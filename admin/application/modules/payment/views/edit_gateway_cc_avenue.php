<?php $this->view('simple_layout/header'); ?>
<?php $this->view('simple_layout/leftSidebar'); ?>
<section id="content">
	<div class="page page-forms-validate">
		<div class="pageheader">
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li><a href="<?php echo site_url();?>"><i class="fa fa-home"></i>
							<?php echo $this->lang->line ( "dashboard" );?></a></li>
					<li><a href="<?php echo site_url($this->uri->segment("1"));?>/payment_setting"></i><?php echo $this->lang->line ( "getway" );?></a></li>
					<li><a></i><?php echo $this->lang->line ( "edit" );?> <?php echo $this->lang->line ( "getway" );?></a></li>
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
							<?php echo $this->lang->line ( "edit" );?>  <strong><?php echo $this->lang->line ( "getway" );?>  </strong>
						</h1>
					</div>
					<!-- /tile header -->
					<?php $attributes = array('class' => 'form-horizontal','id'=>'add_menu'); ?>
					<?php echo form_open_multipart('payment/update_getway',$attributes); ?>
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
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "getway" );?> <?php echo $this->lang->line ( "display" );?> <?php echo $this->lang->line ( "name" );?> </label>
								<div class="col-sm-9">
									<div class="input text">
										<input type="text" name="getway_display_name"
											placeholder="" class="form-control" value="<?php echo $result->dsapayg_display_name; ?>">
									</div>
								</div>
							</div>
							
                               <div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "getway" );?>  <?php echo $this->lang->line ( "user" );?> <?php echo $this->lang->line ( "id" );?>  </label>
								<div class="col-sm-9">
									<div class="input text">
										<input type="text" name="guserid"
											placeholder="" class="form-control" value="<?php echo $result->dsapayg_gateway_user_id; ?>">
									</div>
								</div>
							</div>
                                  

                            <div class="form-group saltkey" >
								<label class="col-sm-2 control-label">Type</label>
								<div class="col-sm-9">
									<div class="input text">
										<select name="gateway_type" class="form-control">
											<option <?php if($result->dsapayg_type == "fix"){ echo "selected"; } ?> value="fix">Fix</option>
											<option <?php if($result->dsapayg_type == "percentage"){ echo "selected"; } ?> value="percentage">Percent</option>
										</select>
									</div>
								</div>
							</div>
                            <div class="form-group saltkey" >
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "convenience_fee" );?>  </label>
								<div class="col-sm-9">
									<div class="input text">
										<input type="text" name="g_convenience_fee"
											placeholder="" class="form-control" value="<?php echo $result->dsapayg_convenience_fee; ?>">
									</div>
								</div>
							</div>
                                             <div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "site_type" );?> </label>
								<div class="col-sm-9">
									<div class="input text">
										<select class="form-control" name="sitetype">
											<option <?php if($result->dsapayg_b2b_b2c == "B2c"){ echo "selected"; } ?> value="B2c">B2C</option>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "getway" );?>  <?php echo $this->lang->line ( "status" );?>  </label>
								<div class="col-sm-9">
									<div class="input text">
										<select class="form-control" name="status">
										<option value="active" <?php if($result->dsapayg_status=="active"){ echo "selected"; } ?>><?php echo $this->lang->line ( "active" );?> </option>
										<option value="inactive" <?php if($result->dsapayg_status=="inactive"){ echo "selected"; } ?>><?php echo $this->lang->line ( "inactive" );?> </option>
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

<script type="text/javascript">
   // function get_getwayfield(getway){
      // if(getway == "payu"){
          // $(".merchantkey").show();
          // $(".saltkey").show();
		  // $(".pauyfield").show();
		  // $(".ftCash").hide();
		  // $(".aamarpay").hide();
			
      // }
	  // else if(getway == "ftCash"){
		// $(".merchantkey").show();
		// $(".saltkey").show();
		// $(".ftCash").show();
		// $(".pauyfield").hide();
		// $(".aamarpay").hide();
		
	// }
	// else if(getway == "aamarpay"){
			// $(".merchantkey").show();
			// $(".saltkey").show();
			// $(".aamarpay").show();
			// $(".ftCash").hide();
			// $(".pauyfield").hide();
			
	// }else if(getway == "traknpay"){
			// $(".merchantkey").show();
			// $(".saltkey").show();
			// $("#saltkey").text('<?php echo $this->lang->line ( "salt" )?>');
			// $("#merchantkey").text('<?php echo $this->lang->line ( "api_key" )?>');
			
	// }else{
		// $(".merchantkey").hide();
		// $(".saltkey").hide();  
		// }


   // }
    </script>