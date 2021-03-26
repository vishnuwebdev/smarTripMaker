<?php $this->load->view("holidaylayout/header"); ?>
<!--//=======Main Slider=======//-->
<style>
    .alert>p {
    color: red;
}
label.error {
    font-size: 13px;
    color: red;
}
</style>
<div class="container-fluid loginpagefluid">
<div class="container">
		<h1 class="mainheading">Reset your Password </h1>
		
   <div class="row loginpagerow mt50"> 
			<div class="col-sm-6 col-md-offset-3">
				<div class="clearfix">
                                                         <?php
        if ($this->session->flashdata('cusmsg') != NULl) {
            $bhanu_message = $this->session->flashdata('cusmsg');
            ?>

            <div
                class="alert alert-sm alert-border-left alert-danger  light alert-dismissable">
                <button type="button" class="close" data-dismiss="alert"
                        aria-hidden="true">×</button>
                <i class="fa fa-info pr10"></i> <strong> <?php echo $bhanu_message["massege"]; ?></strong>
            </div>

        <?php } ?>
                               </div>
                        <!--//==Form Start==//-->
                        <form action="<?php echo site_url(); ?>user/resetpasspost" method="post" class="loginsignupform" id="register">
                            <?php echo form_error('myfield', '<div class="error">', '</div>');?>
					<?php if(validation_errors()!=NULL){?>	
					<div class="alert alert-big alert-lightred alert-dismissable fade in">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <?php echo validation_errors(); ?>
                                    </div>
                                    <?php }?>
                            <input type="hidden" name="CustomerRSTokan" value="<?php echo $cust_id; ?>" >
                            <p class="form-row pd-left">
                                <label for="password">Passwords <span class="required">*</span></label>
                                <input type="password" name="password" id="password" class="input block width-100 border radius" required="">
                            </p>
                            
                             <p class="form-row pd-left">
                                <label for="password">Confirm Password <span class="required">*</span></label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="input block width-100 border radius" required="">
                            </p>
                            
                            <p class="form-row mt20">
                                <button type="submit" value="Submit" name="reset" class="btn btn-success block width-100 otpformbtn"><i class="fa fa-sign-in"></i> Reset Password </button>                          
                            </p>
                           
                        </form>
				</div>
			</div>
		</div>
</div>
   <?php $this->load->view("holidaylayout/footer"); ?>
  <?php // $this->load->view("js"); ?>      

