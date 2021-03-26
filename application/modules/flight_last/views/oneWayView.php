<?php $this->load->view('include/head');
$this->load->view('include/header');
// getting current currency
$current_currency = getCurrentCurrency();
if( $current_currency == "USD" ){
	$currency_symbol = "icofont-dollar"; $js_currency_symbol = "$";
}else{
	$currency_symbol = "icofont-rupee"; $js_currency_symbol = "₹";
}

if( $current_currency == "AED" ){
	$js_currency_symbol = "AED";
}
$airline_list = array();
$segmentcount = 0;
$resultdata = $_SESSION ['flight'] ['Search_Result'];
$data = $resultdata->Response->Results[0];
 $total_flights = count($data);
$search_data=$_SESSION ['flight'] [$searchID] ['search_RequestData'];
	$total_pax = (int)($search_data['no_adult'] + $search_data['no_child'] + $search_data['no_infants']) ;
foreach ($resultdata->Response->Results[0] as $k => $airlineresultsprice) {
		$segmentf = $airlineresultsprice->Segments [0][0];
		if (!in_array($segmentf->Airline->AirlineName, $airline_list)) {
			$airline_list [$segmentf->Airline->AirlineCode] = $segmentf->Airline->AirlineName;
		}
		$segment_get = $airlineresultsprice->Segments[0];
		$fare_get =$airlineresultsprice->Fare;
		$offerfare_get = $fare_get->OfferedFare/$total_pax;
		$PublishedFare_get = $fare_get->PublishedFare/$total_pax;
		$dsa_data_get=$this->dsa_data;
		$dsa_airline_code_get=$segment_get[0]->Airline->AirlineCode;
		$baseFare_get = $fare_get->BaseFare/$total_pax;
		$yq_fare_get = $fare_get->YQTax;
	
	//echo "<pre>";
	$deptime[] = (GetTime($segment_get[0]->Origin->DepTime));
	
    //$bp_fare_data_get=bp_get_fare($offerfare_get,$PublishedFare_get,$dsa_airline_code_get,$dsa_data_get,$baseFare_get, $yq_fare_get);
	$bp_fare_data_get=bp_get_fare_without_markup($offerfare_get,$PublishedFare_get,$dsa_airline_code_get,$dsa_data_get,$baseFare_get, $yq_fare_get);
	
	 $dsa_fare_get=$bp_fare_data_get['dsa_fare'];
        $customer_fare_get=$bp_fare_data_get['customer_fare'];
        // $dsa_fare_get=$offerfare_get;
        // $customer_fare_get=$PublishedFare_get;
		
		$all_price[] = round($customer_fare_get);

		// $segmentcount = count($airlineresultsprice->Segments[0]);
		if($segmentcount < count($airlineresultsprice->Segments[0])){
		$segmentcount = count($airlineresultsprice->Segments[0]);
		}else{ 
		}
		
		
		if($requestdata['type'] =='Return'){
		   $segmentcount1 = count($airlineresultsprice->Segments[1]);
		}
	}
	// echo "<pre>";
	  
	
	$traceID = $resultdata->Response->TraceId;
	$_SESSION["traceID"] = $traceID;	
	$pricefiltermin = (min($all_price));
	$pricefiltermax = (max($all_price));
	
	$timemin = (min($deptime));
	$timemax = (max($deptime));
	// $search_data=$_SESSION ['flight'] [$searchID] ['search_RequestData'];
	// $total_pax = (int)($search_data['no_adult'] + $search_data['no_child'] + $search_data['no_infants']) ;
		//print_r($total_pax);
		
if($search_data["type"] == 'MultiWay'){
    $no_of_city =0 ;
    for($i=0; $i< count($search_data["fromLocation_m"]); $i++ ){
		if ($search_data["fromLocation_m"] [$i] != "" ) {
      if($search_data["fromLocation_m"] [$i]) {
        $no_of_city++;
      }
		}
    }

  }
  else{
    $no_of_city =2 ;
  }
  

  ?>

 <?php //print_r($this->input->get("depart_date"));?>

<!-- Search Result info -->
<?php if($search_data["type"] == 'MultiWay'){
		for($aa=0;$aa < count($search_data["fromLocation_m"]);$aa++){
if ($search_data["fromLocation_m"][$aa] != "" ) {
                  if($aa == 0){  		
		?>

<section class="search-result-info pt-3 pb-3">
	<div class="container-fluid">
		<div class="oneway-modify ">
			<div class="row">
				<div class="col-md-4 col-sm-6 col-8 border-right">
					<div class="one-flght-location">
						<small class="text-muted text-uppercase">Multicity</small>
						<h6 class="mb-0">
						
						<?php 
						$from_data=explode(',',$search_data['fromLocation_m'][$aa]);
								$to_data=explode(',',$search_data['toLocation_m'] [$aa]);
			
						?>							
						<?php echo $from_data[1] ?>
						To
											
						 <?php } else { ?>	
						  <?php 	
							$to_data=explode(',',$search_data['toLocation_m'][$aa]); ?>
					
						<?php echo $to_data[1] ?> 
						</h6>
						<?php } } } ?>
					</div>
				</div>
				<div class="col-md-2 col-sm-6 col-4 border-right">
					<div class="flght-depart">
						<small class="text-muted text-uppercase">Departure</small>
						<h6 class="mb-0"><i class="icofont-ui-calendar"></i> <?php echo date("D, j M Y", strtotime($search_data['dept_date_m'][0]) ); ?></h6>
					</div>
				</div>
				<div class="col-md-2 col-sm-4 col-4 border-right">
					<div class="passeng-dts">
						<small class="text-muted text-uppercase">Adult</small>
						<h6 class="mb-0"><i class="icofont-ui-user"></i> <?php echo $search_data['no_adult']; ?></h6>
					</div>
				</div>
				<div class="col-md-1 col-sm-4 col-4 border-right">
					<div class="passeng-dts">
						<small class="text-muted text-uppercase">Child</small>
						<h6 class="mb-0"><i class="icofont-ui-user"></i> <?php echo $search_data['no_child']; ?></h6>
					</div>
				</div>
				<div class="col-md-1 col-sm-4 col-4 border-right">
					<div class="passeng-dts">
						<small class="text-muted text-uppercase">Infant</small>
						<h6 class="mb-0"><i class="icofont-ui-user"></i> <?php echo $search_data['no_infants']; ?></h6>
					</div>
				</div>
				<div class="col-md-2 col-sm-4 col-12">
					<div class="modify-btn text-center">
						<a href="javascript:void(0)" class="btn btn-search d-md-none" id="filter_btn">Filter</a>
						<button type="" class="btn btn-search" data-toggle="modal" data-target="#modify-search"> Modify Search</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

		



<?php } else{ ?>

<section class="search-result-info pt-3 pb-3">
	<div class="container-fluid">
		<div class="oneway-modify ">
			<div class="row">
			<?php if($search_data["type"] == 'OneWay'){?>
				<div class="col-md-4 col-sm-6 col-8 border-right">
					<div class="one-flght-location">
						<small class="text-muted text-uppercase">One Way</small>
						<h6 class="mb-0">  <?php $from_data=explode(',',$search_data['from_location']);
                        $to_data=explode(',',$search_data['to_location']); ?> 
						
						<?php echo $from_data[1] ?>
						to <?php echo $to_data[1] ?></h6>
					</div>
				</div>
				<div class="col-md-2 col-sm-6 col-4 border-right">
					<div class="flght-depart">
						<small class="text-muted text-uppercase">Departure</small>
						<h6 class="mb-0"><i class="icofont-ui-calendar"></i> <?php echo date("D, j M Y", strtotime($search_data['depart_date']) ); ?></h6>
					</div>
				</div>
				
			<?php } else {?>
				<div class="col-md-3 col-sm-6 col-8 border-right">
					<div class="one-flght-location">
						<small class="text-muted text-uppercase">Return</small>
						<h6 class="mb-0">  <?php $from_data=explode(',',$search_data['from_location']);
                        $to_data=explode(',',$search_data['to_location']); ?> 
						
						<?php echo $from_data[1] ?>
						to <?php echo $to_data[1] ?></h6>
					</div>
				</div>
				<div class="col-md-2 col-sm-6 col-4 border-right">
					<div class="flght-depart">
						<small class="text-muted text-uppercase">Departure</small>
						<h6 class="mb-0"><i class="icofont-ui-calendar"></i> <?php echo date("D, j M Y", strtotime($search_data['depart_date']) ); ?></h6>
					</div>
				</div>
				
				<div class="col-md-2 col-sm-6 col-4 border-right">
					<div class="flght-depart">
						<small class="text-muted text-uppercase">Return</small>
						<h6 class="mb-0"><i class="icofont-ui-calendar"></i> <?php echo date("D, j M Y", strtotime($search_data['return_date']) ); ?></h6>
					</div>
				</div>
			
				
			<?php }?>
				<div class="col-md-1 col-sm-4 col-4 border-right">
					<div class="passeng-dts">
						<small class="text-muted text-uppercase">Adult</small>
						<h6 class="mb-0"><i class="icofont-ui-user"></i> <?php echo $search_data['no_adult']; ?></h6>
					</div>
				</div>
				<div class="col-md-1 col-sm-4 col-4 border-right">
					<div class="passeng-dts">
						<small class="text-muted text-uppercase">Child</small>
						<h6 class="mb-0"><i class="icofont-ui-user"></i> <?php echo $search_data['no_child']; ?></h6>
					</div>
				</div>
				<div class="col-md-1 col-sm-4 col-4 border-right">
					<div class="passeng-dts">
						<small class="text-muted text-uppercase">Infant</small>
						<h6 class="mb-0"><i class="icofont-ui-user"></i> <?php echo $search_data['no_infants']; ?></h6>
					</div>
				</div>
				<div class="col-md-2 col-sm-4 col-12">
					<div class="modify-btn text-center">
						<a href="javascript:void(0)" class="btn btn-search d-md-none" id="filter_btn">Filter</a>
						<button type="" class="btn btn-search" data-toggle="modal" data-target="#modify-search"> Modify Search</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>


<?php }?>


<!-- Search Result info end -->

