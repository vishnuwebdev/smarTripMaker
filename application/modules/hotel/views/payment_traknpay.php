<?php 
$this->load->view("include/head"); 
$this->load->view("include/header"); 
?>
<?php
// Date in the past
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache");
header("Pragma: no-cache");
@extract($SearchData);
?>
<script src="<?php echo site_url() ?>assets/js/jquery.js"></script>
<script src="<?php echo site_url() ?>assets/js/bootstrap.min.js"></script>
<section id="content" class="gray-area" style="padding-top:0;">
            <div class="container">
                <div class="row" >
				<div class="modal-dialog flights-search-popup" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title" id="myModalLabel">Redirecting To Payment Gateway</h4>
      </div>
      <div class="modal-body text-center"> <img class="loader-img" src="<?php echo site_url(); ?>assets/images/logo.png">
	  <h3>Please Wait</h3>
        <span class="block midfz">Don't Close or Refresh Window </span>
      </div>
    </div>
  </div>

				</div>
			</div>
</section>		
 <?php 
$salt = $gateway_data['salt']; //Pass your SALT here
$hash = hashCalculate($salt, $gateway_data);

function hashCalculate($salt,$input){
	/* Columns used for hash calculation, Donot add or remove values from $hash_columns array */
	$hash_columns = ['address_line_1', 'address_line_2', 'amount', 'api_key', 'city', 'country', 'currency', 'description', 'email', 'mode', 'name', 'order_id', 'phone', 'return_url', 'state', 'udf1', 'udf2', 'udf3', 'udf4', 'udf5', 'zip_code',];
	/*Sort the array before hashing*/
	ksort($hash_columns);

	/*Create a | (pipe) separated string of all the $input values which are available in $hash_columns*/
	$hash_data = $salt;
	foreach ($hash_columns as $column) {
		if (isset($input[$column])) {
			if (strlen($input[$column]) > 0) {
				$hash_data .= '|' . $input[$column];
			}
		}
	}
	$hash = strtoupper(hash("sha512", $hash_data));
	
	return $hash;
}
?>
<form action="https://biz.traknpay.in/v1/paymentrequest" id="payment_form" method="POST">
<input type="hidden" value="<?php echo $hash; ?>"                   name="hash"/>
<input type="hidden" value="<?php echo $gateway_data['api_key'];?>"        name="api_key"/>
<input type="hidden" value="<?php echo $gateway_data['return_url']; ?>"    name="return_url"/>
<input type="hidden" value="<?php echo $gateway_data['mode'];?>"           name="mode"/>
<input type="hidden" value="<?php echo $gateway_data['order_id'];?>"       name="order_id"/>
<input type="hidden" value="<?php echo $gateway_data['amount'];?>"         name="amount"/>
<input type="hidden" value="<?php echo $gateway_data['currency'];?>"       name="currency"/>
<input type="hidden" value="<?php echo $gateway_data['description'];?>"    name="description"/>
<input type="hidden" value="<?php echo $gateway_data['name'];?>"           name="name"/>
<input type="hidden" value="<?php echo $gateway_data['email'];?>"          name="email"/>
<input type="hidden" value="<?php echo $gateway_data['phone'];?>"          name="phone"/>
<input type="hidden" value="<?php echo $gateway_data['address_line_1'];?>" name="address_line_1"/>
<input type="hidden" value="<?php echo $gateway_data['address_line_2'];?>" name="address_line_2"/>
<input type="hidden" value="<?php echo $gateway_data['city'];?>"           name="city"/>
<input type="hidden" value="<?php echo $gateway_data['state'];?>"          name="state"/>
<input type="hidden" value="<?php echo $gateway_data['zip_code'];?>"       name="zip_code"/>
<input type="hidden" value="<?php echo $gateway_data['country'];?>"        name="country"/>
<input type="hidden" value="<?php echo $gateway_data['udf1'];?>"           name="udf1"/>
<input type="hidden" value="<?php echo $gateway_data['udf2'];?>"           name="udf2"/>
<input type="hidden" value="<?php echo $gateway_data['udf3'];?>"           name="udf3"/>
<input type="hidden" value="<?php echo $gateway_data['udf4'];?>"           name="udf4"/>
<input type="hidden" value="<?php echo $gateway_data['udf5'];?>"           name="udf5"/>
<noscript><input type="submit" value="Continue"/></noscript>
</form>
<script>
function formAutoSubmit () {
	var payform = document.getElementById("payment_form");
	payform.submit();
}
window.onload = formAutoSubmit;
</script>
            
<?php $this->load->view("include/footer");?>