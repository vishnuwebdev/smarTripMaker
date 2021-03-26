<?php
class Hotel extends MX_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->Model ( 'Hotel_Model' );
		$this->load->helper ( 'hotel/hotel' );
		$this->load->helper('text');
		
		//$CI = &get_instance();
        //ini_set('serialize_precision', -1);
        //$this->load->model("Tbo_Model");
		
		
		$tbo_data = $this->Hotel_Model->get_table("*", "ahapi_name", "tbo_live", "api_hotel_active");
        $this->TokenId = $tbo_data->ahapi_token;
        $this->ClientId = $tbo_data->ahapi_client_id;
        $this->UserName = $tbo_data->ahapi_user_name;
        $this->Password = $tbo_data->ahapi_api_password;
        $this->EndUserIp = $tbo_data->ahapi_ip;
        $this->url = $tbo_data->ahapi_url;
		$this->auth_url = $tbo_data->ahapi_auth_url;
		
        if ($tbo_data->ahapi_token_update != date("d")) {
            $this->token_authenticate();
            $token_data = $_SESSION['flight']['TokenData'];
            if ($token_data->Status == "1") {
                $bp_rbo_auth_token = $token_data->TokenId;
                $updat_date = date("d");
                $data = array(
                    "ahapi_token" => $bp_rbo_auth_token,
                    "ahapi_token_update" => $updat_date,
                );
                $this->Hotel_Model->update_table("ahapi_name", "tbo_live", "api_hotel_active", $data);
            }
        }
		
		
	}
	
	/**
	 * Login Method for non login users
	 */
	public function login() {
    	$email = $this->security->xss_clean($this->input->post('email'));
		$password = MD5($this->security->xss_clean($this->input->post('password')));
		if(empty($email) || empty($password)){
			$this->session->set_flashdata ( 'alert_register', array ( 'message' => 'Please fill both field to login',
    			'class' => 'alert-danger'
    		));
    		$data["status"] = "fail";               
    		$data["message"] = "Please fill both field to login";
		}
    	$userid = $this->Hotel_Model->userLogin($email, $password);
    	if ($userid == NULL) {
    		$this->session->set_flashdata ( 'alert_register', array ( 'message' => 'User name or Password is wrong',
    			'class' => 'alert-danger'
    		));
    		$data["status"] = "fail";               
    		$data["message"] = "User name or Password is wrong!";
    	} else {

    		$_SESSION['customer_id'] = $userid['id'];
    		$_SESSION['customer_name'] = $userid['name'];
    		$this->session->set_userdata('Userlogin', $userid);
    		$this->session->set_flashdata('cusmsg', 'You are Login Successfully ');
    		$data["status"] = "success";               
    		$data["message"] = "You are Login Successfully!";
    	}
    	echo json_encode($data);
    }

	
	public function token_authenticate(){
        $data = array(
            "ClientId" => $this->ClientId,
            "UserName" => $this->UserName,
            "Password" => $this->Password,
            "EndUserIp" => $this->EndUserIp,
        );
		$data_string = json_encode($data);
		// echo "url ".$this->auth_url."<br>";
		// echo $data_string."<br>";
        $ch = curl_init($this->auth_url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string),
        ));
        $result = curl_exec($ch);
		
		// print_r($result);die; 
		
        $arrayresult = json_decode($result);
        $_SESSION['flight']['Token_request_data'] = $data_string;
        $_SESSION['flight']['Token_result_data'] = $result;
        $_SESSION['flight']['TokenData'] = $arrayresult;
    }
	
	
	public function index() {
		unset ( $_SESSION ['hotel'] );
		//redirect ( "" );
		
		$sliderimg = $this->Hotel_Model->get_slider_img("slider_image");
		 $data["sliderimg"] = $sliderimg;
		
		$category1 = $this->Hotel_Model->get_category("1");
		$category2 = $this->Hotel_Model->get_category("2");
		$package1 = $this->Hotel_Model->get_packages_by_category_id("1");
		$package2 = $this->Hotel_Model->get_packages_by_category_id("2");
		$data['category1'] = $category1;
	    $data['category2'] = $category2;
	    $data['package1'] = $package1;
	    $data['package2'] = $package2;
		
		$blogs = $this->Hotel_Model->get_blog_list("blog_list");
		$data["blogs"] = $blogs;
		
		$this->load->view('hotel/home',$data);
	}

	public function print_ticket(){
		$refId = url_decode ( $_GET ['ref_id'] );
		$SelectedFare['bp_hotel_detailq'] = $this->Hotel_Model->get_search_detail ( $refId);
		$SelectedFare['temp_data'] = $this->Hotel_Model->get_hotel_temp_data( $refId);
		$SelectedFare['bp_passenger_detail'] = $this->Hotel_Model->get_search_detail_passenger( $refId);
	    $SelectedFare['hotel_info'] = $this->Hotel_Model->get_hotel_temp_info("hotel_info_result",$refId);

		// echo "<pre>";
		// print_r($SelectedFare);die;
		$this->load->view ( 'user/ticket/booking_print', $SelectedFare );
		//$this->load->view('hotel/ticket/booking_print');
	}

    public function voucher_print(){
		$booking_id = bp_hash($this->input->get("ref_id"));
		$booking_details = $this->Hotel_Model->get_hotel_by_booking_id($booking_id);
		$hotel_id = $booking_details->hoffbo_hotel_id;
		$room_id = $booking_details->hoffbo_room_id;
		$data['booking_details'] = $booking_details;
		$hotel_details = $this->Hotel_Model->get_hotel_by_hotelid($hotel_id);
		$data['hotel_details'] = $hotel_details;
		$room_details = $this->Hotel_Model->get_room_by_roomid($room_id);
		$data['room_details'] = $room_details;
		$pax_details = $this->Hotel_Model->get_pax_by_booking_id($booking_id);
		$data['pax_details'] = $pax_details;
		// echo"<pre>";
		// print_r($data);
		// die;
		$this->load->view('hotel/ticket/voucher_print', $data);
	}
	
	public function fetch_city() {
		$id = $this->input->post ( 'id' );
		$bp_result_city = array ();
		$bp_result_fount = "0";
		$bp_city = $this->Hotel_Model->bp_city ( $id );
		$bp_other_city = $this->Hotel_Model->bp_other_city ( $id );
		array_push ( $bp_result_city, $bp_city );
		array_push ( $bp_result_city, $bp_other_city );
		$return_city = $this->Hotel_Model->findcity ( $id );
		echo '<ul>';
		foreach ( $bp_result_city as $return_city ) {
			if (is_array ( $return_city )) {
				foreach ( $return_city as $city_name ) {
					if ($city_name->stateprovince != "") {
						$bp_state = $city_name->stateprovince . ' , ';
					} else {
						$bp_state = "";
					}
					$bp_result_fount = "1";
					echo '<li onClick="fill(\'' . $city_name->Destination . ' , ' . $bp_state . $city_name->country . '\',\'' . $city_name->Destination . '_' . $city_name->cityid . '_' . $city_name->countrycode . '\');" value=' . $city_name->cityid . '_' . $city_name->countrycode . '>' . $city_name->Destination . ' ( ' . $bp_state . $city_name->country . ')' . '</li>';
				}
			}
		}
		if ($bp_result_fount == "0") {
			echo '<li>No Found, Please enter valid city name</li>';
		}
		echo '</ul>';
	}
	
	public function search() {
		unset ( $_SESSION ['hotel'] );
		$RequestMethod = $this->input->server ( 'REQUEST_METHOD' );
		if ($RequestMethod == "POST") {
			$country_full = explode ( "_", $this->input->post ( "country" ) );
			$data ['nationality'] = $country_full ['0'];
			$city = $_POST ['cityDom'];
			$exp = explode ( "_", $city );
			$data ['cityName'] = $exp [0];
			$data ['cityCode'] = $exp [1];
			$data ['country'] = $exp [2];
			if ($data ['country'] == "IN") {
				$data ['IsDomestic'] = "true";
				$data ['type'] = "domestic";
			} else {
				$data ['IsDomestic'] = "false";
				$data ['type'] = "international";
			}
			$data ['location'] = $_POST ['location'];
			$data ['checkIn'] = $_POST ['checkin'];
			$data ['checkOut'] = $_POST ['checkout'];
			$date1 = new DateTime ( date ( 'Y-m-d', strtotime ( $_POST ['checkin'] ) ) );
			$date2 = new DateTime ( date ( 'Y-m-d', strtotime ( $_POST ['checkout'] ) ) );
			$nights = $date2->diff ( $date1 )->format ( "%a" );
			if ($nights == 0){
				$nights = 1;}else {
				    $nights = $nights;
				}
			$data ['nights'] = $nights;
			$data ['room'] = $_POST ['room'];
			$data ['rating'] = $_POST ['rating'];
			for($i = 1; $i <= $_POST ['room']; $i ++) {
				$data ["adult_" . $i] = $_POST ['adult_' . $i];
				if ($_POST ['child_' . $i] == "") {
					$data ["child_" . $i] = "0";
				} else {
					$data ["child_" . $i] = $_POST ['child_' . $i];
					for($j = 1; $j <= $data ["child_" . $i]; $j ++) {
						$data ["age_" . $i . "_" . $j] = $_POST ["age_" . $i . "_" . $j];
					}
				}
			}
			$_SESSION ['hotel'] ['search_data'] = $data;
			$location = $data ['location'];
			$type = $data ['type'];
			$country = $data ['country'];
			$city = $data ['cityName'];
			$cityCode = $data ['cityCode'];
			$checkin = date ( "d/m/Y", strtotime ( $data ['checkIn'] ) );
			$checkout = date ( "dd/mm/yy", strtotime ( $data ['checkOut'] ) );
			$date1 = new DateTime ( date ( 'Y-m-d', strtotime ( $data ['checkIn'] ) ) );
			$date2 = new DateTime ( date ( 'Y-m-d', strtotime ( $data ['checkOut'] ) ) );
			$nights = $date2->diff ( $date1 )->format ( "%a" );
			if ($nights == 0)
				$nights = 1;
			$room = $data ['room'];
			$isDomestic = $data ['IsDomestic'];
			$rating = $data ['rating'];
			$rate = explode ( '_', $rating );
			$roomS = $_SESSION ['hotel'] ['search_data'];
			for($i = 1; $i <= $room; $i ++) {
				$age [$i] = array ();
				if ($roomS ['child_' . $i] != 0) {
					for($j = 1; $j <= $roomS ['child_' . $i]; $j ++) {
						array_push ( $age [$i], $roomS ['age_' . $i . '_' . $j] );
					}
				}
			}
			$roomdata = array ();
			for($i = 1; $i <= $room; $i ++) {
				$abc = array (
						"NoOfAdults" => $roomS ['adult_' . $i],
						"NoOfChild" => $roomS ['child_' . $i],
						"ChildAge" => $age [$i] 
				);
				array_push ( $roomdata, $abc );
			}
			$data_json = array (
					"BookingMode" => '5',
					"CheckInDate" => $checkin,
					"NoOfNights" => $nights,
					"CountryCode" => $country,
					"CityId" => $cityCode,
					"ResultCount" => null,
					"PreferredCurrency" => getCurrentCurrency(),
					"GuestNationality" => $_SESSION ['hotel'] ['search_data'] ['nationality'],
					"NoOfRooms" => $room,
					"RoomGuests" => $roomdata,
					"PreferredHotel" => "",
					"MaxRating" => $rate [1],
					"MinRating" => $rate [0],
					"ReviewScore" => null,
					"IsNearBySearchAllowed" => false,
			);
			
			//$this->db_token();
			$bp_search_data_for_search=$data_json;
			$data_json['EndUserIp'] = $this->EndUserIp;
			$data_json['TokenId'] = $this->TokenId;
			$data_string = json_encode($data_json);
			$_SESSION ['hotel'] ['array'] ['search_request'] = $data_json;
			$_SESSION ['hotel'] ['json'] ['search_request'] = $data_string;
			
			 // echo "<pre>";
			 // print_r(($data_string));die;
			
			$ch = curl_init($this->url . '/GetHotelResult/');
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'Content-Type: application/json',
				'Content-Length: ' . strlen($data_string),
			));
			$result = curl_exec($ch);
			$_SESSION ['hotel'] ['json'] ['search_result'] = $result;
			$arrayresult = json_decode($result);
			$_SESSION ['hotel'] ['array'] ['search_result'] = $arrayresult;
			$_SESSION ['hotel'] ['nights']= $nights;
			
			// echo "<pre>";
			// print_r($result);die;
			// echo "<pre>";
			//print_r(json_encode($result));die;
			
			redirect ( "hotel/result" );
		} else {

		echo "not working ";
		}
	}
	
	public function result() {
		if (isset ( $_SESSION ['hotel'] ['array'] ['search_result'] )) {
			if ($_SESSION ['hotel'] ['array'] ['search_result']->HotelSearchResult->Error->ErrorCode == "0") {
				// ----Start for filter data-----
				$address_list[] = "";
				foreach ($_SESSION ['hotel']['array']['search_result']->HotelSearchResult->HotelResults as $bp_for_filter_loop ) {
					$_SESSION ['hotel'] ['hotel_names'] [] = $bp_for_filter_loop->HotelName;
					$_SESSION ['hotel'] ['price'] [] = round($bp_for_filter_loop->Price->PublishedPrice);
					$address = explode(",",$bp_for_filter_loop->HotelAddress);
					foreach($address as $ad){
						if(empty($ad)){
						}else{
							if(in_array($ad,$address_list)){	
							}else{
								if($_SESSION ['hotel'] ['search_data']['cityName']){
									$replacedata = str_replace($_SESSION ['hotel'] ['search_data']['cityName'],"",$ad);
								}
								$address_list[]=$replacedata;
							}
						}
					}			
					
				}
				
				$_SESSION ['hotel'] ['hotel_location'] =  	$address_list;				
				$_SESSION ['hotel'] ['filter'] ['name_fliter'] = "all";
				$_SESSION ['hotel'] ['filter'] ['location_fliter'] = "all";
				$_SESSION ['hotel'] ['filter'] ['star'] = array (
						'',
						'0',
						'1',
						'2',
						'3',
						'4',
						'5' 
				);
				$_SESSION ['hotel'] ['filter'] ['min_price'] = min ( $_SESSION ['hotel'] ['price'] );
				$_SESSION ['hotel'] ['filter'] ['max_price'] = max ( $_SESSION ['hotel'] ['price'] );
				// ----End for filter data---------
				unset( $_SESSION ['hotel'] ['array'] ['new_result'] );
				$_SESSION ['hotel'] ['array'] ['new_result'] = $_SESSION ['hotel']['array']['search_result']->HotelSearchResult->HotelResults;
				$_SESSION ['hotels'] = $this->hotelspage($page = 1);
				
				$dsa_markup_temp = $this->Hotel_Model->get_dsa_markup($this->dsa_data->dsa_id);
				$dsa_markup = array();
		
				if (is_array($dsa_markup_temp)) {
					foreach ($dsa_markup_temp as $key => $dsa_markup_temps) {
							$dsa_markup [$key] ['dsamark_amount_type'] = $dsa_markup_temps->dsahomark_amount_type;
							$dsa_markup	[$key] ['dsamark_value'] = $dsa_markup_temps->dsahomark_amount;
							$dsa_markup [$key] ['dsamark_min_range'] = $dsa_markup_temps->dsahomark_low_range;
							$dsa_markup	[$key] ['dsamark_max_range'] = $dsa_markup_temps->dsahomark_high_range;
					}
				}
				$dsa_discount_temp = $this->Hotel_Model->get_dsa_discount($this->dsa_data->dsa_id);
				$_SESSION ['hotle'] ['dsa_discount'] = $dsa_discount_temp; 
				$_SESSION ['hotle'] ['dsa_markup'] = $dsa_markup;
				$this->load->view ( "hotel_result" );
			}  else {
				$_SESSION ['bp_error_message'] = "Oops! Something went wrong. This page didn't load data. Please search again! (" . $_SESSION ['hotel'] ['array'] ['search_result']->HotelSearchResult->Error->ErrorMessage . ")";
				$_SESSION ['bp_error_class'] = "alert-warning";
				$this->load->view ( "bp_error" );
			}
		} else {
			redirect ( "hotel" );
		}
	}
	
	public function hotelspage($page = 0) {
		if ($page != 0) {
			$_GET ['page'] = $page;
		}
		$yourDataArray = array ();
		$result = $_SESSION ['hotel'] ['array'] ['new_result'];
		$_SESSION ['total_hotels'] = count ( $_SESSION ['hotel'] ['array'] ['new_result'] );
		$bp_result_count = count ( $result );
		$page = ! empty ( $_GET ['page'] ) ? ( int ) $_GET ['page'] : 1;
		$yourDataArray = $result;
		$total = count ( $yourDataArray ); // total items in array
		$limit = 50; // per page
		$totalPages = ceil ( $total / $limit ); // calculate total pages
		$page = max ( $page, 1 ); // get 1 page when $_GET['page'] <= 0
		$page = min ( $page, $totalPages ); // get last page when $_GET['page'] > $totalPages
		$offset = ($page - 1) * $limit;
		if ($offset < 0)
			$offset = 0;
		$yourDataArray = array_slice ( $yourDataArray, $offset, $limit );
		$_SESSION ['showing'] = $page * $limit;
		$_SESSION ['total_pages'] = $totalPages;
		if (isset ( $_GET ['is_ajax'] ) == 1) {
			// echo json_encode($yourDataArray);
			$hotels = $this->getFormatedHotels ( $yourDataArray );
			echo json_encode ( $hotels );
		} else {
			return json_encode ( $yourDataArray );
		}
	}
	
	function getFormatedHotels($hotelsArray) {
		$hotels = array ();
		foreach ( $hotelsArray as $key => $results ) {
			$hotels ['hotels'] [] = $this->resultCard ( $results, $key );
		}
		$hotels ['total'] = $_SESSION ['total_hotels'];
		$hotels ['showing'] = $_SESSION ['showing'];
		$hotels ['total_pages'] = $_SESSION ['total_pages'];
		// $hotels['showing'] = $_SESSION['showing'];
		return $hotels;
	}
	
	public function resultCard($results, $key = '') {

		$nights = $_SESSION ['hotel'] ['nights'];
		$publish_fare = $results->Price->PublishedPriceRoundedOff;
		$offer_fare =   $results->Price->OfferedPriceRoundedOff;
		$currency  = $results->Price->CurrencyCode;
		$currency = $currency ? $currency : getCurrentCurrency();
		$symbol = getCurrencySymbol($currency); 
		
		//$markup_discount = bp_get_hotel_fare($offer_fare,$publish_fare);
		$markup_discount = bp_get_hotel_fare_pernight($offer_fare,$publish_fare,$nights);
		$customer_fare = round($markup_discount['final_fare']);
		$totol_price [] = $customer_fare;
		$total_StarRating [] = $results->StarRating;
		$hotel_name_list [] = $results->HotelName;
		$hotelName = $results->HotelName;
		$hotelCode = $results->HotelCode;
		$hotelAddress = trim ( $results->HotelAddress, ' ,' );
		$addArr = explode ( ',', $results->HotelAddress );
		$picture = $results->HotelPicture;
		//print_r($results);die;
		
		$area = $hotelAddress;
		$area = $addArr [sizeof ( $addArr ) - 2];
		$html = '<div class="rating_str" rating="' . $results->StarRating . '">
             <div class="price_div" price="' . $customer_fare . '">
            <div class="address_div" address="' . $results->HotelAddress . '">
             <div class="hotel_name_div" hotel-name="' . $results->HotelName . '" address="' . $results->HotelAddress . '">
			 <!------new obx--------->
			
			 	<div class="htl-listing-result-wrap">
					<div class="row">
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<div class="htl-listing-img">
							<img class="hotel-thumnail lazy" data-src="' . $results->HotelPicture . '">
						</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class="htl-listing-desc">
							<h3 class="htl-name">' . $results->HotelName . '</h3>
							<ul class="list-inline hj">';
									if ($results->StarRating > 0) {
										for($star_i = 0; $star_i < $results->StarRating; $star_i ++) {
											$html .= '<li class="list-inline-item"><i class="icofont-star yellow-star"></i></li>';
										}
		                            }	
									$html .= '</ul>
				                      <div class="htl-add">
				                        <span class="area"><i class="icofont-google-map"></i> : '.$results->HotelAddress.'</span>
				                      </div>
				                      <div class="html-shrt-desc">
				                        <p>' . bp_word_limit ( $results->HotelDescription, "160" ) . '</p>
				                      </div>
				                    </div>
				                  </div>
				                  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
				                    <div class="htl-listing-price text-center">
				                      <div class="htl-price-list  mb-10">
				                        <div class="per-nt-price">'.$symbol.'  '.$customer_fare .'<small class="d-block">per night</small> </div>
										 <div class="tw-nt-price">(<span>'.$symbol.' '.$customer_fare*$nights .'</span> for '.$nights.' nights)</div>
				                      </div>
				                      <div class="htl-view-list">
										 <form action="' . site_url () . 'hotel/booking_detail" method="POST">
                              <input type="hidden" name="result_index" value="' . $results->ResultIndex . '">
							  <input type="hidden" name="hotel_name" value="' . $results->HotelName . '">
                              <input type="hidden" name="array_index" value="' . $key . '">
                              <input type="hidden" name="hotel_code" value="' . $results->HotelCode . '">
                              <button type="submit" class="btn btn-search booknow">View Detail</button>
                           </form>
				                      </div>
				                    </div>
				                  </div>
				                </div>
				            </div>
							
							</div>
							</div>
							</div>
							</div>
			 <!------end new box----------->';
		return $html;
	}
	
	public function filter_set() {
		// ----Start for star filter-------
		if ($_POST ['type'] == "star") {
			$_SESSION ['hotel'] ['filter'] ['star'] = $_POST ['star_data'];
		}
		// ----Stop Star filter-----------
		// ----Start Price Filter------
		if ($_POST ['type'] == "price") {
			$_SESSION ['hotel'] ['filter'] ['min_price'] = $_POST ['min_price'];
			$_SESSION ['hotel'] ['filter'] ['max_price'] = $_POST ['max_price'];
		}
		// ----Stop Price filter-----
		// ----Start Name filter----
		if ($_POST ['type'] == "name") {
			$_SESSION ['hotel'] ['filter'] ['name_fliter'] = $_POST ['hotel_name'];
		}
		// ----Start Location filter----
		if ($_POST ['type'] == "location") {
			$_SESSION ['hotel'] ['filter'] ['location_fliter'] = $_POST ['hotel_location'];
		}
		
		if ($_POST ['type'] == "name_reset") {
			$_SESSION ['hotel'] ['filter'] ['name_fliter'] = "all";
		}
		// ----Stop Name Filter----
		$old_data = $_SESSION ['hotel'] ['array'] ['search_result']->HotelSearchResult->HotelResults;
		$bp_hotel_data_after_filter = array ();
		foreach ( $old_data as $old_datas ) {
			$bp_c_hotel_name = $old_datas->HotelName;
			$bp_c_hotel_location = $old_datas->HotelAddress;
			$bp_c_star = $old_datas->StarRating;
			$bp_c_price = round($old_datas->Price->PublishedPrice);
			$bp_full_star = $_SESSION ['hotel'] ['filter'] ['star'];
			$bp_min_price = $_SESSION ['hotel'] ['filter'] ['min_price'];
			$bp_max_price = $_SESSION ['hotel'] ['filter'] ['max_price'];
			$bp_hotel_name = $_SESSION ['hotel'] ['filter'] ['name_fliter'];
			$bp_location_name = $_SESSION ['hotel'] ['filter'] ['location_fliter'];	
			
			
			if ($bp_hotel_name == "all") {
			if (in_array ( $bp_c_star, $bp_full_star ) && $bp_c_price >= $bp_min_price && $bp_c_price <= $bp_max_price) {				
				echo 0;
				echo $bp_location_name."--!";
				if ($bp_location_name == "all") {
					echo 1;
					$bp_hotel_data_after_filter [] = $old_datas;
				} else {
					if (strpos($bp_c_hotel_location, $bp_location_name) !== false){
						echo 2;
						$bp_hotel_data_after_filter [] = $old_datas;
					}
				}
				
				}
			}
			else{
				if (in_array ( $bp_c_star, $bp_full_star ) && $bp_c_price >= $bp_min_price && $bp_c_price <= $bp_max_price && strtoupper ( $bp_c_hotel_name )==strtoupper ( $bp_hotel_name )) {
			
					if ($bp_location_name == "all") {
						$bp_hotel_data_after_filter [] = $old_datas;
					} else {
						if (strpos($bp_c_hotel_location, $bp_location_name) !== false){
							$bp_hotel_data_after_filter [] = $old_datas;
						}
					}
				}
			}			
			
			
		}
		// PrintArray($_SESSION ['hotel'] ['array'] ['orginal_result']->Results);
		unset ( $_SESSION ['hotel'] ['array'] ['new_result'] );
		$_SESSION ['hotel'] ['array'] ['new_result'] = $bp_hotel_data_after_filter;
		 
		// PrintArray($_SESSION ['hotel'] ['array'] ['search_result']->Results);
	}
	
	public function hotel_name_json() {
		$bp_hotel_name = $_SESSION ['hotel'] ['hotel_names'];
	    //	unset ( $bp_return_array );
		$bp_return_array = array ();
		foreach ( $bp_hotel_name as $bp_hotel_names ) {
			$bp_st_pos=strpos ( strtoupper ( $bp_hotel_names ), strtoupper ( $_GET ['value'] ) );
			if ($bp_st_pos !== false) {
				if (! in_array ( $bp_hotel_names, $bp_return_array )) {
					$bp_return_array [] = $bp_hotel_names;
				}
			}
		}
		echo json_encode ( $bp_return_array );
	}
	
	public function hotel_location_json() {
		$bp_hotel_name = $_SESSION ['hotel'] ['hotel_location'];
		unset ( $bp_return_array );
		$bp_return_array = array ();
		foreach ( $bp_hotel_name as $bp_hotel_names ) {
			$bp_st_pos=strpos ( strtoupper ( $bp_hotel_names ), strtoupper ( $_GET ['value'] ) );
			if ($bp_st_pos !== false) {
				if (! in_array ( $bp_hotel_names, $bp_return_array )) {
					$bp_return_array [] = $bp_hotel_names;
				}
			}
		}
		echo json_encode ( $bp_return_array );
	}
	
	
	public function booking_detail() {
		$_SESSION ['hotel'] ['array'] ['hotel_info_request_post'] = $_POST;
		$bp_result_index = $this->input->post ( "result_index" );
		$bp_hotel_id = $this->input->post("hotel_code");
		$bp_trace_id = $_SESSION ['hotel'] ['array'] ['search_result']->HotelSearchResult->TraceId;
		$search_data_tbo = array(
            "EndUserIp" => $this->EndUserIp,
            "TokenId" => $this->TokenId,
            "TraceId" => $bp_trace_id,
            "ResultIndex" => $bp_result_index,
            "HotelCode" => $bp_hotel_id,
        );
        $data_string = json_encode($search_data_tbo);
        $ch = curl_init($this->url . '/GetHotelInfo/');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string),
        ));
        $result = curl_exec($ch);
		$_SESSION ['hotel'] ['json'] ['hotel_info_result'] = $result;
		$arrayresult = json_decode($result);
		if ($arrayresult->HotelInfoResult->Error->ErrorCode == "0") {
			$_SESSION ['hotel'] ['array'] ['hotel_info_result'] = $arrayresult;
			$ch = curl_init($this->url . '/GetHotelRoom/');
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'Content-Type: application/json',
				'Content-Length: ' . strlen($data_string),
			));
			$result = curl_exec($ch);
			$result_array_room = json_decode($result);
			$_SESSION ['hotel'] ['json'] ['hotel_room_result'] = $result; 
			if (isset ( $result_array_room->GetHotelRoomResult->Error->ErrorCode )) {
				if ($result_array_room->GetHotelRoomResult->Error->ErrorCode == "0") {
					$_SESSION ['hotel'] ['array'] ['hotel_room_result'] = $result_array_room;
					redirect ( "hotel/select_room" );
				} else {
					$_SESSION ['bp_error_message'] = "Oops! Something went wrong. This page didn't load data. Please search again! (" . $result_array_room->GetHotelRoomResult->Error->ErrorMessage . ")";
					$_SESSION ['bp_error_class'] = "alert-warning";
					$this->load->view ( "bp_error" );
				}
			} else {
				$_SESSION ['bp_error_message'] = "Oops! Something went wrong. This page didn't load data. Please search again!";
				$_SESSION ['bp_error_class'] = "alert-warning";
				$this->load->view ( "bp_error" );
			}
		} else {
			$_SESSION ['bp_error_message'] = "Oops! Something went wrong. This page didn't load data. Please search again! (" . $arrayresult->HotelInfoResult->Error->ErrorMessage . ")";
			$_SESSION ['bp_error_class'] = "alert-warning";
			$this->load->view ( "bp_error" );
		}
	}

	public function select_room() {
	    
		if (isset ( $_SESSION ['hotel'] ['array'] ['hotel_room_result'] )) {
			if (isset ( $_SESSION ['hotel'] ['array'] ['hotel_info_result'] )) {
				$this->load->view ( "hotel/hotel_detail" );
			} else {
				$_SESSION ['bp_error_message'] = "Oops! Something went wrong. This page didn't load data. Please search again!";
				$_SESSION ['bp_error_class'] = "alert-warning";
				$this->load->view ( "bp_error" );
			}
		} else {
			$_SESSION ['bp_error_message'] = "Oops! Something went wrong. This page didn't load data. Please search again!";
			$_SESSION ['bp_error_class'] = "alert-warning";
			$this->load->view ( "bp_error" );
		}
	}
	
	public function block_room() {
		if(!$this->session->userdata("Userlogin")){
			return redirectBack();
		}

		$bp_selected_room_index = explode ( "_", $this->input->get ( "room_index" ) );
		$roominfo = array ();
		$bp_room_data = $_SESSION ['hotel'] ['array'] ['hotel_room_result']->GetHotelRoomResult->HotelRoomsDetails;
		foreach ( $bp_room_data as $bp_room_datas ) {
			if (in_array ( $bp_room_datas->RoomIndex, $bp_selected_room_index )) {
				//  PrintArray($bp_room_datas);
				$bp_select_room_array ["ChildCount"] = $bp_room_datas->ChildCount;
				$bp_select_room_array ["RequireAllPaxDetails"] = $bp_room_datas->RequireAllPaxDetails;
				$bp_select_room_array ["RoomId"] = $bp_room_datas->RoomId;
				$bp_select_room_array ["RoomStatus"] = $bp_room_datas->RoomStatus;
				$bp_select_room_array ["RoomIndex"] = $bp_room_datas->RoomIndex;
				$bp_select_room_array ["RoomTypeCode"] = $bp_room_datas->RoomTypeCode;
				$bp_select_room_array ["RoomTypeName"] = $bp_room_datas->RoomTypeName;
				$bp_select_room_array ["RatePlan"] = $bp_room_datas->RatePlan;
				$bp_select_room_array ["RatePlanCode"] = $bp_room_datas->RatePlanCode;
				$bp_select_room_array ["InfoSource"] = $bp_room_datas->InfoSource;
				$bp_select_room_array ["SequenceNo"] = $bp_room_datas->SequenceNo;
				foreach ( $bp_room_datas->DayRates as $date_key => $bp_dates_value ) {
					$bp_select_room_array ["DayRates"] [$date_key] ['Amount'] = number_format($bp_dates_value->Amount,2);
					$bp_select_room_array ["DayRates"] [$date_key] ['Date'] = $bp_dates_value->Date;
				}
				$bp_select_room_array ["SupplierPrice"] = $bp_room_datas->SupplierPrice;
				$bp_select_room_array ["Price"] = $bp_room_datas->Price;
				$bp_select_room_array ["Price"]->OtherCharges = isset($bp_select_room_array ["Price"]->OtherCharges) ? number_format($bp_select_room_array ["Price"]->OtherCharges,2): null;
				$bp_select_room_array ["Price"]->RoomPrice = isset($bp_select_room_array ["Price"]->RoomPrice) ? number_format($bp_select_room_array ["Price"]->RoomPrice,2): null;
				$bp_select_room_array ["Price"]->PublishedPrice = isset($bp_select_room_array ["Price"]->PublishedPrice) ? number_format($bp_select_room_array ["Price"]->PublishedPrice,2): null;
				$bp_select_room_array ["Price"]->OfferedPrice = isset($bp_select_room_array ["Price"]->OfferedPrice) ? number_format($bp_select_room_array ["Price"]->OfferedPrice,2): null;
				$bp_select_room_array ["Price"]->AgentCommission = isset($bp_select_room_array ["Price"]->AgentCommission) ? number_format($bp_select_room_array ["Price"]->AgentCommission,2): null;
				$bp_select_room_array ["Price"]->ServiceTax = isset($bp_select_room_array ["Price"]->ServiceTax) ? number_format($bp_select_room_array ["Price"]->ServiceTax,2): null;
				$bp_select_room_array ["Price"]->TDS = isset($bp_select_room_array ["Price"]->TDS) ? number_format($bp_select_room_array ["Price"]->TDS,2): null;
				$bp_select_room_array ["Price"]->TotalGSTAmount = isset($bp_select_room_array ["Price"]->TotalGSTAmount) ? number_format($bp_select_room_array ["Price"]->TotalGSTAmount,2): null;
				if(isset($bp_select_room_array ["Price"]->GST->IGSTAmount)){
					//  PrintArray($bp_select_room_array ["Price"]->GST->IGSTAmount);
					 $bp_select_room_array ["Price"]->GST->IGSTAmount =  number_format($bp_select_room_array ["Price"]->GST->IGSTAmount,2);
				}
				$bp_select_room_array ["RoomPromotion"] = $bp_room_datas->RoomPromotion;
				$bp_select_room_array ["Amenities"] = $bp_room_datas->Amenities;
				$bp_select_room_array ["SmokingPreference"] = "0";
				$bp_select_room_array ["BedTypes"] = $bp_room_datas->BedTypes;
				$bp_select_room_array ["HotelSupplements"] = $bp_room_datas->HotelSupplements;
				$bp_select_room_array ["LastCancellationDate"] = $bp_room_datas->LastCancellationDate;
				$bp_select_room_array ["CancellationPolicies"] = $bp_room_datas->CancellationPolicies;
				$bp_select_room_array ["CancellationPolicy"] = $bp_room_datas->CancellationPolicy;
				$bp_select_room_array ["Inclusion"] = $bp_room_datas->Inclusion;
				$bp_select_room_array ["BedTypeCode"] = NULL;
				$bp_select_room_array ["Supplements"] = NULL;
				$roominfo [] = $bp_select_room_array;
				unset ( $bp_select_room_array );
			}
		}
		$_SESSION ['hotel'] ["array"] ['selected_hotel_room_info'] = $roominfo;
		$room = $_SESSION ['hotel'] ['search_data'] ['room'];
		$bp_srdv_index = $this->input->post ( "s_index" );
		$bp_trace_id = $_SESSION ['hotel'] ['array'] ['search_result']->HotelSearchResult->TraceId;
		//$bp_srdv_type = $_SESSION ['hotel'] ['array'] ['search_result']->SrdvType;
		$bp_hotel_post_data = $_SESSION ['hotel'] ['array'] ['hotel_info_request_post'];
		//new block]
		
		$data_json = array(
            "ResultIndex" => $bp_hotel_post_data ['result_index'],
            "HotelCode" => $bp_hotel_post_data ['hotel_code'],
            "HotelName" => $bp_hotel_post_data ['hotel_name'],
            "GuestNationality" => $_SESSION ['hotel'] ['search_data'] ['nationality'],
            "NoOfRooms" => $room,
            "ClientReferenceNo" => 0,
            "IsVoucherBooking" => true,
            "HotelRoomsDetails" => $roominfo,
            "EndUserIp" => $this->EndUserIp,
            "TokenId" => $this->TokenId,
            "TraceId" => $bp_trace_id,
        );
		
		// echo "API URL  : ".$this->url . '/BlockRoom/'."<br/>";
		// echo  "Requested Parameters : ";
		// PrintArray($data_json);die;
		// echo "Room Price = ".$data_json['HotelRoomsDetails'][0]['Price']->RoomPrice;
		// echo  "<br>Offered Price = ".$data_json['HotelRoomsDetails'][0]['Price']->OfferedPrice."<br>";
		// echo  "<br>Offered Price = ".$data_json['HotelRoomsDetails'][0]['Price']->OtherCharges."<br>";
        $data_string = json_encode($data_json);
		// PrintArray($data_string);
		$_SESSION ['hotel'] ['json'] ['hotel_block_request'] = $data_string;
        $ch = curl_init($this->url . '/BlockRoom/');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string),
        ));
        $result = curl_exec($ch);
       
		$_SESSION ['hotel'] ['json'] ['hotel_block_result'] = $result;
        $result_array = json_decode($result);
		$_SESSION ['hotel'] ['array'] ['hotel_block_result'] = $result_array; 
		// echo "Response :";
        // PrintArray($result_array);
        // die;
		//end of new block room
		if (isset ( $result_array->BlockRoomResult->Error->ErrorCode )) {
			if ($result_array->BlockRoomResult->Error->ErrorCode == "0") {
				if ($result_array->BlockRoomResult->AvailabilityType == "Confirm" || $result_array->BlockRoomResult->AvailabilityType == "Confirm") {
					redirect ( "hotel/passenger_detail" );
				} else {
					$_SESSION ['bp_error_message'] = "Oops! Something went wrong. This page didn't load data. Please search again! (" . $result_array->BlockRoomResult->Error->ErrorMessage . ")";
					$_SESSION ['bp_error_class'] = "alert-warning";
					$this->load->view ( "bp_error" );
				}
			} else {
				$_SESSION ['bp_error_message'] = "Oops! Something went wrong. This page didn't load data. Please search again! (" . $result_array->BlockRoomResult->Error->ErrorMessage . ")";
				$_SESSION ['bp_error_class'] = "alert-warning";
				$this->load->view ( "bp_error" );
			}
		} else {
			$_SESSION ['bp_error_message'] = "Oops! Something went wrong. This page didn't load data. Please search again! ";
			$_SESSION ['bp_error_class'] = "alert-warning";
			$this->load->view ( "bp_error" );
		}
	}

	public function passenger_detail() { 
		if(!$this->session->userdata("Userlogin")){
			return redirectBack();
		}
		if (isset ( $_SESSION ['hotel'] ['array'] ['hotel_room_result'] )) {
			if (isset ( $_SESSION ['hotel'] ['array'] ['hotel_info_result'] )) {
			    $bp_user_id = $this->dsa_data->dsa_id;
				$getwayList = $this->Common_Model->get_table_result ( "*", array (
					"dsapayg_user_type" => "DSA",
					"dsapayg_user_id" => $bp_user_id,
					"dsapayg_b2b_b2c" => "B2c",
					"dsapayg_status" => "active", 
					"dsapayg_gateway_name" => "cc_avenue"
				), "dsa_payment_gateway" );
				$data ["getwayList"] = $getwayList;
				
				// echo "<pre>";
				// print_r($getwayList);die;
				
				$this->load->view ( "hotel/hotel_passenger_detail",$data);
			} else {
				$_SESSION ['bp_error_message'] = "Oops! Something went wrong. This page didn't load data. Please search again!";
				$_SESSION ['bp_error_class'] = "alert-warning";
				$this->load->view ( "bp_error" );
			}
		} else {
			$_SESSION ['bp_error_message'] = "Oops! Something went wrong. This page didn't load data. Please search again!";
			$_SESSION ['bp_error_class'] = "alert-warning";
			$this->load->view ( "bp_error" );
		}						
	}

	public function save_booking_data() {
		if (isset ( $_SESSION ['hotel'] ['array'] ['search_request'] ['RoomGuests'] )) {
			$bp_pax_request = $_SESSION ['hotel'] ['array'] ['search_request'] ['RoomGuests'];
			$_SESSION['payment_method']=$this->input->post ( 'payment_method' );
			$_SESSION['mobile']=$this->input->post ( 'mobile' );
			$_SESSION['email']= $this->input->post ( 'cust_email' );
			
			$bp_pax_info = array ();
			foreach ( $bp_pax_request as $bp_pax_key => $bp_pax_requests ) {
				for($i = 0; $i < $bp_pax_requests ['NoOfAdults']; $i ++) {
					$bp_pax_array ["Title"] = $this->input->post ( "title_adult_" . $bp_pax_key . "_" . $i );
					$bp_pax_array ["FirstName"] = $this->input->post ( "first_name_adult_" . $bp_pax_key . "_" . $i );
					$bp_pax_array ["MiddleName"] = null;
					$bp_pax_array ["LastName"] = $this->input->post ( "last_name_adult_" . $bp_pax_key . "_" . $i );
					$bp_pax_array ["Phoneno"] = $this->input->post ( "mobile" );
					$bp_pax_array ["Email"] = $this->input->post ( "email" );
					$bp_pax_array ["PaxType"] = "1";
					if ($i == 0) {
						$bp_pax_array ["LeadPassenger"] = true;
					} else {
						$bp_pax_array ["LeadPassenger"] = false;
					}
					$bp_pax_array ["PassportNo"] = null;
					$bp_pax_array ["PassportIssueDate"] = null;
					$bp_pax_array ["PassportExpDate"] = null;
					$bp_pax_info [$bp_pax_key] [] = $bp_pax_array;
					unset ( $bp_pax_array );
				}
				if ($bp_pax_requests ['NoOfChild'] > 0) {
					foreach ( $bp_pax_requests ['ChildAge'] as $bp_key_child => $bp_child_pax_data ) {
						$bp_pax_array ["Title"] = $this->input->post ( "title_child_" . $bp_pax_key . "_" . $bp_key_child );
						$bp_pax_array ["FirstName"] = $this->input->post ( "first_name_child_" . $bp_pax_key . "_" . $bp_key_child );
						$bp_pax_array ["MiddleName"] = null;
						$bp_pax_array ["LastName"] = $this->input->post ( "last_name_child_" . $bp_pax_key . "_" . $bp_key_child );
						$bp_pax_array ["Phoneno"] = $this->input->post ( "mobile" );
						$bp_pax_array ["Email"] = $this->input->post ( "email" );
						$bp_pax_array ["PaxType"] = "2";
						$bp_pax_array ["LeadPassenger"] = false;
						$bp_pax_array ["Age"] = $this->input->post ( "age_child_" . $bp_pax_key . "_" . $bp_key_child );
						$bp_pax_array ["PassportNo"] = null;
						$bp_pax_array ["PassportIssueDate"] = null;
						$bp_pax_array ["PassportExpDate"] = null;
						$bp_pax_info [$bp_pax_key] [] = $bp_pax_array;
						unset ( $bp_pax_array );
					}
				}
			}
			$bp_room_data = array ();
			$bp_selected_room = $_SESSION ['hotel'] ["array"] ['selected_hotel_room_info'];
			foreach ( $bp_selected_room as $bp_select_room_key => $bp_selected_rooms ) {
				$bp_room_array ['ChildCount'] = $bp_selected_rooms ['ChildCount'];
				$bp_room_array ['RequireAllPaxDetails'] = $bp_selected_rooms ['RequireAllPaxDetails'];
				$bp_room_array ['RoomId'] = $bp_selected_rooms ['RoomId'];
				$bp_room_array ['RoomStatus'] = $bp_selected_rooms ['RoomStatus'];
				$bp_room_array ['RoomIndex'] = $bp_selected_rooms ['RoomIndex'];
				$bp_room_array ['RoomTypeCode'] = $bp_selected_rooms ['RoomTypeCode'];
				$bp_room_array ['RoomTypeName'] = $bp_selected_rooms ['RoomTypeName'];
				$bp_room_array ['RatePlan'] = $bp_selected_rooms ['RatePlan'];
				$bp_room_array ['RatePlanCode'] = $bp_selected_rooms ['RatePlanCode'];
				$bp_room_array ['InfoSource'] = $bp_selected_rooms ['InfoSource'];
				$bp_room_array ['SequenceNo'] = $bp_selected_rooms ['SequenceNo'];
				$bp_room_array ['DayRates'] = $bp_selected_rooms ['DayRates'];
				$bp_room_array ['SupplierPrice'] = $bp_selected_rooms ['SupplierPrice'];
				$bp_room_array ['Price'] = $bp_selected_rooms ['Price'];
				$bp_room_array ['HotelPassenger'] = $bp_pax_info [$bp_select_room_key];
				$bp_room_array ['RoomPromotion'] = $bp_selected_rooms ['RoomPromotion'];
				$bp_room_array ['Amenities'] = $bp_selected_rooms ['Amenities'];
				$bp_room_array ['SmokingPreference'] = $bp_selected_rooms ['SmokingPreference'];
				$bp_room_array ['BedTypes'] = $bp_selected_rooms ['BedTypes'];
				$bp_room_array ['HotelSupplements'] = $bp_selected_rooms ['HotelSupplements'];
				$bp_room_array ['LastCancellationDate'] = $bp_selected_rooms ['LastCancellationDate'];
				$bp_room_array ['CancellationPolicies'] = $bp_selected_rooms ['CancellationPolicies'];
				$bp_room_array ['CancellationPolicy'] = $bp_selected_rooms ['CancellationPolicy'];
				$bp_room_array ['Inclusion'] = $bp_selected_rooms ['Inclusion'];
				$bp_room_array ['BedTypeCode'] = $bp_selected_rooms ['BedTypeCode'];
				$bp_room_array ['Supplements'] = $bp_selected_rooms ['Supplements'];
				$bp_room_data [] = $bp_room_array;
				unset ( $bp_pax_array );
			}
			$roominfo = $_SESSION ['hotel'] ["array"] ['selected_hotel_room_info'];
			$room = $_SESSION ['hotel'] ['search_data'] ['room'];
			$bp_trace_id = $_SESSION ['hotel'] ['array'] ['search_result']->HotelSearchResult->TraceId;
			//$bp_srdv_type = $_SESSION ['hotel'] ['array'] ['search_result']->SrdvType;
			$bp_hotel_post_data = $_SESSION ['hotel'] ['array'] ['hotel_info_request_post'];
			$depart_date_time_arrray = explode("/",$_SESSION ['hotel'] ['array'] ['search_request']['CheckInDate']);
			$depart_date_time = $depart_date_time_arrray['2']."-".$depart_date_time_arrray['1']."-".$depart_date_time_arrray['0'];
			$data ['depart_date'] = $depart_date_time. "T00:00:00";

			
			//booking new
			//$this->db_token();
			$data_json = array(
				"ResultIndex" => $bp_hotel_post_data ['result_index'],
				"HotelCode" => $bp_hotel_post_data ['hotel_code'],
				"HotelName" => $bp_hotel_post_data ['hotel_name'],
				"GuestNationality" => $_SESSION ['hotel'] ['search_data'] ['nationality'],
				"IsPackageFare" =>	$_SESSION ['hotel'] ['array'] ['hotel_block_result']->BlockRoomResult->IsPackageFare,
				"NoOfRooms" => $room,
				"ClientReferenceNo" => 0,
				"IsVoucherBooking" => true,
				"HotelRoomsDetails" => $bp_room_data,
				"ArrivalTransport"=> array(
												"ArrivalTransportType" => 0,
												"TransportInfoId" => "Ab 777",
												"Time" => $data ['depart_date']
											  ),
				"FlightInfo" => null,
				"OnlinePaymentId" => 0,
				"TransactionId" => null,
				"CancelAtPriceChangeAfterBooking" => true,
				"IsAmountDeduct" => false,
				"IsHotelImport" => false,
				"MakePaymentInfo" => null,
				"EndUserIp" => $this->EndUserIp,
				"TokenId" => $this->TokenId,
				"TraceId" => $bp_trace_id,
			);
			$data_string = json_encode($data_json);
			//new booking
			$_SESSION ['hotel'] ['json'] ['hotel_book_request'] = $data_string;
			$_SESSION ['hotel'] ['array'] ['hotel_book_request'] = $data_json;
			$bp_hotel_result = $_SESSION ['hotel'] ['array'] ['search_result'];
			$bp_rooms = 0;
			$bp_adult = 0;
			$bp_child = 0;
			foreach ( $bp_hotel_result->HotelSearchResult->RoomGuests as $no_of_room_loop ) {
				$bp_rooms = $bp_rooms + 1;
				$bp_adult = $bp_adult + $no_of_room_loop->NoOfAdults;
				$bp_child = $bp_child + $no_of_room_loop->NoOfChild;
			}

			if ($this->session->userdata('Userlogin') != NULL) {
				$cusid = $this->session->userdata('Userlogin')['userData']->cust_id;
			} else {
				$cusid = 0;
			}
			
			if ($this->input->post ( 'payment_method' )== "cc_avenue") 
				{
					$transaction_fee = $_SESSION['hotel']['Conv_fee'];
				} else {
					$transaction_fee = 0;
				}
			
			$booking_data = array (
					"hotboli_city_name" => $_SESSION ['hotel'] ['search_data'] ['cityName'],
					"hotboli_city_id" => $_SESSION ['hotel'] ['search_data'] ['cityName'],
					"hotboli_country" => $_SESSION ['hotel'] ['search_data'] ['country'],
					"hotboli_location" => $_SESSION ['hotel'] ['search_data'] ['location'],
					"hotboli_check_in_date" => $bp_hotel_result->HotelSearchResult->CheckInDate,
					"hotboli_check_out_date" => $bp_hotel_result->HotelSearchResult->CheckOutDate,
					"hotboli_adult" => $bp_adult,
					"hotboli_child" => $bp_child,
					"hotboli_room" => $bp_rooms,
					"hotboli_hotel_name" => $data_json ['HotelName'],
					"hotboli_customer_fare" => $_SESSION ['hotel'] ['amount'] ['customer_fare'],
					"hotboli_agent_fare" => $_SESSION ['hotel'] ['amount'] ['agent_fare'],
					"hotboli_dsa_fare" => $_SESSION ['hotel'] ['amount'] ['dsa_fare'],
					"hotboli_admin_fare" => $_SESSION ['hotel'] ['amount'] ['admin_fare'],
					"hotboli_customer_id" => $cusid,
					"hotboli_agent_id" => "0",
					"hotboli_dsa_id" => $this->dsa_data->dsa_id,
					"hotboli_agent_markup" => "0",
					"hotboli_dsa_markup" => "0",
					"hotboli_admin_markup" => "0",
					"hotboli_booking_status" => "Pending",
					"hotboli_payment_status" => "Pending",
					"hotboli_first_name" => $data_json ['HotelRoomsDetails'] ['0'] ['HotelPassenger'] ['0'] ['FirstName'],
					"hotboli_last_name" => $data_json ['HotelRoomsDetails'] ['0'] ['HotelPassenger'] ['0'] ['LastName'],
					"hotboli_mobile" => $this->input->post ( "mobile" ),
					"hotboli_email" => $this->input->post ( 'cust_email' ),
					"hotboli_country_code" => $_SESSION ['hotel'] ['search_data'] ['nationality'],
					"hotboli_mobile_code" => "",
					"hotboli_module" =>"B2C",
					"hotboli_transaction_fee" =>$transaction_fee,
			);

			$bp_booking_id = $this->Hotel_Model->insert_booking ( $booking_data );
			
			$_SESSION ['booking_id'] =$bp_booking_id;

			foreach ( $data_json ['HotelRoomsDetails'] as $bp_room_key_p => $hotel_room_detail_loop ) {
				foreach ( $hotel_room_detail_loop ['HotelPassenger'] as $hotel_room_detail_loops ) {
					$bp_room_no = $bp_room_key_p + 1;
					$bp_pax_title = $hotel_room_detail_loops ['Title'];
					$bp_pax_first_name = $hotel_room_detail_loops ['FirstName'];
					$bp_pax_last_name = $hotel_room_detail_loops ['LastName'];
					$bp_pax_mobile = $hotel_room_detail_loops ['Phoneno'];
					$bp_pax_email = $hotel_room_detail_loops ['Email'];
					if ($hotel_room_detail_loops ['PaxType'] == "1") {
						$bp_pax_type = "Adult";
						$bp_pax_age = "";
					} else {
						$bp_pax_type = "Child";
						$bp_pax_age = $hotel_room_detail_loops ['Age'];
					}
					$pax_data = array (
							"hotbopax_booking_id" => $bp_booking_id,
							"hotbopax_room" => $bp_room_no,
							"hotbopax_title" => $bp_pax_title,
							"hotbopax_first_name" => $bp_pax_first_name,
							"hotbopax_last_name" => $bp_pax_last_name,
							"hotbopax_type" => $bp_pax_type,
							"hotbopax_age" => $bp_pax_age,
							"hotbopax_mobile" => $bp_pax_mobile,
							"hotbopax_email" => $bp_pax_email 
					);
					$this->Hotel_Model->insert_pax ( $pax_data );
				}
			}
			$bp_selected_hotel_room_data = json_encode ( $data_json );
			$temp_data = array (
					"hotdata_booking_id" => $bp_booking_id,
					"hotdata_key" => "selected_hotel_room",
					"hotdata_data" => $bp_selected_hotel_room_data 
			);
			$this->Hotel_Model->insert_temp_data ( $temp_data );
			// hotel inforamtion store //
			$bp_selected_hotel_data = json_encode ( $_SESSION ['hotel'] ['array'] ['hotel_info_result'] );
			$temp_data = array (
					"hotdata_booking_id" => $bp_booking_id,
					"hotdata_key" => "hotel_info_result",
					"hotdata_data" => $bp_selected_hotel_data 
			);
			$this->Hotel_Model->insert_temp_data ( $temp_data );
			redirect ( "hotel/payment_request" );
		} else {
			$_SESSION ['bp_error_message'] = "Oops! Something went wrong. This page didn't load data. Please search again! ";
			$_SESSION ['bp_error_class'] = "alert-warning";
			$this->load->view ( "bp_error" );
		}
	}

	public function payment_request() {
		if(!$this->session->userdata("Userlogin")){
			return redirectBack();
		}
		$booking_id =$_SESSION['booking_id'];
		$remark = "Hotel Booking (ID - " . $booking_id . ")";		
		$totalFare = $_SESSION ['hotel'] ['amount'] ['customer_fare'];
		$currencySelected = $_SESSION ['hotel'] ['amount'] ['currency'];
		if(isset($_SESSION['coupon_applied']) && $_SESSION['coupon_applied'] == true && $_SESSION['coupon_amount'] > 0){
			$totalFare = $totalFare - $_SESSION['coupon_amount'];
		}
		$wallet_amount_detected = 0;
		if ($this->input->post ( 'wallet_amount' ) == "customerCash") {
	        if($this->user_data->cust_balance > 0){
	            if($this->user_data->cust_balance >= $totalFare){
	                $user_id = $this->session->userdata['Userlogin']["id"];
					$bp_agent_payment_status = $this->deduct_customer_balance ( $remark, $totalFare );
					if ($bp_agent_payment_status == "success") {
		                $formData = array (
		                    "wallet_id" => $user_id,
		                    "order_id" => $booking_id,
		                    "customer_id" => $user_id,
		                    "amount_detected" => $totalFare,
		                    "amount_added" => 0,
		                    "wallet_action_detail" => 'Flight payment paid by wallet.',
		                    "created" => date('y-m-d h:i:s')
		                );
		                $this->VisaModel->insert_table('stm_wallet_history',$formData);
						redirect ( "hotel/payment_result_cash" );
					} else {
			            $this->session->set_flashdata('flash_error','There is some problem in booking with your balance. Please contact Admin.');
			            redirect('hotel');
					}
	            }else {
	                $this->session->set_userdata("wallet_amount_detected_flight", $this->user_data->cust_balance); 
	                $wallet_amount_detected = $this->user_data->cust_balance;
	            }
	        }else {
	            $this->session->set_flashdata('flash_error','Insufficient wallet balance. Please try again.');
	            redirect('hotel');
	        }
		}
		if(empty($this->input->post ( 'wallet_amount' )) || ($this->input->post ( 'wallet_amount' ) == "customerCash" && $this->user_data->cust_balance < $totalFare)) {
			$bp_user_id = $this->dsa_data->dsa_id;
			$getwayList = $this->Common_Model->get_table_row("*", array(
				"dsapayg_user_type" => "DSA",
				"dsapayg_user_id" => $bp_user_id,
				"dsapayg_status" => "active",
				"dsapayg_b2b_b2c" => "B2c",
				"dsapayg_gateway_name" => "cc_avenue"
					), "dsa_payment_gateway");
			if($getwayList!="0") {	
				$totalFare = $_SESSION ['hotel'] ['amount'] ['customer_fare'];
				$RefId = $_SESSION ['booking_id'];
				$data1['booking_id'] = $_SESSION ['booking_id'];
				$data['ccavenueConfig'] = $this->Common_Model->get_ccavenue_data("ccavenue_config",'1');		
				$data ['gateway_data'] ['redirect_url'] = site_url () . "hotel/payment_result";
				$data ['gateway_data'] ['cancel_url'] = site_url () . "hotel/payment_result";
				// $data ['gateway_data'] ['merchant_id'] = $getwayList->dsapayg_gateway_user_id;
				$data ['gateway_data'] ['merchant_id'] = $data['ccavenueConfig']->merchant_id;
				$data ['gateway_data'] ["order_id"] = $booking_id;
				if($getwayList->dsapayg_type == "fix"){
					$nkwithconfee =  $totalFare + $getwayList->dsapayg_convenience_fee;
				} else{
					$nkwithconfee =  $totalFare + (( $totalFare * $getwayList->dsapayg_convenience_fee)/100); 
				}
				$nkwithconfee = $nkwithconfee - $wallet_amount_detected;
				$data ['gateway_data'] ['amount'] = round($nkwithconfee);
				$data ['gateway_data'] ['currency'] = getCurrentCurrency();
				$data ['gateway_data'] ['tid'] = "";
				$data ['gateway_data'] ['billing_tel'] = $_SESSION['mobile'];
				$data ['gateway_data'] ['billing_email'] = $_SESSION['email'];
				$data ['gateway_data'] ['billing_address'] = $this->dsa_data->dsa_address;
				$data ['gateway_data'] ['billing_city'] = $this->dsa_data->dsa_city;
				$data ['gateway_data'] ['billing_state'] = $this->dsa_data->dsa_state;
				$data ['gateway_data'] ['billing_zip'] = "";
				$data ['gateway_data']['merchant_param1'] = "";
				$data ['gateway_data']['promo_code']="";
				$data ['gateway_data']['customer_identifier']="";
				$data ['gateway_data']['billing_name']="";
				if($currencySelected == 'AED'){
					$this->session->unset_userdata('temp_transaction');
					// $this->load->view ( 'flight/payment_payd', $data );
					$this->loadAEDPaymentTransaction($data);
				}else{
					$this->load->view ( 'hotel/payment_cc_avenue', $data);
				}
				
			} else {
		   	 	$bp_home_url = site_url ();
				$_SESSION['error'] = "Something Went Wrong Please Contact Admin. <a href='$bp_home_url'>Go to Home</a>";			
			}
		}
		//end ccu
	}


	/**	AED Transaction Implementing */
	private function loadAEDPaymentTransaction($data){
		$this->session->set_userdata(["temp_transaction"=>$data]);
		$userData = $this->session->userdata['Userlogin']['userData'];
		$dataJson = array (
			"name" => $userData->cust_first_name." ".$userData->cust_last_name,
			"amount" => $data ['gateway_data'] ['amount'],
			"remarks" =>$data ['gateway_data'] ["order_id"],
			"phone"=>$userData->cust_mobile,
			"email" => $userData->cust_email,
			"redirecturl" => site_url () . "hotel/payment_payd_response"
		);
		$dataString = json_encode ( $dataJson );
		$headerData = array ('Accept:application/json','secretkey:'.PAYMENT_AED_SECRET_KEY);
		try {
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,PAYMENT_AED_URL);
			curl_setopt ( $ch, CURLOPT_CUSTOMREQUEST, "POST" );
			curl_setopt ( $ch, CURLOPT_POSTFIELDS, $dataJson );
			curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
			curl_setopt ( $ch, CURLOPT_HTTPHEADER,  $headerData);
			curl_setopt($ch, CURLOPT_ENCODING, "gzip");
			$result = curl_exec ( $ch );
			$result = json_decode($result);
			$payment_url = $result->data;
			return redirect($payment_url);
		}catch(Exception $e){
			// echo 'Message: ' .$e->getMessage();
			$this->session->set_flashdata('flash_error','Insufficient wallet balance. Please try again.');
			return redirect('/hotel');
		}
	}


	/** Payment Gateway response Handler (PAYD Payment Gateway) */
	public function payment_payd_response(){
		$ref_id = isset($_GET['reference']) ? $_GET['reference'] : null;
		$dataString = json_encode ( $dataJson );
		$headerData = array ('Accept:application/json','secretkey:'.PAYMENT_AED_SECRET_KEY);
		if($ref_id){
			$api_url =  getAEDPaymentDetail($ref_id);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,$api_url);
			curl_setopt ( $ch, CURLOPT_CUSTOMREQUEST, "GET" );
			curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
			curl_setopt ( $ch, CURLOPT_HTTPHEADER,  $headerData);
			curl_setopt($ch, CURLOPT_ENCODING, "gzip");
			$result = curl_exec ( $ch );
			$result = json_decode($result);
			$orderStatus =  (isset($result->status) && $result->status == 1) ? 'Success' : "Failed";
			$BookingId = $result->remarks;
			$data = array (
				'hotboli_payment_status' => $orderStatus,
				'hotboli_booking_status' => $orderStatus, 
			);
			$this->Hotel_Model->update_booking ( $data, $BookingId );
			if ($orderStatus == "Success") {
				$remark = "Hotel Booking (ID - " . $BookingId . ")";
				$bp_dsa_amount = $_SESSION ['hotel'] ['amount'] ['dsa_fare'];
				$bp_dsa_payment_status = $this->deduct_dsa_balance ($remark, $bp_dsa_amount );
				redirect ( "hotel/book" );
			} else {
				$_SESSION['flight']['search_RequestData']["BookingId"] = $BookingId ;	
				return redirect ( '/flight/payment_error/' );
			}
		}else{
			$transaction = $this->session->userdata('temp_transaction');
			return redirect ( 'hotel/payment_error');
		}
	}

	public function confirm_online() {
        $sessionid = $_POST['udf3'];
        $bp_booking_id = $BookingId =$_SESSION ['booking_id'];
		
		if(isset($_SESSION['hotel_booking_type'])){
			if($_SESSION['hotel_booking_type'] = "extranet"){
				if ($_POST ['status'] == "success") {
			$status = "Success";
			$BookingId = bp_booking_id;
			
		} else {
			$status = "Failed";
		}
				$data = array (
			'hoffbo_amount_status' => $status,
			'hoffbo_status' => $status, 
		);
		$this->Hotel_Model->update_booking_offline ( $data, $BookingId );
		
		if ($status == "Success") {
			$remark = "Hotel Booking (ID - " . $BookingId . ")";
				
				
		redirect ( "hotel/book_result" );
				
		
		} else {
			redirect ( 'hotel/payment_error');
		}
			}
		}else{
        if ($_POST['status'] == "success") {
            $paymentstatus = "success";
            $data = array (
                'hotboli_payment_status' => "Success"
            );
        } else {
            $paymentstatus = "fail";
            $data = array (
                'hotboli_payment_status' => "Failed"
            );
        }
		$this->Hotel_Model->update_booking ( $data, $BookingId );
        
        if ($paymentstatus == "success") {
			$remark = "Hotel Booking (ID - " . $BookingId . ")";
			$bp_dsa_amount = $_SESSION ['hotel'] ['amount'] ['dsa_fare'];
			$bp_dsa_payment_status = $this->deduct_dsa_balance ( $remark, $bp_dsa_amount );
				
				if ("success" == "success") {
							redirect ( "hotel/book" );
				} else {
					echo "There is some problem in booking. Please contact Super Admin";
			}
        } else {
            $this->load->view("hotel/payment_error");
        }
		}
	}
	
	function deduct_dsa_balance($remark, $amount) {
		return "success";
	}

	public function payment_result() {
		$ccavenueConfig = $this->Common_Model->get_ccavenue_data("ccavenue_config",'1');
        $workingKey=$ccavenueConfig->working_key;     //Working Key should be provided here.	
		$BookingId =$_SESSION ['booking_id'];
		// $workingKey='754F85D4B3E4DD8103B9A89871C7FC95';		//Working Key should be provided here.
		$encResponse=$_POST["encResp"];			//This is the response sent by the CCAvenue Server
		$rcvdString= cc_decrypt($encResponse,$workingKey);		//Crypto Decryption used as per the specified working key.
		$order_status="";
		$decryptValues=explode('&', $rcvdString);
		
		$dataSize=sizeof($decryptValues);
		for($i = 0; $i < $dataSize; $i++) {
			$information = explode('=',$decryptValues[$i]);
			if($i==3)	$order_status=$information[1];
			if($i==0)	$BookingId=$information[1];
		}
		
		$status = $order_status;
		if ($status == "Success") {
			// $BookingId = $this->input->post("udf1");
		} else {
			$status = "Failed";
		}
		$data = array (
			'hotboli_payment_status' => $status,
			'hotboli_booking_status' => $status, 
		);
		$this->Hotel_Model->update_booking ( $data, $BookingId );
		
		if ($status == "Success") {
			$remark = "Hotel Booking (ID - " . $BookingId . ")";
			$bp_dsa_amount = $_SESSION ['hotel'] ['amount'] ['dsa_fare'];
			// PrintArray($_SESSION ['hotel'] ['amount']);
			// die ("test");
			$bp_dsa_payment_status = $this->deduct_dsa_balance ( $remark, $bp_dsa_amount );
			// echo "test = ".$bp_dsa_payment_status;
			// if ("success" == "success") {
				redirect ( "hotel/book" );
			// } else {
			// 	echo "There is some problem in booking. Please contact Super Admin";
			// }
		} else {
			redirect ( 'hotel/payment_error');
		}
	}
	
	public function payment_result_cash() {
		$BookingId =$_SESSION ['booking_id'];
		$status = "Success";

		$data = array (
			'hotboli_payment_status' => $status 
		);
		$this->Hotel_Model->update_booking ( $data, $BookingId );
		
		if ($status == "Success") {
			
			$remark = "Hotel Booking (ID - " . $BookingId . ")";
			$bp_dsa_amount = $_SESSION ['hotel'] ['amount'] ['dsa_fare'];
			$bp_dsa_payment_status = $this->deduct_dsa_balance ( $remark, $bp_dsa_amount );
				
				if ("success" == "success") {
							redirect ( "hotel/book" );
				} else {
					echo "There is some problem in booking. Please contact Super Admin";
			}
			
		} else {
			redirect ( 'hotel/payment_error');
		}

	}
	
	//=========deduct custome balance
	function deduct_customer_balance($remark, $totalFare) {
		// $bp_dsa_id = $this->customerdata->cust_id;
		//$bp_dsa_company_name = $this->customerdata->cust_first_name;
		$bp_dsa_id = $this->session->userdata("Userlogin")['userData']->cust_id;
		$bp_dsa_company_name = $this->session->userdata("Userlogin")["name"];		
		
		$bp_credit = $totalFare;
		//print_r($bp_dsa_id);die;
		$bp_old_balance = $this->user_data->cust_balance;
		//print_r($bp_old_balance );die;
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
    public function payment_razorpay() {
		if (!empty($this->input->post('razorpay_payment_id')) ) {
			$BookingId =$_SESSION ['booking_id'];
				$status = "Success";
			
			if(isset($_SESSION['hotel_booking_type'])){
				if($_SESSION['hotel_booking_type'] = "extranet"){
					$data = array (
				'hoffbo_amount_status' => $status,
				'hoffbo_status' => $status, 
			);
			$this->Hotel_Model->update_booking_offline ( $data, $BookingId );
			
			if ($status == "Success") {
				$remark = "Hotel Booking (ID - " . $BookingId . ")";
					
					
			redirect ( "hotel/book_result" );
					
			
			} else {
				redirect ( 'hotel/payment_error');
			}
				}
			}else{
			$data = array (
				'hotboli_payment_status' => $status,
				'hotboli_booking_status' => $status, 
		);
		$this->Hotel_Model->update_booking ( $data, $BookingId );
		
		if ($status == "Success") {
			$remark = "Hotel Booking (ID - " . $BookingId . ")";
			$bp_dsa_amount = $_SESSION ['hotel'] ['amount'] ['dsa_fare'];
			$bp_dsa_payment_status = $this->deduct_dsa_balance ( $remark, $bp_dsa_amount );
				
				if ("success" == "success") {
							redirect ( "hotel/book" );
				} else {
					echo "There is some problem in booking. Please contact Super Admin";
			}
		
		} else {
			redirect ( 'hotel/payment_error');
		}
		}
		} else {
			redirect ( 'hotel/payment_error');
		}
	}
	
	public function payment_result_ammar() {
        $BookingId =$_SESSION ['booking_id'];
		if($_POST["pay_status"] == "Successful"){
			$status="Success";
		}else{
			$status="Failed";
		}
		if (isset($_SESSION['hotel_booking_type'])){
			if($_SESSION['hotel_booking_type'] = "extranet"){
				$data = array (
			'hoffbo_amount_status' => $status,
			'hoffbo_status' => $status, 
		);
		$this->Hotel_Model->update_booking_offline ( $data, $BookingId );
		
		if ($status == "Success") {
			$remark = "Hotel Booking (ID - " . $BookingId . ")";
				
				
		redirect ( "hotel/book_result" );
				
		
		} else {
			redirect ( 'hotel/payment_error');
		}
			}
		}else{
			$data = array (
				'hotboli_payment_status' => $status 
			);
			$this->Hotel_Model->update_booking ( $data, $BookingId );
		
			if ($status == "Success") {

				$remark = "Hotel Booking (ID - " . $BookingId . ")";
				$bp_dsa_amount = $_SESSION ['hotel'] ['amount'] ['dsa_fare'];
				$bp_dsa_payment_status = $this->deduct_dsa_balance ( $remark, $bp_dsa_amount );
					
					if ("success" == "success") {
								redirect ( "hotel/book" );
					} else {
						echo "There is some problem in booking. Please contact Super Admin";
				}

			} else {
				redirect ( '/hotel/payment_error/' );
			}
		}
	}

	public function payment_error() {
		$this->load->view ( "hotel/payment_error" );
	}

	public function book() {
		if (isset ( $_SESSION ['hotel'] ['array'] ['search_request'] ['RoomGuests'] )) {
			$data_string = $_SESSION ['hotel'] ['json'] ['hotel_book_request'];
			$dataString = json_decode($data_string,true);
			$dataString['HotelRoomsDetails'][0]['HotelPassenger'][0]['PAN'] = 'EBQPS3333T';
			$data_string = json_encode($dataString);
			echo $this->url . '/Book/';
			$ch = curl_init($this->url . '/Book/');
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'Content-Type: application/json',
				'Content-Length: ' . strlen($data_string),
			));
			$result = curl_exec($ch);
			$_SESSION ['hotel'] ['json'] ['hotel_book_result'] = $result;
			$result_array = json_decode($result);
			$_SESSION ['hotel'] ['array'] ['hotel_book_result'] = $result_array;
			//end new
			if (isset ( $result_array->BookResult->Error->ErrorCode )) {
				if ($result_array->BookResult->Error->ErrorCode == "0") {
				$dataB = array (
							'hotboli_book_confim_number' 	=> $result_array->BookResult->ConfirmationNo,
							'hotboli_booking_id' 			=> $result_array->BookResult->BookingId, 
							'hotboli_booking_status'     	=> "Success"	
						);
						//$this->Hotel_Model->update_booking ( $dataB, $BookingId );
					$this->Hotel_Model->update_booking ( $dataB, $_SESSION['booking_id'] );
					if ($result_array->BookResult->HotelBookingStatus == "Confirmed") {
						$data= $this->Hotel_Model->get_pax_data($_SESSION['booking_id']);
						$message = $this->load->view('hotel/ticket/booking_print',"vk",TRUE); 
						// $dsaemailsetting = $this->Hotel_Model->get_mailsetting($this->dsa_data->dsa_id);
						// $emailconfig = array(
							// "smtp_host" => $dsaemailsetting->email_smtp_host,
							// "smtp_port" => $dsaemailsetting->email_smtp_port,
							// "smtp_username" => $dsaemailsetting->email_smtp_user,
							// "smtp_password" => $dsaemailsetting->email_smtp_password,
							// "smtp_frommail" => $dsaemailsetting->email_from,
							// "smtp_name" => $dsaemailsetting->email_name,
						// );
						$mail_id = $data->hotbopax_email;
						$sender_subject = "Your hotel booked successful ( Booking ID :".$_SESSION['booking_id'].")" ;
						// email_send($mail_id, $sender_subject, $message, $emailconfig,$content);
						email_send($mail_id, $sender_subject, $message);
						redirect ( "hotel/booking_result" );
					} else {
						$_SESSION ['bp_error_message'] = "Oops! Something went wrong. This page didn't load data. Please search again! (" . $result_array->BookResult->Error->ErrorMessage . ")";
						$_SESSION ['bp_error_class'] = "alert-warning";
						$this->load->view ( "bp_error" );
					}
				} else {
					$_SESSION ['bp_error_message'] = "Oops! Something went wrong. This page didn't load data. Please search again! (" . $result_array->BookResult->Error->ErrorMessage . ")";
					$_SESSION ['bp_error_class'] = "alert-warning";
					$this->load->view ( "bp_error" );
				}
			} else {
				$_SESSION ['bp_error_message'] = "Oops! Something went wrong. This page didn't load data. Please search again! ";
				$_SESSION ['bp_error_class'] = "alert-warning";
				$this->load->view ( "bp_error" );
			}
		} else {
			die ("else");
			$_SESSION ['bp_error_message'] = "Oops! Something went wrong. This page didn't load data. Please search again! ";
			$_SESSION ['bp_error_class'] = "alert-warning";
			$this->load->view ( "bp_error" );
		}
	}

	public function booking_result() {
		$booking_id=$_SESSION ['booking_id'];
		$data['bp_hotel_detailq'] = $this->Hotel_Model->get_search_detail ( $booking_id);
		$this->load->view ("book_result",$data);
	}

	public function test() {
		PrintArray ( $_SESSION ['hotel'] ['array'] );
	}

	public function search_extranet() {
		$data = $_SESSION ['hotel'] ['search_data'];
		$city = $data['cityName'];
			$hotel_offline = $this->Hotel_Model->get_hotel ($city );
			$data['hotel_offline'] = $hotel_offline;
			
			if($hotel_offline != "not")
			{
           $checkin = $data['checkIn'];
           $checkout = $data['checkOut'];
		   $bp_from_data = explode ( "-", $checkin ); 
			
			$bp_data ['from'] = $checkin;
			$bp_data ['from_day'] = ( int ) $bp_from_data ['0'];
			$bp_data ['from_month'] = ( int ) $bp_from_data ['1'];
			$bp_data ['from_year'] = ( int ) $bp_from_data ['2'];
			//--To date Operation
			$bp_to_data = explode ( "-", $checkout );
			$bp_data ['to'] = $checkout;
			$bp_data ['to_day'] = ( int ) $bp_to_data ['0'];
			$bp_data ['to_month'] = ( int ) $bp_to_data ['1'];
			$bp_data ['to_year'] = ( int ) $bp_to_data ['2'];

			$bp_from_date_for_compare = date_format ( date_create ( $checkin ), "Y-m-d" );
			$bp_to_date_for_compare = date_format ( date_create ( $checkout ), "Y-m-d" );
			
			$date = $bp_from_date_for_compare;
			$end_date = $bp_to_date_for_compare;
				// $bp_final_data = explode ( "-", $date );
				// $bp_data_final ['final_day'] = ( int ) $bp_final_data ['2'];
				// $bp_data_final ['final_day_1'] = "hofravai_d_" . $bp_data_final ['final_day'];
				// $bp_data_final ['final_month'] = ( int ) $bp_final_data ['1'];
				// $bp_data_final ['final_year'] = ( int ) $bp_final_data ['0'];
				// $bp_final_data1 = explode ( "-", $end_date );
				// $bp_data_final ['final_day2'] = ( int ) $bp_final_data1 ['2'];
				// $bp_data_final ['final_day_2'] = "hofravai_d_" . $bp_data_final ['final_day2'];
				// $bp_data_final ['final_month2'] = ( int ) $bp_final_data1 ['1'];
				// $bp_data_final ['final_year2'] = ( int ) $bp_final_data1 ['0'];
				foreach($data['hotel_offline'] as $key => $room_availability){
					$bp_data_final['hotel_id'] = $room_availability->hofl_id;
					$hotel_id = $bp_data_final['hotel_id'];
					
					// $availability = $this->Hotel_Model->bp_room_availability_get ( $bp_data_final );
				
					while (strtotime($checkin) <= strtotime($checkout)) {
                //echo "$checkin\n";
				
					$bp_final_data = explode ( "-", $checkin );
					$bp_data_final ['final_day'] = ( int ) $bp_final_data ['0'];
					$bp_data_final ['final_day_1'] = "hofravai_d_" . $bp_data_final ['final_day'];
					$bp_data_final ['final_month'] = ( int ) $bp_final_data ['1'];
					$bp_data_final ['final_year'] = ( int ) $bp_final_data ['2'];
					
					$availability = $this->Hotel_Model->bp_room_availability_get( $bp_data_final);
			   
					if ($availability != "not"){
						
						$data['bp_availability_get'][$hotel_id] = $availability;
					} else {
						$data['bp_availability_get'] = "not";
						
					}
                    $checkin = date ("d-m-Y", strtotime("+1 day", strtotime($checkin)));
	            }
                }
						

				if ($data['bp_availability_get'] == "not") {
				$bp_already_booked ['book'] = "Room Not Available";
			} else {$rooms_details=array();
					$hotel_images=array();
					$rooms_images=array();
					$i = 0;
         foreach($data['bp_availability_get'] as $key => $bp_availability)
         {
			 
         	$room_id = $bp_availability[$i]->hofravai_room_id;
         	$hotel_id = $bp_availability[$i]->hofravai_hotel_id;

         	$roomdet = $this->Hotel_Model->bp_room_details($room_id); 
         	if($roomdet == "not"){
              
         	}else{
         		$rooms_details = $roomdet;
         	}
            $hotel_img[$hotel_id] = $this->Hotel_Model->bp_hotel_images($hotel_id); 
         	if($hotel_img == "not"){
              
         	}else{
         		$hotel_images = $hotel_img;
         	}
			$roomimg = $this->Hotel_Model->bp_room_images($room_id); 
         	if($roomimg == "not"){
              
         	}else{
         		$rooms_images = $roomimg;
         	}
			$i++;
         }	
		 $data['rooms_details'] = $rooms_details;
		 $data['hotel_images'] = $hotel_images;
		 $data['rooms_images'] = $rooms_images;
					
				}
		}else {
			
			$data['rooms_details'] = "";
			$data['hotel_images'] = "";
			$data['rooms_images'] = "";
		}
			return $data;
		
	}

    public function room_detail() {
		$id = url_decode ( $this->input->get ( "ref_id" ) );
		$checkin = $_SESSION['Hotel_Offline'] ['array']['checkIn'];
           $checkout = $_SESSION['Hotel_Offline'] ['array']['checkOut'];
			$bp_from_data = explode ( "-", $checkin ); 
		$bp_data ['from'] = $checkin;
		$bp_data ['from_day'] = ( int ) $bp_from_data ['0'];
		$bp_data ['from_month'] = ( int ) $bp_from_data ['1'];
		$bp_data ['from_year'] = ( int ) $bp_from_data ['2'];
		//--To date Operation
		$bp_to_data = explode ( "-", $checkout );
		$bp_data ['to'] = $checkout;
		$bp_data ['to_day'] = ( int ) $bp_to_data ['0'];
		$bp_data ['to_month'] = ( int ) $bp_to_data ['1'];
		$bp_data ['to_year'] = ( int ) $bp_to_data ['2'];

		$bp_from_date_for_compare = date_format ( date_create ( $checkin ), "Y-m-d" );
		$bp_to_date_for_compare = date_format ( date_create ( $checkout ), "Y-m-d" );
		
		$date = $bp_from_date_for_compare;
		$end_date = $bp_to_date_for_compare;
				// $bp_final_data = explode ( "-", $date );
				// $bp_data_final ['final_day'] = ( int ) $bp_final_data ['2'];
				// $bp_data_final ['final_day_1'] = "hofravai_d_" . $bp_data_final ['final_day'];
				// $bp_data_final ['final_month'] = ( int ) $bp_final_data ['1'];
				// $bp_data_final ['final_year'] = ( int ) $bp_final_data ['0'];
				// $bp_final_data1 = explode ( "-", $end_date );
				// $bp_data_final ['final_day2'] = ( int ) $bp_final_data1 ['2'];
				// $bp_data_final ['final_day_2'] = "hofravai_d_" . $bp_data_final ['final_day2'];
				// $bp_data_final ['final_month2'] = ( int ) $bp_final_data1 ['1'];
				// $bp_data_final ['final_year2'] = ( int ) $bp_final_data1 ['0'];
				while (strtotime($checkin) <= strtotime($checkout)) {
                //echo "$checkin\n";
				
					$bp_final_data = explode ( "-", $checkin );
					$bp_data_final ['final_day'] = ( int ) $bp_final_data ['0'];
					$bp_data_final ['final_day_1'] = "hofravai_d_" . $bp_data_final ['final_day'];
					$bp_data_final ['final_month'] = ( int ) $bp_final_data ['1'];
					$bp_data_final ['final_year'] = ( int ) $bp_final_data ['2'];
			 $result = $this->Hotel_Model->bp_room_availability_get_id ( $id, $bp_data_final );
			  $checkin = date ("d-m-Y", strtotime("+1 day", strtotime($checkin)));
	            }
			 $room_id = $result[0]->hofravai_room_id;
			 $hotel_images = $this->Hotel_Model->bp_hotel_images1 ( $id );
			 $data['result'] = $result;
			 $data['hotel_images'] = $hotel_images;
			// echo"<pre>";
			// print_r($data);
			// die;
			$facilities = explode ( ",", $result[0]->hofl_facility );
			foreach($facilities as $facility){
				$data['hotel_facilities'] = $this->Hotel_Model->get_hotel_facilities($facility);
			}
			// echo"<pre>";
			// print_r($data['hotel_facilities']);
			// die;
			$_SESSION ['hotel'] ['array'] ['hotel_room_result'] = $data;
			 if (isset ( $_SESSION ['hotel'] ['array'] ['hotel_room_result'] )) {
                      $this->load->view ( "room_detail" );				
			
		} else {
			$_SESSION ['bp_error_message'] = "Oops! Something went wrong. This page didn't load data. Please search again! (" . $result_array->HotelInfoResult->Error->ErrorMessage . ")";
			$_SESSION ['bp_error_class'] = "alert-warning";
			$this->load->view ( "bp_error" );
		}
	}

	public function book_room() {
		$id = url_decode ( $this->input->get ( "room_index" ) );
		$hotel_id = url_decode ( $this->input->get ( "hotel_id" ) );
		
		if (isset ( $_SESSION ['hotel'] ['array'] ['hotel_room_result'] )) {
			$room_details = $this->Hotel_Model->bp_room_details ($id);
			$hotel_details = $this->Hotel_Model->bp_hotel_details ($hotel_id);
		$data['room_details'] = $room_details;
		$data['hotel_details'] = $hotel_details;
		$_SESSION['Hotel_offline']['hotel_details'] = $hotel_details;
		$_SESSION['Hotel_offline']['room_details'] = $room_details;
		
			    $bp_user_id = $this->dsa_data->dsa_id;
				$getwayList = $this->Common_Model->get_table_result ( "*", array (
					"dsapayg_user_type" => "DSA",
					"dsapayg_user_id" => $bp_user_id,
					"dsapayg_b2b_b2c" => "B2c",
					"dsapayg_status" => "active" 
				), "dsa_payment_gateway" );
				$data ["getwayList"] = $getwayList;
				$this->load->view ( "hotel/hotel_passengers_detail",$data);
			
		} else {
			$_SESSION ['bp_error_message'] = "Oops! Something went wrong. This page didn't load data. Please search again!";
			$_SESSION ['bp_error_class'] = "alert-warning";
			$this->load->view ( "bp_error" );
		}						
	}

	public function save_bookingdata() {
		
		$bp_pax_request = $_SESSION ['hotel'] ['array'] ['search_request'] ['RoomGuests'];
		
			$_SESSION['payment_method']=$this->input->post ( 'payment_method' );
			$_SESSION['mobile']=$this->input->post ( 'mobile' );
			$_SESSION['email']=$this->input->post ( 'email' );
			if ($this->session->userdata('Userlogin') != NULL) {
				$customer_id = $this->session->userdata('Userlogin')['userData']->cust_id; 
			}else {
				$customer_id = 0;
			} 
              if($_SESSION ['Hotel']['No_Of_child'] != null ){
				  $no_of_child = $_SESSION ['Hotel']['No_Of_child'];
			  } else {
				  $no_of_child = 0;
			  }
			$bp_pax_info = array ();
			foreach ( $bp_pax_request as $bp_pax_key => $bp_pax_requests ) {
				for($i = 0; $i < $bp_pax_requests ['NoOfAdults']; $i ++) {
					$bp_pax_array ["Title"] = $this->input->post ( "title_adult_" . $bp_pax_key . "_" . $i );
					$bp_pax_array ["FirstName"] = $this->input->post ( "first_name_adult_" . $bp_pax_key . "_" . $i );
					$bp_pax_array ["MiddleName"] = null;
					$bp_pax_array ["LastName"] = $this->input->post ( "last_name_adult_" . $bp_pax_key . "_" . $i );
					$bp_pax_array ["Phoneno"] = $this->input->post ( "mobile" );
					$bp_pax_array ["Email"] = $this->input->post ( "email" );
					$bp_pax_array ["PaxType"] = "1";
					if ($i == 0) {
						$bp_pax_array ["LeadPassenger"] = true;
					} else {
						$bp_pax_array ["LeadPassenger"] = false;
					}
					$bp_pax_array ["PassportNo"] = null;
					$bp_pax_array ["PassportIssueDate"] = null;
					$bp_pax_array ["PassportExpDate"] = null;
					$bp_pax_info [$bp_pax_key] [] = $bp_pax_array;
					unset ( $bp_pax_array );
				}
				if ($bp_pax_requests ['NoOfChild'] > 0) {
					foreach ( $bp_pax_requests ['ChildAge'] as $bp_key_child => $bp_child_pax_data ) {
						$bp_pax_array ["Title"] = $this->input->post ( "title_child_" . $bp_pax_key . "_" . $bp_key_child );
						$bp_pax_array ["FirstName"] = $this->input->post ( "first_name_child_" . $bp_pax_key . "_" . $bp_key_child );
						$bp_pax_array ["MiddleName"] = null;
						$bp_pax_array ["LastName"] = $this->input->post ( "last_name_child_" . $bp_pax_key . "_" . $bp_key_child );
						$bp_pax_array ["Phoneno"] = $this->input->post ( "mobile" );
						$bp_pax_array ["Email"] = $this->input->post ( "email" );
						$bp_pax_array ["PaxType"] = "2";
						$bp_pax_array ["LeadPassenger"] = false;
						$bp_pax_array ["Age"] = $this->input->post ( "age_child_" . $bp_pax_key . "_" . $bp_key_child );
						$bp_pax_array ["PassportNo"] = null;
						$bp_pax_array ["PassportIssueDate"] = null;
						$bp_pax_array ["PassportExpDate"] = null;
						$bp_pax_info [$bp_pax_key] [] = $bp_pax_array;
						unset ( $bp_pax_array );
					}
				}
			}
			$booking_data = array (
					"hoffbo_dsa_id" => $this->dsa_data->dsa_id,
					"hoffbo_hotel_id" => $_SESSION ['hotel'] ['array'] ['hotel_detail'][0]->hofl_id,
					"hoffbo_room_id" => $_SESSION ['hotel'] ['amount'] ['room_detail'][0]->hoffr_id,
					"hoffbo_customer_id" => $customer_id,
					"hoffbo_end_date" => $_SESSION['Hotel_Offline'] ['array']['checkOut'],
					"hoffbo_start_date" => $_SESSION['Hotel_Offline'] ['array']['checkIn'],
					"hoffbo_max_adult" => $_SESSION ['Hotel']['No_Of_Adults'],
					"hoffbo_max_child" => $no_of_child,
					"hoffbo_status" => "pending",
					"hoffbo_basic_fare" => $_SESSION ['hotel'] ['amount'] ['base_fare'],
					"hoffbo_tax" => $_SESSION ['hotel'] ['amount'] ['tax'],
					"hoffbo_publish_fare" => $_SESSION ['hotel'] ['amount'] ['customer_fare'],
					"hoffbo_payable_amount" => $_SESSION ['hotel'] ['amount'] ['total_payable'],
					"hoffbo_paid_amount" => 0,
					"hoffbo_amount_status" => "Pending",
					"hoffbo_booked_by" =>"online"
			);

			$bp_booking_id = $this->Hotel_Model->insert_booking_offline ( $booking_data );
			
			$_SESSION ['booking_id'] =$bp_booking_id;
            // echo "<pre>";
			// print_r($bp_pax_info );
			// die;
			$_SESSION['Hotel']['Pax_info'] = $bp_pax_info;
				foreach( $bp_pax_info as $bp_room_key_p => $hotel_room_detail_loop ) {
				foreach( $hotel_room_detail_loop as $hotel_room_detail_loops ) {
					
					$bp_room_no = $bp_room_key_p + 1;
					$bp_pax_title = $hotel_room_detail_loops ['Title'];
					$bp_pax_first_name = $hotel_room_detail_loops ['FirstName'];
					$bp_pax_last_name = $hotel_room_detail_loops ['LastName'];
					$bp_pax_mobile = $hotel_room_detail_loops ['Phoneno'];
					$bp_pax_email = $hotel_room_detail_loops ['Email'];
					if ($hotel_room_detail_loops ['PaxType'] == "1") {
						$bp_pax_type = "Adult";
						$bp_pax_age = "";
					} else {
						$bp_pax_type = "Child";
						$bp_pax_age = $hotel_room_detail_loops ['Age'];
					}
					$pax_data = array (
							"hotbopax_booking_id" => $bp_booking_id,
							"hotbopax_room" => $bp_room_no,
							"hotbopax_title" => $bp_pax_title,
							"hotbopax_first_name" => $bp_pax_first_name,
							"hotbopax_last_name" => $bp_pax_last_name,
							"hotbopax_type" => $bp_pax_type,
							"hotbopax_age" => $bp_pax_age,
							"hotbopax_mobile" => $bp_pax_mobile,
							"hotbopax_email" => $bp_pax_email 
					);
					$this->Hotel_Model->insert_pax_offline ( $pax_data );
				}
				}
			
			if($bp_booking_id != "" || $bp_booking_id != 0){
				$_SESSION['hotel_booking_type'] = "extranet";
			redirect ( "hotel/payment_request" );
		} else {
			$_SESSION ['bp_error_message'] = "Oops! Something went wrong. This page didn't load data. Please search again! ";
			$_SESSION ['bp_error_class'] = "alert-warning";
			$this->load->view ( "bp_error" );
		}
	}

	public function book_result() {
		$booking_id = $_SESSION ['booking_id'];
		$data['hotel_id'] = $this->Hotel_Model->get_hotel_by_booking_id($booking_id);
		$hotel_id = $data['hotel_id']->hoffbo_hotel_id;
		
		$hotel_details = $this->Hotel_Model->get_hotel_by_hotelid($hotel_id);
		$data['hotel_details'] = $hotel_details;
		$this->load->view ( "booking_result", $data );
	}
	
	//TICKET BOOKING DETAIL FOR CUSTOMER AS A GUEST

	public function print_eticket()
	{
		if ($this->input->server ( 'REQUEST_METHOD' ) == "POST")
		{
		$ticket_pnr = $this->input->post ( 'ticket_pnr' );
		$emailid = $this->input->post ( 'cust_email' );
		$BookingDetails = $this->Hotel_Model->get_booking_by_booking_id ( $ticket_pnr,$emailid );
		if ($BookingDetails == '') {
			$this->session->set_flashdata ( 'alert_register', array ( 'message' => 'PNR No or Email ID is wrong',
			'class' => 'alert-danger'
			));
			redirect('hotel/print_eticket');
		}
		else {
		redirect ( "hotel/print_ticket?ref_id=" . url_encode ($BookingDetails->hotboli_id ) );
		}
		}
		$this->load->view("hotel/print_eticket");
	}	
	
	//GET COUPON
	public function Getcoupon(){
		$roomResult  = json_decode($_SESSION ['hotel'] ['json'] ['hotel_room_result'],true);
		$guestData = $_SESSION ['hotel'] ['array'] ['search_request'] ['RoomGuests'];
		$total_pax = 0;
		foreach($guestData as $item){
			$guest = (int)$item['NoOfAdults'] + (int)$item['NoOfChild'] ;
			$total_pax = $total_pax + $guest;
		}
		$amountData = $_SESSION ['hotel'] ['amount'];
		$customer_amount = $amountData['customer_fare'] + $amountData['final_con'];

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
        // GET Coupon Detials
		$where = array(
			"coupon_code" => $_POST["coupon"],
			"coupon_status" => "active",
			"coupon_user_id" => $dsa_id,
			"coupon_user_type" => $das_type,
		);
		$coupon_user_provide = $this->Hotel_Model->get_coupon_data("*", $where, "coupon");		
		if ($coupon_user_provide != "0") {
			if ($_SESSION['copont_applied'] == FALSE && $coupon_user_provide->coupon_use_limit != 0 && $coupon_user_provide->coupon_start_date <= date("d/m/Y") && date("d/m/Y") <= $coupon_user_provide->coupon_end_date) {
                if ($coupon_user_provide->coupon_amount_type == "fixed") {
                	$amount_coupon = $coupon_user_provide->coupon_amount;
                }
                if ($coupon_user_provide->coupon_amount_type == "percent") {
                	$amount_coupon = (($customer_amount * $coupon_user_provide->coupon_amount) / 100);
				}
				$db_amount = $amount_coupon;
				$amount_coupon = convertPrice($amount_coupon,"INR",$amountData['currency']);
				
				$new_amount = $customer_amount - $amount_coupon;
                // update coupon limit
                $up_coupon = $this->Hotel_Model->updateCouponLimit($coupon_user_provide->coupon_id, $coupon_user_provide->coupon_use_limit - 1);
				$final_fare = $new_amount;
				//after discount
                // if($getwayList->dsapayg_type=="fix") {
                // 	$retu = 2;
                // 	$total_con_fee = round($getwayList->dsapayg_convenience_fee*$total_pax*$retu);
                // 	$final_fare = $total_con_fee + $new_amount;
                // } else {
                // 	$total_con_fee =  round(( $new_amount * $getwayList->dsapayg_convenience_fee)/100);
                // 	$final_fare = $total_con_fee + $new_amount;
                // }

                //insert into flight coupon table
                $data_coupon_fight = array(
                	"coupon_code" => $_POST["coupon"],
                	"dsa_id" => $dsa_id,
                	"discount_type" => $coupon_user_provide->coupon_amount_type,
                	"total_amount" => $customer_amount,
                	"discount_amount" => $amount_coupon,
                	'discount' => $new_amount,
				);
				
				$this->Hotel_Model->hotelCoupon($data_coupon_fight);

				$_SESSION['coupon_applied'] = true;
				$_SESSION['coupon_amount'] = $amount_coupon;
                
               // $data["amount"] = round($new_amount);
                $data["total_con_fee"] = $total_con_fee;
                $data["amount"] = round($final_fare);
                $data["status"] = "success";
                $data["discount_amount"] = round($amount_coupon);
                $data["message"] = "Coupon has been Successfully Applied !";
				
            } else {
			
            	$coupon_expire = "true";
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
	
}