<!-- Flight Result Main -->
	<section class="flght-result-oneway pt-2 pb-2 pt-md-3 pb-md-3">
		<div class="container-fluid">
			<div class="row">
				<!-- Flight Search result by filter -->
				<div class="col-md-3" id="sidebar-flght">  
					<div class="search-by-filter">
					 	 <div class="search-flt-topbar pb-2 border-bottom mb-2 mb-md-3">
					 	 	<div class="row">
					 	 		<div class="col-md-6">
					 	 			<h6 class="font-weight-normal">Filter Results</h6>
					 	 		</div>
					 	 		<div class="col-md-6 text-md-right">
					 	 			<a href="" class="reset text-danger reset">Reset All</a>
					 	 		</div>
					 	 	</div>
					 	 </div>

					 	 <!-- Flight Stop Start -->
					 	 <div class="sidebar-com no-of-stop pb-2 pb-md-3 border-bottom mb-md-3 ">
					 	 	<h6 class="font-weight-normal mb-2">No. of Stops</h6>
					 	 	<div class="flt-stop" id="flght-stops-num">
					 	 		<ul class="list-inline mb-0 text-center">
								
								<?php								
								for($i = 0; $i < $segmentcount; $i++) { ?>
						 	 		<li class="list-inline-item">
						 	 			<label for="stop-<?php echo $i?>" class="mb-0 d-block"  >  
						 	 			<input class="flightstop" type="checkbox" name="oneWay-fl-stop" id="stop-<?php echo $i?>" check_see="0" value="<?php echo $i; ?>" >
											<p class="mb-0">
												<strong>
												<?php
												if ($i == 0) {
													echo "Non";
												} else {
													echo $i;
												}
											?>
												 Stop</strong>
												<!--<span class="d-block">14357</span>-->
											</p>
						 	 			</label>
						 	 		</li>
									<?php } ?>
						 	 	
					 	 		</ul>
					 	 	</div>
					 	 </div><!-- Stop End -->
						
						<!-- Flight Depart Time -->
						<!--
					 	<div class="sidebar-com depart-time pb-2 pb-md-3 border-bottom mb-md-3 ">
					 	 	<h6 class="font-weight-normal mb-2">Departure Time <span class="from-st"></span></h6>
					 	 	<div class="flt-stop flt-depart-time" id="flt-depart-tm">	
					 	 		<ul class="list-inline mb-0 text-center">
								 <li class="list-inline-item">
										  <label for="before-six" class="mb-0 d-block tymlab">
											<input type="checkbox" name="oneWay-fl-time" class="departtym" value="06-12" id="before-six">
											<p class="mb-0">
											  <i class="icofont-sun-rise d-block"></i>
											  <strong>6am to 12pm</strong>
											</p>
										  </label>
										</li>
										<li class="list-inline-item">
										  <label for="before-twl" class="mb-0 d-block tymlab">
											<input type="checkbox" name="oneWay-fl-time" class="departtym" value="12-18" id="before-twl">
											<p class="mb-0">
											  <i class="icofont-full-sunny d-block"></i>
											  <strong>12pm to 6 pm</strong>
											</p>
										  </label>
										</li>
										<li class="list-inline-item">
										  <label for="after-six" class="mb-0 d-block tymlab">
											<input type="checkbox" name="oneWay-fl-time" class="departtym" value="18-24" id="after-six">
											<p class="mb-0">
											  <i class="icofont-sun-set d-block"></i>
											  <strong>6pm to 12am</strong>
											</p>
										  </label>
										</li>
										<li class="list-inline-item">
										  <label for="before-twl-am" class="mb-0 d-block tymlab">
											<input type="checkbox" name="oneWay-fl-time" class="departtym" value="24-06" id="before-twl-am">
											<p class="mb-0">
											  <i class="icofont-moon d-block"></i>
											  <strong>12am to 6am</strong>
											</p>
										  </label>
										</li>
					 	 		</ul>
					 	 	</div>
					 	</div>
						-->
					<div class="sidebar-com depart-time pb-2 pb-md-3 border-bottom mb-md-3 ">
						 <div class="sidebar-com price-airlines price-range mb-2">
							<h6 class="font-weight-normal mb-2">Departure Time</h6>
							<!--
							<div id="time-range">
							<p>Time Range: <span class="slider-time">10:00 AM</span> - <span class="slider-time2">12:00 PM</span>
							</p>
							<div class="sliders_step1">
								<div id="slider-range"></div>
							</div>
							</div>
							-->
							
							
							<div class="flt-stop prc-air-lines" id="price-rng">
								<p class="mb-0">
								  <ul class="list-inline clearfix mb-2">
									<li class="list-inline-item float-left">
										<input type="text" id="timep1" value="00:00 - 23:59" readonly>
									</li>
									<li class="list-inline-item float-right text-md-right">
										<input type="text" id="time-range1"  class="text-md-right" readonly>
									</li>
								  </ul>
								</p>
								<div id="slider-range_onward"></div>
							</div>
					</div>
					</div>
						<!-- Flight Depart Time End -->

					 	<div class="sidebar-com flght-airlines pb-2 pb-md-3 border-bottom mb-md-3 ">
					 		<h6 class="font-weight-normal mb-2">Airlines</h6>
					 		<div class="flt-stop flt-air-lines" id="airline-brands">
					 	 		<ul class="list-unstyled mb-0">
								
								<?php
								$i=0;
								foreach ($airline_list as $airlinekey => $airline_lists) {
									?>
								
						 	 		<li class="">
						 	 			<label for="airline-<?php echo $i?>" class="mb-0 d-block">
						 	 				<input type="checkbox" name="airlines" class ="flightso" id="airline-<?php echo $i?>" value_for_short ="<?php echo $airline_lists; ?>" value="0" >
											<p class="mb-0">
												<span class="air-icon">
													<img src="<?php echo site_url()?>assets/images/airlines/<?php echo $airlinekey; ?>.gif" alt="">
												</span>
												<strong class="air-name"><?php echo $airline_lists; ?></strong>
												<!--
												<span class="d-block price"><i class="icofont-rupee"></i> 13,685 onwards</span>-->
											</p>
						 	 			</label>
						 	 		</li>
									<?php $i++; }  ?>
						 	 	
						 	 		
					 	 		</ul>
					 	 	</div>
					 	</div>
					 	<div class="sidebar-com price-airlines price-range">
					 		<h6 class="font-weight-normal mb-2">Price Range</h6>
					 		<div class="flt-stop prc-air-lines" id="price-rng">
								<p class="mb-0">
								  <ul class="list-inline clearfix mb-2">
								  	<li class="list-inline-item float-left">
								  		<input type="text" id="amount" readonly>
								  	</li>
								  	<li class="list-inline-item float-right text-md-right">
								  		<input type="text" id="amount-sec" class="text-md-right" readonly>
								  	</li>
								  </ul>
								</p>
								<div id="slider-range"></div>
					 		</div>
					 	</div>
					</div>
					<div class="d-md-none"><a href="javascript:void(0)" class="w-100 btn btn-search" id="filter_click_submit">View Result</a></div>
				</div>
				<!-- Flight Search result by filter end -->

				
				
				<div class="col-md-9">
					<div class="flght-result-one-way paul-oneway">
						<div class="flght-shrt-descr position-relative mb-3">
							<span class="fl-icon">
								<i class="icofont-ui-flight"></i>
							</span>
							<h6 class="mb-0"><?php echo $from_data[1] ?>
						to <?php echo $to_data[1] ?> - <?php if($search_data["type"] == 'MultiWay'){
							echo date("D, j M Y", strtotime($search_data['dept_date_m'][0]) ); ?>
						<?php }else { 
							echo date("D, j M Y", strtotime($search_data['depart_date']) ); ?> <?php } ?></h6>
							
							<span class="total-flght d-block"><?php echo $total_flights?> Flights Found</span>
						</div>

						
						  <!-- Next Prev Button -->
						  <?php if($search_data["type"] == 'OneWay'){?>
						  
						<div class="nxt-prev-btn clearfix mb-15 text-center">
					   <?php $currdate = $this->input->get("depart_date");
						$yesterday = date('d-m-Y',strtotime($currdate  . "-1 days"));
							//print_r($this->input->get("from_location"));
						?>

					  <a href="<?php echo site_url(); ?>flight/result?type=<?php echo $this->input->get("type"); ?>&from_location=<?php echo $this->input->get("from_location"); ?>&to_location=<?php echo $this->input->get("to_location"); ?>&to_city_code=<?php echo $this->input->get("to_city_code"); ?>&from_city_code=<?php echo $this->input->get("from_city_code"); ?>&depart_date=<?php echo $yesterday; ?>&return_date=&no_adult=<?php echo $this->input->get("no_adult"); ?>&no_child=<?php echo $this->input->get("no_child"); ?>&no_infants=<?php echo $this->input->get("no_infants"); ?>&cabin_class=<?php echo $this->input->get("cabin_class"); ?>" class="btn btn-search float-left"><i class="icofont-swoosh-left"></i> <span>Previous Day</span></a>  <?php 
						$tomorrow = date('d-m-Y',strtotime($currdate  . "+1 days")); ?>
					  <a href="<?php echo site_url(); ?>flight/result?type=<?php echo $this->input->get("type"); ?>&from_location=<?php echo $this->input->get("from_location"); ?>&to_location=<?php echo $this->input->get("to_location"); ?>&to_city_code=<?php echo $this->input->get("to_city_code"); ?>&from_city_code=<?php echo $this->input->get("from_city_code"); ?>&depart_date=<?php echo $tomorrow; ?>&return_date=&no_adult=<?php echo $this->input->get("no_adult"); ?>&no_child=<?php echo $this->input->get("no_child"); ?>&no_infants=<?php echo $this->input->get("no_infants"); ?>&cabin_class=<?php echo $this->input->get("cabin_class"); ?>" class="btn btn-search float-right"> <i class="icofont-swoosh-right"></i> <span>Next Day</span> </a>

					</div>
				  <?php }?>
					<!---FOR INTERNATIONAL RETURN--->
					
					<?php if($search_data["type"] == 'Return'){?>
					<?php $currdate = $this->input->get("depart_date");						
						$yesterday = date('d-m-Y',strtotime($currdate  . "-1 days"));
						
						$retdate = $this->input->get("return_date");
						$ret_yesterday = date('d-m-Y',strtotime($retdate  . "-1 days"));
						
						?>
						<div class="row">
							<div class="col-md-6 col-sm-6">
								<ul class="list-inline">
									<li class="list-inline-item">
										<a href="<?php echo site_url(); ?>flight/result?type=<?php echo $this->input->get("type"); ?>&from_location=<?php echo $this->input->get("from_location"); ?>&to_location=<?php echo $this->input->get("to_location"); ?>&to_city_code=<?php echo $this->input->get("to_city_code"); ?>&from_city_code=<?php echo $this->input->get("from_city_code"); ?>&depart_date=<?php echo $yesterday; ?>&return_date=<?php echo $retdate;?>&no_adult=<?php echo $this->input->get("no_adult"); ?>&no_child=<?php echo $this->input->get("no_child"); ?>&no_infants=<?php echo $this->input->get("no_infants"); ?>&cabin_class=<?php echo $this->input->get("cabin_class"); ?>" class=""> <span><i class="icofont-swoosh-left"></i> Prev Day</span></a>
									</li>
									<li class="list-inline-item">Outbound</li>
									<li class="list-inline-item">
									<?php 
									$tomorrow = date('d-m-Y',strtotime($currdate  . "+1 days")); ?>
								  <a href="<?php echo site_url(); ?>flight/result?type=<?php echo $this->input->get("type"); ?>&from_location=<?php echo $this->input->get("from_location"); ?>&to_location=<?php echo $this->input->get("to_location"); ?>&to_city_code=<?php echo $this->input->get("to_city_code"); ?>&from_city_code=<?php echo $this->input->get("from_city_code"); ?>&depart_date=<?php echo $tomorrow; ?>&return_date=<?php echo $retdate?>&no_adult=<?php echo $this->input->get("no_adult"); ?>&no_child=<?php echo $this->input->get("no_child"); ?>&no_infants=<?php echo $this->input->get("no_infants"); ?>&cabin_class=<?php echo $this->input->get("cabin_class"); ?>" class=""> <span>Next Day <i class="icofont-swoosh-right"></i></span> </a>
									</li>
								</ul>
							</div>
							<div class="col-md-6 col-sm-6 text-right">
								<ul class="list-inline">
									<li class="list-inline-item">
									<a href="<?php echo site_url(); ?>flight/result?type=<?php echo $this->input->get("type"); ?>&from_location=<?php echo $this->input->get("from_location"); ?>&to_location=<?php echo $this->input->get("to_location"); ?>&to_city_code=<?php echo $this->input->get("to_city_code"); ?>&from_city_code=<?php echo $this->input->get("from_city_code"); ?>&depart_date=<?php echo $currdate; ?>&return_date=<?php echo $ret_yesterday;?>&no_adult=<?php echo $this->input->get("no_adult"); ?>&no_child=<?php echo $this->input->get("no_child"); ?>&no_infants=<?php echo $this->input->get("no_infants"); ?>&cabin_class=<?php echo $this->input->get("cabin_class"); ?>" class=""><i class="icofont-swoosh-left"></i> <span>Prev Day</span></a> 
									</li>
									<li class="list-inline-item">Inbound</li>
									<li class="list-inline-item">
									<?php 
										$ret_tomorrow = date('d-m-Y',strtotime($retdate  . "+1 days")); ?>
									  <a href="<?php echo site_url(); ?>flight/result?type=<?php echo $this->input->get("type"); ?>&from_location=<?php echo $this->input->get("from_location"); ?>&to_location=<?php echo $this->input->get("to_location"); ?>&to_city_code=<?php echo $this->input->get("to_city_code"); ?>&from_city_code=<?php echo $this->input->get("from_city_code"); ?>&depart_date=<?php echo $currdate; ?>&return_date=<?php echo $ret_tomorrow?>&no_adult=<?php echo $this->input->get("no_adult"); ?>&no_child=<?php echo $this->input->get("no_child"); ?>&no_infants=<?php echo $this->input->get("no_infants"); ?>&cabin_class=<?php echo $this->input->get("cabin_class"); ?>" class=""> <span>Next Day <i class="icofont-swoosh-right"></i> </span> </a>
									</li>
									</ul>
							</div>
						</div>
					<!--INBOUND--->
					  
					
					  
					</div>
					<?php }?>
				<!-- Next Prev Button End -->	
						
						<!--  <?php  if (isset($resultdata->Response->Results[0])) { ?>
							<div class="col-md-9 contant " >
							<span style="padding:15px" id="wait">Please wait...</span>  
							 <div class="rio-promos" id="slider_c"> </div>
							</div>
							<?php } ?>
							-->
						
						<div class="flght-res-onewy">
							<!-- Title bar start -->
							<div class="flt-title-bar mb-3 mb-md-4">
								<div class="row">
									<div class="col-md-2 col-sm-2 col-2">
				                      <h5>Airline</h5>
				                    </div>
				                    <div class="col-md-2 col-sm-2 col-2">
				                      <h5>Depart</h5>
				                    </div>
				                    <div class="col-md-2 col-sm-2 col-2">
				                      <h5>Arrive</h5>
				                    </div>
				                    <div class="col-md-3 col-sm-2 col-2">
				                      <h5>Duration</h5>
				                    </div>
				                    <div class="col-md-3 col-sm-2 col-2">
				                      <h5 style="">Price</h5>
				                    </div>
				                </div>
							</div><!--/ Title bar start -->

							<!-- Flight Listing start from here -->
							
							<?php
                if (isset($resultdata->Response->Results[0])) {
                    $i = 0;
					 foreach ($resultdata->Response->Results[0] as $airlineresults) {
						  // echo "<pre>";
						// print_r($airlineresults);
						// die;

						 // $i = 0;
                    // foreach ($data as $airlineresults) {
                         $i++;
                        $segmentcount = count($airlineresults->Segments[0]);
						// print_r($segmentcount);
                        $segment = $airlineresults->Segments;
						// print_r($airlineresults->Fare);
                        $fare = $airlineresults->Fare;
            			$offer_fare=$fare->OfferedFare;
            			$publish_fare=$fare->PublishedFare;
            			$dsa_data=$this->dsa_data;
            			$dsa_airline_code=$segment[0][0]->Airline->AirlineCode;
                        $baseFare = $fare->BaseFare;
                        $yq_fare = $fare->YQTax;
						// $bp_fare_data=bp_get_fare($offer_fare,$publish_fare,$dsa_airline_code,$dsa_data,$baseFare,$yq_fare);
						$bp_fare_data=bp_get_fare_without_markup($offer_fare,$publish_fare,$dsa_airline_code,$dsa_data,$baseFare,$yq_fare);
						$dsa_fare=$bp_fare_data['dsa_fare'];
                        $customer_fare=$bp_fare_data['customer_fare'];
                       
						$baseFare = $fare->BaseFare;
                        // $offerfareround = ($publish_fare);
						 $offerfareround = ($customer_fare);
                        $taxvalue = $offerfareround - $baseFare;
						$deptime = TimeMinuts(GetTime($segment[0][0]->Origin->DepTime));
					
					$deptime_tem = GetTime($segment[0][0]->Origin->DepTime);
                        if ($segmentcount > 1) {

                            $stopsduration = $segment[0][$segmentcount - 1]->AccumulatedDuration;

                            $arrtime = TimeMinuts(GetTime($segment[0][$segmentcount - 1]->Destination->ArrTime));
                        } else {

                            $stopsduration = $segment[0][0]->Duration;
                            $arrtime = TimeMinuts(GetTime($segment[0][0]->Destination->ArrTime));
                        }

                        $NonRefundable = $airlineresults->IsRefundable;
                        if ($NonRefundable == "1") {
                            $fareType = "Refundable";
                            $fareType12 = "Refundable";
                        } else {
                            $fareType = "Non Refundable";
                            $fareType12 = "NonRefundable";
                        }
                        ;
						//echo $deptime_tem;
                        ?>
						<div class="price1" price="<?php echo $offerfareround; ?>" 
                                 data-price="<?php echo $offerfareround; ?>" 
                                 data-duration="<?php echo $stopsduration; ?>"
                                 data-arrtime="<?php echo $arrtime; ?>"
                                 data-deptime="<?php echo $deptime; ?>"
                                 >	
								 
				<div class="price111 price111onword" timedep="<?php $bb = TimeMinuts(GetTime($segment[0][0]->Origin->DepTime)); echo $bb; ?>" timearr="<?php $bb = explode(":", GetTime($airlineresults->Segments[0][$segmentcount - 1]->Destination->ArrTime));
                echo $bb[0]; ?>"> 
								 
								 
							<div class="refendable11 refendable11onword" refendable="<?php echo $fareType12; ?>">
							<div class="flight11" flight="<?php echo $segment[0][0]->Airline->AirlineName; ?>">
                               <div class="stopscount" stop="<?php echo $segmentcount - 1; ?>">								 
						 
							<div class="flight-oneway-listing">
								<div class="row">
								
									<div class="col-md-8">
									 <?php
						  foreach ($airlineresults->Segments as $type_key =>$segmentsints) { 
								   $segmentcountint = count($segmentsints);
								  // print_r($bp_fare_data);
								   
								?>
								
										<div class="row">
											<div class="col-md-3 col-sm-4 col-6">
												<div class="airline-logo fl-o-way-com">
													<span class="air-brand">
													
														<img src="<?php echo site_url()?>assets/images/airlines/<?php echo $segmentsints[0]->Airline->AirlineCode; ?>.gif" alt="com-logo">
													</span>
													<h6><?php echo $segmentsints[0]->Airline->AirlineName; ?></h6>
													<span class="text-muted d-block"><?php echo $segmentsints[0]->Airline->AirlineCode . "-" . $segmentsints[0]->Airline->FlightNumber; ?></span>
												</div>
											</div>
											<div class="col-md-3 col-sm-4 col-6">
												<div class="dep-dr fl-o-way-com">
													<h6><?php echo GetTime($segmentsints[0]->Origin->DepTime); ?><br/>
													<span><?php echo GetDateScFull($segmentsints[0]->Origin->DepTime); ?></span>
													</h6>
													<span class="text-muted d-block"><?php echo $segmentsints[0]->Origin->Airport->CityName; ?> , <?php echo $segmentsints[0]->Origin->Airport->AirportCode; ?></span>
												</div>
											</div>
											<div class="col-md-3 col-sm-4 col-6">
												<div class="ari-dr fl-o-way-com">
													<h6><?php echo GetTime($segmentsints[$segmentcountint-1]->Destination->ArrTime); ?> <br/>
													<span><?php echo GetDateScFull($segmentsints[0]->Destination->ArrTime); ?></span>
													</h6>
													<span class="text-muted d-block"><?php echo $segmentsints[$segmentcountint-1]->Destination->Airport->CityName; ?>, <?php echo $segmentsints[$segmentcountint-1]->Destination->Airport->AirportCode; ?></span>
												</div>
											</div>
											<div class="col-md-3 col-sm-4 col-6">
												<div class="ari-dr fl-o-way-com txt-right">
												<h6>
												<?php															
											if ($segmentcountint > 1) {
												
												echo minute_to_hour($segmentsints[$segmentcountint - 1]->AccumulatedDuration);
												
											} else {
												echo minute_to_hour($segmentsints[0]->Duration);
											}
											?>	
											</h6>
												<span class="text-muted d-block flght-stop"><?php echo $segmentcountint - 1; ?> Stop</span>
											</div>
											</div>
									</div>
									
									<?php }?>
								</div>
									
					  		
									<div class="col-md-2 col-sm-4 col-6">
										<div class="price-flt fl-o-way-com txt-lt">
											<h6><?= getCurrencySymbol($current_currency) ?> <?php echo round($customer_fare/$total_pax); ?></h6>
										</div>
									</div>
									<div class="col-md-2 col-sm-4 col-6">
										<div class="price-flt fl-o-way-com">
										
									 <button type="button" onclick="book_now('<?php echo $traceID; ?>','<?php echo $airlineresults->ResultIndex; ?>','<?php echo $searchID; ?>');"  class="btn btn-search  booking_btn bookingbtnsubmit mb-10-xs">Book</button>
										
									<!--<button class="btn btn-search" onclick="window.location.href='flight-booking.php'">Book</button>-->
										</div>
									</div>
						
									
									<div class="col-md-12">
										<div class="flght-footer">
											<ul class="mb-0 list-inline fl-foot text-md-right">
												<li class="list-inline-item">
												<!--	<a href="javascript:void(0)">Free Meals/Snacks </a>-->
												</li>
												<li class="list-inline-item">
													<a href="javascript:void(0)" class="fl-dts">Flight Details</a>
												</li>
												<li class="list-inline-item">
												
												<!--
												<li>
												<a href="#flght-rules<?php echo $i ?>" data-toggle="modal" onclick="getFareRulepoonam('<?php echo $traceID; ?>','<?php echo $airlineresults->ResultIndex; ?>','<?php echo $i ?>');" ><i class="icofont-hand-right"></i> Fare Rules </a>
												</li>
												-->
												
											</ul>
											<div class="flt-details-wrap">
												<nav>
												  <div class="nav nav-tabs" id="nav-tab" role="tablist">
												    <a class="nav-item nav-link active" data-toggle="tab" href="#flight-details<?php echo $i?>">Flight Details</a>
												    <a class="nav-item nav-link" data-toggle="tab" href="#fare-details<?php echo $i?>">Fare Details</a>
													<!--
												    <a class="nav-item nav-link" data-toggle="tab" href="#cancellation-fee<?php echo $i?>">Cancellation Fee</a>
												    <a class="nav-item nav-link" data-toggle="tab" href="#date-change-fee<?php echo $i?>">Date Change Fee</a>
													-->
												    <a class="nav-item nav-link" data-toggle="tab" href="#baggage-details<?php echo $i?>">Baggage Details</a> 

													<a class="nav-item nav-link" data-toggle="modal" href="#fare-rule<?php echo $i?>" onclick="getFareRulepoonam('<?php echo $traceID; ?>','<?php echo $airlineresults->ResultIndex; ?>','<?php echo $i ?>');">Fare Rule</a>
													 
													 
												  </div>
												</nav>
												<div class="tab-content" id="nav-tabContent">
												  <div class="tab-pane fade show active" id="flight-details<?php echo $i?>">
													<div class="flt-details-comm flt-oway-dts">
														<h6 class="dt">
														<?php 
														if($search_data["type"] == 'MultiWay'){
														echo date("j M, Y D", strtotime($search_data['dept_date_m'][0]) );?>	
														
															
														<?php } else {?>
														<?php 
														echo date("j M, Y D", strtotime($search_data['depart_date']) );?>
														<?php }?>
														
														
														
														</h6>
														<div class="row">
														<!--Flight Detail Summary-->
														
												<?php foreach ($airlineresults->Segments as $type_key =>$segmentsints) { 
												$count2seg = 0;
										   $segmentcountint = count($segmentsints);		?>
											<?php if($search_data['type'] =="OneWay" || $search_data['type'] =="Return" ) { ?>
											<div class="col-md-12 mb-15"><span class="label label-primary"><i class="icofont-airplane-alt "></i> <?php  if($segmentsints[0]->TripIndicator=="1") {echo "Departure" ;} else {echo "Return";} ?> </span></div>
										<?php } ?>
										
										<?php foreach ($segmentsints as $seg => $segmentloop) {
											 $count2seg++;
											$dep_time = GetTime($segmentloop->Origin->DepTime);
											$to_time = strtotime($segmentloop->Origin->DepTime);
											$from_time = strtotime($segmentloop->Destination->ArrTime);
											$minutess =  round(abs($to_time - $from_time) / 60,2);
											$hours = floor($minutess / 60).'H :'.($minutess -   floor($minutess / 60) * 60).'M';										
											?>
											<!--======LAYOVER START=========-->	
									 <div class="col-md-12">
											   <?php if ($segmentcount  > 1 && $count2seg > 1)
												{
												 $arr_value1 = strtotime($segmentsints[$seg-1]->Destination->ArrTime);							
												 $dept_value1 = strtotime($segmentloop->Origin->DepTime);
												 $minutess1 =  round(abs($dept_value1 - $arr_value1) / 60,2);
												 $layover = floor($minutess1 / 60).'H :'.($minutess1 -   floor($minutess1 / 60) * 60).'M';												
												 ?>							 
										<span class="layover text-center d-block"> Layover:<?php echo $layover ?></span>
									 
										<?php }?>
									 </div>
									 <!--======LAYOVER END=========-->	
															<div class="col-md-3 col-sm-4 col-6">
																<div class="airline-logo fl-o-way-com">
																	<span class="air-brand">
																		<img src="<?php echo site_url()?>assets/images/airlines/<?php echo $segmentloop->Airline->AirlineCode; ?>.gif" alt="">
																	</span>
																	<h6><?php echo $segmentloop->Airline->AirlineName ?></h6>
																	<span class="text-muted d-block">
																	<?php echo $segmentloop->Airline->AirlineCode . "-" . $segmentloop->Airline->FlightNumber; ?>
																	</span>
																</div>
															</div>
															<div class="col-md-2 col-sm-4 col-6">
																<div class="dep-dr fl-o-way-com">
																	<h6>
																	<?php echo GetTime($segmentloop->Origin->DepTime); ?> <br/>
											<span><?php echo GetDateScFull($segmentloop->Origin->DepTime); ?></span>
																	
																	</h6>
																	<span class="text-muted d-block"><?php echo $segmentloop->Origin->Airport->CityName; ?>, <?php echo $segmentloop->Origin->Airport->AirportCode; ?></span>
																</div>
															</div>
															<div class="col-md-2 col-sm-4 col-6">
																<div class="ari-dr fl-o-way-com">
																	<h6>
																	<?php echo GetTime($segmentloop->Destination->ArrTime); ?> <br/>
											<span><?php echo GetDateScFull($segmentloop->Destination->ArrTime); ?></span>
																	</h6>
																	<span class="text-muted d-block"><?php echo $segmentloop->Destination->Airport->CityName; ?>, <?php echo $segmentloop->Destination->Airport->AirportCode; ?></span>
																</div>
															</div>
															<div class="col-md-2 col-sm-4 col-6">
																<div class="ari-dr fl-o-way-com">
																	<h6>
																	<?php 
																	//echo minute_to_hour($segmentloop->Duration);
																	echo $hours
																	?>
																	
																	</h6>
																	
																</div>
															</div>
															<div class="col-md-3 col-sm-4 col-6">
																<div class="rufundable fl-o-way-com">
																	<h6><?php echo $fareType?></h6>
																	<span class="text-muted d-block flght-class"></span>
																</div>
															</div>
														
												<?php } }?>
														<!---->
														</div>
													</div>
												  </div>
												  <div class="tab-pane fade" id="fare-details<?php echo $i?>">
												  	<div class="flt-details-comm fare-oway-dts">
												  		<div class="table-responsive">
												  			<table class="table table-bordered table-striped">
												  				<thead>
												  					<tr>
												  						<th colspan="2">Fare Summary</th>
												  					</tr>
												  				</thead>
												  				<tbody>
												  					<tr>
												  						<td>Base Fare</td>
												  						<td><?= getCurrencySymbol($current_currency) ?> <?php echo round($baseFare); ?></td>
												  					</tr>
												  					<tr>
												  						<td>Airline Fuel Surcharges</td>
												  						<td><?= getCurrencySymbol($current_currency) ?> 
																		<?php echo round($customer_fare - $baseFare );?>
																		</td>
												  					</tr>
												  					<tr>
												  						<th>Total</th>
												  						<th><?= getCurrencySymbol($current_currency) ?> <?php echo round($customer_fare); ?></th>
												  					</tr>
												  				</tbody>
												  				<tfoot>
												  					<tr>
												  						<td colspan="2" class="note">*Total fare displayed above has been rounded off and may thus show a slight difference.</td>
												  					</tr>
												  				</tfoot>
												  			</table>
												  		</div>
												  	</div>
												  </div>
												
													<!--
											<div class="tab-pane fade" id="cancellation-fee<?php echo $i?>">
												  	<div class="flt-details-comm flt-oway-dts">
												  		cancellation fee
												  	</div>
												  </div>
												  <div class="tab-pane fade" id="date-change-fee<?php echo $i?>">
												  	<div class="flt-details-comm flt-oway-dts">
												  		date-change-fee
												  	</div>
												  </div>

													-->

												<div class="tab-pane fade" id="baggage-details<?php echo $i?>">
												  	<div class="flt-details-comm flt-oway-dts">
												  		<ul class="mb-0 list-inline bagge-dts">
												  		<?php foreach ($airlineresults->Segments as $type_key =>$segmentsints) {?>
															<?php  if($segmentsints[0]->TripIndicator=="1") { ?>
															<li class="list-inline-item">
															<strong>Cabin Baggage :</strong><span>
															<?php if($segmentsints[0]->CabinBaggage!=""){
																echo $segmentsints[0]->CabinBaggage ;
															 } else{ echo "0"; }?>
															
															</span>
															</li>
															<li class="list-inline-item">
															<strong>Check-In Baggage :</strong><span>
															<?php if($segmentsints[0]->Baggage!=""){
																echo $segmentsints[0]->Baggage ;
															} else{ echo "0"; }?>
															</span>
															</li>
														<?php }?>
														
														<?php  if($segmentsints[0]->TripIndicator=="2") { ?>
														<li class="list-inline-item">
														<strong>Return Cabin Baggage :</strong><span>
														<?php if($segmentsints[0]->CabinBaggage!=""){
																echo $segmentsints[0]->CabinBaggage ;
															 } else{ echo "0"; }?>
														</span>
														</li>
														<li class="list-inline-item">
														<strong>Return Check-In Baggage :</strong><span>
														<?php if($segmentsints[0]->Baggage!=""){
																echo $segmentsints[0]->Baggage ;
															 } else{ echo "0"; }?>
														</span>
														</li>
														<?php }?>
														
														<?php }?>
												  		</ul>
													
														
												  	</div>
												  </div>
												  
												   
												  <!-- Fare Rule Modal -->
													<div class="modal fade" id="fare-rule<?php echo $i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
													  <div class="modal-dialog modal-lg" role="document">
													    <div class="modal-content">
													      <div class="modal-header">
													        <h5 class="modal-title" id="exampleModalLongTitle">Fare Rules</h5>
													        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
													          <span aria-hidden="true">&times;</span>
													        </button>
													      </div>
													      <div class="modal-body">
													        <div class="flt-details-comm flt-oway-dts text-center">
																 <span id="loadfarerule<?php echo $i?>">
																  <img  src="<?php echo site_url(); ?>assets/images/loading.gif">
																</span>
																
															  	</div>
													      </div>
													      <div class="modal-footer">
													        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
													        <!--<button type="button" class="btn btn-primary">Save changes</button>-->
													      </div>
													    </div>
													  </div>
													</div>
												  <!-- Fare Rule Modal End -->
												 
												  
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						
						</div>
					</div>						
					</div>
					</div>
					</div>
					
					<!-- Fare Rules -->
					<div class="modal fade" id="flght-rules<?php echo $i ?>">
						<div class="modal-dialog modal-lg">
						  <div class="modal-content">
						  
							<!-- Modal Header -->
							<div class="modal-header">
							  <h4 class="modal-title">Flight Rules</h4>
							  <button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>
							
							<!-- Modal body -->
							<div class="modal-body">
							
							  <span id="loadfarerule<?php echo $i?>" style="text-center">
							  <img  src="<?php echo site_url(); ?>assets/images/loading.gif">
							 
							 </span>
							</div>
							
							<!-- Modal footer -->
							<div class="modal-footer">
							  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							</div>
						  </div>
						</div>
					</div>
					<!-- Fare Rules end -->
					
					
					 <?php 
					 //$i++; }?>
				<?php }
						
				}?>	
							
							
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<!-- Flight Result Main  end-->

