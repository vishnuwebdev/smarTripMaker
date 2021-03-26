<?php
$this->load->view("header");

//print_r($SelectedFare->Response);
//die;
$FareBreakdown = $SelectedFare->Response->FlightItinerary->Passenger;
?>

<link href="<?php echo site_url(); ?>assets/css/bootstrap.min_3.css" media="screen" rel="stylesheet" type="text/css"/>
<style type="text/css">
    a.btn.btn-primary {
        border-radius: 30px;
    color: #fff;
    font-size: 14px !important;
    padding: 9px 18px;
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
<body>
    
    
<div class="page-title-container">
            <div class="container">
                <div class="page-title pull-left">
                    <h2 class="entry-title"></h2>
                </div>
               
            </div>
        </div>
		<section id="content" class="gray-area">
            <div class="container">
                <div class="row thumbnail">
                    
                    
                    <div class=" col-md-12 container alert alert-success">
                    <div class="col-md-2 col-sm-2">
                        <span class="fa fa-check-circle-o" aria-hidden="true" style="font-size: 150px"></span> 
                    </div>
                    <div  class="col-sm-10 col-md-10">
                        
                        <div class="booking-information travelo-box">
                            
                            <h3>Booking Successfully Done.</h3>
                         
                            <div class="booking-confirmation clearfix">
                                <i class="soap-icon-recommend icon circle"></i>
                                <div class="message">
                                    <h4 class="main-message">Thank You. Your Booking Order is Confirmed Now.</h4>
                                    <p>A confirmation email has been sent to your provided email address.</p>
                                </div>
								
								
                            </div>
                           
                           
                        </div>
                    </div>
                    </div>
                    <div class=" col-md-12 thumbnail" style="background: #f9f9f9;">
                        <div class="col-md-6">
                            <h3 style="color: #793f5f"><b>Flight Detail</b></h3>
                        </div>
                        <div class="col-md-6 ">
                            <h3 class="pull-right"><b>PNR : <?php echo $SelectedFare->Response->FlightItinerary->PNR; ?></b></h3>
                        </div>
                    </div>
                    <div class="col-md-12">
                  <div class="modal-body" style="padding: 30px 34px 30px 20px;">
         <div class="row">
             <div class="col-md-8">
                 
                 <div class="list-group">
    <p class="list-group-item active">
        Flight Detail (<b><?php echo $BookingDetails->fbook_depart_city; ?></b> To <b><?php echo $BookingDetails->fbook_arrive_city; ?></b>, depart - <b><?php 
        $dateformat = date_format(date_create($BookingDetails->fbook_depart_date),"d M Y");
        echo $dateformat; ?> </b>)
    </p>
                 <div class="">
                   
                     <li class="list-group-item"><b class="fn"> 
  <?php 
        foreach ($SelectedFare->Response->FlightItinerary->Segments as $seg => $segmentloop){
            
         ?>
					<div class="airlines" style="height:180px">
						<div class="col-md-12 col-sm-12 col-xs-12 flight_name no-padding segmentline"><?php echo $segmentloop->Origin->AirportCode; ?> → <?php echo $segmentloop->Destination->AirportCode; ?> | <small><?php echo GetDateWithDay($segmentloop->DepTime); ?></small></div>
						<div class="col-md-1 col-sm-1 col-xs-1 no-padding">
							<img src="<?php echo site_url(); ?>assets/images/airlines/<?php echo $segmentloop->Airline->AirlineCode; ?>.gif" width="50" />
							<p><?php echo $segmentloop->Airline->AirlineCode . "-" . $segmentloop->Airline->FlightNumber; ?></p>
						</div>
						<div class="col-md-3 col-sm-3 col-xs-3">
							<label>
								<p><label class="depart-arr">DEP</label><span><?php echo $segmentloop->Origin->AirportCode; ?></span></p>
								<p style="margin-bottom: 3px;"><?php echo GetTime($segmentloop->DepTime); ?> | <?php echo GetDateScFull($segmentloop->DepTime); ?></p>
								<p class="terminal_details">Terminal <?php echo $segmentloop->Origin->Terminal; ?>,</br><?php echo $segmentloop->Origin->AirportName; ?></p>
							</label>
						</div>
						<div class="col-md-5  col-sm-5 col-xs-5 no-padding" style="padding-top:30px;">
							<p class="text-align-center"><i class="fa fa-clock-o"></i> <?php echo minute_to_hour($segmentloop->Duration); ?> </p>
							<p class="dots"><i class="fa fa-plane plane_horiz"></i></p>
							<p class="text-align-center">Fare Class: <?php echo $segmentloop->Airline->FareClass; ?> &nbsp;|&nbsp; 
								<?php
								if ($SelectedFare->Response->FlightItinerary->NonRefundable != true) {

									echo "<span style='color:green'>Refundable</span>";
								} else {
									echo "<span style='color:red'>Non-Refundable</span>";
								}
								?></p>
						</div>
						<div class="col-md-3 col-sm-3 col-xs-3">
							<label>
								<p><label class="depart-arr">ARR</label><span><?php echo $segmentloop->Destination->AirportCode; ?></span></p>
								<p style="margin-bottom: 3px;"><?php echo GetTime($segmentloop->ArrTime); ?> | <?php echo GetDateScFull($segmentloop->ArrTime); ?></p>
								<p class="terminal_details">Terminal <?php echo $segmentloop->Destination->Terminal; ?>,</br><?php echo $segmentloop->Destination->AirportName; ?></p>
							</label>
						</div>
					</div>
                    <?php  } ?>
         </b> </li>
              </div>
                 </div>
                 <div class="list-group">
    <a href="#" class="list-group-item active">
    Passenger Detail-
    </a>
                 <div class="pax_data_apend">
                     <?php foreach ($PaxDetails as $PaxDetails23){ ?>
                     <li class="list-group-item"><b class="fn"> <?php echo $PaxDetails23->fpax_type; ?> - <?php echo $PaxDetails23->fpax_title; ?> <?php echo $PaxDetails23->fpax_first_name; ?> <?php echo $PaxDetails23->fpax_last_name; ?> </b></li>
                     <?php } ?>
                 </div>
                 </div>
                 
                 <div class="list-group">
    <a href="#" class="list-group-item active">
    Contact Detail
    </a>
                 <div class="">
                  <li class="list-group-item email_confirm"><b class="fn">Email: <?php echo $PaxDetails[0]->fpax_email; ?></b></li>
                  <li class="list-group-item contact_confirm"><b class="fn">Mobile No:  <?php echo $PaxDetails[0]->fpax_mobile; ?></b></li>  
  
              </div>
                 </div>
                 
                 
             </div>
             
             <div class="col-md-4 sidebar">
                  <a href="#" class="list-group-item active">
    Payment Detail
    </a>
                 <div class="airlines">
                         <ul class="fare_details">
         <li>Base Fare  <span class="pull-right"><i class="fa fa-inr"></i> <?php echo $SelectedFare->Response->FlightItinerary->Fare->BaseFare; ?></span></li>
                        <li>Tax and Additional Charge (+)<span class="pull-right"><i class="fa fa-inr"></i> <?php echo $BookingDetails->fbook_customer_fare - $SelectedFare->Response->FlightItinerary->Fare->BaseFare; ?></span></li>
                        
                        <li>Total Fare<span class="pull-right"><i class="fa fa-inr"></i> <?php echo $BookingDetails->fbook_customer_fare; ?></span></li>
                    </ul>
                </div>
                 <div class="" style="padding-top: 40px;">
                 <div class="btn-group">
                    
                     <a id="resform_downloadResume" href="<?php echo site_url(); ?>flight/print_ticket?ref_id=<?php echo bp_hash(url_decode($_GET ['ref_no'])); ?>" target="_blank" name="" class="btn btn-primary btn-large btn-loading" style="padding-left: 10px; font-family: Calibri; font-size:19px;" data-loading-text="Please Wait..." ><span class="fa fa-print" aria-hidden="true" style="font-size: 22px;"></span> Print Ticket </a>

			</div>
                     <div class="btn-group pull-right">
                    
                     <a  href="<?php echo site_url(); ?>flight/print_invoice/?ref_id=<?php echo bp_hash(url_decode($_GET ['ref_no'])); ?>" target="_blank" id="resform_downloadResume" name="" class="btn btn-primary btn-large btn-loading" style="padding-left: 10px; font-family: Calibri; font-size:19px;" data-loading-text="Please Wait..."><span class="fa fa-file" aria-hidden="true" style="font-size: 22px;"></span> Print Invoice </a>

			</div>
             </div>
              </div>
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
$this->load->view("footer"); ?>

