<?php $this->view('simple_layout/header'); ?>
<?php $this->view('simple_layout/leftSidebar'); ?>
<link rel="stylesheet" href="<?php echo site_url();?>assets/js/vendor/summernote/summernote.css">
<section id="content">
	<div class="page page-forms-validate">
		<div class="pageheader">
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li><a href="<?php echo site_url();?>"><i class="fa fa-home"></i>
							<?php echo $this->lang->line ( "dashboard" );?></a></li>
					<li><a href="<?php echo site_url($this->uri->segment("1"));?>/blog_list"></i><?php echo $this->lang->line ( "blog" );?></a></li>
					<li><a></i> <?php echo $this->lang->line ( "add" );?> <?php echo $this->lang->line ( "blog" );?>  </a></li>
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
							<?php echo $this->lang->line ( "add" );?> <strong><?php echo $this->lang->line ( "blog" );?> </strong>
						</h1>
					</div>
					<!-- /tile header -->
					<?php $attributes = array('class' => 'form-horizontal','id'=>'add_blog_post'); ?>
					<?php echo form_open_multipart('blog/add_blog_post',$attributes); ?>
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
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "title" );?>:</label>
								<div class="col-sm-9">
									<div class="input text">
									        <?php echo form_input(array('name'=>'blog_title','class'=>'form-control','placeholder'=>'Blog title'),set_value('blog_title'));?>
									        <?php echo form_error('category_name', '<div class="error">', '</div>');?>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "slug" );?> :</label>
								<div class="col-sm-9">
									<div class="input text">
										<input type="text" name="blog_link"
											placeholder="Blog Link" class="form-control" value="<?php echo set_value('blog_link'); ?>">
									</div>
								</div>
							</div>
							<hr class="line-dashed line-full"/>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"><?php echo $this->lang->line ( "description" );?>:</label>
                                            <div class="col-sm-9">
                                                <textarea name="blog_detail" id=""></textarea>
                                            </div>
                                        </div>
							
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "image" );?> </label>
								<div class="col-sm-9">
									<div class="input text">
										<input class="form-control" type="file" name="userfile" />
									</div>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "category" );?> </label>
								<div class="col-sm-9">
									<div class="input text">
										<select class="form-control" name="blog_category">
										<option value="">-----<?php echo $this->lang->line ( "select" );?> <?php echo $this->lang->line ( "category" );?>-----</option>
										<?php foreach ($categories as $categories1) {  ?>
										<option value="<?php echo $categories1->bc_id; ?>"><?php echo $categories1->bc_name; ?> (<?php echo $categories1->bc_language; ?>)</option>
										<?php } ?>
										
										</select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "status" );?> </label>
								<div class="col-sm-9">
									<div class="input text">
										<select class="form-control" name="blog_status">
										<option value="active"><?php echo $this->lang->line ( "active" );?></option>
										<option value="inactive"><?php echo $this->lang->line ( "inactive" );?></option>
										</select>
									</div>
								</div>
							</div>
								<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "meta_title" );?> </label>
								<div class="col-sm-9">
									<div class="input text">
										<input type="text" name="meta_title"
											placeholder="Category Meta Title" class="form-control" value="<?php echo set_value('meta_title'); ?>">
									</div>
								</div>
							</div>
								<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "meta_keyeord" );?></label>
								<div class="col-sm-9">
									<div class="input text">
									<?php echo form_textarea(array('name'=>'meta_keyword','class'=>'form-control'),set_value('meta_keyword'));?>
									</div>
								</div>
							</div>
								<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "meta_description" );?> </label>
								<div class="col-sm-9">
									<div class="input text">
										<textarea class="form-control" name="meta_description"><?php echo set_value('"meta_description"'); ?></textarea>
									</div>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "updated_by" );?>: </label>
								<div class="col-sm-9">
									<div class="input text">
										<textarea class="form-control" name="updated_by"><?php echo set_value('"meta_description"'); ?></textarea>
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
									<input type="submit" class="btn btn-success" value="<?php echo $this->lang->line ( "submit" );?> ">
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
var editor=CKEDITOR.replace( 'blog_detail' ,{height: 300});

</script>
<?php $this->load->view("blog/js");?>