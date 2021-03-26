<?php $this->view('simple_layout/header'); ?>
<?php $this->view('simple_layout/leftSidebar'); ?>
<section id="content">
	<div class="page page-forms-validate">
		<div class="pageheader">
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li><a href="<?php echo site_url();?>"><i class="fa fa-home"></i>
							<?php echo $this->lang->line ( "dashboard" );?></a></li>
					<li><a href="<?php echo site_url($this->uri->segment("1"));?>/blog_category_list"></i><?php echo $this->lang->line ( "blog" );?></a></li>
					<li><a></i> <?php echo $this->lang->line ( "edit" );?> <?php echo $this->lang->line ( "blog" );?> <?php echo $this->lang->line ( "category" );?> </a></li>
				</ul>
			</div>
		</div>
		<!-- row -->
		<div class="row">
			<!-- col -->
			<div class="col-md-12">
				<!-- tile -->
				<section class="tile bp_shadow">
					<!-- tile header -->
					<div class="tile-header dvd dvd-btm">
						<h1 class="custom-font">
							<?php echo $this->lang->line ( "edti" );?> <strong><?php echo $this->lang->line ( "blog" );?> <?php echo $this->lang->line ( "category" );?> </strong>
						</h1>
					</div>
					<!-- /tile header -->
					<?php $attributes = array('class' => 'form-horizontal','id'=>'add_blog_category'); ?>
					<?php echo form_open_multipart('blog/edit_category_detail',$attributes); ?>
					<!-- tile body -->
					<div class="tile-body">
					<input type="hidden" name="id" value="<?php echo url_encode($result->bc_id); ?>">
					<?php echo form_error('myfield', '<div class="error">', '</div>');?>
					<?php if(validation_errors()!=NULL){?>	
					<div class="alert alert-big alert-lightred alert-dismissable fade in">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <?php echo validation_errors(); ?>
                                    </div>
                                    <?php }?>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "category" );?> <?php echo $this->lang->line ( "name" );?></label>
								<div class="col-sm-9">
									<div class="input text">
									        <?php echo form_input(array('name'=>'category_name','class'=>'form-control','placeholder'=>'Category Name'),$result->bc_name);?>
									        <?php echo form_error('category_name', '<div class="error">', '</div>');?>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "category" );?> <?php echo $this->lang->line ( "slug" );?></label>
								<div class="col-sm-9">
									<div class="input text">
										<input type="text" name="slug"
											placeholder="Category Slug" class="form-control" value="<?php echo $result->bc_slug; ?>">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "category" );?> <?php echo $this->lang->line ( "tags" );?> </label>
								<div class="col-sm-9">
									<div class="input text">
										<input type="text" name="tag"
											placeholder="Category tag" class="form-control" value="<?php echo $result->bc_tags; ?>">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "category" );?> <?php echo $this->lang->line ( "image" );?> </label>
								<div class="col-sm-9">
									<div class="input text">
										<input class="form-control" type="file" name="userfile" />
									</div>
								</div>
								<div class="col-sm-9 col-md-offset-2">
													    <?php if($result->bc_image !=""){?>
														<img src="<?php echo site_url();?>assets/img/blog/<?php echo $result->bc_image; ?>" class="img-responsive thumbnail mr25" style="width: 100%;">
													     <?php }else{?>
													     <div class="alert alert-sm alert-border-left alert-danger light alert-dismissable bp_incomplete_info_alert">
                               image not uploaded ,Please select a image and upload
                            </div>
													     <?php }?>
													</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "category" );?> <?php echo $this->lang->line ( "status" );?> </label>
								<div class="col-sm-9">
									<div class="input text">
										<select class="form-control" name="status">
										<option value="active" <?php if($result->bc_status=="active"){ echo "selected"; } ?>><?php echo $this->lang->line ( "active" );?></option>
										<option value="inactive" <?php if($result->bc_status=="inactive"){ echo "selected"; } ?>><?php echo $this->lang->line ( "inactive" );?></option>
										</select>
									</div>
								</div>
							</div>
								<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "meta_title" );?></label>
								<div class="col-sm-9">
									<div class="input text">
										<input type="text" name="meta_title"
											placeholder="Category Meta Title" class="form-control" value="<?php echo $result->bc_meta_title; ?>">
									</div>
								</div>
							</div>
								<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "meta_keyword" );?> </label>
								<div class="col-sm-9">
									<div class="input text">
									<?php echo form_textarea(array('name'=>'meta_keyword','class'=>'form-control'),$result->bc_keyword);?>
									</div>
								</div>
							</div>
								<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "meta_description" );?> </label>
								<div class="col-sm-9">
									<div class="input text">
										<textarea class="form-control" name="meta_description"><?php echo $result->bc_meta_description; ?></textarea>
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
										<option value="<?php echo $all_languages;?>" <?php if($result->bc_language==$all_languages){ echo "selected"; }?>><?php echo $all_languages;?></option>
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
									<input type="submit" class="btn btn-success" value="<?php echo $this->lang->line ( "change" );?>">
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
<?php $this->load->view("blog/js");?>