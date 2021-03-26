<?php $this->view('simple_layout/header'); ?>
<?php $this->view('simple_layout/leftSidebar'); ?>
<section id="content">
	<div class="page page-forms-validate">
		<div class="pageheader">
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li><a href="<?php echo site_url();?>"><i class="fa fa-home"></i> <?php echo $this->lang->line ( "dashbord" );?></a></li>
					<li><a href="<?php echo site_url($this->uri->segment("1"));?>"></i> <?php echo $this->lang->line ( "holiday" );?></a></li>
					<li><a></i><?php echo $this->lang->line ( "edit_payment_mode" );?> </a></li>
				</ul>
			</div>
		</div>
		<!-- row -->
		<div class="row">
			<!-- col -->
			<div class="col-md-12">
				<!-- tile -->
				<a href="<?php echo site_url().$this->uri->segment ( '1' ) ;?>/add_payment_mode" class="btn btn-greensea btn-ef btn-ef-7 btn-ef-7h mb-10 pull-right mr-10"><i class="fa fa-plus"></i> <?php echo $this->lang->line ( "add_payment_mode" );?></a>
				<a href="<?php echo site_url().$this->uri->segment ( '1' ) ;?>/payment_mode" class="btn btn-greensea btn-ef btn-ef-7 btn-ef-7h mb-10 pull-right mr-10"><i class="fa fa-list"></i> <?php echo $this->lang->line ( "payment_mode_list" );?></a>
				<div class="clearfix"></div>
				<section class="tile bp_shadow">
					<!-- tile header -->
					<div class="tile-header dvd dvd-btm">
						<h1 class="custom-font">
							 <strong> <?php echo $this->lang->line ( "edit_payment_mode" );?> </strong>
						</h1>
					</div>
					<!-- /tile header -->
					<form class="form-horizontal" role="form" action="" method="post" id="add_payment_mode" enctype="multipart/form-data">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
						<div class="panel panel-info">
							<div class="panel-heading">
								<div class="panel-title hidden-xs"><?php echo $this->lang->line ( "payment_mode" );?> </div>
							</div>
							<div class="panel-body pn">
								<br>
								<table class="table table-bordered bp_table_td">
									<tbody>
										<tr>
											<td class="warning"><?php echo $this->lang->line ( "name" );?>*</td>
											<td><input type="text" name="name" class="form-control" placeholder="Enter Hotel Type" value="<?php echo $result->holpaym_name;?>"></td>
											<td class="warning"><?php echo $this->lang->line ( "status" );?></td>
											<td><select class="form-control" name="status">
													<option value="active" <?php if($result->holpaym_status == "active"){echo "selected";}?>><?php echo $this->lang->line ( "active" );?></option>
													<option value="inactive" <?php if($result->holpaym_status == "inactive"){echo "selected";}?>><?php echo $this->lang->line ( "inactive" );?></option>
											</select></td>
										</tr>
										<tr>
											<td class="warning"><?php echo $this->lang->line ( "mode_of_payment" );?></td>
											<td><select class="form-control" name="mode">
													<option value="offline" <?php if($result->holpaym_mode == "offline"){echo "selected";}?>><?php echo $this->lang->line ( "offline" );?></option>
													<option value="online" <?php if($result->holpaym_mode	== "online"){echo "selected";}?>><?php echo $this->lang->line ( "online" );?></option>
											</select></td>
											<td class="warning"><?php echo $this->lang->line ( "payment" );?></td>
											<td><select class="form-control" name="amount">
											        <option value="0" <?php if($result->holpaym_amount == "0"){echo "selected";}?>>0 %</option>
													<option value="10" <?php if($result->holpaym_amount == "10"){echo "selected";}?>>10 %</option>
													<option value="20" <?php if($result->holpaym_amount == "20"){echo "selected";}?>>20 %</option>
													<option value="25" <?php if($result->holpaym_amount == "25"){echo "selected";}?>>25 %</option>
													<option value="30" <?php if($result->holpaym_amount == "30"){echo "selected";}?>>30 %</option>
													<option value="40" <?php if($result->holpaym_amount == "40"){echo "selected";}?>>40 %</option>
													<option value="50" <?php if($result->holpaym_amount == "50"){echo "selected";}?>>50 %</option>
													<option value="60" <?php if($result->holpaym_amount == "60"){echo "selected";}?>>60 %</option>
													<option value="70" <?php if($result->holpaym_amount == "70"){echo "selected";}?>>70 %</option>
													<option value="75" <?php if($result->holpaym_amount == "75"){echo "selected";}?>>75 %</option>
													<option value="80" <?php if($result->holpaym_amount == "80"){echo "selected";}?>>80 %</option>
													<option value="90" <?php if($result->holpaym_amount == "90"){echo "selected";}?>>90 %</option>
													<option value="100" <?php if($result->holpaym_amount == "100"){echo "selected";}?>>100 %</option>
											</select></td>
										</tr>
											<tr>
											<td class="warning"><?php echo $this->lang->line ( "language" );?></td>
											<td><select class="form-control" name="language">
										<?php $all_language=$this->all_language;
										?>
										<?php foreach($all_language as $all_languages){ ?> 
										<option value="<?php echo $all_languages;?>" <?php if($result->holpaym_language==$all_languages){ echo "selected"; }?>><?php echo $all_languages;?></option>
										<?php }?>
										</select></td>
										</tr>
									</tbody>
								</table>

							</div>


							<div class="panel-body pn">

								<div class="row box-footer">
									<div class="text-center">

										<button type="submit" class="btn btn-primary"><?php echo $this->lang->line ( "update" );?></button>

									</div>
								</div>
								<br>
							</div>

						</div>
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