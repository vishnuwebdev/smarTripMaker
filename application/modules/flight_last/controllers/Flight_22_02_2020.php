<?php
class Flight extends MX_Controller {
	function __construct() {
		parent::__construct ();
		
		$this->load->Model ( 'Flight_Model' );
        $this->load->Model(array('Flight_Model','Common_Model'));
		$this->load->helper ( 'common_helper' );
		$this->u_address1 = "A152 Ashok Nagar";
		$this->u_city = "delhi";
		$this->load->helper('text');
		$this->load->helper ( 'flight/flight' );
		$this->bp_token_data_count = 1;
		$tbo_data = $this->Flight_Model->get_table("*", "afapi_name", "tbo_live", "api_flight_active");
		$this->TokenId = $tbo_data->afapi_token;
		$this->ClientId = $tbo_data->afapi_client_id;
		$this->UserName = $tbo_data->afapi_user_name;
		$this->Password = $tbo_data->afapi_api_password;
		$this->EndUserIp = $tbo_data->afapi_ip;
		$this->url = $tbo_data->afapi_url;
		$this->auth_url = $tbo_data->afapi_auth_url;
		$this->bp_token_data_count = 1;
		if ($tbo_data->afapi_token_update != date("d")) 
		{
			$this->token_authenticate();
			$token_data = $_SESSION['flight']['TokenData'];
			if ($token_data->Status == "1") {
				$bp_rbo_auth_token = $token_data->TokenId;
				$updat_date = date("d");
				$data = array(
					"afapi_token" => $bp_rbo_auth_token,
					"afapi_token_update" => $updat_date,
				);
				$this->Flight_Model->update_table("afapi_name", "tbo_live", "api_flight_active", $data);
			}
		}
		$tbo_data = $this->Flight_Model->get_table("*", "afapi_name", "tbo_live", "api_flight_active");
	}	
	public function token_authenticate()
	{
		$data = array(
			"ClientId" => $this->ClientId,
			"UserName" => $this->UserName,
			"Password" => $this->Password,
			"EndUserIp" => $this->EndUserIp,
		);
		$data_string = json_encode($data);
		$ch = curl_init($this->auth_url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'Content-Length: ' . strlen($data_string),
		));
		$result = curl_exec($ch);	
		$arrayresult = json_decode($result);
		$_SESSION['flight']['Token_request_data'] = $data_string;
		$_SESSION['flight']['Token_result_data'] = $result;
		$_SESSION['flight']['TokenData'] = $arrayresult;
	}
	
	public function index() {
		echo "flight home";
	}
	public function result() {	
		if ($this->input->get( "type" ) == "OneWay" || $this->input->get ( "type" ) == "Return")	{              
			$fromd = explode ( ",", $_GET ["from_location"] );
			$tod = explode ( ",", $_GET ["to_location"] );					
			$data ['type'] = $this->input->get ( "type" );
			$data ['from_location'] = $fromd[1];
			$data ['to_location'] = $tod [1];
			$data['from_city_code']=$fromd[1];
			$data['to_city_code']=$tod[1];
			$depart_date_time = date ( "Y-m-d", strtotime ( $this->input->get ( "depart_date" ) ) );
			$data ['depart_date'] = $depart_date_time . "T00:00:00";
			$data ['no_adult'] = $this->input->get ( "no_adult" );
			$data ['no_child'] = $this->input->get ( "no_child" );
			$data ['no_infants'] = $this->input->get ( "no_infants" );
			$data ['preferred_airline'] = $this->input->get ( "preferred_airline" );
			$data ['cabin_class'] = $this->input->get ( "cabin_class" );
			$data ['depart_time'] = $this->input->get ( "depart_time" );
			$data ['return_time'] = $this->input->get ( "return_time" );
			$data ['PromotionalPlanType'] = "Normal";


			if ($this->input->get( "type" ) == "OneWay") {
				$searchtypedata = $this->search_one_way($data);			
				
			}else if ($this->input->get ( "type" ) == "Return") {
				$return_date_time = date ( "Y-m-d", strtotime ( $this->input->get ( "return_date" ) ) );
				$data ['return_date'] = $return_date_time . "T00:00:00";
						// $arrayresult = $this->returnSearch($data);
				$searchtypedata = $this->returnSearch($data);		 

			}					

			$data_string = $searchtypedata;
						//print_r($data_string);die;
			$ch = curl_init($this->url . '/Search/');
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'Content-Type: application/json',
				'Content-Length: ' . strlen($data_string)
			));
			$result = curl_exec($ch);
			$arrayresult = json_decode($result);

			$searchID = uniqID ();
			$_SESSION ['flight'] [$searchID] ['Search_data_json'] = $data_string;
			$_SESSION ['flight'] [$searchID] ['Search_Result_json'] = $result;
			$_SESSION ['flight'] ['Search_Result'] = $arrayresult;	
			$_SESSION ['flight'] [$searchID] ['search_RequestData'] = $_GET;	



			if ($arrayresult->Response->Error->ErrorCode != "0") {
				$bp_error ['class'] = "alert-danger";
				$bp_error ['message'] = "Sorry ! There is no data for selected Segment.<br>(" . $arrayresult->Response->Error->ErrorMessage . ")";
				$_SESSION ['flight'] ['bp_error'] = $bp_error;
				redirect ( "flight/result_not_found" );
			}


			if ($this->input->get ( "from_country" ) == "IN" && $this->input->get ( "to_country" ) == "IN") {
				$_SESSION ['flight'] [$searchID] ['search_RequestData'] ['IsDomestic'] = "true";
				$data ['IsDomestic'] = "true";
				$bp_dom_int="domestic";
			}
			else {
				$_SESSION ['flight'] [$searchID] ['search_RequestData'] ['IsDomestic'] = "false";
				$data ['IsDomestic'] = "false";
				$bp_dom_int="international";
			} 

				//Start Markup

			$dsa_markup_temp = $this->Flight_Model->get_dsa_markup($this->dsa_data->dsa_id,$bp_dom_int);

			$dsa_markup = array();
			if (is_array($dsa_markup_temp)) {
				foreach ($dsa_markup_temp as $dsa_markup_temps) {
					if ($dsa_markup_temps->dsamark_markup_type == "all") {
						$dsa_markup ['all'] ['dsamark_amount_type'] = $dsa_markup_temps->dsamark_amount_type;
						$dsa_markup ['all'] ['dsamark_value'] = $dsa_markup_temps->dsamark_value;
					} else {
						$dsa_markup [$dsa_markup_temps->dsamark_airline_code] ['dsamark_amount_type'] = $dsa_markup_temps->dsamark_amount_type;
						$dsa_markup [$dsa_markup_temps->dsamark_airline_code] ['dsamark_value'] = $dsa_markup_temps->dsamark_value;
					}
				}
			}

			
			$_SESSION ['flight'] ['dsa_markup'] = $dsa_markup;


						// Start Discount 
			$dsa_id	=$this->dsa_data->dsa_id;
			$get_all_discount = $this->Flight_Model->get_flight_discount($dsa_id);
			$b2c_discount = array();
			if (is_array($get_all_discount)) {
				foreach ($get_all_discount as $key => $b2c_discount_as) {
					$b2c_discount [$b2c_discount_as->dsafdis_airline_code]['amount_type'] = $b2c_discount_as->dsafdis_amount_type;
					$b2c_discount [$b2c_discount_as->dsafdis_airline_code]['fix_value'] = $b2c_discount_as->dsafdis_fix_val;
					$b2c_discount [$b2c_discount_as->dsafdis_airline_code]['basic'] = $b2c_discount_as->dsafdis_on_basic;
					$b2c_discount [$b2c_discount_as->dsafdis_airline_code]['yq'] = $b2c_discount_as->dsafdis_on_yq;
					$b2c_discount [$b2c_discount_as->dsafdis_airline_code]['airline_code'] = $b2c_discount_as->dsafdis_airline_code;
					$b2c_discount [$b2c_discount_as->dsafdis_airline_code]['airline_type'] = $b2c_discount_as->dsafdis_airline_type;
				}
			}

			$_SESSION ['flight'] ['discount'] = $b2c_discount;

		// print_r($b2c_discount);

			$data ['searchID'] = $searchID;

				// echo "<pre>";
				// print_r($data);die;

			$this->load->view ("result", $data );


		} 

		else if($this->input->server ( 'REQUEST_METHOD' ) == "GET" && $this->input->get("type") == "MultiWay")
		{
				// print_r($_GET); die;
			$searchID = uniqID (); 
			$data ['type'] = $this->input->get ( "type" );
			$data ['preferred_airline'] = $this->input->get ( "preferred_airline" );
			$data ['cabin_class'] = "All";
			$data ['depart_time'] = "00";
			$data ['return_time'] = "00";
			$data ['from_location'] = $this->input->get ( "fromLocation_m" )[0];
			$data ['depart_date'] = $this->input->get ( "dept_date_m" )[0];

			$_SESSION ['flight'] ['imp_data'] ['IsDomestic'] = "true";
			$data ['IsDomestic'] = "true";
			
			for($i = 0; $i < count($this->input->get("toLocation_m")); $i ++) {
				if ($this->input->get ( "toLocation_m")[$i] != "" ) {
					$data ['return_date'] = $this->input->get ( "dept_date_m" )[$i];
					$data ['to_location'] = $this->input->get ( "toLocation_m" )[$i];

				}
			}

			for($i = 0; $i < count($this->input->get("fromLocation_m")); $i ++) {
				if ($this->input->get ( "fromLocation_m")[$i] != "" ) {
					$data ["from_location_" . $i] = $this->input->get ( "fromLocation_m" )[$i];
					$data ["depart_date_" . $i] = $this->input->get ( "dept_date_m" ) [$i];
					$data ["to_location_" . $i] = $this->input->get ( "toLocation_m" ) [$i];
					
					if ($data ["from_location_" . $i] != "") {						
						
						
						if ($this->input->get ( "from_country" ) [$i] == "IN" ) 
						{								
							$_SESSION ['flight'] ['imp_data'] ['IsDomestic'] = "true";
							$data ['IsDomestic'] = "true";
						}
						else
						{
							$_SESSION ['flight'] ['imp_data'] ['IsDomestic'] = "false";
							$data ['IsDomestic'] = "false";
						}

						if ($this->input->get ( "to_country" ) [$i] == "IN" ) 
						{
							$_SESSION ['flight'] ['imp_data'] ['IsDomestic'] = "true";
							$data ['IsDomestic'] = "true";
						}
						else
						{
							$_SESSION ['flight'] ['imp_data'] ['IsDomestic'] = "false";
							$data ['IsDomestic'] = "false";
						}
						
						
						
						
						
					}
				}
			}
			$data ['no_adult'] = $this->input->get( "no_adult" );
			$data ['no_child'] = $this->input->get( "no_child" );
			$data ['no_infants'] = $this->input->get ( "no_infants" );

			if ($data ['type'] == "Special") {
				$data ['PromotionalPlanType'] = $this->input->get ( "specialType" );
			} else {
				$data ['PromotionalPlanType'] = "Normal";
			}
			$_SESSION ['flight'] ['SearchData'] = $data;

			$flight_segment = array ();
			$i = 1;

			for($i = 0; $i < count($this->input->get("toLocation_m")); $i ++) {
				if ($this->input->get ( "toLocation_m")[$i] != "" ) {
					if (isset($_SESSION ['flight'] ['SearchData'] ["to_location_" . $i])) {
						$origin=explode(",",$this->input->get ( "fromLocation_m" ) [$i]);
						$desti=explode(",",$this->input->get ( "toLocation_m" ) [$i]);
						
						$bhanu_segment = array (
							"Origin" => $origin[1],
							"Destination" => $desti[1],
							"FlightCabinClass" => "1",
							"PreferredDepartureTime" => date ( "Y-m-d", strtotime ( $this->input->get ( "dept_date_m" ) [$i]) ) . 'T00:00:00',
							"PreferredArrivalTime" => date ( "Y-m-d", strtotime ( $this->input->get ( "dept_date_m") [$i] ) ) . 'T00:00:00' 
						);				
						
						array_push ( $flight_segment, $bhanu_segment );
					}
				}
			}


				 //$this->db_token();	

			$search_data = array (
				"EndUserIp" => $this->EndUserIp,
				"TokenId" => $this->TokenId,
				"AdultCount" => $data ['no_adult'],
				"ChildCount" => $data ['no_child'],
				"InfantCount" => $data ['no_infants'],
				"JourneyType" => "3",
				"Sources" => $data['preferred_airline'],
				"PreferredAirlines" => NULL,  
				"Segments" => $flight_segment 
			);


			$data_string = json_encode ( $search_data );

			$ch = curl_init($this->url . '/Search/');
			curl_setopt ( $ch, CURLOPT_CUSTOMREQUEST, "POST" );
			curl_setopt ( $ch, CURLOPT_POSTFIELDS, $data_string );
			curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
			curl_setopt ( $ch, CURLOPT_HTTPHEADER, array (
				'Content-Type: application/json',
				'Content-Length: ' . strlen ( $data_string ) 
			) );
			$result = curl_exec ( $ch );				
			$arrayresult = json_decode ( $result );			


			if ($arrayresult->Response->Error->ErrorCode != "0") {
				$bp_error ['class'] = "alert-danger";
				$bp_error ['message'] = "Sorry ! There is no data for selected Segment.<br>(" . $arrayresult->Response->Error->ErrorMessage . ")";
				$_SESSION ['flight'] ['bp_error'] = $bp_error;
				redirect ( "flight/result_not_found" );
			}

			$searchID = uniqID ();
			$_SESSION ['flight'] [$searchID] ['Search_data_json'] = $data_string;
			$_SESSION ['flight'] [$searchID] ['Search_Result_json'] = $result;
			$_SESSION ['flight'] ['Search_Result'] = $arrayresult;
			$_SESSION ['flight'] [$searchID] ['search_RequestData'] = $_GET;
			$_SESSION ['flight'] [$searchID] ['search_RequestData'] ['IsDomestic'] = $data ['IsDomestic'];

			if($data['IsDomestic'] == "false")
			{

				$bp_dom_int="international";

			} 
			else if($data['IsDomestic'] == "true") {
				$bp_dom_int="domestic";
			}	

			$data ['searchID'] = $searchID;


			$this->load->view ("result", $data );
		} 

	}
	
	//oneway search
	function search_one_way($search_data) {
	    //$this->db_token();		
		$search_data_tbo = array(
			"EndUserIp" => $this->EndUserIp,
			"TokenId" => $this->TokenId,           
			"AdultCount" => $search_data['no_adult'],
			"ChildCount" => $search_data['no_child'],
			"InfantCount" => $search_data['no_infants'],
			"JourneyType" => "1",
			"Sources" => $search_data['preferred_airline'],
			"PreferredAirlines" => NULL,           
			"Segments" => [ 
				array (
					"Origin" => $search_data ['from_city_code'],
					"Destination" => $search_data ['to_city_code'],
					"FlightCabinClass" => $search_data ['cabin_class'],
					"PreferredDepartureTime" => $search_data ['depart_date'],
					"PreferredArrivalTime" => $search_data ['depart_date'] 
				) 
			] 
		);
		$data_string = json_encode ( $search_data_tbo );
		return $data_string; 
	}
	
	//fare-rule		
	public function fare_rule() {
		if ($this->input->server ( 'REQUEST_METHOD' ) == "POST") {		
			//$this->db_token();		
			$traceID = $this->input->post ( "traceID" );
			$resultIndex = $this->input->post ( "resultIndex" );
			$search_data_tbo = array (
				"EndUserIp" => $this->EndUserIp,
				"TokenId" => $this->TokenId,					
				"TraceId" => $traceID,
				"ResultIndex" => $resultIndex 
			);
			
			$data_string = json_encode($search_data_tbo);
			$ch = curl_init($this->url . '/FareRule/');
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'Content-Type: application/json',
				'Content-Length: ' . strlen($data_string)
			));
			$result = curl_exec($ch);
			$arrayresult = json_decode($result);
			echo $result;
		}
	}
	
	public function confirm_fare() {
		if ($this->input->server ( 'REQUEST_METHOD' ) == "POST") {
			
			//$this->db_token();
			
			$traceID = $this->input->post ( "traceID" );
			$resultIndex = $this->input->post ( "resultIndex" );
			$sessionID = $this->input->post ( "sessionID" );
			$search_data_tbo = array (
				"EndUserIp" => $this->EndUserIp,
				"TokenId" => $this->TokenId,				
				"TraceId" => $traceID,
				"ResultIndex" => $resultIndex 
			);
			$data_string = json_encode($search_data_tbo);
			$ch = curl_init($this->url . '/FareQuote/');
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'Content-Type: application/json',
				'Content-Length: ' . strlen($data_string)
			));
			$result = curl_exec($ch);
			$arrayresult = json_decode($result);
			$_SESSION ['flight'] [$sessionID] ['farequote_request_json'] = $data_string;
			$_SESSION ['flight'] [$sessionID] ['farequote_Result_json'] = $result;
			$_SESSION ['flight'] [$sessionID] ['farequote_Result'] = $arrayresult;			
			
			if ($arrayresult->Response->Error->ErrorCode == "0") {
				$_SESSION ['flight'] [$sessionID] ['farequote_data'] ['confirm_price'] = $arrayresult;
				if ($_SESSION ['flight'] [$sessionID] ['farequote_data'] ['confirm_price']->Response->Results->IsLCC == "1") {
					$_SESSION ['flight'] [$sessionID] ['farequote_data'] ['IsLCC'] = "true";
				} else {
					$_SESSION ['flight'] [$sessionID] ['farequote_data'] ['IsLCC'] = "false";
				}
				echo "true";

			} else {
				echo "There is some Problem on request. Please Try again later.";
			}
			
		}
	}
	
	public function roundtrip_confirm_fare() {
		if ($this->input->server ( 'REQUEST_METHOD' ) == "POST") {
			//$this->db_token();			
			$traceID = $this->input->post ( "traceID" );
			$resultIndexOB = $this->input->post ( "resultIndexOB" );
			$sessionID = $this->input->post ( "sessionID" );
			$search_dataOB = array (
				"EndUserIp" => $this->EndUserIp,
				"TokenId" => $this->TokenId,
				"TraceId" => $traceID,
				"ResultIndex" => $resultIndexOB 
			);
			$search_dataIB = array (
				"EndUserIp" => $this->EndUserIp,
				"TokenId" => $this->TokenId,
				"TraceId" => $traceID,
				"ResultIndex" => $this->input->post ( "resultIndexIB" ) 
			);
			if ($this->confirm_fare_return ( $search_dataOB, "OB", $sessionID ) == "success") {				
				
				if ($this->confirm_fare_return ( $search_dataIB, "IB", $sessionID ) == "success") {				
					echo "true";
				}
			} else {
				
				echo "There is some Problem on request. Please Try again later.";
			}
		}
	}
	
	
	public function confirm_fare_return($search_data, $bond, $sessionID) {
		//$this->db_token();
		$data_string = json_encode ( $search_data );
		$method = "/FareQuote/";
		$url = $this->url . $method;
		$ch = curl_init ( $url );
		curl_setopt ( $ch, CURLOPT_CUSTOMREQUEST, "POST" );
		curl_setopt ( $ch, CURLOPT_POSTFIELDS, $data_string );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt ( $ch, CURLOPT_HTTPHEADER, array (
			'Content-Type: application/json',
			'Content-Length: ' . strlen ( $data_string ) 
		) );
		$result = curl_exec ( $ch );
		$arrayresult = json_decode ( $result );		
		
		if ($bond == "OB") {
			
			$_SESSION ['flight'] [$sessionID] ['farequote_request_json_OB'] = $data_string;
			$_SESSION ['flight'] [$sessionID] ['farequote_Result_json_OB'] = $result;

			
			if ($arrayresult->Response->Error->ErrorCode == "0") {
				$_SESSION ['flight'] [$sessionID] ['farequote_data_OB'] ['confirm_price'] = $arrayresult;
				if ($_SESSION ['flight'] [$sessionID] ['farequote_data_OB'] ['confirm_price']->Response->Results->IsLCC == "1") {
					$_SESSION ['flight'] [$sessionID] ['farequote_data_OB'] ['IsLCC'] = "true";
				} else {
					$_SESSION ['flight'] [$sessionID] ['farequote_data_OB'] ['IsLCC'] = "false";
				}
				
				return "success";
			} else {
				echo "There is some Problem on request. Please Try again later.";
			}
		} else {
			
			$_SESSION ['flight'] [$sessionID] ['farequote_request_json_IB'] = $data_string;
			$_SESSION ['flight'] [$sessionID] ['farequote_Result_json_IB'] = $result;
			
			if ($arrayresult->Response->Error->ErrorCode == "0") {
				$_SESSION ['flight'] [$sessionID] ['farequote_data_IB'] ['confirm_price'] = $arrayresult;
				if ($_SESSION ['flight'] [$sessionID] ['farequote_data_IB'] ['confirm_price']->Response->Results->IsLCC == "1") {
					$_SESSION ['flight'] [$sessionID] ['farequote_data_IB'] ['IsLCC'] = "true";
				} else {
					$_SESSION ['flight'] [$sessionID] ['farequote_data_IB'] ['IsLCC'] = "false";
				}
				// echo "neerajIB";
				return "success";
			} else {
				echo "There is some Problem on request. Please Try again later.";
			}
		}
		// echo $result;
	}
	
	
	public function booking_detail() {
		$sessionid = $this->input->get ( 'seesionid' );	

		$bp_user_id = $this->dsa_data->dsa_id;
		$getwayList = $this->Common_Model->get_table_row("*", array(
			"dsapayg_user_type" => "DSA",
			"dsapayg_user_id" => $bp_user_id,
			"dsapayg_status" => "active",
			"dsapayg_b2b_b2c" => "B2c",
			"dsapayg_gateway_name" => "cc_avenue"
		), "dsa_payment_gateway");
		$data ["getwayList"] = $getwayList;
        $data['wallet'] = $this->Common_Model->get_full_table('dsa_setting');

		$isdomestic = $this->session->userdata ( "flight" ) [$sessionid] ['search_RequestData'] ['IsDomestic'];
		
		if ($this->session->userdata ( "flight" ) [$sessionid] ['search_RequestData'] ['type'] == "Return" && $isdomestic == "true") {
			$flightdataconfrimOB = $this->session->userdata ( "flight" ) [$sessionid] ['farequote_data_OB'] ['confirm_price'];
			$flightdataconfrimIB = $this->session->userdata ( "flight" ) [$sessionid] ['farequote_data_IB'] ['confirm_price'];
			
			$data ["confrimdataOB"] = $flightdataconfrimOB;
			$data ["confrimdataIB"] = $flightdataconfrimIB;
			$data ['sessionid'] = $sessionid;
			// $allcountry = $this->Flight_Model->get_countries ();
			// $data ["allcountry"] = $allcountry;
			$this->load->view ( "booking_detail_return", $data );
		} else {
			// $allcountry = $this->Flight_Model->get_countries ();
			// $data ["allcountry"] = $allcountry;
			$flightdataconfrim = $this->session->userdata ( "flight" ) [$sessionid] ['farequote_data'] ['confirm_price'];
			$data ["confrimdata"] = $flightdataconfrim;
			$data ['sessionid'] = $sessionid;
			
			
			$this->load->view ( "booking_detail", $data );
		}
	}

	public function save_customer_data() {

		$sessionid = $this->input->post ( 'sessionid' );

		$searchData = $_SESSION ['flight'] [$sessionid] ['search_RequestData'];

	 // print_r($searchData);die;
		if ($this->session->userdata ( 'Userlogin' ) != NULL) {
			$cusid = $this->session->userdata ( 'Userlogin' ) ['userData']->cust_id;
		} else {
			$cusid = 0;
		}
		
		if ($this->input->post ( 'payment_method' )== "cc_avenue") {
			$transaction_fee = $_SESSION['flight']['Conv_fee'];
		} else {
			$transaction_fee = 0;
		}
		
		if ($searchData ['type'] == "Return" && $searchData ['IsDomestic'] == "true") {
			
			$_SESSION ['flight'] [$sessionid] ['farequote_data_OB'] ['customer_data'] = $_POST;
			
			$bookingData = $this->returnbookingdata ( $searchData, $sessionid, $cusid, $transaction_fee );
			$FareRes = $_SESSION ['flight'] [$sessionid] ['farequote_data_OB'];
			$FBreakDwn = $_SESSION ['flight'] [$sessionid] ['farequote_data_OB'] ['confirm_price']->Response->Results->FareBreakdown;
		} 
		
		
		else {			
			if($searchData ['type'] == "MultiWay"){
				$searchData ['return_date'] = "";
				$searchData ['depart_date'] = $searchData['dept_date_m']['0'];
				
				$_SESSION ['flight'] [$sessionid] ['farequote_data_OB'] ['customer_data'] = $_POST;
			}
			else if($searchData ['return_date'] == NULL) {

				$searchData ['return_date'] = "";				
			}		
			
			
			$_SESSION ['flight'] [$sessionid] ['farequote_data'] ['customer_data'] = $_POST;
			
			$FareRes = $_SESSION ['flight'] [$sessionid] ['farequote_data'];
			$totalFare = str_replace ( ",", "", $_SESSION ['flight'] [$sessionid]['flight_total_fare'] );
			
			$searchData ['IsLcc'] = $_SESSION ['flight'] [$sessionid] ['farequote_data'] ['confirm_price']->Response->Results->IsLCC;
			$FBreakDwn = $_SESSION ['flight'] [$sessionid] ['farequote_data'] ['confirm_price']->Response->Results->FareBreakdown;
			$segment = $_SESSION ['flight'] [$sessionid] ['farequote_data'] ['confirm_price']->Response->Results->Segments[0];
			$main_segment = $_SESSION ['flight'] [$sessionid] ['farequote_data'] ['confirm_price']->Response->Results->Segments;
			$countmain = count($_SESSION ['flight'] [$sessionid] ['farequote_data'] ['confirm_price']->Response->Results->Segments);
			
			$segcountoneword = count ( $segment );
			
			

			$departdataonword = $segment[0]->Origin->Airport;

			if($searchData ['type'] == "MultiWay"){
				$arriveldataonword = $main_segment[$countmain-1] [$segcountoneword - 1]->Destination->Airport;
			}
			else{
				$arriveldataonword = $segment [$segcountoneword - 1]->Destination->Airport;
			}


			

			$bookingData = array (
				'fbook_total_fare' => $totalFare,
				'fbook_customer_fare' => $totalFare,
				'fbook_booking_type' => $searchData ['type'],
				'fbook_depart_city' => $departdataonword->CityName,
				'fbook_depart_airport' => $departdataonword->AirportName,
				'fbook_depart_airport_code' => $departdataonword->AirportCode,
				'fbook_arrive_city' => $arriveldataonword->CityName,
				'fbook_arrive_airport' => $arriveldataonword->AirportName,
				'fbook_arrive_airport_code' => $arriveldataonword->AirportCode,
				'fbook_depart_date' => $searchData ['depart_date'],
				'fbook_return_date' => $searchData ['return_date'],
				'fbook_booking_type' => $searchData ['type'],
				'fbook_agent_fare' => "",
				'fbook_markup' => "",
				'fbook_discount' => "",
				'fbook_markup_detail' => "",
				'fbook_discount_detail' => "",
				'fbook_airline_name' => $segment [0]->Airline->AirlineName,
				'fbook_airline_code' => $segment [0]->Airline->AirlineCode,
				'fbook_adult' => $searchData ['no_adult'],
				'fbook_child' => $searchData ['no_child'],
				'fbook_infant' => $searchData ['no_infants'],
				'fbook_agent_name' => "",
				'fbook_is_domestic' => $searchData ['IsDomestic'],
				'fbook_payment_status' => 'Pending',
				'fbook_ob_booking_status' => 'Pending',
				'fbook_ib_booking_status' => "",
				'fbook_customer_id' => $cusid,
				'fbook_agent_id' => '',
				'fbook_contact_name' => $this->input->post ( 'AdultFirstName_1' ) . ' ' . $this->input->post ( 'AdultLastName_1' ),
				'fbook_contact_email' => $this->input->post ( 'cust_email' ),
				'fbook_contact_phone' => $this->input->post ( 'cust_mobile_no' ),
				'fbook_customer_name' => "",
				'fbook_user_type' => "DSA",
				'fbook_user_id' => $this->dsa_data->dsa_id,
				'fbook_remark' => "",
				'fbook_sessionid' => $sessionid,
				'fbook_module'	=> "B2C",
				'fbook_transaction_fee'	=> $transaction_fee,				
			);
		}




		$bookingid = $this->Flight_Model->insert_booking ( $bookingData );
		


		
		$search_data = array (
			'ftemp_ref_id' => $bookingid,
			'ftemp_user_type' => "DSA",
			'ftemp_user_id' => $this->dsa_data->dsa_id,
			'ftemp_key' => "ob_search",
			'ftemp_data' => json_encode ( $FareRes ) 
		);
		
		$this->Flight_Model->insert_temp ( $search_data );
		
		if ($searchData ['type'] == "Return" && $searchData ['IsDomestic'] == "true") {
			$FareResIB = $_SESSION ['flight'] [$sessionid] ['farequote_data_IB'];
			$search_data2 = array (
				'ftemp_ref_id' => $bookingid,
				'ftemp_user_type' => "DSA",
				'ftemp_user_id' => 5,
				'ftemp_key' => "ib_search",
				'ftemp_data' => json_encode ( $FareResIB ) 
			);
			$this->Flight_Model->insert_temp ( $search_data2 );
		}
		$ci_mobile_no = $this->input->post ( "cust_mobile_no" );
		$ci_email = $this->input->post ( "cust_email" );
		
		foreach ( $FBreakDwn as $val ) {
			$noOfPx = $val->PassengerCount;
			for($i = 1; $i <= $noOfPx; $i ++) {
				$fld_pax_type = passanger_t_f_number ( $val->PassengerType );
				$fld_pax_title = $this->input->post ( $fld_pax_type . "Title_" . $i );
				$fld_pax_fname = $this->input->post ( $fld_pax_type . "FirstName_" . $i );
				$fld_pax_lname = $this->input->post ( $fld_pax_type . "LastName_" . $i );
				$fld_pax_gender = $this->input->post ( $fld_pax_type . "Gender_" . $i );
				$fld_pax_dob_d = $this->input->post ( $fld_pax_type . "Date_" . $i );
				if ($searchData ['IsDomestic'] == "false") {
					$fld_passport_no = $this->input->post ( $fld_pax_type . "PassportNum_" . $i );
					$IssuingCntry = $this->input->post ( $fld_pax_type . "IssuingCntry_" . $i );
					$fld_pass_expiry_d = $this->input->post ( $fld_pax_type . "PassExpDate_" . $i );
				} else {
					$fld_passport_no = "";
					$IssuingCntry = "";
					$fld_pass_expiry_d = "";
				}
				$bookingPaxDetails = array (
					'fpax_booking_id' => $bookingid,
					'fpax_type' => $fld_pax_type,
					'fpax_title' => $fld_pax_title,
					'fpax_first_name' => $fld_pax_fname,
					'fpax_last_name' => $fld_pax_lname,
					'fpax_gender' => $fld_pax_gender,
					'fpax_dob' => $fld_pax_dob_d,
					'fpax_passport_number' => $fld_passport_no,
					'fpax_passport_issue_country' => $IssuingCntry,
					'fpax_passport_expiry' => $fld_pass_expiry_d,
					'fpax_user_type' => "DSA",
					'fpax_user_id' => $this->dsa_data->dsa_id,
					'fpax_mobile' => $ci_mobile_no,
					'fpax_email' => $ci_email 
				);
				
				$this->Flight_Model->insert_booking_pax_details ( $bookingPaxDetails );
			}
		}
		// die;
		$_SESSION ['flight'] [$sessionid] ['search_RequestData'] ["BookingId"] = $bookingid;
		
		$_SESSION ['flight'] [$sessionid] ['SearchData'] ["BookingId"]= $bookingid;
		// $_SESSION ['flight'] [$sessionid] ['search_RequestData'] ["RefId"] = $ref_id;
		echo $bookingid;
		
	}
	
