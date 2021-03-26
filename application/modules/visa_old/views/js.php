<script src="<?php echo site_url(); ?>assets/js/jquery-ui.min.js"></script>
<script src="<?php echo site_url(); ?>assets/js/custom.js"></script>


<script>



                    $(function () {
                        $('#depart_date').datepicker({
                            numberOfMonths: 2,
                            dayNamesMin: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
                            "minDate": 0,
                            showOn: 'both',
                            buttonText: '',
                            dateFormat: 'dd-mm-yy',
                            onClose: function (selectedDate)
                            {
                                $("#return_date").datepicker("option", "minDate", selectedDate);
                            }
                        });
                        $('#return_date').datepicker({
                            numberOfMonths: 2,
                            dayNamesMin: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
                            "minDate": 0,
                            showOn: 'both',
                            dateFormat: 'dd-mm-yy',
                            buttonText: '',
                        });

                    });

                    function getDate(element) {
                        var date;
                        try {
                            date = $.datepicker.parseDate(dateFormat, element.value);
                        } catch (error) {
                            date = null;
                        }

                        return date;
                    }




</script>

<script src="<?php echo site_url();?>assets/js/jquery.validate.min.js"></script>
<script>
$("#searchform").validate({
	  rules: {
		  from_location:{
	         required: true,
		  },
                  to_location:{
	         required: true,
		  },
                  depart_date:{
	         required: true,
		  }
	  },
	  from_location:{
		  balance:{
	          required:"Please select Airport first.",
		  }
		 
	  },
          to_location:{
		  balance:{
	          required:"Please select destination Airport first.",
		  }
		 
	  }
		});
                
                
 $("#register").validate({
	  rules: {
		  first_name:{
	         required: true,
		  },
                  last_name:{
	         required: true,
		  },
                  email_address:{
	         required: true,
		  },
                    mobile_no:{
	         required: true,
		  },
          terms:{
	         required: true,
		  },
            password:{
	         required: true,
                 minlength: 6
		  },
           
              password_confirmation:{
	          required: true,
                  equalTo: "#password",
                  minlength: 6
		  },
	  },
	  password:{
		  balance:{
	          required:"Please select Airport first.",
		  }
		 
	  },
          
		});

$("#forgot_pass").validate({
	  rules: {
            email:{
				required: true,
				// email:true;
              
		  },
                 
	  },
	 
          
		});
		
$("#reset_password").validate({
rules: {
	password:{
	 required: true,
		 minlength: 6
  },
		  password_confirmation:{
	  required: true,
		  equalTo: "#password",
		  minlength: 6
  },
},

  
});
</script>

<script type="text/javascript">
    $('#flightbtn').on('click', function () {
        // alert();
        var $btn = $(this).button('loading');
        // business logic...
        if ($('#searchform').validate()) {
            $btn.button('reset');
        }
    });



    $('#traveller').popover({
        "template": '<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
        "html": true,
        'content': '<div class="row reavellerrow"><div class="col-md-12"><p class="bp_for_pax_error_pre error"></p></div><div class="col-md-5"><p class="bp_adult_data">1 Adult</p></div><div class="col-md-7"><div class="btn-group btn-group-sm pull-right" role="group" aria-label="Large button group"> <button type="button" class="btn btn-default bp_adult_minus"><span class="glyphicon glyphicon-minus"></span></button><button type="button" class="btn btn-default bp_adult_plus"><span class="glyphicon glyphicon-plus"></span></button> \n\</div></div></div><div class="row reavellerrow"><div class="col-md-5"><p class="bp_child_data">0 child</p></div><div class="col-md-7"><div class="btn-group btn-group-sm pull-right" role="group" aria-label="Large button group"> <button type="button" class="btn btn-default bp_child_minus"><span class="glyphicon glyphicon-minus"></span></button><button type="button" class="btn btn-default bp_child_plus"><span class="glyphicon glyphicon-plus"></span></button> \n\</div></div></div><div class="row reavellerrow"><div class="col-md-5"><p class="bp_infant_data">0 Infant</p></div><div class="col-md-7"><div class="btn-group btn-group-sm pull-right" role="group" aria-label="Large button group"> <button type="button" class="btn btn-default bp_infant_minus"><span class="glyphicon glyphicon-minus"></span></button><button type="button" class="btn btn-default bp_infant_plus"><span class="glyphicon glyphicon-plus"></span></button> \n\</div></div></div><div class="row reavellerrow-end"><div class="col-md-12"><button type="button" class="btn btn-md btn-success pull-right closepopover">done</div></div>'
    });

    $('#class_stops').popover({
        "template": '<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
        "html": true,
        'content': '<div class="row classandstoprow"><div class="col-md-12"><p><input type="radio" value="1" aria-label=""> All</p></div><div class="col-md-12"><p><input type="radio" value="2" aria-label=""> Economy</p></div><div class="col-md-12"><p><input type="radio" value="3" aria-label=""> PremiumEconomy</p></div><div class="col-md-12"><p><input type="radio" value="4" aria-label=""> Business</p></div><div class="col-md-12"><p><input type="radio" aria-label="" value="5"> PremiumBusiness</p></div><div class="col-md-12"><p><input type="radio" value="6" aria-label=""> First Class</p></div></div>\n\
        <label>Stop</label><div class="row classandstoprow-end"><div class="col-md-12 checkbox"><label class="checkbox" style="width:100%"><input type="checkbox" value="1" for="Direct Flight" label="Direct Flight"> Direct Flight</label></div>\n\
<div class="col-md-12"><button type="button" class="btn btn-md btn-success pull-right closepopover">done</div></div>'
    });

    $('body').on('click', function (e) {
        //did not click a popover toggle or popover
        if ($(e.target).data('toggle') !== 'popover'
                && $(e.target).parents('.popover.in').length === 0) {
            $('#traveller').popover('hide');
            $('#class_stops').popover('hide');
        }
    });

    $(document).on("click", ".closepopover", function (e) {

        //did not click a popover toggle or popover


        $('#class_stops').popover('hide');
        $('#traveller').popover('hide');

    });



