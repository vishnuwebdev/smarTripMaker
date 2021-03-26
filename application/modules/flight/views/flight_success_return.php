<?php 
	$this->load->view('include/head');
	$this->load->view('include/header'); 
	$FareBreakdown = $SelectedFare->Response->Response->FlightItinerary->Passenger;

?>

<!-- Flight Booking Details -->
<section class="flght-booking-details pt-2 pb-2 pt-md-4 pb-md-4">
	<div class="container">
		<!-- Flight Booking Confirm -->
		<div class="thankyou-confrim">
			<span class="icon">
				<i class="icofont-check-circled"></i>
			</span>
			<h5>Booking Successfully Done.</h5>
			<p class="mb-0">Thank You. Your Booking Id : STM00<?php echo $BookingDetails->fbook_id; ?>  is Confirmed Now.</p>
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
									<h5>Onward Flight Details (<b><?php echo $BookingDetails->fbook_depart_city; ?></b> To <b><?php echo $BookingDetails->fbook_arrive_city; ?></b>, depart - <b><?php
                                      $dateformat = date_format(date_create($BookingDetails->fbook_depart_date), "d M Y");
                                      echo $dateformat;
                                       ?> </b>) </h5>
									   
								</div>
								<div class="col-md-4">
									<div class="flght-pnr text-md-right">
										<h5>PNR : <?php echo $SelectedFare->Response->Response->FlightItinerary->PNR; ?></h5>
									</div>
								</div>
							</div>
						</div>
						
						 <?php
						foreach ($SelectedFare->Response->Response->FlightItinerary->Segments as $seg => $segmentloop) {
							?>

						<div class="flt-booking-dts">
							<div class="row">
								<div class="col-md-3 col-sm-3 col-6">
									<div class="airline-logo fl-o-way-com">
										<span class="air-brand">
											 <img src="<?php echo site_url(); ?>assets/images/airlines/<?php echo $segmentloop->Airline->AirlineCode; ?>.gif" />
										</span>
										<h6><?php echo $segmentloop->Airline->AirlineName; ?></h6>
										<span class="text-muted d-block"><?php echo $segmentloop->Airline->AirlineCode . "-" . $segmentloop->Airline->FlightNumber; ?></span>
									</div>
								</div>
								<div class="col-md-3 col-sm-3 col-6">
									<div class="dep-dr fl-o-way-com txt-right">
										<h6><?php echo GetTime($segmentloop->Origin->DepTime); ?> | <?php echo GetDateScFull($segmentloop->Origin->DepTime); ?></h6>
										<p class="mb-0"><?php echo $segmentloop->Origin->Airport->AirportCode; ?></p>
										<span class="text-muted d-block"><?php echo $segmentloop->Origin->Airport->AirportName; ?></span>
									</div>
								</div>
								<div class="col-md-1 col-sm-1 d-none d-md-flex">
									<div class="flt-boo-arw fl-o-way-com text-center">
										<i class="icofont-long-arrow-right"></i>
									</div>
								</div>
								<div class="col-md-3 col-sm-3 col-6">
									<div class="arv-dr fl-o-way-com txt-lt">
										<h6><?php echo GetTime($segmentloop->Destination->ArrTime); ?> | <?php echo GetDateScFull($segmentloop->Destination->ArrTime); ?></h6>
										<p class="mb-0"><?php echo $segmentloop->Destination->Airport->AirportCode; ?></p>
										<span class="text-muted d-block"><?php echo $segmentloop->Destination->Airport->AirportName; ?></span>
									</div>
								</div>
								<div class="col-md-2 col-sm-3 col-6">
									<div class="st-prc-flt fl-o-way-com txt-right">
										<h6><?php echo minute_to_hour($segmentloop->Duration); ?></h6>
										<!--<p class="mb-0 stp">Non stop</p>
										<span class="text-muted d-block trv-cls">Economy</span>
										-->
									</div>
								</div>
							</div>
						</div>
						
						<?php }?>
					</div><!--/ Flight details list oneWay end Paul -->
					
					<!-- Flight details list Return Paul -->
					<div class="flt-booking-wrap mb-2 mb-md-3">
						<div class="flt-booking-top">
							<div class="row">
								<div class="col-md-8">
									<h5>Return Flight Details (<b><?php echo $BookingDetails->fbook_arrive_city; ?></b> To <b><?php echo $BookingDetails->fbook_depart_city; ?></b>, depart - <b><?php
                                      $dateformat = date_format(date_create($BookingDetails->fbook_return_date), "d M Y");
                                      echo $dateformat;
                                       ?> </b>) </h5>
									   
								</div>
								<div class="col-md-4">
									<div class="flght-pnr text-md-right">
										<h5>PNR : <?php echo $SelectedFareIB->Response->Response->FlightItinerary->PNR; ?></h5>
									</div>
								</div>
							</div>
						</div>
						
						 <?php
						foreach ($SelectedFareIB->Response->Response->FlightItinerary->Segments as $seg => $segmentloop) {
							?>

						<div class="flt-booking-dts">
							<div class="row">
								<div class="col-md-3 col-sm-3 col-6">
									<div class="airline-logo fl-o-way-com">
										<span class="air-brand">
											 <img src="<?php echo site_url(); ?>assets/images/airlines/<?php echo $segmentloop->Airline->AirlineCode; ?>.gif" />
										</span>
										<h6><?php echo $segmentloop->Airline->AirlineName; ?></h6>
										<span class="text-muted d-block"><?php echo $segmentloop->Airline->AirlineCode . "-" . $segmentloop->Airline->FlightNumber; ?></span>
									</div>
								</div>
								<div class="col-md-3 col-sm-3 col-6">
									<div class="dep-dr fl-o-way-com txt-right">
										<h6><?php echo GetTime($segmentloop->Origin->DepTime); ?> | <?php echo GetDateScFull($segmentloop->Origin->DepTime); ?></h6>
										<p class="mb-0"><?php echo $segmentloop->Origin->Airport->AirportCode; ?></p>
										<span class="text-muted d-block"><?php echo $segmentloop->Origin->Airport->AirportName; ?></span>
									</div>
								</div>
								<div class="col-md-1 col-sm-1 d-none d-md-flex">
									<div class="flt-boo-arw fl-o-way-com text-center">
										<i class="icofont-long-arrow-right"></i>
									</div>
								</div>
								<div class="col-md-3 col-sm-3 col-6">
									<div class="arv-dr fl-o-way-com txt-lt">
										<h6><?php echo GetTime($segmentloop->Destination->ArrTime); ?> | <?php echo GetDateScFull($segmentloop->Destination->ArrTime); ?></h6>
										<p class="mb-0"><?php echo $segmentloop->Destination->Airport->AirportCode; ?></p>
										<span class="text-muted d-block"><?php echo $segmentloop->Destination->Airport->AirportName; ?></span>
									</div>
								</div>
								<div class="col-md-2 col-sm-3 col-6">
									<div class="st-prc-flt fl-o-way-com txt-right">
										<h6><?php echo minute_to_hour($segmentloop->Duration); ?></h6>
										<!--<p class="mb-0 stp">Non stop</p>
										<span class="text-muted d-block trv-cls">Economy</span>
										-->
									</div>
								</div>
							</div>
						</div>
						
						<?php }?>
					</div><!--/ Flight details list oneWay end Paul -->
					
					
					
					<!-- Traveller Details Start From here -->
					<div class="trvl-details">
						<div class="trv-topbar mb-3">
							<div class="flt-booking-top">
								<h5>Passenger Detail</h5>
							</div>
							<?php
								$baggageTotalWeight = $BookingDetails->fbook_ib_baggage_weight + $BookingDetails->fbook_ob_baggage_weight;
							?>
							<div class="flt-booking-dts">
							 <?php foreach ($PaxDetails as $PaxDetails23) { ?>
								<div class="row flt-booking-dts">
									<div class="col-md-5 col-sm-5 col-6">
										<div class="fl-o-way-com">
											<p class="mb-0"><strong>
												<?php echo $PaxDetails23->fpax_type; ?> -</strong>  <?php echo $PaxDetails23->fpax_title; ?> <?php echo $PaxDetails23->fpax_first_name; ?> <?php echo $PaxDetails23->fpax_last_name; ?> 
											</p>
										</div>
									</div>
									<?php if(isset($PaxDetails23->fpax_baggage_weight) && !empty($PaxDetails23->fpax_baggage_weight)){?>
										<div class="col-md-3 col-sm-3 col-6">
											<div class="dep-dr fl-o-way-com txt-right">
												<!-- <i class="icofont-school-bag font-22"></i>  -->
												<strong>Baggage Detail : </strong>
												<?php 
													//echo ($PaxDetails23->fpax_baggage_weight) ? $PaxDetails23->fpax_baggage_weight. 'KG' : ''; 
													echo (isset($baggageTotalWeight) && $baggageTotalWeight > 0 ) ? $baggageTotalWeight." KG" : null; 
												?>
											</div>
										</div>
									<?php } ?>
									<?php if(isset($PaxDetails23->fpax_meal_item) && !empty($PaxDetails23->fpax_meal_item)){?>
										<div class="col-md-4 col-sm-4 col-6">
											<div class="arv-dr fl-o-way-com txt-lt">
												<!-- <i class="icofont-fast-food font-22"></i>  -->
												<strong>Meal & Bavrages : </strong>
												<?php print_r($PaxDetails23->fpax_meal_item); ?>
											</div>
										</div>
									<?php } ?>
								</div>
							 <?php }?>
							</div>
						</div>
				
						<div class="trv-topbar">
							<div class="flt-booking-top">
								<h5>Contact Details</h5>
							</div>
							<div class="flt-booking-dts">
								<div class="col-fly-inn">
									<p class="mb-0"><strong>Email:</strong> <?php echo $PaxDetails[0]->fpax_email; ?></p>
									<p class="mb-0"><strong>Mobile No:</strong> <?php echo $PaxDetails[0]->fpax_mobile; ?></p>
								</div>
							</div>
						</div>
					</div>
					<!--/ Traveller Details Start From here -->
					
				</div>
			</div>
			
			<div class="col-md-3">
				<div class="flght-side-det">
					<div class="review_title clearfix">
		              <h4 class="">Fare Details</h4>
		            </div>
		            <div class="contant">
		            	<ul class="fare_details list-unstyled mb-0">
						<li><strong>Onward</strong></li>
							<?php
								$baggage = $BookingDetails->fbook_ob_baggage_amount;
							?>
		            		<li>Base Fare <span class="float-right"><i class="icofont-rupee"></i> <?php echo $SelectedFare->Response->Response->FlightItinerary->Fare->BaseFare; ?></span></li>
		            		<li>Tax (+)<span class="float-right"><i class="icofont-rupee"></i>  <?php echo ($BookingDetails->fbook_customer_fare  - $SelectedFare->Response->Response->FlightItinerary->Fare->BaseFare) - $baggage; ?></span></li>
							<li>Baggage Fare<span class="float-right"><i class="icofont-rupee"></i>  <?php echo $baggage ?></span></li>
							<li>Meals Fare<span class="float-right"><i class="icofont-rupee"></i>  <?php echo $BookingDetails->fbook_ob_meals_amount ?></span></li>
		            		<li>Total Fare<span class="float-right"><i class="icofont-rupee"></i><?php echo $BookingDetails->fbook_customer_fare; ?></span></li>
		            	</ul>
		            </div>
					<div class="contant">
		            	<ul class="fare_details list-unstyled mb-0">
						<li><strong>Return</strong></li>
							<?php
								$baggage = $BookingDetails->fbook_ib_baggage_amount;
							?>
		            		<li>Base Fare <span class="float-right"><i class="icofont-rupee"></i> <?php echo $SelectedFareIB->Response->Response->FlightItinerary->Fare->BaseFare; ?></span></li>
		            		<li>Tax (+)<span class="float-right"><i class="icofont-rupee"></i> <?php echo ($BookingDetails->fbook_ib_total_fare + $BookingDetails->fbook_transaction_fee - $SelectedFareIB->Response->Response->FlightItinerary->Fare->BaseFare)-$baggage; ?></span></li>
							<li>Baggage Fare<span class="float-right"><i class="icofont-rupee"></i>  <?php echo $baggage ?></span></li>
							<li>Meals Fare<span class="float-right"><i class="icofont-rupee"></i>  <?php echo $BookingDetails->fbook_ib_meals_amount ?></span></li>
		            		<li>Total Fare<span class="float-right"><i class="icofont-rupee"></i><?php echo $BookingDetails->fbook_ib_total_fare + $BookingDetails->fbook_transaction_fee; ?></span></li>
							<li><strong>Grand Fare<span class="float-right"><i class="icofont-rupee"></i> <?php echo $BookingDetails->fbook_customer_fare+$BookingDetails->fbook_ib_total_fare + $BookingDetails->fbook_transaction_fee; ?></span></strong></li>
		            	</ul>
		            </div>
		        </div>
		        <div class="flght-book-btn mt-3">
		        	<ul class="list-inline mb-0 clearfix">
		        		<li class="list-inline-item float-md-left">
		        			<a href="<?php echo site_url(); ?>flight/print_ticket?ref_id=<?php echo bp_hash(url_decode($_GET ['ref_no'])); ?>" class="ic-btn" target="_blank"><i class="icofont-print"></i> Print Ticket</a>
		        		</li>
		        		<li class="list-inline-item float-md-right">
		        			<a href="<?php echo site_url(); ?>flight/print_invoice/?ref_id=<?php echo bp_hash(url_decode($_GET ['ref_no'])); ?>" class="ic-btn" target="_blank"><i class="icofont-printer"></i> Print Invoice</a>
		        		</li>
		        	</ul>
		        </div>
			</div>
		</div>
	</div>