//=======RETURN FLIGHT SEARCH===============
	public function returnSearch($data) {
	 //$this->db_token();
		$search_data = array (
			"EndUserIp" => $this->EndUserIp,
			"TokenId" => $this->TokenId,				
			"AdultCount" => $data ['no_adult'],
			"ChildCount" => $data ['no_child'],
			"InfantCount" => $data ['no_infants'],
			"JourneyType" => "2",
			"Sources" => $data ['preferred_airline'],
			"PreferredAirlines" => NULL,
			"Segments" => [ 
				array (
					"Origin" => $data ['from_city_code'],
					"Destination" => $data ['to_city_code'],
					"FlightCabinClass" => $data ['cabin_class'],
					"PreferredDepartureTime" => $data ['depart_date'],
					"PreferredArrivalTime" => $data ['depart_date'] 
				),
				array (
					"Origin" => $data ['to_city_code'],
					"Destination" => $data ['from_city_code'],
					"FlightCabinClass" => $data ['cabin_class'],
					"PreferredDepartureTime" => $data ['return_date'],
					"PreferredArrivalTime" => $data ['return_date'] 
				) 
			] 
		);
		
		$data_string = json_encode ( $search_data );
		return $data_string;		
	}


	
//Payement Request
	
	
		// ticket Booking
	public function ticket_booking($booking_id = NULL) {


		$bookingdata = $this->Flight_Model->get_bookingflight_data ( $booking_id );

		$searchData = $_SESSION ['flight'] [$bookingdata->fbook_sessionid] ['search_RequestData'];

		if ($searchData ['type'] == "Return" && $searchData ['IsDomestic'] == "true") {
			
			$resbookOB = $this->return_ticket_OB( $booking_id, $bookingdata );
			if ($resbookOB == "success") {
				$resbookIB = $this->return_ticket_IB ( $booking_id, $bookingdata );
				if ($resbookIB == "success") {
					redirect ( '/flight/get_booking/' . $booking_id );
				}
			}
		} else {
			$resbookOB = $this->ticket_book_oneway ( $booking_id, $bookingdata );
			
			if ($resbookOB == "success") {
				redirect ( '/flight/get_booking/' . $booking_id );
			}
		}
	}
	
	function ticket_book_oneway($booking_id, $bookingdata) {		
		
		if ($_SESSION ['flight'] [$bookingdata->fbook_sessionid] ['farequote_data'] ['IsLCC'] == "true") {
			$sessiondata = $_SESSION ['flight'] [$bookingdata->fbook_sessionid] ['farequote_data'];
			$ticket_result = $this->ticket_lcc ( $booking_id, $sessiondata, $bookingdata->fbook_sessionid, "OB" );
			
			$ticket_data = json_decode ( $_SESSION ['flight'] [$bookingdata->fbook_sessionid] ['ticket_result_data'] );
			
			
			
			if ($ticket_data->Response->Error->ErrorCode == "0" && isset ( $ticket_data->Response->Response->PNR )) {
				
				if ($ticket_data->Response->Response->TicketStatus == "1") {
					$BookingRes = json_encode ( $ticket_data );
					$search_data = array (
						'ftemp_ref_id' => $booking_id,
						'ftemp_user_type' => "DSA",
						'ftemp_user_id' => $this->dsa_data->dsa_id,
						'ftemp_key' => "ob_ticket",
						'ftemp_data' => $BookingRes 
					);
					$this->Flight_Model->insert_temp ( $search_data );
					$data = array (
						'fbook_ob_pnr' => $ticket_data->Response->Response->PNR,
						'fbook_ob_booking_id' => $ticket_data->Response->Response->BookingId,
						'fbook_ob_booking_status' => "Success" 
					);
					$this->Flight_Model->update_booking ( $data, $booking_id );
					return "success";
				}
				else {
					$_SESSION ['flight'] [$bookingdata->fbook_sessionid] ['farequote_data'] ['error'] = $ticket_data->Response->Error->ErrorMessage;
					redirect ( "/flight/booking_error?sessionid=" . $bookingdata->fbook_sessionid );
				}
			} else {
				$_SESSION ['flight'] [$bookingdata->fbook_sessionid] ['farequote_data'] ['error'] = $ticket_data->Response->Error->ErrorMessage;
				$BookingRes = json_encode ( $ticket_data );
				$search_data = array (
					'ftemp_ref_id' => $booking_id,
					'ftemp_user_type' => "DSA",
					'ftemp_user_id' => $this->dsa_data->dsa_id,
					'ftemp_key' => "ob_ticket",
					'ftemp_data' => $BookingRes 
				);
				$this->Flight_Model->insert_temp ( $search_data );
				
				$data = array (
						// 'Fld_TicketDesc' => $ticket_data->Error->ErrorMessage,
					'fbook_ob_booking_status' => "Failed" 
				);
				$this->Flight_Model->update_booking ( $data, $booking_id );
				redirect ( "/flight/booking_error?sessionid=" . $bookingdata->fbook_sessionid );
			}
		} elseif ($_SESSION ['flight'] [$bookingdata->fbook_sessionid] ['farequote_data'] ['IsLCC'] == "false") {
			
			$sessiondata = $_SESSION ['flight'] [$bookingdata->fbook_sessionid] ['farequote_data'];
			
			$book_result = $this->hold ( $booking_id, $sessiondata, $bookingdata->fbook_sessionid, "OB" );			
			$book_data = json_decode($_SESSION ['flight'] [$bookingdata->fbook_sessionid] ['hold_result_data'] );
			
			
			if ($book_data->Response->Error->ErrorCode == "0" && isset ( $book_data->Response->Response->PNR )) {
				$BookingRes = json_encode ( $book_data );
				$stempbook_data = array (
					'ftemp_ref_id' => $booking_id,
					'ftemp_user_type' => "DSA",
					'ftemp_user_id' => $this->dsa_data->dsa_id,
					'ftemp_key' => "ob_book",
					'ftemp_data' => $BookingRes 
				);
				$this->Flight_Model->insert_temp ( $stempbook_data );
				$data = array (
					'fbook_ob_pnr' => $book_data->Response->Response->PNR,
					'fbook_ob_booking_id' => $book_data->Response->Response->BookingId,
					'fbook_ob_booking_status' => "Hold" 
				);
				$this->Flight_Model->update_booking ( $data, $booking_id );
				
				$ticket_result = $this->ticket_gds ( $book_data->Response->Response->PNR, $book_data->Response->Response->BookingId, $sessiondata, $bookingdata->fbook_sessionid, "OB" );
				
				
				$ticket_data = json_decode ( $_SESSION ['flight'] [$bookingdata->fbook_sessionid] ['ticket_result_data'] );			
				
				
				if ($ticket_data->Response->Error->ErrorCode == "0" && isset ( $ticket_data->Response->Response->PNR )) {
					if ($ticket_data->Response->Response->TicketStatus == "1") {
						$ticketRes = json_encode ( $ticket_data );
						$tempticket_data = array (
							'ftemp_ref_id' => $booking_id,
							'ftemp_user_type' => "DSA",
							'ftemp_user_id' => $this->dsa_data->dsa_id,
							'ftemp_key' => "ob_ticket",
							'ftemp_data' => $ticketRes 
						);
						$this->Flight_Model->insert_temp ( $tempticket_data );
						$data = array (
							'fbook_ob_pnr' => $book_data->Response->Response->PNR,
							'fbook_ob_booking_id' => $book_data->Response->Response->BookingId,
							'fbook_ob_booking_status' => "Success" 
						);
						$this->Flight_Model->update_booking ( $data, $booking_id );
						return "success";
					} else {
						$_SESSION ['flight'] [$bookingdata->fbook_sessionid] ['farequote_data'] ['error'] = $ticket_data->Response->Error->ErrorMessage;
						
						redirect ( "/flight/booking_error?sessionid=" . $bookingdata->fbook_sessionid );
					}
				} else {
					$_SESSION ['flight'] [$bookingdata->fbook_sessionid] ['farequote_data'] ['error'] = $ticket_data->Error->ErrorMessage;
					redirect ( "/flight/booking_error?sessionid=" . $bookingdata->fbook_sessionid );
				}
			} else {
				
				$_SESSION ['flight'] [$bookingdata->fbook_sessionid] ['farequote_data'] ['error'] = $book_data->Error->ErrorMessage;
				
				$BookingRes = json_encode ( $book_data );
				$search_data = array (
					'ftemp_ref_id' => $booking_id,
					'ftemp_user_type' => "DSA",
					'ftemp_user_id' => $this->dsa_data->dsa_id,
					'ftemp_key' => "ob_ticket",
					'ftemp_data' => $BookingRes 
				);
				$this->Flight_Model->insert_temp ( $search_data );
				
				$data = array (
						// 'Fld_TicketDesc' => $ticket_data->Error->ErrorMessage,
					'fbook_ob_booking_status' => "Failed" 
				);
				$this->Flight_Model->update_booking ( $data, $booking_id );
				redirect ( "/flight/booking_error?sessionid=" . $bookingdata->fbook_sessionid );
			}
		} else {
			redirect ( "/flight/booking_error?sessionid=" . $bookingdata->fbook_sessionid );
		}
	}
	

	function ticket_lcc($booking_id = NULL, $sessiondata = NULL, $sessionid, $tickettype) {
		
		
		$TraceId = $sessiondata ['confirm_price']->Response->TraceId;
		$ResultIndex = $sessiondata ['confirm_price']->Response->Results->ResultIndex;
		$FBreakDwn = $sessiondata ['confirm_price']->Response->Results->FareBreakdown;
		
		
		if ($_SESSION ['flight'] [$sessionid] ['search_RequestData'] ["IsDomestic"] == "false") {
			
			$customer_data = $_SESSION ['flight'] [$sessionid] ['farequote_data'] ['customer_data'];
		} else {
			if ($_SESSION ['flight'] [$sessionid] ['search_RequestData'] ['type'] == "OneWay") {
				$customer_data = $_SESSION ['flight'] [$sessionid] ['farequote_data'] ['customer_data'];
				
				
			} else {
				
				$customer_data = $_SESSION ['flight'] [$sessionid] ['farequote_data_OB'] ['customer_data'];
			}
		}
		
		
		
		$passenger = array ();
		$bhanu_i = 0;
		foreach ( $FBreakDwn as $val ) {
			$noOfPx = $val->PassengerCount;
			for($i = 1; $i <= $noOfPx; $i ++) {
				$fld_pax_type = passanger_t_f_number ( $val->PassengerType );
				if ($customer_data [$fld_pax_type . "Gender_" . $i] == "Female") {
					$bhanu_gender = "2";
				} else {
					$bhanu_gender = "1";
				}
				if ($_SESSION ['flight'] [$sessionid] ['search_RequestData'] ['IsDomestic'] == "true") {
					$bhanu_passport_no = "";
					$bhanu_passport_expiry = "";
					$PassportIssueDate = "";
					$PassportIssueCountryCode = "";
					$bhanu_address_line1 = "A152 Ashok Nagar";
					$bhanu_city = "Delhi";
					$bhanu_country_code = "IN";
					$bhanu_country = "INDIA";
					if ($val->PassengerType == "1") {
						$bhanu_dob = "";
					} else {
						$bhanu_dob = date ( "Y-m-d", strtotime ( $customer_data [$fld_pax_type . "Date_" . $i] ) );
					}
				} else {
					$bhanu_passport_no = $customer_data [$fld_pax_type . "PassportNum_" . $i];
					$bhanu_passport_expiry = date ( "Y-m-d", strtotime ( $customer_data [$fld_pax_type . "PassExpDate_" . $i] ) );
					$bhanu_dob = date ( "Y-m-d", strtotime ( $customer_data [$fld_pax_type . "Date_" . $i] ) );
					$bhanu_address_line1 = $this->u_address1;
					$bhanu_city = $this->u_city;
					$countrycode = explode ( "_", $customer_data ["AdultIssuingCntry_1"] );
					$bhanu_country_code = $countrycode [0];
					$bhanu_country = $countrycode [1];
				}
				if ($bhanu_i == 0) {
					$bhanu_lead_pax = 1;
				} else {
					$bhanu_lead_pax = 0;
				}


				if (isset($customer_data['GSTAllowed'])) {
					$bhanu_passenge = array(
						"Title" => $customer_data [$fld_pax_type . "Title_" . $i],
						"FirstName" => $customer_data [$fld_pax_type . "FirstName_" . $i],
						"LastName" => $customer_data [$fld_pax_type . "LastName_" . $i],
						"PaxType" => $val->PassengerType,
						"DateOfBirth" => $bhanu_dob,
						"Gender" => $bhanu_gender,						
						"PassportNo" => $bhanu_passport_no,
						"PassportExpiry" => $bhanu_passport_expiry,
						"PassportIssueDate" => $PassportIssueDate,
						"PassportIssueCountryCode" => $PassportIssueCountryCode,
						"AddressLine1" => $bhanu_address_line1,
						"City" => $bhanu_city,
						"CountryCode" => $bhanu_country_code,
						"CountryName" => $bhanu_country,
						"ContactNo" => $customer_data ['cust_mobile_no'],
						"Email" => $customer_data ['cust_email'],
						"IsLeadPax" => $bhanu_lead_pax,
						"GSTCompanyAddress" => $customer_data['GSTCompanyAddress'],
						"GSTCompanyContactNumber" => $customer_data['GSTCompanyContactNumber'],
						"GSTCompanyName" => $customer_data['GSTCompanyName'],
						"GSTNumber" => $customer_data['GSTNumber'],
						"GSTCompanyEmail" => $customer_data['GSTCompanyEmail'],
						"Fare" => [
							array(
								"BaseFare" => $val->BaseFare,
								"Tax" => $val->Tax,
								"TransactionFee" => "0",
								"YQTax" => $val->YQTax,
								"AdditionalTxnFeeOfrd" => $val->AdditionalTxnFeeOfrd,
								"AdditionalTxnFeePub" => $val->AdditionalTxnFeePub,
								"AirTransFee" => "0",
							),
						],
					);

				} else {

					$bhanu_passenge = array (
						"Title" => $customer_data [$fld_pax_type . "Title_" . $i],
						"FirstName" => $customer_data [$fld_pax_type . "FirstName_" . $i],
						"LastName" => $customer_data [$fld_pax_type . "LastName_" . $i],
						"PaxType" => $val->PassengerType,
						"DateOfBirth" => $bhanu_dob,
						"Gender" => $bhanu_gender,						
						"PassportNo" => $bhanu_passport_no,
						"PassportExpiry" => $bhanu_passport_expiry,
						"PassportIssueDate" => $PassportIssueDate,
						"PassportIssueCountryCode" => $PassportIssueCountryCode,
						"AddressLine1" => $bhanu_address_line1,
						"City" => $bhanu_city,
						"CountryCode" => $bhanu_country_code,
						"CountryName" => $bhanu_country,
						"ContactNo" => $customer_data ['cust_mobile_no'],
						"Email" => $customer_data ['cust_email'],
						"IsLeadPax" => $bhanu_lead_pax,
						"Fare" => [ 
							array (									
								"BaseFare" => $val->BaseFare,
								"Tax" => $val->Tax,
								"TransactionFee" => "0",
								"YQTax" => $val->YQTax,
								"AdditionalTxnFeeOfrd" => $val->AdditionalTxnFeeOfrd,
								"AdditionalTxnFeePub" => $val->AdditionalTxnFeePub,
								"AirTransFee" => "0" 
							) 
						] 
					);

				}
				array_push ( $passenger, $bhanu_passenge );
				$bhanu_i ++;
			}
		}
		// print_r($passenger);die;
		
		
		 //$this->db_token();
		$search_data_tbo = array(
			"EndUserIp" => $this->EndUserIp,
			"TokenId" => $this->TokenId,				
			"TraceId" => $TraceId,
			"ResultIndex" => $ResultIndex,
			"Passengers" => $passenger,
		);
		$data_string = json_encode($search_data_tbo);
		$ch = curl_init($this->url . '/Ticket/');
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'Content-Length: ' . strlen($data_string)
		));
		$result = curl_exec($ch);
		$arrayresult = json_decode($result);

		if ($tickettype == "OB") {
			$_SESSION ['flight'] [$sessionid] ['ticket_request_data'] = $data_string;
			$_SESSION ['flight'] [$sessionid] ['ticket_result_data'] = $result;
		} else {
			$_SESSION ['flight'] [$sessionid] ['ticket_request_data_IB'] = $data_string;
			$_SESSION ['flight'] [$sessionid] ['ticket_result_data_IB'] = $result;
		}
		return $arrayresult;

	}	
	
	//Return ticket Booking
	
	public function return_ticket_OB($booking_id, $bookingdata) {
		$sessiondata = $_SESSION ['flight'] [$bookingdata->fbook_sessionid] ['farequote_data_OB'];
		if ($_SESSION ['flight'] [$bookingdata->fbook_sessionid] ['farequote_data_OB'] ['IsLCC'] == "true") {
			
			$ticket_result = $this->ticket_lcc( $booking_id, $sessiondata, $bookingdata->fbook_sessionid, "OB" );
			// print_r($ticket_result);die;

			$ticket_data = $ticket_result;
			
			
			
			if ($ticket_data->Response->Error->ErrorCode == "0" && isset ( $ticket_data->Response->Response->PNR )) {
				
				$BookingRes = json_encode ( $ticket_data );
				$search_data = array (
					'ftemp_ref_id' => $booking_id,
					'ftemp_user_type' => "DSA",
					'ftemp_user_id' => $this->dsa_data->dsa_id,
					'ftemp_key' => "ob_ticket",
					'ftemp_data' => $BookingRes 
				);
				$this->Flight_Model->insert_temp ( $search_data );
				$data = array (
					'fbook_ob_pnr' => $ticket_data->Response->Response->PNR,
					'fbook_ob_booking_id' => $ticket_data->Response->Response->BookingId,
					'fbook_ob_booking_status' => "Success" 
				);
				$this->Flight_Model->update_booking ( $data, $booking_id );
				
				return "success";
			} else {
				$_SESSION ['flight'] [$bookingdata->fbook_sessionid] ['farequote_data'] ['error'] = $ticket_data->Response->Error->ErrorMessage;
				$BookingRes = json_encode ( $ticket_data );
				$data = array (
						// 'Fld_TicketDesc' => $ticket_data->Error->ErrorMessage,
					'fbook_ob_booking_status' => "Failed" 
				);
				$this->Flight_Model->update_booking ( $data, $booking_id );
				redirect ( "/flight/booking_error?sessionid=" . $bookingdata->fbook_sessionid );
			}
		} else {
			
			$book_result = $this->hold( $booking_id, $sessiondata, $bookingdata->fbook_sessionid, "OB" );
			$book_data = json_decode ( $_SESSION ['flight'] [$bookingdata->fbook_sessionid] ['hold_result_data'] );
			
			if ($book_data->Response->Error->ErrorCode == "0" && isset ( $book_data->Response->Response->PNR )) {
				$BookingRes = json_encode ( $book_data );
				$stempbook_data = array (
					'ftemp_ref_id' => $booking_id,
					'ftemp_user_type' => "DSA",
					'ftemp_user_id' => $this->dsa_data->dsa_id,
					'ftemp_key' => "ob_book",
					'ftemp_data' => $BookingRes 
				);
				$this->Flight_Model->insert_temp ( $stempbook_data );
				$data = array (
					'fbook_ib_pnr' => $book_data->Response->Response->PNR,
					'fbook_ib_booking_id' => $book_data->Response->Response->BookingId,
					'fbook_ib_booking_status' => "Hold" 
				);
				$this->Flight_Model->update_booking ( $data, $booking_id );
				$ticket_result = $this->ticket_gds ( $book_data->Response->PNR, $book_data->Response->Response->BookingId, $sessiondata, $bookingdata->fbook_sessionid, "OB" );
				$ticket_data = $ticket_result;
				if ($ticket_data->Response->Error->ErrorCode == "0" && isset ( $ticket_data->Response->Response->PNR )) {
					$ticketRes = json_encode ( $ticket_data );
					$tempticket_data = array (
						'ftemp_ref_id' => $booking_id,
						'ftemp_user_type' => "DSA",
						'ftemp_user_id' => $this->dsa_data->dsa_id,
						'ftemp_key' => "ob_ticket",
						'ftemp_data' => $ticketRes 
					);
					$this->Flight_Model->insert_temp ( $tempticket_data );
					$data = array (
						'fbook_ob_pnr' => $book_data->Response->Response->PNR,
						'fbook_ob_booking_id' => $book_data->Response->Response->BookingId,
						'fbook_ob_booking_status' => "Success" 
					);
					$this->Flight_Model->update_booking ( $data, $booking_id );
					return "success";
				} else {
					$_SESSION ['flight'] [$bookingdata->fbook_sessionid] ['farequote_data'] ['error'] = $ticket_data->Error->ErrorMessage;
					redirect ( "/flight/booking_error?sessionid=" . $bookingdata->fbook_sessionid );
				}
			}
		}
	}
	
	public function return_ticket_IB($booking_id, $bookingdata) {
		
		if ($_SESSION ['flight'] [$bookingdata->fbook_sessionid] ['farequote_data_IB'] ['IsLCC'] == "true") {
			
			$sessiondata = $_SESSION ['flight'] [$bookingdata->fbook_sessionid] ['farequote_data_IB'];
			
			$ticket_result = $this->ticket_lcc ( $booking_id, $sessiondata, $bookingdata->fbook_sessionid, "IB" );
			
			
			$ticket_data = $ticket_result;
			
			if ($ticket_data->Response->Error->ErrorCode == "0" && isset ( $ticket_data->Response->Response->PNR )) {
				
				$BookingRes = json_encode ( $ticket_data );
				$search_data = array (
					'ftemp_ref_id' => $booking_id,
					'ftemp_user_type' => "DSA",
					'ftemp_user_id' => $this->dsa_data->dsa_id,
					'ftemp_key' => "ib_ticket",
					'ftemp_data' => $BookingRes 
				);
				$this->Flight_Model->insert_temp ( $search_data );
				$data = array (
					'fbook_ib_pnr' => $ticket_data->Response->Response->PNR,
					'fbook_ib_booking_id' => $ticket_data->Response->Response->BookingId,
					'fbook_ib_booking_status' => "Success" 
				);
				$this->Flight_Model->update_booking ( $data, $booking_id );
				$sessiondataIB = $_SESSION ['flight'] [$bookingdata->fbook_sessionid] ['farequote_data_IB'];
				
				return "success";
			} else {
				$_SESSION ['flight'] [$bookingdata->fbook_sessionid] ['farequote_data'] ['error'] = $ticket_data->Response->Error->ErrorMessage;
				$BookingRes = json_encode ( $ticket_data );
				$data = array (
						// 'Fld_TicketDesc' => $ticket_data->Error->ErrorMessage,
					'fbook_ib_booking_status' => "Failed" 
				);
				$this->Flight_Model->update_booking ( $data, $booking_id );
				redirect ( "/flight/booking_error?sessionid=" . $bookingdata->fbook_sessionid );
			}
		} else {
			
			$sessiondataIB = $_SESSION ['flight'] [$bookingdata->fbook_sessionid] ['farequote_data_IB'];
			$book_result = $this->hold ( $booking_id, $sessiondataIB, $bookingdata->fbook_sessionid, "IB" );
			$book_data = $book_result;
			
			if ($book_data->Response->Error->ErrorCode == "0" && isset ( $book_data->Response->Response->PNR )) {
				$BookingRes = json_encode ( $book_data );
				$stempbook_data = array (
					'ftemp_ref_id' => $booking_id,
					'ftemp_user_type' => "DSA",
					'ftemp_user_id' => $this->dsa_data->dsa_id,
					'ftemp_key' => "ib_book",
					'ftemp_data' => $BookingRes 
				);
				$this->Flight_Model->insert_temp ( $stempbook_data );
				$data = array (
					'fbook_ib_pnr' => $book_data->Response->Response->PNR,
					'fbook_ib_booking_id' => $book_data->Response->Response->BookingId,
					'fbook_ib_booking_status' => "Hold" 
				);
				$this->Flight_Model->update_booking ( $data, $booking_id );
				
				$ticket_resultIB = $this->ticket_gds ( $book_data->Response->Response->PNR, $book_data->Response->Response->BookingId, $sessiondataIB, $bookingdata->fbook_sessionid, "IB" );
				
				$ticket_dataIB = $ticket_resultIB;
				
				if ($ticket_dataIB->Response->Error->ErrorCode == "0" && isset ( $ticket_dataIB->Response->Response->PNR ) && $ticket_dataIB->Response->Response->TicketStatus == "1") {
					$ticketResIB = json_encode ( $ticket_dataIB );
					$tempticket_dataIB = array (
						'ftemp_ref_id' => $booking_id,
						'ftemp_user_type' => "DSA",
						'ftemp_user_id' => $this->dsa_data->dsa_id,
						'ftemp_key' => "ib_ticket",
						'ftemp_data' => $ticketResIB 
					);
					$this->Flight_Model->insert_temp ( $tempticket_dataIB );
					$data = array (
						'fbook_ib_pnr' => $book_data->Response->Response->PNR,
						'fbook_ib_booking_id' => $book_data->Response->Response->BookingId,
						'fbook_ib_booking_status' => "Success" 
					);
					$this->Flight_Model->update_booking ( $data, $booking_id );
					redirect ( '/flight/get_booking/' . $booking_id );
				} else {
					
					if ($ticket_dataIB->Response->Error->ErrorCode != "0") {
						$_SESSION ['flight'] [$bookingdata->fbook_sessionid] ['farequote_data'] ['error'] = $ticket_dataIB->Response->Error->ErrorMessage;
					} else {
						
						$_SESSION ['flight'] [$bookingdata->fbook_sessionid] ['farequote_data'] ['error'] = $ticket_dataIB->Response->Error->ErrorMessage;
					}
					redirect ( "/flight/booking_error?sessionid=" . $bookingdata->fbook_sessionid );
				}
			}
		}
	}
	
	
	//get bookingData
	
	public function get_booking($booking_id) {		
		$refId = $booking_id;
		$encrypted_string = url_encode ( $refId );
		$SelectedFare = $this->Flight_Model->get_search_detail ( $booking_id, 'ob_ticket' );		
		$Sel_detail = json_decode ( $SelectedFare->ftemp_data );		
		$BookingDetails = $this->Flight_Model->get_booking_by_id ( $refId );
		$FareDetail = $BookingDetails;
		$PaxDetail = $this->Flight_Model->get_pax_by_id ( $refId );	
		$Fld_Type = $FareDetail->fbook_booking_type;
		$Fld_IsDomestic = $FareDetail->fbook_is_domestic;
		$Fld_TicketStatus = $FareDetail->fbook_ob_booking_status;	
		$data ['SelectedFare'] = $Sel_detail;
		$data ['BookingDetails'] = $FareDetail;
		$data ['PaxDetails'] = $PaxDetail;		
		$data ['refId'] = $refId;
		$data ['email_send'] = "true";	
		if ($Fld_TicketStatus == "Success") {
			
			if ($Fld_Type == "Return" && $Fld_IsDomestic == "true") {
				$SelectedFareIB = $this->Flight_Model->get_search_detail ( $refId, 'ib_ticket' );
				
				$Sel_detailIB = json_decode ( $SelectedFareIB->ftemp_data );
				$data ['SelectedFareIB'] = $Sel_detailIB;
				
				$message = $this->load->view ( 'flight/ticket/ticket_return_dom', $data, TRUE );
			} else if ($Fld_Type == "Return" && $Fld_IsDomestic == "false") {
				$message = $this->load->view ( 'flight/ticket/ticket_return_int', $data, TRUE );
			} else {
				$message = $this->load->view ( 'flight/ticket/onewayticket', $data, TRUE );
			}
			
			//INVOICE
			
			$SelectedFare = $this->Flight_Model->get_search_detail ( $refId, 'ob_ticket' );
			$Sel_detail = json_decode ( $SelectedFare->ftemp_data);
			$BookingDetails = $this->Flight_Model->get_booking_by_id ( $refId );
			$FareDetail = $BookingDetails;
			$PaxDetail = $this->Flight_Model->get_pax_by_id ( $refId );
			$Fld_Type = $FareDetail->fbook_booking_type;
			$Fld_IsDomestic = $FareDetail->fbook_is_domestic;
			$Fld_TicketStatus = $FareDetail->fbook_ob_booking_status;
			$data ['SelectedFare'] = $Sel_detail;
			$data ['BookingDetails'] = $FareDetail;
			$data ['PaxDetails'] = $PaxDetail;
			$data ['refId'] = $refId;
			if ($Fld_TicketStatus == "Success") {
				if ($Fld_Type == "Return" && $Fld_IsDomestic == "true") {
					$SelectedFareIB = $this->Flight_Model->get_search_detail ( $refId, 'ib_ticket' );
					$Sel_detailIB = json_decode ( $SelectedFareIB->ftemp_data );
					$data ['SelectedFareIB'] = $Sel_detailIB;
					$invoice = $this->load->view ( 'flight/invoice/return_invoice_dom', $data, TRUE );
				} else if ($Fld_Type == "Return" && $Fld_IsDomestic == "false") {
					$invoice = $this->load->view ( 'flight/invoice/onewayinvoice', $data, TRUE );
				} else {
					$invoice = $this->load->view ( 'flight/invoice/onewayinvoice', $data, TRUE );
				}
			}
			
			$mail_id = $data ['PaxDetails'] [0]->fpax_email;
			$sender_subject = "Your flight booked successful ( Booking ID : " . $data ['PaxDetails'] [0]->fpax_booking_id . ")";
			$this->load->library('m_pdf');
			$pdf = $this->m_pdf->load();
			$pdfsss = $pdf->WriteHTML($message,2);
			$content = $pdf->Output('', 'S');
			
			$pdf1 = $this->m_pdf->load();
			$pdfsss1 = $pdf1->WriteHTML($invoice,2);
			$content1 = $pdf1->Output('', 'S');
			
			email_send_pdf($mail_id, $sender_subject, $message,$content,$content1);
			email_send ( "info@smarttripmaker.com", "Booking Success", $message );
			// email_send_pdf($mail_id, $sender_subject, $message, $emailconfig,$content);
			//$ch = email_send ( $mail_id, $sender_subject, $message, $emailconfig );
			//print_r($dsaemailsetting); exit;
			redirect ( '/flight/flight_booking_confirm/?ref_no=' . $encrypted_string );
		}
	}
	
	
	public function flight_booking_confirm() {
		// $this->load->library('m_pdf');
		$key = 'flightbook';
		$refId = url_decode ( $_GET ['ref_no'] );
		$SelectedFare = $this->Flight_Model->get_search_detail ( $refId, 'ob_ticket' );
		// print_r($SelectedFare);
		// die;
		$Sel_detail = json_decode($SelectedFare->ftemp_data);
		// print_r($Sel_detail);
		// die;
		$BookingDetails = $this->Flight_Model->get_booking_by_id ( $refId );
		$FareDetail = $BookingDetails;
		$PaxDetail = $this->Flight_Model->get_pax_by_id ( $refId );
		// $Pax_c_Detail = $this->Flight_Model->get_pax_c_by_id ( $refId );
		$Fld_Type = $FareDetail->fbook_booking_type;
		$Fld_IsDomestic = $FareDetail->fbook_is_domestic;
		$Fld_TicketStatus = $FareDetail->fbook_ob_booking_status;
		// $Fld_TicketDesc = $FareDetail->Fld_TicketDesc;
		$data ['SelectedFare'] = $Sel_detail;
		$data ['BookingDetails'] = $FareDetail;
		$data ['PaxDetails'] = $PaxDetail;
		// $data ['Pax_c_Detail'] = $Pax_c_Detail;
		$data ['refId'] = $refId;
		
		if ($Fld_TicketStatus == "Success") {
			
			if ($Fld_Type == "Return" && $Fld_IsDomestic == "true") {
				$SelectedFareIB = $this->Flight_Model->get_search_detail ( $refId, 'ib_ticket' );
				// print_r($refId);
				// die;
				$Sel_detailIB = json_decode ( $SelectedFareIB->ftemp_data );
				$data ['SelectedFareIB'] = $Sel_detailIB;
				
				$this->load->view ( 'flight/flight_success_return', $data );
			} else if ($Fld_Type == "Return" && $Fld_IsDomestic == "false") {
				
				$this->load->view ( 'flight/flight_success_return_int', $data );
			} else {

				// echo "<pre>";
				// print_r($data);die;
				$this->load->view ( 'flight/flight_success', $data );
			}
		} else {
			$this->load->view ( '/flight/booking_error', $data );
		}
	}
	
	//HOLD	
	public function hold($booking_id = NULL, $sessiondata = NULL, $sessionid, $tickettype) {
		
		$TraceId = $sessiondata ['confirm_price']->Response->TraceId; 
		$ResultIndex = $sessiondata ['confirm_price']->Response->Results->ResultIndex;	
		
		$FBreakDwn = $sessiondata ['confirm_price']->Response->Results->FareBreakdown;
		if ($_SESSION ['flight'] [$sessionid] ['search_RequestData'] ["IsDomestic"] == "true" && $_SESSION ['flight'] [$sessionid] ['search_RequestData'] ['type'] == "Return") {			
			$customer_data = $_SESSION ['flight'] [$sessionid] ['farequote_data_OB'] ['customer_data'];
		} else {
			$customer_data = $_SESSION ['flight'] [$sessionid] ['farequote_data'] ['customer_data'];
		}
		$passenger = array ();
		$bhanu_i = 0;
		foreach ( $FBreakDwn as $val ) {
			$noOfPx = $val->PassengerCount;
			for($i = 1; $i <= $noOfPx; $i ++) {
				$fld_pax_type = passanger_t_f_number ( $val->PassengerType );
				if ($customer_data [$fld_pax_type . "Gender_" . $i] == "Female") {
					$bhanu_gender = "2";
				} else {
					$bhanu_gender = "1";
				}
				if ($_SESSION ['flight'] [$sessionid] ['search_RequestData'] ['IsDomestic'] == "true") {
					$bhanu_passport_no = "";
					$bhanu_passport_expiry = "";
					$PassportIssueDate = "";
					$PassportIssueCountryCode = "";
					$bhanu_address_line1 = "A152 Ashok Nagar";
					$bhanu_city = "Delhi";
					$bhanu_country_code = "IN";
					$bhanu_country = "INDIA";
					if ($val->PassengerType == "1") {
						$bhanu_dob = "";
					} else {
						$bhanu_dob = date ( "Y-m-d", strtotime ( $customer_data [$fld_pax_type . "Date_" . $i] ) );
					}
				} else {
					$bhanu_passport_no = $customer_data [$fld_pax_type . "PassportNum_" . $i];
					$bhanu_passport_expiry = date ( "Y-m-d", strtotime ( $customer_data [$fld_pax_type . "PassExpDate_" . $i] ) );
					$bhanu_dob = date ( "Y-m-d", strtotime ( $customer_data [$fld_pax_type . "Date_" . $i] ) );
					$bhanu_address_line1 = $this->u_address1;
					$bhanu_city = $this->u_city;
					$countrycode = explode ( "_", $customer_data ["AdultIssuingCntry_1"] );
					$bhanu_country_code = $countrycode [0];
					$bhanu_country = $countrycode [1];
				}
				if ($bhanu_i == 0) {
					$bhanu_lead_pax = 1;
				} else {
					$bhanu_lead_pax = 0;
				}
				
				if (isset($customer_data['GSTAllowed'])) {
					$bhanu_passenge = array(
						"Title" => $customer_data [$fld_pax_type . "Title_" . $i],
						"FirstName" => $customer_data [$fld_pax_type . "FirstName_" . $i],
						"LastName" => $customer_data [$fld_pax_type . "LastName_" . $i],
						"PaxType" => $val->PassengerType,
						"DateOfBirth" => $bhanu_dob,
						"Gender" => $bhanu_gender,						
						"PassportNo" => $bhanu_passport_no,
						"PassportExpiry" => $bhanu_passport_expiry,
						// "PassportIssueDate" => $PassportIssueDate,
						// "PassportIssueCountryCode" => $PassportIssueCountryCode,
						"AddressLine1" => $bhanu_address_line1,
						"City" => $bhanu_city,
						"CountryCode" => $bhanu_country_code,
						"CountryName" => $bhanu_country,
						"ContactNo" => $customer_data ['cust_mobile_no'],
						"Email" => $customer_data ['cust_email'],
						"IsLeadPax" => $bhanu_lead_pax,
						"GSTCompanyAddress" => $customer_data['GSTCompanyAddress'],
						"GSTCompanyContactNumber" => $customer_data['GSTCompanyContactNumber'],
						"GSTCompanyName" => $customer_data['GSTCompanyName'],
						"GSTNumber" => $customer_data['GSTNumber'],
						"GSTCompanyEmail" => $customer_data['GSTCompanyEmail'],
						"Fare" => [
							array(
								"BaseFare" => $val->BaseFare,
								"Tax" => $val->Tax,
								"TransactionFee" => "0",
								"YQTax" => $val->YQTax,
								"AdditionalTxnFeeOfrd" => $val->AdditionalTxnFeeOfrd,
								"AdditionalTxnFeePub" => $val->AdditionalTxnFeePub,
								"AirTransFee" => "0",
							),
						],
					);

				} else {

					$bhanu_passenge = array (
						"Title" => $customer_data [$fld_pax_type . "Title_" . $i],
						"FirstName" => $customer_data [$fld_pax_type . "FirstName_" . $i],
						"LastName" => $customer_data [$fld_pax_type . "LastName_" . $i],
						"PaxType" => $val->PassengerType,
						"DateOfBirth" => $bhanu_dob,
						"Gender" => $bhanu_gender,
						"PassportNo" => $bhanu_passport_no,
						"PassportExpiry" => $bhanu_passport_expiry,
						// "PassportIssueDate" => $PassportIssueDate,
						// "GSTCompanyAddress" => "Noida",
						// "GSTCompanyContactNumber" => "9874563210",
						// "GSTCompanyName" => "SRDV",
						// "GSTNumber" => "29abcde12342z5",
						// "GSTCompanyEmail" => "test@gmail.com",
						// "PassportIssueCountryCode" => $PassportIssueCountryCode,
						"AddressLine1" => $bhanu_address_line1,
						"City" => $bhanu_city,
						"CountryCode" => $bhanu_country_code,
						"CountryName" => $bhanu_country,
						"ContactNo" => $customer_data ['cust_mobile_no'],
						"Email" => $customer_data ['cust_email'],
						"IsLeadPax" => $bhanu_lead_pax,
						"Fare" => [ 
							array (
								"BaseFare" => $val->BaseFare,
								"Tax" => $val->Tax,
								"TransactionFee" => "0",
								"YQTax" => $val->YQTax,
								"AdditionalTxnFeeOfrd" => $val->AdditionalTxnFeeOfrd,
								"AdditionalTxnFeePub" => $val->AdditionalTxnFeePub,
								"AirTransFee" => "0" 
							) 
						] 
					);

				}
				
				
				array_push ( $passenger, $bhanu_passenge );
				$bhanu_i ++;
			}
		}

 //$this->db_token();
		
		$search_data_tbo = array(
			"EndUserIp" => $this->EndUserIp,
			"TokenId" => $this->TokenId,
			// "TokenId" => "c208ecc9-c4aa-4279-9da3-15585901e334",
			"TraceId" => $TraceId,
			"ResultIndex" => $ResultIndex,
			"Passengers" => $passenger,
		);
		$data_string = json_encode($search_data_tbo);
		$ch = curl_init($this->url . '/Book/');
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'Content-Length: ' . strlen($data_string)
		));
		$result = curl_exec($ch);
		$arrayresult = json_decode($result);
		if ($tickettype == "OB") {
			$_SESSION ['flight'] [$sessionid] ['hold_request_data'] = $data_string;
			$_SESSION ['flight'] [$sessionid] ['hold_result_data'] = $result;
		} else {
			$_SESSION ['flight'] [$sessionid] ['hold_request_data_IB'] = $data_string;
			$_SESSION ['flight'] [$sessionid] ['hold_result_data_IB'] = $result;
		}
		return $arrayresult;
		
	}


