<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
class User extends MX_Controller {
    function __construct() {
        parent::__construct();
		$this->load->helper('captcha');
        $this->load->Model(array('UserModel', 'Common_Model'));
        $this->load->library(array('session','google','facebook'));
      //  $this->load->helper('google_helper');
		
        $this->load->helper('url');
        $this->load->helper('common_helper');
		$this->load->helper ( 'user/user');
        $dt = explode('/', uri_string());
        if ($dt["1"] == "reset_passsword") {
            $urlkeyt = $dt["2"];
        } else {
            $urlkeyt = "";
        }

		if ($dt["1"] == "verify_email") {
            $urlkey = $dt["2"];
        } else {
            $urlkey = "";
        }

        $exception_uris = array(
            'user', 'user/google_login_return', 'user/forgotpassword','user/registration',
            'user/login',
            'user/verify_email/' . $urlkey,
            'user/rest_password',
            'forgot-password',
            'user/logout',
            'user/returnurl',
            'user/resend_otp',
            'user/send_otp',
            'user/verify_otp'

        );

        if (in_array(uri_string(), $exception_uris) == FALSE) {
            if (($this->session->userdata('Userlogin') == NULL)) {
                redirect('user/login');
            } else {

                $this->user_data = $this->UserModel->get_table("*", "cust_id", $this->session->userdata('Userlogin')["id"], "customer");
            }
        }
    }



    public function index() {
		  $this->load->view('index');
		
	}

    public function login() {
		
        if($this->session->userdata('Userlogin') != NULL){
            redirect('user/dashboard');
        }else{
        $RequestMethod = $this->input->server('REQUEST_METHOD');
        if ($RequestMethod == "POST") {						
            $email = $this->security->xss_clean($this->input->post('email'));
            $password = MD5($this->security->xss_clean($this->input->post('password')));
            $userid = $this->UserModel->userlogin($email, $password);
            if ($userid == NULL) {
                $this->session->set_flashdata ( 'alert_register', array ( 'message' => 'User name or Password is wrong',
                    'class' => 'alert-danger'
                ));
                redirect('user/login');
            } else {
                $_SESSION['customer_id'] = $userid['id'];
                $_SESSION['customer_name'] = $userid['name'];
                $this->session->set_userdata('Userlogin', $userid);
                if($this->session->userdata('payment_pending')){
                    redirect('visa/setPaymentDataAfterLogin');
                }
                $this->session->set_flashdata('cusmsg', 'You are Login Successfully ');
                redirect('user/dashboard');
            }
        }
		$data['login_url'] = $this->facebook->login_url();
        $data['google_login_url'] = $this->google->loginURL();
        
        $this->load->view("user/index",$data);
     }
    }

