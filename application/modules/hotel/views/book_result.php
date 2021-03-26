<?php $this->load->view('include/header');?>
<?php $this->load->view('include/head');?>


<?php
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
$bp_pax_request = $_SESSION ['hotel'] ['array'] ['search_request'] ['RoomGuests'];
$bp_hotel_block_result=$_SESSION ['hotel'] ['array'] ['hotel_block_result']->BlockRoomResult;
$bp_hotel_one_room_detail=$_SESSION ['hotel'] ['array'] ['hotel_block_result']->BlockRoomResult->HotelRoomsDetails[0];
$bp_customer_price=bp_get_hotel_fare($bp_hotel_one_room_detail->Price->OfferedPriceRoundedOff,$bp_hotel_one_room_detail->Price->PublishedPriceRoundedOff)['final_fare'];
$bp_base_price=$bp_hotel_one_room_detail->Price->RoomPrice;
$bp_publish_fare=$bp_hotel_one_room_detail->Price->PublishedPrice;
$bp_tax=$bp_publish_fare-$bp_base_price;
$_SESSION ['hotel'] ['array'] ['publish_fare'];
$bp_book_result=$_SESSION ['hotel'] ['array'] ['hotel_book_result'];
$bp_hotel_book_request=$_SESSION ['hotel'] ['array'] ['hotel_book_request'];

	$currencyCode = getCurrentCurrency();
	if(count($bp_room_detail) > 0){
		$currencyCode = $bp_room_detail[0]->Price->CurrencyCode;
	}
	$symbol = getCurrencySymbol($currencyCode); 
//PrintArray($bp_book_result);
//PrintArray($bp_hotel_detail);
//PrintArray($_SESSION ['hotel'] ['array'] ['search_request']);
//PrintArray($bp_hotel_book_request['HotelRoomsDetails'] );
?>
<!--------new-------->
<section class="flght-booking-details pt-2 pb-2 pt-md-4 pb-md-4">
	<div class="container">
		<!-- Flight Booking Confirm -->
		<div class="thankyou-confrim">
			<span class="icon">
				<i class="icofont-check-circled"></i>
			</span>
			<h5>Booking Successfully Done.</h5>
			<p class="mb-0">Thank You. Your Booking Order is Confirmed Now.</p>
			<span class="d-block">A confirmation email has been sent to your provided email address.</span>
		</div>
		<!-- Flight Booking Confirm end -->

		<div class="row">
			<div class="col-md-9">
				<div class="flght-booking-left-col flght-booking-confrim-temp">

					<!-- Flight details list oneWay Paul -->
					<div class="flt-booking-wrap mb-2 mb-md-3">
						<div class="flt-booking-top">
							<div class="row">
								<div class="col-md-8">
									<h5>Welcome <span class="font-weight-normal"> <?php print_r($bp_hotel_detail->HotelName) ?> </span></h5>
								</div>
								<div class="col-md-4 d-none">
									<div class="flght-pnr text-md-right">
										<h5>PNR : MH2PST</h5>
									</div>
								</div>
							</div>
						</div>
						<div class="flt-booking-dts">
							<div class="check-out-htl">
								<div class="row">
									<div class="col-md-4">
										<div class="com-chtl">
											<span class="fz-12">Check-in</span>
											<p class="mb-0"><?php echo $bp_hotel_result->HotelSearchResult->CheckInDate;?></p>
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
	                                <p class="mb-0"><?php echo $bp_hotel_result->HotelSearchResult->CheckOutDate;?></p>
	                              </div>
	                            </div>
	                          </div>
	                        </div>
						</div>
					</div><!--/ Flight details list oneWay end Paul -->
					
					<!-- Traveller Details Start From here -->
					<div class="trvl-details">
					<?php foreach($bp_hotel_book_request['HotelRoomsDetails'] as $bp_hotel_room_detail_loop){?>
						<div class="trv-topbar mb-3">
							<div class="flt-booking-top">
								<h5><?php echo $bp_hotel_room_detail_loop['RoomTypeName'];?></h5>
							</div>
							 <?php foreach($bp_hotel_room_detail_loop['HotelPassenger'] as $bp_hotel_pax_loop){ ?>
							<div class="flt-booking-dts">
								<div class="col-fly-inn">
									<p class="mb-0"><?php echo $bp_hotel_pax_loop['Title'];?> <?php echo $bp_hotel_pax_loop['FirstName'];?> <?php echo $bp_hotel_pax_loop['LastName'];?></p>
								</div>
							</div>
							<?php }?>
						</div>
					<?php }?>	
									
					<div class="trv-topbar">
							<div class="flt-booking-top">
								<h5>Contact Details</h5>
							</div>
							<div class="flt-booking-dts">
								<div class="col-fly-inn">
									<p class="mb-0"><strong>Address:</strong> <?php echo $bp_hotel_detail->Address;?></p>
									<p class="mb-0"><strong>Mobile No:</strong> <?php if($bp_hotel_detail->HotelContactNo){echo "<i class='fa fa-phone'></i>".$bp_hotel_detail->HotelContactNo;} else{ echo "Contact details are not available"; } ?></p>
								</div>
							</div>
						</div>
					</div><!--/ Traveller Details Start From here -->


					
				</div>
			</div>
			<div class="col-md-3">
				<div class="flght-side-det">
					<div class="review_title clearfix">
		              <h4 class="">Fare Details</h4>
		            </div>
		            <div class="contant">
		            	<ul class="fare_details list-unstyled mb-0">
		            		<li>Base Fare <span class="float-right"><?= $symbol ?> <?php echo round($bp_hotel_one_room_detail->Price->RoomPrice);?></span></li>
		            		<li>Tax (+)<span class="float-right"><?= $symbol ?> <?php echo round($bp_customer_price + $bp_hotel_detailq->hotboli_transaction_fee  -$bp_hotel_one_room_detail->Price->RoomPrice);?></span></li>
		            		<li>Total Fare<span class="float-right"><?= $symbol ?> <?php echo round($bp_customer_price + $bp_hotel_detailq->hotboli_transaction_fee) ;?></span></li>
		            	</ul>
		            </div>
		        </div>
		        <div class="flght-book-btn mt-3">
		        	<ul class="list-inline mb-0 clearfix">
		        		<li class="list-inline-item float-md-left">
		        			<a target="_blank" href="<?php echo site_url(); ?>hotel/print_ticket?ref_id=<?php echo url_encode($bp_hotel_detailq->hotboli_id)?>" class="ic-btn" target="_blank"><i class="icofont-print"></i> Voucher</a>
		        		</li>
		        	</ul>
		        </div>
			</div>
		</div>
	</div>
</section>
<!-- Flight Booking Details End -->

<!--------new end--------->

	
<?php $this->load->view('include/footer') ; ?>