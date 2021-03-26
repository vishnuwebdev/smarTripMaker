<?php $this->view('simple_layout/header'); ?>
<?php $this->view('simple_layout/leftSidebar'); ?>
<section id="content">
	<div class="page page-forms-validate">
		<div class="pageheader">
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li><a href="<?php echo site_url();?>"><i class="fa fa-home"></i> <?php echo $this->lang->line ( "dashboard" );?></a></li>
					<li><a href="<?php echo site_url($this->uri->segment("1"));?>"></i> <?php echo $this->lang->line ( "setting" );?></a></li>
					<li><a></i> <?php echo $this->lang->line ( "add_location" );?></a></li>
				</ul>
			</div>
		</div>
		<!-- row -->
		<div class="row">
			<!-- col -->
			<div class="col-md-12">
				<!-- tile -->
				<a href="<?php echo site_url().$this->uri->segment("1");?>/location_list" class="btn btn-greensea btn-ef btn-ef-7 btn-ef-7h mb-10 pull-right mr-10"><i class="fa fa-list"></i><?php echo $this->lang->line ( "location_list" );?></a>
				<div class="clearfix"></div>
				<section class="tile bp_shadow">
				    <form class="form-horizontal" role="form" action="" method="post" id="add_new_location" enctype="multipart/form-data">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
					<!-- tile header -->
					<div class="tile-header dvd dvd-btm">
						<h1 class="custom-font">
							<strong><?php echo $this->lang->line ( "add_location" );?> </strong>
						</h1>
					</div>
					<!-- /tile header -->
					<!-- tile body -->
					<div class="tile-body">
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "location" );?>:</label>
								<div class="col-sm-9">
									<div class="input text">
									        <input type="text" name="location" placeholder="" class="form-control">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "country" );?>:</label>
								<div class="col-sm-9">
									<div class="input text">
									        <select name="country" class="form-control">
									        <?php foreach($country as $bp){?>
									      <option value="<?php echo $bp->country_code."___".$bp->country_name;?>"><?php echo $bp->country_name;?></option>
									       <?php }?>
									        </select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "latitude" );?>:</label>
								<div class="col-sm-9">
									<div class="input text">
									        <input type="text" name="latitude" placeholder="" class="form-control">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "longitude" );?>:</label>
								<div class="col-sm-9">
									<div class="input text">
									        <input type="text" name="longitude" placeholder="" class="form-control">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "language" );?>:</label>
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
<?php $this->load->view($this->uri->segment("1")."/js");?>
<?php $this->load->view($this->uri->segment("1")."/data_table_js");?>