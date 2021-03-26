<?php $this->view('simple_layout/header'); ?>
<?php $this->view('simple_layout/leftSidebar'); ?>
<link rel="stylesheet" href="<?php echo site_url();?>assets/js/vendor/summernote/summernote.css">
<section id="content">
	<div class="page page-forms-validate">
	<div class="pageheader">
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li><a href="<?php echo site_url();?>"><i class="fa fa-home"></i> <?php echo $this->lang->line ( "dashboard" );?></a></li>
					<li><a href="<?php echo site_url($this->uri->segment("1"));?>"></i> <?php echo $this->lang->line ( "page" );?></a></li>
					<li><a></i> <?php echo $this->lang->line ( "edit" );?></a></li>
				</ul>
			</div>
		</div>
		<!-- row -->
		<div class="row">
			<!-- col -->
			<div class="col-md-12">
				<!-- tile -->
				<a href="<?php echo site_url().$this->uri->segment ( "1" );?>" class="btn btn-greensea btn-ef btn-ef-7 btn-ef-7h mb-10 pull-right"><i class="fa fa-list"></i> <?php echo $this->lang->line ( "all_page_list" );?></a>
				<div class="clearfix"></div>
				<section class="tile bp_shadow">
					<!-- tile header -->
					<div class="tile-header dvd dvd-btm">
						<h1 class="custom-font">
							<?php echo $this->lang->line ( "edit" );?> <strong><?php echo $this->lang->line ( "page" );?>  </strong>
						</h1>
					</div>
					<!-- /tile header -->
					<?php $attributes = array('class' => 'form-horizontal','id'=>'add_blog_post'); ?>
					<?php echo form_open_multipart('pages/edit_page',$attributes); ?>
					<!-- tile body -->
					<div class="tile-body">
					<input type="hidden" name="id" value="<?php echo bp_hash($result->page_id); ?>">
					<?php echo form_error('myfield', '<div class="error">', '</div>');?>
					<?php if(validation_errors()!=NULL){?>	
				<div class="alert alert-big alert-lightred alert-dismissable fade in">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <?php echo validation_errors(); ?>
                                     </div>
                                    <?php }?>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "title" );?>:</label>
								<div class="col-sm-9">
									<div class="input text">
									        <?php echo form_input(array('name'=>'page_title','class'=>'form-control','placeholder'=>'Page title'),$result->page_title);?>
									        <?php echo form_error('page_title', '<div class="error">', '</div>');?>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "slug" );?>:</label>
								<div class="col-sm-9">
									<div class="input text">
										<input type="text" name="page_slug"
											placeholder="Page Slug" class="form-control" value="<?php echo $result->page_slug; ?>">
									</div>
								</div>
							</div>
							<hr class="line-dashed line-full"/>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"><?php echo $this->lang->line ( "description" );?>:</label>
                                            <div class="col-sm-9">
                                                <textarea name="page_detail" id="summernote"><?php echo $result->page_desc;?></textarea>
                                            </div>
                                        </div>
							
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "image" );?> </label>
								<div class="col-sm-9">
									<div class="input text">
                                                                            <input type="hidden" name="page_image"  value="<?php echo $result->page_image; ?>"/>
										<input class="form-control" type="file" name="userfile" />
									</div>
								</div>
								<div class="col-sm-9 col-md-offset-2">
													    <?php if($result->page_image !=""){?>
														<img src="<?php echo site_url();?>assets/img/pages/<?php echo $result->page_image; ?>" class="img-responsive thumbnail mr25" style="width: 100%;">
													     <?php }else{?>
													     <div class="alert alert-sm alert-border-left alert-danger light alert-dismissable bp_incomplete_info_alert">
                               image not uploaded ,Please select a image and upload
                            </div>
													     <?php }?>
													</div>
							</div>
							
							
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "status" );?> </label>
								<div class="col-sm-9">
									<div class="input text">
										<select class="form-control" name="page_status">
										<option value="active" <?php if($result->page_status=="active"){ echo "selected"; }?>><?php echo $this->lang->line ( "active" );?></option>
										<option value="inactive" <?php if($result->page_status=="inactive"){ echo "selected"; }?>><?php echo $this->lang->line ( "inactive" );?></option>
										</select>
									</div>
								</div>
							</div>
								<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "meta_title" );?>:</label>
								<div class="col-sm-9">
									<div class="input text">
										<input type="text" name="meta_title"
											placeholder="Page Slug" class="form-control" value="<?php echo $result->page_meta_title; ?>">
									</div>
								</div>
							</div>
								<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "meta_keyword" );?> </label>
								<div class="col-sm-9">
									<div class="input text">
									<?php echo form_textarea(array('name'=>'meta_keyword','class'=>'form-control'),$result->page_meta_keyword);?>
									</div>
								</div>
							</div>
								<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "meta_description" );?> </label>
								<div class="col-sm-9">
									<div class="input text">
										<textarea class="form-control" name="meta_description"><?php echo $result->page_meta_desc; ?></textarea>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "language" );?> </label>
								<div class="col-sm-9">
									<div class="input text">
										<select class="form-control" name="page_language">
										<?php $all_language=$this->all_language;
										?>
										<?php foreach($all_language as $all_languages){ ?> 
										<option value="<?php echo $all_languages;?>" <?php if($result->page_language==$all_languages){ echo "selected"; }?>><?php echo $all_languages;?></option>
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
									<input type="submit" class="btn btn-success" value="Submit">
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
var editor=CKEDITOR.replace( 'page_detail' ,{height: 300});

</script>
<?php $this->load->view("blog/js");?>