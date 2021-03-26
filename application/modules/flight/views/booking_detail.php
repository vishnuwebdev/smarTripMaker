<style>

div.multiple_select_checkbox {
    width: 100%;
    height: 160px;
    overflow-x: hidden;
    overflow-y: auto;
    border: 1px solid #CCCCCC;
}
</style>
<?php 
$this->load->view('include/head');
$this->load->view('include/header'); 

$baggageData = 0;

$result = $confrimdata->Response->Results;
$segment = $result->Segments;
$traceID = $confrimdata->Response->TraceId;


$old_selected_data=json_decode ($_SESSION ["flight"] [$this->input->get('seesionid')] ["Search_Result_json"]);


$offer_fare= $result->Fare->OfferedFare;

$current_currency = $result->Fare->Currency;
$publish_fare = $result->Fare->PublishedFare;
$dsa_data=$this->dsa_data;
$dsa_airline_code=$segment[0][0]->Airline->AirlineCode;
$baseFare = $result->Fare->BaseFare;
$yq_fare = $result->Fare->YQTax;
$tax = $publish_fare - $baseFare;

$bp_fare_data=bp_get_fare($offer_fare,$publish_fare,$dsa_airline_code,$dsa_data,$baseFare,$yq_fare);
if( $current_currency == "USD" ){
	$currency_symbol = "icofont-dollar"; $js_currency_symbol = "$";
}
else{
	$currency_symbol = " icofont-rupee"; $js_currency_symbol = "₹";
}

$dsa_fare=$bp_fare_data['dsa_fare'];
$customer_fare=$bp_fare_data['customer_fare'];

// $dsa_fare=$offer_fare;
// $customer_fare = $publish_fare;

for($k=0; $k < count($old_selected_data->Response->Results[0]); $k++){
	if($old_selected_data->Response->Results[0][$k]->ResultIndex == $result->ResultIndex ){	

	$old_OB_fare=$old_selected_data->Response->Results[0][$k]->Fare;
	$offer_fare=$old_OB_fare->OfferedFare;
    $publish_fare=$old_OB_fare->PublishedFare;
    $baseFare_old = $result->Fare->BaseFare;
    $yq_fare_old = $result->Fare->YQTax;
		
	}

}

$DirPublishedFarePrice =  ( $customer_fare );

//$DirPublishedFarePrice = $DirPublishedFarePrice + $baggageData;

$_SESSION ['flight'] [$sessionid] ['flight_total_fare'] = $DirPublishedFarePrice;
$_SESSION ['flight'][$sessionid]['farequote_data'] ['TraceId'] = $confrimdata->Response->TraceId;
$SearchData = $_SESSION ['flight'] [$sessionid] ['search_RequestData'];

$IsDomestic = $_SESSION["flight"][$sessionid]["search_RequestData"];

$base_fare = $result->Fare->BaseFare;

$tax=$DirPublishedFarePrice-$base_fare;
$total_pax =(int)$IsDomestic['no_adult'] + (int)$IsDomestic['no_child'] +  (int)$IsDomestic['no_infants'] ;
$search_data=$_SESSION ['flight'] [$this->input->get('seesionid')] ['search_RequestData'];
 if($search_data["type"] == 'MultiWay'){

    $depart=$IsDomestic['dept_date_m']['0'];

 }

 else{
	 $depart=$search_data["depart_date"];
 }
 
 // echo "<pre>";
// print_r($result);die;
 // print_r($bp_fare_data);
 $_SESSION['copont_applied'] = FALSE;
?>

