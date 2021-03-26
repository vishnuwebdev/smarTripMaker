
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
                    <li><a href="<?php echo site_url($this->uri->segment("1")); ?>"></i>Edit Slider Image</a></li>
                </ul>
            </div>
        </div>
          <div class="row">
            <!-- col -->
            <div class="col-md-12">
              
                    <!-- tile header -->
               
	<div class="tile-header dvd dvd-btm">
		<h1 class="custom-font">
			<strong>Edit Slider Image </strong>
			
					<a href="<?php echo site_url() ?>sitesetting/slider_images" class="btn btn-greensea btn-ef btn-ef-7 btn-ef-7h pull-right"><i class="fa fa-list"></i> Images List</a>
		</h1>
	</div>
	<section class="tile bp_shadow">
					<div class="tile-body">
							<div class="form-group">
								<label class="col-sm-2 control-label">Image:</label>
								<div class="col-sm-9">
									<div class="input text">
									        <input type="file" name="userfile" class="form-control">
									        <input type="hidden" name="image" value="<?php echo $bp_image[0]->sliimg_image;?>">
									        <div class="pull-left thumb" style="width: 80px;">
                                            <?php if($bp_image[0]->sliimg_image!=""){?>
                                                            <img class="media-object thumbscl" src="<?php echo site_url();?>assets/img/slider/thumbs/<?php echo $bp_image[0]->sliimg_image; ?>" alt="<?php echo $bp_image[0]->sliimg_alt; ?>">
                                                       <?php }else{ ?>
                                                       	     <img class="media-object thumbscl" src="<?php echo site_url();?>assets/images/not_found.png" alt="<?php echo $bp_image[0]->sliimg_alt; ?>">
                                                      <?php }?>
                                                        </div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Title:</label>
								<div class="col-sm-9">
									<div class="input text">
									        <input type="text" name="title" value="<?php echo $bp_image[0]->sliimg_title?>" placeholder="Image Title" class="form-control">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Alt:</label>
								<div class="col-sm-9">
									<div class="input text">
									        <input type="text" name="alt" value="<?php echo $bp_image[0]->sliimg_alt?>" placeholder="Image Alt" class="form-control">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Detail:</label>
								<div class="col-sm-9">
									<div class="input text">
									        <textarea name="detail" class="form-control"><?php echo $bp_image[0]->sliimg_detail?></textarea>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Status:</label>
								<div class="col-sm-9">
									<div class="input text">
									        <select name="status" class="form-control">
									           <option value="active" <?php if($bp_image[0]->sliimg_status=="active"){echo "selected";}?>>Active</option>
									           <option value="inactive" <?php if($bp_image[0]->sliimg_status=="inactive"){echo "selected";}?>>Inactive</option>
									        </select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Module:</label>
								<div class="col-sm-9">
									<div class="input text">
									        <select name="module" class="form-control">
									           <option <?php if($bp_image[0]->sliimg_slider_module=="b2c"){echo "selected";}?> value="b2c">B2C</option>
									        </select>
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