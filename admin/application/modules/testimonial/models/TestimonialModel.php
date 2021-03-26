<?php
class TestimonialModel extends CI_Model {
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
        
        function testimonial_list($limit, $offset=NULL,$bp_user_id) {
		$this->db->where("testimo_user_type","DSA");
		$this->db->where("testimo_user_id",$bp_user_id);
		$this->db->limit($limit,$offset);
		$this->db->order_by("testimo_id", "desc");
		$query=$this->db->get('testimonial');
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return "0";
		}
	}
        
        function get_testimo_by_id($id){
		$this->db->select("*");
		$this->db->where("testimo_id",$id);
		$query=$this->db->get("testimonial");
		if($query->num_rows()>0){
			return $query->row();
		}else{
			return "0";
		}
	}
	
        function update_testimo_data($table,$data,$id){
		$this->db->where("testimo_id",$id);
		$this->db->update($table,$data);
		return "success";
	}
        
        function update_menu_page_data($table,$data,$id){
		$this->db->where("menupage_id",$id);
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