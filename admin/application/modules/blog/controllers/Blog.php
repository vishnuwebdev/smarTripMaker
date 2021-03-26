<?php
class Blog extends MX_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->Model ( 'Blog_Model' );
	}
	public function index() {
		$activedata = array (
				"displayblock" => "",
				"activeclass" => "",
				"activemain" => "dashboard" 
		);
		$data ["activedata"] = $activedata;
		$this->load->view ( "dashboard/index", $data );
	}
	public function add_blog_category() {
		$activedata = array (
				"activemain" => "blog",
				"displayblock" => "blog",
				"activeclass" => "add_blog_category" 
		);
		$data ["activedata"] = $activedata;
		$request_type = $this->input->server ( "REQUEST_METHOD" );
		if ($request_type == "POST") {
			$this->form_validation->set_rules('category_name', 'Category Name', 'required');
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view ( "blog/add_blog_category", $data );
			}else{
			$bp_updated_by = $this->dsa_data->dsa_id;
			if($_FILES['userfile']['error']>0){
				$bp_image_name="";
			}else{
				$image_data1=$this->Blog_Model->do_upload();
				$bp_image_name=$image_data1 ['file_name'];
			}
			$data = array (
					'bc_status' => $this->input->post ( 'status' ),
					'bc_name' => $this->input->post ( 'category_name' ),
					"bc_slug" => $this->input->post ( 'slug' ),
					'bc_tags' => $this->input->post ( 'tag' ),
					"bc_meta_title" => $this->input->post ( 'meta_title' ),
					'bc_meta_description' => $this->input->post ( 'meta_description' ),
					"bc_keyword" => $this->input->post ( 'meta_keyword' ),
					"bc_language" => $this->input->post ( 'language' ),
					'bc_image' => $bp_image_name,
					"bc_insert_by" => $bp_updated_by.', admin',
					'bc_user_type' => "DSA",
					"bc_user_id" => $bp_updated_by 
			);
			$this->Blog_Model->insert_blog_category ( $data );
			$this->session->set_flashdata ( "alert", array (
					"message" => "Blog Category  Successfully Added",
					"class" => "alert-success" 
			) );
			redirect ("blog/blog_category_list");
			}
		}else{
		$this->load->view ( "blog/add_blog_category", $data );
		}
	}
	public function blog_category_list(){
		$activedata = array (
				"activemain" => "blog",
				"displayblock" => "blog",
				"activeclass" => "blog_category_list"
		);
		$data ["activedata"] = $activedata;
		if ($this->uri->segment ( 3 )) {
			$page = $this->uri->segment ( 3 );
		} else {
			$page = 0;
		}
		$bp_user_id=$this->dsa_data->dsa_id;
		$this->db->where("bc_user_type","DSA");
		$this->db->where("bc_user_id",$bp_user_id);
		$total_row = $this->db->from ( "blog_category" )->count_all_results ();
		$pagination_segment = 3;
		$per_page = 10;
		$pagination_url = base_url () . "blog/blog_category_list/";
		$config = bp_pagination ( $pagination_url, 0, $total_row, $per_page );
		$this->pagination->initialize ( $config );
		$result = $this->Blog_Model->blog_category_list ( $config ["per_page"], $page ,$bp_user_id );
		$data ['result'] = $result;
		$this->load->view ( "blog/blog_category_list", $data );
	}
	public function update_category_status(){
		$id = url_decode ( $this->input->get ( "ref_id" ) );
		$data1 = array (
				"bc_status" => $this->input->get ( "status" ),
		);
		$this->Blog_Model->update_category_date ( $data1,$id);
		$this->session->set_flashdata ( "alert", array (
				"message" => "Category Successfully Updated",
				"class" => "alert-success"
		) );
		redirect ( "blog/blog_category_list");
	}
	
	public function deletecategory(){
		
		$id = url_decode ( $this->input->get ( "cat_id" ) );
		
	   $data = $this->Blog_Model->delete($id);
		redirect ( "blog/blog_category_list");
	}
	
	public function editcategorydetail(){
		
		$activedata = array (
				"activemain" => "blog",
				"displayblock" => "blog",
				"activeclass" => "blog_category_list" 
		);
		$id = url_decode ( $this->input->get ( "ref_id" ) );
		$result = $this->Blog_Model->get_cat_by_id ( $id );
		//print_r($result);
		//die;
		$data ['result'] = $result;
		$data["activedata"]= $activedata;
		$this->load->view ( "blog/editcategorydetail", $data );
	}
	
	public function edit_category_detail(){
		
	$request_type = $this->input->server ( "REQUEST_METHOD" );
		if ($request_type == "POST") {
			$this->form_validation->set_rules('category_name', 'Category Name', 'required');
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view ( "blog/edit_category_detail", $data );
			}else{
			$bp_updated_by = $this->dsa_data->dsa_id;
			if($_FILES['userfile']['error']>0){
				$bp_image_name="";
			}else{
				$image_data1=$this->Blog_Model->do_upload();
				$bp_image_name=$image_data1 ['file_name'];
			}
			$data = array (
					'bc_status' => $this->input->post ( 'status' ),
					'bc_name' => $this->input->post ( 'category_name' ),
					"bc_slug" => $this->input->post ( 'slug' ),
					'bc_tags' => $this->input->post ( 'tag' ),
					"bc_meta_title" => $this->input->post ( 'meta_title' ),
					'bc_meta_description' => $this->input->post ( 'meta_description' ),
					"bc_keyword" => $this->input->post ( 'meta_keyword' ),
					"bc_language" => $this->input->post ( 'language' ),
					'bc_image' => $bp_image_name,
					"bc_insert_by" => $bp_updated_by.', admin',
					'bc_user_type' => "DSA",
					"bc_user_id" => $bp_updated_by 
			);
			$id =url_decode($this->input->post ( 'id' ));
			$this->Blog_Model->update_category_date ( $data,$id);
			$this->session->set_flashdata ( "alert", array (
					"message" => "Blog Category  Successfully updated",
					"class" => "alert-success" 
			) );
			redirect ("blog/blog_category_list");
			}
		}else{
		$this->load->view ( "blog/edit_category_detail", $data );
		}
		
	}
	
	
	public function blog_list(){
		$activedata = array (
				"activemain" => "blog",
				"displayblock" => "blog",
				"activeclass" => "blog_list"
		);
		$dsa_id = $this->dsa_data->dsa_id;
		$data ["activedata"] = $activedata;
		$blogs = $this->Blog_Model->getAllBlogPosts($dsa_id);
		$data ["result"] = $blogs;
		//print_r($blogs);die;
		$this->load->view ( "blog/blog_list", $data );
		
	}
	public function add_blog_post()
	{
		$activedata = array (
				"activemain" => "blog",
				"displayblock" => "blog",
				"activeclass" => "add_blog_post"
		);
		$dsa_id = $this->dsa_data->dsa_id;
		$category = $this->Blog_Model->getAllCategory($dsa_id);
		$data ["activedata"] = $activedata;
	    $data["categories"] = $category;
	    $request_type = $this->input->server ( "REQUEST_METHOD" );
	    if ($request_type == "POST") {
	    	
	    	//print_r($_POST);
	    	//die;
	    	$this->form_validation->set_rules('blog_title', 'Blog title', 'required');
	    	if ($this->form_validation->run() == FALSE)
	    	{
	    		$this->load->view ( "blog/add_blog_post", $data );
	    	}else{
	    		$bp_updated_by = $this->dsa_data->dsa_id;
	    		if($_FILES['userfile']['error']>0){
	    			$bp_image_name="";
	    		}else{
	    			$image_data1=$this->Blog_Model->do_upload();
	    			$bp_image_name=$image_data1 ['file_name'];
	    		}
	    		$data = array (
	    				'b_status' => $this->input->post ( 'blog_status' ),
	    				'b_title' => $this->input->post ( 'blog_title' ),
	    				"b_link" => $this->input->post ( 'blog_link' ),
	    				'b_detail' => $this->input->post ( 'blog_detail' ),
	    				"b_category" => $this->input->post ( 'blog_category' ),
	    				'b_image' => $bp_image_name,
	    				"b_keywords" => $this->input->post ( 'meta_keyword' ),
	    				'b_meta_description' => $this->input->post ( 'meta_description' ),
	    				"b_posted_by" => $this->input->post ( 'updated_by' ),
	    				"b_language" => $this->input->post ( 'language' ),
	    				'b_user_type' => "DSA",
	    				"b_user_id" => $bp_updated_by,
	    				"b_insert_by"=> $bp_updated_by.'admin',
	    		);
	    		$this->Blog_Model->insert_blog_post ( $data );
	    		$this->session->set_flashdata ( "alert", array (
	    				"message" => $this->lang->line ( "successfully_updated" ),
	    				"class" => "alert-success"
	    		) );
	    		redirect ("blog/blog_list");
	    	}
	    }else{
	    	$this->load->view ( "blog/add_blog_post", $data );
	    }
	
		
	
	}
	
	public function update_blog_status(){
		$id = url_decode ( $this->input->get ( "ref_id" ) );
		$data1 = array (
				"b_status" => $this->input->get ( "status" ),
		);
		$this->Blog_Model->update_blog_date ( $data1,$id);
		$this->session->set_flashdata ( "alert", array (
				"message" => "blog Successfully Updated",
				"class" => "alert-success"
		) );
		redirect ( "blog/blog_list");
	}
	
	public function deleteblog(){
	
		$id = url_decode ( $this->input->get ( "bc_id" ) );
	
	    $data = $this->Blog_Model->deleteBlog($id);
		redirect ( "blog/blog_list");
	}
	
	public function editblogpost(){
	$activedata = array (
				"activemain" => "blog",
				"displayblock" => "blog",
				"activeclass" => "blog_list" 
		);
		$id = url_decode ( $this->input->get ( "ref_id" ) );
		$result = $this->Blog_Model->get_blog_by_id ( $id );
		//print_r($result);
		//die;
		$dsa_id = $this->dsa_data->dsa_id;
		$category = $this->Blog_Model->getAllCategory($dsa_id);
		
	    $data["categories"] = $category;
		$data ['result'] = $result;
		$data["activedata"]= $activedata;
		$this->load->view ( "blog/editblogpost", $data );
	}
	
	public function edit_blog_post(){
		
		$request_type = $this->input->server ( "REQUEST_METHOD" );
		if ($request_type == "POST") {
		
			//print_r($_POST);
			//die;
			$this->form_validation->set_rules('blog_title', 'Blog title', 'required');
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view ( "blog/add_blog_post", $data );
			}else{
				$bp_updated_by = $this->dsa_data->dsa_id;
				if($_FILES['userfile']['error']>0){
					$bp_image_name= $this->input->post ( 'imgp' );
				}else{
					$image_data1=$this->Blog_Model->do_upload();
					$bp_image_name=$image_data1 ['file_name'];
				}
				$data = array (
						'b_status' => $this->input->post ( 'blog_status' ),
						'b_title' => $this->input->post ( 'blog_title' ),
						"b_link" => $this->input->post ( 'blog_link' ),
						'b_detail' => $this->input->post ( 'blog_detail' ),
						"b_category" => $this->input->post ( 'blog_category' ),
						'b_image' => $bp_image_name,
						"b_keywords" => $this->input->post ( 'meta_keyword' ),
						'b_meta_description' => $this->input->post ( 'meta_description' ),
						"b_posted_by" => $this->input->post ( 'updated_by' ),
						"b_language" => $this->input->post ( 'language' ),
						'b_user_type' => "DSA",
						"b_user_id" => $bp_updated_by,
						"b_insert_by"=> $bp_updated_by.'admin',
				);
				$id =bp_hash($this->input->post ( 'id' ));
				$this->Blog_Model->update_blog_date ( $data,$id);
				$this->session->set_flashdata ( "alert", array (
						"message" => "Blog Post  Successfully Added",
						"class" => "alert-success"
				) );
				redirect ("blog/blog_list");
			}
		}else{
			$this->load->view ( "blog/edit_blog_post", $data );
		}
	}
	
}

