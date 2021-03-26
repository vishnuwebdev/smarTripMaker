<?php
class B2c_visa_Model extends CI_Model {
	public function __construct() {
		parent::__construct ();
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
	
	//GET CUSTOMER DETAIL
	function get_customerdetail_by_id($id) {	
		$this->db->from ( 'customer' );
		$this->db->where ( 'cust_id', $id );
		$query = $this->db->get ();
		if ($query->num_rows () == '') {
			return '';
		} else {
			return $query->row ();
		}
	}
	
}