</script>
<script>
    $(document).on("click", ".bp_adult_plus", function (e) {
        var adult = Number($(".bp_no_adult").val());
        var child = Number($(".bp_no_child").val());
        var infant = Number($(".bp_no_infant").val());
        var total_count = adult + child + infant;
        if (adult > 8) {
            $(".bp_for_pax_error_pre").html("Can not select more then 9 Pax");
          //  $(".bp_adult_plus").attr("disabled", "disabled")
        } else {
            if (total_count > 8) {
                var for_infant_data = "0 Inafnt";
                $(".bp_infant_data").html(for_infant_data);
                $(".bp_no_infant").val("0");
                var for_child_data = "0 Child";
                $(".bp_child_data").html(for_child_data);
                $(".bp_no_child").val("0");
                adult = adult + 1;
                var for_adult_data = adult + " Adult";
                $(".bp_adult_data").html(for_adult_data);
                $(".bp_no_adult").val(adult);
            } else {
                adult = adult + 1;
                var for_adult_data = adult + " Adult";
                $(".bp_adult_data").html(for_adult_data);
                $(".bp_no_adult").val(adult);
            }
            $(".bp_for_pax_error_pre").html("");
        }
        var bp_traveller_data = adult + " Adult," + child + " Child," + infant + " Infant";
        $(".bp_traveller_data").val(bp_traveller_data);
    });
    $(document).on("click", ".bp_adult_minus", function (e) {
        var adult = Number($(".bp_no_adult").val());
        var child = Number($(".bp_no_child").val());
        var infant = Number($(".bp_no_infant").val());
        if (adult > 1) {
            $(".bp_for_pax_error_pre").html("");
            if (infant > adult) {
                var for_infant_data = "0 Inafnt";
                $(".bp_infant_data").html(for_infant_data);
                $(".bp_no_infant").val("0");
            }
            adult = adult - 1;
            var for_adult_data = adult + " Adult";
            $(".bp_adult_data").html(for_adult_data);
            $(".bp_no_adult").val(adult);
        }
        var bp_traveller_data = adult + " Adult," + child + " Child," + infant + " Infant";
        $(".bp_traveller_data").val(bp_traveller_data);
    });
</script>
<script>
    $(document).on("click", ".bp_child_plus", function (e) {
        var adult = Number($(".bp_no_adult").val());
        var child = Number($(".bp_no_child").val());
        var infant = Number($(".bp_no_infant").val());
        var total_count = adult + child + infant;
        if (total_count > 8) {
            $(".bp_for_pax_error_pre").html("Can not select more then 9 Pax");
        } else {
            child = child + 1;
            var for_child_data = child + " Child";
            $(".bp_child_data").html(for_child_data);
            $(".bp_no_child").val(child);
            $(".bp_for_pax_error_pre").html("");
        }
        var bp_traveller_data = adult + " Adult," + child + " Child," + infant + " Infant";
        $(".bp_traveller_data").val(bp_traveller_data);
    });
    $(document).on("click", ".bp_child_minus", function (e) {
        var adult = Number($(".bp_no_adult").val());
        var child = Number($(".bp_no_child").val());
        var infant = Number($(".bp_no_infant").val());
        var total_count = adult + child;
        if (child > 0) {
            child = child - 1;
            $(".bp_no_child").val(child);
            var for_child_data = child + " Child";
            $(".bp_child_data").html(for_child_data);
            $(".bp_for_pax_error_pre").html("");
        }
        $(".bp_for_pax_error_pre").html("");
        var bp_traveller_data = adult + " Adult," + child + " Child," + infant + " Infant";
        $(".bp_traveller_data").val(bp_traveller_data);
    });
</script>
<script>
    $(document).on("click", ".bp_infant_plus", function (e) {
        var adult = Number($(".bp_no_adult").val());
        var child = Number($(".bp_no_child").val());
        var infant = Number($(".bp_no_infant").val());
        var total_count = adult + child + infant;
        if (total_count > 8) {
            $(".bp_for_pax_error_pre").html("Can not select more then 9 Pax");
        } else {
        if (infant >= adult) {
            $(".bp_for_pax_error_pre").html("Cannot select infant more than adult");
        } else {
            infant = infant + 1;
            var for_infant_data = infant + " Infant";
            $(".bp_infant_data").html(for_infant_data);
            $(".bp_no_infant").val(infant);
            $(".bp_for_pax_error_pre").html("");
        }
    }
        var bp_traveller_data = adult + " Adult," + child + " Child," + infant + " Infant";
        $(".bp_traveller_data").val(bp_traveller_data);
    });
    $(document).on("click", ".bp_infant_minus", function (e) {
        var adult = Number($(".bp_no_adult").val());
        var child = Number($(".bp_no_child").val());
        var infant = Number($(".bp_no_infant").val());
            if (infant > 0) {
                infant = infant - 1;
                $(".bp_no_infant").val(infant);
                var for_infant_data = infant + " Infant";
                $(".bp_infant_data").html(for_infant_data);
            }
            $(".bp_for_pax_error_pre").html("");
        var bp_traveller_data = adult + " Adult," + child + " Child," + infant + " Infant";
        $(".bp_traveller_data").val(bp_traveller_data);
    });
</script>