    public function registration() {
        $RequestMethod = $this->input->server('REQUEST_METHOD');		
        if ($RequestMethod == "POST") {
            $this->form_validation->set_rules('first_name', 'First Name', 'required');
            $this->form_validation->set_rules('last_name', 'last Name', 'required');
            $this->form_validation->set_rules('email_address', 'Email Name', 'required');
            $this->form_validation->set_rules('password', 'Pasword Name', 'required');
            $this->form_validation->set_rules('mobile_no', 'Mobile Name', 'required');
            if ($this->form_validation->run() == FALSE) {
                $this->load->view("user/register");
            } else {
                $mail_id = $this->input->post('email_address');
                $valid = $this->UserModel->mailexists_customer($mail_id,$this->dsa_data->dsa_id);  
                if ($valid != true) {
					 $inputCaptcha = $this->input->post('captcha');
                    $sessCaptcha = $this->session->userdata('captchaCode');
                    if($inputCaptcha === $sessCaptcha){
                        $data1 = array(
                            'cust_first_name' => $this->input->post('first_name'),
                            'cust_last_name' => $this->input->post('last_name'),
                            'cust_email' => $this->security->xss_clean($this->input->post('email_address')),
                            'cust_password' => MD5($this->security->xss_clean($this->input->post('password'))),
                            'cust_mobile' => $this->input->post('mobile_no'),
                            'cust_user_id' => $this->dsa_data->dsa_id,
                            'cust_user_type' => 'dsa',
                            'cust_balance' =>100
                        );
                        $userdata = $this->UserModel->register($data1);
                        $this->session->set_flashdata ( 'alert_register', array ( 'message' => 'Your Account Successfully Created','class' => 'alert-success') );
                        $email = $this->security->xss_clean($this->input->post('email_address'));
                        $password = MD5($this->security->xss_clean($this->input->post('password')));
                        $userid = $this->UserModel->userlogin($email, $password);
                        $_SESSION['customer_id'] = $userid['id'];
                        $_SESSION['customer_name'] = $userid['name'];
                        $this->session->set_userdata('Userlogin', $userid);
                        $bp_message = "Dear ".$this->input->post ( "first_name" )." ".$this->input->post ( "last_name" )." <br> We Welcome You Onboard With Smart Trip Maker. Your Login Credentials Are: - Login ID: - ".$this->input->post ( "email_address" )." & Password: - ".$this->input->post ( "password" )." . <br> Thank You For Your Valuable Association! <br> We Look Forward For Eternal Business Relationships With Mutual Benefits And Success! <br>  Smart Trip Maker";
                        // $bp_sms = "Dear ".$this->input->post ( "first_name" )." ".$this->input->post ( "last_name" )." \n We Welcome You Onboard With Smart Trip Maker. Your Login Credentials Are: - Login ID: - ".$this->input->post ( "email_address" )." & Password: - ".$this->input->post ( "password" )." . \n Thank You For Your Valuable Association! \n We Look Forward For Eternal Business Relationships With Mutual Benefits And Success! \n  Smart Trip Maker";					
                        // $number = $this->input->post ( "mobile_no" );
                        // $ch = send_sms ( $number, $bp_sms, "" );
                        $sender_subject = "Customer Credentials";
                        email_send ( $mail_id, $sender_subject, $bp_message );
                        if($this->session->userdata('payment_pending')){
                            redirect('visa/setPaymentDataAfterLogin');
                        }
                        $this->session->set_flashdata('cusmsg', 'You are Login Successfully ');
                        redirect('user/dashboard'); 
                    }else{
                        $this->session->set_flashdata ( 'wrong_cap', 'Captcha code does not match, please try again.' );
                        redirect('user/registration');
                    }
                }else{
                    $this->session->set_flashdata ( 'alert_register', array ('message' => 'Email already registered !','class' => 'alert-danger' ) );
                    redirect('user/login');
                }
            }
        }
		
        $data['login_url'] = $this->facebook->login_url();
        $data['google_login_url'] = $this->google->loginURL();
		
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
		
        $this->load->view("user/register",$data);
    }


    public function dashboard() {
       $userid = $this->session->userdata('Userlogin')["id"];
	   
    	   $userid = $this->session->userdata('Userlogin')["id"];
            $userdata = $this->UserModel->getUserData($userid);
            $data["result"] = $userdata;
			// print_r($userdata);die;
		
        $this->load->view("user/dashboard",$data );
    }


    

    public function flight_booking_spc() {
         $userid = $this->session->userdata('Userlogin')["id"];
          $allflightbookings = $this->UserModel->get_bookingflight_data_off($userid);
          $bookingdata = array();
          $data = array();
         
          if(count($allflightbookings) != "not" ){
          foreach ($allflightbookings as $key => $allflightbookings11){
           
            $data ["FBookingList"] [$key] ["paxlist"] = $this->UserModel->get_pax_detail_off( $allflightbookings11->fbook_id );
            $data ["FBookingList"] [$key] ["booklist"] = $allflightbookings11;
             
          }
          }else{
              $data["FBookingList"] =array();
          }
		  
		  // echo "<pre>";
       // print_r($data);die;
	   
          $this->load->view("user/flight_off_booking",$data);
      }
    

     public function editprofile() {
        
        $RequestMethod = $this->input->server('REQUEST_METHOD');
        if ($RequestMethod == "POST") {
            $id = url_decode($this->input->post('id'));

            $data1 = array(
                'cust_first_name' => $this->input->post('first_name'),
                'cust_last_name' => $this->input->post('last_name'),
                'cust_mobile' => $this->user_data->cust_mobile!=null ? $this->user_data->cust_mobile : $this->input->post('cust_mobile'),
				'cust_address' => $this->input->post('cust_add'),
                'cust_state' => $this->input->post('cust_state'),
				'cust_city' => $this->input->post('cust_city'),
                'cust_pincode' => $this->input->post('cust_pin'),
				'cust_country' => $this->input->post('cust_country'),
				//GST DETAILS
				'cust_gst_name' => $this->input->post('gst_name'),
                'cust_gst_number' => $this->input->post('gst_number'),
				'cust_gst_address' => $this->input->post('gst_address'),
                'cust_gst_mobile' => $this->input->post('gst_mobile'),
				'cust_gst_email' => $this->input->post('gst_email'),
				
                //'cust_pan_number' => $this->user_data->cust_pan_number!=null ? $this->user_data->cust_pan_number : $this->input->post('cust_pan_number'),
            );
        
            $this->UserModel->update_profile($id,$data1);
            $this->session->set_flashdata ( 'edit_profile', array ( 'message' => 'Your Profile Successfully Updated','class' => 'alert-success') );
            redirect('user/editprofile');
        }
        else {
            $userid = $this->session->userdata('Userlogin')["id"];
            $userdata = $this->UserModel->getUserData($userid);
            $data["result"] = $userdata;
            $this->load->view("user/edit_profile", $data);
        }
    }

