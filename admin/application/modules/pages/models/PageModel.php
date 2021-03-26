<?php
class PageModel extends CI_Model {
	public function __construct() {
		parent::__construct ();
	}
	
        function do_upload() {
		$this->load->library('upload');
		$config['allowed_types']  = 'jpg|jpeg|gif|png|pdf';
		$config['upload_path']    =  FCPATH . '/assets/img/pages';
		$config['max_size']       = '4024';
		$this->upload->initialize($config);
		$this->load->library('upload', $config);
		if($this->upload->do_upload())
		{
			 $image_data = $this->upload->data();
			$config = array(
					'source_image' => $image_data['full_path'],
					'new_image' => FCPATH . '/assets/img/pages/thumbs',
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
        
        function insert_page_data($data){
		$this->db->insert("pages",$data);
		return "success";
	}
        
        
        function getAllpages($dsa_id){
		$this->db->select("*");
		$this->db->where("page_user_id",$dsa_id);
		$this->db->where("page_user_type","DSA");
		
		$query=$this->db->get("pages");
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return "0";
		}
	}
        
        function update_page_date($data,$id){
		$this->db->where("page_id",$id);
		$this->db->update("pages",$data);
		return "success";
	}
        
        function deletePage($id){
		$this->db->where('page_id', $id);
		$this->db->delete('pages');
		return 1;
	}
        
        function get_page_by_id($id){
		$this->db->select("*");
		$this->db->where("page_id",$id);
		$query=$this->db->get("pages");
		if($query->num_rows()>0){
			return $query->row();
		}else{
			return "0";
		}
	}
	
}