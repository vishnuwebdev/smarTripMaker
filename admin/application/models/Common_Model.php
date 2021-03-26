<?php
class Common_Model extends CI_Model {
	public function __construct() {
		parent::__construct ();
	}
	function get_table_with_where_with_select($select,$type,$type_val,$user_id,$id,$table){
		$this->db->select($select);
		$this->db->where($type,$type_val);
		$this->db->where($user_id,$id);
		$query = $this->db->get($table);
		if($query->num_rows() > 0){
			return $query->row();
		}
		else{
			return "0";
		}
	}
	
	function update_table($where,$where_val,$table,$data) {
		$this->db->where ( $where, $where_val );
		$this->db->update ( $table, $data );
		return "success";
	}
	function get_table($select,$where,$where_val,$table){
		$this->db->select($select);
		$this->db->where($where,$where_val);
		$query = $this->db->get($table);
		if($query->num_rows() > 0){
			return $query->row();
		}
		else{
			return "0";
		}
	}
	function get_table_result($select,$where,$where_val,$table){
		$this->db->select($select);
		$this->db->where($where,$where_val);
		$query = $this->db->get($table);
		if($query->num_rows() > 0){
			return $query->result();
		}
		else{
			return "0";
		}
	}
	function get_table_result2($select,$where,$where_val,$where1,$where_val1,$table){
		$this->db->select($select);
		$this->db->where($where,$where_val);
		$this->db->where($where1,$where_val1);
		$query = $this->db->get($table);
		if($query->num_rows() > 0){
			return $query->row();
		}
		else{
			return "0";
		}
	}
	function get_table_dsa($type,$type_val,$user_id,$id,$table){
		$this->db->select("*");
		$this->db->where($type,$type_val);
		$this->db->where($user_id,$id);
		$query = $this->db->get($table);
		if($query->num_rows() > 0){
			return $query->result();
		}
		else{
			return "0";
		}
	}
	function update_table_dsa($where_1_name,$where_1_value,$where_2_name,$where_2_value,$where_3_name,$where_3_value,$table,$data){
		$this->db->where($where_1_name,$where_1_value);
		$this->db->where($where_2_name,$where_2_value);
		$this->db->where($where_3_name,$where_3_value);
		$this->db->update($table,$data);
		return "success";
	}
	function get_table_dsa_short($type,$type_val,$user_id,$id,$short_by,$table){
		$this->db->select("*");
		$this->db->order_by($short_by, "desc");
		$this->db->where($type,$type_val);
		$this->db->where($user_id,$id);
		$query = $this->db->get($table);
		if($query->num_rows() > 0){
			return $query->result();
		}
		else{
			return "0";
		}
	}
	function delete_table($where,$where_val,$table)
	{
		$this->db->where($where,$where_val);
		$this->db->delete($table);
		return $data="true";
		 
	}
	function get_full_table($table){
		$this->db->select("*");
		$query = $this->db->get($table);
		if($query->num_rows() > 0){
			return $query->result();
		}
		else{
			return "0";
		}
	}
	function insert_common_data($data){
		$this->db->insert("common_data",$data);
	}
	function insert_table($table,$data){
		$this->db->insert($table,$data);
	}
	function common_data($id){
		$this->db->select("*");
		$this->db->where("cd_name",$id);
		$query=$this->db->get("common_data");
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return "0";
		}
	}
	function update_common_data($data,$id){
		$this->db->where("cd_name",$id);
		$this->db->update("common_data",$data);
	}
	function pagination_table($limit, $offset=NULL,$where_1_name,$where_1_value,$where_2_name,$where_2_value,$order_by,$table) {
		$this->db->where($where_1_name,$where_1_value);
		$this->db->where($where_2_name,$where_2_value);
		$this->db->limit($limit,$offset);
		$this->db->order_by($order_by, "desc");
		$query=$this->db->get($table);
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return "0";
		}
	}
	function get_full_table_by_dsa($select,$where,$where_val,$table){
		$this->db->select($select);
		$this->db->where($where,$where_val);
		$query = $this->db->get($table);
		if($query->num_rows() > 0){
			return $query->result();
		}
		else{
			return "0";
		}
	}
    function all_airline_list(){
		$this->db->select("*");
		$this->db->order_by("airline_id","desc");
		$query=$this->db->get("airline_list");
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return "0";
		}
	}
    
    function count_table($select,$where,$table){
            $this->db->select($select);
		$this->db->where($where);
		$query = $this->db->get($table);
		return $query->num_rows();
        }
    
    function get_table_setting($select,$where,$table){
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

	function pagination_nk($limit, $offset=NULL,$where = null,$order_by,$table) {
		$this->db->where($where);
		$this->db->limit($limit,$offset);
		$this->db->order_by($order_by, "desc");
		$query=$this->db->get($table);
		if($query->num_rows()>0){
			return $query->result();
		}else{
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
	
	function visa_table($limit, $offset=NULL,$order_by,$table) {
		$where = "request_visa_id > 0 and userId is NOT NULL";
		$this->db->where($where);
		$this->db->limit($limit,$offset);
		$this->db->order_by($order_by, "desc");
		$query=$this->db->get($table);
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return "0";
		}
	}
}
