<?php $this->load->view('include/head') ?>
<?php $this->load->view('include/header');

	$this->load->view('css');
	$airline_list = array();
	$segmentcount = 0;
	foreach ($resultdata->Results[0] as $k => $airlineresultsprice) {
		$segmentf = $airlineresultsprice->Segments [0] [0];
		if (!in_array($segmentf->Airline->AirlineName, $airline_list)) {
			$airline_list [$segmentf->Airline->AirlineCode] = $segmentf->Airline->AirlineName;
		}
		$segment_get = $airlineresultsprice->Segments[0];
		$fare_get =$airlineresultsprice->Fare;
		$offerfare_get = $fare_get->OfferedFare;
		$PublishedFare_get = $fare_get->PublishedFare;
		$dsa_data_get=$this->dsa_data;
		$dsa_airline_code_get=$segment_get[0]->Airline->AirlineCode;
    $baseFare_get = $fare_get->BaseFare;
    $yq_fare_get = $fare_get->YQTax;
    $bp_fare_data_get=bp_get_fare($offerfare_get,$PublishedFare_get,$dsa_airline_code_get,$dsa_data_get,$baseFare_get, $yq_fare_get);
        $dsa_fare_get=$bp_fare_data_get['dsa_fare'];
        $customer_fare_get=$bp_fare_data_get['customer_fare'];
		$all_price[] = $customer_fare_get;
		//$all_price[] = $airlineresultsprice->Fare->OfferedFare;

		$segmentcount = count($airlineresultsprice->Segments[0]);
		if($requestdata['type'] =='Return'){
		   $segmentcount1 = count($airlineresultsprice->Segments[1]);
		}
	}
	$srdvType = $resultdata->SrdvType;
	$traceID = $resultdata->TraceId;
	$_SESSION["traceID"] = $traceID;
	$_SESSION["srdvTrype"] = $srdvType;
	$pricefiltermin = (min($all_price));
	$pricefiltermax = (max($all_price));
	$search_data=$_SESSION ['flight'] [$searchID] ['search_RequestData'];

	
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
// print_r($search_data);
 // die;
  ?>
	

	<style>
	.ui-datepicker-trigger{display:none;}
	.suggestionsBox {
    position: absolute;
    padding: 0px;
    background-color: #FFFFFF !important;
    /* border-top: 1px solid #FDFDFD; */
    color: #3C8DBC;
    z-index: 2;
    height: auto;
    max-height: 200px;
    overflow-y: scroll;
    box-shadow: 0px 3px 7px 2px #C1C1C1;
    margin: 0px 0px 0px 0px;
	}

	.suggestionList ul {
		padding: 0px;
	}

	.suggestionList ul li {
		list-style: none !important;
		margin: 0px;
		padding: 6px 15px !important;
		border-bottom: 1px solid #E4E0E0;
		cursor: pointer;
		color: #333;
	}

	.display_inline{
		display:inline;
	}
	.display_none{
		display:none;
	}

	samp {
    font-family: unset !important;
	}
	
	.text-align-center{
		text-align:center;
	}
.dpart-d-rdonl[readonly]{
	background:white;
}

.ui-autocomplete-input {
  border: none; 
  font-size: 14px;
  width: 100%;
  height: 40px;
  padding-top: 2px;
  border: 1px solid #DDD !important;
  padding-top: 0px !important;
  z-index: 1511;
  position: relative;
}
.ui-menu .ui-menu-item a {
  font-size: 12px;
}
.ui-autocomplete {
  position: absolute;
  top: 100%;
  left: 0;
  z-index: 1051 !important;
  float: left;
  display: none;
  min-width: 160px;
  _width: 160px;
  padding: 4px 0;
  margin: 2px 0 0 0;
  list-style: none;
  background-color: #ffffff;
  border-color: #ccc;
  border-color: rgba(0, 0, 0, 0.2);
  border-style: solid;
  border-width: 1px;
  -webkit-border-radius: 2px;
  -moz-border-radius: 2px;
  border-radius: 2px;
  -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
  -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
  -webkit-background-clip: padding-box;
  -moz-background-clip: padding;
  background-clip: padding-box;
  *border-right-width: 2px;
  *border-bottom-width: 2px;
}
.ui-menu-item > a.ui-corner-all {
    display: block;
    padding: 3px 15px;
    clear: both;
    font-weight: normal;
    line-height: 18px;
    color: #555555;
    white-space: nowrap;
    text-decoration: none;
}
.ui-state-hover, .ui-state-active {
      color: #ffffff;
      text-decoration: none;
      background-color: #0088cc;
      border-radius: 0px;
      -webkit-border-radius: 0px;
      -moz-border-radius: 0px;
      background-image: none;
}
#modalIns{
    width: 500px;
}
.hot-page2-alp-l3 ul li label {
    display: block;
    font-size: 15px;
    color: #343c42;
    font-weight: 600;
    padding-left: 7px;
    /* border: 1px solid #cecaca; */
    margin: 0 2px 5px;
}
.btn-is-disabled{
	opacity:0.5;
}
.txt-tc li:not(:last-child):after{
	display:none;
}
	</style>


   <!-- Search Result info -->
	<?php if($search_data["type"] == 'MultiWay'){
		for($aa=0;$aa < count($search_data["fromLocation_m"]);$aa++){
if ($search_data["fromLocation_m"][$aa] != "" ) {
                  if($aa == 0){  
		
		?>  
               <div class="search-result-info">
                <div class="container">
                    <div class="row">
                      <!-- Flight Details Start & End -->
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="flght-start-end">
                          <ul class="list-inline clearfix">   
						<?php 	$from_data=explode(',',$search_data['fromLocation_m'][$aa]);
								$to_data=explode(',',$search_data['toLocation_m'] [$aa]);
			
								?>						  
							<li>                          
							   <h4><?php echo $from_data[1] ?></h4>
                              <p class="airline"><?php echo $search_data["fromLocation_m"][$aa] ?></p>						  
							</li>
                            <li>
                             <h4><?php echo $to_data[1] ?></h4>
                              <p class="airline"><?php echo $search_data['toLocation_m'][$aa] ?></p>
							  </li>
							
							 <?php } else { ?>							 
							 <?php $from_data=explode(',',$search_data['fromLocation_m'][$aa]);	
								$to_data=explode(',',$search_data['toLocation_m'][$aa]); ?>
								<li>                          
							   <h4><?php echo $from_data[1] ?></h4>
                              <p class="airline"><?php echo $search_data["fromLocation_m"][$aa] ?></p>						  
							</li>
							 <li>
							 <h4><?php echo $to_data[1] ?></h4>
                              <p class="airline"><?php echo $search_data['toLocation_m'][$aa] ?></p>
							
						</li>
		<?php } } } ?>
                          </ul>
                        </div>
                      </div>
                      <!-- Flight Details Start & End -->

                      <!-- Flight Search Date -->
                      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="search-flght-date pos-rv">
                          <div class="cl-fgt pos-ab">
                            <i class="icofont-calendar"></i>
                          </div>
                          <ul class="p-0 list-inline">
                            <li>ONWARD  <small><?php echo date("D, j M Y", strtotime($search_data['dept_date_m'][0]) ); ?></small></li>
                  
                          </ul>
                          <div class="flght-psg-deails">
                            <span>ADULTS <strong><?php echo $search_data['no_adult']; ?></strong></span>
                            <span>CHILD <strong><?php echo $search_data['no_child']; ?></strong></span>
                            <span>INFANT <strong><?php echo $search_data['no_infants']; ?></strong></span>
                            <span>All <strong><?php echo $search_data['no_adult'] + $search_data['no_child'] + $search_data['no_infants']; ?></strong></span>
                          </div>
                        </div>
                      </div><!--/ Flight Search Date End -->

                      <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                        <div class="modify-srearch-btn">
                          <button type="" data-toggle="modal" data-target="#modify_search" class="btn costom_site_color btn">Modify Search</button>
                        </div>
                      </div>

                    </div>
                </div>
              </div>
	
	<?php } else{ ?>
	<div class="search-result-info">
                <div class="container">
                    <div class="row">
                      <!-- Flight Details Start & End -->
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="flght-start-end">
                          <ul class="list-inline clearfix">
                    <?php $from_data=explode(',',$search_data['from_location']);
                        $to_data=explode(',',$search_data['to_location']); ?>
                            <li>
                              <h4><?php echo $from_data[1] ?></h4>
                              <p class="airline"><?php echo $from_data[0] ?></p>
                            </li>
                            <li>
                              <h4><?php echo $to_data[1] ?></h4>
                              <p class="airline"><?php echo $to_data[0] ?></p>
                            </li>
                          </ul>
                        </div>
                      </div>
                      <!-- Flight Details Start & End -->

                      <!-- Flight Search Date -->
                      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="search-flght-date pos-rv">
                          <div class="cl-fgt pos-ab">
                            <i class="icofont-calendar"></i>
                          </div>
                          <ul class="p-0 list-inline">
                            <li>ONWARD  <small><?php echo date("D, j M Y", strtotime($search_data['depart_date']) ); ?></small></li>
                    <?php if($search_data['type'] =="Return") {?>
                      <li>RETURN <small><?php echo date("D, j M Y", strtotime($search_data['return_date']) ); ?></small></li>
                    <?php } ?>
                          </ul>
                          <div class="flght-psg-deails">
                            <span>ADULTS <strong><?php echo $search_data['no_adult']; ?></strong></span>
                            <span>CHILD <strong><?php echo $search_data['no_child']; ?></strong></span>
                            <span>INFANT <strong><?php echo $search_data['no_infants']; ?></strong></span>
                            <span>All <strong><?php echo $search_data['no_adult'] + $search_data['no_child'] + $search_data['no_infants']; ?></strong></span>
                          </div>
                        </div>
                      </div><!--/ Flight Search Date End -->

                      <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                        <div class="modify-srearch-btn">
                          <button type="" data-toggle="modal" data-target="#modify_search" class="btn costom_site_color btn">Modify Search</button>
                        </div>
                      </div>

                    </div>
                </div>
              </div>
	<?php }?>
			  <!-- Search Result info End --> 
	
