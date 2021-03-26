<script src="<?php echo site_url();?>assets/vendor/plugins/jquery_validation/dist/jquery.validate.js"></script>
<script>
$("#changepass").validate({
	  rules: {
		  old_password: "required",
		  
		  new_password:{
	           required:true,
	           minlength:5,
		  },
		  conf_new_password: {
				required: true,
				minlength: 5,
				equalTo: "#newpassword"
			},   
		 
	  },
	  messages:{
		  old_password:"Please Enter current password",
		  
		  new_password:{
	          required:"Please enter password for user",
	          minlength:"Minimum 5 digit required",
		  },
		  conf_new_password:{
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
function confirm_pop_up(url){

	$('#delPollModal').modal('show');
	$('#deletePoll').click(function () {
	      window.location.href = url;
	    })
}
</script>