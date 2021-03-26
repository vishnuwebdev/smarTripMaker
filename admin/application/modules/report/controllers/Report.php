<?php
class Report extends MX_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->model ( array (
				'Report_Model' 
		) );
	}
	public function index() {
		redirect($this->uri->segment ( "1" )."/flight_search_history");
	}
	public function flight_search_history(){
		$activedata = array (
				"activemain" => $this->uri->segment ( "1" ),
				"displayblock" => $this->uri->segment ( "1" ),
				"activeclass" => $this->uri->segment ( "1" ) . "/" . $this->uri->segment ( "2" )
		);
		$data ["activedata"] = $activedata;
		$bp_user_type = "DSA";
		$bp_user_id = $this->dsa_data->dsa_id;
		$table = "flight_search_history";
		$where_1_name = "fsh_user_type";
		$where_1_value = $bp_user_type;
		$where_2_name = "fsh_user_id";
		$where_2_value = $bp_user_id;
		$order_by = "fsh_id";
		$bp_template_name = "flight_search_list";
		if ($this->uri->segment ( 3 )) {
			$page = $this->uri->segment ( 3 );
		} else {
			$page = 0;
		}
		$this->db->where ( $where_1_name, $where_1_value );
		$this->db->where ( $where_2_name, $where_2_value );
		$total_row = $this->db->from ( $table )->count_all_results ();
		$pagination_segment = 3;
		$per_page = 30;
		$pagination_url = base_url () . $this->uri->segment ( "1" ) . "/" . $this->uri->segment ( "2" );
		$config = bp_pagination ( $pagination_url, 0, $total_row, $per_page );
		$this->pagination->initialize ( $config );
		$result = $this->Common_Model->pagination_table ( $config ["per_page"], $page, $where_1_name, $where_1_value, $where_2_name, $where_2_value, $order_by, $table );
		$data ['result'] = $result;
		$this->load->view ( $this->uri->segment ( "1" ) . "/" . $bp_template_name, $data );
	}
	
	
		
}