
<?php $this->load->view('header');?>
<?php $this->load->view('hotel/css');?>
<?php 
//echo max($_SESSION ['hotel'] ['price']);
//PrintArray($_SESSION ['hotel'] ['price']);
$bp_result_count = $_SESSION['total_hotels'];
$yourDataArray = json_decode($_SESSION['hotels']);
$bp_search_request = $_SESSION ['hotel'] ['search_data'];
?>
<style>
.ui-slider-horizontal .ui-slider-handle {
	background: #e91f62;
}
</style>

<?php
$result = $_SESSION ['hotel'] ['array'] ['search_result']->Results;
$bp_search_request = $_SESSION ['hotel'] ['search_data'];
$bp_result_count = count ( $result );
// PrintArray($_SESSION ['hotel'] ['array'] ['search_result']);
?>
<link rel="stylesheet" href="<?php echo site_url(); ?>assets/css/hotel-result.css">
<div class="xsfilterparent">
	<div class="hidden visible-xs clearfix xsfilter">
		<a href="#none" class="booknow mkshowmodify pull-left">Modify Search</a> <a href="#none" class="booknow mkshowfilter pull-right">Filter</a>
	   
	</div>
</div>
<div class="container-fluid  modifysearchfluidparent">
	<div class="container modifysearchfluid">
		<h3 class="text-center">Modify Search</h3>
		
	<?php $this->load->view("hotel/hotel_search");?>
</div>
</div>
<!-- hotel-result-fluid starts from here -->
<div class="container-fluid hotel-result-fluid">
	<div class="container">
		<div class="row hotel-result-row">
			<h3 class="text-center"><?php echo $bp_search_request['cityName']; ?>,  <?php echo date_format(date_create($bp_search_request['checkIn']),"D d M Y");?>, <?php echo $bp_search_request['nights']?> Nights, <?php echo $bp_search_request['room']?> Rooms
			</h3>
			<div class="col-md-3 mkfiltercol">
				<div class="grabber hotelBox lefthbox">
					<div class="hotel-filters">

						<div class="filterbox">
							<h3 class="filter-heading clearfix">
								Filter By Price 
							</h3>
							<p>
								<label for="amount"> Price range: <button type="button" class="btn btn-success btn-xs" hotel-price-slider-apply-btn="true" style="height:22px;">Apply</button></label> 
								<input type="text" id="amount" readonly style="border: 0; color: #f6931f; font-weight: bold;width:100%;">
							</p>

							<div id="price_filter_slider"></div>
						</div>

						<div class="filterbox">
							<h3 class="filter-heading clearfix">
								Filter By Hotel Name <a href="#none" class="resetall pull-right" hotel-name-reset="true">Reset</a>
							</h3>
							<input style="float: none; width: 100%; height: 35px;" placeholder="Enter Hotel Name" id="hotel_name" type="text">
						</div>

						<div class="filterbox">
							<h3 class="filter-heading clearfix">Hotel Star Rating</h3>
                    <?php for ($i = 1; $i <= 5; $i++) { ?>
															<div class="checkbox">
								<label><input class="rating_star" type="checkbox" check_see="0" value="<?php echo $i; ?>"><?php
																					
																					echo $i . " Star";
																					
																					for($bp_j = 1; $bp_j <= $i; $bp_j ++) {
																						?>
																			<i class="fa fa-star yellow-star"></i>
																	<?php
																					
}
																					
																					?>
										</label>
							</div>
																<?php } ?>
                </div>

						

					</div>
				</div>
			</div>
			<div class="col-md-9">
				<div class="grabber righthbox bp_hotel_list">

					<!-- Start Hotel result -->
				
					<!-- Stop Hotel result -->
      
				</div>
				<p id="bp_for_test_data"></p>
			</div>
		</div>
	</div>
</div>
<!-- hotel-result-fluid ends from here -->
<?php $this->load->view('footer');?>
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
	minLength : 3,
	maxResults : 15,
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
			}
		});
	},
	select: function(event, ui) {
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
// Filter by Hotel name -----------

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
        $( "#amount" ).val( "<?php echo $this->bp_white_label_setting->wls_currency_code;?>." + ui.values[ 0 ] + "  -  <?php echo $this->bp_white_label_setting->wls_currency_code;?>." + ui.values[ 1 ] );
        bp_p_slider_slider_min=ui.values[ 0 ];
        bp_p_slider_slider_max=ui.values[ 1 ];     
      }
    });
    $("[hotel-price-slider-apply-btn]").click(function(){
        
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
    $( "#amount" ).val( "<?php echo $this->bp_white_label_setting->wls_currency_code;?>. " + "<?php echo min($_SESSION ['hotel'] ['price']); ?>" +
      "  -  <?php echo $this->bp_white_label_setting->wls_currency_code;?>. " + "<?php echo max($_SESSION ['hotel'] ['price']); ?>" );
  });
  
// Filter By Star rating - ---------
	$(".rating_star").click(function () {
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
			 $.ajax({
			        type: "POST",
			        url: "<?php echo site_url(); ?>hotel/filter_set",
			        data:{star_data:star,type:"star"},
			        success:
			               function (data) {
			        	$('.bp_hotel_list').html("");
			        	current_page = 1;
			        	loadHotels();
			                }
			    });
			
	}); 
</script>
 