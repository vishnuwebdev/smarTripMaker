<script src="<?php echo site_url();?>assets/vendor/plugins/jquery_validation/dist/jquery.validate.js"></script>
<script src="<?php echo site_url();?>assets/js/vendor/daterangepicker/moment.min.js"></script>
<script src="<?php echo site_url();?>assets/js/vendor/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script>
    
   $(function () {
        $('#startdate').datetimepicker({
            format: 'L',
            minDate: moment(),
            format: 'DD/MM/YYYY'
        });
        $('#enddate').datetimepicker({
            format: 'L',
            minDate: moment(),
            format: 'DD/MM/YYYY'//Important! See issue #1075
        });
        $("#startdate").on("dp.change", function (e) {
            $('#enddate').data("DateTimePicker").minDate(e.date._d);
        });
        $("#enddate").on("dp.change", function (e) {
            
        });
    });
$("#coupenform").validate({
	  rules: {
		  coupon_amount:{
	         required: true,
                 number: true
		  },
                  coupon_use_limit:{
                    required: true,
                    number: true  
                  }
	  },
	  coupon_amount:{
		  coupon_amount:{
	          required:"Please enter valid amount",
		  },
                  coupon_use_limit:{
	          required:"Please enter Limit for Coupon",
                  number:"Please enter valid no"
		  }
		 
	  }
		});



</script>