    public function profile() {
        
            $userid = $this->session->userdata('Userlogin')["id"];
            $userdata = $this->UserModel->getUserData($userid);
            $data["result"] = $userdata;
            $this->load->view("user/profile", $data);
        
    }


    public function upload_profile_pic(){
        $id = url_decode($this->input->post('id'));
        if ($_FILES ['userfile'] ['error'] > 0) {
            $image_name = "";
        } else {
            $image_data1 = $this->UserModel->do_upload ();
            $image_name = $image_data1 ['file_name'];
        }
        $data1 = array(
    
            'cust_profile_pic' =>$image_name
        );
      
        $this->UserModel->update_profile($id,$data1);
        $this->session->set_flashdata ( 'edit_profile', array ( 'message' => 'Your Profile Image Successfully Updated','class' => 'alert-success') );
        redirect('user/editprofile');
    }

    //Google--------------------------------------------------------------------------------------------------------


/*     public function google_login_return() {

        if (isset($_GET['code'])) {
            //authenticate user
            $this->google->getAuthenticate();
            //get user info from google
            $result = $this->google->getUserInfo();
            $fb_data = array(
                "cust_first_name" => $result['given_name'],
                "cust_last_name" => $result['family_name'],
                "cust_email" => $result['email'],
                "cust_status" => $result['verified_email'],
                "cust_social_id" => $result['id'],
                "cust_social_profile_image" => $result['picture'],
                "cust_login_by" => "gmail",
                "cust_password" => $result['id'],
                "cust_user_type" => "dsa",
                "cust_user_id" => $this->dsa_data->dsa_id,
                   
            );
            $result1 = $this->UserModel->check_fb_id($result['email']);
            if ($result1 == false) {
                $this->UserModel->fb_data_entry($fb_data);
            }
            $userid = $this->UserModel->userlogin_face($result['email']);
            if ($userid == NULL) {
                redirect(); 
            } else {
                $this->session->set_userdata('Userlogin', $userid);
                redirect('user/dashboard');
            }
        }
    } */
	
	
	public function google_login_return(){
        // Redirect to profile page if the user already logged in
        if($this->session->userdata('Userlogin') == true){
           redirect('user/dashboard');
        }
        
        if(isset($_GET['code'])){
            
            // Authenticate user with google
            if($this->google->getAuthenticate()){
            
                // Get user info from google
                $gpInfo = $this->google->getUserInfo();
                
                // Preparing data for database insertion
				$fb_data = array(
                "cust_social_id"             => $gpInfo['id'],
                "cust_first_name"     		 => $gpInfo['given_name'],
                "cust_last_name"         	 => $gpInfo['family_name'],
                "cust_email"                 => $gpInfo['email'],
                "cust_gender"                => !empty($gpInfo['gender'])?$gpInfo['gender']:'',
                "cust_social_profile_url"    => !empty($gpInfo['link'])?$gpInfo['link']:'',
                "cust_social_profile_image"  => !empty($gpInfo['picture'])?$gpInfo['picture']:'',
				"cust_login_by"              => "google",
				"cust_password"              => $gpInfo['id'],
				"cust_user_type"             => "dsa",
                "cust_user_id"               => $this->dsa_data->dsa_id,
				);
			
                
                // Insert or update user data to the database
                $userID = $this->UserModel->checkUser($fb_data);
               
				
				$user_det = $this->UserModel->userlogin_by_id($userID);
                $user_det['cust_balance'] = 100;
				$_SESSION['customer_id'] = $userID;
                $_SESSION['customer_name'] = $user_det['name'];
                $this->session->set_userdata('Userlogin', $user_det);
                // Store the status and user profile info into session
                $this->session->set_flashdata('cusmsg', 'You are Login Successfully ');
                redirect('user/dashboard');
                
            }
        } 
        
        // Google authentication url
        $data['loginURL'] = $this->google->loginURL();
        
        // Load google login view
        $this->load->view('user_authentication/index',$data);
    }

