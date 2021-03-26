<?php 
	$this->load->view('include/head');
	$this->load->view('include/header');
	if ($this->session->userdata('Userlogin') != NULL) {
		$loginuser = $this->session->userdata('Userlogin')['userData'];
	} else {
		$loginuser = array();
	}
	$bp_hotel_result = $_SESSION ['hotel'] ['array'] ['search_result'];
	$bp_hotel_detail = $_SESSION ['hotel'] ['array'] ['hotel_info_result']->HotelInfoResult->HotelDetails;
	$bp_room_result = $_SESSION ['hotel'] ['array'] ['hotel_room_result']->GetHotelRoomResult;
	$bp_room_detail = $_SESSION ['hotel'] ['array'] ['hotel_room_result']->GetHotelRoomResult->HotelRoomsDetails;
	$bp_post_data_from_result = $_SESSION ['hotel'] ['array'] ['hotel_info_request_post'];
	// PrintArray($bp_hotel_detail);
	// PrintArray($bp_room_result);
	$bp_rooms = 0;
	$bp_adult = 0;
	$bp_child = 0;
	foreach ( $bp_hotel_result->HotelSearchResult->RoomGuests as $no_of_room_loop ) {
		$bp_rooms = $bp_rooms + 1;
		$bp_adult = $bp_adult + $no_of_room_loop->NoOfAdults;
		$bp_child = $bp_child + $no_of_room_loop->NoOfChild;
	}
	$nights = $_SESSION ['hotel'] ['array'] ['search_request']['NoOfNights'];
	$bp_pax_request = $_SESSION ['hotel'] ['array'] ['search_request'] ['RoomGuests'];
	$bp_hotel_block_result = $_SESSION ['hotel'] ['array'] ['hotel_block_result']->BlockRoomResult;
	//$bp_hotel_one_room_detail = $_SESSION ['hotel'] ['array'] ['hotel_block_result']->BlockRoomResult->HotelRoomsDetails[0];
	// $bp_base_price = round($bp_hotel_one_room_detail->Price->RoomPrice);
	// $bp_publish_fare = $bp_hotel_one_room_detail->Price->PublishedPrice;
	$bp_hotel_one_room_detail = $_SESSION ['hotel'] ['array'] ['hotel_block_result']->BlockRoomResult->HotelRoomsDetails;
	$bp_base_price = 0;
	$bp_publish_fare =0;
	$bp_offer =0;
	
	foreach ( $bp_hotel_one_room_detail as $bp_hotel_one_room_details ) {
		$bp_base_price = $bp_base_price + $bp_hotel_one_room_details->Price->RoomPrice;
		$bp_publish_fare= $bp_publish_fare + $bp_hotel_one_room_details->Price->PublishedPrice;
		$bp_offer = $bp_offer + $bp_hotel_one_room_details->Price->OfferedPriceRoundedOff;
	}
	// $bp_customer_price1 = bp_get_hotel_fare_pernight($bp_hotel_one_room_detail->Price->OfferedPriceRoundedOff,$bp_hotel_one_room_detail->Price->PublishedPriceRoundedOff,$nights)['final_fare'];
	$bp_customer_price1=bp_get_hotel_fare_pernight($bp_offer,$bp_publish_fare,$nights)['final_fare'];
	$bp_customer_price= $bp_customer_price1*$nights;
	$bp_tax = round($bp_customer_price-$bp_base_price);
	if($getwayList!="0"){
		$nkwithconfee = ( $bp_customer_price * $getwayList[0]->dsapayg_convenience_fee)/100;
	}else { 
		$nkwithconfee = 0; 
	} 
	$_SESSION ['hotel'] ['array'] ['publish_fare']=$bp_publish_fare;
	//$_SESSION ['hotel'] ['amount'] ['customer_fare']=$bp_publish_fare;
	$_SESSION ['hotel'] ['amount'] ['customer_fare']=$bp_customer_price;
	$_SESSION ['hotel'] ['amount'] ['agent_fare']=$bp_publish_fare;
	$_SESSION ['hotel'] ['amount'] ['dsa_fare']=$bp_publish_fare;
	$_SESSION ['hotel'] ['amount'] ['admin_fare']=$bp_publish_fare;
	$currencyCode = getCurrentCurrency();
	if(count($bp_room_detail) > 0){
		$currencyCode = $bp_room_detail[0]->Price->CurrencyCode;
  	}
  	$_SESSION ['hotel'] ['amount'] ['currency'] = $currencyCode;
  	$symbol = getCurrencySymbol($currencyCode); 
  	if( $currencyCode == "USD" ){
		$js_currency_symbol = "$";
	}else if( $currencyCode == "AED" ){
		$js_currency_symbol = "AED";
	}else{
		$js_currency_symbol = "₹";
	}

