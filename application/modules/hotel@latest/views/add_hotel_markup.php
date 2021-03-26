<?php
$this->load->view ( 'header' );
?>
<div class="container-fluid dashboardfluid">
	<div class="container dashboardcontainer">
		<div class="row userdashboardrow" role="tabpanel">
			<div class="col-sm-12">
				<div class="clearfix bp_page_layout">
					<div class="tab-content dashboardtabcontent">
						<div role="tabpanel" class="tab-pane active" id="mybookings">
							<div class="bookingtypeandstatus clearfix">
								<h3 class="pull-left fz18 black-color mt0">Add Hotel Markup</h3>
								<a href="<?php echo site_url();?>hotel/hotel_markup_list" class="btn btn-primary pull-right mb10"><i class="fa fa-list"></i> Hotel Markup List</a>
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
							<div class="clearfix"></div>
							<div class="clearfix tripsbooked">
								<div class="row alert alert-warning">
									<form action="" method="POST" id="add_markup">
										<div class="col-sm-6">
											<div class="clearfix mt15">
												<label>Amount Type</label> 
												<select class="form-control" name="amount_type">
											      <option value="fix">Fix</option>
											       <option value="percent">Percentage</option>
											  </select>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="clearfix mt15">
												<label>Amount</label> 
												<input type="text" name="amount" class="form-control">
											</div>
										</div>
										<div class="col-sm-6">
											<div class="clearfix mt15">
												<label>Lowest Range</label> 
												<input type="text" name="low_price" id="low_price11" class="form-control">
											</div>
										</div>
										<div class="col-sm-6">
											<div class="clearfix mt15">
												<label>Highest Range</label> 
												<input type="text" name="high_price" id="high_price" class="form-control">
											</div>
										</div>
										<div class="col-sm-12">
											<div class="clearfix mt15 text-right">
												<button type="submit" class="btn btn-success">Add Hotel Markup</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('footer'); ?>
<?php $this->load->view('hotel/js'); ?>