<!-- Flight Booking Details -->
<section class="flght-booking-details pt-2 pb-2 pt-md-4 pb-md-4">
	<div class="container">
		<div class="row">
			<div class="col-md-9">
				<div class="flght-booking-left-col">
					<div class="flght-shrt-descr position-relative mb-3">
						<span class="fl-icon">
							<i class="icofont-ui-flight"></i>
						</span>
						<span class="d-block">Departure</span>						
					</div>

					<!-- Flight details list oneWay Paul -->
					<div class="flt-booking-wrap mb-2 mb-md-3">
						<div class="flt-booking-top">
							<h5>
							<?php 
							if($search_data["type"] == 'MultiWay'){
							echo date("j M Y, D", strtotime($search_data['dept_date_m'][0]) );?>	
							
								
							<?php } else {?>
							<?php 
							echo date("j M Y, D", strtotime($search_data['depart_date']) );?>
							<?php }?>
							
							<a href="#baggage-fare-rule" class="float-right baggage-fare" data-toggle="modal" data-target="">Baggage and Fare Rules</a>
							</h5>
						</div>
						<?php
							foreach ($segment as $segment123) {
						$segmentcountint = count($segment123);
                    ?>
					 <?php foreach ($segment123 as $segmentflight) {
						 
						$to_time = strtotime($segmentflight->Origin->DepTime);
						$from_time = strtotime($segmentflight->Destination->ArrTime);
						$minutess =  round(abs($to_time - $from_time) / 60,2);
						$hours = floor($minutess / 60).'h :'.($minutess -   floor($minutess / 60) * 60).'m';
						 ?>

						<div class="flt-booking-dts">
							<div class="row">
							
								<div class="col-md-3 col-sm-3 col-7">
									<div class="airline-logo fl-o-way-com">
										<span class="air-brand">
											
											<img src="<?php echo site_url(); ?>assets/images/airlines/<?php echo $segmentflight->Airline->AirlineCode; ?>.gif" />
										</span>
										<h6><?php echo $segmentflight->Airline->AirlineName; ?></h6>
										<span class="text-muted d-block"><?php echo $segmentflight->Airline->AirlineCode; ?>-<?php echo $segmentflight->Airline->FlightNumber; ?></span>
									</div>
								</div>
								<div class="col-md-3 col-sm-3 col-5">
									<div class="dep-dr fl-o-way-com">
										<h6><?php echo GetTime($segmentflight->Origin->DepTime); ?> | <?php echo GetDateScFull($segmentflight->Origin->DepTime); ?> </h6>
										<p class="mb-0"><?php echo $segmentflight->Origin->Airport->CityName; ?> (<?php echo $segmentflight->Origin->Airport->AirportCode; ?>)</p>
										<span class="text-muted d-block"><?php echo $segmentflight->Origin->Airport->AirportName; ?></span>
									</div>
								</div>
								<div class="col-md-1 col-sm-1 d-none d-md-flex">
									<div class="flt-boo-arw fl-o-way-com text-center">
										<i class="icofont-long-arrow-right"></i>
									</div>
								</div>
								<div class="col-md-3 col-sm-3 col-7">
									<div class="arv-dr fl-o-way-com">
										<h6><?php echo GetTime($segmentflight->Destination->ArrTime); ?> | <?php echo GetDateScFull($segmentflight->Destination->ArrTime); ?></h6>
										<p class="mb-0"><?php echo $segmentflight->Destination->Airport->CityName; ?> (<?php echo $segmentflight->Destination->Airport->AirportCode; ?>)</p>
										<span class="text-muted d-block"><?php echo $segmentflight->Destination->Airport->AirportName; ?></span>
									</div>
								</div>
								<div class="col-md-2 col-sm-3 col-5">
									<div class="st-prc-flt fl-o-way-com">
										<!--<h6><?php echo minute_to_hour($segmentflight->Duration); ?></h6>-->
										<h6><?php echo $hours; ?></h6>
										
									<!--	<p class="mb-0 stp">Non stop</p>
										<span class="text-muted d-block trv-cls">Economy</span>
										-->
									</div>
								</div>
							</div>
						</div>
						
					 <?php }?>
						  <?php } ?>
						
					</div><!--/ Flight details list oneWay end Paul -->

					
					
					<!-- Traveller Details Start From here -->
					 <form action="<?php echo site_url(); ?>flight/payment_request"  method="post" id="travellerdetail">
					<div class="trvl-details">
						<div class="trv-topbar mb-3">
							<div class="flt-booking-top">
								<h5>Traveller Details</h5>
							</div>
							<?php
                    			$FareBreakdown = $result->FareBreakdown;
                    			if (is_numeric(key($FareBreakdown))) {
                        		foreach ($FareBreakdown as $key => $FBDetails) {
                            		$PassengerType = passanger_t_f_number($FBDetails->PassengerType);
                            		$noOfPess = $FBDetails->PassengerCount;
                            		for ($i = 1; $i <= $noOfPess; $i ++) { ?>
							<div class="flt-booking-dts">
								<div class="col-fly-inn">
					                 <label><?php echo $PassengerType . ' ' . $i; ?> </label>
					                 <div class="row">
									   <input type="hidden" name="sessionid" value="<?php echo $this->input->get('seesionid'); ?>" />
					                   <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					                     <div class="form-group custom-select-wrap">
					                       <select class="form-control custom-select pax_validation_field title_auto_fill for_pop_data" pestype="<?php echo $PassengerType;?>" forend="0" name="<?php echo $PassengerType; ?>Title_<?php echo $i; ?>"
                                                error_msg="Please select Title for <?php echo $PassengerType; ?>"
                                                key_unique="<?php echo $PassengerType . $i; ?>">
					                          <option value="">Select Title</option>
											    <?php
												if ($PassengerType == "Adult") {
                                                ?>
					                          <option value="Mr">Mr</option>
					                          <option value="Mrs">Mrs</option>
					                          <option value="Miss">Miss</option>
					                          <option value="Ms">Ms</option>
											   <?php
                                            } else {
												 ?>
                                                <option value="Mstr">Mstr</option>
                                                <option value="Miss">Miss</option>
                                            <?php } ?>
											</select>
					                     </div>
					                   </div>
									   
					                   <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					                      <div class="form-group">
					                        <input type="text" class="form-control pax_validation_field for_pop_data"  placeholder="Enter First Name"  pestype="<?php echo $PassengerType;?>" forend="1" id="<?php echo $PassengerType; ?>FirstName_<?php echo $i; ?>"  placeholder="Enter First Name" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)" name="<?php echo $PassengerType; ?>FirstName_<?php echo $i; ?>"error_msg="Please enter first name for <?php echo $PassengerType; ?>">
					                      </div>
					                    </div>
										
					                     <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					                        <div class="form-group">
					                          <input type="text" class="form-control pax_validation_field for_pop_data"  pestype="<?php echo $PassengerType;?>" forend="2" id="<?php echo $PassengerType; ?>LastName_<?php echo $i; ?>" placeholder="Enter Last Name" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)" name="<?php echo $PassengerType; ?>LastName_<?php echo $i; ?>"error_msg="Please enter Last name for <?php echo $PassengerType; ?>">
					                        </div>
					                      </div>
										  
					                      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					                        <div class="form-group">
					                        <input type="text" class="form-control pax_validation_field gender_auto_fill"  id="<?php echo $PassengerType; ?>Gender_<?php echo $i; ?>" name="<?php echo $PassengerType; ?>Gender_<?php echo $i; ?>" error_msg="Please select gender  for <?php echo $PassengerType; ?>" readonly key_unique="<?php echo $PassengerType . $i; ?>" placeholder="Gender" >
					                      </div>
					                      </div>
										  
									 <?php if ($IsDomestic['IsDomestic'] == "false" || $dsa_airline_code=="I5" || $PassengerType == "Child" || $PassengerType == "Infant" ) { ?>	  
									 <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					                      <div class="form-group">
					                        <input type="text"  error_msg="Please select DOB for <?php echo $PassengerType; ?>" name="<?php echo $PassengerType; ?>Date_<?php echo $i; ?>" class="form-control pax_<?php echo $PassengerType; ?>_dob pax_validation_field co_dateofbirth" placeholder="Date of Birth" readonly>
					                      </div>
					                    </div>
										
									 <?php }?>
										
										
										
										
										<?php
										 if ($IsDomestic ['IsDomestic'] == "false") {

                                        ?>
					                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					                        <div class="form-group">
					                          <input type="text"  error_msg="Please Enter Passport no for <?php echo $PassengerType; ?>" name="<?php echo $PassengerType; ?>PassportNum_<?php echo $i; ?>" class="form-control pass_number pax_validation_field" id="passport-no" placeholder="Passport No">
					                        </div>
					                    </div>
					                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					                      <div class="form-group">
					                        <input type="text" error_msg="Please select passport Exp. for <?php echo $PassengerType; ?>"  name="<?php echo $PassengerType; ?>PassExpDate_<?php echo $i; ?>" id="pass-exp_<?php echo $PassengerType; ?>_<?php echo $i; ?>" readonly="" placeholder="Passport Exp." class="form-control co_dateofbirth ex_date pax_validation_field co_expdatebirth">
					                      </div>
					                    </div>
					                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					                       <div class="form-group flght-icon custom-select-wrap">
					                 	<select name="<?php echo $PassengerType; ?>IssuingCntry_<?php echo $i; ?>" id="nationality" class="form-control custom-select pax_validation_field" pestype="<?php echo $PassengerType;?>"  error_msg="Please select Title for <?php echo $PassengerType; ?>" key_unique="<?php echo $PassengerType . $i; ?>">
					                        	 <option value="">Select Nationality</option>
					                        	<?php foreach($nationality as $country){ ?>
					                        	<option value="<?php echo $country->alpha_2_code.'_'.$country->en_short_name ?>"><?php echo $country->en_short_name; ?></option>
					                        <?php } ?>
					                        </select>
					                      </div>
					                    </div>
								
										 <?php }?>


								</div>
								</div>
							</div>
							<?php 
								if($PassengerType !='Infant'){

							 if(isset($baggage->Response->MealDynamic) && !empty($baggage->Response->MealDynamic)) { ?>
								 <div class="flt-booking-wrap mb-2 mb-md-3">
					<div class="flt-booking-top">
						<h5><span><i class="icofont-school-bag font-22"></i> Baggage</span> <span class="float-right"><i class="icofont-fast-food font-22"></i> Meal & Bavrage</span></h5>
					</div>
					<div class="flt-booking-dts">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<select class="form-control baggageFareDetail" data-value="<?php echo $PassengerType; ?>_<?php echo $i; ?>" name="baggage[]" id="baggageFare_<?php echo $i; ?>">
									<option value="">Select Baggage</option>
									<?php for($j=0; $j<count($baggage->Response->Baggage[0]); $j++){ ?>
									 	<!-- <option value="<?php echo ($baggage->Response->Baggage[0][$j]->Weight); ?>"><?php echo ($baggage->Response->Baggage[0][$j]->Weight); ?> Kilogram  - <?php echo ($baggage->Response->Baggage[0][$j]->Price); ?> INR</option> -->
										 <option value="<?php echo ($baggage->Response->Baggage[0][$j]->Weight); ?>"><?php echo ($baggage->Response->Baggage[0][$j]->Weight); ?> Kilogram  - <?php echo ($baggage->Response->Baggage[0][$j]->Price); ?> <?= $current_currency?></option>
									 		<?php } ?>	
									 	</select>
									
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<select class="form-control mealFareDetail" data-value="<?php echo $PassengerType; ?>_<?php echo $i; ?>" name="meal[]" class="mealcheckbox">
										<option value="">Select Meals</option>
								    <?php for($k=0; $k<count($baggage->Response->MealDynamic[0]); $k++){ 
												if(!empty($baggage->Response->MealDynamic[0][$k]->AirlineDescription)){?>
										
										<!-- <option value="<?php echo $baggage->Response->MealDynamic[0][$k]->AirlineDescription; ?>"><?php echo ($baggage->Response->MealDynamic[0][$k]->AirlineDescription); ?> - <?php echo ($baggage->Response->MealDynamic[0][$k]->Price); ?> INR</option> -->
										<option value="<?php echo $baggage->Response->MealDynamic[0][$k]->AirlineDescription; ?>"><?php echo ($baggage->Response->MealDynamic[0][$k]->AirlineDescription); ?> - <?php echo ($baggage->Response->MealDynamic[0][$k]->Price); ?> <?= $current_currency?></option>


									<?php } } ?>
									</select>

									 </div>
								</div>
							</div>
						</div>
					</div><!--/ Frequent Flyer end Paul -->
				<?php } } ?>
								 <?php
										 
                            }

                        }

                    }

                    ?>	
							
						</div>
				

				



				<div class="flt-booking-wrap mb-2 mb-md-3">
						<div class="flt-booking-top">
							<h5>Frequent Flyer</h5>
						</div>
						<div class="flt-booking-dts">
							<div class="row">
								<div class="col-md-6">
									 <div class="form-group">
									 	<input type="text" name="" placeholder="Frequent Flyer" id="frequnt" class="form-control" value=""  title="">
									 </div>
								</div>
							</div>
						</div>
					</div><!--/ Frequent Flyer end Paul -->
				
					<!-- GST Details Start From here -->
				
						<div class="trv-topbar mb-3">
						 <?php if ($result->GSTAllowed) {?>
							<div class="flt-booking-top htl-srch-rtng">
								<h5>
							 <?php
								if ($result->IsGSTMandatory == 1) {?>
									<label for="gst-air" id="gst-airline">
									<input type="hidden" name="GSTAllowed" value="gst_data_filed"  >
			 	 						<input type="checkbox" id="gst-air" class="flightfare gstAllowed" checked name="GSTAllowed" value="gst_data_filed">
			 	 						<span>
			 	 							GST Mandatory for this Airline
			 	 						</span>
			 	 					</label>
								<?php } else {?>
								
								<label for="gst-air" id="gst-airline">
			 	 						<input type="checkbox" id="gst-air" class="flightfare gstAllowed" name="GSTAllowed" value="gst_data_filed">
			 	 						<span>
			 	 							GST Not Mandatory for this Airline
			 	 						</span>
			 	 					</label>

								<?php }?>								
									
			 	 				</h5>
							</div>
						 <?php }?>
							<div class="flt-booking-dts" id="gst-details">
							 <?php $result->IsGSTMandatory == 1 ? $valid_gst = "pax_validation_field" : $valid_gst = " "?>
								<div class="col-fly-inn">
									<div class="row">
					                    <div class="col-lg-6 col-md-6 col-sm-12">
					                      <div class="form-group">
					                        <label>Company Name:</label>
					                        <input type="text" class="form-control <?php echo $valid_gst ?>" id="company-name" placeholder="Company Name" name="GSTCompanyName" error_msg="Please enter Company Name">
					                      </div>
					                    </div>
					                    <div class="col-lg-6 col-md-6 col-sm-12">
					                      <div class="form-group">
					                        <label>GST Number:</label>
					                        <input type="number" class="form-control <?php echo $valid_gst ?>" id="gst-num" placeholder="GST Number" name="GSTNumber"  error_msg="Please enter GST Number">
					                      </div>
					                    </div>
					                    <div class="col-lg-12 col-md-12 col-sm-12">
					                      <div class="form-group">
					                        <label>Company Address:</label>
					                        <input type="text" class="form-control <?php echo $valid_gst ?>" id="com-add" placeholder="Company Address" name="GSTCompanyAddress"  error_msg="Please Enter Company Address">
					                      </div>
					                    </div>
					                    <div class="col-lg-6 col-md-6 col-sm-12">
					                      <div class="form-group">
					                        <label>Company Contact Number:</label>
					                        <input type="number" class="form-control <?php echo $valid_gst ?>" id="company-contact" placeholder="Company Contact Number" name="GSTCompanyContactNumber"  error_msg="Please enter Company Contact Number">
					                      </div>
					                    </div>
					                    <div class="col-lg-6 col-md-6 col-sm-12">
					                      <div class="form-group">
					                        <label>Company Email:</label>
					                        <input type="email" class="form-control <?php echo $valid_gst ?>" id="company-eml" placeholder="Company Email" name="GSTCompanyEmail"  error_msg="Please enter Company Email">
					                      </div>
					                    </div>
				                 	</div>
				               </div>
							</div>
						</div>

						<!-- Gst Details end from here -->
						
						<!--=====Apply Coupon=======--->
						
