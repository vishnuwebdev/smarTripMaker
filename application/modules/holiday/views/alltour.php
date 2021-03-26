 <?php $this->load->view("header"); ?>
 <link rel="stylesheet" href="http://beta.booking-tours.com/assets/holiday/css/main.css">
 
<div class="container-fluid allpackcategoryfluid">
	<div class="container">
		<h1 class="mainheading">All Packages </h1>
    <div class="row featuredrow allpackcategoryrow">
    <?php 
    if($result != 0){
    foreach ($result as $Key=>$results){ ?>
        <div class="col-sm-3">
            <a href="<?php echo site_url() ?>holiday/holidaydetail/<?php echo $results->holiday_slug; ?>" class="clearfix packagebox">
              <div class="packimggrabber">
<!--                  <div class="ribbon"><span>Popular</span></div>-->
                  <img src="<?php echo site_url(); ?>admin/assets/img/holiday/thumbs/<?php echo $results->holiday_feature_image; ?>" alt="img">
                  <span class="noofnight"><?php echo $results->holiday_night; ?> Nights/<?php echo $results->holiday_night+1; ?> days</span>
				  
              </div>
			  
              <div class="packcontent" style="height:210px">
			        <span class="pull-right">
                          <?php for($i=1;$i<=$results->holiday_rating;$i++) {?>
                        <i class="fa fa-star warning-color"></i>
                          <?php } ?>
						  <?php for($k=1;$k<=5-$results->holiday_rating ;$k++) {?>
                         <i class="fa fa-star"></i>
                          <?php } ?>
                        
                      </span>
					   
                  <h4 class="mt0"><?php echo word_limiter(strip_tags($results->holiday_name), 5); ?></h4>     
                  <div class="clearfix">
                      <span class="pull-left danger-color">
                          <small class="fz14 read-color uppercase">Start From</small> <?php  echo $results->holiday_start_price; ?>
                      </span>
                   
                  </div>
                  <p class="read-color mt15 taj" style="height: 60px;" >
                      <?php echo word_limiter(strip_tags($results->holiday_short_description), 15); ?>
                  </p>
              </div>
              <span class="btn btn-default block">View Details</span>
          </a>
      </div>
    <?php  } }else{ ?>
        <h2 class="text-center"> No any records Founds For this area. </h2>  
    <?php } ?>
    </div>
	</div>
    <div class="text-center">
									<?php echo $this->pagination->create_links();?>
			</div>  
</div>
 <?php $this->load->view("footer"); ?>