<div class="news-letter-wrap" id="newsletter-wrapper">
    <div class="container">
      <form action="<?php echo site_url();?>pages/newsletter" method="post">
        <div class="row">
          <div class="col-lg-5 col-md-12 col-sm-12">
            <h2>Subscribe to our Newsletter</h2>
          </div>
         <div class="col-lg-7 col-md-12 col-sm-12">
           <div class="row">
              <div class="col-md-9 col-sm-8 ">
              <div class="newsletter-box">
                <i class="icofont-ui-message"></i>
                <input type="email" name="email" class="form-control fccustom2 sub_email" id="exampleInputEmail1" placeholder="Enter your email" required="">
              </div>
            </div>
            <div class="col-md-3 col-sm-4 pl-sm-0">
              <button type="submit" class="btn btn-success btn-block sub_newsletter ttu"> Subscribe</button>
            </div>
           </div>
         </div>
        </div>
      <?php
        if ($this->session->flashdata ( 'newwsalert' ) !== NULl) {
          $bhanu_message = $this->session->flashdata ( 'newwsalert' );
          ?>
          <div class="text-center">
            <!-- Button trigger modal -->
            <h5 class="success-smg-nlt" style="<?php echo $bhanu_message['class'];?>"><?php echo $bhanu_message['message'];?></h5>
          </div>
        <?php }?>
      </form>
    </div>
