<?php
class B2c_hotel extends MX_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->Model ( 'B2c_hotel_Model' );
		$this->model_name = "Hotel_Model";
		$this->load->helper ( 'common_helper' );
	}
	public function search_log(){
		$activedata = array (
				"activemain" => $this->uri->segment ( "1" ),
				"displayblock" => $this->uri->segment ( "1" ),
				"activeclass" => $this->uri->segment ( "1" ) . "/" . $this->uri->segment ( "2" )
		);
		$data ["activedata"] = $activedata;
		$bp_user_type = "DSA";
		$bp_user_id = $this->dsa_data->dsa_id;
		$bp_model_name = $this->model_name;
		$table = "hotel_live_search_log";
		$where_1_name = "hotsealog_dsa_id";
		$where_1_value = $bp_user_id;
		$where_2_name = "hotsealog_booking_module";
		$where_2_value = "B2C";
		$order_by = "hotsealog_id";
		$bp_template_name = "hotel_search_log";
		if ($this->uri->segment ( 3 )) {
			$page = $this->uri->segment ( 3 );
		} else {
			$page = 0;
		}
		$this->db->where ( $where_1_name, $where_1_value );
		$this->db->where ( $where_2_name, $where_2_value );
		$total_row = $this->db->from ( $table )->count_all_results ();
		$pagination_segment = 3;
		$per_page = 10;
		$pagination_url = base_url () . $this->uri->segment ( "1" ) . "/" . $this->uri->segment ( "2" );
		$config = bp_pagination ( $pagination_url, 0, $total_row, $per_page );
		$this->pagination->initialize ( $config );
		$result = $this->Common_Model->pagination_table ( $config ["per_page"], $page, $where_1_name, $where_1_value, $where_2_name, $where_2_value, $order_by, $table );
		$data ['result'] = $result;
		$this->load->view ( $this->uri->segment ( "1" ) . "/" . $bp_template_name, $data );
	}
	public function index() {
		redirect("hotel/booking_list");
	}
	public function delete_b2c_markup() {
		$id = url_decode ( $this->input->get ( "ref_id" ) );
		$data = $this->Common_Model->delete_table ( "dsahomark_id", $id, "dsa_hotel_markup" );
		$this->session->set_flashdata ( "alert", array (
				"message" => $this->lang->line ( "successfully_deleted" ),
				"class" => "alert-success"
		) );
		redirect ( $this->uri->segment ( "1" )."/b2c_markup_list" );
	}
	public function b2c_markup_list(){
		$activedata = array (
				"activemain" => $this->uri->segment ( "1" ),
				"displayblock" => $this->uri->segment ( "1" ),
				"activeclass" => $this->uri->segment ( "1" ) . "/" . $this->uri->segment ( "2" )
		);
		$data ["activedata"] = $activedata;
		$bp_user_type = "DSA";
		$bp_user_id = $this->dsa_data->dsa_id;
		$bp_model_name = $this->model_name;
		$table = "dsa_hotel_markup";
		$where_1_name = "dsahomark_b2c_b2b";
		$where_1_value = "b2c";
		$where_2_name = "dsahomark_dsa_id";
		$where_2_value = $bp_user_id;
		$order_by = "dsahomark_id";
		$bp_template_name = "b2c_markup_list";
		if ($this->uri->segment ( 3 )) {
			$page = $this->uri->segment ( 3 );
		} else {
			$page = 0;
		}
		$this->db->where ( $where_1_name, $where_1_value );
		$this->db->where ( $where_2_name, $where_2_value );
		$total_row = $this->db->from ( $table )->count_all_results ();
		$pagination_segment = 3;
		$per_page = 10;
		$pagination_url = base_url () . $this->uri->segment ( "1" ) . "/" . $this->uri->segment ( "2" );
		$config = bp_pagination ( $pagination_url, 0, $total_row, $per_page );
		$this->pagination->initialize ( $config );
		$result = $this->Common_Model->pagination_table ( $config ["per_page"], $page, $where_1_name, $where_1_value, $where_2_name, $where_2_value, $order_by, $table );
		$data ['result'] = $result;
		$this->load->view ( $this->uri->segment ( "1" ) . "/" . $bp_template_name, $data );
	}
	public function add_b2c_markup(){
		$activedata = array (
				"activemain" => $this->uri->segment ( "1" ),
				"displayblock" => $this->uri->segment ( "1" ),
				"activeclass" => $this->uri->segment ( "1" ) . "/" . $this->uri->segment ( "2" )
		);
		$data ["activedata"] = $activedata;
		$request_type = $this->input->server ( "REQUEST_METHOD" );
		if ($request_type == "POST") {
			$bp_updated_by = $this->dsa_data->dsa_id;
			if($this->input->post ( 'amount_type' )=="percent"){
				if($this->input->post ( 'amount' )>=99){
					$this->session->set_flashdata ( "alert", array (
							"message" => $this->lang->line ( "enter_valid_amount" ),
							"class" => "alert-danger"
					) );
					redirect ($this->uri->segment ( "1" )."/add_b2b_markup");
				}
			}
			$data_1 = array (
					'dsahomark_amount' => $this->input->post ( 'amount' ),
					'dsahomark_amount_type' => $this->input->post ( 'amount_type' ),
					"dsahomark_low_range" => $this->input->post ( 'low_price' ),
					"dsahomark_high_range" => $this->input->post ( 'high_price' ),
					'dsahomark_b2c_b2b' => "b2c",
					"dsahomark_dsa_id" => $bp_updated_by
			);
			$this->Common_Model->insert_table ( "dsa_hotel_markup", $data_1 );
			$this->session->set_flashdata ( "alert", array (
					"message" => $this->lang->line ( "successfully_added" ),
					"class" => "alert-success"
			) );
			redirect ($this->uri->segment ( "1" )."/b2c_markup_list");
		} else {
			$this->load->view ( $this->uri->segment ( "1" ) . "/add_b2c_hotel_markup",$data);
		}
	}
	public function delete_b2b_markup() {
		$id = url_decode ( $this->input->get ( "ref_id" ) );
		$data = $this->Common_Model->delete_table ( "dsahomark_id", $id, "dsa_hotel_markup" );
		$this->session->set_flashdata ( "alert", array (
				"message" => $this->lang->line ( "successfully_deleted" ),
				"class" => "alert-success"
		) );
		redirect ( $this->uri->segment ( "1" )."/b2b_markup_list" );
	}
	public function b2b_markup_list(){
		$activedata = array (
				"activemain" => $this->uri->segment ( "1" ),
				"displayblock" => $this->uri->segment ( "1" ),
				"activeclass" => $this->uri->segment ( "1" ) . "/" . $this->uri->segment ( "2" )
		);
		$data ["activedata"] = $activedata;
		$bp_user_type = "DSA";
		$bp_user_id = $this->dsa_data->dsa_id;
		$bp_model_name = $this->model_name;
		$table = "dsa_hotel_markup";
		$where_1_name = "dsahomark_b2c_b2b";
		$where_1_value = "b2c";
		$where_2_name = "dsahomark_dsa_id";
		$where_2_value = $bp_user_id;
		$order_by = "dsahomark_id";
		$bp_template_name = "b2b_markup_list";
		if ($this->uri->segment ( 3 )) {
			$page = $this->uri->segment ( 3 );
		} else {
			$page = 0;
		}
		$this->db->where ( $where_1_name, $where_1_value );
		$this->db->where ( $where_2_name, $where_2_value );
		$total_row = $this->db->from ( $table )->count_all_results ();
		$pagination_segment = 3;
		$per_page = 10;
		$pagination_url = base_url () . $this->uri->segment ( "1" ) . "/" . $this->uri->segment ( "2" );
		$config = bp_pagination ( $pagination_url, 0, $total_row, $per_page );
		$this->pagination->initialize ( $config );
		$result = $this->Common_Model->pagination_table ( $config ["per_page"], $page, $where_1_name, $where_1_value, $where_2_name, $where_2_value, $order_by, $table );
		$data ['result'] = $result;
		$this->load->view ( $this->uri->segment ( "1" ) . "/" . $bp_template_name, $data );
	}
	public function add_b2b_markup(){
		$activedata = array (
				"activemain" => $this->uri->segment ( "1" ),
				"displayblock" => $this->uri->segment ( "1" ),
				"activeclass" => $this->uri->segment ( "1" ) . "/" . $this->uri->segment ( "2" )
		);
		$data ["activedata"] = $activedata;
		$request_type = $this->input->server ( "REQUEST_METHOD" );
		if ($request_type == "POST") {
			$bp_updated_by = $this->dsa_data->dsa_id;
			if($this->input->post ( 'amount_type' )=="percent"){
				if($this->input->post ( 'amount' )>=99){
					$this->session->set_flashdata ( "alert", array (
							"message" => $this->lang->line ( "enter_valid_amount" ),
							"class" => "alert-danger"
					) );
					redirect ($this->uri->segment ( "1" )."/add_b2b_markup");
				}
			}
			$data_1 = array (
					'dsahomark_amount' => $this->input->post ( 'amount' ),
					'dsahomark_amount_type' => $this->input->post ( 'amount_type' ),
					"dsahomark_low_range" => $this->input->post ( 'low_price' ),
					"dsahomark_high_range" => $this->input->post ( 'high_price' ),
					"dsahomark_agent_class" => $this->input->post ( 'class' ),
					'dsahomark_b2c_b2b' => "b2c",
					"dsahomark_dsa_id" => $bp_updated_by
			);
			$this->Common_Model->insert_table ( "dsa_hotel_markup", $data_1 );
			$this->session->set_flashdata ( "alert", array (
					"message" => $this->lang->line ( "successfully_added" ),
					"class" => "alert-success"
			) );
			redirect ($this->uri->segment ( "1" )."/b2b_markup_list");
		} else {
			$bp_dsa_id=$this->dsa_data->dsa_id;
			$agent_class_list = $this->Common_Model->get_table_result("*","agclali_dsa_id",$bp_dsa_id,"agent_class_list");
			$data ['agent_class_list'] = $agent_class_list;
			$this->load->view ( $this->uri->segment ( "1" ) . "/add_b2b_hotel_markup",$data);
		}
	}

	public function booking_list(){
		$activedata = array (
				"activemain" => $this->uri->segment ( "1" ),
				"displayblock" => $this->uri->segment ( "1" ),
				"activeclass" => $this->uri->segment ( "1" ) . "/" . $this->uri->segment ( "2" )
		);
		$data ["activedata"] = $activedata;
	
		$bp_user_id = $this->dsa_data->dsa_id;

		$bp_model_name = $this->model_name;
		$table = "hotel_live_booking_list";
		$where_1_name = "hotboli_dsa_id";
		$where_1_value = $bp_user_id;
		$where_2_name = "hotboli_module";
		$where_2_value = "B2C";
		$order_by = "hotboli_id";
		$bp_template_name = "hotel_booking_list";
		if ($this->uri->segment ( 3 )) {
			$page = $this->uri->segment ( 3 );
		} else {
			$page = 0;
		}
		$this->db->where ( $where_1_name, $where_1_value );
		$this->db->where ( $where_2_name, $where_2_value );
		$total_row = $this->db->from ( $table )->count_all_results ();
		$pagination_segment = 3;
		$per_page = 10;
		$pagination_url = base_url () . $this->uri->segment ( "1" ) . "/" . $this->uri->segment ( "2" );
		$config = bp_pagination ( $pagination_url, 0, $total_row, $per_page );
		$this->pagination->initialize ( $config );
		$result = $this->Common_Model->pagination_table ( $config ["per_page"], $page, $where_1_name, $where_1_value, $where_2_name, $where_2_value, $order_by, $table );
		$data ['result'] = $result;

		$pax=array();
		if(is_array($result)){
		foreach($result as $results){
			$booking_id=$results->hotboli_id;
			$pax[$booking_id]=$this->Common_Model->get_table_result("*","hotbopax_booking_id",$booking_id,"hotel_live_booking_pax");
		}
		}
		$data ['pax'] = $pax;
		$this->load->view ( $this->uri->segment ( "1" ) . "/" . $bp_template_name, $data );
	}

	public function print_ticket_admin() {
		$refId = url_decode ( $_GET ['ref_id'] );
		$data ['isEmail'] = "false" ;
		$data['hotel_info_result'] = json_decode($this->Common_Model->get_table_row ("*", array(
			"hotdata_booking_id" => $refId,
			"hotdata_key" =>"hotel_info_result"
		), 
		"hotel_live_temp_data")->hotdata_data);

		$data['requset_data'] = json_decode($this->Common_Model->get_table_row ("*", array(
			"hotdata_booking_id" => $refId,
			"hotdata_key" =>"selected_hotel_room"
		), "hotel_live_temp_data")->hotdata_data,true);

		$data['hotel_booking'] = $this->Common_Model->get_table_row ("*", array(
			"hotboli_id" =>$refId,
		), 	"hotel_live_booking_list");

		// echo "<pre>";
		// print_r($data);die;
		$this->load->view ( 'ticket/hotel_voucher', $data );
	}
	
	public function get_voucher() {
		$refId =$_GET ['ref_id'];
		$to = $_GET ['mnailiduser'];
		$subject = $_GET ['valuesubj'];
		$data['hotel_info_result'] = unserialize($this->Common_Model->get_table_row ("*", array(
			"hotdata_booking_id" => $refId,
			"hotdata_key" =>"hotel_info_result"
		), "hotel_live_temp_data")->hotdata_data);

		$data['requset_data'] = unserialize($this->Common_Model->get_table_row ("*", array(
			"hotdata_booking_id" => $refId,
			"hotdata_key" =>"selected_hotel_room"
		), "hotel_live_temp_data")->hotdata_data);

		$data['hotel_booking'] = $this->Common_Model->get_table_row ("*", array(
			"hotboli_id" =>$refId,
		), 	"hotel_live_booking_list");
		$data ['isEmail'] = "true";
		
				$message = $this->load->view ( 'ticket/hotel_voucher', $data, TRUE );
			// $dsaemailsetting = $this->B2c_hotel_Model->get_mailsetting ( $this->dsa_data->dsa_id );
			// if ($dsaemailsetting != "not") {
				// $emailconfig = array (
						// "smtp_host" => $dsaemailsetting->email_smtp_host,
						// "smtp_port" => $dsaemailsetting->email_smtp_port,
						// "smtp_username" => $dsaemailsetting->email_smtp_user,
						// "smtp_password" => $dsaemailsetting->email_smtp_password,
						// "smtp_frommail" => $dsaemailsetting->email_from,
						// "smtp_name" => $dsaemailsetting->email_name 
				// );
				$mail_id = $to;
				$sender_subject = $subject;
				email_send ( $mail_id, $sender_subject, $message );
			//}
		}
	

	
	public function print_ticket() {
		$refId = url_decode($_GET ['ref_id']);
		$SelectedFare = $this->Flight_Model->get_search_detail($refId, 'ob_ticket');
		$Sel_detail = unserialize($SelectedFare->ftemp_data);
		$BookingDetails = $this->Flight_Model->get_booking_by_id($refId);
		$FareDetail = $BookingDetails;
		$PaxDetail = $this->Flight_Model->get_pax_by_id($refId);
		$Fld_Type = $FareDetail->fbook_booking_type;
		$Fld_IsDomestic = $FareDetail->fbook_is_domestic;
		$Fld_TicketStatus = $FareDetail->fbook_ob_booking_status;
		$data ['SelectedFare'] = $Sel_detail;
		$data ['BookingDetails'] = $FareDetail;
		$data ['PaxDetails'] = $PaxDetail;
		$data ['refId'] = $refId;
		if ($Fld_TicketStatus == "Success") {
			if ($Fld_Type == "Return" && $Fld_IsDomestic == "true") {
				$SelectedFareIB = $this->Flight_Model->get_search_detail($refId, 'ib_ticket');
				$Sel_detailIB = unserialize($SelectedFareIB->ftemp_data);
				$data ['SelectedFareIB'] = $Sel_detailIB;
				$this->load->view('flight/ticket/ticket_return_dom', $data);
			} else if ($Fld_Type == "Return" && $Fld_IsDomestic == "false") {
				$this->load->view('flight/ticket/ticket_return_int', $data);
			} else {
				$this->load->view('flight/ticket/onewayticket', $data);
			}
		} else {
			redirect("/flight/booking_error?sessionid=" . $bookingdata->fbook_sessionid);
		}
	}
	
	public function print_invoice() {
		$refId = url_decode($_GET ['ref_id']);
		$SelectedFare = $this->Flight_Model->get_search_detail($refId, 'ob_ticket');
		$Sel_detail = unserialize($SelectedFare->ftemp_data);
		$BookingDetails = $this->Flight_Model->get_booking_by_id($refId);
		$FareDetail = $BookingDetails;
		$PaxDetail = $this->Flight_Model->get_pax_by_id($refId);
		$Fld_Type = $FareDetail->fbook_booking_type;
		$Fld_IsDomestic = $FareDetail->fbook_is_domestic;
		$Fld_TicketStatus = $FareDetail->fbook_ob_booking_status;
		$data ['SelectedFare'] = $Sel_detail;
		$data ['BookingDetails'] = $FareDetail;
		$data ['PaxDetails'] = $PaxDetail;
		$data ['refId'] = $refId;
		if ($Fld_TicketStatus == "Success") {
			if ($Fld_Type == "Return" && $Fld_IsDomestic == "true") {
				$SelectedFareIB = $this->Flight_Model->get_search_detail($refId, 'ib_ticket');
				$Sel_detailIB = unserialize($SelectedFareIB->ftemp_data);
				$data ['SelectedFareIB'] = $Sel_detailIB;
				$this->load->view('flight/invoice/return_invoice_dom', $data);
			} else if ($Fld_Type == "Return" && $Fld_IsDomestic == "false") {
				$this->load->view('flight/invoice/onewayinvoice', $data);
			} else {
				$this->load->view('flight/invoice/onewayinvoice', $data);
			}
		} else {
			redirect("/flight/booking_error?sessionid=" . $bookingdata->fbook_sessionid);
		}
	}
	
	// hotel discount start

	public function add_hotel_discount(){
		$activedata = array (
			"activemain" => $this->uri->segment ( "1" ),
			"displayblock" => $this->uri->segment ( "1" ),
			"activeclass" => $this->uri->segment ( "1" ) . "/" . $this->uri->segment ( "2" )
		);
		$data ["activedata"] = $activedata;
		$request_type = $this->input->server ( "REQUEST_METHOD" );
		if ($request_type == "POST") {
			$bp_updated_by = $this->dsa_data->dsa_id;
			$data_1 = array (
					'hdis_fix' => $this->input->post ( 'amount' ),
					"hdis_status" => "active",
					'hdis_module' => "b2c",
					'hdis_class' =>"",
					"hdis_dsa_id" => $bp_updated_by
			);
			$this->Common_Model->insert_table ( "hotel_discount", $data_1 );
			$this->session->set_flashdata ( "alert", array (
					"message" => $this->lang->line ( "successfully_added" ),
					"class" => "alert-success"
			) );
			redirect ($this->uri->segment ( "1" )."/b2c_discount_list");
		} else {
			$bp_dsa_id=$this->dsa_data->dsa_id;			
			$this->load->view("add_b2c_hotel_discount",$data );
		}
	}

	public function b2c_discount_list(){
		$activedata = array (
				"activemain" => $this->uri->segment ( "1" ),
				"displayblock" => $this->uri->segment ( "1" ),
				"activeclass" => $this->uri->segment ( "1" ) . "/" . $this->uri->segment ( "2" )
		);
	
		$data ["activedata"] = $activedata;
		$bp_user_type = "DSA";
		$bp_user_id = $this->dsa_data->dsa_id;
		$bp_model_name = $this->model_name;
		$table = "hotel_discount";
		$where_1_name = "	hdis_module";
		$where_1_value = "b2c";
		$where_2_name = "hdis_dsa_id";
		$where_2_value = $bp_user_id;
		$order_by = "hdis_dsa_id";
		$bp_template_name = "b2c_discount_list";
		if ($this->uri->segment ( 3 )) {
			$page = $this->uri->segment ( 3 );
		} else {
			$page = 0;
		}
		$this->db->where ( $where_1_name, $where_1_value );
		$this->db->where ( $where_2_name, $where_2_value );
		$total_row = $this->db->from ( $table )->count_all_results ();
		$pagination_segment = 3;
		$per_page = 10;
		$pagination_url = base_url () . $this->uri->segment ( "1" ) . "/" . $this->uri->segment ( "2" );
		$config = bp_pagination ( $pagination_url, 0, $total_row, $per_page );
		$this->pagination->initialize ( $config );
		$result = $this->Common_Model->pagination_table ( $config ["per_page"], $page, $where_1_name, $where_1_value, $where_2_name, $where_2_value, $order_by, $table );
		$data ['result'] = $result;
		$this->load->view ( $this->uri->segment ( "1" ) . "/" . $bp_template_name, $data );
	}

	public function delete_b2c_discount() {
		$id = url_decode ( $this->input->get ( "ref_id" ) );
		
		$data = $this->Common_Model->delete_table ( "hdis_id", $id, "hotel_discount" );
		$this->session->set_flashdata ( "alert", array (
				"message" => $this->lang->line ( "successfully_deleted" ),
				"class" => "alert-success"
		) );
		redirect ( $this->uri->segment ( "1" )."/b2c_discount_list" );
	}
	
}