//TICKET GDS
	public function ticket_gds($pnr, $booking_id, $sessiondata, $sessionid, $tickettype) {
		 //$this->db_token();
		$TraceId = $sessiondata ['confirm_price']->Response->TraceId;
		$search_data_tbo = array(
			"EndUserIp" => $this->EndUserIp,
			"TokenId" => $this->TokenId,
			 // "TokenId" => "c208ecc9-c4aa-4279-9da3-15585901e334",
			"TraceId" => $TraceId,
			"PNR" => $pnr,
			"BookingId" => $booking_id,
		);
		$data_string = json_encode($search_data_tbo);
		$ch = curl_init($this->url . '/Ticket/');
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'Content-Length: ' . strlen($data_string)
		));
		$result = curl_exec($ch);
		$arrayresult = json_decode($result);
		if ($tickettype == "OB") {
			$_SESSION ['flight'] [$sessionid] ['ticket_request_data'] = $data_string;
			$_SESSION ['flight'] [$sessionid] ['ticket_result_data'] = $result;
		} else {
			$_SESSION ['flight'] [$sessionid] ['ticket_request_data_IB'] = $data_string;
			$_SESSION ['flight'] [$sessionid] ['ticket_result_data_IB'] = $result;
		}
		return $arrayresult;
	}
	
	
	
	public function print_ticket() {
		// $key = 'flightbook';
		$refId = bp_hash ( $_GET ['ref_id'] );
		$SelectedFare = $this->Flight_Model->get_search_detail ( $refId, 'ob_ticket' );
		
		// echo "<pre>";
		// print_r($SelectedFare);
		// die;
		
		$Sel_detail = json_decode ( $SelectedFare->ftemp_data );
		$BookingDetails = $this->Flight_Model->get_booking_by_id ( $refId );
		$FareDetail = $BookingDetails;
		$PaxDetail = $this->Flight_Model->get_pax_by_id ( $refId );
		// $Pax_c_Detail = $this->Flight_Model->get_pax_c_by_id ( $refId );
		$Fld_Type = $FareDetail->fbook_booking_type;
		$Fld_IsDomestic = $FareDetail->fbook_is_domestic;
		$Fld_TicketStatus = $FareDetail->fbook_ob_booking_status;
		// $Fld_TicketDesc = $FareDetail->Fld_TicketDesc;
		$data ['SelectedFare'] = $Sel_detail;
		$data ['BookingDetails'] = $FareDetail;
		$data ['PaxDetails'] = $PaxDetail;
		// $data ['Pax_c_Detail'] = $Pax_c_Detail;
		$data ['refId'] = $refId;
		
		if ($Fld_TicketStatus == "Success") {
			if ($Fld_Type == "Return" && $Fld_IsDomestic == "true") {
				$SelectedFareIB = $this->Flight_Model->get_search_detail ( $refId, 'ib_ticket' );
				$Sel_detailIB = json_decode ( $SelectedFareIB->ftemp_data );
				$data ['SelectedFareIB'] = $Sel_detailIB;
				$this->load->view ( 'flight/ticket/ticket_return_dom', $data );
			} else if ($Fld_Type == "Return" && $Fld_IsDomestic == "false") {
				$this->load->view ( 'flight/ticket/ticket_return_int', $data );
			} else {
				$this->load->view ( 'flight/ticket/onewayticket', $data );
			}
		} else {
			redirect ( "/flight/booking_error?sessionid=" . $bookingdata->fbook_sessionid );
		}
	}
	public function print_invoice() {
		$refId = bp_hash ( $_GET ['ref_id'] );
		$SelectedFare = $this->Flight_Model->get_search_detail ( $refId, 'ob_ticket' );
		$Sel_detail = json_decode ( $SelectedFare->ftemp_data);
		$BookingDetails = $this->Flight_Model->get_booking_by_id ( $refId );
		$FareDetail = $BookingDetails;
		$PaxDetail = $this->Flight_Model->get_pax_by_id ( $refId );
		$Fld_Type = $FareDetail->fbook_booking_type;
		$Fld_IsDomestic = $FareDetail->fbook_is_domestic;
		$Fld_TicketStatus = $FareDetail->fbook_ob_booking_status;
		$data ['SelectedFare'] = $Sel_detail;
		$data ['BookingDetails'] = $FareDetail;
		$data ['PaxDetails'] = $PaxDetail;
		$data ['refId'] = $refId;
		if ($Fld_TicketStatus == "Success") {
			if ($Fld_Type == "Return" && $Fld_IsDomestic == "true") {
				$SelectedFareIB = $this->Flight_Model->get_search_detail ( $refId, 'ib_ticket' );
				$Sel_detailIB = json_decode ( $SelectedFareIB->ftemp_data );
				$data ['SelectedFareIB'] = $Sel_detailIB;
				$this->load->view ( 'flight/invoice/return_invoice_dom', $data );
			} else if ($Fld_Type == "Return" && $Fld_IsDomestic == "false") {
				$this->load->view ( 'flight/invoice/onewayinvoice', $data );
			} else {
				$this->load->view ( 'flight/invoice/onewayinvoice', $data );
			}
		} else {
			redirect ( "/flight/booking_error?sessionid=" . $bookingdata->fbook_sessionid );
		}
	}
	public function booking_error() {
		$session_id =  ( $_GET ['sessionid'] );		
		$BookingDetails = $this->Flight_Model->get_booking_by_session_id ( $session_id );
		$booking_id =  $BookingDetails->fbook_id;	
		$PaxDetail = $this->Flight_Model->get_pax_by_id ( $BookingDetails->fbook_id );
		$SelectedFare = $this->Flight_Model->get_search_detail ( $booking_id, 'ob_ticket' );
		$Sel_detail = json_decode ( $SelectedFare->ftemp_data);
		$data ['BookingDetails'] = $BookingDetails;
		$data ['PaxDetails'] = $PaxDetail;
		$data ['SelectedFare'] = $Sel_detail;
		$message = $this->load->view ( 'flight/ticket/notification_page', $data, TRUE );
		
		email_send ( "info@smarttripmaker.com", "Booking Failed", $message );
		$this->load->view ( "flight/booking_error" );
	}
	
	
	
	
	public function payment_error() {
		$this->load->view ( "flight/payment_error" );
	}


	function returnbookingdata($searchData, $sessionid, $cusid, $transaction_fee) {
		$totalFare = str_replace ( ",", "", $_SESSION ['flight'] [$sessionid] ['flight_total_fare_return'] );
		$FBreakDwn = $_SESSION ['flight'] [$sessionid] ['farequote_data_OB'] ['confirm_price']->Response->Results->FareBreakdown;
		$segment = $_SESSION ['flight'] [$sessionid] ['farequote_data_OB'] ['confirm_price']->Response->Results->Segments [0];
		$segmentIB = $_SESSION ['flight'] [$sessionid] ['farequote_data_IB'] ['confirm_price']->Response->Results->Segments [0];
		$segcountoneword = count ( $segment );
		$departdataonword = $segment [0]->Origin;
		$arriveldataonword = $segment [$segcountoneword - 1]->Destination;
		
		
		
		$bookingData = array (
				// 'Fld_RefrenceId' => $ref_id,
			'fbook_total_fare' => str_replace ( ",", "", $_SESSION ['flight'] [$sessionid] ['flight_total_fare_OB'] ),
			'fbook_customer_fare' => str_replace ( ",", "", $_SESSION ['flight'] [$sessionid] ['flight_total_fare_OB'] ),
			'fbook_ib_total_fare' => str_replace ( ",", "", $_SESSION ['flight'] [$sessionid] ['flight_total_fare_IB'] ),
			'fbook_ib_customer_fare' => str_replace ( ",", "", $_SESSION ['flight'] [$sessionid] ['flight_total_fare_IB'] ),
			'fbook_booking_type' => $searchData ['type'],
			'fbook_depart_city' => $departdataonword->Airport->CityName,
			'fbook_depart_airport' => $departdataonword->Airport->AirportName,
			'fbook_depart_airport_code' => $departdataonword->Airport->AirportCode,
			'fbook_arrive_city' => $arriveldataonword->Airport->CityName,
			'fbook_arrive_airport' => $arriveldataonword->Airport->AirportName,
			'fbook_arrive_airport_code' => $arriveldataonword->Airport->AirportCode,
			'fbook_depart_date' => $searchData ['depart_date'],
			'fbook_return_date' => $searchData ['return_date'],
			'fbook_booking_type' => $searchData ['type'],
			'fbook_agent_fare' => "",
			'fbook_markup' => "",
			'fbook_discount' => "",
			'fbook_markup_detail' => "",
			'fbook_discount_detail' => "",
			'fbook_airline_name' => $segment [0]->Airline->AirlineName,
			'fbook_airline_code' => $segment [0]->Airline->AirlineCode,
			'fbook_ib_airline_name' => $segmentIB [0]->Airline->AirlineName,
			'fbook_ib_airline_code' => $segmentIB [0]->Airline->AirlineCode,
			'fbook_adult' => $searchData ['no_adult'],
			'fbook_child' => $searchData ['no_child'],
			'fbook_infant' => $searchData ['no_infants'],
			'fbook_agent_name' => "",
			'fbook_is_domestic' => $searchData ['IsDomestic'],
				// 'Fld_SearchSession' => $searchData ['TraceID'],
			'fbook_payment_status' => 'Pending',
			'fbook_ob_booking_status' => 'Pending',
			'fbook_ib_booking_status' => "Pending",
			'fbook_customer_id' => $cusid,
			'fbook_agent_id' => '',
			'fbook_contact_name' => $this->input->post ( 'AdultFirstName_1' ) . ' ' . $this->input->post ( 'AdultLastName_1' ),
			'fbook_contact_email' => $this->input->post ( 'cust_email' ),
			'fbook_contact_phone' => $this->input->post ( 'cust_mobile_no' ),
			'fbook_customer_name' => "",
			'fbook_user_type' => "DSA",
			'fbook_user_id' => $this->dsa_data->dsa_id,
			'fbook_remark' => "",
			'fbook_sessionid' => $sessionid,
			'fbook_module'	=> "B2C",
			'fbook_transaction_fee'	=> $transaction_fee,		
		);
		

		return $bookingData;
	}
	
	
	
	public function return_dom_selected_airline() {
		$flightIndexID = $this->input->post ( "flightIndexID" );
		$sessionID = $this->input->post ( "sessionID" );
		$faretype = $this->input->post ( "faretype" );
		$resultdata = json_decode ( $_SESSION ["flight"] [$sessionID] ["Search_Result_json"] );
		$flightdata = array ();
		if ($faretype == "OB") {
			$flightdata = $resultdata->Response->Results [0] [$flightIndexID];
		} else if ($faretype == "IB") {
			
			$flightdata = $resultdata->Response->Results [1] [$flightIndexID];
		}
		
		$data ["flightdata"] = $flightdata;
		$this->load->view ( "selected_airline_data", $data );
	}

	
	
	public function result_not_found() {
		$this->load->view ( "flight_result_not_found" );
	}
	
	
	public function cancel_request() {
		$refId = url_decode ( $_GET ['ref_id'] );
		$SelectedFare = $this->Flight_Model->get_search_detail ( $refId, 'ob_ticket' );
		if (! empty ( $SelectedFare )) {
			$Sel_detail = json_decode ( $SelectedFare->ftemp_data);
		} else {
			$Sel_detail = array ();
		}
		$BookingDetails = $this->Flight_Model->get_booking_by_id ( $refId );
		$FareDetail = $BookingDetails;
		$Sel_detailIB = "";
		if ($BookingDetails->fbook_booking_type == "Return") {
			$SelectedFareIB = $this->Flight_Model->get_search_detail ( $refId, 'ib_ticket' );
			$Sel_detailIB = json_decode ( $SelectedFareIB->ftemp_data);
		}
		$PaxDetail = $this->Flight_Model->get_pax_by_id ( $refId );
		$Fld_Type = $FareDetail->fbook_booking_type;
		$Fld_IsDomestic = $FareDetail->fbook_is_domestic;
		$Fld_TicketStatus = $FareDetail->fbook_ob_booking_status;
		$data ['SelectedFare'] = $Sel_detail;
		$data ['SelectedFareIB'] = $Sel_detailIB;
		$data ['BookingDetails'] = $FareDetail;
		$data ['PaxDetails'] = $PaxDetail;
		$data ['refId'] = $refId;
		
		
		
		$this->load->view ( "cancel_request", $data );
	}

	public function send_cancel_request() {
		$RequestMethod = $this->input->server ( 'REQUEST_METHOD' );
		if ($RequestMethod == "POST") {
			$bp_sector = array ();
			if ($this->input->post ( "Segmentlist" ) && $this->input->post ( "pax" )) {
				foreach ( $this->input->post ( "Segmentlist" ) as $inputseg ) {
					$segments = explode ( "_", $inputseg );
					$bp_sdector_array ['Origin'] = $segments [0];
					$bp_sdector_array ['Destination'] = $segments [1];
					$bp_sdector_array ['Remarks'] = "Cancellation Check";
					$bp_sector [] = $bp_sdector_array;
				}
				$ticketids = "";
				$ticketids .= "[";
				foreach ( $this->input->post ( "pax" ) as $keys => $pexseg ) {
					if (count ( $this->input->post ( "pax" ) ) > 1) {
						if (count ( $this->input->post ( "pax" ) ) == $keys + 1) {
							$ticketids .= $pexseg;
						} else {
							$ticketids .= $pexseg . ",";
						}
					} else {
						$ticketids .= $pexseg;
					}
				}
				$ticketids .= "]";
				$data_json = array (
					"BookingId" => $this->input->post ( "BookingId" ),
					"RequestType" => "2",
					"CancellationType" => "3",
					"SrdvType" => "SingleTB",
					"SrdvIndex" => "SrdvTB",
					"Sectors" => $bp_sector,
					"TicketId" => $ticketids,
					"EndUserIp" => $this->EndUserIp,
					"ClientId" => $this->ClientId,
					"UserName" => $this->UserName,
					"Password" => $this->Password 
				);
				$data_string = json_encode ( $data_json );
				$method = "/SendChangeRequest";
				$url = $this->url . $method;
				$ch = curl_init ( $url );
				curl_setopt ( $ch, CURLOPT_CUSTOMREQUEST, "POST" );
				curl_setopt ( $ch, CURLOPT_POSTFIELDS, $data_string );
				curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
				curl_setopt ( $ch, CURLOPT_HTTPHEADER, array (
					'Content-Type: application/json',
					'Content-Length: ' . strlen ( $data_string ) 
				) );
				$result = curl_exec ( $ch );
				$bp_result_array = json_decode ( $result );


				if ($bp_result_array->Error->ErrorCode == "0" && $bp_result_array->ResponseStatus == "1") {

					if($bp_result_array->Status == "1"){
						$status="Successful";
					}

					$canceldata = array (
						"chareq_ref_id" => $this->input->post ( "fbook_id" ),
						"chareq_booking_id" => $this->input->post ( "BookingId" ),
						"chareq_status" => $status,
						'chareq_request_data' => json_encode ( $data_json ),
						'chareq_result_data' => json_encode ( $bp_result_array ),
						'chareq_user_type' => "DSA",
						'chareq_remark' => $this->input->post ( "ocanc_remark" ),
						'chareq_user_id' => $this->dsa_data->dsa_id 
					);
					$canceldata_update = $this->Common_Model->insert_table ( "flight_change_request", $canceldata );

					$data_can = array (
						'fbook_can_status' => $status,
					);
					$this->Flight_Model->update_booking ( $data_can, $this->input->post ( "fbook_id" ) );

					$this->session->set_flashdata ( "alert", array (
						"message" => "Successfully submit Cancel Request.",
						"class" => "alert-success" 
					) );
					redirect ( "user/dashboard" );
				} else {
					$this->session->set_flashdata ( "alert", array (
						"message" => $bp_result_array->Error->ErrorMessage,
						"class" => "alert-danger" 
					) );
					redirect ( "user/dashboard" );
				}
			} else {
				$this->session->set_flashdata ( "alert", array (
					"message" => "Please select Segment Sector !",
					"class" => "alert-danger" 
				) );
				redirect ( "flight/cancel_request?ref_id=" . url_encode ( $this->input->post ( "fbook_id" ) ) );
			}
		}
	}
	
	
	//NEW METHOD FOR PAYMENT REQUUEST
	
	public function payment_request() {
		
		$sessionid=$this->input->post("sessionid");	
		$booking_id = $_SESSION ['flight'] [$sessionid] ['search_RequestData'] ["BookingId"];
		$remark = "Flight Booking (ID - " . $booking_id . ")";
		  // print_r($remark);die;
		if(isset( $_SESSION ['flight'] [$sessionid] ['flight_total_fare'])){
			$totalFare = str_replace ( ",", "", $_SESSION ['flight'] [$sessionid] ['flight_total_fare']);
		}else{
			$totalFare = str_replace(",", "", $_SESSION ['flight'][$sessionid] ['flight_total_fare_return']);
		}

		if ($this->input->post ( 'payment_method' ) == "customerCash") {

			$bp_agent_payment_status = $this->deduct_customer_balance ( $remark, $totalFare );
				// print_r($bp_agent_payment_status);die;

			if ($bp_agent_payment_status == "success") {
				$_SESSION ['flight'] [$sessionid] ['search_RequestData'] ["payment_status"] = "success";
				redirect ( "flight/payment_result_customer/?ref_id=" . url_encode($booking_id) );
			} else {
				echo "There is some problem in booking with your balance. Please contact Admin";
			}

		}
		else {
			$bp_user_id = $this->dsa_data->dsa_id;
			$getwayList = $this->Common_Model->get_table_row("*", array(
				"dsapayg_user_type" => "DSA",
				"dsapayg_user_id" => $bp_user_id,
				"dsapayg_status" => "active",
				"dsapayg_b2b_b2c" => "B2c",
				"dsapayg_gateway_name" => "cc_avenue"
			), "dsa_payment_gateway");

			if($getwayList!="0")
			{		
			// $booking_id = $_SESSION ['flight'] [$sessionid] ['search_RequestData'] ["BookingId"];
                $data['ccavenueConfig'] = $this->Common_Model->get_ccavenue_data("ccavenue_config",'1');
				$RefId = $booking_id;
				$data1 ['booking_id'] = $booking_id;			
				$data ['gateway_data'] ['redirect_url'] = site_url () . "flight/payment_result";
				$data ['gateway_data'] ['cancel_url'] = site_url () . "flight/payment_result";
				$data ['gateway_data'] ['merchant_id'] = $data['ccavenueConfig']->merchant_id;
				$data ['gateway_data'] ["order_id"] = $booking_id;

				$searchData = $_SESSION ['flight'] [$sessionid] ['search_RequestData'];
				$total_pax =(int)$searchData['no_adult'] + (int)$searchData['no_child'] +  (int)$searchData['no_infants'] ;
				if ($searchData ['type'] == "Return" && $searchData ['IsDomestic'] == "true") {
					$totalFare = str_replace ( ",", "", $_SESSION ['flight'] [$sessionid] ['flight_total_fare_return'] );	

					if($getwayList->dsapayg_type=="fix")
					{
						$gatewaycon =  round($getwayList->dsapayg_convenience_fee*$total_pax);
					} else {
						$gatewaycon =  round(( $totalFare * $getwayList->dsapayg_convenience_fee)/100);
					}

					$nkwithconfee = $totalFare + $gatewaycon;

				// $nkwithconfee =  $totalFare + ( $totalFare * $getwayList->dsapayg_convenience_fee)/100;

				}
				else {
					$totalFare = str_replace ( ",", "", $_SESSION ['flight'] [$sessionid] ['flight_total_fare'] );	

					if($getwayList->dsapayg_type=="fix")
					{
						$gatewaycon =  round($getwayList->dsapayg_convenience_fee*$total_pax);
					} else {
						$gatewaycon =  round(( $totalFare * $getwayList->dsapayg_convenience_fee)/100);
					}

					$nkwithconfee = $totalFare + $gatewaycon;

				// $nkwithconfee =  $totalFare + ( $totalFare * $getwayList->dsapayg_convenience_fee)/100;
				}



				$data ['gateway_data'] ['amount'] = round($nkwithconfee);
				$data ['gateway_data'] ['currency'] = "INR";
				$data ['gateway_data'] ['tid'] = "";
				$data ['gateway_data'] ['billing_tel'] = "";
				$data ['gateway_data'] ['billing_email'] = "";
				$data ['gateway_data'] ['billing_address'] = "";
				$data ['gateway_data'] ['billing_city'] = "";
				$data ['gateway_data'] ['billing_state'] = "";
				$data ['gateway_data'] ['billing_zip'] = "";
				$data ['gateway_data']['merchant_param1'] = $booking_id;
				$data ['gateway_data']['promo_code']="";
				$data ['gateway_data']['customer_identifier']="";
				$data ['gateway_data']['billing_name']="";

				$this->load->view ( 'flight/payment_cc_avenue', $data );
			} else {
				$bp_home_url = site_url ();
				$_SESSION['error'] = "Something Went Wrong Please Contact Admin. <a href='$bp_home_url'>Go to Home</a>";			
			}
		}
	}
	
	public function payment_result_customer() {		
		$status="success";
		$BookingId = url_decode($_GET['ref_id']);	
		
		// print_r($BookingId);die;		
		$data = array (
			'fbook_payment_status' => $status 
		);
		$this->Flight_Model->update_booking ( $data, $BookingId );
		$paymentResponse = json_encode ( $_POST );
		$search_data = array (
			'search_type' => 'flight',
			'ref_id' => $BookingId,
			'type' => "array",
			'key' => "PaymentDetails",
			'data' => $paymentResponse 
		);
		//$this->Flight_Model->insert_search ( $search_data );
		
		if ($status == "success") {
			$data['booking_id'] = $BookingId;
			// print_r($data);die;
			$this->load->view ( 'flight/after_payment_loading', $data );
		} else {
			$_SESSION['flight']['search_RequestData']["BookingId"] = $BookingId ;
			redirect ( '/flight/payment_error/',$data );
		}
	}
	
	

	public function payment_result() {
        $ccavenueConfig = $this->Common_Model->get_ccavenue_data("ccavenue_config",'1');
        $workingKey=$ccavenueConfig->working_key;     //Working Key should be provided here.
		$encResponse=$_POST["encResp"];			//This is the response sent by the CCAvenue Server
		$rcvdString = cc_decrypt($encResponse,$workingKey);		//Crypto Decryption used as per the specified working key.
		$order_status="";
		$decryptValues=explode('&', $rcvdString);
		$dataSize=sizeof($decryptValues);
		for($i = 0; $i < $dataSize; $i++) 
		{
			$information=explode('=',$decryptValues[$i]);
			if($i==0)	$booking_id=$information[1];
			if($i==3)	$order_status=$information[1];
		}

		$status = $order_status;
		$BookingId = $booking_id;
		$data = array (
			'fbook_payment_status' => $status 
		);
		$this->Flight_Model->update_booking ( $data, $BookingId );
		$paymentResponse = json_encode ( $_POST );
		$search_data = array (
			'search_type' => 'flight',
			'ref_id' => $BookingId,
			'type' => "array",
			'key' => "PaymentDetails",
			'data' => $paymentResponse 
		);
		//$this->Flight_Model->insert_search ( $search_data );
		
		if ($status == "Success") {
			$data ['booking_id'] = $BookingId;
			$this->load->view ( 'flight/after_payment_loading', $data );
		} else {
			$_SESSION['flight']['search_RequestData']["BookingId"] = $BookingId ;	
			redirect ( '/flight/payment_error/' );
		}
	}


	
