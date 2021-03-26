<?php 

class Dsa extends MX_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->Model('DsaModel');
	}
  public function index() {
		if (($this->session->userdata ( 'Dsalogin' ) == NULL)) {
			$this->load->view("dsa/login");
		}else{
			redirect("dashboard");
		}
	}
	
	public function super_admin_login(){
		$id = $this->security->xss_clean ( $this->input->get ( 'ref' ) );
		$password = $this->security->xss_clean ( $this->input->get ( 'key' ) );
		$result = $this->DsaModel->super_admin_login($id, $password);
		if($result!="not"){
			$this->session->set_userdata ( 'Dsalogin', $result );
			$this->session->set_flashdata ( 'alert', array (
					'message' => 'you have successfully logged in',
					'class' => 'alert-success'
			) );
			redirect ( 'dashboard' );
		}else{
			echo "Directory access is forbidden.";
		}
	}
	public function dsa_login(){
		if ($this->input->post ( 'username' ) == "" or $this->input->post ( 'password' ) == "") {
			
			
			$this->session->set_flashdata ( 'alert', array (
					'message' => 'Please Enter valid login details',
					'class' => 'alert-danger'
			) );
			redirect ("dsa");
		} else {
			$email = $this->security->xss_clean ( $this->input->post ( 'username' ) );
			$password = MD5 ( $this->security->xss_clean ( $this->input->post ( 'password' ) ) );
                        //print_r($this->input->post ( 'user_type' ));
                        //die;
                        if($this->input->post ( 'user_type' ) == "admin"){
                        
			  $result = $this->DsaModel->login ( $email, $password );
                          	
                          if ($result) {
				if ($result->dsa_status == "active") {
					$this->session->set_userdata ( 'Dsalogin', $result );
					$this->session->set_flashdata ( 'alert', array (
							'message' => 'you have successfully logged in',
							'class' => 'alert-success'
					) );
					$this->DsaModel->update_last_login ();
					$this->DsaModel->update_last_ip ();
					$this->insert_login_log("By username and password");
					if ($this->input->post ( 'remember' ) == "save") {
						$bp_data ['email'] = $email;
						$bp_data ['password'] = $password;
						$bp = serialize ( $bp_data );
						$bp_cookie_name = site_url () . "email_password";
						setcookie ( $bp_cookie_name, $bp, time () + (86400 * 30), "/" );
					}
					redirect ( 'dashboard' );
				} else {
					$this->session->set_flashdata ( 'alert', array (
							'message' => 'your account is in inactive mode.Contact administrator',
							'class' => 'alert-warning'
					) );
					redirect ("dsa");
				}
			} else {
				$this->session->set_flashdata ( 'alert', array (
						'message' => 'Please Enter Valid Email and Password',
						'class' => 'alert-danger'
				) );
				redirect ("dsa");
			}
                        
                        }else{
                            
                           $resultstaff = $this->DsaModel->staff_login ( $email, $password ); 
                           
                           if($resultstaff){
                           
                           if($resultstaff->dsast_status == "active") { 
                               
                               $this->session->set_userdata ( 'DsaStafflogin', $resultstaff );
                               $result = $this->DsaModel->dsa_data_by_id($resultstaff->dsast_user_id);
                            if ($result) {
				if ($result->dsa_status == "active") {
					$this->session->set_userdata ( 'Dsalogin', $result );
					$this->session->set_flashdata ( 'alert', array (
							'message' => 'you have successfully logged in',
							'class' => 'alert-success'
					) );
					$this->DsaModel->update_last_login ();
					$this->DsaModel->update_last_ip ();
					$this->insert_login_log("By username and password");
					if ($this->input->post ( 'remember' ) == "save") {
						$bp_data ['email'] = $email;
						$bp_data ['password'] = $password;
						$bp = serialize ( $bp_data );
						$bp_cookie_name = site_url () . "email_password";
						setcookie ( $bp_cookie_name, $bp, time () + (86400 * 30), "/" );
					}
					redirect ( 'dashboard' );
				} else {
					$this->session->set_flashdata ( 'alert', array (
							'message' => 'your account is in inactive mode.Contact administrator',
							'class' => 'alert-warning'
					) );
					redirect ("dsa");
				}
                           } 
                           }
                           else{
                              $this->session->set_flashdata ( 'alert', array (
							'message' => 'your account is in inactive mode.Contact administrator',
							'class' => 'alert-warning'
				) );
					redirect ("dsa"); 
                           }
                                }  else {
				$this->session->set_flashdata ( 'alert', array (
						'message' => 'Please Enter Valid Email and Password',
						'class' => 'alert-danger'
				) );
				redirect ("dsa");
			}
                        }
		
		}
	}
	public function logout() {
	$this->session->unset_userdata ( 'Dsalogin' );
        if($this->session->userdata("DsaStafflogin") != NULL){
          
            $this->session->unset_userdata ( 'DsaStafflogin' );
        }
	$bp_cookie_name = site_url () . "email_password";
	setcookie ( $bp_cookie_name, "", time () - (86400 * 30), "/" );
	$this->session->set_flashdata ( 'alert', array (
			'message' => 'You have successfully logged out',
			'class' => 'alert-warning'
	) );
	redirect ( 'dsa', 'refresh' );
	}
	public function forgot_password(){
		if (($this->session->userdata ( 'adminDetail' ) == NULL)) {
			if(isset($_SESSION['bp_not_unset'])){
				unset($_SESSION['bp_not_unset']);
			}else{
				unset($_SESSION['forgot_password']);
				unset($_SESSION['bp_not_unset']);
			}
			$this->load->view("login/forgot_password");
		}else{
			unset($_SESSION['forgot_password']);
			redirect("dashboard");
		}
	}
	public function otp(){
		if(isset($_POST['login_by_otp'])){
			$this->login_otp($_POST['mobile']);
			$_SESSION['bp_not_unset']="1";
			redirect("forgot-password");
		}else if($this->input->post("login_by_otp_verify_otp")=="1"){
			if($this->input->post("otp")==$_SESSION['forgot_password']['otp']){
				$email = $_SESSION['forgot_password']['user_data']->ad_email;
				$password = $_SESSION['forgot_password']['user_data']->ad_password;
				$result = $this->Login_model->login ( $email, $password );
				if ($result) {
					if ($result->ad_status == "active") {
						$this->session->set_userdata ( 'adminDetail', $result );
						$this->session->set_flashdata ( 'alert', array (
								'message' => 'you have successfully logged in',
								'class' => 'alert-success'
						) );
						$this->Login_model->update_last_login ();
						$this->Login_model->update_last_ip ();
						$this->insert_login_log("By OTP");
						unset($_SESSION['forgot_password']);
						unset($_SESSION['bp_not_unset']);
						redirect ( 'dashboard' );
					} else {
						$this->session->set_flashdata ( 'alert', array (
								'message' => 'your account is in inactive mode.Contact administrator',
								'class' => 'alert-warning'
						) );
						unset($_SESSION['forgot_password']);
						unset($_SESSION['bp_not_unset']);
						redirect ("login");
					}
				} else {
					$this->session->set_flashdata ( 'alert', array (
							'message' => 'Wrong OTP , Please try again',
							'class' => 'alert-danger'
					) );
					unset($_SESSION['forgot_password']);
					unset($_SESSION['bp_not_unset']);
					redirect ("login");
				}
			}else{
				$_SESSION['forgot_password']['msg']="Invalid one time passcode. Please enter a valid otp.";
				$_SESSION['forgot_password']['msg_class']="alert-danger";
				$_SESSION['forgot_password']['active']="lbo";
				$_SESSION['forgot_password']['response']="not";
				$_SESSION['bp_not_unset']="1";
				redirect("forgot-password");
			}
		}else{
			redirect("login");
		}
	}
	private function login_otp(){
		$number= $this->input->post("mobile");
		if($number==""){
			$_SESSION['forgot_password']['msg']="mobile number not valid.";
			$_SESSION['forgot_password']['msg_class']="alert-danger";
			$_SESSION['forgot_password']['active']="lbo";
			$_SESSION['forgot_password']['response']="not";
		}
		$bp_fetch_data=$this->Login_model->fetch_admin_data_by_number($number);
		if($bp_fetch_data!="not"){
			$_SESSION['forgot_password']['msg']="Verification code successfully sent on your registered mobile";
			$_SESSION['forgot_password']['msg_class']="alert-success";
			$_SESSION['forgot_password']['active']="lbo";
			$_SESSION['forgot_password']['otp']=six_digit_rendom_number();
			$_SESSION['forgot_password']['user_data']=$bp_fetch_data;
			$number=$number;
			$message=$_SESSION['forgot_password']['otp']." is you verification code for login.";
			$bp_sms_result=send_sms($number, $message, $this->bp_sms_sender_id);
			if(is_numeric($bp_sms_result->msg_id['0'])){
				$bp_messahe_id=$bp_sms_result->msg_id['0'];
				$bp_msg_status="SUBMITTED";
				$bp_msg_remark="";
			}else{
				$bp_messahe_id="";
				$bp_msg_status="fail";
				$bp_msg_remark=$bp_sms_result->msg_id['0'];
			}
			$data = array (
					"sms_log_mobile_number" => $number,
					"sms_log_message" => $message,
					"sms_log_sender_id" => $this->bp_sms_sender_id,
					"sms_log_status" => $bp_msg_status,
					"sms_log_send_by" => "Login By OTP ___".$bp_fetch_data->dsa_id,
					"sms_log_message_id" => $bp_messahe_id,
					"sms_log_remark" => $bp_msg_remark,
			);
			$this->Login_model->insert_sms_log( $data );
			$_SESSION['forgot_password']['response']="success";
		}else{
			$_SESSION['forgot_password']['msg']="Mobile number doesn't exist.";
			$_SESSION['forgot_password']['msg_class']="alert-danger";
			$_SESSION['forgot_password']['active']="lbo";
			$_SESSION['forgot_password']['response']="not";
		}
	}
	public function insert_login_log($logintype){
		$data=array(
				"login_log_login_type"=>$logintype,
				"login_log_user_type"=>"dsa",
				"login_log_user_id"=>$this->session->userdata['Dsalogin']->dsa_id,
				"login_log_user_name"=>$this->session->userdata['Dsalogin']->dsa_email,
				"login_log_ip"=>$this->input->ip_address(),
				"login_log_user_browser"=>$_SERVER['HTTP_USER_AGENT'],
				"login_log_server_name"=>site_url()
		);
		$this->DsaModel->insert_login_log( $data );
	}
	function login_otp_verify($number=NULL){
		echo $number;
	}
	
	function changePassword(){
		 $activedata = array(
            "activemain" => $this->uri->segment("1"),
            "displayblock" => $this->uri->segment("1"),
            "activeclass" => $this->uri->segment("1")
        );
        $data["activedata"] = $activedata;
		if ($this->input->server('REQUEST_METHOD') == 'POST'){
			
			
			if ($this->input->post("old_password") == "" || $this->input->post("new_password")=="" || $this->input->post("conf_new_password")=="") {
				
				$this->session->set_flashdata ( 'alert', array (
						'message' => 'Please Enter valid password !',
						'class' => 'alert-danger'
				) );
				redirect ("dsa/changePassword");
			}
			
			if ( $this->input->post("new_password") != $this->input->post("conf_new_password")) {
			
				$this->session->set_flashdata ( 'alert', array (
						'message' => 'Password and confirm password not match !',
						'class' => 'alert-danger'
				) );
				redirect ("dsa/changePassword");
			}
			
			
			$oldpass = $this->DsaModel->checkPassword ($this->session->userdata['Dsalogin']->dsa_id );
			
			
			
			if (md5($this->input->post("old_password")) == $oldpass ) {
				
				$uppass = $this->DsaModel->update_password(md5($this->input->post("new_password")));
			
		   if ($uppass) {
				
				$this->session->set_flashdata ( 'alert', array (
					'message' => 'Password change Successfully',
					'class' => 'alert-info'
			) );
			redirect ("dsa/changePassword");
			}
			
			}else{
				
				$this->session->set_flashdata ( 'alert', array (
						'message' => 'Wrong ! please enter correct password.',
						'class' => 'alert-danger'
				) );
				redirect ("dsa/changePassword");
			}
			
			
		}
		
		$this->load->view("dsa/changePassword",$data);
	}
 }

