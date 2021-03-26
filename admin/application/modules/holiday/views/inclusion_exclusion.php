
					<?php
					$bp_active_tab_data ['bp_active_tab'] = "inclusion_exclusion";
					$this->load->view ( "package_tab", $bp_active_tab_data );
					?>
<!-- /tile header -->
<form class="form-horizontal" role="form" action="" method="post" id="">
	<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
	<!-- tile body -->
	<div class="tile-header dvd dvd-btm">
		<h1 class="custom-font">
			<strong><?php echo $this->lang->line ( "inclusion" );?> </strong>
		</h1>
	</div>
	<div class="tile-body">
	<?php $bp_inclusion_for_select=explode(",", $result->holiday_inclusion);
								if(is_array($bp_inclusion_for_select)){
									foreach($bp_inclusion_for_select as $bp_inclusion_foreach){
										$bp_package_inclusion_list[$bp_inclusion_foreach]=$bp_inclusion_foreach;
									}
								}
								?>
						<?php
						if (is_array ( $bp_inclusion )) {
							foreach ( $bp_inclusion as $bp_inclusions ) {
								?>
	
		<div class="form-group">
			<label class="col-sm-1 control-label"></label>
			<div class="col-sm-10">
				<label class="checkbox-inline"> <input type="checkbox" <?php if(isset($bp_package_inclusion_list[$bp_inclusions->holinc_id])){ echo "checked";}?> name="inclusion[]" value="<?php echo $bp_inclusions->holinc_id;?>"> <i class="fa <?php echo $bp_inclusions->holinc_icon;?>"> </i> <?php echo $bp_inclusions->holinc_name;?> (<?php echo $bp_inclusions->holinc_detail;?>), <?php echo $bp_inclusions->holinc_language;?>
				</label>
			</div>
		</div>
					<?php } }?>
	</div>
	<hr>
	<div class="tile-header dvd dvd-btm">
		<h1 class="custom-font">
			<strong><?php echo $this->lang->line ( "exclusion" );?> </strong>
		</h1>
	</div>
	<div class="tile-body">
	<?php $bp_exclusion_for_select=explode(",", $result->holiday_exclusion);
								if(is_array($bp_exclusion_for_select)){
									foreach($bp_exclusion_for_select as $bp_exclusion_foreach){
										$bp_package_exclusion_list[$bp_exclusion_foreach]=$bp_exclusion_foreach;
									}
								}
								?>
						<?php
						if (is_array ( $bp_exclusion )) {
							foreach ( $bp_exclusion as $bp_exclusions ) {
								?>
		<div class="form-group">
			<label class="col-sm-1 control-label"></label>
			<div class="col-sm-10">
				<label class="checkbox-inline"> <input type="checkbox" name="exclusion[]" <?php if(isset($bp_package_exclusion_list[$bp_exclusions->holexc_id])){ echo "checked";}?> value="<?php echo $bp_exclusions->holexc_id;?>"> <i class="fa <?php echo $bp_exclusions->holexc_icon;?>"> </i> <?php echo $bp_exclusions->holexc_name;?> (<?php echo $bp_exclusions->holexc_detail;?>), <?php echo $bp_exclusions->holexc_language;?>
				</label>
			</div>
		</div>
					<?php } }?>
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
var editor=CKEDITOR.replace( 'short_desc' ,{height: 150});
var editor=CKEDITOR.replace( 'long_desc' ,{height: 300});
</script>
<?php $this->load->view("holiday/js");?>
<script>
$(".bp_package_name").keyup(function(){
	var bp_package_name=$(this).val();
	//var bp_package_slug=bp_package_name.replaceAll(" ","-");
	$(".bp_package_slug").val(bp_package_name);
});
</script>