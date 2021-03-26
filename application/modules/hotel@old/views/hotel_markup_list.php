<?php
$this->load->view ( "commenLayout/head" );
$this->load->view ( 'commenLayout/header' );
?>
<div class="container-fluid dashboardfluid">
	<div class="container dashboardcontainer">
		<div class="row userdashboardrow" role="tabpanel">

			<div class="col-sm-12">
				<div class="clearfix bp_page_layout">
					<div class="tab-content dashboardtabcontent">
						<div role="tabpanel" class="tab-pane active" id="mybookings">
							<div class="bookingtypeandstatus clearfix">
								<h3 class="pull-left fz18 black-color mt0">Hotel Markup List</h3>
								<a href="<?php echo site_url();?>hotel/add_hotel_markup" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add Hotel Markup</a>
							</div>
							<div class="clearfix tripsbooked">
								<div class="table-responsive">
									<table class="table table-striped custab table-bordered mt20 table-font-14">
										<thead>
											<tr>
												<th>#</th>
												<th>Amount Type</th>
												<th>Amount</th>
												<th>Start Range</th>
												<th>End Range</th>
												<th>Date</th>
												<th>Action</th>
											</tr>
										</thead>
                                        
<?php
if (is_array ( $result )) {
	$i = 1;
	foreach ( $result as $results ) {
		?>
                                            <tr>
											<td><?php echo $i;?></td>
											<td><?php echo $results->agehomark_amount_type; ?></td>
											<td><?php echo $results->agehomark_amount; ?></td>
											<td><?php echo $results->agehomark_low_range; ?></td>
											<td><?php echo $results->agehomark_high_range; ?></td>
											<td><?php echo date_format(date_create($results->agehomark_entry_date),"h:i A , d M Y") ?> </td>
											<td>
												<button class="btn btn-sm btn-danger" onclick="confirm_pop_up('<?php echo site_url().$this->uri->segment ( "1" );?>/delete_markup/?ref_id=<?php echo url_encode($results->agehomark_id); ?>')">
													<span>Delete</span>
												</button>
											</td>


										</tr>
 <?php $i++; } } else{ ?>
                          
                       <tr>
											<td colspan="8">No Data Available .</td>   
                  <?php } ?>
                                    
									
									</table>
									<div style="text-align: right;"><?php echo $this->pagination->create_links();?></div>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="delPollModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title custom-font">! Warning</h3>
			</div>
			<div class="modal-body">Do you want to delete this item ?</div>
			<div class="modal-footer">
				<a class="btn btn-success" id="deletePoll"><i class="fa fa-arrow-right"></i> Submit</a> <a class="btn btn-danger" data-dismiss="modal"><i class="fa fa-arrow-left"></i> Cancel</a>
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('commenLayout/footer'); ?>
<?php $this->load->view($this->uri->segment ( "1" )."/js"); ?>