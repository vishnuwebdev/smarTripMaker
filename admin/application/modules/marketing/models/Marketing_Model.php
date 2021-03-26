<?php
class Marketing_Model extends CI_Model {
	public function __construct() {
		parent::__construct ();
	}
	public function newsletter_list($user_type,$user_id){
		$this->db->select("*");
		$this->db->order_by("newl_id","desc");
                $this->db->where("newl_user_type",$user_type);
                $this->db->where("newl_user_id",$user_id);
		$query=$this->db->get("newsletter");
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return "0";
		}
	}
        function update_newsletter_data($data,$id){
		$this->db->where("newl_id",$id);
		$this->db->update("newsletter",$data);
		return "success";
	}
        function delete_query ($id){
		$this->db->where("com_id",$id);
		$this->db->delete("common_queries");
		return "success";
	}
	
}