  /*   public function returnurl() {
        if ($this->facebook->is_authenticated()) {
            $userProfile = $this->facebook->request('get', '/me?fields=id,first_name,last_name,email,gender,locale,picture');
            if(isset($userProfile['gender'])){
                $gender = $userProfile['gender'];
            }else{
                $gender = " ";
            }
            $fb_data = array(
                "cust_first_name" => $userProfile['first_name'],
                "cust_last_name" => $userProfile['last_name'],
                "cust_email" => $userProfile['email'],
                "cust_status" => "active",
                "cust_social_id" => $userProfile['id'],
                "cust_social_profile_image" => $userProfile['picture']['data']['url'],
                "cust_social_profile_url" => "https://www.facebook.com/" . $userProfile['id'],
                "cust_gender" => $gender,
                "cust_login_by" => "Facebook",
                "cust_password" => $userProfile['id'],
                "cust_user_type" => "dsa",
                "cust_user_id" => $this->dsa_data->dsa_id,
            );
            $result1 = $this->UserModel->check_fb_id($userProfile['email']);
            if ($result1 == false) {
                $this->UserModel->fb_data_entry($fb_data);
            }
            $userid = $this->UserModel->userlogin_face($userProfile['email']);
            if ($userid == NULL) {
                redirect(); 
            } else {
                $this->session->set_userdata('Userlogin', $userid);
                redirect('user/dashboard');
            }
        }
    } */
	
	public function returnurl(){
        $userData = array();
        
        // Check if user is logged in

        if($this->facebook->is_authenticated()){
            // Get user facebook profile details
            $fbUserProfile = $this->facebook->request('get', '/me?fields=id,first_name,last_name,email,link,gender,locale,cover,picture');
              // print_r($fbUserProfile); exit;
            // Preparing data for database insertion
            $fb_data = array(
                "cust_first_name" 	=> $fbUserProfile['first_name'],
                "cust_last_name" 	=> $fbUserProfile['last_name'],
                "cust_email" 		=> isset($fbUserProfile['email']) ? $fbUserProfile['email'] : "",
                "cust_status" 		=> "active",
                "cust_social_id" 	=> $fbUserProfile['id'],
                "cust_social_profile_image" => $fbUserProfile['picture']['data']['url'],
                "cust_social_profile_url" 	=> isset($fbUserProfile['link']) ? $fbUserProfile['link'] : "",
                "cust_gender" 		=> isset($fbUserProfile['gender']) ? $fbUserProfile['gender'] : "",
                "cust_login_by" 	=> "facebook",
                "cust_password" 	=> $fbUserProfile['id'],
                "cust_user_type" 	=> "dsa",
                "cust_user_id" 		=> $this->dsa_data->dsa_id,
            );
            // Insert or update user data
            $userID = $this->UserModel->checkUser_fb($fb_data);
           // print_r($userID); exit;
            // Check user data insert or update status
			
			$user_det = $this->UserModel->userlogin_by_id($userID);
			$_SESSION['customer_id'] = $userID;
            $_SESSION['customer_name'] = $user_det['name'];
			$_SESSION['fb_logout_url'] = $this->facebook->logout_url();
            $this->session->set_userdata('Userlogin', $user_det);
                // Store the status and user profile info into session

            $this->session->set_flashdata('cusmsg', 'You are Login Successfully ');
            redirect('user/dashboard');
			
        } else {
            // Get login URL
             redirect(site_url());
        }
        
       
    }

    public function logout() {
        $this->session->unset_userdata('Userlogin');
		$this->session->unset_userdata('fb_logout_url');
        redirect('user/login');
    }

    public function rest_password($token=null){
        $RequestMethod = $this->input->server('REQUEST_METHOD');
        if ($RequestMethod == "POST") {
                $new_password = md5($this->input->post("password_confirmation"));
                $token        = $this->input->post("token");
                $this->UserModel->update_password($token,$new_password,$this->dsa_data->dsa_id);
                $this->UserModel->remove_token($token,$this->dsa_data->dsa_id);
                $this->session->set_flashdata ( 'alert_register', array (
                    'message' => 'Password has been reset Please Login!',
                    'class' => 'alert-success'
                  ) );
                redirect('user/login');
        }
        else{
          $token=$this->input->get($token);
          $valid =  $this->UserModel->token_exists_customer($token['token'],$this->dsa_data->dsa_id);
          if ($valid == true) {
              $data['token'] =$token;
              $this->load->view('reset_password',$data);
          }
          else{
            $this->session->set_flashdata ( 'alert_register', array (
                'message' => 'Invalid token !',
                'class' => 'alert-danger'
              ) );
            redirect('user/login');
          }
        }
    }


