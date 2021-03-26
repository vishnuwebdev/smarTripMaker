<?php $this->load->view('header'); 
$result = $confrimdataOB->Results;
$resultIB = $confrimdataIB->Results;



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



for($k=0; $k<count($old_selected_data->Results[0]); $k++){
	if($old_selected_data->Results[0][$k]->ResultIndex == $result->ResultIndex ){	
		$old_OB_fare=$old_selected_data->Results[0][$k]->Fare;
		$offer_fare=$old_OB_fare->OfferedFare;
		$publish_fare=$old_OB_fare->PublishedFare;
    $baseFare_old = $old_OB_fare->BaseFare;
    $yq_fare_old = $old_OB_fare->YQTax;
		$bp_fare_data1=bp_get_fare($offer_fare,$publish_fare,$dsa_airline_code,$dsa_data,$baseFare_old,$yq_fare_old);
		$customer_old_fare=$bp_fare_data1['customer_fare'];
	}
}

for($k=0; $k<count($old_selected_data->Results[1]); $k++){
	if($old_selected_data->Results[1][$k]->ResultIndex == $resultIB->ResultIndex ){
		$old_IB_fare=$old_selected_data->Results[1][$k]->Fare;
		$offer_fare_ib=$old_IB_fare->OfferedFare;
		$publish_fare_ib=$old_IB_fare->PublishedFare;
    $baseFare_ib = $old_IB_fare->BaseFare;
    $yq_fare_ib = $old_IB_fare->YQTax;
		$bp_fare_data_ib1=bp_get_fare($offer_fare_ib,$publish_fare_ib,$dsa_airline_code_ib,$dsa_data,$baseFare_ib,$yq_fare_ib);
		$customer_old_ib=$bp_fare_data_ib1['customer_fare'];
	}
}





$offer_fare=$result->Fare->OfferedFare;
$publish_fare=$result->Fare->PublishedFare;
$baseFare = $result->Fare->BaseFare;
$yq_fare = $result->Fare->YQTax;
$bp_fare_data=bp_get_fare($offer_fare,$publish_fare,$dsa_airline_code,$dsa_data,$baseFare,$yq_fare);
$dsa_fare=$bp_fare_data['dsa_fare'];
$customer_fare=$bp_fare_data['customer_fare'];
$base_fare = dsa_currency_convert($result->Fare->BaseFare);
$tax=$customer_fare-$base_fare;


$offer_fare_ib=$resultIB->Fare->OfferedFare;
$publish_fare_ib=$resultIB->Fare->PublishedFare;
$baseFare_ib = $resultIB->Fare->BaseFare;
$yq_fare_ib = $resultIB->Fare->YQTax;
$bp_fare_data_ib=bp_get_fare($offer_fare_ib,$publish_fare_ib,$dsa_airline_code_ib,$dsa_data,$baseFare_ib,$yq_fare_ib);
$dsa_fare_ib=$bp_fare_data_ib['dsa_fare'];
$customer_fare_ib=$bp_fare_data_ib['customer_fare'];
$base_fare_ib = dsa_currency_convert($resultIB->Fare->BaseFare);
$tax_ib=$customer_fare_ib-$base_fare_ib;


$DirPublishedFarePriceOB =  round ( $customer_fare );
$DirPublishedFarePriceIB =  round ( $customer_fare_ib );

$_SESSION ['flight'][$sessionid] ['flight_total_fare_return'] = $DirPublishedFarePriceOB + $DirPublishedFarePriceIB;
$_SESSION ['flight'][$sessionid] ['flight_total_fare_OB'] = $DirPublishedFarePriceOB;
$_SESSION ['flight'][$sessionid] ['flight_total_fare_IB'] = $DirPublishedFarePriceIB;
$_SESSION ['flight'][$sessionid]['farequote_data_OB']['TraceId'] = $confrimdataOB->TraceId;
$IsDomestic = $_SESSION["flight"][$sessionid]["search_RequestData"];
//PrintArray();
$total_pax =(int)$IsDomestic['no_adult'] + (int)$IsDomestic['no_child'] +  (int)$IsDomestic['no_infants'] ;
// die;
$SearchData =  "";
$search_data=$_SESSION ['flight'] [$this->input->get('seesionid')] ['search_RequestData'];
?>




