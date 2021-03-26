<?php 
	$this->load->view('include/head');
 	$this->load->view('include/header');
	$bp_result_count = $_SESSION['total_hotels'];
	$yourDataArray = json_decode($_SESSION['hotels']);
	$bp_search_request = $_SESSION ['hotel'] ['search_data'];
	$bp_search_req = $_SESSION ['hotel'] ['array'] ['search_request'];
	$tot_adult = 0;
	$tot_child = 0;
	foreach($bp_search_req['RoomGuests'] as $paxs){
		$tot_adult = $tot_adult+$paxs['NoOfAdults'];
		$tot_child = $tot_child+$paxs['NoOfChild'];
	}

	$result = $_SESSION ['hotel'] ['array'] ['search_result']->HotelSearchResult->HotelResults;
	$bp_search_request = $_SESSION ['hotel'] ['search_data'];
	$bp_result_count = count ( $result );
	$currencyCode = getCurrentCurrency();
	if($bp_result_count > 0){
		$currencyCode = $result[0]->Price->CurrencyCode;
	}

	if( $currencyCode == "USD" ){
		$js_currency_symbol = "$";
	}else if( $currencyCode == "AED" ){
		$js_currency_symbol = "AED";
	}else{
		 $js_currency_symbol = "₹";
	}
	
	
	
	// PrintArray($_SESSION ['hotel'] ['array'] ['search_result']);
	// PrintArray($_SESSION ['hotel'] ['filter'] ['star']);
	// $checkin_date=$bp_search_request['checkIn'];
	// $checkout_date =$bp_search_request['checkOut'];
	// $nights = strtotime($checkout_date) - strtotime( $checkin_date);
	// $_SESSION ['hotel'] ['nights']= $nights/86400;
	// echo $nights/86400 ;

	//PrintArray($_SESSION ['hotel'] ['array'] ['search_result']); die;
?>

<!------new--------->
<section class="search-result-info pt-3 pb-3">
	<div class="container-fluid">
		<div class="oneway-modify">
			<div class="row">
				<div class="col-md-3 col-sm-6 col-8 border-right">
					<div class="one-flght-location">
						<small class="text-muted text-uppercase">Hotels</small>
						<h6 class="mb-0"><?php echo $bp_search_request['cityName']; ?></h6>
					</div>
				</div>
				<div class="col-md-2 col-sm-6 col-4 border-right">
					<div class="flght-depart">
						<small class="text-muted text-uppercase">Check In</small>
						<h6 class="mb-0"><i class="icofont-ui-calendar"></i> <?php echo date_format(date_create($bp_search_request['checkIn']),"D d M Y");?></h6>
					</div>
				</div>
				<div class="col-md-2 col-sm-6 col-4 border-right">
					<div class="flght-depart">
						<small class="text-muted text-uppercase">Check Out</small>
						<h6 class="mb-0"><i class="icofont-ui-calendar"></i> <?php echo date_format(date_create($bp_search_request['checkOut']),"D d M Y");?></h6>
					</div>
				</div>
				<div class="col-md-1 col-sm-4 col-4 border-right mt-3 mt-sm-0">
					<div class="passeng-dts">
						<small class="text-muted text-uppercase">Adult</small>
						<h6 class="mb-0"><i class="icofont-ui-user"></i> <?php echo $tot_adult;?></h6>
					</div>
				</div>
				<div class="col-md-2 col-sm-4 col-4 border-right">
					<div class="passeng-dts">
						<small class="text-muted text-uppercase">Child</small>
						<h6 class="mb-0"><i class="icofont-ui-user"></i> <?php echo $tot_child;?></h6>
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
	<section class="flght-result-oneway htl-result-listing pt-2 pb-2 pt-md-3 pb-md-3">
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
					 	 			<a href="javascript:void(0)" hotel-name-reset="true" class="resetall reset text-danger">Reset All</a>
					 	 		</div>
					 	 	</div>
					 	 </div>

					 	 <!-- Flight Stop Start -->
					 	 <div class="sidebar-com no-of-stop pb-2 pb-md-3 border-bottom mb-md-3 ">
					 	 	<h6 class="font-weight-normal mb-2">Filter By Hotel Name</h6>
					 	 	<div class="htl-comm htl-srch-name">
					 	 		<input type="text" name="" id="hotel_name" class="form-control" value="" placeholder="Enter Hotel Name">
					 	 	</div>
					 	 </div><!-- Stop End -->

						<!-- Price filter -->
						<div class="sidebar-com price-airlines price-range pb-2 pb-md-3 border-bottom mb-md-3 ">
					 		<h6 class="font-weight-normal mb-2">Price Range 
							<button type="button" class="btn btn-success btn-xs" hotel-price-slider-apply-btn="true" >Apply</button></h6>
					 		<div class="flt-stop prc-air-lines" id="price-rng">
								<p class="mb-0">
								  <ul class="list-inline clearfix mb-2">
								  	<li class="list-inline-item float-left">
								  		<input type="text" id="amount" readonly>
								  	</li>
								  	<li class="list-inline-item float-right">
										<input type="text" id="amount1" readonly class="text-right">
								  	</li>
								  </ul>
								</p>
								<div id="price_filter_slider"></div>
					 		</div>
					 	</div><!-- Price filter end -->

					 	 <!-- Star Rating -->
						 <div class="sidebar-com no-of-stop pb-2 pb-md-3 border-bottom mb-md-3 ">
					 	 	<h6 class="font-weight-normal mb-2">Hotel Star Rating</h6>
					 	 	<div class="htl-comm htl-srch-rtng">
					 	 		<ul class="list-unstyled">
								<?php for ($i = 1; $i <= 5; $i++) { ?>
					 	 			<li>
					 	 				<label for="one-star<?php echo $i; ?>">
					 	 					<input id="one-star<?php echo $i; ?>" class="rating_star" check_see="0" value="<?php echo $i; ?>" type="checkbox" name="htl-rtng">
					 	 					<span>
											<?php for($bp_j = 1; $bp_j <= $i; $bp_j ++) { ?>
					 	 						<i class="icofont-star yellow-star"></i>
											<?php } ?>	
					 	 					</span>
					 	 				</label>
					 	 			</li>
					 	 		<?php } ?>	
					 	 		</ul>
					 	 	</div>
					 	 </div>
					 	 <!-- Star Rating end -->

					 	 <!-- Flight Location Start -->
					 	 <div class="sidebar-com no-of-stop pb-2 pb-md-3 border-bottom mb-md-3 ">
					 	 	<h6 class="font-weight-normal mb-2">Filter By Locations</h6>
					 	 	<div class="htl-comm htl-srch-name">
					 	 		<input type="text" name="" id="filter_location" class="form-control" value="" placeholder="Enter Your Favourite Location">
								<!--<input style="float: none; width: 100%; height: 35px;" placeholder="Enter Address" id="search-htl-loc" type="text">-->
								
					 	 	</div>
					 	 </div>
					<!--Location End -->
					</div>
					<div class="d-md-none"><a href="javascript:void(0)" class="w-100 btn btn-search" id="filter_click_submit">View Result</a></div>
				</div>
				<!-- Flight Search result by filter end -->

				<div class="col-md-9">
					<div class="htl-result-right-list paul-htl-result-list">

						<div class="hotel-result-list-col bp_hotel_list">
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
	      <?php $this->load->view("hotel/hotel_search");?>
	    </div>
	    
	    <!-- Modal footer -->
	    <div class="modal-footer">
	      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	    </div>
	  </div>
	</div>
