<?php 

class Online extends MX_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->Model('OnlineModel');
	}
  
        public function index() {
     
	}
    public function contact_us() {
      $request_type = $this->input->server ( "REQUEST_METHOD" );
      if ($request_type == "POST") {
          $data1 = 
          array (
            "com_name" => $this->input->post ( "name" ),
            "com_email" => $this->input->post ( "email" ), 
            "com_mobile" => $this->input->post ( "mobile" ),  
            "com_description" => $this->input->post ( "message" ), 
            "com_subject" => $this->input->post ( "subject" ), 
            "com_query_type" => "contact",  
            "com_user_type" => "DSA",  
            "com_user_id" => $this->dsa_data->dsa_id,
        );
        $this->Common_Model->insert_table ( "common_queries", $data1 );
        $this->session->set_flashdata ( "alertmsg", array (
            "message" => "Request Successfully Submitted",
            "class" => "alert-success"
        ) );
      } 
      $this->load->view ( 'contact_us' );
    }
    

     public function about_us(){
     	$this->load->view('about_us');  
     }

    public function faq_help(){
    	$this->load->view('faq_help');  
    }
	 
     public function careers(){
	  $request_type = $this->input->server ( "REQUEST_METHOD" );
      if ($request_type == "POST") {
			
			if ($_FILES ['userfile'] ['error'] > 0) {
				$bp_image_name = "";
			} else {
				$image_data1 = $this->OnlineModel->do_upload_images();
				$bp_image_name = $image_data1 ['file_name'];
			}
			
			$job_req = array(

				'job_req_first_name'		=>	$this->input->post('first_name'),
				'job_req_last_name'			=>	$this->input->post('last_name'),
				'job_req_email'				=>	$this->input->post('email'),
				'job_req_mob'				=>	$this->input->post('mob'),
				'job_req_age'				=>	$this->input->post('age'),
				'job_req_gender'			=>	$this->input->post('gender'),
				'job_req_pincode'			=>	$this->input->post('pincode'),
				'job_req_experience'		=>	$this->input->post('experience'),
				'job_req_current_salary'	=>	$this->input->post('current_salary'),
				'job_req_notice_per'		=>	$this->input->post('notice_per'),
				'job_req_current_address'	=>	$this->input->post('current_address'),
				'job_req_sales'				=>	$this->input->post('sales'),
				'job_req_resume'			=>	$bp_image_name
			);
			
			$this->Common_Model->insert_table ( "job_request", $job_req );
			$this->session->set_flashdata ( "alert", array (
				"message" => "Job Request Successfully Submitted",
				"class" => "alert-success"
			) );
			
			redirect("careers");
			
	  } else{
		   $this->load->view('careers');  
	  }
        
     }
	 
	 
        
        public function pages(){
            
          //  echo $this->uri->segment(2);
            
            $pagedata = $this->OnlineModel->get_page_data($this->uri->segment(2),$this->dsa_data->dsa_id,"DSA",$this->default_lang);
            
           // PrintArray($pagedata);
           //die;

            $data['result'] = $pagedata;
            $this->load->view('online/pages_dynamic',$data);
        }
        
        
        
        
	
	
	
 }

