<?php
class SRDV_Controller extends CI_Controller {
	public $common_data = array ();
	function __construct() {
		parent::__construct ();
		$this->load->library ( 'encryption' );
		$this->load->model ( "Common_Model" );
		$this->load->library ( 'pagination' );
		$this->load->helper ( "common" );
		$dsaUrl = site_url ();
		$this->dsa_data = $this->Common_Model->get_table ( "*", "dsa_id", "5", "dsa" );
		if ($this->dsa_data == "0" || $this->dsa_data->dsa_status == "inactive") {
			echo "Directory access is forbidden.";
			die ();
		}
		$staff_exception_uris = array (
				'dsa',
				'dsa/dsa_login',
				'forgot-password',
				'logout',
				'dsa/super_admin_login',
				'dashboard' 
		);
		if (($this->session->userdata ( 'DsaStafflogin' ) != NULL)) {
			$dsastaffdata = dsa_Staff_Data_by_id ( $this->session->userdata ( "DsaStafflogin" )->dsast_id );
			$dsaStaffmenu = explode ( ",", $dsastaffdata->dsast_permission );
			if (in_array ( $this->uri->segment ( "1" ), $dsaStaffmenu ) || in_array ( uri_string (), $staff_exception_uris ) || uri_string () == "") {
			} else {
				echo '<h1 class="text-center p-30">
                   <div class="alert alert-danger">Sorry ! You Do not have permission to access this module.</div>
                       </h1>';
				die (); 
			}
		}
		$this->key_for_encrypt = $this->dsa_data->dsa_id;
		$this->all_language = explode ( ",", $this->dsa_data->dsa_all_language );
		$this->dsa_set_language = $this->dsa_data->dsa_set_language;
		$this->lang->load ( "front", $this->dsa_data->dsa_set_language );
		$this->encryption->initialize ( array (
				'cipher' => 'aes-256',
				'mode' => 'ctr',
				'key' => $this->key_for_encrypt 
		) );
		$exception_uris = array (
				'dsa',
				'dsa/dsa_login',
				'forgot-password',
				'logout',
				'dsa/super_admin_login' 
		);
		if (in_array ( uri_string (), $exception_uris ) == FALSE) {
			if (($this->session->userdata ( 'Dsalogin' ) == NULL)) {
				redirect ( 'dsa' );
			} else {
				$this->user_data = $this->Common_Model->get_table ( "*", "dsa_id", $this->session->userdata ( 'Dsalogin' )->dsa_id, "dsa" );
				$bp_dsa_permission=explode(",",$this->dsa_data->dsa_admin_permission);
				if (in_array ( $this->uri->segment ( "1" ), $bp_dsa_permission ) || in_array ( uri_string (), $staff_exception_uris ) || uri_string () == "") {
				} else {
					echo '<h1 class="text-center p-30">
                   <div class="alert alert-danger">Sorry ! You Do not have permission to access this module.</div>
                       </h1>';
					die ();
				}
			}
		}
		$where = array (
				"dsaset_user_id" => $this->dsa_data->dsa_id,
				'dsaset_language' => $this->dsa_data->dsa_set_language 
		);
		$this->dsa_setting = $this->Common_Model->get_table_setting ( "*", $where, "dsa_setting" );
		/* Admin Currency */
		$this->admin_currency = '';
		$this->UserName = "";
		$this->Password = "";
		$this->ClientId = "";
		$this->EndUserIp = "";
		$this->Hotel_Url = ""; // Hotel
		$this->Air_Url	= ""; // Air
	}
	function index() {
	}
}