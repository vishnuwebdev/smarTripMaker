<?php $this->view('simple_layout/header'); ?>
<?php $this->view('simple_layout/leftSidebar'); ?>

<style>
/* <!--
.thumbscl {
	border-radius: 6%;
}
--> */
</style>
<section id="content">
	<div class="page page-forms-validate">
		<div class="pageheader">
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li><a href="<?php echo site_url();?>"><i class="fa fa-home"></i><?php echo $this->lang->line ( "dashboard" );?></a></li>
					<li><a href="<?php echo site_url($this->uri->segment("1"));?>"></i><?php echo $this->lang->line ( "customer" );?></a></li>
					<li><a></i> Transaction Log</a></li>
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
							<strong><?php echo $this->lang->line ( "customer_transaction" );?></strong>
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
						<div class="table-responsive">
						<table class="table table-bordered bp_table">
							<thead>
								<tr>
									<th><?php echo $this->lang->line ( "user_id" );?></th>
									<th><?php echo $this->lang->line ( "name" );?></th>
									<th><?php echo $this->lang->line ( "transaction_detail" );?></th>
									<th><?php echo $this->lang->line ( "debit" );?></th>
									<th><?php echo $this->lang->line ( "credit" );?></th>
									<th><?php echo $this->lang->line ( "balance" );?></th>
								    <th><?php echo $this->lang->line ( "date" );?></th>
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
									<td><?php echo $bp->balance_log_user_id; ?></td>
									<td><?php echo $bp->balance_log_user_name; ?></td>
									<td><?php echo $bp->balance_log_detail; ?></td>
									<td><?php echo $bp->balance_log_debit ; ?></td>
									<td><?php echo $bp->balance_log_credit ; ?></td>
								    <td><?php echo $bp->balance_log_balance ; ?></td>
									<td><?php echo date_format(date_create($bp->balance_log_entry_date),"h:i A , d M Y");?></td>
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
<!--/ CONTENT -->
<?php $this->load->view("simple_layout/footer");?>
<?php $this->load->view("blog/js");?>
<?php $this->load->view("blog/data_table_js");?>