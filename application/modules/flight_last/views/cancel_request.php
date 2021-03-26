<?php
$this->load->view('header');

?>
<section id="special" class="p-xs-8">
		<div class="container-fluid">
	        <div class="row">
              <?php $this->load->view("user/customersidebar"); ?>
            <div class="col-md-9">
		       <div class="card">
		        <div class="card-body" style="background: white; padding: 10px;">
                        <div role="tabpanel" class="tab-pane active" id="mybookings">
                            <div class="bookingtypeandstatus clearfix">
                                <h3 class="pull-left fz18 black-color mt0">Cancel Request</h3>
                            </div>
                            <div class="clearfix tripsbooked">
                                <?php
				if ($this->session->flashdata ( 'alert' ) !== NULl) {
					$bhanu_message = $this->session->flashdata ( 'alert' );
					?>
																													<div
			class="alert alert-sm alert-border-left <?php echo $bhanu_message['class'];?> light alert-dismissable">
			<button type="button" class="close" data-dismiss="alert"
				aria-hidden="true">×</button>
			<i class="fa fa-info pr10"></i> <strong> <?php echo $bhanu_message['message'];?></strong>
		</div>
              
			<?php }?>
                                <div class="table-responsive">
                                   <div class="col-md-8">
            <h4>Cancel Request</h4>
            <form action="<?php echo site_url(); ?>flight/send_cancel_request" method="POST" id="change_request" novalidate="novalidate">
                <div class="form-group form-group-icon-left">
                    <input type="hidden" name="fbook_id" value="<?php echo url_decode($this->input->get("ref_id")); ?>">
                   
                    <input type="hidden" name="BookingId" value="<?php echo $SelectedFare->Response->BookingId; ?>">
                    <label>Select Request*</label> 
                    <select class="form-control valid" name="ocanc_type">
                        <option value="cancel">Cancel Request</option>
                    </select>
                </div>
                <div class="row">
                <div class="col-md-6">
                <div class="form-group form-group-icon-left">
                    <label>Select Refund Sectors*</label>
                    <div class="alert alert-warning">
                        <div class="checkbox">
                                <label class="checkbox-inline">
                                    <input id="all_sector" type="checkbox" value="all" name=""> All
                                </label>
                            </div>
                       <?php foreach ($SelectedFare->Response->FlightItinerary->Segments as $SelectedFaresss){ ?>
                            <div class="checkbox">
                                <label class="checkbox-inline">
                                    <input class="sector_input" type="checkbox" value="<?php echo $SelectedFaresss->Origin->AirportCode."_".$SelectedFaresss->Destination->AirportCode; ?>" name="Segmentlist[]"><?php echo $SelectedFaresss->Origin->AirportCode." - ".$SelectedFaresss->Destination->AirportCode; ?> (<?php echo date_format(date_create($SelectedFaresss->DepTime),"h:i A , d M Y"); ?> )
                                </label>
                            </div>
                       <?php } ?>
                           

                    </div>
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group form-group-icon-left">
                    <label>Select Pax*</label>
                   
                    <div class="alert alert-warning">
                          <div class="checkbox">
                                <label class="checkbox-inline">
                                    <input id="all_pax" type="checkbox" value="all_pex" name=""> All
                                </label>
                            </div>
          <?php foreach ($SelectedFare->Response->FlightItinerary->Passenger as $Selected_pass){ ?>
                            <div class="checkbox">
                                <label class="checkbox-inline">
                                    <input class="pax_input" type="checkbox" value="<?php echo $Selected_pass->Ticket->TicketId; ?>" name="pax[]"><?php echo $Selected_pass->Title." ".$Selected_pass->FirstName." ".$Selected_pass->LastName; ?>
                                </label>
                            </div>
            <?php } ?>
                       
                    </div>
                </div>
                </div>
                </div>
                <div class="form-group form-group-icon-left">
                    <i class="fa fa-pencil input-icon"></i> <label>Details</label>
                    <textarea rows="5" name="ocanc_remark" class="form-control"></textarea>
                </div>

                <hr>
                <input class="btn btn-primary" type="submit" value="Submit">
            </form>
             <hr>
             <?php if($BookingDetails->fbook_booking_type == "Return"){  ?>
              <h4>Cancel Request Return</h4>
            <form action="<?php echo site_url(); ?>flight/send_cancel_request" method="POST" id="change_request_return" novalidate="novalidate">
                <div class="form-group form-group-icon-left">
                    <input type="hidden" name="fbook_id" value="<?php echo url_decode($this->input->get("ref_id")); ?>">
                   
                    <input type="hidden" name="BookingId" value="<?php echo $SelectedFareIB->Response->BookingId; ?>">
                    <label>Select Request*</label> 
                    <select class="form-control valid" name="ocanc_type">
                        <option value="cancel">Cancel Request</option>
                    </select>
                </div>
                <div class="row">
                <div class="col-md-6">
                <div class="form-group form-group-icon-left">
                    <label>Select Refund Sectors*</label>
                    <div class="alert alert-warning">
                        <div class="checkbox">
                                <label class="checkbox-inline">
                                    <input id="all_sector_return" type="checkbox" value="all" name=""> All
                                </label>
                            </div>
                       <?php foreach ($SelectedFareIB->Response->FlightItinerary->Segments as $SelectedFaresss){ ?>
                            <div class="checkbox">
                                <label class="checkbox-inline">
                                    <input class="sector_input_return" type="checkbox" value="<?php echo $SelectedFaresss->Origin->AirportCode."_".$SelectedFaresss->Destination->AirportCode; ?>" name="Segmentlist[]"><?php echo $SelectedFaresss->Origin->AirportCode." - ".$SelectedFaresss->Destination->AirportCode; ?> (<?php echo date_format(date_create($SelectedFaresss->DepTime),"h:i A , d M Y"); ?> )
                                </label>
                            </div>
                       <?php } ?>
                           

                    </div>
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group form-group-icon-left">
                    <label>Select Pax*</label>
                   
                    <div class="alert alert-warning">
                          <div class="checkbox">
                                <label class="checkbox-inline">
                                    <input id="all_pax_return" type="checkbox" value="all_pex_return" name=""> All
                                </label>
                            </div>
          <?php foreach ($SelectedFareIB->Response->FlightItinerary->Passenger as $Selected_pass){ ?>
                            <div class="checkbox">
                                <label class="checkbox-inline">
                                    <input class="pax_input_return" type="checkbox" value="<?php echo $Selected_pass->Ticket->TicketId; ?>" name="pax[]"><?php echo $Selected_pass->Title." ".$Selected_pass->FirstName." ".$Selected_pass->LastName; ?>
                                </label>
                            </div>
            <?php } ?>
                       
                    </div>
                </div>
                </div>
                </div>
                <div class="form-group form-group-icon-left">
                    <i class="fa fa-pencil input-icon"></i> <label>Details</label>
                    <textarea rows="5" name="ocanc_remark" class="form-control"></textarea>
                </div>

               
                <input class="btn btn-primary" type="submit" value="Submit">
            </form>
             <?php } ?>
        </div>
                                    
                                   <div class="col-md-4">
            <h4>Flight Detail</h4>
            <div class="alert alert-success">
                <p class="text-small">
                    <?php echo $SelectedFare->Response->FlightItinerary->Segments[0]->Origin->CityName; ?> To <?php 
                    $countseg = count($SelectedFare->Response->FlightItinerary->Segments);
                    echo $SelectedFare->Response->FlightItinerary->Segments[$countseg-1]->Destination->CityName; ?> , <b>
                        Depart Date
                    </b> - <?php echo date_format(date_create($SelectedFare->Response->FlightItinerary->Segments[0]->DepTime),"h:i A , d M Y"); ?> , <b>PNR</b> - <?php echo $SelectedFare->Response->PNR; ?>
                </p>
                <p class="text-small">
                    <b>Airline Name</b> - <?php echo $SelectedFare->Response->FlightItinerary->Segments[0]->Airline->AirlineName; ?> , <b>
                        Airline Code
                    </b> - <?php  echo $SelectedFare->Response->FlightItinerary->Segments[0]->Airline->AirlineCode; ?>
                </p>
            </div>

             <?php if($BookingDetails->fbook_booking_type == "Return"){ ?>
            <h4>Flight Detail Return</h4>
            <div class="alert alert-success">
                <p class="text-small">
                    <?php echo $SelectedFareIB->Response->FlightItinerary->Segments[0]->Origin->CityName; ?> To <?php 
                    $countsegib = count($SelectedFareIB->Response->FlightItinerary->Segments);
                    echo $SelectedFareIB->Response->FlightItinerary->Segments[$countsegib-1]->Destination->CityName; ?> , <b>
                        Depart Date
                    </b> - <?php echo date_format(date_create($SelectedFareIB->Response->FlightItinerary->Segments[0]->DepTime),"h:i A , d M Y"); ?> , <b>PNR</b> - <?php echo $SelectedFareIB->Response->PNR; ?>
                </p>
                <p class="text-small">
                    <b>Airline Name</b> - <?php echo $SelectedFareIB->Response->FlightItinerary->Segments[0]->Airline->AirlineName; ?> , <b>
                        Airline Code
                    </b> - <?php  echo $SelectedFareIB->Response->FlightItinerary->Segments[0]->Airline->AirlineCode; ?>
                </p>
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






<?php $this->load->view('footer'); ?>
<?php $this->load->view('flight/js'); ?>
<script type="text/javascript">
   
    $("#all_sector").change(function(){
      
      if($(this).prop('checked')){
         // alert($(this).prop('checked'));
          $(".sector_input").prop('checked', true);
       }else{
        $(".sector_input").prop('checked', false);  
       }
      
      
    });
    $("#all_pax").change(function(){
      
      if($(this).prop('checked')){
         // alert($(this).prop('checked'));
          $(".pax_input").prop('checked', true);
       }else{
        $(".pax_input").prop('checked', false);  
       }
      
      
    });
    
       $("#all_sector_return").change(function(){
      
      if($(this).prop('checked')){
         // alert($(this).prop('checked'));
          $(".sector_input_return").prop('checked', true);
       }else{
        $(".sector_input_return").prop('checked', false);  
       }
      
      
    });
    $("#all_pax_return").change(function(){
      
      if($(this).prop('checked')){
         // alert($(this).prop('checked'));
          $(".pax_input_return").prop('checked', true);
       }else{
        $(".pax_input_return").prop('checked', false);  
       }
      
      
    });
    
    
    $("#change_request_return").validate({
	  rules: {
	      "Segmentlist[]": "required",
	      "pax[]": "required",
	  },
	  messages: {
	      "Segmentlist[]": "Please select Sector",
	      "pax[]": "Please select Pax",
	  }
		});

    </script>