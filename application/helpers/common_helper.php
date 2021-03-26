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

if (! function_exists ( 'getDecimal' )) {
	function getDecimal($number) {
		return number_format((float)$number, 2, '.', '');
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
function DurationMinuts($cc) {
    $bp = explode(":", $cc);
    $h = explode("H", $bp[0]);
    $m = explode("M", $bp[1]);
    $duration = $h[0] * 60 + $m[0];
    return $duration;
}

function minute_to_hour($bp) {
    $mint1 = $bp % 60;
    $hours1 = $bp / 60;
    $cc = intval($hours1) . 'h : ' . $mint1 . 'm';
    echo $cc;
}

function TimeMinuts($cc) {
    $bp = explode(":", $cc);
    $duration = $bp[0] * 60 + $bp[1];
    return $duration;
}

function sec_to_hour($bp) {
    
   
    $hours1 = $bp / 60;
    $cc = intval($hours1);
    echo $cc;
}

if (!function_exists('GetTime')) {

    function GetTime($var) {
        list($dt, $tm) = explode('T', $var);
        $tm = substr($tm, 0, 5);
        return $tm;
    }

}
if (!function_exists('GetDateSc')) {

    function GetDateSc($var) {
        list($dt, $tm) = explode('T', $var);
        $dtime = date("d M", strtotime($dt));
        return $dtime;
    }

}

if (!function_exists('GetDateScFull')) {

    function GetDateScFull($var) {
        list($dt, $tm) = explode('T', $var);
        $dtime = date("d M y", strtotime($dt));
        return $dtime;
    }

}

if (!function_exists('GetDateWithDay')) {

    function GetDateWithDay($var) {
        list($dt, $tm) = explode('T', $var);
        $dtime = date("d M 'y, D", strtotime($dt));
        return $dtime;
    }

}

if (!function_exists('GetdateDay')) {

    function GetdateDay($var) {
        //list($dt, $tm) = explode('T', $var);
        $dtime = date("d M y, D", strtotime($var));
        return $dtime;
    }

}
if (!function_exists('GetDateSc')) {

    function GetDateSc($var) {
        list($dt, $tm) = explode('T', $var);
        $dtime = date("d M", strtotime($dt));
        return $dtime;
    }

}

if (!function_exists('GetDateScFull')) {

    function GetDateScFull($var) {
        list($dt, $tm) = explode('T', $var);
        $dtime = date("d M y", strtotime($dt));
        return $dtime;
    }

}

if (!function_exists('GetDateWithDay')) {

    function GetDateWithDay($var) {
        list($dt, $tm) = explode('T', $var);
        $dtime = date("d M 'y, D", strtotime($dt));
        return $dtime;
    }

}

if (!function_exists('GetdateDay')) {

    function GetdateDay($var) {
        //list($dt, $tm) = explode('T', $var);
        $dtime = date("d M y, D", strtotime($var));
        return $dtime;
    }

}

if (!function_exists('displayLimit')) {

    function displayLimit($string, $length) {
        if ($length == NULL)
            $length = 130;

        $stringDisplay = substr(strip_tags($string), 0, $length);

        if (strlen(strip_tags($string)) > $length)
            $stringDisplay .= ' ...';

        return $stringDisplay;
    }

}


if (!function_exists('styleDateFormat')) {

    function styleDateFormat($var) {
        $day = date("D", strtotime($var));
        $date = date("d", strtotime($var));
        $moyr = date("M'y", strtotime($var));

        return '<span class="cheack-date3">' . $day . ',</span>
	<span class="date3">' . $date . '</span>
	<span class="check-date4">' . $moyr . '</span></p>';
    }

}

if (!function_exists('dateDiff')) {

    function dateDiff($date1, $date2) {

        $date1 = date("Y-m-d", strtotime($date1));
        $date2 = date("Y-m-d", strtotime($date2));

        $current = $date1;
        $datetime2 = date_create($date2);
        $count = 0;
        while (date_create($current) < $datetime2) {
            $current = gmdate("Y-m-d", strtotime("+1 day", strtotime($current)));
            $count++;
        }
        return $count;
    }

}


if (!function_exists('GetDateWithDay')) {

    function GetDateWithDay($var) {
        list($dt, $tm) = explode('T', $var);
        $dtime = date("D, d M, Y", strtotime($dt));
        return $dtime;
    }

}


if (!function_exists('GetTimeStamp')) {

    function GetTimeStamp($var) {
        list($dt, $tm) = explode('T', $var);
        $t_stamp = $dt . ' ' . $tm;
        return strtotime($t_stamp);
    }

}



if (!function_exists("passanger_t_f_number")) {

    function passanger_t_f_number($type) {
        if ($type == "1") {
            return "Adult";
        } elseif ($type == "2") {
            return "Child";
        } elseif ($type == "3") {
            return "Infant";
        }
    }

}


function get_footer_menu($sitetype = NULL,$footertype = NULL) {
    $ci = & get_instance ();
    $ci->load->database ();
    // print_r($ci->agent_set_language);
    // die;
    $ci->db->select ( "*" );
    $ci->db->where ( array (
            "menu_type" => $footertype,
            "menu_user_id" => $ci->dsa_data->dsa_id,
            "menu_user_type" => "DSA",
            "menu_language" => "en",
            "menu_site_type" => $sitetype,
            "menu_status" => "active" 
    ) );
    
    $query = $ci->db->get ( "menu" );
     //print_r($query->num_rows ()); exit;
    if ($query->num_rows () > 0) {
        $menudata = $query->result ();

        
        foreach ( $menudata as $key => $valuedatamenu ) {
            
            $menupagesdata [$key] ["menu"] ["menuTitle"] = $valuedatamenu->menu_title;
            $menupagesdata [$key] ["menu"] ["menuName"] = $valuedatamenu->menu_name;
            $menupagesdata [$key] ["menu"] ["menuslug"] = $valuedatamenu->menu_slug;
            $menupagesdata [$key] ["menu"] ["menuId"] = $valuedatamenu->menu_id;
            $ci->db->select ( "*" );
            $ci->db->where ( array (
                    "menupage_menu_id" => $valuedatamenu->menu_id,
                    "menupage_user_id" => $ci->dsa_data->dsa_id,
                    "menupage_user_type" => "DSA",
                    "menupage_language" => "en",
                    "menupage_status" => "active" 
            ) );
            $ci->db->order_by ( "menupage_order", "asc" );
            $query2 = $ci->db->get ( "menu_page" );
            if ($query2->num_rows () > 0) {
                $menupagedata = $query2->result ();
                $menupagesdata [$key] ["menuPage"] = $menupagedata;
            } else {
                $menupagesdata [$key] ["menuPage"] = array ();
            }
        }
        return $menupagesdata;
        // printArray($menupagesdata);
        // die;
    } else {
        return "0";
    }
}

//GET FARE WITHOUT MARKUP

function bp_get_fare_without_markup($offer_fare,$publish_fare,$dsa_airline_code,$dsa_data,$base_fare = NULL,$yq_fare=NULL){
    
    $dsa_markup=$_SESSION ['flight']['dsa_markup'];
    $data['dsa_fare']=$offer_fare;
    $data['original_pub_fair']=$publish_fare;
    $bp_agent_fare=$data['dsa_fare'];
    $dsa_discounts = isset($_SESSION ['flight'] ['discount']) ? $_SESSION ['flight'] ['discount'] : 0;
    $bp_agent_fare_mark = 0;
    $publish_fare_disc  = 0;
    // print_r($dsa_discounts); exit;
    
        /* --------------- start Discount ---------------------*/
        
    if(isset($dsa_discounts[$dsa_airline_code]['airline_code'])) {
        //print_r($dsa_discounts[$dsa_airline_code]['airline_code']); exit;
        if($dsa_discounts[$dsa_airline_code]['airline_code'] == $dsa_airline_code){
            if($dsa_discounts[$dsa_airline_code]['amount_type']=='fix'){
                // $total=$publish_fare;
				 $total=$publish_fare - $offer_fare;
                $discount=($total*$dsa_discounts[$dsa_airline_code]['fix_value'])/100;
                
                $bp_agent_fare_disc = $discount;
                $publish_fare_disc = $discount;
                
            } else {
                $basic=($base_fare*$dsa_discounts[$dsa_airline_code]['basic'])/100;
                $yq=($yq_fare*$dsa_discounts[$dsa_airline_code]['yq'])/100; 
                $basic_bq=$basic+$yq;
                $bp_agent_fare_disc = $basic+$yq ;
                $publish_fare_disc = $basic+$yq;
            }
        }
    }
    else {
      
        if(isset($dsa_discounts[0]['airline_type'])){
            if($dsa_discounts[0]['airline_type'] == 'all'){
                if($dsa_discounts[0]['amount_type']=='fix'){
                    // $total=$publish_fare;
					 $total=$publish_fare - $offer_fare;
                    $discount=($total*$dsa_discounts[0]['fix_value'])/100;
                
                    $bp_agent_fare_disc = $discount;
                    $publish_fare_disc= $discount;
                    
                }else{
                    $basic=($base_fare*$dsa_discounts[0]['basic'])/100;
                    $yq=($yq_fare*$dsa_discounts[0]['yq'])/100; 
                    $basic_bq=$basic+$yq;
                    $bp_agent_fare_disc = $basic+$yq;
                    $publish_fare_disc = $basic+$yq;
                }
            }
        }
    }

    /* --------------- End Discount ---------------------*/
   
    $publish_fare=$publish_fare-$publish_fare_disc+$bp_agent_fare_mark;   
	
	//$data['dsa_markup']=($dsa_markup);
	$data['bp_agent_fare_mark']=($bp_agent_fare_mark);
    $data['publish_fare_disc']=($publish_fare_disc);
    $data['customer_fare']=($publish_fare);
    $data['base_fare']=($base_fare);
    $data['yq_fare']=($yq_fare);
	
	
    return $data;
}

//GET FARE

 function bp_get_fare($offer_fare,$publish_fare,$dsa_airline_code,$dsa_data,$base_fare = NULL,$yq_fare=NULL){
    
    $dsa_markup=$_SESSION ['flight']['dsa_markup'];
    $data['dsa_fare']=$offer_fare;
    $data['original_pub_fair']=$publish_fare;
    $bp_agent_fare=$data['dsa_fare'];
    $dsa_discounts = $_SESSION ['flight'] ['discount'];
    $bp_agent_fare_mark = 0;
    $publish_fare_disc  = 0;
    // print_r($dsa_discounts); exit;
    
        /* --------------- start Discount ---------------------*/
        
    if(isset($dsa_discounts[$dsa_airline_code]['airline_code'])) {
        //print_r($dsa_discounts[$dsa_airline_code]['airline_code']); exit;
        if($dsa_discounts[$dsa_airline_code]['airline_code'] == $dsa_airline_code){
            if($dsa_discounts[$dsa_airline_code]['amount_type']=='fix'){
                // $total=$publish_fare;
				$total=$publish_fare - $offer_fare;
                $discount=($total*$dsa_discounts[$dsa_airline_code]['fix_value'])/100;
                
                $bp_agent_fare_disc = $discount;
                $publish_fare_disc = $discount;
                
            } else {
                $basic=($base_fare*$dsa_discounts[$dsa_airline_code]['basic'])/100;
                $yq=($yq_fare*$dsa_discounts[$dsa_airline_code]['yq'])/100; 
                $basic_bq=$basic+$yq;
                $bp_agent_fare_disc = $basic+$yq ;
                $publish_fare_disc = $basic+$yq;
            }
        }
    }
    else {
      
        if(isset($dsa_discounts[0]['airline_type'])){
            if($dsa_discounts[0]['airline_type'] == 'all'){
                if($dsa_discounts[0]['amount_type']=='fix'){
                    // $total=$publish_fare;
					$total=$publish_fare - $offer_fare;
                    $discount=($total*$dsa_discounts[0]['fix_value'])/100;
                
                    $bp_agent_fare_disc = $discount;
                    $publish_fare_disc= $discount;
                    
                }else{
                    $basic=($base_fare*$dsa_discounts[0]['basic'])/100;
                    $yq=($yq_fare*$dsa_discounts[0]['yq'])/100; 
                    $basic_bq=$basic+$yq;
                    $bp_agent_fare_disc = $basic+$yq;
                    $publish_fare_disc = $basic+$yq;
                }
            }
        }
    }

    /* --------------- End Discount ---------------------*/
    
    
    //------Dsa Markup start---------------------
		if(isset($dsa_markup[$dsa_airline_code])){
			if($dsa_markup[$dsa_airline_code]["dsamark_amount_type"]=="fix"){
				$bp_agent_fare_mark =$dsa_markup[$dsa_airline_code]["dsamark_value"];
			}else{
				$bp_dsa_markup_percentage=$dsa_markup[$dsa_airline_code]["dsamark_value"];
				$bp_agent_fare_mark =($bp_agent_fare*$bp_dsa_markup_percentage)/100;
			}
		}elseif(isset($dsa_markup["all"])){
			if($dsa_markup["all"]["dsamark_amount_type"]=="fix"){
				$bp_agent_fare_mark =$dsa_markup["all"]["dsamark_value"];
			}else{
				$bp_dsa_markup_percentage=$dsa_markup["all"]["dsamark_value"];
				$bp_agent_fare_mark =($bp_agent_fare*$bp_dsa_markup_percentage)/100;
			}
		}
    //------DSA Markup END -----------------------
  
    $publish_fare=$publish_fare-$publish_fare_disc+$bp_agent_fare_mark;
    
   
	$data['bp_agent_fare_mark']=($bp_agent_fare_mark);
    $data['publish_fare_disc']=($publish_fare_disc);
    $data['customer_fare']=($publish_fare);
    $data['base_fare']=($base_fare);
    $data['yq_fare']=($yq_fare);
	
	
    return $data;
}

if (!function_exists("is_domestic_find")) {

    function is_domestic_find($airport_name) {
        $bhanu = array("Ahmedabad (India) ,AMD","Agra (India) ,AGR","Amritsar (India) ,ATQ","Bhubaneswar (India) ,BBI","Vadodara (India) ,BDQ","Bhuj (India) ,BHJ","Bhopal (India) ,BHO","Bhavnagar (India) ,BHU","Bikaner (India) ,BKB","Bangalore (India) ,BLR","Mumbai (India) ,BOM","Kozhikode (India) ,CCJ","Kolkata (India) ,CCU","Coimbatore (India) ,CJB","Kochi (India) ,COK","Dehra Dun (India) ,DED","Delhi (India) ,DEL","Dharamsala (India) ,DHM","Dibrugarh (India) ,DIB","Diu In (India) ,DIU","Guwahati (India) ,GAU","Gaya (India) ,GAY","Goa In (India) ,GOI","Gorakhpur (India) ,GOP","Gwalior (India) ,GWL","Hubli (India) ,HBX","Khajuraho (India) ,HJR","Shamshabad (India) ,HYD","Indore (India) ,IDR","Imphal (India) ,IMF","Agartala (India) ,IXA","Bagdogra (India) ,IXB","Chandigarh (India) ,IXC","Allahabad (India) ,IXD","Mangalore (India) ,IXE","Belgaum (India) ,IXG","Lilabari (India) ,IXI","Jammu (India) ,IXJ","Leh IN (India) ,IXL","Madurai (India) ,IXM","Pathankot (India) ,IXP","Ranchi (India) ,IXR","Silchar (India) ,IXS","Aurangabad (India) ,IXU","Kandla (India) ,IXY","Port Blair (India) ,IXZ","Jaipur (India) ,JAI","Jodhpur (India) ,JDH","Jamnagar (India) ,JGA","Jorhat (India) ,JRH","Jaisalmer (India) ,JSA","Kolhapur (India) ,KLH","Kanpur (India) ,KNU","Kulu (India) ,KUU","Lucknow (India) ,LKO","Latur (India) ,LTU","Ludhiana (India) ,LUH","Chennai (India) ,MAA","Mysore (India) ,MYQ","Nagpur (India) ,NAG","Patna (India) ,PAT","Porbandar (India) ,PBD","Pantnagar (India) ,PGH","Pune (India) ,PNQ","Rajkot (India) ,RAJ","Rajahmundry (India) ,RJA","Raipur (India) ,RPR","Simla (India) ,SLV","Srinagar (India) ,SXR","Tuticorin (India) ,TCR","Tirupati (India) ,TIR","Thiruvananthapuram (India) ,TRV","Tiruchirappali (India) ,TRZ","Udaipur (India) ,UDR","Vijayawada (India) ,VGA","Varanasi (India) ,VNS","Vishakhapatanam (India) ,VTZ"); 
        if (in_array($airport_name, $bhanu)) {
            return "true";
        } else {
            return "false";
        }
    }
}


//===EMAIL SEND
function email_send($to,$subject,$msg)
{
    $ci = get_instance();
    $ci->load->library('email');
    $config['protocol'] = "mail";
    $config['smtp_port'] = "465";   
    $config['smtp_host'] = "ssl://smtp.gmail.com";
    $config['smtp_user'] =  'techsupport@smarttripmaker.com';
    $config['smtp_pass'] = '8209364614';
    $config['charset'] = "utf-8";
    $config['mailtype'] = "html";
    $config['newline'] = "\r\n";
    $ci->email->initialize($config);
    $ci->email->from('techsupport@smarttripmaker.com', 'SMART TRIP MAKER');
    $ci->email->to($to);
    $ci->email->subject($subject);
    $ci->email->message($msg);
    $ci->email->send();
    return $ci;
}

function email_send_pdf($to, $subject, $msg, $ttechment = NULL,$ttechment1 = NULL) {
    $ci = get_instance ();
    $ci->load->library ( 'email' );
    $config['protocol'] = "mail";
    $config['smtp_port'] = "465";   
    $config['smtp_host'] = "ssl://smtp.gmail.com";
    $config['smtp_user'] =  'techsupport@smarttripmaker.com';
    $config['smtp_pass'] = '8209364614';
    $config['charset'] = "utf-8";
    $config['mailtype'] = "html";
    $config['newline'] = "\r\n";
    $ci->email->initialize($config);
    $ci->email->from('techsupport@smarttripmaker.com', 'SMART TRIP MAKER');
    $ci->email->to ( $to );
    $ci->email->subject ( $subject );
    $ci->email->message ( $msg );
    if ($ttechment != NULL) {       
		$ci->email->attach($ttechment, 'attachment', "Ticket.pdf", 'application/pdf');
	    $ci->email->attach($ttechment1, 'attachment', "Invoice.pdf", 'application/pdf');
    }
    $ci->email->send ();
}

if (!function_exists("emailWithAttachment")) {
    function emailWithAttachment($to, $subject, $msg, $attachment){
        $ci = get_instance ();
        $ci->load->library ( 'email' );
        $config['protocol'] = "mail";
        $config['smtp_port'] = "465";   
        $config['smtp_host'] = "ssl://smtp.gmail.com";
        $config['smtp_user'] =  'techsupport@smarttripmaker.com';
        $config['smtp_pass'] = '8209364614';
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";
        $ci->email->initialize($config);
        $ci->email->from('techsupport@smarttripmaker.com', 'SMART TRIP MAKER');
        $ci->email->to ( $to );
        $ci->email->subject ( $subject );
        $ci->email->message ( $msg );
        if(count($attachment) > 0){
            foreach($attachment as $item){   
                $ci->email->attach($item['src']);
                //$ci->email->attach($item['src'], 'attachment', $item['name'], $item['type']);
            }
        }
        
        $ci->email->send ();
    }
}




if (!function_exists('bp_pagination')) {

    function bp_pagination($pagination_url, $pagination_segment, $total_row, $per_page) {
        $config = array();
        $config["base_url"] = $pagination_url;
        $config["total_rows"] = $total_row;
        $config["per_page"] = $per_page;
        $config['uri_segment'] = $pagination_segment;
        $config['full_tag_open'] = '<nav><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav><!--pagination-->';
        $config['first_link'] = '&laquo; First';
        $config['first_tag_open'] = '<li class="prev page">';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last &raquo;';
        $config['last_tag_open'] = '<li class="next page">';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = 'Next &rarr;';
        $config['next_tag_open'] = '<li class="next">';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&larr; Previous';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        return $config;
    }

}


    function cc_encrypt($plainText,$key)
    {
        $secretKey = cc_hextobin(md5($key));
        $initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
        $encryptedText = openssl_encrypt($plainText, "AES-128-CBC", $secretKey, OPENSSL_RAW_DATA, $initVector);
        $encryptedText = bin2hex($encryptedText);
        return $encryptedText;
    }

    function cc_decrypt($encryptedText,$key)
    {
        $secretKey         = cc_hextobin(md5($key));
        $initVector         =  pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
        $encryptedText      = cc_hextobin($encryptedText);
        $decryptedText         =  openssl_decrypt($encryptedText,"AES-128-CBC", $secretKey, OPENSSL_RAW_DATA, $initVector);
        return $decryptedText;
    }
    //********** Hexadecimal to Binary function for php 4.0 version ********

    function cc_hextobin($hexString) 
     { 
            $length = strlen($hexString); 
            $binString="";   
            $count=0; 
            while($count<$length) 
            {       
                $subString =substr($hexString,$count,2);           
                $packedString = pack("H*",$subString); 
                if ($count==0)
            {
                $binString=$packedString;
            } 
                
            else 
            {
                $binString.=$packedString;
            } 
                
            $count+=2; 
            } 
            return $binString; 
          } 


    /**
     * Method to redirect to the previous page
     * Add to one of your helpers
     * USEAGE: redirectPreviousPage();
     */
    if ( ! function_exists('redirectBack')){
        function redirectBack(){
            if (isset($_SERVER['HTTP_REFERER'])){
                header('Location: '.$_SERVER['HTTP_REFERER']);
            }else{
                header('Location: http://'.$_SERVER['SERVER_NAME']);
            }
            exit;
        }
    }

    /**
     * Getting Current IP Address 
     */
    if ( ! function_exists('currentIP')){
        function currentIP(){
            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $ip = $_SERVER['REMOTE_ADDR'];
            }
            return $ip;
        }
    }
      
      
    /**
     * Getting Current Location Information
     * @return Array | null
    */
    if ( ! function_exists('locationInfo')){  
        function locationInfo() {
            $ip = currentIP();
            if($ip){
                $json = @file_get_contents("https://ipinfo.io/{$ip}/geo");
                $details = json_decode($json, true);
                return $details;
            }
            return null;
        }
    }

    /**
     * Getting Current Currency
     */
    if(!function_exists('getCurrentCurrency')){
        function getCurrentCurrency(){
            $current_currency = DEFAULT_CURRENCY;
            $ci =& get_instance();
            $ci->load->library('session');
            if($ci->session->has_userdata('currency')){
                $current_currency = $ci->session->userdata('currency');
            }
            return $current_currency;
        }
    }
      
      

    /**
     * function for load Currency According to User's Location 
     * @param null
     * @return null
     */
    if ( ! function_exists('handleCurrencyByLocation')){
        function handleCurrencyByLocation(){
            $ci =& get_instance();
            $ci->load->library('session');
            $currency = $ci->config->item('currency');
            $countries = array_keys($currency);
            $locationInfo = locationInfo();
            if(!$ci->session->has_userdata('currency') && isset($locationInfo['country']) && !empty($locationInfo['country']) && in_array($locationInfo['country'],$countries)){
                $ci->session->set_userdata(['currency'=>$currency[$locationInfo['country']]]);
            }
            if(!$ci->session->has_userdata('currency')){
                $ci->session->set_userdata(['currency'=>DEFAULT_CURRENCY]);
            }
        }
    }
    handleCurrencyByLocation();

    if ( ! function_exists('convertPrice')){
        function convertPrice($amt,$convertTo = null, $convertFrom = null,$actual = false ){
            $convertTo = (isset($convertTo) && !empty($convertTo)) ? $convertTo : getCurrentCurrency();
            $convertFrom = (isset($convertFrom) && !empty($convertFrom)) ? $convertFrom : CURRENCY_CONVERT_TYPE;
            $getUrl = "?access_key=".FIXER_ACCESS_KEY."&from=".$convertFrom."&to=".$convertTo."&amount=".$amt;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, FIXER_API_URL.$getUrl);
            
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);
            $jsonArrayResponse = json_decode($response,true);
            // echo "<pre>";
            // print_r($jsonArrayResponse['result']);
            // die;
            $amount = isset($jsonArrayResponse['result']) ? $jsonArrayResponse['result'] : $amt;
            
            if($actual){
                return round($amount,2);
            }else{
                return ceil(round($amount,2));
            }
        }
    }

    if ( ! function_exists('convertActualPrice')){
        function convertActualPrice($amt,$convertTo = null, $convertFrom = null ){
            $convertTo = (isset($convertTo) && !empty($convertTo)) ? $convertTo : getCurrentCurrency();
            $convertFrom = (isset($convertFrom) && !empty($convertFrom)) ? $convertFrom : CURRENCY_CONVERT_TYPE;
            
            return convertPrice($amt,$convertTo,$convertFrom,true);
        }
    }


    if ( ! function_exists('getAEDPaymentDetail')){
        function getAEDPaymentDetail($ref_id ){
            $url = AED_PAYMENT_DETAIL_URL."$ref_id/".AED_PAYMENT_MODE;
            return $url;
        }
    }

    if ( ! function_exists('getCurrencySymbol')){
        function getCurrencySymbol($currency = null ,$icon = true ){
            $currency = $currency ? $currency : getCurrentCurrency();
            if($icon){
                if($currency == "AED") {
                    return "<b>AED</b>";
                }elseif($currency == 'USD'){
                    return "<i class='icofont-dollar'></i>";
                }else{
                    return "<i class='icofont-rupee'></i>";
                }
            }
            return $currency;
        }
    }

    if ( ! function_exists('getTextCurrencySymbol')){
        function getTextCurrencySymbol($currency = null ,$icon = true ){
            $currency = $currency ? $currency : getCurrentCurrency();
            if($icon){
                if($currency == "AED") {
                    return "AED";
                }elseif($currency == 'USD'){
                    return "$";
                }else{
                    return "₹";
                }
            }
            return $currency;
        }
    }


?>