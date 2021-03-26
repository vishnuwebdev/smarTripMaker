<?php
class Query_Model extends CI_Model {
	public function __construct() {
		parent::__construct ();
	}
	public function query_list($user_type,$user_id){
		$this->db->select("*");
		$this->db->order_by("com_id","desc");
                $this->db->where("com_user_type",$user_type);
                $this->db->where("com_user_id",$user_id);
		$query=$this->db->get("common_queries");
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return "0";
		}
	}


	public function get_query($id){
		$this->db->select("*");
		$this->db->where("com_id",$id);
        $query=$this->db->get("common_queries");
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return "0";
		}
	}


	
		public function job_request_list(){
			$this->db->select("*");
			$query=$this->db->get("job_request");
			if($query->num_rows()>0){
				return $query->result();
			}else{
				return "0";
			}
		}
	
    function update_query_data($data,$id){
		$this->db->where("com_id",$id);
		$this->db->update("common_queries",$data);
		return "success";
	}
        function delete_query ($id){
		$this->db->where("com_id",$id);
		$this->db->delete("common_queries");
		return "success";
	}
	
}