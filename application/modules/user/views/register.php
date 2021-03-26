 <?php $this->load->view('include/head') ?>
<?php $this->load->view('include/header') ?>

<body>

<section class="login-paul-temp pt-4 pb-4 pb-md-5">
	<div class="container">
		<div class="login-page-temp registration-temp">
			<!-- Login Top Head -->
			<div class="login-top-head">
				<h3>Registration</h3>
				<span class="ic-login">
					<i class="icofont-users-alt-3"></i>
				</span>
			</div><!-- Login Top Head End -->
			<!-- Login Body Wrapper -->
			<div class="login-body-wrap">
				<form action="<?php echo site_url();?>user/registration" method="post" role="form" id="register">
					   <?php echo form_error('myfield', '<div class="error">', '</div>');?>
                        <?php if(validation_errors()!=NULL){?>	
                        <div class="alert alert-big alert-lightred alert-dismissable fade in">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<?php echo validation_errors(); ?>
						</div>
						<?php }?>
					<?php $log_wrong= $this->session->flashdata('wrong_cap');
			if(!empty($log_wrong)){?>
				<div class="alert alert-danger mt-lg" id="contactSuccess">
					Captcha code does not match, please try again.
				</div>
			<?php }?>
					<div class="row">
						<div class="col-md-6">
							<div class="input-group mb-3">
			                  <div class="input-group-prepend">
			                    <span class="input-group-text">
			                      <i class="icofont-ui-user"></i>
			                    </span>
			                  </div>
			                  <input type="text" name="first_name" id="first_name" class="form-control" placeholder="First Name">
			                </div>
						</div>
						<div class="col-md-6">
							<div class="input-group mb-3">
			                  <div class="input-group-prepend">
			                    <span class="input-group-text">
			                      <i class="icofont-ui-user"></i>
			                    </span>
			                  </div>
			                  <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last Name">
			                </div>
						</div>
						<div class="col-md-6">
							<div class="input-group mb-3">
			                  <div class="input-group-prepend">
			                    <span class="input-group-text">
			                      <i class="icofont-phone"></i>
			                    </span>
			                  </div>
			                  <input type="number" name="mobile_no" id="mobile_no" class="form-control" placeholder="Mobile No" >
			                </div>
						</div>
						<div class="col-md-6">
							<div class="input-group mb-3">
			                  <div class="input-group-prepend">
			                    <span class="input-group-text">
			                      <i class="icofont-envelope-open"></i>
			                    </span>
			                  </div>
			                 <input type="email" name="email_address" id="email" class="form-control" placeholder="Enter Email">
			                </div>
						</div>
						<div class="col-md-6">
							<div class="input-group mb-3">
			                  <div class="input-group-prepend">
			                    <span class="input-group-text">
			                      <i class="icofont-key"></i>
			                    </span>
			                  </div>
			                 <input type="password" name="password" id="password" class="form-control" placeholder="Enter Password" >
			                </div>
						</div>
						<div class="col-md-6">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text">
				                     <i class="icofont-key"></i>	
				                    </span>
				                </div>
				               <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm Password">
				           </div>
						</div>
						
							<div class="form-group">
								<div class="col-md-12">
									<label>Enter Captcha Code Below*</label>
									<p id="captImg"><?php echo $captchaImg; ?></p>
									<p>Can't read the image? click <a href="<?php echo site_url("user/registration");?>" class="refreshCaptcha">here</a> to refresh.</p>
									  <input type="text" name="captcha" class="form-control" value="" data-msg-required="Please enter captcha code." required=""/>
								</div>
							</div>
						
						
						
						
						
					</div>
					<div class="login-form-bottom pt-2 pb-2">
						<ul class="list-inline mb-0">
						  <span class="button-checkbox">
							<li class="list-inline-item">
								<div id="remember" class="checkbox htl-srch-rtng mb-2 t_and_c">
			                      <label>
			                        <input type="checkbox" value="remember-me" name="terms">
									<span>By proceeding, you agree with our <a href="<?php echo site_url() ?>online/terms-and-conditions" class="text-success">Terms of Service</a> &
									<a href="<?php echo site_url(); ?>online/privacy-policy" class="text-danger">Privacy Policy</a></span>
			                      </label>								  
			                  </div>						 
							   
                               <input type="checkbox" name="t_and_c" id="t_and_c" class="hidden" style="display:none;" value="1">
							</li>
							 </span>
							<li class="list-inline-item">							
								<a href="<?php echo site_url();?>user/login" class="text-success">Login</a>
							</li>
						</ul>
						<label id="terms-error" class="error" for="terms" style="display:none !important;">This field is required.</label>						
					</div>


					<div class="social-media-login text-center">
						<div class="login-sep"><span>OR</span></div>
	                    <ul class="list-inline mb-0 social-login-wrap">
	                    	<li class="list-inline-item">
		                        <a href="<?php echo $login_url; ?>" class="fb-login">
		                          <i class="icofont-facebook"></i> Login With Facebook
		                        </a>
	                    	</li>
	                    	<li class="list-inline-item">
	                    		<a href="<?php echo $google_login_url; ?>" class="plus-login">
	                    			<i class="icofont-google-plus"></i> Login with google
	                    		</a>
	                    	</li>
						</ul>
					</div>
					
					<button type="submit" class="btn btn-login"><i class="icofont-long-arrow-right"></i></button>
				</form>
			</div>			
		</div>
	</div>
</section>


    <?php $this->load->view("include/footer"); ?>


    <?php $this->load->view("js"); ?>

</body>

