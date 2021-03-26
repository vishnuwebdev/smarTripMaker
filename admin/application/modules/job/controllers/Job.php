<?php 

class Job extends MX_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->Model('Job_Model');
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
        $result = $this->Job_Model->query_list($user_type, $user_id);
        $data ['result'] = $result;
        $this->load->view($this->uri->segment("1")."/job_list", $data);
	}
	
	// public function job_requests() {
  	 // $activedata = array(
            // "activemain" => $this->uri->segment("1"),
            // "displayblock" => $this->uri->segment("2"),
            // "activeclass" => $this->uri->segment("2")
        // );
        // $data["activedata"] = $activedata;
        // $user_type = "DSA";
        // $user_id = $this->dsa_data->dsa_id;
        // $result = $this->Job_Model->job_request_list();
        // $data ['result'] = $result;
        // $this->load->view($this->uri->segment("1")."/job_request_list", $data);
	// }
	
	public function update_query_status(){
		$id = url_decode ( $this->input->get ( "ref_id" ) );
		$data1 = array (
				"job_status" => $this->input->get ( "status" ),
		);
		$this->Job_Model->update_query_data ( $data1,$id);
		$this->session->set_flashdata ( "alert", array (
				"message" => "Request Successfully Updated",
				"class" => "alert-success"
		) );
		redirect ($this->uri->segment("1"));
	}
      
	  public function delete_query(){
		$id = url_decode ( $this->input->get ( "ref_id" ) );
		$this->Job_Model->delete_query ($id);
		$this->session->set_flashdata ( "alert", array (
				"message" => "Request Deleted Successfully",
				"class" => "alert-success"
		) );
		redirect ($this->uri->segment("1"));
	}
	
 }

