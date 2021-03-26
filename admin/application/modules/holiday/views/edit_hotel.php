<?php $this->view('simple_layout/header'); ?>
<?php $this->view('simple_layout/leftSidebar'); ?>
<section id="content">
	<div class="page page-forms-validate">
		<div class="pageheader">
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li><a href="<?php echo site_url();?>"><i class="fa fa-home"></i> <?php echo $this->lang->line ( "dashbord" );?></a></li>
					<li><a href="<?php echo site_url($this->uri->segment("1"));?>"></i> <?php echo $this->lang->line ( "holiday" );?></a></li>
					<li><a></i><?php echo $this->lang->line ( "edit_hotel" );?> </a></li>
				</ul>
			</div>
		</div>
		<!-- row -->
		<div class="row">
			<!-- col -->
			<div class="col-md-12">
				<!-- tile -->
				<a href="<?php echo site_url().$this->uri->segment("1");?>/add_hotel" class="btn btn-greensea btn-ef btn-ef-7 btn-ef-7h mb-10 pull-right mr-10"><i class="fa fa-plus"></i> <?php echo $this->lang->line ( "add_new_hotel" );?></a>
				<a href="<?php echo site_url().$this->uri->segment("1");?>/hotel_list" class="btn btn-greensea btn-ef btn-ef-7 btn-ef-7h mb-10 pull-right mr-10"><i class="fa fa-list"></i> <?php echo $this->lang->line ( "hotel_list" );?></a>
				<div class="clearfix"></div>
				<section class="tile bp_shadow">
					<!-- tile header -->
					<div class="tile-header dvd dvd-btm">
						<h1 class="custom-font">
							 <strong><?php echo $this->lang->line ( "edit_hotel" );?> </strong>
						</h1>
					</div>
					<!-- /tile header -->
				
					<form class="form-horizontal" role="form" action="" method="post" id="add_hotel" enctype="multipart/form-data">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
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
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "name" );?>:</label>
								<div class="col-sm-9">
									<div class="input text">
									        <input type="text" name="name" placeholder="Hotel Name" class="form-control" value="<?php echo $result->holhot_name;?>">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "type" );?>:</label>
								<div class="col-sm-9">
									<div class="input text">
									        <select name="type" class="form-control">
									        <option value="">--- Select Hotel Type ---</option>
									        <?php foreach($bp_hotel_extra as $bp){
									        if($bp->hohex_type == "hotel_type" && $bp->hohex_status == "active"){
									        	?>
									      <option value="<?php echo $bp->hohex_id;?>" <?php if($bp->hohex_id==$result->holhot_hotel_type){echo "selected";}?>><?php echo $bp->hohex_name;?> (<?php echo $bp->hohex_language;?>)</option>
									       <?php } }?>
									        </select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "amenity" );?>:</label>
								<div class="col-sm-9">
								<?php $bp_amenity_for_select=explode(",", $result->holhot_hotel_amenity);
								if(is_array($bp_amenity_for_select)){
									foreach($bp_amenity_for_select as $bp_amenity_foreach){
										$bp_hotel_amenity_list[$bp_amenity_foreach]=$bp_amenity_foreach;
									}
								}
								?>
								<?php foreach($bp_hotel_extra as $bp){
									        if($bp->hohex_type == "hotel_amenity" && $bp->hohex_status == "active"){
									        	?>
									     <div class="col-md-3">
									            <label class="checkbox-inline">
                                                    <input type="checkbox" name="amenity[]" <?php if(isset($bp_hotel_amenity_list[$bp->hohex_id])){ echo "checked";}?>  value="<?php echo $bp->hohex_id;?>"> <i class="fa <?php echo $bp->hohex_icon; ?>"> </i>  <?php echo $bp->hohex_name;?> (<?php echo $bp->hohex_language;?>)
                                                </label>
                                                </div>
									       <?php } }?>
									
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "location" );?> </label>
								<div class="col-sm-9">
									<div class="input text">
                                                <input type="text" name="location" class="form-control" value="<?php echo $result->holhot_location;?>">
									</div>
								</div>
							</div>
							<hr class="line-dashed line-full"/>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"><?php echo $this->lang->line ( "short_description" );?>:</label>
                                            <div class="col-sm-9">
                                                <textarea name="short_desc"><?php echo $result->holhot_short_desc;?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"><?php echo $this->lang->line ( "long_description" );?>:</label>
                                            <div class="col-sm-9">
                                                <textarea name="long_desc"><?php echo $result->holhot_long_desc;?></textarea>
                                            </div>
                                        </div>
							
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "feature_image" );?> </label>
								<div class="col-sm-9">
									<div class="input text">
									   <div class="pull-left thumb" style="width:80px;">
                                            <?php if($result->holhot_feture_image!=""){?>
                                                            <img class="media-object thumbscl" src="<?php echo site_url();?>assets/img/holiday/thumbs/<?php echo $result->holhot_feture_image; ?>" alt="<?php echo $result->holhot_name; ?>">
                                                       <?php }else{ ?>
                                                       	     <img class="media-object thumbscl" src="<?php echo site_url();?>assets/images/not_found.png" alt="<?php echo $result->holhot_name; ?>">
                                                      <?php }?>
                                                        </div>
                                                        <br>
										<input class="form-control" type="file" name="userfile" />
										<input class="form-control" type="hidden" name="holhot_feture_image" value="<?php echo $result->holhot_feture_image?>"/>
									</div>
								</div>
							</div>
							 <div class="form-group">
                                            <label class="col-sm-2 control-label"><?php echo $this->lang->line ( "language" );?>:</label>
                                            <div class="col-sm-9">
                                               <select class="form-control" name="language">
										<?php $all_language=$this->all_language;
										?>
										<?php foreach($all_language as $all_languages){ ?> 
										<option value="<?php echo $all_languages;?>" <?php if($result->holhot_language==$all_languages){ echo "selected"; }?>><?php echo $all_languages;?></option>
										<?php }?>
										</select>
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
var editor=CKEDITOR.replace( 'short_desc' ,{height: 150});
var editor=CKEDITOR.replace( 'long_desc' ,{height: 300});
</script>
<?php $this->load->view("holiday/js");?>