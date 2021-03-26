<?php $this->load->view('include/head') ?>
<?php $this->load->view('include/header') ;

 if(null !==$this->input->get()){
       $date = $this->input->get('date');
	   $tour_type = $this->input->get('tour_type');
	   $tour_location = $this->input->get('location');
	    
    }else{
        
        $date = "";
    }
    if(null !==$this->input->get('guest_no')){
       $paxno = $this->input->get('guest_no');
    }else{
        
        $paxno = "";
    }
	
?>

<!-- Search Result info -->
<section class="search-result-info pt-3 pb-3">
	<div class="container">
		<div class="oneway-modify">
			<div class="row justify-content-center">
				<div class="col-md-10 col-sm-6 col-12">
					<div class="one-flght-location">
						<small class="text-muted text-uppercase">Total Result</small>
						<h6 class="mb-0"><?php echo $total_result ?> Results Found.</h6>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Search Result info end -->

<!-- Flight Result Main -->
	<section class="flght-result-oneway hldy-result-listing pt-2 pb-2 pt-md-3 pb-md-3">
		<div class="container">
			<div class="row">
				<!-- Flight Search result by filter -->
				<div class="col-md-4" id="sidebar-flght">  
					<div class="search-by-filter mr-0 mr-md-1">
					 	 <div class="search-flt-topbar pb-2 border-bottom mb-2 mb-md-3">
					 	 	<div class="row">
					 	 		<div class="col-md-6">
					 	 			<h6 class="font-weight-normal">Filter Results</h6>
					 	 		</div>
					 	 		<div class="col-md-6 text-md-right">
					 	 			<a href="javascript:void(0)" class="reset text-danger">Reset All</a>
					 	 		</div>
					 	 	</div>
					 	 </div>

					 	 <!-- Flight Stop Start -->
						<form action="<?php echo site_url();?>holiday/holiday_list" method="get">
					 	 <div class="sidebar-com no-of-stop pb-2 pb-md-3 border-bottom mb-md-3 ">
					 	 	<h6 class="font-weight-normal mb-2">Select Your Destination</h6>
					 	 	<div class="htl-comm htl-srch-name">
					 	 		<label for="keyword">Search Holiday Packages: </label>
  								<input id="keyword" name="keyword" class="form-control custom-select mb-2">
								<button type="submit" class="btn btn-search"> Find Packages</button>
					 	 	</div>
					 	 </div>
						  </form>
						 <!-- Stop End -->
					</div>
				</div>
				<!-- Flight Search result by filter end -->

				<div class="col-md-8">
					<div class="hldy-result-right-list paul-hldy-result-list">
			<?php 				
			 if($result !=0){ 
              foreach ($result as $alltours){
                $totol_price[]=$alltours->holiday_start_price;
              ?>
						<div class="holdiay-listing-col mb-2 mb-md-3">
							<div class="row">
								<div class="col-md-5">
									<div class="hldy-img">
										<img src="<?php echo site_url(); ?>admin/assets/img/holiday/thumbs/<?php echo $alltours->holiday_feature_image; ?>" alt="">
										<div class="hld-lst-time">
											<p class="mb-0"><?php echo $alltours->holiday_night;?> Nights <span><?php echo $alltours->holiday_night+1; ?>Days</span></p>
										</div>
									</div>
								</div>
								<div class="col-md-7">
									<div class="hldy-desc-wrap">
										<div class="price-hldy">
											<span><i class="icofont-rupee"></i> <?php echo $alltours->holiday_start_price; ?></span>
										</div>
										<h4><?php echo $alltours->holiday_name; ?> </h4>
										<div class="facilities-hldy">
											<ul class="list-inline mb-0">
												<li class="list-inline-item">
													<i class="icofont-culinary"></i>
													<span>Meals</span>
												</li>
												<li class="list-inline-item">
													<i class="icofont-hotel"></i>
													<span>Hotel</span>
												</li>
												<li class="list-inline-item">
													<i class="icofont-car-alt-1"></i>
													<span>Transfer</span>
												</li>
											</ul>
										</div>
										<p><?php echo word_limiter(strip_tags($alltours->holiday_short_description), 18); ?></p>
										<a href="<?php echo site_url() ?>holiday/holidaydetail/<?php echo $alltours->holiday_slug; ?>?tour_id=<?php echo $alltours->holiday_id; ?>&date=<?php echo $date; ?>&paxno=<?php echo $paxno; ?>" class="btn btn-search">View Details</a>
									</div>
								</div>
							</div>
						</div>
						
						 <?php }}else{ ?>
                  
                  <h2 class="text-center"> No any record founds for this area. </h2>
           <?php   } ?>
						<!---
						<div class="holdiay-listing-col mb-2 mb-md-3">
							<div class="row">
								<div class="col-md-5">
									<div class="hldy-img">
										<img src="assets/images/orlando.jpg" alt="">
										<div class="hld-lst-time">
											<p class="mb-0">5 Nights <span> 6 Days</span></p>
										</div>
									</div>
								</div>
								<div class="col-md-7">
									<div class="hldy-desc-wrap">
										<div class="price-hldy">
											<span><i class="icofont-rupee"></i> 1500</span>
										</div>
										<h4>Scenic Kashmir & Shikara Ride </h4>
										<div class="facilities-hldy">
											<ul class="list-inline mb-0">
												<li class="list-inline-item">
													<i class="icofont-culinary"></i>
													<span>Meals</span>
												</li>
												<li class="list-inline-item">
													<i class="icofont-hotel"></i>
													<span>Hotel</span>
												</li>
												<li class="list-inline-item">
													<i class="icofont-car-alt-1"></i>
													<span>Transfer</span>
												</li>
											</ul>
										</div>
										<p>Benidorm is a buzzing resort with a big reputation for beach holidays. Situated in sunny Costa Blanca, the town is...</p>
										<a href="holiday-details.php" class="btn btn-search">View Details</a>
									</div>
								</div>
							</div>
						</div>
						
						-->
						
					</div>
				</div>
			</div>
		</div>
	</section>
<!-- Flight Result Main  end-->
<?php $this->load->view('include/footer') ?>

<script>
  $( function() {
    var availableTags = <?php print_r($keyword) ?>;
    $( "#keyword" ).autocomplete({
      source: availableTags,
      minLength:1,   
      delay:100,  
	  autoFocus:true

    });
  } );
  </script>


<style type='text/css'>
  <?php
    if(isset($_SERVER['QUERY_STRING']) && empty($_SERVER['QUERY_STRING']))
    {
      echo ".search-flt-topbar { display:none; } ";
    }
    else
    {
       //echo css here
    }
  ?>
</style>

<script>
$(".reset").click(function () {
	window.location.href = "<?php echo site_url();?>holiday/holiday_list";
});
</script>