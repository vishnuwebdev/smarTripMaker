<script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>

<!--========NEW SCRIPTS=============-->
<script>

function getFareRulepoonam(traceID, resultIndex,id) {

var data = {traceID: traceID, resultIndex: resultIndex};
$.ajax({
    type: "POST",
    url: "<?php echo site_url(); ?>flight/fare_rule",
    data: data,
    dataType: "text",
    cache: false,
    beforeSend: function () {
        // setting a timeout
        $("#loadfarerule1").html('<div class="text-align-center">' +
                '<img style="max-width:100px; margin:0px auto;" src="<?php echo site_url(); ?>assets/images/loading.gif">' +
                '</div>')
    },
    success: function (data) {      

        var parsed_result = JSON.parse(data);
		console.log(parsed_result);
		
		var result = (parsed_result.Response.FareRules[0].FareRuleDetail).split('============================================================');
        // console.log(result);
        var html = "";
        for (i = 0; i < result.length; i++) {
            if (i == 0) {
                html += "<h5>" + result[i] + "</h5>";

            } else {
                var result2 = (result[i]).split('-------------------------------------------------------------------------------------');
                if (result2[1] == undefined) {
                    html += "<p>" + result2[0] + "</p>";
                } else {
                    html += "<h5>" + result2[0] + "</h5>";
                    html += "<p>" + result2[1] + "</p>"
                }
            }
        }
 // console.log(html);
        $('#loadfarerule' + id).html(html);
	}
});
}

//BOOK NOW


function book_now(traceID, resultIndex, sessionID){ 

        $('#confirmprice').modal({backdrop: 'static'});
        $("#confirmprice").modal("show");
        var formD = $(this).attr("faresno");
        var flightType = $(this).attr("flighttype");
        $.ajax({
            type: "POST",

            url: "<?php echo site_url(); ?>flight/confirm_fare",

            data: {traceID: traceID, resultIndex: resultIndex, sessionID: sessionID},

            dataType: "text",

            cache: false,

            success:

                    function (data) {
                        console.log(data);
                       $("#confirmprice").modal("hide");
                        if (data == "true") {
                            location.href = "<?php echo site_url(); ?>/flight/booking_detail?seesionid=" + sessionID;

                        } else {
						   $("#confirmerror").modal("show");
                        }

                    }

        });

        return false;

    }

</script>

<!--29-04-2019-->
<script>
// from Validation

    $("#flight-form").validate({
        rules: {
            from_location: {
                required: true,
            },
            to_location: {
                required: true,
            },
            depart_date: {
                required: true,
				},
				 return_date: {
                    required: {
                        depends: function (element) {
						return $("#round-rad").hasClass('active');
                           //return $("#round-trip").prop("checked", true);
                        }
                    }
                }
        },
        from_location: {
            balance: {
                required: "Please select Airport first.",
            }
        },
        to_location: {
            balance: {
                required: "Please select destination Airport first.",
            }
        }

    });

	// autocomplete



function flight_suggest(inputString,id) {

$( ".flight_from"+id ).autocomplete({
	
    autoFocus: true,	

    minLength : 2,

    source : function(request, response) {

    $.ajax({

        type: "POST",

        url: "<?php echo site_url() ?>front/fetch_city",

        dataType : "json",

        cache : false,

        data: {id: inputString,div_id:id},

        success: 

        function(data){

		console.log(data);
            var all_l=[];

            for(var i=0;i<data.length;i++)

            {
                var city_name=data[i].airport_city_name; 

                var air_name=data[i].airport_name; 

                var air_code=data[i].airport_code;

                var air_country_code=data[i].airport_country_code; 

                var air_city_code = data[i].airport_city_code;

                all_l.push({ "label": city_name+" ("+air_name+"), "+air_code, "value": city_name+" ("+air_name+"), "+air_code, "country": air_country_code,"city": air_city_code } );



            }

                response(all_l);

        }	

    });	  

    

},

select: function(event, ui) {

    $( "#flight_from_country"+id).val(ui.item.country);	

    $( "#flight_from_city"+id).val(ui.item.city);	

    $( ".flight_from_to"+id).focus();	

},

});    

    

}