?>

<!--new-->
<section class="flght-booking-details pt-2 pb-2 pt-md-4 pb-md-4">
	<div class="container">
		<div class="row">
			<div class="col-md-9">
				<div class="flght-booking-left-col htl-booking-wrappper">

					<!-- Flight details list oneWay Paul -->
					<div class="flt-booking-wrap mb-2 mb-md-3">
						<div class="flt-booking-top">
							<h5>Review Your Booking</h5>
						</div>
						<div class="flt-booking-dts">
							<div class="reviewhtl-booking">
			                    <div class="row">
			                      <div class="col-sm-12 col-md-12 mb-10">
			                      	<div class="rew-htl-topbar">
			                      		<ul class="list-unstyled"> 
			                      			<li class="mb-1"><span><strong>Welcome </strong>  <?php print_r($bp_hotel_detail->HotelName) ?> </span></li>
			                      			<li>
			                      				<span><strong><i class="icofont-google-map"></i>  Address  :</strong></span><?php echo $bp_hotel_detail->Address;?>
			                      			</li>
			                      		</ul>	
			                      	</div>
			                      </div>
			                      <div class="col-sm-12 col-md-12 mb-10">
			                        <div class="check-out-htl">
			                          <div class="row">
			                            <div class="col-md-4">
			                              <div class="com-chtl">
			                                <span class="fz-12">Check-in</span>
			                                <p class="mb-0"><?php echo date_format(date_create($bp_hotel_result->HotelSearchResult->CheckInDate),"D, d M Y");?></p>
			                              </div>
			                            </div>
			                            <div class="col-md-4">
			                              <div class="com-chtl">
			                                <span class="fz-12">Night(s)</span>
			                                <p class="mb-0"><?php echo $_SESSION ['hotel'] ['array'] ['search_request']['NoOfNights']?></p>
			                              </div>
			                            </div>
			                            <div class="col-md-4">
			                              <div class="com-chtl">
			                                <span class="fz-12">Check-out </span>
			                                <p class="mb-0"><?php echo date_format(date_create($bp_hotel_result->HotelSearchResult->CheckOutDate),"D, d M Y");?></p>
			                              </div>
			                            </div>
			                          </div>
			                        </div>
			                      </div>
			                    </div>
			                  </div>
						</div>
					</div><!--/ Flight details list oneWay end Paul -->
					
					<!-- Traveller Details Start From here -->
					<form id="id_from" action="<?php echo site_url(); ?>hotel/save_booking_data" method="post" >
						<input type="hidden" name="sessionid" value="<?php echo $this->input->get('seesionid'); ?>">
					<div class="trvl-details">
						<div class="trv-topbar mb-3">
							<div class="flt-booking-top">
								<h5>Guest Details</h5>
							</div>
							<div class="flt-booking-dts">
								<div class="col-fly-inn">
								<?php  foreach($bp_pax_request as $bp_pax_key => $bp_pax_requests){?>
									<h6 class="room-no">Room <?php echo $bp_pax_key+1;?></h6>
									<?php for($i=0;$i<$bp_pax_requests['NoOfAdults'];$i++){ ?>
					                 <label>Adult <?php echo $i+1;?> -</label>
					                 <div class="row">
					                   <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
					                     <div class="form-group custom-select-wrap">
											<select class="form-control custom-select pax_validation_field full white-bg"  name="title_adult_<?php echo $bp_pax_key;?>_<?php echo $i;?>">
												<option>Mr</option>
												<option>Mrs</option>
												<option>Miss</option>
												<option>Ms</option>
											</select>
					                     </div>
					                   </div>
					                   <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
					                      <div class="form-group">
											<input type="text" name="first_name_adult_<?php echo $bp_pax_key;?>_<?php echo $i;?>" class=" form-control pax_validation_field name_valid full white-bg" placeholder="Enter First Name"/>
					                      </div>
					                    </div>
					                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
					                        <div class="form-group">
					                          <input type="text" name="last_name_adult_<?php echo $bp_pax_key;?>_<?php echo $i;?>" class="form-control pax_validation_field name_valid full white-bg" placeholder="Enter Last Name"/>
					                        </div>
										</div>
									</div>
									<div class="row">
										<?php  if($bp_hotel_one_room_detail[$i]->IsPANMandatory) { ?>
											<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
												<div class="form-group">
													<input type="text" name="pan_adult_<?= $bp_pax_key ?>_<?= $i ?>" class="form-control pax_validation_field name_valid full white-bg" placeholder="PAN Number"/>
												</div>
											</div>
										<?php } if($bp_hotel_one_room_detail[$i]->IsPassportMandatory){ ?>
											<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
												<div class="form-group">
													<input type="text" name="passport_adult_<?= $bp_pax_key ?>_<?= $i ?>" class="form-control pax_validation_field name_valid full white-bg" placeholder="Passport Number"/>
												</div>
											</div>

											<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
												<div class="form-group">
													<input type="text" name="passport_exp_adult_<?= $bp_pax_key ?>_<?= $i ?>" class="form-control pax_validation_field name_valid full white-bg" placeholder="Passport Expiry Date"/>
												</div>
											</div>
										<?php } ?>
									</div>
									<?php } ?>
									<?php if($bp_pax_requests['NoOfChild']>0){?>
									 <?php foreach($bp_pax_requests['ChildAge'] as $bp_key_child => $bp_child_pax_data){?>
									 <label>Child <?php echo $bp_key_child+1;?> (Age - <?php echo $bp_child_pax_data;?>) -</label>
										<div class="row">
										<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
											<div class="form-group custom-select-wrap">
												<select  class="form-control custom-select full white-bg" name="title_child_<?php echo $bp_pax_key;?>_<?php echo $bp_key_child;?>">
													<option>Mstr</option>
													<option>Miss</option>
												</select>
											</div>
										</div>
											<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
											<div class="form-group">
												<input type="text" name="first_name_child_<?php echo $bp_pax_key;?>_<?php echo $bp_key_child;?>" class="form-control pax_validation_field name_valid full white-bg" placeholder="Enter First Name"/>
											</div>
											</div>
											<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
												<div class="form-group">
												<input type="text" name="last_name_child_<?php echo $bp_pax_key;?>_<?php echo $bp_key_child;?>" class="form-control name_valid pax_validation_field full white-bg" placeholder="Enter Last Name"/>
													<input type="hidden" value="<?php echo $bp_child_pax_data;?>" name="age_child_<?php echo $bp_pax_key;?>_<?php echo $bp_key_child;?>" class="full white-bg" />
												</div>
											</div>
										</div>
									

								<?php } } }?>
									
					             </div>
							</div>
						</div>
				
						<div class="trv-topbar mb-3">
							<div class="flt-booking-top">
								<h5>Contact Details</h5>
							</div>
							<div class="flt-booking-dts">
								<div class="col-fly-inn">
									<div class="row">
					                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					                      <div class="form-group">
					                        <label>Enter Your Email:</label>
											<input type="text" id="email_valid" name="cust_email" class="form-control pax_validation_field full white-bg" />
					                      </div>
					                    </div>
					                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					                      <div class="form-group">
					                        <label>Enter Your Mobile:</label>
					                        <input  type="number"  name="mobile" class="phone form-control pax_validation_field full white-bg" />
										</div>
					                    </div>
				                 	</div>
				               </div>
							</div>
						</div>

						<!-- Privacy Policy -->
						<div class="trv-topbar mb-3 htl-policy-desc">
							<div class="flt-booking-top">
								<h5>Policies</h5>
							</div>
							<div class="flt-booking-dts">
							<?php foreach($bp_hotel_block_result->HotelRoomsDetails as $bp_room_detail_key => $bp_hotel_block_results){?>
								<div class="col-fly-inn">
									<a class="room-type" href="#" title="Room 1 Smart Deluxe Room">Room <?php echo $bp_room_detail_key+1;?> - <?php echo $bp_hotel_block_results->RoomTypeName;?></a>
									<h5 class="htl-title">Hotel Policy</h5>
									<p><?php echo $bp_hotel_block_result->HotelPolicyDetail;?></p>
									<h5 class="htl-title">Cancel Policy</h5>
									<p><?php echo $bp_hotel_block_results->CancellationPolicy;?></p>
				               </div>
							  <?php }?> 
							</div>
						</div>
						<!-- Privacy Policy end -->						
							
						
						<?php  if($getwayList!="0"){ ?>
						<div class="trv-topbar mb-3">
							<div class="flt-booking-top">
								<h5>Payment Gateway</h5>
							</div>
							<div class="flt-booking-dts">
								<div class="col-fly-inn">
								<!--check customer wallet -->		   
								<?php 
								  	if($this->session->userdata("Userlogin") != NULL){
										$bp_customer_total_balance= convertPrice($this->user_data->cust_balance,$currencyCode);
										$bp_total_fare = $customer_fare;
                            			if($bp_customer_total_balance > 0){
								?>
                        			<div class="col-md-12">
										<div class="checkbox">
											<label>
												<input name="wallet_amount" class="term_condition" type="checkbox" value="customerCash"> 
												Use Customer Wallet Amount 
												<b>Available Balance is: </b>
												<?= $symbol ?> <?= $bp_customer_total_balance ?> 
											</label>
										</div>
									</div>
								<?php 
									} }
									$getwayLists = $getwayList[0];
									//$getwayLists = $getwayList;
									if($getwayLists->dsapayg_type == "fix"){
										$final_con =  $getwayList[0]->dsapayg_convenience_fee;
									} else{                      	
										$final_con =  round(( $bp_customer_price * $getwayList[0]->dsapayg_convenience_fee)/100);
									}	
								?>
									<div class="col-md-12">		
										<div class="checkbox">	
											<label>				
												<input name="payment_method" class="payment_option" checked type="radio" value="<?php echo $getwayLists->dsapayg_gateway_name; ?>"> 
												<?php echo $getwayLists->dsapayg_gateway_name; ?>
											</label>
											<br/>
											<span class="">
												<?= $symbol ?> <?php echo $final_con ?> Convenience Fee (Will be included in total fare at the time of payment) 
											</span>
											<?php 
												$_SESSION[$getwayLists->dsapayg_gateway_name]['Conv_fee'] = $final_con; 
												$_SESSION['hotel']['Conv_fee'] = $final_con;
											?>
											<br/><br/>
										</div>
									</div>
									<!---========END Customer Wallet or payment==============-->
				                	<!--  	<div style="display:none;" class="checkbox cstm-rdo">
				                  		<input name="payment_method" checked class="term_condition" id="payment-mode" type="radio" value="<?php  echo $getwayList[0] ->dsapayg_gateway_name ?>"> 
				                  		<label for="payment-mode"><?php  echo $getwayList[0] ->dsapayg_gateway_name ?></label>
				                  	</div>
									-->
									
									
									
									
				                  	<div class="checkbox htl-srch-rtng">
				                  		<label for="terms">
					 	 					<input type="checkbox" id="terms" class="flightfare" value="NonRefundable">
					 	 					<span>					 	 						
												I have read and accept the <a target="blank" href="https://www.smarttripmaker.com/online/terms-and-conditions"> Terms and Conditions </a> and <a target="blank" href="https://www.smarttripmaker.com/online/privacy-policy">Privacy Policy</a>.
					 	 					</span>
					 	 				</label>
				                  	</div>
				                  	<div class="form-group text-md-right">
										<button type="button" class="btn btn-search booking_btn bookingbtnsubmit btn-com bp_hotel_info_find"  id="id_btn">Complete Booking </button> 
				                    </div>
				               	</div>
							</div>
						</div>
						<?php } else { ?>
						<p>Something went wrong please contact admin</p>
						<?php }  ?>

					</div>
                <form>

					
				</div>
			</div>
			<div class="col-md-3">
				<div class="flght-side-det">
					<div class="review_title clearfix">
		              <h4 class="">Fare Details</h4>
		            </div>
		            <div class="contant">
		            	<ul class="fare_details list-unstyled mb-0">
		            		<li>Base Fare <span class="float-right"><?= $symbol ?> <?php echo round($bp_base_price); ?></span></li>
		            		<li>Tax (+)<span class="float-right"><?= $symbol ?> <?php echo round($bp_tax); ?></span></li>
							<?php if($getwayList!="0"){
								// $getwayLists = $getwayList[0];					
								// if($getwayLists->dsapayg_type = "fix"){
									// $final_con =  $getwayList[0]->dsapayg_convenience_fee;
								// } else{
									// $final_con =  round(( $bp_customer_price * $getwayList[0]->dsapayg_convenience_fee)/100,2);
								// }
							?>
							<li>Convenience Fee<span class="float-right"><?= $symbol ?> <?php echo $final_con; ?></span></li>
						
                        	<?php }else { $final_con = 0; }  $_SESSION['hotel']['amount']['final_con'] = $final_con; ?>
		            		
		            		<li>Total Fare<span class="float-right final_fare"><?= $symbol ?> <?php echo round($bp_customer_price+$final_con); ?></span></li>
		            	</ul>
		            </div>
					<!-- Apply Coupon -->
					<div class="flght-side-det">
						<div class="review_title">
							<h4 class="">Apply Coupon</h4>
						</div>
						<div class="contant">
							<div id="massegealert" > </div>
							<div class="apply-coupoun text-center">
								<div class="form-group">
									<input type="text" id="user_coupon" name="coupon" class="form-control" placeholder="Enter Coupon code to get discount">
								</div>
							<a href="#none" id="add_coupon" class="btn btn-search">Add coupon</a>
							</div>
						</div>
					</div>
					<!-- Apply Coupon end -->
		        </div>
			</div>
		</div>
	</div>
	
	
	<div class="modal fade confirmpop " id="Modal_for_confirm"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1111" aria-hidden="true">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
    <div class="modal-content">
	<div class="modal-header" style="">
	  <button type="button" class="close" data-dismiss="modal">&times;</button>
	  <h4><span class="glyphicon glyphicon-lock"></span> Please Confirm your Flight </h4>
	</div>
    <div class="modal-body" style="padding: 30px 34px 30px 20px;">
         <div class="row">
             <div class="col-md-8">
                 <div class="list-group">
    <a href="#" class="list-group-item active">
    Passenger Detail-
    </a>
                 <div class="pax_data_apend">
                     
  
