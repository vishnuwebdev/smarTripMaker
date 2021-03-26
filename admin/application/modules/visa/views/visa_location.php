<?php $this->view('simple_layout/header'); ?>
<?php $this->view('simple_layout/leftSidebar'); ?>

<section id="content">
	<div class="page page-forms-validate">
		<div class="pageheader">
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li><a href="<?php echo site_url();?>"><i class="fa fa-home"></i>
							<?php echo $this->lang->line ( "dashboard" );?></a></li>
					<li><a href="<?php echo site_url($this->uri->segment("1"));?>/visa_location"></i>Visa</a></li>
					<li><a></i> Visa Location</a></li>
				</ul>
			</div>
		</div>
		<!-- row -->
		<div class="row">
			<!-- col -->
			<div class="col-md-12">
				
				<div class="clearfix"></div>
				<section class="tile bp_shadow">
					<!-- tile header -->
					<div class="tile-header dvd dvd-btm">
						<h1 class="custom-font">
							<strong>Visa Location</strong>
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
										<th>Location</th>
										<th>Country</th>
										<th>Country Code</th>
										<th><?php echo $this->lang->line ( "status" );?></th> 
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
													<td><?php echo $bp->location_location; ?></td>
													<td><?php echo $bp->location_country_name; ?></td>
													<td><?php echo $bp->location_country_code; ?></td>
													<td>
													    <?php if($bp->visa_status == 1){ ?>
													        <a href="<?php echo site_url();?>visa/update_visa_location_status/?ref_id=<?php echo url_encode($bp->location_id); ?>&status=inactive" class="label label-success">
													           <?php echo "Active";?>
												            </a>
											            <?php }else{ ?>
											                <a href="<?php echo site_url();?>visa/update_visa_location_status/?ref_id=<?php echo url_encode($bp->location_id); ?>&status=active" class="label label-danger">
											                    <?php echo "Inactive";?>
										                    </a>
									                    <?php }?>
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

<!--/ CONTENT -->
<?php $this->load->view("simple_layout/footer");?>
<?php $this->load->view("visa/js");?>

