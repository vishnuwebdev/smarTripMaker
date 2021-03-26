<?php
$this->load->view('header');
?>

<style>
.packagebox .packimggrabber .noofnight {
    width: 60%;
    display: block;
    position: absolute;
    bottom: 0;
    padding: 7px 15px;
    text-align: center;
    font-size: 16px;
    color: #ffffff;
    background: linear-gradient(rgba(0,0,0,.03), rgba(0,0,0,.8));
}

.stars-right {
    width: 40%;
    display: block;
    position: absolute;
    bottom: 0;
    right: 0;
    padding: 7px 4px;
    text-align: center;
    font-size: 14px;
    color: #ffffff;
    background: linear-gradient(rgba(0,0,0,.03), rgba(0,0,0,.8));
}

</style>

<div class="container-fluid allpackcategoryfluid">
	<div class="container">
		<h1 class="mainheading">All Activities </h1>
    <div class="row featuredrow allpackcategoryrow">
    <?php 
    if($result != 0){
    foreach ($result as $Key=>$results){ ?>
        <div class="col-sm-3">
            <a style="text-decoration:none" href="<?php echo site_url() ?>activity/activitydetail/<?php echo $results->holiday_slug; ?>" class="clearfix packagebox">
              <div class="packimggrabber">
<!--                  <div class="ribbon"><span>Popular</span></div>-->
                  <img src="<?php echo $this->dsa_data->dsa_admin_url; ?>assets/img/holiday/thumbs/<?php echo $results->holiday_feature_image; ?>" alt="img">
                  <span class="noofnight"><?php echo $results->holiday_night; ?> Nights/<?php echo $results->holiday_night+1; ?> days</span>
                  <span class="pull-right stars-right">
                          <?php for($i=1;$i<=$results->holiday_rating;$i++) {?>
                        <i class="fa fa-star warning-color"></i>
                          <?php } ?>
						  <?php for($k=1;$k<=5-$results->holiday_rating ;$k++) {?>
                         <i class="fa fa-star"></i>
                          <?php } ?>
                        
                      </span>
              </div>
			  
              <div class="packcontent" style="height: 190px;">
			       
					   
                  <h4 class="mt0"><?php echo word_limiter(strip_tags($results->holiday_name), 5);?></h4>
			     <?php  if($results->holiday_start_price != NULL) { ?>
                  <div class="clearfix">
                      <span class="pull-left danger-color">
                          <small class="fz14 read-color uppercase">Start From</small> <?php echo $this->dsa_data->dsa_currency.' '.$results->holiday_start_price; ?>
                      </span>
                          
                  </div>
                  <?php } ?>
                  <p class="read-color mt15 taj">
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