    public function forgotpassword() {
        $RequestMethod = $this->input->server('REQUEST_METHOD');
        if ($RequestMethod == "POST") {
            $mail_id = $this->input->post('email');
            $data1 = $this->UserModel->mailexists_customer($mail_id,$this->dsa_data->dsa_id);
            if ($data1 == true) {

                $token = md5(uniqid(rand(), true));
                $this->UserModel->insert_token($mail_id,$token,$this->dsa_data->dsa_id);

                // $dsaemailsetting = $this->UserModel->get_mailsetting($this->dsa_data->dsa_id);
                // if ($dsaemailsetting != "not") {
                    // $emailconfig = array(
                        // "smtp_host" => $dsaemailsetting->email_smtp_host,
                        // "smtp_port" => $dsaemailsetting->email_smtp_port,
                        // "smtp_username" => $dsaemailsetting->email_smtp_user,
                        // "smtp_password" => $dsaemailsetting->email_smtp_password,
                        // "smtp_frommail" => $dsaemailsetting->email_from,
                        // "smtp_name" => $dsaemailsetting->email_name
                    // );
                // }
                $this->db->where('cust_email', $mail_id);
                $this->db->from('customer');
                $result = $this->db->get()->result();
                foreach ($result as $r) {
                    $toemail = $r->cust_email;
                    $password = $r->cust_password;
                    $data["first_name"] = $r->cust_first_name;
                }

                $reciement_email = $mail_id;
                $sender_subject = "Forgot Password";

                $data["subject"] = 'Customer Forgot Password details for'.$this->dsa_data->dsa_company_name;
                $data["url"] = site_url();
                $data["shop_name"] = $this->dsa_data->dsa_company_name;
                $data["shop_url"] = site_url();
                $data["shop_logo"] = $this->dsa_data->dsa_admin_url."assets/img/logos/".$this->dsa_data->dsa_logo;
                $data["sender_email"] = $toemail;
                $data["username"] = $toemail;
                $data["rest_link"] = site_url()."user/rest_password?token=".$token;
                $data["sender_name"]= $this->dsa_data->dsa_company_name;

                $message = $this->load->view('email_forgot',$data,TRUE); 
                email_send($mail_id, $sender_subject, $message,$emailconfig);

                $this->session->set_flashdata ( 'alert_register', array ( 'message' => 'Email has been to your Email ',
                    'class' => 'alert-success'
                ) );
                redirect('user/login');
               
            }
            else {
                    $this->session->set_flashdata ( 'alert_register', array ( 'message' => 'invalid Email ID ! ',
                    'class' => 'alert-danger'
                    ) );
                    redirect('user/login');
                }
            } else {
                $this->load->view('forgot_password');
            }
    }

    
	public function print_ticket_admin() {
		$refId = url_decode ( $_GET ['ref_id'] );
		$SelectedFare['bp_hotel_detailq'] = $this->UserModel->get_search_detail ( $refId);
		$SelectedFare['temp_data'] = $this->UserModel->get_hotel_temp_data( $refId);
		$SelectedFare['bp_passenger_detail'] = $this->UserModel->get_search_detail_passenger( $refId);
	
		// echo "<pre>";
		// print_r($SelectedFare);die;
	

		$this->load->view ( 'user/ticket/booking_print', $SelectedFare );
	}
	
