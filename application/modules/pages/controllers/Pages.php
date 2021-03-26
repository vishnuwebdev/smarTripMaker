<?php

class Pages extends MX_Controller{

	public function __construct(){

		parent::__construct();

		$this->load->helper('captcha');

		$this->load->model ( "Page_Model" );

		$this->model_name="Page_Model";

		$this->load->model ( "Common_Model" );

		$this->load->library('pagination');

		$this->load->library('session');

		$this->load->helper ( "common" );

		if (($this->session->userdata ( 'loginDetail' ) == NULL)) {

		} else {

			$this->user_data = $this->Page_Model->get_table ( "*", "user_id", $this->session->userdata ( 'loginDetail' )->user_id, "users" );

		}

		//$this->latest_news_for_sidebar=$this->Page_Model->latest_1_news_list();

	}

	

	

	public function contact_us() {

		$request_type = $this->input->server ( "REQUEST_METHOD" );

		if ($request_type == "POST") {

			$inputCaptcha = $this->input->post('captcha');

			$sessCaptcha = $this->session->userdata('captchaCode');

			if($inputCaptcha === $sessCaptcha){

				

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

				$id = $this->Page_Model->insert_table ( "common_queries", $data1 );

				$data ['result'] = $this->Page_Model->get_table ( "*", "com_id", $id, "common_queries" );		

				

				$mail_id ="info@smarttripmaker.com";

				$sender_subject ="Contact Query";

				$message = $this->load->view ( 'pages/contact_us_email', $data, TRUE );

				//print_r($message);die;

				//$ch = email_send ( $mail_id, $sender_subject, $message );

				

				$this->session->set_flashdata ( "alertmsg", array (

					"message" => "Request Successfully Submitted",

					"class" => "alert-success"

				) );

			}

			else{

				$this->session->set_flashdata ( 'wrong_cap', 'Captcha code does not match, please try again.' );

			}

			redirect("pages/contact_us");

		} 

			 // $this->load->helper('captcha');

		$config = array(

			'img_path'      => 'captcha_images/',

			'img_url'       => base_url().'captcha_images/',

			'font_path'     => 'system/fonts/texb.ttf',

			'img_width'     => '150',

			'img_height'    => 50,

			'word_length'   => 5,

			'font_size'     => 22,

			'pool'         => '0123456789',

            // 'colors'        => array(

                // 'background' => array(255, 255, 255),

                // 'border' => array(255, 255, 255),

                // 'text' => array(0, 0, 0),

                // 'grid' => array(255, 40, 40)

            // )

		);

		$captcha = create_captcha($config);



        // Unset previous captcha and set new captcha word

		$this->session->unset_userdata('captchaCode');

		$this->session->set_userdata('captchaCode', $captcha['word']);



        // Pass captcha image to view

		$data['captchaImg'] = $captcha['image'];

		$this->load->view ('contact_us',$data);

	}

	

	

	public function carrier() {

		$request_type = $this->input->server ( "REQUEST_METHOD" );

		if ($request_type == "POST") {

			$inputCaptcha = $this->input->post('captcha');

			$sessCaptcha = $this->session->userdata('captchaCode');

			if($inputCaptcha === $sessCaptcha){

				

				if($_FILES['userfile']['error']>0){

					$bp_image_name="";

				}else{

					$image_data1=$this->Page_Model->do_upload();

					$bp_image_name=$image_data1 ['file_name'];

				}



				$data1 = 

				array (

					"job_name" => $this->input->post ( "name" ),

					"job_email" => $this->input->post ( "email" ), 

					"job_mobile" => $this->input->post ( "mobile" ),  

					"job_description" => $this->input->post ( "message" ), 

					"job_subject" => $this->input->post ( "subject" ), 

					"job_resume" => $bp_image_name,

					"job_query_type" => "Job",  

					"job_user_type" => "DSA",  

					"job_user_id" => $this->dsa_data->dsa_id,

				);



				$id = $this->Page_Model->insert_table ( "job_queries", $data1 );



				$data ['result'] = $this->Page_Model->get_table ( "*", "job_id", $id, "job_queries" );			

				$mail_id ="info@smarttripmaker.com";

				$sender_subject ="Job Query";

				$message = $this->load->view ( 'pages/career_email', $data, TRUE );		

				$ch = email_send ( $mail_id, $sender_subject, $message );



				$this->session->set_flashdata ( "alertmsg", array (

					"message" => "Job Request Successfully Submitted",

					"class" => "alert-success"

				) );

			}

			else{

				$this->session->set_flashdata ( 'wrong_cap', 'Captcha code does not match, please try again.' );

			}



			redirect("career");

		} 

		$config = array(

			'img_path'      => 'captcha_images/',

			'img_url'       => base_url().'captcha_images/',

			'font_path'     => 'system/fonts/texb.ttf',

			'img_width'     => '150',

			'img_height'    => 50,

			'word_length'   => 5,

			'font_size'     => 22,

			'pool'         => '0123456789',

            // 'colors'        => array(

                // 'background' => array(255, 255, 255),

                // 'border' => array(255, 255, 255),

                // 'text' => array(0, 0, 0),

                // 'grid' => array(255, 40, 40)

            // )

		);

		$captcha = create_captcha($config);

		

        // Unset previous captcha and set new captcha word

		$this->session->unset_userdata('captchaCode');

		$this->session->set_userdata('captchaCode', $captcha['word']);

		

        // Pass captcha image to view

		$data['captchaImg'] = $captcha['image'];

		$this->load->view ('carrier',$data);

	}

	

	

	

