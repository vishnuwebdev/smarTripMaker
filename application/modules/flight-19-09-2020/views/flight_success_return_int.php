<?php $this->load->view('include/head');
$this->load->view('include/header'); 

//print_r($SelectedFare->Response);
//die;
$FareBreakdown = $SelectedFare->Response->Response->FlightItinerary->Passenger;
?>
<link href="<?php echo site_url(); ?>assets/css/bootstrap.min_3.css" media="screen" rel="stylesheet" type="text/css"/>
<!--
<style type="text/css">
    a.btn.btn-primary {
           border-radius: 30px;
    color: #fff;
    font-size: 14px !important;
    padding: 7px 22px;
}
   .list-group-item.active, .list-group-item.active:focus, .list-group-item.active:hover {
    z-index: 2;
    color: #fff;
    background-color: #010202;
    border-color: #010202;
} 
   
.alert-success {
    color: #7a3f60;
    background-color: #e8c1d8;
    border-color: #c191ab;
}
.fare_details {
    padding-left: 0px;
    list-style: none;
    margin-bottom: 0;
    width: 100%;
}   
</style>
-->
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
			 
			  <!--Oneway-->
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
                 <div class="">
                   
                     <li class="list-group-item"><b class="fn"> 
  <?php 
        foreach ($SelectedFare->Response->Response->FlightItinerary->Segments as $seg => $segmentloop){
            
            // echo "<pre>";
            // print_r($segmentloop);
            // die;
            if($segmentloop->TripIndicator == 1){
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
								
							</div>
						</div>	
					</div>
					</div>
            <?php   } } ?>
         </b> 
		 </li>
              </div>
                 </div>
				  <!--End Oneway-->
				 
				 <!--Return-->
                 
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
								<h5>PNR : <?php echo $SelectedFare->Response->Response->FlightItinerary->PNR; ?></h5>
							</div>
						</div>
					</div>
				</div>
                 <div class="">
                   
                     <li class="list-group-item"><b class="fn"> 
  <?php 
        foreach ($SelectedFare->Response->Response->FlightItinerary->Segments as $seg => $segmentloop){
            
            if($segmentloop->TripIndicator == 2){
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
								
							</div>
						</div>	
					</div>
					</div>
            <?php  } } ?>
         </b> </li>
              </div>
                 </div>
             
				<!--End Return-->
				
			 
					<!-- Traveller Details Start From here -->
					<div class="trvl-details">
						<div class="trv-topbar mb-3">
							<div class="flt-booking-top">
								<h5>Passenger Detail</h5>
							</div>
							<div class="flt-booking-dts">
							 <?php foreach ($PaxDetails as $PaxDetails23) { ?>
								<div class="col-fly-inn">
									<p class="mb-0"><strong>
									<?php echo $PaxDetails23->fpax_type; ?> -</strong>  <?php echo $PaxDetails23->fpax_title; ?> <?php echo $PaxDetails23->fpax_first_name; ?> <?php echo $PaxDetails23->fpax_last_name; ?> 
									</p>
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
			 
			 
			 
             
            <div class="col-md-3">
				<div class="flght-side-det">
					<div class="review_title clearfix">
		              <h4 class="">Fare Details</h4>
		            </div>
		            <div class="contant">
		            	<ul class="fare_details list-unstyled mb-0">
		            		<li>Base Fare <span class="float-right"><i class="icofont-rupee"></i> <?php echo $SelectedFare->Response->Response->FlightItinerary->Fare->BaseFare; ?></span></li>
		            		<li>Tax (+)<span class="float-right"><i class="icofont-rupee"></i> <?php echo $BookingDetails->fbook_customer_fare + $BookingDetails->fbook_transaction_fee - $SelectedFare->Response->Response->FlightItinerary->Fare->BaseFare; ?></span></li>
		            		<li>Total Fare<span class="float-right"><i class="icofont-rupee"></i><?php echo $BookingDetails->fbook_customer_fare + $BookingDetails->fbook_transaction_fee; ?></span></li>
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
<?php 
//echo "<pre>";
//print_r($BookingDetails);
//echo "</pre>";
?>	
<?php
$this->load->view("include/footer"); ?>

