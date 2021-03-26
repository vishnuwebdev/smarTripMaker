<?php $this->view('simple_layout/header'); ?>
<?php $this->view('simple_layout/leftSidebar'); ?>
<section id="content">
	<div class="page page-forms-validate">
		<div class="pageheader">
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li><a href="<?php echo site_url();?>"><i class="fa fa-home"></i> <?php echo $this->lang->line ( "dashboard" );?></a></li>
					<li><a href="<?php echo site_url($this->uri->segment("1"));?>"></i> <?php echo $this->lang->line ( "site_management" );?></a></li>
					<li><a></i> <?php echo $this->lang->line ( "site_setting" );?></a></li>
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
							<?php echo $this->lang->line ( "address_list" );?>
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
									<th style="width: 20%;"><?php echo $this->lang->line ( "address" );?></th>
									<th style="width: 30%;"><?php echo $this->lang->line ( "metadata" );?></th>
									<th><?php echo $this->lang->line ( "contact" );?></th>
									<th><?php echo $this->lang->line ( "language" );?></th>
                                                                        <th><?php echo $this->lang->line ( "news" );?></th>
									<th><?php echo $this->lang->line ( "updated_on" );?></th>
									<th><?php echo $this->lang->line ( "action" );?></th>
								</tr>
							</thead>
							<tbody>
                                     <?php
																																					
