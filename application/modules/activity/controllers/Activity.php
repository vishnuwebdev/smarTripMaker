<?php
class Activity extends MX_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->Model ( 'HolidayModel' );
		$this->load->Model ( 'Common_Model' );
		// $this->load->Model('user/UserModel');
		
		$this->load->helper ( array (
				'text',
				'form',
				'url' 
		) );
		$this->load->library ( 'form_validation' );
		
		$this->load->library ( array (
				'session',
				'facebook',
				'google' 
		) );
		
	}
	public function index() {
		redirect ( 'activity/all_activity' );
	}
	function ajax_booking_query() {
		$RequestMethod = $this->input->server ( 'REQUEST_METHOD' );
		if ($RequestMethod == "POST") {
			
			$data1 = array (
					
					'com_name' => $this->input->post ( 'custFirstName' ) . " " . $this->input->post ( 'custLastName' ),
					'com_email' => $this->security->xss_clean ( $this->input->post ( 'custEmail' ) ),
					'com_mobile' => $this->input->post ( 'custMobleNo' ),
					'com_query_type' => 'package',
					'com_reff' => $this->input->post ( 'tour_ID' ),
					'com_user_type' => "DSA",
					'com_user_id' => $this->dsa_data->dsa_id 
			);
			$inserted = $this->HolidayModel->register_query ( $data1 );
			if ($inserted) {
				
				$data ["status"] = "success";
				$data ["message"] = "Your booking query submited !";
			} else {
				$data ["status"] = "error";
				$data ["message"] = "Someting Wrong please try again!";
			}
			
			echo json_encode ( $data );
		}
	}
	public function activitydetail($slug = Null) {
		
		// print_r($slug);
		// die;
		$refid = url_decode ( $this->input->get ( "ref_id" ) );
		if ($slug != NULL) {
			$bookingdetail = $this->HolidayModel->get_bookingdetail ( $slug );
			// print_r($bookingdetail);
			// die;
			if (! empty ( $bookingdetail )) {
				$data ["bookingdetail"] = $bookingdetail;
				$bookingimg = $this->HolidayModel->get_bookingimages ( $bookingdetail->holiday_id );
				$data ["Bimages"] = $bookingimg;
				$Bitinerary = $this->HolidayModel->get_bitinerary ( $bookingdetail->holiday_id );
				$data ['Bitinerary'] = $Bitinerary;
				$inclusionid = explode ( ",", $bookingdetail->holiday_inclusion );
				$Binclusion = $this->HolidayModel->get_inclusion ( $inclusionid );
				$data ['Binclusion'] = $Binclusion;
				$exclusionid = explode ( ",", $bookingdetail->holiday_exclusion );
				$Bexclusion = $this->HolidayModel->get_exclusion ( $exclusionid );
				$data ['Bexclusion'] = $Bexclusion;
				$Breletedpachage = $this->HolidayModel->get_releted_packeges ( $bookingdetail->holiday_category_id,$this->dsa_data->dsa_id );
				$data ['Breletedpachage'] = $Breletedpachage;
			} else {
				$data ["bookingdetail"] = "not";
			}
		} else {
			
			redirect ( "/" );
		}
		$this->load->view ( "holiday/holidaydetail", $data );
	}
	public function holiday_list() {
		$RequestMethod = $this->input->server ( 'REQUEST_METHOD' );
		if ($RequestMethod == "GET") {
			$location = $this->input->get ( "location" );
			$tour_catid = $this->input->get ( "tour_type" );
			$adultno = $this->input->get ( "guest_no" );
			
			
			$extrawhere = array ();
			if (empty ( $tour_catid )) {
				$catcon = array ();
			} else {
				$catcon = array (
						"FIND_IN_SET(" . $tour_catid . ",holiday_sub_category_id) >" => 0 
				);
			}
			if (empty ( $location )) {
				$loccon = array ();
			} else {
				$loccon = array (
						"holiday_location LIKE" => '%' . $location . '%' 
				);
			}
			
			$catedata = array ();
			$array = array (
					"holiday_user_id" => $this->dsa_data->dsa_id,
					"holiday_user_type" => "DSA",
					"holiday_language" => $this->default_lang 
			);
			$extrawhere = array_merge ( $catcon, $loccon, $extrawhere );
			// print_r($array);
			// die;
			$table = "holiday";
			$where_1_name = "holiday_status";
			$where_1_value = "active";
			$order_by = "holiday_id";
			$bp_template_name = "holidayList";
			if ($this->uri->segment ( 3 )) {
				$page = $this->uri->segment ( 3 );
			} else {
				$page = 0;
			}
			$this->db->where ( $extrawhere );
			$this->db->where ( $where_1_name, $where_1_value );
			$total_row = $this->db->from ( $table )->count_all_results ();
			$pagination_segment = 3;
			$per_page = 50;
			$pagination_url = base_url () . $this->uri->segment ( "1" ) . "/" . $this->uri->segment ( "2" );
			$config = bp_pagination ( $pagination_url, 0, $total_row, $per_page );
			$this->pagination->initialize ( $config );
			$result = $this->Common_Model->pagination_table ( $config ["per_page"], $page, $where_1_name, $where_1_value, $order_by, $table, $extrawhere );
			
			$data ['result'] = $result;
			
			$data ['total_result'] = $total_row;
			
			// $data ['Category_name'] = $catedata;
			// PrintArray($result);
			// die;
			$this->load->view ( "holiday/" . $bp_template_name, $data );
		}
		
		// $this->load->view("holiday/holidayList");
	}
	public function all_activity() {
	
		$table = "holiday";
		$where_1_name = "holiday_status";
		$where_1_value = "active";
		$where_2_name = "holiday_user_id";
		$where_2_value = $this->dsa_data->dsa_id;
		$order_by = "holiday_id";
		$bp_template_name = "alltour";
		if ($this->uri->segment ( 3 )) {
			$page = $this->uri->segment ( 3 );
		} else {
			$page = 0;
		}

		$extrawhere = array (
			"FIND_IN_SET(1,holiday_category_id) >" => 0,
		);

		$this->db->where ( $where_1_name, $where_1_value );
		$this->db->where ( $where_2_name, $where_2_value );
		$total_row = $this->db->from ( $table )->count_all_results ();
		$pagination_segment = 3;
		$per_page = 12;
		$pagination_url = base_url () . $this->uri->segment ( "1" ) . "/" . $this->uri->segment ( "2" );
		$config = bp_pagination ( $pagination_url, 0, $total_row, $per_page );
		$this->pagination->initialize ( $config );
		$result = $this->HolidayModel->pagination_table ( $config ["per_page"], $page, $where_1_name, $where_1_value,$where_2_name, $where_2_value, $order_by, $table,$extrawhere );
		$data ['result'] = $result;
		
		// PrintArray($data);
		// die;
		$this->load->view ( $this->uri->segment ( "1" ) . "/" . $bp_template_name, $data );
	}
	public function contactus() {
		$this->load->view ( "holiday/contactus" );
	}
	public function bookingdetail() {
		$this->load->view ( "holiday/bookingdetail" );
	}
	public function tour_passenger_details() {
		$refid = $this->input->get ( "tour_ID" );
		if ($this->input->get ( "adult_no" ) < 1) {
			
			echo "please select min 1 adult traveller.";
			return false;
		} else {
			if ($refid != NULL) {
				
				$bookingdetail = $this->HolidayModel->get_bookingdetail_by_id ( $refid );
				$data ["bookingdetail"] = $bookingdetail;
				$bookingimg = $this->HolidayModel->get_bookingimages ( $refid );
				$data ["Bimages"] = $bookingimg;
				$Bitinerary = $this->HolidayModel->get_bitinerary ( $refid );
				$data ['Bitinerary'] = $Bitinerary;
				$inclusionid = explode ( ",", $bookingdetail->holiday_inclusion );
				$Binclusion = $this->HolidayModel->get_inclusion ( $inclusionid );
				$data ['Binclusion'] = $Binclusion;
				$exclusionid = explode ( ",", $bookingdetail->holiday_exclusion );
				$Bexclusion = $this->HolidayModel->get_exclusion ( $exclusionid );
				$data ['Bexclusion'] = $Bexclusion;
				$Breletedpachage = $this->HolidayModel->get_releted_packeges ( $bookingdetail->holiday_category_id );
				$data ['Breletedpachage'] = $Breletedpachage;
				$allcountry = $this->HolidayModel->get_countries ();
				$data ["allcountry"] = $allcountry;
			} else {
				
				redirect ( "/" );
			}
			
			$this->load->view ( "holiday/tourpassengerdetails", $data );
		}
	}
	public function dashboard() {
		$this->load->view ( "holiday/dashboard" );
	}
	public function category($cateid = NULL) {
		
		// print_r($cateid);
		// die;
		$extrawhere = array ();
		$catedata = array ();
		if ($this->uri->segment ( 1 ) == "cat") {
			
			$extrawhere = array (
					"FIND_IN_SET(" . $cateid . ",holiday_category_id) >" => 0,
					"holiday_user_id" => $this->dsa_data->dsa_id,
					"holiday_user_type" => "DSA",
					"holiday_language" => $this->default_lang 
			);
			$catedata = $this->HolidayModel->get_category_by_id ( $cateid );
		} else if ($this->uri->segment ( 1 ) == "subcat") {
			
			$extrawhere = array (
					"FIND_IN_SET(" . $cateid . ",holiday_sub_category_id) >" => 0,
					"holiday_user_id" => $this->dsa_data->dsa_id,
					"holiday_user_type" => "DSA",
					"holiday_language" => $this->default_lang 
			);
			$catedata = $this->HolidayModel->get_sub_category_by_id ( $cateid );
		}
		
		$table = "holiday";
		$where_1_name = "holiday_status";
		$where_1_value = "active";
		$order_by = "holiday_id";
		$bp_template_name = "category_tour";
		if ($this->uri->segment ( 3 )) {
			$page = $this->uri->segment ( 3 );
		} else {
			$page = 0;
		}
		$this->db->where ( $extrawhere );
		$this->db->where ( $where_1_name, $where_1_value );
		$total_row = $this->db->from ( $table )->count_all_results ();
		$pagination_segment = 3;
		$per_page = 50;
		$pagination_url = base_url () . $this->uri->segment ( "1" ) . "/" . $this->uri->segment ( "2" );
		$config = bp_pagination ( $pagination_url, 0, $total_row, $per_page );
		$this->pagination->initialize ( $config );
		$result = $this->Common_Model->pagination_table ( $config ["per_page"], $page, $where_1_name, $where_1_value, $order_by, $table, $extrawhere );
		
		$data ['result'] = $result;
		$data ['Category_name'] = $catedata;
		
		// PrintArray($catedata);
		// die;
		$this->load->view ( "holiday/" . $bp_template_name, $data );
	}
	public function get_location() {
		$RequestMethod = $this->input->server ( 'REQUEST_METHOD' );
		if ($RequestMethod == "GET") {
			$term = $this->input->get ( "term" );
			$where = $term;
			
			$result = $this->HolidayModel->get_all_location_json ( $where );
			
			echo json_encode ( $result );
		}
	}
	public function add_to_cart() {
		$RequestMethod = $this->input->server ( 'REQUEST_METHOD' );
		if ($RequestMethod == "POST") {
			
			$refid = $this->input->post ( "BookingID" );
			
			$bookingdetail = $this->HolidayModel->get_bookingdetail_by_id ( $refid );
			$data ["bookingdetail"] = $bookingdetail;
			
			$totalpax = 0;
			$adult = 0;
			$child = 0;
			$infant = 0;
			$totalprice = 0;
			if ($this->input->get ( "start_date" ) != NULL) {
				$strdate = $this->input->get ( "start_date" );
			} else {
				
				$strdate = "";
			}
			if ($this->input->post ( "adult_no" ) != NULL) {
				
				$totalpax = $totalpax + $this->input->post ( "adult_no" );
				$adult = $this->input->post ( "adult_no" );
				$adultprice = $bookingdetail->holiday_start_price * $adult;
			}
			if ($this->input->post ( "child_no" ) != NULL) {
				
				$totalpax = $totalpax + $this->input->post ( "child_no" );
				$child = $this->input->post ( "child_no" );
				$childprice = $bookingdetail->holiday_start_price * $child;
			}
			if ($this->input->post ( "infant_no" ) != NULL) {
				
				$totalpax = $totalpax + $this->input->post ( "infant_no" );
				$infant = $this->input->post ( "infant_no" );
				$infantprice = $bookingdetail->holiday_start_price * $infant;
			}
			$totalprice = $bookingdetail->holiday_start_price * $totalpax;
			
			PrintArray ( $_POST );
			
			$bookingData = array (
					// 'Fld_RefrenceId' => $ref_id,
					'holbook_user_id' => $this->dsa_data->dsa_id,
					'holbook_user_type' => "DSA",
					'holbook_tour_id' => $this->input->post ( "BookingID" ),
					'holbook_total_pax' => $totalpax,
					'holbook_adult' => $adult,
					'holbook_child' => $child,
					'holbook_infant' => $infant,
					'holbook_contact_person_name' => $this->input->post ( "adult" ) ["1"] ["first_name_adult"] . ' ' . $this->input->post ( "adult" ) ["1"] ["last_name_adult"],
					'holbook_contact_phone' => $this->input->post ( "contact_mobile" ),
					'holbook_contact_email' => $this->input->post ( "contact_email" ),
					'holbook_remark' => "",
					'holbook_booking_status' => "Pending",
					'holbook_payment_status' => "Pending",
					'holbook_tour_extra' => "",
					'holbook_tour_hotel' => "",
					'holbook_amount' => $totalprice,
					'holbook_adult_price' => $adultprice,
					'holbook_child_price' => $childprice,
					'holbook_infant_price' => $infantprice,
					'holbook_discount' => "",
					'holbook_coupon_use_id' => "",
					'holbook_customer_id' => $this->session->userdata ( 'Userlogin' ) ["id"],
					'holbook_tour_start_date' => $strdate 
			);
			$bookingid = $this->HolidayModel->insert_booking ( $bookingData );
			
			if ($bookingid) {
				$data = array (
						"holbook_ref_id" => $this->dsa_data->dsa_booking_prefix . '-' . $bookingid 
				);
				$this->HolidayModel->update_booking ( $bookingid, $data );
				
				for($ad = 1; $ad <= $adult; $ad ++) {
					
					$bookingPaxDetails = array (
							'holpax_booking_id' => $bookingid,
							'holpax_type' => "adult",
							'holpax_title' => $this->input->post ( "adult" ) [$ad] ["title_adult"],
							'holpax_first_name' => $this->input->post ( "adult" ) [$ad] ["first_name_adult"],
							'holpax_last_name' => $this->input->post ( "adult" ) [$ad] ["last_name_adult"],
							'holpax_gender' => $this->input->post ( "adult" ) [$ad] ["gender_adult"],
							'holpax_dob' => $this->input->post ( "adult" ) [$ad] ["date_of_birth_adult"],
							'holpax_passport_number' => $this->input->post ( "adult" ) [$ad] ["passport_no_adult"],
							'holpax_passport_issue_country' => $this->input->post ( "adult" ) [$ad] ["pass_issue_country_adult"],
							'holpax_passport_expiry' => $this->input->post ( "adult" ) [$ad] ["pass_expire_adult"],
							'holpax_user_type' => "DSA",
							'holpax_user_id' => $this->dsa_data->dsa_id 
					);
					
					$this->HolidayModel->insert_booking_pax_details ( $bookingPaxDetails );
				}
				for($chi = 1; $chi <= $child; $chi ++) {
					
					$bookingPaxDetailschild = array (
							'holpax_booking_id' => $bookingid,
							'holpax_type' => "child",
							'holpax_title' => $this->input->post ( "child" ) [$chi] ["title_child"],
							'holpax_first_name' => $this->input->post ( "child" ) [$chi] ["first_name_child"],
							'holpax_last_name' => $this->input->post ( "child" ) [$chi] ["last_name_child"],
							'holpax_gender' => $this->input->post ( "child" ) [$chi] ["gender_child"],
							'holpax_dob' => $this->input->post ( "child" ) [$chi] ["date_of_birth_child"],
							'holpax_passport_number' => $this->input->post ( "child" ) [$chi] ["passport_no_child"],
							'holpax_passport_issue_country' => $this->input->post ( "child" ) [$chi] ["pass_issue_country_child"],
							'holpax_passport_expiry' => $this->input->post ( "child" ) [$chi] ["pass_expire_child"],
							'holpax_user_type' => "DSA",
							'holpax_user_id' => $this->dsa_data->dsa_id 
					);
					
					$this->HolidayModel->insert_booking_pax_details ( $bookingPaxDetailschild );
				}
				
				$tours = array ();
				$new_tours = array (
						array (
								'tour_id' => $bookingdetail->holiday_id,
								'tour_title' => $bookingdetail->holiday_name,
								'tour_location' => "",
								'tour_start_date' => $strdate,
								'tour_adult_no' => $adult,
								'tour_child_no' => $child,
								'tour_infant_no' => $infant,
								'tour_price' => $bookingdetail->holiday_start_price,
								'tour_total_price' => $totalprice,
								"booking_id" => $bookingid 
						) 
				);
				
				if (isset ( $_SESSION ["Tours_Cart"] )) {
					$found = false;
					foreach ( $_SESSION ["Tours_Cart"] as $cart_itm ) {
						
						if ($cart_itm ["tour_id"] == $bookingdetail->holiday_id) {
							$tours [] = array (
									'tour_id' => $bookingdetail->holiday_id,
									'tour_title' => $bookingdetail->holiday_name,
									'tour_location' => "",
									'tour_start_date' => $strdate,
									'tour_adult_no' => $adult,
									'tour_child_no' => $child,
									'tour_infant_no' => $infant,
									'tour_price' => $bookingdetail->holiday_start_price,
									'tour_total_price' => $totalprice,
									"booking_id" => $bookingid 
							);
							$found = true;
						} else {
							$tours [] = array (
									'tour_id' => $cart_itm ["tour_id"],
									'tour_title' => $cart_itm ["totour_titleur_id"],
									'tour_location' => "",
									'tour_start_date' => $cart_itm ["tour_start_date"],
									'tour_adult_no' => $cart_itm ["tour_adult_no"],
									'tour_child_no' => $cart_itm ["toutour_child_nor_id"],
									'tour_infant_no' => $cart_itm ["tour_infant_no"],
									'tour_price' => $cart_itm ["tour_price"],
									'tour_total_price' => $cart_itm ["tour_total_price"],
									"booking_id" => $cart_itm ["booking_id"] 
							);
						}
					}
					if ($found == false) {
						$_SESSION ["Tours_Cart"] = array_merge ( $tours, $new_tours );
					} else {
						$_SESSION ["Tours_Cart"] = $tours;
					}
				} else {
					$_SESSION ["Tours_Cart"] = $new_tours;
				}
				
				redirect ( "holiday/cart" );
			}
		}
	}
	public function cart() {
		$carttotal = 0;
		if (! empty ( $_SESSION ["Tours_Cart"] )) {
			
			foreach ( $_SESSION ["Tours_Cart"] as $key => $cartdata ) {
				
				$bbokingdata [$key] ["tourdetail"] = $this->HolidayModel->get_bookingdetail_by_id ( $cartdata ["tour_id"] );
				$bbokingdata [$key] ["cart_detail"] = $cartdata;
				
				$bbokingdata [$key] ["bookingdetail"] = $this->HolidayModel->get_booking_by_id ( $cartdata ["booking_id"] );
				$bbokingdata [$key] ["bookingPax"] = $this->HolidayModel->get_pax_id ( $cartdata ["booking_id"] );
				$carttotal = $carttotal + $cartdata ["tour_total_price"];
			}
		} else {
			$bbokingdata = array ();
		}
		$data ["result"] = $bbokingdata;
		$data ["carttotalPrice"] = $carttotal;
		
		$this->load->view ( "holiday/cart", $data );
	}
	public function remove_from_cart() {
		$tour_id = $this->input->get ( 'tour_id' );
		if (isset ( $_SESSION ["Tours_Cart"] )) {
			foreach ( $_SESSION ["Tours_Cart"] as $cart_itm ) {
				
				if ($cart_itm ["tour_id"] != $tour_id) {
					$tours [] = array (
							'tour_id' => $cart_itm ["tour_id"],
							'tour_title' => $cart_itm ["totour_titleur_id"],
							'tour_location' => "",
							'tour_start_date' => $cart_itm ["tour_start_date"],
							'tour_adult_no' => $cart_itm ["tour_adult_no"],
							'tour_child_no' => $cart_itm ["toutour_child_nor_id"],
							'tour_infant_no' => $cart_itm ["tour_infant_no"],
							'tour_price' => $cart_itm ["tour_price"],
							'tour_total_price' => $cart_itm ["tour_total_price"],
							"booking_id" => $cart_itm ["booking_id"] 
					);
				}
			}
			if (isset ( $tours )) {
				$_SESSION ["Tours_Cart"] = $tours;
			} else {
				
				unset ( $_SESSION ["Tours_Cart"] );
			}
		}
		redirect ( "holiday/cart" );
	}
	public function payment_request() {
		$paymentstatus = "success";
		if ($paymentstatus == "success") {
			
			// $this->HolidayModel->update_holibooking();
			$this->load->view ( "card_detail" );
		} else {
			$this->load->view ( "payment_request" );
		}
	}
	public function booking_confirm() {
		if (isset ( $_SESSION ["Tours_Cart"] )) {
			foreach ( $_SESSION ["Tours_Cart"] as $cart_itm ) {
				
				$where = array (
						"holbook_booking_status" => "Success" 
				);
				$updated = $this->HolidayModel->update_booking ( $cart_itm ["booking_id"], $where );
			}
		}
		
		redirect ( "holiday/booking_success" );
		
		PrintArray ( $_SESSION ["Tours_Cart"] );
		die ();
		// $this->HolidayModel->update_status();
	}
	public function booking_success() {
		if (! empty ( $_SESSION ["Tours_Cart"] )) {
			
			foreach ( $_SESSION ["Tours_Cart"] as $key => $cartdata ) {
				
				$bbokingdata [$key] ["tourdetail"] = $this->HolidayModel->get_bookingdetail_by_id ( $cartdata ["tour_id"] );
				$bbokingdata [$key] ["cart_detail"] = $cartdata;
				
				$bbokingdata [$key] ["bookingdetail"] = $this->HolidayModel->get_booking_by_id ( $cartdata ["booking_id"] );
				$bbokingdata [$key] ["bookingPax"] = $this->HolidayModel->get_pax_id ( $cartdata ["booking_id"] );
				// $carttotal = $carttotal + $cartdata["tour_total_price"];
			}
		} else {
			$bbokingdata = array ();
			redirect ( "/" );
		}
		$data ["result"] = $bbokingdata;
		$this->load->view ( "holiday/booking_success", $data );
	}
	public function card_details() {
		$RequestMethod = $this->input->server ( 'REQUEST_METHOD' );
		if ($RequestMethod == "POST") {
			
			foreach ( $_SESSION ["Tours_Cart"] as $cart_itm ) {
				$cardData = array (
						'crecard_user_id' => $this->dsa_data->dsa_id,
						'crecard_user_type' => "DSA",
						'crecard_status' => "Active",
						'crecard_card_type' => $this->input->post ( "crecard_card_type" ),
						'crecard_booking_id' => $cart_itm ["booking_id"],
						'crecard_first_name' => $this->input->post ( "crecard_first_name" ),
						'crecard_last_name' => $this->input->post ( "crecard_last_name" ),
						'crecard_card_name' => $this->input->post ( "crecard_card_name" ),
						'crecard_card_number' => $this->input->post ( "crecard_card_number" ),
						'crecard_expiry' => $this->input->post ( "crecard_expiry_month" ) . '/' . $this->input->post ( "crecard_expiry_year" ),
						'crecard_customer_id' => $this->session->userdata ( 'Userlogin' ) ["id"],
						'crecard_cvv' => $this->input->post ( "crecard_cvv" ) 
				);
				$cardid = $this->HolidayModel->insert_card ( $cardData );
			}
			// print_r($cardData);
			// $cardid = $this->HolidayModel->insert_card($cardData);
			
			if ($cardid) {
				
				redirect ( "holiday/booking_confirm" );
			}
		}
	}
	public function print_ticket() {
		if (! empty ( $_SESSION ["Tours_Cart"] )) {
			
			foreach ( $_SESSION ["Tours_Cart"] as $key => $cartdata ) {
				
				$bbokingdata [$key] ["tourdetail"] = $this->HolidayModel->get_bookingdetail_by_id ( $cartdata ["tour_id"] );
				$bbokingdata [$key] ["cart_detail"] = $cartdata;
				
				$bbokingdata [$key] ["bookingdetail"] = $this->HolidayModel->get_booking_by_id ( $cartdata ["booking_id"] );
				$bbokingdata [$key] ["bookingPax"] = $this->HolidayModel->get_pax_id ( $cartdata ["booking_id"] );
			}
		} else {
			$bbokingdata = array ();
			redirect ( "/" );
		}
		$data ["result"] = $bbokingdata;
		unset ( $_SESSION ['Tours_Cart'] );
		$this->load->view ( "ticket", $data );
	}
	public function forgot_password() {
		$this->load->library ( 'email' );
		
		// SMTP & mail configuration
		$config = array (
				'protocol' => 'smtp',
				'smtp_host' => 'ssl://smtp.gmail.com',
				'smtp_port' => 465,
				'smtp_user' => 'm',
				'smtp_pass' => '',
				'mailtype' => 'html',
				'charset' => 'utf-8' 
		);
		$this->email->initialize ( $config );
		$this->email->set_mailtype ( "html" );
		$this->email->set_newline ( "\r\n" );
		
		// Email content
		$htmlContent = '<h1>Forgot Password</h1>';
		$htmlContent .= '<p>update your password </p>';
		$htmlContent .= '<p>Link here!</p>';
		
		$this->email->to ( '' );
		$this->email->from ( '', 'MyWebsite' );
		$this->email->subject ( 'How to send email via SMTP server in CodeIgniter' );
		$this->email->message ( $htmlContent );
		
		// Send email
		$this->email->send ();
		
		echo $this->email->send ();
	}
}
