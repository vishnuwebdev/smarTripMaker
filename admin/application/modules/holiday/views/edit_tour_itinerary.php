
					<?php
					$bp_active_tab_data ['bp_active_tab'] = "package_itinerary";
					$this->load->view ( "package_tab", $bp_active_tab_data );
					?>
<!-- /tile header -->
<form class="form-horizontal" role="form" action="" method="post" id="">
	<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
	<!-- tile body -->
	<div class="dvd dvd-btm m-10">
		<h1 class="custom-font">
			<strong><?php echo $this->lang->line ( "edit_tour_itinerary" );?></strong>
			
					<a href="<?php echo site_url().$this->uri->segment ( "1" );?>/tour_itinerary/?ref_id=<?php echo url_encode($id); ?>" class="btn btn-greensea btn-ef btn-ef-7 btn-ef-7h pull-right"><i class="fa fa-list"></i> <?php echo $this->lang->line ( "itinerary_list" );?></a>
		</h1>
	</div>
	
					<div class="tile-body">
					        <div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "name" );?>:</label>
								<div class="col-sm-9">
									<div class="input text">
									        <select class="form-control" name="name">
									        <?php for($i=0;$i<=$result->holiday_night;$i++){ ?>
									        <option value="<?php echo $i+1;?>" <?php if($bp_itinerary[0]->holiti_name==$i+1){echo "selected";}?>><?php echo $this->lang->line ( "day" );?> <?php echo $i+1;?></option>
									       <?php } ?> 
									        </select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "title" );?>:</label>
								<div class="col-sm-9">
									<div class="input text">
									        <input type="text" name="title" value="<?php echo $bp_itinerary[0]->holiti_title;?>" placeholder="Itinerary Title" class="form-control">
									</div>
								</div>
							</div>
							
						
		<div class="form-group">
			<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "meal" );?></label>
			<div class="col-sm-9">
			<?php $bp_meal_for_select=explode(",", $bp_itinerary[0]->holiti_meal);
								if(is_array($bp_meal_for_select)){
									foreach($bp_meal_for_select as $bp_meal_for_selects){
										$bp_itinerary_meal_list[$bp_meal_for_selects]=$bp_meal_for_selects;
									}
								}
								?>
			<?php
						if (is_array ( $bp_meal )) {
							foreach ( $bp_meal as $bp_meals ) {
								?>
				<label class="checkbox-inline"> <input type="checkbox" <?php if(isset($bp_itinerary_meal_list[$bp_meals->holmeal_id])){ echo "checked";}?> name="meal[]" value="<?php echo $bp_meals->holmeal_id;?>"> <i class="fa <?php echo $bp_meals->holmeal_icon;?>"> </i> <?php echo $bp_meals->holmeal_meal_name;?> (<?php echo $bp_meals->holmeal_meal_type;?>, <?php echo $bp_meals->holmeal_meal_description;?>, <?php echo $bp_meals->holmeal_language;?>)
				</label><br>
				<?php } }?>
			</div>
		</div>
					
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "remark" );?>:</label>
								<div class="col-sm-9">
									<div class="input text">
									        <input type="text" name="remark" value="<?php echo $bp_itinerary[0]->holiti_remark;?>" placeholder="Remark" class="form-control">
									</div>
								</div>
							</div>
							<hr class="line-dashed line-full"/>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"><?php echo $this->lang->line ( "detail" );?>:</label>
                                            <div class="col-sm-9">
                                                <textarea name="detail"><?php echo $bp_itinerary[0]->holiti_detail;?></textarea>
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
var editor=CKEDITOR.replace( 'detail' ,{height: 300});
</script>
<?php $this->load->view("holiday/js");?>
<script>
$(".bp_package_name").keyup(function(){
	var bp_package_name=$(this).val();
	//var bp_package_slug=bp_package_name.replaceAll(" ","-");
	$(".bp_package_slug").val(bp_package_name);
});
</script>