	public function make_payment()
	{
		$bp_user_id = $this->dsa_data->dsa_id;
		$getwayList = $this->Common_Model->get_table_row("*", array(
			"dsapayg_user_type" => "DSA",
			"dsapayg_user_id" => $bp_user_id,
			"dsapayg_status" => "active",
			"dsapayg_b2b_b2c" => "B2c",
			"dsapayg_gateway_name" => "cc_avenue"
				), "dsa_payment_gateway");
			
		$data ['getwayList'] = $getwayList;
		$this->load->view("user/make_payment",$data);
	}
	
	
	public function deposite_payment_request1() {
		$RequestMethod = $this->input->server ( 'REQUEST_METHOD' );
		if ($RequestMethod == "POST") {
			// print_r($data);die;
			
			$data ['gateway_data'] ["bookingId"] = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
			$data1 ['booking_id'] = $data ['gateway_data'] ["bookingId"];
			$data ['gateway_data']["api_key"] = "640fea01-9448-4b2e-a627-cda3ac670355";
			$data ['gateway_data']["salt"] = "8fe9fafe729137c5f240e2e7455518addc01a1d4";
			$data ['gateway_data'] ['return_url'] = site_url () . "user/payment_response/";
			$data ['gateway_data'] ['mode'] = "TEST";
			$data ['gateway_data'] ["order_id"] = $data ['gateway_data'] ["bookingId"];
			$totalFare = str_replace ( ",", "", (float)$_POST['amount'] );
			$data ['gateway_data'] ['amount'] = $totalFare;
			$data ['gateway_data'] ['currency'] = "INR";
			$data ['gateway_data'] ['description'] = "Online Make Payment,Reference ID - " . $data ['gateway_data'] ["bookingId"];
			$data ['gateway_data'] ['name'] = $_POST['firstname'];;
			$data ['gateway_data'] ['phone'] = $_POST['phone'];
			$data ['gateway_data'] ['email'] = $_POST['email'];
			$data ['gateway_data'] ['address_line_1'] = $_POST['address1'];
			$data ['gateway_data'] ['address_line_2'] = $_POST['address1'];
			$data ['gateway_data'] ['city'] = $_POST['city'];
			$data ['gateway_data'] ['state'] = $_POST['state'];
			$data ['gateway_data'] ['country'] = "IND";
			$data ['gateway_data'] ['zip_code'] = $_POST['zipcode'];
			$data ['gateway_data'] ['srdv_payment_mode'] = $_POST['payment_mode'];
			$_SESSION ['srdv'] ['wallet_recharge_amount']=$_POST['amount1'];
			$data ['gateway_data'] ['udf1'] = $_POST['amount1'];
			$data ['gateway_data'] ['udf2'] = "";
			$data ['gateway_data'] ['udf3'] = "";
			$data ['gateway_data'] ['udf4'] = "";
			$data ['gateway_data'] ['udf5'] = "";
			$data ['gateway_data'] ['timeout_duration'] = 60;	
			$payment_det = array (
					'order_id' => $data ['gateway_data'] ["bookingId"],
					'op_before_payment' => serialize($data),
			);
			$this->Common_Model->insert_table ( "online_payment", $payment_det );			
			$this->load->view ( 'user/payment_loading', $data );
		} else {
			redirect('user/make_payment');
		}
	}
	
	
	
	
	
