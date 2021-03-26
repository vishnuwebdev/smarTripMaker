<?php

$this->load->view("commenLayout/head");


$this->load->view('commenLayout/header');
?>
<div class="container-fluid search-fluid">
    <div class="container absolute-container">
        <div class="mainsearchengine clearfix">
            <div role="tabpanel">
                <ul class="nav nav-tabs wt-nav-tabs" role="tablist">



                </ul>
                <div class="clearfix"></div>
                <div class="tab-content" style="margin-top: 50px;">


                    <div role="tabpanel" class="tab-pane active" id="packagebooking">
                        <form action="<?php echo site_url(); ?>holiday/holiday_list" method="get">
                        <div class="searchengine clearfix">
                            
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="clearfix forminputgrabber">
                                        <i class="fa fa-map-marker forminputicon"></i>
                                        <input type="text" class="input block width-100 border" name="location" id="tour_locaton" placeholder="Your Destination" value="" required="">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="clearfix">
                                        <select class="select block width-100 border" name="tour_type" required="">
                                            
                                            <option value="">Any</option>
                                            <?php foreach ($this->all_sub_category as $allsubcat){ ?>
                                           
<option value="<?php echo $allsubcat->holsubc_id; ?>"><?php echo $allsubcat->holsubc_name; ?></option>
 <?php } ?>
                                           
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="clearfix forminputgrabber">
                                        <label for="date1" class="fa fa-calendar forminputicon"></label>
                                        <input type="text" class="input block width-100 border datepicker" placeholder="Date" name="date" readonly id="date1">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="clearfix">
                                        <select name="guest_no" class="select block width-100 border" required="">
                                            <option value="1" selected>Guest(1)</option>
                                            <?php for($i=1;$i<=50;$i++){ ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                            <?php } ?>
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="clearfix">
                                        <button type="submit" class="btn btn-primary block"><i class="fa fa-search"></i> Find Packages</button>
                                    </div>
                                </div>
                            
                            </div>
                           
                        </div>
                             </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div id="main-slider" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
			
                <li data-target="#main-slider" data-slide-to="0" class="active"></li>
                <li data-target="#main-slider" data-slide-to="1" class=""></li>
                <li data-target="#main-slider" data-slide-to="2" class=""></li>
                <li data-target="#main-slider" data-slide-to="3" class=""></li>
            </ol>
           <div class="carousel-inner">

                 <?php

    if($sliderimg == "0"){ 
         foreach ($sliderimg as $key => $sliderimgvalue) {
              # code...
          ?>

   <div class="item  <?php  if($key == 0){ echo "active"; } ?>">
                    <img src="<?php echo site_url() ?>admin/assets/img/slider/main/<?php  echo $sliderimgvalue->sliimg_image; ?>" alt="<?php  echo $sliderimgvalue->sliimg_alt; ?>">
                   
                </div>
           

            <?php } } else{
                ?>
              <div class="item active">
                    <img src="<?php echo site_url();?>assets/images/slide2.jpg" alt="slide2.jpg">
                   
                </div>

                <?php  } ?>
             
            </div>
             <?php

    if($sliderimg != "0" && count($sliderimg) > 1){ 
         ?>
            <a class="left carousel-control wow bounceInUp" href="#main-slider" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
            <a class="right carousel-control wow bounceInUp" href="#main-slider" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
            <?php } ?>
        </div>
    </div>
</div>
<div class="container-fluid light-bg featuredfluid">
    <div class="container">
        <h1 class="mainheading">Top Destinations <small>You will love them</small></h1>
        <div class="row featuredrow">
            <?php 
         

           if(!empty($result)){
            foreach ($result as $Key => $results) { ?>
                <div class="col-sm-3">
                    <a style="text-decoration:none" href="<?php echo site_url() ?>/activity/holidaydetail/<?php echo $results->holiday_slug; ?>" class="clearfix packagebox">
                        <div class="packimggrabber">
<!--                            <div class="ribbon"><span>Popular</span></div>-->
                            <img src="<?php  echo $this->dsa_data->dsa_admin_url; ?>assets/img/holiday/thumbs/<?php echo $results->holiday_feature_image; ?>" alt="img">
                            <span class="noofnight"><?php echo $results->holiday_night; ?> Nights/<?php echo $results->holiday_night + 1; ?> days</span>
                        </div>
                        <div class="packcontent">
						 <span class="pull-right">
                                    <?php for ($i = 1; $i <= $results->holiday_rating; $i++) { ?>
                                        <i class="fa fa-star warning-color"></i>
                                    <?php } ?>

                                    <?php for ($i = 1; $i <= 5 - $results->holiday_rating; $i++) { ?>
                                        <i class="fa fa-star"></i>
                                    <?php } ?>

                                </span>
                            <h4 class="mt0"><?php echo $results->holiday_name; ?></h4>
                            <?php  if($results->holiday_start_price != NULL) { ?>
                                    <div class="clearfix">
                                        <span class="pull-left danger-color">
                                            <small class="fz14 read-color uppercase">Start From</small> <?php echo $this->dsa_data->dsa_currency.' '.$results->holiday_start_price; ?>
                                        </span>
                                            
                                    </div>
                            <?php } ?>
                            <p class="read-color mt15 taj">
                                <?php echo word_limiter(strip_tags($results->holiday_short_description), 12); ?>
                            </p>
                        </div>
                        <span class="btn btn-default block">View Details</span>
                    </a>
                </div>
           <?php } } else{ ?>
            <h2 class="text-center">Not found any featured tours.</h2>
           <?php } ?>

        </div>
    </div>
</div>




<?php $this->load->view("commenLayout/footer"); ?>

<script type="text/javascript">

$('#date1').datepicker('setDate', '1');
    </script>
	
	


