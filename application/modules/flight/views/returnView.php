<?php $this->load->view('include/head');
$this->load->view('include/header');
// getting current currency
$current_currency = getCurrentCurrency();
if( $current_currency == "USD" ){
	$currency_symbol = "icofont-dollar"; $js_currency_symbol = "$";
} else{
	$currency_symbol = "icofont-rupee"; $js_currency_symbol = "₹";
}

if( $current_currency == "AED" ){
	$js_currency_symbol = "AED";
}
$airline_list = array();
$segmentcount = 0;
$resultdata = $_SESSION ['flight'] ['Search_Result'];
$segmentcountreturn=0;

$total_flights_ob = count($resultdata->Response->Results[0]);
$total_flights_ib = count($resultdata->Response->Results[1]);
$search_data = $_SESSION ['flight'] [$searchID] ['search_RequestData'];
$total_pax = (int)($search_data['no_adult'] + $search_data['no_child'] + $search_data['no_infants']) ;
$_SESSION ['total_pax'] = $total_pax;
foreach ($resultdata->Response->Results[0] as $k => $airlineresultsprice) {
    $segmentf = $airlineresultsprice->Segments [0][0];
    if (!in_array($segmentf->Airline->AirlineName, $airline_list)) {
        $airline_list [$segmentf->Airline->AirlineCode] = $segmentf->Airline->AirlineName;
    }
    $segment_ob_get = $airlineresultsprice->Segments[0];
    $fare_ob_get = $airlineresultsprice->Fare;
    $offer_fare_ob_get=$fare_ob_get->OfferedFare/$total_pax;
    $publish_fare_ob_get =$fare_ob_get->PublishedFare/$total_pax;
    $dsa_data_ob_get=$this->dsa_data;
    $dsa_airline_code_ob_get=$segment_ob_get[0]->Airline->AirlineCode;
    $baseFare_get = $fare_ob_get->BaseFare/$total_pax;
    $yq_fare_get = $fare_ob_get->YQTax; 
    //$bp_fare_data_ob_get=bp_get_fare($offer_fare_ob_get,$publish_fare_ob_get,$dsa_airline_code_ob_get,$dsa_data_ob_get,$baseFare_get,$yq_fare_get);
	$bp_fare_data_ob_get=bp_get_fare_without_markup($offer_fare_ob_get,$publish_fare_ob_get,$dsa_airline_code_ob_get,$dsa_data_ob_get,$baseFare_get,$yq_fare_get);
	$dsa_fare_ob_get=$bp_fare_data_ob_get['dsa_fare'];
    $customer_fare_ob_get=$bp_fare_data_ob_get['customer_fare'];
    // $dsa_fare_ob_get = $offer_fare_ob_get;
    // $customer_fare_ob_get = $publish_fare_ob_get;
    $all_price[] = $customer_fare_ob_get;
   	// $all_price[] = $airlineresultsprice->Fare->OfferedFare;
    if($segmentcount < count($airlineresultsprice->Segments[0])){
    	$segmentcount = count($airlineresultsprice->Segments[0]);
    }else{ } 
}
$traceID = $resultdata->Response->TraceId;
$selectedResultindexOB = $resultdata->Response->Results[0][0]->ResultIndex;
$selectedResultindexIB = $resultdata->Response->Results[1][0]->ResultIndex;

// $search_data = $_SESSION ['flight'] [$searchID] ['search_RequestData'];
// $total_pax = (int)($search_data['no_adult'] + $search_data['no_child'] + $search_data['no_infants']) ;

//********************** for return data filter 
$airline_listreturn = array();
foreach ($resultdata->Response->Results[1] as $k => $airlineresultspricereturn) {
    //echo "---</br>".$airlineresultsprice->Fare->OfferedFare;
    $segmentfreturn = $airlineresultspricereturn->Segments [0][0];
    if (!in_array($segmentfreturn->Airline->AirlineName, $airline_listreturn)) {
        $airline_listreturn [$segmentfreturn->Airline->AirlineCode] = $segmentfreturn->Airline->AirlineName;
    }
    $segmentreturn_ib_get = $airlineresultspricereturn->Segments[0];
    $farereturn_ib_get = $airlineresultspricereturn->Fare;
    $offer_fare_ib_get=$farereturn_ib_get->OfferedFare/$total_pax;
	$publish_fare_ib_get=$farereturn_ib_get->PublishedFare/$total_pax;
	$dsa_data_ib_get=$this->dsa_data;
	$dsa_airline_code_ib_get=$segmentreturn_ib_get[0]->Airline->AirlineCode;
	$baseFare_ib_get = $farereturn_ib_get->BaseFare/$total_pax;
	$yq_fare_ib_get = $farereturn_ib_get->YQTax;
	//$bp_fare_data_ib_get=bp_get_fare($offer_fare_ib_get,$publish_fare_ib_get,$dsa_airline_code_ib_get,$dsa_data_ib_get,$baseFare_ib_get,$yq_fare_ib_get);
	$bp_fare_data_ib_get=bp_get_fare_without_markup($offer_fare_ib_get,$publish_fare_ib_get,$dsa_airline_code_ib_get,$dsa_data_ib_get,$baseFare_ib_get,$yq_fare_ib_get);
	$dsa_fare_ib_get=$bp_fare_data_ib_get['dsa_fare'];
	$customer_fare_ib_get=$bp_fare_data_ib_get['customer_fare'];
	// $dsa_fare_ib_get = $offer_fare_ib_get;
	// $customer_fare_ib_get= $publish_fare_ib_get;
    $all_pricereturn[] = $customer_fare_ib_get;
    if($segmentcountreturn < count($airlineresultspricereturn->Segments[0])){
    	$segmentcountreturn = count($airlineresultspricereturn->Segments[0]);
    }else{       }   
}
$bothsaleprice = array_merge($all_price,$all_pricereturn);
if($segmentcount < $segmentcountreturn){
  $segmentcount =  $segmentcountreturn; 
}else{}
$pricefiltermin = round(min($bothsaleprice));
$pricefiltermax = round(max($bothsaleprice));
$from_city= explode(" ",$search_data["from_location"]); 
$to_city = explode(" ",$search_data["to_location"]); 
if($search_data["type"] == 'MultiWay'){
		$no_of_city =0 ;
		for($i=1; $i<=5; $i++ ){
			if($search_data["from_location_".$i]) {
				$no_of_city++;
			}
		}
	}else{
		$no_of_city =2 ;
	}