if (isset ( $dsa_setting )) {
																																						if (is_array ( $dsa_setting )) {
																																							$i = 1;
																																							foreach ( $dsa_setting as $bp ) {
																																								?>
                                        <tr>
									<td><?php echo $i;?> </td>
									<td><strong><?php echo $this->lang->line ( "address" );?> : </strong><?php echo $bp->dsaset_address_1;?><br> <strong><?php echo $this->lang->line ( "city" );?> : </strong><?php echo $bp->dsaset_city;?><br> <strong><?php echo $this->lang->line ( "state" );?> : </strong><?php echo $bp->dsaset_state;?><br>
										<strong><?php echo $this->lang->line ( "country" );?> : </strong><?php echo $bp->dsaset_country;?><br> <strong><?php echo $this->lang->line ( "pincode" );?> : </strong><?php echo $bp->dsaset_pincode;?><br></td>
									<td><strong><?php echo $this->lang->line ( "meta_title" );?> : </strong><?php echo $bp->dsaset_meta_title;?><br> <strong><?php echo $this->lang->line ( "meta_description" );?> : </strong><?php echo $bp->dsaset_meta_desc;?><br> <strong><?php echo $this->lang->line ( "meta_keyword" );?> : </strong><?php echo $bp->dsaset_meta_keyword;?><br>
										</td>
								    <td><strong><?php echo $this->lang->line ( "phone" );?> : </strong><?php echo $bp->dsaset_phone;?><br> <strong><?php echo $this->lang->line ( "email" );?> : </strong><?php echo $bp->dsaset_email;?>
										</td>		
									<td class="text-uppercase"><?php echo $bp->dsaset_language;?></td>
                                                                        <td class="text-uppercase"><?php echo $bp->dsaset_news;?></td>
									<td><?php echo date_format(date_create($bp->dsaset_update_date),"d M Y");?></td>
									<td><a href="<?php echo site_url().$this->uri->segment ( "1" );?>/edit_setting_detail/?ref_id=<?php echo url_encode($bp->dsaset_id); ?>" class="btn btn-primary btn-rounded btn-ef btn-xs btn-ef-5 btn-ef-5b"><i class="fa fa-pencil"></i> <span><?php echo $this->lang->line ( "edit" );?></span></a>
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
		<div class="row">

			<!-- col -->

			<div class="col-md-6">
				<section class="tile bp_shadow">

					<!-- tile header -->
					<div class="tile-header dvd dvd-btm">
						<h1 class="custom-font">
							<strong><?php echo $this->lang->line ( "logo" );?></strong>
						</h1>
						<ul class="controls">

						</ul>
					</div>
					<!-- /tile header -->
					<form name="form2" role="form" id="changepass" method="POST" action="<?php echo site_url('sitesetting/upload_website_logo'); ?>" enctype="multipart/form-data">
						<!-- tile body -->
						<div class="tile-body">




							<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                    <?php
																																				if ($this->session->flashdata ( 'alert' ) !== NULl) {
																																					$bhanu_message = $this->session->flashdata ( 'alert' );
																																					?>
		
              <div class="alert alert-sm alert-border-left <?php echo $bhanu_message['class'];?> light alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<i class="fa fa-info pr10"></i> <strong> <?php echo $bhanu_message['message'];?></strong>
							</div>
              
			<?php }?>

                                        <div class="form-group"></div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?php echo $this->lang->line ( "current" );?> <?php echo $this->lang->line ( "logo" );?>: </label>
								<div class="col-sm-8">
													    <?php if($result->dsa_logo !=""){?>
														<img src="<?php echo site_url();?>assets/img/logos/<?php echo $result->dsa_logo; ?>" class="img-responsive thumbnail mr25">
													     <?php }else{?>
													     <div class="alert alert-sm alert-border-left alert-danger light alert-dismissable bp_incomplete_info_alert"><?php echo $this->lang->line ( "logo_not_upload_please_upload" );?></div>
													     <?php }?>
													</div>
							</div>
							<div class="form-group">
								<label for="website"><?php echo $this->lang->line ( "change" );?> <?php echo $this->lang->line ( "logo" );?>: </label> <input type="file" name="userfile" id="newpassword" class="form-control" placeholder="" required> 
								<!--<span class="label bg-hotpink">
								<?php echo $this->lang->line ( "note" );?>:</span>-->
								<!--<code class="progress progress-striped progress-sm"><?php echo $this->lang->line ( "logo_upload_note" );?></code>-->
							</div>

							<div class="form-group"></div>




						</div>
						<!-- /tile body -->
						<!-- tile footer -->
						<div class="tile-footer text-right bg-tr-black lter dvd dvd-top">
							<!-- SUBMIT BUTTON -->
							<button type="submit" class="btn btn-greensea mb-10"><?php echo $this->lang->line ( "change" );?></button>
						</div>
						<!-- /tile footer -->
					</form>


				</section>
			</div>

			<!-- col -->
			<div class="col-md-6">



				<section class="tile bp_shadow">

					<!-- tile header -->
					<div class="tile-header dvd dvd-btm">
						<h1 class="custom-font">
							<strong><?php echo $this->lang->line ( "favicon" );?></strong>
						</h1>
						<ul class="controls">

						</ul>
					</div>
					<!-- /tile header -->
					<form name="form2" role="form" id="changepass" method="POST" action="<?php echo site_url('sitesetting/upload_website_fevicon'); ?>" enctype="multipart/form-data">
						<!-- tile body -->
						<div class="tile-body">




							<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                    <?php
																																				if ($this->session->flashdata ( 'alert' ) !== NULl) {
																																					$bhanu_message = $this->session->flashdata ( 'alert' );
																																					?>
		
              <div class="alert alert-sm alert-border-left <?php echo $bhanu_message['class'];?> light alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<i class="fa fa-info pr10"></i> <strong> <?php echo $bhanu_message['message'];?></strong>
							</div>
              
			<?php }?>

                                        <div class="form-group"></div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?php echo $this->lang->line ( "change" );?> <?php echo $this->lang->line ( "favicon" );?>: </label>
								<div class="col-sm-8">
													    <?php if($result->dsa_fab !=""){?>
														<img src="<?php echo site_url();?>assets/img/fevicon/<?php echo $result->dsa_fab; ?>" class="img-responsive thumbnail mr25">
													     <?php }else{?>
													     <div class="alert alert-sm alert-border-left alert-danger light alert-dismissable bp_incomplete_info_alert"><?php echo $this->lang->line ( "favicon_not_upload_please_upload" );?></div>
													     <?php }?>
													</div>
							</div>
							<div class="form-group">
								<label for="website"><?php echo $this->lang->line ( "change" );?> <?php echo $this->lang->line ( "favicon" );?>: </label> <input type="file" name="userfile" id="newpassword" class="form-control" placeholder="" required> 
								<!--<span class="label bg-hotpink"><?php echo $this->lang->line ( "note" );?>:</span>
								<code class="progress progress-striped progress-sm"><?php echo $this->lang->line ( "favion_upload_note" );?></code>-->
							</div>
							<div class="form-group"></div>
						</div>
						<!-- /tile body -->
						<!-- tile footer -->
						<div class="tile-footer text-right bg-tr-black lter dvd dvd-top">
							<!-- SUBMIT BUTTON -->
							<button type="submit" class="btn btn-greensea mb-10"><?php echo $this->lang->line ( "change" );?></button>
						</div>
						<!-- /tile footer -->
					</form>
				</section>
				<!-- tile -->
			</div>
			<!-- /col -->
		</div>
	</div>
</section>
<?php $this->load->view("simple_layout/footer");?>
   <?php $this->load->view("sitesetting/js");?>