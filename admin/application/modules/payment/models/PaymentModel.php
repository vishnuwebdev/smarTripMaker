<?php
class PaymentModel extends CI_Model {
	public function __construct() {
		parent::__construct ();
	}
        
        function insert_data($table,$data){
		$this->db->insert($table,$data);
		return "success";
	}
        
        function insert_data_menu($table,$data){
		$insertid = $this->db->insert($table,$data);
		return $insert_id = $this->db->insert_id();;
	}
        
        function card_list($limit, $offset=NULL,$bp_user_id) {
		$this->db->where("crecard_user_type","DSA");
		$this->db->where("crecard_user_id",$bp_user_id);
		$this->db->limit($limit,$offset);
		$this->db->order_by("crecard_id", "desc");
		$query=$this->db->get('credit_card');
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return "0";
		}
	}
        
           function getway_list($limit, $offset=NULL,$bp_user_id) {
		$this->db->where("dsapayg_user_type","DSA");
		$this->db->where("dsapayg_user_id",$bp_user_id);
		$this->db->limit($limit,$offset);
		$this->db->order_by("dsapayg_id", "desc");
		$query=$this->db->get('dsa_payment_gateway');
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return "0";
		}
	}
        
          function bankdetail_list($limit, $offset=NULL,$bp_user_id) {
		$this->db->where("dsabank_user_type","DSA");
		$this->db->where("dsabank_user_id",$bp_user_id);
		$this->db->limit($limit,$offset);
		$this->db->order_by("dsabank_id", "desc");
		$query=$this->db->get('dsa_bank_detail');
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return "0";
		}
	}
        
        function get_card_by_id($id){
		$this->db->select("*");
		$this->db->where("crecard_id",$id);
		$query=$this->db->get("credit_card");
		if($query->num_rows()>0){
			return $query->row();
		}else{
			return "0";
		}
	}
	
        function update_card_data($table,$data,$id){
		$this->db->where("crecard_id",$id);
		 $this->db->update($table,$data);
                
               // print_r($this->db->update($table,$data));
               //  die;
                
		return "success";
	}
        
        
       
        
        function delete($table,$where){
		$this->db->where($where);
		$this->db->delete($table);
		return 1;
	}
        function get_table_result($select,$where,$table){
		$this->db->select($select);
		$this->db->where($where);
		$query = $this->db->get($table);
		if($query->num_rows() > 0){
			return $query->result();
		}
		else{
			return "0";
		}
	}
          function get_table_row($select,$where,$table){
		$this->db->select($select);
		$this->db->where($where);
		$query = $this->db->get($table);
		if($query->num_rows() > 0){
			return $query->row();
		}
		else{
			return "0";
		}
	}
        
         function get_getway_by_id($id){
		$this->db->select("*");
		$this->db->where("dsapayg_id",$id);
		$query=$this->db->get("dsa_payment_gateway");
		if($query->num_rows()>0){
			return $query->row();
		}else{
			return "0";
		}
	}
        
            function update_getway_data($table,$data,$id){
		$this->db->where("dsapayg_id",$id);
		 $this->db->update($table,$data);
                
               // print_r($this->db->update($table,$data));
               //  die;
                
		return "success";
	}
        
        function update_data($table,$data,$where){
		$this->db->where($where);
		 $this->db->update($table,$data);
                
               // print_r($this->db->update($table,$data));
               //  die;
                
		return "success";
	}
        
        function get_row_by_id($where,$table){
		$this->db->select("*");
		$this->db->where($where);
		$query=$this->db->get($table);
		if($query->num_rows()>0){
			return $query->row();
		}else{
			return "0";
		}
	}
	
}