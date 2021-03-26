<?php 
class Pages_model extends MX_Model{
  
    public function __construct(){
	    parent::__construct();
    }	
	
	function contact_us_form_submit($data){
       $this->db->insert("common_queries",$data);
    }
}