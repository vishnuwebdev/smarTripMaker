
					<?php
					$bp_active_tab_data ['bp_active_tab'] = "tour_image";
					$this->load->view ( "package_tab", $bp_active_tab_data );
					?>
<!-- /tile header -->
<form class="form-horizontal" role="form" action="" method="post" id="" enctype="multipart/form-data">
	<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
	<!-- tile body -->
	<div class="dvd dvd-btm m-10">
		<h1 class="custom-font">
			<strong><?php echo $this->lang->line ( "edit_tour_image" );?></strong>
			
					<a href="<?php echo site_url().$this->uri->segment ( "1" );?>/tour_images/?ref_id=<?php echo url_encode($id); ?>" class="btn btn-greensea btn-ef btn-ef-7 btn-ef-7h pull-right"><i class="fa fa-list"></i> <?php echo $this->lang->line ( "image_list" );?></a>
		</h1>
	</div>
	
					<div class="tile-body">
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "image" );?>:</label>
								<div class="col-sm-9">
									<div class="input text">
									        <input type="file" name="userfile" class="form-control">
									        <input type="hidden" name="image" value="<?php echo $bp_image[0]->holimg_image;?>">
									        <div class="pull-left thumb" style="width: 80px;">
                                            <?php if($bp_image[0]->holimg_image!=""){?>
                                                            <img class="media-object thumbscl" src="<?php echo site_url();?>assets/img/holiday/thumbs/<?php echo $bp_image[0]->holimg_image; ?>" alt="<?php echo $bp_image[0]->holimg_alt; ?>">
                                                       <?php }else{ ?>
                                                       	     <img class="media-object thumbscl" src="<?php echo site_url();?>assets/images/not_found.png" alt="<?php echo $bp_image[0]->holimg_alt; ?>">
                                                      <?php }?>
                                                        </div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "title" );?>:</label>
								<div class="col-sm-9">
									<div class="input text">
									        <input type="text" name="title" value="<?php echo $bp_image[0]->holimg_title?>" placeholder="Image Title" class="form-control">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "alt" );?>:</label>
								<div class="col-sm-9">
									<div class="input text">
									        <input type="text" name="alt" value="<?php echo $bp_image[0]->holimg_alt?>" placeholder="Image Alt" class="form-control">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "detail" );?>:</label>
								<div class="col-sm-9">
									<div class="input text">
									        <textarea name="detail" class="form-control"><?php echo $bp_image[0]->holimg_detail?></textarea>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "status" );?>:</label>
								<div class="col-sm-9">
									<div class="input text">
									        <select name="status" class="form-control">
									           <option value="active" <?php if($bp_image[0]->holimg_status=="active"){echo "selected";}?>><?php echo $this->lang->line ( "active" );?></option>
									           <option value="inactive" <?php if($bp_image[0]->holimg_status=="inactive"){echo "selected";}?>><?php echo $this->lang->line ( "inactive" );?></option>
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
									<input type="submit" class="btn btn-success" value="<?php echo $this->lang->line ( "update" );?>">
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