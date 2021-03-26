<script>
$(".hotel_search_button").click(function(){
	var data_error=0;
            $(".bp_hotel_search_validation").each(function () {
                if ($(this).val() == "")
                {   data_error=1;
                    $(this).css({"border": "2px solid red"});
                    window.scroll(0, 0)
                } else
                {
                    $(this).css({"border": ""});

                }
            });
	if(data_error == 0){
		$(".bp_hotel_search_loaction").text($("#country").val());
		$(".bp_hotel_check_in").text($("#bp_check_in_date").val());
		$(".bp_hotel_check_out").text($("#bp_check_out_date").val());
		$('#hotel_search_popup').modal('show'); 
		$("#hotel_search_form").submit();
	}else{
      return false;
	}

});


$(function () {
		
	
  $(".bp_hotel_info_find").click(function (e) {
            var data_apend = "";
            var data_error=0;
            $(".pax_validation_field").each(function () {
                if ($(this).val() == "")
                {   data_error=1;
					
                    $(this).css({"border": "2px solid red"});
                    window.scroll(0, 0);
					e.preventDefault();
                } else
                {
                    $(this).css({"border": ""});

                }
            });
	
	        if($("#terms").prop("checked") == false){
			       	data_error=1;
                    $("#terms").css({"outline": "2px solid red"});
                    $("#terms").parent().css({"color": "#ff0000"});
					e.preventDefault();
            }

			if($("#receiveemails").prop("checked") == false){
			       	data_error=1;
                    $("#receiveemails").css({"outline": "2px solid red"});
					e.preventDefault();
            }
			
			
			if($("#email_valid").val()!= ""){
			 var value = $("#email_valid").val();
			 if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(value))
			  {
				$("#err_mail_msg").hide(); 		
			  }
			  else{
				$("#email_valid").css({"border": "2px solid red"});
                    window.scroll(0, 0)
				$("#err_mail_msg").show();
				$("#err_mail_msg").text("You have entered an invalid email address!");
				data_error=1;
				e.preventDefault();
			  }
			
			}
          if(data_error == 0){
              $('#hotel_confirm_pop_up').modal('show');
              $('#id_from').submit();
          }
            
        });

});

$(function () {
		
	
  $(".bp_hotel_info_find1").click(function (e) {
            var data_apend = "";
            var data_error=0;
            $(".pax_validation_field").each(function () {
                if ($(this).val() == "")
                {   data_error=1;
					
                    $(this).css({"border": "2px solid red"});
                    window.scroll(0, 0);
					e.preventDefault();
                } else
                {
                    $(this).css({"border": ""});

                }
            });
	
	if($("#terms").prop("checked") == false){
			       	data_error=1;
                    $("#terms").css({"outline": "2px solid red"});
					e.preventDefault();
            }

			if($("#receiveemails").prop("checked") == false){
			       	data_error=1;
                    $("#receiveemails").css({"outline": "2px solid red"});
					e.preventDefault();
            }
			
			
			if($("#email_valid").val()!= ""){
			 var value = $("#email_valid").val();
			 if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(value))
			  {
				$("#err_mail_msg").hide(); 		
			  }
			  else{
				$("#email_valid").css({"border": "2px solid red"});
                    window.scroll(0, 0)
				$("#err_mail_msg").show();
				$("#err_mail_msg").text("You have entered an invalid email address!");
				data_error=1;
				e.preventDefault();
			  }
			
			}
          if(data_error == 0){
              $('#hotel_confirm_pop_up').modal('show');
              $('#id_from').submit();
          }
            
        });

});
</script>



