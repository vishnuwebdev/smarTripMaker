<?php $this->view('simple_layout/header'); ?>
<?php $this->view('simple_layout/leftSidebar'); ?>
<style>
/* <!--
.thumbscl{

 border-radius:6%;
 width: 80px;
 height: 80px !important;

}

table.bp_table th,table.bp_table tr td{
    vertical-align: middle;
}
--> */


</style>
<section id="content">
	<div class="page page-forms-validate">
		<div class="pageheader">
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li><a href="<?php echo site_url();?>"><i class="fa fa-home"></i> <?php echo $this->lang->line ( "dashboard" );?></a></li>
					<li><a href="<?php echo site_url($this->uri->segment("1"));?>/request_list"></i> <?php echo $this->lang->line ( "visa" );?></a></li>
					<li><a></i> <?php echo $this->lang->line ( "visa_list" );?></a></li>
				</ul>
			</div>
		</div>
		<!-- row -->
		<div class="row">
			<!-- col -->
			<div class="col-md-12">
				<!-- tile -->
				<div class="clearfix"></div>
				<section class="tile bp_shadow">
					<!-- tile header -->
					<div class="tile-header dvd dvd-btm">
						<h1 class="custom-font">
							<strong><?php echo $this->lang->line ( "visa_list" );?> </strong>
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
						<table class="table table-bordered bp_table dataTable no-footer">
							<thead>
								<tr>
									<th><?php echo $this->lang->line ( "status" );?></th>
									<th><?php echo $this->lang->line ( "visa_request" );?></th>
									<th><?php echo $this->lang->line ( "passenger" );?></th>
									<th><?php echo $this->lang->line ( "visa_amount" );?></th>
									<th><?php echo $this->lang->line ( "visa_request_date" );?></th>
								
								</tr>
							</thead>
							<tbody>
                            <?php 
                            	if(isset($result)){
									if(is_array($result)){
									$i=1;
									foreach($result as $bp)
									{
									?>
                                        <tr>
                                            <td>
												<strong class="text-greensea">Ref. ID</strong> <?php echo $bp->id; ?><br>
											</td>
                                            <td>
	                                             <?php
													$booking_id=$bp->id;
													$createdOn=$bp->createdOn;
													$visa_amount='';
													if(is_array($pax[$booking_id])){
														foreach($pax[$booking_id] as $paxs){
															$visa_amount=$paxs->visa_amount;
															echo "<strong> Dubai - </strong>".$paxs->visa_title."<br>";
														} 
													} ?>

											</td>
                                            <td>
												<?php echo '<strong>(User ID:'.$bp->userId.')</strong> '.$bp->firstName.' '.$bp->lastName;?>
											</td>
                                            <td>
												<?php echo $visa_amount;?>
											</td>
                                            <td>
												<?php echo date_format(date_create($createdOn),"h:i A , d M Y");?>
											</td>
                                        </tr>
                                    <?php 
									}
								}
							}?>
							</tbody>
						</table>
					</div>




						<div style="text-align: right;"><?php echo $this->pagination->create_links();?></div>
						<div>* <?php echo $this->lang->line ( "all_time_in_utc" );?></div>
						
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
                        <h3 class="modal-title custom-font">! <?php echo $this->lang->line ( "warning" );?></h3>
                    </div>
                    <div class="modal-body">
                        <?php echo $this->lang->line ( "do_you_want_to_delete" );?>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-success btn-ef btn-ef-3 btn-ef-3c" id="deletePoll"><i class="fa fa-arrow-right"></i> <?php echo $this->lang->line ( "submit" );?></a>
                        <button class="btn btn-lightred btn-ef btn-ef-4 btn-ef-4c" data-dismiss="modal"><i class="fa fa-arrow-left"></i> <?php echo $this->lang->line ( "cancel" );?></button>
                    </div>
                </div>
            </div>
        </div>
<!--/ CONTENT -->
<?php $this->load->view("simple_layout/footer");?>
<?php $this->load->view("blog/js");?>
<?php $this->load->view("blog/data_table_js");?>