?>
<!-- Search Result info -->
<section class="search-result-info pt-3 pb-3">
	<div class="container-fluid">
		<div class="oneway-modify ">
			<div class="row">
				<?php 
					$from_data=explode(',',$search_data['from_location']);
			   		$to_data=explode(',',$search_data['to_location']); 
				?>		
				<div class="col-md-3 col-sm-6 col-12 border-right">
					<div class="one-flght-location">
						<small class="text-muted text-uppercase">Return</small>
						<h6 class="mb-0"><?php echo $from_data[1] ?> to <?php echo $to_data[1] ?></h6>
					</div>
				</div>
				<div class="col-md-2 col-sm-6 col-6 border-right">
					<div class="flght-depart">
						<small class="text-muted text-uppercase">Departure</small>
						<h6 class="mb-0"><i class="icofont-ui-calendar"></i> <?php echo date("j M Y D", strtotime($search_data['depart_date']) ); ?></h6>
					</div>
				</div>
				<div class="col-md-2 col-sm-6 col-6 border-right">
					<div class="flght-depart txt-right">
						<small class="text-muted text-uppercase">Return</small>
						<h6 class="mb-0"><i class="icofont-ui-calendar"></i> <?php echo date("j M Y D", strtotime($search_data['return_date']) ); ?></h6>
					</div>
				</div>
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
					 	 	<h6 class="font-weight-normal mb-2">No. of Stops(Onward)</h6>
					 	 	<div class="flt-stop" id="flght-stops-num">
					 	 		<ul class="list-inline mb-0 text-center">
								   	<?php for ($i = 0; $i < $segmentcount; $i++) { ?>
										<li class="list-inline-item">
											<label for="stop-<?php echo $i?>" class="mb-0 d-block">
												<input type="checkbox" name="oneWay-fl-stop" class="flightstop" id="stop-<?php echo $i?>" check_see="0" value="<?php echo $i; ?>">
												<p class="mb-0">
													<strong> <?= ($i == 0) ? "Non" : $i ?> Stop</strong>
													<!--<span class="d-block">14357</span>-->
												</p>
											</label>
										</li>
									<?php } ?> 
								</ul>
					 	 	</div>
					 	 </div>
						 <!---Return stops--->
						 <div class="sidebar-com no-of-stop pb-2 pb-md-3 border-bottom mb-md-3 ">
					 	 	<h6 class="font-weight-normal mb-2">No. of Stops(Return)</h6>
					 	 	<div class="flt-stop" id="flght-stops-num_ret">
					 	 		<ul class="list-inline mb-0 text-center">								
									<?php for ($i = 0; $i < $segmentcountreturn; $i++) { ?>
										<li class="list-inline-item">
											<label for="stop_ret-<?php echo $i?>" class="mb-0 d-block">
												<input type="checkbox" name="return-fl-stop" class="flightstop_return" id="stop_ret-<?php echo $i?>" check_see="0" value="<?php echo $i; ?>">
												<p class="mb-0">
													<strong> <?= ($i == 0) ? "Non" : $i ?> Stop</strong>
													<!--<span class="d-block">14357</span>-->
												</p>
											</label>
										</li>
									<?php } ?> 
								</ul>
					 	 	</div>
						</div>
						<!-- Stop End -->
						<!-- Flight Depart Time -->
						<!--
					 	<div class="sidebar-com depart-time pb-2 pb-md-3 border-bottom mb-md-3 ">
					 	 	<h6 class="font-weight-normal mb-2">Departure Time Onward <span class="from-st"></span></h6>
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
						
						<!--<div class="row_sidebar_contant range-slider">-->
							<div class="accordion return-vw" id="accordionExample">
							  <div class="card">
							    <div class="card-header" id="headingOne">
							      <button class="btn btn-link" type="button" data-toggle="collapse" aria-expanded="true" data-target="#departure-time">Departure Time</button>
							    </div>

							    <div id="departure-time" class="collapse show" aria-labelledby="headingOne" data-parent="#departure-time">
							      <div class="card-body">
							        <div class="sidebar-com price-airlines price-range mb-2">
								 		<h6 class="font-weight-normal mb-2">Outbound</h6>
								 		<div class="flt-stop prc-air-lines" id="price-rng">
											<p class="mb-0">
											  <ul class="list-inline clearfix mb-2">
											  	<li class="list-inline-item float-left">
											  		<input type="text" id="timep1" value="00:00 - 23:59" readonly>
											  	</li>
											  	<li class="list-inline-item float-right text-md-right">
											  		<input type="text" id="time-range1" class="text-md-right" readonly>
											  	</li>
											  </ul>
											</p>
											<div id="slider-range_onward"></div>
								 		</div>
								 	</div>
									
									<div class="sidebar-com price-airlines price-range">
								 		<h6 class="font-weight-normal mb-2">Return</h6>
								 		<div class="flt-stop prc-air-lines" id="price-rng">
											<p class="mb-0">
											  <ul class="list-inline clearfix mb-2">
											  	<li class="list-inline-item float-left">
											  		<input type="text" id="timep1_ret" value="00:00 - 23:59" readonly>
											  	</li>
											  	<li class="list-inline-item float-right text-md-right">
											  		<input type="text" id="time-range1_ret" class="text-md-right" readonly>
											  	</li>
											  </ul>
											</p>
											<div id="time_slider_ret"></div>
								 		</div>
								 	</div>
							      </div>
							    </div>
							  </div>
							</div>
						
						<!--Return dep date--->
						<!--<div class="sidebar-com depart-time pb-2 pb-md-3 border-bottom mb-md-3 ">
					 	 	<h6 class="font-weight-normal mb-2">Departure Time Return <span class="from-st"></span></h6>
					 	 	<div class="flt-stop flt-depart-time" id="flt-depart-tm_ret">
					 	 		<ul class="list-inline mb-0 text-center">
						 	 		 <li class="list-inline-item">
										  <label for="before-six_ret" class="mb-0 d-block tymlab_ret">
											<input type="checkbox" name="oneWay-fl-time" class="departtym_ret" value="06-12" id="before-six_ret">
											<p class="mb-0">
											  <i class="icofont-sun-rise d-block"></i>
											  <strong>6am to 12pm</strong>
											</p>
										  </label>
										</li>
										<li class="list-inline-item">
										  <label for="before-twl_ret" class="mb-0 d-block tymlab_ret">
											<input type="checkbox" name="oneWay-fl-time" class="departtym_ret" value="12-18" id="before-twl_ret">
											<p class="mb-0">
											  <i class="icofont-full-sunny d-block"></i>
											  <strong>12pm to 6 pm</strong>
											</p>
										  </label>
										</li>
										<li class="list-inline-item">
										  <label for="after-six_ret" class="mb-0 d-block tymlab_ret">
											<input type="checkbox" name="oneWay-fl-time" class="departtym_ret" value="18-24" id="after-six_ret">
											<p class="mb-0">
											  <i class="icofont-sun-set d-block"></i>
											  <strong>6pm to 12am</strong>
											</p>
										  </label>
										</li>
										<li class="list-inline-item">
										  <label for="before-twl-am_ret" class="mb-0 d-block tymlab_ret">
											<input type="checkbox" name="oneWay-fl-time" class="departtym_ret" value="24-06" id="before-twl-am_ret">
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
						<!-- Flight Depart Time End -->

					 

				<!--=====Airlines=====-->
					 <div class="sidebar-com flght-airlines pb-2 pb-md-3 border-bottom mb-md-3 ">
					 		<h6 class="font-weight-normal mb-2">Airlines Onward</h6>
					 		<div class="flt-stop flt-air-lines" id="airline-brands">
					 	 		<ul class="list-unstyled mb-0">
								 <?php
								 $i=0;
								 foreach ($airline_list as $airlinekey => $airline_lists) {	?>

						 	 		<li class="">
						 	 			<label for="airline-<?php echo $i?>" class="mb-0 d-block">
						 	 				<input type="checkbox" name="airlines" id="airline-<?php echo $i?>" class="flightso" value_for_short ="<?php echo $airline_lists; ?>" value="0">
											<p class="mb-0">
												<span class="air-icon">
													<img src="<?php echo site_url()?>assets/images/airlines/<?php echo $airlinekey; ?>.gif" alt="">
												</span>
												<strong class="air-name"><?php echo $airline_lists; ?></strong>
												
											</p>
						 	 			</label>
						 	 		</li>
									
						 	 	 <?php $i++;} ?>
								
					 	 		</ul>
					 	 	</div>
					 	</div>
						<!--RETURN AIRLINE FILTER---->
						<div class="sidebar-com flght-airlines pb-2 pb-md-3 border-bottom mb-md-3 ">
					 		<h6 class="font-weight-normal mb-2">Airlines(Return)</h6>
					 		<div class="flt-stop flt-air-lines" id="airline-brands_ret">
					 	 		<ul class="list-unstyled mb-0">
								 <?php
								 $i=0;
								 foreach ($airline_listreturn as $airlinekey => $airline_lists) {	?>

						 	 		<li class="">
						 	 			<label for="airline_ret-<?php echo $i?>" class="mb-0 d-block">
						 	 				<input type="checkbox" name="airlines" id="airline_ret-<?php echo $i?>" class="flightso_ret" value_for_short ="<?php echo $airline_lists; ?>" value="0">
											<p class="mb-0">
												<span class="air-icon">
													<img src="<?php echo site_url()?>assets/images/airlines/<?php echo $airlinekey; ?>.gif" alt="">
												</span>
												<strong class="air-name"><?php echo $airline_lists; ?></strong>									
											</p>
						 	 			</label>
						 	 		</li>
									
						 	 	 <?php $i++;} ?>
								
					 	 		</ul>
					 	 	</div>
					 	</div>
						<!---AIRLINE FILTER END--->
						<!--PRICE FILTER START-->
					 	<div class="sidebar-com price-airlines price-range">
					 		<h6 class="font-weight-normal mb-2">Price Range(onward)</h6>
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
						<!---Return-->
						<div class="sidebar-com price-airlines price-range">
					 		<h6 class="font-weight-normal mb-2">Price Range(Return)</h6>
					 		<div class="flt-stop prc-air-lines" id="price-rng_ret">
								<p class="mb-0">
								  <ul class="list-inline clearfix mb-2">
								  	<li class="list-inline-item float-left">
								  		<input type="text" id="amount_ret" readonly>
								  	</li>
								  	<li class="list-inline-item float-right text-md-right">
								  		<input type="text" id="amount-sec_ret" class="text-md-right" readonly>
								  	</li>
								  </ul>
								</p>
								<div id="slider-range_ret"></div>
					 		</div>
					 	</div>
						
						<!--PRICE FILTER END--->
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
							<h6 class="mb-0"><?php echo $from_data[1] ?> to <?php echo $to_data[1] ?> - <?php echo date("D, j M Y", strtotime($search_data['depart_date']) ); ?></h6>
							<span class="total-flght d-block"> <?php echo $total_flights_ob?> Onward Flights And <?php echo $total_flights_ib?> Return Flights Found</span> 
						</div>

						<div class="flght-res-onewy flght-return-view">
							<div class="row">
							<!--====Oneway Flights=====-->
								<div class="col-md-6">
									<div class="nxt-prev-btn clearfix mb-2 mb-md-3">
									
									   <?php $currdate = $this->input->get("depart_date");

										$yesterday = date('d-m-Y',strtotime($currdate  . "-1 days")); ?>
									  <a href="<?php echo site_url(); ?>flight/result?type=<?php echo $this->input->get("type"); ?>&from_location=<?php echo $this->input->get("from_location"); ?>&to_location=<?php echo $this->input->get("to_location"); ?>&from_country=<?php echo $this->input->get("from_country"); ?>&to_country=<?php echo $this->input->get("to_country"); ?>&to_city_code=<?php echo $this->input->get("to_city_code"); ?>&from_city_code=<?php echo $this->input->get("from_city_code"); ?>&depart_date=<?php echo $yesterday; ?>&return_date=<?php echo $this->input->get("return_date"); ?>&no_adult=<?php echo $this->input->get("no_adult"); ?>&no_child=<?php echo $this->input->get("no_child"); ?>&no_infants=<?php echo $this->input->get("no_infants"); ?>&cabin_class=<?php echo $this->input->get("cabin_class"); ?>" class="btn btn-search float-left"><i class="icofont-swoosh-left"></i> Previous Day</a>
									
									<?php 

									$tomorrow = date('d-m-Y',strtotime($currdate  . "+1 days")); ?>
								  <a href="<?php echo site_url(); ?>flight/result?type=<?php echo $this->input->get("type"); ?>&from_location=<?php echo $this->input->get("from_location"); ?>&to_location=<?php echo $this->input->get("to_location"); ?>&from_country=<?php echo $this->input->get("from_country"); ?>&to_country=<?php echo $this->input->get("to_country"); ?>&to_city_code=<?php echo $this->input->get("to_city_code"); ?>&from_city_code=<?php echo $this->input->get("from_city_code"); ?>&depart_date=<?php echo $tomorrow; ?>&return_date=<?php echo $this->input->get("return_date"); ?>&no_adult=<?php echo $this->input->get("no_adult"); ?>&no_child=<?php echo $this->input->get("no_child"); ?>&no_infants=<?php echo $this->input->get("no_infants"); ?>&cabin_class=<?php echo $this->input->get("cabin_class"); ?>" class="btn btn-search float-right"> Next Day <i class="icofont-swoosh-right"></i>  </a>
									
									
					                </div>
					                <div class="flt-title-bar mb-3 mb-md-4">
					                	<div class="row">
					                		<div class="col-md-2 col-sm-6 col-6">
						                      <h5>Airline</h5>
						                    </div>
						                    <div class="col-md-3 col-sm-3 d-md-block d-none">
						                      <h5>Depart</h5>
						                    </div>
						                    <div class="col-md-3 col-sm-3 d-md-block d-none">
						                      <h5>Arrive</h5>
						                    </div>
						                    <div class="col-md-2 col-sm-2 d-md-block d-none">
						                      <h5>Duration</h5>
						                    </div>
						                    <div class="col-md-2 col-sm-6 col-6">
						                      <h5>Price</h5>
						                    </div>
						                </div>
					                </div>
							<?php

							if (isset($resultdata->Response->Results[0])) {
							$i = 0;
							foreach ($resultdata->Response->Results[0] as $index=>$airlineresults) {
								$i++;
								$segmentcount = count($airlineresults->Segments[0]);
								
								$segment = $airlineresults->Segments[0];
								
								$fare = $airlineresults->Fare;
								$offer_fare=$fare->OfferedFare;
								$publish_fare=$fare->PublishedFare;
								$dsa_data=$this->dsa_data;
								$dsa_airline_code=$segment[0]->Airline->AirlineCode;
								$baseFare = $fare->BaseFare;
								$yq_fare = $fare->YQTax;
								
								// $bp_fare_data=bp_get_fare($offer_fare,$publish_fare,$dsa_airline_code,$dsa_data,$baseFare,$yq_fare);
								$bp_fare_data=bp_get_fare_without_markup($offer_fare,$publish_fare,$dsa_airline_code,$dsa_data,$baseFare,$yq_fare);
								
								$dsa_fare=$bp_fare_data['dsa_fare']; 
								$customer_fare=$bp_fare_data['customer_fare'];
								
								// $dsa_fare=$offer_fare;
								// $customer_fare=$publish_fare;
								
								$baseFare = $fare->BaseFare;
								$offerfareround = round($customer_fare/$total_pax );
								$taxvalue = $offerfareround - $baseFare;
								$deptime = TimeMinuts(GetTime($segment[0]->Origin->DepTime));
								if(!isset($offerfareseelctedOB)){
								$offerfareseelctedOB = $customer_fare;
								}
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
								
			 <div class="refendable11 refendable11onword flght-temp-col" refendable="<?php echo $fareType12; ?>">
                <div class="price1" price="<?php echo $offerfareround; ?>"  data-price="<?php echo $offerfareround; ?>" data-duration="<?php echo $stopsduration; ?>"data-arrtime="<?php echo $arrtime; ?>" data-deptime="<?php echo $deptime; ?>" >                            

                  <div class="price111 price111onword deptime" timedep="<?php $bb=TimeMinuts(GetTime($segment[0]->Origin->DepTime)); echo $bb;?>" timearr="<?php $bb=explode(":",GetTime($airlineresults->Segments[0][$segmentcount-1]->Destination->ArrTime)); echo $bb[0];?>">
                     
					<div class="flight11" flight="<?php echo $segment[0]->Airline->AirlineName; ?>">
                   	<div class="stopscount" stop="<?php echo $segmentcount - 1; ?>">
								
					  <div id="selectonword_<?php echo $index; ?>" class="airline row-areline-return selectairline select_<?php echo $index; ?> selectonword_<?php echo $index; ?>" faretype="OB" flightindex="<?php echo $index; ?>" searchID ="<?php echo $searchID; ?>"  fareprice="<?php echo $offerfareround; ?>" selectedair="selected" resultindex = "<?php echo $airlineresults->ResultIndex; ?>">
									 
					                <div class="refendable11 flght-result-col domestic-flght-view">	
									<div class="row airlines row-areline-return-dom row-areline-selected">
				                      	<div class="col-md-2 col-sm-12 p-0">
				                          <div class="flght-logo">
				                            <img src="<?php echo site_url(); ?>assets/images/airlines/<?php echo $airlineresults->AirlineCode; ?>.gif" alt="com-logo">
				                            <span class="text-center"><?php echo $segment[0]->Airline->AirlineCode . "-" . $segment[0]->Airline->FlightNumber; ?></span>
				                          </div>
				                        </div>
				                        <div class="col-md-6 col-sm-6 col-6">
				                          <div class="row">
				                            <div class="col-md-6 col-sm-6">
				                              <div class="flght-depart text-center">
				                                <span class="d-block"> <?php echo GetTime($segment[0]->Origin->DepTime); ?></span>
				                                <span class="d-none d-md-block"> <?php echo GetDateScFull($segment[0]->Origin->DepTime); ?></span>
				                              </div>
				                            </div>
				                            <div class="col-md-6 col-sm-6">
				                              <div class="flght-depart text-center">
				                                  <span class="d-block"><?php echo GetTime($segment[$segmentcount - 1]->Destination->ArrTime); ?></span>
				                                  <span class="d-none d-md-block"><?php echo GetDateScFull($segment[0]->Destination->ArrTime); ?></span>
				                              </div>
				                            </div>
				                            <div class="col-md-12 col-sm-4 col-4 d-none d-md-block">
				                              <div class="flght-de text-center">
				                                <span><?php echo $segment[0]->Origin->Airport->CityName; ?>, <?php echo $segment[0]->Origin->Airport->AirportCode; ?></span><i class="icofont-long-arrow-right"></i><span><?php echo $segment[$segmentcount-1]->Destination->Airport->CityName; ?>, <?php echo $segment[$segmentcount-1]->Destination->Airport->AirportCode; ?></span>
				                              </div>
				                            </div>
				                          </div>

				                          
				                        </div>
				                        
				                        <div class="col-md-2 col-sm-6 col-6 p-0">
				                          <div class="flght-duration text-center">
										  
				                            <span class="time-hour">
											
											 <?php
										if ($segmentcount > 1) {
											echo minute_to_hour($segment[$segmentcount - 1]->AccumulatedDuration);
										} else {
											echo minute_to_hour($segment[0]->Duration);
										}
										?>
											</span> <br/>
				                            <span class="fl-stop"> 
											<?php echo $segmentcount - 1; ?> Stop</span>
				                          </div>
				                        </div>
				                        <div class="col-md-2 col-sm-2 p-0">
				                          <div class="flht-ex text-center">
				                            <h3 class="airline_price mb-0">
				                              <?= getCurrencySymbol($current_currency) ?><span> <?php echo round($customer_fare/$total_pax); ?></span>
				                            </h3>
				                            <p class="detail_btn show_details_btn hidden-xs mb-0" id="show_details_btn" data-class="showdtail_3">
				                              <a href="javascript:void(0)" data-toggle="modal" data-target="#flight-details-left<?php echo $i ?>" class="btn-flght-details">Details</a>
				                            </p>
				                          </div>
				                        </div>
				                       
				                        <div class="clearfix"></div>
				                        <div class="airline_footer col-md-12">
				                          <ul class="list-inline clearfix mb-0">
				                            <li class="fare-rules list-inline-item float-left">
				                              <a href="#flght-rules<?php echo $i ?>" data-toggle="modal" onclick="getFareRulepoonam('<?php echo $traceID; ?>','<?php echo $airlineresults->ResultIndex; ?>','<?php echo $i ?>');" >
				                                <i class="icofont-hand-right"></i> Fare Rules
				                              </a>
				                            </li>
				                            
				                            <li class="refund float-right list-inline-item">
				                              
										 <?php
										  if ($airlineresults->IsRefundable == true) {
											  echo '<span class="pull-right refund">  Refundable</span>';

										  } else {
											  echo '<span class="pull-right nonrefund">  Non-Refundable</span>';
										  }

                              ?>
											  
				                            </li>
				                          </ul>
				                        </div>
				                      </div>						  
									  
				                    </div>
									
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
						
						
									
									
									<!-- Flight Details View -->
		<div class="modal fade" id="flight-details-left<?php echo $i ?>">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Flight Details</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						<div class="flt-details-wrap d-block">
							<nav>
							  <div class="nav nav-tabs" id="nav-tab" role="tablist">
								<a class="nav-item nav-link active" data-toggle="tab" href="#flight-details<?php echo $i ?>">Flight Details</a>
								<a class="nav-item nav-link" data-toggle="tab" href="#fare-details<?php echo $i ?>">Fare Details</a>
								<!--
								<a class="nav-item nav-link" data-toggle="tab" href="#cancellation-fee<?php echo $i ?>">Cancellation Fee</a>
								<a class="nav-item nav-link" data-toggle="tab" href="#date-change-fee<?php echo $i ?>">Date Change Fee</a>
								-->
								<a class="nav-item nav-link" data-toggle="tab" href="#baggage-details<?php echo $i ?>">Baggage Details</a>
							  </div>
							</nav>
							<div class="tab-content" id="nav-tabContent">
							  <div class="tab-pane fade show active" id="flight-details<?php echo $i ?>">
								<div class="flt-details-comm flt-oway-dts">
									<h6 class="dt"><?php echo date("D, j M Y", strtotime($search_data['depart_date']) ); ?></h6>
									<?php 
										foreach ($airlineresults->Segments as $type_keys=> $airlineresultsint){
										$count2seg = 0;
										foreach ($airlineresultsint as $seg => $segmentloop) {
											$count2seg++;
											$to_time = strtotime($segmentloop->Origin->DepTime);
											$from_time = strtotime($segmentloop->Destination->ArrTime);
											$minutess =  round(abs($to_time - $from_time) / 60,2);
											$hours = floor($minutess / 60).'H :'.($minutess -   floor($minutess / 60) * 60).'M';
											?>
											
									<!--======LAYOVER START=========-->	
									 <div class="col-md-12">
											   <?php if ($segmentcount  > 1 && $count2seg > 1)
												{
												 $arr_value1 = strtotime($airlineresultsint[$seg-1]->Destination->ArrTime);							
												 $dept_value1 = strtotime($segmentloop->Origin->DepTime);
												 $minutess1 =  round(abs($dept_value1 - $arr_value1) / 60,2);
												 $layover = floor($minutess1 / 60).'H :'.($minutess1 -   floor($minutess1 / 60) * 60).'M';												
												 ?>							 
										<span class="layover text-center d-block"> Layover:<?php echo $layover ?></span>
									 
										<?php }?>
									 </div>
									 <!--======LAYOVER END=========-->
											
									<div class="row">										
										<div class="col-md-3 col-sm-4 col-6">
											<div class="airline-logo fl-o-way-com">
												<span class="air-brand">
													<img src="<?php echo site_url(); ?>assets/images/airlines/<?php echo $segmentloop->Airline->AirlineCode; ?>.gif" />	
												</span>
												<h6><?php echo $segmentloop->Airline->AirlineName ?></h6>
												<span class="text-muted d-block"> <?php echo $segmentloop->Airline->AirlineCode . "-" . $segmentloop->Airline->FlightNumber; ?></span>
											</div>
										</div>
										<div class="col-md-2 col-sm-4 col-6">
											<div class="dep-dr fl-o-way-com">
												<h6><?php echo GetTime($segmentloop->Origin->DepTime); ?></h6>
											<span class="text-muted d-block"><?php echo $segmentloop->Origin->Airport->CityName; ?>, <?php echo $segmentloop->Origin->Airport->AirportCode; ?></span>
											</div>
										</div>
										<div class="col-md-2 col-sm-4 col-6">
											<div class="ari-dr fl-o-way-com">
												<h6><?php echo GetTime($segmentloop->Destination->ArrTime); ?></h6>
											<span class="text-muted d-block"><?php echo $segmentloop->Destination->Airport->CityName; ?>, <?php echo $segmentloop->Destination->Airport->AirportCode; ?></span>
											</div>
										</div>
										<div class="col-md-2 col-sm-4 col-6">
											<div class="ari-dr fl-o-way-com">
												<h6><?php echo $hours; ?> </h6>
												<span class="text-muted d-block flght-stop"></span>
											</div>
										</div>
										<div class="col-md-3 col-sm-4 col-6">
											<div class="rufundable fl-o-way-com">
												<h6>										
												<?php
                                                    if ($airlineresults->IsRefundable == true) {
													 echo '<span class="pull-right refund"> Refundable</span>';
                                                    } else {
														 echo '<span class="pull-right nonrefund"> Non-Refundable</span>';
												   }

                                                    ?>
												</h6>
												<span class="text-muted d-block flght-class"><?php echo $segmentloop->Airline->FareClass ?></span>
											</div>
										</div>
								

								</div>
								<?php }} ?>
								
								</div>
							  </div>
							  <div class="tab-pane fade" id="fare-details<?php echo $i ?>">
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
													<td><?= getCurrencySymbol($current_currency) ?> <?php echo number_format($baseFare); ?></td>
												</tr>
												<tr>
													<td>Airline Fuel Surcharges</td>
													<td><?= getCurrencySymbol($current_currency) ?> <?php echo number_format($taxvalue) ; ?></td>
												</tr>
												<tr>
													<th>Total</th>
													<th><?= getCurrencySymbol($current_currency) ?> <?php echo number_format($offerfareround); ?></th>
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
							 <div class="tab-pane fade" id="cancellation-fee<?php echo $i ?>">
								<div class="flt-details-comm flt-oway-dts">
									3
								</div>
							  </div>
							  <div class="tab-pane fade" id="date-change-fee<?php echo $i ?>">
								<div class="flt-details-comm flt-oway-dts">
									4
								</div>
							  </div>
							  -->
							  
							  <div class="tab-pane fade" id="baggage-details<?php echo $i ?>">
								<div class="flt-details-comm flt-oway-dts">
									Cabin Baggage : 
									<?php if($airlineresultsint[0]->CabinBaggage!=""){
										echo $airlineresultsint[0]->CabinBaggage ;
									 } else{ echo "0"; }?>
									
								</div>
								<div class="flt-details-comm flt-oway-dts">
									Check-In Baggage :
									<?php if($airlineresultsint[0]->Baggage!=""){
										echo $airlineresultsint[0]->Baggage ;
									 } else{ echo "0"; }?>
									
								</div>
							  </div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
															
								<!----Flight Details End---->
								
								
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
								
								 <?php  }}  ?>
								
								
								</div>
							<!--====End Oneway Flights=====-->



						<!--====Return Flights=====-->
							<div class="col-md-6">
									<div class="nxt-prev-btn clearfix mb-2 mb-md-3">
									 <?php $currdateret = $this->input->get("return_date");
									$yesterdayret = date('d-m-Y',strtotime($currdateret  . "-1 days"));	
									?> 
									 <a href="<?php echo site_url(); ?>flight/result?type=<?php echo $this->input->get("type"); ?>&from_location=<?php echo $this->input->get("from_location"); ?>&to_location=<?php echo $this->input->get("to_location"); ?>&to_city_code=<?php echo $this->input->get("to_city_code"); ?>&from_city_code=<?php echo $this->input->get("from_city_code"); ?>&depart_date=<?php echo $this->input->get("depart_date"); ?>&return_date=<?php echo $yesterdayret; ?>&no_adult=<?php echo $this->input->get("no_adult"); ?>&no_child=<?php echo $this->input->get("no_child"); ?>&no_infants=<?php echo $this->input->get("no_infants"); ?>&cabin_class=<?php echo $this->input->get("cabin_class"); ?>" class="btn btn-search float-left"><i class="icofont-swoosh-left"></i> Previous Day</a>

								<?php $tomorrowret = date('d-m-Y',strtotime($currdateret  . "+1 days")); ?>
								
								<a href="<?php echo site_url(); ?>flight/result?type=<?php echo $this->input->get("type"); ?>&from_location=<?php echo $this->input->get("from_location"); ?>&to_location=<?php echo $this->input->get("to_location"); ?>&to_city_code=<?php echo $this->input->get("to_city_code"); ?>&from_city_code=<?php echo $this->input->get("from_city_code"); ?>&depart_date=<?php echo $this->input->get("depart_date"); ?>&return_date=<?php echo $tomorrowret; ?>&no_adult=<?php echo $this->input->get("no_adult"); ?>&no_child=<?php echo $this->input->get("no_child"); ?>&no_infants=<?php echo $this->input->get("no_infants"); ?>&cabin_class=<?php echo $this->input->get("cabin_class"); ?>" class="btn btn-search float-right">Next Day <i class="icofont-swoosh-right"></i>  </a> </a>
									
									
					                </div>
					                <div class="flt-title-bar mb-3 mb-md-4">
					                	<div class="row">
					                		<div class="col-md-2 col-sm-6 col-6">
						                      <h5>Airline</h5>
						                    </div>
						                    <div class="col-md-3 col-sm-3 d-md-block d-none">
						                      <h5>Depart</h5>
						                    </div>
						                    <div class="col-md-3 col-sm-3 d-md-block d-none">
						                      <h5>Arrive</h5>
						                    </div>
						                    <div class="col-md-2 col-sm-2 d-md-block d-none">
						                      <h5>Duration</h5>
						                    </div>
						                    <div class="col-md-2 col-sm-6 col-6">
						                      <h5>Price</h5>
						                    </div>
						                </div>
					                </div>
					             
				<?php
                    if (isset($resultdata->Response->Results[1])) {
                    $ireturn = $i;
                    foreach ($resultdata->Response->Results[1] as $indexreturn=>$airlineresultsreturn) {
                        $ireturn++;
						
                        $segmentcountreturn = count($airlineresultsreturn->Segments[0]);
                       $segmentreturn = $airlineresultsreturn->Segments[0];
                        $farereturn = $airlineresultsreturn->Fare;
                        $offer_fare=$farereturn->OfferedFare;
                        $publish_fare=$farereturn->PublishedFare;
                        $dsa_data=$this->dsa_data;
                        $dsa_airline_code=$segmentreturn[0]->Airline->AirlineCode;
                        $baseFare_return = $farereturn->BaseFare;
                        $yq_fare_return = $farereturn->YQTax;
						
                        //$bp_fare_data=bp_get_fare($offer_fare,$publish_fare,$dsa_airline_code,$dsa_data,$baseFare_return,$yq_fare_return);
						
						 $bp_fare_data=bp_get_fare_without_markup($offer_fare,$publish_fare,$dsa_airline_code,$dsa_data,$baseFare_return,$yq_fare_return);
						
						
					    $dsa_fare=$bp_fare_data['dsa_fare']; 
                        $customer_fare=$bp_fare_data['customer_fare'];
						
                        // $dsa_fare=$offer_fare;
                        // $customer_fare=$publish_fare;
                        $baseFarereturn = $farereturn->BaseFare;
                        $offerfareroundreturn = round($customer_fare/$total_pax);
                        $taxvaluereturn = $offerfareroundreturn - $baseFarereturn;
                        $deptimereturn = TimeMinuts(GetTime($segmentreturn[0]->Origin->DepTime));
                        if(!isset($offerfareseelctedIB)){
                        	$offerfareseelctedIB = round($customer_fare);
                        }
                        if ($segmentcountreturn > 1) {
                            $stopsdurationreturn = $segmentreturn[$segmentcountreturn - 1]->AccumulatedDuration;
                            $arrtimereturn = TimeMinuts(GetTime($segmentreturn[$segmentcountreturn - 1]->Destination->ArrTime));
                        } else {
                            $stopsdurationreturn = $segmentreturn[0]->Duration;                            $arrtimereturn = TimeMinuts(GetTime($segmentreturn[0]->Destination->ArrTime));
                        }
                        $NonRefundablereturn = $airlineresultsreturn->IsRefundable;
                        if ($NonRefundablereturn == "1") {
                            $fareTypereturn = "Refundable";
                            $fareType12return = "Refundable";
                        } else {
                            $fareTypereturn = "Non Refundable";
                            $fareType12return = "NonRefundable";
                        }
                        ;
                        ?> 
						
						
						<div class="refendable11 flght-temp-col refendable11return" refendable="<?php echo $fareType12return; ?>">
						<div class="price1_ret" price="<?php echo $offerfareroundreturn; ?>" data-price="<?php echo $offerfareroundreturn; ?>" data-duration="<?php echo $stopsdurationreturn; ?>" data-arrtime="<?php echo $arrtimereturn; ?>" data-deptime="<?php echo $deptimereturn; ?>" >
						
                           <div class="price111 price111return deptime_ret" timedep="<?php $bbreturn=TimeMinuts(GetTime($segmentreturn[0]->Origin->DepTime)); echo $bbreturn;?>" timearr="<?php $bb=explode(":",GetTime($airlineresultsreturn->Segments[0][$segmentcountreturn-1]->Destination->ArrTime)); echo $bbreturn[0];?>">

                            <div class="flight11_ret" flight="<?php echo $segmentreturn[0]->Airline->AirlineName; ?>">
                               <div class="stopscount_ret" stop="<?php echo $segmentcountreturn - 1; ?>">
							   
						 <div id="selectreturn_<?php echo $indexreturn; ?>" class="airline row-areline-return selectairline  select_<?php echo $indexreturn; ?> selectreturn_<?php echo $indexreturn; ?>"  faretype="IB" flightindex="<?php echo $indexreturn; ?>" searchID ="<?php echo $searchID; ?>" fareprice="<?php echo $offerfareroundreturn; ?>" selectedair="selected" resultindex = "<?php echo $airlineresultsreturn->ResultIndex; ?>">
						
								 <div class="refendable11 flght-result-col domestic-flght-view">
				                      <div class="row airlines row-areline-return-dom row-areline-selected">
				                      	<div class="col-md-2 col-sm-12 p-0">
				                          <div class="flght-logo">
				                           <img src="<?php echo site_url(); ?>assets/images/airlines/<?php echo $airlineresultsreturn->AirlineCode; ?>.gif" alt="com-logo">
				                            <span class="text-center"><?php echo $segmentreturn[0]->Airline->AirlineCode . "-" . $segmentreturn[0]->Airline->FlightNumber; ?></span>
				                          </div>
				                        </div>
				                        <div class="col-md-6 col-sm-6 col-6">
				                          <div class="row">
				                            <div class="col-md-6 col-sm-6 col-4">
				                              <div class="flght-depart text-center">
				                                <span class="d-block"> <?php echo GetTime($segmentreturn[0]->Origin->DepTime); ?></span>
				                                <span class="d-none d-md-block"> <?php echo GetDateScFull($segmentreturn[0]->Origin->DepTime); ?></span>
				                              </div>
				                            </div>
				                            <div class="col-md-6 col-sm-6 col-4">
				                              <div class="flght-depart text-center">
				                                  <span class="d-block"><?php echo GetTime($segmentreturn[$segmentcountreturn - 1]->Destination->ArrTime); ?></span>
				                                  <span class="d-none d-md-block"><?php echo GetDateScFull($segmentreturn[0]->Destination->ArrTime); ?></span>
				                              </div>
				                            </div>
				                            <div class="col-md-12 col-sm-4 col-4 d-none d-md-block">
				                              <div class="flght-de text-center">
				                                <span><?php echo $segmentreturn[0]->Origin->Airport->CityName; ?>, <?php echo $segmentreturn[0]->Origin->Airport->AirportCode; ?></span><i class="icofont-long-arrow-right"></i><span><?php echo $segmentreturn[$segmentcountreturn-1]->Destination->Airport->CityName; ?>, <?php echo $segmentreturn[$segmentcountreturn-1]->Destination->Airport->AirportCode; ?></span>
				                              </div>
				                            </div>
				                          </div>

				                          
				                        </div>
				                        
				                        <div class="col-md-2 col-sm-6 col-6 p-0">
				                          <div class="flght-duration text-center">
				                            <span class="time-hour">
											<?php if ($segmentcountreturn > 1) {
											echo minute_to_hour($segmentreturn[$segmentcountreturn - 1]->AccumulatedDuration);
										} else {
											echo minute_to_hour($segmentreturn[0]->Duration);
										}
										?>
											</span> <br/>
				                            <span class="fl-stop"><?php echo $segmentcountreturn - 1; ?> Stop</span>
				                          </div>
				                        </div>
				                        <div class="col-md-2 col-sm-2 p-0">
				                          <div class="flht-ex text-center">
				                            <h3 class="airline_price mb-0">
				                              <?= getCurrencySymbol($current_currency) ?><span> <?php echo round($customer_fare/$total_pax) ?> </span>
				                            </h3>
				                            <p class="detail_btn show_details_btn hidden-xs mb-0" id="show_details_btn" data-class="showdtail_3">
				                              <a href="javascript:void(0)" data-toggle="modal" data-target="#flight-details-right<?php echo $ireturn?>" class="btn-flght-details">Details</a>
				                            </p>
				                          </div>
				                        </div>
				                       
				                        <div class="clearfix"></div>
				                        <div class="airline_footer col-md-12">
				                          <ul class="list-inline clearfix mb-0">
				                            <li class="fare-rules list-inline-item float-left">
				                              <a href="#flght-rules<?php echo $ireturn ?>" data-toggle="modal" onclick="getFareRulepoonam('<?php echo $traceID; ?>','<?php echo $airlineresultsreturn->ResultIndex; ?>','<?php echo $ireturn ?>');" >
				                                <i class="icofont-hand-right"></i> Fare Rules
				                              </a>
				                            </li>
				                            
				                            <li class="refund float-right list-inline-item">
				                             
											    <?php

                                            if ($airlineresultsreturn->IsRefundable == true) {
                                                echo '<span class="pull-right refund"> Refundable</span>';

                                            } else {
                                                echo '<span class="pull-right nonrefund"> Non-Refundable  </span>';										
                                            }

                                            ?>
											  
				                            </li>
				                          </ul>
				                        </div>
				                      </div>
				                    </div>
								
								</div>
								
							</div>
						</div>
					</div>
				</div>
			</div>							
								
								
									<!-- Flight Details View -->
		<div class="modal fade" id="flight-details-right<?php echo $ireturn ?>">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Flight Details</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						<div class="flt-details-wrap d-block">
							<nav>
							  <div class="nav nav-tabs" id="nav-tab" role="tablist">
								<a class="nav-item nav-link active" data-toggle="tab" href="#flight-details<?php echo $ireturn ?>">Flight Details</a>
								<a class="nav-item nav-link" data-toggle="tab" href="#fare-details<?php echo $ireturn ?>">Fare Details</a>
								<!--
								<a class="nav-item nav-link" data-toggle="tab" href="#cancellation-fee<?php echo $ireturn ?>">Cancellation Fee</a>
								<a class="nav-item nav-link" data-toggle="tab" href="#date-change-fee<?php echo $ireturn ?>">Date Change Fee</a>
								-->
								<a class="nav-item nav-link" data-toggle="tab" href="#baggage-details<?php echo $ireturn ?>">Baggage Details</a>
							  </div>
							</nav>
							<div class="tab-content" id="nav-tabContent">
							  <div class="tab-pane fade show active" id="flight-details<?php echo $ireturn ?>">
								<div class="flt-details-comm flt-oway-dts">
									<h6 class="dt"><?php echo date("D, j M Y", strtotime($search_data['return_date']) ); ?></h6>								
											
											<?php 
											foreach ($airlineresultsreturn->Segments as $type_keys=> $segmentreturn){
												$count2seg=0;
											foreach ($segmentreturn as $seg => $segmentloop)  {
												$count2seg++;
											$to_time = strtotime($segmentloop->Origin->DepTime);
											$from_time = strtotime($segmentloop->Destination->ArrTime);
											$minutess =  round(abs($to_time - $from_time) / 60,2);
											$hours = floor($minutess / 60).'H :'.($minutess -   floor($minutess / 60) * 60).'M';
											?>
											
												<!--======LAYOVER START=========-->	
										<div class="col-md-12">
											   <?php if ($segmentcountreturn  > 1 && $count2seg > 1)
												{
												 $arr_value1 = strtotime($segmentreturn[$seg-1]->Destination->ArrTime);							
												 $dept_value1 = strtotime($segmentloop->Origin->DepTime);
												 $minutess1 =  round(abs($dept_value1 - $arr_value1) / 60,2);
												 $layover = floor($minutess1 / 60).'H :'.($minutess1 -   floor($minutess1 / 60) * 60).'M';												
												 ?>							 
										<span class="layover text-center d-block"> Layover:<?php echo $layover ?></span>
									 
										<?php }?>
										</div>
									 <!--======LAYOVER END=========-->
									<div class="row">										
										<div class="col-md-3 col-sm-4 col-6">
											<div class="airline-logo fl-o-way-com">
												<span class="air-brand">
													<img src="<?php echo site_url(); ?>assets/images/airlines/<?php echo $segmentloop->Airline->AirlineCode; ?>.gif" />	
												</span>
												<h6><?php echo $segmentloop->Airline->AirlineName ?></h6>
												<span class="text-muted d-block"> <?php echo $segmentloop->Airline->AirlineCode . "-" . $segmentloop->Airline->FlightNumber; ?></span>
											</div>
										</div>
										<div class="col-md-2 col-sm-4 col-6">
											<div class="dep-dr fl-o-way-com">
												<h6><?php echo GetTime($segmentloop->Origin->DepTime); ?></h6>
											<span class="text-muted d-block"><?php echo $segmentloop->Origin->Airport->CityName; ?>, <?php echo $segmentloop->Origin->Airport->AirportCode; ?></span>
											</div>
										</div>
										<div class="col-md-2 col-sm-4 col-6">
											<div class="ari-dr fl-o-way-com">
												<h6><?php echo GetTime($segmentloop->Destination->ArrTime); ?></h6>
											<span class="text-muted d-block"><?php echo $segmentloop->Destination->Airport->CityName; ?>, <?php echo $segmentloop->Destination->Airport->AirportCode; ?></span>
											</div>
										</div>
										<div class="col-md-2 col-sm-4 col-6">
											<div class="ari-dr fl-o-way-com">
												<h6><?php echo $hours; ?> </h6>
												<span class="text-muted d-block flght-stop"></span>
											</div>
										</div>
										<div class="col-md-3 col-sm-4 col-6">
											<div class="rufundable fl-o-way-com">
												<h6>										
												<?php
                                                    if ($airlineresults->IsRefundable == true) {
													 echo '<span class="pull-right refund"> Refundable</span>';
                                                    } else {
														 echo '<span class="pull-right nonrefund"> Non-Refundable</span>';
												   }

                                                    ?>
												</h6>
												<span class="text-muted d-block flght-class"><?php echo $segmentloop->Airline->FareClass ?></span>
											</div>
										</div>
								

								</div>
											<?php } }?>
								
								</div>
							  </div>
							  <div class="tab-pane fade" id="fare-details<?php echo $ireturn ?>">
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
													<td><?= getCurrencySymbol($current_currency) ?> <?php echo number_format($baseFarereturn); ?></td>
												</tr>
												<tr>
													<td>Airline Fuel Surcharges</td>
													<td><?= getCurrencySymbol($current_currency) ?> <?php echo number_format($taxvaluereturn) ; ?></td>
												</tr>
												<tr>
													<th>Total</th>
													<th><?= getCurrencySymbol($current_currency) ?> <?php echo number_format($offerfareroundreturn); ?></th>
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
`							<div class="tab-pane fade" id="cancellation-fee<?php echo $ireturn ?>">
								<div class="flt-details-comm flt-oway-dts">
									3
								</div>
							  </div>
							  <div class="tab-pane fade" id="date-change-fee<?php echo $ireturn ?>">
								<div class="flt-details-comm flt-oway-dts">
									4
								</div>
							  </div>
							
								-->

							<div class="tab-pane fade" id="baggage-details<?php echo $ireturn ?>">
								<div class="flt-details-comm flt-oway-dts">
									Cabin Baggage : 
									<?php if($segmentreturn[0]->CabinBaggage!=""){
										echo $segmentreturn[0]->CabinBaggage ;
									 } else{ echo "0"; }?>
									
								</div>
								<div class="flt-details-comm flt-oway-dts">
									Check-In Baggage :
									<?php if($segmentreturn[0]->Baggage!=""){
										echo $segmentreturn[0]->Baggage ;
									 } else{ echo "0"; }?>
									
								</div>
								
								<!--<div class="flt-details-comm flt-oway-dts">
									Baggage : <?php echo $segmentreturn[0]->Baggage; ?>
								</div>-->
							  </div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>						
								
								<!----Flight Details End---->
								
					<!-- Fare Rules -->
					<div class="modal fade" id="flght-rules<?php echo $ireturn ?>">
						<div class="modal-dialog modal-lg">
						  <div class="modal-content">
						  
							<!-- Modal Header -->
							<div class="modal-header">
							  <h4 class="modal-title">Flight Rules</h4>
							  <button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>
							
							<!-- Modal body -->
							<div class="modal-body">
							
							  <span id="loadfarerule<?php echo $ireturn?>" style="text-center">
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
								
								
								 <?php  }}  ?>
								
								</div>
							
							<!--====Ends Return Flights=====-->
							
							</div>
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
	    <div class="modal-body">	   
		  
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
					  					<li class="list-inline-item <?php if($requestdata['type'] =='Return') { echo "active"; }  else {}?>" id="round-rad">
					  						<label for="round-trip" class="mb-0 flght-rad">
					  							<input type="radio" name="type" id="round-trip" value="Return" <?php if($requestdata['type'] =='Return') { echo "checked"; }?>>
					  							<span>Round Trip</span>
					  						</label>
					  					</li>
					  					<li class="list-inline-item <?php if($requestdata['type'] =='MultiWay') { echo "active"; }  else {}?>" id="multicity-rad">
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
								<input id="search_type" name="type" value="<?php echo $requestdata["type"];?>" class="custom-control-input" type="hidden">								
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
													<input placeholder="YYYY-MM-DD" type="text" name="depart_date" id="depart_date" class="form-control" value="<?php if($requestdata["type"] =='OneWay' || $requestdata["type"] =='Return'){ echo $search_data["depart_date"];} ?>" style="opacity:1">
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
					  											<label class="">Adult(12+ Yrs)</label>

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
												<label class="">Child(2-11 Yrs)</label>
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
												<label class="">Infant(Under 2 Yrs)</label>
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
														<input type="text" name="fromLocation_m[0]" id="tagfrom0_multicity" class="form-control flight_from1"  onkeyup="flight_suggest(this.value,1);" placeholder="From" autocomplete="off" required>
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
						  								<label class="" style="color:black;">Adult(s)(12+ Yrs)</label>
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
						  								<label class="" style="color:black;">Child(s)(2-11 Yrs)</label>
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
						  								<label class="" style="color:black;">Infant(s)(Under 2 Yrs)</label>
						  								<select name="no_infants" id="m-infant" class="form-control custom-select infent_select pop_select" required="required">
															<option value="0">0</option>
															<option value="1">1</option>
														</select>
						  							</div>
						  						</div>
						  						<div class="col-md-3 col-sm-6 col-6">
						  							<div class="form-group">
						  								<label class="" style="color:black;">Class</label>
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
 <!-- Modal  End Confirm Price-->
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

	<!-- Fixed Flight Footer -->
	<div id="foo-fixed-price-dom" class="footer-fixed-prc">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-5 col-md-5 border-right_l" id="bookingstripviewOB"></div>
				<div class="col-lg-5 col-md-5 border-right_l" id="bookingstripviewIB"></div>
				<div class="col-md-2 col-sm-12 col-12">
					<ul class="list-inline foo-fxd-book mb-0">
						<li class="ds-md-block total-amt">TOTAL AMOUNT</li>
						<li class="airline_price d-md-block" >
							<?= getCurrencySymbol($current_currency) ?>
							<span id="price_anim">
								<?php echo round(($offerfareseelctedOB+$offerfareseelctedIB)/$total_pax); ?> 
							</span>
						</li>
						<li class="bookbtn">
							<button 
								type="button" class="btn costom_site_color btn-com" id="returnBookingbtn" 
								tracid="<?php echo $traceID; ?>" 
								resultindexOB="<?php echo $airlineresults->ResultIndex; ?>" 
								resultindexIB="<?php echo $airlineresultsreturn->ResultIndex; ?>"
								searchid="<?php echo $searchID; ?>"> 
								Book 
							</button>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!-- Fixed Flight Footer end -->

<!--==BOOK -->
<script>

 $("#returnBookingbtn").click(function()
   {  

        $('#confirmprice').modal({backdrop: 'static'});

        $("#confirmprice").modal("show");

        var srdvType = $(this).attr("srdvtype");

        // var srdvIndexOB = $(this).attr("srdvindexob");

        // var srdvIndexIB = $(this).attr("srdvindexib");

        var traceID = $(this).attr("tracid");

        var resultIndexOB = $(this).attr("resultindexob");

        var sessionID = $(this).attr("searchid");

        var resultIndexIB = $(this).attr("resultindexib");

        $.ajax({

            type: "POST",

            url: "<?php echo site_url(); ?>flight/roundtrip_confirm_fare",

            data: {srdvType: srdvType,

					// srdvIndexOB: srdvIndexOB,

                   // srdvIndexIB: srdvIndexIB,

                   traceID: traceID, 

                   resultIndexOB: resultIndexOB,

                   resultIndexIB: resultIndexIB,

                   sessionID: sessionID,                   

               },

            dataType: "text",

            cache: false,

            success:

                    function (data) {

                         

                        console.log(data);

                        $("#confirmprice").modal("hide");



                        if (data == "true") {

                           location.href = "<?php echo site_url(); ?>flight/booking_detail?seesionid=" + sessionID;

                        } else {

                            $("#confirmerror").modal("show");

                        }

                    }

        });

        return false;

    })

</script>

<script>
//DATEPICKER

$(function () {

	$('#depart_date').datepicker({

		numberOfMonths: 1,

		dayNamesMin: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],

		"minDate": 0,

		showOn: 'both',

		buttonText: '',

		dateFormat: 'dd-mm-yy',

		beforeShow: function() {          

		},

		onSelect: function (selectedDate)

		{   
			$('#ui-datepicker-div').addClass("searchdatepicker");
			$("#return_date").datepicker("option", "minDate", selectedDate);

		}

	});

	$('#return_date').datepicker({

		numberOfMonths: 1,

		dayNamesMin: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],

		"minDate": "<?php echo $this->input->get("depart_date"); ?>",

		showOn: 'both',

		dateFormat: 'dd-mm-yy',

		buttonText: '',

		beforeShow:function(){  

			// alert();
			$('#ui-datepicker-div').addClass("searchdatepicker");
			$('#returnid').prop("checked", true);

			$('#onwayid').prop("checked", false);

			$('#return_datebox').css("opacity","1");
			
		}

	});
});

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
</script>

<!---->


<script>
//======Reset All====		
		 $(".reset").click(function () {
			  $(".price1").each(function () {
                  $(this).show();                    

                    }); 			 
		 });
		//===
  $( function() {
		var maxv= $('#pricep').attr("data-slider-max");
		var vali= $('#pricep').attr("data-slider-value");
    $( "#slider-range" ).slider({
      range: true,
      min: <?php echo $pricefiltermin ; ?>,
      max: <?php echo $pricefiltermax ; ?>,
       values: [ <?php echo $pricefiltermin ; ?>, <?php echo $pricefiltermax ; ?> ],
      slide: function( event, ui ) {
        //$( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
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

  select_airline("OB","<?php echo $searchID; ?>","<?php echo $offerfareseelctedOB; ?>","<?php echo $selectedResultindexOB; ?>");

    select_airline("IB","<?php echo $searchID; ?>","<?php echo $offerfareseelctedIB; ?>","<?php echo $selectedResultindexIB; ?>");
  
  
  </script>

<!---NEW SCRIPT====--->

<script>
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

                

                $(".search-results-title-onword").html('<b>'+count_bhanu+'</b> Onward Flights');

                

                $(".refendable11return").each(function () {

                    if ($("div:visible", this).length > 10)

                    {

                        count_bhanuret = count_bhanuret + 1;

                    }

                });

                 $(".search-results-title-return").html('<b>'+count_bhanuret+'</b> Return Flights');

                $("#form_submit_pop_over").modal("hide");

            });

        }); 

//

$(".flightso").click(function () {
            //$("#form_submit_pop_over").modal("show");
            if ($(this).val() == "0")
            {
                $(this).val("1");
            } else
            {       
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
                $(".search-results-title-onword").html('<b>'+count_bhanu+'</b> Onward Flights');               
                

            $("#form_submit_pop_over").modal("hide");

        });
		
		
////===============DEPARTURE Time
 
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
			// var time3=  (hours1*60) + minutes1 ;
			// var time4=  (hours2*60) + minutes2 ;
			
			var i=0;
			var j=0;
			
			$(".price111onword").each(function(){
			if($(this).attr("timedep")<ui.values[ 0 ] || $(this).attr("timedep")>ui.values[ 1 ])
			//if($(this).attr("timedep")< time3 || $(this).attr("timedep")>(time4))
			{
			$(this).hide();
			}
			if($(this).attr("timedep")>ui.values[ 0 ] && $(this).attr("timedep")<ui.values[ 1 ])
			//if($(this).attr("timedep")> time3 && $(this).attr("timedep")<time4)
			{
			$(this).show();
			}
			});	 
		}
		});	
		$('#timep1').val(hours1+':'+minutes1+' - '+hours2+':'+minutes2 );
		
		// $( "#timep1" ).val( $( "#slider-range_onward" ).slider( "values", 0 ) +
			 // " - " + $( "#slider-range_onward" ).slider( "values", 1 ) );
		
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
 
 		

</script>

<!---===RETURN FLIGHT FILTER==--->
<script>
$(function () {
            $(".flightstop_return").click(function () {             
                if ($(this).attr("check_see") == "0")
                {
                    $(this).attr("check_see", "1");
                } else
                {
                    $(this).attr("check_see", "0");
                }
                var stops1 = "";
                $(".flightstop_return").each(function () {
                    if ($(this).attr("check_see") == "1")
                    {
                        stops1 = $(this).val();
                        $(".stopscount_ret").each(function () {
                            if (stops1 == $(this).attr("stop"))
                            {
                                $(this).show();
                            }
                        });
                    } else
                     {
                        var stops2 = $(this).val();
                        $(".stopscount_ret").each(function () {
                            if (stops2 == $(this).attr("stop"))
                            {
                                $(this).hide();
                            }
                        });
                   }
                });
                if (stops1 == "")
               {
                    $(".stopscount_ret").each(function () {
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
                $(".search-results-title-onword").html('<b>'+count_bhanu+'</b> Onward Flights');
                $(".refendable11return").each(function () {
                    if ($("div:visible", this).length > 10)
                    {
                       count_bhanuret = count_bhanuret + 1;
                    }
                });
                 $(".search-results-title-return").html('<b>'+count_bhanuret+'</b> Return Flights');
                $("#form_submit_pop_over").modal("hide");
            });
        }); 
		
$(".flightso_ret").click(function () {
            if ($(this).val() == "0")
            {
               $(this).val("1");
            } else
            {
               $(this).val("0");
            }
            var stops1 = "";
            $(".flightso_ret").each(function () {
                if ($(this).val() == "1")
                {
                    stops1 = $(this).attr("value_for_short");
                    $(".flight11_ret").each(function () {
                        if (stops1 == $(this).attr("flight"))
                        {
                            $(this).show();
                        }
					});
                } else
                {
                    var stops2 = $(this).attr("value_for_short");
                    $(".flight11_ret").each(function () {
                        if (stops2 == $(this).attr("flight"))
                        {
                            $(this).hide();
                        }
                    });
                }
            });
            if (stops1 == "")
            {
                $(".flight11_ret").each(function () {
                    $(this).show();
                });
            }
            var count_bhanu=0;
            var count_bhanuret=0;
			// $(".refendable11onword").each(function () {
                    // if ($("div:visible", this).length > 10)
                    // {
                        // count_bhanu = count_bhanu + 1;
                    // }
                // });             

                // $(".search-results-title-onword").html('</i>Onword - <b>'+count_bhanu+'</b> Flights');
                $(".refendable11return").each(function () {
                    if ($("div:visible", this).length > 10)
                    {
                        count_bhanuret = count_bhanuret + 1;
                    }
                });
                 $(".search-results-title-return").html('<b>'+count_bhanuret+'</b> Return Flights');
				$("#form_submit_pop_over").modal("hide");
        });		
	
 $( function() {
		var maxv= $('#pricep').attr("data-slider-max");
		var vali= $('#pricep').attr("data-slider-value");
    $( "#slider-range_ret" ).slider({
      range: true,
      min: <?php echo $pricefiltermin ; ?>,
      max: <?php echo $pricefiltermax ; ?>,
       values: [ <?php echo $pricefiltermin ; ?>, <?php echo $pricefiltermax ; ?> ],
      slide: function( event, ui ) {        
       $( "#amount_ret" ).val( "<?php echo $js_currency_symbol; ?> " + ui.values[ 0 ]  );
       $( "#amount-sec_ret" ).val( "<?php echo $js_currency_symbol; ?> " + ui.values[ 1 ] );
		
		var i=0;
		var j=0;
		$(".price1_ret").each(function(){
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
    $( "#amount_ret" ).val( "<?php echo $js_currency_symbol; ?> " + $( "#slider-range_ret" ).slider( "values", 0 ));
    $( "#amount-sec_ret" ).val( "<?php echo $js_currency_symbol; ?> " + $( "#slider-range_ret" ).slider( "values", 1 ) );
  } );	
	
$(function() {
		$( "#time_slider_ret" ).slider({
			 // range:true,
			 // min: 0,
			 // max: 23,
			 // values: [ 0, 23 ],
			 // slide: function( event, ui ) {
			// $( "#timep1_ret" ).val( ui.values[ 0 ] +"  - " + ui.values[ 1 ] );
			range: true,
			min: 0,
			max: 1440,
			step: 15,
			values: [ 0, 1440 ],
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
				
			$('#timep1_ret').val(hours1+':'+minutes1+' - '+hours2+':'+minutes2 );
			var time1 = hours1 +':'+ minutes1 ; 
			var time2=  hours2+':'+ minutes2;
			
			var time3=  (hours1*60) + minutes1 ;
			var time4=  (hours2*60) + minutes2 ;
			var i=0;
			var j=0;
			$(".price111return").each(function(){
			if($(this).attr("timedep")<ui.values[ 0 ] || $(this).attr("timedep")>ui.values[ 1 ])
			//if($(this).attr("timedep")< time3 || $(this).attr("timedep")>(time4))
			{
			$(this).hide();
			}
			if($(this).attr("timedep")>ui.values[ 0 ] && $(this).attr("timedep")<ui.values[ 1 ])
			//if($(this).attr("timedep")> time3 && $(this).attr("timedep")<time4)
			{
			$(this).show();
			}
			});	 
		}
		});	
		//$( "#timep1_ret" ).val( $( "#time_slider_ret" ).slider( "values", 0 ) +
			// " - " + $( "#time_slider_ret" ).slider( "values", 1 ) );
		$('#timep1_ret').val(hours1+':'+minutes1+' - '+hours2+':'+minutes2 );
			 
	 });	

 $('.departtym_ret').click(function(e){
	    var str=$(this).val();
		$('.tymlab_ret').removeClass('active');
		$(this).parent().addClass('active');
        var res = str.split("-");       
        if($(this).prop("checked") == true){	   
		    $(".price111return").each(function(){
		    	if($(this).attr("timedep")>=res[0] && $(this).attr("timedep")<=res[1])
				{
					$(this).show();
				} else {
					$(this).hide();
				}
			});	
		} else {
			$(".price111return").show();
		}
    });

</script>


