<?php $this->load->view('header') ;
$search_data=$_SESSION ['flight'] [$searchID] ['search_RequestData'];
$no_of_city =0 ;
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
	</style>



<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/angularjs-slider/6.4.3/rzslider.css" /> 
   <!-- Search Result info -->
   <!-- Search Result info -->
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
              <button type="" data-toggle="modal" data-target="#modify_search" class="btn btn-org btn-flght"><i class="icofont-search"></i> Modify Search</button>
            </div>
          </div>

        </div>
      </div>
	</div><!-- Search Result info End -->
	
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
              		<h4><i class="icofont-rupee"></i> Price</h4>
              	</div>
              	<div class="row_sidebar_contant range-slider">
				  <rzslider  class="custom-slider" rz-slider-model="slider.minValue" rz-slider-high="slider.maxValue" rz-slider-options="slider.options"></rzslider>
			  	</div>
              </div>
              <div class="row price_filter">
              	<div class="row_sidebar_title">
              		<h4><i class="icofont-clock-time"></i> Depart Time </h4>
              	</div>

				  <div class="row_sidebar_contant range-slider">
              		<ul class="departtimes list-inline">
                    <li>
                      <span  isflight="@{{filtering_flight('timing', 1, 0) ? 1 : 0}}" ng-click="filtering_flight('timing', 1, 0) ? filter_timing(1) : angular.noop()" id="departure_time_1" value="1" class="icon"><i class="icofont-full-sunny"></i></span>
                     	 <a href="#" title="Morining-flights" style="margin: 0;border: none; padding: 0;" class="departure_time_class @{{filtering_flight('timing', 1, 0) ? '' : 'btn-is-disabled'}}"  value="1">
						<span class="time">00-06</span>
						<p style="visibility: hidden;"><i class="icofont-rupee"></i> 1833</p>
					  </a>
					  <!-- <input type="checkbox" ng-checked="true" ng-click="filter_timing(1)"> -->
                    </li>
                    <li>
                      <span isflight="@{{filtering_flight('timing', 2, 0) ? 1 : 0}}" ng-click="filtering_flight('timing', 2, 0) ? filter_timing(2) : angular.noop()" id="departure_time_2" value="2" class="icon"><i class="icofont-star-alt-1"></i></span>
					  	<a class="star departure_time_class @{{filtering_flight('timing', 2, 0) ? '' : 'btn-is-disabled'}}" href="#" value="2" title="Morining-flights" style="margin: 0;border: none; padding: 0;" >
					  		<span class="time">06-12</span>
						</a>	  
                      <p style="visibility: hidden;"><i class="icofont-rupee"></i> 1855</p>
                    </li>
                    <li>
                      <span isflight="@{{filtering_flight('timing', 3, 0) ? 1 : 0}}" ng-click="filtering_flight('timing', 3, 0) ? filter_timing(3) : angular.noop()" id="departure_time_3" value="3" class="icon"><i class="icofont-spinner-alt-5"></i></span>
					  	<a href="#" class="departure_time_class @{{filtering_flight('timing', 3, 0) ? '' : 'btn-is-disabled'}}" value="3" title="Afternone-flights" style="margin: 0;border: none; padding: 0;">
						  <span class="time">12-18</span>
						</a>	  
                    	  <p style="visibility: hidden;"><i class="icofont-rupee"></i> 1833</p>
                    </li>
                    <li>
                      <span isflight="@{{filtering_flight('timing', 4, 0) ? 1 : 0}}" ng-click="filtering_flight('timing', 4, 0) ? filter_timing(4) : angular.noop()" id="departure_time_4" value="4" class="icon"><i class="icofont-moon"></i></span>
                      <a href="#" class="departure_time_class @{{filtering_flight('timing', 4, 0) ? '' : 'btn-is-disabled'}}" value="4" title="Nights-flights" style="margin: 0;border: none; padding: 0;">
					 	<span class="time">18-00</span>
					 </a>		 
                      <p style="visibility: hidden;"><i class="icofont-rupee"></i> 1833</p>
                    </li>  
                  </ul>
              	</div>
						


              </div>

              <div class="row price_filter">
                    <div class="row_sidebar_title">
                        <h4><i class="icofont-money-bag"></i> Fare Type <span class="pull-right"></span></h4>
                    </div>
                    <div class="row_sidebar_contant">
                        <form>
                            <div class="checkbox cstm-check">
                            	<input type="checkbox" ng-checked="true" ng-click="filter_refundable(1)" class="flightfare" id="refundable" value="Refundable">
                                <label for="refundable">Refundable </label>
                            </div>
                            <div class="checkbox cstm-check">
                            	<input type="checkbox" ng-checked="true" ng-click="filter_refundable(2)" id="non-refundable" class="flightfare" value="NonRefundable" >
                                <label for="non-refundable">Non Refundable</label>
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
							<div class="checkbox cstm-check">
                        		<input class="flightstop"  ng-checked="true" ng-click="filter_stops(1)" isflight="@{{filtering_flight('stops', 1, 0) ? 1 : 0}}"  id="stop-1" type="checkbox" check_see="0" value="1">
                        		<label for="stop-1">Non Stop</label>
                        	</div>
							
							<div class="checkbox cstm-check">
                        		<input class="flightstop"  ng-checked="true" ng-click="filter_stops(2)" isflight="@{{filtering_flight('stops', 2, 0) ? 1 : 0}}" type="checkbox" id="non-stop" check_see="0" value="0">
                        		<label for="non-stop">1 Stop </label>
                        	</div>
                        	<div class="checkbox cstm-check">
                        		<input class="flightstop"  ng-checked="true" isflight="@{{filtering_flight('stops', 3, 0) ? 1 : 0}}"   ng-click="filter_stops(3)" id="stop-2" type="checkbox" check_see="0" value="2">
                        		<label for="stop-2">2 Stop</label>
                        	</div>
                        </form>
                    </div>
                </div>
                <div class="row price_filter">
                    <div class="row_sidebar_title">
                        <h4><i class="icofont-airplane-alt"></i> Airlines <span class="pull-right"></span></h4>
                    </div>
                    <div class="row_sidebar_contant">
                        <form>
						
                        	<div class="checkbox cstm-check" ng-repeat="airlines_name in airlinnameshow">
                        		<input class="flightso" type="checkbox"  ng-checked="true" ng-click="filter_airlines_name(airlines_name)" id="{{airlines_name}}" value="0" value_for_short="{{airlines_name}}">
                        		<label for="{{airlines_name}}">{{airlines_name}}</label>
							</div>
							
                        </form>
                    </div>
                </div>
            </div>
          </div>
          <div class="col-lg-9 col-md-9 col-sm-12" id="">
            <div class="flght-search-result-right">
              <!-- company promos -->
              <!-- <div class="company-promos allcom-carousel owl-carousel mb-20">
                <div class="item">
                	<div class="com-pro-col trans">
                		<a href="javascript:void(0)">
                			<div class="clearfix  fc-airline">
                				<img src="<?php echo site_url()?>assets/images/airlines/SG.gif" alt="com-logo">
                				<span class="price"><i class="icofont-rupee"></i> 5310</span>
                			</div>
                			<div class="clearfix flt-date">
                				<span class="fc-date">18-09-2018</span>
                			</div>
                		</a>
                	</div>
                </div>
                <div class="item">
                	<div class="com-pro-col trans">
                		<a href="javascript:void(0)">
                			<div class="clearfix  fc-airline">
                				<img src="<?php echo site_url()?>assets/images/airlines//SG.gif" alt="com-logo">
                				<span class="price"><i class="icofont-rupee"></i> 5310</span>
                			</div>
                			<div class="clearfix flt-date">
                				<span class="fc-date">18-09-2018</span>
                			</div>
                		</a>
                	</div>
                </div>
                <div class="item">
                	<div class="com-pro-col trans">
                		<a href="javascript:void(0)">
                			<div class="clearfix  fc-airline">
                				<img src="<?php echo site_url()?>assets/images/airlines//SG.gif" alt="com-logo">
                				<span class="price"><i class="icofont-rupee"></i> 5310</span>
                			</div>
                			<div class="clearfix flt-date">
                				<span class="fc-date">18-09-2018</span>
                			</div>
                		</a>
                	</div>
                </div>
                <div class="item">
                	<div class="com-pro-col trans">
                		<a href="javascript:void(0)">
                			<div class="clearfix  fc-airline">
                				<img src="<?php echo site_url()?>assets/images/airlines//SG.gif" alt="com-logo">
                				<span class="price"><i class="icofont-rupee"></i> 5310</span>
                			</div>
                			<div class="clearfix flt-date">
                				<span class="fc-date">18-09-2018</span>
                			</div>
                		</a>
                	</div>
                </div>
                <div class="item">
                	<div class="com-pro-col trans">
                		<a href="javascript:void(0)">
                			<div class="clearfix  fc-airline">
                				<img src="<?php echo site_url()?>assets/images/airlines/SG.gif" alt="com-logo">
                				<span class="price"><i class="icofont-rupee"></i> 5310</span>
                			</div>
                			<div class="clearfix flt-date">
                				<span class="fc-date">18-09-2018</span>
                			</div>
                		</a>
                	</div>
                </div>
                <div class="item">
                	<div class="com-pro-col trans">
                		<a href="javascript:void(0)">
                			<div class="clearfix  fc-airline">
                				<img src="<?php echo site_url()?>assets/images/airlines/SG.gif" alt="com-logo">
                				<span class="price"><i class="icofont-rupee"></i> 5310</span>
                			</div>
                			<div class="clearfix flt-date">
                				<span class="fc-date">18-09-2018</span>
                			</div>
                		</a>
                	</div>
                </div>
                <div class="item">
                	<div class="com-pro-col trans">
                		<a href="javascript:void(0)">
                			<div class="clearfix  fc-airline">
                				<img src="<?php echo site_url()?>assets/images/airlines//SG.gif" alt="com-logo">
                				<span class="price"><i class="icofont-rupee"></i> 5410</span>
                			</div>
                			<div class="clearfix flt-date">
                				<span class="fc-date">18-09-2018</span>
                			</div>
                		</a>
                	</div>
                </div>
                <div class="item">
                	<div class="com-pro-col trans">
                		<a href="javascript:void(0)">
                			<div class="clearfix  fc-airline">
                				<img src="<?php echo site_url()?>assets/images/airlines//SG.gif" alt="com-logo">
                				<span class="price"><i class="icofont-rupee"></i> 5410</span>
                			</div>
                			<div class="clearfix flt-date">
                				<span class="fc-date">18-09-2018</span>
                			</div>
                		</a>
                	</div>
				</div>
				
               </div>company promos -->

               <!-- Next Prev Button -->

              <div class="nxt-prev-btn clearfix mb-15">
                        <?php $currdate = $this->input->get("depart_date");
                    $yesterday = date('d-m-Y',strtotime($currdate  . "-1 days")); ?>

                  <a href="<?php echo site_url(); ?>flight/result?type=<?php echo $this->input->get("type"); ?>&from_location=<?php echo $this->input->get("from_location"); ?>&to_location=<?php echo $this->input->get("to_location"); ?>&to_city_code=<?php echo $this->input->get("to_city_code"); ?>&from_city_code=<?php echo $this->input->get("from_city_code"); ?>&depart_date=<?php echo $this->input->get("depart_date"); ?>&return_date=<?php echo $yesterday; ?>&no_adult=<?php echo $this->input->get("no_adult"); ?>&no_child=<?php echo $this->input->get("no_child"); ?>&no_infants=<?php echo $this->input->get("no_infants"); ?>&cabin_class=<?php echo $this->input->get("cabin_class"); ?>&preferred_airline=<?php echo $this->input->get("preferred_airline"); ?>" class="btn-org btn-flght"><i class="icofont-swoosh-left"></i> Previous Day</a>
                
                  <?php 
                    $tomorrow = date('d-m-Y',strtotime($currdate  . "+1 days")); ?>

                  <a href="<?php echo site_url(); ?>flight/result?type=<?php echo $this->input->get("type"); ?>&from_location=<?php echo $this->input->get("from_location"); ?>&to_location=<?php echo $this->input->get("to_location"); ?>&to_city_code=<?php echo $this->input->get("to_city_code"); ?>&from_city_code=<?php echo $this->input->get("from_city_code"); ?>&depart_date=<?php echo $this->input->get("depart_date"); ?>&return_date=<?php echo $tomorrow; ?>&no_adult=<?php echo $this->input->get("no_adult"); ?>&no_child=<?php echo $this->input->get("no_child"); ?>&no_infants=<?php echo $this->input->get("no_infants"); ?>&cabin_class=<?php echo $this->input->get("cabin_class"); ?>&preferred_airline=<?php echo $this->input->get("preferred_airline"); ?>" class="btn-flght bext-btn pull-right"> <i class="icofont-swoosh-right"></i> Next Day </a>

                </div><!-- Next Prev Button End -->	

               	<!-- Airline title -->
               	<div class="airline_title">
               		<div class="row">
               			<div class="col-md-2 col-sm-2">
               				<h5>Airline</h5>
               			</div>
               			<div class="col-md-2 col-sm-2">
               				<h5><a href="javascript:void(0s)">Depart</a></h5>
               			</div>
               			<div class="col-md-2 col-sm-2">
               				<h5><a href="javascript:void(0s)">Arrive</a></h5>
               			</div>
               			<div class="col-md-2 col-sm-2">
               				<h5><a href="javascript:void(0s)">Duration</a></h5>
               			</div>
               			<div class="col-md-2 col-sm-2">
               				<h5><a href="javascript:void(0s)">Price</a></h5>
               			</div>
               			<div class="col-md-2 col-sm-2">
               				<h5><a href="javascript:void(0s)">SNF</a></h5>
               			</div>
               		</div>
               	</div><!-- Airline title End -->
				
				<!-- Flight Details -->
				<div ng-repeat="flight in flights | filter:filterflights" class="refendable11 flght-result-col">
               		<div class="row airlines">
               			<div class="col-md-8 col-sm-8 col-xs-8 price1 no-padding-xs">
               				<div class="clearfix">
               					<div class="col-md-2 col-sm-3 col-xs-3 no-padding-xs pl-0">
               						<img src="<?php echo site_url()?>assets/images/airlines/{{flight.AirlineCode}}.gif" alt="com-logo">
               						<span class="text-center">{{flight.AirlineCode}} - {{flight.Segments[0][0].Airline.FlightNumber}}</span>
               					</div>

               					<div class="txt-tc col-md-7 col-sm-6 col-xs-6 no-padding-xs pl-10-xs">
               						<ul class="list-inline">
               							<li class="dep-dt">
               								<!-- <span> 00:05</span> -->
               								<span class="hidden-xs"> <span ng-controller="timeCtrl">{{flight.DepartureTime | date: 'HH:mm'}}</span></span>
               								<span class="ds-block">{{origin}}</span> 
               							</li>
               							<li class="arv-dt">
               								<!-- <span>04:10</span> -->
               								<span class="hidden-xs"> <span ng-controller="timeCtrl">{{flight.Segments[0][flight.Segments[0].length-1].StopPointArrivalTime | date: 'HH:mm'}}</span></span>
               								<span class="ds-block">{{destination}}</span> 
               							</li>
               						</ul>
               					</div>
               					<div class="col-md-3 col-sm-3 col-xs-3 no-padding-xs">
               						<div class="flght-duration">
									   	   
               							<p><span>{{flight.all_duration}}</span></p>
               							<p><span>{{flight.stops == 1 ? 'Non Stop' : flight.stops - 1 + ' Stop'}}</span></p>
               						</div>
               						
               					</div>
               				</div>
               			</div>
               			<div class="col-md-4 col-sm-4 col-xs-4 no-padding-xs">
               				<div class="col-md-7 col-sm-7 col-xs-12 no-padding">
                                <h3 class="airline_price"><i class="icofont-rupee"></i><span> {{flight.Fare.PublishedFare}} </span></h3>
                                <p class="for_net_fare_div none">{{flight.Fare.PublishedFare}}</p>
                            </div>
                            <div class="col-md-5 col-sm-5 col-xs-12 pr-0">
                            	<button type="button" ng-click="book(SrdvType,flight.SrdvIndex,TraceId,flight.ResultIndex,'<?php echo $searchID; ?>');"  class="btn costom_site_color w-100 booking_btn bookingbtnsubmit mb-10-xs" onclick="">Book</button>
                            	<p class="detail_btn show_details_btn hidden-xs" id="show_details_btn" data-class="showdtail_3"><a href="javascript:void(0)">Details</a></p>
                            </div>
               			</div>
               			<div class="clearfix"></div>
               			<div class="col-md-12 col-sm-12 col-xs-12 trip_details p-0 showdtail_3">
               				<div class="flght-col-details clearfix">

									<div class="col-md-9 col-sm-9 col-xs-9 p-0">
										<div ng-repeat="flight_segments in flight.Segments[0]" class="row airlines short_trip_details">
											<div class="flight_name">{{flight_segments.Origin.AirportCode}} → {{flight_segments.Destination.AirportCode}}| <small><span ng-controller="timeCtrl">{{flight_segments.DepTime | myDatetimeFilter }}</span></small></div>
											<div class="col-md-1 col-sm-1 col-xs-1 p-0">
												<img src="<?php echo site_url()?>assets/images/airlines/{{flight_segments.Airline.AirlineCode}}.gif" >
												
												<p>{{flight.AirlineCode}} - {{flight.Segments[0][0].Airline.FlightNumber}}</p>
											</div>
											<div class="col-md-3 col-sm-3 col-xs-3">
												<label>
													<p><label class="depart-arr">DEP</label><span>{{flight_segments.Origin.AirportCode}}</span></p>
													<p><span ng-controller="timeCtrl">{{flight_segments.DepTime | myDatetimeFilter }}</span></p>
													<p class="terminal_details">Terminal 2,<br>{{flight_segments.Origin.AirportName}}</p>
												</label>
											</div>
											<div class="col-md-5  col-sm-5 col-xs-5 no-padding fly-fl-time">
												<p class="text-center"><i class="icofont-clock-time"></i> <span ng-controller="MainCtrl">{{ flight_segments.Duration | myDateFilter }}</span></p>
												<p class="dots"><i class="icofont-airplane plane_horiz"></i></p>
												<p class="text-center">Fare Class: {{flight_segments.Airline.FareClass}}&nbsp;|&nbsp; 
												<span class="refund" ng-if="flight.IsRefundable == '1'"> Refundable </span> <span class="nonrefund" ng-if="flight.IsRefundable == '0'"> Non-Refundable </span></p>
											</div>
											<div class="col-md-3 col-sm-3 col-xs-3">
												<label>
													<p><label class="depart-arr">ARR</label><span>{{flight_segments.Destination.AirportCode}}</span></p>
													<p style="margin-bottom: 3px;"><span ng-controller="timeCtrl">{{flight_segments.ArrTime | myDatetimeFilter }}</span></p>
													<p class="terminal_details">Terminal ,<br>{{flight_segments.Destination.AirportName}}</p>
												</label>
											</div>
										</div>
									</div>
								   
               					<div class="col-md-3 col-sm-3 col-xs-3 fare-break-up p-0">
                                    <div class="col-md-12 col-sm-12 col-xs-12 flight_name p-0">Fare breakup</div>
                                    <div class="row airlines short_trip_details">
                                        <ul class="fare_details">
                                            <li>Base Fare <span class="pull-right"><i class="icofont-rupee"></i> {{flight.Fare.BaseFare}}</span></li>
                                            <li>Tax (+)<span class="pull-right"><i class="icofont-rupee"></i> {{flight.Fare.Tax + flight_result.Fare.OtherCharges }}</span></li>
                                            <li>Total Fare<span class="pull-right"><i class="icofont-rupee"></i>{{flight.Fare.PublishedFare}}</span></li>
                                        </ul>
                                    </div>
                                </div>
               				</div>
               			</div>
               			<div class="clearfix"></div>
               			<div class="airline_footer col-md-12">
               				<ul class="list-inline clearfix">
               					<li class="fare-rules">
               						<a ng-click="getFareRule(SrdvType,flight.SrdvIndex,TraceId,flight.ResultIndex,'<?php echo $searchID; ?>');"  href="#farerule" >
               							<i class="icofont-hand-right"></i> Fare Rules
               						</a>
               					</li>
               					<li><i class="icofont-shopping-cart"></i> Baggage : {{flight.Segments[0][0].Baggage}} </li>
               					<li><i class="icofont-luggage"></i> Cabin Baggage : {{flight.Segments[0][0].CabinBaggage}} </li>
               					<li class="seats"><i class="icofont-chair"></i> Seat(s) Left! : {{flight.Segments[0][0].NoOfSeatAvailable}}</li>
               					<li class="pull-right"> <span class="refund" ng-if="flight.IsRefundable == '1'"> <i class="icofont-rupee-true"></i> Refundable </span> <span class="nonrefund" ng-if="flight.IsRefundable == '0'"> <i class="icofont-rupee-true"></i> Non-Refundable </span> </li>
               				</ul>
               			</div>
               		</div>
				   </div>
				
				   <!-- Flight Details End-->
				   
           </div>
          </div>
        </div>
      </div>
    </div>
	<div class="modal fade" id="modify_search" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modify Search</h4>
        </div>
        <div class="modal-body">
				<form class="modify-form" id="search_form" action="<?php echo site_url(); ?>flight/result" method="get">
		       <div class="form-group col-md-12">
		       <label class="radio-inline">
						 <input type="radio" value="Return" id="returnid" name="type" <?php if($requestdata['type'] =='Return') { echo "checked"; }?> />	Round Trip
					</label>
				<label class="radio-inline">
				  <input type="radio" value="OneWay" id="onwayid" name="type" <?php if($requestdata['type'] =='OneWay') { echo "checked"; }?> />One Way
				</label>

				<!-- <label class="radio-inline">
				  <input type="radio" value="MultiWay" id="MultiWayid" name="type" <?php if($requestdata['type'] =='MultiWay') { echo "checked"; }?> />Multi City
				</label> -->

				</div>
				<div class="clearfix"></div>
				<samp  class="oneway_box display_inline"> 
								<div class="form-group col-md-3">
									   <input type="text" class="form-control pax_validation_field" name="from_location" value="<?php echo $search_data["from_location"]; ?>"  id="flight_from0"  placeholder="City or airport" required onkeyup="flight_suggest(this.value,0);" onblur="bp_fill();" autocomplete="off"/>
										<div class="suggestionsBox"  id="flight_suggestions0"  style="display: none;">
											<div class="suggestionList"  id="flight_suggestionsList0">&nbsp;</div>
										</div>
									

									</div>
 
									<!-- <i class="fa fa-exchange exch-icon hidden-xs"></i> -->
										<div class="form-group col-md-3">
										<input class="form-control pax_validation_field" type="text" id="flight_from_to0" name="to_location" value="<?php echo $search_data["to_location"]; ?>"  placeholder="City airport" required onkeyup="flight_suggest_to(this.value,0);" onblur="bp_fill_to();" autocomplete="off"/>
										<span style="display: none" id="tolocation"></span>
											<span style="display: none" id="fromlocation"></span>
											<input type="hidden" name="from_country" id="flight_from_country0" value="<?php echo $search_data["from_country"]; ?>">
											<input type="hidden" name="to_country" id="flight_from_to_country0" value="<?php echo $search_data["to_country"]; ?>">
											<input type="hidden" name="from_city_code" id="flight_from_city0" value="<?php echo $search_data["from_city_code"]; ?>" >
                                            <input type="hidden" name="to_city_code" id="flight_from_to_city0" value="<?php echo $search_data["to_city_code"]; ?>">
										<div class="suggestionsBox" id="flight_suggestions_to0"  style="display: none; ">
												<div class="suggestionList" id="flight_suggestionsList_to0">&nbsp;</div>
											</div>
									
										</div> 
										<div class="form-group  col-md-3">
										<input type="text" id="depart_date" class="form-control pax_validation_field dpart-d-rdonl" value="<?php echo $search_data["depart_date"]; ?>" name="depart_date" placeholder="Depart Date" required readonly>
								</div>
								 <div class="form-group col-md-3">
										<input type="text" id="return_date" value="<?php if($requestdata["type"] != 'MultiWay'){ echo $requestdata["return_date"]; }  ?>"  class="form-control "  name="return_date" placeholder="DD/MM/YYYY" readonly>
									</div>
					</samp>
					<samp class="mulitycity_box display_none"> 

									<div class="form-group col-md-3">
									   <input type="text" class="form-control pax_validation_field_multi" name="from_location_1" id="flight_from1" value="<?php if($requestdata['type'] =='MultiWay'){ echo $search_data["from_location_1"];} ?>"  placeholder="City(1) or airport" required onkeyup="flight_suggest(this.value,1);" onblur="bp_fill();" autocomplete="off"/>
										<div class="suggestionsBox" id="flight_suggestions1" style="display: none;">
											<div class="suggestionList" id="flight_suggestionsList1">&nbsp;</div>
										</div>
									</div>
 
									<!-- <i class="fa fa-exchange exch-icon hidden-xs"></i> -->
										<div class="form-group col-md-3">
										<input class="form-control pax_validation_field_multi" type="text" id="flight_from_to1" name="to_location_1" value="<?php if($requestdata['type'] =='MultiWay'){ echo $search_data["to_location_1"];} ?>"  placeholder="City(1) airport" required onkeyup="flight_suggest_to(this.value,1);" onblur="bp_fill_to();" autocomplete="off"/>
										<span style="display: none" id="tolocation"></span>
											<span style="display: none" id="fromlocation"></span>
											<input type="hidden" name="from_country_1" id="flight_from_country1">
											<input type="hidden" name="to_country_1" id="flight_from_to_country1">
										<div class="suggestionsBox" id="flight_suggestions_to1" style="display: none; ">
												<div class="suggestionList" id="flight_suggestionsList_to1">&nbsp;</div>
											</div>
										</div> 
										<div class="form-group col-md-3 ">
											<input type="text" id="city1" class="form-control pax_validation_field_multi" name="depart_date_1" value="<?php  if($requestdata['type'] =='MultiWay'){ echo $search_data["depart_date_1"];} ?>" placeholder="City(1) Depart Date" required>
										</div>

									</samp>

									

									<div class="mulitycity_box mulitycity_append  display_none"> 
									
									<?php for($k=2; $k<=$no_of_city; $k++) { ?>

										<div class="mt-10 col-md-12 removeroute<?php echo $k; ?>" style="padding-right: 0px; padding-left: 0px;">
											<div class="form-group col-md-3">
											<input type="text" class="form-control pax_validation_field_multi" name="from_location_<?php echo $k; ?>" id="flight_from<?php echo $k; ?>" value="<?php if($requestdata['type'] =='MultiWay'){ echo $search_data["from_location_".$k];} ?>"  placeholder="City(<?php echo $k; ?>) or airport" required onkeyup="flight_suggest(this.value,<?php echo $k; ?>);" onblur="bp_fill();" autocomplete="off"/>
												<div class="suggestionsBox" id="flight_suggestions<?php echo $k; ?>" style="display: none;">
													<div class="suggestionList" id="flight_suggestionsList<?php echo $k; ?>">&nbsp;</div>
												</div>
											</div>
											<div class="form-group col-md-3">
												<input class="form-control pax_validation_field_multi" type="text" id="flight_from_to<?php echo $k; ?>" name="to_location_<?php echo $k; ?>" value="<?php if($requestdata['type'] =='MultiWay'){ echo $search_data["to_location_".$k]; } ?>"  placeholder="City(<?php echo $k; ?>) or airport" required onkeyup="flight_suggest_to(this.value,<?php echo $k; ?>);" onblur="bp_fill_to();" autocomplete="off"/>
												<span style="display: none" id="tolocation"></span>
												<span style="display: none" id="fromlocation"></span>
												<input type="hidden" name="from_country_<?php echo $k; ?>" value="from_country_<?php echo $k ?>" id="flight_from_country2">
												<input type="hidden" name="to_country_<?php echo $k; ?>" value="to_country_<?php echo $k ?>" id="flight_from_to_country2">
												<div class="suggestionsBox" id="flight_suggestions_to<?php echo $k; ?>" style="display: none; ">
													<div class="suggestionList" id="flight_suggestionsList_to<?php echo $k; ?>">&nbsp;</div>
												</div>
											</div> 
											<div class="form-group col-md-3">
												<input type="text" id="city<?php echo $k; ?>" class="form-control pax_validation_field_multi" value="<?php if($requestdata['type'] =='MultiWay'){ echo $search_data["depart_date_".$k]; } ?>" name="depart_date_<?php echo $k; ?>" placeholder="City(<?php echo $k; ?>) Depart Date" required>
											</div>
											<div class="form-group col-md-3">
												<?php if($k >= 3) { ?>
													<span><i class="fa fa-times remove_btn" id="removeroute<?php echo $k?>"></i></span>
												<?php } else {echo "&nbsp";} ?>
											</div>
										</div>
										
									<?php } ?>
								 </div>
								

									<div class="mulitycity_box add_more col-md-12 mt-10 display_none">
											<label><a href="javascript:;" class="addroute"><i class="fa fa-plus-circle"></i> Add City</a></label>
									</div>
							
			 
			  <div class="form-group col-md-4 ">
									<select name="no_adult" class="form-control adult_select pax_validation_field" >
											<?php for($i=1; $i<=9; $i++) { 
												if ($i == $this->input->get("no_adult")) { ?>
														<option selected value="<?php echo $i ?>"><?php echo $i ?></option>
											<?php } else { ?>
														<option value="<?php echo $i ?>"><?php echo $i ?></option>
											<?php } } ?>
										
									</select>
									</div>
									<div class="form-group col-md-4">
									<select name="no_child" class="form-control child_select pax_validation_field" >
													
													<?php for($j=0; $j<=9-$this->input->get("no_adult"); $j++  ) {
														if($j == $this->input->get("no_child") ){?>
															
															<option selected value="<?php echo $j; ?>"><?php echo $j; ?></option>
																								<?php } else{ ?>
												    	
															<option value="<?php echo $j; ?>"><?php echo $j; ?></option>
														
													<?php	} } ?>
												</select>
									</div>
									<div class="form-group col-md-4">
									<select name="no_infants" class="form-control infant_select pax_validation_field" >
									
									<?php for($k=0; $k<=$this->input->get("no_adult"); $k++  ) {
										if($k == $this->input->get("no_infants") ){ ?>
											<option selected value="<?php echo $k; ?>"><?php echo $k; ?></option>
											
										<?php } else{ ?>
											
											<option value="<?php echo $k; ?>"><?php echo $k; ?></option>
										
									<?php	} } ?>
									
									
								</select>
									</div>	
               <div class="form-group col-md-4 ">
								<select name="cabin_class" class="form-control">
													<option <?php if($this->input->get("cabin_class")==6){echo "selected";} ?> value="6" >First</option>
													<option <?php if($this->input->get("cabin_class")==2){echo "selected";} ?> value="2" >Economy</option>
													<option <?php if($this->input->get("cabin_class")==4){echo "selected";} ?>value="4">Business</option>		
							</select>
			  </div>
											
			  <div class="form-group col-md-4">
			  <button type="button" id="submit_btn" style="width:100%" class="btn btn-custom"><i class="fa fa-search"></i> Search</button>
			  </div>
			</form>
        </div>
		<div class="clearfix"></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

 <!-- Modal Confirm Price-->
   <div class="modal fade" id="confirmprice" role="dialog">
    <div class="modal-dialog" style="width: 450px;">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="padding: 10px; text-align: center;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4><span class="fa fa-lock"></span> We Confirming Price... </h4>
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
		<div class="modal-dialog modal-lg" style="width:77%">
			<!-- Modal content-->
			<div class="modal-content" style="border-radius: 0px;">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Fare Rule</h4>
				</div>
				<div class="modal-body">
					<div id="loadfarerule" class="text-align-center container-auto" style="text-align: justify">
						<div class="text-align-center">
							<img style="width:60%" src="<?php echo site_url(); ?>/assets/images/loading1.gif">
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