	public function deposite_payment_request() { 
		$bp_user_id = $this->dsa_data->dsa_id;
		$getwayList = $this->Common_Model->get_table_row("*", array(
			"dsapayg_user_type" => "DSA",
			"dsapayg_user_id" => $bp_user_id,
			"dsapayg_status" => "active",
			"dsapayg_b2b_b2c" => "B2c",
			"dsapayg_gateway_name" => "cc_avenue"
				), "dsa_payment_gateway");

		//new ccu
		$data['ccavenueConfig'] = $this->Common_Model->get_ccavenue_data("ccavenue_config",'1');
		// $data ['gateway_data'] ["bookingId"] = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
		 $data ['gateway_data'] ["bookingId"] = $this->session->userdata('Userlogin')["id"];
		// $RefId = $data ['gateway_data'] ["bookingId"];	
		//$data1 ['booking_id'] = $data ['gateway_data'] ["bookingId"];	
		$data ['gateway_data'] ['redirect_url'] = site_url () . "user/payment_result";
		$data ['gateway_data'] ['cancel_url'] = site_url () . "user/payment_result";
		// $data ['gateway_data'] ['merchant_id'] = $getwayList->dsapayg_gateway_user_id;
		$data ['gateway_data'] ['merchant_id'] = $data['ccavenueConfig']->merchant_id;
		$data ['gateway_data'] ["order_id"] = $data ['gateway_data'] ["bookingId"];
		//$data ['gateway_data'] ["order_id"] = $this->session->userdata('Userlogin')["id"];
		$totalFare = str_replace ( ",", "", (float)$_POST['amount'] );	
		
        $_SESSION['addWalletAmount'] = $_REQUEST['amount1'];
        
		
		
		$data ['gateway_data'] ['amount'] = round($totalFare);
		$data ['gateway_data'] ['currency'] = "INR";
		$data ['gateway_data'] ['tid'] = "";
		$data ['gateway_data'] ['billing_tel'] = "";
		$data ['gateway_data'] ['billing_email'] = "";
		$data ['gateway_data'] ['billing_address'] = "";
		$data ['gateway_data'] ['billing_city'] = "";
		$data ['gateway_data'] ['billing_state'] = "";
		$data ['gateway_data'] ['billing_zip'] = "";
		$data ['gateway_data']['merchant_param1'] = $this->session->userdata('Userlogin')["id"];
		$data ['gateway_data']['promo_code']="";
		$data ['gateway_data']['customer_identifier']="";
		$data ['gateway_data']['billing_name']="";
        		
		
		$this->load->view ( 'user/payment_cc_avenue', $data);
		//end ccu
		
	}
	
	
	public function payment_result() {
       $ccavenueConfig = $this->Common_Model->get_ccavenue_data("ccavenue_config",'1');
	   $user_balance = $this->user_data->cust_balance;
	   $new_balance = 0;
	   $BookingId = $_SESSION ['booking_id'];
       $workingKey=$ccavenueConfig->working_key;		//Working Key should be provided here.
	   $encResponse=$_POST["encResp"];			//This is the response sent by the CCAvenue Server
	   $rcvdString=cc_decrypt($encResponse,$workingKey);		//Crypto Decryption used as per the specified working key.
       $order_status="";
	   $decryptValues=explode('&', $rcvdString);
	   $dataSize=sizeof($decryptValues);
       for($i = 0; $i < $dataSize; $i++) {
			$information=explode('=',$decryptValues[$i]);
			if($i==3)	$order_status=$information[1];
		}


		$status = $order_status;
          
                if ($status == "Success") {
			//$amt = $_SESSION ['srdv'] ['wallet_recharge_amount'];	
            $amt = $_SESSION['addWalletAmount'];

                      
			$new_balance = $amt+$user_balance;	
			
			$BookingId = $this->input->post ( "udf1" );
		} 
		else {
			$status = "Failed";
		}
		$balance_data = array (
			"balance_log_user_id" => $_SESSION['customer_id'],
						"balance_log_user_name" => $this->user_data->cust_email,
						"balance_log_user_type" => "customer",
						"balance_log_detail" => "Upload Payment",
						"balance_log_credit" => $new_balance,
						"balance_log_balance" => $user_balance,
						"balance_log_update_by" => "customer" 
		);
		// $this->Hotel_Model->update_booking ( $data, $BookingId );
			$this->Common_Model->insert_table ( "balance_log", $balance_data );


	   		
		if ($status == "Success") {
			$data1 = array (
						"cust_balance" => $new_balance 
				);
				$re = $this->UserModel->update_customer_date ( $data1, $this->user_data->cust_id );
				$this->session->set_flashdata ( "bal_alert", array (
						"message" => "Walled Amount Updated",
						"class" => "alert-success" 
				) );
                
				redirect("user/make_payment");
		}
		else {
					echo "There is some problem in booking. Please contact Super Admin";
			}
			 unset($_SESSION['addWalletAmount']);
			redirect ( 'user/payment_error');
	}
	
	
	
	function payment_response() {
		
	  
		$user_balance = $this->user_data->cust_balance;
		
		$status="Pending";
		if(isset($_POST['response_code'])){
		
			if($_POST['response_code']=="0")
			{
                $status="success";
				$amt = $_SESSION ['srdv'] ['wallet_recharge_amount'];	
				$new_balance = $amt+$user_balance;	
				$balance_data = array (
						"balance_log_user_id" => $_SESSION['customer_id'],
						"balance_log_user_name" => $this->user_data->cust_email,
						"balance_log_user_type" => "customer",
						"balance_log_detail" => "Upload Payment",
						"balance_log_credit" => $new_balance,
						"balance_log_balance" => $user_balance,
						"balance_log_update_by" => "customer" 
				);
				$this->Common_Model->insert_table ( "balance_log", $balance_data );
				$data1 = array (
						"cust_balance" => $new_balance 
				);
				$re = $this->UserModel->update_customer_date ( $data1, $this->user_data->cust_id );
				//print_r($re); exit;
				$this->session->set_flashdata ( "bal_alert", array (
						"message" => "Customer balance successfully Updated",
						"class" => "alert-success" 
				) );
				redirect("user/make_payment");
			} else {
				$this->session->set_flashdata ( "bal_alert", array (
					"message" => "Payment Unsuccessful",
					"class" => "alert-danger" 
				) );
				redirect("user/make_payment");
			}
			
		} else {
			$this->session->set_flashdata ( "bal_alert", array (
				"message" => "Payment Unsuccessful",
				"class" => "alert-danger" 
		    ) );
			redirect("user/make_payment");
		}
	}
	
