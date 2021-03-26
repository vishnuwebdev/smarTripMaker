<?php $this->view('simple_layout/header'); ?>
<?php $this->view('simple_layout/leftSidebar'); ?>
<section id="content">
	<div class="page page-forms-validate">
		<div class="pageheader">
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li><a href="<?php echo site_url();?>"><i class="fa fa-home"></i>
							<?php echo $this->lang->line ( "dashboard" );?></a></li>
					<li><a href="<?php echo site_url($this->uri->segment("1"));?>"></i><?php echo $this->lang->line ( "bank" );?> <?php echo $this->lang->line ( "detail" );?></a></li>
					<li><a></i><?php echo $this->lang->line ( "add" );?> <?php echo $this->lang->line ( "bank" );?> <?php echo $this->lang->line ( "detail" );?></a></li>
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
							<?php echo $this->lang->line ( "add" );?>  <strong><?php echo $this->lang->line ( "bank" );?> <?php echo $this->lang->line ( "detail" );?>  </strong>
						</h1>
					</div>
					<!-- /tile header -->
					<?php $attributes = array('class' => 'form-horizontal','id'=>'add_bank'); ?>
					<?php echo form_open_multipart('payment/update_bank_detail',$attributes); ?>
                                          <input type="hidden" name="ref_id" value="<?php echo bp_hash(url_decode($this->input->get("ref_id"))); ?>">
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
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "bank" );?>  <?php echo $this->lang->line ( "name" );?> </label>
								<div class="col-sm-9">
									<div class="input text">
									       
									        <?php echo form_error('bank_name', '<div class="error">', '</div>');?>
                                                                           <input type="text" name="bank_name"
											placeholder="" class="form-control" value="<?php echo $result->dsabank_bank_name; ?>">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "bank" );?> <?php echo $this->lang->line ( "account" );?> <?php echo $this->lang->line ( "name" );?> </label>
								<div class="col-sm-9">
									<div class="input text">
										<input type="text" name="bank_account_name"
											placeholder="" class="form-control" value="<?php echo $result->dsabank_account_name; ?>">
									</div>
								</div>
							</div>
							
                                            <div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "account" );?>  <?php echo $this->lang->line ( "number" );?> </label>
								<div class="col-sm-9">
									<div class="input text">
										<input type="text" name="bank_account_number"
											placeholder="" class="form-control" value="<?php echo $result->dsabank_account_number; ?>">
									</div>
								</div>
							</div>
                                             <div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "branch" );?>  <?php echo $this->lang->line ( "name" );?> </label>
								<div class="col-sm-9">
									<div class="input text">
										<input type="text" name="bank_branch_name"
											placeholder="" class="form-control" value="<?php echo $result->dsabank_branch_name; ?>">
									</div>
								</div>
							</div>
                                            
                                            <div class="form-group" style="">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "ifsc" );?>  <?php echo $this->lang->line ( "code" );?> </label>
								<div class="col-sm-9">
									<div class="input text">
										<input type="text" name="bank_ifsc_code"
											placeholder="" class="form-control" value="<?php echo $result->dsabank_ifsc_code; ?>">
									</div>
								</div>
							</div>
                                            
                                          <!-- for payu -->  
                                             <div class="form-group" >
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "swift" );?>  <?php echo $this->lang->line ( "code" );?> </label>
								<div class="col-sm-9">
									<div class="input text">
										<input type="text" name="bank_swift_code"
											placeholder="" class="form-control" value="<?php echo $result->dsabank_swift_code; ?>">
									</div>
								</div>
							</div>
                                            
                                             <div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "menu_site_type" );?> </label>
								<div class="col-sm-9">
									<div class="input text">
										<select class="form-control" name="menusitetype">
										<option value="B2c" <?php if($result->dsabank_b2b_b2c=="B2c"){ echo "selected"; } ?>>B2c</option>
										<option value="B2b" <?php if($result->dsabank_b2b_b2c=="B2b"){ echo "selected"; } ?>>B2b</option>
										
										</select>
									</div>
								</div>
							</div>
                                            
							
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "getway" );?>  <?php echo $this->lang->line ( "status" );?>  </label>
								<div class="col-sm-9">
									<div class="input text">
										<select class="form-control" name="status">
										<option value="active"><?php echo $this->lang->line ( "active" );?> </option>
										<option value="inactive"><?php echo $this->lang->line ( "inactive" );?> </option>
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
