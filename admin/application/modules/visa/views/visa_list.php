<?php $this->view('simple_layout/header'); ?>
<?php $this->view('simple_layout/leftSidebar'); ?>

<section id="content">
	<div class="page page-forms-validate">
		<div class="pageheader">
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li><a href="<?php echo site_url();?>"><i class="fa fa-home"></i>
							<?php echo $this->lang->line ( "dashboard" );?></a></li>
					<li><a href="<?php echo site_url($this->uri->segment("1"));?>/visa_list"></i>Visa</a></li>
					<li><a></i> Visa Type</a></li>
				</ul>
			</div>
		</div>
		<!-- row -->
		<div class="row">
			<!-- col -->
			<div class="col-md-12">
				<!-- tile -->
				<a href="<?php echo site_url().$this->uri->segment ( "1" );?>/add_visa" class="btn btn-greensea btn-ef btn-ef-7 btn-ef-7h mb-10 pull-right"><i class="fa fa-plus"></i> <?php echo $this->lang->line ( "add" );?> <?php echo $this->lang->line ( "visa" );?> Type</a>
				<div class="clearfix"></div>
				<section class="tile bp_shadow">
					<!-- tile header -->
					<div class="tile-header dvd dvd-btm">
						<h1 class="custom-font">
							<strong>Visa Types</strong>
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
						<?php 
					} ?>
					<!-- /tile header -->

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
										<th>Title</th>
										<th>Country</th>
										<th>Amount</th>
										<th><?php echo $this->lang->line ( "status" );?></th> 
										<th><?php echo $this->lang->line ( "action" );?></th> 
									</tr>
								</thead>
								<tbody>
									<?php 
									if(isset($result)){
										if(is_array($result)){
											$i=1;
											foreach($result as $bp){ ?>
												<tr>
													<td><?php echo $i;?> </td>
													<td><?php echo $bp->visa_title; ?></td>
													<td><?php echo $bp->location_location; ?></td>
													<td><?php echo $bp->visa_amount; ?></td>
													<td><?php if($bp->visa_status=="active"){ ?><a href="<?php echo site_url();?>visa/update_visa_status/?ref_id=<?php echo url_encode($bp->id); ?>&status=inactive" class="label label-success"><?php echo $this->lang->line ( $bp->visa_status );?></a><?php }else{ ?><a href="<?php echo site_url();?>visa/update_visa_status/?ref_id=<?php echo url_encode($bp->id); ?>&status=active" class="label label-danger"><?php echo "Inactive";?></a><?php }?></td> 
													<td>
														<a href="<?php echo site_url();?>visa/edit_visa/?ref_id=<?php echo url_encode($bp->id); ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> <span> <?php echo $this->lang->line ( "edit" );?></span></a>
														<button class="btn btn-danger btn-sm"  onclick="addidfordelete('<?php echo site_url();?>visa/deletevisa/?id=<?php echo url_encode($bp->id); ?>')"><i class="fa fa-trash"></i> <span><?php echo $this->lang->line ( "delete" );?></span></button>
													  
													</td>
												</tr>
												<?php 
												$i++;
											}
										}
									} ?>
								</tbody>
							</table>
						</div>
						<div style="text-align: right;"><?php echo $this->pagination->create_links();?></div>
					</div>
					<!-- /tile body -->
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
				<h3 class="modal-title custom-font">! <?php echo $this->lang->line ( "warning" );?></h3>
			</div>
			<div class="modal-body">
				<?php echo $this->lang->line ( "do_you_want_to_delete" );?>
			</div>
			<div class="modal-footer">
				<a class="btn btn-success btn-ef btn-ef-3 btn-ef-3c" id="deletePoll"><i class="fa fa-arrow-right"></i> <?php echo $this->lang->line ( "delete" );?></a>
				<button class="btn btn-lightred btn-ef btn-ef-4 btn-ef-4c" data-dismiss="modal"><i class="fa fa-arrow-left"></i> <?php echo $this->lang->line ( "cancel" );?></button>
			</div>
		</div>
	</div>
</div>

<!--/ CONTENT -->
<?php $this->load->view("simple_layout/footer");?>
<?php $this->load->view("visa/js");?>

