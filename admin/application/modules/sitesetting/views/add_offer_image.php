
<?php $this->view('simple_layout/header'); ?>
<?php $this->view('simple_layout/leftSidebar'); ?>					
<!-- /tile header -->

<form class="form-horizontal" role="form" action="" method="post" id="" enctype="multipart/form-data">
	<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
	<!-- tile body -->
        <section id="content">
    <div class="page page-forms-validate">
        <div class="pageheader">
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li><a href="<?php echo site_url(); ?>"><i class="fa fa-home"></i>
                            <?php echo $this->lang->line("dashboard"); ?></a></li>
                    <li><a href="<?php echo site_url($this->uri->segment("1")); ?>"></i>Add Offer Images</a></li>
                </ul>
            </div>
        </div>
          <div class="row">
            <!-- col -->
            <div class="col-md-12">
              
                    <!-- tile header -->
               
	<div class="tile-header dvd dvd-btm">
		<h1 class="custom-font">
			<strong>Add Offer Images </strong>
			
					<a href="<?php echo site_url() ?>sitesetting/offer_images" class="btn btn-greensea btn-ef btn-ef-7 btn-ef-7h pull-right"><i class="fa fa-list"></i> Images List</a>
		</h1>
	</div>
	<section class="tile bp_shadow">
					<div class="tile-body">
							<div class="form-group">
								<label class="col-sm-2 control-label">Image:</label>
								<div class="col-sm-9">
									<div class="input text">
									        <input type="file" name="userfile" class="form-control">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Title:</label>
								<div class="col-sm-9">
									<div class="input text">
									        <input type="text" name="title" value="" placeholder="Image Title" class="form-control">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Url:</label>
								<div class="col-sm-9">
									<div class="input text">
									        <input type="text" name="url" value="" placeholder="Image Url" class="form-control">
									</div>
								</div>
							</div>
							
							
							
					</div>
					<!-- /tile body -->
					<!-- tile footer -->
					<div class="tile-footer text-right bg-tr-black lter dvd dvd-top">
						<!-- SUBMIT BUTTON -->
								<div class="submit">
									<input type="submit" class="btn btn-success" value="Update">
								</div>
					</div>
					<!-- /tile footer -->
					</form>
				</section>
				<!-- /tile -->
			</div>
			<!-- /col -->
		</div>
		<!-- /row -->
	</div>
</section>
<!--/ CONTENT -->

<?php $this->load->view("simple_layout/footer");?>
 
  <script src="<?php echo site_url();?>assets/vendor/ckeditor/ckeditor.js"></script>	
<script>
var editor=CKEDITOR.replace( 'detaila' ,{height: 300});
</script>
<?php $this->load->view("holiday/js");?>
<script>
$(".bp_package_name").keyup(function(){
	var bp_package_name=$(this).val();
	//var bp_package_slug=bp_package_name.replaceAll(" ","-");
	$(".bp_package_slug").val(bp_package_name);
});
</script>