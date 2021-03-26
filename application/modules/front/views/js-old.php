

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
            $(".from_location_m").text($("#flight_from0").val());
            $(".to_location_m").text($("#flight_from_to0").val());
            $(".depart_date_m").text($("#depart_date").val());

		}

		if($('#returnid').is(':checked')) { 
          
	    	$(".oneway_m").show();
	    	$(".return_m").show();
			$(".return_m_d").show();
            $(".from_location_m").text($("#flight_from0").val());
            $(".to_location_m").text($("#flight_from_to0").val());
            $(".depart_date_m").text($("#depart_date").val());
			$(".return_date_m").text($("#return_date").val());

		}

        
		if($('#MultiWayid').is(':checked')) { 
           $(".return_m").hide();
           $(".return_m_d").hide();
           $(".oneway_m").show();

           $(".from_location_m").text($("#flight_from1").val());
           $(".depart_date_m").text($("#city1").val());
           
           if($("#flight_from_to2").val() != ""){ 
                $(".to_location_m").text($("#flight_from_to2").val());
           }

            if($("#flight_from_to3").val() != ""){ 
                $(".to_location_m").text($("#flight_from_to3").val());
            }

            if($("#flight_from_to4").val() != ""){ 
                $(".to_location_m").text($("#flight_from_to4").val());
            }
        }
      
       

		$(".num_adult").text($(".adult_select").val());
		$(".num_child").text($(".child_select").val());
		$(".num_infant").text($(".infant_select").val());
		$('#wait_pop').modal({
		backdrop: 'static',
		keyboard: false
		});

		$('#wait_pop').modal('show'); 
    	$("#search_form").submit();
	}

});









        $(function () {
            $("#onwayid").click(function () {
                $('#return_datebox').css("opacity",".5");
                $('.onwayid').addClass("active");
                $('.returnid').removeClass("active");
                $('.MultiWayid').removeClass("active");
				$("#return_date").attr('disabled','disabled');
                $("#return_date").removeAttr('required');
                $(".mulitycity_box").removeClass( "display_inline" );
                $(".mulitycity_box").addClass( "display_none" );
                $(".oneway_box").removeClass( "display_none" );
                $(".oneway_box").addClass( "display_inline" );
            });

            $("#returnid").click(function () {
                $('#return_datebox').css("opacity","1");
                $('.returnid').addClass("active");
                $('.onwayid').removeClass("active");
                $('.MultiWayid').removeClass("active");
                $("#return_date").removeAttr('disabled');
                $("#return_date").attr("required", "true");
                $(".mulitycity_box").removeClass( "display_inline" );
                $(".mulitycity_box").addClass( "display_none" );
                $(".oneway_box").removeClass( "display_none" );
                $(".oneway_box").addClass( "display_inline" );
            });
            
            $('.MultiWayid').click(function(){
                $(".mulitycity_box").removeClass( "display_none" );
                $(".mulitycity_box").addClass( "display_inline" );
                
                $(".oneway_box").removeClass( "display_inline" );
                $(".oneway_box").addClass( "display_none" );

                $('.returnid').removeClass("active");
                $('.onwayid').removeClass("active");
                $(".MultiWayid").addClass( "active" );
                $("#return_date").attr('disabled','disabled');
            });
        });



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
                beforeShow:function(){  
                    // alert();
                    $('#returnid').prop("checked", true);
                    $('#onwayid').prop("checked", false);
                    $('#return_datebox').css("opacity","1");
                    $('.returnid').addClass("active");
                    $('.onwayid').removeClass("active");
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
        
        //........................
        
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







</script>

