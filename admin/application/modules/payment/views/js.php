<script src="<?php echo site_url(); ?>assets/vendor/plugins/jquery_validation/dist/jquery.validate.js"></script>
<script>
    $("#add_meal").validate({
        rules: {
            amount: "required",

        },
        messages: {
            amount: "Please Enter Amount",

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

</script>