<!--					
					<div class="trv-topbar mb-3">	
					 <div class="flt-booking-top">
								<h5>Apply Coupon</h5>
							</div>
							
						
							<div class="flt-booking-dts">	
								<div class="col-fly-inn">
									<div class="row">
									
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group">
                <div id="massegealert" > </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
              <div class="form-group">
                <input type="text" style="max-width: 380px" id="user_coupon" name="coupon" class="form-control" placeholder="Enter Coupon code to get special discount">
              </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
              <div class="form-group">
                <a href="#none" id="add_coupon" class="btn btn-primary block">Add coupon</a>
              </div>
            </div>
										
					                
				                 	</div>
				               </div>
							
						</div>
						</div>
						-->
						
						
						<!--=======Coupon End=======--->
						
						<div class="trv-topbar">
							<div class="flt-booking-top">
								<h5>Personal Details</h5>
							</div>
							<div class="flt-booking-dts">
								<div class="col-fly-inn">
									<div class="row">
					                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					                      <div class="form-group">
					                        <label>Enter Your Email:</label>										
											
											<?php 
											
											if ($this->session->userdata ( 'Userlogin' ) != NULL) {?>
											<input type="email" class="form-control pax_validation_field for_email_confirm" id="your-email" placeholder="Enter Your Email" name="cust_email" value="<?php echo $this->session->userdata("Userlogin")["userData"]->cust_email; ?>">
										<?php } else {?>
											<input type="email" class="form-control pax_validation_field for_email_confirm" id="your-email" placeholder="Enter Your Email" name="cust_email">
										<?php }?>
											
											
											
											
					                      </div>
					                    </div>
					                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					                      <div class="form-group">
					                        <label>Enter Your Mobile:</label>
					                        <input type="number" class="form-control pax_validation_field for_contact_confirm" id="enter-mobile" placeholder="Enter Your Mobile" name="cust_mobile_no">
					                      </div>
					                    </div>
										
										<div class="col-md-12">
											<div class="checkbox htl-srch-rtng">
												<label for="accept-pol" class="accept">
													<input type="checkbox" id="accept-pol" class="flightfare pax_validation_field" value="NonRefundable" name="terms">
													<span>
														I have read and accept the <a target="blank" href="https://www.smarttripmaker.com/online/terms-and-conditions"> Terms and Conditions </a> and <a target="blank" href="https://www.smarttripmaker.com/online/privacy-policy">Privacy Policy</a>.
													</span>
												</label>
											</div>
										</div>
											
									
									<!--========Customer wallet or payment gatway==========-->
									 <!--Radio buttons for balance-->
	   <!--check customer wallet -->
		   
		  <?php if($this->session->userdata("Userlogin") != NULL){
				$bp_customer_total_balance=$this->user_data->cust_balance;
				$bp_total_fare = $customer_fare;		
				if($bp_customer_total_balance > 0){
			?>
                        <div class="col-md-12">
						<div class="checkbox htl-srch-rtng">
							<label for="wallet_amt">
								<input id="wallet_amt" name="wallet_amount" class="term_condition" type="checkbox" value="customerCash">  
								<span>
									Use Customer Wallet Amount <b>Available Balance is: </b> 
									<?= getCurrencySymbol($current_currency) ?>
									<?php echo convertActualPrice($bp_customer_total_balance,$current_currency); ?> 
								</span>
								<!-- <b>Available Balance is: </b>
								<?= getCurrencySymbol($current_currency) ?>
								<?php echo convertActualPrice($bp_customer_total_balance,$current_currency); ?>  -->
							</label>
                        </div>
						</div>
						
						<?php } }?>
							<?php 
							$getwayLists = $getwayList;							
							$convenience_amount= $getwayLists->dsapayg_convenience_fee;
							$convenience_min_amount= $getwayLists->dsapayg_convenience_fee;
							if($getwayLists->dsapayg_type=="fix")
						  {
							 $final_con =  round($getwayList->dsapayg_convenience_fee*$total_pax);
						  } else {
							$final_con =  round(( $DirPublishedFarePrice * $getwayList->dsapayg_convenience_fee)/100);
						  } 		
						  


						 ?>
				<div class="col-md-12">		
				<div class="checkbox">	
						<label>				
						<input name="payment_method" class="payment_option" checked type="radio" value="<?php echo $getwayLists->dsapayg_gateway_name; ?>"> 
							<?php 
								if($current_currency == "AED"){
									echo "&nbsp;&nbsp; PayD Payment";
								}else{
									//echo $getwayLists->dsapayg_gateway_name; 
									echo '&nbsp;&nbsp; CC Avenue'; 
								}
							?>
						</label>
							<br/>
							<!--<span class=""><?= getCurrencySymbol($current_currency) ?> <?php echo $final_con ?> Convenience Fee (Will be included in total fare at the time of payment) </span>-->
							<?php $_SESSION[$getwayLists->dsapayg_gateway_name]['Conv_fee'] = $final_con; ?>
							<?php $_SESSION['flight']['Conv_fee'] = $final_con; ?>


							<br/><br/>
							</div>
							</div>
							<?php //}  ?> 
							
							
									<?php  ?>
									

									<!---========END Customer Wallet or payment==============-->
											
										  <div class="col-lg-12">
										  
										  <?php 
											
											if ($this->session->userdata ( 'Userlogin' ) != NULL) {?>
											<div class="form-group">
												<ul class="list-inline">
												 <input type="hidden" name="sessionid" value="<?php echo $this->input->get('seesionid'); ?>" />
													<button type="button"  class="btn btn-search booking_btn bookingbtnsubmit btn-com pax_validation_continue"> Continue Booking<i class="icofont-ui-flight"></i></button>
												</ul>
											</div>
											<?php }else {?>
											<div class="form-group">
												<ul class="list-inline">
												 <input type="hidden" name="sessionid" value="<?php echo $this->input->get('seesionid'); ?>" />
													<li class="list-inline-item">					
													<button type="button"  class="btn btn-search booking_btn bookingbtnpopup bookingbtnsubmit btn-com pax_validation_continue"> Continue as Guest <i class="icofont-ui-flight"></i></button>														
													</li>
													<li class="list-inline-item">
														<span>Or</span>
													</li>
													<li class="list-inline-item">
														
													<a data-toggle="modal" data-target="#login_modal" class="btn btn-info purchasenow text-white">Login & Continue </a>	
													
														
													</li>
												</ul>
											</div>
											
											<?php }?>
											
											
					                    </div>
				                 	</div>
				               </div>
							</div>
						</div>
						<!-- Gst Details end from here -->
					</div><!--/ Traveller Details Start From here -->


					</form>
				</div>
			</div>
		
		<div class="col-md-3">
				<div class="flght-side-det">
					<div class="review_title clearfix">
		              <h4 class="">Fare Details</h4>
		            </div>
		            <div class="contant">
		            	<ul class="fare_details list-unstyled mb-0">
						 
		            		<li>
								<a class="collapsed" href="javascript:void(0)" role="button" data-toggle="collapse" data-target="#basefare">Base Fare<small>(<?php echo $total_pax; ?> Traveller) </small> <i class="icofont-rounded-down"></i></a><span class="float-right"><?= getCurrencySymbol($current_currency) ?> <?php echo round($base_fare); ?></span>
								<div class="collapse" id="basefare" aria-expanded="false">
									<ul class="list-unstyled">
									<?php
									  $FareBreakdown = $result->FareBreakdown;
									  $FareBreakdown = $result->FareBreakdown;
									  if (is_numeric(key($FareBreakdown))) {
									  foreach ($FareBreakdown as $key => $FBDetails) {
									  $PassengerType = passanger_t_f_number($FBDetails->PassengerType);
									  $noOfPess = $FBDetails->PassengerCount;
										?>
										<li>
											<span><?php echo $PassengerType; ?> x <?php echo $noOfPess; ?></span>
											<span class="float-right"><?= getCurrencySymbol($current_currency) ?> <?php echo round($FBDetails->BaseFare); ?></span>
										</li>
										  <?php } } ?>	
										
									</ul>
								</div>
							</li>
							<li>Tax (+) <span class="float-right"><?= getCurrencySymbol($current_currency) ?> <?php echo round($tax) ?></span></li>
						 	<?php  if($this->session->userdata("Userlogin") != NULL && $this->user_data->cust_balance > 0 && $wallet[0]->detected_wallet_percentage > 0 && $wallet[0]->detected_wallet_percentage < 100){ ?> 
			            		<li>Wallet Amount (-)<span class="float-right"><?= getCurrencySymbol($current_currency) ?> <?php echo ($this->user_data->cust_balance * $wallet[0]->detected_wallet_percentage) / 100; ?></span></li>
			            	<?php } ?>

			            	
							<li>Baggage <span class="float-right"><?= getCurrencySymbol($current_currency) ?><span class="conv baggage-price"></span></span></li>

							<li>Meal  & Bavarage <span class="float-right"><?= getCurrencySymbol($current_currency) ?><span class="conv meal-price"></span></span></li>

							


							<?php if($getwayList!="0"){              
						   if($getwayList->dsapayg_type=="fix")
								  {
									$nkwithconfee =  round($getwayList->dsapayg_convenience_fee*$total_pax);
								  } else {
									$nkwithconfee =  round(( $DirPublishedFarePrice * $getwayList->dsapayg_convenience_fee)/100,2);
								  } 
						   ?>
						   <!--
						   <li>Convenience Fee<span class="float-right"><?= getCurrencySymbol($current_currency) ?><span class="gateway_charge"> <?php echo $nkwithconfee; ?> <span></span></li>
						   -->
						  <?php } else { $nkwithconfee = 0; } ?> 
						   <li style="display: none;" class="coupon none"></li>
		            		<li>Total Fare<span class="float-right"><?= getCurrencySymbol($current_currency) ?><span class="final_fare finalamount">
		            			<?php echo round($customer_fare); ?></span></span></li>
		            	</ul>
		            </div>
		       
							<!-- Apply Coupon -->
							<div class="flght-side-det">
								<div class="review_title">
									<h4 class="">Apply Coupon</h4>
								</div>
								<div class="contant">
									<div id="massegealert" > </div>
									<div class="apply-coupoun text-center">
										<div class="form-group">
											<input type="text" id="user_coupon" name="coupon" class="form-control" placeholder="Enter Coupon code to get discount">
										</div>
									<a href="#none" id="add_coupon" class="btn btn-search">Add coupon</a>
									</div>
								</div>
							</div>
					   		<!-- Apply Coupon end -->

			   </div>
			</div>
		</div>
	</div>