function flight_suggest_to(inputString,id) {

    $( ".flight_from_to"+id ).autocomplete({

    autoFocus: true,	

    minLength : 2,

    source : function(request, response) {

     $.ajax({

        type: "POST",

        url: "<?php echo site_url() ?>/front/fetch_city",

        dataType : "json",

        cache : false,

        data: {id: inputString,div_id:id},

        success: 

          function(data){

              var all_l=[];

            for(var i=0;i<data.length;i++)

            {

                var city_name=data[i].airport_city_name; 

                var air_name=data[i].airport_name; 

                var air_code=data[i].airport_code;

                var air_country_code=data[i].airport_country_code; 

                var air_city_code = data[i].airport_city_code;

                all_l.push({ "label": city_name+" ("+air_name+"), "+air_code, "value": city_name+" ("+air_name+"), "+air_code, "country": air_country_code,"city": air_city_code } );



            }

            response(all_l);

        }	

    });	  

    

},

select: function(event, ui) {



$( "#flight_from_to_country"+id ).val(ui.item.country);	

$( "#flight_from_to_city"+id ).val(ui.item.city);	

$( "#depart_date" ).focus();

    

},

});    



     

}


// search from submit and  Modal open

$("#flightbtnsearch").click(function(){
	
    if($("#flight-form").valid() == true){

       // if($('#one-way').is(':checked')) { 
	   
	   if($('#one-way-rad').hasClass('active')){

		$(".return_m").hide();

		$(".return_m_d").hide();	

		$(".oneway_m").show();
		
			
		$(".from_location_m").text($(".flight_from0").val());
		$(".to_location_m").text($(".flight_from_to0").val());	
		
		$(".depart_date_m").text($("#depart_date").val());		
		$(".return_date_m").text($("#return_date").val());
		$(".num_adult").text($(".adult_select").val());
		$(".num_child").text($(".child_select").val());
		$(".num_infant").text($(".infent_select").val());


	}  else {
		$(".oneway_m").hide();  
		$(".return_m").show();
		$(".return_m_d").show();
		
        $(".from_location_m").text($(".flight_from0").val());
        $(".to_location_m").text($(".flight_from_to0").val());
        $(".depart_date_m").text($("#depart_date").val());
        $(".return_date_m").text($("#return_date").val());  
        $(".num_adult").text($(".adult_select").val());
        $(".num_child").text($(".child_select").val());
        $(".num_infant").text($(".infent_select").val());

        
  }
    $("#searchingpopup").modal("show");

    $("#myModal").modal("hide");
	$("#modify-search").modal("hide");

    }
    $("#flight-form").submit();

});

//Multicity Form submit

$("#flightbtnsearch1").click(function(){
	
    if($("#searchform_multi").valid() == true){
		
		$(".return_m").hide();
        $(".return_m_d").hide();
        $(".oneway_m").show();       
        $(".depart_date_m").text($("#ft-date1_multicity").val());   

        if($('.flight_from_to4').val() != "")  
        {
           var to_loc = $('.flight_from_to4').val();
        } else if($('.flight_from_to3').val() != "")
        { 
            var to_loc = $('.flight_from_to3').val();

        } else 
        {
            var to_loc = $('.flight_from_to2').val();
        } 

        var from_loc = $('.flight_from1').val();
       
        $(".from_location_m").text(from_loc);
        $(".to_location_m").text(to_loc);
		$(".num_adult").text($(".adult_select1").val());
		$(".num_child").text($(".child_select1").val());
		$(".num_infant").text($(".infent_select1").val());

        
  
    $("#searchingpopup").modal("show");

    $("#myModal").modal("hide");
	$("#modify-search").modal("hide");
	$("#searchform_multi").submit();
    }
   

});


