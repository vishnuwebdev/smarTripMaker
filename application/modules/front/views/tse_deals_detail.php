
<?php $this->load->view('header'); ?>
  <style>
  .fnt {
	      font-size: 16px;
    font-weight: 600;
    color: #000;
  }
  </style>
  <div class="main-field">
    <div class="container">
      
      <div class="col-md-8 contant pr-0-xs pl-0-xs">
          <div class="bus-book-right-bar">
            <div class="dis-details-temp">
			<?php if(isset($result)) { ?>
			<?php foreach($result as $bp) { ?>
              <div class="row airlines">
                  <div class="deal-card">
                    <div class="main-block dis-details-img">
                      <figure>
					     <?php if(isset($bp->voubran_image) && $bp->voubran_image!=null) {?>
                        <img src="<?php echo $this->dsa_data->dsa_b2b_url_2; ?>/assets/brand/<?php echo $bp->voubran_image ?>" alt="slider" class="responsive-img">
			<?php } else { ?>
			<img src="<?php echo site_url(); ?>/assets/images/not_found.png" alt="slider" class="responsive-img">
			<?php } ?>
                         <figcaption class="title clearfix"><!----brand name--------->
                          <h1 itemprop="name"><?php echo $bp->voubran_brand_name;?> </h1>
                        </figcaption>
                      </figure>

                      <!-- Social Icons -->
                      <div class="social-icon">
                        <ul class="list-inline">
                          <li><a href="javascripti:void"><i class="fa fa-facebook"></i></a></li>
                          <li><a href="javascripti:void"><i class="fa fa-twitter"></i></a></li>
                          <li><a href="javascripti:void"><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                      </div>
                      <!-- Social Icons End -->
                      <div class="shrt-details">
                        <p><?php echo $bp->voubran_detail ?></p>
                      </div>
                    </div>
                  </div>
              </div>
<?php } } ?>