<script type="text/javascript">
//------Hotel Check in date--------Start------------------
$(function(){
	  $( "#bp_check_in_date" ).datepicker({
		   numberOfMonths: 1,
           dayNamesMin: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
           "minDate": 0,
           showOn: 'both',
           buttonText: '',
           dateFormat: 'dd-mm-yy',
           beforeShow: function() 
             {
                $('#ui-datepicker-div').addClass("searchdatepicker");
                $('#depart_date_on_mobile').attr("name","");
             },
           onClose: function (selectedDate)
             {
               $("#bp_check_out_date").datepicker("option", "minDate", selectedDate);
             }
    });
	 $( "#bp_check_out_date" ).datepicker({
		 numberOfMonths: 1,
         dayNamesMin: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
         "minDate": 0,
         showOn: 'both',
         buttonText: '',
         dateFormat: 'dd-mm-yy',
         beforeShow: function() 
           {
             $('#ui-datepicker-div').addClass("searchdatepicker");
             $('#depart_date_on_mobile').attr("name","");
           },
    });
});
//------Hotel Check in date--------End------------------
</script>
<script>
$(".bp_room_select").click(function (){
	 $(".hotelguestsdetails").show();
});
$(".bp_room_select").change(function (){
	 $(".hotelguestsdetails").show();
	var bp_no_rooms = this.value;
	var bp_room_data = "";
	for(var i = 1; i <= bp_no_rooms; i++){
	  bp_room_data += '<div class="roombox clearfix">\
                         <span class="block fz16 fwb black-color">Room '+i+':</span>\
                         <div class="roomchildbox clearfix border-top">\
                           <div class="row mt15">\
                              <div class="col-sm-6">\
                                <span class="block mb10 black-color fz12">Adult(12+ Yrs)</span>\
                                  <select name="adult_'+i+'" id="adult_'+i+'" class="block width-100 border radius">\
                                    <option value="1">1 Adult</option>\
                                    <option value="2">2 Adults</option>\
                                    <option value="3">3 Adults</option>\
                                    <option value="4">4 Adults</option>\
									<option value="5">5 Adult</option>\
                                    <option value="6">6 Adults</option>\
                                    <option value="7">7 Adults</option>\
                                    <option value="8">8 Adults</option>\
                                  </select>\
                              </div>\
                              <div class="col-sm-6">\
                                 <span class="block mb10 black-color fz12">Child(2-11 Yrs)</span>\
                                 <select name="child_'+i+'" id="child_'+i+'" class="block width-100 border radius" onchange="return bp_child_age(this.value,'+i+');">\
                                    <option value="">0 Child</option>\
                                    <option value="1">1 Child</option>\
                                    <option value="2">2 Children</option>\
                                 </select>\
                              </div>\
                           </div>\
                        <div class="clearfix"></div>\
                        <div id="bp_for_child_dob_'+i+'"></div>\
                        </div>\
                      </div>';	 	
	
		}
	$(".bp_room_data").html(bp_room_data);
	});
</script>
<script>
	function bp_child_age(value, sect){
	if(value == ""){
	$("#bp_for_child_dob_"+sect).fadeOut(300);
		} else {
	$("#bp_for_child_dob_"+sect).fadeIn(300);
			}
	var bp_age_div_data = "";			
	bp_age_div_data +='<div class="row mt15">';
	for(var i = 1; i <= value; i++){
                        bp_age_div_data +='<div class="col-sm-6">\
                                                <span class="block mb10 black-color fz12">Child 1 Age</span>\
                                                <select name="age_'+sect+'_'+i+'" id="age_'+sect+'_'+i+'" class="block width-100 border radius">\
                                                    <option value="1">1 Year</option>\
                                                    <option value="2">2 Years</option>\
                                                    <option value="3">3 Years</option>\
                                                    <option value="4">4 Years</option>\
                                                    <option value="5">5 Years</option>\
                                                    <option value="6">6 Years</option>\
                                                    <option value="7">7 Years</option>\
                                                    <option value="8">8 Years</option>\
                                                    <option value="9">9 Years</option>\
                                                    <option value="10">10 Years</option>\
                                                    <option value="11">11 Years</option>\
                                                    <option value="12">12 Years</option>\
                                                </select>\
                                            </div>';
                                            }
                  bp_age_div_data +='</div>';			
    $("#bp_for_child_dob_"+sect).html(bp_age_div_data);
	
	}
</script>
<script>
function fill(thisValue,code) {
	var addvalue="";
    addvalue=thisValue;
	$('#country').val(addvalue);
	$('#cityDom').val(code);
	$("#country").removeAttr("data-validation");
	$('#suggestions').fadeOut();
}
function suggest(inputString) {
	if(inputString.length <3) {
			 $('#suggestions').fadeOut();	
		}
		else{	
			$('#country').addClass('load');	 
		    $.ajax({
            type: "POST",
            url: "<?php echo site_url();?>/hotel/fetch_city",
            data: {id: inputString},
            success: 
              function(data){
				  if(data.length >0) {
					$('#suggestions').fadeIn();
					$('#suggestionsList').html(data);
					$('#country').removeClass('load');
				}
              }
 });
	   }
   }
</script>
<script>
$("[bp-hotel-pax-cl-btn]").click(function(){
	$(".hotelguestsdetails").hide();
});
</script>
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
<script>
function confirm_pop_up(url){
	$('#delPollModal').modal('show');
	$('#deletePoll').click(function () {
	      window.location.href = url;
	    })
}
</script>