</div>
                 </div>
                 
                 <div class="list-group">
    <a href="#" class="list-group-item active">
    Contact Detail
    </a>
                 <div class="">
                  <li class="list-group-item email_confirm"></li>
                  <li class="list-group-item contact_confirm"></li>  
  
              </div>
                 </div>
                 
                 <div class="list-group">
    <a href="#" class="list-group-item active">
    Journey Details
    </a>
                 
                 </div>
             </div>
             
             <div class="col-md-4">
                 <div class="row airlines">
                    <ul class="fare_details">
                        <li>Base Fare <span class="pull-right"><?= $symbol ?> <?php echo 0; ?></span></li>
                        <li>Tax <span class="pull-right"><?= $symbol ?> <?php echo 0; ?></span></li>
                        <li>Total Fare <span class="pull-right"><?= $symbol ?> <?php echo 0; ?></span></li>
                    </ul>
                </div>
             </div>
              </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-success proceed_payment_data">Proceed Payment</button>
        </div>
      </div>
	</div>
  </div> 


	<div id="hotel_confirm_pop_up" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1111" aria-hidden="true">
		<div class="modal-dialog ">
			<div class="modal-content">
		        <div class="modal-header">
		          <h5 class="text-center w-100">Please Wait... </h5>
		        </div>
		        <div class="modal-body">
					<div class="text-center">
						<!-- Loader start from here -->
				         	<div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>

				        <!-- Loader end from here -->
				        <!-- <span class="block midfz pt-md-3 border-top">Do not refresh or close the Window</span> -->
					</div>
		        </div>
		      </div>
		</div>
	</div>
