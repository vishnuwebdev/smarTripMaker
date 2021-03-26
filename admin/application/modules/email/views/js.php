<script src="<?php echo site_url();?>assets/vendor/plugins/jquery_validation/dist/jquery.validate.js"></script>
<script>
$("#add_new_customer").validate({
	  rules: {
		  first_name: "required",
		  email: {
	         required: true,
	         email : true
		  },
		  mobile:{
	         required: true,
	         number:true,
	         minlength:9,
	         maxlength:10
		  },
		  password:{
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
		  first_name:"Please Enter First Name",
		  email:{
	            required:"Please enter email id",
	            email:"Please enter a valide email",
		  },
		  mobile:{
	          required:"Please enter mobile number",
	          number:"Please enter 10 digit mobile number without 0 or +91",
	          minlength:"Please enter 10 digit mobile number without 0 or +91",
	          maxlength:"Please enter 10 digit mobile number without 0 or +91"
		  },
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