$(function(){
	
$(".adult_select").change(function(){
    var a=Number($(this).val());
    var b=Number($(".child_select").val());
    var c=Number($(".infent_select").val());
    //alert(b);
    var tot=a+b+c;
    var for_b_val=9-a;
    var b_val="";
    var c_val="";
    var i=0;
    
    //for b ...................
    if(tot>9)
    {
        for(i=0;i<=for_b_val;i++)
        {
           b_val+= '<option val="'+i+'">'+i+'</option>';
        }
        $(".child_select").html(b_val);
        $(".child_select").val(0);
        $(".child_span span").html(0);

        $(".infent_select").html(c_val);
        $(".infent_select").val(0);
        $(".infant_span span").html(0);
    }
    else
    {
        for(i=0;i<=for_b_val;i++)
        {
           b_val+= '<option val="'+i+'">'+i+'</option>';
        }
        $(".child_select").html(b_val);
        $(".child_select").val(b);
        $(".child_span span").html(b);

        $(".infent_select").html(c_val);
        $(".infent_select").val(0);
        $(".infant_span span").html(0);
    }
    //.......................
    
    //for a...................
    if((a + b) > 4)
    {
        for(i=0;i<=9-a;i++)
        {
           c_val+= '<option val="'+i+'">'+i+'</option>';
        }
        $(".infent_select").html(c_val);
        $(".infent_select").val(0);
        $(".infant_span span").html(0);
    }
    else
    {
        for(i=0;i<=a;i++)
        {
           c_val+= '<option val="'+i+'">'+i+'</option>';
        }
        $(".infent_select").html(c_val);
        $(".infent_select").val(c);
        $(".infant_span span").html(c);
    }
    
    //........................
    
});

 $(".child_select").change(function(){
    var b_val="";
    var c_val="";
    var a=Number($(".adult_select").val());
    var b=Number($(this).val());
    var c=Number($(".infent_select").val());
    if((a+b) <= 9)
    {
        if(a >= 4){
            for(i=0;i<=9-(a+b);i++)
        {
           c_val+= '<option val="'+i+'">'+i+'</option>';
        }
        $(".infent_select").html(c_val);
        $(".infent_select").val(0);
        $(".infant_span span").html(0);

        }else{

        
        for(i=0;i<=9 - (a+b);i++)
        {
           c_val+= '<option val="'+i+'">'+i+'</option>';
        }
        $(".infent_select").html(c_val);
        $(".infent_select").val(0);
        $(".infant_span span").html(0);
        }
    }
    else
    {
        for(i=0;i<=a-(b+c);i++)
        {
           c_val+= '<option val="'+i+'">'+i+'</option>';
        }
        $(".infent_select").html(c_val);
        $(".infent_select").val(c);
        $(".infant_span span").html(c);
    }
    
 });
});


$("#searchform_multi").validate({

    });
	
</script>



<!--====================-->


<script>
$(document).ready(function()
        {
           $('.refendable11').sort(function (a, b)
              {
                  return $(a).find('.price1').data('price') - $(b).find('.price1').data('price');
              }).each(function (_, refendable11)
              {
                   $(refendable11).parent().append(refendable11);
              });
        });
</script>

<script>    

