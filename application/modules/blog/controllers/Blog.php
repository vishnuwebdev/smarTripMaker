<?php 

class Blog extends MX_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->Model('BlogModel');
		$this->load->Model('HolidayModel');
        $this->load->helper('text');
	}

   public function index() 
   
   {
		$blogs = $this->BlogModel->get_blog_list("blog_list");
		$data["blogs"] = $blogs;	    
		// echo "<pre>";
		// print_r($blogs);die;		
		
		$this->load->view("blog/index",$data);
	}
	
	public function blogdetail($slug = Null)    
   {
		//print_r($slug);die;
        if ($slug != NULL) {
           // $bookingdetail = $this->HolidayModel->get_bookingdetail($slug);

            $result = $this->BlogModel->get_blog_detail($slug);
			 $data["result"] = $result;
			// print_r($result);die;
			 
            }else{
              $data["result"] = "not";
            }
        
		$this->load->view("blog/blog_detail",$data);
	}
        

    public function about_us() {

		$this->load->view("front/about_us");

	}

	public function disclaimer() {

		$this->load->view("front/disclaimer");

	}

	public function faq_help() {
		$this->load->view("front/faq&help");
	}

	public function privacy_policy() {
		$this->load->view("front/privacy_policy");
	}

	public function terms_conditions() {
		$this->load->view("front/terms_conditions");
	}

	public function contact_us(){
		$this->load->view("front/contact_us");
	}

	public function contact_query() {
        $RequestMethod = $this->input->server('REQUEST_METHOD');
        if ($RequestMethod == "POST") {
		   
		
			

                $data = array(
                    "com_name" => $this->input->post('name'),
                    "com_email" => $this->input->post('email'),
                    "com_mobile" => $this->input->post('mobile'),
                    "com_subject" =>$this->input->post('subject'),
                    "com_description" => $this->input->post('message'),
                    "com_status" => "open",
                    "com_query_type" => "contact"
				);
				
                $this->FrontModel->submitQuery($data);
                $this->session->set_flashdata('alertmsg',array('class'=>"btn-success", 'message' => 'you have submit query successfully!'));
                redirect('front/contact_us');
            }
    }
	

 
	
	public function fetch_city() {
		$id = $this->input->post ( 'id' );
		$bp_by_code=$return_city = $this->FrontModel->by_code ( $id );
		$bp_by_city_name = $this->FrontModel->by_city_name ( $id );

		$bp_result_array=array();

		if(isset($bp_by_code[0])) {
			array_push($bp_result_array, $bp_by_code[0]);
		}
		if(isset($bp_by_city_name[0])) {
			array_push($bp_result_array, $bp_by_city_name[0]);
		}
		echo json_encode($bp_result_array);		
	}

		public function fetch_city_to() {
		$id = $this->input->post ( 'id' );
		$bp_by_code=$return_city = $this->FrontModel->by_code ( $id );
		$bp_by_city_name = $this->FrontModel->by_city_name ( $id );
		$bp_result_array=array();

		if(isset($bp_by_code[0])) {
			array_push($bp_result_array, $bp_by_code[0]);
		}
		if(isset($bp_by_city_name[0])) {
			array_push($bp_result_array, $bp_by_city_name[0]);
		}
		echo json_encode($bp_result_array);
	
	}


	public function tse_deals()
	{  $RequestMethod = $this->input->server ( 'REQUEST_METHOD' );
		
		if ($RequestMethod == "POST") {
		$location = $this->input->post('location');
		//print_r($location); exit;
		$dsa_id = $this->dsa_data->dsa_id;
		$result = $this->FrontModel->get_tse_deals($location,$dsa_id);
		$data ['result'] = $result;
		//print_r($data); exit;
		$voucher=array();
		$category=array();
		if(is_array($result)){
		foreach($result as $results){
			$brand_id=$results->voubran_id;
			$voucher[$brand_id]=$this->FrontModel->get_brand($dsa_id,$brand_id);
			$category_id=$results->voubran_category;
			if(isset($category_id)) {
				$category=$this->FrontModel->get_category($dsa_id,$category_id);
			}
			
		}
		}
		$data ['voucher'] = $voucher;
		$data ['category'] = $category;
		//print_r($data); exit;
		
		//print_r($data); exit;
		$this->load->view ( "tse_deals",$data);
		} else {
			redirect("b2b");
		}
		
	}
	
	
	public function tse_deals_detail()
	{
		$brand_id = url_decode($this->input->get('ref_id'));
		//print_r($brand_id); exit;
		$dsa_id = $this->dsa_data->dsa_id;
		$result = $this->FrontModel->get_tse_deals_details($brand_id,$dsa_id);
		$data ['result'] = $result;
		//print_r($data); exit;
		$voucher=array();
		$category=array();
		if(is_array($result)){
		foreach($result as $results){
			$brand_id=$results->voubran_id;
			$voucher[$brand_id]=$this->FrontModel->get_brand($dsa_id,$brand_id);
			$category_id=$results->voubran_category;
			if(isset($category_id)) {
				$category=$this->FrontModel->get_category($dsa_id,$category_id);
			}
			
		}
		}
		$data ['voucher'] = $voucher;
		$data ['category'] = $category;
		//print_r($data); exit;
		
		//print_r($data); exit;
		$this->load->view ( "tse_deals_detail",$data);
	}
	
/* 	public function email_test()
	{
		$dsaemailsetting = $this->FrontModel->get_mailsetting ( $this->dsa_data->dsa_id );
		$emailconfig = array (
					 "smtp_host" => $dsaemailsetting->email_smtp_host,
					 "smtp_port" => $dsaemailsetting->email_smtp_port,
					 "smtp_username" => $dsaemailsetting->email_smtp_user,
					 "smtp_password" => $dsaemailsetting->email_smtp_password,
					 "smtp_frommail" => $dsaemailsetting->email_from,
					 "smtp_name" => $dsaemailsetting->email_name 
		);
		print_r($emailconfig);
		$mail_id = "vishank@srdvtechnologies.com";
		$sender_subject ="dfgyhudtghju";
		$message="xdfyhdtg";
		$ch = email_send ( $mail_id, $sender_subject, $message, $emailconfig );
	} */


	public function change_currency()
	{
		$currency = $this->input->get('currency');
		//print_r($currency );die;
		if($currency=="INR")
		{
			$_SESSION['set_currency'] = $currency;
		} 
		elseif($currency=="USD")
		{
			$_SESSION['set_currency'] = $currency;
		} 
		elseif($currency=="Euro")
		{
			$_SESSION['set_currency'] = $currency;
		} 
		elseif($currency=="OMR")
		{
			$_SESSION['set_currency'] = $currency;
		} 
		elseif($currency=="KWD")
		{
			$_SESSION['set_currency'] = $currency;
		} 
		elseif($currency=="QAR")
		{
			$_SESSION['set_currency'] = $currency;
		} 
		elseif($currency=="BD")
		{
			$_SESSION['set_currency'] = $currency;
		} 
		elseif($currency=="AED")
		{
			$_SESSION['set_currency'] = $currency;
		} 
		elseif($currency=="LKR")
		{
			$_SESSION['set_currency'] = $currency;
		} 
		elseif($currency=="SAR")
		{
			$_SESSION['set_currency'] = $currency;
		} 
		
		
		else {
			$_SESSION['set_currency'] = "INR";
		}
		
		
		//$_SESSION['set_currency'] = $currency;
        redirect ( "" );
	
	}

	

	

 }



