<?php

class OnlineModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_page_data($slug = NULL, $dsaid = NULL, $dsatype = NULL, $language = NULL) {

        $this->db->select("*");
        $this->db->from('pages');
        $this->db->where('page_user_id', $dsaid);
        $this->db->where('page_user_type', $dsatype);
        $this->db->where('page_slug', $slug);
        $this->db->where('page_language', $language);
        $query = $this->db->get();
        if ($query->num_rows() == '') {

            return '0';
        } else {

            return $query->row();
        }
    }
	
	function do_upload_images() {
		$this->load->library('upload');
		$config['allowed_types']  = 'pdf';
		$config['upload_path']    =  FCPATH . '/assets/resume';
		$config['max_size']       = '4024';
		$this->upload->initialize($config);
		$this->load->library('upload', $config);
		if($this->upload->do_upload())
		{
			$image_data = $this->upload->data();
			return $image_data;
		} else {
			print_r ($this->upload->display_errors());
			exit();
		}
	}
}