//=========deduct custome balance
	function deduct_customer_balance($remark, $totalFare) {		
		$bp_dsa_id = $this->session->userdata("Userlogin")['userData']->cust_id;
		$bp_dsa_company_name = $this->session->userdata("Userlogin")["name"];		
		
		$bp_credit = $totalFare;
		
		$bp_old_balance = $this->user_data->cust_balance;
		// print_r($bp_old_balance );die;
		if ($bp_old_balance >= $bp_credit) {
			$bp_new_balance = $bp_old_balance - $bp_credit;
			$data_2 = array (
				"balance_log_user_id" => $bp_dsa_id,
				"balance_log_user_name" => $bp_dsa_company_name,
				"balance_log_user_type" => "customer",
				"balance_log_detail" => $remark,
				"balance_log_debit" => $bp_credit,
				"balance_log_balance" => $bp_new_balance,
				"balance_log_update_by" => "Auto" 
			);
			$table = "balance_log";
			$this->Common_Model->insert_table ( $table, $data_2 );
			$data1 = array (
				"cust_balance" => $bp_new_balance 
			);
			$table = "customer";
			$where = "cust_id";
			$where_val = $this->session->userdata("Userlogin")['userData']->cust_id;
			$this->Common_Model->update_table ( $where, $where_val, $table, $data1 );
			return "success";
		} else {
			return "not";
		}
	}
