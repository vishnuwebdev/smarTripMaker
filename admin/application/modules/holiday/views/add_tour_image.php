
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
			<strong><?php echo $this->lang->line ( "add_tour_images" );?> </strong>
			
					<a href="<?php echo site_url().$this->uri->segment ( "1" );?>/tour_images/?ref_id=<?php echo url_encode($id); ?>" class="btn btn-greensea btn-ef btn-ef-7 btn-ef-7h pull-right"><i class="fa fa-list"></i> <?php echo $this->lang->line ( "image_list" );?></a>
		</h1>
	</div>
	
					<div class="tile-body">
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "image" );?>:</label>
								<div class="col-sm-9">
									<div class="input text">
									        <input type="file" name="userfile" class="form-control">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "title" );?>:</label>
								<div class="col-sm-9">
									<div class="input text">
									        <input type="text" name="title" value="" placeholder="Image Title" class="form-control">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "alt" );?>:</label>
								<div class="col-sm-9">
									<div class="input text">
									        <input type="text" name="alt" value="" placeholder="Image Alt" class="form-control">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "detail" );?>:</label>
								<div class="col-sm-9">
									<div class="input text">
									        <textarea name="detail" class="form-control"></textarea>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "status" );?>:</label>
								<div class="col-sm-9">
									<div class="input text">
									        <select name="status" class="form-control">
									           <option value="active"><?php echo $this->lang->line ( "active" );?></option>
									           <option value="inactive"><?php echo $this->lang->line ( "inactive" );?></option>
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
									<input type="submit" class="btn btn-success" value="<?php echo $this->lang->line ( "submit" );?>">
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