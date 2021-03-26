<?php $this->view('simple_layout/header'); ?>
<?php $this->view('simple_layout/leftSidebar'); ?>
<section id="content">
	<div class="page page-forms-validate">
		<div class="pageheader">
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li><a href="<?php echo site_url();?>"><i class="fa fa-home"></i>
							<?php echo $this->lang->line ( "dashboard" );?></a></li>
					<li><a href="<?php echo site_url($this->uri->segment("1"));?>/menu_list"></i><?php echo $this->lang->line ( "menu" );?></a></li>
					<li><a></i><?php echo $this->lang->line ( "add" );?> <?php echo $this->lang->line ( "menu" );?></a></li>
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
							<?php echo $this->lang->line ( "add" );?>  <strong><?php echo $this->lang->line ( "menu" );?>  </strong>
						</h1>
					</div>
					<!-- /tile header -->
					<?php $attributes = array('class' => 'form-horizontal','id'=>'add_menu'); ?>
					<?php echo form_open_multipart('menu/add_menu',$attributes); ?>
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
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "menu" );?>  <?php echo $this->lang->line ( "name" );?> </label>
								<div class="col-sm-9">
									<div class="input text">
									        <?php echo form_input(array('name'=>'menu_name','class'=>'form-control'),set_value('menu_name'));?>
									        <?php echo form_error('menu_name', '<div class="error">', '</div>');?>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "menu" );?>  <?php echo $this->lang->line ( "slug" );?> </label>
								<div class="col-sm-9">
									<div class="input text">
										<input type="text" name="menu_slug"
											placeholder="" class="form-control" value="<?php echo set_value('menu_slug'); ?>">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "menu" );?>  <?php echo $this->lang->line ( "title" );?>  </label>
								<div class="col-sm-9">
									<div class="input text">
										<input type="text" name="menu_title"
											placeholder="" class="form-control" value="<?php echo set_value('menu_title'); ?>">
									</div>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "menu" );?>  <?php echo $this->lang->line ( "status" );?>  </label>
								<div class="col-sm-9">
									<div class="input text">
										<select class="form-control" name="status">
										<option value="active"><?php echo $this->lang->line ( "active" );?> </option>
										<option value="inactive"><?php echo $this->lang->line ( "inactive" );?> </option>
										</select>
									</div>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "menu" );?>  <?php echo $this->lang->line ( "order" );?>  </label>
								<div class="col-sm-9">
									<div class="input text">
										<input type="text" name="order"
											placeholder="" class="form-control" value="<?php echo set_value('order'); ?>">
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
                                            
                                            <div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "menu_site_type" );?> </label>
								<div class="col-sm-9">
									<div class="input text">
										<select class="form-control" name="menusitetype">
										
										<option value="B2c">B2c</option>
										<option value="B2b">B2b</option>
										</select>
									</div>
								</div>
							</div>
                                            
                                             <div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "menu_type" );?> </label>
								<div class="col-sm-9">
									<div class="input text">
										<select class="form-control" name="menu_type">
										
										<option value="footer_one">Footer 1</option>
										<option value="footer_two">Footer 2</option>
										<option value="footer_three">Footer 3</option>
										
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
<?php $this->load->view("blog/js");?>