<?php $this->load->view("commenLayout/head"); ?>
<?php $this->load->view("commenLayout/header"); ?>
<?php $this->load->view("flight/ft_cash/checksum.php");?>
<?php $this->load->view("flight/ft_cash/config.php");?>

<?php
// Date in the past
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache");
header("Pragma: no-cache");
@extract($SearchData);
?>
<?php
		$Amount=$gateway_data['amount'];
		$OrderId=$gateway_data['udf1'];
        $secret = config::Secret_Key();
		$all = "'". $gateway_data['amount'] . "''" . $gateway_data['udf1'] . "''" . config::MID() . "'";
		$checksum = Checksum::calculateChecksum($secret, $all);
        $actionUrl="https://www.ftcash.com/app/temp/verifymerchant2.php";
		
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
	<form name="myform" id="payment_form" action=<?php echo $actionUrl;?> method="POST">
			<input class="required email" size="50" name="email" type="hidden" value=<?php echo $gateway_data['email'];?>>
			<input class="required number" size="50" name="amount" type="hidden" value=<?php echo $gateway_data['amount'];?>>
			<input class="required number" size="50" maxlength="10" minlength="10" name="cell" type="hidden" value=<?php echo $gateway_data['phone'];?>>
			<input size="30" name="orderid" type="hidden" value=<?php echo $gateway_data['udf1'];?>>
			<input size="30" name="mid" type="hidden" id="mid" value="<?php echo config::MID();?>">
			<input size="100" name="name" type="hidden" id="name" value="<?php echo $gateway_data['name'];?>">
			<input size="100" name="redirect_url" type="hidden" id="redirect_url" value="<?php echo $gateway_data['return_url'];?>">
            <input type="hidden" name="checksum" value="<?php echo $checksum;?>" />
			
	</form>	
<script>
function formAutoSubmit () {
	var payform = document.getElementById("payment_form");
	payform.submit();
}
window.onload = formAutoSubmit;
</script>
            
     
<?php $this->load->view("commenLayout/footer"); ?>