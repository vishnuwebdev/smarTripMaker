<?php $this->load->view('header'); 
$result = $confrimdata->Results;
$segment = $result->Segments;
$DirPublishedFarePrice = $result->Fare->PublishedFare;
$DirPublishedFarePrice = round ( $DirPublishedFarePrice );
$_SESSION ['flight'][$sessionid] ['flight_total_fare'] = $DirPublishedFarePrice;
$_SESSION ['flight'][$sessionid]['farequote_data'] ['TraceId'] = $confrimdata->TraceId;
$SearchData =$_SESSION ['flight'] [$sessionid] ['search_RequestData'];
$IsDomestic = $_SESSION["flight"][$sessionid]["search_RequestData"];

$base_fare = $result->Fare->BaseFare;
$tax=$result->Fare->PublishedFare-$base_fare;
$DirPublishedFarePrice = round ( $result->Fare->PublishedFare );

?> 

<section id="special" class="p-xs-8">
		<div class="container no-padding">
		<div class="col-md-9 main-contant no-padding-xs">

			<?php
                foreach ($segment as $segment123) {

                    $segmentcountint = count($segment123);
                    ?>


		     <h3 class="mt-0 booking-title"> Review Your Booking</h3>


			 <div class="row airline">
					 <?php foreach ($segment123 as $segmentflight) { ?>
			    <div class="row p-20">
				<div class="clearfix"></div>
				  <div class="col-md-2 text-center br-1">
					<img src="<?php echo site_url(); ?>assets/images/airlines/<?php echo $segmentflight->Airline->AirlineCode; ?>.gif" width="50%" />
					<p><?php echo $segmentflight->Airline->AirlineCode; ?>-<?php echo $segmentflight->Airline->FlightNumber; ?><br><small>Operated by <?php echo $segmentflight->Airline->AirlineName; ?></small></p><p>
				  </p></div>
				 <div class="col-md-10 pt-15">
				  <div class="col-md-3 text-center-xs">
				    <p class="mb-0"><?php echo $segmentflight->Origin->CityName; ?> (<?php echo $segmentflight->Origin->AirportCode; ?>)</p> 
                    <p class="mb-0"><b><?php echo GetTime($segmentflight->DepTime); ?> | <?php echo GetDateScFull($segmentflight->DepTime); ?> </b></p>
                    <small><?php echo $segmentflight->Origin->AirportName; ?></small>
				  </div>
				  <div class="col-md-6">
				     <p class="text-center"><i class="fa fa-clock-o"></i><?php echo minute_to_hour($segmentflight->Duration); ?> </p>
                        <p class="dots"><i class="fa fa-plane plane_horiz"></i></p>
                        <p class="text-center">Fare Class: <?php echo $segmentflight->Airline->FareClass; ?> &nbsp;|&nbsp; <span class="text-success">  <?php
                                        if ($result->IsRefundable == true) {

                                            echo "<span style='color:green'>Refundable</span>";
                                        } else {
                                            echo "<span style='color:red'>Non-Refundable</span>";
                                        }
                                        ?></span></p>
				  </div>
				  <div class="col-md-3 text-center-xs">
				    <p class="mb-0"><?php echo $segmentflight->Destination->CityName; ?> (<?php echo $segmentflight->Destination->AirportCode; ?>)</p> 
                    <p class="mb-0"><b><?php echo GetTime($segmentflight->ArrTime); ?> | <?php echo GetDateScFull($segmentflight->ArrTime); ?> </b></p>
                    <small><?php echo $segmentflight->Destination->AirportName; ?> - T-<?php echo $segmentflight->Destination->Terminal; ?></small>
				  </div>
				 </div>
				</div>
				<?php } ?>
			 </div>

			  <?php } ?>


			 <h3 class="mt-0 booking-title"> Enter Traveller Details </h3>
			 <form class="form-horizontal" action="">
			 <div class="row airline p-20">
			    <form class="form-horizontal" action="">
				<div class="form-group bb-1 md-10 pb-20">
				  <label class="control-label col-sm-3" for="email">Contact Details:</label>
				  <div class="col-sm-4 mb-xs-10">
					<input type="email" class="form-control pax_validation_field for_email_confirm" id="email" placeholder="Enter email" name="cust_email">
				  </div>
				  <div class="col-sm-5 mb-xs-10">
					<input type="number" class="form-control pax_validation_field for_contact_confirm" id="cust_mobile_no" name="cust_mobile_no" placeholder="Enter Number">
				  </div>
				</div>



