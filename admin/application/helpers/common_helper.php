<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
if (! function_exists ( 'PrintArray' )) {
	function PrintArray($data) {
		echo "<pre>";
		print_r ( $data );
		echo "</pre>";
	}
}
if (! function_exists ( 'url_encode' )) {
	function url_encode($data) {
		$CI = & get_instance ();
		return rawurlencode ( $CI->encryption->encrypt ( $data ) );
	}
}
if (! function_exists ( 'url_decode' )) {
	function url_decode($data) {
		$CI = & get_instance ();
		return $CI->encryption->decrypt ( $data );
	}
}
if (! function_exists ( 'bp_hash' )) {
	function bp_hash($n) {
		return (((0x0000FFFF & $n) << 16) + ((0xFFFF0000 & $n) >> 16));
	}
}


if (! function_exists ( 'send_sms' )) {
	function send_sms($number, $message, $sender) {
		
	}
}

if (! function_exists ( 'bp_pagination' )) {
	function bp_pagination($pagination_url, $pagination_segment, $total_row, $per_page) {
		$config = array ();
		$config ["base_url"] = $pagination_url;
		$config ["total_rows"] = $total_row;
		$config ["per_page"] = $per_page;
		$config ['uri_segment'] = $pagination_segment;
		$config ['full_tag_open'] = '<nav><ul class="pagination">';
		$config ['full_tag_close'] = '</ul></nav><!--pagination-->';
		$config ['first_link'] = '&laquo; First';
		$config ['first_tag_open'] = '<li class="prev page">';
		$config ['first_tag_close'] = '</li>';
		$config ['last_link'] = 'Last &raquo;';
		$config ['last_tag_open'] = '<li class="next page">';
		$config ['last_tag_close'] = '</li>';
		$config ['next_link'] = 'Next &rarr;';
		$config ['next_tag_open'] = '<li class="next">';
		$config ['next_tag_close'] = '</li>';
		$config ['prev_link'] = '&larr; Previous';
		$config ['prev_tag_open'] = '<li class="prev">';
		$config ['prev_tag_close'] = '</li>';
		$config ['cur_tag_open'] = '<li class="active"><a href="">';
		$config ['cur_tag_close'] = '</a></li>';
		$config ['num_tag_open'] = '<li>';
		$config ['num_tag_close'] = '</li>';
		return $config;
	}
}
if (! function_exists ( 'getAutoincrement' )) {
	function getAutoincrement($tablename) {
		$CI = & get_instance ();
		$inc = 0;
		$query = $CI->db->query ( "SHOW TABLE STATUS LIKE '$tablename'" );
		if ($query->num_rows () == 1) {
			$row = $query->row ();
			$inc = $row->Auto_increment;
		}
		return $inc;
	}
}
if (! function_exists ( 'six_digit_rendom_number' )) {
	function six_digit_rendom_number() {
		$num_str = sprintf ( "%06d", mt_rand ( 1, 999999 ) );
		return $num_str;
	}
}

function email_send($to,$subject,$msg)
{
	$ci = get_instance();
	$ci->load->library('email');
	$config['protocol'] = "smtp";
	$config['smtp_host'] = "ssl://smtp.gmail.com";
	$config['smtp_port'] = "465";
	$config['smtp_user'] =  'smarttripmakers@gmail.com';
	$config['smtp_pass'] = '8209364614';
	$config['charset'] = "utf-8";
	$config['mailtype'] = "html";
	$config['newline'] = "\r\n";
	$ci->email->initialize($config);
	$ci->email->from('smarttripmakers@gmail.com', 'SMART TRIP MAKER');
	$ci->email->to($to);
	$ci->email->subject($subject);
	$ci->email->message($msg);
	$ci->email->send();
	return $ci;
}

