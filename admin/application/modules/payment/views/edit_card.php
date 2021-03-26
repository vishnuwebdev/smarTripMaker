<?php $this->view('simple_layout/header'); ?>
<?php $this->view('simple_layout/leftSidebar'); ?>
<section id="content">
	<div class="page page-forms-validate">
		<div class="pageheader">
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li><a href="<?php echo site_url();?>"><i class="fa fa-home"></i>
							<?php echo $this->lang->line ( "dashboard" );?></a></li>
					<li><a href="<?php echo site_url($this->uri->segment("1"));?>"></i><?php echo $this->lang->line ( "card" );?></a></li>
					<li><a></i><?php echo $this->lang->line ( "edit" );?> <?php echo $this->lang->line ( "card" );?></a></li>
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
							<?php echo $this->lang->line ( "edit" );?>  <strong><?php echo $this->lang->line ( "card" );?>  </strong>
						</h1>
					</div>
					<!-- /tile header -->
					<?php $attributes = array('class' => 'form-horizontal','id'=>'edit_card'); ?>
					<?php echo form_open_multipart('payment/update_card',$attributes); ?>
                                        <input type="hidden" name="id" value="<?php echo url_encode($result->crecard_id); ?>">
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
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "first" );?>  <?php echo $this->lang->line ( "name" );?> </label>
								<div class="col-sm-9">
									<div class="input text">
									        <?php echo form_input(array('name'=>'first_name','class'=>'form-control'),$result->crecard_first_name);?>
									        <?php echo form_error('first_name', '<div class="error">', '</div>');?>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "card" );?>  <?php echo $this->lang->line ( "last" );?><?php echo $this->lang->line ( "name" );?> </label>
								<div class="col-sm-9">
									<div class="input text">
										<input type="text" name="last_name"
											placeholder="" class="form-control" value="<?php echo $result->crecard_last_name; ?>">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "card" );?>  <?php echo $this->lang->line ( "name" );?>  </label>
								<div class="col-sm-9">
									<div class="input text">
										<input type="text" name="card_name"
											placeholder="" class="form-control" value="<?php echo $result->crecard_card_name; ?>">
									</div>
								</div>
							</div>
                                            
                                            <div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "card" );?>  <?php echo $this->lang->line ( "type" );?>  </label>
								<div class="col-sm-9">
									<div class="input text">
										<input type="text" name="card_type"
											placeholder="" class="form-control" value="<?php echo $result->crecard_card_type; ?>">
									</div>
								</div>
							</div>
                                            <div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "card" );?>  <?php echo $this->lang->line ( "expiry" );?>  </label>
								<div class="col-sm-9">
									<div class="input text">
										<input type="text" name="card_expiry"
											placeholder="" class="form-control" value="<?php echo $result->crecard_expiry; ?>">
									</div>
								</div>
							</div>
                                             <div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "card" );?>  <?php echo $this->lang->line ( "cvv_number" );?>  </label>
								<div class="col-sm-9">
									<div class="input text">
										<input type="text" name="card_cvv"
											placeholder="" class="form-control" value="<?php echo $result->crecard_cvv; ?>">
									</div>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "card" );?> Approved  <?php echo $this->lang->line ( "status" );?>  </label>
								<div class="col-sm-9">
									<div class="input text">
										<select class="form-control" name="app_status">
										<option value="pending" <?php if($result->crecard_approve=="pending"){ echo "selected"; } ?>><?php echo $this->lang->line ( "pending" );?> </option>
										<option value="approved" <?php if($result->crecard_approve=="approved"){ echo "selected"; } ?>><?php echo $this->lang->line ( "approved" );?> </option>
										
                                                                                </select>
									</div>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "card" );?>  <?php echo $this->lang->line ( "number" );?>  </label>
								<div class="col-sm-9">
									<div class="input text">
										<input type="text" name="card_number"
											placeholder="" class="form-control" value="<?php echo $result->crecard_card_number; ?>">
									</div>
								</div>
							</div>
                                            <div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "card" );?>  <?php echo $this->lang->line ( "status" );?>  </label>
								<div class="col-sm-9">
									<div class="input text">
										<select class="form-control" name="card_status">
										<option value="active" <?php if($result->crecard_status=="active"){ echo "selected"; } ?>><?php echo $this->lang->line ( "active" );?> </option>
										<option value="inactive" <?php if($result->crecard_status=="inactive"){ echo "selected"; } ?>><?php echo $this->lang->line ( "inactive" );?> </option>
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
									<input type="submit" class="btn btn-success" value="<?php echo $this->lang->line ( "update" );?> ">
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