//=========
	
	
	
	//GET COUPON
	
	public function Getcoupon()
	{
		$dsa_id = $this->dsa_data->dsa_id;
		$das_type = $this->dsa_setting->dsaset_user_type;
		$sessionid = $_POST["sessionid"];
		$amount_coupon = 0;
		
		$getwayList = $this->Common_Model->get_table_row("*", array(
			"dsapayg_user_type" => "DSA",
			"dsapayg_user_id" => $dsa_id,
			"dsapayg_status" => "active",
			"dsapayg_b2b_b2c" => "B2c",
			"dsapayg_gateway_name" => "cc_avenue"
		), "dsa_payment_gateway");

		if (isset($_SESSION['flight'][$sessionid]['flight_total_fare'])) {
			$customer_amount = str_replace(",", "", $_SESSION['flight'][$sessionid]['flight_total_fare']);
            //$customer_amount1 = str_replace(",", "", $_SESSION['flight'][$sessionid]['flight_total_fare']);
		} else {
			$customer_amount = str_replace(",", "", $_SESSION['flight'][$sessionid]['flight_total_fare_return']);

            //$customer_amount1 = str_replace(",", "", $_SESSION['flight'][$sessionid]['flight_total_fare_IB']);
		}
		
		// if($getwayList->dsapayg_type=="fix")
			// {
				// $gatewaycon =  round($getwayList->dsapayg_convenience_fee*$total_pax);
			// } else {
				// $gatewaycon =  round(( $customer_amount * $getwayList->dsapayg_convenience_fee)/100);
			// }

        // GET Coupon Detials
		$where = array(
			"coupon_code" => $_POST["coupon"],
			"coupon_status" => "active",
			"coupon_user_id" => $dsa_id,
			"coupon_user_type" => $das_type,
		);

		$coupon_user_provide = $this->Flight_Model->get_coupon_data("*", $where, "coupon");
		
		if ($coupon_user_provide != "0") {
			
			//print_r ($coupon_user_provide); die;
			
            // check coupon Valid or not
			if ($_SESSION['copont_applied'] == FALSE && $coupon_user_provide->coupon_use_limit != 0 && $coupon_user_provide->coupon_start_date <= date("d/m/Y") && date("d/m/Y") <= $coupon_user_provide->coupon_end_date) {

                /* $coupon_expire="ture";
                $data["amount"]=0;
                $data["status"] = "fail";
                $data["message"] = "Invalid Coupon!"; */

                if ($coupon_user_provide->coupon_amount_type == "fixed") {
                	$amount_coupon = $coupon_user_provide->coupon_amount;

                }
                if ($coupon_user_provide->coupon_amount_type == "percent") {
                	$amount_coupon = (($customer_amount * $coupon_user_provide->coupon_amount) / 100);
                }


                $new_amount = $customer_amount - $amount_coupon;
                //$new_amount1 = $customer_amount1 - $amount_coupon;

                // update coupon limit
                $up_coupon = $this->Flight_Model->updatecouponlimit($coupon_user_provide->coupon_id, $coupon_user_provide->coupon_use_limit - 1);

	//after discount
                if($getwayList->dsapayg_type=="fix") {
                	$retu = 2;
                	$total_con_fee = round($getwayList->dsapayg_convenience_fee*$total_pax*$retu);
                	$final_fare = $total_con_fee+$new_amount;
                } else {
                	$total_con_fee =  round(( $new_amount * $getwayList->dsapayg_convenience_fee)/100);
                	$final_fare = $total_con_fee+$new_amount;
					//print_r($totalFare ); exit;
                }



                //insert into flight coupon table
                $data_coupon_fight = array(
                	"fliocous_coupon_code" => $_POST["coupon"],
                	"fliocous_dsa_id" => $dsa_id,
                	"fliocous_discount_type" => $coupon_user_provide->coupon_amount_type,
                	"fliocous_total_amount" => $customer_amount,
                	"fliocous_discount_amount" => $amount_coupon,
                	'fliocous_discount' => $new_amount,
                );
                $this->Flight_Model->fligth_on_cupon($data_coupon_fight);
                $_SESSION['copont_applied'] = true;

                if (isset($_SESSION['flight'][$sessionid]['flight_total_fare'])) {
                	$_SESSION['flight'][$sessionid]['flight_total_fare'] = $new_amount;
                } else {
                	$_SESSION['flight'][$sessionid]['flight_total_fare_return'] = $new_amount;
                   // $_SESSION['flight'][$sessionid]['flight_total_fare_IB'] = $new_amount1;
                }

               // $data["amount"] = round($new_amount);
                $data["total_con_fee"] = $total_con_fee;
                $data["amount"] = round($final_fare);
                $data["status"] = "success";
                $data["discount_amount"] = round($amount_coupon);
                $data["message"] = "Coupon has been Successfully Applied !";

            } else {

            	$coupon_expire = "ture";
            	$data["amount"] = 0;
            	$data["status"] = "fail";
            	$data["message"] = "Invalid Coupon!";
            }

        } else {
        	$data["amount"] = $customer_amount;
        	$data["status"] = "Fail";
        	$data["message"] = "invalid Coupon !";
        }

        echo json_encode($data);
    }

	//LOGIN AND CONTINUE

    public function login() {
    	$email = $this->security->xss_clean($this->input->post('email'));
    	$password = MD5($this->security->xss_clean($this->input->post('password')));
    	$userid = $this->Flight_Model->userlogin($email, $password);
    	if ($userid == NULL) {
    		$this->session->set_flashdata ( 'alert_register', array ( 'message' => 'User name or Password is wrong',
    			'class' => 'alert-danger'
    		));
               // echo "false";
    		$data["status"] = "fail";               
    		$data["message"] = "User name or Password is wrong!";
    	} else {

    		$_SESSION['customer_id'] = $userid['id'];
    		$_SESSION['customer_name'] = $userid['name'];
    		$this->session->set_userdata('Userlogin', $userid);
    		$this->session->set_flashdata('cusmsg', 'You are Login Successfully ');
               // echo "true";
    		$data["status"] = "success";               
    		$data["message"] = "You are Login Successfully!";
    	}
    	echo json_encode($data);
    }



	//=====OLD Function

    public function payment_request1() {

		//$this->load->view ( 'booking_confirm');
    	$sessionid=$this->input->post("sessionid");

		// echo "<pre>";
		// print_r($_SESSION ['flight'] [$sessionid]);die;

    	redirect("flight/ticket_booking/".$_SESSION ['flight'] [$sessionid] ['SearchData'] ["BookingId"]);

    }	




    public function payment_result1() {
    	if (!empty($this->input->post('razorpay_payment_id')) ) {
    		$status="success";

    		$BookingId = $this->input->post ( "merchant_order_id" );
    		$data = array (
    			'fbook_payment_status' => $status 
    		);
    		$this->Flight_Model->update_booking ( $data, $BookingId );
    		$paymentResponse = json_encode ( $_POST );
    		$search_data = array (
    			'search_type' => 'flight',
    			'ref_id' => $BookingId,
    			'type' => "array",
    			'key' => "PaymentDetails",
    			'data' => $paymentResponse 
    		);

    		if ($status == "success") {
    			$data ['booking_id'] = $BookingId;
    			$this->load->view ( 'flight/after_payment_loading', $data );
    		} else {
    			redirect ( '/flight/payment_error/' );
    		}
    	} else {
    		redirect ( '/flight/payment_error/' );
    	}
    }