<?php if(isset($result)) { ?>
			<?php foreach($result as $bp) { ?>
			<?php if(isset($voucher[$bp->voubran_id]) && is_array($voucher[$bp->voubran_id])  && $voucher!="0") { ?>
		<?php foreach($voucher[$bp->voubran_id] as $kie => $vouc) { ?>
		  <?php if($kie=="0") { ?> 
              <div class="row airlines">
                <div class="dis-acc-wrap">
                  <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h4 class="panel-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $kie;?>" aria-expanded="true">
                            <span><i class="fa fa-bullhorn"></i> <?php echo $vouc->vouch_name;?></span>
                            <div class="price">
                                <i class="fa fa-inr"></i>
                                <span class="mrp"><?php echo $vouc->vouch_real_price;?></span>
                                <span class="sp"><?php echo $vouc->vouch_offer_price;?></span>
                            </div>
                          </a>
                        </h4>
                      </div>
                      <div id="collapse<?php echo $kie;?>" class="panel-collapse collapse in">
                        <div class="panel-body">
                          <div class="dis-tab-pane">
                            <div class="row">
                              <div class="col-md-8 col-xs-12">
                                <ul class="list-ar">
                                  <li><strong>Week Days :</strong><?php echo $vouc->vouch_week_day;?></li>
                                  <li><strong>Week Time :</strong><?php echo $vouc->vouch_week_time;?></li>
                                  
                                   <?php echo $vouc->vouch_detail;?>
								  
                                </ul>
                              </div>
                              <div class="col-md-4 col-xs-12">
                                  <div class="buy">
                                    
                                    <div class="clearfix"></div>
                                    <p>Expires on <?php echo $vouc->vouch_end_date;?></p>
                                  </div>
                              </div>
                            </div>
                          </div>
						  <div class="row airlines">
                <div class="redeem-deal">
                  <h4>How to Use</h4>
                  <div class="ins blk-body">
                     <?php if(isset($vouc->vouch_how_to_use)) { ?>
                    <?php echo $vouc->vouch_how_to_use;?>
					<?php } ?>
                  </div>
                </div>
              </div>
			  
			      <div class="row airlines">
                <div class="redeem-deal">
                  <h4>Terms & Conditions</h4>
                  <div class="ins blk-body blk-body-col">
                     <p><?php echo $vouc->vouch_terms_condition;?></p>
                  </div>
                </div>
              </div>
			  
			  
                        </div>
                      </div>
                    </div>
				 </div> 


                </div>
              </div>
		  <?php } else {?>
		    <div class="row airlines">
                <div class="dis-acc-wrap">
                  <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h4 class="panel-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $kie;?>" aria-expanded="false">
                            <span><i class="fa fa-bullhorn"></i> <?php echo $vouc->vouch_name;?></span>
                            <div class="price">
                                <i class="fa fa-inr"></i>
                                <span class="mrp"><?php echo $vouc->vouch_real_price;?></span>
                                <span class="sp"><?php echo $vouc->vouch_offer_price;?></span>
                            </div>
                          </a>
                        </h4>
                      </div>
                      <div id="collapse<?php echo $kie;?>" class="panel-collapse collapse">
                        <div class="panel-body">
                          <div class="dis-tab-pane">
                            <div class="row">
                              <div class="col-md-8 col-xs-12">
                                <ul class="list-ar">
                                  <li><strong>Week Days :</strong><?php echo $vouc->vouch_week_day;?></li>
                                  <li><strong>Week Time :</strong><?php echo $vouc->vouch_week_time;?></li>
                                 
                                   <?php echo $vouc->vouch_detail;?>
								   
                                </ul>
                              </div>
                              <div class="col-md-4 col-xs-12">
                                  <div class="buy">
                                    
                                    <div class="clearfix"></div>
                                    <p>Expires on <?php echo $vouc->vouch_end_date;?></p>
                                  </div>
                              </div>
                            </div>
                          </div>
				<div class="row airlines">
                <div class="redeem-deal">
                  <h4>How to Use</h4>
                  <div class="ins blk-body">
				    <?php if(isset($vouc->vouch_how_to_use)) { ?>
                   
                    <?php echo $vouc->vouch_how_to_use;?>
					<?php } ?>
                  </div>
                </div>
              </div>
			  
			     <div class="row airlines">
                <div class="redeem-deal">
                  <h4>Terms & Conditions</h4>
                  <div class="ins blk-body blk-body-col">
                     <p><?php echo $vouc->vouch_terms_condition;?></p>
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
<?php } } } } ?>
             

           

            </div>
          </div>
        </div>

        <div class="col-md-4 hidden-on-mob sidebar" id="deal-view-dis">
          <div class="dis-details-sidebar">
          

            <!-- Recommended Deals -->
             <div class="sidebar-dts-panel addr-details-side">
              <h4>Recommended Category</h4>
              <div class="recom-deals-wrap">
                <div class="recom-deals-col">
                  <div class="card-head">
                    <div class="deal-icon">
                      <i class="icon-restaurants"></i>
                    </div>
                    <div class="deal-name">
                      <?php if(isset($category) && is_array($category)) { ?>
			           <?php foreach($category as $cata) { ?>
                      <div class="row_sidebar_contant">
                
                    <ul class="find-deals-cate list-unstyled">
                    	<li> <h2 class=" fnt mrname"><?php echo $cata->voubracat_name;?></h2></li>
                    	
                    </ul>
                
            </div>
			<?php } } ?>
                    </div>
                  </div>
                 
                </div>
              </div>
              
            </div>
          </div>
        </div>
    </div>
  </div>
  






<?php $this->load->view('footer'); ?>
<script>
/* $(function() {
    if (window.history && window.history.pushState) {
        window.history.pushState('', null, './');
        $(window).on('popstate', function() {
            //alert('Back button was pressed.');
			var url_test = "<?php echo site_url();?>";
            document.location.href = url_test;

        });
    }
}); */
</script>