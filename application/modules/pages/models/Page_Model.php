<?php
class Page_Model extends CI_Model {
	public function __construct() {
		parent::__construct ();
	}
	
	
	
	function insert_table($table,$data){
		$this->db->insert($table,$data);
		return $this->db->insert_id ();
	}
	
	
	
	function get_table($select, $where, $where_val, $table) {
		$this->db->select ( $select );
		$this->db->where ( $where, $where_val );
		$query = $this->db->get ( $table );
		if ($query->num_rows () > 0) {
			return $query->row ();
		} else {
			return "0";
		}
	}
	function get_user_by_id($id) {
		$this->db->select ( "*" );
		$this->db->where ( "user_id", $id );
		$query = $this->db->get ( "users" );
		if ($query->num_rows () == 1) {
			return $query->result ();
		} else {
			return "0";
		}
	}
	function login($user_id, $password) {
		$this->db->where ( 'user_id', $user_id );
		$this->db->where ( 'user_password', $password );
		$this->db->limit ( 1 );
		$query = $this->db->get ( 'users' );
		if ($query->num_rows () == 1) {
			return $query->row ();
		} else {
			return false;
		}
	}
	function update_last_login() {
		$data = array (
				'user_last_login' => date ( 'd-m-Y H:i:s' ) 
		);
		$this->db->where ( 'user_id', $this->session->userdata ( 'loginDetail' )->user_id );
		$this->db->update ( 'users', $data );
	}
	function update_last_ip() {
		$data = array (
				'user_last_login_ip' => $this->input->ip_address () 
		);
		$this->db->where ( 'user_id', $this->session->userdata ( 'loginDetail' )->user_id );
		$this->db->update ( 'users', $data );
	}
	function insert_user($data) {
		$this->db->insert ( "users", $data );
		return $this->db->insert_id ();
	}
	function chack_email($id) {
		$this->db->select ( "user_name" );
		$this->db->where ( "user_email", $id );
		$query = $this->db->get ( "users" );
		if ($query->num_rows () > 0) {
			return "1";
		} else {
			return "0";
		}
	}
	function user_list() {
		$this->db->select ( "*" );
		$this->db->order_by ( "user_id", "desc" );
		$query = $this->db->get ( "users" );
		if ($query->num_rows () > 0) {
			return $query->result ();
		} else {
			return "0";
		}
	}
	function active_user_list() {
		$this->db->select ( "*" );
		$this->db->where ( "user_status", "active" );
		$this->db->order_by ( "user_id", "desc" );
		$query = $this->db->get ( "users" );
		if ($query->num_rows () > 0) {
			return $query->result ();
		} else {
			return "0";
		}
	}
	function inactive_user_list() {
		$this->db->select ( "*" );
		$this->db->where ( "user_status", "inactive" );
		$this->db->order_by ( "user_id", "desc" );
		$query = $this->db->get ( "users" );
		if ($query->num_rows () > 0) {
			return $query->result ();
		} else {
			return "0";
		}
	}
	function change_user_status($id, $status) {
		$this->db->where ( "user_id", $id );
		$this->db->update ( "users", $status );
		return "1";
	}
	function delete_user($id) {
		$this->db->where ( "user_id", $id );
		$this->db->delete ( "users" );
		return "1";
	}
	function update_user_personal_info($data, $id) {
		$this->db->where ( "user_id", $id );
		$this->db->update ( "users", $data );
		return "1";
	}
	
	
	
	function do_upload() {
		$this->load->library ( 'upload' );
		$config ['allowed_types'] = 'docx|pdf';
		$config ['upload_path'] = FCPATH . '/assets/resume';
		$config ['max_size'] = '8048';
		$this->upload->initialize ( $config );
		$this->load->library ( 'upload', $config );
		if ($this->upload->do_upload ()) {
			return $image_data = $this->upload->data ();
		} else {
			print_r ( $this->upload->display_errors () );
			exit ();
		}
	}
	function active_package_list() {
		$this->db->where ( "pac_status", "active" );
		$query = $this->db->get ( "user_package" );
		if ($query->num_rows () > 0) {
			return $query->result ();
		} else {
			return "0";
		}
	}
	function update_parent_childe($data, $id) {
		$this->db->where ( "user_id", $id );
		$this->db->update ( "users", $data );
		return "1";
	}
	function contact_us_form_submit($data) {
		$this->db->insert ( "common_queries", $data );
	}
	
