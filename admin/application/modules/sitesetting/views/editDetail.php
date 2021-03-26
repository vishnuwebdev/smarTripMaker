<?php $this->view('simple_layout/header'); ?>
<?php $this->view('simple_layout/leftSidebar'); ?>

            <!-- ====================================================
            ================= CONTENT ===============================
            ===================================================== -->
            <section id="content">

              
            <!-- ====================================================
            ================= CONTENT ===============================
            ===================================================== -->
        

                <div class="page page-forms-validate">

                    <div class="pageheader">

                        <h2>Site Settings <span></span></h2>

                        <div class="page-bar">

                            <ul class="page-breadcrumb">
                                <li>
                                    <a href="index.html"><i class="fa fa-home"></i> SITE SETTING</a>
                                </li>
                               
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
                                    <h1 class="custom-font"><strong>update Site Setting</strong></h1>
                                    <ul class="controls">
                                      
                                    </ul>
                                </div>
                                <!-- /tile header -->
<form name="form2" role="form" id="changepass" method="POST" action="<?php echo site_url('sitesetting/update_website_detail'); ?>">
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
<input type="hidden" name="id" value="<?php echo $result->dsa_id; ?>">
                                        <div class="form-group">
                                            <label for="website">Site Title: </label>
                                            <input type="text" name="site_title" id="website" class="form-control" placeholder="" 
                                            value="<?php if(isset($result->dsa_meta_title)){ echo $result->dsa_meta_title;}?>">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="website">Meta description </label>
                                           <textarea name="site_meta_description" class="form-control" rows="6" name="message" id="metadescription" placeholder="Type your message" 
                                           ><?php if(isset($result->dsa_meta_desc)){ echo $result->dsa_meta_desc;}?></textarea>
                                        </div>
                                        
                                         <div class="form-group">
                                            <label for="website">Meta Keyword </label>
                                           
                                                              <input type="text" name="site_meta_keywords" id="metadata" class="form-control" placeholder="" 
                                                              value="<?php if(isset($result->dsa_meta_keyword)){ echo $result->dsa_meta_keyword;}?>">
                                      
                                        </div>
                                        

                                       
                                  

                                </div>
                                <!-- /tile body -->
                                 <!-- tile footer -->
                                <div class="tile-footer text-right bg-tr-black lter dvd dvd-top">
                                    <!-- SUBMIT BUTTON -->
                                    <button type="submit" class="btn btn-greensea mb-10">Update</button>
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