<?php $this->view('simple_layout/header'); ?>
<?php $this->view('simple_layout/leftSidebar'); ?>
<section id="content">
	<div class="page page-forms-validate">
		<div class="pageheader">
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li><a href="<?php echo site_url();?>"><i class="fa fa-home"></i>
							Dashboard</a></li>
					<li><a href="<?php echo site_url($this->uri->segment("1"));?>"> <?php echo $this->uri->segment("1");?></a></li>
					<li><a>Update Password</a></li>
				</ul>
			</div>
		</div>

                    <!-- row -->
                    <div class="row">

                        <!-- col -->
                        


                        <!-- col -->
                        <div class="col-md-6 col-md-offset-3">

                            <!-- tile -->
                            <section class="tile">

                                <!-- tile header -->
                                <div class="tile-header dvd dvd-btm">
                                    <h1 class="custom-font"><strong>Change Password</strong></h1>
                                    <ul class="controls">
                                      
                                    </ul>
                                </div>
                                <!-- /tile header -->
<form name="form2" role="form" id="changepass" method="POST" action="<?php echo site_url('dsa/changePassword'); ?>">
                                <!-- tile body -->
                                <div class="tile-body">

                                   

                                    
	   <input type="hidden"
			name="<?php echo $this->security->get_csrf_token_name(); ?>"
			value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                    <?php
																												if ($this->session->flashdata ( 'alert' ) !== NULl) {
																													$bhanu_message = $this->session->flashdata ( 'alert' );
																													?>
		
              <div
								class="alert alert-sm alert-border-left <?php echo $bhanu_message['class'];?> light alert-dismissable">
								<button type="button" class="close" data-dismiss="alert"
									aria-hidden="true">×</button>
								<i class="fa fa-info pr10"></i> <strong> <?php echo $bhanu_message['message'];?></strong>
							</div>
              
			<?php }?>

                                        <div class="form-group">
                                            <label for="website">Current Password: </label>
                                            <input type="password" name="old_password" id="website" class="form-control" placeholder="" required>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="website">New Password: </label>
                                            <input type="password" name="new_password" id="newpassword" class="form-control" placeholder="" required data-parsley-trigger="change"
                                                              >
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="website">Confirm New Password: </label>
                                            <input type="password" name="conf_new_password" class="form-control" placeholder="" required data-parsley-trigger="change"
                                                               data-parsley-equalto="#newpassword">
                                        </div>

                                       
                                  

                                </div>
                                <!-- /tile body -->
                                 <!-- tile footer -->
                                <div class="tile-footer text-right bg-tr-black lter dvd dvd-top">
                                    <!-- SUBMIT BUTTON -->
                                    <button type="submit" class="btn btn-lightred">Change</button>
                                </div>
                                <!-- /tile footer -->
  </form>
                               

                            </section>
                            <!-- /tile -->


                            <!-- tile -->
                            


                        </div>
                        <!-- /col -->



                    </div>
                    <!-- /row -->




                </div>
                
            </section>
            <!--/ CONTENT -->
 


       <?php $this->load->view("simple_layout/footer");?>
<?php $this->load->view($this->uri->segment("1")."/js");?>