</section>

<!----Baggage Fare Rule----->
<!--baggage and fare rule popup start here-->

<!-- Modal -->
<div class="modal fade" id="baggage-fare-rule" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content custm_tab">
      <div class="modal-body p-0">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="icofont-close"></i>
        </button>
            <nav>
              <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="baggage-tab" data-toggle="tab" href="#baggage" role="tab" aria-controls="baggage" aria-selected="true">Baggage</a>
                <a class="nav-item nav-link" id="farerule-tab" data-toggle="tab" href="#farerule" role="tab" aria-controls="farerule" aria-selected="false"  onclick="getFareRulepoonam('<?php echo $traceID; ?>','<?php echo $result->ResultIndex; ?>','0');">Fare Rules</a>
              
			  </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
              <div class="tab-pane fade show active" id="baggage" role="tabpanel" aria-labelledby="baggage-tab">
                <table class="table table-bordered">
                <tbody>
                  <tr>
                    <td>Cabin Baggage </td>
                    <td>Check-In Baggage </td>
                  </tr>                
                  <tr>
                    <td>
						<?php if($segment[0][0]->CabinBaggage!=""){
							echo $segment[0][0]->CabinBaggage ;
						 }
							else{ echo "0";
						 }?>
						</td>
                    <td>
					<?php if($segment[0][0]->Baggage!=""){
							echo $segment[0][0]->Baggage ;
						 }
							else{ echo "0";
						 }?>
					
					</td>
                  </tr>
                </tbody>
              </table>
              </div>
              <div class="tab-pane fade" id="farerule" role="tabpanel" aria-labelledby="farerule-tab">             
				 <span id="loadfarerule0" style="text-center" class="fare-rule-cont">
				  <img  src="<?php echo site_url(); ?>assets/images/loading.gif">
              </div>
            </div>
      </div>
    </div>
  </div>
