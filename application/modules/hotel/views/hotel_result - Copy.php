
<?php $this->load->view('header');?>
<?php 
$result=$_SESSION ['hotel'] ['array'] ['search_result']->Results;
$bp_search_request=$_SESSION ['hotel'] ['search_data'];
$bp_result_count=count($result);
?>
 <!-- Search Result info -->
 <div class="search-result-info htl-search-res-top">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="total-htl-count">
              <p><?php echo $bp_search_request['cityName']; ?>,  <?php echo date_format(date_create($bp_search_request['checkIn']),"D d M Y");?>, <?php echo $bp_search_request['nights']?> Nights, <?php echo $bp_search_request['room']?> Rooms, <span class="font-size-14"><?php echo $bp_result_count;?> Results Found</span></p>
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
             <div class="modify-srearch-btn">
              <button type="" data-toggle="modal" data-target="#modify_search_htl" class="btn btn-org btn-flght"><i class="icofont-search"></i> Modify Search</button>
            </div>
          </div>
        </div>
      </div>
    </div><!-- Search Result info End -->

    <div class="main-field">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-3 col-sm-12 hotelBox sidebar-wrap" id="filter_xs_slide">
            <div class="filter-search-bar">
              <!-- <div class="flight_count search-results-title">
              	<h5>194 Hotels found</h5>
              </div> -->
              <div class="sidebar_title">Search Filter</div>
              <div class="row price_filter">
              	<div class="row_sidebar_title">
              		<h4><i><?php echo $this->bp_white_label_setting->wls_currency_symbol;?></i> Filter By Price <a href="#none" class="resetall pull-right filter_price_reset">Reset</a></h4>
              	</div>
              	<div class="row_sidebar_contant range-slider">
              	
                  <div class="inp-rng-wrap"><input type="text" id="amount" readonly></div>
                  <div id="price_filter_slider"></div>

                  <!-- <label for="amount">Price range:</label>
                  <input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;"> -->
              	</div>
              </div>
              <div class="row price_filter">
              	<div class="row_sidebar_title">
              		<h4><i class="icofont-hotel"></i> Filter By Hotel Name <a href="#none" class="resetall pull-right" hotel-name-reset="true">Reset</a></h4>
              	</div>
              	<div class="row_sidebar_contant filterby-htl-name">
                  <input class="form-control" placeholder="Enter Hotel Name" id="hotel_name" type="text" >
                </div>
              </div>

              <div class="row price_filter htl-star-rating">
                    <div class="row_sidebar_title">
                        <h4><i class="icofont-5-star-hotel"></i> Hotel Star Rating <span class="pull-right"></span></h4>
                    </div>
                    <div class="row_sidebar_contant htl-star-rating-wrap">
                        <form>
                            <?php for ($i = 1; $i <= 5; $i++) { ?>
															<div class="checkbox cstm-check">
																<label><input class="rating_star" type="checkbox" check_see="0" value="<?php echo $i; ?>"><span><?php
																	
																		echo $i." Star";
																		
																		for($bp_j=1;$bp_j<=$i;$bp_j++){?>
																			<i class="icofont-star yellow-star"></i>
																	<?php 	}
																	
																	?></span>
										          </label>
                                         </div>
																<?php } ?>
                        </form>
                    </div>
                </div>

                <div class="row price_filter">
              	<div class="row_sidebar_title">
              		<h4><i class="icofont-map"></i> Filter By Locations  <a href="#none" class="resetall pull-right filter_location_reset">Reset</a></h4>
              	</div>
              	<div class="row_sidebar_contant filterby-htl-name">
                <input class="form-control" placeholder="Enter Location" id="filter_location" type="text" >
              	</div>
              </div>
            </div>
            <a href="#" id="filter_click_submit" class="btn search-btn hidden xs-show filter_click_submit"><i class="icofont-filter"></i> Show Result</a>
          </div>

          <div class="col-lg-9 col-md-9 col-sm-12" id="">
            <div class="flght-search-result-right htl-listing-result">
              <div class="filt-btn-mob">
                <a href="javascript:void" id="filter_btn" class="btn-org btn-flght hidden xs-show filter-btn"><i class="icofont-filter"></i> Filter</a>
              </div>

            <?php foreach($result as $key => $results){
                 $customer_fare=$results->Price->PublishedPriceRoundedOff;
                 $customer_fare=dsa_currency_convert($customer_fare);
                 $totol_price[]=$customer_fare;
                 $total_StarRating[]=$results->StarRating;
                 $address = explode(",",$results->HotelAddress);
                 $address_list[] = "";	
                 $hotel_name_list[] = "";
				 //
				 $publish_fare = $results->Price->PublishedPriceRoundedOff;
				$offer_fare =   $results->Price->OfferedPriceRoundedOff;
				$markup_discount = bp_get_hotel_fare($offer_fare,$publish_fare);
				
                 foreach($address as $ad){
                   if(empty($ad)){
                   }else{
                     if(in_array($ad,$address_list)){	
                     }else{
                       if($_SESSION ['hotel'] ['search_data']['cityName']){
                         $replacedata = str_replace($_SESSION ['hotel'] ['search_data']['cityName'],"",$ad);
                       }
                       $address_list[]=$replacedata;
                     }
                   }
                 }
                 $hotel_name_list[]=$results->HotelName;
                ?> 
          <div class="rating_str" rating="<?php echo $results->StarRating; ?>">
            <div class="price_div" price="<?php echo $customer_fare; ?>">
            <div class="address_div" address="<?php echo $results->HotelAddress;?>">
             <div class="hotel_name_div" hotel-name="<?php echo $results->HotelName;?>" address="<?php echo $results->HotelAddress;?>">
              
              <div class="htl-listing-result-wrap">
                <div class="row">
                  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="htl-listing-img">
                      <img src="<?php echo $results->HotelPicture;?>" alt="htl-royal">
                    </div>
                  </div>
                  <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                    <div class="htl-listing-desc">
                      <h3 class="htl-name"><?php echo $results->HotelName;?></h3>
                      <div class="htl-add">
                        <span class="area"><i class="icofont-google-map"></i> : <?php echo $results->HotelAddress;?></span>
                      </div>
                      <div class="html-shrt-desc">
                        <p><?php echo bp_word_limit($results->HotelDescription, "160");?></p>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 pos-inherit">
                    <div class="htl-listing-price text-center">
                      <div class="htl-price-list  mb-10">
                        <span><?php echo $this->bp_white_label_setting->wls_currency_symbol;?> <?php echo $markup_discount['final_fare'] ; ?></span>
                      </div>
                      <div class="htl-view-list">
                        <form action="<?php echo site_url();?>hotel/booking_detail" method="post">
                                <input type="hidden" name="result_index" value="<?php echo $results->ResultIndex;?>">
                                <input type="hidden" name="s_index" value="<?php echo $results->SrdvIndex;?>">
                                <input type="hidden" name="array_index" value="<?php echo $key;?>">
                                <input type="hidden" name="hotel_code" value="<?php echo $results->HotelCode;?>">
                                <input type="hidden" name="hotel_name" value="<?php echo $results->HotelName;?>">
                                <input type="hidden" name="image" value="<?php echo $results->HotelPicture;?>">
                                <button type="submit" class="btn btn-org">View Detail</button>
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

            <?php } ?>

           
            </div>
          </div>
        </div>
      </div>
    </div>





		<script>