	function online_payment_insert($data){
		$this->db->insert("online_payment",$data);
	}


	function online_payment_update($data,$order_id){
		$this->db->where("order_id",$order_id);
		$this->db->update("online_payment",$data);
		return "0";
	}
	function business_list_top_10(){
		$this->db->select("*");
		$this->db->order_by("bd_id","desc");
		$this->db->limit("15");
		$query=$this->db->get("business_directory");
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return "0";
		}
	}
	function business_detail_by_id($id){
		$this->db->select("*");
		$this->db->where("bd_id",$id);
		$query=$this->db->get("business_directory");
		if($query->num_rows()>0){
			return $query->row();
		}else{
			return "0";
		}
	}
	function full_business_list(){
		$this->db->order_by("bd_id","desc");
		$query=$this->db->get("business_directory");
		return $query->result();
	}
	function fetch_business_list($limit, $offset=NULL) {
		$this->db->limit($limit,$offset);
		$this->db->where("bd_status","active");
		$this->db->order_by("bd_id", "desc");
	    $query=$this->db->get('business_directory');
	if($query->num_rows()>0){
			return $query->result();
		}else{
			return "0";
		}
	}
	function fetch_business_list_by_category($category){
		$this->db->select("*");
		$this->db->like("bd_category",$category);
		$query=$this->db->get("business_directory");
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return "0";
		}
	}
	function full_job_list(){
		$this->db->order_by("jd_id","desc");
		$query=$this->db->get("job_directory");
		return $query->result();
	}
	function fetch_job_list($limit, $offset=NULL) {
		$this->db->limit($limit,$offset);
		$this->db->where("jd_status","active");
		$this->db->order_by("jd_id", "desc");
		$query=$this->db->get('job_directory');
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return "0";
		}
	}
	function job_detail_by_id($id){
		$this->db->select("*");
		$this->db->where("jd_id",$id);
		$query=$this->db->get("job_directory");
		if($query->num_rows()>0){
			return $query->row();
		}else{
			return "0";
		}
	}
	function full_classified_list(){
		$this->db->order_by("cd_id","desc");
		$query=$this->db->get("classified_directory");
		return $query->result();
	}
	function fetch_classified_list($limit, $offset=NULL) {
		$this->db->limit($limit,$offset);
		$this->db->where("cd_status","active");
		$this->db->order_by("cd_id", "desc");
		$query=$this->db->get('classified_directory');
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return "0";
		}
	}
	function classified_detail_by_id($id){
		$this->db->select("*");
		$this->db->where("cd_id",$id);
		$query=$this->db->get("classified_directory");
		if($query->num_rows()>0){
			return $query->row();
		}else{
			return "0";
		}
	}
	function fetch_classified_list_by_category($category){
		$this->db->select("*");
		$this->db->like("cd_category",$category);
		$query=$this->db->get("classified_directory");
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return "0";
		}
	}
	function full_news_list(){
		$this->db->order_by("n_id","desc");
		$query=$this->db->get("news");
		return $query->result();
	}
	function fetch_news_list($limit, $offset=NULL) {
		$this->db->limit($limit,$offset);
		$this->db->where("n_status","active");
		$this->db->order_by("n_id", "desc");
		$query=$this->db->get('news');
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return "0";
		}
	}
	function news_detail_by_id($id){
		$this->db->select("*");
		$this->db->where("n_id",$id);
		$query=$this->db->get("news");
		if($query->num_rows()>0){
			return $query->row();
		}else{
			return "0";
		}
	}
	function latest_1_news_list(){
		$this->db->order_by("n_id","desc");
		$this->db->limit("1");
		$query=$this->db->get("news");
		return $query->result();
	}
	function blog_detail($name){
		$this->db->select("*");
		$this->db->where("b_link",$name);
		$query=$this->db->get("blog_list");
		if($query->num_rows()==1){
			return $query->row();
		}else{
			return "no data";
		}
	}


	//newsletter
	
		public function add_newsletter($query1) {			
			$condition = array("newl_email" => $query1['newl_email']);
			$this->db->select('*');
			$this->db->from('newsletter');
			$this->db->where($condition);
			$this->db->limit(1);
			$query = $this->db->get();
			 // print_r($query);die;
			if ($query->num_rows() == 0) {
				$this->db->insert('newsletter', $query1);               
				if ($this->db->affected_rows() > 0) {
			return true;
			}
		} else {
		return false;
		}
		}
}
