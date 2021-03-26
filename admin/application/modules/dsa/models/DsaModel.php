<?php
class DsaModel extends CI_Model {
	public function __construct() {
		parent::__construct ();
	}
	function super_admin_login($id, $password) {
		$this->db->where ( 'dsa_id', $id );
		$this->db->where ( 'dsa_password', $password );
		$query = $this->db->get ( 'dsa' );
		if ($query->num_rows () == 1) {
			return $query->row ();
		} else {
			return "not";
		}
	}
	function login($mail, $password) {
		$this->db->where ( 'dsa_email', $mail );
		$this->db->where ( 'dsa_password', $password );
                $this->db->where("dsa_id",$this->dsa_data->dsa_id);
		$query = $this->db->get ( 'dsa' );
		if ($query->num_rows () == 1) {
			return $query->row ();
		} else {
			return false;
		}
	}
        function dsa_data_by_id($dasid) {
		$this->db->where ( 'dsa_id', $dasid );
		$query = $this->db->get ( 'dsa' );
		if ($query->num_rows () == 1) {
			return $query->row ();
		} else {
			return false;
		}
	}
        
        function staff_login($mail, $password) {
		$this->db->where ( 'dsast_email', $mail );
		$this->db->where ( 'dsast_password', $password );
		$query = $this->db->get ( 'dsa_staff' );
		if ($query->num_rows () == 1) {
			return $query->row ();
		} else {
			return false;
		}
	}
        
	function update_last_login() {
		$data = array (
				'dsa_last_login' => date ( 'Y-m-d H:i:s' )
		);
		$this->db->where ( 'dsa_id', $this->session->userdata ( 'Dsalogin' )->dsa_id );
		$this->db->update ( 'dsa', $data );
	}
	function update_last_ip() {
		$data = array (
				'dsa_last_login_ip' => $this->input->ip_address ()
		);
		$this->db->where ( 'dsa_id', $this->session->userdata ( 'Dsalogin' )->dsa_id );
		$this->db->update ( 'dsa', $data );
	}
	function fetch_admin_data_by_number($number){
		$this->db->where ( 'dsa_mobile', $number );
		$query = $this->db->get ( 'dsa' );
		if ($query->num_rows () == 1) {
			return $query->row ();
		} else {
			return "not";
		}
	}
	function insert_sms_log($data){
		$this->db->insert("sms_log",$data);
	}
	function insert_login_log($data){
		$this->db->insert("login_log",$data);
	}
	
	function checkPassword($dsa_id){
		$this->db->where ( 'dsa_id', $dsa_id );
		$query = $this->db->get ( 'dsa' );
		if ($query->num_rows () == 1) {
			if ($query->row()->dsa_password != ""){
			return $query->row()->dsa_password;
			}else{
				return "";
			}
		} else {
			return false;
		}
	}
	
	function update_password($newpassword) {
		$data = array (
				'dsa_password' => $newpassword
		);
		$this->db->where ( 'dsa_id', $this->session->userdata ( 'Dsalogin' )->dsa_id );
		$this->db->update ( 'dsa', $data );
		return true;
	}
	
}