$(".bp_hotel_info_find").click(function(){
		$('#hotel_confirm_pop_up').modal('show'); 
});
</script>
<?php $this->load->view('footer') ?>
<?php $this->load->view('hotel/js') ?>

<!-- Modify Hotel Search -->
<div class="modal fade" id="modify_search_htl" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title text-center">Modify Search</h4>
        </div>
        <div class="modal-body">
          <?php $this->load->view("hotel_search_home"); ?>
        </div>
        <div class="clearfix"></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
<!-- Modify Hotel Search End -->
<div id="hotel_confirm_pop_up" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1111" aria-hidden="true">
			<div class="modal-dialog ">				
				<div class="modal-content">					
					<div class="modal-body">
						<div class="row">							
							<div class="col-sm-12 col-md-12 modal-body-right">
								<div class="inner">
									<form>
										<div class="row">
										        <div class="col-sm-12 col-md-12">
													<div class="text-align-center" style="color:#000">
												       	<img src="<?php echo site_url(); ?>/assets/images/loading.gif">
														<h3 style="font-size: 20px;">Please Wait, We are finding Hotel Information</h3>
														<span class="block midfz">Do not refresh or close the Window</span>
												</div>
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

    <script>
// Filter by Hotel Name-----------------
var h_name = <?php echo json_encode($hotel_name_list) ?>;
$( "#hotel_name" ).autocomplete({
	source: h_name,
	select: function(event, ui) {
		$(".hotel_name_div").each(function(){
				if($(this).attr("hotel-name") == ui.item.label)
				{
					$(this).show();	
				}
				else
				{
					$(this).hide();
				}
		});	 
	},
});
$(".hotel_name_reset").click(function(){
	$(".hotel_name_div").show();
});
// Filter by Hotel Location -----------
var lst = <?php echo json_encode($address_list) ?>;
	$( "#filter_location" ).autocomplete({
		source: lst,
		select: function(event, ui) {
			$(".address_div").each(function(){
				var adddddd = $(this).attr("address");
				var splitadd = (ui.item.label).split(" ");
				var length = 0;
				if(splitadd.length > 5){
					length =5;
				}else{
					length =splitadd.length;
				}
				for (var sdsd = 0; sdsd < length; sdsd++) {
         
					if (adddddd.indexOf(splitadd[sdsd]) >-1) {
						console.log("inside====="+splitadd[sdsd]);
						$(this).show();	
					}
					else{
						$(this).hide();
					}
			}
			});	 
		}
	});
	$(".filter_location_reset").click(function(){
		$(".address_div").show();
	});
