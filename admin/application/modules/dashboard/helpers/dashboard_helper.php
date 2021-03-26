<?php 
if(! defined('BASEPATH')) exit('No direct script access allowed');
if (! function_exists ( 'check_srdv_sms_balance' )) {
	function check_srdv_sms_balance($id) {
		$url = "http://sms.srdvtechnologies.com/api/checkcredits.php?authkey=$id";
		$ch = curl_init ( $url );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
		$curl_scraped_page = curl_exec ( $ch );
		$bp1=json_decode($curl_scraped_page);
		curl_close ( $ch );
		return $bp1;
	}
}

