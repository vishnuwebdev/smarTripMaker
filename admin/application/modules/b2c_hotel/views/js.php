<script src="<?php echo site_url();?>assets/vendor/plugins/jquery_validation/dist/jquery.validate.js"></script>
<script>
$("#add_markup").validate({
	  rules: {
		  amount: {
			  "required":true,
			  "number":true
		  },
		  low_price: {
			  "required":true,
			  "number":true
		  },
		  high_price: {
			  "number": true, 
			  "required": true,
		},
		  
	  },
	  messages:{
		  amount: {
			  "required":"Please Enter Amount",
			  "number":"Please enter valid amount"
		  },
		  low_price: {
			  "required":"Please Enter Amount",
			  "number":"Please enter valid amount"
		  },
		  high_price: {
			  "required":"Please Enter Amount",
			  "number":"Please enter valid amount",
		  }
		 
	  }
		});
</script>
<link rel="stylesheet" type="text/css" href="<?php echo site_url();?>assets/vendor/plugins/jquery_ui/jquery-ui.min.css">
<script type="text/javascript" src="<?php echo site_url();?>assets/vendor/plugins/jquery_ui/jquery-ui.min.js"></script>

