<?php
class Email_Model extends CI_Model {
	public function __construct() {
		parent::__construct ();
	}
	
		function get_sender_id($id){
		$this->db->select ( "*" );
		$this->db->from ( 'email_sender_id' );
		$this->db->where ( 'ssid_user_id', $id );
		$query = $this->db->get ();
		if ($query->num_rows () == '') {
			return '';
		} else {
			return $query->result ();
		}
	}
	
	function insert_email_log($data) {
		$this->db->insert ( 'email_log', $data );
		$insert_id = $this->db->insert_id ();
		return $insert_id;
	}

	function get_agent($type){
		$this->db->select("*");
		$this->db->where("agent_status","active");
		$query = $this->db->get("agent");
		if($query->num_rows() > 0){
			return $query->result();
		}
		else{
			return "0";
		}
	}
	
	function get_agent_selected(){
		$this->db->select("agent_email");
		$this->db->where("agent_status","active");
		$query = $this->db->get("agent");
		if($query->num_rows() > 0){
			return $query->result();
		}
		else{
			return "0";
		}
	}
	
	
	function get_agent_by_class($class){
		$this->db->select("agent_email,agent_class,agent_contact_person");
		$this->db->where("agent_class",$class);
		$this->db->where("agent_status","active");
		$query = $this->db->get("agent");
		if($query->num_rows() > 0){
			return $query->result();
		}
		else{
			return "0";
		}
	}

	
	public function customer_list($user_type,$user_id){
		$this->db->select("*");
		$this->db->order_by("cust_id","desc");
                $this->db->where("cust_user_type",$user_type);
                $this->db->where("cust_user_id",$user_id);
		$query=$this->db->get("customer");
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return "0";
		}
	}
	
	public function selected_customer_list($user_type,$user_id){
		$this->db->select("cust_email");
		$this->db->order_by("cust_id","desc");
                $this->db->where("cust_user_type",$user_type);
                $this->db->where("cust_user_id",$user_id);
		$query=$this->db->get("customer");
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return "0";
		}
	}
	
	 function get_mailsetting($userid=NULL){
			
			$this->db->select("*");
			$this->db->from('email_setting');
            $this->db->where('email_user_type',"DSA");
            $this->db->where('email_user_id',$userid);
			$query = $this->db->get();
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->row();
			}
		}
	
}
