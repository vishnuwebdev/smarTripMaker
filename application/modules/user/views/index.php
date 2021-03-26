 <?php $this->load->view('include/head') ?>
<?php $this->load->view('include/header') ?>

<body>

<section class="login-paul-temp pt-4 pb-4 pb-md-5">
	<div class="container">
	 <?php
        if ($this->session->flashdata('alert_register') !== NULl) {
            $bhanu_message = $this->session->flashdata('alert_register');
            ?>

            <div
                class="alert alert-sm alert-border-left <?php echo $bhanu_message['class']; ?>  light alert-dismissable">
                <button type="button" class="close" data-dismiss="alert"
                        aria-hidden="true">×</button>
                <i class="fa fa-info pr10"></i> <strong> <?php echo $bhanu_message['message']; ?></strong>
            </div>

        <?php } ?>
		<div class="login-page-temp">
			<!-- Login Top Head -->
			<div class="login-top-head">
				<h3>Login</h3>
				<span class="ic-login">
					<i class="icofont-users-alt-3"></i>
				</span>
			</div><!-- Login Top Head End -->
			<!-- Login Body Wrapper -->
			<div class="login-body-wrap">
				<form action="<?php echo site_url(); ?>user/login" method="post" role="form" id="login">
					<div class="form-group lg-col">
						<input type="email" name="email" class="form-control" id="" autocomplete="off" placeholder="Enter Your Email Id" required>
						<span><i class="icofont-envelope-open"></i></span>
					</div>
					<div class="form-group lg-col">
						<input type="password" name="password" class="form-control" id="" placeholder="Enter Your Password" required>
						<span><i class="icofont-lock"></i></span>
					</div>
					<div class="login-form-bottom pt-2 pb-2">
						<ul class="list-inline mb-0">
							<li class="list-inline-item">
								<div id="remember" class="checkbox htl-srch-rtng">
			                      <label>
			                        <input type="checkbox" value="remember-me"> <span>Remember me?</span>
			                      </label>
			                      
			                    </div>
							</li>
							<li class="list-inline-item">
								<a class="forgot-password text-danger" data-toggle="modal" href='#forgot-password'>Forgot Password</a>
							</li>
							<li class="list-inline-item">
								<a href="<?php echo site_url();?>user/registration" class="text-success">Register Now</a>
							</li>
						</ul>
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



	




<!-- Forgot Password -->
<div class="modal fade" id="forgot-password">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Forgot Password</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
				<div class="forgot-pass">
				  <form class="form-signin" action="<?php echo site_url(); ?>user/forgotpassword" method="post" id="forgot_pass">
					<div class="input-group mb-3">
	                  <div class="input-group-prepend">
	                    <span class="input-group-text">
	                      <i class="icofont-envelope-open"></i>
	                    </span>
	                  </div>
	                  <input type="email" name="email" id="last-name" class="form-control" placeholder="Enter Email Id">
	                </div>
	                <ul class="list-inline mb-2 text-center">
	                	<li class="list-inline-item">
	                		<button type="submit" class="btn btn-search">Submit</button>
	                	</li>
	                </ul>
					</form>
	                <p class="mb-0 for-acc text-center">Don't have Smart Trip Maker Account? <a href="<?php echo site_url();?>user/registration" class="create_an text-success">Create An Account Title</a></p>
				</div>
			</div>
		</div>
	</div>
</div>


    <?php $this->load->view("include/footer"); ?>


    <?php $this->load->view("js"); ?>

</body>

