

	<?php $this->load->view('header') ?>



		

	

		<!-- ============================================================== -->

		<!-- Concierge Services Starts -->

		<!-- ============================================================== -->

		 <section id="special" class="p-xs-8">
		<div class="container no-padding">
		  <div class="col-md-12 main-contant no-padding-xs">
		     <h3 class="mt-0 booking-title">Contact Us</h3>
			 <div class="row airline">
			    <div class="row pt-15">
					<div class="clearfix"></div>
						<div class="col-md-8 text-justify br-1 no-padding-xs">
						<?php
                    if ($this->session->flashdata('alertmsg') !== NULl) {
                        $bhanu_message = $this->session->flashdata('alertmsg');
                        ?>

                        <div
                            class="alert alert-sm alert-border-left <?php echo $bhanu_message['class']; ?>  light alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert"
                                    aria-hidden="true">×</button>
                            <i class="fa fa-info pr10"></i> <strong> <?php echo $bhanu_message['message']; ?></strong>
                        </div>

					<?php } ?>
						<form class="wow fadeInDown " action="<?php echo site_url() ?>front/contact_query"  data-wow-offset="300" method="post">
							 <div class="bhanu_error_msg_div002" style="display:none;"></div>
								 <div class="form_all_error_contact alert-danger"></div>
								<div class="row form-group">
									<div class="col-xs-6">
										<label>Name</label>
										<input type="text" placeholder="Name" name="name" class="form-control bhanu_validation" id="contact_name" required>
									</div>
									<div class="col-xs-6">
										<label>Email</label>
									 <input type="text" name="email" placeholder="Email" class="form-control bhanu_validation" id="contact_email" required>
									</div>
								</div>
								<div class="row form-group">
									<div class="col-xs-6">
										<label>Subject</label>
									  <input type="text" name="subject" placeholder="Subject "  class="form-control bhanu_validation" id="contact_subject" required>
									</div>
									<div class="col-xs-6">
										<label>Mobile No</label>
										 <input type="text" placeholder="Mobile No" name="mobile" class="form-control full-width bhanu_validation" id="contact_mobile" required>
									</div>
								</div>
								
								
								<div class="row form-group">
									<div class="col-md-12"><label>Your Query</label>
									 <textarea name="message" rows="6"  class="form-control bhanu_validation" placeholder="Write message here" id="contact_message" required></textarea></div>
								</div>
								<div class="row form-group mt-10">
									<div class="col-md-12">
								     <button type="submit" class="btn btn-custom btn-lg"> Send Query </button>
								     <p class="text-center" style="color:green">	</p>
									</div>
								</div>
							</form>

						</div>
						<div class="col-md-4">
							<h2>Head Office (INDIA)</h2>
							<p><strong>Phone:</strong>
							+91 <?php print_r($this->dsa_setting->dsaset_phone); ?>
							</p>
							<p><strong>Email:</strong>
							<?php print_r($this->dsa_setting->dsaset_email); ?>
							</p>
							<p><strong>Address:</strong>
							<?php echo $this->dsa_setting->dsaset_address_1.',<br>'.$this->dsa_setting->dsaset_city
                    .','.$this->dsa_setting->dsaset_state
                    .',<br>'.$this->dsa_setting->dsaset_country.','.$this->dsa_setting->dsaset_pincode; ?>
							</p>
							</div>
						</div>
				</div>
			 </div>
			 
		 
		</div>
		</div>
	</section>

<?php $this->load->view('footer') ?>

