<?php $this->view('simple_layout/header'); ?>
<?php $this->view('simple_layout/leftSidebar'); ?>
<section id="content">
	<div class="page page-forms-validate">
		<div class="pageheader">
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li><a href="<?php echo site_url();?>"><i class="fa fa-home"></i> <?php echo $this->lang->line ( "dashboard" );?></a></li>
					<li><a href="<?php echo site_url($this->uri->segment("1"));?>"></i> <?php echo $this->lang->line ( "holiday" );?></a></li>
					<li><a></i> <?php echo $this->lang->line ( "add" );?> <?php echo $this->lang->line ( "hotel" );?></a></li>
				</ul>
			</div>
		</div>
		<!-- row -->
		<div class="row">
			<!-- col -->
			<div class="col-md-12">
				<!-- tile -->
				<a href="<?php echo site_url().$this->uri->segment("1");?>/hotel_list" class="btn btn-greensea btn-ef btn-ef-7 btn-ef-7h mb-10 pull-right mr-10"><i class="fa fa-list"></i> <?php echo $this->lang->line ( "hotel" );?> <?php echo $this->lang->line ( "list" );?></a>
				<div class="clearfix"></div>
				<section class="tile bp_shadow">
					<!-- tile header -->
					<div class="tile-header dvd dvd-btm">
						<h1 class="custom-font">
							<?php echo $this->lang->line ( "add" );?> <strong><?php echo $this->lang->line ( "hotel" );?> </strong>
						</h1>
					</div>
					<!-- /tile header -->
					<?php $attributes = array('class' => 'form-horizontal','id'=>'add_hotel'); ?>
					<?php echo form_open_multipart('',$attributes); ?>
					<!-- tile body -->
					<div class="tile-body">
					<?php echo form_error('myfield', '<div class="error">', '</div>');?>
					<?php if(validation_errors()!=NULL){?>	
					<div class="alert alert-big alert-lightred alert-dismissable fade in">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <?php echo validation_errors(); ?>
                                    </div>
                                    <?php }?>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "hotel" );?> <?php echo $this->lang->line ( "name" );?>:</label>
								<div class="col-sm-9">
									<div class="input text">
									        <input type="text" name="name" placeholder="Hotel Name" class="form-control">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "hotel" );?> <?php echo $this->lang->line ( "status" );?> </label>
								<div class="col-sm-9">
									<div class="input text">
										<select class="form-control" name="status">
										<option value="active"><?php echo $this->lang->line ( "active" );?></option>
										<option value="inactive"><?php echo $this->lang->line ( "inactive" );?></option>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "hotel" );?> <?php echo $this->lang->line ( "type" );?>:</label>
								<div class="col-sm-9">
									<div class="input text">
									        <select name="type" class="form-control">
									        <option value="">--- <?php echo $this->lang->line ( "select" );?> <?php echo $this->lang->line ( "hotel" );?> <?php echo $this->lang->line ( "type" );?> ---</option>
									        <?php foreach($bp_hotel_extra as $bp){
									        if($bp->hohex_type == "hotel_type" && $bp->hohex_status == "active"){
									        	?>
									      <option value="<?php echo $bp->hohex_id;?>"><?php echo $bp->hohex_name;?> (<?php echo $bp->hohex_language;?>)</option>
									       <?php } }?>
									        </select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "hotel" );?><?php echo $this->lang->line ( "amenity" );?></label>
								<div class="col-sm-9">
								<?php foreach($bp_hotel_extra as $bp){
									        if($bp->hohex_type == "hotel_amenity" && $bp->hohex_status == "active"){
									        	?>
									     <div class="col-md-3">
									            <label class="checkbox-inline">
                                                    <input type="checkbox" name="amenity[]" value="<?php echo $bp->hohex_id;?>"> <i class="fa <?php echo $bp->hohex_icon; ?>"> </i>  <?php echo $bp->hohex_name;?> (<?php echo $bp->hohex_language;?>)
                                                </label>
                                                </div>
									       <?php } }?>
									
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "location" );?> </label>
								<div class="col-sm-9">
									<div class="input text">
										<input type="text" name="location" class="form-control">
									</div>
								</div>
							</div>
							<hr class="line-dashed line-full"/>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"><?php echo $this->lang->line ( "hotel" );?> <?php echo $this->lang->line ( "short" );?> <?php echo $this->lang->line ( "description" );?>:</label>
                                            <div class="col-sm-9">
                                                <textarea name="short_desc" id=""></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"><?php echo $this->lang->line ( "hotel" );?> <?php echo $this->lang->line ( "long" );?> <?php echo $this->lang->line ( "description" );?>:</label>
                                            <div class="col-sm-9">
                                                <textarea name="long_desc" id=""></textarea>
                                            </div>
                                        </div>
							
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "hotel" );?> <?php echo $this->lang->line ( "feature" );?> <?php echo $this->lang->line ( "image" );?> </label>
								<div class="col-sm-9">
									<div class="input text">
										<input class="form-control" type="file" name="userfile" />
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "language" );?> </label>
								<div class="col-sm-9">
									<div class="input text">
										<select class="form-control" name="language">
										<?php $all_language=$this->all_language;
										?>
										<?php foreach($all_language as $all_languages){ ?> 
										<option value="<?php echo $all_languages;?>" <?php if($this->dsa_set_language==$all_languages){ echo "selected"; }?>><?php echo $all_languages;?></option>
										<?php }?>
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
									<input type="submit" class="btn btn-success" value=<?php echo $this->lang->line ( "submit" );?>>
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