</div>
<!--baggage and fare rule popup end here-->

<!-----END Baggage Rule --->
<!-- Flight Booking Details End -->



<div class="modal fade" id="Modal_for_confirm">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Please Confirm your Flight</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
				<div class="confirm-flght-details">
					<div class="row">
						<div class="col-md-8">
							<div class="flt-dts">
								<div class="flt-booking-top">
									<h5></h5>
								</div>
							<?php
							foreach ($segment as $segment123) {
						$segmentcountint = count($segment123);
							?>
								<div class="flt-booking-dts">
							 <?php foreach ($segment123 as $segmentflight) { ?>
									<div class="row border-bottom border-left border-right">
										<div class="col-md-4 col-sm-6 border-right">
											<div class="airline-logo fl-o-way-com">
												<span class="air-brand">
													<img src="<?php echo site_url(); ?>assets/images/airlines/<?php echo $segmentflight->Airline->AirlineCode; ?>.gif" />
												</span>
												<h6><?php echo $segmentflight->Airline->AirlineName; ?></h6>
												<span class="text-muted d-block"><?php echo $segmentflight->Airline->AirlineCode; ?>-<?php echo $segmentflight->Airline->FlightNumber; ?></span>
											</div>
										</div>
										<div class="col-md-3 col-sm-6 col-4 border-right">
											<div class="dep-dr fl-o-way-com txt-lt">
												<h6><?php echo GetTime($segmentflight->Origin->DepTime); ?> | <?php echo GetDateScFull($segmentflight->Origin->DepTime); ?></h6>
												<p class="mb-0"> <?php echo $segmentflight->Origin->Airport->CityName; ?> (<?php echo $segmentflight->Origin->Airport->AirportCode; ?>)</p>
										<span class="text-muted d-block"><?php echo $segmentflight->Origin->Airport->AirportName; ?></span>
												
											</div>
										</div>
										<div class="col-md-3 col-sm-6 col-4 border-right">
											<div class="arv-dr fl-o-way-com txt-right">
												<h6><?php echo GetTime($segmentflight->Destination->ArrTime); ?> | <?php echo GetDateScFull($segmentflight->Destination->ArrTime); ?></h6>
										<p class="mb-0"><?php echo $segmentflight->Destination->Airport->CityName; ?> (<?php echo $segmentflight->Destination->Airport->AirportCode; ?>)</p>
										<span class="text-muted d-block"><?php echo $segmentflight->Destination->Airport->AirportName; ?></span>
											</div>
										</div>
										<div class="col-md-2 col-sm-6 col-4">
											<div class="st-prc-flt fl-o-way-com txt-right">
												<h6><h6><?php echo minute_to_hour($segmentflight->Duration); ?></h6>
												<!--<p class="mb-0 stp">Non stop</p>
												<span class="text-muted d-block trv-cls">Economy</span>-->
											</div>
										</div>
									</div>
									 <?php } ?>
								</div>
								  <?php } ?>
								
							</div>

							<div class="flt-dts">
								<div class="flt-booking-top">
									<h5>Passenger Detail</h5>
								</div>
								<div class="flt-booking-dts">
									<p class="mb-0 pax_data_apend"> </p>
								</div>
							</div>

							<div class="flt-dts">
								<div class="flt-booking-top">
									<h5>Contact Detail</h5>
								</div>
								<div class="flt-booking-dts">
									<p class="mb-2 email_confirm"><strong>Email:</strong> sk@gmail.com</p>
									<p class="mb-0 contact_confirm"><strong>Mobile No:</strong> 9848498484</p>
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
								
						
								<li>
								<a class="collapsed" href="javascript:void(0)" role="button" data-toggle="collapse" data-target="#basefare">Base Fare<small>(<?php echo $total_pax; ?> Traveller) </small> <i class="icofont-rounded-down"></i></a><span class="float-right"><?= getCurrencySymbol($current_currency) ?>  <?php echo round($base_fare); ?></span>
								<div class="collapse" id="basefare" aria-expanded="false">
									<ul class="list-unstyled">
									 <?php $FareBreakdown = $result->FareBreakdown;  
										if (is_numeric(key($FareBreakdown))) {
										  foreach ($FareBreakdown as $key => $FBDetails) {
										   $PassengerType = passanger_t_f_number($FBDetails->PassengerType);
										   $noOfPess = $FBDetails->PassengerCount;
										?>
										<li>
											<span><?php echo $PassengerType; ?> x <?php echo $noOfPess; ?></span>
											<span class="float-right"><?= getCurrencySymbol($current_currency) ?> <?php echo round($FBDetails->BaseFare); ?></span>
										</li>
										<?php } } ?>	
										
									</ul>
								</div>
							</li>	
					
							 
							<li>Tax (+)<span class="float-right"><?= getCurrencySymbol($current_currency) ?> <?php echo round($tax);?> </span></li>
							<li>Convenience Fee (+)<span class="float-right"><?= getCurrencySymbol($current_currency) ?> <span class="conv  totalConvenienceFee"> <?php echo $final_con; ?></span></span></li>
								<?php if($getwayList!="0"){              
						   if($getwayList->dsapayg_type=="fix")
								  {
									$nkwithconfee =  round($getwayList->dsapayg_convenience_fee*$total_pax);
								  } else {
									$nkwithconfee =  round(( $DirPublishedFarePrice * $getwayList->dsapayg_convenience_fee)/100,2);
								  } 
						   ?>
						    <li style="display: none;" class="coupon none"></li>
						  <!-- <li>Convenience Fee<span class="float-right"><?= getCurrencySymbol($current_currency) ?><span class="gateway_charge"> <?php echo $nkwithconfee; ?> <span></span></li>-->
						  <?php } else { $nkwithconfee = 0; } ?> 
							
							<li>Baggage <span class="float-right"><?= getCurrencySymbol($current_currency) ?><span class="conv baggage-price"></span></span></li>

							<li>Meal  & Bavarage <span class="float-right"><?= getCurrencySymbol($current_currency) ?><span class="conv meal-price"></span></span></li>
							
							<li>Total Fare<span class="float-right"><?= getCurrencySymbol($current_currency) ?><span class="final_fare finalamountPopup"><?php echo round($customer_fare + $final_con); ?></span></span></li>
						</ul>
					</div>
					        </div>
					        <ul class="mb-0 list-unstyled flt-side-dts">
					        	<li>
								<button type="button" class="btn btn-search w-100 mb-2 proceed_payment_data">Proceed Payment</button>
								<!--
								<button type="button" class="btn btn-search w-100 mb-2" onclick="window.location.href='flight-booking-confirm.php'">Proceed 
								Payment</button>
								-->
								</li>
					        	<li>
								
								<button type="button" class="btn btn-danger w-100" data-dismiss="modal">Close</button>
								</li>
					        </ul>
						
						
						
						
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!---->

    <div class="modal fade flights-search-popup" id="form_submit_pop_over" role="dialog">
	    <div class="modal-dialog">
	    
	      <!-- Modal content-->
	      <div class="modal-content">
	        <div class="modal-header">
	          <h5 class="text-center w-100">Please Wait... </h5>
			  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        </div>
	        <div class="modal-body">
				<div class="text-center">
					<!-- Loader start from here -->
			         	<div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
			        <!-- Loader end from here -->
				</div>
	        </div>
	        <div class="modal-footer">
	        </div>
	      </div>
	    </div>
  </div> 
  
    <div class="modal fade flights-search-popup" id="login_modal" role="dialog">
	    <div class="modal-dialog">
	    
		
		
	      <!-- Modal content-->
	      <div class="modal-content">
	        <div class="modal-header">
	          <h5 class="text-center w-100">Login </h5>
			    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        </div>
	        <div class="modal-body">
			
			<div id="successMessage" > </div>
			
				<div class="text-center">
					<form action="" method="post" role="form" id="login" class="loginsignupform">
					<div class="form-group lg-col">
						<input id="email_ajax" type="email" name="email" class="form-control" autocomplete="off" placeholder="Enter Your Email Id" required>
						<span><i class="icofont-envelope-open"></i></span>
					</div>
					<div class="form-group lg-col">
						<input id="password_ajax" type="password" name="password" class="form-control"  placeholder="Enter Your Password" required>
						<span><i class="icofont-lock"></i></span>
					</div>
					<!--
					<div class="login-form-bottom pt-2 pb-2">
						<ul class="list-inline mb-0">
							<li class="list-inline-item">
								<div id="remember" class="checkbox htl-srch-rtng">
			                      <label>
			                        <input type="checkbox" value="remember-me"> <span>Remember me?</span>
			                      </label>
			                      
			                    </div>
							</li>
							<li class="list-inline-item">
								<a class="forgot-password text-danger" data-toggle="modal" href='#forgot-password'>Forgot Password</a>
							</li>
							<li class="list-inline-item">
								<a href="<?php echo site_url();?>user/registration" class="text-success">Register Now</a>
							</li>
						</ul>
					</div>-->
					<button type="submit" class="btn btn-login login_in"><i class="icofont-long-arrow-right login_in"></i></button>
				</form>
				</div>
	        </div>
	        <div class="modal-footer">
	        </div>
	      </div>
	    </div>
  </div> 
	<?php $this->load->view('include/footer'); ?>
	<?php $this->load->view('js'); ?>
	<script>
		// $(".currency_change").on("click",function(e){
		// 	e.preventDefault();
		// 	console.log("clicked");
		// });

		$( ".baggageFareDetail" ).on("change",function(e){
			let baggage = $(this).val();
			let passenger = e.target.getAttribute('data-value');
			let baggageJson = <?php echo json_encode($baggage->Response->Baggage[0]); ?>;
			console.log(baggageJson);
			let convFee = <?php echo $DirPublishedFarePrice; ?>;
			let sessionID = "<?php echo $this->input->get('seesionid'); ?>" ;
			// $("#loader").modal('show');
			$("#form_submit_pop_over").modal('show');
			$.each(baggageJson, function (key, data) {
				if(data.Weight == baggage){
					var rawdata = data
					var sessionID = "<?php echo $this->input->get('seesionid'); ?>" ;
					$.ajax({
						type: "POST",
						url: "<?php echo site_url(); ?>flight/set_baggage_data",
						data: { 'baggageWeight': data.Weight, 'baggagePrice': data.Price,'sessionId':sessionID,'passenger':passenger,'rawData':data ,'type':'OB'},
						dataType: "text",
						cache:false,
						success: function(data){
							$("#form_submit_pop_over").modal('hide');
							if(data){
								data = Math.ceil(data)
								// console.log(parseInt(data));
								// console.log(Math.ceil(data));
								$(".baggage-price").html(data);
								let totalItemAmount = convFee + parseInt(data);
								localStorage.setItem("baggagePrice"+sessionID,data);
								let totalAmount = parseInt(convFee)  + parseInt(data) + parseInt((localStorage.getItem("mealPrice"+sessionID)) ? localStorage.getItem("mealPrice"+sessionID) : 0);
								$("#loader").modal('hide');
								let totalConvenienceFee = (totalAmount * <?php echo $getwayList->dsapayg_convenience_fee ?>) / 100;
								$(".finalamount").html(Math.round(totalAmount));
								$(".totalConvenienceFee").html(Math.round(totalConvenienceFee));
								$(".finalamountPopup").html(Math.round(totalAmount+totalConvenienceFee));
								console.log('baggage-price',data,'totalamount',totalAmount,'totalConvenienceFee',totalConvenienceFee);
							}
						},
						error : function(){
							$("#form_submit_pop_over").modal('hide');
						}
					});
					return false;
				}  
			})
		});
		//
		$( ".mealFareDetail" ).on("change",function(e){
			let baggage = $(this).val();
			let passenger = e.target.getAttribute('data-value');	
			let baggageJson = <?php echo json_encode($baggage->Response->MealDynamic[0]); ?>;
			let convFee = <?php echo $DirPublishedFarePrice; ?>;
			let sessionID = "<?php echo $this->input->get('seesionid'); ?>" ;
			$.each(baggageJson, function (key, data) {
				if(data.AirlineDescription == baggage){
					var sessionID = "<?php echo $this->input->get('seesionid'); ?>" ;
					// $("#loader").modal('show');
					$("#form_submit_pop_over").modal('show');
					$.ajax({
						type: "POST",
						url: "<?php echo site_url(); ?>flight/set_meals_data",
						data: { 'meal': data.AirlineDescription, 'price': data.Price,'sessionId':sessionID,'passenger':passenger,'rawData':data,'type':'OB' },
						dataType: "text",
						cache:false,
						success: function(data){
							$("#form_submit_pop_over").modal('hide');
							if(data){
								data = Math.ceil(data);
								$(".meal-price").html(data);
								let totalItemAmount = convFee + parseInt(data);
								localStorage.setItem("mealPrice"+sessionID,data);
								let totalAmount = parseInt(convFee)  + parseInt(data) + parseInt((localStorage.getItem("baggagePrice"+sessionID)) ? localStorage.getItem("baggagePrice"+sessionID) : 0);
								// $("#loader").modal('hide');
								let totalConvenienceFee = (totalAmount * <?php echo $getwayList->dsapayg_convenience_fee ?>) / 100;
								$(".finalamount").html(Math.round(totalAmount));
								$(".finalamountPopup").html(Math.round(totalAmount+totalConvenienceFee));
								$(".totalConvenienceFee").html(Math.round(totalConvenienceFee));
								console.log('mealData',data,'totalamount',totalAmount,'totalConvenienceFee',totalConvenienceFee);
							}
						},
						error : function(){
							$("#form_submit_pop_over").modal('hide');
						}
					});
					return false;
				}  
			})
		});
		$(document).ready(function() {
			let sessionID = "<?php echo $this->input->get('seesionid'); ?>" ;
			console.log('ajax run');
			$.ajax({ 
				type: "POST", 
				url: "<?php echo site_url(); ?>flight/remove_temp_data", 
				data: {'sessionId':sessionID},
			});
			localStorage.clear();
		});
		//mealcheckbox
		$(function () {
			$(".login_in").click(function () {
			
				emailid =  $("#email_ajax").val();
				password =  $("#password_ajax").val();			
				var sessionID = "<?php echo $this->input->get('seesionid'); ?>" ;
				// alert(sessionID);
				$.ajax({
					type: "POST",
					url: "<?php echo site_url(); ?>flight/login",               
					data: { email: emailid, password: password },
					dataType: "text",
					cache: false,
					success:
					function (data) {                     
						var obj = jQuery.parseJSON(data);
											
						if (obj.status == "success"){                          
							location.href = "<?php echo site_url(); ?>/flight/booking_detail?seesionid=" + sessionID;
							alert(obj.message);
						}else{
							$('#successMessage').html(obj.message);
								$("#successMessage").addClass("alert alert-danger");
							// return false;
						}
					}
				});
				return false;
			});
		});
	</script>
	<script>
		//script for coupon
		$("#add_coupon").click(function(){
			var coupontext = $("#user_coupon").val() ;
			var sessionid = "<?php echo $sessionid ?>" ;
			$("#loader").modal('show');
			$.ajax({
				url: "<?php echo site_url(); ?>flight/Getcoupon",
				type: "POST",
				data: { coupon:coupontext ,sessionid :sessionid },
				dataType: "text",
				cache: false,
				success: function(data){
					var obj = jQuery.parseJSON(data);
					if (obj.status == "success"){
						$("#loader").modal('hide');
						$('#massegealert').html(obj.message);
						$("#massegealert").addClass("alert alert-success");
						$('.conv').html(obj.total_con_fee);
						$('.final_fare').html(obj.amount);
						$("#add_coupon").attr("disabled", "disabled");
						$('.coupon_show').show();
						var getway_charge=parseInt($('.gateway_charge').text());
						$('.without_gatewaty').text(parseInt(obj.amount));
						$('.with_gatewaty').text(parseInt(getway_charge+obj.amount));
						$('.coupon').show();
						$('.coupon').append("Coupon Discount (-) <span class='float-right'> <?= getCurrencySymbol($current_currency) ?> "+ parseInt(obj.discount_amount) +"</span>");
					}else{
						$("#loader").modal('hide');
						$('#massegealert').html(obj.message);
						$("#massegealert").addClass("alert alert-danger");
					}
				},
				error: function (jqXHR, textStatus, errorThrown){
					alert('Error!')
				}
			});
		});
	</script>
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
							//alert(data);
							if(data){			
								$("#Modal_for_confirm").modal("hide");
								$("#travellerdetail").submit();
							}
						}
					});
					return false;
			});
		});
		//
		$.each($(".ex_date" ), function( index, item ) {
			$(item).datepicker({
				dateFormat: 'dd-mm-yy',
				changeMonth: true,
				changeYear: true,
				yearRange: "-0:+10",
				minDate: "<?php echo $depart; ?>",		
			});
		});
		// $( ".ex_date" ).datepicker({
		// 	dateFormat: 'dd-mm-yy',
		// 	changeMonth: true,
		// 	changeYear: true,
		// 	yearRange: "-0:+10",
		// 	minDate: "<?php echo $depart; ?>",		
		// });
		//Script for gst
		$("#gst-details").hide();
		if ($(".gstAllowed").is(":checked")) {  
			$("#gst-details").show();
		}else{ 
			$("#gst-details").hide();
		}
		$('.gstAllowed').change(function() {
			if (this.value == 'gst_data_filed') {
				$("#gst-details").toggle();
			}
		});
		$("form").submit(function() {
			$(".gstAllowed").removeAttr("disabled");
		});
	</script>
