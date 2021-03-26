 <?php $this->load->view("holidaylayout/header"); ?>
<div class="container-fluid allpackcategoryfluid">
	<div class="container">
		<h1 class="mainheading"><?php 
                if($this->uri->segment(1) == "cat"){
                echo $Category_name->holcat_name;
                }else{
                echo $Category_name->holsubc_name;    
                    
                }
?> </h1>
                
    <div class="row featuredrow allpackcategoryrow">
    <?php 
    if($result != 0){
    foreach ($result as $Key=>$results){ ?>
        <div class="col-sm-3">
            <a href="<?php echo site_url() ?>holiday/holidaydetail/<?php echo $results->holiday_slug; ?>" class="clearfix packagebox">
              <div class="packimggrabber">
                  <div class="ribbon"><span>Popular</span></div>
                  <img src="<?php echo $this->admin_site_url; ?>assets/img/holiday/thumbs/<?php echo $results->holiday_feature_image; ?>" alt="img">
                  <span class="noofnight"><?php echo $results->holiday_night; ?> Nights/<?php echo $results->holiday_night+1; ?> days</span>
              </div>
              <div class="packcontent">
                  <h4 class="mt0"><?php echo $results->holiday_name; ?></h4>
                  <div class="clearfix">
                      <span class="pull-left danger-color">
                          <small class="fz14 read-color uppercase">Start From</small> <i class="fa fa-inr"></i> <?php echo $results->holiday_start_price; ?>
                      </span>
                      <span class="pull-right">
                          <?php for($i=1;$i<=$results->holiday_rating;$i++) {?>
                        <i class="fa fa-star warning-color"></i>
                          <?php } ?>
                        
                      </span>
                  </div>
                  <p class="read-color mt15 taj">
                      <?php echo $results->holiday_short_description; ?>
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
									<?php //echo $this->pagination->create_links();?>
			</div>  
</div>
 <?php $this->load->view("holidaylayout/footer"); ?>