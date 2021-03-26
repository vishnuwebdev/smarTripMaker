<?php $this->view('simple_layout/header'); ?>
<?php $this->view('simple_layout/leftSidebar'); ?>


<section id="content">
	<div class="page page-forms-validate">
		<div class="pageheader">
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li><a href="<?php echo site_url();?>"><i class="fa fa-home"></i>
							Dashboard</a></li>
					<li><a href="<?php echo site_url($this->uri->segment("1"));?>"></i> <?php echo $this->uri->segment("1");?></a></li>
					<li><a></i> Package Booking Rquest List</a></li>
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
							<strong>Booking Rquest</strong> List
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

					<!-- tile body -->
					<!-- tile body -->
					<div class="tile-body">
						<div class="row">
							<div class="col-md-6">
								<div id="tableTools"></div>
							</div>
							<div class="col-md-6">
								<div id="colVis"></div>
							</div>
						</div>
						<table class="table table-bordered bp_table">
							<thead>
								<tr>
                                    <th>Sr.</th>
									<th>ID</th>
									<th>Name</th>
									<th>Email</th>
									<th>Mobile</th>
                                    <th>Tour</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
                                     <?php
																																					
							if (isset ( $result )) {
																																						if (is_array ( $result )) {
																																							$i = 1;
																																							foreach ( $result as $bp ) {
																																								?>
                                        <tr>
									<td><?php echo $i; ?></td>
                                                                        <td><?php echo $bp->com_id; ?></td>
									<td> <?php echo $bp->com_name; ?></td>
									<td><?php echo $bp->com_email; ?></td>
									<td><?php echo $bp->com_mobile; ?></td>
                                    <td><?php echo $bp->holiday_name; ?></td>
									<td><?php if($bp->com_status=="close"){ ?><a
										href="<?php echo site_url();?>/<?php echo $this->uri->segment("1");?>/update_query_status/?ref_id=<?php echo url_encode($bp->com_id); ?>&status=open"
										class="label label-success">Booked</a><?php }else{ ?><a
										href="<?php echo site_url();?>/<?php echo $this->uri->segment("1");?>/update_query_status/?ref_id=<?php echo url_encode($bp->com_id); ?>&status=close"
										class="label label-danger">Pending</a><?php }?></td>
								   
									<td>
										
										<div class="btn-group">
											<button type="button" class="btn btn-primary btn-rounded  dropdown-toggle"
												data-toggle="dropdown" aria-expanded="false">
												Action <span class="caret"></span>
											</button>
											<ul class="dropdown-menu dropdown-menu-right" role="menu">
											 <li> <a class="bp_cussor_pointer" onclick="confirm_pop_up('<?php echo site_url();?>/<?php echo $this->uri->segment("1");?>/delete_query/?ref_id=<?php echo url_encode($bp->com_id); ?>')">Delete</a></li>
                                             </ul>
										</div>
									</td>
								</tr>
                                       <?php
																																								$i ++;
																																							}
																																						}
																																					}
																																					?>
							</tbody>
						</table>
						<div style="text-align: right;"><?php echo $this->pagination->create_links();?></div>
					</div>
					<!-- /tile body -->
					<!-- /tile body -->
					<!-- tile footer -->
					<div class="tile-footer text-right bg-tr-black lter dvd dvd-top">
						<!-- SUBMIT BUTTON -->

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

  <div class="modal fade" id="delPollModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title custom-font">! Warning</h3>
                    </div>
                    <div class="modal-body">
                        Are you sure ! you want to delete this  ?
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-success btn-ef btn-ef-3 btn-ef-3c" id="deletePoll"><i class="fa fa fa-trash"></i> Delete</a>
                        <button class="btn btn-lightred btn-ef btn-ef-4 btn-ef-4c" data-dismiss="modal"><i class="fa fa-arrow-left"></i> Cancel</button>
                    </div>
                </div>
            </div>
        </div>
<!--/ CONTENT -->
<?php $this->load->view("simple_layout/footer");?>
<?php $this->load->view($this->uri->segment("1")."/js");?>
<?php $this->load->view($this->uri->segment("1")."/data_table_js");?>