	public function terms_condition(){



		$this->load->view('terms_condition');  

	}



	public function privacy_policy(){



		$this->load->view('privacy_policy');  

	}

	

	public function newsletter(){ 	

		$status = "active";
		if($_POST){	
			$this->form_validation->set_rules('email', 'email', 'required'); 
			if ($this->form_validation->run() == FALSE) { 
				$this->session->set_flashdata ( 'error',  'Please fill Email Correctly' );
				redirect('front'); 
			} else {
				$query = array( 
					'newl_email' 	=>$this->input->post('email'),
					'newl_status' 	=>$status,
					'newl_user_id'	=>$this->dsa_data->dsa_id,
					'newl_user_type' =>"DSA"
				);
				$vale = $this->Page_Model->add_newsletter($query); 
				if ($vale == true) {
					$this->session->set_flashdata ( 'success', 'Subscribed Successfully ' );
					redirect(site_url());
				}	else{
					$this->session->set_flashdata ( 'error',  'Already Subscribed  ' );
					redirect(site_url());
				}
			}
		}
	}





	function ajax_newsletter() {

		$RequestMethod = $this->input->server('REQUEST_METHOD');

		if ($RequestMethod == "POST") {

			$status = "active";

			$data1 = array(					

				'newl_email' 	=>$this->input->post('email'),

				'newl_status' 	=>$status,

				'newl_user_id'	=>$this->dsa_data->dsa_id,

				'newl_user_type' =>"DSA"



			);

			$inserted = $this->Page_Model->add_newsletter($data1);

			if ($inserted == true) {



				$data["status"] = "success";

				$data["message"] = "Subscribed Successfully !";

			} else {

				$data["status"] = "error";

				$data["message"] = "Already Subscribed !";                       

			}



			echo json_encode($data);

		}

	}











	public function blog_list(){

		

		$bp_model_name = $this->model_name;

		$table = "blog_list";

		$where_1_name = "b_status";

		$where_1_value = "active";

		$order_by = "b_id";

		$bp_template_name = "blog_list";

		if ($this->uri->segment ( 3 )) {

			$page = $this->uri->segment ( 3 );

		} else {

			$page = 0;

		}

		$this->db->where ( $where_1_name, $where_1_value );



		$total_row = $this->db->from ( $table )->count_all_results ();

		$pagination_segment = 3;

		$per_page = 5;

		$pagination_url = base_url () . $this->uri->segment ( "1" ) . "/" . $this->uri->segment ( "2" );

		$config = bp_pagination ( $pagination_url, 0, $total_row, $per_page );

		$this->pagination->initialize ( $config );

		$result = $this->Common_Model->pagination_table ( $config ["per_page"], $page, $where_1_name, $where_1_value, $order_by, $table );

		$data ['result'] = $result;

		$this->load->view ( $this->uri->segment ( "1" ) . "/" . $bp_template_name, $data );

	}

	public function blog_detail(){

		$bp_model_name = $this->model_name;

		$name=$this->uri->segment(2);

		$result=$this->$bp_model_name->blog_detail ( $name );

		if($result=="no data"){

			redirect("pages/blog");

		}

		

		$data ['result'] =$result;

		$data ['title'] = $result->b_title;

		$data ['keywords'] = $result->b_keywords;

		$data ['description'] = $result->b_meta_description;

		$this->load->view ( 'pages/blog_detail', $data );

	}

	

	



}