<!-- Modify Search Popup -->
<div class="modal fade" id="modify-search">
	<div class="modal-dialog modal-lg">
	  <div class="modal-content">
	  
	    <!-- Modal Header -->
	    <div class="modal-header">
	      <h4 class="modal-title">Modify Search</h4>
	      <button type="button" class="close" data-dismiss="modal">&times;</button>
	    </div>
	    
	    <!-- Modal body -->
	    <div class="modal-body flight-modify-search">	   
		  
						<div class="tab-pane" id="flight-tab">
					  		<div class="search-bar-col flight-wrap-col">
					  			<div class="radio-flght mb-2">
					  				<ul class="list-inline mb-0">
					  					<li class="list-inline-item <?php if($requestdata['type'] =='OneWay') { echo "active"; } else {} ?>" id="one-way-rad">
					  						<label for="one-way" class="mb-0 flght-rad">
					  							<input type="radio" name="flght-type" id="one-way" value="OneWay"  <?php if($requestdata['type'] =='OneWay') { echo "checked"; }?>>
					  							<span>One Way</span>
					  						</label>
					  					</li>
					  					<li class="list-inline-item <?php if($requestdata['type'] =='Return') { echo "active"; } else {} ?>" id="round-rad">
					  						<label for="round-trip" class="mb-0 flght-rad">
					  							<input type="radio" name="type" id="round-trip" value="Return" <?php if($requestdata['type'] =='Return') { echo "checked"; }?>>
					  							<span>Round Trip</span>
					  						</label>
					  					</li>
					  					<li class="list-inline-item <?php if($requestdata['type'] =='MultiWay') { echo "active"; } else {} ?>" id="multicity-rad">
					  						<label for="multicity" class="mb-0 flght-multi-rad">
					  							<input type="radio" name="type" id="multicity" value="MultiWay" <?php if($requestdata['type'] =='MultiWay') { echo "checked"; }?>>
					  							<span>Multicity</span>
					  						</label>
					  					</li>
					  				</ul>
					  			</div>
					  			<!-- Flight OneWay -->
					  			<div class="flight-oneway-view" id="oneway-flght">
								<form action="<?php echo site_url(); ?>/flight/result" method="get" id="flight-form" autocomplete="off">
							<input id="search_type" name="type" value="<?php echo $requestdata["type"]?>" class="custom-control-input" type="hidden">								
					  					<div class="row">
					  						<div class="col-md-6">
					  							<label for="">Flying From</label>
					  							<div class="input-group mb-3">
					  								<div class="input-group-prepend">
					  									<span class="input-group-text"><i class="icofont-google-map"></i></span>
													</div>
													<input type="text" name="from_location" id="FromSector " onkeyup="flight_suggest(this.value,0);"  class="form-control flight_from0" placeholder="City or Airport" value="<?php if($requestdata["type"] =='OneWay' || $requestdata["type"] =='Return'){ echo $search_data["from_location"];} ?>">
												</div>
					  						</div>
					  						<div class="col-md-6">
					  							<label for="">Flying To</label>
					  							<div class="input-group mb-3">
					  								<div class="input-group-prepend">
					  									<span class="input-group-text"><i class="icofont-google-map"></i></span>
													</div>
													<input type="text" name="to_location" id="Editbox13" class="form-control flight_from_to0" onkeyup="flight_suggest_to(this.value,0);"  placeholder="City or Airport"  value="<?php if($requestdata["type"] =='OneWay' || $requestdata["type"] =='Return'){ echo $search_data["to_location"];} ?>" >
													
													
												<input type="hidden" class="" name="from_country" id="flight_from_country0" value="<?php if($requestdata["type"] =='OneWay' || $requestdata["type"] =='Return'){ echo $search_data["from_country"];} ?>">
												
											<input type="hidden" class="" name="to_country" id="flight_from_to_country0" value="<?php if($requestdata["type"] =='OneWay' || $requestdata["type"] =='Return'){ echo $search_data["to_country"];} ?>"
											>
											<input type="hidden" name="from_city_code" id="flight_from_city0" value="<?php if($requestdata["type"] =='OneWay' || $requestdata["type"] =='Return'){ echo $search_data["from_city_code"]; } ?>"
											>
											<input type="hidden" name="to_city_code" id="flight_from_to_city0" value="<?php if($requestdata["type"] =='OneWay' || $requestdata["type"] =='Return'){ echo $search_data["to_city_code"];} ?>">
												
												</div>
					  						</div>
					  						<div class="col-md-3 depart-flt">
					  							<label for="">Departing</label>
					  							<div class="input-group mb-3">
					  								<div class="input-group-prepend">
					  									<span class="input-group-text">
					  										<i class="icofont-ui-calendar"></i>
					  									</span>
													</div>
													<input placeholder="YYYY-MM-DD" type="text" name="depart_date" id="depart_date" class="form-control" value="<?php if($requestdata["type"] =='OneWay' || $requestdata["type"] =='Return'){ echo $search_data["depart_date"];} ?>">
												</div>
					  						</div>
					  						<div class="col-md-3 retrun-flt">
					  							<label for="">Returning</label>
					  							<div class="input-group mb-3">
					  								<div class="input-group-prepend">
					  									<span class="input-group-text">
					  										<i class="icofont-ui-calendar"></i>
					  									</span>
													</div>
													<input placeholder="YYYY-MM-DD" type="text" name="return_date" id="return_date" class="form-control" value="<?php if($requestdata["type"] =='OneWay' || $requestdata["type"] =='Return'){ echo $requestdata["return_date"]; }   ?>"  >
												</div>
					  						</div>
					  						<div class="col-md-3">
					  							<div class="form-group">
					  								<label for="">Traveller</label>
					  								<div class="travel-wrap">
					  									<a href="javascript:void(0)" class="form-control trvl-tgl">
					  									<i class="icofont-user"></i> <span class="flt-trv pr-1 guest_num">1</span>Traveller</a>
					  									<div class="traveller-com">
								<div class="col-trvl clearfix">
												<label class="">Adult (12+ Yrs)</label>

												<select name="no_adult" id="adults" class="form-control adult_select pop_select" required="required">				
												 <?php for($i=1; $i<=9; $i++) { 
												if ($i == $this->input->get("no_adult")) { ?>
													<option selected value="<?php echo $i ?>"><?php echo $i ?></option>
											  <?php } else { ?>
													<option value="<?php echo $i ?>"><?php echo $i ?></option>
											  <?php } } ?>
												</select>
											</div>
											<div class="col-trvl clearfix">
												<label class="">Child (2-11 Yrs)</label>
												<select name="no_child" id="children" class="form-control child_select pop_select" required="required">
												 <?php for($j=0; $j<=9-$this->input->get("no_adult"); $j++  ) {
												if($j == $this->input->get("no_child") ){?>  
												  <option selected value="<?php echo $j; ?>"><?php echo $j; ?></option>
												<?php } else{ ?>
												  <option value="<?php echo $j; ?>"><?php echo $j; ?></option>
											  <?php } } ?>
												
													</select>
											</div>
											<div class="col-trvl clearfix">
												<label class="">Infant (Under 2 Yrs)</label>
												<select name="no_infants" id="children" class="form-control infent_select pop_select" required="required">
												 <?php for($k=0; $k<=$this->input->get("no_adult"); $k++  ) {
												if($k == $this->input->get("no_infants") ){ ?>
												  <option selected value="<?php echo $k; ?>"><?php echo $k; ?></option>
												<?php } else{ ?>
												
											  <?php } } ?>
												<!--
													<option value="0">0</option>
													<option value="1">1</option>
													-->
													</select>
											</div>
										
											<div class="col-trvl clearfix text-right">
												<a id="rooms_add" href="javascript:void(0)" class="btn btn-search searchenginehoteldone">DONE</a>
											</div>
					  									</div>	
					  								</div>
					  							</div>
					  						</div>
					  						<div class="col-md-3">
					  							<div class="form-group mb-3">
					  								<label for="">Class</label>
					  								<select id="input" class="form-control custom-select" name="cabin_class">
													
													<option <?php if($this->input->get("cabin_class")==1){echo "selected";} ?> value="1" selected="">All</option>
													<option <?php if($this->input->get("cabin_class")==2){echo "selected";} ?> value="2">Economy</option>
													<option <?php if($this->input->get("cabin_class")==4){echo "selected";} ?> value="4">Business</option>
													<option <?php if($this->input->get("cabin_class")==6){echo "selected";} ?> value="6">First Class</option>
					  									
					  								</select>
					  							</div>
					  						</div>
					  						<div class="col-md-12">
					  							<button id="flightbtnsearch" type="button" class="btn btn-search">Modify Search</button>
					  						</div>
					  					</div>
					  				</form>
					  			</div><!--/ Flight OneWay End -->

					  			<!-- Multicity Flights -->
								<div class="flight-oneway-view flght-multi-wrap" id="multi-flght">
					  				<form action="<?php echo site_url(); ?>/flight/result" method="get" id="searchform_multi">
									<input type="hidden" name="type" value="MultiWay">
					  					<div class="pickup_fields_wrap">
						  					<div class="row">
						  						<div class="col-md-4">
						  							<div class="input-group mb-3">
						  								<div class="input-group-prepend">
						  									<span class="input-group-text"><i class="icofont-google-map"></i></span>
														</div>
														<input type="text" name="fromLocation_m[0]" id="tagfrom0_multicity" class="form-control flight_from1"  onkeyup="flight_suggest(this.value,1);" placeholder="From" autocomplete="off" required value="<?php if($requestdata["type"] =='MultiWay'){ echo $requestdata["fromLocation_m[0]"];} ?>">
													<input type="hidden" name="from_country[0]" id="flight_from_country1">
													</div>
						  						</div>
						  						<div class="col-md-4">
						  							<div class="input-group mb-3">
						  								<div class="input-group-prepend">
						  									<span class="input-group-text"><i class="icofont-google-map"></i></span>
														</div>
														<input type="text" name="toLocation_m[0]" id="tagto0_multicity" class="form-control flight_from_to1" onkeyup="flight_suggest_to(this.value,1);"  placeholder="To" autocomplete="off" required>
														
														<input type="hidden" name="to_country[0]" id="flight_from_to_country1">
													</div>
						  						</div>
						  						<div class="col-md-3 depart-flt">
						  							<div class="input-group mb-3">
						  								<div class="input-group-prepend">
						  									<span class="input-group-text">
						  										<i class="icofont-ui-calendar"></i>
						  									</span>
														</div>
														<input placeholder="DD-MM-YYYY" type="text" name="dept_date_m[0]" id="ft-date1_multicity" class="form-control datepicker-cl" autocomplete="off" required>
													</div>
						  						</div>
						  					</div>
						  					<div class="row">
						  						<div class="col-md-4">
						  							<div class="input-group mb-3">
						  								<div class="input-group-prepend">
						  									<span class="input-group-text"><i class="icofont-google-map"></i></span>
														</div>
														<input type="text" name="fromLocation_m[1]" id="tagfrom1_multicity" class="form-control flight_from2"  onkeyup="flight_suggest(this.value,2);"  placeholder="From" autocomplete="off" required> 
														<input type="hidden" name="from_country[1]" id="flight_from_country2">
													</div>
						  						</div>
						  						<div class="col-md-4">
						  							<div class="input-group mb-3">
						  								<div class="input-group-prepend">
						  									<span class="input-group-text"><i class="icofont-google-map"></i></span>
														</div>
														<input type="text" name="toLocation_m[1]" id="tagto1_multicity" class="form-control flight_from_to2" onkeyup="flight_suggest_to(this.value,2);" placeholder="To" autocomplete="off" required>
														<input type="hidden" name="to_country[1]" id="flight_from_to_country2">
													</div>
						  						</div>
						  						<div class="col-md-3 depart-flt">
						  							<div class="input-group mb-3">
						  								<div class="input-group-prepend">
						  									<span class="input-group-text">
						  										<i class="icofont-ui-calendar"></i>
						  									</span>
														</div>
														<input placeholder="DD-MM-YYYY" type="text" name="dept_date_m[1]" id="ft-date2_multicity" class="form-control datepicker-cl" autocomplete="off" required>
													</div>
						  						</div>
						  						<div class="col-md-1">
						  							<button type="button" class="btn btn-success add_pickup_more"><i class="icofont-plus"></i></button>
						  						</div>
						  					</div>
						  					<div class="row flght-multi-1">
						  						<div class="col-md-4">
						  							<div class="input-group mb-3">
						  								<div class="input-group-prepend">
						  									<span class="input-group-text"><i class="icofont-google-map"></i></span>
														</div>
														<input type="text" name="fromLocation_m[2]" id="tagfrom2_multicity" class="form-control flight_from3" onkeyup="flight_suggest(this.value,3);" placeholder="From" autocomplete="off" required>
													<input type="hidden" name="from_country[2]" id="flight_from_country3">
													</div>
						  						</div>
						  						<div class="col-md-4">
						  							<div class="input-group mb-3">
						  								<div class="input-group-prepend">
						  									<span class="input-group-text"><i class="icofont-google-map"></i></span>
														</div>
														<input type="text" name="toLocation_m[2]" id="tagto2_multicity" class="form-control flight_from_to3" onkeyup="flight_suggest_to(this.value,3);" placeholder="To" autocomplete="off" required>
														<input type="hidden" name="to_country[2]" id="flight_from_to_country3">
													</div>
						  						</div>
						  						<div class="col-md-3 depart-flt">
						  							<div class="input-group mb-3">
						  								<div class="input-group-prepend">
						  									<span class="input-group-text">
						  										<i class="icofont-ui-calendar"></i>
						  									</span>
														</div>
														<input placeholder="DD-MM-YYYY" type="text" name="dept_date_m[2]" id="ft-date3_multicity" class="form-control datepicker-cl" autocomplete="off" required>
													</div>
						  						</div>
						  						<div class="col-md-1">
						  							<button type="button" class="btn btn-danger remove_field"><i class="icofont-ui-delete"></i></button>
						  						</div>
						  					</div>
						  					<div class="row flght-multi-2">
						  						<div class="col-md-4">
						  							<div class="input-group mb-3">
						  								<div class="input-group-prepend">
						  									<span class="input-group-text"><i class="icofont-google-map"></i></span>
														</div>
														<input type="text" name="fromLocation_m[3]" id="tagfrom3_multicity" class="form-control flight_from4"  onkeyup="flight_suggest(this.value,4);"  placeholder="From" autocomplete="off" required>
														<input type="hidden" name="from_country[3]" id="flight_from_country4">
													</div>
						  						</div>
						  						<div class="col-md-4">
						  							<div class="input-group mb-3">
						  								<div class="input-group-prepend">
						  									<span class="input-group-text"><i class="icofont-google-map"></i></span>
														</div>
														<input type="text" name="toLocation_m[3]" id="tagto3_multicity" class="form-control flight_from_to4" onkeyup="flight_suggest_to(this.value,4);" placeholder="To" autocomplete="off" required>
														<input type="hidden" name="to_country[3]" id="flight_from_to_country4">
													</div>
						  						</div>
						  						<div class="col-md-3 depart-flt">
						  							<div class="input-group mb-3">
						  								<div class="input-group-prepend">
						  									<span class="input-group-text">
						  										<i class="icofont-ui-calendar"></i>
						  									</span>
														</div>
														<input placeholder="DD-MM-YYYY" type="text" name="dept_date_m[3]" id="ft-date4_multicity" class="form-control datepicker-cl" autocomplete="off" required>
													</div>
						  						</div>
						  						<div class="col-md-1">
						  							<button type="button" class="btn btn-danger remove_field"><i class="icofont-ui-delete"></i></button>
						  						</div>
						  					</div>
						  					<div class="row">
						  						<div class="col-md-3 col-sm-6 col-6">
						  							<div class="form-group">
						  								<label class="">Adult(12+ Yrs)</label>
						  								<select name="no_adult" id="m-adults" class="form-control custom-select adult_select pop_select" required="required">
															<option value="1">1</option>
															<option value="2">2</option>
															<option value="3">3</option>
															<option value="4">4</option>
															<option value="5">5</option>
															<option value="6">6</option>
															<option value="7">7</option>
															<option value="8">8</option>
															<option value="9">9</option>
														</select>
						  							</div>
						  						</div>
						  						<div class="col-md-3 col-sm-6 col-6">
						  							<div class="form-group">
						  								<label class="">Child(s)(2-11 Yrs)</label>
						  								<select name="no_child" id="m-childs" class="form-control custom-select child_select pop_select" required="required">
															<option value="0">0</option>
															<option value="1">1</option>
															<option value="2">2</option>
															<option value="3">3</option>
															<option value="4">4</option>
															<option value="5">5</option>
															<option value="6">6</option>
															<option value="7">7</option>
															<option value="8">8</option>
														</select>
						  							</div>
						  						</div>
						  						<div class="col-md-3 col-sm-6 col-6">
						  							<div class="form-group">
						  								<label class="">Infant(s)(Under 2 Yrs)</label>
						  								<select name="no_infants" id="m-infant" class="form-control custom-select infent_select pop_select" required="required">
															<option value="0">0</option>
															<option value="1">1</option>
														</select>
						  							</div>
						  						</div>
						  						<div class="col-md-3 col-sm-6 col-6">
						  							<div class="form-group">
						  								<label class="">Class</label>
						  								<select name="cabin_class" id="m-class" class="form-control custom-select  pop_select" required="required">
															<option value="1">ALL</option>
															<option value="2">Economy</option>
															<option value="4"> Business</option>
															<option value="6"> First Class</option>
														</select>
						  							</div>
						  						</div>
						  						<div class="col-md-2 col-sm-6 col-6">
						  							<button id="flightbtnsearch1" type="button" class="btn btn-search w-100" >Search</button>
						  						</div>
						  					</div>
					  					</div>
					  				</form>
					  			</div>
					  			<!-- Multicity Flights end -->
					  		</div>
		  
		  
		  
	    </div>
	    
	    <!-- Modal footer -->
	    <div class="modal-footer">
	      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	    </div>
	  </div>
	</div>
