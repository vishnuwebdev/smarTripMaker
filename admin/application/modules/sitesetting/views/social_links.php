<?php $this->view('simple_layout/header'); ?>
<?php $this->view('simple_layout/leftSidebar'); ?>
<section id="content">
	<div class="page page-forms-validate">
		<div class="pageheader">
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li><a href="<?php echo site_url();?>"><i class="fa fa-home"></i> <?php echo $this->lang->line ( "dashboard" );?></a></li>
					<li><a href="<?php echo site_url($this->uri->segment("1"));?>"></i> <?php echo $this->lang->line ( "setting" );?></a></li>
					<li><a></i> Edit Social Links</a></li>
				</ul>
			</div>
		</div>
		<!-- row -->
		<div class="row">
			<!-- col -->
			<div class="col-md-12">
				<!-- tile -->
				<section class="tile bp_shadow">
				    <form class="form-horizontal" role="form" action="" method="post"  enctype="multipart/form-data">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
					<!-- tile header -->
					<div class="tile-header dvd dvd-btm">
						<h1 class="custom-font">
							<strong>Edit Social Links </strong>
						</h1>
					</div>
					<!-- /tile header -->
					<!-- tile body -->
					<div class="tile-body">
							
							<div class="form-group">
								<label class="col-sm-2 control-label">Facebook :</label>
								<div class="col-sm-9">
									<div class="input text">
									        <input type="text" name="facebook" value="<?php if(isset($result['facebook'])){echo $result['facebook'];}?>" placeholder="" class="form-control">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Twitter :</label>
								<div class="col-sm-9">
									<div class="input text">
									        <input type="text" name="twitter" value="<?php if(isset($result['twitter'])){echo $result['twitter'];}?>" placeholder="" class="form-control">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">YouTube :</label>
								<div class="col-sm-9">
									<div class="input text">
									        <input type="text" name="youtube" value="<?php if(isset($result['youtube'])){echo $result['youtube'];}?>" placeholder="" class="form-control">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Instagram</label>
								<div class="col-sm-9">
									<div class="input text">
									        <input type="text" name="instagram" value="<?php if(isset($result['instagram'])){echo $result['instagram'];}?>" placeholder="" class="form-control">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Linkedin :</label>
								<div class="col-sm-9">
									<div class="input text">
									        <input type="text" name="google" value="<?php if(isset($result['google'])){echo $result['google'];}?>" placeholder="" class="form-control">
									</div>
								</div>
							</div>
							
							
					</div>
					<!-- /tile body -->
					<!-- tile footer -->
					<div class="tile-footer text-right bg-tr-black lter dvd dvd-top">
						<!-- SUBMIT BUTTON -->
								<div class="submit">
									<input type="submit" class="btn btn-success" value=<?php echo $this->lang->line ( "update" );?>>
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