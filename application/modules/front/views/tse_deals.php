<?php $this->load->view('header'); ?>
<?php

	if(isset($result))
	{
		foreach ($result as $k => $res) {
			if(isset($voucher[$res->voubran_id]) && is_array($voucher[$res->voubran_id])  && $voucher!="0") 
			{ 
				foreach($voucher[$res->voubran_id] as $vou) 
				{
					$all_price[] = $vou->vouch_offer_price;
				}
			}			
		}
	}

   
	$pricefiltermin = round(min($all_price));
	$pricefiltermax = round(max($all_price));
	 //print_r($pricefiltermax); exit;
 ?> 
  <div class="main-field">
    <div class="container">
      <div class="col-md-3 hidden-on-mob sidebar-wrap dis-booking-side" id="filter_xs_slide">
        <div class="sidebar_title">Search Filter</div>
      
        <!-- Price List -->
        <div class="row price_filter">
            <div class="row_sidebar_title">
                <h4><i class="fa fa-inr"></i> Price<span class="pull-right"></span></h4>
            </div>
            <div id="demo" class="row_sidebar_contant">
                        <p style="margin-top:10px;"><span><b>Rs </b> <?php echo $pricefiltermin; ?></span><span class="pull-right"><b>Rs </b><?php echo $pricefiltermax; ?></span></p>
                        <input id="ex3" type="text" class="span2" value="" data-slider-min="<?php echo $pricefiltermin - 1; ?>" data-slider-max="<?php echo $pricefiltermax + 1; ?>" data-slider-step="1" data-slider-value="[<?php echo $pricefiltermin; ?>,<?php echo $pricefiltermax; ?>]" />
                    </div>
        </div>
        <!-- Find Deals By Category -->
        <!-- <div class="row price_filter">
            <div class="row_sidebar_title">
                <h4><i class="fa fa-cog"></i> Find Deals By Category <span class="pull-right"></span></h4>
            </div>
			
        </div> -->
      </div>
      <div class="col-md-9 contant pr-0-xs pl-0-xs">
          <div class="dis-book-right-bar">
            <div class="dis-tab-cat-list">
              <?php if(isset($category)) { ?>
                <?php foreach($category as $cata) { ?>
                      <div class="row_sidebar_contant">
                          <form>
                              <ul class="find-deals-cate list-inline mb-0">
                                <li><a href="javascripti:void(0)"><span><?php echo $cata->voubracat_name;?></span></a></li>
                                
                              </ul>
                          </form>
                      </div>
                <?php } } ?>
            </div>
            <div class="dis-page-temp-btm">
			
			<?php if(isset($result)) { ?>
			<?php foreach($result as $bp) { ?>
              <div class="row airlines"  >
                <div class="list-deals-dis">
				<!-- Discount Header Start from here -->		
                  <div class="dis-card-head">
                    <div class="dis-deal-icon">
                      <img src="<?php echo site_url(); ?>assets/images/manager.png" >
                    </div>
                    <div class="dis-deal-name"><!----brand name--------->
                      <h2 class="mrname"><a class="mrname" href="<?php echo site_url()?>front/tse_deals_detail?ref_id=<?php echo url_encode($bp->voubran_id)?>"><?php echo $bp->voubran_brand_name;?></a></h2>
                      <span class="mrt"><i class="fa fa-star"></i><?php echo $bp->voubran_rating;?></span>
                      <strong class="deal-loc"><i class="fa fa-map-marker"></i>  <?php echo $bp->voubran_local_address;?></strong>
                    </div>
                    <div class="dis-deal-like like-icon">
                    	<h5>Deals: <span class="ttl-deals">05</span></h5>
                    </div>
                  </div><!-- Discount Header End from here -->
                 <?php if(isset($voucher[$bp->voubran_id]) && is_array($voucher[$bp->voubran_id])  && $voucher!="0") { ?>
				 <?php foreach($voucher[$bp->voubran_id] as $vouc) { ?>
                  <div class="dis-card-dlinfo price1" price="<?php echo round($vouc->vouch_offer_price); ?>">
                      <div class="deal-list">
                        <div class="row">
                          <a href="<?php echo site_url()?>front/tse_deals_detail?ref_id=<?php echo url_encode($bp->voubran_id)?>" class="deal-list-anc clearfix">
                          	<div class="col-md-8 col-sm-8 col-xs-8">
	                            <div class="deal-name"><?php echo $vouc->vouch_detail;?></div>
	                        </div>
	                        <div class="col-md-4 col-sm-4 col-xs-4">
	                        	<div class="price">
	                        		<i class="fa fa-inr"></i>
	                        		<span class="mrp"><?php echo $vouc->vouch_real_price;?></span><span class="sp"><?php echo $vouc->vouch_offer_price;?></span>
	                        	</div>
	                        </div>
                          </a>
                        </div>
                      </div>
                  </div>
                 <?php } } ?>
                  
                </div>
              </div>
			<?php } } else { ?>
			
			        <div class="row airlines">
                <div class="list-deals-dis">
				<!-- Discount Header Start from here -->		
                  <div class="dis-card-head">
                    <div class="dis-deal-icon">
                    
                    </div>
                    <div class="dis-deal-name"><!----brand name--------->
                      <h2 class="mrname"></h2>
                      <span class="mrt">Not Found</span>
                      <strong class="deal-loc"></strong>
                    </div>
                    <div class="dis-deal-like like-icon">
                    	
                    </div>
                  </div><!-- Discount Header End from here -->
                
                  <div class="dis-card-dlinfo">
                      <div class="deal-list">
                        <div class="row">
                          <a href="javascripti:void(0)" class="deal-list-anc clearfix">
                          	<div class="col-md-8 col-sm-8 col-xs-8">
	                            <div class="deal-name">Not Found</div>
	                        </div>
	                        <div class="col-md-4 col-sm-4 col-xs-4">
	                        	<div class="price">
	                        		<i class="fa fa-inr"></i>
	                        		<span class="mrp">0</span><span class="sp">0</span>
	                        	</div>
	                        </div>
                          </a>
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
  






<?php $this->load->view('footer'); ?>
<script src="<?php echo site_url(); ?>assets/js/filter.js"></script>
<script>
$(window).load(function(){
    $('body').backDetect(function(){
    // Callback function
      alert("Look forward to the future, not the past!");
    });
  })
</script>
