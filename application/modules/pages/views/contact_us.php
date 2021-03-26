
 <?php $this->load->view('include/head') ?>
<?php $this->load->view('include/header') ?>
 
<!-- Inner Page Header -->
<section class="inner-header pt-2 pb-2 pt-md-4 pb-md-4">
	<div class="container">
		<div class="section-heading--title position-relative">
			<h1 class="text-center title-show-title">Contact Us</h1>
			<h1 class="text-center title-back-title">Contact Us</h1>
			
		</div>
	</div>
</section>
<!-- Inner Page Header end -->

<!-- Main Wrapper Start from here -->
<main class="main-contant-wrap pt-md-3 pb-md-3"> 
	<div class="container">
		<div class="contact-page-temp p-2 pt-md-3 pb-md-3">
			<div class="ctc-add-details pr-4 pl-4">
				<div class="row">
					<div class="col-md-4 col-sm-4 col-12">
						<div class="ctc-addr-com">
							<i class="icofont-phone"></i>
							<div class="ctc-add-right">
								<strong>Phone :</strong>
								<!--<a href="tel:<?php echo $this->dsa_setting->dsaset_phone; ?>"><?php echo $this->dsa_setting->dsaset_phone; ?></a>-->
								<!-- <a href="tel:+917087271792">INDIA : +91 7087271792</a> <br/> -->
								<a href="tel:+919876764792">INDIA : +91 9876764792</a> <br/>
								<!-- <a href="tel:+971556135321">UAE :  +971556135321</a> -->
								<a href="tel:+971543744833">UAE :  +971 543744833</a>
								
								<!-- <a href="tel:+971543744833">UAE : +971543744833, +97143836857 +971556135321</a> -->
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-4 col-12">
						<div class="ctc-addr-com">
							<i class="icofont-envelope-open"></i>
							<div class="ctc-add-right">
								<strong>Email  :</strong>
								<a href="mailto:<?php echo $this->dsa_setting->dsaset_email; ?>"><?php echo $this->dsa_setting->dsaset_email; ?></a>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-4 col-12">
						<div class="ctc-addr-com">
							<i class="icofont-google-map"></i>
							<div class="ctc-add-right">
							
								<strong>India Address:-  </strong>								
								<p class="mb-0">

								<!-- SCF NO 103, Cabin No-2, Basement, <br/>
								Phase 11 Mohali Sector 65 <br/>
								Punjab - 160065    -->
								SCF NO 103, Cabin No-1, Top Floor, <br/>
								Phase 11 Mohali Sector 65 <br/>
								Punjab - 160065
								</p>
							</div>	
							<i class="icofont-google-map" style="margin-top:10px"></i>
							<div class="ctc-add-right" style="margin-top:10px">
								<strong>Dubai Address:-  </strong>
								<!--<p class="mb-0"><?php echo $this->dsa_setting->dsaset_address_1.',<br>'.$this->dsa_setting->dsaset_city
								.','.$this->dsa_setting->dsaset_state
								.',<br>'.$this->dsa_setting->dsaset_country.','.$this->dsa_setting->dsaset_pincode; ?>
								</p>-->
								<p class="mb-0">
								Smart Trip Maker FZ LLE <br/>
								Suite 17, The Iridium Building  <br/>
								Umm Suqeim Road, Al Barsha  <br/>
								Dubai - 391186     
								</p>
								
								
							</div>
						</div>
					</div>
					
					
				</div>
			</div>
			<div class="contact-form pt-2 pb-2 pt-md-4 pb-md-4">
				<div class="section-heading--title position-relative">
					<h1 class="text-center contact-head">Contact Form <span class="d-block">If you have any question just ask us</span></h1>
				</div>				
				  <?php
            if ($this->session->flashdata('alertmsg') !== NULl) {
                $bhanu_message = $this->session->flashdata('alertmsg');
                ?>
                <div
                    class="alert alert-sm alert-border-left <?php echo $bhanu_message['class']; ?> light alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert"
                            aria-hidden="true">×</button>
                    <i class="fa fa-info pr10"></i> <strong> <?php echo $bhanu_message['message']; ?></strong>
                </div>
            <?php } ?>
			<?php $log_wrong= $this->session->flashdata('wrong_cap');
			if(!empty($log_wrong)){?>
				<div class="alert alert-danger mt-lg" id="contactSuccess">
					Captcha code does not match, please try again.
				</div>
			<?php }?>
				<div class="col-lg-8 col-md-10 offset-md-1 offset-lg-2">
                    <form class="form" id="contact-form" method="post" action="<?php echo site_url();?>pages/contact_us">
                    	<div class="row">
                    		<div class="col-lg-6">
                    			<div class="form-group">
                    				<input id="form_name" type="text" class="form-control" name="name" placeholder="Name*" required="required">
                    			</div>
                    		</div>
                    		<div class="col-lg-6">
                    			<div class="form-group">
                    				<input id="form_email" type="email" class="form-control" name="email" placeholder="Email*" required="required">
                    			</div>
                    		</div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input id="form_phone" type="text" class="form-control" name="mobile" placeholder="Phone*">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input id="form_subject" type="text" class="form-control" name="subject" placeholder="Subject*">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea id="form_message" class="form-control" name="message" placeholder="Message*" required="required"></textarea>
                                </div>
                            </div>
							
							<div class="row">
								<div class="form-group">
									<div class="col-md-12">
										<label>Enter Captcha Code Below*</label>
										<p id="captImg"><?php echo $captchaImg; ?></p>
										<p>Can't read the image? click <a href="<?php echo site_url("pages/contact_us");?>" class="refreshCaptcha">here</a> to refresh.</p>
										  <input type="text" name="captcha" class="form-control" value="" placeholder="Captcha code*" data-msg-required="Please enter captcha code." required=""/>
									</div>
								</div>
								</div>

                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-search"><span>Send Message</span></button>
                            </div>
                        </div> 
                    </form>
                </div>
			</div>
		</div>
	</div>
</main><!--/ Main Wrapper Start from here -->
 
 <?php $this->load->view("include/footer"); ?>
 
 <script>
 
 $("#contact-form").validate({
	  rules: {
		  name:{
	        required: true,
			number:false,
		},
		
		subject:{
	        required: true,			
		},
		  mobile:{
			required: true,
			number:true,
			minlength: 10,
			maxlength: 10
		    
			  },
		   email:{
				required: true,
				email: true,				
		    },
			
			message:{
	        required: true,			
		},
	},
	  messages:{
		
	}
		});
 </script>