	public function transaction_log() {
        $da = explode("&per_page", $_SERVER["QUERY_STRING"]);
		$bp_user_type = "customer";
		$bp_user_id = $this->user_data->cust_id;
		$table = "balance_log";
        $where_1_value = $bp_user_type;
		$where_2_value = $bp_user_id;
		$order_by = "balance_log_id";
		$bp_template_name = "transaction_log";
		if ($this->input->get("per_page")) {
			$page = $this->input->get("per_page");
		} else {
			$page = 0;
		}
		$where = array("balance_log_user_type" => $where_1_value,"balance_log_user_id" => $bp_user_id);
		if($this->input->get("statement_type") == "min"){
				$where["MONTH(balance_log_entry_date)"] = date('m');
		}
		if($this->input->get("statement_type") == "year"){
			if($this->input->get("state_month")!= NULL && !empty($this->input->get("state_month"))){
				$where["MONTH(balance_log_entry_date)"] = $this->input->get("state_month");
				$where["YEAR(balance_log_entry_date)"] = $this->input->get("state_year");
			}else{
				$where["YEAR(balance_log_entry_date)"] = $this->input->get("state_year"); 
			}
		}
		if($this->input->get("statement_type") == "custom"){
				
			$where["DATE(balance_log_entry_date)>="] = date_format(date_create($this->input->get("st_fromdate")),"y-m-d");
			$where["DATE(balance_log_entry_date)<="] = date_format(date_create($this->input->get("st_todate")),"y-m-d");
		}      
		$this->db->where ( $where );
		
		$total_row = $this->db->from ( $table )->count_all_results ();
		$pagination_segment = 3;
		$per_page = 10;
		$pagination_url = base_url () . $this->uri->segment ( "1" ) . "/" . $this->uri->segment ( "2" )."?".$da[0];
		$config = bp_pagination ( $pagination_url, 0, $total_row, $per_page );
                $config['page_query_string'] = TRUE;
		$this->pagination->initialize ( $config );
		$result = $this->Common_Model->pagination_nk ( $config ["per_page"], $page, $where, $order_by, $table );
		$data ['result'] = $result;
		// echo "<pre>";
		// print_r($result);die;
		$this->load->view ( $this->uri->segment ( "1" ) . "/" . $bp_template_name,$data);
	}

   
   
    
	
	
/* 	public function test()
	{
		$number = "7011070464";
		$userid['name'] = "vishank tyagi";
		$mail_id = "vishank@gmail.com";
		$password = "70110704546";
		$bp_sms = "Dear ".$userid['name']."  \n We Welcome You Onboard With SOLOGO. Your Login Credentials Are: - Login ID: - ".$mail_id." & Password: - ".$password." . \n Thank You For Your Valuable Association! \n We Look Forward For Eternal Business Relationships With Mutual Benefits And Success! \n  SOLOGO";
		$ch = send_sms ( $number, $bp_sms, "" );
		echo $bp_sms;
	}  */
	
	public function hotel_booking() {
          $userid = $this->session->userdata('Userlogin')["id"];
		  //print_r($userid);die;
          $allholtelbookings = $this->UserModel->get_hotel_booking($userid);
          $bookingdata = array();
          $data = array();

          if(is_array($allholtelbookings) && count($allholtelbookings)){
          foreach ($allholtelbookings as $key => $allholtelbookings11){
             $data["HBookingList"][$key]["paxlist"] = $this->UserModel->get_hotel_pax_detail($allholtelbookings11->hotboli_id); 
             $data["HBookingList"][$key]["booklist"] = $allholtelbookings11;
             $data["HBookingList"][$key]["tempdata"] = $this->UserModel->get_hotel_temp_data($allholtelbookings11->hotboli_id);
          }
          }else{
              $data["HBookingList"] =array();
          }
          $this->load->view("user/hotel_booking",$data);
    }

    public function holiday_booking() {
        $userid = $this->session->userdata('Userlogin')["id"];			
        $result = $this->UserModel->holiday_list($userid);
        $data ['result'] = $result;
        //PrintArray($result);die;
        $this->load->view("user/holiday_booking",$data);
    }

    public function visa_apply(){
        $userid = $this->session->userdata('Userlogin')["id"];          
        $result = $this->UserModel->holiday_list($userid);
        $data['nationality'] = $this->Common_Model->get_full_table("nationality");
        $data ['result'] = $result;
        $this->load->view("user/visa_apply",$data);   
    }

    public function visa_booking() {
        $userid = $this->session->userdata('Userlogin')["id"];			
        $result = $this->UserModel->visa_list($userid);
        $data ['result'] = $result;
        $data['visa_type'] = $this->UserModel->visa_type(); 
        //PrintArray($result);die;
        $this->load->view("user/visa_booking",$data);
    }


}

