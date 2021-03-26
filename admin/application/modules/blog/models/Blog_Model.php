<?php
class Blog_Model extends CI_Model {
	public function __construct() {
		parent::__construct ();
	}
	function do_upload() {
		$this->load->library('upload');
		$config['allowed_types']  = 'jpg|jpeg|gif|png|pdf';
		$config['upload_path']    =  FCPATH . '/assets/img/blog';
		$config['max_size']       = '4024';
		$this->upload->initialize($config);
		$this->load->library('upload', $config);
		if($this->upload->do_upload())
		{
			 $image_data = $this->upload->data();
			$config = array(
					'source_image' => $image_data['full_path'],
					'new_image' => FCPATH . '/assets/img/blog/thumbs',
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
		$this->db->insert("blog_category",$data);
		return "success";
	}
	function blog_category_list($limit, $offset=NULL,$bp_user_id) {
		$this->db->where("bc_user_type","DSA");
		$this->db->where("bc_user_id",$bp_user_id);
		$this->db->limit($limit,$offset);
		$this->db->order_by("bc_id", "desc");
		$query=$this->db->get('blog_category');
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return "0";
		}
	}
	function update_category_date($data,$id){
		$this->db->where("bc_id",$id);
		$this->db->update("blog_category",$data);
		return "success";
	}
	
	function delete($id){
		$this->db->where('bc_id', $id);
		$this->db->delete('blog_category');
		return 1;
	}
	
	function get_cat_by_id($id){
		$this->db->select("*");
		$this->db->where("bc_id",$id);
		$query=$this->db->get("blog_category");
		if($query->num_rows()>0){
			return $query->row();
		}else{
			return "0";
		}
	}
	
	function getAllCategory($dsa_id){
		$this->db->select("*");
		$this->db->where("bc_status","active");
		$this->db->where("bc_user_id",$dsa_id);
		$this->db->where("bc_user_type","DSA");
		$query=$this->db->get("blog_category");
	if($query->num_rows()>0){
			return $query->result();
		}else{
			return "0";
		} 
	}
	
	function insert_blog_post($data){
		$this->db->insert("blog_list",$data);
		return "success";
	}
	
	function getAllBlogPosts($dsa_id){
		$this->db->select("*");
		$this->db->where("blog_list.b_user_id",$dsa_id);
		$this->db->where("blog_list.b_user_type","DSA");
		$this->db->join('blog_category', 'blog_category.bc_id = blog_list.b_category');
		$query=$this->db->get("blog_list");
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return "0";
		}
	}
	
	function update_blog_date($data,$id){
		$this->db->where("b_id",$id);
		$this->db->update("blog_list",$data);
		return "success";
	}
	
	function deleteBlog($id){
		$this->db->where('b_id', $id);
		$this->db->delete('blog_list');
		return 1;
	}
	
	function get_blog_by_id($id){
		$this->db->select("*");
		$this->db->where("b_id",$id);
		$query=$this->db->get("blog_list");
		if($query->num_rows()>0){
			return $query->row();
		}else{
			return "0";
		}
	}
	
	
}