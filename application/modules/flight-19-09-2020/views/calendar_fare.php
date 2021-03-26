<?php $this->load->view("header"); ?>
    <link href='<?php echo site_url();?>assets/full_calendar/fullcalendar.min.css' rel='stylesheet' />
    

    <body style="background:#fff">
        <style>
         .search-box-calender{
            background: #fff;
            box-shadow: 0px 0px 25px 0px #00000026;
            margin-bottom: 20px;
         }
         .fc-toolbar h2 {
            color:#000;
        }
        .fc-toolbar .fc-left {
            display:none;
        }
        .fc-day-grid-event{
            tex-decoration:none;
        }
        .fc-toolbar .fc-right {
            display:none;
        }
		.error {
			color: red!important;
		}
        </style> 


    <?php  
        if(isset($searchID)){
            $searchdata = array ();
            $resultdata = array ();
            if (isset ( $_SESSION ["calender"] [$searchID] ["Search_data_json"] )) {
                $searchdata = json_decode ( $_SESSION ["calender"] [$searchID] ["Search_data_json"] );
                $resultdata = json_decode ( $_SESSION ["calender"] [$searchID] ["Search_Result_json"] );
            }
            $requestdata = $_SESSION ["calender"] [$searchID] ["search_RequestData"];
            $result=$resultdata->Results;

        }      
    ?>
     

        <div class="container">
            <div class="row clnd-fare-view">
                <h2 class="text-center" style="color:#000"> Fare Calendar </h2>

<?php  
        if(isset($searchID)){ ?>
            <div class="col-md-12 ">
            <div class="search-box-calender">
               <div class="col-md-4 col-xs-6">
                   <h4 class="hidden-xs"><?php echo $searchdata->Segments[0]->Origin; ?> </h4>
                   <p class="airlane"><?php echo $requestdata["from_location"]; ?></p>
               </div>
               <div class="hidden xs-show search_result_info_arrow text-center"><i class="fa fa-long-arrow-right"></i></div>
               <div class="col-md-4 col-xs-6 xs-text-right">
                   <h4 class="hidden-xs"><?php echo $searchdata->Segments[0]->Destination; ?></h4>
                   <p class="airlane"><?php echo $requestdata["to_location"]; ?></p>
               </div>
               <div class="col-md-4 col-xs-8 search_info_date">
                   <i style="font-size: 22px;margin-top: 11px; color:#000;" class="fa fa-calendar pull-left hidden-xs"></i>
                   <p class="no-padding-xs pt-7"><span class="hidden-xs">ONWARD</span><br/><b class="no-padding-xs" style="font-size: 14px;margin-top: 11px; color:#777777;"><?php echo $depart_date_time = date("j M Y, D", strtotime($requestdata["depart_date"])); ?></b></p>
              </div>
                 <div class="clearfix"></div>
           </div>
           </div>
<?php } ?>

                <div class="col-md-12 text-right">
                <div class="search-box-calender">
                <form id="searchform"  action="<?php echo site_url();?>flight/calendar_fare" method="POST">
						<div class="searchengine clearfix">
							<div class="row">
								<div class="col-sm-4">
									<div class="clearfix forminputgrabber">
										<i class="fa fa-map-marker forminputicon"></i>
									    <input type="text" class="form-control flight_from0" name="from_location"  onkeyup="flight_suggest(this.value,0);"  placeholder="Source" value="<?php if(isset($requestdata["from_location"])){ echo $requestdata["from_location"]; } ?>" required="required" autocomplete="off">
									</div>
								</div>
                                <div class="col-sm-4">
									<div class="clearfix forminputgrabber">
										<i class="fa fa-map-marker forminputicon"></i>
                                    <input type="text" class="form-control flight_from_to0" name="to_location"  onkeyup="flight_suggest_to(this.value,0);" value="<?php if(isset($requestdata["from_location"])){ echo $requestdata["to_location"]; } ?>" placeholder="<?php echo $this->lang->line('destination_title'); ?>" required="required" autocomplete="off">
                                    <input type="hidden" value="<?php if(isset($requestdata["from_country"])){ echo $requestdata["from_country"]; } ?>" name="from_country" id="flight_from_country0">
                                    <input type="hidden" value="<?php if(isset($requestdata["to_country"])){ echo $requestdata["to_country"]; } ?>" name="to_country" id="flight_from_to_country0">
                                    <input type="hidden" value="<?php if(isset($requestdata["from_city"])){ echo $requestdata["from_city"]; } ?>"  name="from_city" id="flight_from_city0">
                                    <input type="hidden" value="<?php if(isset($requestdata["to_city"])){ echo $requestdata["to_city"]; } ?>" name="to_city" id="flight_from_to_city0">
									</div>
								</div>
								<div class="col-sm-3">
									<div class="clearfix forminputgrabber">
										<label for="ht-date1" class="fa fa-calendar forminputicon"></label> 
										<input type="text" class="form-control bp_hotel_search_validation hidden-xs" placeholder="Date" id="depart_date" value="<?php if(isset($requestdata["depart_date"])){ echo $requestdata["depart_date"]; } ?>" name="depart_date" readonly required="requestdata" autocomplete="off"> 

                    <input type="text" class="input block width-100 border hidden xs-show" placeholder="Date" id="depart_date_on_mobile" name="depart_date" value="<?php if(isset($requestdata["depart_date"])){ echo $requestdata["depart_date"]; } ?>" name="depart_date" readonly required="">

									</div>
								</div>
								<div class="col-sm-1">
									<div class="clearfix">
										<button type="button" id="search_flight_c" class="btn search-btn">Search </button>
										<!--<a href="hotel-result.php" class="btn btn-primary block"><i class="fa fa-search"></i> Search Hotels</a>-->
									</div>
								</div>
							</div>
						</div>
					</form>
                   </div> 
                </div>

 

