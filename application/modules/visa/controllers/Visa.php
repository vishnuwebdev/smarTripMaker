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
        $sliderimg 				= $this->VisaModel->get_slider_img("slider_image");
        $data["sliderimg"] 		= $sliderimg;
        $data["visalist"] 	= $this->VisaModel->get_visa_list("visa_list");
		$data["location_list"] 	= $this->VisaModel->visa_location_list();
        $category1 				= $this->VisaModel->get_category("1");
        $category2 				= $this->VisaModel->get_category("2");
        
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
        $package1 		= $this->VisaModel->get_packages_by_category_id("1");
        $package2 		= $this->VisaModel->get_packages_by_category_id("2");
        $blogs 			= $this->VisaModel->get_blog_list("blog_list");
        $data["blogs"] 	= $blogs;

        $data['category1'] 	= $category1;
        $data['category2'] 	= $category2;
        $data['package1'] 	= $package1;
        $data['package2'] 	= $package2;
        $data['keyword'] 	= json_encode(array_unique($singlearray));
        
        $this->load->view("index", $data);

    }

    public function search(){
       
        $uniqueId = uniqid(rand(), TRUE);//generates random number 
        //if session is not set then it sets (if your session has already value then this step will be skip out)
        if(!$this->session->has_userdata('my_session_id')){
            $this->session->set_userdata("my_session_id", md5($uniqueId)); 
        }
        $userid = $this->session->userdata('Userlogin')["id"];
        $data["location_list"] 	= $this->VisaModel->visa_location_list();
        $data["visalist"] 		= $this->VisaModel->get_visa_list("visa_list");
		$data['nationality'] 	= $this->Common_Model->get_full_table("nationality");
		$data['visa_id'] 		= bp_hash( $this->input->post("type") );
        $data['location_id'] 	= bp_hash( $this->input->post("destination") );
        $data['email'] = $this->input->post("email");
        $data['phone'] = $this->input->post("phone");
        $RequestMethod = $this->input->server('REQUEST_METHOD');
        if ($RequestMethod == "POST" && $this->input->post("firstName") != '') {
            $data['visa_id'] = bp_hash( $this->input->post("visa_type") );
            $validateVisa = $this->VisaModel->get_visa_by_id_before_login("visa_list",$data['visa_id']);
            if($validateVisa->visa_amount) {
                $this->input->post["visa_destination"] = $validateVisa->visa_title;
                $this->session->set_userdata("visa_destination", $validateVisa->visa_title);
                $this->session->set_userdata("visa_type", $validateVisa->id);
                $this->form_validation->set_error_delimiters('<p class="form-error">', '</p>');
                $this->form_validation->set_rules('firstName', 'First Name', 'required');
                if($id = $this->VisaModel->add()){
                    $_SESSION['visa_insert_ID'] = $id;
                    $visaId = $id;
                    $data['visaId'] = $visaId;
                    if($this->session->userdata['Userlogin']["id"]) {
                        if($this->input->post("payment_method")) {
                            if($this->user_data->cust_balance > 0){
                                if($this->user_data->cust_balance > $validateVisa->visa_amount){
                                    $user_id = $this->session->userdata['Userlogin']["id"];
                                    $updateArray['cust_balance'] = $this->user_data->cust_balance - $validateVisa->visa_amount;
                                    $this->VisaModel->update_profile($user_id,$updateArray);
                                    $formData = array (
                                        "visa_id" 			=> $id,
                                        "order_id" 			=> $id,
                                        "tracking_id" 		=> 0,
                                        "order_status" 		=> 'Success',
                                        "amount" 			=> $validateVisa->visa_amount,
                                        "discount_value" 	=> 0,
                                        "trans_date" 		=> date('d/m/y h:i:s'),
                                        "payment_data" 		=> 'Visa payment paid by wallet.'
                                    );
                                    $this->VisaModel->addVisaPayment($formData);
                                    $formData = array (
                                        "wallet_id" 			=> $user_id,
                                        "order_id" 				=> $id,
                                        "customer_id" 			=> $user_id,
                                        "amount_detected" 		=> $validateVisa->visa_amount,
                                        "amount_added" 			=> 0,
                                        "wallet_action_detail" 	=> 'Visa payment paid by wallet.',
                                        "created" 				=> date('y-m-d h:i:s')
                                    );
                                    $this->VisaModel->insert_table('stm_wallet_history',$formData);
                                    $this->sendNotifiction($visaId);
                                    $this->session->set_flashdata('flash_success',$customer_message);
                                    redirect('visa/visaResponse');
                                }else {
                                    $this->session->set_userdata("wallet_amount_detected", $this->user_data->cust_balance); 
                                    $ccavenueConfig = $this->VisaModel->get_visa_by_id_before_login("ccavenue_config",'1');
                                    $remainingAmount = $validateVisa->visa_amount - $this->user_data->cust_balance;
                                    $data['paymentData'] = $this->setPaymentData($id,$visaId,($remainingAmount),$ccavenueConfig->merchant_id);
                                    $data['ccavenueConfig'] = $ccavenueConfig;
                                    // $this->load->view('submit_visa',$data);    
                                    $this->startPaymentGateway($data);
                                }
                            }else {
                                $this->session->set_flashdata('flash_error','Insufficient wallet balance. Please try again.');
                                redirect('visa/search');
                            }
                        }else{
                            $ccavenueConfig = $this->VisaModel->get_visa_by_id_before_login("ccavenue_config",'1');
                            $data['paymentData'] = $this->setPaymentData($id,$visaId,$validateVisa->visa_amount,$ccavenueConfig->merchant_id);
                            $data['ccavenueConfig'] = $ccavenueConfig;
                            // $this->load->view('submit_visa',$data);    
                            $this->startPaymentGateway($data);
                        }
                    }else{
                        $this->session->set_userdata("payment_pending", $id); 
                        redirect('user/login');
                    }
                } else {
                    $this->load->view('apply_visa',$data);    
                    $this->session->set_flashdata('flash_error','Sorry! Unable to send your visa application. Please try again.');
                    //$this->session->set_flashdata('cusmsg', '');
                }
            } else {
                $this->session->set_flashdata('flash_error','Sorry! Unauthenticated data passed in request. Please try again.');
                $this->load->view('apply_visa',$data);
            }
        }else{			
			if( $data['visa_id'] == 0 && $data['location_id'] == 0 ){
				redirect('visa');
			}
            //$this->session->set_flashdata('flash_error','Unauthenticated data passed in request. Please try again.');
            $this->load->view('apply_visa',$data);    
        }
    }

    function setPaymentData($id,$visaId,$amount,$merchant_id){
        $data['merchant_id'] = $merchant_id;
        $data['order_id'] = $id;
        $data['amount'] = convertPrice($amount);
        // $data['currency'] = 'INR';
        //$data['currency'] = 'USD';
        $data['currency'] = getCurrentCurrency();
        $data['redirect_url'] = site_url('visa/ccavResponseHandler');
        $data['cancel_url'] = site_url('visa/ccavResponseHandler');
        $data['language'] = 'EN';
        $data['delivery_name'] = $this->input->post('firstName').' '.$this->input->post('lastName');
        $data['merchant_param1'] = $visaId;
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
        for($i = 0; $i < $dataSize; $i++) {
            $information=explode('=',$decryptValues[$i]);
            if($i==3)   $order_status=$information[1];
        }
        $paymentData = [];
        for($i = 0; $i < $dataSize; $i++) {
            $information=explode('=',$decryptValues[$i]);
            $paymentData[$information[0]] = $information[1];
        }
        if($order_status==="Success"){
            // $userid = $this->session->userdata('Userlogin')["id"];
            // $message = $paymentData['delivery_name']." has make a successful transaction of a visa for more information please check your panel.";
            // email_send ( "info@smarttripmaker.com", "Visa Request", $message );
            // $customer_message = 'Thank you for visa request. Your transaction is successful.';
            // email_send ( $paymentData['merchant_param1'], "Visa Request",$customer_message );
            $visaId = $paymentData['merchant_param1'];
            $this->sendNotifiction($visaId);
            $this->session->set_flashdata('flash_success','Thank you for visa request. Your transaction is successful.');
        }else if($order_status==="Aborted"){
            $this->session->set_flashdata('flash_error','The transaction has been aborted.');
        }else if($order_status==="Failure"){
            $this->session->set_flashdata('flash_error','The transaction has been declined.');
        }else{
            $this->session->set_flashdata('flash_error','Security Error. Illegal access detected');
        }
        
        // $validateVisa = $this->VisaModel->addVisaPayment($paymentData);
        // if($order_status==="Success" && $this->session->userdata('wallet_amount_detected')){
        //     $formData = array (
        //         "wallet_id" => $this->session->userdata('Userlogin')["id"],
        //         "order_id" => $paymentData['order_id'],
        //         "customer_id" => $this->session->userdata('Userlogin')["id"],
        //         "amount_detected" => $this->session->userdata('wallet_amount_detected'),
        //         "amount_added" => 0,
        //         "wallet_action_detail" => 'Visa payment paid by wallet.',
        //         "created" => date('y-m-d h:i:s')
        //     );
        //     $this->VisaModel->insert_table('stm_wallet_history',$formData);
        //     $user_id = $this->session->userdata['Userlogin']["id"];
        //     $updateArray['cust_balance'] = $this->session->userdata('wallet_amount_detected') - $paymentData['amount'];
        //     $this->VisaModel->update_profile($user_id,$updateArray);
        //     $this->session->unset_userdata('wallet_amount_detected');
        // }
        $this->storeVisaResponse($paymentData);
        redirect('visa/visaResponse');
    }

    private function generateRazorOrder($orderData){
        $ch = curl_init(RAZOR_PAY_HOST.'orders');
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $orderData);
        curl_setopt($ch, CURLOPT_USERPWD, RAZOR_API_KEY . ":" . RAZOR_CLIENT_SECRET);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'Content-Length: ' . strlen($orderData)
		));
        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result,true);
    }

    function setPaymentDataAfterLogin(){
        if($this->session->userdata('payment_pending')){
            $id = $this->session->userdata('payment_pending');
            $validateVisa = $this->VisaModel->get_visa_by_id_before_login("visa",$id);
            if(!empty($validateVisa)){
                $this->VisaModel->update_visa("visa",$id);
                $ccavenueConfig = $this->VisaModel->get_visa_by_id_before_login("ccavenue_config",'1');
                $data['visa_id'] = $id;
                $data['merchant_id'] = $ccavenueConfig->merchant_id;
                $data['order_id'] = $id;
                $data['amount'] = $this->VisaModel->get_visa_by_id("visa_list",$validateVisa->request_visa_id);
                $data['currency'] = getCurrentCurrency();
                $data['redirect_url'] = site_url('visa/ccavResponseHandler');
                $data['cancel_url'] = site_url('visa/ccavResponseHandler');
                $data['language'] = 'EN';
                $data['delivery_name'] = $validateVisa->firstName.' '.$validateVisa->lastName;
                $data['merchant_param1'] = $id;
                $paymentData['paymentData'] = $data;
                $paymentData['ccavenueConfig'] = $ccavenueConfig;
                $this->session->unset_userdata('payment_pending');
                $this->startPaymentGateway($data);
                // $this->load->view('submit_visa',$paymentData);    
            }
        } else {
            $this->session->set_flashdata('flash_error','Unable to access this page.');
            redirect('visa');
        }
    }

    function visaResponse(){
        if(isset($_SESSION['visa_insert_ID'])){
            $id = $_SESSION['visa_insert_ID'];
            $visaData = $this->VisaModel->getVisa($id);
            $this->load->view('apply_visa_response',['visa'=>$visaData]);    
        }else{
            return redirect("visa/");
        }
    }
	
	public function get_visa_list_by_location_id() { 
		if(!empty($_POST['id'])){
			$converted_list = array();
			$location_id 	= bp_hash($_POST['id']);
			$visa_list  	=  $this->VisaModel->visa_list_by_location_id( $location_id );
			if( $visa_list != false ){ 
				// convert the visa price and id
				foreach( $visa_list as $list){
					$converted_list[] = array( "id" => bp_hash($list['id']), "visa_title" => $list['visa_title'], "visa_amount" => convertPrice($list['visa_amount']) );
				}
				echo json_encode($converted_list);
			}
			else{
				echo json_encode($visa_list);
			}
		}
		else{
			return false;
		}
    }
    
    public function sendNotifiction($visaId){
        $visaData = $this->VisaModel->getVisa($visaId);
        $dirPath = './assets/upload/visa/';
        $userName = $visaData->firstName." ".$visaData->lastName;
        $message = "Visa information given bellow :<br><br>";
        $message .= "Name : $userName<br>";
        $message .= "Email : ".$visaData->email."<br>";
        $message .= "Mobile Phone : ".$visaData->phone."<br>";
        $message .= "Gender : ".$visaData->gender."<br>";
        $message .= "Visa Type : ".$visaData->visaType."<br>";
        $message .= "Country : ".$visaData->nationality."<br>";
        $message .= "Date of birth : ".$visaData->dob."<br>";
        $message .= "Departure Date : ".$visaData->departureDate."<br>";
        $message .= "Arrival Date : ".$visaData->arrivalDate."<br><br>";

        $passFrontFile = $dirPath.$visaData->passportFront;
        $passBackFile = $dirPath.$visaData->passportBack;
        $photographFile = $dirPath.$visaData->photograph;
        $attachment = [];
        if(file_exists($passFrontFile)){
            array_push($attachment,[
                'name' => 'Passport Front File',
                "src" => $passFrontFile,
                "type" => mime_content_type($passFrontFile)
            ]);
        }
        if(file_exists($passBackFile)){
            array_push($attachment,[
                'name' => 'Passport Back File',
                "src" => $passBackFile,
                "type" => mime_content_type($passBackFile)
            ]);
        }
        if(file_exists($photographFile)){
            array_push($attachment,[
                'name' => 'Passport Back File',
                "src" => $photographFile,
                "type" => mime_content_type($photographFile)
            ]);
        }
        $adminNotification = "$userName has make a successful transaction, for information please check your panel.<br><br>$message";
        emailWithAttachment ( "info@smarttripmaker.com", "Visa Request", $adminNotification ,$attachment);
        $customerNotification = "Thank you for visa request. Your transaction is successful.<br><br>$message";
        emailWithAttachment ($visaData->email, "Visa Request",$customerNotification,$attachment);
        return true;
    }

    private function generateOrderData($data){
        $this->session->unset_userdata('visaTransactionData');
        $orderData = [
            "amount" => $data['amount']*100,
            "currency" => "INR",
            "receipt" => "visa_".$data['order_id']
        ];
        return json_encode($orderData);
    }

    private function startPaymentGateway($data){
        if($data['paymentData']['currency'] == INR){
            $orderData = $this->generateOrderData($data['paymentData']);
            $orderResponse = $this->generateRazorOrder($orderData);
            $this->storeTransactionData($data['paymentData'],$orderResponse);
            if(isset($orderResponse['error'])){
                return redirect("visa/");
                $this->session->set_flashdata('flash_error','Sorry! Unable to send your visa application. Please try again.');
            }else{
                unset($data['location_list']);
                unset($data['nationality']);
                unset($data['visalist']);
                $data['gatewayData'] = $orderResponse;
                $this->session->set_userdata('visaTransactionData', $data);
                $this->load->view('razor_gateway_submit',$data);
            }
        }else{
            $this->load->view('submit_visa',$data);    
        }
    }

    private function storeVisaResponse($paymentData){
        $validateVisa = $this->VisaModel->addVisaPayment($paymentData);
        if($order_status==="Success" && $this->session->userdata('wallet_amount_detected')){
            $formData = array (
                "wallet_id" => $this->session->userdata('Userlogin')["id"],
                "order_id" => $paymentData['order_id'],
                "customer_id" => $this->session->userdata('Userlogin')["id"],
                "amount_detected" => $this->session->userdata('wallet_amount_detected'),
                "amount_added" => 0,
                "wallet_action_detail" => 'Visa payment paid by wallet.',
                "created" => date('y-m-d h:i:s')
            );
            $this->VisaModel->insert_table('stm_wallet_history',$formData);
            $user_id = $this->session->userdata['Userlogin']["id"];
            $updateArray['cust_balance'] = $this->session->userdata('wallet_amount_detected') - $paymentData['amount'];
            $this->VisaModel->update_profile($user_id,$updateArray);
            $this->session->unset_userdata('wallet_amount_detected');
        }
        return true;
    }

    public function handleResponse(){
        $response = ['status' => 'failed','route' => 'visa'];
        if($this->session->has_userdata('visaTransactionData')){
            $visaTempData = $this->session->userdata('visaTransactionData');
            $status = $_POST['status'];
            $responseData = $_POST['response'];
            if($status == "success" && $responseData['razorpay_order_id'] == $visaTempData['gatewayData']['id']){
                $visaTempData['paymentData']['tracking_id'] = $responseData['razorpay_order_id'];
                $visaTempData['paymentData']['order_status'] = "Success";
                $visaTempData['paymentData']['discount_value'] = 0;
                $visaTempData['paymentData']['type'] = "razor_pay";
                $visaTempData['paymentData']['razor_pay_response'] = json_encode($responseData);
                $visaTempData['paymentData']['trans_date'] = date("d/m/Y H:m:i");
                $this->storeVisaResponse($visaTempData['paymentData']);
                $this->session->unset_userdata('visaTransactionData');
                $this->sendNotifiction($visaId);
                $this->session->set_flashdata('flash_success','Thank you for visa request. Your transaction is successful.');
                $response['status'] = 'success';
                $response['route'] = 'visa/visaResponse';
            }else{
                $visaTempData['paymentData']['tracking_id'] = $visaTempData['gatewayData']['id'];
                $visaTempData['paymentData']['order_status'] = "Failed";
                $visaTempData['paymentData']['discount_value'] = 0;
                $visaTempData['paymentData']['type'] = "razor_pay";
                $visaTempData['paymentData']['razor_pay_response'] = json_encode($responseData);
                $visaTempData['paymentData']['trans_date'] = date("d/m/Y H:m:i");
                $this->storeVisaResponse($visaTempData['paymentData']);
                $this->session->unset_userdata('visaTransactionData');
               // $this->sendNotifiction($visaId);
                $this->session->set_flashdata('flash_error','Your visa transaction got failed. Please try again.');
                $response['status'] = 'error';
                $response['route'] = 'visa/';
            }
        }
        echo json_encode($response);
    }
    
    private function storeTransactionData($paymentData,$orderData){
        $dbData = [];
        $dbData['visa_id'] = $paymentData['order_id'];
        $dbData['order_id'] = $paymentData['order_id'];
        $dbData['order_status'] = "Pending";
        $dbData['amount'] = $paymentData['amount'];
        $dbData['tracking_id'] = $orderData['id'];
        $isExist = $this->VisaModel->getVisaTransaction($dbData['visa_id']);
        if($isExist){
            $this->VisaModel->updatePaymentTransaction($dbData);
        }else{
            $this->VisaModel->addInitialTransaction($dbData);
        }
    }

    
}