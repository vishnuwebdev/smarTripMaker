<?php

class SRDV_Controller extends CI_Controller {

    public $common_data = array();

    function __construct() {
        parent::__construct();
        $this->load->helper('common_helper');
        $this->load->library ( 'encryption' );
        $this->load->model ( "Common_Model" );
        $this->load->library ( 'pagination' );
        $this->load->helper ( "common" );
        $this->dsa_data = $this->Common_Model->get_table ( "*", "dsa_id", "5", "dsa" );
        $this->u_firstname = "test Name";
		$this->u_lastname = "";
		$this->u_address1 = "test";
		$this->u_address2 = "test";
		$this->u_city = "test";
		$this->u_state = "test test";
		$this->u_country = "India";
		$this->u_zipcode = "test";
		$this->u_id_pre = "VM-MA";
		$this->u_id_other_pre = "VM-OT";
        $this->u_email = "test@gmail.com";
        $this->con_firstname = "test";
		$this->con_lastname = "test";
		$this->con_title = "Test";
		$this->con_address1 = "test";
		$this->con_address2 = "test";
		$this->con_city = "Test";
		$this->con_state = "Test";
		$this->con_country = "India";
		$this->con_zipcode = "Test";
		$this->con_email = "test@gmail.in";
		$this->con_phone = "+91 888888";
		$this->con_company_name = "Test";
		$this->con_ref_id_pre = "F";
		$this->con_theme_color_1 = "#fd6a2e";
		$this->con_theme_color_2 = "S";
		$this->con_website_url = "test.com";
		$this->con_company_full_name = "Test";
		
		
		if(!isset($_SESSION['set_currency']))
		{
			$_SESSION['set_currency'] = "INR";
		}
		$this->default_lang="en";
		$this->dsa_data = $this->Common_Model->get_table ( "*", "dsa_id", 5, "dsa" );
		$where = array("dsaset_user_id" => $this->dsa_data->dsa_id);
		$this->dsa_setting = $this->Common_Model->get_table_setting ( "*", $where, "dsa_setting" );
		
	    if ($this->session->userdata('Userlogin') != NULL) {
			$this->user_data = $this->Common_Model->get_table ( "*", "cust_id", $this->session->userdata("Userlogin")['userData']->cust_id, "customer" );
		}

        $wheresub = array(
            "holsubc_status" => "active"
            );
			
        $all_sub_cat = $this->Common_Model->get_sub_categories_menu($wheresub,"holiday_sub_category");
        $this->all_sub_category = $all_sub_cat;	
		// print_r($all_sub_cat);
		
		$where = array (
			"dsafd_dsa_id" => $this->dsa_data->dsa_id,
		);
		$this->dsa_front_data = $this->Common_Model->get_table_setting ( "*", $where, "dsa_front_data" );
		$this->social_links = unserialize($this->dsa_front_data->dsafd_social_links);
    }

    function index() {
        
    }
}
