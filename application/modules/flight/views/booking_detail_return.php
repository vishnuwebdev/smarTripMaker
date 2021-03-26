<style>

div.multiple_select_checkbox {
    width: 100%;
    height: 160px;
    overflow-x: hidden;
    overflow-y: auto;
    border: 1px solid #CCCCCC;
}
.font-22{
	font-size:22px;
}
</style>

<?php $this->load->view('include/head');
$this->load->view('include/header');

$result = $confrimdataOB->Response->Results;
$resultIB = $confrimdataIB->Response->Results;

$traceID = $confrimdataOB->Response->TraceId;


if ($this->session->userdata('Userlogin') != NULL) {

    $loginuser = $this->session->userdata('Userlogin')['userData'];
} else {
    $loginuser = array();
}

$segment = $result->Segments;
$segmentIB = $resultIB->Segments;
$old_selected_data=json_decode ($_SESSION ["flight"] [$this->input->get('seesionid')] ["Search_Result_json"]);

$dsa_data=$this->dsa_data;
$dsa_airline_code=$segment[0][0]->Airline->AirlineCode;
$dsa_airline_code_ib=$segmentIB[0][0]->Airline->AirlineCode;



for($k=0; $k<count($old_selected_data->Response->Results[0]); $k++){
	if($old_selected_data->Response->Results[0][$k]->ResultIndex == $result->ResultIndex ){	
		$old_OB_fare=$old_selected_data->Response->Results[0][$k]->Fare;
		$offer_fare=$old_OB_fare->OfferedFare;
		$publish_fare=$old_OB_fare->PublishedFare;
    $baseFare_old = $old_OB_fare->BaseFare;
    $yq_fare_old = $old_OB_fare->YQTax;
		$bp_fare_data1=bp_get_fare($offer_fare,$publish_fare,$dsa_airline_code,$dsa_data,$baseFare_old,$yq_fare_old);
		$customer_old_fare=$bp_fare_data1['customer_fare'];
		// $customer_old_fare=$publish_fare;
	}
}

for($k=0; $k<count($old_selected_data->Response->Results[1]); $k++){
	if($old_selected_data->Response->Results[1][$k]->ResultIndex == $resultIB->ResultIndex ){
		$old_IB_fare=$old_selected_data->Response->Results[1][$k]->Fare;
		$offer_fare_ib=$old_IB_fare->OfferedFare;
		$publish_fare_ib=$old_IB_fare->PublishedFare;
		$baseFare_ib = $old_IB_fare->BaseFare;
		$yq_fare_ib = $old_IB_fare->YQTax;
		$bp_fare_data_ib1=bp_get_fare($offer_fare_ib,$publish_fare_ib,$dsa_airline_code_ib,$dsa_data,$baseFare_ib,$yq_fare_ib);
		$customer_old_ib=$bp_fare_data_ib1['customer_fare'];
		// $customer_old_ib=$publish_fare_ib;
	}
}
$offer_fare=$result->Fare->OfferedFare;
$publish_fare=$result->Fare->PublishedFare;
$baseFare = $result->Fare->BaseFare;
$current_currency = $result->Fare->Currency;
$yq_fare = $result->Fare->YQTax;
$bp_fare_data=bp_get_fare($offer_fare,$publish_fare,$dsa_airline_code,$dsa_data,$baseFare,$yq_fare);
$dsa_fare=$bp_fare_data['dsa_fare'];
$customer_fare=$bp_fare_data['customer_fare'];
 
 // $dsa_fare = $offer_fare;
// $customer_fare = $publish_fare;
$base_fare = $result->Fare->BaseFare;
$tax=$customer_fare-$base_fare;



$offer_fare_ib=$resultIB->Fare->OfferedFare;
$publish_fare_ib=$resultIB->Fare->PublishedFare;
$baseFare_ib = $resultIB->Fare->BaseFare;
$yq_fare_ib = $resultIB->Fare->YQTax;
$bp_fare_data_ib=bp_get_fare($offer_fare_ib,$publish_fare_ib,$dsa_airline_code_ib,$dsa_data,$baseFare_ib,$yq_fare_ib);
$dsa_fare_ib=$bp_fare_data_ib['dsa_fare'];
$customer_fare_ib=$bp_fare_data_ib['customer_fare'];
// $dsa_fare_ib = $offer_fare_ib;
// $customer_fare_ib = $publish_fare_ib;
$base_fare_ib = $resultIB->Fare->BaseFare;
$tax_ib = $customer_fare_ib-$base_fare_ib;


$DirPublishedFarePriceOB =  round ( $customer_fare );
$DirPublishedFarePriceIB =  round ( $customer_fare_ib );

$_SESSION ['flight'][$sessionid] ['flight_total_fare_return'] = $DirPublishedFarePriceOB + $DirPublishedFarePriceIB;
$_SESSION ['flight'][$sessionid] ['flight_total_fare_OB'] = $DirPublishedFarePriceOB;
$_SESSION ['flight'][$sessionid] ['flight_total_fare_IB'] = $DirPublishedFarePriceIB;
$_SESSION ['flight'][$sessionid]['farequote_data_OB']['TraceId'] = $confrimdataOB->Response->TraceId;
$IsDomestic = $_SESSION["flight"][$sessionid]["search_RequestData"];
//PrintArray();
$total_pax =(int)$IsDomestic['no_adult'] + (int)$IsDomestic['no_child'] +  (int)$IsDomestic['no_infants'] ;
// die;
$SearchData =  "";
$search_data=$_SESSION ['flight'] [$this->input->get('seesionid')] ['search_RequestData'];

//echo $_SESSION ['flight'][$sessionid] ['flight_total_fare_return'];
$_SESSION['copont_applied']= FALSE;



