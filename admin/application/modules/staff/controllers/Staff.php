<?php
class Staff extends MX_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->model ( array (
				'Staff_Model' 
		) );
	}
	public function index() {
		redirect($this->uri->segment ( "1" )."/staff_list");
	}
	public function edit_staff_detail(){
		$id = url_decode ( $this->input->get ( "ref_id" ) );
		$bp_staff_detail=$this->Common_Model->get_table("*","dsast_id",$id,"dsa_staff");
		$activedata = array (
				"activemain" => $this->uri->segment ( "1" ),
				"displayblock" => $this->uri->segment ( "1" ),
				"activeclass" => $this->uri->segment ( "1" ) . "/" . $this->uri->segment ( "2" )
		);
		$data ["activedata"] = $activedata;
		$request_type = $this->input->server ( "REQUEST_METHOD" );
		if ($request_type == "POST") {
			$bp_updated_by = $this->dsa_data->dsa_id;
			$bp_permission_entry="";
			if(isset($_POST['permission'])){
				foreach($_POST['permission'] as $bp){
					if($bp_permission_entry==""){
						$bp_permission_entry=$bp;
					}else{
						$bp_permission_entry=$bp_permission_entry.",".$bp;
					}
				}
			}
			$data_1 = array (
					"dsast_first_name" => $this->input->post("first_name"),
					"dsast_last_name" => $this->input->post("last_name"),
					"dsast_email" => $this->input->post("email"),
					"dsast_mobile" => $this->input->post("mobile"),
					"dsast_permission" => $bp_permission_entry,
			);
			$this->Common_Model->update_table("dsast_id",$id,"dsa_staff",$data_1);
			$this->session->set_flashdata ( "alert", array (
					"message" => "Staff successfully Updated",
					"class" => "alert-success"
			) );
			redirect($this->uri->segment ( "1" )."/staff_list");
		} else {
			$module = $this->Common_Model->get_table_result ( "*", "dsasm_status", "active", "dsa_staff_module" );
			$data ['bp_staff_detail'] = $bp_staff_detail;
			$data ['module'] = $module;
			$this->load->view ( $this->uri->segment ( "1" ) . "/edit_staff", $data );
		}
	}
	public function delete_staff() {
		$id = url_decode ( $this->input->get ( "ref_id" ) );
		$data = $this->Common_Model->delete_table ( "dsast_id", $id, "dsa_staff" );
		$this->session->set_flashdata ( "alert", array (
				"message" => "Staff Deleted Successfully",
				"class" => "alert-success"
		) );
		redirect ($this->uri->segment ( "1" )."/staff_list");
	}
	public function update_staff_status() {
		$id = url_decode ( $this->input->get ( "ref_id" ) );
		$data1 = array (
				"dsast_status" => $this->input->get ( "status" )
		);
		$this->Common_Model->update_table ( "dsast_id", $id, "dsa_staff", $data1 );
		$this->session->set_flashdata ( "alert", array (
				"message" => "Staff Successfully Updated",
				"class" => "alert-success"
		) );
		redirect ($this->uri->segment ( "1" )."/staff_list");
	}
	public function staff_list(){
		$activedata = array (
				"activemain" => $this->uri->segment ( "1" ),
				"displayblock" => $this->uri->segment ( "1" ),
				"activeclass" => $this->uri->segment ( "1" )
		);
		$data ["activedata"] = $activedata;
		$bp_user_type = "DSA";
		$bp_user_id = $this->dsa_data->dsa_id;
		$table = "dsa_staff";
		$where_1_name = "dsast_user_id";
		$where_1_value = $bp_user_id;
		$where_2_name = "dsast_user_id";
		$where_2_value = $bp_user_id;
		$order_by = "dsast_id";
		$bp_template_name = "staff_list";
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
	public function add_new_staff(){
		$activedata = array (
				"activemain" => $this->uri->segment ( "1" ),
				"displayblock" => $this->uri->segment ( "1" ),
				"activeclass" => $this->uri->segment ( "1" ) . "/" . $this->uri->segment ( "2" )
		);
		$data ["activedata"] = $activedata;
		$request_type = $this->input->server ( "REQUEST_METHOD" );
		if ($request_type == "POST") {
			$bp_updated_by = $this->dsa_data->dsa_id;
			$bp_permission_entry="";
			if(isset($_POST['permission'])){
				foreach($_POST['permission'] as $bp){
					if($bp_permission_entry==""){
						$bp_permission_entry=$bp;
					}else{
						$bp_permission_entry=$bp_permission_entry.",".$bp;
					}
				}
			}
			$data_1 = array (
					"dsast_first_name" => $this->input->post("first_name"),
					"dsast_last_name" => $this->input->post("last_name"),
					"dsast_email" => $this->input->post("email"),
					"dsast_password" => md5($this->input->post("password")),
					"dsast_mobile" => $this->input->post("mobile"),
					"dsast_permission" => $bp_permission_entry,
					"dsast_user_id" => $bp_updated_by,
			);
			$this->Common_Model->insert_table ( "dsa_staff", $data_1 );
			
			$bp_message = "Dear ".$this->input->post("first_name").", Your account is created successfully.\n" . "Your login Detail :-\n" . "Username-" . $this->input->post ( "email" ) . "\n" . "Password-" . $this->input->post ( "password" ). " URL-" . site_url();
			//email
			$dsaemailsetting = $this->Staff_Model->get_mailsetting ( $this->dsa_data->dsa_id );
			if ($dsaemailsetting != "not") {
				$emailconfig = array (
						"smtp_host" => $dsaemailsetting->email_smtp_host,
						"smtp_port" => $dsaemailsetting->email_smtp_port,
						"smtp_username" => $dsaemailsetting->email_smtp_user,
						"smtp_password" => $dsaemailsetting->email_smtp_password,
						"smtp_frommail" => $dsaemailsetting->email_from,
						"smtp_name" => $dsaemailsetting->email_name 
				);
				$mail_id = $this->input->post ( "email" );
				$sender_subject = "Staff Credentials";
				email_send ( $mail_id, $sender_subject, $bp_message, $emailconfig );
			}
			//end email
			$number = $this->input->post ( "mobile" );
			$ch = send_sms ( $number, $bp_message, "" );
			
			$this->session->set_flashdata ( "alert", array (
					"message" => "Staff successfully Updated",
					"class" => "alert-success"
			) );
			
			
			redirect($this->uri->segment ( "1" )."/staff_list");
		} else {
			$result = $this->Common_Model->get_table_result ( "*", "dsasm_status", "active", "dsa_staff_module" );
			$data ['result'] = $result;
			$this->load->view ( $this->uri->segment ( "1" ) . "/add_staff", $data );
		}
	}
		
}