<style>
.ui-datepicker .ui-datepicker-title select{
	color:#000;
}
.form-inline .form-control {
	
    width: 112% !important;
   
}
</style>

 
  <div class="main-field">
     <div class="container">
       <div class="row">
         <div class="col-lg-9 col-md-9 col-sm-12">
           <div class="flght-booking-details flght-book-return">
            <!-- Review Your Booking -->
             <div class="col-fly-com">
               <h3 class="heading-1 text-center mb-4">Review Your Booking</h3>
               <div class="col-fly-inn">
			   <h4 class="mt-0 booking-title"> INBOUND</h4>
			   <?php
                foreach ($segment as $segment123) {
                    $segmentcountint = count($segment123);
                    ?>
		   
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
				     <p class="text-center"><i class="icofont-clock-time"></i><?php echo minute_to_hour($segmentflight->Duration); ?> </p>
                        <p class="dots"><i class="icofont-airplane plane_horiz"></i></p>
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

			  <h4 class="mt-0 booking-title"> OUTBOUND</h4>

			  <?php
                foreach ($segmentIB as $segment123) {

                    $segmentcountint = count($segment123);
                    ?>
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
				     <p class="text-center"><i class="icofont-clock-time"></i><?php echo minute_to_hour($segmentflight->Duration); ?> </p>
                        <p class="dots"><i class="icofont-airplane plane_horiz"></i></p>
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

               </div>
             </div>
             <!-- Review Your Booking End -->
            <form action="<?php echo site_url(); ?>flight/payment_request" method="post" id="travellerdetail">
              <!-- Traveller Details -->
             <div class="col-fly-com">
               <h3 class="review-title">Traveller Details</h3>
               <div class="col-fly-inn">
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
															
                                <div class="col-md-12">    
							    	<div class="form-group col-md-3">
                                       
                                        <select style="width:112%" class="form-control pax_validation_field title_auto_fill for_pop_data"
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
                                    <div class="form-group col-md-3" >
                                        <input type="text" class="form-control pax_validation_field for_pop_data"
                                               pestype="<?php echo $PassengerType;?>" forend="1"
                                               id="<?php echo $PassengerType; ?>FirstName_<?php echo $i; ?>"
                                               placeholder="Enter First Name" onkeypress="return (event.charCode > 64 && 
event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)" name="<?php echo $PassengerType; ?>FirstName_<?php echo $i; ?>"
                                               error_msg="Please enter first name for <?php echo $PassengerType; ?>">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <input type="text" class="form-control pax_validation_field for_pop_data"
                                               pestype="<?php echo $PassengerType;?>" forend="2"
                                               id="<?php echo $PassengerType; ?>LastName_<?php echo $i; ?>"
                                               placeholder="Enter Last Name" onkeypress="return (event.charCode > 64 && 
event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)"
                                               name="<?php echo $PassengerType; ?>LastName_<?php echo $i; ?>"
                                               error_msg="Please enter Last name for <?php echo $PassengerType; ?>">
                                    </div>
                               
                                    <div class="form-group col-md-3">
                                        <input type="text" class="form-control pax_validation_field gender_auto_fill co_gander" id="<?php echo $PassengerType; ?>Gender_<?php echo $i; ?>" placeholder=""
                                               name="<?php echo $PassengerType; ?>Gender_<?php echo $i; ?>"
                                               error_msg="Please select gender  for <?php echo $PassengerType; ?>" readonly key_unique="<?php echo $PassengerType . $i; ?>">
                                    </div>
									
									 <div class="form-group col-md-3">
                                                <input type="text" readonly
                                                       error_msg="Please select DOB for <?php echo $PassengerType; ?>"
                                                       name="<?php echo $PassengerType; ?>Date_<?php echo $i; ?>"
                                                       class="form-control pax_<?php echo $PassengerType; ?>_dob pax_validation_field co_dateofbirth"
                                                       placeholder="Date of Birth">
                                     </div>
								</div>


                                    <?php

                                    if ($IsDomestic ['IsDomestic'] == "false") {
                                        ?>
                                        <div class="col-md-12" style="padding-top: 15px;">
                                           

                                            <div class="form-group col-md-3">
                                                <input type="text"
                                                       error_msg="Please Enter Passport no for <?php echo $PassengerType; ?>"
                                                       name="<?php echo $PassengerType; ?>PassportNum_<?php echo $i; ?>"
                                                       class="form-control pass_number pax_validation_field"
                                                       placeholder="Passport No">
                                            </div>

                                            <div class="form-group col-md-3">
                                                <input type="text" readonly
                                                       error_msg="Please select passport Exp. for <?php echo $PassengerType; ?>"
                                                       name="<?php echo $PassengerType; ?>PassExpDate_<?php echo $i; ?>"
                                                       class="form-control ex_date pax_validation_field co_expdatebirth"
                                                       placeholder="Passport Exp.">
                                            </div>

                                            <div class="form-group col-md-3" >
                                                <select class="form-control pax_validation_field for_pop_data"
                                                pestype="<?php echo $PassengerType;?>" forend="0"
                                                name="<?php echo $PassengerType; ?>IssuingCntry_<?php echo $i; ?>"
                                                error_msg="Please select Title for <?php echo $PassengerType; ?>"
                                                key_unique="<?php echo $PassengerType . $i; ?>" style="width:112%">
                                            <option value="">Select Country--</option>
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
               </div>
              </div>
            <!-- Traveller Details End -->

			
			
			
			
			
            <!-- Personal Details -->
              <div class="col-fly-com">
               <h3 class="review-title">Personal Details</h3>
               <div class="col-fly-inn form-inline">
                 <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label>Enter Your Email:</label>
                        <input type="email" class="form-control pax_validation_field for_email_confirm" id="email" placeholder="Enter email" name="cust_email">
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label>Enter Your Mobile:</label>
						<input type="number" class="form-control pax_validation_field for_contact_confirm" id="cust_mobile_no" name="cust_mobile_no" placeholder="Enter Number">
                      </div>
                    </div>
                 </div>
               </div>
              </div>
            <!-- Personal Details End -->


              <div class="col-fly-com">
        <h3 class="review-title">Apply Coupon</h3>
        
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


			<div class="text-center">
				<input type="hidden" name="sessionid" value="<?php echo $this->input->get('seesionid'); ?>" />
				 <button type="button"  class="btn btn-default search-btn pax_validation_continue"> Book Now</button>
			 </div>
            </form>
           </div>
         </div>

         <div class="col-lg-3 col-md-3 col-sm-12">
           <div class="flght-side-det">
            <div class="review_title clearfix">
              <h4 class="">Fare Details  <!-- <span class="snf_hnf pull-right">HNF</span> --> </h4>
            </div>
            <div class="contant">

		<ul class="fare_details">
		   <li>Oneway</li>
		     <li>
				 
			  <a class="" role="button" data-toggle="collapse" href="#basefare2" aria-expanded="false" aria-controls="basefare">Base Fare<small>(<?php echo $total_pax; ?> Traveller) </small> <i class="fa fa-angle-down rotate-icon"></i></a>
			  <span class="pull-right"><?php echo $this->bp_white_label_setting->wls_currency_symbol;?> <?php echo number_format(dsa_currency_convert($resultIB->Fare->BaseFare)); ?></span>
			  <div class="collapse" id="basefare2">
             <ul class="list-group list-group-item list-group-item-info list-unstyled">
						
			 <?php
				 	    $FareBreakdown = $result->FareBreakdown;
                        if (is_numeric(key($FareBreakdown))) {
                            foreach ($FareBreakdown as $key => $FBDetails) {
                                $PassengerType = passanger_t_f_number($FBDetails->PassengerType);
                                $noOfPess = $FBDetails->PassengerCount;
                                ?>

									<li>
										<span><?php echo $PassengerType; ?> x <?php echo $noOfPess; ?></span><span class="pull-right"><?php echo $this->bp_white_label_setting->wls_currency_symbol;?> <?php echo number_format($FBDetails->BaseFare); ?></span>
									</li>

						<?php } } ?>		
				  </ul>
			 </div>
			 
			 </li>
			
			 <li>
			    <span>Tax</span><span class="pull-right"><?php echo $this->bp_white_label_setting->wls_currency_symbol;?> <?php echo round($tax); ?></span>
			 </li>
			
		     <li ><span>Total Fare</span><span class="pull-right"><?php echo $this->bp_white_label_setting->wls_currency_symbol;?> <?php echo $DirPublishedFarePriceOB; ?></span></li>
		   </ul>		
			

		 <ul class="fare_details">
		   <li>Returns</li>
		     <li>
				 
			  <a class="" role="button" data-toggle="collapse" href="#basefare3" aria-expanded="false" aria-controls="basefare">Base Fare<small>(<?php echo $total_pax; ?> Traveller) </small> <i class="fa fa-angle-down rotate-icon"></i></a>
			  <span class="pull-right"><?php echo $this->bp_white_label_setting->wls_currency_symbol;?> <?php echo number_format(dsa_currency_convert($resultIB->Fare->BaseFare)); ?></span>
			  <div class="collapse" id="basefare3">
             <ul class="list-group list-group-item list-group-item-info list-unstyled">
						
			 <?php
				 	    $FareBreakdown = $resultIB->FareBreakdown;
                        if (is_numeric(key($FareBreakdown))) {
                            foreach ($FareBreakdown as $key => $FBDetails) {
                                $PassengerType = passanger_t_f_number($FBDetails->PassengerType);
                                $noOfPess = $FBDetails->PassengerCount;
                                ?>
									<li>
										<span><?php echo $PassengerType; ?> x <?php echo $noOfPess; ?></span><span class="pull-right"><?php echo $this->bp_white_label_setting->wls_currency_symbol;?> <?php echo number_format($FBDetails->BaseFare); ?></span>
									</li>
									<?php } } ?>
								
				  </ul>
			 </div>
			
			 </li>
			
			 <li>
			    <span>Tax</span><span class="pull-right"><?php echo $this->bp_white_label_setting->wls_currency_symbol;?> <?php echo round($tax_ib); ?></span>
			 </li>
		     <li ><span>Total Fare</span><span class="pull-right"><?php echo $this->bp_white_label_setting->wls_currency_symbol;?> <?php echo $DirPublishedFarePriceIB; ?></span></li>
		   </ul>

		   <table class="table" style="border:1px solid gainsboro">
												<thead>
                          <tr>

                            <?php if($getwayList!="0"){
                //$nkwithconfee =  round(( $DirPublishedFarePriceOB + $DirPublishedFarePriceIB * $getwayList->dsapayg_convenience_fee)/100);
                  if($getwayList->dsapayg_type=="fix")
                  {
                    $nkwithconfee =  round($getwayList->dsapayg_convenience_fee*$total_pax);
                  } else {
                    $nkwithconfee =  round(( $DirPublishedFarePrice * $getwayList->dsapayg_convenience_fee)/100);
                  } 
            ?>      
                   <th>Total Convenience Fee</th>
                   <th><?php echo $this->bp_white_label_setting->wls_currency_symbol;?> <?php echo $nkwithconfee; ?>  <?php } else { $nkwithconfee = 0; } ?> </th>
                   </tr>
												<tr>
													<th>Grand Total</th>
													<th style="background: #47143d;color: #fff;text-align: center;"><?php echo $DirPublishedFarePriceOB + $DirPublishedFarePriceIB + $nkwithconfee; ?></th>
												</tr>
                        <tr class="coupon none">
                          <th>Discount</th>
                          <th class="coupon1 none" style="display:none;"></th>
                        </tr>
												</thead>
											</table>

			




            </div>
           </div>
         </div>
       </div>
     </div>
    </div>









	

<div class="modal fade confirmpop " id="Modal_for_confirm" role="dialog" >
    <div class="modal-dialog modal-lg">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4><span class="fa fa-lock"></span> Please Confrim your Flight </h4>
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
												 <?php 
                                              foreach ($segment as $type_key => $segment123) {  ?>	
											
											<div><?php  echo "Onwards" ?> :</div> 
											
											<?php foreach ($segment123 as $segmentflight) { ?>
									
								
								              	<li class="list-group-item"><b class="row">
                              
												<div class="text-right col-md-3">   
												<?php  echo $segmentflight->Origin->CityName;?> </div>
													<div class="col-md-2">  
														<p class="dots"><i class="icofont-airplane plane_horiz"></i></p> </div>
														<div class="border-right_l pr-3 col-md-3 ">
														      <?php echo $segmentflight->Destination->CityName;?> </div>
														      
														  
												<div class="col-md-4 ">  
											  <?php echo GetTime($segmentflight->DepTime); ?> | <?php echo GetDateScFull($segmentflight->DepTime); ?> 
											 
												</div>
												 </b>
												  </li>
												<?php } ?>
							
											<?php } ?>


											<?php 
                                              foreach ($segmentIB as $type_key => $segment123) {  ?>	
											
											<div><?php  echo "Return"; ?> :</div> 
											
											<?php foreach ($segment123 as $segmentflight) { ?>
									
								
								              	<li class="list-group-item"><b class="row">
                              
												<div class="text-right col-md-3">   
												<?php  echo $segmentflight->Origin->CityName;?> </div>
													<div class="col-md-2">  
														<p class="dots"><i class="icofont-airplane plane_horiz"></i></p> </div>
														<div class="border-right_l pr-3 col-md-3 ">
														      <?php echo $segmentflight->Destination->CityName;?> </div>
														      
														  
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

													<div class="border border-bottom-0">

												<table class="table" style="border:1px solid gainsboro">
												<thead>
												<tr>
													<th>Fare Details </th>
													<th>(Onwards)</th>
												</tr>
												</thead>
												<tbody>
												     <tr>
															<?php
															 $FareBreakdown = $result->FareBreakdown;
															if (is_numeric(key($FareBreakdown))) {
																foreach ($FareBreakdown as $key => $FBDetails) {
																	$PassengerType = passanger_t_f_number($FBDetails->PassengerType);
																	$noOfPess = $FBDetails->PassengerCount;
																	?>
																	   <td>Base Fare <br>(<?php echo $PassengerType; ?> <i class="fa fa-times"></i> <?php echo $noOfPess; ?>) </td><td><?php echo $this->bp_white_label_setting->wls_currency_symbol;?> <?php echo number_format(dsa_currency_convert($FBDetails->BaseFare)); ?></td>
																	<?php }
																}
																?>

													        </tr>

															<tr>
																<td>
																	Tax (+)
																</td>
																<td>
																	<?php echo $this->bp_white_label_setting->wls_currency_symbol;?><?php echo round($tax); ?>
																</td>
															</tr>
													       

															<tr>
																<td>
																	Total Fare
																</td>
																<td>
																	<?php echo $this->bp_white_label_setting->wls_currency_symbol;?><?php echo $DirPublishedFarePriceOB; ?>
																</td>
															</tr>
														</tbody>
											        </table>

											<table class="table" style="border:1px solid gainsboro">
												<thead>
												<tr>
													<th>Fare Details </th>
													<th>(Returns)</th>
												</tr>
												</thead>
												<tbody>
												     <tr>
															<?php
															  $FareBreakdown = $resultIB->FareBreakdown;
															if (is_numeric(key($FareBreakdown))) {
																foreach ($FareBreakdown as $key => $FBDetails) {
																	$PassengerType = passanger_t_f_number($FBDetails->PassengerType);
																	$noOfPess = $FBDetails->PassengerCount;
																	?>
																	   <td>Base Fare <br>(<?php echo $PassengerType; ?> <i class="fa fa-times"></i> <?php echo $noOfPess; ?>) </td><td><?php echo $this->bp_white_label_setting->wls_currency_symbol;?> <?php echo number_format(dsa_currency_convert($FBDetails->BaseFare)); ?></td>
																	<?php }
																}
																?>

													        </tr>

															<tr>
																<td>
																	Tax (+)
																</td>
																<td>
																	<?php echo $this->bp_white_label_setting->wls_currency_symbol;?><?php echo round($tax_ib); ?>
																</td>
															</tr>
													      
															<tr>
																<td>
																	Total Fare
																</td>
																<td>
																	<?php echo $this->bp_white_label_setting->wls_currency_symbol;?><?php echo $DirPublishedFarePriceIB; ?>
																</td>
															</tr>
														</tbody>
											        </table>

											<table class="table" style="border:1px solid gainsboro">
												<thead>
                          <tr>

                            <?php if($getwayList!="0"){
                //$nkwithconfee =  round(( $DirPublishedFarePriceOB + $DirPublishedFarePriceIB * $getwayList->dsapayg_convenience_fee)/100);
                  if($getwayList->dsapayg_type=="fix")
                  {
                    $nkwithconfee =  round($getwayList->dsapayg_convenience_fee*$total_pax);
                  } else {
                    $nkwithconfee =  round(( $DirPublishedFarePrice * $getwayList->dsapayg_convenience_fee)/100);
                  } 
            ?>      
                   <th>Total Convenience Fee</th>
                   <th><?php echo $this->bp_white_label_setting->wls_currency_symbol;?> <?php echo $nkwithconfee; ?>  <?php } else { $nkwithconfee = 0; } ?> </th>
                   </tr>
													<tr>
														<th>Grand Total</th>
														<th><?php echo $DirPublishedFarePriceOB + $DirPublishedFarePriceIB + $nkwithconfee; ?></th>
													</tr>
                          <tr class="coupon none">
                            <th>Discount</th>
                            <th class="coupon1 none" style="display:none;"></th>
                            </tr>
												</thead>
											</table>
													
											</div>
													
										
                
                
             </div>
              </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <a  class="btn btn-success proceed_payment_data">Proceed Payment</a>
        </div>
      </div>

    </div>
  </div>



<div class="modal fade" id="form_submit_pop_over" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4><span class="fa fa-lock"></span> Please Wait... </h4>
        </div>
        <div class="modal-body " style="padding:40px 50px;">
         <div class="text-align-center">
              <img style="width:100%" src="<?php echo site_url(); ?>/assets/images/loading1.gif">
              </div>
        </div>
        <div class="modal-footer">
          
        </div>
      </div>
      
    </div>
  </div> 






  <div class="modal fade" id="confirmerror" role="dialog">
    <div class="modal-dialog" style="width: 450px;">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 style="text-align: center;"><span class="fa fa-lock"></span> Price has been changed !</h4>
        </div>
        <div class="modal-body " style="padding: 10px; text-align: center;">
			<div class="text-align-center">
				<?php if($result->IsPriceChanged ==1 ) { ?>
					<p><b>Onwards :</b><!--<br>Old Price : <i class="fa fa-inr"></i> <?php echo round($customer_old_fare) ?> --><br> New Price : <?php echo $this->bp_white_label_setting->wls_currency_symbol;?> <?php echo round($customer_fare) ?> <p>
				<?php } ?>
				<?php if($resultIB->IsPriceChanged ==1 ) { ?>
					<p><b>Returns :</b><!--<br>Old Price : <i class="fa fa-inr"></i> <?php echo round($customer_old_ib) ?> --><br> New Price : <?php echo $this->bp_white_label_setting->wls_currency_symbol;?> <?php echo round($customer_fare_ib) ?> <p>
				<?php } ?>
			</div>
        </div>
        <div style="padding: 8px 12px;" class="modal-footer">
			<a href="#" title="Cancel" class="btn btn-primary" data-dismiss="modal">Ok</a>
			<a href="<?php echo site_url()."flight/result?type=".$search_data["type"]."&from_location=".$search_data["from_location"]."&to_location=".$search_data["to_location"]."&from_country=".$search_data["from_country"]."&to_country=".$search_data["to_country"]."&depart_date=".$search_data["depart_date"]."&return_date=".$search_data["return_date"]."&no_adult=".$search_data["no_adult"]."&no_child=".$search_data["no_child"]."&no_infants=".$search_data["no_infants"]."&class_stops=0&cabin_class=".$search_data["cabin_class"]."&preferred_airline=" ?>"> <button type="button" class="btn btn-default">Back to Search  </button></a>
        </div>
      </div>
      
    </div>
  </div> 













	<?php $this->load->view('footer'); ?>
	<?php $this->load->view('js'); ?>
	<?php if($resultIB->IsPriceChanged ==1 ||$resultIB->IsPriceChanged ==1 ){ ?>
     <?php if(round($customer_old_fare)!=round($customer_fare) || round($customer_old_ib) != round($customer_fare_ib) ){ ?>
		<script type="text/javascript"> $('#confirmerror').modal('show'); </script>
   
	<?php } ?> 
	<?php } ?> 






    <script>


     $("#add_coupon").click(function(){   
        var coupontext = $("#user_coupon").val() ;
        var sessionid = "<?php echo $sessionid ?>" ; 
    console.log(sessionid);
        $("#loader").modal('show');
        $.ajax({
            url: "<?php echo site_url(); ?>flight/Getcoupon",
            type: "POST",
            data: { coupon:coupontext ,sessionid :sessionid },
            dataType: "text",
            cache: false,
            success: function(data){
        console.log(data);
                var obj = jQuery.parseJSON(data);
                console.log(obj);
                if (obj.status == "success") 
                {
                    $("#loader").modal('hide');
                    $('#massegealert').html(obj.message);
                    $("#massegealert").addClass("alert alert-success");
                    $("#add_coupon").attr("disabled", "disabled");
                    $('.coupon_show').show();
                    var getway_charge=parseInt($('.gateway_charge').text());
                    $('.without_gatewaty').text(parseInt(obj.amount));
                    $('.with_gatewaty').text(parseInt(getway_charge+obj.amount));
          $('.coupon1').show();
                    $('.coupon1').append('<i class="fa fa-inr"></i> '+ parseInt(obj.discount_amount));
          $('.coupon').show();
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
								url: "<?php echo site_url(); ?>flight/save_customer_data",
								data: formD,
								dataType: "text",
								cache:false,
								success:
									function(data){
									if(data){
									  // alert(data);
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

