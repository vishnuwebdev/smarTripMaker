<?php
class Email extends MX_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->helper ( "email/email" );
		$this->load->model ( array (
				'Email_Model' 
		) );
	}
	public function index() {
			$activedata = array (
				"activemain" => $this->uri->segment ( "1" ),
				"displayblock" => $this->uri->segment ( "1" ),
				"activeclass" => $this->uri->segment ( "1" )
		);
		
		$data ["activedata"] = $activedata;
		$bp_user_id = $this->dsa_data->dsa_id;
		$table = "email_log";
		$where_1_name = "email_log_dsa_id";
		$where_1_value = 5;
		$where_2_name = "email_log_dsa_id";
		$where_2_value = 5;
		$order_by = "email_log_id";
		$bp_template_name = "email_report";
		if ($this->uri->segment ( 3 )) {
			$page = $this->uri->segment ( 3 );
		} else {
			$page = 0;
		}
		$this->db->where ( $where_1_name, $where_1_value );
		$this->db->where ( $where_2_name, $where_2_value );
		$total_row = $this->db->from ( $table )->count_all_results ();
		$pagination_segment = 3;
		$per_page = 20;
		$pagination_url = base_url () . $this->uri->segment ( "1" ) . "/" . $this->uri->segment ( "2" );
		$config = bp_pagination ( $pagination_url, 0, $total_row, $per_page );
		$this->pagination->initialize ( $config );
		$result = $this->Common_Model->pagination_table ( $config ["per_page"], $page, $where_1_name, $where_1_value, $where_2_name, $where_2_value, $order_by, $table );
		$data ['result'] = $result;
		
		
		$this->load->view ( $this->uri->segment ( "1" ) . "/" . $bp_template_name, $data );
	}
	
	
	public function send_email() {
		$activedata = array (
				"activemain" => $this->uri->segment ( "1" ),
				"displayblock" => $this->uri->segment ( "1" ),
				"activeclass" => $this->uri->segment ( "1" )
		);

		$data ["activedata"] = $activedata;
		$bp_user_type = "DSA";
		$bp_user_id = $this->dsa_data->dsa_id;
		$request_type = $this->input->server ( "REQUEST_METHOD" );
		$data ['agentsS'] =$this->Email_Model->get_agent('agent');
		// print_r($data ['agentsS']);
		// die;
		$data ['selected_agentsS'] =$this->Email_Model->get_agent_selected();
		$data ['agents_class'] = $this->Common_Model->get_table_result("*","agclali_dsa_id",$bp_user_id,"agent_class_list");
		$data ['staff_list'] = $this->Common_Model->get_table_result("*","dsast_status","active","dsa_staff");
		$data ['customers'] = $this->Email_Model->customer_list($bp_user_type, $bp_user_id);
		$data ['selected_customers'] = $this->Email_Model->selected_customer_list($bp_user_type, $bp_user_id);
		$dsaemailsetting = $this->Email_Model->get_mailsetting ( $this->dsa_data->dsa_id );
			 $emailconfig = array (
					 "smtp_host" => $dsaemailsetting->email_smtp_host,
					 "smtp_port" => $dsaemailsetting->email_smtp_port,
					 "smtp_username" => $dsaemailsetting->email_smtp_user,
					 "smtp_password" => $dsaemailsetting->email_smtp_password,
					 "smtp_frommail" => $dsaemailsetting->email_from,
					 "smtp_name" => $dsaemailsetting->email_name 
		);
		//print_r($dsaemailsetting);
		//die;
		if($request_type == "POST")
		{	
			//print_r($_POST);
			//die;
			if($_POST['type'] == "all" )
			{
				$mail_id="";
				//$bp_numbers1="";
				if(is_array($data ['selected_customers']) && $data ['selected_customers']!=0) {
					
					foreach($data ['selected_customers'] as $cust_list) { 
					    if(isset($cust_list->cust_email) && $cust_list->cust_email!=null)
						{	
							$mail_id .= $cust_list->cust_email.",";
							 $sender_subject = "";
		                     email_send ( $mail_id, $_POST['subject'], $_POST['message'], $emailconfig );
							//send_email ($cust_list->cust_mobile,$_POST['message'], "" );
						}
					} 
				} 
				
				if(is_array($data ['selected_agentsS']) && $data ['selected_agentsS']!=0) {
					
					foreach($data ['selected_agentsS'] as $agent_list) { 
					    if(isset($agent_list->agent_email) && $agent_list->agent_email!=null)
						{
							$mail_id .= $agent_list->agent_email.",";
							$sender_subject = "";
		                     email_send ( $mail_id, $_POST['subject'], $_POST['message'], $emailconfig );
							//send_email ($agent_list->agent_mobile,$_POST['message'], "" );
						}
					} 
				} 
                
                if(is_array($data ['staff_list']) && $data ['staff_list']!=0) {
					foreach($data ['staff_list'] as $staff_lists) { 
						if($staff_lists->dsast_email!="")
						{	
							$mail_id .= $staff_lists->dsast_email.",";
							$sender_subject = "";
		                     email_send ( $mail_id, $_POST['subject'], $_POST['message'], $emailconfig );
							//send_email($staff_lists->dsast_mobile,$_POST['message'], "" );
						}
					}
			    }  

				
				$bp_message=$_POST['message'];
				$bp_subject=$_POST['subject'];
				$bp_sender_id=$dsaemailsetting->email_from;
				$bp_sent_by="Admin";
				$bp_user_id = $this->dsa_data->dsa_id;
				$data1=array(
						"email_log_email"=>$mail_id,
						"email_log_subject"=>$bp_subject,
						"email_log_sender_id"=>$bp_sender_id,
						"email_log_message"=>$bp_message,
						"email_log_send_by"=>$bp_sent_by,
						"email_log_dsa_id"=>5,
						
				);
				
				$insert_id=$this->Email_Model->insert_email_log($data1);
				$this->session->set_flashdata("alert",array(
						"message"=> "Email Sent Successfully",
						"class"=>"alert-success",
				));
				redirect("email");
				
				
				
			} else if($_POST['type'] == "agent")	
			{
				if($_POST['agent_cls']=="all") {
					foreach($data ['selected_agentsS'] as $agent_list) { 
							    $mail_id .= $agent_list->agent_email.",";
		                     email_send ( $mail_id, $_POST['subject'], $_POST['message'], $emailconfig );
								//email_send ($agent_list->agent_mobile,$_POST['message'], "" );
					}
							
					$bp_message=$_POST['message'];
				$bp_subject=$_POST['subject'];
					$bp_sender_id=$dsaemailsetting->email_from;
					$bp_sent_by="Admin";
					$bp_user_id = $this->dsa_data->dsa_id;
					$data1=array(
							"email_log_email"=>$mail_id,
						"email_log_subject"=>$bp_subject,
							"email_log_sender_id"=>$bp_sender_id,
							"email_log_message"=>$bp_message,
							"email_log_send_by"=>$bp_sent_by,
						"email_log_dsa_id"=>5,
							
					);
					$insert_id=$this->Email_Model->insert_email_log($data1);
					$this->session->set_flashdata("alert",array(
							"message"=> "Email Sent Successfully",
							"class"=>"alert-success",
					));
					redirect("email");
					
					
				} else {
					
					
					$mail_id="";
					foreach($_POST['agent_id'] as $mobile){
						if($mobile=="all")
						{
                            $data['agent_cls_choice'] = $this->Email_Model->get_agent_by_class($_POST['agent_cls']);
							foreach($data ['agent_cls_choice'] as $agent_lst) { 
							    $mail_id .= $agent_list->agent_email.",";
		                     email_send ( $mail_id, $_POST['subject'], $_POST['message'], $emailconfig );
								//email_send ($agent_lst->agent_mobile,$_POST['message'], "" );
							}
							
								$bp_message=$_POST['message'];
								$bp_subject=$_POST['subject'];
								$bp_sender_id=$dsaemailsetting->email_from;
								$bp_sent_by="Admin";
								$bp_user_id = $this->dsa_data->dsa_id;
								$data1=array(
										"email_log_email"=>$mail_id,
										"email_log_subject"=>$bp_subject,
										"email_log_sender_id"=>$bp_sender_id,
										"email_log_message"=>$bp_message,
										"email_log_send_by"=>$bp_sent_by,
										"email_log_dsa_id"=>5,
										
								);
								$insert_id=$this->Email_Model->insert_email_log($data1);
								$this->session->set_flashdata("alert",array(
										"message"=> "Email Sent Successfully",
										"class"=>"alert-success",
								));
								redirect("email");
						} else {
							// print_r($_POST ["agent_id"]);
							// die;
							$mail_id = implode( ",", $_POST ["agent_id"]);
							
							$bp_sms_result = email_send ( $mail_id, $_POST['subject'], $_POST['message'], $emailconfig );
						}	
						
					}
					
				}
				
				$bp_message=$_POST['message'];
				$bp_subject=$_POST['subject'];
				$bp_sender_id=$dsaemailsetting->email_from;
				$bp_sent_by="Admin";
				$bp_user_id = $this->dsa_data->dsa_id;
				$data1=array(
						"email_log_email"=>$mail_id,
						"email_log_subject"=>$bp_subject,
						"email_log_sender_id"=>$bp_sender_id,
						"email_log_message"=>$bp_message,
						"email_log_send_by"=>$bp_sent_by,
						"email_log_dsa_id"=>5,
				);
				//print_r($data1);
				//die;
				$insert_id=$this->Email_Model->insert_email_log($data1);
				$this->session->set_flashdata("alert",array(
						"message"=> "Email Sent Successfully",
						"class"=>"alert-success",
				));
			} else if($_POST['type'] == "customer")
			{
				$mail_id="";
					foreach($_POST['customer_id'] as $mobi){
						if($mobi=="all")
						{
                            
							if(is_array($data ['selected_customers']) && $data ['selected_customers']!=0) {
								
								foreach($data ['selected_customers'] as $cust_list) { 
									if(isset($cust_list->cust_email) && $cust_list->cust_email!=null)
									{	
										$mail_id .= $cust_list->cust_email.",";
										email_send ( $mail_id, $_POST['subject'], $_POST['message'], $emailconfig );
										//email_send ($cust_list->cust_mobile,$_POST['message'], "" );
									}
								} 
							} 
							
							$bp_message=$_POST['message'];
							$bp_subject=$_POST['subject'];
							$bp_sender_id=$dsaemailsetting->email_from;
							$bp_sent_by="Admin";
							$bp_user_id = $this->dsa_data->dsa_id;
							$data1=array(
									"email_log_email"=>$mail_id,
									"email_log_subject"=>$bp_subject,
									"email_log_sender_id"=>$bp_sender_id,
									"email_log_message"=>$bp_message,
									"email_log_send_by"=>$bp_sent_by,
									"email_log_dsa_id"=>5,
									
							);
							$insert_id=$this->Email_Model->insert_email_log($data1);
							$this->session->set_flashdata("alert",array(
									"message"=> "Email Sent Successfully",
									"class"=>"alert-success",
							));
							redirect("email");
						} else {
							$mail_id = implode( ",", $_POST["customer_id"]);
							$bp_sms_result = email_send ( $mail_id, $_POST['subject'], $_POST['message'], $emailconfig );
							
							$bp_message=$_POST['message'];
							$bp_subject=$_POST['subject'];
							$bp_sender_id=$dsaemailsetting->email_from;
							$bp_sent_by="Admin";
							$bp_user_id = $this->dsa_data->dsa_id;
							$data1=array(
									"email_log_email"=>$mail_id,
									"email_log_subject"=>$bp_subject,
									"email_log_sender_id"=>$bp_sender_id,
									"email_log_message"=>$bp_message,
									"email_log_send_by"=>$bp_sent_by,
									"email_log_dsa_id"=>5,
							);
							$insert_id=$this->Email_Model->insert_email_log($data1);
							$this->session->set_flashdata("alert",array(
									"message"=> "Email Sent Successfully",
									"class"=>"alert-success",
							));
							redirect("email");
						}	
						
					}
			} else if($_POST['type'] == "staff")
			{
				//print_r($data ['staff_list']); exit;
				$mail_id="";
				foreach($data ['staff_list'] as $staff_lists) { 
					if($staff_lists->dsast_mobile!="")
					{	
						$mail_id .= $staff_lists->dsast_email.",";
						email_send ( $mail_id, $_POST['subject'], $_POST['message'], $emailconfig );
					}
				}
							
				$bp_message=$_POST['message'];
				$bp_subject=$_POST['subject'];
				$bp_sender_id=$dsaemailsetting->email_from;
				$bp_sent_by="Admin";
				$bp_user_id = $this->dsa_data->dsa_id;
				$data1=array(
						"email_log_email"=>$mail_id,
						"email_log_subject"=>$bp_subject,
						"email_log_sender_id"=>$bp_sender_id,
						"email_log_message"=>$bp_message,
						"email_log_send_by"=>$bp_sent_by,
						"email_log_dsa_id"=>5,
						
				);
				$insert_id=$this->Email_Model->insert_email_log($data1);
				$this->session->set_flashdata("alert",array(
						"message"=> "Email Sent Successfully",
						"class"=>"alert-success",
				));
				redirect("email");
			}	
			
			
			redirect("email");
		} else {
			//$result = $this->Email_Model->get_sender_id($bp_user_id);
			//$data ['results'] = $result;
			$this->load->view ("email/email_send", $data );
		}
		
	}
	
	
	public function agent()
	{
		$class=$_GET['type'];
		$data = $this->Email_Model->get_agent_by_class($class);
		if($data!=0)
		{	
			$result = json_encode ( $data );
			print_r($result);
		}

	}

		public function send_custom_email() {
		$activedata = array (
				"activemain" => $this->uri->segment ( "1" ),
				"displayblock" => $this->uri->segment ( "1" ),
				"activeclass" => $this->uri->segment ( "1" )
		);
		$data ["activedata"] = $activedata;
		$bp_user_type = "DSA";
		$bp_user_id = $this->dsa_data->dsa_id;
		$request_type = $this->input->server ( "REQUEST_METHOD" );
		$dsaemailsetting = $this->Email_Model->get_mailsetting ( $this->dsa_data->dsa_id );
			 $emailconfig = array (
					 "smtp_host" => $dsaemailsetting->email_smtp_host,
					 "smtp_port" => $dsaemailsetting->email_smtp_port,
					 "smtp_username" => $dsaemailsetting->email_smtp_user,
					 "smtp_password" => $dsaemailsetting->email_smtp_password,
					 "smtp_frommail" => $dsaemailsetting->email_from,
					 "smtp_name" => $dsaemailsetting->email_name 
		);
		if($request_type == "POST")
		{
			
			$bp_message=$_POST['message'];
			$bp_subject=$_POST['subject'];
			$bp_sender_id=$dsaemailsetting->email_from;
			$mail_id=$_POST['email_id1'];
			$bp_sent_by="Admin";
			$bp_email_result=email_send ( $mail_id, $_POST['subject'], $_POST['message'], $emailconfig );
			
			$bp_data=serialize($bp_email_result);
			$data1=array(
					"email_log_email"=>$mail_id,
					"email_log_subject"=>$bp_subject,
					"email_log_sender_id"=>$bp_sender_id,
					"email_log_message"=>$bp_message,
					"email_log_send_by"=>$bp_sent_by,
					"email_log_dsa_id"=>5,
			);
			$insert_id=$this->Email_Model->insert_email_log($data1);
			// print_r($data1);
			// die;
			$this->session->set_flashdata("alert",array(
					"message"=> "Email Sent Successfully",
					"class"=>"alert-success",
			));
			redirect("email");
		
		} else {
			//$result = $this->Email_Model->get_sender_id($bp_user_id);
			//$data ['results'] = $result;
		
			$this->load->view ("email/send_custom_email", $data );
		}
		
	}
	

	
}