</section>
<!-- Flight Booking Details End -->



<div class="modal fade" id="confirm-booking-pop">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Please Confrim your Flight</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
				<div class="confirm-flght-details">
					<div class="row">
						<div class="col-md-8">
							<div class="flt-dts">
								<div class="flt-booking-top">
									<h5>12 Feb 2019, Tue fgfh</h5>
								</div>
								<div class="flt-booking-dts">
									<div class="row">
										<div class="col-md-4 col-sm-6">
											<div class="airline-logo fl-o-way-com">
												<span class="air-brand">
													<img src="assets/images/6E.gif" alt="">
												</span>
												<h6>Air India</h6>
												<span class="text-muted d-block">AI-469</span>
											</div>
										</div>
										<div class="col-md-3 col-sm-6">
											<div class="dep-dr fl-o-way-com">
												<h6>22:00</h6>
												<p class="mb-0">Del</p>
												<span class="text-muted d-block">New Delhi</span>
											</div>
										</div>
										<div class="col-md-3 col-sm-6">
											<div class="arv-dr fl-o-way-com">
												<h6>01:15</h6>
												<p class="mb-0">CJB</p>
												<span class="text-muted d-block">Coimbatore</span>
											</div>
										</div>
										<div class="col-md-2 col-sm-6">
											<div class="st-prc-flt fl-o-way-com">
												<h6>3h 15m</h6>
												<p class="mb-0 stp">Non stop</p>
												<span class="text-muted d-block trv-cls">Economy</span>
											</div>
										</div>
									</div>
								</div>
							</div>
							
							
							

							<div class="flt-dts">
								<div class="flt-booking-top">
									<h5>Passenger Detail</h5>
								</div>
								<div class="flt-booking-dts">
									<p class="mb-0">Mr Sk Paul </p>
								</div>
							</div>

							<div class="flt-dts">
								<div class="flt-booking-top">
									<h5>Contact Detail</h5>
								</div>
								<div class="flt-booking-dts">
									<p class="mb-2"><strong>Email:</strong> sk@gmail.com</p>
									<p class="mb-0"><strong>Mobile No:</strong> 9848498484</p>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="flght-side-det mb-2">
								<div class="review_title clearfix">
					              <h4 class="">Fare Details</h4>
					            </div>
					            <div class="contant">
					            	<ul class="fare_details list-unstyled mb-0">
					            		<li>Base Fare <span class="float-right"><i class="icofont-rupee"></i> 3499</span></li>
					            		<li>Tax (+)<span class="float-right"><i class="icofont-rupee"></i> 2082.8</span></li>
					            		<li>Total Fare<span class="float-right"><i class="icofont-rupee"></i>5581.8</span></li>
					            	</ul>
					            </div>
					        </div>
					        <ul class="mb-0 list-unstyled flt-side-dts">
					        	<li><button type="button" class="btn btn-search w-100 mb-2" data-dismiss="modal">Proceed Payment</button></li>
					        	<li><button type="button" class="btn btn-danger w-100" data-dismiss="modal">Close</button></li>
					        </ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>







<?php $this->load->view('include/footer'); ?>
<?php $this->load->view('js'); ?>