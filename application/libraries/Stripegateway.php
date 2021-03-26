<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Description of Stripegateway
 *
 * @author wahyu widodo
 */
 
include("./vendor/autoload.php"); 
 
class Stripegateway {
	
	public function __construct(){
		$stripe = array(
			"secret_key" => "sk_test_FCuZuswT2YqswbmNxtrTZpGv",
			"public_key" => "pk_test_wSZqNcWkhCUdCb4olHkQpBsq"
		);
		\Stripe\Stripe::setApiKey($stripe["secret_key"]);
	}
	
	public function checkout($data){
		$message = "";
		try{
            
			$token=$data['stripeToken'];    
			$amount=$data['amount'];
			$charge = \Stripe\Charge::create(array( 'amount' =>$amount,
                                                    'currency' => 'eur',
                                                    'description' => 'Example charge',
                                                    'source' => $token ));
			$message = $charge->status;											
		}catch (Exception $e){
			$message = $e->getMessage();
		}	
		return $message;
	}
    

}