</div>

		<!-- Footer Start from here -->
		<footer class="site-footer pt-2 pb-2 pt-md-4 pb-md-3" id="site-footer">
			<!-- Top Footer Start From here -->
		<div class="top-footer">
				<div class="container">
					<div class="row">
						<div class="col-lg-2 col-md-2 col-sm-6 col-6">
							<div class="foot-com">
                   <?php $mdataaa = get_footer_menu("B2c","footer_one");
                       // printArray($mdataaa);
                       // die;
					   
                 $gridvalue = 0;
                       if($mdataaa != "0"){
                        foreach ($mdataaa as $key => $mdata) {
                          
                        ?>
						
						
                  <h3><?php echo $mdata["menu"]["menuTitle"]; ?></h3>
                  <div class="foo-link">
                    <ul class="list-inline">
                        <?php
                            if($mdata["menuPage"] != NULL){
                            foreach($mdata["menuPage"] as $datasds){ ?>
                      <li>
                       <?php if($datasds->menupage_menu_type == "custom"){ 
                                    
                                    $hreflink = $datasds->menupage_page_slug;
                                }else{
                                    
                                    $hreflink = site_url()."online/".$datasds->menupage_page_slug;
                                } ?>

                        <a href="<?php echo $hreflink; ?>" target="<?php echo $datasds->menupage_menu_target; ?>"><?php 
                                if(!empty($datasds->menupage_page_display_title)){
                                echo $datasds->menupage_page_display_title;
                                }else{
                                   echo $datasds->menupage_page_title;
                                } ?>
                                  
                                </a></li>
                                  <?php } }else{ ?>
                                Menu page not added.
                            <?php } ?>
				
                      
                    </ul>
                  </div>
                  <?php if($gridvalue == 3){ ?>

                <div class="clearfix"></div>
          <?php $gridvalue =0; } ?>
           <?php
           $gridvalue++;
          }
        } else{ ?>
                           Please check you have added menu in admin correctly.
                <?php } ?>
									
					</div>
				</div>
						<div class="col-lg-2 col-md-2 col-sm-6 col-6">
							<div class="foot-com">
							
							 <?php $mdataaa2 = get_footer_menu("B2c","footer_two");
                       // printArray($mdataaa);
                       // die;
                 $gridvalue2 = 0;
                       if($mdataaa2 != "0"){
                        foreach ($mdataaa2 as $key2 => $mdata2) {
                          
                        ?>
                  <h3><?php echo $mdata2["menu"]["menuTitle"]; ?></h3>
                <div class="foo-link">
                    <ul class="list-inline">
                      <?php
                            if($mdata2["menuPage"] != NULL){
                            foreach($mdata2["menuPage"] as $datasds2){ ?>
                      <li>
                       <?php if($datasds2->menupage_menu_type == "custom"){ 
                                    
                                    $hreflink2 = $datasds2->menupage_page_slug;
                                }else{
                                    
                                    $hreflink2 = site_url()."online/".$datasds2->menupage_page_slug;
                                } ?>
                         <a href="<?php echo $hreflink2; ?>" target="<?php echo $datasds2->menupage_menu_target; ?>"><?php 
                                if(!empty($datasds2->menupage_page_display_title)){
                                echo $datasds2->menupage_page_display_title;
                                }else{
                                   echo $datasds2->menupage_page_title;
                                } ?></a></li>
                                     <?php } }else{ ?>
                                Menu page not added.
                            <?php } ?>
                      
                     
                    </ul>
                  </div>
                          <?php if($gridvalue2 == 3){ ?>

                <div class="clearfix"></div>
          <?php $gridvalue2 =0; } ?>
           <?php
           $gridvalue2++;
          }
        } else{ ?>
                           Please check you have added menu in admin correctly.
                <?php } ?>
				
							</div>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-6">
							<div class="foot-com">
							
							 <?php $mdataaa3 = get_footer_menu("B2c","footer_three");
                       // printArray($mdataaa);
                       // die;
                 $gridvalue3 = 0;
                       if($mdataaa3 != "0"){
                        foreach ($mdataaa3 as $key3 => $mdata3) {
                          
                        ?>
                  <h3><?php echo $mdata3["menu"]["menuTitle"]; ?></h3>
                  <div class="foo-link">
					<ul class="list-inline">
                          <?php
                            if($mdata3["menuPage"] != NULL){
                            foreach($mdata3["menuPage"] as $datasds3){ ?>
                      <li>
                        <?php if($datasds3->menupage_menu_type == "custom"){ 
                                    
                                    $hreflink3 = $datasds3->menupage_page_slug;
                                }else{
                                    
                                    $hreflink3 = site_url()."online/".$datasds3->menupage_page_slug;
                                } ?>
                         <a href="<?php echo $hreflink3; ?>" target="<?php echo $datasds3->menupage_menu_target; ?>"><?php 
                                if(!empty($datasds3->menupage_page_display_title)){
                                echo $datasds3->menupage_page_display_title;
                                }else{
                                   echo $datasds3->menupage_page_title;
                                } ?></a></li>
                                <?php } }else{ ?>
                                Menu page not added.
                            <?php } ?>
                    </ul>
                  </div>
                                     <?php if($gridvalue3 == 3){ ?>

                <div class="clearfix"></div>
          <?php $gridvalue3 =0; } ?>
           <?php
           $gridvalue3++;
          }
        } else{ ?>
                           Please check you have added menu in admin correctly.
                <?php } ?>
							
							
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-6">
							<div class="foot-com">
								<h3>Follow Us</h3>
								<div class="foo-link social-media">
								
								  <ul class="list-inline">
               
				   <?php if(strlen(str_replace(' ','',$this->social_links['facebook'])) != 0){ ?> 
                        <li class="fb list-inline-item" >
                            <a href="<?php echo $this->social_links['facebook'] ?>" target="_blank">
                                <i class="icofont-facebook"></i>
                            </a>
                        </li>
                        <?php } ?> 
                       
                        <?php if(strlen(str_replace(' ','',$this->social_links['twitter'])) != 0){ ?> 
                        <li class="tw list-inline-item" >
                            <a href="<?php echo $this->social_links['twitter'] ?>" target="_blank">
                                <i class="icofont-twitter"></i>
                            </a>
                        </li>
                        <?php } ?> 

                       <?php if(strlen(str_replace(' ','',$this->social_links['instagram'])) != 0){ ?> 
                        <li class="insta list-inline-item" >
                            <a href="<?php echo $this->social_links['instagram'] ?>" target="_blank">
                                <i class="icofont-instagram"></i>
                            </a>
                        </li>
                        <?php } ?> 

                      

                        <?php if(strlen(str_replace(' ','',$this->social_links['google'])) != 0){ ?> 
                        <li class="ldn list-inline-item" >
                            <a href="<?php echo $this->social_links['google'] ?>" target="_blank">
                                <i class="icofont-linkedin"></i>
                            </a>
                        </li>
                        <?php } ?> 
						
						<?php if(strlen(str_replace(' ','',$this->social_links['youtube'])) != 0){ ?> 
                        <li class="utube list-inline-item" >
                            <a href="<?php echo $this->social_links['youtube'] ?>" target="_blank">
                                <i class="icofont-youtube"></i>
                            </a>
                        </li>
                        <?php } ?> 

                </ul>
								
								
								<!--
									<ul class="list-inline">
										<li class="fb list-inline-item">
											<a href="javascript:void(0)"><i class="icofont-facebook"></i></a>
										</li>
										<li class="tw list-inline-item">
											<a href="javascript:void(0)"><i class="icofont-twitter"></i></a>
										</li>
										<li class="ldn list-inline-item">
											<a href="javascript:void(0)"><i class="icofont-linkedin"></i></a>
										</li>
										<li class="insta list-inline-item">
											<a href="javascript:void(0)"><i class="icofont-instagram"></i></a>
										</li>
										<li class="gplus list-inline-item">
											<a href="javascript:void(0)"><i class="icofont-google-plus"></i></a>
										</li>
									</ul>									
								-->
									
								</div>
								<!--<div class="our-partner">
									<img src="<?php echo site_url();?>assets/images/partners.jpg" alt="partners">
								</div>-->
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-4">
							<div class="foot-com">
								<h3>Connect With Us</h3>
								<div class="foo-link foo-address">
									<ul class="list-unstyled">
									
									 <!-- <li>
									 <i class="icofont-google-map"></i> <?php echo $this->dsa_setting->dsaset_address_1.',<br>'.$this->dsa_setting->dsaset_city
									.','.$this->dsa_setting->dsaset_state
									.',<br>'.$this->dsa_setting->dsaset_country.','.$this->dsa_setting->dsaset_pincode; ?>
									</li>
									
									<li>
									  <i class="icofont-phone"></i> <a href="tel:<?php echo $this->dsa_setting->dsaset_phone; ?>"><?php echo $this->dsa_setting->dsaset_phone; ?></a>
									  </li>
									  <li>
									  <i class="icofont-envelope-open"></i> <a href="mailto:<?php echo $this->dsa_setting->dsaset_email; ?>"><?php echo $this->dsa_setting->dsaset_email; ?></a>
									  </li>
									
									-->
					
							  <!-- <li>
							  <i class="icofont-phone"></i> <a href="tel:+91 7087271792"> INDIA : +91 7087271792</a>
							  </li>
							  <li>
							  <i class="icofont-phone"></i> <a href="tel:+971543744833"> UAE : +971543744833</a>
							  </li> -->

                <li>
							    <i class="icofont-phone"></i> <a href="tel:+91 7087271792"> INDIA : +91 9876764792</a>
							  </li>
							  <li>
							    <!-- <i class="icofont-phone"></i> <a href="tel:+971543744833"> UAE : +971543744833</a> -->
                  <i class="icofont-phone"></i> <a href="tel:+971556135321"> UAE : +971 543744833</a>
                  
							  </li>
							  <li>
							  <i class="icofont-envelope-open"></i> <a href="mailto:<?php echo $this->dsa_setting->dsaset_email; ?>"><?php echo $this->dsa_setting->dsaset_email; ?></a>
							  </li>
								
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div><!--/ Top Footer end From here -->

			<!-- Bottom Footer Start From here -->
			<div class="bottom-footer">
				<div class="container">
					<p class="copyright text-center mb-0">Copyright &copy; 2019 Smart Trip Maker. All rights reserved.</p>
				</div>
			</div>
			<!-- Bottom Footer end From here -->
		</footer>
		<!-- Footer end from here -->
		
		<!--Flight Searhing Popup-->
