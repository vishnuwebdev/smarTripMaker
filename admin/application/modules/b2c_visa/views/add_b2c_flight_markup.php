<?php $this->view('simple_layout/header'); ?>

<?php $this->view('simple_layout/leftSidebar'); ?>
<section id="content">
	<div class="page page-forms-validate">
		<div class="pageheader">
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li><a href="<?php echo site_url();?>"><i class="fa fa-home"></i> <?php echo $this->lang->line ( "dashboard" );?></a></li>
					<li><a href="<?php echo site_url($this->uri->segment("1"));?>/booking_list"></i> <?php echo $this->lang->line ( "b2c" )." ".$this->lang->line ( "flight" );?></a></li>
					<li><a></i>  Add B2C Markup</a></li>
				</ul>
			</div>
		</div>
		<!-- row -->
		<div class="row">
			<!-- col -->
			<div class="col-md-12">
				<!-- tile -->
				<a href="<?php echo site_url().$this->uri->segment ( '1' ) ;?>/b2c_flight_markup_list" class="btn btn-greensea btn-ef btn-ef-7 btn-ef-7h mb-10 pull-right"><i class="fa fa-list"></i> B2c Flight Markup </a>
				<div class="clearfix"></div>
				<section class="tile bp_shadow">
					<!-- tile header -->
					<div class="tile-header dvd dvd-btm">
						<h1 class="custom-font">
							 <strong> Add B2C Flight Markup </strong>
						</h1>
					</div>
					<?php
				if ($this->session->flashdata ( 'alert' ) !== NULl) {
					$bhanu_message = $this->session->flashdata ( 'alert' );
					?>
																													<div
			class="alert alert-sm alert-border-left <?php echo $bhanu_message['class'];?> light alert-dismissable">
			<button type="button" class="close" data-dismiss="alert"
				aria-hidden="true">×</button>
			<i class="fa fa-info pr10"></i> <strong> <?php echo $bhanu_message['message'];?></strong>
		</div>
              
			<?php }?>
					<!-- /tile header -->
					<form class="form-horizontal" role="form" action="" method="post" id="add_meal" enctype="multipart/form-data">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
						<div class="panel panel-info">
							<div class="panel-body pn">
								<br>
								<div class="table-responsive">
								<table class="table table-bordered bp_table_td">
									<tbody>
										<tr>
											<td class="warning">Domestic/international</td>
											<td>
											   <select class="form-control" name="dom_int">
											      <option value="domestic">Domestic</option>
											       <option value="international">International</option>
											       
											  </select>
											</td>
											<td class="warning"><?php echo $this->lang->line ( "amount_type" );?></td>
											<td><select class="form-control" name="amount_type">
											      <option value="fix"><?php echo $this->lang->line ( "fix" );?></option>
											       <option value="percent"><?php echo $this->lang->line ( "percentage" );?></option>
											  </select></td>
											  	<td class="warning"><?php echo $this->lang->line ( "amount" );?></td>
											<td><input type="text" name="amount" class="form-control"></td>
										</tr>
									
										<tr>
												<td class="warning"><?php echo $this->lang->line ( "markup_type" );?></td>
											<td>
											   <select class="form-control type_all_airline" name="markup_type">
											      <option value="all"><?php echo $this->lang->line ( "all" );?></option>
											       <option value="airline_wise"><?php echo $this->lang->line ( "airline_wise" );?></option>
											       
											  </select>
											</td>
											<td class="warning hide_1" style="display:none;"><?php echo $this->lang->line ( "airline_code" );?></td>
											<td class="hide_2" style="display:none;"><input type="text" name="airline" class="form-control" id="airport">
											</td>
										</tr>
									
									</tbody>
								</table>
							</div>

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