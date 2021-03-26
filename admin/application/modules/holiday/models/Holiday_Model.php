<?php
class Holiday_Model extends CI_Model {
	public function __construct() {
		parent::__construct ();
	}
	function do_upload() {
		$this->load->library('upload');
		$config['allowed_types']  = 'jpg|jpeg|gif|png|pdf';
		$config['upload_path']    =  FCPATH . '/assets/img/holiday/main';
		$config['max_size']       = '4024';
		$this->upload->initialize($config);
		$this->load->library('upload', $config);
		if($this->upload->do_upload())
		{
			$image_data = $this->upload->data();
			$config = array(
					'source_image' => $image_data['full_path'],
					'new_image' => FCPATH . '/assets/img/holiday/thumbs',
					'maintain_ration' => true,
					'width' => 200,
					'height' => 200
			);
				
			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
			$image_data = $this->upload->data();
	
			return $image_data;
				
		} else {
			print_r ($this->upload->display_errors());
			exit();
		}
	}
	function insert_blog_category($data){
		$this->db->insert("holiday_category",$data);
		return "success";
	}
	function blog_category_list($limit, $offset=NULL,$bp_user_id) {
		$this->db->where("bc_user_type","DSA");
		$this->db->where("bc_user_id",$bp_user_id);
		$this->db->limit($limit,$offset);
		$this->db->order_by("holcat_id", "desc");
		$query=$this->db->get('holiday_category');
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return "0";
		}
	}
	function hotel_setting_list ( $user_type, $user_id,$hotel_set_type ){
		$this->db->where("hohex_user_type",$user_type);
		$this->db->where("hohex_user_id",$user_id);
		$this->db->where("hohex_type",$hotel_set_type);
		$this->db->order_by("hohex_id", "desc");
		$query=$this->db->get('holiday_hotel_extra');
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return "not";
		}
	}

	public function query_list($user_type,$user_id){
		$this->db->select("*");
		$this->db->order_by("com_id","desc");
		$this->db->where("com_user_type",$user_type);
		$this->db->where("com_user_id",$user_id);
		$this->db->where("com_query_type","package");
		$this->db->from("common_queries");
		$this->db->join('holiday', 'common_queries.com_reff = holiday.holiday_id');
		$query=$this->db->get();
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