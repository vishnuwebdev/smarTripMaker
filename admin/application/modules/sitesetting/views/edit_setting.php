<?php $this->view('simple_layout/header'); ?>
<?php $this->view('simple_layout/leftSidebar'); ?>
<section id="content">
    <div class="page page-forms-validate">
        <div class="pageheader">
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li><a href="<?php echo site_url(); ?>"><i class="fa fa-home"></i> <?php echo $this->lang->line("dashboard"); ?></a></li>
                    <li><a href="<?php echo site_url($this->uri->segment("1")); ?>"></i> <?php echo $this->lang->line("site_management"); ?></a></li>
                    <li><a></i> <?php echo $this->lang->line("edit_setting"); ?></a></li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <section class="tile">
                    <div class="tile-header dvd dvd-btm">
                        <h1 class="custom-font">
                            <strong><?php echo $this->lang->line("edit_setting"); ?></strong>
                        </h1>
                    </div>
                    <!-- /tile header -->
                    <form name="form2" role="form" id="changepass" method="POST" action="">
                        <!-- tile body -->
                        <div class="tile-body">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                            <?php
                            if ($this->session->flashdata('alert') !== NULl) {
                                $bhanu_message = $this->session->flashdata('alert');
                                ?>

                                <div class="alert alert-sm alert-border-left <?php echo $bhanu_message['class']; ?> light alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <i class="fa fa-info pr10"></i> <strong> <?php echo $bhanu_message['message']; ?></strong>
                                </div>

                            <?php } ?>
                            
                            <div class="form-group">
                                <label for="website"><?php echo $this->lang->line("address"); ?> : </label> <input type="text" name="address" id="website" class="form-control" placeholder="" value="<?php echo $result->dsaset_address_1; ?>">
                            </div>
                            <div class="form-group">
                                <label for="website"><?php echo $this->lang->line("city"); ?> : </label> <input type="text" name="city" id="website" class="form-control" placeholder="" value="<?php echo $result->dsaset_city; ?>">
                            </div>
                            <div class="form-group">
                                <label for="website"><?php echo $this->lang->line("state"); ?> : </label> <input type="text" name="state" id="website" class="form-control" placeholder="" value="<?php echo $result->dsaset_state; ?>">
                            </div>
                            <div class="form-group">
                                <label for="website"><?php echo $this->lang->line("country"); ?> : </label> <input type="text" name="country" id="website" class="form-control" placeholder="" value="<?php echo $result->dsaset_country; ?>">
                            </div>
                            <div class="form-group">
                                <label for="website"><?php echo $this->lang->line("pincode"); ?> : </label> <input type="text" name="pincode" id="website" class="form-control" placeholder="" value="<?php echo $result->dsaset_pincode; ?>">
                            </div>
                            <div class="form-group">
                                <label for="website"><?php echo $this->lang->line("meta_title"); ?> : </label> <input type="text" name="meta_title" id="website" class="form-control" placeholder="" value="<?php echo $result->dsaset_meta_title; ?>">
                            </div>
                            <div class="form-group">
                                <label for="website"><?php echo $this->lang->line("meta_description"); ?> : </label> <input type="text" name="meta_description" id="website" class="form-control" placeholder="" value="<?php echo $result->dsaset_meta_desc; ?>">
                            </div>
                            <div class="form-group">
                                <label for="website"><?php echo $this->lang->line("meta_keyword"); ?> : </label> <input type="text" name="meta_keyword" id="website" class="form-control" placeholder="" value="<?php echo $result->dsaset_meta_keyword; ?>">
                            </div>
                             <div class="form-group">
                                <label for="website"><?php echo $this->lang->line("phone"); ?> : </label> <input type="text" name="phone"  class="form-control" placeholder="" value="<?php echo $result->dsaset_phone; ?>">
                            </div>
                             <div class="form-group">
                                <label for="website"><?php echo $this->lang->line("email"); ?> : </label> <input type="text" name="email" class="form-control" placeholder="" value="<?php echo $result->dsaset_email; ?>">
                            </div>
                            <div class="form-group">
                                <label for="website"><?php echo $this->lang->line("news_flash"); ?> : </label> <textarea name="news_flash" id="newsflash" class="form-control" placeholder="" ><?php echo $result->dsaset_news; ?></textarea>
                            </div>
                            
                            <div class="form-group">
                                <label for="website"><?php echo $this->lang->line("sms_signature"); ?> : </label> <textarea name="sms_signature" id="newsflash" class="form-control" placeholder="" ><?php echo $result->dsaset_sms_signature; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="website"><?php echo $this->lang->line("welcome_wallet_balance"); ?> : </label> <input type="text" name="welcome_wallet_balance" class="form-control" placeholder="" value="<?php echo $result->welcome_wallet_balance; ?>">
                            </div>
                            <div class="form-group">
                                <label for="website"><?php echo $this->lang->line("detected_wallet_percentage"); ?> : </label> <input type="text" name="detected_wallet_percentage" class="form-control" placeholder="" value="<?php echo $result->detected_wallet_percentage; ?>">
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
<?php $this->load->view("simple_layout/footer"); ?>
<script src="<?php echo site_url(); ?>assets/vendor/ckeditor/ckeditor.js"></script>	
<script>
     CKEDITOR.replace('header_html1', {height: 300,
         autoParagraph :false,
        allowedContent : true,
        fullPage : false,
    });
   CKEDITOR.replace('footer_html1', {height: 300});
    // CKEDITOR.replace('custom_css', {height: 300});
    CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
    
        config.autoParagraph = false;
        config.allowedContent = true;
        config.fullPage = true;
};

</script>
<?php $this->load->view($this->uri->segment("1") . "/js"); ?>