 <?php $this->load->view('include/head') ?>
<?php $this->load->view('include/header') ?>


<body>

  

    <div class="container mb-40" style="padding-top: 40px;">
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
        <div class="card card-container">

           <img class="profile-img-card" src="<?php echo site_url();?>admin/assets/img/logos/<?php echo $this->dsa_data->dsa_logo;?>" alt="<?php echo $this->dsa_data->dsa_company_name;?>" title="<?php echo $this->dsa_data->dsa_company_name;?>" height="50" width="200" />
         
            <form class="form-signin" action="<?php echo site_url(); ?>user/rest_password" id="reset_password" method="post">
                <span id="reauth-email" class="reauth-email"></span>
                <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <input type="hidden" name="token" value="<?php echo $token['token'];  ?>">
                                <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" tabindex="5">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control input-lg" placeholder="Confirm Password" tabindex="6">
                            </div>
                        </div>
                    </div>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
            </form>
            <!-- /form -->
            <a href="<?php echo site_url(); ?>user/login" class="forgot-password">
                Sign In.
            </a>
        </div>
        <!-- /card-container -->
    </div>
    <!-- /container -->


<?php $this->load->view("include/footer"); ?>
<?php $this->load->view("js"); ?>

</body>

