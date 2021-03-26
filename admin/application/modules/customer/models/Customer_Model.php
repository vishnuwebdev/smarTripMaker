<?php
class Customer_Model extends CI_Model {
	public function __construct() {
		parent::__construct ();
	}
	function insert_new_customer($data){
		$this->db->insert("customer",$data);
		return "success";
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
        function update_customer_data($data,$id){
		$this->db->where("cust_id",$id);
		$this->db->update("customer",$data);
		return "success";
	}
        function delete_customer ($id){
		$this->db->where("cust_id",$id);
		$this->db->delete("customer");
		return "success";
	}
	
	// Added new code
	
	 function get_customer_by_id($id){
		$this->db->select("*");
		$this->db->where("cust_id",$id);
		$query=$this->db->get("customer");
		if($query->num_rows()>0){
			return $query->row();
		}else{
			return "0";
		}
	}
	function insert_balance_log($data){
		$this->db->insert("balance_log",$data);
		return "success";
	}
	
	function update_customer_date($data,$id){
		$this->db->where("cust_id",$id);
		$this->db->update("customer",$data);
		return "success";
	}
	
	function get_customer_transaction($id){
		$this->db->select("*");
		$this->db->where("balance_log_user_id",$id);
		$this->db->where("balance_log_user_type","customer");
		$this->db->order_by("balance_log_id","desc");
		$query=$this->db->get("balance_log");
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return "0";
		}
	}
	
	
	
}