<?php $this->load->view('footer') ?>
<?php $this->load->view('js'); ?>
<script>
	var result = <?php echo json_encode($resultdata); ?>;
	console.log(result);
	var app = angular.module("myApp", ['rzModule']);
	app.controller("myCtrl", function($scope) {
		$scope.records			 = result;
		$scope.flights			 = result.Results[0];
		$scope.flightsreturns	 = [];
		$scope.all_datas 		 = null;
		$scope.srdvType 		 = null;
		$scope.airlines_names    = [];
		$scope.origin            = result.Origin ;
		$scope.destination       = result.Destination;
		$scope.SrdvType 		 = result.SrdvType;
		$scope.TraceId 			 = result.TraceId;
		var flight;
		
		$scope.departure_time = function(time, for_format) {
			var datehourede	
			if (for_format) {
				datehourede = moment(time).utcOffset('+05:30').format('ddd, DD MMMM, hh:mm A');
				return datehourede;
			}	
			datehourede = moment(time).utcOffset('+05:30').toObject();		
			var departure_at = datehourede.hours + '.' + datehourede.minutes
			return departure_at;
		}

		$scope.stops = [1, 2, 3]
			// filtering stops
		$scope.filter_stops = function(s_index) {
			var i = $.inArray(s_index, $scope.stops);
			if (i > -1) {
				$scope.stops.splice(i, 1);
			} else {
				$scope.stops.push(s_index);
			}
			return ;
		}

		// filtering  airlinename
		$scope.airlines_names = []
		$scope.filter_airlines_name = function(airline) {
			var i = $.inArray(airline, $scope.airlines_names);
			if (i > -1) {
				$scope.airlines_names.splice(i, 1);
			} else {
				$scope.airlines_names.push(airline);
			}
			return ;
		}



		$scope.fare_types = [1, 2]
			// filtering  fare type
			$scope.filter_refundable = function(r_index) {
				var i = $.inArray(r_index, $scope.fare_types);
				if (i > -1) {
					$scope.fare_types.splice(i, 1);
				} else {
					$scope.fare_types.push(r_index);
				}
				return ;
		}
		$scope.timing = [1, 2, 3, 4]
			// filtering timing datas
			$scope.filter_timing = function(de_index) {
				var i = $.inArray(de_index, $scope.timing);
				if (i > -1) {
					$scope.timing.splice(i, 1);
				} else {
					$scope.timing.push(de_index);
				}
				return ;
			}


		//maping flight data function

		$scope.mappingdata = function(flights) {
			flights.map((flight, i, arr) => {

				angular.forEach($scope.airlines, function(value, key){
					if (flight.AirlineCode == value.code) {
						flight['airlineName'] = value.name
					}
				});
				
				flight['id'] = i + 1
				var dep_time = $scope.departure_time(flight.Segments[0][0].StopPointDepartureTime)
				// adding dep_time_index
				if (dep_time >= 0 && dep_time <= 6) {
					flight['dep_time_cat'] = 1
				} else if(dep_time >= 6 && dep_time <= 12){
					flight['dep_time_cat'] = 2
				} else if (dep_time >= 12 && dep_time <= 18){
					flight['dep_time_cat'] = 3
				}else{
					flight['dep_time_cat'] = 4
				}
				// adding stops time
				if (flight.Segments[0].length == 1) {
					flight['stops'] = 1
				} else if(flight.Segments[0].length == 2){
					flight['stops'] = 2
				} else{
					flight['stops'] = 3
				}

				// adding fare_types
				if (flight.IsRefundable) {
					flight['fare_type'] = 1
				}else{
					flight['fare_type'] = 2
				}

				// adding departure date time
				flight['DepartureTime'] = flight.Segments[0][0].StopPointDepartureTime
				// adding arrival date time
				flight['arrivalTime'] = flight.Segments[flight.Segments.length - 1][0].StopPointArrivalTime
				// adding all duration
				flight['all_duration'] = $scope.all_duration(flight.Segments, 1)

				if (flight.AirlineRemark) {
					var remarksflight = flight.AirlineRemark.toUpperCase()
					var smeindex  = remarksflight.search("SME")
					if (smeindex >= 0) {
						flight['isSme'] = 1
					}else{
						flight['isSme'] = 0
					}
				} else {
					flight['isSme'] = 0
				}
					
					return flight;
			});
			
			return flights;
		}



		$scope.all_duration = (segments, repeat) => {
			var dur_tim = 0;
				var arrival_f = moment(segments[0][segments[0].length-1].StopPointArrivalTime);
				var departure_f = moment(segments[0][0].StopPointDepartureTime);
				var durtime_obj_f = moment.duration(arrival_f.diff(departure_f)).asMinutes()
				// console.log(departure_f);
				dur_tim = durtime_obj_f
			if (repeat == 1) {
				var durtime = moment.duration(dur_tim * 60 * 1000)
				var durationtime =  durtime.get('hours') +'h ' + durtime.get('minutes') + 'm'

				return durationtime;

			}
			return dur_tim;
		}

		$scope.filtering_flight = (type, value, is_for_flight_count) => {
			var total_flights
			if (type == "stops") {
				total_flights = $scope.all_datas.filter(flight => flight.stops == value);
			} else if (type == "airlines") {
				//total_flights = $scope.all_datas.filter(flight => flight.AirlineCode == $scope.airline_code_fun(value));
			} else if (type == "timing") {
				total_flights = $scope.all_datas.filter(flight => flight.dep_time_cat == value);
			} else {
				total_flights = $scope.all_datas.filter(flight => flight.fare_type === value);
			}
			if (is_for_flight_count == 1) {
				return total_flights;
			} else {
				if (total_flights.length > 0) {
					return true;
				} else {
					return false;
				}
			}
		}

		// finding minimum value 
		$scope.filter_min_price = (type, value) => {
			return Math.min.apply(Math,$scope.filtering_flight(type, value, 1).map(function(flight){return flights.Fare.PublishedFare;}));
		}

		// filter functions
		$scope.filterflights = function(flights) {
				
				if ($scope.timing.length > 0) {
					 console.log($.inArray(flights.dep_time_cat, $scope.timing));
					if ($.inArray(flights.dep_time_cat, $scope.timing) < 0) {
						return ;
					}
				}

				// if ($scope.isSmeArrays.length > 0) {
				// 	if ($.inArray(flights.isSme, $scope.isSmeArrays) < 0) {
				// 		return ;
				// 	}
				// }

				if ($scope.stops.length > 0) {
					if ($.inArray(flights.stops, $scope.stops) < 0) {
						return ;
					}
				}

				if ($scope.fare_types.length > 0) {
					if ($.inArray(flights.fare_type, $scope.fare_types) < 0) {
						return ;
					}
				}
                
				if ($scope.airlines_names.length > 0) {
					if ($.inArray(flights.Segments[0][0].Airline.AirlineName, $scope.airlines_names) < 0) {
						return ;
					}
				}

				if ($scope.min > 0 && $scope.max > 0 ) {
				//	console.log(flights.Fare.PublishedFare);
					return (flights.Fare.PublishedFare >= $scope.slider.minValue && flights.Fare.PublishedFare <= $scope.slider.maxValue);
				}

				return flights;
			}


        // end mappingdata

		$scope.flights = $scope.mappingdata($scope.flights)
		$scope.flightsreturns = $scope.mappingdata($scope.flightsreturns)
		$scope.all_datas = $scope.flights.concat($scope.flightsreturns);

		angular.forEach($scope.all_datas, function(value, key){				
			if(!$scope.airlines_names.includes(value.Segments[0][0].Airline.AirlineName)){
				$scope.airlines_names.push(value.Segments[0][0].Airline.AirlineName);
			}
		})

		$scope.airlinnameshow = angular.copy($scope.airlines_names);
		$scope.min = Math.floor(Math.min.apply(Math,$scope.all_datas.map(function(item){return item.Fare.PublishedFare;}))/1000)*1000
		$scope.max = Math.ceil(Math.max.apply(Math,$scope.all_datas.map(function(item){return  item.Fare.PublishedFare;}))/1000)*1000

		console.log($scope.min);
		console.log($scope.max);

		$scope.slider = {
			minValue: $scope.min,
			maxValue: $scope.max,
			options: {
				floor: $scope.min,
				ceil: $scope.max,
				translate: function(value) {
					return value;
				}
			}
		};

		// fare rule
		$scope.getFareRule = function(SrdvType,SrdvIndex,TraceId,ResultIndex,search_id) {  
			getFareRule(SrdvType,SrdvIndex,TraceId,ResultIndex);
		};

		// fare Book
		$scope.book = function(SrdvType,SrdvIndex,TraceId,ResultIndex,search_id) {  
			book_now(SrdvType,SrdvIndex,TraceId,ResultIndex,search_id);
		};
		
			
		// garbage
		var airline_list = new Array();	
		//var total_duration = new Array();
		for(var i = 0; i < result.Results[0].length; i++){
			for(var j = 0; j < result.Results[0][i].Segments.length; j++){
				var per_segment_duration = 0;
				//console.log(result.Results[0][i].Segments[j]);
				for(var k=0; k < result.Results[0][i].Segments[j].length; k++ ){
					airline_data = {
						airline_code:result.Results[0][i].Segments[j][k].Airline.AirlineCode,
						airline_name:result.Results[0][i].Segments[j][k].Airline.AirlineName
					}	
				}
			}
		}
		$scope.airline = airline_list;
		//grabage





	});

	app.controller('MainCtrl', function($scope) {})
	.filter('myDateFilter', ['$filter',
		function($filter) {
			return function(input) {
				var num = input;
				var hours = (num / 60);
				var rhours = Math.floor(hours);
				var minutes = (hours - rhours) * 60;
				var rminutes = Math.round(minutes);
				return  rhours + " H : " + rminutes + " M	";
			}
		}
	]);
	
	app.controller('timeCtrl', function($scope) {})
	.filter('myDatetimeFilter', ['$filter',
		function($filter) {
			return function(input) {
				var str = input;
				var res = str.split("T");
				var date = res[0];
				var time = res[1].slice(0, 5);;
				return  date + " | " + time;
			}
		}
	]);


