<?php
class VisaModel extends CI_Model {
	public function __construct() {
		parent::__construct ();
	}
        
    function insert_data($table,$data){
		$this->db->insert($table,$data);
		return "success";
	}
        
    function insert_data_visa($table,$data){
		$insertid = $this->db->insert($table,$data);
		return $insert_id = $this->db->insert_id();;
	}
        
	function visa_list($limit, $offset=NULL,$bp_user_id) {
		$this->db->select('visa_list.id, visa_list.visa_title, visa_list.visa_amount, visa_list.visa_status, location.location_location');
		$this->db->from('visa_list');
        $this->db->join('location', 'visa_list.country_id = location.location_id');
		$this->db->limit($limit,$offset);
		$this->db->order_by("visa_list.id", "desc");
		$query = $this->db->get();
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return "0";
		}
	}
        
    function get_visa_by_id($id){
		$this->db->select("*");
		$this->db->where("id",$id);
		$query = $this->db->get("visa_list");
		if($query->num_rows()>0){
			return $query->row();
		}else{
			return "0";
		}
	}
	
	function select_info($table_name,$cond = array(),$orderby = array()){
		$this->db->select('*');
		$this->db->from($table_name);
		if(!empty($cond)){ foreach ($cond as $key => $value)$this->db->where($key,$value); }
		if(!empty($orderby)){ foreach ($orderby as $key => $value)$this->db->order_by($key,$value); }
		$query = $this->db->get();
		return ($query->num_rows() > 0)?$query->result_array():FALSE;
	}
	
    function update_visa_data($table,$data,$id){
		$this->db->where("id",$id);
		$this->db->update($table,$data);
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
	
}