//print_r($baggageOB);
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
							<h5><?php echo date("j M Y, D", strtotime($search_data['depart_date']) ); ?>
							<a href="#baggage-fare-ruleOB" data-toggle="modal" data-target="" class="float-right baggage-fare">Baggage and Fare Rules</a>
							</h5>
						</div>
						 <?php
						foreach ($segment as $segment123) {
							$segmentcountint = count($segment123);
                    ?>
					<?php foreach ($segment123 as $segmentflight) { ?>
						<div class="flt-booking-dts">
							<div class="row">
								<div class="col-md-3 col-sm-3 col-7">
									<div class="airline-logo fl-o-way-com">
										<span class="air-brand">
											<img src="<?php echo site_url(); ?>assets/images/airlines/<?php echo $segmentflight->Airline->AirlineCode; ?>.gif" />
										</span>
										<h6> <?php echo $segmentflight->Airline->AirlineName; ?></h6>
										<span class="text-muted d-block"><?php echo $segmentflight->Airline->AirlineCode; ?>-<?php echo $segmentflight->Airline->FlightNumber; ?></span>
									</div>
								</div>
								<div class="col-md-3 col-sm-3 col-5">
									<div class="dep-dr fl-o-way-com">
										<h6><?php echo GetTime($segmentflight->Origin->DepTime); ?>| <?php echo GetDateScFull($segmentflight->Origin->DepTime); ?></h6>
										<p class="mb-0"><?php echo $segmentflight->Origin->Airport->CityName; ?>(<?php echo $segmentflight->Origin->Airport->AirportCode; ?>)</p>
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
										<h6><?php echo minute_to_hour($segmentflight->Duration); ?></h6>
										<!--<p class="mb-0 stp">Non stop</p>
										<span class="text-muted d-block trv-cls">Economy</span>-->
									</div>
								</div>
							</div>
						</div>
					

					<?php } ?>
						
			<?php } ?>	
					</div><!--/ Flight details list oneWay end Paul -->

					<!---=========Return Details==========---->
					<div class="flght-shrt-descr position-relative mb-3">
						<span class="fl-icon">
							<i class="icofont-ui-flight"></i>
						</span>
						<span class="d-block">Return</span>						
					</div>
					
					
					<div class="flt-booking-wrap mb-2 mb-md-3">
						<div class="flt-booking-top">
							<h5><?php echo date("j M Y D", strtotime($search_data['return_date']) ); ?>
							<a href="#baggage-fare-ruleIB" data-toggle="modal" data-target="" class="float-right baggage-fare">Baggage and Fare Rules</a>
							</h5>
						</div>
						 <?php
                foreach ($segmentIB as $segment123) {

                    $segmentcountint = count($segment123);
                    ?>
					<?php foreach ($segment123 as $segmentflight) { ?>
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
										<h6><?php echo GetTime($segmentflight->Origin->DepTime); ?> | <?php echo GetDateScFull($segmentflight->Origin->DepTime); ?></h6>
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
										<h6><?php echo minute_to_hour($segmentflight->Duration); ?></h6>
										<!--<p class="mb-0 stp">Non stop</p>
										<span class="text-muted d-block trv-cls">Economy</span>
										-->
									</div>
								</div>
							</div>
						</div>
					

				<?php }?>
			<?php }?>
					
					</div>
					
					
				
					
					<!-- Traveller Details Start From here -->
				<form action="<?php echo site_url(); ?>flight/payment_request" method="post" id="travellerdetail">
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
                            for ($i = 1; $i <= $noOfPess; $i ++) {
                                ?>
					 
							<div class="flt-booking-dts">
								<div class="col-fly-inn">
					                 <label><?php echo $PassengerType . ' ' . $i; ?> -</label>
					                 <div class="row">
					                   <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					                     <div class="form-group custom-select-wrap">
					                       <select class="form-control custom-select pax_validation_field title_auto_fill for_pop_data" pestype="<?php echo $PassengerType;?>" forend="0"  name="<?php echo $PassengerType; ?>Title_<?php echo $i; ?>"
                                           error_msg="Please select Title for <?php echo $PassengerType; ?>"
                                           key_unique="<?php echo $PassengerType . $i; ?>">
					                          <option value="">Select Title</option>
											   <?php
                                            if ($PassengerType == "Adult") {
                                                ?>
												<option value="Mr">Mr</option>
                                                <option value="Ms">Ms</option>
												<option value="Mrs">Mrs</option>
                                                <option value="Miss">Miss</option>
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
					                        <input type="text" class="form-control pax_validation_field for_pop_data"  pestype="<?php echo $PassengerType;?>" forend="1"
                                               id="<?php echo $PassengerType; ?>FirstName_<?php echo $i; ?>"
                                               placeholder="Enter First Name" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)" name="<?php echo $PassengerType; ?>FirstName_<?php echo $i; ?>"  error_msg="Please enter first name for <?php echo $PassengerType; ?>">
					                      </div>
					                    </div>
					                     <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					                        <div class="form-group">
					                          <input type="text" class="form-control pax_validation_field for_pop_data"  pestype="<?php echo $PassengerType;?>" forend="2"
                                               id="<?php echo $PassengerType; ?>LastName_<?php echo $i; ?>"
                                               placeholder="Enter Last Name" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)" name="<?php echo $PassengerType; ?>LastName_<?php echo $i; ?>"
                                               error_msg="Please enter Last name for <?php echo $PassengerType; ?>">
					                        </div>
					                      </div>
					                      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					                        <div class="form-group">
					                        <input type="text" class="form-control pax_validation_field gender_auto_fill co_gander" id="<?php echo $PassengerType; ?>Gender_<?php echo $i; ?>" placeholder="Gender" name="<?php echo $PassengerType; ?>Gender_<?php echo $i; ?>" error_msg="Please select gender  for <?php echo $PassengerType; ?>" readonly key_unique="<?php echo $PassengerType . $i; ?>">
					                      </div>
					                      </div>
										 
									<?php if ($IsDomestic['IsDomestic'] == "false" || $dsa_airline_code=="I5" || $PassengerType == "Child" || $PassengerType == "Infant" ) { ?>										 
					                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					                      <div class="form-group">
					                        <input type="text" readonly error_msg="Please select DOB for <?php echo $PassengerType; ?>" name="<?php echo $PassengerType; ?>Date_<?php echo $i; ?>" class="form-control pax_<?php echo $PassengerType; ?>_dob pax_validation_field co_dateofbirth"  placeholder="Date of Birth">
					                      </div>
					                    </div>
									<?php }?>
										
										  <?php
										if ($IsDomestic ['IsDomestic'] == "false") {
                                        ?>
										
					                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					                        <div class="form-group pass_number pax_validation_field">
					                          <input type="text" class="form-control"  error_msg="Please Enter Passport no for <?php echo $PassengerType; ?>" name="<?php echo $PassengerType; ?>PassportNum_<?php echo $i; ?>" placeholder="Passport No">
					                        </div>
					                    </div>
					                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					                      <div class="form-group">
					                        <input type="text" readonly="" placeholder="Passport Exp." class="form-control ex_date pax_validation_field co_expdatebirth" readonly
                                             error_msg="Please select passport Exp. for <?php echo $PassengerType; ?>" name="<?php echo $PassengerType; ?>PassExpDate_<?php echo $i; ?>">
					                      </div>
					                    </div>
					                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					                       <div class="form-group flght-icon custom-select-wrap">
					                        <select name="" id="nationality" class="form-control custom-select pax_validation_field for_pop_data"  pestype="<?php echo $PassengerType;?>" forend="0" name="<?php echo $PassengerType; ?>IssuingCntry_<?php echo $i; ?>" error_msg="Please select Title for <?php echo $PassengerType; ?>" key_unique="<?php echo $PassengerType . $i; ?>" >
											
					                            <option value="">Select Nationality</option>
					                            <?php foreach($nationality as $country){ ?>
					                        	<option value="<?php echo $country->alpha_2_code.'_'.$country->en_short_name ?>"><?php echo $country->en_short_name; ?></option>
					                        <?php } ?>
					                        </select>
					                      </div>
					                    </div>
					               <?php } ?>

								  </div>
					               </div>
							</div>
					
					<?php if($PassengerType !='Infant'){
					 if($baggageOB->Response->MealDynamic) {  ?>
					<div class="flt-booking-wrap mb-2 mb-md-3">
					
						<span class="fl-icon" style="font-size:20px;">
							<i class="icofont-long-arrow-right"></i>
						</span>
						Onward
						<div class="flt-booking-top">
							<h5>
								<span>
									<i class="icofont-school-bag font-22"></i> Baggage
								</span> 
								<span class="float-right">
									<i class="icofont-fast-food font-22"></i> Meal & Bavrage
								</span>
							</h5>
						</div>
						<div class="flt-booking-dts">
							<div class="row">
								<div class="col-md-6">
									 <div class="form-group">
									 	<select class="form-control baggageOB" name="baggageOB[]" data-value="<?php echo $PassengerType; ?>_<?php echo $i; ?>" id="baggageOB">
									 		<option value="">Select Baggage</option>
											<?php for($j=0; $j<count($baggageOB->Response->Baggage[0]); $j++){ 	?>
									 			<option value="<?php echo ($baggageOB->Response->Baggage[0][$j]->Weight); ?>">
												 	<?php echo ($baggageOB->Response->Baggage[0][$j]->Weight); ?> Kilogram <?php echo ($baggageOB->Response->Baggage[0][$j]->Price); ?>
												</option>
									 		<?php } ?>	
									 	</select>
									 </div>
								</div>
								<div class="col-md-6">
									 <div class="form-group">
									 	<select class="form-control mealFareOB" name="mealOB[]" data-value="<?php echo $PassengerType; ?>_<?php echo $i; ?>"  >
									 		<option value="">Select Meals</option>
									 			 <?php for($j=0; $j<count($baggageOB->Response->MealDynamic[0]); $j++){
														if(!empty($baggageOB->Response->MealDynamic[0][$j]->AirlineDescription)){ ?>
   															<option value="<?php echo $baggageOB->Response->MealDynamic[0][$j]->AirlineDescription; ?>" /><?php echo ($baggageOB->Response->MealDynamic[0][$j]->AirlineDescription); ?> <?php echo ($baggageOB->Response->MealDynamic[0][$j]->Price); ?> <?= getCurrencySymbol($current_currency,false) ?></option>
												<?php } } ?>
									 	</select>
									 </div>
								</div>
							</div>
						</div>
					</div>
<?php } ?>
	<?php if($baggageIB->Response->MealDynamic) { ?>
					<div class="flt-booking-wrap mb-2 mb-md-3">
					
						<span class="fl-icon" style="font-size:20px;"><i class="icofont-long-arrow-left"></i></span>
						Return
						<div class="flt-booking-top">
							<h5><span><i class="icofont-school-bag font-22"></i> Baggage</span> <span class="float-right"><i class="icofont-fast-food font-22"></i> Meal & Bavrage</span></h5>
						</div>
						<div class="flt-booking-dts">
							<div class="row">
								<div class="col-md-6">
									 <div class="form-group">
									 	<select class="form-control baggageIB" name="baggageIB[]" data-value="<?php echo $PassengerType; ?>_<?php echo $i; ?>">
									 		<option value="">Select Baggage</option>
									 	<?php for($j=0; $j<count($baggageIB->Response->Baggage[0]); $j++){ ?>
									 			<option value="<?php echo ($baggageIB->Response->Baggage[0][$j]->Weight); ?>"><?php echo ($baggageIB->Response->Baggage[0][$j]->Weight); ?> Kilogram <?php echo ($baggageIB->Response->Baggage[0][$j]->Price); ?></option>
									 		<?php } ?>	
									 	</select>
									 </div>
								</div>
								<div class="col-md-6">
									 <div class="form-group">
									 	<select class="form-control mealFareIB" name="mealIB[]" data-value="<?php echo $PassengerType; ?>_<?php echo $i; ?>"  >
									 		<option value="">Select Meals</option>
									 			<?php for($j=0; $j<count($baggageIB->Response->MealDynamic[0]); $j++){ 
				if(!empty($baggageIB->Response->MealDynamic[0][$j]->AirlineDescription)){
	?>

   <option value="<?php echo $baggageIB->Response->MealDynamic[0][$j]->AirlineDescription; ?>" /><?php echo ($baggageIB->Response->MealDynamic[0][$j]->AirlineDescription); ?> <?php echo ($baggageIB->Response->MealDynamic[0][$j]->Price); ?> <?= getCurrencySymbol($current_currency,false) ?></option>

	<?php } } ?>
									 	</select>
									 </div>
								</div>
							</div>
						</div>
					</div>
				<?php } } ?>
						 <?php
                            }
                        }
                    }
                    ?>
						
						
						</div>
						
				
				





					<!--/ Frequent Flyer end Paul -->
				<!---================================-->
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
							<div class="flt-booking-top htl-srch-rtng1">
								<h5>
							 <?php
								if ($result->IsGSTMandatory == 1) {?>
								 <input type="hidden" name="GSTAllowed" value="gst_data_filed"  >
									<label for="gst-air" id="gst-airline">		
									<input type="checkbox" id="gst-air" class="flightfare gstAllowed" checked>
									<span> GST Mandatory for this Airline</span>
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
								<div class="col-fly-inn" class="gst_details">
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
				
					
						
			
						<!-- Gst Details start from here -->
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
				                  		<label for="accept-pol" class="accept" >
					 	 					<input type="checkbox" id="accept-pol" class="flightfare" value="NonRefundable">
					 	 					<span>					 	 						
												I have read and accept the <a target="blank" href="https://www.smarttripmaker.com/online/terms-and-conditions"> Terms and Conditions </a> and <a target="blank" href="https://www.smarttripmaker.com/online/privacy-policy">Privacy Policy</a>.
												
					 	 					</span>
					 	 				</label>
				                  	</div>
										</div>
										
										<!--========Customer wallet or payment gatway==========-->
									 <!--Radio buttons for balance-->
	   <!--check customer wallet -->
		   
		<?php 
		  	if($this->session->userdata("Userlogin") != NULL){    
				$bp_customer_total_balance=convertActualPrice($this->user_data->cust_balance,$current_currency);
				$bp_total_fare = $customer_fare;
				if($bp_customer_total_balance>=$bp_total_fare){
		?>
					<div class="col-md-12">
						<div class="checkbox">
                            <label>
							<input name="wallet_amount" class="term_condition" type="radio" value="customerCash"> Customer <b>Balance : </b><?= getCurrencySymbol($current_currency) ?><?php echo $bp_customer_total_balance; ?> </label>
                        </div>
					</div>	
		<?php } }?>

		<?php 
			$getwayLists = $getwayList;							
			$convenience_amount= $getwayLists->dsapayg_convenience_fee;
			$convenience_min_amount= $getwayLists->dsapayg_convenience_fee;
			if($getwayLists->dsapayg_type=="fix"){
				$final_con =  round($getwayList->dsapayg_convenience_fee*$total_pax);
			} else {
				$final_con =  round((( $DirPublishedFarePriceOB + $DirPublishedFarePriceIB) * $getwayList->dsapayg_convenience_fee)/100);
			} 
			// echo $final_con;		  
		?>
		<div class="col-md-12">		
			<div class="checkbox">	
					<label>				
						<input name="payment_method" class="payment_option" checked type="radio" value="<?php echo $getwayLists->dsapayg_gateway_name; ?>"> 
						<?php 
							if($current_currency == 'AED'){
								echo "PayD Payment Gateway";
							}else{
								
								echo "CC Avenue";
								// echo $getwayLists->dsapayg_gateway_name; 
							}
						?>
					</label>
							<!--	<span class=""><?= getCurrencySymbol($current_currency) ?> <?php echo $final_con ?> Convenience Fee (Will be included in total fare at the time of payment) </span>-->
							<?php $_SESSION[$getwayLists->dsapayg_gateway_name]['Conv_fee'] = $final_con; ?>
							<?php $_SESSION['flight']['Conv_fee'] = $final_con; ?>
							<br/><br/>
							</div>
							</div>
						<?php //} ?> 
							
									
									

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
													<li class="list-inline-item">	
												<input type="hidden" name="sessionid" value="<?php echo $this->input->get('seesionid'); ?>" />													
													<button type="button"  class="btn btn-search booking_btn bookingbtnsubmit btn-com pax_validation_continue"> Continue as Guest <i class="icofont-ui-flight"></i></button>														
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
									   
									   
<!--									   <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 offset-md-8">
					                      <div class="form-group text-md-right">
										  <input type="hidden" name="sessionid" value="<?php echo $this->input->get('seesionid'); ?>" />
										   <button type="button" class="btn btn-search booking_btn bookingbtnsubmit btn-com pax_validation_continue">Continue Booking</button>										 
					                      </div>
					                    </div>
										-->
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
						<li><strong>Onward</strong></li>
							
							<li>
								<a class="collapsed" href="javascript:void(0)" role="button" data-toggle="collapse" data-target="#basefare">Base Fare<small>(<?php echo $total_pax; ?> Traveller) </small> <i class="icofont-rounded-down"></i></a><span class="float-right"><?= getCurrencySymbol($current_currency) ?> <?php echo number_format($result->Fare->BaseFare); ?></span>
								<div class="collapse" id="basefare" aria-expanded="false">
									<ul class="list-unstyled">
									<?php
									$FareBreakdown = $result->FareBreakdown;
									if (is_numeric(key($FareBreakdown))) {
										foreach ($FareBreakdown as $key => $FBDetails) {
											$PassengerType = passanger_t_f_number($FBDetails->PassengerType);
											$noOfPess = $FBDetails->PassengerCount;
											?>
										<li>
											<span><?php echo $PassengerType; ?> x <?php echo $noOfPess; ?></span>
											<span class="float-right"><?= getCurrencySymbol($current_currency) ?> <?php echo $FBDetails->BaseFare; ?></span>
										</li>
										<?php } } ?>
										
									</ul>
								</div>
							</li>	
						
		            		
		            									
		            		<li>Meal  & Bavarage
								 <span class="float-right"><?= getCurrencySymbol($current_currency) ?><span class="conv meal-priceOB"></span></span>
							</li>
							<li>Baggage <span class="baggage-weightOB"></span> <span class="float-right"><?= getCurrencySymbol($current_currency) ?><span class="conv baggage-priceOB"></span></span></li>

							<li>Tax (+)<span class="float-right"><?= getCurrencySymbol($current_currency) ?> <?php echo round($tax); ?></span></li>

		            		<li>Total Fare<span class="float-right final_fareOB finalamountOB"><?= getCurrencySymbol($current_currency) ?><?php echo $DirPublishedFarePriceOB; ?></span></li>

		            		
		            	</ul>
		            </div>
					
					 <div class="contant">
		            	<ul class="fare_details list-unstyled mb-0">
						<li><strong>Return</strong></li>
						
							<li>
							<a class="collapsed" href="javascript:void(0)" role="button" data-toggle="collapse" data-target="#basefare_ret">Base Fare<small>(<?php echo $total_pax; ?> Traveller) </small> <i class="icofont-rounded-down"></i></a><span class="float-right"><?= getCurrencySymbol($current_currency) ?> <?php echo number_format($resultIB->Fare->BaseFare); ?></span>
							<div class="collapse" id="basefare_ret" aria-expanded="false">
								<ul class="list-unstyled">
								 <?php
				 	    $FareBreakdown = $resultIB->FareBreakdown;
                        if (is_numeric(key($FareBreakdown))) {
                            foreach ($FareBreakdown as $key => $FBDetails) {
                                $PassengerType = passanger_t_f_number($FBDetails->PassengerType);
                                $noOfPess = $FBDetails->PassengerCount;
                                ?>
									<li>
										<span><?php echo $PassengerType; ?> x <?php echo $noOfPess; ?></span>
										<span class="float-right"><?= getCurrencySymbol($current_currency) ?> <?php echo $FBDetails->BaseFare; ?></span>
									</li>
									
									<?php } } ?>
									
								</ul>
							</div>
							</li>	
							
		            		
		            		
							<li>Meal  & Bavarage
								 <span class="float-right"><?= getCurrencySymbol($current_currency) ?><span class="conv meal-priceIB"></span></span>
							</li>
							<li>Baggage <span class="baggage-weightIB"></span> <span class="float-right"><?= getCurrencySymbol($current_currency) ?><span class="conv baggage-priceIB"></span></span></li>

							<li>Tax (+)<span class="float-right"><?= getCurrencySymbol($current_currency) ?> <?php echo round($tax_ib); ?></span></li>

		            		<li>Total Fare<span class="float-right final_fareOB finalamountIB"><?= getCurrencySymbol($current_currency) ?><?php echo $DirPublishedFarePriceIB; ?></span></li>         	
						

                            <?php if($getwayList!="0"){
             
						  if($getwayList->dsapayg_type=="fix")
						  {
							$nkwithconfee =  round($getwayList->dsapayg_convenience_fee*$total_pax);
						  } else {
							$nkwithconfee =  round(( $DirPublishedFarePriceOB + $DirPublishedFarePriceIB * $getwayList->dsapayg_convenience_fee)/100,2);
						  } 
						?>  
						<!--	<li>Total Convenience Fee<span class="float-right"><?= getCurrencySymbol($current_currency) ?> <?php// echo $nkwithconfee; ?>  <?php } // else { $nkwithconfee = 0; } ?></span></li>
						-->
                  
						<!--li>Total Convenience Fee (+)<span class="float-right"><?= getCurrencySymbol($current_currency) ?> <span class="conv"><?php //echo $final_con; ?></span></span></li-->
                  				
						 <li style="display: none;" class="coupon none"></li>
						
						<li><strong>Grand Total</strong><span class="float-right"><?= getCurrencySymbol($current_currency) ?><span class="final_farePage"><?php echo $DirPublishedFarePriceOB + $DirPublishedFarePriceIB; ?></span></span></li></li>
						
						
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
										<input type="text" id="user_coupon" name="coupon" class="form-control mb-10" placeholder="Enter Coupon code to get discount">
									</div>
								  <a href="javascript:void(0)" id="add_coupon" class="btn btn-search">Add coupon</a>
								</div>
							  </div>
							</div>
					   <!-- Apply Coupon end -->
					
					
		        </div>
			</div>
		</div>
	</div>
</section>
<!-- Flight Booking Details End -->
<!-- Modal -->
<div class="modal fade" id="baggage-fare-ruleOB" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
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

<!-----RETURN FLIGHT FARE RULE------->
<div class="modal fade" id="baggage-fare-ruleIB" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content custm_tab">
      <div class="modal-body p-0">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="icofont-close"></i>
        </button>
            <nav>
              <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="baggage-tab" data-toggle="tab" href="#baggageIB" role="tab" aria-controls="baggage" aria-selected="true">Baggage</a>
                <a class="nav-item nav-link" id="farerule-tab" data-toggle="tab" href="#fareruleIB" role="tab" aria-controls="farerule" aria-selected="false"  onclick="getFareRulepoonam('<?php echo $traceID; ?>','<?php echo $resultIB->ResultIndex; ?>','1');">Fare Rules</a>
              
			  </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
              <div class="tab-pane fade show active" id="baggageIB" role="tabpanel" aria-labelledby="baggage-tab">
                <table class="table table-bordered">
                <tbody>
                  <tr>
                    <td>Cabin Baggage </td>
                    <td>Check-In Baggage </td>
                  </tr>                
                  <tr>
                    <td>
					<?php if($segmentIB[0][0]->CabinBaggage!=""){
							echo $segmentIB[0][0]->CabinBaggage ;
						 }
							else{ echo "0";
						 }?>				
					</td>
                    <td>
					<?php if($segmentIB[0][0]->Baggage!=""){
							echo $segmentIB[0][0]->Baggage ;
						 }
							else{ echo "0";
						 }?>
					</td>
                  </tr>
                </tbody>
              </table>
              </div>
              <div class="tab-pane fade" id="fareruleIB" role="tabpanel" aria-labelledby="farerule-tab">             
				 <span id="loadfarerule1" style="text-center" class="fare-rule-cont">
				  <img  src="<?php echo site_url(); ?>assets/images/loading.gif">
              </div>
            </div>
      </div>
    </div>
  </div>
</div>
<!--baggage and fare rule popup end here-->



<div class="modal fade" id="Modal_for_confirm">
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
						
						<!---Onward--->
							<div class="flt-dts">
								<div class="flt-booking-top">
									<h5>Onward(<?php echo date("j M Y, D", strtotime($search_data['depart_date']) ); ?>)</h5>
								</div>
								<?php 
								  foreach ($segment as $type_key => $segment123) {  ?>								
																
								<?php foreach ($segment123 as $segmentflight) { ?>
								<div class="flt-booking-dts">
									<div class="row">
										<div class="col-md-4 col-sm-6">
											<div class="airline-logo fl-o-way-com">
												<span class="air-brand">
													<img src="<?php echo site_url(); ?>assets/images/airlines/<?php echo $segmentflight->Airline->AirlineCode; ?>.gif" />
												</span>
												<h6><?php echo $segmentflight->Airline->AirlineName; ?></h6>
												<span class="text-muted d-block"><?php echo $segmentflight->Airline->AirlineCode; ?>-<?php echo $segmentflight->Airline->FlightNumber; ?></span>
											</div>
										</div>
										<div class="col-md-3 col-sm-6 col-4">
											<div class="dep-dr fl-o-way-com txt-lt">
												<h6><?php echo GetTime($segmentflight->Origin->DepTime); ?> | <?php echo GetDateScFull($segmentflight->Origin->DepTime); ?></h6>
												<p class="mb-0"><?php  echo $segmentflight->Origin->Airport->CityName;?> (<?php echo $segmentflight->Origin->Airport->AirportCode; ?>) </p>
												<span class="text-muted d-block"><?php echo $segmentflight->Origin->Airport->AirportName; ?></span>
											</div>
										</div>
										<div class="col-md-3 col-sm-6 col-4">
											<div class="arv-dr fl-o-way-com txt-right">
												<h6><?php echo GetTime($segmentflight->Destination->ArrTime); ?> | <?php echo GetDateScFull($segmentflight->Destination->ArrTime); ?></h6>
												<p class="mb-0"><?php echo $segmentflight->Destination->Airport->CityName; ?> (<?php echo $segmentflight->Destination->Airport->AirportCode; ?>)</p>
												<span class="text-muted d-block"><?php echo $segmentflight->Destination->Airport->AirportName; ?></span>
											</div>
										</div>
										<div class="col-md-2 col-sm-6 col-4">
											<div class="st-prc-flt fl-o-way-com txt-right">
												<h6><?php echo minute_to_hour($segmentflight->Duration); ?></h6>
												
											</div>
										</div>
									</div>
								</div>
						
						<?php } ?>

				<?php } ?>

						</div>
						<!---End Onward--->
							
							<!---Return--->
							<div class="flt-dts">
								<div class="flt-booking-top">
									<h5> Return (<?php echo date("j M Y, D", strtotime($search_data['return_date']) ); ?>)</h5>
								</div>
								<?php 
								  foreach ($segmentIB as $type_key => $segment123) {  ?>								
															
								<?php foreach ($segment123 as $segmentflight) { ?>
								<div class="flt-booking-dts">
									<div class="row">
										<div class="col-md-4 col-sm-6">
											<div class="airline-logo fl-o-way-com">
												<span class="air-brand">
													<img src="<?php echo site_url(); ?>assets/images/airlines/<?php echo $segmentflight->Airline->AirlineCode; ?>.gif" />
												</span>
												<h6><?php echo $segmentflight->Airline->AirlineName; ?></h6>
												<span class="text-muted d-block"><?php echo $segmentflight->Airline->AirlineCode; ?>-<?php echo $segmentflight->Airline->FlightNumber; ?></span>
											</div>
										</div>
										<div class="col-md-3 col-sm-6 col-4">
											<div class="dep-dr fl-o-way-com txt-lt">
												<h6><?php echo GetTime($segmentflight->Origin->DepTime); ?> | <?php echo GetDateScFull($segmentflight->Origin->DepTime); ?></h6>
												<p class="mb-0"><?php  echo $segmentflight->Origin->Airport->CityName;?> (<?php echo $segmentflight->Origin->Airport->AirportCode; ?>) </p>
												<span class="text-muted d-block"><?php echo $segmentflight->Origin->Airport->AirportName; ?></span>
											</div>
										</div>
										<div class="col-md-3 col-sm-6 col-4">
											<div class="arv-dr fl-o-way-com txt-right">
												<h6><?php echo GetTime($segmentflight->Destination->ArrTime); ?> | <?php echo GetDateScFull($segmentflight->Destination->ArrTime); ?></h6>
												<p class="mb-0"><?php echo $segmentflight->Destination->Airport->CityName; ?> (<?php echo $segmentflight->Destination->Airport->AirportCode; ?>)</p>
												<span class="text-muted d-block"><?php echo $segmentflight->Destination->Airport->AirportName; ?></span>
											</div>
										</div>
										<div class="col-md-2 col-sm-6 col-4">
											<div class="st-prc-flt fl-o-way-com txt-right">
												<h6><?php echo minute_to_hour($segmentflight->Duration); ?></h6>
												
											</div>
										</div>
									</div>
								</div>
						
						<?php } ?>

				<?php } ?>

						</div>
							
							<!---END Return--->
							<div class="flt-dts">
								<div class="flt-booking-top">
									<h5>Passenger Detail</h5>
								</div>
								<div class="flt-booking-dts flt-booking-dts border mt-2">
									<p class="mb-0 pax_data_apend"> </p>
								</div>
							</div>

							<div class="flt-dts">
								<div class="flt-booking-top">
									<h5>Contact Detail</h5>
								</div>
								<div class="flt-booking-dts border mt-2">
									<p class="mb-2 email_confirm"><strong>Email:</strong> </p>
									<p class="mb-0 contact_confirm"><strong>Mobile No:</strong></p>
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
									<li><strong>Onward</strong></li>
										
										<li>
								<a class="collapsed" href="javascript:void(0)" role="button" data-toggle="collapse" data-target="#basefareo">Base Fare<small>(<?php echo $total_pax; ?> Traveller) </small> <i class="icofont-rounded-down"></i></a><span class="float-right"><?= getCurrencySymbol($current_currency) ?> <?php echo number_format($result->Fare->BaseFare); ?></span>
								<div class="collapse" id="basefareo" aria-expanded="false">
									<ul class="list-unstyled">
									<?php
										 $FareBreakdown = $result->FareBreakdown;
										if (is_numeric(key($FareBreakdown))) {
										foreach ($FareBreakdown as $key => $FBDetails) {
										$PassengerType = passanger_t_f_number($FBDetails->PassengerType);
										$noOfPess = $FBDetails->PassengerCount;
										?>
										<li>
											<span><?php echo $PassengerType; ?> x <?php echo $noOfPess; ?></span>
											<span class="float-right"><?= getCurrencySymbol($current_currency) ?>  <?php echo $FBDetails->BaseFare; ?></span>
										</li>
										<?php } }	?>
									</ul>
								</div>
							</li>
								<li>Meal  & Bavarage
								 <span class="float-right"><?= getCurrencySymbol($current_currency) ?><span class="conv meal-priceOB"></span></span>
							</li>
							<li>Baggage <span class="baggage-weightOB"></span> <span class="float-right"><?= getCurrencySymbol($current_currency) ?><span class="conv baggage-priceOB"></span></span></li>
							
					            		<li>Tax (+)<span class="float-right"><?= getCurrencySymbol($current_currency) ?> <?php echo round($tax); ?></span></li>
					            		<li>Total Fare<span class="float-right finalamountOB"><?= getCurrencySymbol($current_currency) ?><?php echo $DirPublishedFarePriceOB; ?></span></li>
										
					            	</ul>
					            </div>
								 <div class="contant">
					            	<ul class="fare_details list-unstyled mb-0">
									<li><strong>Return</strong></li>
									<li>
								<a class="collapsed" href="javascript:void(0)" role="button" data-toggle="collapse" data-target="#basefarer">Base Fare<small>(<?php echo $total_pax; ?> Traveller) </small> <i class="icofont-rounded-down"></i></a><span class="float-right"><?= getCurrencySymbol($current_currency) ?> <?php echo number_format($resultIB->Fare->BaseFare); ?></span>
								<div class="collapse" id="basefarer" aria-expanded="false">
									<ul class="list-unstyled">
									<?php
									  $FareBreakdown = $resultIB->FareBreakdown;
										if (is_numeric(key($FareBreakdown))) {
										foreach ($FareBreakdown as $key => $FBDetails) {
										$PassengerType = passanger_t_f_number($FBDetails->PassengerType);
										$noOfPess = $FBDetails->PassengerCount;
										?>
										<li>
											<span><?php echo $PassengerType; ?> x <?php echo $noOfPess; ?></span>
											<span class="float-right"><?= getCurrencySymbol($current_currency) ?> <?php echo $FBDetails->BaseFare; ?></span>
										</li>
										<?php }
											}
										?>
										
									</ul>
								</div>
							</li>
							<li>Meal  & Bavarage
								 <span class="float-right"><?= getCurrencySymbol($current_currency) ?><span class="conv meal-priceIB"></span></span>
							</li>
							<li>Baggage <span class="baggage-weightIB"></span> <span class="float-right"><?= getCurrencySymbol($current_currency) ?><span class="conv baggage-priceIB"></span></span></li>

							<li>Tax (+)<span class="float-right"><?= getCurrencySymbol($current_currency) ?> <?php echo round($tax_ib); ?></span></li>
							<li>Total Fare<span class="float-right"><?= getCurrencySymbol($current_currency) ?> <span class="finalamountIB"><?php echo $DirPublishedFarePriceIB; ?></span></span></li>
							


							<?php if($getwayList!="0"){
             
				  if($getwayList->dsapayg_type=="fix")
                  {
                    $nkwithconfee =  round($getwayList->dsapayg_convenience_fee*$total_pax);
                  } else {
                    $nkwithconfee =  round(( $DirPublishedFarePriceOB + $DirPublishedFarePriceIB * $getwayList->dsapayg_convenience_fee)/100,2);
                  } 
				?>  
			<!--	<li>Total Convenience Fee<span class="float-right"><?= getCurrencySymbol($current_currency) ?> <?php echo $nkwithconfee; ?>  <?php } else { $nkwithconfee = 0; } ?></span></li>
				-->
							
							<li>Convenience Fee (+)<span class="float-right "><?= getCurrencySymbol($current_currency) ?> <span class="totalConvenienceFee"> <?php echo $final_con; ?></span></span></li>
							<li style="display: none;" class="coupon none"></li>
							<li><strong>Grand Total</strong><span class="float-right"><?= getCurrencySymbol($current_currency) ?><span class="finalamountPopup"><?php echo $DirPublishedFarePriceOB + $DirPublishedFarePriceIB + $final_con ; ?></span></span></li>
							
						</ul>
					</div>
					        </div>
					        <ul class="mb-0 list-unstyled flt-side-dts">
					        	<li>
								 <a  class="btn btn-search w-100 mb-2 proceed_payment_data text-white">Proceed Payment</a>
								<!--<button type="button" class="btn btn-search w-100 mb-2 proceed_payment_data" >Proceed Payment</button>-->
								</li>
					        	<li><button type="button" class="btn btn-danger w-100" data-dismiss="modal">Close</button></li>
					        </ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



  
   <div class="modal fade flights-search-popup" id="form_submit_pop_over" role="dialog">
	    <div class="modal-dialog">
	    
	      <!-- Modal content-->
	      <div class="modal-content">
	        <div class="modal-header">
	          <h5 class="text-center w-100">Please Wait... </h5>
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


  <!--MODAL FOR LOGIN-->
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
					<button type="submit" class="btn btn-login"><i class="icofont-long-arrow-right login_in"></i></button>
				</form>
				</div>
	        </div>
	        <div class="modal-footer">
	        </div>
	      </div>
	    </div>
  </div> 
  
  
  
<?php $this->load->view('include/footer');?>
<?php $this->load->view('js'); ?>

<script>

// $(document).ready(function(){
// 	localStorage.clear();
// 	localStorage.setItem('totalAmountIB<?php echo $this->input->get('seesionid'); ?>','<?php echo $DirPublishedFarePriceIB; ?>');
// 	localStorage.setItem('totalAmountOB<?php echo $this->input->get('seesionid'); ?>','<?php echo $DirPublishedFarePriceOB; ?>');
// });
$(document).ready(function() {
	let sessionID = "<?php echo $this->input->get('seesionid'); ?>" ;
	console.log('ajax run');
	$.ajax({ 
		type: "POST", 
		url: "<?php echo site_url(); ?>flight/remove_temp_data", 
		data: {'sessionId':sessionID},
	});
	localStorage.clear();
	localStorage.setItem('totalAmountIB<?php echo $this->input->get('seesionid'); ?>','<?php echo $DirPublishedFarePriceIB; ?>');
	localStorage.setItem('totalAmountOB<?php echo $this->input->get('seesionid'); ?>','<?php echo $DirPublishedFarePriceOB; ?>');
	console.log("done");
});

$( ".baggageOB" ).on("change",function(e){

	let baggageOB = $(this).val();
	let passengerOB = e.target.getAttribute('data-value');	
	let baggageJsonOB = <?php echo json_encode($baggageOB->Response->Baggage[0]); ?>;
	let convFee = <?php echo $DirPublishedFarePriceOB; ?>;
	let sessionID = "<?php echo $this->input->get('seesionid'); ?>" ;
	$.each(baggageJsonOB, function (key, data) {
		console.log(data,baggageOB)
    	if(data.Weight == baggageOB){
    		var rawdata = data
    		 $.ajax({
				type: "POST",
				url: "<?php echo site_url(); ?>flight/set_baggage_data",
				data: { 'baggageWeight': data.Weight, 'baggagePrice': data.Price,'sessionId':sessionID,'passenger':passengerOB,'rawData':data,'type':'OB' },
				dataType: "text",
				cache:false,
				success:
                function(data){
                	if(data){
                		$(".baggage-priceOB").html(data);
      					let totalItemAmount = convFee + parseInt(data);
						localStorage.setItem("baggagePriceOB"+sessionID,data);
						
						let totalAmount = parseInt(convFee)  + parseInt(data) + parseInt((localStorage.getItem("mealPriceOB"+sessionID)) ? localStorage.getItem("mealPriceOB"+sessionID) : 0);


							localStorage.setItem('totalAmountOB'+sessionID,totalAmount);
                       	let finalAmountOB = parseInt(totalAmount) + ((localStorage.getItem('totalAmountIB'+sessionID) != null) ? parseInt(localStorage.getItem('totalAmountIB'+sessionID)) : 0);


                       	$('.final_farePage').html(finalAmountOB);
                       	$(".finalamountOB").html(parseInt(totalAmount));
                       	localStorage.setItem('onWardTotalFare'+sessionID,finalAmountOB );


                       	let totalConvenienceFee = (finalAmountOB * <?php echo $getwayList->dsapayg_convenience_fee ?>) / 100;
                       	$(".totalConvenienceFee").html(Math.round(totalConvenienceFee));
                       	
                       	$(".finalamountPopup").html(Math.round(finalAmountOB+totalConvenienceFee));
                    }
                }
			});
	return false;
    	}  
	})


});







$( ".mealFareOB" ).on("change",function(e){
	let mealOB = $(this).val();
	let passengerOB = e.target.getAttribute('data-value');	
	let mealJsonOB = <?php echo json_encode($baggageOB->Response->MealDynamic[0]); ?>;
	let convFee = <?php echo $DirPublishedFarePriceOB; ?>;
	let sessionID = "<?php echo $this->input->get('seesionid'); ?>" ;
	$.each(mealJsonOB, function (key, data) {
    	
    	if(data.AirlineDescription == mealOB){

    		var sessionID = "<?php echo $this->input->get('seesionid'); ?>" ;
    			$("#loader").modal('show');
			$.ajax({
				type: "POST",
				url: "<?php echo site_url(); ?>flight/set_meals_data",
				data: { 'meal': data.AirlineDescription, 'price': data.Price,'sessionId':sessionID,'passenger':passengerOB,'rawData':data,'type':'OB' },
				dataType: "text",
				cache:false,
				success:
                function(data){
                	if(data){
						
                       	$(".meal-priceOB").html(data);
      					localStorage.setItem("mealPriceOB"+sessionID,data);
						let totalAmount = parseInt(convFee)  + parseInt(data) + (localStorage.getItem("baggagePriceOB"+sessionID) !=null ? parseInt(localStorage.getItem("baggagePriceOB"+sessionID)) : 0);

						localStorage.setItem('totalAmountOB'+sessionID,totalAmount);

                       	let finalAmountOB = parseInt(totalAmount) + ((localStorage.getItem('totalAmountIB'+sessionID) != null) ? parseInt(localStorage.getItem('totalAmountIB'+sessionID)) : 0);
                       	$('.final_farePage').html(finalAmountOB);
                       	$(".finalamountOB").html(parseInt(totalAmount));
                       	
                       	let totalConvenienceFee = (finalAmountOB * <?php echo $getwayList->dsapayg_convenience_fee ?>) / 100;
                       	$(".totalConvenienceFee").html(Math.round(totalConvenienceFee));
                       	$(".finalamountPopup").html(Math.round(finalAmountOB+totalConvenienceFee));
                    }
                }
			});
	return false;
    	}  
	})

});



$( ".baggageIB" ).on("change",function(e){
	let baggageIB = $(this).val();
	let passengerIB = e.target.getAttribute('data-value');
	console.log(baggageIB);
	let baggageJsonIB = <?php echo json_encode($baggageIB->Response->Baggage[0]); ?>;
	let convFee = <?php echo $DirPublishedFarePriceIB; ?>;
	let sessionID = "<?php echo $this->input->get('seesionid'); ?>" ;
	$.each(baggageJsonIB, function (key, data) {
    	if(data.Weight == baggageIB){
    		$.ajax({
				type: "POST",
				url: "<?php echo site_url(); ?>flight/set_baggage_data",
				data: { 'baggageWeight': data.Weight, 'baggagePrice': data.Price,'sessionId':sessionID,'passenger':passengerIB,'rawData':data,'type':'IB' },
				dataType: "text",
				cache:false,
				success:
                function(data){
                	console.log(data);
                	if(data){
                		$(".baggage-priceIB").html(data);
      					let totalItemAmount = convFee + parseInt(data);
						localStorage.setItem("baggagePriceIB"+sessionID,data);
						let totalAmount = parseInt(convFee)  + parseInt(data) + parseInt((localStorage.getItem("mealPriceIB"+sessionID)) ? localStorage.getItem("mealPriceIB"+sessionID) : 0);
						$("#loader").modal('hide');
                       	localStorage.setItem('totalAmountIB'+sessionID,totalAmount);

                       	let finalAmountIB = parseInt(totalAmount) + ((localStorage.getItem('totalAmountOB'+sessionID) != null) ? parseInt(localStorage.getItem('totalAmountOB'+sessionID)) : 0);
                       	$(".finalamountIB").html(parseInt(totalAmount));
                       	$('.final_farePage').html(finalAmountIB);

                       	let totalConvenienceFee = (finalAmountIB * <?php echo $getwayList->dsapayg_convenience_fee ?>) / 100;
                       	$(".totalConvenienceFee").html(Math.round(totalConvenienceFee));
                       	
                       	$(".finalamountPopup").html(Math.round(finalAmountIB+totalConvenienceFee));
                       	
                       	localStorage.setItem('returnTotalFare'+sessionID,finalAmountIB )

                       let onWardFare = localStorage.getItem('onWardTotalFare'+sessionID) ? parseInt(localStorage.getItem('onWardTotalFare'+sessionID)) : 0;

                    }
                }
			});
	return false;
    	}  
	})


});

$("input[name=wallet_amount]").on("change",function(){
	if($(this).is(":checked")){
		$("input[name=payment_method]").prop("checked",false);
	}
})
$("input[name=payment_method]").on("change",function(){
	if($(this).is(":checked")){
		$("input[name=wallet_amount]").prop("checked",false);
	}
})



$( ".mealFareIB" ).on("change",function(e){
	
	let baggageIB = $(this).val();
	let passengerIB = e.target.getAttribute('data-value');	
	let baggageJsonIB = <?php echo json_encode($baggageIB->Response->MealDynamic[0]); ?>;


	let convFee = <?php echo $DirPublishedFarePriceIB; ?>;
	let sessionID = "<?php echo $this->input->get('seesionid'); ?>" ;
	$.each(baggageJsonIB, function (key, data) {
    	
    	if(data.AirlineDescription == baggageIB){

    		var sessionID = "<?php echo $this->input->get('seesionid'); ?>" ;
    			$("#loader").modal('show');
			$.ajax({
				type: "POST",
				url: "<?php echo site_url(); ?>flight/set_meals_data",
				data: { 'meal': data.AirlineDescription, 'price': data.Price,'sessionId':sessionID,'passenger':passengerIB,'rawData':data,'type':'IB' },
				dataType: "text",
				cache:false,
				success:
                function(data){
                	if(data){
						$(".meal-priceIB").html(data);
      					localStorage.setItem("mealPriceIB"+sessionID,data);
						let totalAmount = parseInt(convFee)  + parseInt(data) + (localStorage.getItem("baggagePriceIB"+sessionID) !=null ? parseInt(localStorage.getItem("baggagePriceIB"+sessionID)) : 0);
						localStorage.setItem('totalAmountIB'+sessionID,totalAmount);
                       	let finalAmountIB = parseInt(totalAmount) + ((localStorage.getItem('totalAmountOB'+sessionID) != null) ? parseInt(localStorage.getItem('totalAmountOB'+sessionID)) : 0);
                       	$('.final_farePage').html(finalAmountIB);
                       	$(".finalamountIB").html(parseInt(totalAmount));
                       	let totalConvenienceFee = (finalAmountIB * <?php echo $getwayList->dsapayg_convenience_fee ?>) / 100;
                       	$(".totalConvenienceFee").html(Math.round(totalConvenienceFee));
                       	$(".finalamountPopup").html(Math.round(finalAmountIB+totalConvenienceFee));
                    }
                }
			});
	return false;
    	}  
	})

});



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
                console.log(obj);
                if (obj.status == "success")
                {
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
                    $('.coupon').append(`Coupon Discount (-) <span class="float-right"> <?= getCurrencySymbol($current_currency) ?> `+ parseInt(obj.discount_amount) +'</span>');

                }
                else{
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
//script for login

$(function () {
        $(".login_in").click(function () {
           
            emailid =  $("#email_ajax").val();
            password =  $("#password_ajax").val();			
			var sessionID = "<?php echo $this->input->get('seesionid'); ?>" ;			
            $.ajax({
                type: "POST",
			    url: "<?php echo site_url(); ?>flight/login",              
                data: { email: emailid, password: password },
                dataType: "text",
                cache: false,
                success:
                  function (data) {                     
                       var obj = jQuery.parseJSON(data);
                     console.log(data);                     
						   if (obj.status == "success"){
                          
						  location.href = "<?php echo site_url(); ?>/flight/booking_detail?seesionid=" + sessionID;
						  alert(obj.message);
						  }
					  else
						  {							
						   $('#successMessage').html(obj.message);
							$("#successMessage").addClass("alert alert-danger");                      
                      }
                  }
            });
            return false;
        });
    });

</script>


<script>

$( ".ex_date" ).datepicker({
	        dateFormat: 'dd-mm-yy',
			changeMonth: true,
			changeYear: true,
			yearRange: "-0:+10",
		    minDate: "<?php echo $IsDomestic["depart_date"]; ?>",
			
})
	    $('.pass_number').on('keypress', function (event) {
    var regex = new RegExp("^[a-zA-Z0-9]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
       event.preventDefault();
       return false;
    }
});
$(function(){
$(".proceed_payment_data").click(function(){
	$("#form_submit_pop_over").modal("show");
		var formD = $("#travellerdetail").serializeArray();
		$.ajax({
			type: "POST",
			url: "<?php echo site_url(); ?>flight/save_return_customer_data",
			data: formD,
			dataType: "text",
			cache:false,
			success:
				function(data){
				if(data){
				  // alert(data);
					// console.log(data);
					// return false;
					//alert("please try after some time or contact FLightMantra Admin");
					$("#Modal_for_confirm").modal("hide");
				   //alert("Server is under maintenance .Please try after sometime.");
					$( "#travellerdetail" ).submit();
					}
						}
				});
		return false;
		});
	});
	
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
