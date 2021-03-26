 <?php $this->load->view('include/head') ?>
<?php $this->load->view('include/header') ?>


<body>

  

    <section class="login-paul-temp pt-4 pb-4 pb-md-5">
	<div class="container">
	 <?php
      if ($this->session->flashdata('alert_forgot') !== NULl) {
          $bhanu_message = $this->session->flashdata('alert_forgot');
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
				<h3>Reset Password</h3>
				<span class="ic-login">
					<i class="icofont-users-alt-3"></i>
				</span>
			</div><!-- Login Top Head End -->
			<!-- Login Body Wrapper -->
			<div class="login-body-wrap">
			<form class="form-signin" action="<?php echo site_url(); ?>user/rest_password" id="reset_password" method="post">
					<div class="form-group lg-col">
					  <input type="hidden" name="token" value="<?php echo $token['token'];  ?>">					
						 <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" tabindex="5">
						<span><i class="icofont-lock"></i></span>
					</div>
					<div class="form-group lg-col">						
						 <input type="password" name="password_confirmation" id="password_confirmation" class="form-control input-lg" placeholder="Confirm Password" tabindex="6">
						<span><i class="icofont-lock"></i></span>
					</div>
					<div class="login-form-bottom pt-2 pb-2">
						<ul class="list-inline mb-0">
						 <button class="btn btn-lg btn-primary btn-block" style="background-color:#069045" type="submit">Submit</button>
						 
							<li class="list-inline-item">
								<a href="<?php echo site_url();?>user/login" class="text-success">Sign In</a>
							</li>
						</ul>
					</div>
					<!--<button type="submit" class="btn btn-login"><i class="icofont-long-arrow-right"></i></button>-->
				</form>
			</div>			
		</div>
	</div>
</section>


<?php $this->load->view("include/footer"); ?>
<?php $this->load->view("js"); ?>

</body>