</script>
<script>
function flight_suggest(inputString,id) {
	
	$( "#flight_from"+id ).autocomplete({
	autoFocus: true,	
	minLength : 3,
	source : function(request, response) {
	$.ajax({
		type: "POST",
		url: "<?php echo site_url();?>front/fetch_city",
		dataType : "json",
		cache : false,
		data: {id: inputString,div_id:id},
		success: 
		function(data){
			console.log(data.length);
			var all_l=[];
			for(var i=0;i<data.length;i++)
			{
				   var city_name=data[i].airport_city_name; 
			var air_name=data[i].airport_name; 
			var air_code=data[i].airport_code;
			var air_country_code=data[i].airport_country_code; 
			var air_city_code = data[i].airport_city_code;
			all_l.push({ "label": city_name+" ("+air_name+"), "+air_code, "value": city_name+" ("+air_name+"), "+air_code, "country": air_country_code,"city": air_city_code } );

			}
				response(all_l);
		}	
	});	  
	
},
select: function(event, ui) {

 $( "#flight_from_country"+id).val(ui.item.country);	
$( "#flight_from_city"+id).val(ui.item.city);	
$( "#flight_from_to"+id).focus();	
	
},
});    
	
	
}
function flight_suggest_to(inputString,id) {
	$( "#flight_from_to"+id ).autocomplete({
	autoFocus: true,	
	minLength : 3,
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
			var air_city_code = data[i].airport_city_code;
			all_l.push({ "label": city_name+" ("+air_name+"), "+air_code, "value": city_name+" ("+air_name+"), "+air_code, "country": air_country_code,"city": air_city_code } );

			}
			response(all_l);
		
		}	
	});	  
	
},
select: function(event, ui) {


$( "#flight_from_to_country"+id ).val(ui.item.country);	
$( "#flight_from_to_city"+id ).val(ui.item.city);	
$( "#depart_date" ).focus();
	
},
});    

	   
}
</script>
