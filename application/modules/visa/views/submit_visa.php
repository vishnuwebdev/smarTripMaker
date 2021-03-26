<html>
<body>
	<center>

		<?php 
			$merchant_data='';
			$working_key= $ccavenueConfig->working_key;//Shared by CCAVENUES
			$access_code= $ccavenueConfig->access_code;//Shared by CCAVENUES
			foreach ($paymentData as $key => $value){
				$merchant_data.=$key.'='.$value.'&';
			}
			$encrypted_data=cc_encrypt($merchant_data,$working_key); // Method for encrypting the data.
			$currency = getCurrentCurrency();
		?>
		<form method="post" name="redirect" action="<?php echo $ccavenueConfig->status == 1 ? $ccavenueConfig->live_url : $ccavenueConfig->demo_url?>"> 
			<?php
				echo "<input type=hidden name=encRequest value=$encrypted_data>";
				echo "<input type=hidden name=access_code value=$access_code>";
			?>
		</form>
	</center>
<script language='javascript'>document.redirect.submit();</script>
</body>
</html>