</div>
</div>
<!-- Modify Search Popup end -->

    
     <!-- Modal Confirm Price-->
   <div class="modal fade flights-search-popup" id="confirmprice" role="dialog">
	    <div class="modal-dialog">
	    
	      <!-- Modal content-->
	      <div class="modal-content">
	        <div class="modal-header">
	          <h5 class="text-center w-100">We are Reconfirming Price... </h5>
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
 <!-- Modal End Confirm Price-->


<!-- Modal start Confirm Error Price-->
      <div  id="confirmerror" class="modal fade flights-search-popup" role="dialog" >
        <div class="modal-dialog ">
          <!-- Modal content-->
          <div class="modal-content">
		   <div class="modal-header">
	          <h5 class="text-center w-100">Error....</h5>
	        </div>
            <div class="modal-body">
              <div class="text-center">
                <h4 class="modal-title">There is some Problem on request. Please Try again later.</h4>
              </div>
            </div>
            <div class="modal-footer">
              <a href="#" title="Cancel" class="btn btn-secondary" data-dismiss="modal">Cancel</a>
              <a href="<?php echo site_url() ?>"> <button type="button" class="btn btn-default">Home  </button></a>
            </div>
          </div>  
        </div>
      </div>

<!-- Modal  End Confirm Error Price-->



