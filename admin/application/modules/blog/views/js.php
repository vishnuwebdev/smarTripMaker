<script src="<?php echo site_url();?>assets/vendor/plugins/jquery_validation/dist/jquery.validate.js"></script>
<script>
$("#add_blog_category").validate({
	  rules: {
		  category_name:{
	         required: true,
		  }
	  },
	  category_name:{
		  balance:{
	          required:"Please enter category name",
		  }
		 
	  }
		});


function addidfordelete(url){

	$('#delPollModal').modal('show');
	$('#deletePoll').click(function () {
	      // similar behavior as clicking on a link
	      window.location.href = url;
	    })
}
</script>