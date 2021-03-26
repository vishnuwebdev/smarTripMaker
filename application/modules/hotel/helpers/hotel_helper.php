<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );


function bp_get_hotel_fare($offer_fare,$publish_fare) {	
	$data['dsa_fare'] = $offer_fare;	
	$agent_actual_discount =0;
	$dsa_discount = $_SESSION ['hotle'] ['dsa_discount'];	
	if(($dsa_discount )){
		$dsa_discount = $_SESSION ['hotle'] ['dsa_discount']->hdis_fix;
		$dsa_actual_discount = $publish_fare - $offer_fare;
		$agent_actual_discount = (($dsa_actual_discount * $dsa_discount) / 100);
		$customer_fare = $publish_fare - $agent_actual_discount;
		
	}else{		
		$customer_fare = $publish_fare ;
	}
	//$customer_fare = $publish_fare ;
	$dsa_markup = $_SESSION ['hotle'] ['dsa_markup'];	
	$markup_dsa=0;
	if (( $dsa_markup )) {
		for($k=0; $k<count($dsa_markup); $k++){
			if($customer_fare >= $dsa_markup [$k] ['dsamark_min_range'] && $customer_fare <= $dsa_markup[$k] ['dsamark_max_range']){	
				if ($dsa_markup [$k] ["dsamark_amount_type"] == "fix") {
					$markup_dsa = $dsa_markup [$k] ["dsamark_value"];
					break;
				} else {
					$bp_dasa_markup_percentage = $dsa_markup [$k] ["dsamark_value"];
					$markup_dsa =  (($customer_fare * $bp_dasa_markup_percentage) / 100);
					break;
				}
			}	
		}
	}
	
	$final_fare = $customer_fare+$markup_dsa;
	$data ['final_fare'] = round($final_fare);	
	//$data ['markup_dsa'] = dsa_currency_convert($markup_dsa);
	$data ['discount'] = round($agent_actual_discount);
	return $data;
}

function bp_get_hotel_fare_pernight($offer_fare,$publish_fare,$nights) {	
	$data['dsa_fare'] = $offer_fare;	
	$agent_actual_discount =0;
	$dsa_discount = $_SESSION ['hotle'] ['dsa_discount'];	
	if(($dsa_discount )){
		$offer_fare = $offer_fare/$nights;
		$publish_fare = $publish_fare/$nights;
		$dsa_discount = $_SESSION ['hotle'] ['dsa_discount']->hdis_fix;
		$dsa_actual_discount = ($publish_fare - $offer_fare);
		$agent_actual_discount = (($dsa_actual_discount * $dsa_discount) / 100);
		
		$customer_fare = $publish_fare - ($agent_actual_discount);
		//$customer_fare = $publish_fare/$nights; ;
		//echo $agent_actual_discount;
	}else{		
		$customer_fare = $publish_fare/$nights; ;
	}
	
	
	
	//$customer_fare = $publish_fare ;
	$dsa_markup = $_SESSION ['hotle'] ['dsa_markup'];	
	$markup_dsa=0;
	if (( $dsa_markup )) {
		for($k=0; $k<count($dsa_markup); $k++){
			if($customer_fare >= $dsa_markup [$k] ['dsamark_min_range'] && $customer_fare <= $dsa_markup[$k] ['dsamark_max_range']){	
				if ($dsa_markup [$k] ["dsamark_amount_type"] == "fix") {
					$markup_dsa = $dsa_markup [$k] ["dsamark_value"];
					break;
				} else {
					$bp_dasa_markup_percentage = $dsa_markup [$k] ["dsamark_value"];
					$markup_dsa =  (($customer_fare * $bp_dasa_markup_percentage) / 100);
					break;
				}
			}	
		}
	}
	
	$final_fare = ($customer_fare+$markup_dsa);
	$data ['final_fare'] = round($final_fare);	
	//$data ['markup_dsa'] = dsa_currency_convert($markup_dsa);
	$data ['discount'] = round($agent_actual_discount);
		//print_r($data);die;	
	return $data;
}



if (! function_exists ( 'PrintArray' )) {
	function PrintArray($data) {
		echo "<pre>";
		print_r ( $data );
		echo "</pre>";
	}
}
if (! function_exists ( 'bp_word_limit' )) {
	function bp_word_limit($string, $length) {
		if ($length == NULL)
			$length = 130;
		$stringDisplay = substr ( strip_tags ( $string ), 0, $length );
		if (strlen ( strip_tags ( $string ) ) > $length)	
			$stringDisplay .= ' ...';	
		return $stringDisplay;
	}
}

function encrypt($plainText,$key)
	{
		$secretKey = hextobin(md5($key));
		$initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
	  	$openMode = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '','cbc', '');
	  	$blockSize = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, 'cbc');
		$plainPad = pkcs5_pad($plainText, $blockSize);
	  	if (mcrypt_generic_init($openMode, $secretKey, $initVector) != -1) 
		{
		      $encryptedText = mcrypt_generic($openMode, $plainPad);
	      	      mcrypt_generic_deinit($openMode);
		      			
		} 
		return bin2hex($encryptedText);
	}

	function decrypt($encryptedText,$key)
	{
		$secretKey = hextobin(md5($key));
		$initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
		$encryptedText=hextobin($encryptedText);
	  	$openMode = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '','cbc', '');
		mcrypt_generic_init($openMode, $secretKey, $initVector);
		$decryptedText = mdecrypt_generic($openMode, $encryptedText);
		$decryptedText = rtrim($decryptedText, "\0");
	 	mcrypt_generic_deinit($openMode);
		return $decryptedText;
		
	}
	//*********** Padding Function *********************

	 function pkcs5_pad ($plainText, $blockSize)
	{
	    $pad = $blockSize - (strlen($plainText) % $blockSize);
	    return $plainText . str_repeat(chr($pad), $pad);
	}

	//********** Hexadecimal to Binary function for php 4.0 version ********

	function hextobin($hexString) 
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