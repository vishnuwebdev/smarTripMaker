
<?php 
$this->load->view('include/head');
$this->load->view('include/header');?>
<?php
//PrintArray($_SESSION ['hotel'] ['array'] ['search_result']);
$bp_hotel_result = $_SESSION ['hotel'] ['array'] ['search_result'];
$bp_hotel_detail = $_SESSION ['hotel'] ['array'] ['hotel_info_result']->HotelInfoResult->HotelDetails;
$bp_room_result = $_SESSION ['hotel'] ['array'] ['hotel_room_result']->GetHotelRoomResult;
$bp_room_detail = $_SESSION ['hotel'] ['array'] ['hotel_room_result']->GetHotelRoomResult->HotelRoomsDetails;
$bp_post_data_from_result = $_SESSION ['hotel'] ['array'] ['hotel_info_request_post'];
$bp_rooms = 0;
$bp_adult = 0;
$bp_child = 0;
foreach ( $bp_hotel_result->HotelSearchResult->RoomGuests as $no_of_room_loop ) {
	$bp_rooms = $bp_rooms + 1;
	$bp_adult = $bp_adult + $no_of_room_loop->NoOfAdults;
	$bp_child = $bp_child + $no_of_room_loop->NoOfChild;
}
$bp_search_request = $_SESSION ['hotel'] ['search_data'];
// echo "<pre>";
// print_r($bp_hotel_result); die;
 $checkin_date=$bp_search_request['checkIn'];
$checkout_date =$bp_search_request['checkOut'];
$diff = strtotime($checkout_date) - strtotime( $checkin_date);
$nights = $diff/86400;

// PrintArray($bp_room_detail); die;

