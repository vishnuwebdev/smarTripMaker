<?php $this->load->view('header') ?>
<?php $this->load->view('home_slider') ?>
<?php $this->load->view('hotel_search_home') ?>

<section id="special" class="hidden-xs">

		<div class="container no-padding">
            <div class="row"><h2 style="font-weight: bold;color: #fe0045;width: fit-content;border-bottom: 3px solid;padding-bottom: 8px;margin: auto;margin-bottom: 20px;">Top Destinations</h2></div>
			 <div class="row">
     
					<?php 
					if(!empty($result)){
							foreach ($result as $Key => $results) { ?>
							<div class="col-md-4" style="padding:10px">
                                <div class="grid">
                                    <figure class="effect-roxy">
                                        <img src="<?php echo site_url(); ?>admin/assets/img/holiday/main/<?php echo $results->holiday_feature_image; ?>" alt="img15"/>
                                        <figcaption>
                                            <h2><?php echo word_limiter(strip_tags($results->holiday_name), 5); ?></h2>
                                            <p>
                                                <?php echo word_limiter(strip_tags($results->holiday_short_description), 15); ?>
                                            </p>
                                            <p style="margin-top: 20px;">
                                            <span style="font-size: 26px;" class="pricepak text-right">
                                                <i class="fa fa-inr"></i> <?php  echo $results->holiday_start_price; ?>
                                            </span>
                                                <button class="btn btn-custom pull-right" href="<?php echo site_url() ?>holiday/holidaydetail/<?php echo $results->holiday_slug; ?>">View more</button>
                                            </p>
                                            <a class="btn btn-custom" href="<?php echo site_url() ?>holiday/holidaydetail/<?php echo $results->holiday_slug; ?>">View more</a>
                                        </figcaption>			
                                    </figure>
                                </div>
                            </div>

							<?php } }?>

					<div>

					</div>

					</div>

		</div>

	</div>

</section>	







<?php $this->load->view('footer') ?>






