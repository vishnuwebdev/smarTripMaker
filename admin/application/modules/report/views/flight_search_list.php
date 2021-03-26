<?php $this->view('simple_layout/header'); ?>
<?php $this->view('simple_layout/leftSidebar'); ?>
<
<style>
<!--
.thumbscl {
	border-radius: 6%;
}
-->
</style>
<section id="content">
	<div class="page page-forms-validate">
		<div class="pageheader">
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li><a href="<?php echo site_url();?>"><i class="fa fa-home"></i>
							<?php echo $this->lang->line ( "dashboard" );?></a></li>
					<li><a href="<?php echo site_url($this->uri->segment("1"));?>"></i>Report</a></li>
					<li><a></i> Flight Search List</a></li>
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
							<strong>Flight Search List</strong>
						
						
						</h1>
					</div>
					<?php
					if ($this->session->flashdata ( 'alert' ) !== NULl) {
						$bhanu_message = $this->session->flashdata ( 'alert' );
						?>
																													<div class="alert alert-sm alert-border-left <?php echo $bhanu_message['class'];?> light alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
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
						<div class="table-responsive">
						<table class="table table-bordered bp_table">
							<thead>
								<tr>
									<th>#</th>
									<th>Agent ID</th>
									<th>From </th>
									<th>To</th>
									<th>Type</th>
									<th>Pax</th>
									<th>Date</th>
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
								   <td><?php echo $i;?></td>
								   <td><?php echo $bp->fsh_agent_id;?></td>
								   <td><?php echo $bp->fsh_from;?></td>
								   <td><?php echo $bp->fsh_to;?></td>
								   <td><?php echo $bp->fsh_type;?></td>
								   <td>
								      <strong>Adult - </strong><?php echo $bp->fsh_adult;?><br>
								      <strong>Child - </strong><?php echo $bp->fsh_child;?><br>
								      <strong>Infant - </strong><?php echo $bp->fsh_infant;?><br>
								   </td>
								   <td>
								      <strong>Depart - </strong><?php echo date_format(date_create($bp->fsh_depart_date),"d M Y");?><br>
								      <?php if($bp->fsh_return_date!=""){?>
								      <strong>Return - </strong><?php echo date_format(date_create($bp->fsh_return_date),"d M Y");?><br>
								      <?php }?>
								      <strong>Search - </strong><?php echo date_format(date_create($bp->fsh_entry_date),"h:i A , d M Y");?><br>
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
					</div>
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
			<div class="modal-body">Are you sure ! you want to delete this ?</div>
			<div class="modal-footer">
				<a class="btn btn-success btn-ef btn-ef-3 btn-ef-3c" id="deletePoll"><i class="fa fa fa-trash"></i> Delete</a>
				<button class="btn btn-lightred btn-ef btn-ef-4 btn-ef-4c" data-dismiss="modal">
					<i class="fa fa-arrow-left"></i> Cancel
				</button>
			</div>
		</div>
	</div>
</div>
<!--/ CONTENT -->
<?php $this->load->view("simple_layout/footer");?>
<?php $this->load->view("blog/js");?>
<?php $this->load->view("blog/data_table_js");?>