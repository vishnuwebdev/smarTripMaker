

<?php $this->load->view("header"); ?>
<link href="<?php echo site_url(); ?>assets/css/login.css" rel="stylesheet">
<style>
    .forgot-box .input-group{
        margin-bottom: 10px;
    } 
    .create_an{
      color: #004683;
      font-size: 13px;
      display: inline-block;
      font-weight: 600;
    }
</style>
<body>

  <div class="lgn-bg">  
  
    <div class="container mb-40">
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
        <div class="forgot-box col-md-8 col-md-offset-2">
           <div class="login-wrap-form">
             <!-- <img class="profile-img-card" src="<?php echo $this->dsa_data->dsa_admin_url;?>assets/img/logos/<?php echo $this->dsa_data->dsa_logo;?>" alt="<?php echo $this->dsa_data->dsa_company_name;?>" title="<?php echo $this->dsa_data->dsa_company_name;?>" height="50" style="width:300px;" /> -->
         
            <form class="form-signin" action="<?php echo site_url(); ?>user/forgotpassword" method="post">
                <span id="reauth-email" class="reauth-email"></span>
                <div class="input-group">
                  <span class="input-group-addon"><i class="icofont-envelope-open"></i></span>
                  <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus name="email">
                </div>
                <div class="forgot-pass-bottom text-center">
                  <button class="btn-login btn btn-org btn-flght" type="submit"><i class="icofont-paper-plane"></i> Submit</button>
                    <a href="<?php echo site_url(); ?>user/login" class="forgot-password btn-login btn btn-org btn-flght">
                    <i class="icofont-sign-in"></i> Sign In.
                </a>
                </div>
            </form>
            <!-- /form --> 
            
            <p class="text-center mb-0">Don't have <?php echo $this->dsa_data->dsa_company_name;?> Account?</p>
            <p class="text-center"><a href="<?php echo site_url(); ?>user/registration" class="create_an">Create An Account Title</a></p>
           </div>
           
             

        </div>
        <!-- /card-container -->
    </div>
  </div>
    <!-- /container -->


    <?php $this->load->view("footer"); ?>


    <?php $this->load->view("js"); ?>

</body>