$(function () {

	$('#depart_date').datepicker({

		numberOfMonths: 1,

		dayNamesMin: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],

		"minDate": 0,

		showOn: 'both',

		buttonText: '',

		dateFormat: 'dd-mm-yy',

		beforeShow: function() {          

		},

		onSelect: function (selectedDate)

		{   
			$('#ui-datepicker-div').addClass("searchdatepicker");
			$("#return_date").datepicker("option", "minDate", selectedDate);

		}

	});

	$('#return_date').datepicker({

		numberOfMonths: 1,

		dayNamesMin: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],

		"minDate": "<?php echo $this->input->get("depart_date"); ?>",

		showOn: 'both',

		dateFormat: 'dd-mm-yy',

		buttonText: '',

		beforeShow:function(){  

			
			$('#ui-datepicker-div').addClass("searchdatepicker");
			$('#returnid').prop("checked", true);

			$('#onwayid').prop("checked", false);

			$('#return_datebox').css("opacity","1");
			
		}

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

	$("#searchform").validate({
            rules: {
                from_location: {
                    required: true,
                },
                to_location: {
                    required: true
                },
                depart_date: {
                    required: true,
                }
            }
        });
		
		
$("#search_flight_c").click(function(e){
	

	var data_error=0;
	
            if ($("#searchform").valid() == false) 
                {   data_error=1;
                    $(this).css({"border": "2px solid red"});
                    window.scroll(0, 0)
                } else
                {
                    $(this).css({"border": ""});

                }
           
    if(data_error == 0){
		var depart_date = $("#depart_date").val();
		var depart_date_on_mobile = $("#depart_date_on_mobile").val();
		if(depart_date){
		$("#depart_date_on_mobile").val(depart_date);
		}else{
			$("#depart_date").val(depart_date_on_mobile);
		}
		
		$("#searchform").submit();
        $(".return_m").hide();
        $(".return_m_d").hide();
        $(".oneway_m").show();
        $(".from_location_m").text($(".flight_from0").val().split(" ",1));
        $(".to_location_m").text($(".flight_from_to0").val().split(" ",1));
        $(".depart_date_m").text($("#depart_date").val());
        $(".c_adult").hide();
        $("#searchingpopup").modal("show");
		}else{
       e.preventDefault();
    }
});


  

  $(function(){

    $(".adult_select").change(function(){

        var a=Number($(this).val());

        var b=Number($(".child_select").val());

        var c=Number($(".infant_select").val());

        //alert(b);

        var tot=a+b+c;

        var for_b_val=9-a;

        var b_val="";

        var c_val="";

        var i=0;

        

        //for b ...................

        if(tot>9)

        {

            for(i=0;i<=for_b_val;i++)

            {

               b_val+= '<option val="'+i+'">'+i+'</option>';

            }

                $(".child_select").html(b_val);

                $(".child_select").val(0);

                $(".infant_select").html(c_val);

                $(".infant_select").val(0);

        }

        else

        {

            for(i=0;i<=for_b_val;i++)

            {

               b_val+= '<option val="'+i+'">'+i+'</option>';

            }

            $(".child_select").html(b_val);

            $(".child_select").val(b);

            $(".infant_select").html(c_val);

            $(".infant_select").val(0);

            

        }

        //.......................

        

        //for a...................

        if((a + b) > 4)

        {

            for(i=0;i<=9-a;i++)

            {

               c_val+= '<option val="'+i+'">'+i+'</option>';

            }

            $(".infant_select").html(c_val);

            $(".infant_select").val(0);

           

        }

        else

        {

            for(i=0;i<=a;i++)

            {

               c_val+= '<option val="'+i+'">'+i+'</option>';

            }

            $(".infant_select").html(c_val);

            $(".infant_select").val(c);

        }

 

    });



     $(".child_select").change(function(){

        var b_val="";

        var c_val="";

        var a=Number($(".adult_select").val());

        var b=Number($(this).val());

        var c=Number($(".infant_select").val());

        if((a+b) <= 9)

        {

            if(a >= 4){

                for(i=0;i<=9-(a+b);i++)

            {

               c_val+= '<option val="'+i+'">'+i+'</option>';

            }

            $(".infant_select").html(c_val);

            $(".infant_select").val(0);

        

            }else{

            for(i=0;i<=9 - (a+b);i++)

            {

               c_val+= '<option val="'+i+'">'+i+'</option>';

            }

            $(".infant_select").html(c_val);

            $(".infant_select").val(c);

            }

        }

        else

        {

            for(i=0;i<=a-(b+c);i++)

            {

               c_val+= '<option val="'+i+'">'+i+'</option>';

            }

          

            $(".infant_select").html(c_val);

        	$(".infant_select").val(c);

        }

        

     });

    

});




  $(function () {

        $(".pax_validation_continue").click(function () {

            var error_msg = "";

            var data_apend = "";

            $(".pax_validation_field").each(function () {

                if ($(this).val() == "")
                {
                    error_msg = error_msg + "<div class='alert alert-danger bs-callout-danger' role='alert' style='background-color: #EB411A;color:#FFFFFF'>" + $(this).attr("error_msg") + "</div> ";

                    $(this).css({"border": "2px solid red"});
                    window.scroll(0, 0)

                } else

                {
                    $(this).css({"border": ""});
                }

            });
			
			if($('#accept-pol').is(':checked')) { 

              $(this).css({"border": ""});
			  $('.accept').css({"color": "black"});
            }
			
			else
			{
				 error_msg = error_msg + "<div class='alert alert-danger bs-callout-danger' role='alert' style='background-color: #EB411A;color:#FFFFFF'>" + $(this).attr("error_msg") + "</div> ";
                    $(this).css({"border": "2px solid red"});
                    window.scroll(0, 0)
				$('.accept').css({"color": "#ff0000"});
				
			}

            if (error_msg != "")

            {

                $(".alert_for_error_msg").show();

                $(".alert_for_error_msg").html(error_msg);

                return false;

            } else

            {

                $(".alert_for_error_msg").hide();

                $(".alert_for_error_msg").html(error_msg);

               

                $(".for_pop_data").each(function () {

                    if ($(this).attr("forend") == "0")

                    {

                        data_apend += '<p class="fn mb-0">';

                    }

					

                    data_apend += $(this).val() + " ";

                    if ($(this).attr("forend") == "2")

                    {

                        data_apend += "</p>";

                    }

                });

                $(".email_confirm").html('<b class="fn">Email: ' + '</b>' + $(".for_email_confirm").val() );

                $(".contact_confirm").html('<b class="fn">Mobile No:  ' + '</b>' + $(".for_contact_confirm").val() );

                $(".pax_data_apend").html(data_apend);                

                $('#Modal_for_confirm').modal('show');
                return true;

            }

        });

    });

	



    function select_airline(faretypeval, searchID, fareprice, resultindex) {

        var indexID = null;

        var farepriceOB = 0;

        var farepriceIB = 0;

        var totalprice = 0;

        var faretype = faretypeval;

        var searchID = searchID;

        var srdvindexOB = null;

        var resultindexOB = null;

        var srdvindexIB = null;

        var resultindexIB = null;





        if (faretype == "OB")

        {



            farepriceOB = fareprice;

            indexID = 0;

            // srdvindexOB = srdvindex;

            resultindexOB = resultindex;

            $('#returnBookingbtn').attr('srdvindexob', srdvindexOB);

            $('#returnBookingbtn').attr('resultindexob', resultindexOB);



        }



        if (faretype == "IB") {



            farepriceIB = fareprice;

            indexID = 0;

            // srdvindexIB = srdvindex;

            resultindexIB = resultindex;

            $('#returnBookingbtn').attr('srdvindexib', srdvindexIB);

            $('#returnBookingbtn').attr('resultindexib', resultindexIB);

        }

        totalprice = Math.round(parseFloat(farepriceIB) + parseFloat(farepriceOB));

    }





   $(function () {
	   
        var indexID = null;

        var farepriceOB = $('#selectonword_0').attr('fareprice');

        var farepriceIB = $('#selectreturn_0').attr('fareprice');

        var totalprice = 0;

        var srdvindexOB = null;

        var resultindexOB = null;

        var srdvindexIB = null;

        var resultindexIB = null;

        $(".selectairline").click(function () {



            var faretype = $(this).attr('faretype');

            var searchID = $(this).attr('searchID');

            var srdvindex = $(this).attr('srdvindex');

            var resultindex = $(this).attr('resultindex');

            console.log($(this).attr('resultindex'));



            if (faretype == "OB")

            {



                farepriceOB = $(this).attr('fareprice');



                indexID = $(this).attr('flightindex');

                if (indexID != $("#selectreturn_0").attr('flightindex')) {

                    $("#selectonword_0").attr('selectedair', "");

                    // $("#selectreturn_0").attr('selectedair',"");

                }



                srdvindexOB = srdvindex;

                resultindexOB = resultindex;

                $('#returnBookingbtn').attr('srdvindexob', srdvindexOB);

                $('#returnBookingbtn').attr('resultindexob', resultindexOB);



            }



            if (faretype == "IB") {





                farepriceIB = $(this).attr('fareprice');



                indexID = $(this).attr('flightindex');

                if (indexID != $("#selectonword_0").attr('flightindex')) {

                    $("#selectreturn_0").attr('selectedair', "");

                    //$("#selectonword_0").attr('selectedair',"");

                }

                srdvindexIB = srdvindex;

                resultindexIB = resultindex;

                $('#returnBookingbtn').attr('srdvindexib', srdvindexIB);

                $('#returnBookingbtn').attr('resultindexib', resultindexIB);

            }





            totalprice = Math.round(parseFloat(farepriceIB) + parseFloat(farepriceOB));

            $(".selectairline").each(function () {

                if ($(this).attr('faretype') == faretype)

                {

                    $(this).removeClass("row-areline-selected");

                }

            });

            $(this).addClass("row-areline-selected");

            if (indexID !== null || faretype !== null) {



                var data = {faretype: faretype, sessionID: searchID, flightIndexID: indexID};

                $.ajax({

                    type: "POST",

                    url: "<?php echo site_url(); ?>/flight/return_dom_selected_airline",

                    data: data,

                    dataType: "text",

                    cache: false,

                    success: function (data) {

                        // alert(faretype);	
						console.log(data);

                        if (faretype == "OB") {
						console.log(data);
                            $("#bookingstripviewOB").html(data);
							

                        } else {

                            $("#bookingstripviewIB").html(data);

                        }

                        $('#price_anim').html(totalprice);

                        // $("#fareSec").slideDown(1000, "swing");

                        // $("#fareSec").slideDown("slow");

                        call_animate(); /* Prabeen 29/01/2016*/

                        // $("#submitBooking").attr("param", obselval + "_" + ibselval);

                    }

                });

            }

        });

    });



    function select_airline(faretypeval, searchID, fareprice, resultindex) {

        var indexID = null;

        var farepriceOB = 0;

        var farepriceIB = 0;

        var totalprice = 0;

        var faretype = faretypeval;

        var searchID = searchID;

        var srdvindexOB = null;

        var resultindexOB = null;

        var srdvindexIB = null;

        var resultindexIB = null;









        if (faretype == "OB")

        {



            farepriceOB = fareprice;

            indexID = 0;

            // srdvindexOB = srdvindex;

            resultindexOB = resultindex;

            $('#returnBookingbtn').attr('srdvindexob', srdvindexOB);

            $('#returnBookingbtn').attr('resultindexob', resultindexOB);



        }



        if (faretype == "IB") {



            farepriceIB = fareprice;

            indexID = 0;

            // srdvindexIB = srdvindex;

            resultindexIB = resultindex;

            $('#returnBookingbtn').attr('srdvindexib', srdvindexIB);

            $('#returnBookingbtn').attr('resultindexib', resultindexIB);

        }

        totalprice = Math.round(parseFloat(farepriceIB) + parseFloat(farepriceOB));

        $(".selectairline").each(function () {

            if (faretypeval == faretype)

            {

                $(".select_0").removeClass("row-areline-selected");

            }

        });

        $(".select_0").addClass("row-areline-selected");

        if (indexID !== null || faretype !== null) {



            var data = {faretype: faretype, sessionID: searchID, flightIndexID: indexID};

            $.ajax({

                type: "POST",

                url: "<?php echo site_url(); ?>flight/return_dom_selected_airline",

                data: data,

                dataType: "text",

                cache: false,

                success: function (data) {

                    // alert(faretype);	

                    if (faretype == "OB") {

                        $("#bookingstripviewOB").html(data);

                    } else {

                        $("#bookingstripviewIB").html(data);

                        call_animate();

                    }

                 

                }

            });

        }



    }



 

$(function () {

	$(".title_auto_fill").change(function () {
	   
		var title_value = $(this).val();

		var name = $(this).attr("key_unique");

		$(".gender_auto_fill").each(function () {

			if ($(this).attr("key_unique") == name)

			{

				if (title_value != "")

				{

					if (title_value == "Mr" || title_value == "Mstr")

					{

						$(this).val("Male");

					} else

					{

						$(this).val("Female");

					}

				} else

				{

					$(this).val("");

				}

			}

		});



	});

});



    function call_animate() {

        $('#price_anim').counterUp({

            delay: 1,

            time: 100

        });

    }







$( ".pax_Adult_dob" ).datepicker({

	        dateFormat: 'dd-mm-yy',

			changeMonth: true,

			changeYear: true,

			yearRange: "-68:-12",
			
			minDate:"-68y",

            maxDate:"-12y",

			

			

});

$( ".pax_Child_dob" ).datepicker({

			dateFormat: 'dd-mm-yy',

			changeMonth: true,

			changeYear: true,

			yearRange: "-12:-2",

			minDate:"-12y",

            maxDate:"-2y",

			

});



$( ".pax_Infant_dob" ).datepicker({

			dateFormat: 'dd-mm-yy',

			changeMonth: true,

			changeYear: true,

			yearRange: "-2:+0",

			maxDate:"-1",

			minDate:"-2y"

			

});





 











</script>















<script>

$("#submit_btn").click(function(){

   

	var data_error=0;

    var validation_class="";



			if($('#returnid').is(':checked')) { 

                if($("#return_date").val() == ""){

                    data_error=1;

                    $("#return_date").css({"border": "2px solid red"});

                    validation_class=".pax_validation_field";

                }

            }



			if($('#onwayid').is(':checked')) { 

                $("#return_date").css({"border": ""});

                validation_class=".pax_validation_field";

             }



            if($('#MultiWayid').is(':checked')) { 

                validation_class=".pax_validation_field_multi";

            }



            $(validation_class).each(function () {

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

    

 

		if($('#onwayid').is(':checked')) {

			$(".return_m").hide();

			$(".return_m_d").hide();

			$(".oneway_m").show();

            $(".from_location_m").text($("#flight_from0").val().split(" ",1));

            $(".to_location_m").text($("#flight_from_to0").val().split(" ",1));

            $(".depart_date_m").text($("#depart_date").val());

		}



		if($('#returnid').is(':checked')) { 

	    	$(".oneway_m").hide();

	    	$(".return_m").show();

			$(".return_m_d").show();

            $(".from_location_m").text($("#flight_from0").val().split(" ",1));

            $(".to_location_m").text($("#flight_from_to0").val().split(" ",1));

            $(".depart_date_m").text($("#depart_date").val());

			$(".return_date_m").text($("#return_date").val());

		}



		if($('#MultiWayid').is(':checked')) { 

           $(".return_m").hide();

           $(".return_m_d").hide();

           $(".oneway_m").show();



           $(".from_location_m").text($("#flight_from1").val().split(" ",1));

           $(".depart_date_m").text($("#city1").val());

           

           if($("#flight_from_to2").val() != ""){ 

                $(".to_location_m").text($("#flight_from_to2").val().split(" ",1));

           }



            if($("#flight_from_to3").val()){ 

                $(".to_location_m").text($("#flight_from_to3").val().split(" ",1));

            }



            if($("#flight_from_to4").val()){ 

                $(".to_location_m").text($("#flight_from_to4").val().split(" ",1));

            }

        }

      

		$(".num_adult").text($(".adult_select").val());

		$(".num_child").text($(".child_select").val());

		$(".num_infant").text($(".infant_select").val());

		

		$("#modify_search").modal('hide');

		$("#searchingpopup").modal({

			backdrop: "static"

		});

		

		

    	$("#search_form").submit();

	}



});

    



function getFareRule(srdvType, srdvIndex, traceID, resultIndex) {



$('#farerule').modal('show')

var data = {srdvType: srdvType, srdvIndex: srdvIndex, traceID: traceID, resultIndex: resultIndex};

$.ajax({

    type: "POST",

    url: "<?php echo site_url(); ?>flight/getfarerule",

    data: data,

    dataType: "text",

    cache: false,

    beforeSend: function () {

        // setting a timeout

        $("#loadfarerule").html('<div class="text-align-center">' +

                '<img style="max-width:100px; margin:0px auto;" src="<?php echo site_url(); ?>assets/images/waiting5.gif">' +

                '</div>')

    },

    success: function (data) {

        // alert(faretype);

        var parsed_result = JSON.parse(data);



        console.log(parsed_result.Results[0].FareRuleDetail);

        var result = (parsed_result.Results[0].FareRuleDetail).split('============================================================');

        console.log(result);

        var html = "";

        for (i = 0; i < result.length; i++) {

            if (i == 0) {



                html += "<h5>" + result[i] + "</h5>";

            } else {

                var result2 = (result[i]).split('-------------------------------------------------------------------------------------');

                if (result2[1] == undefined) {

                    html += "<p>" + result2[0] + "</p>";

                } else {



                    html += "<h5>" + result2[0] + "</h5>";

                    html += "<p>" + result2[1] + "</p>"

                }

            }

        }

        $('#loadfarerule').html(html);





        // $("#fareSec").slideDown(1000, "swing");

        // $("#fareSec").slideDown("slow");

        /* Prabeen 29/01/2016*/

        // $("#submitBooking").attr("param", obselval + "_" + ibselval);

    }

});

}



</script>

<script>

$('#filter_btn').click(function(){

            

            if ($('#filter_xs_slide').is(':hidden')) {

               

               $('#filter_xs_slide').show('slide',{direction:'left'});

               $("#filter_xs_slide").addClass("position");

               $('#contant_hide_on_filter').hide();

            } else {

               $('#filter_xs_slide').hide('slide',{direction:'left'});

            }

});

$('#filter_click_submit').click(function(){

       $('#filter_xs_slide').hide('slide',{direction:'left'});

       $('#contant_hide_on_filter').show();

});

</script>

