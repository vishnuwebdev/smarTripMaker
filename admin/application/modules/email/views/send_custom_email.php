<?php $this->view('simple_layout/header'); ?>
<?php $this->view('simple_layout/leftSidebar'); ?>
<link rel="stylesheet" href="<?php echo site_url();?>assets/js/vendor/summernote/summernote.css">
<section id="content">
	<div class="page page-forms-validate">
		<div class="pageheader">
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li><a href="<?php echo site_url();?>"><i class="fa fa-home"></i> <?php echo $this->lang->line ( "dashboard" );?></a></li>
					<li><a href="<?php echo site_url($this->uri->segment("1"));?>"></i> Email</a></li>
					<li><a></i> Email Send</a></li>
				</ul>
			</div>
		</div>
		<!-- row -->
		<div class="row">
			<!-- col -->
			<div class="col-md-12">
				<!-- tile -->
					<a href="<?php echo site_url().$this->uri->segment ( "1" );?>" class="btn btn-greensea btn-ef btn-ef-7 btn-ef-7h mb-10 pull-right"><i class="fa fa-list"></i>Email Report</a>
				<div class="clearfix"></div>
				<section class="tile bp_shadow">
					<!-- tile header -->
					<div class="tile-header dvd dvd-btm">
						<h1 class="custom-font">
							Email Send
						</h1>
					</div>
					<!-- /tile header -->
					<?php $attributes = array('class' => 'form-horizontal','id'=>'add_blog_post'); ?>
					<?php echo form_open_multipart('email/send_custom_email',$attributes); ?>
					<!-- tile body -->
					<div class="tile-body">
					<?php echo form_error('myfield', '<div class="error">', '</div>');?>
					<?php if(validation_errors()!=NULL){?>	
					<div class="alert alert-big alert-lightred alert-dismissable fade in">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <?php echo validation_errors(); ?>
                                    </div>
                                    <?php }?>
					
						
							<hr class="line-dashed line-full"/>

                    <div class="form-group">
								<label class="col-sm-2 control-label">Email Id: </label>
								<div class="col-sm-9">
									<div class="input text">
									<input type="text" name="email_id1" class="form-control">
									</div>
								</div>
							</div>
							
						
							<div class="form-group">
								<label class="col-sm-2 control-label">Subject: </label>
								<div class="col-sm-9">
									<div class="input text">
										<input id="subject" maxlength="50" name="subject" class="form-control"></input>
										</div>
								</div>
							</div>
							
						
							
								<div class="form-group">
								<label class="col-sm-2 control-label">Message: </label>
								<div class="col-sm-9">
									<div class="input text">
									<?php echo form_textarea(array('name'=>'message','class'=>'form-control'),set_value('meta_keyword'));?>
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
	

