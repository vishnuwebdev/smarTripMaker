<?php
class SiteSettingModel extends CI_Model {
	public function __construct() {
		parent::__construct ();
	}
        
       function do_upload() {
		$this->load->library('upload');
		$config['allowed_types']  = 'jpg|jpeg|gif|png|pdf';
		$config['upload_path']    =  FCPATH . '/assets/img/slider/main';
		$config['max_size']       = '4024';
		$this->upload->initialize($config);
		$this->load->library('upload', $config);
		if($this->upload->do_upload())
		{
			$image_data = $this->upload->data();
			$config = array(
					'source_image' => $image_data['full_path'],
					'new_image' => FCPATH . '/assets/img/slider/thumbs',
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
	
	function upload_logo() {
		$this->load->library('upload');
		$config['allowed_types']  = 'jpg|jpeg|gif|png';
		$config['upload_path']    =  FCPATH . '/assets/img/logos';
		// $config['max_size']       = '4024';
		// $config['max_width']       = 800;
        // $config['max_height']       = 300;
		$this->upload->initialize($config);
		$this->load->library('upload', $config);
		if($this->upload->do_upload())
		{
			return $image_data = $this->upload->data();
		} else {
			print_r ($this->upload->display_errors());
			exit();
		}
	}
	
	
	function update_website_data($data,$id){
		$this->db->where("dsa_id",$id);
		$this->db->update("dsa",$data);
		return "1";
	}
	
	function get_website_by_id($id){
		$this->db->select("*");
		$this->db->where("dsa_id",$id);
		$query=$this->db->get("dsa");
		if($query->num_rows()>0){
			return $query->row();
		}else{
			return "0";
		}
	}
	
	function upload_fevicon() {
		$this->load->library('upload');
		$config['allowed_types']  = 'jpg|jpeg|gif|png';
		$config['upload_path']    =  FCPATH . '/assets/img/fevicon';
		// $config['max_size']       = '4024';
		// $config['max_width']       = 250;
		// $config['max_height']       = 250;
		$this->upload->initialize($config);
		$this->load->library('upload', $config);
		if($this->upload->do_upload())
		{
			return $image_data = $this->upload->data();
		} else {
			print_r ($this->upload->display_errors());
			exit();
		}
	}
        
        public function get_slider_images($where = NULL){
               $this->db->where($where);
		
		$query=$this->db->get('slider_image');
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return "not";
		}
        }
        
        function update_sliderimg_status($data,$id){
		$this->db->where("sliimg_id",$id);
		$this->db->update("slider_image",$data);
		return "success";
	}
        function deleteSliderImage($id){
		$this->db->where('sliimg_id', $id);
		$this->db->delete('slider_image');
		return 1;
	}
	
	public function get_prom_text($where = NULL){
		$this->db->where($where);
		$query=$this->db->get('promotion_text');
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return "not";
		}
	}
	
	function deleteSliderofferImage($id){
		$this->db->where('hos_id', $id);
		$this->db->delete('home_offer_slider');
		return 1;
	}
	
		function do_upload_offer() {
		$this->load->library('upload');
		$config['allowed_types']  = 'jpg|jpeg|gif|png|pdf';
		$config['upload_path']    =  FCPATH . '/assets/img/offer/main';
		$config['max_size']       = '4024';
		$this->upload->initialize($config);
		$this->load->library('upload', $config);
		if($this->upload->do_upload())
		{
			$image_data = $this->upload->data();
			$config = array(
					'source_image' => $image_data['full_path'],
					'new_image' => FCPATH . '/assets/img/offer/thumbs',
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
	
	
	public function get_offer_images(){
        
		$query=$this->db->get('home_offer_slider');
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return "not";
		}
    }	
	
}