<?php
	// print_r($_SESSION ["flight"] [$sessionID] ["Search_Result_json"]);
 	$airlineresults = $flightdata;
 	// PrintArray($airlineresults);
 	// echo "<pre>";
 	// print_r($airlineresults);
	$total_pax = $_SESSION ['total_pax'] ;
	$segmentcount = count($airlineresults->Segments[0]);
	$segment = $airlineresults->Segments[0];
	$fare = $airlineresults->Fare;
	$offerfare = $fare->OfferedFare;
	$baseFare = $fare->BaseFare;
	$current_currency = $fare->Currency;
	$publish_fare=$fare->PublishedFare;
	$dsa_data=$this->dsa_data;
	$dsa_airline_code = $segment[0]->Airline->AirlineCode;
	// $bp_fare_data=bp_get_fare($offerfare,$publish_fare,$dsa_airline_code,$dsa_data);
	$bp_fare_data=bp_get_fare_without_markup($offerfare,$publish_fare,$dsa_airline_code,$dsa_data);
	$dsa_fare=$bp_fare_data['dsa_fare']; 
	$customer_fare=$bp_fare_data['customer_fare'];

	// $dsa_fare=$bp_fare_data['dsa_fare'];
	// $customer_fare = $publish_fare;
						
	$offerfareround = round($customer_fare);

	$taxvalue = $offerfareround - $baseFare;
	$deptime = TimeMinuts(GetTime($segment[0]->Origin->DepTime));
	if ($segmentcount > 1) {
		$stopsduration = $segment[$segmentcount - 1]->AccumulatedDuration;
		$arrtime = TimeMinuts(GetTime($segment[$segmentcount - 1]->Destination->ArrTime));
	} else {
		$stopsduration = $segment[0]->Duration;
		$arrtime = TimeMinuts(GetTime($segment[0]->Destination->ArrTime));
	}

	$NonRefundable = $airlineresults->IsRefundable;
	if ($NonRefundable == "1") {
		$fareType = "Refundable";
		$fareType12 = "Refundable";
	} else {
		$fareType = "Non Refundable";
		$fareType12 = "NonRefundable";
	};
?>					
	<div class="row">
		<div class="col-md-9 col-sm-9 col-xs-8 price1 no-padding-xs">			
			<div class="row">
				<div class="col-md-2 col-sm-3">
	               <img src="<?php echo site_url(); ?>assets/images/airlines/<?php echo $airlineresults->AirlineCode; ?>.gif">
	                <span class="text-center"><?php echo $segment[0]->Airline->AirlineCode . "-" . $segment[0]->Airline->FlightNumber; ?></span>
				</div>
				<div class="txt-tc col-md-7 col-sm-6">
	                <ul class="list-inline mb-0">
	                  <li class="dep-dt list-inline-item">
	                    <span> <?php echo GetTime($segment[0]->Origin->DepTime); ?></span>
	                    <span class="hidden-xs"> | <?php echo GetDateScFull($segment[0]->Origin->DepTime); ?></span>
	                  </li>
	                  <li class="arv-dt list-inline-item">
	                    <span><?php echo GetTime($segment[$segmentcount - 1]->Destination->ArrTime); ?></span>
	                    <span class="hidden-xs"> |<?php echo GetDateScFull($segment[$segmentcount - 1]->Destination->ArrTime); ?></span>
	                  </li>
	                  <li class="list-inline-item">
					  
					  <?php if ($segmentcount > 0) { ?>
					 	 <?php
                           foreach ($segment as $countseg => $segmentsmulti) {
							if ($countseg == 0) {
								?>
	                  	<span><?php echo $segmentsmulti->Origin->Airport->AirportCode; ?>
						</span>
						<i class="icofont-long-arrow-right"></i>
						<span><?php echo $segmentsmulti->Destination->Airport->AirportCode; ?></span>
							<?php } else { ?>
							<i class="icofont-long-arrow-right"></i><span><?php echo $segmentsmulti->Destination->Airport->AirportCode; ?></span>
							
							<?php 
							}
						}?>
						
					  <?php }?>
	                  </li>
	                </ul>
	              </div>
	              <div class="col-md-3 col-sm-3">
	                <div class="flght-duration">
	                  <p><span>
					  <?php
						if ($segmentcount > 1) {
							echo minute_to_hour($segment[$segmentcount - 1]->AccumulatedDuration);
						} else {
							echo minute_to_hour($segment[0]->Duration);
						}
						?>
						</span></p>
	                  <p><span><?php echo $segmentcount - 1; ?> Stop</span></p>
	                </div>
            	</div>
			</div> 
		</div>
		<div class="col-md-3 col-sm-3 col-xs-4 p-0 no-padding-xs text-center">
			<h3 class="airline_price mb-0">
				<?= getCurrencySymbol($current_currency) ?>
				<span> 
					<?php echo round($customer_fare/$total_pax); ?>
				</span>
			</h3>
			<!--  <p class="for_net_fare_div none mb-0"><?php echo round($customer_fare); ?></p>-->
			<!--  <p class="seat-avl mb-0">Seat Left 1</p>-->
		</div>
	</div>	
	

				
						
						
						
						

