<?php
class B2c_hotel_Model extends CI_Model {
	public function __construct() {
		parent::__construct ();
	}
	function get_dsa_markup($id,$bp_dom_int,$bp_agent_class){
		$this->db->select ( "*" );
		$this->db->from ( 'dsa_markup' );
		$this->db->where ( 'dsamark_user_id', $id );
		$this->db->where ( 'dsamark_ag_type', $bp_agent_class );
		$this->db->where ( 'dsamark_dom_int', $bp_dom_int );
		$this->db->where ( 'dsamark_b2b_b2c', "b2b" );
		$query = $this->db->get ();
		if ($query->num_rows () == '') {
			return '';
		} else {
			return $query->result ();
		}
	}
	function insert_booking($data) {
		$this->db->insert ( 'flight_booking_list', $data );
		$insert_id = $this->db->insert_id ();
		
		return $insert_id;
	}
	function insert_booking_pax_details($data) {
		return $this->db->insert ( 'flight_pax_list', $data );
	}
	function insert_temp($data, $type = NULL) {
		if ($type == "array") {
			$this->db->insert_batch ( 'flight_temp_data', $data );
		} else {
			$this->db->insert ( 'flight_temp_data', $data );
		}
	}
	function get_bookingflight_data($bookingid) {
		$this->db->select ( "*" );
		$this->db->from ( 'flight_booking_list' );
		$this->db->where ( 'fbook_id', $bookingid );
		// $this->db->order_by("fbook_id", $bookingid);
		$query = $this->db->get ();
		if ($query->num_rows () == '') {
			return '';
		} else {
			return $query->row ();
		}
	}
	function update_booking($data, $id) {
		$this->db->where ( 'fbook_id', $id );
		
		$this->db->update ( 'flight_booking_list', $data );
	}
	function get_search_detail($ref_id, $key) {
		$this->db->select ( "*" );
		$this->db->from ( 'flight_temp_data' );
		$this->db->where ( 'ftemp_ref_id', $ref_id );
		$this->db->order_by ( "ftemp_id", "desc" );
		$this->db->where ( 'ftemp_key', $key );
		$query = $this->db->get ();
		if ($query->num_rows () == '') {
			return '';
		} else {
			return $query->row ();
		}
	}
	function get_countries() {
		$this->db->select ( "*" );
		$this->db->from ( 'country_list' );
		$query = $this->db->get ();
		if ($query->num_rows () == '') {
			return '';
		} else {
			return $query->result ();
		}
	}
	function get_mailsetting($userid = NULL) {
		$this->db->select ( "*" );
		$this->db->from ( 'email_setting' );
		$this->db->where ( 'email_user_type', "DSA" );
		$this->db->where ( 'email_user_id', $userid );
		$query = $this->db->get ();
		if ($query->num_rows () == '') {
			return 'not';
		} else {
			return $query->row ();
		}
	}
	function get_booking_by_id($id, $fld = "*") {
		$this->db->select ( $fld );
		$this->db->from ( 'flight_booking_list' );
		$this->db->where ( 'fbook_id', $id );
		$query = $this->db->get ();
		if ($query->num_rows () == '') {
			
			return '';
		} else {
			
			return $query->row ();
		}
	}
	function get_pax_by_id($id) {
		$this->db->select ( '*' );
		
		$this->db->from ( 'flight_pax_list' );
		
		$this->db->where ( 'fpax_booking_id', $id );
		
		$query = $this->db->get ();
		
		if ($query->num_rows () == '') {
			
			return '';
		} else {
			
			return $query->result ();
		}
	}
}