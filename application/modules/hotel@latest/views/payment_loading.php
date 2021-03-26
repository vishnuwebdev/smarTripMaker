<?php
$this->load->view("header");


?>
<?php 


		$posted = array();
		$action = "";
		$price = $amount;
		$fnlAmount = (float)$price;
		$posted['amount'] = $fnlAmount;
		$posted['firstname'] = $firstname;
		$posted['phone'] = $phone;
		$posted['key'] = $MERCHANT_KEY;		
		$posted['productinfo'] = $productinfo;		
		$posted['email'] = $email;
		$posted['surl'] = $surl;
		$posted['furl'] = $furl;
		$posted['curl'] = $curl; 		
		$posted['address1'] = $address1;
		$posted['city'] = $city;
		$posted['state'] = $state;
		$posted['country'] = $country;
		$posted['lastname'] = $lastname;
		$posted['zipcode'] = $zipcode;
		$posted['udf1'] = $productinfo;
		$posted['txnid'] = $txnid;
                $posted["udf2"] = $remark;
                $posted["udf3"] = $sessionid;
		$hash = '';	  
		// Hash Sequence
		$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
		
		$hashVarsSeq = explode('|', $hashSequence);
		$hash_string = '';	
		foreach($hashVarsSeq as $hash_var) {
			 $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
			 $hash_string .= '|';
		   }

			$hash_string .= $SALT;
			$hash = strtolower(hash('sha512', $hash_string));
			$action = $PAYU_BASE_URL . '/_payment';
	
	  ?>      


	 <style>
	 .text-center{
		 text-align:center;
	 }
	 </style>	   


        <section id="content" class="gray-area" style="padding-top:0;">
            <div class="container">
                <div class="row">
				<div class="modal-dialog" role="document">
                <div class="modal-content">
                 
				 <div class="modal-header text-center">
                  <h4 class="modal-title" id="myModalLabel">
				  <br/> Please Wait While we generate Payment message</h4>                 
				 </div>                  				
				
                    <div class="modal-body text-center"><img style="display: unset;" class="img-responsive" src="<?php echo site_url(); ?>/assets/images/loading.gif"> 
				   <br/><b>Please Wait</b></br>Don't Close or Refresh Window
			     </div>
				 
                </div>                
				</div>                
				</div>			
			</div>
</section>  

            
<form action="<?php echo $action; ?>" method="POST" name="payuForm" id="payment_form">
     <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
     <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
     <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
     <input type="hidden"  name="amount" value="<?php echo (empty($posted['amount'])) ? '' : $posted['amount'] ?>" />
     <input type="hidden"  name="firstname" id="firstname" value="<?php echo (empty($posted['firstname'])) ? '' : $posted['firstname']; ?>" />
     <input type="hidden"  name="email" id="email" value="<?php echo (empty($posted['email'])) ? '' : $posted['email']; ?>" />
     <input type="hidden"  name="phone" value="<?php echo (empty($posted['phone'])) ? '' : $posted['phone']; ?>" />
     <textarea  style="display:none;" name="productinfo"><?php echo (empty($posted['productinfo'])) ? '' : $posted['productinfo'] ?></textarea>
     <input type="hidden"  name="surl" value="<?php echo (empty($posted['surl'])) ? '' : $posted['surl'] ?>" size="64" />
     <input type="hidden"  name="furl" value="<?php echo (empty($posted['furl'])) ? '' : $posted['furl'] ?>" size="64" />
     <input type="hidden"  name="service_provider" value="<?php echo (empty($posted['service_provider'])) ? $service_provider : $posted['service_provider'] ?>" size="64" />
     <input type="hidden"  name="lastname"  value="<?php echo (empty($posted['lastname'])) ? '' : $posted['lastname']; ?>" />
     <input type="hidden"  name="curl" value="<?php echo (empty($posted['curl'])) ? '' : $posted['curl']; ?>" />
     <input type="hidden"  name="address1" value="<?php echo (empty($posted['address1'])) ? '' : $posted['address1']; ?>" />
     <input type="hidden"  name="address2" value="<?php echo (empty($posted['address2'])) ? '' : $posted['address2']; ?>" />
     <input type="hidden"  name="city" value="<?php echo (empty($posted['city'])) ? '' : $posted['city']; ?>" />
     <input type="hidden"  name="state" value="<?php echo (empty($posted['state'])) ? '' : $posted['state']; ?>" />
     <input type="hidden"  name="country" value="<?php echo (empty($posted['country'])) ? '' : $posted['country']; ?>" />
     <input type="hidden"  name="zipcode" value="<?php echo (empty($posted['zipcode'])) ? '' : $posted['zipcode']; ?>" />
     <input type="hidden"  name="udf1" value="<?php echo (empty($posted['udf1'])) ? '' : $posted['udf1']; ?>" />
     <input type="hidden"  name="udf2" value="<?php echo (empty($posted['udf2'])) ? '' : $posted['udf2']; ?>" />
     <input type="hidden"  name="udf3" value="<?php echo (empty($posted['udf3'])) ? '' : $posted['udf3']; ?>" />
     <input type="hidden"  name="udf4" value="<?php echo (empty($posted['udf4'])) ? '' : $posted['udf4']; ?>" />
     <input type="hidden"  name="udf5" value="<?php echo (empty($posted['udf5'])) ? '' : $posted['udf5']; ?>" />
     <input type="hidden"  name="pg" value="<?php echo (empty($posted['pg'])) ? '' : $posted['pg']; ?>" />
     
   </form>

<script>
function formAutoSubmit () {
	var payform = document.getElementById("payment_form");
	payform.submit();
}
window.onload = formAutoSubmit;
</script>
