<?php 

class Marketing extends MX_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->Model('Marketing_Model');
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
        $result = $this->Marketing_Model->newsletter_list($user_type, $user_id);
        $data ['result'] = $result;
        $this->load->view($this->uri->segment("1")."/newsletter_list", $data);
	}
	
	public function update_newsletter_status(){
		$id = url_decode ( $this->input->get ( "ref_id" ) );
		$data1 = array (
				"newl_status" => $this->input->get ( "status" ),
		);
		$this->Marketing_Model->update_newsletter_data ( $data1,$id);
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
	
 }