<?php $this->load->view('include/footer') ?>
<?php //$this->load->view('front/js') ?>

<?php $this->load->view('flight/js') ?>

<script src="<?php echo site_url();?>assets/js/slick.js"></script>


<?php  if (isset($resultdata->Response->Results[0])) { ?>


 <script>
$('#filter_click').click(function(){
            
            if ($('#filter_xs_slide').is(':hidden')) {
               
               $('#filter_xs_slide').show('slide',{direction:'left'});
               $("#filter_xs_slide").addClass("position");
               $('#contant_hide_on_filter').hide();
            } else {
               $('#filter_xs_slide').hide('slide',{direction:'left'});
            }
});
$('#filter_click_submit').click(function(){
       $('#filter_xs_slide').hide('slide',{direction:'left'});
       $('#contant_hide_on_filter').show();
});

//$(window).load(function(){
	//$('#wait').click(function(){
$(document).ready(function(){
    var from_city = "<?php echo $_GET['from_city_code'] ?>";
    var to_city = "<?php echo $_GET['to_city_code'] ?>";
	 // var from_city = "<?php echo $search_data["from_city_code"] ?>";
	 // var to_city = "<?php echo $search_data["to_city_code"] ?>";
    var depart_date = "<?php echo $_GET['depart_date'] ?>";
   console.log(depart_date);
     $.ajax({
                type: "POST",
                url: "<?php echo site_url(); ?>flight/ajax_calendar_fare",
                data: {from_city:from_city,to_city:to_city,depart_date:depart_date},
                dataType: "text",
                cache: false,
                success:
                        function (data) {
                            console.log(data);
                            $('.rio-promos').slick('unslick');
                             $(".rio-promos").html("");
                             var bp_age_div_data = "";	
                             $('#wait').hide();
                             $('#slider_c').show();
							 var obj = jQuery.parseJSON(data);							 
                             var json = obj.result;
                            for(var i=0;i<json.length;i++){                               
                                 
                                if(json[i].DepartureDate.split('T')[0] == "<?php echo date("Y-m-d", strtotime($_GET['depart_date'])); ?>" )  {
                                    bp_age_div_data +='<div class="mk-farecalendar active ">\
                                                        <a class="search_flight_slider" href="<?php echo site_url(); ?>flight/result?type=<?php echo $this->input->get("type"); ?>&from_country=<?php echo $this->input->get("from_country"); ?>&to_country=<?php echo $this->input->get("to_country"); ?>&from_location=<?php echo $this->input->get("from_location"); ?>&to_location=<?php echo $this->input->get("to_location"); ?>&from_city_code=<?php echo $this->input->get("from_city_code"); ?>&to_city_code=<?php echo $this->input->get("to_city_code"); ?>&depart_date=<?php echo $this->input->get("depart_date"); ?>&return_date=<?php echo $this->input->get("return_date"); ?>&no_adult=<?php echo $this->input->get("no_adult"); ?>&no_child=<?php echo $this->input->get("no_child"); ?>&no_infants=<?php echo $this->input->get("no_infants"); ?>&cabin_class=<?php echo $this->input->get("cabin_class"); ?>>\
                                                            <div class="clearfix fc-airline">\
                                                                <img src="<?php echo site_url(); ?>assets/images/airlines/'+json[i].AirlineCode+'.gif" alt="Airline">\
                                                                <span>'+json[i].AirlineName+'</span>\
                                                            </div>\
                                                            <div class="clearfix fc-price">\
                                                                <small>'+json[i].DepartureDate.split('T')[0]+'</small>\
                                                                <span><?php echo $this->bp_white_label_setting->wls_currency_symbol;?>'+Math.round(json[i].Fare)+'</span>\
                                                            </div>\
                                                        </a>\
                                                    </div>';
                                } 
                                else{
                                    bp_age_div_data +='<div class="mk-farecalendar ">\
                                                        <a class="search_flight_slider" href="<?php echo site_url(); ?>flight/result?type=<?php echo $this->input->get("type"); ?>&from_country=<?php echo $this->input->get("from_country"); ?>&to_country=<?php echo $this->input->get("to_country"); ?>&from_location=<?php echo $this->input->get("from_location"); ?>&to_location=<?php echo $this->input->get("to_location"); ?>&from_city_code=<?php echo $this->input->get("from_city_code"); ?>&to_city_code=<?php echo $this->input->get("to_city_code"); ?>&depart_date=<?php echo $this->input->get("depart_date"); ?>&return_date=<?php echo $this->input->get("return_date"); ?>&no_adult=<?php echo $this->input->get("no_adult"); ?>&no_child=<?php echo $this->input->get("no_child"); ?>&no_infants=<?php echo $this->input->get("no_infants"); ?>&cabin_class=<?php echo $this->input->get("cabin_class"); ?>">\
                                                            <div class="clearfix fc-airline">\
                                                                <img src="<?php echo site_url(); ?>assets/images/airlines/'+json[i].AirlineCode+'.gif" alt="Airline">\
                                                                <span>'+json[i].AirlineName+'</span>\
                                                            </div>\
                                                            <div class="clearfix fc-price">\
                                                                <small>'+json[i].DepartureDate.split('T')[0]+'</small>\
                                                                <span><?php echo $this->bp_white_label_setting->wls_currency_symbol;?>'+Math.round(json[i].Fare)+'</span>\
                                                            </div>\
                                                        </a>\
                                                    </div>';
                                }

                                
    
                        }
                        $(".rio-promos").append(bp_age_div_data);
                        $('.rio-promos').slick({
                            dots: false,
                            infinite: true,
                            speed: 500,
                            slidesToShow: 6,
                            slidesToScroll: 1,
                            autoplay: false,
                            autoplaySpeed: 2000,
                            arrows: true,
                            responsive: [{
                                    breakpoint: 600,
                                    settings: {
                                        slidesToShow: 2,
                                        slidesToScroll: 1
                                    }
                                },
                                {
                                    breakpoint: 400,
                                    settings: {
                                        arrows: false,
                                        slidesToShow: 1,
                                        slidesToScroll: 1
                                    }
                                }
                            ]
                        });


                        $(".search_flight_slider").click(function(){
                          
							 if($('#one-way-rad').hasClass('active')){
								$(".return_m").hide();
								$(".return_m_d").hide();
								$(".oneway_m").show();	
									
								$(".from_location_m").text($(".flight_from0").val());
								$(".to_location_m").text($(".flight_from_to0").val());								
								$(".depart_date_m").text($("#depart_date").val());		
								$(".return_date_m").text($("#return_date").val());
								$(".num_adult").text($(".adult_select").val());
								$(".num_child").text($(".child_select").val());
								$(".num_infant").text($(".infent_select").val());

							}  else {
								$(".oneway_m").hide();  
								$(".return_m").show();
								$(".return_m_d").show();								
								$(".from_location_m").text($(".flight_from0").val());
								$(".to_location_m").text($(".flight_from_to0").val());
								$(".depart_date_m").text($("#depart_date").val());
								$(".return_date_m").text($("#return_date").val());  
								$(".num_adult").text($(".adult_select").val());
								$(".num_child").text($(".child_select").val());
								$(".num_infant").text($(".infent_select").val());							
						  }
                            $("#searchingpopup").modal("show");
                        });


                    }
            });
});

</script>

 <?php } ?>

