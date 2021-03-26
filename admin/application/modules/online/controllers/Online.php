<?php 

class Online extends MX_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->Model('Online_Model');
	}
  public function index() {
  	$activedata = array(
  			"displayblock"=>"",
	 			"activeclass"=>"",
	 			"activemain"=>"dashboard"
  	);
  	$data["activedata"] = $activedata;
	$this->load->view("dashboard/index",$data);
	}
	public function font_awesome(){
		$activedata = array(
			"activemain" => $this->uri->segment ( "1" ),
				"displayblock" => $this->uri->segment ( "1" ),
				"activeclass" => $this->uri->segment ( "1" ) . "/" . $this->uri->segment ( "2" ) 
		);
		$data["activedata"] = $activedata;
		$this->load->view ( $this->uri->segment ( "1" ) . "/font_awsome", $data );
	}
	public function user_class(){
		
	}
	public function set_language(){
		$return_url=$this->input->get("return_url");
		$language=$this->input->get("language");
		$dsa_id=$this->user_data->dsa_id;
		$all_language=explode(",",$this->user_data->dsa_all_language);
		$data_1 = array (
				'dsa_set_language' => $language,
		);
		if(in_array($language, $all_language))
		{
		$this->Common_Model->update_table("dsa_id",$dsa_id,"dsa",$data_1);
		$this->lang->load ( "front", $language );
		$this->session->set_flashdata ( "alert", array (
				"message" => $this->lang->line ( "language_successfully_updated" ),
				"class" => "alert-success"
		) );
		redirect ($return_url);
		}else{
			echo "You Are not allowed to change this language.Contact Super Admin";
		}
	}
	
	
	
 }

