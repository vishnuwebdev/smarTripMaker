
<?php $this->load->view('header');?>
<?php
$bp_hotel_result = $_SESSION['Hotel_Offline'] ['array'];
$bp_room_detail = $_SESSION ['hotel'] ['array'] ['hotel_room_result'];
$bp_rooms = $bp_hotel_result['room'];
$bp_nights = $bp_hotel_result['nights'];
// echo"<pre>";
// print_r($bp_room_detail);
// die; 
// foreach ( $bp_room_detail->result as $no_of_room_loop ) {
	// $bp_rooms = $bp_rooms + 1;
	// $bp_adult = $bp_adult + $no_of_room_loop->adult_1;
	// $bp_child = $bp_child + $no_of_room_loop->child_1;
// }
$bp_search_request = $_SESSION['Hotel_Offline'] ['array'];
?>
<style>
	@media screen and (min-width:768px){
		.htlcol-price {
			padding-top: 45%;
		}
	}
</style>

 <div class="main-field">
      <div class="container">
        <div class="flght-booking-details hotl-booking-wrap">
          <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12">
              <div class="hotl-booking-temp">
                <!-- <h1><?php echo $bp_room_detail->result[0]->hofl_hotel_name;?></h1> -->
                <!-- slider here -->
                <div class="hotel-carousel owl-carousel">
					<?php if(isset($bp_room_detail->hofhim_image)){?>
						<?php if(is_array($bp_room_detail->hofhim_image)){?>
							<?php foreach($bp_room_detail->hofhim_image as $hptel_image_key => $bp_hotel_images){?>
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
					<?php if($bp_room_detail['result'][0]->hofl_address!=""){?>
						<li><i class="icofont-google-map"></i> <strong>Address : </strong><?php echo $bp_room_detail['result'][0]->hofl_address;?>, <?php echo $bp_room_detail['result'][0]->hofl_city;?>, <?php echo $bp_room_detail['result'][0]->hofl_state;?></li>
					<?php }?>
					<?php if($bp_room_detail['result'][0]->hofl_country!=""){?>
						<li><i class="icofont-google-map"></i> <strong>Country : </strong><?php echo $bp_room_detail['result'][0]->hofl_country;?></li>
					<?php }?>
					<?php if($bp_room_detail['result'][0]->hofl_pincode!=""){?>
						<li> <i class="icofont-pin"></i><strong>Pincode : </strong><?php echo $bp_room_detail['result'][0]->hofl_pincode;?></li>
					<?php }?>
					<?php if($bp_room_detail['result'][0]->hofl_mobile!="" || $bp_room_detail['result'][0]->hofl_phone!=""){?>
						<li> <i class="icofont-phone"></i><strong>Contact Number : </strong><?php echo $bp_room_detail['result'][0]->hofl_mobile;?>, <?php echo $bp_room_detail['result'][0]->hofl_phone;?></li>
					<?php }?>
					<?php if($bp_room_detail['result'][0]->hofl_email!=""){?>
						<li><i class="icofont-envelope-open"></i> <strong>Email : </strong><?php echo $bp_room_detail['result'][0]->hofl_email;?></li>
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
							<?php foreach($bp_room_detail['result'] as $bp_room_key => $bp_room_details) {?>
							
									
									<!-- hresult-box ends from here -->
									<div class="modal fade mk-modal roomfarebreakup_<?php echo $bp_room_details->hoffr_id;?>">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
													<h4 class="modal-title"><?php echo $bp_room_details->hoffr_room_type;?> Fare Breakup</h4>
												</div>
												<div class="modal-body">
													<div class="table-responsive">
														<span class="block black-color p710 light-bg border">Rate Breakup</span>
														<table class="table table-bordered">
															<tbody>
																<tr>
																	<td class="text-right"><i class=""><?php echo $this->bp_white_label_setting->wls_currency_symbol;?></i> <?php echo dsa_currency_convert($bp_room_details->hoffr_publish_price) ;?> </td>
																</tr>		
															</tbody>
														</table>
													</div>
													<div class="table-responsive">
														<span class="block black-color p710 light-bg border">Rate Summary</span>
														<table class="table table-bordered">
															<tbody>
																<tr>
																	<td class="text-left">Room Price</td>
																	<td class="text-right"><i class=""><?php echo $this->bp_white_label_setting->wls_currency_symbol;?></i> <?php echo dsa_currency_convert($bp_room_details->hoffr_publish_price);?></td>
																</tr>
																<tr>
																	<td class="text-left">Tax</td>
																	<td class="text-right"><i class=""><?php echo $this->bp_white_label_setting->wls_currency_symbol;?></i> <?php echo dsa_currency_convert($bp_room_details->hoffr_tax);?></td>
																</tr>
																<tr>
																	<td class="text-left">Total Price</td>
																	<td class="text-right"><i class=""><?php echo $this->bp_white_label_setting->wls_currency_symbol;?></i> <?php echo dsa_currency_convert($bp_room_details->hoffr_basic_fare);?></td>
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
								  <?php } //} }}else{?>
                    	
				  

                    	<?php foreach($bp_room_detail['result'] as $bp_room_key => $bp_room_details){
							
							 ?>
						
                    <?php
					//$bp_customer_price=dsa_currency_convert($bp_room_details->Price->PublishedPriceRoundedOff);
					//$bp_customer_price=bp_get_hotel_fare($bp_room_details->Price->OfferedPriceRoundedOff,$bp_room_details->Price->PublishedPriceRoundedOff)['final_fare'];
					?>
                    <!-- hresult-box starts from here -->
										<div class="row">
											<div class="col-md-10 col-sm-12">
												<div class="dash-title">
													<h3 class="fz18"><?php echo $bp_room_details->hoffr_room_type ;?></h3>
												</div>
												<h5>Terms And Conditions</h5>
												<div class="table-responsive">
													<table class="table table-bordered table-hover table-striped">
														<tbody>
															<tr>
																<th class="text-center">Terms And Conditions</th>
															</tr>
																<tr>
																		<td class="text-center"><?php echo $bp_room_details->hofl_terms_condition ; ?></td>
																	</tr>
														</tbody>
													</table>
												</div>
											</div>
											<div class="col-md-2 col-sm-2">
												<div class="htlcol-price text-center">
												<span class="ht-Price ds-block mb-10 mainprice"><i class=""><?php echo $this->bp_white_label_setting->wls_currency_symbol;?></i>&nbsp; <?php echo dsa_currency_convert($bp_room_details->hoffr_publish_price *$bp_rooms *$bp_nights);?></span> 
												<a href="#roomfarebreakup_<?php echo $bp_room_details->hoffr_id; ?>" data-toggle="modal" class="badge danger-bg fz10 mb-10">Fare breakup</a> 
												<a href="<?php echo site_url();?>hotel/book_room/?room_index=<?php echo url_encode($bp_room_details->hoffr_id);?>&hotel_id=<?php echo url_encode($bp_room_details->hofl_id);?>" class="booknow selectedroom btn btn-org t-white"> Select</a>
											</div>
										</div>
									
									<!-- hresult-box ends from here -->
									<div class="modal fade mk-modal" id="roomfarebreakup_<?php echo $bp_room_details->hoffr_id;?>">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
													<h4 class="modal-title"><?php echo $bp_room_details->hoffr_room_type;?> Fare Breakup</h4>
												</div>
												<div class="modal-body">
													<div class="table-responsive">
														<span class="block black-color p710 light-bg border">Rate Breakup</span>
														<table class="table table-bordered">
															<tbody>
																<tr>
																	<td class="text-right"><i class=""><?php echo $this->bp_white_label_setting->wls_currency_symbol;?></i> <?php echo dsa_currency_convert($bp_room_details->hoffr_publish_price *$bp_rooms *$bp_nights) ;?> </td>
																</tr>		
															</tbody>
														</table>
													</div>
													<div class="table-responsive">
														<span class="block black-color p710 light-bg border">Rate Summary</span>
														<table class="table table-bordered">
															<tbody>
																<tr>
																	<td class="text-left">Room Price</td>
																	<td class="text-right"><i class=""><?php echo $this->bp_white_label_setting->wls_currency_symbol;?></i> <?php echo dsa_currency_convert($bp_room_details->hoffr_publish_price *$bp_rooms *$bp_nights);?></td>
																</tr>
																<tr>
																	<td class="text-left">Tax</td>
																	<td class="text-right"><i class=""><?php echo $this->bp_white_label_setting->wls_currency_symbol;?></i> <?php echo dsa_currency_convert($bp_room_details->hoffr_tax);?> * <?php echo $bp_rooms ?> Rooms * <?php echo $bp_nights ?> Nights</td>
																</tr>
																<tr>
																	<td class="text-left">Total Price</td>
																	<td class="text-right"><i class=""><?php echo $this->bp_white_label_setting->wls_currency_symbol;?></i> <?php echo dsa_currency_convert($bp_room_details->hoffr_basic_fare);?> * <?php echo $bp_rooms ?> Rooms * <?php echo $bp_nights ?> Nights</td>
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
                 		<?php  }  //}?>
                  </div>

                  <div id="hotel-info" class="tab-pane fade">
				  <div class="hotelBox hresult-box relative mb15">
										<p><?php echo $bp_room_detail['result'][0]->hofl_detail;?></p>
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
							<?php 
							foreach($bp_room_detail['hotel_facilities'] as $bp_HotelFacilities) {?>
								<div class="col-sm-4 mb-5">
										<i class="fa <?php echo $bp_HotelFacilities->hofff_icon; ?>"></i>&nbsp;&nbsp;<?php echo $bp_HotelFacilities->hofff_facility_name;?>
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
