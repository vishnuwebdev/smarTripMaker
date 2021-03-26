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
                                <label for="website"><?php echo $this->lang->line("language"); ?> : </label> <input type="text" readonly class="form-control" placeholder="" value="<?php echo $result->dsaset_language; ?>">
                            </div>
                           
                            <div class="form-group">
                                <label for="website"><?php echo $this->lang->line("meta_description"); ?> : </label> <input type="text" name="meta_description" id="website" class="form-control" placeholder="" value="<?php echo $result->dsaset_meta_desc; ?>">
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
//     CKEDITOR.replace('header_html', {height: 300});
//   CKEDITOR.replace('footer_html', {height: 300});
//     CKEDITOR.replace('contact_us_data', {height: 300});
//    CKEDITOR.editorConfig = function( config )
//{
//	// Define changes to default configuration here. For example:
//	// config.language = 'fr';
//	// config.uiColor = '#AADC6E';
//    
//        config.autoParagraph = false;
//        config.allowedContent = true;
//        config.fullPage = true;
//};

</script>
<?php $this->load->view($this->uri->segment("1") . "/js"); ?>