</section>
<!---new end--->

<?php $this->load->view('include/footer');?>
<?php $this->load->view('hotel/js');?>
<script>
	//script for coupon
	$("#add_coupon").click(function(){
		var coupontext = $("#user_coupon").val() ;
		var sessionid = "<?php echo $sessionid ?>" ;
		$("#loader").modal('show');
		$.ajax({
			url: "<?php echo site_url(); ?>hotel/Getcoupon",
			type: "POST",
			data: { coupon:coupontext ,sessionid :sessionid },
			dataType: "text",
			cache: false,
			success: function(data){
				var obj = jQuery.parseJSON(data);
				if (obj.status == "success"){
					$("#loader").modal('hide');
					$('#massegealert').html(obj.message);
					$("#massegealert").addClass("alert alert-success");
					$('.conv').html(obj.total_con_fee);
					$('.final_fare').html(obj.amount);
					$("#user_coupon").val('') ;
					$("#add_coupon").attr("disabled", "disabled");
					$('.coupon_show').show();
					var getway_charge=parseInt($('.gateway_charge').text());
					$('.without_gatewaty').text(parseInt(obj.amount));
					$('.with_gatewaty').text(parseInt(getway_charge+obj.amount));
					$('.coupon').show();
					$('.coupon').append("Coupon Discount (-) <span class='float-right'> <?= $js_currency_symbol ?> "+ parseInt(obj.discount_amount) +"</span>");
				}else{
					$("#loader").modal('hide');
					$('#massegealert').html(obj.message);
					$("#massegealert").addClass("alert alert-danger");
				}
			},
			error: function (jqXHR, textStatus, errorThrown){
				$("#loader").modal('hide');
					$('#massegealert').html("Please try again");
					$("#massegealert").addClass("alert alert-danger");
			}
		});
	});
</script>