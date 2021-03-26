<script src="<?php echo site_url();?>assets/vendor/plugins/jquery_validation/dist/jquery.validate.js"></script>
<script>
$("#add_new_category").validate({
	  rules: {
		  name: "required",
		  
	  },
	  messages:{
		  name:"Please Enter Category Name",
		 
	  }
		});
</script>
<script>
$("#add_new_inclusion").validate({
	  rules: {
		  name: "required",
		  
	  },
	  messages:{
		  name:"Please Enter inclusion Name",
		 
	  }
		});
</script>
<script>
$("#add_new_exclusion").validate({
	  rules: {
		  name: "required",
		  
	  },
	  messages:{
		  name:"Please Enter exclusion Name",
		 
	  }
		});
</script>
<script>
$("#add_hotel_type").validate({
	  rules: {
		  name: "required",
		  
	  },
	  messages:{
		  name:"Please Enter Hotel Type",
		 
	  }
		});
</script>
<script>
$("#add_hotel_amenity").validate({
	  rules: {
		  name: "required",
		  
	  },
	  messages:{
		  name:"Please Enter Hotel Amenity",
		 
	  }
		});
</script>
<script>
$("#add_room_amenity").validate({
	  rules: {
		  name: "required",
		  
	  },
	  messages:{
		  name:"Please Enter Room Amenity",
		 
	  }
		});
</script>
<script>
$("#add_hotel").validate({
	  rules: {
		  name: "required",
		  
	  },
	  messages:{
		  name:"Please Enter Hotel Name",
		 
	  }
		});
</script>
<script>
$("#add_payment_mode").validate({
	  rules: {
		  name: "required",
		  
	  },
	  messages:{
		  name:"Please Enter payment Mode name",
		 
	  }
		});
</script>
<script>
$("#add_contact_detail").validate({
	 rules: {
		  name: "required",
		  service_name: "required",
		  email: "required",
		  phone: "required",
		  
	  },
	  messages:{
		  name:"Please Enter Contact Person  name",
		  service_name:"Please Enter Service  name", 
		  email:"Please Enter contact email id",
		  phone:"Please Enter contact phone number", 
	  }
		});
</script>
<script>
$("#add_meal").validate({
	 rules: {
		  name: "required",
		  
	  },
	  messages:{
		  name:"Please Enter meal Name",
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