// Filter By Price---------
  $(function() {
    $( "#price_filter_slider" ).slider({
      range: true,
      min: <?php echo min($totol_price); ?>,
      max: <?php echo max($totol_price); ?>,
      values: [ <?php echo min($totol_price); ?>, <?php echo max($totol_price); ?> ],
      slide: function( event, ui ) {
        $( "#amount" ).val( "<?php echo $this->bp_white_label_setting->wls_currency_symbol;?>" + "" + ui.values[ 0 ] + "  - <?php echo $this->bp_white_label_setting->wls_currency_symbol;?>" + ui.values[ 1 ] );
		var i=0;
		var j=0;
		$(".price_div").each(function(){
		     if($(this).attr("price")<ui.values[ 0 ] || $(this).attr("price")>ui.values[ 1 ])
			 {
			 $(this).hide();
			 }
			 if($(this).attr("price")>ui.values[ 0 ] && $(this).attr("price")<ui.values[ 1 ])
			 {
			 $(this).show();
			 }
		});	 
		 var count_bhanu=0;
		 $(".refendable11").each(function(){
			 if($("div:visible", this).length>10)
			 {
				count_bhanu=count_bhanu+1; 
			 }
		 });
		 $(".search-results-title").html('<b>'+count_bhanu+'</b> flights found.');		
		
      }
    });
    $( "#amount" ).val( "<?php echo $this->bp_white_label_setting->wls_currency_symbol;?>" + "<?php echo min($totol_price); ?>" +
      "  -  <?php echo $this->bp_white_label_setting->wls_currency_symbol;?>" + "<?php echo max($totol_price); ?>" );
  });
  $(".filter_price_reset").click(function(){
		$(".price_div").show();
	});
// Filter By Star rating - ---------
	$(".rating_star").click(function () {
		if ($(this).attr("check_see") == "0") {
			$(this).attr("check_see", "1");
			} else {
			$(this).attr("check_see", "0");
			}
			var stops1 = "";
			$(".rating_star").each(function () {
			if ($(this).attr("check_see") == "1")
			{
				stops1 = $(this).val();
				$(".rating_str").each(function () {
					
					if (stops1 == $(this).attr("rating"))
					{
						$(this).show();
					}
					else{
						$(this).hide();
					}
				});
			} if ($(this).attr("check_see") == "0"){	
				var stops2 = $(this).val();
				$(".rating_str").each(function () {
					if (stops2 == $(this).attr("rating"))
					{
						$(this).hide();
					}
				});
			}
			if (stops1 == "")
			{
				$(".rating_str").each(function () {
					
					$(this).show();
				});
			}
		});
	}); 

//   $( function() {
//     $( "#htl-range" ).slider({
//         range: true,
//         min: 0,
//         max: 500,
//         values: [ 75, 300 ],
//         slide: function( event, ui ) {
//             $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
//         }
//     });
//     $( "#amount" ).val( "$" + $( "#bus-range" ).slider( "values", 0 ) +
//         " - $" + $( "#bus-range" ).slider( "values", 1 ) );
// } );
</script>
<script>

$('#filter_btn').click(function(){
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

</script>