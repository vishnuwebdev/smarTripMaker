<?php $this->view('simple_layout/header'); ?>
<?php $this->view('simple_layout/leftSidebar'); ?>
<section id="content">
	<div class="page page-forms-validate">
		<div class="pageheader">
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li><a href="<?php echo site_url();?>"><i class="fa fa-home"></i> <?php echo $this->lang->line ( "dashboard" );?></a></li>
					<li><a href="<?php echo site_url($this->uri->segment("1"));?>"></i> <?php echo $this->lang->line ( "holiday" );?></a></li>
					<li><a></i> <?php echo $this->lang->line ( "add_payment_mode" );?></a></li>
				</ul>
			</div>
		</div>
		<!-- row -->
		<div class="row">
			<!-- col -->
			<div class="col-md-12">
				<!-- tile -->
				<a href="<?php echo site_url().$this->uri->segment ( '1' ) ;?>/payment_mode" class="btn btn-greensea btn-ef btn-ef-7 btn-ef-7h mb-10 pull-right"><i class="fa fa-list"></i> <?php echo $this->lang->line ( "payment_mode_list" );?></a>
				<div class="clearfix"></div>
				<section class="tile bp_shadow">
					<!-- tile header -->
					<div class="tile-header dvd dvd-btm">
						<h1 class="custom-font">
							 <strong> <?php echo $this->lang->line ( "add_payment_mode" );?> </strong>
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
											<td><input type="text" name="name" class="form-control" placeholder="Enter Hotel Type"></td>
											<td class="warning"><?php echo $this->lang->line ( "status" );?></td>
											<td><select class="form-control" name="status">
													<option value="active"><?php echo $this->lang->line ( "active" );?></option>
													<option value="inactive"><?php echo $this->lang->line ( "inactive" );?></option>
											</select></td>
										</tr>
										<tr>
											<td class="warning"><?php echo $this->lang->line ( "payment_mode" );?></td>
											<td><select class="form-control" name="mode">
													<option value="offline"><?php echo $this->lang->line ( "offline" );?></option>
													<option value="online"><?php echo $this->lang->line ( "online" );?></option>
											</select></td>
											<td class="warning"><?php echo $this->lang->line ( "payment" );?></td>
											<td><select class="form-control" name="amount">
											        <option value="0">0 %</option>
													<option value="10">10 %</option>
													<option value="20">20 %</option>
													<option value="25">25 %</option>
													<option value="30">30 %</option>
													<option value="40">40 %</option>
													<option value="50">50 %</option>
													<option value="60">60 %</option>
													<option value="70">70 %</option>
													<option value="75">75 %</option>
													<option value="80">80 %</option>
													<option value="90">90 %</option>
													<option value="100">100 %</option>
											</select></td>
										</tr>
										<tr>
											<td class="warning"><?php echo $this->lang->line ( "language" );?>*</td>
											<td>	<select class="form-control" name="language">
										<?php $all_language=$this->all_language;
										?>
										<?php foreach($all_language as $all_languages){ ?> 
										<option value="<?php echo $all_languages;?>" <?php if($this->dsa_set_language==$all_languages){ echo "selected"; }?>><?php echo $all_languages;?></option>
										<?php }?>
										</select></td>
										</tr>
									</tbody>
								</table>

							</div>


							<div class="panel-body pn">

								<div class="row box-footer">
									<div class="text-center">

										<button type="submit" class="btn btn-primary"><?php echo $this->lang->line ( "submit" );?></button>
										<button type="reset" class="btn btn-danger"><?php echo $this->lang->line ( "reset" );?></button>

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