?>
<!-----starts------>
<div class="main-field pt-2 pb-2 pt-md-4 pb-md-4">
      <div class="container">
        <div class="flght-booking-details hotl-booking-wrap">
          <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12">
              <div class="hotl-booking-temp">
                <!-- Hotel Title here -->
                  <h3 class="title-htl"><?php echo $bp_hotel_detail->HotelName;?></h3>
                <!-- Hotel Title end here -->
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
              	<h3>We Offer Lowest Price Guarantee</h3>
                <ul class="list-unstyled mb-0">
                  <li><i class="icofont-google-map"></i> <?php echo $bp_hotel_detail->Address;?></li>
				  <?php if($bp_hotel_detail->CountryName!=""){?>
                  <li><i class="icofont-map"></i> <?php echo $bp_hotel_detail->CountryName;?></li>
				  <?php }?>
                  <li><i class="icofont-pin"></i> <?php echo $bp_hotel_detail->PinCode;?></li>
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
              </div>
            </div>

            <div class="col-md-12">
              <div class="hotelBox-booking mt-2 mt-md-3">
                 <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" data-toggle="tab" href="#availability">
                        <i class="icofont-home"></i> Availability
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#hotel-info">
                        <i class="icofont-info"></i> Hotel Information
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#hotel-facility">
                        <i class="icofont-hotel-boy-alt"></i> Hotel Facility
                      </a>
                    </li>
                  </ul>

                  <!-- Tab panes -->
                  <div class="tab-content">
                    <div id="availability" class="tab-pane active">
					<?php if ($bp_rooms > 1) {						
						if ($bp_room_result->RoomCombinations->InfoSource == "FixedCombination"){
					?>
					<?php 
					// $typeofcombination = $bp_room_result->RoomCombinations->InfoSource; 
					// foreach($bp_room_result->RoomCombinations->RoomCombination as $key => $RoomCombinations) {		if($typeofcombination == "FixedCombination"){
							// $bp_room_index_for_select = "";
								// foreach ( $RoomCombinations as $RoomCombinationss ) {
									// if ($bp_room_index_for_select == "") {
										// $bp_room_index_for_select = $RoomCombinationss;
									// } else {
										// $bp_room_index_for_select = $bp_room_index_for_select . "_" . $RoomCombinationss;
									// }
								// }
							// }
							// if($typeofcombination == "OpenCombination"){
								// $bp_room_index_for_select = $bp_room_result->RoomCombinations->RoomCombination[0][$key] . "_" . $bp_room_result->RoomCombinations->RoomCombination[1][$key];
							// }
						// foreach($bp_room_detail as $bp_room_key => $bp_room_details) {
						// if ($bp_room_details->RoomIndex == $RoomCombinations [0]) {						
							  // $bp_customer_price=bp_get_hotel_fare_pernight($bp_room_details->Price->OfferedPriceRoundedOff,$bp_room_details->Price->PublishedPriceRoundedOff,$nights)['final_fare'];
								
							$typeofcombination = $bp_room_result->RoomCombinations->InfoSource; 
							foreach($bp_room_result->RoomCombinations->RoomCombination as $key => $RoomCombinations) {
								if($typeofcombination == "FixedCombination"){
									$bp_room_index_for_select = "";
										foreach ( $RoomCombinations->RoomIndex as $RoomCombinationss ) {
											if ($bp_room_index_for_select == "") {
												$bp_room_index_for_select = $RoomCombinationss;
											} else {
												$bp_room_index_for_select = $bp_room_index_for_select . "_" . $RoomCombinationss;
											}
										}							
									}				
							
								if($typeofcombination == "OpenCombination"){									
									$bp_room_index_for_select = $bp_room_result->RoomCombinations->RoomCombination[$key]->RoomIndex[0] . "_" . $bp_room_result->RoomCombinations->RoomCombination[$key]->RoomIndex[1];
								
									// $bp_room_index_for_select = "";								
										// foreach ( $bp_room_result->RoomCombinations->RoomCombination[$key]->RoomIndex as $key1 => $RoomCombinationss1 ) {
											// if($key1 < $bp_rooms){
												// echo $key1;
												// if ($bp_room_index_for_select == "") {
													// $bp_room_index_for_select = $RoomCombinationss1[$key1];
												// } else {
													// $bp_room_index_for_select = $bp_room_index_for_select . "_" . $RoomCombinationss1[$key1];
												// }
											// }
										// }							
							}							
							
						
								foreach($bp_room_detail as $bp_room_key => $bp_room_details) {					
									if ($bp_room_details->RoomIndex == $RoomCombinations->RoomIndex [0]) {
										$bp_customer_price=bp_get_hotel_fare_pernight($bp_room_details->Price->OfferedPriceRoundedOff,$bp_room_details->Price->PublishedPriceRoundedOff,$nights)['final_fare'];				
					
						?>
                      <div class="row">
                        <div class="col-md-10 col-sm-12">
                          <div class="dash-title pt-2 pt-md-3">
                            <h3 class="fz18"><?php echo $bp_room_details->RoomTypeName;?></h3>
                          </div>
                          <ul class="list-inline clearfix mb-0 fare-cncl">
                            <li class="list-inline-item float-left">
                              <h5>Cancellation Detail</h5>
                            </li>
                            <li class="list-inline-item float-right">
							  <a href=".roomfarebreakup_<?php echo $bp_room_key;?>" data-toggle="modal" class="badge danger-bg fz10 mb-10">Fare breakup</a>
                            </li>
                          </ul>
                          <div class="table-responsive">
                            <table class="table table-bordered">
                              <thead>
                                <tr>
                                  <th class="text-center">From Date</th>
                                  <th class="text-center">To Date</th>
                                  <th class="text-center">Charge</th>
                                </tr>
                              </thead>
                              <tbody>
							  <?php foreach($bp_room_details->CancellationPolicies as $CancellationPolicies){?>
                                <tr>
                                  <td class="text-center"><?php echo date_format(date_create($CancellationPolicies->FromDate),"d M Y");?></td>
                                  <td class="text-center"><?php echo date_format(date_create($CancellationPolicies->ToDate),"d M Y");?></td>
                                  <td class="text-center"> <?php if($CancellationPolicies->ChargeType == '1'){ ?> <?php }?> <?php echo round($CancellationPolicies->Charge);?> <?php if($CancellationPolicies->ChargeType == '2'){ echo "%"; }?></td>
                                </tr>
								<?php }?>
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <div class="col-md-2 col-sm-2">
                          <div class="htlcol-price text-right">
						                <div class="ttl_price d-block mb-1">
                              <small class="htl-dur">Total price</small>
                              <span class="d-block"><i class="icofont-rupee"></i> <?php echo round($bp_customer_price*$nights);?></span> 
                            </div>

                            <div class="ht-Price d-block mb-1">
                              <small class="d-block htl-dur">Price per night</small>
                              <span class="d-block">
                                <i class="icofont-rupee"></i> 
                              <?php echo round($bp_customer_price);?>
                            </span>
                            </div>
							<a href="<?php echo site_url();?>hotel/block_room/?room_index=<?php echo $bp_room_index_for_select;?>" title="Select" class="btn btn-search bp_hotel_info_find">Select</a>
                          </div>
                        </div>
                      </div>
					  
					  <!-- Fare breakup  -->
			<div class="modal fade roomfarebreakup_<?php echo $bp_room_key;?>" >
				<div class="modal-dialog modal-md">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title fwb">Fare Breakup</h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>
						<div class="modal-body">
						  <div class="table-responsive">
							<span class="d-block black-color p-2 light-bg border">Rate Breakup</span>
							<table class="table table-bordered">
							  <tbody>
							  <?php foreach($bp_room_details->DayRates as $bp_rate_date_brackup) {?>
								<tr>
								  <td class="text-left"><?php echo date_format(date_create($bp_rate_date_brackup->Date),"d M Y");?></td>
								  <td class="text-right"><i class="icofont-rupee"></i> <i class="icofont-rupee"></i> <?php echo round($bp_rate_date_brackup->Amount/$nights);?> </td>
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
										<td class="text-right"><i class="icofont-rupee"></i> <?php echo round($bp_room_details->Price->RoomPrice/$nights);?></td>
									</tr>
									<tr>
										<td class="text-left">Tax</td>
										<td class="text-right"><i class="icofont-rupee"></i> <?php echo round(($bp_customer_price - ($bp_room_details->Price->RoomPrice/$nights)));?></td>
									</tr>
									<tr>
										<td class="text-left">Total Price</td>
										<td class="text-right"><i class="icofont-rupee"></i> <?php echo round($bp_customer_price);?></td>
									</tr>
								</tbody>
							</table>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
					
						<?php } } } }
						else { ?>
						No Rooms Available
						<?php }?>	
						
					<?php }else{ ?>
                    <?php foreach($bp_room_detail as $bp_room_key => $bp_room_details){ ?>  
					<?php $bp_customer_price=bp_get_hotel_fare_pernight($bp_room_details->Price->OfferedPriceRoundedOff,$bp_room_details->Price->PublishedPriceRoundedOff,$nights)['final_fare'];
					?>
						<div class="row">
                        <div class="col-md-10 col-sm-12">
                          <div class="dash-title pt-2 pt-md-3">
                            <h3 class="fz18"><?php echo $bp_room_details->RoomTypeName;?></h3>
                          </div>
                          <ul class="list-inline clearfix mb-0 fare-cncl">
                            <li class="list-inline-item float-left">
                              <h5>Cancellation Detail</h5>
                            </li>
                            <li class="list-inline-item float-right">
							  <a href=".roomfarebreakup_<?php echo $bp_room_key;?>" data-toggle="modal" class="badge danger-bg fz10 mb-10">Fare breakup</a>
                            </li>
                          </ul>
                          <div class="table-responsive">
                            <table class="table table-bordered">
                              <thead>
                                <tr>
                                  <th class="text-center">From Date</th>
                                  <th class="text-center">To Date</th>
                                  <th class="text-center">Charge</th>
                                </tr>
                              </thead>
                              <tbody>
							  	<?php foreach($bp_room_details->CancellationPolicies as $CancellationPolicies){?>
                                <tr>
                                  <td class="text-center"><?php echo date_format(date_create($CancellationPolicies->FromDate),"d M Y");?></td>
                                  <td class="text-center"><?php echo date_format(date_create($CancellationPolicies->ToDate),"d M Y");?></td>
                                  <td class="text-center"><?php if($CancellationPolicies->ChargeType == '1'){ ?> <?php }?> <?php echo round($CancellationPolicies->Charge);?> <?php if($CancellationPolicies->ChargeType == '2'){ echo "%"; }?></td>
                                </tr>
								<?php }?>
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <div class="col-md-2 col-sm-2">
                          <div class="htlcol-price text-right">
            						   <div class="ttl_price d-block mb-1">
                            <small class="htl-dur">Total price</small>
                            <span class="d-block"><i class="icofont-rupee"></i><?php echo round($bp_customer_price*$nights);?></span>
                          </div>
                          <div class="ht-Price d-block mb-1">
                            <small class="htl-dur">Price Per night</small>
                            <span class="d-block">
                              <i class="icofont-rupee"></i><?php echo round(($bp_customer_price));?>
                            </span> 
                          </div>
							<a href="<?php echo site_url();?>hotel/block_room/?room_index=<?php echo $bp_room_details->RoomIndex;?>" class="btn btn-search booknow selectedroom"> Select</a>
                          </div>
                        </div>
                      </div>
					  <div class="modal fade roomfarebreakup_<?php echo $bp_room_key;?>" >
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title fwb">Fare Breakup</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <div class="table-responsive">
                <span class="d-block black-color p-2 light-bg border">Rate Breakup</span>
                <table class="table table-bordered">
                  <tbody>
				  <?php foreach($bp_room_details->DayRates as $bp_rate_date_brackup) {?>
                    <tr>
                      <td class="text-left"><?php echo date_format(date_create($bp_rate_date_brackup->Date),"d M Y");?></td>
                      <td class="text-right"><i class="icofont-rupee"></i> <?php echo round($bp_rate_date_brackup->Amount);?> </td>
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
							<td class="text-right"><i class="icofont-rupee"></i> <?php echo round($bp_room_details->Price->RoomPrice/$nights);?></td>
						</tr>
						<tr>
							<td class="text-left">Tax</td>
							<td class="text-right"><i class="icofont-rupee"></i> <?php echo round(($bp_customer_price - ($bp_room_details->Price->RoomPrice/$nights)));?></td>
						</tr>
						<tr>
							<td class="text-left">Total Price</td>
							<td class="text-right"><i class="icofont-rupee"></i> <?php echo round($bp_customer_price);?></td>
						</tr>
					</tbody>
				</table>
			</div>
</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
					<?php } } ?>
                    </div>
                    <div id="hotel-info" class="tab-pane fade">
                      <div class="dash-title pt-2 pt-md-3">
                        <h3>General: </h3>
                      </div>
                      <ul class="list">
                        <li><?php echo $bp_hotel_detail->Description;?>.</li>
                      </ul>
                    </div>
                    <div id="hotel-facility" class="tab-pane fade">
                        <div class="dash-title pt-2 pt-md-3">
                          <h3>Hotel Facility</h3>
                        </div>
                        <div class="row">
						<?php foreach($bp_hotel_detail->HotelFacilities as $bp_HotelFacilities) { ?>
                          <div class="col-md-3">
                            <div class="htl-facil">
                              <p><i class="icofont-money"></i> <?php echo $bp_HotelFacilities;?></p>
                            </div>
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




<!------end----->




<?php $this->load->view('include/footer');?>
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