function email_send_pdf($to, $subject, $msg, $ttechment = NULL) {
	$ci = get_instance ();
	$ci->load->library ( 'email' );
	$config ['protocol'] = "smtp";
	$config['smtp_port'] = "465";		
	$config['smtp_host'] = "ssl://mail.smarttripmaker.com";
	$config['smtp_user'] =  'info@smarttripmaker.com';
	$config['smtp_pass'] = 'smarttripmaker@001';
	$config ['charset'] = "utf-8";
	$config ['mailtype'] = "html";
	$config ['newline'] = "\r\n";

	$ci->email->initialize ( $config );
	$ci->email->from('info@smarttripmaker.com', 'SMART TRIP MAKER');
	$ci->email->to ( $to );
	$ci->email->subject ( $subject );
	$ci->email->message ( $msg );
	if ($ttechment != NULL) {
        //$ci->email->attach ( $ttechment );
		$ci->email->attach($ttechment, 'attachment', "Ticket.pdf", 'application/pdf');
		
	}
	$ci->email->send ();
}

function dsa_Staff_Data_by_id($staffid) {
	$ci = get_instance ();
	$ci->db->where ( 'dsast_id', $staffid );
	
	$query = $ci->db->get ( 'dsa_staff' );
	if ($query->num_rows () == 1) {
		return $query->row ();
	} else {
		return false;
	}
}
function dsa_menu() {
	$ci = get_instance ();
	$dsamenuarray = array (

		array (
			"menu_module_name" => "sitesetting",
			"menu_title" => $ci->lang->line ( "site_management" ),
			"menu_icon" => "fa-cogs",
			"menu_active_class" => "setting",
			"sub_menu_display_class" => "sitesettingdisplay",
			"sub_menu" => array (
				array (
					"sub_menu_name" => $ci->lang->line ( "site_setting" ),
					"sub_menu_title" => $ci->lang->line ( "site_setting" ),
					"sub_menu_link" => "sitesetting",
					"sub_menu_active_class" => "sitesettingli" 
				),

				array (
					"sub_menu_name" => "Social Links",
					"sub_menu_title" => "Social Links",
					"sub_menu_link" => "sitesetting/social_link",
					"sub_menu_active_class" => "sitesettingli/social_link" 
				),
				array (
					"sub_menu_name" => $ci->lang->line ( "slider_image" ),
					"sub_menu_title" => $ci->lang->line ( "slider_image" ),
					"sub_menu_link" => "sitesetting/slider_images",
					"sub_menu_active_class" => "sitesetting/slider_images" 
				),

						// array (
								// "sub_menu_name" => "Home Offer Image",
								// "sub_menu_title" => "Home Offer Image",
								// "sub_menu_link" => "sitesetting/offer_images",
								// "sub_menu_active_class" => "sitesetting/offer_images" 
						// ) 

			)

		),

		array (
			"menu_module_name" => "b2c_flight",
			"menu_title" => "Flight Management",
			"menu_icon" => "fa-plane",
			"menu_active_class" => "b2c_flight",
			"sub_menu_display_class" => "b2c_flight",
			"sub_menu" => array (
				array (
					"sub_menu_name" => "b2c_flight/booking_list",
					"sub_menu_title" => $ci->lang->line ( "flight" ) . " " . $ci->lang->line ( "booking" ) . " " . $ci->lang->line ( "list" ),
					"sub_menu_link" => "b2c_flight/booking_list",
					"sub_menu_active_class" => "b2c_flight/booking_list",
					"sub_menu_icon" => "fa-list"
				),
				array (
					"sub_menu_name" => "b2c_flight/discount_list",
					"sub_menu_title" => "Discount List",
					"sub_menu_link" => "b2c_flight/discount_list",
					"sub_menu_active_class" => "b2c_flight/discount_list",
					"sub_menu_icon" => "fa-list"
				),
				array (
					"sub_menu_name" => "b2c_flight/add_discount",
					"sub_menu_title" => "Add Discount",
					"sub_menu_link" => "b2c_flight/add_discount",
					"sub_menu_active_class" => "b2c_flight/add_discount",
					"sub_menu_icon" => "fa-plus"
				),
				array (
					"sub_menu_name" => "b2c_flight/b2c_flight_markup_list",
					"sub_menu_title" => "B2C " . $ci->lang->line ( "markup" ),
					"sub_menu_link" => "b2c_flight/b2c_flight_markup_list",
					"sub_menu_active_class" => "b2c_flight/b2c_flight_markup_list"
				),
				array (
					"sub_menu_name" => "b2c_flight/add_b2c_flight_markup",
					"sub_menu_title" => "Add B2C Markup ",
					"sub_menu_link" => "b2c_flight/add_b2c_flight_markup",
					"sub_menu_active_class" => "b2c_flight/add_b2c_flight_markup"
				)
			)
		),


		
		array (
			"menu_module_name" => "b2c_hotel",
			"menu_title" => "Hotel Management",
			"menu_icon" => "fa-dot-circle-o",
			"menu_active_class" => "b2c_hotel",
			"sub_menu_display_class" => "b2c_hotel",
			"sub_menu" => array (
				array (
					"sub_menu_name" => "b2c_hotel/booking_list",
					"sub_menu_title" =>"Booking List",
					"sub_menu_link" => "b2c_hotel/booking_list",
					"sub_menu_active_class" => "b2c_hotel/booking_list",
					"sub_menu_icon" => "fa-list"
				),
				array (
					"sub_menu_name" => "b2c_hotel/b2c_markup_list",
					"sub_menu_title" =>"Markup List",
					"sub_menu_link" => "b2c_hotel/b2c_markup_list",
					"sub_menu_active_class" => "b2c_hotel/b2c_markup_list",
					"sub_menu_icon" => "fa-list"
				),
				array (
					"sub_menu_name" => "b2c_hotel/add_b2c_markup",
					"sub_menu_title" =>"Add Markup",
					"sub_menu_link" => "b2c_hotel/add_b2c_markup",
					"sub_menu_active_class" => "b2c_hotel/add_b2c_markup",
					"sub_menu_icon" => "fa-plus"
				),
						//Add hotel discount

				array (
					"sub_menu_name" => "b2c_hotel/b2c_discount_list",
					"sub_menu_title" =>"Discount List",
					"sub_menu_link" => "b2c_hotel/b2c_discount_list",
					"sub_menu_active_class" => "b2c_hotel/b2c_discount_list",
					"sub_menu_icon" => "fa-list"
				),
				array (
					"sub_menu_name" => "b2c_hotel/add_hotel_discount",
					"sub_menu_title" =>"Add Discount",
					"sub_menu_link" => "b2c_hotel/add_hotel_discount",
					"sub_menu_active_class" => "b2c_hotel/add_hotel_discount",
					"sub_menu_icon" => "fa-plus"
				),													


			)

		),

		array (
			"menu_module_name" => "holiday",
			"menu_title" => $ci->lang->line ( "package" ) . " " . $ci->lang->line ( "management" ),
			"menu_icon" => "fa-umbrella",
			"menu_active_class" => "holiday",
			"sub_menu_display_class" => "holiday",
			"sub_menu" => array (

				array (
					"sub_menu_name" => "coupon list",
					"sub_menu_title" => "Query List",
					"sub_menu_link" => "holiday/query",
					"sub_menu_active_class" => "holiday/query",
					"sub_menu_icon" => "fa-list" 
				),
				array (
					"sub_menu_name" => "coupon list",
					"sub_menu_title" => $ci->lang->line ( "package_list" ),
					"sub_menu_link" => "holiday",
					"sub_menu_active_class" => "holiday",
					"sub_menu_icon" => "fa-list" 
				),

				array (
					"sub_menu_name" => "category_list",
					"sub_menu_title" => $ci->lang->line ( "category_list" ),
					"sub_menu_link" => "holiday/category_list",
					"sub_menu_active_class" => "holiday/category_list",
					"sub_menu_icon" => "fa-list" 
				),
				array (
					"sub_menu_name" => "sub_category_list",
					"sub_menu_title" => $ci->lang->line ( "sub_category_list" ),
					"sub_menu_link" => "holiday/sub_category_list",
					"sub_menu_active_class" => "holiday/sub_category_list",
					"sub_menu_icon" => "fa-list" 
				),
				array (
					"sub_menu_name" => "inclusion_list",
					"sub_menu_title" => $ci->lang->line ( "inclusion_list" ),
					"sub_menu_link" => "holiday/inclusion_list",
					"sub_menu_active_class" => "holiday/inclusion_list",
					"sub_menu_icon" => "fa-list" 
				),
				array (
					"sub_menu_name" => "exclusion_list",
					"sub_menu_title" => $ci->lang->line ( "exclusion_list" ),
					"sub_menu_link" => "holiday/exclusion_list",
					"sub_menu_active_class" => "holiday/exclusion_list",
					"sub_menu_icon" => "fa-list" 
				),



				array (
					"sub_menu_name" => "add_package",
					"sub_menu_title" => $ci->lang->line ( "add_package" ),
					"sub_menu_link" => "holiday/add_package",
					"sub_menu_active_class" => "holiday/add_package",
					"sub_menu_icon" => "fa-plus" 
				),
				array (
					"sub_menu_name" => "add_category",
					"sub_menu_title" => $ci->lang->line ( "add_package_category" ),
					"sub_menu_link" => "holiday/add_category",
					"sub_menu_active_class" => "holiday/add_category",
					"sub_menu_icon" => "fa-plus" 
				),
				array (
					"sub_menu_name" => "add_sub_category",
					"sub_menu_title" => $ci->lang->line ( "add_package_sub_category" ),
					"sub_menu_link" => "holiday/add_sub_category",
					"sub_menu_active_class" => "holiday/add_sub_category",
					"sub_menu_icon" => "fa-plus" 
				),
				array (
					"sub_menu_name" => "add_inclusion",
					"sub_menu_title" => $ci->lang->line ( "add_package_inclusion" ),
					"sub_menu_link" => "holiday/add_inclusion",
					"sub_menu_active_class" => "holiday/add_inclusion",
					"sub_menu_icon" => "fa-plus" 
				),
				array (
					"sub_menu_name" => "add_exclusion",
					"sub_menu_title" => $ci->lang->line ( "add_package_exclusion" ),
					"sub_menu_link" => "holiday/add_exclusion",
					"sub_menu_active_class" => "holiday/add_exclusion",
					"sub_menu_icon" => "fa-plus" 
				),

			)

		),

		array (
			"menu_module_name" => "customer",
			"menu_title" => $ci->lang->line ( "customer" ) . " " . $ci->lang->line ( "management" ),
			"menu_icon" => "fa-user",
			"menu_active_class" => "customer",
			"sub_menu_display_class" => "customer",
			"sub_menu" => array (
				array (
					"sub_menu_name" => "customer",
					"sub_menu_title" => "Customer List",
					"sub_menu_link" => "customer",
					"sub_menu_active_class" => "customer" 
				),
				array (
					"sub_menu_name" => "add_new_customer",
					"sub_menu_title" => "Add New Customer",
					"sub_menu_link" => "customer/add_new_customer",
					"sub_menu_active_class" => "customer/add_new_customer" 
				) 
			)

		),
		array (
			"menu_module_name" => "b2c_visa",
			"menu_title" => "Visa Request",
			"menu_icon" => "fa-cc-visa",
			"menu_active_class" => "b2c_visa",
			"sub_menu_display_class" => "b2c_visa",
			"sub_menu" => array (
				array (
					"sub_menu_name" => "b2c_visa/request_list",
					"sub_menu_title" => $ci->lang->line ( "visa" ) . " " . $ci->lang->line ( "list" ),
					"sub_menu_link" => "b2c_visa/request_list",
					"sub_menu_active_class" => "b2c_visa/request_list",
					"sub_menu_icon" => "fa-list"
				),
				// array (
				// 	"sub_menu_name" => "visa/visa_list",
				// 	"sub_menu_title" => "Visa Types",
				// 	"sub_menu_link" => "visa/visa_list",
				// 	"sub_menu_active_class" => "visa/visa_list",
				// 	"sub_menu_icon" => "fa-list"
				// ),
				// array (
				// 	"sub_menu_name" => "visa/visa_location",
				// 	"sub_menu_title" => "Visa Location",
				// 	"sub_menu_link" => "visa/visa_location",
				// 	"sub_menu_active_class" => "visa/visa_location",
				// 	"sub_menu_icon" => "fa-list"
				// ),
			)
		),
		array (
			"menu_module_name" => "visa",
			"menu_title" => "Visa Management",
			"menu_icon" => "fa-cc-visa",
			"menu_active_class" => "visa",
			"sub_menu_display_class" => "visa",
			"sub_menu" => array (
				array (
					"sub_menu_name" => "visa/visa_list",
					"sub_menu_title" => "Visa Types",
					"sub_menu_link" => "visa/visa_list",
					"sub_menu_active_class" => "visa/visa_list",
					"sub_menu_icon" => "fa-list"
				),
				array (
					"sub_menu_name" => "visa/visa_location",
					"sub_menu_title" => "Visa Location",
					"sub_menu_link" => "visa/visa_location",
					"sub_menu_active_class" => "visa/visa_location",
					"sub_menu_icon" => "fa-list"
				),
			)
		),
		array (
			"menu_module_name" => "staff",
			"menu_title" => $ci->lang->line ( "staff" ) . " " . $ci->lang->line ( "management" ),
			"menu_icon" => "fa-tree",
			"menu_active_class" => "staff",
			"sub_menu_display_class" => "staff",
			"sub_menu" => array (
				array (
					"sub_menu_name" => $ci->lang->line ( "staff" ) . " " . $ci->lang->line ( "list" ),
					"sub_menu_title" => $ci->lang->line ( "staff" ) . " " . $ci->lang->line ( "list" ),
					"sub_menu_link" => "staff",
					"sub_menu_active_class" => "staff" 
				),
				array (
					"sub_menu_name" => $ci->lang->line ( "add" ) . " " . $ci->lang->line ( "staff" ),
					"sub_menu_title" => $ci->lang->line ( "add" ) . " " . $ci->lang->line ( "new" ) . " " . $ci->lang->line ( "staff" ),
					"sub_menu_link" => "staff/add_new_staff",
					"sub_menu_active_class" => "staff/add_new_staff" 
				) 
			)

		),


		array (
			"menu_module_name" => "marketing",
			"menu_title" => $ci->lang->line ( "marketing" ) . " " . $ci->lang->line ( "management" ),
			"menu_icon" => "fa-signal",
			"menu_active_class" => "marketing",
			"sub_menu_display_class" => "marketing",
			"sub_menu" => array (
				array (
					"sub_menu_name" => "marketing",
					"sub_menu_title" => "NewsLetter Email List",
					"sub_menu_link" => "marketing",
					"sub_menu_active_class" => "marketing",
					"sub_menu_icon" => "fa-caret-right" 
				) 
			)

		),

		array (
			"menu_module_name" => "coupon",
			"menu_title" => $ci->lang->line ( "coupon" ) . " " . $ci->lang->line ( "management" ),
			"menu_icon" => "fa-strikethrough",
			"menu_active_class" => "coupon",
			"sub_menu_display_class" => "coupon",
			"sub_menu" => array (
				array (
					"sub_menu_name" => "coupon list",
					"sub_menu_title" => $ci->lang->line ( "coupon" ) . " " . $ci->lang->line ( "list" ),
					"sub_menu_link" => "coupon/allcoupon",
					"sub_menu_active_class" => "allcoupon" 
				),
			)

		),

		array (
			"menu_module_name" => "pages",
			"menu_title" => "Page Management",
			"menu_icon" => "fa-files-o",
			"menu_active_class" => "pages",
			"sub_menu_display_class" => "pages",
			"sub_menu" => array (
				array (
					"sub_menu_name" => $ci->lang->line ( "all_page_list" ),
					"sub_menu_title" => $ci->lang->line ( "all_page_list" ),
					"sub_menu_link" => "pages",
					"sub_menu_active_class" => "pages/allpage_list" 
				),
				array (
					"sub_menu_name" => $ci->lang->line ( "add_new_page" ),
					"sub_menu_title" => $ci->lang->line ( "add_new_page" ),
					"sub_menu_link" => "pages/add_new_page",
					"sub_menu_active_class" => "pages/add_new_page" 
				) 
			)

		),

		array (
			"menu_module_name" => "payment",
			"menu_title" => $ci->lang->line ( "payment" ) . " " . $ci->lang->line ( "management" ),
			"menu_icon" => "fa-money",
			"menu_active_class" => "payment",
			"sub_menu_display_class" => "payment",
			"sub_menu" => array (
				array (
					"sub_menu_name" => $ci->lang->line ( "payment" ) . " " . $ci->lang->line ( "setting" ),
					"sub_menu_title" => $ci->lang->line ( "payment" ) . " " . $ci->lang->line ( "setting" ),
					"sub_menu_link" => "payment/payment_setting",
					"sub_menu_active_class" => "payment/payment_setting" 
				),

			)

		),

		array (
			"menu_module_name" => "menu",
			"menu_title" => $ci->lang->line ( "menu" ) . " " . $ci->lang->line ( "management" ),
			"menu_icon" => "fa-list",
			"menu_active_class" => "menu",
			"sub_menu_display_class" => "menu",
			"sub_menu" => array (
				array (
					"sub_menu_name" => $ci->lang->line ( "menu" ) . " " . $ci->lang->line ( "list" ),
					"sub_menu_title" => $ci->lang->line ( "menu" ) . " " . $ci->lang->line ( "list" ),
					"sub_menu_link" => "menu/menu_list",
					"sub_menu_active_class" => "alllist" 
				),
				array (
					"sub_menu_name" => "add menu",
					"sub_menu_title" => $ci->lang->line ( "add" ) . " " . $ci->lang->line ( "menu" ),
					"sub_menu_link" => "menu/add_menu",
					"sub_menu_active_class" => "menu/add_menu" 
				) 
			)

		),


		array (
			"menu_module_name" => "blog",
			"menu_title" => $ci->lang->line ( "blog" ) . " " . $ci->lang->line ( "management" ),
			"menu_icon" => "fa-random",
			"menu_active_class" => "blog",
			"sub_menu_display_class" => "blog",
			"sub_menu" => array (
				array (
					"sub_menu_name" => "cat list",
					"sub_menu_title" => $ci->lang->line ( "blog" ) . " " . $ci->lang->line ( "category" ) . " " . $ci->lang->line ( "list" ),
					"sub_menu_link" => "blog/blog_category_list",
					"sub_menu_active_class" => "blog_category_list" 
				),
				array (
					"sub_menu_name" => "add category",
					"sub_menu_title" => $ci->lang->line ( "add" ) . " " . $ci->lang->line ( "blog" ) . " " . $ci->lang->line ( "category" ),
					"sub_menu_link" => "blog/add_blog_category",
					"sub_menu_active_class" => "add_blog_category" 
				),
				array (
					"sub_menu_name" => "blog list",
					"sub_menu_title" => $ci->lang->line ( "blog" ) . " " . $ci->lang->line ( "list" ),
					"sub_menu_link" => "blog/blog_list",
					"sub_menu_active_class" => "blog_list" 
				),
				array (
					"sub_menu_name" => "add blog",
					"sub_menu_title" => $ci->lang->line ( "add" ) . " " . $ci->lang->line ( "new" ) . " " . $ci->lang->line ( "blog" ),
					"sub_menu_link" => "blog/add_blog_post",
					"sub_menu_active_class" => "add_blog_post" 
				) 
			)

		),


		array (
			"menu_module_name" => "query",
			"menu_title" => $ci->lang->line ( "query" ) . " " . $ci->lang->line ( "management" ),
			"menu_icon" => "fa-user",
			"menu_active_class" => "query",
			"sub_menu_display_class" => "query",
			"sub_menu" => array (
				array (
					"sub_menu_name" => "query",
					"sub_menu_title" => "Query List",
					"sub_menu_link" => "query",
					"sub_menu_active_class" => "query" 
				) 
			)

		),
		
		array (
			"menu_module_name" => "job",
			"menu_title" => "Job" . " " . $ci->lang->line ( "management" ),
			"menu_icon" => "fa-user",
			"menu_active_class" => "job",
			"sub_menu_display_class" => "job",
			"sub_menu" => array (
				array (
					"sub_menu_name" => "job",
					"sub_menu_title" => "Job List",
					"sub_menu_link" => "job",
					"sub_menu_active_class" => "job" 
				) 
			)

		),

		array (
			"menu_module_name" => "online",
			"menu_title" => "Basic Common Data",
			"menu_icon" => "fa-bank",
			"menu_active_class" => "online",
			"sub_menu_display_class" => "online",
			"sub_menu" => array (
				array (
					"sub_menu_name" => "Icons",
					"sub_menu_title" => "Icons",
					"sub_menu_link" => "online/font_awesome",
					"sub_menu_active_class" => "online/font_awesome",
					"sub_menu_icon" => "fa-caret-right" 
				) 
			)

		)	 

);
sort($dsamenuarray);
return $dsamenuarray;
}
// Flight Module
if (! function_exists ( 'GetDateScFull' )) {
	function GetDateScFull($var) {
		list ( $dt, $tm ) = explode ( 'T', $var );
		$dtime = date ( "d M y", strtotime ( $dt ) );
		return $dtime;
	}
}
if (! function_exists ( 'GetTimeStamp' )) {
	function GetTimeStamp($var) {
		list ( $dt, $tm ) = explode ( 'T', $var );
		$t_stamp = $dt . ' ' . $tm;
		return strtotime ( $t_stamp );
	}
}
if (! function_exists ( 'GetTime' )) {
	function GetTime($var) {
		list ( $dt, $tm ) = explode ( 'T', $var );
		$tm = substr ( $tm, 0, 5 );
		return $tm;
	}
}
function getCurrencynumToWord($number) {
	$decimal = round ( $number - ($no = floor ( $number )), 2 ) * 100;
	$hundred = null;
	$digits_length = strlen ( $no );
	$i = 0;
	$str = array ();
	$words = array (
		0 => '',
		1 => 'one',
		2 => 'two',
		3 => 'three',
		4 => 'four',
		5 => 'five',
		6 => 'six',
		7 => 'seven',
		8 => 'eight',
		9 => 'nine',
		10 => 'ten',
		11 => 'eleven',
		12 => 'twelve',
		13 => 'thirteen',
		14 => 'fourteen',
		15 => 'fifteen',
		16 => 'sixteen',
		17 => 'seventeen',
		18 => 'eighteen',
		19 => 'nineteen',
		20 => 'twenty',
		30 => 'thirty',
		40 => 'forty',
		50 => 'fifty',
		60 => 'sixty',
		70 => 'seventy',
		80 => 'eighty',
		90 => 'ninety' 
	);
	$digits = array (
		'',
		'hundred',
		'thousand',
		'lakh',
		'crore' 
	);
	while ( $i < $digits_length ) {
		$divider = ($i == 2) ? 10 : 100;
		$number = floor ( $no % $divider );
		$no = floor ( $no / $divider );
		$i += $divider == 10 ? 1 : 2;
		if ($number) {
			$plural = (($counter = count ( $str )) && $number > 9) ? 's' : null;
			$hundred = ($counter == 1 && $str [0]) ? ' and ' : null;
			$str [] = ($number < 21) ? $words [$number] . ' ' . $digits [$counter] . $plural . ' ' . $hundred : $words [floor ( $number / 10 ) * 10] . ' ' . $words [$number % 10] . ' ' . $digits [$counter] . $plural . ' ' . $hundred;
		} else
		$str [] = null;
	}
	$Rupees = implode ( '', array_reverse ( $str ) );
	$paise = ($decimal) ? "." . ($words [$decimal / 10] . " " . $words [$decimal % 10]) . ' Paise' : '';
	return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise;
}

if (! function_exists ( 'dsa_currency_convert' )) {
	function dsa_currency_convert($amount) {
		$ci = & get_instance ();
		$bp_dsa_currency = $ci->dsa_data->dsa_currency;
		$bp_currency_value = $ci->bp_white_label_setting->wls_currency_value;
		$final_amount = $amount / $bp_currency_value;
		$final_amount = round ( $final_amount, 2 );
		return $final_amount;
	}
}

function get_category($id) {
	$CI = & get_instance ();
	$CI->db->select("holcat_name");
	$CI->db->where("holcat_id",$id);               
	$query=$CI->db->get("holiday_category");
	if($query->num_rows()>0){
		return $query->row()->holcat_name;
	}else{
		return "0";
	}			
}


