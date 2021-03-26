
<?php $this->load->view('header');?>
<?php
// PrintArray($_SESSION ['hotel'] ['array'] ['hotel_room_result']);
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
$bp_search_request = $_SESSION ['hotel'] ['search_data'];
?>

 <div class="main-field">
      <div class="container">
        <div class="flght-booking-details hotl-booking-wrap">
          <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12">
              <div class="hotl-booking-temp">
                <!-- <h1><?php echo $bp_hotel_detail->HotelName;?></h1> -->
                <!-- slider here -->
                <div class="hotel-carousel owl-carousel">
					<?php if(isset($bp_hotel_detail->Images)){?>
						<?php if(is_array($bp_hotel_detail->Images)){?>
							<?php foreach($bp_hotel_detail->Images as $hptel_image_key => $bp_hotel_images){?>
								<div class="item">
									<a data-fancybox="gallery" href="<?php echo $bp_hotel_images;?>">
										<img src="<?php echo $bp_hotel_images;?>" alt="">
									</a>
								</div>
							<?php }?>
						<?php }?>
					<?php }?>
                </div>
                <!-- slider end here -->

              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">

              <div class="htl-side-booking-add">
                <ul>
					<?php if($bp_hotel_detail->Address!=""){?>
						<li><i class="icofont-google-map"></i> <strong>Address : </strong><?php echo $bp_hotel_detail->Address;?></li>
					<?php }?>
					<?php if($bp_hotel_detail->CountryName!=""){?>
						<li><i class="icofont-google-map"></i> <strong>Country : </strong><?php echo $bp_hotel_detail->CountryName;?></li>
					<?php }?>
					<?php if($bp_hotel_detail->PinCode!=""){?>
						<li> <i class="icofont-pin"></i><strong>Pincode : </strong><?php echo $bp_hotel_detail->PinCode;?></li>
					<?php }?>
					<?php if($bp_hotel_detail->HotelContactNo!=""){?>
						<li> <i class="icofont-phone"></i><strong>Contact Number : </strong><?php echo $bp_hotel_detail->HotelContactNo;?></li>
					<?php }?>
					<?php if($bp_hotel_detail->FaxNumber!=""){?>
						<li><i class="icofont-fax"></i> <strong>Fax Number : </strong><?php echo $bp_hotel_detail->FaxNumber;?></li>
					<?php }?>
					<?php if($bp_hotel_detail->Email!=""){?>
						<li><i class="icofont-envelope-open"></i> <strong>Email : </strong><?php echo $bp_hotel_detail->Email;?></li>
					<?php }?>
					<?php if($bp_hotel_detail->Latitude!=""){?>
						<li> <i class="icofont-map"></i> <strong>Latitude : </strong><?php echo $bp_hotel_detail->Latitude;?></li>
					<?php }?>
					<?php if($bp_hotel_detail->Longitude!=""){?>
						<li> <i class="icofont-map"></i> <strong>Longitude : </strong><?php echo $bp_hotel_detail->Longitude;?></li>
         			<?php }?>
                </ul>
                <h3>We Offer Lowest Price Guaranteed</h3>
              </div>
            </div>

            <div class="col-md-12">
              <div class="hotelBox-booking">
                <ul class="nav nav-tabs">
                  <li class="active"><a data-toggle="tab" href="#availability"><i class="icofont-home"></i> Availability</a></li>
                  <li><a data-toggle="tab" href="#hotel-info"><i class="icofont-info"></i> Hotel Information</a></li>
                  <li><a data-toggle="tab" href="#hotel-facility"><i class="icofont-hotel-boy-alt"></i> Hotel Facility</a></li>
                </ul>

                <div class="tab-content">
                  <div id="availability" class="tab-pane fade in active">
				  <?php if ($bp_rooms > 1) {?>
									<?php $typeofcombination = $bp_room_result->RoomCombinations->InfoSource ?>

									
									
									<?php foreach($bp_room_result->RoomCombinations->RoomCombination as $key => $RoomCombinations) {?>
										
							<?php
							if($typeofcombination == "FixedCombination"){
								$bp_room_index_for_select = "";
									foreach ( $RoomCombinations as $RoomCombinationss ) {
										if ($bp_room_index_for_select == "") {
											$bp_room_index_for_select = $RoomCombinationss;
										} else {
											$bp_room_index_for_select = $bp_room_index_for_select . "_" . $RoomCombinationss;
										}
									}
							}
							if($typeofcombination == "OpenCombination"){
								$bp_room_index_for_select = $bp_room_result->RoomCombinations->RoomCombination[0][$key] . "_" . $bp_room_result->RoomCombinations->RoomCombination[1][$key];
							}
									

									?>
							<?php foreach($bp_room_detail as $bp_room_key => $bp_room_details) {?>
							<?php
										if ($bp_room_details->RoomIndex == $RoomCombinations [0]) {
											?>
            
                  			  <?php 
							  //$bp_customer_price=bp_get_hotel_fare(dsa_currency_convert($bp_room_details->Price->PublishedPriceRoundedOff))['final_fare'];
							  $bp_customer_price=bp_get_hotel_fare($bp_room_details->Price->OfferedPriceRoundedOff,$bp_room_details->Price->PublishedPriceRoundedOff)['final_fare'];
							  ?>
									<div class="hotelBox hresult-box relative mb15">
										<div class="row">
											<div class="col-md-7">
												<div class="row">
													<div class="col-sm-12">
														<a href="#none" class="hotel-name roomname"><?php echo $bp_room_details->RoomTypeName;?></a> <span class="area text-justify roominf">Inclusion: </span>
													</div>
												</div>
											</div>
											<div class="col-md-3">
												<a href="#none" condition_block="roomconditions_<?php echo $bp_room_key;?>" class="bp_roomconditions badge warning-bg fz10">Room info & Conditions</a>
											</div>
											<div class="col-md-2 col-sm-6 text-right col-xs-8">
												<span class="mainprice"><i><?php echo $this->bp_white_label_setting->wls_currency_symbol;?></i>&nbsp; <?php echo $bp_customer_price;?></span> <a href=".roomfarebreakup_<?php echo $bp_room_key;?>" data-toggle="modal" class="badge danger-bg fz10">Fare breakup</a>	<a href="<?php echo site_url();?>hotel/block_room/?room_index=<?php echo $bp_room_index_for_select;?>" title="Select" class="btn btn-primary bp_hotel_info_find">Select</a> 
											</div>
										</div>
										<div class="roomconditions_<?php echo $bp_room_key;?> roomconditions-block">
											<p class="warning-bg" style="color: white;"><?php echo $bp_room_details->CancellationPolicy;?></p>
											<table class="table table-bordered">
												<tbody>
													<tr>
														<th class="text-center">From Date</th>
														<th class="text-center">To Date</th>
														<th class="text-center">Charge</th>
													</tr>
																<?php foreach($bp_room_details->CancellationPolicies as $CancellationPolicies){?>
																<tr>
														<td class="text-center"><?php echo date_format(date_create($CancellationPolicies->FromDate),"d M Y");?></td>
														<td class="text-center"><?php echo date_format(date_create($CancellationPolicies->ToDate),"d M Y");?></td>
														<td class="text-center"><?php if($CancellationPolicies->ChargeType == '1'){ echo $this->bp_white_label_setting->wls_currency_symbol; }?> <?php echo dsa_currency_convert($CancellationPolicies->Charge);?> <?php if($CancellationPolicies->ChargeType == '2'){ echo "%"; }?></td>
													</tr>
																<?php }?>
															</tbody>
											</table>
										</div>
									</div>
									<!-- hresult-box ends from here -->
									<div class="modal fade mk-modal roomfarebreakup_<?php echo $bp_room_key;?>">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
													<h4 class="modal-title"><?php echo $bp_room_details->RoomTypeName;?> Fare Breakup</h4>
												</div>
												<div class="modal-body">
													<div class="table-responsive">
														<span class="block black-color p710 light-bg border">Rate Breakup</span>
														<table class="table table-bordered">
															<tbody>
															<?php foreach($bp_room_details->DayRates as $bp_rate_date_brackup) {?>
																<tr>
																	<td class="text-left"><?php echo date_format(date_create($bp_rate_date_brackup->Date),"d M Y");?></td>
																	<td class="text-right"><i class=""><?php echo $this->bp_white_label_setting->wls_currency_symbol;?></i> <?php echo dsa_currency_convert($bp_rate_date_brackup->Amount);?> m  </td>
																</tr>
														    <?php }?>		
															</tbody>
														</table>
													</div>
													<div class="table-responsive">
														<span class="block black-color p710 light-bg border">Rate Summary</span>
														<table class="table table-bordered">
															<tbody>
																<tr>
																	<td class="text-left">Room Price</td>
																	<td class="text-right"><i class=""><?php echo $this->bp_white_label_setting->wls_currency_symbol;?></i> <?php echo dsa_currency_convert($bp_room_details->Price->RoomPrice);?></td>
																</tr>
																<tr>
																	<td class="text-left">Tax</td>
																	<td class="text-right"><i class=""><?php echo $this->bp_white_label_setting->wls_currency_symbol;?></i> <?php echo $bp_customer_price - dsa_currency_convert($bp_room_details->Price->RoomPrice);?></td>
																</tr>
																<tr>
																	<td class="text-left">Total Price</td>
																	<td class="text-right"><i class=""><?php echo $this->bp_white_label_setting->wls_currency_symbol;?></i> <?php echo $bp_customer_price;?></td>
																</tr>
															</tbody>
														</table>
													</div>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
												</div>
											</div>
										</div>
									</div>
                    <?php } } }}else{?>
                    	
				  

                    	<?php foreach($bp_room_detail as $bp_room_key => $bp_room_details){?>
                    <?php
					//$bp_customer_price=dsa_currency_convert($bp_room_details->Price->PublishedPriceRoundedOff);
					$bp_customer_price=bp_get_hotel_fare($bp_room_details->Price->OfferedPriceRoundedOff,$bp_room_details->Price->PublishedPriceRoundedOff)['final_fare'];
					?>
                    <!-- hresult-box starts from here -->
										<div class="row">
											<div class="col-md-10 col-sm-12">
												<div class="dash-title">
													<h3 class="fz18"><?php echo $bp_room_details->RoomTypeName;?></h3>
												</div>
												<h5>Cancellation Detail</h5>
												<div class="table-responsive">
													<table class="table table-bordered table-hover table-striped">
														<tbody>
															<tr>
																<th class="text-center">From Date</th>
																<th class="text-center">To Date</th>
																<th class="text-center">Charge</th>
															</tr>
																<?php foreach($bp_room_details->CancellationPolicies as $CancellationPolicies){?>
																	<tr>
																		<td class="text-center"><?php echo date_format(date_create($CancellationPolicies->FromDate),"d M Y");?></td>
																		<td class="text-center"><?php echo date_format(date_create($CancellationPolicies->ToDate),"d M Y");?></td>
																		<td class="text-center"><?php if($CancellationPolicies->ChargeType == '1'){ echo  $this->bp_white_label_setting->wls_currency_symbol;}?> <?php echo dsa_currency_convert($CancellationPolicies->Charge);?> <?php if($CancellationPolicies->ChargeType == '2'){ echo "%"; }?></td>
																	</tr>
																<?php }?>
														</tbody>
													</table>
												</div>
											</div>
											<div class="col-md-2 col-sm-2">
												<div class="htlcol-price text-center">
												<span class="ht-Price ds-block mb-10 mainprice"><i class=""><?php echo $this->bp_white_label_setting->wls_currency_symbol;?></i>&nbsp; <?php echo $bp_customer_price;?></span> 
												<a href=".roomfarebreakup_<?php echo $bp_room_key;?>" data-toggle="modal" class="badge danger-bg fz10 mb-10">Fare breakup</a> 
												<a href="<?php echo site_url();?>hotel/block_room/?room_index=<?php echo $bp_room_details->RoomIndex;?>" class="booknow selectedroom btn btn-org t-white"> Select</a>
											</div>
										</div>
									
									<!-- hresult-box ends from here -->
									<div class="modal fade mk-modal roomfarebreakup_<?php echo $bp_room_key;?>">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
													<h4 class="modal-title"><?php echo $bp_room_details->RoomTypeName;?> Fare Breakup</h4>
												</div>
												<div class="modal-body">
													<div class="table-responsive">
														<span class="block black-color p710 light-bg border">Rate Breakup</span>
														<table class="table table-bordered">
															<tbody>
															<?php foreach($bp_room_details->DayRates as $bp_rate_date_brackup) {?>
																<tr>
																	<td class="text-left"><?php echo date_format(date_create($bp_rate_date_brackup->Date),"d M Y");?></td>
																	<td class="text-right"><i class=""><?php echo $this->bp_white_label_setting->wls_currency_symbol;?></i> <?php echo dsa_currency_convert($bp_rate_date_brackup->Amount) ;?> </td>
																</tr>
														    <?php }?>		
															</tbody>
														</table>
													</div>
													<div class="table-responsive">
														<span class="block black-color p710 light-bg border">Rate Summary</span>
														<table class="table table-bordered">
															<tbody>
																<tr>
																	<td class="text-left">Room Price</td>
																	<td class="text-right"><i class=""><?php echo $this->bp_white_label_setting->wls_currency_symbol;?></i> <?php echo dsa_currency_convert($bp_room_details->Price->RoomPrice);?></td>
																</tr>
																<tr>
																	<td class="text-left">Tax</td>
																	<td class="text-right"><i class=""><?php echo $this->bp_white_label_setting->wls_currency_symbol;?></i> <?php echo $bp_customer_price - dsa_currency_convert($bp_room_details->Price->RoomPrice);?></td>
																</tr>
																<tr>
																	<td class="text-left">Total Price</td>
																	<td class="text-right"><i class=""><?php echo $this->bp_white_label_setting->wls_currency_symbol;?></i> <?php echo $bp_customer_price;?></td>
																</tr>
															</tbody>
														</table>
													</div>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
												</div>
											</div>
										</div>
									</div>
								</div>	
                 		<?php   } }?>
                  </div>

                  <div id="hotel-info" class="tab-pane fade">
				  <div class="hotelBox hresult-box relative mb15">
										<p><?php echo $bp_hotel_detail->Description;?></p>
									</div>
                    <!-- <h4>General: </h4>
                    <ul class="list">
                      <li>Our rooms are tastefully furnished and offer amenities like AC, Card Payment, Geyser and a lot more.</li>
                      <li>First aid, round the clock security and fire safety are provided to our guests for their safety. </li>
                      <li>To provide further assistance to our guests, we have a 24-hour helpdesk on our property.</li>
                    </ul> -->
                  </div>
                  <div id="hotel-facility" class="tab-pane fade">
					<div class="hotelBox hresult-box relative">
						<div class="row mt15">
							<?php foreach($bp_hotel_detail->HotelFacilities as $bp_HotelFacilities) {?>
								<div class="col-sm-4 mb-5">
										<i class="icofont-money"></i>&nbsp;&nbsp;<?php echo $bp_HotelFacilities;?>
								</div>
							<?php } ?>		
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
<script src="<?php echo site_url();?>assets/js/jquery_lazy_master/jquery.lazy.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $(".bp_roomconditions").click(function(){
        var block_class=$(this).attr("condition_block");
      $("."+block_class).stop().slideToggle(300);
    });
  });
</script>
<script>
$('.lazy').Lazy();
</script>
