<?php



class Holiday extends MX_Controller {



    function __construct() {

        parent::__construct();

        $this->load->Model('HolidayModel');

        $this->load->Model('Common_Model');

		//$this->load->Model('user/UserModel');

        $this->load->helper('common_helper');







        $this->load->helper(array('text','form', 'url'));

        $this->load->library('form_validation');



        $this->load->library(array('session'));



        $this->load->helper('url');



    }



    public function index() {



       unset ( $_SESSION ['holiday'] );

		//redirect ( "" );



       $sliderimg = $this->HolidayModel->get_slider_img("slider_image");

       $data["sliderimg"] = $sliderimg;



       $category1 = $this->HolidayModel->get_category("3");

       $category2 = $this->HolidayModel->get_category("2");

       $getkeyword = $this->HolidayModel->get_keyword();

       $keywordarray = array();

       $masterkey = array();

       $singlearray = array();

       foreach($getkeyword as $key=> $value){

        if($value->search_keyword){

            $keywordarray = explode(",",$value->search_keyword);

            $masterkey = array_filter($keywordarray, 'strlen');

            foreach($masterkey as $keyword){

                $singlearray[] = ($keyword);

            }



        }



    }









    $package1 = $this->HolidayModel->get_packages_by_category_id("3");
    
    $package2 = $this->HolidayModel->get_packages_by_category_id("2");

    $data['category1'] = $category1;

    $data['category2'] = $category2;

    $data['package1'] = $package1;

    $data['package2'] = $package2;

    $data['keyword'] = json_encode(array_unique($singlearray));

    $blogs = $this->HolidayModel->get_blog_list("blog_list");
        $data["blogs"] = $blogs;

    $this->load->view("holiday/index", $data);

}









function ajax_booking_query() {

    $RequestMethod = $this->input->server('REQUEST_METHOD');

    if ($RequestMethod == "POST") {

        $inputCaptcha = $this->input->post('Ccaptcha');

        $sessCaptcha = $this->session->userdata('captchaCode');

        if($inputCaptcha === $sessCaptcha){

            if ($this->session->userdata ( 'Userlogin' ) != NULL) {

               $cusid = $this->session->userdata ( 'Userlogin' ) ['userData']->cust_id;

            } else {

              $cusid = 0;

            }

            $data1 = array(

                'com_name' => $this->input->post('custFirstName')." ".$this->input->post('custLastName'),

                'com_email' => $this->security->xss_clean($this->input->post('custEmail')),

                'com_mobile' => $this->input->post('custMobleNo'), 

                'com_query_type' => 'package',

                'com_departure_date'=>$this->input->post('cDate'),

                'com_member'=>$this->input->post('cMember'),

                'com_reff'   => $this->input->post('tour_ID'), 

                "com_user_id" => $this->dsa_data->dsa_id,

                "com_user_type" => "DSA",

                "com_cust_id" => $cusid,

            );



            $inserted = $this->HolidayModel->register_query($data1);



            if ($inserted) {

                $data ['result'] = $this->HolidayModel->get_query_table ( "*", "com_id", $inserted, "common_queries" );											

                $mail_id ="info@smarttripmaker.com";

                $sender_subject ="Package Query";

                $message = $this->load->view ( 'holiday/holiday_email', $data, TRUE );	

                $ch = email_send ( $mail_id, $sender_subject, $message );

                $data["status"] = "success";

                $data["message"] = "Your booking query submitted !";

            } else {

                $data["status"] = "error";

                $data["message"] = "Someting Wrong please try again!";

            }

        } else {

            $data["status"] = "error";

            $data["message"] = "Captcha code does not match, please try again.";

        }

        echo json_encode($data);

    }

}





function query() {

    $RequestMethod = $this->input->server('REQUEST_METHOD');

    if ($RequestMethod == "POST") {



        $data1 = array(



            'hq_origin' => $this->input->post('from_location'),

            'hq_destination' => $this->security->xss_clean($this->input->post('to_location')),

            'hq_date' => $this->input->post('depart_date'), 

            'hq_person' =>  $this->input->post('no_pax'), 

            'hq_email_id'   => $this->input->post('email'), 

            "hq_mobile_no" => $this->input->post('mobile'), 

            "hq_dsa_id" => $this->dsa_data->dsa_id,

            "hq_module" => "B2C",



        );

        $inserted = $this->HolidayModel->holiday_query($data1);

        $this->session->set_flashdata ( "alert", array (

            "message" => "Query Added Successfully",

            "class" => "alert-success"

        ));         

        redirect ( "holiday" );    



    }

}   









public function holidaydetail($slug = Null) {



        //print_r($slug);

        //die;

    $refid = url_decode($this->input->get("ref_id"));

    if ($slug != NULL) {

        $bookingdetail = $this->HolidayModel->get_bookingdetail($slug);



        if(!empty($bookingdetail)){

            $data["bookingdetail"] = $bookingdetail;

            $holiday_hotels_selcted = explode(",",$bookingdetail->holiday_hotel);



            for($i=0; $i<count($holiday_hotels_selcted); $i++)

            {

                $hotel_namet[]= $this->HolidayModel->getHotelNameByid($holiday_hotels_selcted[$i]);



            }



            $data["hotel_names"]=$hotel_namet;



            $bookingimg = $this->HolidayModel->get_bookingimages($bookingdetail->holiday_id);

            $data["Bimages"] = $bookingimg;

            $Bitinerary = $this->HolidayModel->get_bitinerary($bookingdetail->holiday_id);

            $data['Bitinerary'] = $Bitinerary;

            $inclusionid = explode(",", $bookingdetail->holiday_inclusion);

            $Binclusion = $this->HolidayModel->get_inclusion($inclusionid);

            $data['Binclusion'] = $Binclusion;

            $exclusionid = explode(",", $bookingdetail->holiday_exclusion);

            $Bexclusion = $this->HolidayModel->get_exclusion($exclusionid);

            $data['Bexclusion'] = $Bexclusion;

            $Breletedpachage = $this->HolidayModel->get_releted_packeges($bookingdetail->holiday_category_id);

            $data['Breletedpachage'] = $Breletedpachage;

        }else{

          $data["bookingdetail"] = "not";

      }

  } else {



    redirect("/");

}

        // explode($delimiter, $string)

       // PrintArray($data);

       // die;

$this->load->helper('captcha');

$config = array(

    'img_path'      => 'captcha_images/',

    'img_url'       => base_url().'captcha_images/',

    'font_path'     => 'system/fonts/texb.ttf',

    'img_width'     => '150',

    'img_height'    => 50,

    'word_length'   => 5,

    'font_size'     => 22,

    'pool'         => '0123456789',

            // 'colors'        => array(

                // 'background' => array(255, 255, 255),

                // 'border' => array(255, 255, 255),

                // 'text' => array(0, 0, 0),

                // 'grid' => array(255, 40, 40)

            // )

);

$captcha = create_captcha($config);



        // Unset previous captcha and set new captcha word

$this->session->unset_userdata('captchaCode');

$this->session->set_userdata('captchaCode', $captcha['word']);



        // Pass captcha image to view

$data['captchaImg'] = $captcha['image'];



$this->load->view("holiday/holidaydetail", $data);

}



public function holiday_list() {







    $RequestMethod = $this->input->server('REQUEST_METHOD');

    if ($RequestMethod == "GET") {

        $getkeyword = $this->HolidayModel->get_keyword();

        $keywordarray = array();

        $masterkey = array();

        $singlearray = array();

        foreach($getkeyword as $key=> $value){

            if($value->search_keyword){

                $keywordarray = explode(",",$value->search_keyword);

                $masterkey = array_filter($keywordarray, 'strlen');

                foreach($masterkey as $keyword){

                    $singlearray[] = $keyword;

                }



            }

        }

        $data['keyword'] = json_encode(array_unique($singlearray));

        $location = $this->input->get("location");

        $tour_catid = $this->input->get("tour_type");

        $adultno = $this->input->get("guest_no");

        $keyword = $this->input->get("keyword");

        $sub_category = $this->HolidayModel->get_sub_category($tour_catid);

        $data['sub_category'] = $sub_category;



        $extrawhere = array();

        $catcon = array("search_keyword LIKE" => '%' . $keyword . '%');

        if (empty($location)) {

            $loccon = array();

        } else {

            $loccon = array("holiday_location LIKE" => '%' . $location . '%');

        }



        $catedata = array();

        $array = array(

            "holiday_user_id" => $this->dsa_data->dsa_id,

            "holiday_user_type" => "DSA",

            "holiday_language" => $this->default_lang,

        );

        $extrawhere = array_merge($catcon, $loccon, $extrawhere);

            //print_r($array);

            // die;

        $table = "holiday";

        $where_1_name = "holiday_status";

        $where_1_value = "active";

        $order_by = "holiday_id";

        $bp_template_name = "holidayList";

        if ($this->uri->segment(3)) {

            $page = $this->uri->segment(3);

        } else {

            $page = 0;

        }

        $this->db->where($extrawhere);

        $this->db->where($where_1_name, $where_1_value);

        $total_row = $this->db->from($table)->count_all_results();

        $pagination_segment = 3;

        $per_page = 5;

        $pagination_url = base_url() . $this->uri->segment("1") . "/" . $this->uri->segment("2");

        $config = bp_pagination($pagination_url, 0, $total_row, $per_page);

        $this->pagination->initialize($config);

        $result = $this->Common_Model->pagination_table($config ["per_page"], $page, $where_1_name, $where_1_value, $order_by, $table, $extrawhere);





        $data ['result'] = $result;



        $data ['total_result'] = $total_row;





            // $data ['Category_name'] = $catedata;

             // PrintArray($result);

           //  die;

        $this->load->view("holiday/" . $bp_template_name, $data);

    }



        // $this->load->view("holiday/holidayList");

}



public function all_tour() {



        //$bp_model_name = $this->model_name;

    $table = "holiday";

    $where_1_name = "holiday_status";

    $where_1_value = "active";

    $order_by = "holiday_id";

    $bp_template_name = "alltour";

    if ($this->uri->segment(3)) {

        $page = $this->uri->segment(3);

    } else {

        $page = 0;

    }

    $this->db->where($where_1_name, $where_1_value);

    $total_row = $this->db->from($table)->count_all_results();

    $pagination_segment = 3;

    $per_page = 20;

    $pagination_url = base_url() . $this->uri->segment("1") . "/" . $this->uri->segment("2");

    $config = bp_pagination($pagination_url, 0, $total_row, $per_page);

    $this->pagination->initialize($config);

    $result = $this->Common_Model->pagination_table($config ["per_page"], $page, $where_1_name, $where_1_value, $order_by, $table);

    $data ['result'] = $result;



        // PrintArray($data);

        // die;

    $this->load->view($this->uri->segment("1") . "/" . $bp_template_name, $data);

}



public function contactus() {



    $this->load->view("holiday/contactus");

}





public function bookingdetail() {

	

  $dsa_id=$this->dsa_data->dsa_id; 

  $das_type= $this->dsa_setting->dsaset_user_type;



  $refid = $this->input->get("tour_ID");

  if($this->input->get("adult_no") < 1){



    echo "please select min 1 adult traveller.";

    return false;

}else{

    if ($refid != NULL) {



        $bookingdetail = $this->HolidayModel->get_bookingdetail_by_id($refid);

        $holiday_extra = $this->HolidayModel->getHolidayExtra( $dsa_id,$das_type,$refid);

        $data["holiday_extra"] = $holiday_extra;

        $data["bookingdetail"] = $bookingdetail;



    } else {



        redirect("/");

    }



    $this->load->view("holiday/bookingdetail", $data);

}



}





public function tour_passenger_details() {



    $refid = $this->input->get("tour_ID");

    if($this->input->get("adult_no") < 1){



        echo "please select min 1 adult traveller.";

        return false;

    }else{

        if ($refid != NULL) {











            $bookingdetail = $this->HolidayModel->get_bookingdetail_by_id($refid);

            $data["bookingdetail"] = $bookingdetail;

            $bookingimg = $this->HolidayModel->get_bookingimages($refid);

            $data["Bimages"] = $bookingimg;

            $Bitinerary = $this->HolidayModel->get_bitinerary($refid);

            $data['Bitinerary'] = $Bitinerary;

            $inclusionid = explode(",", $bookingdetail->holiday_inclusion);

            $Binclusion = $this->HolidayModel->get_inclusion($inclusionid);

            $data['Binclusion'] = $Binclusion;

            $exclusionid = explode(",", $bookingdetail->holiday_exclusion);

            $Bexclusion = $this->HolidayModel->get_exclusion($exclusionid);

            $data['Bexclusion'] = $Bexclusion;

            $Breletedpachage = $this->HolidayModel->get_releted_packeges($bookingdetail->holiday_category_id);

            $data['Breletedpachage'] = $Breletedpachage;

            $allcountry = $this->HolidayModel->get_countries();

            $data["allcountry"] = $allcountry;



        } else {



            redirect("/");

        }



        $this->load->view("holiday/tourpassengerdetails", $data);

    }

}





public function dashboard() {



    $this->load->view("holiday/dashboard");

}



public function category($cateid = NULL) {





        // print_r($cateid);

        // die;

    $extrawhere = array();

    $catedata = array();

    if ($this->uri->segment(1) == "cat") {



        $extrawhere = array("FIND_IN_SET(" . $cateid . ",holiday_category_id) >" => 0,

            "holiday_user_id" => $this->dsa_data->dsa_id,

            "holiday_user_type" => "DSA",

            "holiday_language" => $this->default_lang,);

        $catedata = $this->HolidayModel->get_category_by_id($cateid);

    } else if ($this->uri->segment(1) == "subcat") {



        $extrawhere = array("FIND_IN_SET(" . $cateid . ",holiday_sub_category_id) >" => 0,

            "holiday_user_id" => $this->dsa_data->dsa_id,

            "holiday_user_type" => "DSA",

            "holiday_language" => $this->default_lang,);

        $catedata = $this->HolidayModel->get_sub_category_by_id($cateid);

    }



    $table = "holiday";

    $where_1_name = "holiday_status";

    $where_1_value = "active";

    $order_by = "holiday_id";

    $bp_template_name = "category_tour";

    if ($this->uri->segment(3)) {

        $page = $this->uri->segment(3);

    } else {

        $page = 0;

    }

    $this->db->where($extrawhere);

    $this->db->where($where_1_name, $where_1_value);

    $total_row = $this->db->from($table)->count_all_results();

    $pagination_segment = 3;

    $per_page = 50;

    $pagination_url = base_url() . $this->uri->segment("1") . "/" . $this->uri->segment("2");

    $config = bp_pagination($pagination_url, 0, $total_row, $per_page);

    $this->pagination->initialize($config);

    $result = $this->Common_Model->pagination_table($config ["per_page"], $page, $where_1_name, $where_1_value, $order_by, $table, $extrawhere);





    $data ['result'] = $result;

    $data ['Category_name'] = $catedata;



        // PrintArray($catedata);

        // die;

    $this->load->view("holiday/" . $bp_template_name, $data);

}



public function get_location() {

    $RequestMethod = $this->input->server('REQUEST_METHOD');

    if ($RequestMethod == "GET") {

        $term = $this->input->get("term");

        $where = $term;



        $result = $this->HolidayModel->get_all_location_json($where);



        echo json_encode($result);

    }

}



public function add_to_cart() {



    $RequestMethod = $this->input->server('REQUEST_METHOD');

    if ($RequestMethod == "POST") {







        $refid = $this->input->post("BookingID");



        $bookingdetail = $this->HolidayModel->get_bookingdetail_by_id($refid);

        $data["bookingdetail"] = $bookingdetail;



        $totalpax = 0;

        $adult = 0;

        $child = 0;

        $infant = 0;

        $totalprice = 0;

        if ($this->input->post("start_date") != NULL) {

            $strdate = $this->input->post("start_date");

        } else {



            $strdate = "";

        }

        if ($this->input->post("adult_no") != NULL) {



            $totalpax = $totalpax + $this->input->post("adult_no");

            $adult = $this->input->post("adult_no");

            $adultprice = $bookingdetail->holiday_start_price * $adult;

        }

        if ($this->input->post("child_no") != NULL) {



            $totalpax = $totalpax + $this->input->post("child_no");

            $child = $this->input->post("child_no");

            $childprice = $bookingdetail->holiday_start_price * $child;

        }

        if ($this->input->post("infant_no") != NULL) {



            $totalpax = $totalpax + $this->input->post("infant_no");

            $infant = $this->input->post("infant_no");

            $infantprice = $bookingdetail->holiday_start_price * $infant;

        }



        $Extra_data = explode(",",$this->input->post("extra")) ;



        $totalprice =  $adultprice + $childprice +  $infantprice ;



        if($Extra_data[0] != NULL ) {



           for($i=0 ; $i<count($Extra_data); $i++){



            $extra["extra"]= $this->HolidayModel->getHolidayExtraByid( $Extra_data[$i] )  ;

            $totalprice+= $extra["extra"][0]->holextra_price ;  

        }

        

    }      



    $hotel_name= $this->HolidayModel->getHotelNameByid($this->input->post("hotel_name"));



    $bookingData = array(

                //'Fld_RefrenceId' => $ref_id,

        'holbook_user_id' => $this->dsa_data->dsa_id,

        'holbook_user_type' => "DSA",

        'holbook_tour_id' => $this->input->post("BookingID"),

        'holbook_total_pax' => $totalpax,

        'holbook_adult' => $adult,

        'holbook_child' => $child,

        'holbook_infant' => $infant,

        'holbook_contact_person_name' => $this->input->post("adult")["1"]["first_name_adult"] . ' ' . $this->input->post("adult")["1"]["last_name_adult"],

        'holbook_contact_phone' => $this->input->post("contact_mobile"),

        'holbook_contact_email' => $this->input->post("contact_email"),

        'holbook_remark' => "",

        'holbook_booking_status' => "Pending",

        'holbook_payment_status' => "Pending",

        'holbook_tour_extra' => $this->input->post("extra"),

        'holbook_tour_hotel' => $hotel_name->holhot_name, 

        'holbook_amount' => $totalprice,

        'holbook_currency_symbol' => $this->dsa_data->dsa_country_code,

        'holbook_currency' => $this->dsa_data->dsa_currency,

        'holbook_adult_price' => $adultprice,

        'holbook_child_price' => $childprice,

        'holbook_infant_price' => $infantprice,

        'holbook_discount' => "",

        'holbook_coupon_use_id' => "",

                'holbook_customer_id' =>0, //$this->session->userdata('Userlogin')["id"],

                'holbook_tour_start_date' => $strdate,

                'holbook_pickup_point' =>  $this->input->post("pickup_location")

            );



	    	//	echo "<pre>";

		  // print_r($bookingData);



		  // die;



    $bookingid = $this->HolidayModel->insert_booking($bookingData);



    if ($bookingid) {

        $data = array("holbook_ref_id" => $this->dsa_data->dsa_booking_prefix . '-' . $bookingid);

        $this->HolidayModel->update_booking($bookingid, $data);



        for ($ad = 1; $ad <= $adult; $ad++) {



            $bookingPaxDetails = array(

                'holpax_booking_id' => $bookingid,

                'holpax_type' => "adult",

                'holpax_title' => $this->input->post("adult")[$ad]["title_adult"],

                'holpax_first_name' => $this->input->post("adult")[$ad]["first_name_adult"],

                'holpax_last_name' => $this->input->post("adult")[$ad]["last_name_adult"],

                'holpax_gender' => $this->input->post("adult")[$ad]["gender_adult"],

                'holpax_dob' => $this->input->post("adult")[$ad]["date_of_birth_adult"],

                'holpax_passport_number' => $this->input->post("adult")[$ad]["passport_no_adult"],

                'holpax_passport_issue_country' => $this->input->post("adult")[$ad]["pass_issue_country_adult"],

                'holpax_passport_expiry' => $this->input->post("adult")[$ad]["pass_expire_adult"],

                'holpax_user_type' => "DSA",

                'holpax_user_id' => $this->dsa_data->dsa_id,

            );



            $this->HolidayModel->insert_booking_pax_details($bookingPaxDetails);

        }

        for ($chi = 1; $chi <= $child; $chi++) {



            $bookingPaxDetailschild = array(

                'holpax_booking_id' => $bookingid,

                'holpax_type' => "child",

                'holpax_title' => $this->input->post("child")[$chi]["title_child"],

                'holpax_first_name' => $this->input->post("child")[$chi]["first_name_child"],

                'holpax_last_name' => $this->input->post("child")[$chi]["last_name_child"],

                'holpax_gender' => $this->input->post("child")[$chi]["gender_child"],

                'holpax_dob' => $this->input->post("child")[$chi]["date_of_birth_child"],

                'holpax_passport_number' => $this->input->post("child")[$chi]["passport_no_child"],

                'holpax_passport_issue_country' => $this->input->post("child")[$chi]["pass_issue_country_child"],

                'holpax_passport_expiry' => $this->input->post("child")[$chi]["pass_expire_child"],

                'holpax_user_type' => "DSA",

                'holpax_user_id' => $this->dsa_data->dsa_id,

            );



            $this->HolidayModel->insert_booking_pax_details($bookingPaxDetailschild);

        }



        for ($inf = 1; $inf <= $infant; $inf++) {



            $bookingPaxDetailschild = array(

                'holpax_booking_id' => $bookingid,

                'holpax_type' => "infant",

                'holpax_title' => "",

                'holpax_first_name' => $this->input->post("infant")[$inf]["first_name_infant"],

                'holpax_last_name' => $this->input->post("infant")[$inf]["last_name_infant"],

                'holpax_gender' => $this->input->post("infant")[$inf]["gender_infant"],

                'holpax_dob' => $this->input->post("infant")[$inf]["date_of_birth_infant"],

                'holpax_passport_number' => $this->input->post("infant")[$inf]["passport_no_infant"],

                'holpax_passport_issue_country' => $this->input->post("infant")[$inf]["pass_issue_country_infant"],

                'holpax_passport_expiry' => $this->input->post("infant")[$inf]["pass_expire_date_infant"],

                'holpax_user_type' => "DSA",

                'holpax_user_id' => $this->dsa_data->dsa_id,

            );



            $this->HolidayModel->insert_booking_pax_details($bookingPaxDetailschild);

        }



        $tours = array();

        $new_tours = array(

            array(

                'tour_id' => $bookingdetail->holiday_id,

                'tour_title' => $bookingdetail->holiday_name,

                'tour_location' => "",

                'tour_start_date' => $strdate,

                'tour_adult_no' => $adult,

                'tour_child_no' => $child,

                'tour_infant_no' => $infant,

                'tour_price' => $bookingdetail->holiday_start_price,

                'tour_hotel' => $hotel_name->holhot_name,

                'tour_total_price' => $totalprice,

                "booking_id" =>$bookingid

            )

        );

              //  echo "<pre>";

              //  print_r($bookingdetail);

			//	print_r($new_tours);

			//	die;





        if (isset($_SESSION ["Tours_Cart"])) {

            $found = false;

            foreach ($_SESSION ["Tours_Cart"] as $cart_itm) {



                if ($cart_itm ["tour_id"] == $bookingdetail->holiday_id) {

                    $tours [] = array(

                        'tour_id' => $bookingdetail->holiday_id,

                        'tour_title' => $bookingdetail->holiday_name,

                        'tour_location' => "",

                        'tour_start_date' => $strdate,

                        'tour_adult_no' => $adult,

                        'tour_child_no' => $child,

                        'tour_infant_no' => $infant,

                        'tour_price' => $bookingdetail->holiday_start_price,

                        'tour_hotel' => $hotel_name->holhot_name,

                        'tour_total_price' => $totalprice,

                        "booking_id" =>$bookingid

                    );

                    $found = true;

                } else {

                    $tours [] = array(

                        'tour_id' => $cart_itm["tour_id"],

                        'tour_title' => $cart_itm["totour_titleur_id"],

                        'tour_location' => "",

                        'tour_start_date' => $cart_itm["tour_start_date"],

                        'tour_adult_no' => $cart_itm["tour_adult_no"],

                        'tour_child_no' => $cart_itm["toutour_child_nor_id"],

                        'tour_infant_no' => $cart_itm["tour_infant_no"],

                        'tour_price' => $cart_itm["tour_price"],

                        'tour_hotel' => $cart_itm["tour_hotel"],

                        'tour_total_price' => $cart_itm["tour_total_price"],

                        "booking_id" =>$cart_itm["booking_id"]

                    );

                }

            }





            if ($found == false) {

                $_SESSION ["Tours_Cart"] = array_merge($tours, $new_tours);

            } else {

                $_SESSION ["Tours_Cart"] = $tours;

            }

        } else {

            $_SESSION ["Tours_Cart"] = $new_tours;

        }



        redirect("holiday/cart");

    }





}





}



public function cart() {



  $dsa_id=$this->dsa_data->dsa_id; 

  $das_type= $this->dsa_setting->dsaset_user_type;  

  $payment_method = $this->HolidayModel->getPaymentMethod( $dsa_id,$das_type);



  $carttotal = 0;



  if(!empty($_SESSION["Tours_Cart"])){  



    foreach ($_SESSION["Tours_Cart"] as $key => $cartdata){



        $bbokingdata[$key]["tourdetail"] = $this->HolidayModel->get_bookingdetail_by_id($cartdata["tour_id"]);

        $bbokingdata[$key]["cart_detail"] =  $cartdata;

        $bbokingdata[$key]["bookingdetail"] = $this->HolidayModel->get_booking_by_id($cartdata["booking_id"]);

        $Extra_data= explode(",",$bbokingdata[$key]["bookingdetail"]->holbook_tour_extra);



        for($i=0 ; $i<count($Extra_data); $i++){

            $bbokingdata[$key]["extra"][$i]= $this->HolidayModel->getHolidayExtraByid( $Extra_data[$i] )  ;

        }

        $bbokingdata[$key]["bookingPax"] = $this->HolidayModel->get_pax_id($cartdata["booking_id"]);



        $carttotal1 = $carttotal + $cartdata["tour_total_price"];



        if(isset($_COOKIE["selected_currency"])) {

            $data_set=explode(",",$_COOKIE["selected_currency"]);

            $carttotal =(float)$data_set[9]*$carttotal1 ;	

        }



        else{

           $carttotal ; 

       }







   }



}



else{

 $bbokingdata = array(); 

}



if (($this->session->userdata('Userlogin') != NULL)) {

    if(!empty($_SESSION["Tours_Cart"])){  

        foreach ($_SESSION["Tours_Cart"] as $key => $cartdata){

            $this->HolidayModel->updateBookingcart($cartdata["booking_id"],$this->session->userdata('Userlogin')["id"]);



        }

    }



}

$data["payment_method"] =  $payment_method;

$data["result"] =  $bbokingdata;

$data["carttotalPrice"] = $carttotal;

$this->load->view("holiday/cart",$data);



}





public function remove_from_cart() {

    $tour_id = $this->input->get('tour_id');

    if (isset($_SESSION ["Tours_Cart"])) {

        foreach ($_SESSION ["Tours_Cart"] as $cart_itm) {



            if ($cart_itm ["tour_id"] != $tour_id) {

                $tours [] = array(

                    'tour_id' => $cart_itm["tour_id"],

                    'tour_title' => $cart_itm["totour_titleur_id"],

                    'tour_location' => "",

                    'tour_start_date' => $cart_itm["tour_start_date"],

                    'tour_adult_no' => $cart_itm["tour_adult_no"],

                    'tour_child_no' => $cart_itm["toutour_child_nor_id"],

                    'tour_infant_no' => $cart_itm["tour_infant_no"],

                    'tour_price' => $cart_itm["tour_price"],

                    'tour_total_price' => $cart_itm["tour_total_price"],

                    "booking_id" =>$cart_itm["booking_id"]

                );



            } 

        }

        if (isset($tours)) {

            $_SESSION ["Tours_Cart"] = $tours;



        } else {



            unset($_SESSION ["Tours_Cart"]);

        }

    }

    redirect("holiday/cart");

}



public function payment_request(){

    $paymentstatus = "success";

    if($paymentstatus == "success"){



           // $this->HolidayModel->update_holibooking();

       $this->load->view("card_detail"); 





   }else{

    $this->load->view("payment_request"); 

}



}          



public function booking_confirm(){

    if (isset($_SESSION ["Tours_Cart"])) {

        foreach ($_SESSION ["Tours_Cart"] as $cart_itm) {



            $where = array("holbook_booking_status" => "Success");

            $updated =  $this->HolidayModel->update_booking($cart_itm["booking_id"],$where); 



        }

    }



    redirect("holiday/booking_success");



    PrintArray($_SESSION["Tours_Cart"]);

    die;

        //$this->HolidayModel->update_status();



}



public function booking_success(){



   if(!empty($_SESSION["Tours_Cart"])){



    foreach ($_SESSION["Tours_Cart"] as $key => $cartdata){



        $bbokingdata[$key]["tourdetail"] = $this->HolidayModel->get_bookingdetail_by_id($cartdata["tour_id"]);

        $bbokingdata[$key]["cart_detail"] =  $cartdata;



        $bbokingdata[$key]["bookingdetail"] = $this->HolidayModel->get_booking_by_id($cartdata["booking_id"]);



        $Extra_data= explode(",",$bbokingdata[$key]["bookingdetail"]->holbook_tour_extra);



        for($i=0 ; $i<count($Extra_data); $i++){

           $bbokingdata[$key]["extra"][$i]= $this->HolidayModel->getHolidayExtraByid( $Extra_data[$i] )  ;

       }





       $bbokingdata[$key]["bookingPax"] = $this->HolidayModel->get_pax_id($cartdata["booking_id"]);

            // $carttotal = $carttotal + $cartdata["tour_total_price"];

   }

}else{

 $bbokingdata = array();

 redirect("/");

}

$data["result"] =  $bbokingdata;

$this->load->view("holiday/booking_success",$data);  

}



public function card_details()

{

   $RequestMethod = $this->input->server('REQUEST_METHOD');

   if ($RequestMethod == "POST")

   {



    foreach ($_SESSION ["Tours_Cart"] as $cart_itm) {

     $cardData = array(

        'crecard_user_id' => $this->dsa_data->dsa_id,

        'crecard_user_type' => "DSA",

        'crecard_status' => "Active",

        'crecard_card_type' => $this->input->post("crecard_card_type"),   

        'crecard_booking_id' => $cart_itm["booking_id"],

        'crecard_first_name' => $this->input->post("crecard_first_name"),

        'crecard_last_name' => $this->input->post("crecard_last_name"),

        'crecard_card_name' => $this->input->post("crecard_card_name"),

        'crecard_card_number' => $this->input->post("crecard_card_number"),

        'crecard_expiry' => $this->input->post("crecard_expiry_month").'/'.$this->input->post("crecard_expiry_year"),

        'crecard_customer_id' =>$this->session->userdata('Userlogin')["id"],

        'crecard_cvv' => $this->input->post("crecard_cvv")        

    );

     $cardid = $this->HolidayModel->insert_card($cardData);

 }

                    // print_r($cardData);

                    // $cardid = $this->HolidayModel->insert_card($cardData);



 if($cardid)

 {  



   redirect("holiday/booking_confirm"); 

}





}





}



public function print_ticket(){



  if(!empty($_SESSION["Tours_Cart"])){



    foreach ($_SESSION["Tours_Cart"] as $key => $cartdata){



        $bbokingdata[$key]["tourdetail"] = $this->HolidayModel->get_bookingdetail_by_id($cartdata["tour_id"]);

        $bbokingdata[$key]["cart_detail"] =  $cartdata;



        $bbokingdata[$key]["bookingdetail"] = $this->HolidayModel->get_booking_by_id($cartdata["booking_id"]);

        $Extra_data= explode(",",$bbokingdata[$key]["bookingdetail"]->holbook_tour_extra);



        for($i=0 ; $i<count($Extra_data); $i++){

           $bbokingdata[$key]["extra"][$i]= $this->HolidayModel->getHolidayExtraByid( $Extra_data[$i] )  ;

       }



       $bbokingdata[$key]["bookingPax"] = $this->HolidayModel->get_pax_id($cartdata["booking_id"]);

   }

}else{

 $bbokingdata = array();

 redirect("/");

}

$data["result"] =  $bbokingdata;

unset($_SESSION['Tours_Cart']);

$this->load->view("ticket",$data); 







}     





public function forgot_password()

{



    $this->load->library('email');



//SMTP & mail configuration

    $config = array(

        'protocol'  => 'smtp',

        'smtp_host' => 'ssl://smtp.gmail.com',

        'smtp_port' => 465,

        'smtp_user' => 'dd@gmail.com',

        'smtp_pass' => 'dd',

        'mailtype'  => 'html',

        'charset'   => 'utf-8'

    );

    $this->email->initialize($config);

    $this->email->set_mailtype("html");

    $this->email->set_newline("\r\n");



//Email content

    $htmlContent = '<h1>Forgot Password</h1>';

    $htmlContent .= '<p>update your password </p>';

    $htmlContent .= '<p>Link here!</p>';



    $this->email->to('d@yahoo.com');

    $this->email->from('d@gmail.com','MyWebsite');

    $this->email->subject('How to send email via SMTP server in CodeIgniter');

    $this->email->message($htmlContent);



//Send email

    $this->email->send();





    echo $this->email->send();



}   







public function paymentUpadate(){

		//  print_r($_POST["paymentBy"]);

  $bookings = explode(",",$_POST["bookingIDS"]) ;



  print_r($bookings);



  for($i=0 ; $i<count($bookings); $i++){

    $bbokingdata["bookingdetail"] = $this->HolidayModel->get_booking_by_id( $bookings[$i] );

    $updation = $this->HolidayModel->updateBookingpayment( $bookings[$i] ,$_POST["paymentBy"] ,$bbokingdata["bookingdetail"]->holbook_amount );



}

}





public function setCurrency() {



    if(isset($_POST['currency_select'])){



        foreach($this->currency_list as $currencies ){

          if($currencies->currman_id == $_POST['currency_select'] ){



           foreach($currencies as $value)

               { $new_array[] = $value; }



                            // Array ( [0] => 6 [1] => 2018-03-17 19:28:36 [2] => 2018-03-17 19:31:55 [3] => 5 [4] => DSA [5] => Rubles [6] => RUB [7] => ₽ [8] => fa-rub [9] => 60 [10] => active )



           $new_array[11] = $this->dsa_setting->dsaset_currency_symbol;						    



           $data_currency=implode(" , ",$new_array);



           $cookie_name = "selected_currency";

           $cookie_value =  $data_currency;

                            setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day



                        }     

                    }



                    if( $_POST['currency_select']  == 999 )

                    {

                        unset($_COOKIE['selected_currency']);

                        setcookie('selected_currency', null, -1, '/');

                    }



                }             



            }          







        }