<script>
if($('#multicity').is(':checked')) { 
$('#multi-flght').show();
 $('#oneway-flght').hide();
$('#one-way-rad').removeClass("active");
$('#multicity-rad').addClass("active");
}



// multicity date picker 
	$('#ft-date1_multicity').datepicker({
                    numberOfMonths: 1,
                    dayNamesMin: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
                    //"minDate": 0,

                    dateFormat: "yy-mm-dd",
                    minDate: 0,

                    beforeShow: function () {
                        $('#ui-datepicker-div').addClass("searchdatepicker");
                    },
                    onSelect: function (selectedDate) {
                        $("#ft-date2_multicity").datepicker("option", "minDate", selectedDate);
                    }
                });

                $('#ft-date2_multicity').datepicker({
                    numberOfMonths: 1,
                    dayNamesMin: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
                    minDate: 0,

                    dateFormat: "yy-mm-dd",

                    beforeShow: function () {
                        $('#returnid').addClass('active');
                        $('#onwayid').removeClass('active');
                        $('#multicityid').removeClass('active');
                        $('#return_datebox').css("opacity", "1");
                        $('#return_date').removeClass("return-background");
                        $("#round-trip").prop("checked", true);
                        $('#ui-datepicker-div').addClass("searchdatepicker");

                    },
                    onSelect: function (selectedDate) {
                        $("#ft-date3_multicity").datepicker("option", "minDate", selectedDate);
                    }
                });

                $('#ft-date3_multicity').datepicker({
                    numberOfMonths: 1,
                    dayNamesMin: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
                    minDate: 0,

                    dateFormat: "yy-mm-dd",

                    beforeShow: function () {
                        $('#returnid').addClass('active');
                        $('#onwayid').removeClass('active');
                        $('#multicityid').removeClass('active');
                        $('#return_datebox').css("opacity", "1");
                        $('#return_date').removeClass("return-background");
                        $("#round-trip").prop("checked", true);
                        $('#ui-datepicker-div').addClass("searchdatepicker");

                    }, onSelect: function (selectedDate) {
                        $("#ft-date4_multicity").datepicker("option", "minDate", selectedDate);
                    }
                });

                $('#ft-date4_multicity').datepicker({
                    numberOfMonths: 2,
                    dayNamesMin: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
                    minDate: 0,

                    dateFormat: "yy-mm-dd",

                    beforeShow: function () {
                        $('#returnid').addClass('active');
                        $('#onwayid').removeClass('active');
                        $('#multicityid').removeClass('active');
                        $('#return_datebox').css("opacity", "1");
                        $('#return_date').removeClass("return-background");
                        $("#round-trip").prop("checked", true);
                        $('#ui-datepicker-div').addClass("searchdatepicker");

                    }
                });

