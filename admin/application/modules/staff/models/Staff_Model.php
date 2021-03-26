<?php
class Staff_Model extends CI_Model {
	public function __construct() {
		parent::__construct ();
	}
	public function insert_new_agent($data){
		$this->db->insert("agent",$data);
		return "success";
	}
	public function agent_list($agent_user_type,$agent_user_id){
		$this->db->select("*");
		$this->db->order_by("agent_id","desc");
                $this->db->where("agent_user_type",$agent_user_type);
                $this->db->where("agent_user_id",$agent_user_id);
		$query=$this->db->get("agent");
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return "0";
		}
	}
	function get_agent_by_id($id){
		$this->db->select("*");
		$this->db->where("agent_id",$id);
		$query=$this->db->get("agent");
		if($query->num_rows()>0){
			return $query->row();
		}else{
			return "0";
		}
	}
	function update_agent_date($data,$id){
		$this->db->where("agent_id",$id);
		$this->db->update("agent",$data);
		return "success";
	}
	function insert_balance_log($data){
		$this->db->insert("balance_log",$data);
		return "success";
	}
	function insert_credit_limit_log($data){
		$this->db->insert("credit_limit_log",$data);
		return "success";
	}
	function get_agent_transaction($id,$type){
		$this->db->select("*");
		$this->db->where("balance_log_user_id",$id);
		$this->db->where("balance_log_user_type",$type);
		$this->db->order_by("balance_log_id","desc");
		$query=$this->db->get("balance_log");
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return "0";
		}
	}
	function get_agent_credit_limit_log($id,$type){
		$this->db->select("*");
		$this->db->where("cl_log_user_id",$id);
		$this->db->where("cl_log_user_type",$type);
		$this->db->order_by("cl_log_id","desc");
		$query=$this->db->get("credit_limit_log");
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return "0";
		}
	}
	function deposit_request_list($limit, $offset=NULL) {
		$this->db->limit($limit,$offset);
		$this->db->order_by("bdre_id", "desc");
		$query=$this->db->get('b2b_deposit_request');
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return "not";
		}
	}
	function credit_request_list($limit, $offset=NULL) {
		$this->db->limit($limit,$offset);
		$this->db->order_by("bcre_id", "desc");
		$query=$this->db->get('b2b_credit_request');
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return "not";
		}
	}
	function update_deposite_request ( $data1,$id){
		$this->db->where("bdre_id",$id);
		$this->db->update("b2b_deposit_request",$data1);
		return "success";
	}
	function update_credit_request ( $data1,$id){
		$this->db->where("bcre_id",$id);
		$this->db->update("b2b_credit_request",$data1);
		return "success";
	}
	function delete_agent ($id){
		$this->db->where("agent_id",$id);
		$this->db->delete("agent");
		return "success";
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