//TICKET BOOKING DETAIL FOR CUSTOMER AS A GUEST

//TICKET BOOKING DETAIL FOR CUSTOMER AS A GUEST

    public function print_eticket()
    {
    	if ($this->input->server ( 'REQUEST_METHOD' ) == "POST")
    	{
    		$ref_id = $this->input->post ( 'ref_id' );
    		$mobile = $this->input->post ( 'cust_mobile' );	
    		$id = explode("00", $ref_id);	
    		$booking_id = $id[1];

    		$BookingDetails = $this->Flight_Model->get_booking_by_booking_id($booking_id, $mobile);
    		if ($BookingDetails == '') {

    			$this->session->set_flashdata ( 'alert_register', array ( 'message' => 'Ref ID. or Mobile No. is wrong',
    				'class' => 'alert-danger'
    			));
    			redirect('flight/print_eticket');
    		}
    		else {		
    			if ($BookingDetails->fbook_ob_booking_status == 'Success') {
    				redirect ( "flight/print_ticket?ref_id=" . bp_hash ($BookingDetails->fbook_id ) );

    			}
    			else{
    				$this->session->set_flashdata ( 'alert_register', array ( 'message' => 'No Data found for this search criteria',
    					'class' => 'alert-danger'
    				));
    				redirect('flight/print_eticket');
    			}
					// redirect ( "flight/print_ticket?ref_id=" . bp_hash ($BookingDetails->fbook_id ) );
    		}
    	}

    	$this->load->view("flight/print_eticket");
    }


    public function ajax_calendar_fare(){

    	$from_city = $this->input->post ( "from_city" );
    	$to_city = $this->input->post ( "to_city" );
    	$depart_date_time = date ( "Y-m-d", strtotime ( $this->input->post ( "depart_date" ) ) );
    	$depart_date = $depart_date_time . "T00:00:00";
    	$search_data = array(
    		"EndUserIp" => $this->EndUserIp,
    		"TokenId" => $this->TokenId,       
    		"JourneyType"  => "2",
    		"Segments" => [ 
    			array (
    				"Origin" => $from_city,
    				"Destination" => $to_city,
    				"FlightCabinClass" => 1,
    				"PreferredDepartureTime" => $depart_date,
    				"PreferredArrivalTime" => $depart_date
    			)
    		] 
    	);


    	$data_string = json_encode ( $search_data );	

    	$method = "/GetCalendarFare/";
    	$url = $this->url . $method;
    	$ch = curl_init ( $url );
    	curl_setopt ( $ch, CURLOPT_CUSTOMREQUEST, "POST" );
    	curl_setopt ( $ch, CURLOPT_POSTFIELDS, $data_string );
    	curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
    	curl_setopt ( $ch, CURLOPT_HTTPHEADER, array (
    		'Content-Type: application/json',
    		'Content-Length: ' . strlen ( $data_string ) 
    	) );
    	$result = curl_exec ( $ch );
		//print_r($result);die;
    	$arrayresult = json_decode ( $result );		
    	$data['result']=$arrayresult->Response->SearchResults;
    	echo json_encode($data);
		//echo $data_string;

    }

}
?>