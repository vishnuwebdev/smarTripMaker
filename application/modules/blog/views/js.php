
<script>
$(".pop_select").change(function(){
  
	var child  =	parseInt($(".infent_select").val());  
	var infant = 	parseInt($(".child_select").val());  
  var adult  =	parseInt($(".adult_select").val());  
	var total=child+infant+adult;
	 $(".guest_num").text(total);
	
});
  // from Ui Datepicekr

  $(function () {

    $('#depart_date').datepicker({

            numberOfMonths: 1,

            dayNamesMin: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],

            "minDate": 0,

            showOn: 'both',

            buttonText: '',

            dateFormat: 'dd-mm-yy',

            beforeShow: function () {

               

                $('#ui-datepicker-div').addClass("searchdatepicker");

            },

            onClose: function (selectedDate)

            {

                $("#return_date").datepicker("option", "minDate", selectedDate);

            }

        });

        $('#return_date').datepicker({

            numberOfMonths: 1,

            dayNamesMin: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],

            "minDate": 0,

            showOn: 'both',

            dateFormat: 'dd-mm-yy',

            buttonText: '',

            beforeShow: function () {



                                $('#round-rad').addClass('active');

                                $('#onwayid').removeClass('active');

                                $('#multicityid').removeClass('active');

                                $('#return_datebox').css("opacity","1");

                                $("#round-trip").prop("checked", true);

                                $('#ui-datepicker-div').addClass("searchdatepicker");

                

                

            }

        });

		
		// multicity date picker 
$('#ft-date1_multicity').datepicker({
                    numberOfMonths: 1,
                    dayNamesMin: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
                    //"minDate": 0,

                    dateFormat: "yy-mm-dd",
                    minDate: 0,

                    beforeShow: function () {
                        $('#ui-datepicker-div').addClass("searchdatepicker");
                    },
                    onSelect: function (selectedDate) {
                        $("#ft-date2_multicity").datepicker("option", "minDate", selectedDate);
                    }
                });

                $('#ft-date2_multicity').datepicker({
                    numberOfMonths: 1,
                    dayNamesMin: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
                    minDate: 0,

                    dateFormat: "yy-mm-dd",

                    beforeShow: function () {
                        $('#returnid').addClass('active');
                        $('#onwayid').removeClass('active');
                        $('#multicityid').removeClass('active');
                        $('#return_datebox').css("opacity", "1");
                        $('#return_date').removeClass("return-background");
                        $("#round-trip").prop("checked", true);
                        $('#ui-datepicker-div').addClass("searchdatepicker");

                    },
                    onSelect: function (selectedDate) {
                        $("#ft-date3_multicity").datepicker("option", "minDate", selectedDate);
                    }
                });

                $('#ft-date3_multicity').datepicker({
                    numberOfMonths: 1,
                    dayNamesMin: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
                    minDate: 0,

                    dateFormat: "yy-mm-dd",

                    beforeShow: function () {
                        $('#returnid').addClass('active');
                        $('#onwayid').removeClass('active');
                        $('#multicityid').removeClass('active');
                        $('#return_datebox').css("opacity", "1");
                        $('#return_date').removeClass("return-background");
                        $("#round-trip").prop("checked", true);
                        $('#ui-datepicker-div').addClass("searchdatepicker");

                    }, onSelect: function (selectedDate) {
                        $("#ft-date4_multicity").datepicker("option", "minDate", selectedDate);
                    }
                });

                $('#ft-date4_multicity').datepicker({
                    numberOfMonths: 2,
                    dayNamesMin: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
                    minDate: 0,

                    dateFormat: "yy-mm-dd",

                    beforeShow: function () {
                        $('#returnid').addClass('active');
                        $('#onwayid').removeClass('active');
                        $('#multicityid').removeClass('active');
                        $('#return_datebox').css("opacity", "1");
                        $('#return_date').removeClass("return-background");
                        $("#round-trip").prop("checked", true);
                        $('#ui-datepicker-div').addClass("searchdatepicker");

                    }
                });

//end multicity datepicker	
		
		
		
    });



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


</script>

<script>
      
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

  $(function () {

    $('#hos_from_date').datepicker({

            numberOfMonths: 1,
            dayNamesMin: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
            "minDate": 0,
            showOn: 'both',
            buttonText: '',
            dateFormat: 'dd-mm-yy',
            beforeShow: function () {
                $('#ui-datepicker-div').addClass("searchdatepicker");
            },
            onClose: function (selectedDate)
            {
                $("#hos_to_date").datepicker("option", "minDate", selectedDate);
            }

        });

        $('#hos_to_date').datepicker({

            numberOfMonths: 1,
            dayNamesMin: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
            "minDate": 0,
            showOn: 'both',
            dateFormat: 'dd-mm-yy',
            buttonText: '',
            

        });

        
         $('#train-dob').datepicker({

            numberOfMonths: 1,
            dayNamesMin: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
            showOn: 'both',
            buttonText: '',
            dateFormat: 'dd-mm-yy',
       });
        

    });
</script>