//end multicity datepicker	


//
    $( function() {
		var maxv= $('#amount').attr("data-slider-max");
		var vali= $('#pricep').attr("data-slider-value");
    $( "#slider-range" ).slider({
      range: true,
		min: <?php echo $pricefiltermin ; ?>,
        max: <?php echo $pricefiltermax ; ?>,
       values: [ <?php echo $pricefiltermin ; ?>, <?php echo $pricefiltermax ; ?> ],
      slide: function( event, ui ) {       
       $( "#amount" ).val( "<?php echo $js_currency_symbol; ?> " + ui.values[ 0 ]  );
       $( "#amount-sec" ).val( "<?php echo $js_currency_symbol; ?> " + ui.values[ 1 ] );
	   
				var i=0;
				var j=0;
					$(".price1").each(function(){
							if($(this).attr("price")<=ui.values[ 0 ] || $(this).attr("price")>=ui.values[ 1 ])
						{
						$(this).hide();
						console.log("hide");
						}
						if($(this).attr("price")>=ui.values[ 0 ] && $(this).attr("price")<=ui.values[ 1 ])
						{
						$(this).show();
						console.log("show");
						}
					});	
	   
      }
    });
	
    $( "#amount" ).val( "<?php echo $js_currency_symbol; ?> " + $( "#slider-range" ).slider( "values", 0 ));

    $( "#amount-sec" ).val( "<?php echo $js_currency_symbol; ?> " + $( "#slider-range" ).slider( "values", 1 ) );
  } );
  