<form class="form-inline" action="<?php echo site_url(); ?>flight/payment_request" method="post" id="travellerdetail">
			  <?php
                    $FareBreakdown = $result->FareBreakdown;

                    if (is_numeric(key($FareBreakdown))) {
                        foreach ($FareBreakdown as $key => $FBDetails) {
                            $PassengerType = passanger_t_f_number($FBDetails->PassengerType);
                            $noOfPess = $FBDetails->PassengerCount;
                            for ($i = 1; $i <= $noOfPess; $i ++) {
                                ?>

																	<label for="email"><?php echo $PassengerType . ' ' . $i; ?>  - </label>
                                <div class="row airlines">
															
                                    
																		<div class="form-group col-md-4">
                                       
                                        <select class="form-control pax_validation_field title_auto_fill for_pop_data"
                                                pestype="<?php echo $PassengerType;?>" forend="0"
                                                name="<?php echo $PassengerType; ?>Title_<?php echo $i; ?>"
                                                error_msg="Please select Title for <?php echo $PassengerType; ?>"
                                                key_unique="<?php echo $PassengerType . $i; ?>"> >
                                            <option value="">Select Title--</option>
                                            <?php
                                            if ($PassengerType == "Adult") {
                                                ?>
                                                <option value="Mr">Mr</option>
<!--
                                                <option value="Mrs">Mrs</option>
                                                <option value="Miss">Miss</option>
-->
                                                <option value="Ms">Ms</option>
                                                <?php
                                            } else {
                                                ?>
                                                <option value="Mstr">Mstr</option>
                                                <option value="Miss">Miss</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4" style="margin:0">
                                        <input type="text" class="form-control pax_validation_field for_pop_data"
                                               pestype="<?php echo $PassengerType;?>" forend="1"
                                               id="<?php echo $PassengerType; ?>FirstName_<?php echo $i; ?>"
                                               placeholder="Enter First Name" name="<?php echo $PassengerType; ?>FirstName_<?php echo $i; ?>"
                                               error_msg="Please enter first name for <?php echo $PassengerType; ?>">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control pax_validation_field for_pop_data"
                                               pestype="<?php echo $PassengerType;?>" forend="2"
                                               id="<?php echo $PassengerType; ?>LastName_<?php echo $i; ?>"
                                               placeholder="Enter Last Name"
                                               name="<?php echo $PassengerType; ?>LastName_<?php echo $i; ?>"
                                               error_msg="Please enter Last name for <?php echo $PassengerType; ?>">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control pax_validation_field gender_auto_fill co_gander" id="<?php echo $PassengerType; ?>Gender_<?php echo $i; ?>" placeholder=""
                                               name="<?php echo $PassengerType; ?>Gender_<?php echo $i; ?>"
                                               error_msg="Please select gender  for <?php echo $PassengerType; ?>" readonly key_unique="<?php echo $PassengerType . $i; ?>">
                                    </div>

                                    <?php

                                    if ($IsDomestic ['IsDomestic'] == "false" || $PassengerType != "Adult") {
                                        ?>
                                        <div class="col-md-12 col-md-4" style="padding-top: 15px;">
                                            <div class="form-group">
                                                <input type="text" readonly
                                                       error_msg="Please select DOB for <?php echo $PassengerType; ?>"
                                                       name="<?php echo $PassengerType; ?>Date_<?php echo $i; ?>"
                                                       class="form-control pax_<?php echo $PassengerType; ?>_dob pax_validation_field co_dateofbirth"
                                                       placeholder="Date of Birth">
                                            </div>

                                            <div class="form-group col-md-4">
                                                <input type="text"
                                                       error_msg="Please Enter Passport no for <?php echo $PassengerType; ?>"
                                                       name="<?php echo $PassengerType; ?>PassportNum_<?php echo $i; ?>"
                                                       class="pass_number form-control pax_validation_field"
                                                       placeholder="Passport No">
                                            </div>

                                            <div class="form-group col-md-4">
                                                <input type="text" readonly
                                                       error_msg="Please select passport Exp. for <?php echo $PassengerType; ?>"
                                                       name="<?php echo $PassengerType; ?>PassExpDate_<?php echo $i; ?>"
                                                       class="form-control pax_<?php echo $PassengerType; ?>_dob pax_validation_field co_expdatebirth"
                                                       placeholder="Passport Exp.">
                                            </div>

                                            <div class="form-group col-md-4" style="width:30%">
                                                <select class="form-control pax_validation_field for_pop_data"
                                                pestype="<?php echo $PassengerType;?>" forend="0"
                                                name="<?php echo $PassengerType; ?>IssuingCntry_<?php echo $i; ?>"
                                                error_msg="Please select Title for <?php echo $PassengerType; ?>"
                                                key_unique="<?php echo $PassengerType . $i; ?>" style="width:64%">
                                            <option value="">Select Title--</option>
                                            <?php foreach ($allcountry as $allcountries) { ?>
                                             <option value="<?php echo $allcountries->country_code.'_'.$allcountries->country_name; ?>"><?php echo $allcountries->country_name; ?></option>
                                            <?php } ?>
                                        </select>
                                            </div>
                                        </div>
                                    <?php } ?>

                                </div>

                                <?php
                            }
                        }
                    }
                    ?>


										 <button type="button"  class="btn btn-custom btn-lg pax_validation_continue"> Book Now</button>
				  </form>
			 </div>
			 <div class="text-center">
			  
			 </div>
			 </form>
		  </div>
		  <div class="col-md-3 pr-0">
		   <h3 class="mt-0 booking-title"> Fare Details </h3>
		   <ul class="list-unstyled fare-detls">
		     <li>
				 <?php
                        if (is_numeric(key($FareBreakdown))) {
                            foreach ($FareBreakdown as $key => $FBDetails) {
                                $PassengerType = passanger_t_f_number($FBDetails->PassengerType);
                                $noOfPess = $FBDetails->PassengerCount;
                                ?>
			  <a class="" role="button" data-toggle="collapse" href="#basefare" aria-expanded="false" aria-controls="basefare">Base Fare<small>(<?php echo $noOfPess; ?> Traveller) </small> <i class="fa fa-angle-down rotate-icon"></i></a>
			  <span class="pull-right"><i class="fa fa-inr"></i> <?php echo number_format($FBDetails->BaseFare); ?></span>
			  <div class="collapse" id="basefare">
             <ul class="list-group list-group-item list-group-item-info list-unstyled">
						

									<li>
										<span><?php echo $PassengerType; ?> x <?php echo $noOfPess; ?></span><span class="pull-right"><i class="fa fa-inr"></i> <?php echo number_format($FBDetails->BaseFare); ?></span>
									</li>

								
				  </ul>
			 </div>
			 </li>
			 <?php } } ?>
			 <li>
			    <span>Tax</span><span class="pull-right"><i class="fa fa-inr"></i> <?php echo $tax; ?></span>
			 </li>
	
		     <li class="total-fare bg-info"><span>Total Fare</span><span class="pull-right"><i class="fa fa-inr"></i> <?php echo $DirPublishedFarePrice; ?></span></li>
		   </ul>
		  </div>
		</div>
	</section>






	

<div class="modal fade confirmpop " id="Modal_for_confirm" role="dialog" >
    <div class="modal-dialog modal-lg">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4><span class="glyphicon glyphicon-lock"></span> Please Confrim your Flight </h4>
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
                 <div class="">

                     <li class="list-group-item" style="padding:40px 10px"><b class="fn"><div class="col-md-2 no-padding">Onward :</div>
                             <div class="col-md-2 no-padding text-right">
            <?php $confirm_lo=explode(" ",$SearchData['from_location']); echo $confirm_lo[0];?> </div>
                <div class="col-md-2">
                    <p class="dots"><i class="fa fa-plane plane_horiz"></i></p> </div>
                    <div class="col-md-3 no-padding">  <?php $confirm_lo=explode(" ",$SearchData['to_location']); echo $confirm_lo[0];?> </div>
            <div class="col-md-2 no-padding">
            <?php /*if(isset($Segment['DepTIme'])){ echo date_format(date_create($Segment['DepTIme']['_v']),"d M ,H : i");}else {  echo date_format(date_create($Segment[0]['DepTIme']['_v']),"d M ,H : i");}*/
			echo date_format(date_create($SearchData['depart_date']),"d M, Y");
			?>
            </div>
         </b> </li>
              </div>
                 </div>
             </div>

             <div class="col-md-4">




						
			 <table class="table bg-white" style="border:1px solid #337ab7">
							<thead>
								<tr class="bg-primary">
									<th>Fare Details</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
							<?php
                        if (is_numeric(key($FareBreakdown))) {
                            foreach ($FareBreakdown as $key => $FBDetails) {
                                $PassengerType = passanger_t_f_number($FBDetails->PassengerType);
                                $noOfPess = $FBDetails->PassengerCount;
                                ?>
								<tr>
									<td>Base Fare (<?php echo $PassengerType; ?> <i class="fa fa-times"></i> <?php echo $noOfPess; ?>) </td>
									<td class="text-right">
										<i class="fa fa-inr"></i> <?php echo $FBDetails->BaseFare; ?></td>
								</tr>

								    <?php }
							}
							?>
     
								<tr>
									<td>Tax</td>
									<td class="text-right">
										<i class="fa fa-inr"></i><?php echo $tax; ?></td>
								</tr>
								<tr class="active">
									<td>
										<b>You Pay</b>
									</td>
									<td class="text-right">
										<b>
											<i class="fa fa-inr"></i> <?php echo $DirPublishedFarePrice; ?></b>
									</td>
								</tr>
							</tbody>
						</table>
			
                
                
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

















	<?php $this->load->view('footer'); ?>
	<?php $this->load->view('js'); ?>


    

    <script>

				$(function(){
					$(".proceed_payment_data").click(function(){
						$("#form_submit_pop_over").modal("show");
							var formD = $("#travellerdetail").serializeArray();
							$.ajax({
								type: "POST",
								url: "<?php echo site_url(); ?>flight/save_customer_data",
								data: formD,
								dataType: "text",
								cache:false,
								success:
									function(data){
									if(data){
									//alert(data);
																								console.log(data);
										//alert("please try after some time or contact FLightMantra Admin");
										$("#form_submit_pop_over").modal("hide");
									//alert("Server is under maintenance .Please try after sometime.");
										$( "#travellerdetail" ).submit();
										}
											}
									});
							return false;
					});
				});
			</script>

