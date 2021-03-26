<script src="<?php echo site_url();?>assets/vendor/plugins/jquery_validation/dist/jquery.validate.js"></script>
<script>
$("#add_new_customer").validate({
	  rules: {
		  cust_first_name: "required",
		  cust_email: {
	         required: true,
	         email : true
		  },
		  cust_mobile:{
	         required: true,
	         number:true,
	         minlength:9,
	         maxlength:10
		  },
		  cust_password:{
	           required:true,
	           minlength:5,
		  },
		  confirm_password: {
				required: true,
				minlength: 5,
				equalTo: "#agent_password"
			},   
		 
	  },
	  messages:{
		  cust_first_name:"Please Enter First Name",
		  cust_email:{
	            required:"Please enter email id",
	            email:"Please enter a valide email",
		  },
		  cust_mobile:{
	          required:"Please enter mobile number",
	          number:"Please enter 10 digit mobile number without 0 or +91",
	          minlength:"Please enter 10 digit mobile number without 0 or +91",
	          maxlength:"Please enter 10 digit mobile number without 0 or +91"
		  },
		  cust_password:{
	          required:"Please enter password for user",
	          minlength:"Minimum 5 digit required",
		  },
		  confirm_password:{
	          required:"Please enter confirm password",
	          minlength:"Minimum 5 digit required",
	          equalTo:"Passowrd and Confirm password mismatch "
		  }
		 
	  }
		});
</script>
<script>
$("#add_agent_topup").validate({
	  rules: {
		  balance:{
	         required: true,
	         number:true
		  }
	  },
	  messages:{
		  balance:{
	          required:"Please enter amount",
	          number:"Please enter valid Amount"
		  }
		 
	  }
		});
</script>
<script>
$("#update_password").validate({
	  rules: {
		  password:{
	           required:true,
	           minlength:5,
		  },
		  confirm_password: {
				required: true,
				minlength: 5,
				equalTo: "#password"
			},
	  },
	  messages:{
		  password:{
	          required:"Please enter password for user",
	          minlength:"Minimum 5 digit required",
		  },
		  confirm_password:{
	          required:"Please enter confirm password",
	          minlength:"Minimum 5 digit required",
	          equalTo:"Passowrd and Confirm password mismatch "
		  }
		 
	  }
		});
</script>
<script>
function confirm_pop_up(url){

	$('#delPollModal').modal('show');
	$('#deletePoll').click(function () {
	      window.location.href = url;
	    })
}
</script>