</div>


		
    <div class="modal fade waiting_popup1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title text-center w-100">Please Wait!!</h4>
				</div>
				<div class="modal-body text-center">
					<img src="<?php echo site_url();?>assets/images/loading.gif" class="ml-auto" style="max-width:150px;">
				</div>
			</div>
		</div>
	</div>
		

<!-------new end--------->
<?php $this->load->view('include/footer');?>
<?php $this->load->view('hotel/js');?>
<script src="<?php echo site_url();?>assets/js/jquery_lazy_master/jquery.lazy.min.js"></script>
<script>
var current_page = 1;
var prices = {};
var lst = [];
var h_name = []
var total_pages = "<?php echo $_SESSION['total_pages']?>";
function loadHotels() {
	var prices = {};
	var lst = [];
	var h_name = []
	var page_url = "<?php echo site_url(); ?>hotel/hotelspage?page="+current_page+"&is_ajax=1"
    $.ajax({
        type: "POST",
        url: "<?php echo site_url(); ?>hotel/hotelspage?page="+current_page+"&is_ajax=1",
        data:{},
        success:
               function (data) {
				   data = $.parseJSON(data);
    		     var hotels = data.hotels;
    		     $('.bp_hotel_list').append(hotels);
    			$('#showing').html(data.showing);
    		     $('.lazy').Lazy();
                }
    });
	current_page++;
	//console.log("test");	 
	$('.waiting_popup').modal('hide');
}
</script>
<script type="text/javascript">
$(document).ready(function() {
	function getDocHeight() {
	    var D = document;
	    return Math.max(
	        D.body.scrollHeight, D.documentElement.scrollHeight,
	        D.body.offsetHeight, D.documentElement.offsetHeight,
	        D.body.clientHeight, D.documentElement.clientHeight
	    );
	}
	//initial call to load hotels
	loadHotels();
	//load more hotels on page scroll
	var sIndex = 11, offSet = 10, isPreviousEventComplete = true, isDataAvailable = true;
	$(window).scroll(function() {
		   var bp_document_heigh=getDocHeight();
		   bp_document_heigh=bp_document_heigh-50;
	       if($(window).scrollTop() + $(window).height() >= bp_document_heigh) {
		       //alert(getDocHeight());
	    	   isPreviousEventComplete = false;
		        loadHotels();
	       }
	   });
});
</script>
<script>
// Filter by Hotel Name-----------------
var h_name = <?php echo json_encode($_SESSION ['hotel'] ['hotel_names']) ?>;
$( "#hotel_name" ).autocomplete({
	minLength : 4,
	maxResults : 1,
	source : function(request, response) {
		
		$.ajax({
			url : '<?php echo site_url();?>hotel/hotel_name_json',
			dataType : "json",
			cache : false,
			data : {
				value : request.term
			},
			success : function(data) {
				response(data);
				//console.log(data);
			}
		});
	},
	select: function(event, ui) {
		$('.waiting_popup').modal('show');
		var bp_hotel_name=ui.item.label;
		 $.ajax({
		        type: "POST",
		        url: "<?php echo site_url(); ?>hotel/filter_set",
		        data:{hotel_name:bp_hotel_name,type:"name"},
		        success:
		               function (data) {
		        	   $('.bp_hotel_list').html("");
		        	    current_page = 1;
		        	    loadHotels();
		                }
		    });
	},
});
$("[hotel-name-reset]").click(function(){
    
	 $.ajax({
	        type: "POST",
	        url: "<?php echo site_url(); ?>hotel/filter_set",
	        data:{type:"name_reset"},
	        success:
	               function (data) {
	        	   $('.bp_hotel_list').html("");
	        	    current_page = 1;
	        	    loadHotels();
	                }
	    });
});
                   