<div class="modal fade flights-search-popup" id="searchingpopup" role="dialog">
<div class="modal-dialog">
    <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header text-center no-padding">
      <h5 class="w-100">Smart Trip Maker</h5>
    </div>
        <div class="modal-body">
         <div class="text-center">
          <!-- Loader start from here -->
          <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
          <!-- Loader end from here -->
          <h3>
            <span>Please Wait ...</span>
            <span> We are searching the best flights for you </span>
          </h3>
            <div class="clearfix destination-wrap">
              <span class="oneway_m">
                <span class="from_location_m">DEL</span>
                <i class="icofont-long-arrow-right"></i>
                <span class="to_location_m">BOM</span>
              </span>
              <span class="return_m">
                <span class="from_location_m" >DEL</span>
                <i class="icofont-exchange"></i>
                <span class="to_location_m">BOM</span>
              </span>
            </div>

            <div class="flght-psg-deails flght-psg-deails-pop">
              <span>Adult(s) <strong class="num_adult">1 </strong> </span>
              <span>Child(s) <strong class="num_child">0 </strong> </span>
              <span>Infant(s) <strong class="num_infant">0 </strong> </span>
            </div>
          <span class="block midfz">Do not refresh or close the Window</span>
          <ul class="list-inline flt-booking-de-re">
            <li class="list-inline-item">
              <span class="oneway_m_d">
                <b>Depart - </b> <span class="depart_date_m"> 20-02-2018 </span>
              </span>
            </li>
            <li class="list-inline-item">
              <span class="return_m_d">
                <b>Return - </b>
                <span class="return_date_m">22-02-2018</span>
              </span>
            </li>
          </ul>
        </div>
        </div>
        
      </div>
      
    </div>
  </div> 


		
		
		
		
		
		<!--Scripts-->
		<script src="<?php echo site_url();?>assets/js/jquery-3.1.1.min.js"></script>
		<script src="<?php echo site_url();?>assets/js/popper.min.js"></script>
		<script src="<?php echo site_url();?>assets/js/bootstrap.min.js"></script>
		<script src="<?php echo site_url();?>assets/js/owl.carousel.min.js"></script>
		<script src="<?php echo site_url();?>assets/js/jquery.fancybox.min.js"></script>
		<script src="<?php echo site_url();?>assets/js/jquery-ui.min.js"></script>
		<script src="<?php echo site_url();?>assets/js/custom.js"></script>
		<script src="<?php echo site_url();?>assets/js/jquery.validate.min.js"></script>
    <script src="<?php echo site_url();?>plugin/toaster/jquery.toast.min.js"></script>
    
    <script>var chatbot_id=6744;!function(){var t,e,a=document,s="smatbot-chatbot";a.getElementById(s)||(t=a.createElement("script"),t.id=s,t.type="text/javascript",t.src="https://smatbot.s3.amazonaws.com/files/smatbot_plugin.js.gz",e=a.getElementsByTagName("script")[0],e.parentNode.insertBefore(t,e))}();</script><script src="https://cdnjs.cloudflare.com/ajax/libs/fingerprintjs2/1.5.1/fingerprint2.min.js"></script>
      <script>
          <?php  if ($this->session->flashdata ( 'success' ) !== NULl) { ?>
              $.toast({
                text :"<?= $this->session->flashdata ( 'success' ) ?>",
                bgColor : "green",
                position:'top-right'
              });
          <?php } if ($this->session->flashdata ( 'error' ) !== NULl) { ?>
              $.toast({
                text :"<?= $this->session->flashdata ( 'error' ) ?>",
                bgColor : "red",
                position:'top-right'
              });
          <?php } ?>
          
      </script>
    
	</body>
</html>