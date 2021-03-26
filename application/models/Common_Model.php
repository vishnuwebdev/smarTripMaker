<?php
class Common_Model extends CI_Model {
	public function __construct() {
		parent::__construct ();
	}
	function update_table($where,$where_val,$table,$data) {
		$this->db->where ( $where, $where_val );
		$this->db->update ( $table, $data );
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


	function get_table_order($select,$where,$where_val,$table){

		$this->db->select($select);
		$this->db->where($where,$where_val);
		$this->db->order_by("created", "DESC");
		$query = $this->db->get($table);
		if($query->num_rows() > 0){
			return $query->row();
		}
		else{
			return "0";
		}
	}


	function get_all_record_where($select,$where,$table) {
		// $this->db->select($select);
		// $this->db->from($table);
		// $this->db->where($where, $where_val);
		// $query = $this->db->get();        
		// return $query->result();
		// OR

		$this->db->select($select);
		$this->db->where($where);
		$this->db->from($table);
		$query = $this->db->get();        
		return $query->result();
	}

	// function get_all_recods($select,$where,$table){

	// 	$this->db->select($select);
	// 	$this->db->where($where);
	// 	$this->db->from($table);
	// 	$query = $this->db->get();        
	// 	return $query->result();
	// }


	function delete_table($where,$where_val,$table)
	{
		$this->db->where($where,$where_val);
		$this->db->delete($table);
		return $data="true";
		 
	}


	function get_table_with_where_orderASC($type,$type_val,$user_id,$id,$table,$order){
		$this->db->select("*");
		$this->db->where($type,$type_val);
		$this->db->where($user_id,$id);
		$this->db->order_by($order, "asc");
		$query = $this->db->get($table);
		if($query->num_rows() > 0){
			return $query->row();
		}
		else{
			return "0";
		}
	}



	function pagination_table_dmt($limit, $offset=NULL,$where_1_name,$where_1_value,$where_2_name,$where_2_value,$order_by,$table) {
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
	
function get_table_with_where($type,$type_val,$user_id,$id,$table){
		$this->db->select("*");
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

	function pagination_table($limit, $offset = NULL, $where_1_name, $where_1_value, $order_by, $table, $extrawhere = NULL) {
		if ($extrawhere != NULL) {
			
			$this->db->where ( $extrawhere );
		}
		
		$this->db->where ( $where_1_name, $where_1_value );
		
		$this->db->limit ( $limit, $offset );
		$this->db->order_by ( $order_by, "desc" );
		$query = $this->db->get ( $table );
		// print_r($this->db->last_query());
		// die;
		if ($query->num_rows () > 0) {
			return $query->result ();
		} else {
			return "0";
		}
	}
	
	function get_table_setting($select, $where, $table) {
		$this->db->select ( $select );
		$this->db->where ( $where );
		$query = $this->db->get ( $table );
		if ($query->num_rows () > 0) {
			return $query->row ();
		} else {
			return "0";
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

	function insert_table($table,$data){
		$this->db->insert($table,$data);
	}

	
	function get_sub_categories_menu($wahere, $tablename = null) {
		$this->db->select ( "*" );
		$this->db->where ( $wahere );
		//$this->db->order_by("holsubc_order", "asc");
		$query = $this->db->get ( $tablename );
		if ($query->num_rows () > 0) {
			return $query->result ();
		} else {
			return "not";
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

	function pagination_ak_where($limit, $offset=NULL,$where = null,$order_by,$list_ids,$table) {
		$this->db->where_in('reculst_customer_id',$list_ids);
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
    function get_ccavenue_data($table,$id){
        $this->db->select("*");
        $this->db->where('id', $id);
        $query = $this->db->get($table);
        $row = $query->result();
        if (!empty($row)) {
            return $row[0];
        }
        else{
            return false;
        }
    }
	
}
