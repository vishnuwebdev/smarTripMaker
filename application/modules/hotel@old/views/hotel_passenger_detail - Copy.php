
<style>


label {
  height: 35px;
  position: relative;
  color: #8798AB;
  display: block;
  margin-top: 30px;
  margin-bottom: 20px;
}

label > span {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  font-weight: 300;
  line-height: 32px;
  color: #8798AB;
  border-bottom: 1px solid #586A82;
  transition: border-bottom-color 200ms ease-in-out;
  cursor: text;
  pointer-events: none;
}

label > span span {
  position: absolute;
  top: -25px;
  left: 0;
  transform-origin: 0% 50%;
  transition: transform 200ms ease-in-out;
  cursor: text;
}

label .field.is-focused + span span,
label .field:not(.is-empty) + span span {
 
  cursor: default;
}

label .field.is-focused + span {
  border-bottom-color: #34D08C;
}

.field {
  background: transparent;
  font-weight: 300;
  border: 0;
  color: #000;
  outline: none;
  cursor: text;
  display: block;
  width: 100%;
  line-height: 32px;
  padding-bottom: 3px;
  transition: opacity 200ms ease-in-out;
}

.field::-webkit-input-placeholder { color: #8898AA; }
.field::-moz-placeholder { color: #8898AA; }

/* IE doesn't show placeholders when empty+focused */
 .field:-ms-input-placeholder { color: #424770; }

.field.is-empty:not(.is-focused) {
  opacity: 0;
}
 button:focus {
  background: #24B47E;
}

button:active {
  background: #159570;
}

.outcome {
  float: left;
  width: 100%;
  padding-top: 8px;
  min-height: 20px;
  text-align: center;
}

.success, .error {
  display: none;
  font-size: 15px;
}

.success.visible, .error.visible {
  display: inline;
}

.error {
  color: #E4584C;
}

.success {
  color: #34D08C;
}

.success .token {
  font-weight: 500;
  font-size: 15px;
}

.checkboxBt span {
	display:none;
}


</style>

<?php $this->load->view('header');?>


<?php
// PrintArray($_SESSION ['hotel'] ['array'] ['hotel_info_result']);
$bp_hotel_result = $_SESSION ['hotel'] ['array'] ['search_result'];
$bp_hotel_detail = $_SESSION ['hotel'] ['array'] ['hotel_info_result']->HotelInfoResult->HotelDetails;
$bp_room_result = $_SESSION ['hotel'] ['array'] ['hotel_room_result']->GetHotelRoomResult;
$bp_room_detail = $_SESSION ['hotel'] ['array'] ['hotel_room_result']->GetHotelRoomResult->HotelRoomsDetails;
$bp_post_data_from_result = $_SESSION ['hotel'] ['array'] ['hotel_info_request_post'];
$bp_rooms = 0;
$bp_adult = 0;
$bp_child = 0;
foreach ( $bp_hotel_result->NoOfRooms as $no_of_room_loop ) {
	$bp_rooms = $bp_rooms + 1;
	$bp_adult = $bp_adult + $no_of_room_loop->NoOfAdults;
	$bp_child = $bp_child + $no_of_room_loop->NoOfChild;
}
$bp_pax_request = $_SESSION ['hotel'] ['array'] ['search_request'] ['RoomGuests'];
$bp_hotel_block_result=$_SESSION ['hotel'] ['array'] ['hotel_block_result']->BlockRoomResult;
$bp_hotel_one_room_detail=$_SESSION ['hotel'] ['array'] ['hotel_block_result']->BlockRoomResult->HotelRoomsDetails[0];
$bp_base_price=$bp_hotel_one_room_detail->Price->RoomPrice;
$bp_publish_fare=$bp_hotel_one_room_detail->Price->PublishedPrice;
$bp_tax=$bp_publish_fare-$bp_base_price;
$_SESSION ['hotel'] ['array'] ['publish_fare']=$bp_publish_fare;
$_SESSION ['hotel'] ['amount'] ['customer_fare']=$bp_publish_fare;
$_SESSION ['hotel'] ['amount'] ['agent_fare']=$bp_publish_fare;
$_SESSION ['hotel'] ['amount'] ['dsa_fare']=$bp_publish_fare;
$_SESSION ['hotel'] ['amount'] ['admin_fare']=$bp_publish_fare;
//PrintArray ( $_SESSION ['hotel'] ['search_data'] );
?>


    <div class="main-field pt-0-xs">
        <div class="container no-padding-xs">
            <div class="col-md-9 contant" style="background-color: #FFFFFF">

               
                    <div class="col-md-12 no-padding review_title">Review Your Booking</div>
                    <div class="row airlines booking-review">
										<div class="full-col">
										<div class="col-sm-12 col-md-12">
										<span><strong>	Hotel :</strong></span>
										<?php print_r($bp_hotel_detail->HotelName) ?> 
										</div>
										<div class="col-sm-12 col-md-12">
										<span>
										<span><strong>	Address :</strong></span>	<?php echo $bp_hotel_detail->Address;?>
										</span>
										</div>
				
							<div class="col-sm-12 col-md-6">
								<span><strong>Check-in</strong></span>
								<p><?php echo date_format(date_create($bp_hotel_result->CheckInDate),"D, d M Y");?></p>
							</div>
							<div class="col-sm-12 col-md-6">
							<span><strong>Check-out</strong></span>
								<p><?php echo date_format(date_create($bp_hotel_result->CheckOutDate),"D, d M Y");?></p>
							</div>
							<div class="col-sm-12">
									<strong>Guests: </strong><?php echo $bp_adult;?> Adults , <?php echo $bp_child;?> Children
									</div>
						
					</div>
								
						
											
                    </div>
                
                <form id="id_from" class="form-inline" action="<?php echo site_url(); ?>hotel/save_booking_data" method="post" >
                    <input type="hidden" name="sessionid" value="<?php echo $this->input->get('seesionid'); ?>" >
                    <div class="col-md-12 no-padding review_title">Guest Details</div>
                    <div class="alert_for_error_msg"></div>
											<div class="row airlines">
											<?php foreach($bp_pax_request as $bp_pax_key => $bp_pax_requests){?>
						<h4>Room <?php echo $bp_pax_key+1;?></h4>
						<?php for($i=0;$i<$bp_pax_requests['NoOfAdults'];$i++){?>
						<h5>Adult <?php echo $i+1;?></h5>
						<div class="row">
							<div class="form-group">
								<label>Title*</label> <select class="form-control pax_validation_field full white-bg"  name="title_adult_<?php echo $bp_pax_key;?>_<?php echo $i;?>">
									<option>Mr</option>
									<option>Mrs</option>
									<option>Miss</option>
									<option>Ms</option>
								</select>
							</div>
							<div class="form-group">
								<label>First Name*</label> <input type="text" name="first_name_adult_<?php echo $bp_pax_key;?>_<?php echo $i;?>" class=" form-control pax_validation_field name_valid full white-bg" />
							</div>
							<div class="form-group">
								<label>Surname*</label> <input type="text" name="last_name_adult_<?php echo $bp_pax_key;?>_<?php echo $i;?>" class="form-control pax_validation_field name_valid full white-bg" />
							</div>
						</div>
						<br>
						<?php }?>
						<?php if($bp_pax_requests['NoOfChild']>0){?>
						   <?php foreach($bp_pax_requests['ChildAge'] as $bp_key_child => $bp_child_pax_data){?>
						   <h5>Child <?php echo $bp_key_child+1;?> (Age - <?php echo $bp_child_pax_data;?>)</h5>
						   	<div class="row">
							<div class="col-12 col-md-2">
								<label>Title*</label> 
									<select  class=" full white-bg" name="title_child_<?php echo $bp_pax_key;?>_<?php echo $bp_key_child;?>">
									<option>Mstr</option>
									<option>Miss</option>
								</select>
							</div>
							<div class="col-12 col-md-5">
								<label>First Name*</label> <input type="text" name="first_name_child_<?php echo $bp_pax_key;?>_<?php echo $bp_key_child;?>" class="form-control pax_validation_field name_valid full white-bg" />
							</div>
							<div class="col-12 col-md-5">
								<label>Surname*</label> 
								<input type="text" name="last_name_child_<?php echo $bp_pax_key;?>_<?php echo $bp_key_child;?>" class="form-control name_valid pax_validation_field full white-bg" />
								<input type="hidden" value="<?php echo $bp_child_pax_data;?>" name="age_child_<?php echo $bp_pax_key;?>_<?php echo $bp_key_child;?>" class="full white-bg" />
							</div>
						</div>
						<br>
						   <?php }?>
						<?php }?>
						<?php }?>

											</div>

                    <div class="col-md-12 no-padding review_title">Contact Details</div>
                    <div class="row airlines">


                        <div class="form-group">
                            <label for="email">Enter Your Email:</label>
														<input type="text" id="email_valid" name="email" class="form-control pax_validation_field full white-bg" />
                        </div>
                        <div class="form-group">
                            <label for="email">Enter Your Mobile:</label>
														<input  type="number"  name="mobile" class="phone form-control pax_validation_field full white-bg" />
                        </div>

                    </div>
                    <div class="row airlines">
					<h4>Policies</h4>
						<div class="row">
						<?php foreach($bp_hotel_block_result->HotelRoomsDetails as $bp_room_detail_key => $bp_hotel_block_results){?>
							<div class="col-12 col-md-12">
								<div class="margin-bottom-10">
									<a href="#" title="Room 1 Smart Deluxe Room">Room <?php echo $bp_room_detail_key+1;?> - <?php echo $bp_hotel_block_results->RoomTypeName;?></a>
								</div>
								<div class="margin-bottom-10">
								   <h5>Hotel Policy</h5> <?php echo $bp_hotel_block_result->HotelPolicyDetail;?>
								</div>
								<h5>Cancel Policy</h5> <?php echo $bp_hotel_block_results->CancellationPolicy;?>
							</div>
							<br>
							<?php }?>
						</div>
						<h4>Acknowledgement</h4>
						<div class="row">
							<div class="col-12">
								<div class="checkbox">
									 <label for="terms" class="border-0"><span class="checkboxBt"> <input style="opacity: 1"  type="checkbox" value="I have read and accept the Terms and Conditions and Privacy Policy." id="terms"> <span></span>
									</span> I have read and accept the Terms and Conditions and Privacy Policy</a>.
									</label>
								</div>
								<div class="checkbox">
									 <label for="receiveemails" class="border-0"><span class="checkboxBt"> <input style="opacity: 1" type="checkbox" value="I wish receive emails from Todo En One on travel deals, special offers and any information.." id="receiveemails"> <span></span>
									</span> I wish receive emails from Todo En One on travel deals, special offers and any information..</label>
								</div>
								<p class="border-top-text">By completing this booking, you are agreeing with our Terms and Privacy Policy.</p>
							</div>
						</div>

                        <button style="float:right" class="btn btn-primary bp_hotel_info_find"  id="id_btn">Complete Booking </button> 
                      
                    </div>
                </form>
            </div>

            <div class="col-md-3 sidebar">
                <div class="col-md-12 no-padding review_title">Fare Details </div>
                <div class="row airlines">
                    <ul class="fare_details">
                        <li>Base Fare<span class="pull-right"><i class="fa fa-inr"></i> <?php echo $bp_base_price; ?></span></li>
                        <li>Tax<span class="pull-right"><i class="fa fa-inr"></i> <?php echo $bp_tax; ?></span></li>
                        <li>Total Fare<span class="pull-right"><i class="fa fa-inr"></i> <?php echo $bp_publish_fare; ?></span></li>
                        <li class="for_net_fare_div none">Net Fare<span class="pull-right"><i class="fa fa-inr"></i> <?php echo 0; ?></span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
	
	



	<div id="hotel_confirm_pop_up" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1111" aria-hidden="true">
			<div class="modal-dialog ">				
				<div class="modal-content">					
					<div class="modal-body">
						<div class="row">							
							<div class="col-sm-12 col-md-12 modal-body-right">
								<div class="inner">
									<form>
										<div class="row">
										        <div class="col-sm-12 col-md-12">
													<div class="text-align-center" style="color:#000; text-align: center;">
												       	<img style="width:20%" src="<?php echo site_url(); ?>/assets/images/loading.gif">
														<h3 style="font-size: 20px;">Please Wait</h3>
														<span class="block midfz">Do not refresh or close the Window</span>
												</div>
											</div>
										</div>
								</div>
							</div>
						</div>
					</div>					
				</div>
			</div>
		</div>
	<?php $this->load->view('footer');?>
<?php $this->load->view('hotel/js');?>

<script>
/* $(".bp_hotel_info_find").click(function(){
		$('#hotel_confirm_pop_up').modal('show'); 
}); */


$('.name_valid').on('keypress', function (event) {
    var regex = new RegExp("^[a-zA-Z ]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
       event.preventDefault();
       return false;
    }
});	

$('.phone').on('keypress', function (event) {
    var regex = new RegExp("^[0-9]*$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
       event.preventDefault();
       return false;
    }
});	



$(".bp_hotel_info_find").click(function (e) {
	e.preventDefault();
	
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
			 
			  $( "#id_from" ).submit();
				
            }
            
            
        });



</script>

<script>



document.querySelector('#id_from').addEventListener('submit', function(e) {
  e.preventDefault();
   $('#hotel_confirm_pop_up').modal('show'); 
  var form = document.querySelector('#id_from');
  var extraDetails = {
    name: form.querySelector('input[name=cardholder-name]').value,
  };
 
  stripe.createToken(card, extraDetails).then(setOutcome);
});



</script>

