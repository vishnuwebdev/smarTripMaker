<?php 

class Query extends MX_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->Model('Query_Model');
	}
	
	public function index() {
  	 $activedata = array(
            "activemain" => $this->uri->segment("1"),
            "displayblock" => $this->uri->segment("1"),
            "activeclass" => $this->uri->segment("1")
        );
        $data["activedata"] = $activedata;
        $user_type = "DSA";
        $user_id = $this->dsa_data->dsa_id;
        $result = $this->Query_Model->query_list($user_type, $user_id);
        $data ['result'] = $result;
        $this->load->view($this->uri->segment("1")."/query_list", $data);
	}
	
	public function job_requests() {
  	 $activedata = array(
            "activemain" => $this->uri->segment("1"),
            "displayblock" => $this->uri->segment("2"),
            "activeclass" => $this->uri->segment("2")
        );
        $data["activedata"] = $activedata;
        $user_type = "DSA";
        $user_id = $this->dsa_data->dsa_id;
        $result = $this->Query_Model->job_request_list();
        $data ['result'] = $result;
        $this->load->view($this->uri->segment("1")."/job_request_list", $data);
	}
	
	public function update_query_status(){
		$id = url_decode ( $this->input->get ( "ref_id" ) );
		$data1 = array (
				"com_status" => $this->input->get ( "status" ),
		);
		$this->Query_Model->update_query_data ( $data1,$id);
		$this->session->set_flashdata ( "alert", array (
				"message" => "Request Successfully Updated",
				"class" => "alert-success"
		) );
		redirect ($this->uri->segment("1"));
	}
        public function delete_query(){
		$id = url_decode ( $this->input->get ( "ref_id" ) );
		$this->Query_Model->delete_query ($id);
		$this->session->set_flashdata ( "alert", array (
				"message" => "Query Deleted Successfully",
				"class" => "alert-success"
		) );
		redirect ($this->uri->segment("1"));
	}

	public function get_detail(){
		$id = url_decode ( $this->input->get ( "ref_id" ));
		$data = $this->Query_Model->get_query($id);
		$this->load->view("query_detail", $data);
	}
	
 }