<div class="main-field" ng-app="myApp" ng-controller="myCtrl">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-3 col-sm-12 sidebar-wrap" id="filter_xs_slide">
            <div class="filter-search-bar">
              <div class="flight_count search-results-title">
              	<!-- <h5>75 Flights Found.</h5> -->
              </div>
              <div class="sidebar_title">Search Filter</div>
			  <div class="row price_filter">
              	<div class="row_sidebar_title">
              		<h4><i class=""><?php echo $this->bp_white_label_setting->wls_currency_symbol;?></i> Price</h4>
              	</div>
              	<div class="row_sidebar_contant range-slider">
                  <div class="collapse in " id="price">
                    <div class="inp-rng-wrap"><input type ="text" id ="pricep" readonly> </div>
                    <div id="slide1f"></div>
              	</div>
              </div>
              </div>

               <div class="row price_filter">
              	<div class="row_sidebar_title">
              		<h4><i class="icofont-clock-time"></i> Depart</h4>
              	</div>
              	<div class="row_sidebar_contant range-slider">
                  <div class="collapse in" id="time_collapse">
                    <div class="inp-rng-wrap"><input type="text"  id="timep1" readonly></div>
			  <div class="clearfix"></div>
              <div id="time-range1"></div>
			 </div>
              	</div>
              </div>

              <div class="row price_filter">
                    <div class="row_sidebar_title">
                        <h4><i class="icofont-money-bag"></i> Fare Type <span class="pull-right"></span></h4>
                    </div>
                    <div class="row_sidebar_contant">
					<form>
						<div class="checkbox cstm-check">
							<label><input type="checkbox" class="flightfare" value="Refundable" check_see="0"><span>Refundable </span></label>
						</div>
						<div class="checkbox cstm-check">
							<label><input type="checkbox" class="flightfare" value="NonRefundable" check_see="0">
                <span>Non Refundable</span> </label>
						</div>
					</form>
                    </div>
                </div>
                <div class="row price_filter">
                    <div class="row_sidebar_title">
                        <h4><i class="icofont-google-map"></i> Stop <span class="pull-right"></span></h4>
                    </div>
                    <div class="row_sidebar_contant">
						<form>
								<?php for ($i = 0; $i <= $segmentcount; $i++) { ?>
									<div class="checkbox cstm-check">
										<label><input class="flightstop" type="checkbox" check_see="0" value="<?php echo $i; ?>">
                      <span>
										<?php
											if ($i == 0) {
												echo "Non";
											} else {
												echo $i;
											}
											?> Stop </span></label>
									</div>
								<?php } ?>
						</form>
                    </div>
                </div>
                <div class="row price_filter">
                    <div class="row_sidebar_title">
                        <h4><i class="icofont-airplane-alt"></i> Airlines <span class="pull-right"></span></h4>
                    </div>
                    <div class="row_sidebar_contant">
                        <form>
						
						<?php	foreach ($airline_list as $airlinekey => $airline_lists) {	?>

							<div class="checkbox cstm-check">
								<label> <input  class="flightso"  type="checkbox" value="0" value_for_short ="<?php echo $airline_lists; ?>"><span><?php echo $airline_lists; ?></span></label>
							</div>

						<?php } ?>
							
                        </form>
                    </div>
                </div>
            </div>
            <a href="#" id="filter_click_submit" class="btn search-btn hidden xs-show filter_click_submit"><i class="icofont-filter"></i> Show Result</a>
          </div>
          <div class="col-lg-9 col-md-9 col-sm-12" id="">
            <div class="flght-search-result-right">

               <!-- Next Prev Button -->

              <div class="nxt-prev-btn clearfix mb-15 text-center">
                        <?php $currdate = $this->input->get("depart_date");
                    $yesterday = date('d-m-Y',strtotime($currdate  . "-1 days"));?>
<?php if($search_data["type"] != 'MultiWay'){ ?>
                  <a href="<?php echo site_url(); ?>flight/result?type=<?php echo $this->input->get("type"); ?>&from_location=<?php echo $this->input->get("from_location"); ?>&to_location=<?php echo $this->input->get("to_location"); ?>&from_country=<?php echo $this->input->get("from_country"); ?>&to_country=<?php echo $this->input->get("to_country"); ?>&to_city_code=<?php echo $this->input->get("to_city_code"); ?>&from_city_code=<?php echo $this->input->get("from_city_code"); ?>&depart_date=<?php echo $yesterday; ?>&return_date=&no_adult=<?php echo $this->input->get("no_adult"); ?>&no_child=<?php echo $this->input->get("no_child"); ?>&no_infants=<?php echo $this->input->get("no_infants"); ?>&cabin_class=<?php echo $this->input->get("cabin_class"); ?>&preferred_airline=<?php echo $this->input->get("preferred_airline"); ?>" class="btn-org btn-flght pull-left nt-xs"><i class="icofont-swoosh-left"></i> <span>Previous Day</span></a>
<?php } ?>  
                    <a href="javascript:void" id="filter_btn" class="btn-org btn-flght hidden xs-show filter-btn"><i class="icofont-filter"></i> Filter</a>

                  <?php 
                    $tomorrow = date('d-m-Y',strtotime($currdate  . "+1 days")); ?>