<?php  
        if(isset($searchID)){ ?>
                <div class="col-md-12" >
                    <div id="calendar1" class="mb-40 clnd-col"></div>
                </div>
        <?php } ?>      
            </div>
        </div>
            
      
        
    <?php $this->load->view("footer"); ?>
    <?php $this->load->view("flight/js"); ?>
    <link href='<?php echo site_url();?>assets/full_calendar/fullcalendar.print.min.css' rel='stylesheet' media='print' />
    <script src='<?php echo site_url();?>assets/full_calendar/lib/moment.min.js'></script>
    <script src='<?php echo site_url();?>assets/full_calendar/fullcalendar.min.js'></script>
    <!--<script src="<?php echo site_url(); ?>assets/js/filter.js"></script>-->

<?php  
        if(isset($searchID)){ ?>
    <script>


        $('#calendar1').fullCalendar({
            eventRender: function(eventObj, $el) {
                    $el.popover({
                    title: eventObj.discription,
                    trigger: 'hover',
                    placement: 'top',
                    container: 'body'
               });
               $el.find('span.fc-title').html($el.find('span.fc-title').text());   
             },
             
			header:{
		
			  center: 'title',
	
			},
		
            eventOrder: "eventOrder",
            defaultDate: '<?php echo date_format(date_create($requestdata["depart_date"]),"Y");?>-<?php echo str_pad(date_format(date_create($requestdata["depart_date"]),"m"),"2","0",STR_PAD_LEFT);?>-<?php echo str_pad(date_format(date_create($requestdata["depart_date"]),"d"),"2","0",STR_PAD_LEFT);?>',
			editable: true,
            textEscape: false, 
			eventLimit: 3, 
           
			viewRender: function(currentView){
				var minDate = moment(),
				maxDate = moment().add(2,'weeks');
				if (minDate >= currentView.start && minDate <= currentView.end) {
					$(".fc-prev-button").prop('disabled', true); 
					$(".fc-prev-button").addClass('fc-state-disabled'); 
				}
				else {
					$(".fc-prev-button").removeClass('fc-state-disabled'); 
					$(".fc-prev-button").prop('disabled', false); 
				 }
			},
			
			views: {
               basic: {
                   eventLimit: 'ture'
               },
			    year: {
				type: 'agenda',
				buttonText: '12 days',
				duration: { months: 3 },
				slotDuration: { days: 60 }
				  
				}
            },
			
			eventClick: function(event) {
				if (event.url) {
                 // window.open(event.url);
                  //return false;
                  myFunction();
				}
			},
            eventLimitClick: function(cellInfo, jsEvent) {
                  $('#calendar1').fullCalendar( 'gotoDate',cellInfo.date );
                  $('#calendar1').fullCalendar('changeView', 'basic');
                 
                 console.log("cellInfo.dayEl: jQuery element for the day cel", cellInfo.date);
             },
			
             events: [
                <?php if(is_array($result)){ foreach($result as $key => $bp){ 
$DateT = explode ("T", $bp->DepartureDate);
				 $DateD = explode("-", $DateT[0]);
				 $Date = $DateD[2]."-".$DateD[1]."-".$DateD[0];
				?>  
                    {
                        id :'<?php echo $key ?>',
                        title : '<center style="padding:4px;font-size: 15px;"><img src="<?php echo site_url(); ?>assets/images/airlines/<?php echo $bp->AirlineCode ; ?>.gif" width="65" /> <br/> <span class="airline-name"><?php echo $bp->AirlineName ?></span> <br/> <span class="fare-cl"> <i class="fa fa-inr"></i> <?php echo round($bp->Fare) ?></span></center>',
                        start : '<?php echo date_format(date_create($bp->DepartureDate),"Y");?>-<?php echo str_pad(date_format(date_create($bp->DepartureDate),"m"),"2","0",STR_PAD_LEFT);?>-<?php echo str_pad(date_format(date_create($bp->DepartureDate),"d"),"2","0",STR_PAD_LEFT);?>',
                        url :'<?php echo site_url(); ?>flight/result?type=<?php echo "OneWay" ?>&from_location=<?php echo $requestdata['from_location']; ?>&to_location=<?php echo $requestdata['to_location']; ?>&from_city_code=<?php echo $requestdata['from_city']; ?>&to_city_code=<?php echo $requestdata['to_city']; ?>&from_country=<?php echo $requestdata['from_country']; ?>&to_country=<?php echo $requestdata['to_country']; ?>&depart_date=<?php echo $Date; ?>&return_date=&no_adult=<?php echo 1; ?>&no_child=<?php echo 0; ?>&no_infants=<?php echo 0; ?>&cabin_class=<?php echo 1; ?>&preferred_airline='
                    },

               <?php } } ?>
            ]
        });
    </script>
		<?php } ?>  

    <script>
	
	

    $('#depart_date').datepicker({
            numberOfMonths: 1,
            dayNamesMin: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
            "minDate": 0,
            showOn: 'both',
            buttonText: '',
            dateFormat: 'dd-mm-yy',
            beforeShow: function() {
                $('#ui-datepicker-div').addClass("searchdatepicker");
            },
            onClose: function (selectedDate){}
    });

function flight_suggest(inputString,id) {
$( ".flight_from"+id ).autocomplete({
    autoFocus: true,	
    minLength : 2,
    source : function(request, response) {
    $.ajax({
        type: "POST",
        url: "<?php echo site_url();?>front/fetch_city",
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
        url: "<?php echo site_url();?>front/fetch_city_to",
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

</script>
   
  
  