// Filter by Hotel Location -----------

var lst = <?php echo json_encode($_SESSION ['hotel'] ['hotel_location']) ?>;
$( "#filter_location" ).autocomplete({
	minLength : 4,
	maxResults : 1,
	source : function(request, response) {
		$.ajax({
			url : '<?php echo site_url();?>hotel/hotel_location_json',
			dataType : "json",
			cache : false,
			data : {
				value : request.term
			},
			success : function(data) {
				response(data);
			}
		});
	},
	select: function(event, ui) {
		$('.waiting_popup').modal('show');
		var bp_hotel_name=ui.item.label;
		 $.ajax({
		        type: "POST",
		        url: "<?php echo site_url(); ?>hotel/filter_set",
		        data:{hotel_location:bp_hotel_name,type:"location"},
		        success:
		               function (data) {
		        	   $('.bp_hotel_list').html("");
		        	    current_page = 1;
		        	    loadHotels();
		                }
		    });
	},
});


// Filter By Price---------
$(function() {
	  var bp_p_slider_slider_min="<?php echo min($_SESSION ['hotel'] ['price']); ?>";
	  var bp_p_slider_slider_max="<?php echo max($_SESSION ['hotel'] ['price']); ?>";
    $( "#price_filter_slider" ).slider({
      range: true,
      min: <?php echo min($_SESSION ['hotel'] ['price']); ?>,
      max: <?php echo max($_SESSION ['hotel'] ['price']); ?>,
      values: [ <?php echo min($_SESSION ['hotel'] ['price']); ?>, <?php echo max($_SESSION ['hotel'] ['price']); ?> ],
      slide: function( event, ui ) {
        $( "#amount" ).val( "<?= $js_currency_symbol ?> " + ui.values[ 0 ]);
		$( "#amount1" ).val("<?= $js_currency_symbol ?> " + ui.values[ 1 ]);
        bp_p_slider_slider_min=ui.values[ 0 ];
        bp_p_slider_slider_max=ui.values[ 1 ];     
      }
    });
    $("[hotel-price-slider-apply-btn]").click(function(){
    	$('.waiting_popup').modal('show');
    	 $.ajax({
		        type: "POST",
		        url: "<?php echo site_url(); ?>hotel/filter_set",
		        data:{min_price:bp_p_slider_slider_min,max_price:bp_p_slider_slider_max,type:"price"},
		        success:
		               function (data) {
		        	   $('.bp_hotel_list').html("");
		        	    current_page = 1;
		        	    loadHotels();
		                }
		    });
    });
    $( "#amount" ).val( "<?= $js_currency_symbol ?> " + "<?php echo min($_SESSION ['hotel'] ['price']); ?>" );
	  $( "#amount1" ).val("<?= $js_currency_symbol ?> " + "<?php echo max($_SESSION ['hotel'] ['price']); ?>" );  
	  

  });
  
// Filter By Star rating - ---------
	$(".rating_star").click(function () {
		//$('.waiting_popup1').modal('show');
		if ($(this).attr("check_see") == "0") {
			$(this).attr("check_see", "1");
			} else {
			$(this).attr("check_see", "0");
			}
			var star = [];
			$(".rating_star").each(function () {
			if ($(this).attr("check_see") == "1")
			{
				star.push($(this).val());
			} 
		    });
			if(star.length>0){
            
			}else{
				star=['','0','1','2','3','4','5'];
			}
		//	console.log(star);
			 $.ajax({
			        type: "POST",
			        url: "<?php echo site_url(); ?>hotel/filter_set",
			        data:{star_data:star,type:"star"},
			        success:
			            function (data) {
							$('.waiting_popup1').removeClass('show');
							$('.waiting_popup1').modal('hide');
							$('.bp_hotel_list').html("");
							current_page = 1;
							loadHotels();
			            }
			    });
	}); 
</script>



 