<?php if($search_data["type"] != 'MultiWay'){ ?>
                  <a href="<?php echo site_url(); ?>flight/result?type=<?php echo $this->input->get("type"); ?>&from_location=<?php echo $this->input->get("from_location"); ?>&to_location=<?php echo $this->input->get("to_location"); ?>&from_country=<?php echo $this->input->get("from_country"); ?>&to_country=<?php echo $this->input->get("to_country"); ?>&to_city_code=<?php echo $this->input->get("to_city_code"); ?>&from_city_code=<?php echo $this->input->get("from_city_code"); ?>&depart_date=<?php echo $tomorrow; ?>&return_date=&no_adult=<?php echo $this->input->get("no_adult"); ?>&no_child=<?php echo $this->input->get("no_child"); ?>&no_infants=<?php echo $this->input->get("no_infants"); ?>&cabin_class=<?php echo $this->input->get("cabin_class"); ?>&preferred_airline=<?php echo $this->input->get("preferred_airline"); ?>" class="btn-flght bext-btn pull-right nt-xs"> <i class="icofont-swoosh-right"></i> <span>Next Day</span> </a>
<?php } ?> 
                </div><!-- Next Prev Button End -->	

               	<!-- Airline title -->
               	<div class="airline_title">
               		<div class="row">
               			<div class="col-md-2 col-sm-2 col-xs-2">
               				<h5>Airline</h5>
               			</div>
               			<div class="col-md-2 col-sm-2 col-xs-2">
               				<h5><a href="javascript:void(0s)">Depart</a></h5>
               			</div>
               			<div class="col-md-2 col-sm-2 col-xs-2">
               				<h5><a href="javascript:void(0s)">Arrive</a></h5>
               			</div>
               			<div class="col-md-2 col-sm-2 col-xs-2">
               				<h5><a href="javascript:void(0s)">Duration</a></h5>
               			</div>
               			<div class="col-md-2 col-sm-2 col-xs-2">
               				<h5><a href="javascript:void(0s)">Price</a></h5>
               			</div>
               			<!--<div class="col-md-2 col-sm-2 col-xs-2">
               				<h5><a href="javascript:void(0s)">SNF</a></h5>
               			</div>-->
               		</div>
               	</div><!-- Airline title End -->
				
			<!-- Flight Details -->
			<?php
                if (isset($resultdata->Results[0])) {
                    $i = 0;
                    foreach ($resultdata->Results[0] as $airlineresults) {
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
            			$bp_fare_data=bp_get_fare($offer_fare,$publish_fare,$dsa_airline_code,$dsa_data,$baseFare,$yq_fare);
            			$dsa_fare=$bp_fare_data['dsa_fare'];
                        $customer_fare=$bp_fare_data['customer_fare'];

                        $baseFare = dsa_currency_convert($fare->BaseFare);
                        $offerfareround = ($customer_fare);
                        $taxvalue = $offerfareround - $baseFare;
                        $deptime = TimeMinuts(GetTime($segment[0]->DepTime));
                        if ($segmentcount > 1) {

                            $stopsduration = $segment[$segmentcount - 1]->AccumulatedDuration;

                            $arrtime = TimeMinuts(GetTime($segment[$segmentcount - 1]->ArrTime));
                        } else {

                            $stopsduration = $segment[0]->Duration;
                            $arrtime = TimeMinuts(GetTime($segment[0]->ArrTime));
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
                        ?> 
                        <div class="refendable11 refendable11onword" refendable="<?php echo $fareType12; ?>">
                            <div class="price1" price="<?php echo $offerfareround; ?>" 
                                 data-price="<?php echo $offerfareround; ?>" 
                                 data-duration="<?php echo $stopsduration; ?>"
                                 data-arrtime="<?php echo $arrtime; ?>"
                                 data-deptime="<?php echo $deptime; ?>"
                                 >

                                <div class="price111 price111onword" timedep="<?php $bb = explode(":", GetTime($segment[0]->DepTime));
                echo $bb[0]; ?>" timearr="<?php $bb = explode(":", GetTime($airlineresults->Segments[0][$segmentcount - 1]->ArrTime));
                echo $bb[0]; ?>">
                                    <div class="flight11" flight="<?php echo $segment[0]->Airline->AirlineName; ?>">
                                        <div class="stopscount" stop="<?php echo $segmentcount - 1; ?>">

				<div class=" flght-result-col">
               		<div class="row airlines">
               			<div class="col-md-8 col-sm-8 col-xs-8 price1 no-padding-xs">
               				
							   <?php foreach ($airlineresults->Segments as $type_key =>$segmentsints) { 
								   $segmentcountint = count($segmentsints);
								?>
								<div class="clearfix">
								<div class="col-md-2 col-sm-3 col-xs-3 no-padding-xs pl-0">
               						<img src="<?php echo site_url()?>assets/images/airlines/<?php echo $segmentsints[0]->Airline->AirlineCode; ?>.gif" alt="com-logo">
               						<span class="text-center"><?php echo $segmentsints[0]->Airline->AirlineCode . "-" . $segmentsints[0]->Airline->FlightNumber; ?></span>
               					</div>

               					
								<div class="txt-tc col-md-7 col-sm-6 col-xs-6 no-padding-xs pl-10-xs tm-dru-wrap">
               						<ul class="list-inline">
               							<li class="dep-dt">
               								<!-- <span> 00:05</span> -->
               								<span class=""> <?php echo GetTime($segmentsints[0]->DepTime); ?><br><small><?php echo GetDateScFull($segmentsints[0]->DepTime); ?></small></span>
											   
               								</li>
               							<li class="arv-dt">
               								<!-- <span>04:10</span> -->
               								<span class=""> <?php echo GetTime($segmentsints[$segmentcountint - 1]->ArrTime); ?><br><small class=""><?php echo GetDateScFull($segmentsints[$segmentcountint - 1]->ArrTime); ?></small></span>
											   
               								</li>
										<li class="ds-block">
										<?php if ($segmentcountint > 0) { ?>
												<p>
													<?php
													foreach ($segmentsints as $countseg => $segmentsmulti) {
														if ($countseg == 0) {
															?> 
															<span><?php echo $segmentsmulti->Origin->AirportCode; ?></span><i class="icofont-long-arrow-right"></i><span><?php echo $segmentsmulti->Destination->AirportCode; ?></span></span>
															<?php } else { ?>
															<i class="icofont-long-arrow-right"></i><span><?php echo $segmentsmulti->Destination->AirportCode; ?></span>
															<?php
														}
													}
													?>
												</p>

												<?php } ?>
										</li>
               						</ul>
               					</div>
               					<div class="col-md-3 col-sm-3 col-xs-3 no-padding-xs">
               						<div class="flght-duration">
									   	   
               							<p><span>
										<?php
															
										if ($segmentcountint > 1) {
											
											echo minute_to_hour($segmentsints[$segmentcountint - 1]->AccumulatedDuration);
											
										} else {
											echo minute_to_hour($segmentsints[0]->Duration);
										}
										?></span></p>
               							<p><span><?php echo $segmentcountint - 1; ?> Stop </span></p>
               						</div>
               						
               					</div>
               				</div>
						<?php } ?>
               			</div>
						
               			<div class="col-md-4 col-sm-4 col-xs-4 no-padding-xs">
               				<div class="col-md-7 col-sm-7 col-xs-12 no-padding">
                                <h3 class="airline_price"><?php echo $this->bp_white_label_setting->wls_currency_symbol;?><span> <?php echo ($customer_fare); ?> </span></h3>
                            </div>
                            <div class="col-md-5 col-sm-5 col-xs-12 pr-0" style="text-align:center">
                            	<button type="button" onclick="book_now('<?php echo $srdvType; ?>','<?php echo $airlineresults->SrdvIndex; ?>','<?php echo $traceID; ?>','<?php echo $airlineresults->ResultIndex; ?>','<?php echo $searchID; ?>');"  class="btn costom_site_color w-100 booking_btn bookingbtnsubmit mb-10-xs" onclick="">Book</button>
                            	<a href="#intinerary<?php echo $i ?>" class=" fare_tab detail_btn" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#flightDetails<?php echo $i ?>">Details</a>
                            </div>
               			</div>
               			<div class="clearfix"></div>
               		
               			<div class="clearfix"></div>
               			<div class="airline_footer col-md-12">
                      <ul class="list-inline clearfix">
                        <li class="fare-rules">
                          <a href="#none" onclick="getFareRule('<?php echo $srdvType; ?>','<?php echo $airlineresults->SrdvIndex; ?>','<?php echo $traceID; ?>','<?php echo $airlineresults->ResultIndex; ?>','<?php echo "loadfarerule".$i ?>');" ><i class="icofont-hand-right"></i> Fare Rules </a>
                        </li>
                        <li class="hidden-xs">
                          <?php if($segmentsints[0]->Baggage!=""){?>  <span> <i class="icofont-shopping-cart"></i> Baggage : <?php echo $segmentsints[0]->Baggage;?></span><?php }?> 
                        </li>
                        <li class="hidden-xs">
                           <?php if($segmentsints[0]->CabinBaggage!=""){?><span> <i class="icofont-luggage"></i> Cabin Baggage : <?php echo $segmentsints[0]->CabinBaggage;?></span><?php }?>
                        </li>
                        <li class="seats">
                          <i class="icofont-chair"></i>
                          <?php if(isset($segmentsints[0]->NoOfSeatAvailable)){ if($segmentsints[0]->NoOfSeatAvailable!="" && $segmentsints[0]->NoOfSeatAvailable != "not set"){?> <span class="error"> <i class="seats"></i> Seat(s) Left! : <?php echo $segmentsints[0]->NoOfSeatAvailable;?></span><?php } }?>
                        </li>
                        <li class="refund pull-right">
                          <a  class="pull-right text-success fare_tab" href="#faresummary<?php echo $i ?>" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#flightDetails<?php echo $i ?>" > 
						  <?php
							if ($airlineresults->IsRefundable == true) {

								echo "<span style='color:green'>Refundable</span>";
							} else {
								echo "<span style='color:red'>Non-Refundable</span>";
							}
							?></a>
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


					   			<div class="modal fade return-view-flght" id="flightDetails<?php echo $i ?>" role="dialog">
							<div class="modal-dialog modal-lg">
							
							<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title text-center">Flight Details</h4>
								</div>
								<div class="modal-body">
									<div class="row mb-15">
                      <div class="col-md-12">
                        <div class="flght-time-loc-wrap">
                          <?php if( $search_data["type"] =="Return" || $search_data['type'] =="OneWay") {?>
         
                             <p class="mb-0"><?php echo $search_data['from_location']; ?> <i class="icofont-long-arrow-right"></i> <?php echo $search_data['to_location']; ?></p>
                             <small><?php echo date("D, j M Y", strtotime($search_data['depart_date']) ); ?></small> |  <?php if ($segmentcountint > 1) {
                                                    
                                                    echo minute_to_hour($segmentsints[$segmentcountint - 1]->AccumulatedDuration);
                                                    
                                                  } else {
                                                    echo minute_to_hour($segmentsints[0]->Duration);
                                                  } ?>  
                        
                           <?php } ?>
                          <?php if($search_data['type'] =="MultiWay") {?>
                           <!-- <p class="mb-0"><?php echo $search_data['fromLocation_m']['0']; ?> <i class="icofont-long-arrow-right"></i> <?php 
                           if(isset($search_data['fromLocation_m']['2'])){
                              echo $search_data['toLocation_m']['2']; } 
                           else{
                             if(isset($search_data['toLocation_m']['3'])){
                              echo $search_data['toLocation_m']['3'];
                            }
                              else{
                                if(isset($search_data['toLocation_m']['4'])){
                                   echo $search_data['toLocation_m']['4']; } 
                               } }?></p>-->
                           <small><?php echo date("D, j M Y", strtotime($search_data['dept_date_m']['0']) ); ?></small>
                         <?php } ?>
                                | <?php echo $segmentcountint - 1; ?> Stop </small></small><span class="pull-right price-flt"><?php echo $this->bp_white_label_setting->wls_currency_symbol;?> <?php echo number_format($customer_fare); ?></span>
                        </div>
                      </div>
								

			   
									</div>
								<div class="row">
                  <div class="col-md-12">
									<ul class="nav nav-tabs">
										<li><a data-toggle="tab" href="#intinerary<?php echo $i ?>"><span class="hidden-xs">Flight</span> Details</a></li>
										<li><a data-toggle="tab" href="#faresummary<?php echo $i ?>">FARE <span class="hidden-xs">SUMMARY</span> </a></li>
										<!-- <li><a data-toggle="tab" onclick="getFareRule('<?php echo $srdvType; ?>','<?php echo $airlineresults->SrdvIndex; ?>','<?php echo $traceID; ?>','<?php echo $airlineresults->ResultIndex; ?>','<?php echo "loadfarerule".$i ?>');"  href="#farerule<?php echo $i ?>">FARE RULES</a></li> -->
									</ul>

									<div class="tab-content pt-15">
									<div id="intinerary<?php echo $i ?>" class="tab-pane fade in active">
										
									<?php 
										foreach ($airlineresults->Segments as $type_keys=> $airlineresultsint){ ?>
									 <?php if($search_data['type'] =="OneWay" || $search_data['type'] =="Return" ) { ?>
										<div class="col-md-12 mb-15"><span class="label label-primary"><i class="icofont-airplane-alt "></i> <?php  if($type_keys==0) {echo "Departure" ;} else {echo "Return";} ?> </span></div>
										<?php } ?>
										
										
									
									<?php	foreach ($airlineresultsint as $seg => $segmentloop) {
											
											$to_time = strtotime($segmentloop->DepTime);
											$from_time = strtotime($segmentloop->ArrTime);
											$minutess =  round(abs($to_time - $from_time) / 60,2);
											$hours = floor($minutess / 60).'H :'.($minutess -   floor($minutess / 60) * 60).'M';
											?>
									
									   <div class="row">
									  
										<div class="clearfix"></div>
										<div class="col-md-2 text-center br-1">
											<img src="<?php echo site_url(); ?>assets/images/airlines/<?php echo $segmentloop->Airline->AirlineCode; ?>.gif" width="50" />	
											<p><?php echo $segmentloop->Airline->AirlineName ?> , <?php echo $segmentloop->Airline->AirlineCode . "-" . $segmentloop->Airline->FlightNumber; ?><br><small>Operated by <?php echo $segmentloop->Airline->AirlineName ?> </small><p>
										</div>
										<div class="col-md-3 text-center-xs">
											<p class="mb-0">	<?php echo $segmentloop->Origin->CityName; ?> (<?php echo $segmentloop->Origin->AirportCode; ?>)</p> 
											<p class="mb-0"><b><?php echo GetDateScFull($segmentloop->DepTime); ?>, <?php echo GetTime($segmentloop->DepTime); ?> </b></p>
											<small><?php echo $segmentloop->Origin->AirportName; ?> </small>
										</div>
										<div class="col-md-4">
											<p class="text-center"><i class="icofont-ui-clock"></i><?php echo $hours; ?> </p>
												<p class="dots"><i class="icofont-airplane plane_horiz"></i></p>
												<p class="text-center">Fare Class: H &nbsp;|&nbsp; <?php
                                                    if ($airlineresults->IsRefundable == true) {

                                                        echo '<span class="pull-right refund"><i class="icofont-rupee"></i> Refundable</span>';
                                                    } else {
                                                        echo '<span class="pull-right nonrefund"><i class="icofont-rupee"></i> Non-Refundable</span>';
                                                    }
                                                    ?></p>
										</div>
										<div class="col-md-3 text-center-xs">
											<p class="mb-0"><?php echo $segmentloop->Destination->CityName; ?> (<?php echo $segmentloop->Destination->AirportCode; ?>)</p> 
											<p class="mb-0"><b><?php echo GetDateScFull($segmentloop->ArrTime); ?>, <?php echo GetTime($segmentloop->ArrTime); ?> </b></p>
											<small> <?php echo $segmentloop->Destination->AirportName; ?> - Terminal <?php echo $segmentloop->Destination->Terminal; ?></small>
										</div>
										</div>

										<?php }} ?>

									</div>
									
									
									<div id="faresummary<?php echo $i ?>" class="tab-pane fade">
										<div class="row">
										<div class="col-md-12">
                      <div class="table-responsive">
											<table class="table table-bordered table-striped">
												<thead>
												<tr>
													<th>Fare Summary</th>
													<th></th>
												</tr>
												</thead>
												<tbody>
												<tr>
													<td>Base Fare</td>
													<td><i class="fa fa-inr"></i> <?php echo number_format($baseFare); ?></td>
												</tr>
												<tr>
													<td>Airline Fuel Surcharges</td>
													<td><i class="fa fa-inr"></i> <?php echo number_format($taxvalue) ; ?></td>
												</tr>
												<tr class="active">
													<td><b>Total</b></td>
													<td><b><i class="fa fa-inr"></i><?php echo number_format($offerfareround); ?></b></td>
												</tr>
												</tbody>
											</table>
                      </div>
											<small>*Total fare displayed above has been rounded off and may thus show a slight difference.</small>
										</div>
								
										</div>
									</div>
									
									


									</div>
								</div>
              </div>
								</div>
								<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								</div>
							</div>
							
							</div>
						</div>
				

				   <?php
                    }
                }
                ?>
				   <!-- Flight Details End-->
				   
           </div>
          </div>
        </div>
      </div>
    </div>
	
	<!--Modify Search-->
	<div class="modal fade" id="modify_search" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title text-center">Modify Search</h4>
        </div>
        <div class="modal-body">
        <!--<form class="modify-form search-form-common" id="search_form" action="<?php echo site_url(); ?>flight/result" method="get">-->
           <div class="form-group col-md-12">
            <div class="flight-trip-wrap">
              <div class="btn-group">
                 <label class="radio-inline active">
                   <input type="radio" value="Return" id="returnid" name="type" <?php if($requestdata['type'] =='Return') { echo "checked"; }?> />  Round Trip
                </label>
                <label class="radio-inline">
                  <input type="radio" value="OneWay" id="onwayid" name="type" <?php if($requestdata['type'] =='OneWay') { echo "checked"; }?> />One Way
                </label>
				 <label class="radio-inline">
					<input type="radio" value="MultiWay" id="MultiWayid" name="type" <?php if($requestdata['type'] =='MultiWay') { echo "checked"; }?> />Multi City
				</label> 
              </div>
            </div>
		</div>
        <div class="clearfix"></div>
		
        <div  class="oneway_box display_inline"> 
		 <form class="modify-form search-form-common" id="search_form" action="<?php echo site_url(); ?>flight/result" method="get">
		 <input type="hidden" id="search_type" name="type"  value="OneWay">
                <div class="col-md-3">
                  <div class="form-group flght-icon">
                    <label for="flight-from">From</label>
                      <div class="search-frm-field pos-rv">
                        
                         <input type="text" class="form-control pax_validation_field dom-flght " name="from_location" value="<?php if($requestdata["type"] =='OneWay' || $requestdata["type"] =='Return'){ echo $search_data["from_location"];} ?>"  id="flight_from0"  placeholder="City or airport" required onkeyup="flight_suggest(this.value,0);" onblur="bp_fill();" autocomplete="off"/>
                        </div>
                        <div class="suggestionsBox"  id="flight_suggestions0"  style="display: none;">
                          <div class="suggestionList"  id="flight_suggestionsList0">&nbsp;</div>
                        </div>
                  </div>

                  </div>
 
                  <!-- <i class="fa fa-exchange exch-icon hidden-xs"></i> -->
                    <div class="col-md-3">
                      <div class="form-group flght-icon">
                      <label for="flight-from">To</label>
                       <div class="search-frm-field pos-rv">
                        
                        <input class="form-control pax_validation_field dom-flght" type="text" id="flight_from_to0" name="to_location" value="<?php if($requestdata["type"] =='OneWay' || $requestdata["type"] =='Return'){ echo $search_data["to_location"];} ?>"  placeholder="City airport" required onkeyup="flight_suggest_to(this.value,0);"  autocomplete="off"/>
                      </div>
                    <span style="display: none" id="tolocation"></span>
                      <span style="display: none" id="fromlocation"></span>	
				
                      <input type="hidden" name="from_country" id="flight_from_country0" value="<?php if($requestdata["type"] =='OneWay' || $requestdata["type"] =='Return'){ echo $search_data["from_country"];} ?>">
                      
					  <input type="hidden" name="to_country" id="flight_from_to_country0" value="<?php if($requestdata["type"] =='OneWay' || $requestdata["type"] =='Return'){ echo $search_data["to_country"];} ?>">
                      
					  <input type="hidden" name="from_city_code" id="flight_from_city0" value="<?php if($requestdata["type"] =='OneWay' || $requestdata["type"] =='Return'){ echo $search_data["from_city_code"]; } ?>" >
                   
				   <input type="hidden" name="to_city_code" id="flight_from_to_city0" value="<?php if($requestdata["type"] =='OneWay' || $requestdata["type"] =='Return'){ echo $search_data["to_city_code"];} ?>"> 
					
                    <div class="suggestionsBox" id="flight_suggestions_to0"  style="display: none; ">
                        <div class="suggestionList" id="flight_suggestionsList_to0">&nbsp;</div>
                      </div>
                     </div>
                    </div> 
                    <div class="col-md-3">
                      <div class="form-group flght-icon">
                        <label for="flight-from">Depart Date</label>
                        <div class="search-frm-field pos-rv">
                         
                          <input type="text" id="depart_date" class="form-control pax_validation_field dpart-d-rdonl" value="<?php if($requestdata["type"] =='OneWay' || $requestdata["type"] =='Return'){ echo $search_data["depart_date"];} ?>" name="depart_date" placeholder="Depart Date" required readonly>
                        </div>
                      </div>
                    </div>
                 <div class="col-md-3">
                    <div class="form-group flght-icon">
                      <label for="flight-from">Return Date</label>
                       <div class="search-frm-field pos-rv">
                          
                         <input type="text" id="return_date" value="<?php if($requestdata["type"] =='OneWay' || $requestdata["type"] =='Return'){ echo $requestdata["return_date"]; }   ?>"  class="form-control "  name="return_date" placeholder="DD/MM/YYYY" readonly>
                        </div>
                    </div>
                  </div>
				  <!---->
				        <div class="col-md-2 ">
                  <div class="form-group">
                    <label for="adults">Adult(s)</label>
                    <select name="no_adult" class="form-control adult_select pax_validation_field" >
                      <?php for($i=1; $i<=9; $i++) { 
                        if ($i == $this->input->get("no_adult")) { ?>
                            <option selected value="<?php echo $i ?>"><?php echo $i ?></option>
                      <?php } else { ?>
                            <option value="<?php echo $i ?>"><?php echo $i ?></option>
                      <?php } } ?>
                    </select>
                </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="adults">Child(s)</label>
                       <select name="no_child" class="form-control child_select pax_validation_field" >
                          
                          <?php for($j=0; $j<=9-$this->input->get("no_adult"); $j++  ) {
                            if($j == $this->input->get("no_child") ){?>
                              
                              <option selected value="<?php echo $j; ?>"><?php echo $j; ?></option>
                                                <?php } else{ ?>
                              
                              <option value="<?php echo $j; ?>"><?php echo $j; ?></option>
                            
                          <?php } } ?>
                        </select>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="adults">Infant(s)</label>
                      <select name="no_infants" class="form-control infant_select pax_validation_field" >
                      
                      <?php for($k=0; $k<=$this->input->get("no_adult"); $k++  ) {
                        if($k == $this->input->get("no_infants") ){ ?>
                          <option selected value="<?php echo $k; ?>"><?php echo $k; ?></option>
                          
                        <?php } else{ ?>
                          
                          <option value="<?php echo $k; ?>"><?php echo $k; ?></option>
                        
                      <?php } } ?>
                      
                      
                    </select>
                    </div>
                  </div>  
               <div class="col-md-3 ">
                <div class="form-group">
                        <label for="adults">Class</label>
                        <select name="cabin_class" class="form-control">
                          <option <?php if($this->input->get("cabin_class")==6){echo "selected";} ?> value="6" >First</option>
                          <option selected <?php if($this->input->get("cabin_class")==2){echo "selected";} ?> value="2" >Economy</option>
                          <option <?php if($this->input->get("cabin_class")==4){echo "selected";} ?>value="4">Business</option>   
                       </select>
                  </div>
               </div>
        <div class="col-md-3">
          <div class="form-group">
			<label>&nbsp;</label>
             <button type="button" id="submit_btn" style="width:100%;" class="btn search-btn"><i class="icofont-search-1"></i> Search</button>
          </div>
        </div>
				  <!---->
				<div class="clearfix"></div>
				</form>
          </div>
	
		  
          <div class="mulitycity_box display_none"> 
 <form class="modify-form search-form-common" id="search_form" action="<?php echo site_url(); ?>flight/result" method="get">
                  <input type="hidden"  name="type"  value="MultiWay">
                  <div class="form-group col-md-3">
                     <input type="text" class="form-control pax_validation_field_multi" name="fromLocation_m[0]" id="flight_from1" value="<?php if($search_data["type"] =='MultiWay'){ echo $search_data["fromLocation_m"][0];} ?>"  placeholder="City(1) or airport" required onkeyup="flight_suggest(this.value,1);" onblur="bp_fill();" autocomplete="off"/>
                    <div class="suggestionsBox" id="flight_suggestions1" style="display: none;">
                      <div class="suggestionList" id="flight_suggestionsList1">&nbsp;</div>
                    </div>
                  </div>
 
                  <!-- <i class="fa fa-exchange exch-icon hidden-xs"></i> -->
                    <div class="form-group col-md-3">
                    <input class="form-control pax_validation_field_multi" type="text" id="flight_from_to1" name="toLocation_m[0]" value="<?php if($search_data['type'] =='MultiWay'){ echo $search_data["toLocation_m"][0];} ?>"  placeholder="City(1) airport" required onkeyup="flight_suggest_to(this.value,1);"  autocomplete="off"/>
                    <span style="display: none" id="tolocation"></span>
                      <span style="display: none" id="fromlocation"></span>
                    <!--  <input type="hidden" name="from_country_1" id="flight_from_country1">-->
                      <!--<input type="hidden" name="to_country_1" id="flight_from_to_country1">-->
					  <input type="hidden" name="from_country[0]" id="flight_from_country1">
					  <input type="hidden" name="to_country[0]" id="flight_from_to_country1">
                    <div class="suggestionsBox" id="flight_suggestions_to1" style="display: none; ">
                        <div class="suggestionList" id="flight_suggestionsList_to">&nbsp;</div>
                      </div>
                    </div> 
                    <div class="form-group col-md-3 ">
                      <input type="text" id="city1" class="form-control pax_validation_field_multi" name="dept_date_m[0]" value="<?php  if($search_data['type'] =='MultiWay'){ echo $search_data["dept_date_m"][0];} ?>" placeholder="City(1) Depart Date" required>
                    </div>

				  <div class="clearfix"></div>
				 
				  
                 <!-- </div>-->

                  

                  <div class="mulitycity_box mulitycity_append  display_none"> 
                  
                  <?php for($k=2; $k <=$no_of_city; $k++) { ?>

                   <div class="mt-10 col-md-12 removeroute<?php echo $k; ?>" style="padding-right: 0px; padding-left: 0px;">
											<div class="form-group col-md-3">
											<input type="text" class="form-control pax_validation_field_multi" name="fromLocation_m[<?php echo $k-1; ?>]" id="flight_from<?php echo $k; ?>" value="<?php if($requestdata['type'] =='MultiWay'){ echo $search_data["fromLocation_m"][$k-1];} ?>"  placeholder="City(<?php echo $k; ?>) or airport" required onkeyup="flight_suggest(this.value,<?php echo $k; ?>);" onblur="bp_fill();" autocomplete="off"/>
												<div class="suggestionsBox" id="flight_suggestions<?php echo $k; ?>" style="display: none;">
													<div class="suggestionList" id="flight_suggestionsList<?php echo $k; ?>">&nbsp;</div>
												</div>
											</div>
											<div class="form-group col-md-3">
												<input class="form-control pax_validation_field_multi" type="text" id="flight_from_to<?php echo $k; ?>" name="toLocation_m[<?php echo $k-1;?>]" value="<?php if($requestdata['type'] =='MultiWay'){ echo $search_data["toLocation_m"][$k-1]; } ?>"  placeholder="City(<?php echo $k; ?>) or airport" required onkeyup="flight_suggest_to(this.value,<?php echo $k; ?>);" onblur="bp_fill_to();" autocomplete="off"/>
												<span style="display: none" id="tolocation"></span>
												<span style="display: none" id="fromlocation"></span>
												<input type="hidden" name="from_country_<?php echo $k; ?>" value="from_country_<?php echo $k ?>" id="flight_from_country2">
												<input type="hidden" name="to_country_<?php echo $k; ?>" value="to_country_<?php echo $k ?>" id="flight_from_to_country2">
												<div class="suggestionsBox" id="flight_suggestions_to<?php echo $k; ?>" style="display: none; ">
													<div class="suggestionList" id="flight_suggestionsList_to<?php echo $k; ?>">&nbsp;</div>
												</div>
											</div> 
											<div class="form-group col-md-3">
												<input type="text" id="city<?php echo $k; ?>" class="form-control pax_validation_field_multi" value="<?php if($requestdata['type'] =='MultiWay'){ echo $search_data["dept_date_m"][$k-1]; } ?>" name="dept_date_m[<?php echo $k-1; ?>]" placeholder="City(<?php echo $k; ?>) Depart Date" required>
											</div>
											<div class="form-group col-md-3">
												<?php if($k >= 3) { ?>
													<span><i class="fa fa-times remove_btn" id="removeroute<?php echo $k?>"></i></span>
												<?php } else {echo "&nbsp";} ?>
											</div>
										</div>
                    
                  <?php } ?>
				  <div class="clearfix"></div>
                 </div>                

                  <div class="mulitycity_box add_more col-md-12 mt-10 display_none">
                      <label><a href="javascript:;" class="addroute"><i class="fa fa-plus-circle"></i> Add City</a></label>
                  </div>
              
		
               <div class="col-md-2 ">
                  <div class="form-group">
                    <label for="adults">Adult(s)</label>
                    <select name="no_adult" class="form-control adult_select pax_validation_field" >
                      <?php for($i=1; $i<=9; $i++) { 
                        if ($i == $this->input->get("no_adult")) { ?>
                            <option selected value="<?php echo $i ?>"><?php echo $i ?></option>
                      <?php } else { ?>
                            <option value="<?php echo $i ?>"><?php echo $i ?></option>
                      <?php } } ?>
                    </select>
                </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="adults">Child(s)</label>
                       <select name="no_child" class="form-control child_select pax_validation_field" >
                          
                          <?php for($j=0; $j<=9-$this->input->get("no_adult"); $j++  ) {
                            if($j == $this->input->get("no_child") ){?>
                              
                              <option selected value="<?php echo $j; ?>"><?php echo $j; ?></option>
                                                <?php } else{ ?>
                              
                              <option value="<?php echo $j; ?>"><?php echo $j; ?></option>
                            
                          <?php } } ?>
                        </select>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="adults">Infant(s)</label>
                      <select name="no_infants" class="form-control infant_select pax_validation_field" >
                      
                      <?php for($k=0; $k<=$this->input->get("no_adult"); $k++  ) {
                        if($k == $this->input->get("no_infants") ){ ?>
                          <option selected value="<?php echo $k; ?>"><?php echo $k; ?></option>
                          
                        <?php } else{ ?>
                          
                          <option value="<?php echo $k; ?>"><?php echo $k; ?></option>
                        
                      <?php } } ?>
                      
                      
                    </select>
                    </div>
                  </div>  
               <div class="col-md-3 ">
                <div class="form-group">
                        <label for="adults">Class</label>
                        <select name="cabin_class" class="form-control">
                          <option <?php if($this->input->get("cabin_class")==6){echo "selected";} ?> value="6" >First</option>
                          <option selected <?php if($this->input->get("cabin_class")==1){echo "selected";} ?> value="1" >Economy</option>
                          <option <?php if($this->input->get("cabin_class")==4){echo "selected";} ?>value="4">Business</option>   
                       </select>
                  </div>
               </div>
        <div class="col-md-3">
          <div class="form-group">
			<label>&nbsp;</label>
             <button type="submit" id="submit_btn1" style="width:100%;" class="btn search-btn"><i class="icofont-search-1"></i> Search</button>
          </div>
        </div>
		<div class="clearfix"></div>
      </form>

</div>	  
        </div>
       
		<div class="clearfix"></div>
      </div>
      
    </div>
  </div>

  <!--Modify serach End-->
 <!-- Modal Confirm Price-->
   <div class="modal fade" id="confirmprice" role="dialog">
    <div class="modal-dialog" style="width: 450px;">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="padding: 10px; text-align: center;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4><span class="fa fa-lock"></span> We are Reconfirming Price... </h4>
        </div>
        <div class="modal-body " style="padding:24px 50px;">
			<div class="text-align-center">
				<img style="width:60%" src="<?php echo site_url(); ?>/assets/images/loading1.gif">
			</div>
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div> 
 <!-- Modal  End Confirm Price-->

	<div id="farerule" class="modal fade" role="dialog">
		<div class="modal-dialog modal-lg">
			<!-- Modal content-->
			<div class="modal-content" style="border-radius: 0px;">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title text-center">Fare Rule</h4>
				</div>
				<div class="modal-body">
					<div id="loadfarerule" class="text-align-center container-auto" style="text-align: justify">
						<div class="text-align-center">
							<img style="width:60%" src="<?php echo site_url(); ?>assets/images/loading1.gif">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>



<!-- Modal start Confirm Error Price-->
 			<div  id="confirmerror" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  >
				<div class="modal-dialog ">
					<!-- Modal content-->
					<div class="modal-content" style="border-radius: 0px;">
						<div class="modal-body">
							<div class="text-align-center" style="margin:15px">
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

<!-- <div ng-app="myApp" ng-controller="myCtrl">
	<h1 ng-repeat="flight_result in records">{{flight_result.AirlineCode}}</h1>
</div> -->


<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/angularjs-slider/6.4.3/rzslider.js"></script>

<?php $this->load->view('include/footer') ?>
<?php $this->load->view('js'); ?>

<script>
$(function() {
		//var minv= $('#pricep').attr("data-slider-min");
		var maxv= $('#pricep').attr("data-slider-max");
		var vali= $('#pricep').attr("data-slider-value");
            $( "#slide1f" ).slider({
               range:true,
               min: <?php echo $pricefiltermin ; ?>,
               max: <?php echo $pricefiltermax ; ?>,
               values: [ <?php echo $pricefiltermin ; ?>, <?php echo $pricefiltermax ; ?> ],
               slide: function( event, ui ) {
                  $( "#pricep" ).val( "<?php echo $this->bp_white_label_setting->wls_currency_symbol;?>" + ui.values[ 0 ] + " - <?php echo $this->bp_white_label_setting->wls_currency_symbol;?>" + ui.values[ 1 ] );
				  	     //$( "#amount" ).val( "Rs." + ui.value[ 0 ] + "  -  Rs." + ui.value[ 1 ] );
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
			//alert();
            $( "#pricep" ).val( "<?php echo $this->bp_white_label_setting->wls_currency_symbol;?>" + $( "#slide1f" ).slider( "values", 0 ) +
               " - Rs" + $( "#slide1f" ).slider( "values", 1 ) );
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
		$( "#time-range1" ).slider({
			 range:true,
			 min: 0,
			 max: 23,
			 values: [ 0, 23 ],
			 slide: function( event, ui ) {
			 $( "#timep1" ).val( ui.values[ 0 ] +"  - " + ui.values[ 1 ] );
		var i=0;
		var j=0;
			$(".price111onword").each(function(){
			if($(this).attr("timedep")<ui.values[ 0 ] || $(this).attr("timedep")>ui.values[ 1 ])
			{
			$(this).hide();
			}
			if($(this).attr("timedep")>ui.values[ 0 ] && $(this).attr("timedep")<ui.values[ 1 ])
			{
			$(this).show();
			}
			});	 

		}
		});
//alert();
		$( "#timep1" ).val( $( "#time-range1" ).slider( "values", 0 ) +
			 " - " + $( "#time-range1" ).slider( "values", 1 ) );
 });

</script>


	<script>

function flight_fill(thisValue,code,div) {
	var addvalue="";

    addvalue=thisValue;
	$('#flight_from'+div).val(addvalue);
	$('#flight_from_country'+div).val(code);
	$('#flight_suggestions'+div).fadeOut();
}
function flight_fill_to(thisValue,code,div) {
	var addvalue="";
    addvalue=thisValue;
	$('#flight_from_to'+div).val(addvalue);
	$('#flight_from_to_country'+div).val(code);
	$('#flight_suggestions_to'+div).fadeOut();
}



function flight_suggest(inputString,id) {


$( "#flight_from"+id ).autocomplete({
    autoFocus: true,	
    minLength : 2,
    source : function(request, response) {
    $.ajax({
        type: "POST",
        url: "<?php echo site_url();?>front/fetch_city",
        dataType : "json",
        cache : false,
        data: {id: inputString,div_id:id},
        success: 
        function(data){
            console.log(data);
            var all_l=[];
            for(var i=0;i<data.length;i++)
            {
                var city_name=data[i].airport_city_name; 
                var air_name=data[i].airport_name; 
                var air_code=data[i].airport_code;
                var air_country_code=data[i].airport_country_code; 
                all_l.push({ "label": city_name+" ("+air_name+"), "+air_code, "value": city_name+" ("+air_name+"), "+air_code, "country": air_country_code } );

            }
                response(all_l);
        }	
    });	  
    
},
select: function(event, ui) {
    $( "#flight_from_country"+id).val(ui.item.country);	
    $( "#flight_from_to"+id).focus();
	$( ".sugg-clear-from"+id).show();
	$("#flight_from_country"+id ).removeClass('has-content');  
	$( "#flight_from_leb"+id).val(ui.item.label);

},
});    
    
    
}

$(document).ready(function(){

    $("#flight_from0").focus();
    
});

function closecross(id)
{
	 $(".sugg-clear-from"+id).hide();
	 $( "#flight_from"+id ).val(" ");
	 $( "#flight_from"+id ).focus();
	 
}

function closecrossto(id)
{
	 $(".sugg-clear-to"+id).hide();
	 $( "#flight_from_to"+id ).val(" ");
	 $( "#flight_from_to"+id ).focus();
	 
}


function flight_suggest_to(inputString,id) {
    $( "#flight_from_to"+id ).autocomplete({
    autoFocus: true,	
    minLength : 2,
    source : function(request, response) {
     $.ajax({
        type: "POST",
        url: "<?php echo site_url();?>front/fetch_city_to",
        dataType : "json",
        cache : false,
        data: {id: inputString,div_id:id},
        success: 
          function(data){
              var all_l=[];
            for(var i=0;i<data.length;i++)
            {
                var city_name=data[i].airport_city_name; 
                var air_name=data[i].airport_name; 
                var air_code=data[i].airport_code;
                var air_country_code=data[i].airport_country_code; 
                all_l.push({ "label": city_name+" ("+air_name+"), "+air_code, "value": city_name+" ("+air_name+"), "+air_code, "country": air_country_code } );

            }
            response(all_l);
        
        }	
    });	  
    
},
select: function(event, ui) {

$( "#flight_from_to_country"+id ).val(ui.item.country);	
$( "#depart_date" ).focus();
$( ".sugg-clear-to"+id).show();
$("#flight_from_to_country"+id ).removeClass('has-content');   
$("#flight_from_to_leb"+id).val(ui.item.label)
},
});    

       
}


$('.fare_tab').click(function(e){
	var tab = $(this).attr('href');	
	$('li > a[href="' + tab + '"]').tab("show");
});


  $(function () {

$('#city1').datepicker({
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
		$("#city2").datepicker("option", "minDate", selectedDate);
	}

});

$('#city2').datepicker({
	numberOfMonths: 1,
	dayNamesMin: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
	"minDate": 0,
	showOn: 'both',
	dateFormat: 'dd-mm-yy',
	buttonText: '',
	beforeShow:function(){ },
	onSelect: function (selectedDate)
	{
		$("#city3").datepicker("option", "minDate", selectedDate);
	}

});

});




var i= <?php echo $no_of_city + 1; ?>;

$(".addroute").click(function (){
	var city_data = "";
	if(i<5){
		city_data += '<div class="mt-10 col-md-12 removeroute'+i+'" style="padding-right: 0px; padding-left: 0px;" >\
							<div class="form-group col-md-3">\
							<input type="text" class="form-control pax_validation_field_multi" name="from_location_'+i+'" id="flight_from'+i+'"  placeholder="City('+i+') or airport" required onkeyup="flight_suggest(this.value,'+i+');" onblur="bp_fill();" autocomplete="off"/>\
								<div class="suggestionsBox" id="flight_suggestions'+i+'" style="display: none;">\
									<div class="suggestionList" id="flight_suggestionsList'+i+'">&nbsp;</div>\
								</div>\
							</div>\
								<div class="form-group col-md-3">\
								<input class="form-control pax_validation_field_multi" type="text" id="flight_from_to'+i+'" name="to_location_'+i+'"  placeholder="City('+i+') or airport" required onkeyup="flight_suggest_to(this.value,'+i+');" onblur="bp_fill_to();" autocomplete="off"/>\
								<span style="display: none" id="tolocation"></span>\
									<span style="display: none" id="fromlocation"></span>\
									<input type="hidden" name="from_country" id="flight_from_country'+i+'">\
									<input type="hidden" name="to_country_'+i+'" id="flight_from_to_country'+i+'">\
								<div class="suggestionsBox" id="flight_suggestions_to'+i+'" style="display: none; ">\
										<div class="suggestionList" id="flight_suggestionsList_to'+i+'">&nbsp;</div>\
									</div>\
								</div> \
								<div class="form-group  col-md-3">\
									<input type="text" id="city'+i+'" class=" city'+i+' form-control pax_validation_field_multi" name="depart_date_'+i+'" placeholder="City('+i+') Depart Date" required>\
								</div>\
								<div class="form-group col-md-3">\
									<span ><i class="fa fa-times remove_btn" id="removeroute'+i+'"></i></span>\
								</div>\
						</div>';
						i++;	 	
		}
		if(i==5){
			$('.add_more').hide();
		}

		$(".mulitycity_append").append(city_data);
		
	    var city_2_date =$("#city2").datepicker('getDate');
		if(city_2_date){} else{
			city_2_date=0;
		}
		$('.city3').datepicker({
			numberOfMonths: 1,
			dayNamesMin: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
			"minDate":0,
			showOn: 'both',
			dateFormat: 'dd-mm-yy',
			buttonText: '',
			beforeShow:function(){ },
		});

		var city_3_date =$(".city3").datepicker('getDate');
		if(city_3_date){} else{
			city_3_date=0;
		}

		$('.city4').datepicker({
			numberOfMonths: 1,
			dayNamesMin: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
			"minDate":0,
			showOn: 'both',
			dateFormat: 'dd-mm-yy',
			buttonText: '',
			beforeShow:function(){ },
		});
});

	$(".mulitycity_append").on('click','.remove_btn',  function(){
		var remove_div_id =$(this).attr("id");
		$("."+remove_div_id).hide();
		i--;
		if(i==4){
			$('.add_more').show();
		}
  	});


</script>


