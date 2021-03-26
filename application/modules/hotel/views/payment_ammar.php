<?php $this->load->view("commenLayout/head"); ?>
<?php $this->load->view("commenLayout/header"); ?>

<?php
// Date in the past
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache");
header("Pragma: no-cache");
@extract($SearchData);
?>
<?php
	date_default_timezone_set('Asia/Dhaka');
	function rand_string( $length ) {
		$str="";
		$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";	

		$size = strlen( $chars );
		for( $i = 0; $i < $length; $i++ ) {
			$str .= $chars[ rand( 0, $size - 1 ) ];
		}

		return $str;
	}
	$cur_random_value=rand_string(10);		
?>	

<script src="<?php echo site_url();?>common/front/js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="<?php echo site_url();?>common/front/js/bootstrap.js"></script>

<section id="content" class="gray-area" style="padding-top:0;">
            <div class="container">
                <div class="row" >
				<div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title" id="myModalLabel">Redirecting To Payment Gateway</h4>
      </div>
      <div class="modal-body text-center"> <img src="<?php echo base_url();?>assets/images/loading.gif"> <br/>
	  <b>Please Wait</b></br>
        Don't Close or Refresh Window </div>
    </div>
  </div>

				</div>
			</div>
</section>	
	



	 		<form name="myform" id="payment_form"  action="https://secure.aamarpay.com/index.php" method="post" >
				<input type="hidden" name="store_id" value="<?php echo $gateway_data['store_id']; ?>">
				<input type="hidden" name="signature_key" value="<?php echo $gateway_data['signature_key'];	?>">
				<input type="hidden" name="tran_id" value="WEP-<?php echo "$cur_random_value"; ?>">
				<input type="hidden" name="amount" value="<?php echo $gateway_data['amount']; ?>"> 
				<input type="hidden" name="currency" value="BDT">
				<input type="hidden" name="cus_name" value="<?php echo $gateway_data['name']; ?>">
				<input type="hidden" name="cus_email" value="<?php echo $gateway_data['email']; ?>">
				<input type="hidden" name="cus_add1" value="<?php echo $gateway_data['address_line_1']; ?>">
				<input type="hidden" name="cus_add2" value="<?php echo $gateway_data['address_line_2']; ?>">
				<input type="hidden" name="cus_city" value="<?php echo $gateway_data['city']; ?>">
				<input type="hidden" name="cus_state" value="<?php echo $gateway_data['state']; ?>">
				<input type="hidden" name="cus_postcode" value="<?php echo $gateway_data['zip_code']; ?>">
				<input type="hidden" name="cus_country" value="<?php echo $gateway_data['country']; ?>">
				<input type="hidden" name="cus_phone" value="<?php echo $gateway_data['phone']; ?>">
				<input type="hidden" name="cus_fax" value="010000000">	
				<input type="hidden" name="amount_vatratio" value="0">
				<input type="hidden" name="amount_vat" value="0">
				<input type="hidden" name="amount_taxratio" value="0">
				<input type="hidden" name="amount_tax" value="0">
				<input type="hidden" name="amount_processingfee_ratio" value="0">
				<input type="hidden" name="amount_processingfee" value="0">	
				<input type="hidden" name="desc" value="<?php echo  $gateway_data['description']; ?>">
				<input type="hidden" name="success_url" value="<?php echo  $gateway_data['success_url']; ?>">
				<input type="hidden" name="fail_url" value = "<?php echo  $gateway_data['fail_url']; ?>">
				<input type="hidden" name="cancel_url" value = "<?php echo $gateway_data['cancel_url']; ?>">
			</form>
	
	


<script>
function formAutoSubmit () {
	var payform = document.getElementById("payment_form");
	payform.submit();
}
window.onload = formAutoSubmit;
</script>
            
     
<?php $this->load->view("commenLayout/footer"); ?>