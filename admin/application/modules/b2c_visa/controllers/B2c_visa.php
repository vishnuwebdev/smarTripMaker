<?php
class B2c_visa extends MX_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->Model ( 'B2c_visa_Model' );
		$this->model_name = "B2c_visa_Model";
		$this->load->helper ( 'common_helper' );
	}
	public function index() {
		echo "Access Forbidden";
	}
	public function request_list(){
		$activedata = array (
				"activemain" => $this->uri->segment ( "1" ),
				"displayblock" => $this->uri->segment ( "1" ),
				"activeclass" => $this->uri->segment ( "1" ) . "/" . $this->uri->segment ( "2" )
		);
		$data ["activedata"] = $activedata;
		$bp_user_type = "DSA";
		$bp_user_id = $this->dsa_data->dsa_id;
		$bp_model_name = $this->model_name;
		$table = "visa";
		$order_by = "id";
		$bp_template_name = "visa_list";
		if ($this->uri->segment ( 3 )) {
			$page = $this->uri->segment ( 3 );
		} else {
			$page = 0;
		}
		$where = "request_visa_id > 0 and userId is NOT NULL";
		$this->db->where($where);
		$total_row = $this->db->from ( $table )->count_all_results ();
		$pagination_segment = 3;
		$per_page = 50;
		$pagination_url = base_url () . $this->uri->segment ( "1" ) . "/" . $this->uri->segment ( "2" );
		$config = bp_pagination ( $pagination_url, 0, $total_row, $per_page );
		$this->pagination->initialize ( $config );
		$result = $this->Common_Model->visa_table ( $config ["per_page"], $page, $order_by, $table );
		$data ['result'] = $result;
		$pax=array();
		if(is_array($result)){
			foreach($result as $results){
				$visa_id=$results->request_visa_id;
				$pax[$results->id]=$this->Common_Model->get_table_result("*","id",$visa_id,"visa_list");
			}
		}
		$data ['pax'] = $pax;
		$this->load->view ( $this->uri->segment ( "1" ) . "/" . $bp_template_name, $data );
	}

	public function print_ticket() {
		$refId = url_decode($_GET ['ref_id']);
		$SelectedFare = $this->B2c_flight_Model->get_search_detail($refId, 'ob_ticket');
		$Sel_detail = json_decode($SelectedFare->ftemp_data);
		$BookingDetails = $this->B2c_flight_Model->get_booking_by_id($refId);
		$FareDetail = $BookingDetails;
		$PaxDetail = $this->B2c_flight_Model->get_pax_by_id($refId);
		$Fld_Type = $FareDetail->fbook_booking_type;
		$Fld_IsDomestic = $FareDetail->fbook_is_domestic;
		$Fld_TicketStatus = $FareDetail->fbook_ob_booking_status;
		$data ['SelectedFare'] = $Sel_detail;
		$data ['BookingDetails'] = $FareDetail;
		$data ['PaxDetails'] = $PaxDetail;
		$data ['refId'] = $refId;
		$data ['isEmail'] = "false" ;
		if ($Fld_TicketStatus == "Success") {
			if ($Fld_Type == "Return" && $Fld_IsDomestic == "true") {
				$SelectedFareIB = $this->B2c_flight_Model->get_search_detail($refId, 'ib_ticket');
				$Sel_detailIB = json_decode($SelectedFareIB->ftemp_data);
				$data ['SelectedFareIB'] = $Sel_detailIB;
				$this->load->view('b2c_flight/ticket/ticket_return_dom', $data);
			} else if ($Fld_Type == "Return" && $Fld_IsDomestic == "false") {
				$this->load->view('b2c_flight/ticket/ticket_return_int', $data);
			} else {
				$this->load->view('b2c_flight/ticket/onewayticket', $data);
			}
		} else {
			redirect("/b2c_flight/booking_error?sessionid=" . $bookingdata->fbook_sessionid);
		}
	}
	
	public function get_booking() {
		// $booking_id = 20;
		$refId = $_GET ['ref_id'];
		$encrypted_string = url_encode ( $refId );
		$SelectedFare = $this->B2c_flight_Model->get_search_detail ( $refId, 'ob_ticket' );
		$Sel_detail = json_decode ( $SelectedFare->ftemp_data );
		$BookingDetails = $this->B2c_flight_Model->get_booking_by_id ( $refId );
		$FareDetail = $BookingDetails;
		$PaxDetail = $this->B2c_flight_Model->get_pax_by_id ( $refId );
		$Fld_Type = $FareDetail->fbook_booking_type;
		$Fld_IsDomestic = $FareDetail->fbook_is_domestic;
		$Fld_TicketStatus = $FareDetail->fbook_ob_booking_status;
		$data ['SelectedFare'] = $Sel_detail;
		$data ['BookingDetails'] = $FareDetail;
		$data ['PaxDetails'] = $PaxDetail;
		$data ['refId'] = $refId;
		$data ['isEmail'] = "true";
		$to = $_GET ['mnailiduser'];
		$subject = $_GET ['valuesubj'];
		if ($Fld_TicketStatus == "Success") {
			if ($Fld_Type == "Return" && $Fld_IsDomestic == "true") {
				$SelectedFareIB = $this->B2c_flight_Model->get_search_detail ( $refId, 'ib_ticket' );
				$Sel_detailIB = json_decode ( $SelectedFareIB->ftemp_data );
				$data ['SelectedFareIB'] = $Sel_detailIB;
				$message = $this->load->view ( 'b2c_flight/ticket/ticket_return_dom', $data, TRUE );
			} else if ($Fld_Type == "Return" && $Fld_IsDomestic == "false") {
				$message = $this->load->view ( 'b2c_flight/ticket/ticket_return_int', $data, TRUE );
			} else {
				$message = $this->load->view ( 'b2c_flight/ticket/onewayticket', $data, TRUE );
			}
			
				$mail_id = $to;
				$sender_subject = $subject;
				
				$this->load->library('m_pdf');
				$pdf = $this->m_pdf->load();
				$pdfsss = $pdf->WriteHTML($message,2);
				$content = $pdf->Output('', 'S');				
				//email_send ( $mail_id, $sender_subject, $message );
				email_send_pdf($mail_id, $sender_subject, $message,$content);
			//}
			// redirect ( '/flight/flight_booking_confirm/?ref_no=' . $encrypted_string );
		}
	}
	
	public function print_invoice() {
		$refId = url_decode($_GET ['ref_id']);
		$SelectedFare = $this->B2c_flight_Model->get_search_detail($refId, 'ob_ticket');
		$Sel_detail = json_decode($SelectedFare->ftemp_data);
		$BookingDetails = $this->B2c_flight_Model->get_booking_by_id($refId);
		$FareDetail = $BookingDetails;
		$PaxDetail = $this->B2c_flight_Model->get_pax_by_id($refId);
		$Fld_Type = $FareDetail->fbook_booking_type;
		$Fld_IsDomestic = $FareDetail->fbook_is_domestic;
		$Fld_TicketStatus = $FareDetail->fbook_ob_booking_status;
		$data ['SelectedFare'] = $Sel_detail;
		$data ['BookingDetails'] = $FareDetail;
		$data ['PaxDetails'] = $PaxDetail;
		$data ['refId'] = $refId;
		$data ['isEmail'] = "false" ;
		
		$customer_detail = $this->B2c_flight_Model->get_customerdetail_by_id($BookingDetails->fbook_customer_id);
		$data ['customer_detail'] = $customer_detail ;
		// echo "<pre>";
		// print_r($customer_detail);die;
		
		
		if ($Fld_TicketStatus == "Success") {
			if ($Fld_Type == "Return" && $Fld_IsDomestic == "true") {
				$SelectedFareIB = $this->B2c_flight_Model->get_search_detail($refId, 'ib_ticket');
				$Sel_detailIB = json_decode($SelectedFareIB->ftemp_data);
				$data ['SelectedFareIB'] = $Sel_detailIB;
				$this->load->view('b2c_flight/invoice/return_invoice_dom', $data);
			} else if ($Fld_Type == "Return" && $Fld_IsDomestic == "false") {
				$this->load->view('b2c_flight/invoice/onewayinvoice', $data);
			} else {
				$this->load->view('b2c_flight/invoice/onewayinvoice', $data);
			}
		} else {
			redirect("/b2c_flight/booking_error?sessionid=" . $bookingdata->fbook_sessionid);
		}
	}
	
	public function get_invoice() {
		// $booking_id = 20;
		$refId = $_GET ['ref_id'];
		$encrypted_string = url_encode ( $refId );
		$SelectedFare = $this->B2c_flight_Model->get_search_detail ( $refId, 'ob_ticket' );
		$Sel_detail = json_decode ( $SelectedFare->ftemp_data );
		$BookingDetails = $this->B2c_flight_Model->get_booking_by_id ( $refId );
		$FareDetail = $BookingDetails;
		$PaxDetail = $this->B2c_flight_Model->get_pax_by_id ( $refId );
		$Fld_Type = $FareDetail->fbook_booking_type;
		$Fld_IsDomestic = $FareDetail->fbook_is_domestic;
		$Fld_TicketStatus = $FareDetail->fbook_ob_booking_status;
		$data ['SelectedFare'] = $Sel_detail;
		$data ['BookingDetails'] = $FareDetail;
		$data ['PaxDetails'] = $PaxDetail;
		$data ['refId'] = $refId;
		$data ['isEmail'] = "true";
		$to = $_GET ['mnailiduser'];
		$subject = $_GET ['valuesubj'];
		if ($Fld_TicketStatus == "Success") {
			if ($Fld_Type == "Return" && $Fld_IsDomestic == "true") {
				$SelectedFareIB = $this->B2c_flight_Model->get_search_detail ( $refId, 'ib_ticket' );
				$Sel_detailIB = json_decode ( $SelectedFareIB->ftemp_data );
				$data ['SelectedFareIB'] = $Sel_detailIB;
				$message = $this->load->view ( 'flight/invoice/return_invoice_dom', $data, TRUE );
			} else if ($Fld_Type == "Return" && $Fld_IsDomestic == "false") {
				$message = $this->load->view ( 'flight/invoice/onewayinvoice', $data, TRUE );
			} else {
				$message = $this->load->view ( 'flight/invoice/onewayinvoice', $data, TRUE );
			}
			$dsaemailsetting = $this->B2c_flight_Model->get_mailsetting ( $this->dsa_data->dsa_id );
			if ($dsaemailsetting != "not") {
				$emailconfig = array (
						"smtp_host" => $dsaemailsetting->email_smtp_host,
						"smtp_port" => $dsaemailsetting->email_smtp_port,
						"smtp_username" => $dsaemailsetting->email_smtp_user,
						"smtp_password" => $dsaemailsetting->email_smtp_password,
						"smtp_frommail" => $dsaemailsetting->email_from,
						"smtp_name" => $dsaemailsetting->email_name 
				);
				$mail_id = $to;
				$sender_subject = $subject;
				email_send ( $mail_id, $sender_subject, $message, $emailconfig );
			}
		}
	}
	
	public function update_discount_status() {
		$id = url_decode ( $this->input->get ( "ref_id" ) );
		$data1 = array (
				"dsafdis_status" => $this->input->get ( "status" )
		);
		$this->Common_Model->update_table("dsafdis_id",$id,"dsa_flight_discount",$data1);
		$this->session->set_flashdata ( "alert", array (
				"message" => "Request Successfully Updated",
				"class" => "alert-success"
		) );
		redirect ( "b2c_flight/discount_list" );
	}
	public function delete_discount(){
		$id = url_decode ( $this->input->get ( "ref_id" ) );
		$this->Common_Model->delete_table("dsafdis_id",$id,"dsa_flight_discount");
		$this->session->set_flashdata ( "alert", array (
				"message" => "Discount Deleted Successfully",
				"class" => "alert-success"
		) );
		redirect ( "b2c_flight/discount_list" );
	}
	public function edit_discount(){
			$request_type = $this->input->server ( "REQUEST_METHOD" );
		if ($request_type == "POST") {
			$bp_airline=explode("___",$this->input->post("airline_code"));
			$data1 = array (
					"dsafdis_dsa_id" => $this->dsa_data->dsa_id,
					"dsafdis_status" => "active",
					"dsafdis_airline_type" => $this->input->post("airline_type"),
					"dsafdis_airline_code" => $bp_airline['0'],
					"dsafdis_airline_name" => $bp_airline['1'],
					"dsafdis_on_basic" => $this->input->post("basic"),
					"dsafdis_on_yq" => $this->input->post("yq"),
					"dsafdis_amount_type" => $this->input->post ( "amount_type" ),
					"dsafdis_fix_val" => $this->input->post ( "fix_amount" ),
					"dsafdis_agent_class" => "",
					"dsafdis_module" => "B2C",
			);
			$this->Common_Model->insert_table("dsa_flight_discount",$data1);
			$this->session->set_flashdata ( "alert", array (
					"message" => $this->lang->line ( "successfully_added" ),
					"class" => "alert-success" 
			) );
			redirect ( "b2c_flight/discount_list" );
		} else {
			$activedata = array (
					"activemain" => $this->uri->segment ( "1" ),
					"displayblock" => $this->uri->segment ( "1" ),
					"activeclass" => $this->uri->segment ( "1" ) . "/" . $this->uri->segment ( "2" ) 
			);
			$data ["activedata"] = $activedata;
			$bp_dsa_id = $this->dsa_data->dsa_id;
			$agent_class_list = $this->Common_Model->get_table_result ( "*", "agclali_dsa_id", $bp_dsa_id, "agent_class_list" );
			$data ['agent_class_list'] = $agent_class_list;
			$airline_list = $this->Common_Model->get_full_table ( "airline_list" );
			$data ['airline_list'] = $airline_list;
			$this->load->view ( $this->uri->segment ( "1" )."/edit_discount", $data );
	}
	}
	public function discount_list(){
			$activedata = array (
				"activemain" => $this->uri->segment ( "1" ),
				"displayblock" => $this->uri->segment ( "1" ),
				"activeclass" => $this->uri->segment ( "1" ) . "/" . $this->uri->segment ( "2" ) 
		);
		$data ["activedata"] = $activedata;
		$bp_user_id = $this->dsa_data->dsa_id;
		$table = "dsa_flight_discount";
		$where_1_name = "dsafdis_module";
		$where_1_value = "B2C";
		$where_2_name = "dsafdis_dsa_id";
		$where_2_value = $bp_user_id;
		$order_by = "dsafdis_id";
		$bp_template_name = "discount_list";
		if ($this->uri->segment ( 3 )) {
			$page = $this->uri->segment ( 3 );
		} else {
			$page = 0;
		}
		$this->db->where ( $where_1_name, $where_1_value );
		$this->db->where ( $where_2_name, $where_2_value );
		$total_row = $this->db->from ( $table )->count_all_results ();
		$pagination_segment = 3;
		$per_page = 30;
		$pagination_url = base_url () . $this->uri->segment ( "1" ) . "/" . $this->uri->segment ( "2" );
		$config = bp_pagination ( $pagination_url, 0, $total_row, $per_page );
		$this->pagination->initialize ( $config );
		$result = $this->Common_Model->pagination_table ( $config ["per_page"], $page, $where_1_name, $where_1_value, $where_2_name, $where_2_value, $order_by, $table );
		$data ['result'] = $result;
		$this->load->view ( $this->uri->segment ( "1" ) . "/" . $bp_template_name, $data );
	}
	public function add_discount() {
		$request_type = $this->input->server ( "REQUEST_METHOD" );
		if ($request_type == "POST") {
			$bp_airline=explode("___",$this->input->post("airline_code"));
			$data1 = array (
					"dsafdis_dsa_id" => $this->dsa_data->dsa_id,
					"dsafdis_status" => "active",
					"dsafdis_airline_type" => $this->input->post("airline_type"),
					"dsafdis_airline_code" => $bp_airline['0'],
					"dsafdis_airline_name" => $bp_airline['1'],
					"dsafdis_on_basic" => $this->input->post("basic"),
					"dsafdis_on_yq" => $this->input->post("yq"),
					"dsafdis_amount_type" => $this->input->post ( "amount_type" ),
					"dsafdis_fix_val" => $this->input->post ( "fix_amount" ),
					"dsafdis_agent_class" => "",
					"dsafdis_module" => "B2C",
			);
			$this->Common_Model->insert_table("dsa_flight_discount",$data1);
			$this->session->set_flashdata ( "alert", array (
					"message" => $this->lang->line ( "successfully_added" ),
					"class" => "alert-success" 
			) );
			redirect ( "b2c_flight/discount_list" );
		} else {
			$activedata = array (
					"activemain" => $this->uri->segment ( "1" ),
					"displayblock" => $this->uri->segment ( "1" ),
					"activeclass" => $this->uri->segment ( "1" ) . "/" . $this->uri->segment ( "2" ) 
			);
			$data ["activedata"] = $activedata;
			$airline_list = $this->Common_Model->get_full_table ( "airline_list" );
			$data ['airline_list'] = $airline_list;
			$this->load->view ( $this->uri->segment ( "1" )."/add_discount", $data );
		}
	}

	/* Markup */

	public function delete_b2c_flight_markup() {
		$id = url_decode ( $this->input->get ( "ref_id" ) );
		$data = $this->Common_Model->delete_table ( "dsamark_id", $id, "dsa_markup" );
		$this->session->set_flashdata ( "alert", array (
				"message" => $this->lang->line ( "successfully_deleted" ),
				"class" => "alert-success"
		) );
		redirect ( $this->uri->segment ( "1" )."/b2c_flight_markup_list" );
	}
	
	public function b2c_flight_markup_list(){
		$activedata = array (
				"activemain" => $this->uri->segment ( "1" ),
				"displayblock" => $this->uri->segment ( "1" ),
				"activeclass" => $this->uri->segment ( "1" ) . "/" . $this->uri->segment ( "2" )
		);
		$data ["activedata"] = $activedata;
		$table = "dsa_markup";
		$where_1_name = "dsamark_b2b_b2c";
		$where_1_value = "b2c";
		$where_2_name = "dsamark_user_id";
		$where_2_value = $this->dsa_data->dsa_id;
		$markup=$this->Common_Model->get_table_dsa($where_1_name,$where_1_value,$where_2_name,$where_2_value,$table);
		$data['markup']=$markup;
		$this->load->view ( "b2c_flight_markup_list", $data );
	}
	public function add_b2c_flight_markup(){
		$activedata = array (
				"activemain" => $this->uri->segment ( "1" ),
				"displayblock" => $this->uri->segment ( "1" ),
				"activeclass" => $this->uri->segment ( "1" ) . "/" . $this->uri->segment ( "2" )
		);
		$data ["activedata"] = $activedata;
		$request_type = $this->input->server ( "REQUEST_METHOD" );
		if ($request_type == "POST") {
			$bp_updated_by = $this->dsa_data->dsa_id;
			$bp_airline_name="";
			$bp_airline_code="";
			$bp_airline_data=explode(",",$_POST['airline']);
			if(isset($bp_airline_data['1'])){
				$bp_airline_name=$bp_airline_data['0'];
				$bp_airline_code=$bp_airline_data['1'];
			}
			if($this->input->post ( 'amount_type' )=="percent"){
				if($this->input->post ( 'amount' )>=99){
					$this->session->set_flashdata ( "alert", array (
							"message" => $this->lang->line ( "enter_valid_amount" ),
							"class" => "alert-success"
					) );
					redirect ($this->uri->segment ( "1" )."/add_b2c_flight_markup");
				}
			}
			$data_1 = array (
					'dsamark_markup_type' => $this->input->post ( 'markup_type' ),
					'dsamark_amount_type' => $this->input->post ( 'amount_type' ),
					"dsamark_value" => $this->input->post ( 'amount' ),
					"dsamark_dom_int" => $this->input->post ( 'dom_int' ),
					'dsamark_airline_code' => $bp_airline_code,
					'dsamark_airline_name' => $bp_airline_name,
					'dsamark_user_type' => "DSA",
					'dsamark_b2b_b2c' => "b2c",
					"dsamark_user_id" => $bp_updated_by
			);
			$this->Common_Model->insert_table ( "dsa_markup", $data_1 );
			$this->session->set_flashdata ( "alert", array (
					"message" => $this->lang->line ( "successfully_added" ),
					"class" => "alert-success"
			) );
			redirect ($this->uri->segment ( "1" )."/b2c_flight_markup_list");
		} else {
			$result = $this->Common_Model->all_airline_list();
			$data ['result'] = $result;
			$this->load->view ( $this->uri->segment ( "1" ) . "/add_b2c_flight_markup", $data );
		}
	}

}

