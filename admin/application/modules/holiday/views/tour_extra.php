
					<?php
						$bp_active_tab_data['bp_active_tab']="package_extra";
						$this->load->view("package_tab",$bp_active_tab_data); 
						?>
					<!-- /tile header -->
					<form class="form-horizontal" role="form" action="" method="post" id="add_package" enctype="multipart/form-data">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
					<!-- tile body -->
					<div class="tile-body">
					<!--
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "contact_detail" );?>:</label>
								<div class="col-sm-9">
								<?php
						if (is_array ( $bp_contact )) {
							foreach ( $bp_contact as $bp_contacts ) {
								?>
									<div>
									        <label class="checkbox-inline"> <input type="radio" name="contact" <?php if($result->holiday_contact == $bp_contacts->holcond_id){echo "checked";}?>  value="<?php echo $bp_contacts->holcond_id;?>">  <?php echo $bp_contacts->holcond_support_name;?> (<b>Name</b> - <?php echo $bp_contacts->holcond_name;?>, <b>Email</b> - <?php echo $bp_contacts->holcond_email;?>, <b>Phone</b> - <?php echo $bp_contacts->holcond_phone;?>) (<?php echo $bp_contacts->holcond_language;?>)
				</label>
									</div>
									
									<?php } }?>
								</div>
							</div>
							-->
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "meta_title" );?>:</label>
								<div class="col-sm-9">
									<div class="input text">
									        <input type="text" name="meta_title" value="<?php echo $result->holiday_meta_title;?>" placeholder="Meta Title" class="form-control">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "meta_keyword" );?>:</label>
								<div class="col-sm-9">
									<div class="input text">
									<textarea class="form-control" name="meta_keyword"><?php echo $result->holiday_meta_keyword;?></textarea>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "meta_description" );?>:</label>
								<div class="col-sm-9">
									<div class="input text">
									   <textarea class="form-control" name="meta_desc"><?php echo $result->holiday_meta_description;?></textarea>
									</div>
								</div>
							</div>
							<hr class="line-dashed line-full"/>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"><?php echo $this->lang->line ( "policy" );?>:</label>
                                            <div class="col-sm-9">
                                                <textarea name="policy"><?php echo $result->holiday_policy;?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"><?php echo $this->lang->line ( "transport" );?>:</label>
                                            <div class="col-sm-9">
                                                <textarea name="transport"><?php echo $result->holiday_transport;?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"><?php echo $this->lang->line ( "additional_information" );?>:</label>
                                            <div class="col-sm-9">
                                                <textarea name="addition_info"><?php echo $result->holiday_additional_info;?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"><?php echo $this->lang->line ( "how_to_book" );?>:</label>
                                            <div class="col-sm-9">
                                                <textarea name="how_to_book"><?php echo $result->holiday_how_to_book;?></textarea>
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
var editor=CKEDITOR.replace( 'policy' ,{height: 300});
var editor=CKEDITOR.replace( 'transport' ,{height: 300});
var editor=CKEDITOR.replace( 'addition_info' ,{height: 300});
var editor=CKEDITOR.replace( 'how_to_book' ,{height: 300});
</script>
<?php $this->load->view("holiday/js");?>
<script>
$(".bp_package_name").keyup(function(){
	var bp_package_name=$(this).val();
	//var bp_package_slug=bp_package_name.replaceAll(" ","-");
	$(".bp_package_slug").val(bp_package_name);
});
</script>