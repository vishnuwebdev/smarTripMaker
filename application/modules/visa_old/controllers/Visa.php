<?php
class Visa extends MX_Controller {
    function __construct() {
        parent::__construct();
        $this->load->helper('captcha');
        $this->load->Model(array('VisaModel', 'Common_Model'));
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('common_helper');
        // if (($this->session->userdata('Userlogin') == NULL)) {
        //         redirect('user/login');
        //     }
    }

    public function index() {

        unset ( $_SESSION ['visa'] );
        
        $sliderimg = $this->VisaModel->get_slider_img("slider_image");
        $data["sliderimg"] = $sliderimg;
        $data["visalist"] = $this->VisaModel->get_visa_list("visa_list");

        $category1 = $this->VisaModel->get_category("1");
        $category2 = $this->VisaModel->get_category("2");
        
        $keywordarray = array();
        $masterkey = array();
        $singlearray = array();
        foreach($getkeyword as $key=> $value){
            if($value->search_keyword){
                $keywordarray = explode(",",$value->search_keyword);
                $masterkey = array_filter($keywordarray, 'strlen');
                foreach($masterkey as $keyword){
                    $singlearray[] = ($keyword);
                }
                
            }

        }
        $package1 = $this->VisaModel->get_packages_by_category_id("1");
        $package2 = $this->VisaModel->get_packages_by_category_id("2");
        $blogs = $this->VisaModel->get_blog_list("blog_list");
        $data["blogs"] = $blogs;

        $data['category1'] = $category1;
        $data['category2'] = $category2;
        $data['package1'] = $package1;
        $data['package2'] = $package2;
        $data['keyword'] = json_encode(array_unique($singlearray));
        
        $this->load->view("index", $data);


    }

    public function search(){
        $uniqueId = uniqid(rand(), TRUE);//generates random number 
        if(!$this->session->has_userdata('my_session_id'))//if session is not set then it sets (if your session has already value then this step will be skip out)
        {
            $this->session->set_userdata("my_session_id", md5($uniqueId)); 
        }
        $userid = $this->session->userdata('Userlogin')["id"];
        $data['nationality'] = $this->Common_Model->get_full_table("nationality");
        $data['visa_id'] = $this->input->post("type");
        $RequestMethod = $this->input->server('REQUEST_METHOD');
        
        if ($RequestMethod == "POST" && $this->input->post("firstName") != '') {
            $data['visa_id'] = $this->input->post("visa_id");
            $validateVisa = $this->VisaModel->get_visa_by_id("visa_list",$data['visa_id']);

            if($validateVisa) {
                $this->session->set_userdata("visa_destination", $_REQUEST['destination']);
                $this->session->set_userdata("visa_type", $_REQUEST['type']);
                $this->form_validation->set_error_delimiters('<p class="form-error">', '</p>');
                $this->form_validation->set_rules('firstName', 'First Name', 'required');
                if($id = $this->VisaModel->add()){
                    if($this->session->userdata['Userlogin']["id"]) {
                        $ccavenueConfig = $this->VisaModel->get_visa_by_id_before_login("ccavenue_config",'1');
                        $data['paymentData'] = $this->setPaymentData($id,$validateVisa,$ccavenueConfig->merchant_id);
                        $data['ccavenueConfig'] = $ccavenueConfig;
                        $this->load->view('submit_visa',$data);    
                    }else{
                        $this->session->set_userdata("payment_pending", $id); 
                        redirect('user/login');
                    }
                    //$this->session->set_flashdata('cusmsg', '');
                } else {
                    $this->load->view('apply_visa',$data);    
                    $this->session->set_flashdata('flash_error','Sorry! Unable to send your visa application. Please try again.');
                    //$this->session->set_flashdata('cusmsg', '');
                }
            } else {
                $this->session->set_flashdata('flash_error','Sorry! Unable to send your visa application. Please try again.');

            }
        }else{
            $this->load->view('apply_visa',$data);    
        }
    }

    function setPaymentData($id,$amount,$merchant_id){
        $data['merchant_id'] = $merchant_id;
        $data['order_id'] = $id;
        $data['amount'] = $amount;
        $data['currency'] = 'INR';
        $data['redirect_url'] = site_url('visa/ccavResponseHandler');
        $data['cancel_url'] = site_url('visa/ccavResponseHandler');
        $data['language'] = 'EN';
        $data['delivery_name'] = $this->input->post('firstName').' '.$this->input->post('lastName');
        return $data;
    }

    function ccavResponseHandler(){
        $ccavenueConfig = $this->VisaModel->get_visa_by_id_before_login("ccavenue_config",'1');
        $workingKey=$ccavenueConfig->working_key;     //Working Key should be provided here.
        $encResponse=$_POST["encResp"];         //This is the response sent by the CCAvenue Server
        $rcvdString=cc_decrypt($encResponse,$workingKey);      //Crypto Decryption used as per the specified working key.
        $order_status="";
        $decryptValues=explode('&', $rcvdString);
        $dataSize=sizeof($decryptValues);
        for($i = 0; $i < $dataSize; $i++) 
        {
            $information=explode('=',$decryptValues[$i]);
            if($i==3)   $order_status=$information[1];
        }

        if($order_status==="Success")
        {
            $this->session->set_flashdata('flash_success','Thank you for visa request. Your transaction is successful.');
            
        }
        else if($order_status==="Aborted")
        {
            $this->session->set_flashdata('flash_error','The transaction has been aborted.');
        }
        else if($order_status==="Failure")
        {
            $this->session->set_flashdata('flash_error','The transaction has been declined.');
        }
        else
        {
            $this->session->set_flashdata('flash_error','Security Error. Illegal access detected');
        }
        $paymentData = [];
        for($i = 0; $i < $dataSize; $i++) 
        {
            $information=explode('=',$decryptValues[$i]);
            $paymentData[$information[0]] = $information[1];
        }
        $validateVisa = $this->VisaModel->addVisaPayment($paymentData);
        redirect('visa/visaResponse');

    }

    function setPaymentDataAfterLogin(){
        if($this->session->userdata('payment_pending')){
            $id = $this->session->userdata('payment_pending');
            $validateVisa = $this->VisaModel->get_visa_by_id_before_login("visa",$id);
            if(!empty($validateVisa)){
                $this->VisaModel->update_visa("visa",$id);
                $data['visa_id'] = $id;
                $data['merchant_id'] = '178695';
                $data['order_id'] = $id;
                $data['amount'] = $this->VisaModel->get_visa_by_id("visa_list",$validateVisa->request_visa_id);
                $data['currency'] = 'INR';
                $data['redirect_url'] = site_url('visa/ccavResponseHandler');
                $data['cancel_url'] = site_url('visa/ccavResponseHandler');
                $data['language'] = 'EN';
                $data['delivery_name'] = $validateVisa->firstName.' '.$validateVisa->lastName;
                $paymentData['paymentData'] = $data;
                $this->session->unset_userdata('payment_pending');
                $this->load->view('submit_visa',$paymentData);    
            }
        } else {
            $this->session->set_flashdata('flash_error','Unable to access this page.');
            redirect('visa');
        }
    }

    function visaResponse(){
        $this->load->view('apply_visa_response');    
    }
}