</script>


<!--NEW SCRIPT-->

<script>
  
		//======Reset All====
		
		 $(".reset").click(function () {
			  $(".price111").each(function () {
                  $(this).show();
                      

                    }); 
			 
		 });
		
		
		
		//===
		
		  $(".flightso").click(function () {
            if ($(this).val() == "0")
            {
                $(this).val("1");
            } else
            {
                // alert($(this).attr("check_see"));
                $(this).val("0");
            }

            var stops1 = "";
            $(".flightso").each(function () {
                if ($(this).val() == "1")
                {
                    stops1 = $(this).attr("value_for_short");
                    $(".flight11").each(function () {
                        if (stops1 == $(this).attr("flight"))
                        {
                            $(this).show();
                        }

                    });


                } else
                {
                    var stops2 = $(this).attr("value_for_short");
                    $(".flight11").each(function () {
                        if (stops2 == $(this).attr("flight"))
                        {
                            $(this).hide();
                        }

                    });

                }

            });
            if (stops1 == "")
            {
                $(".flight11").each(function () {
                    $(this).show();
                });
            }
            var count_bhanu=0;
                 var count_bhanuret=0;
		 $(".refendable11onword").each(function () {
                    if ($("div:visible", this).length > 10)
                    {
                        count_bhanu = count_bhanu + 1;
                    }
                });
                
                $(".search-results-title-onword").html('</i>Onword - <b>'+count_bhanu+'</b> found');
                
                $(".refendable11return").each(function () {
                    if ($("div:visible", this).length > 10)
                    {
                        count_bhanuret = count_bhanuret + 1;
                    }
                });
                 $(".search-results-title-return").html('</i>Return - <b>'+count_bhanuret+'</b> found');
            $("#form_submit_pop_over").modal("hide");
        });
		
		      $(function () {
            $(".flightstop").click(function () {
                // $("#form_submit_pop_over").modal("show");
                if ($(this).attr("check_see") == "0")
                {
                    $(this).attr("check_see", "1");
                } else
                {
                    $(this).attr("check_see", "0");
                }
                var stops1 = "";
                $(".flightstop").each(function () {
                    if ($(this).attr("check_see") == "1")
                    {
                        stops1 = $(this).val();

                        $(".stopscount").each(function () {

                            if (stops1 == $(this).attr("stop"))
                            {

                                $(this).show();
                            }

                        });


                    } else
                    {
                        var stops2 = $(this).val();
                        $(".stopscount").each(function () {
                            if (stops2 == $(this).attr("stop"))
                            {
                                $(this).hide();
                            }

                        });

                    }

                });
                if (stops1 == "")
                {
                    $(".stopscount").each(function () {
                        $(this).show();
                    });
                }
                var count_bhanu=0;
                 var count_bhanuret=0;
		 $(".refendable11onword").each(function () {
                    if ($("div:visible", this).length > 10)
                    {
                        count_bhanu = count_bhanu + 1;
                    }
                });
                
                $(".search-results-title-onword").html('</i>Onword - <b>'+count_bhanu+'</b> found');
                
                $(".refendable11return").each(function () {
                    if ($("div:visible", this).length > 10)
                    {
                        count_bhanuret = count_bhanuret + 1;
                    }
                });
                 $(".search-results-title-return").html('</i>Return - <b>'+count_bhanuret+'</b> found');
                $("#form_submit_pop_over").modal("hide");
            });
        });



$(function() {
		$( "#slider-range_onward" ).slider({
			// range:true,
			// min: 0,
			// max: 23,
			// values: [ 0, 23 ],			 
			// slide: function( event, ui ) {
			// $( "#timep1" ).val( ui.values[ 0 ] +"  - " + ui.values[ 1 ] );
			
			range: true,
			min: 0,
			max: 1440,
			step: 15,
			values: [ 0, 1440 ],
		//	values: [600, 720],
			slide: function(e, ui) {
				
				var hours1 = Math.floor(ui.values[0] / 60);
				var minutes1 = ui.values[0] - (hours1 * 60);

				if (hours1.length == 1) hours1 = '0' + hours1;
				if (minutes1.length == 1) minutes1 = '0' + minutes1;
				if (minutes1 == 0) minutes1 = '00';
				
				
				var hours2 = Math.floor(ui.values[1] / 60);
				var minutes2 = ui.values[1] - (hours2 * 60);

				if (hours2.length == 1) hours2 = '0' + hours2;
				if (minutes2.length == 1) minutes2 = '0' + minutes2;
				if (minutes2 == 0) minutes2 = '00';
				
				$('#timep1').val(hours1+':'+minutes1+' - '+hours2+':'+minutes2 );
			
			var time1 = hours1 +':'+ minutes1 ; 
			var time2=  hours2+':'+ minutes2;			
			 
			var time3=  (hours1*60) + minutes1 ;
			var time4=  (hours2*60) + minutes2 ;
			
			// var timedep=  $(".price111onword").attr("timedep");
			// console.log(time3);
			// console.log(time4);
			var i=0;
			var j=0;
			$(".price111onword").each(function(){
			if($(this).attr("timedep")<ui.values[ 0 ] || $(this).attr("timedep")>ui.values[ 1 ])
			//if($(this).attr("timedep")<= time3 || $(this).attr("timedep")>=time4)
			{
			$(this).hide();
			}
			if($(this).attr("timedep")>ui.values[ 0 ] && $(this).attr("timedep")<ui.values[ 1 ])
			//if($(this).attr("timedep")>= time3 && $(this).attr("timedep")<=time4)
			{
			$(this).show();
			}
			});	 
		}
		});	

		$('#timep1').val( $( "#slider-range_onward" ).slider(hours1+':'+minutes1+' - '+hours2+':'+minutes2 ));
		//$( "#timep1" ).val( $( "#slider-range_onward" ).slider( "values", hours1+':'+minutes1 ) +
			//" - " + $( "#slider-range_onward" ).slider( "values", hours2+':'+minutes2) );
		
	 });
  $('.departtym').click(function(e){
	    var str=$(this).val();
		$('.tymlab').removeClass('active');
		$(this).parent().addClass('active');
        var res = str.split("-");       
        if($(this).prop("checked") == true){	   
		    $(".price111onword").each(function(){
		    	if($(this).attr("timedep")>=res[0] && $(this).attr("timedep")<=res[1])
				{
					$(this).show();
				} else {
					$(this).hide();
				}
			});	
		} else {
			$(".price111onword").show();
		}
    });
 
  
$(function () {
            $(".flightfare").click(function () {
                //$("#form_submit_pop_over").modal("show");
				
				//alert("dfh");
                if ($(this).attr("check_see") == "0")
                {
                    $(this).attr("check_see", "1");
                } else
                {
                    $(this).attr("check_see", "0");
                }
                var stops1 = "";
                $(".flightfare").each(function () {
                    if ($(this).attr("check_see") == "1")
                    {
                        stops1 = $(this).val();

                        $(".refendable11").each(function () {

                            if (stops1 == $(this).attr("refendable"))
                            {

                                $(this).show();
                            }

                        });


                    } else
                    {
                        var stops2 = $(this).val();
                        $(".refendable11").each(function () {
                            if (stops2 == $(this).attr("refendable"))
                            {
                                $(this).hide();
                            }

                        });

                    }

                });
                if (stops1 == "")
                {
                    $(".refendable11").each(function () {
                        $(this).show();
                    });
                }
                var count_bhanu=0;
                 var count_bhanuret=0;
		 $(".refendable11onword").each(function () {
                    if ($("div:visible", this).length > 10)
                    {
                        count_bhanu = count_bhanu + 1;
                    }
                });
                
                $(".search-results-title-onword").html('</i>Onword - <b>'+count_bhanu+'</b> found');
                
                $(".refendable11return").each(function () {
                    if ($("div:visible", this).length > 10)
                    {
                        count_bhanuret = count_bhanuret + 1;
                    }
                });
                 $(".search-results-title-return").html('</i>Return - <b>'+count_bhanuret+'</b> found');
                $("#form_submit_pop_over").modal("hide");
            });

        });




 
</script>




