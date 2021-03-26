<?php $this->load->view('include/head');
$this->load->view('include/header'); ?>

<!-- Flight Booking Details -->
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
									<h5>Flight Detail (Delhi To Jaipur, depart - 25 May 2019 )</h5>
								</div>
								<div class="col-md-4">
									<div class="flght-pnr text-md-right">
										<h5>PNR : MH2PST</h5>
									</div>
								</div>
							</div>
						</div>
						<div class="flt-booking-dts">
							<div class="row">
								<div class="col-md-3 col-sm-3 col-6">
									<div class="airline-logo fl-o-way-com">
										<span class="air-brand">
											<img src="assets/images/6E.gif" alt="">
										</span>
										<h6>Air India</h6>
										<span class="text-muted d-block">AI-469</span>
									</div>
								</div>
								<div class="col-md-3 col-sm-3 col-6">
									<div class="dep-dr fl-o-way-com txt-right">
										<h6>22:00</h6>
										<p class="mb-0">Del</p>
										<span class="text-muted d-block">New Delhi</span>
									</div>
								</div>
								<div class="col-md-1 col-sm-1 d-none d-md-flex">
									<div class="flt-boo-arw fl-o-way-com text-center">
										<i class="icofont-long-arrow-right"></i>
									</div>
								</div>
								<div class="col-md-3 col-sm-3 col-6">
									<div class="arv-dr fl-o-way-com txt-lt">
										<h6>01:15</h6>
										<p class="mb-0">CJB</p>
										<span class="text-muted d-block">Coimbatore</span>
									</div>
								</div>
								<div class="col-md-2 col-sm-3 col-6">
									<div class="st-prc-flt fl-o-way-com txt-right">
										<h6>3h 15m</h6>
										<p class="mb-0 stp">Non stop</p>
										<span class="text-muted d-block trv-cls">Economy</span>
									</div>
								</div>
							</div>
						</div>
					</div><!--/ Flight details list oneWay end Paul -->
					
					<!-- Traveller Details Start From here -->
					<div class="trvl-details">
						<div class="trv-topbar mb-3">
							<div class="flt-booking-top">
								<h5>Passenger Detail</h5>
							</div>
							<div class="flt-booking-dts">
								<div class="col-fly-inn">
									<p class="mb-0"><strong>Adult -</strong> Mr SK Paul</p>
								</div>
							</div>
						</div>
				
						<div class="trv-topbar">
							<div class="flt-booking-top">
								<h5>Contact Details</h5>
							</div>
							<div class="flt-booking-dts">
								<div class="col-fly-inn">
									<p class="mb-0"><strong>Email:</strong> sk@gmail.com</p>
									<p class="mb-0"><strong>Mobile No:</strong> 8498987898</p>
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
		            		<li>Base Fare <span class="float-right"><i class="icofont-rupee"></i> 3499</span></li>
		            		<li>Tax (+)<span class="float-right"><i class="icofont-rupee"></i> 2082.8</span></li>
		            		<li>Total Fare<span class="float-right"><i class="icofont-rupee"></i>5581.8</span></li>
		            	</ul>
		            </div>
		        </div>
		        <div class="flght-book-btn mt-3">
		        	<ul class="list-inline mb-0 clearfix">
		        		<li class="list-inline-item float-md-left">
		        			<a href="print_ticket.php" class="ic-btn" target="_blank"><i class="icofont-print"></i> Print Ticket</a>
		        		</li>
		        		<li class="list-inline-item float-md-right">
		        			<a href="print_invoice.php" class="ic-btn" target="_blank"><i class="icofont-printer"></i> Print Invoice</a>
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
									<h5>12 Feb 2019, Tue</h5>
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