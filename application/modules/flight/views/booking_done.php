<?php
$this->load->view("header");
$result = $confrimdata->Results;
// if ($this->session->userdata('Userlogin') != NULL) {

//     $loginuser = $this->session->userdata('Userlogin')['userData'];
// } else {
//     $loginuser = array();
// }
//PrintArray($this->session->userdata('Userlogin')['userData']);

//die;
$segment = $result->Segments;
$DirPublishedFarePrice = $result->Fare->PublishedFare;
$DirPublishedFarePrice = round ( $DirPublishedFarePrice );
$_SESSION ['flight'][$sessionid] ['flight_total_fare'] = $DirPublishedFarePrice;
$_SESSION ['flight'][$sessionid]['farequote_data'] ['TraceId'] = $confrimdata->TraceId;

$IsDomestic = $_SESSION["flight"][$sessionid]["search_RequestData"];
//PrintArray($result);
// die;

$SearchData =  $IsDomestic;
?> 
		<section>
		    <ul class="tabs d-none">
							<li data-rel="#8f4a71" class="active" data-direction="6" data-url="tab1">
							</li>
                    </ul>
                    <div class="tabs-detail" id="modify-form">
						<div class="inner">
							<div class="tab-detail active" rel="tab1">
							</div>
						</div>
					</div>
			<div class="container">
				<div class="row">
					<div class="col-sm-12 col-md-12 col-lg-8 detail-col-left">
						<h2 class="purple">Payment details</h2>
						<ul class="steps step-4 clearfix">
							<li class="done">
								<span class="number">1</span>
								<span class="label">1 Flights</span>
							</li>
							<li class="done">
								<span class="number">2</span>
								<span class="label">2 Passengers</span>
							</li>
							<li class="done">
								<span class="number">3</span>
								<span class="label">3 Complete your flight</span>
							</li>
							<li class="done">
								<span class="number">4</span>
								<span class="label">4 Payment</span>
							</li>
						</ul>
                 
						<div class="clearfix"></div>
                        <div class="alert alert-success mt-4" role="alert">
                          <strong>Success!</strong> Payment has been  <a href="#" class="alert-link">done successfully</a>.
                        </div>
						<div class="flight-detail-section">
							<div class="sep-line">
								<span></span>
							</div>
							
							<div class="content-section">
								<h3 class="margin-0">
									Price breakdown
									<a href="#" class="flight-detail-section-expand-collaspe hide"></a>
								</h3>
							</div>
							<div class="flight-detail-section-show-hide ">								
								<div class="content-section padding-top-0">
									<div class="pb-tbl-div">
										<table width="100%" class="pb-tbl">
											<thead>
												<tr>
													<th width="25%">Heading</th>
													<th width="15%">Fare</th>
													<th width="13%">Total</th>
												</tr>
											</thead>
											<tbody>
                                            <?php
											     $FareBreakdown = $result->FareBreakdown;
                                                if (is_numeric(key($FareBreakdown))) {
                                                    foreach ($FareBreakdown as $key => $FBDetails) {
                                                        $PassengerType = passanger_t_f_number($FBDetails->PassengerType);
                                                        $noOfPess = $FBDetails->PassengerCount;
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $PassengerType; ?> x<?php echo $noOfPess; ?> </td>
                                                            <td><?php echo number_format($FBDetails->BaseFare); ?></td>
                                                            <td><?php echo number_format($FBDetails->BaseFare); ?></td>
                                                        </tr>
                                                <?php }
                                                }
                                            ?>
												<tr>
                                                  <td>Taxes </td>
                                                  <td><?php echo number_format($result->Fare->Tax); ?> </td>
                                                  <td><?php echo number_format($result->Fare->Tax); ?></td>
                                                </tr>

                                                <tr>
                                                  <td>Service fees</td>
                                                  <td><?php echo number_format($result->Fare->OtherCharges); ?> </td>
                                                  <td><?php echo number_format($result->Fare->OtherCharges); ?> </td>
                                                </tr>
													
												
											<!--	<tr>
													<td>
														<div class="font-medium margin-bottom-10">Travel insurance</div>
														Policy number:<br/>
														<span class="light-color-text">You will receive an email with fullinformation on the policy you have taken out</span>
													</td>
													<td>56.00</td>
													<td>&nbsp;</td>
													<td>&nbsp;</td>
													<td>x2</td>
													<td>112.60</td>
												</tr> -->
												<tr class="no-border">
													<td colspan="6" class="text-right">
														Price shown in: <span class="font-medium">Euro (€)</span>
													</td>												
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							
							
						
							
						</div>
                     

					</div>
					<div class="col-sm-12 col-md-12 col-lg-4 detail-col-right flight-booking-right-col">
						<div class="inner">
							<h3>Your Travel Plan</h3>
							<div class="flight-plan">
								<h4>Details</h4>
								<ul>
                                <?php
                                    foreach ($segment as $type_key => $segment123) {

                                        $segmentcountint = count($segment123);
                                        ?>
                                    <li><?php if($type_key == 1 ){ echo "Return";} else{ echo "Onwards";} ?></li>
                                  <?php foreach ($segment123 as $segmentflight) { ?>
									
								
									<li>
										<div class="font-medium"><?php echo $segmentflight->Origin->AirportCode; ?> - <?php echo $segmentflight->Destination->AirportCode; ?></div>
										<div><?php echo GetTime($segmentflight->DepTime); ?> | <?php echo GetDateScFull($segmentflight->DepTime); ?></div>
										<a href="#" class="expand-collaspe-link">See flight details</a>
										<div class="show-detail">
											DEP: <?php echo GetTime($segmentflight->DepTime); ?> | <?php echo GetDateScFull($segmentflight->DepTime); ?><br>
                                            Terminal <?php echo $segmentflight->Origin->Terminal; ?> - <?php echo $segmentflight->Origin->AirportName; ?><br>
                                            ARR: <?php echo GetTime($segmentflight->ArrTime); ?> | <?php echo GetDateScFull($segmentflight->ArrTime); ?><br>
                                            Terminal <?php echo $segmentflight->Destination->Terminal; ?> - <?php echo $segmentflight->Destination->AirportName; ?>
										</div>
									</li>
                                <?php } } ?>

								</ul>
							</div>
						
						<!--	<div class="flight-plan">
								<h4>Passengers</h4>
								<ul>
									<li>
										<div class="font-medium">2 Adults</div>										
										<a href="#" class="expand-collaspe-link">See passengers details</a>
										<div class="show-detail">
											See passengers details Detail
										</div>
									</li>									
								</ul> 
							</div>-->
							<div class="flight-plan">
								<h4>Total price</h4>
								<div class="text-large"> <?php echo number_format($result->Fare->PublishedFare) ; ?> €</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>


  <style>
	.list-group-item.active {
		z-index: 2;
		color: #fff;
		background-color: #904971;
		border-color: #904971;
	}
  </style>


  <div id="Modal_for_confirm" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">				
				<div class="modal-content">					
					<div class="modal-body">
						<div class="row">
											
							<div class="col-sm-12 col-md-12 modal-body-right">
								<div class="inner">
									<form>
										<div class="row">
											<div class="col-12">
											<p><b>Verify Passenger Names And Airline Details You Are Booking The Following Itinerary</b></p>	
											</div>
											<div class="col-sm-12 col-md-12">
													<div class="row">
												<div class="col-md-8">
													<div class="list-group">
										<a href="#" class="list-group-item active">
										Passenger Detail-
										</a>
													<div style="font-weight:700; padding:10px" class="pax_data_apend">
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
												 <?php 
                                              foreach ($segment as $type_key => $segment123) {  ?>	
											
											<div class="col-md-2 no-padding"><?php if($type_key == 1 ){ echo "Return";} else{ echo "Onwards";} ?> :</div> 
											
											<?php foreach ($segment123 as $segmentflight) { ?>
									
								
								              	<li class="list-group-item"><b class="row">
                              
												<div class="col-md-2  text-right">   
												<?php  echo $segmentflight->Origin->AirportName;?> </div>
													<div class="col-md-2">  
														<p class="dots"><i class="fa fa-plane plane_horiz"></i></p> </div>
														<div class="col-md-2 ">
														      <?php echo $segmentflight->Destination->AirportName;?> </div>
														      
														  
												<div class="col-md-4 ">  
											  <?php echo GetTime($segmentflight->DepTime); ?> | <?php echo GetDateScFull($segmentflight->DepTime); ?> 
											 
												</div>
												 </b>
												  </li>
												<?php } ?>
											   
											    
											    
							
											<?php } ?>
											
											
												</div>
													</div>
												</div>
												
												<div class="col-md-4">
													<div class="row airlines">
														<ul class="fare_details">
															<?php
															 $FareBreakdown = $result->FareBreakdown;
															if (is_numeric(key($FareBreakdown))) {
																foreach ($FareBreakdown as $key => $FBDetails) {
																	$PassengerType = passanger_t_f_number($FBDetails->PassengerType);
																	$noOfPess = $FBDetails->PassengerCount;
																	?>
																	<li>Base Fare (<?php echo $PassengerType; ?> <i class="fa fa-times"></i> <?php echo $noOfPess; ?>)<span class="pull-right"><i class="fa fa-inr"></i> <?php echo $FBDetails->BaseFare; ?></span></li>
										<?php }
									}
									?>
															<li>Tax (+)<span class="pull-right"><i class="fa fa-inr"></i> <?php echo $result->Fare->Tax; ?></span></li>
															<li>Other Charges (+)<span class="pull-right"><i class="fa fa-inr"></i> <?php echo $result->Fare->OtherCharges; ?></span></li>

															<li>Total Fare<span class="pull-right"><i class="fa fa-inr"></i> <?php echo $result->Fare->PublishedFare; ?></span></li>
														</ul>
													</div>
												</div>
										   </div>
										   <div class="row">
											<div class="col-sm-12 text-right">		
												<a href="#" title="Cancel" class="btn btn-secondary" data-dismiss="modal">Cancel</a>
												<a href="#" title="Submit Inquiry" class="btn btn-primary">Confirm</a>
											</div>
										</div>
									
									</form>
								</div>
							</div>
						</div>
					</div>					
				</div>
			</div>
		</div>
	</div>
</div>


<?php $this->load->view("footer"); ?>

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
<?php $this->load->view("js"); ?>