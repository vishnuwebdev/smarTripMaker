<?php $this->view('simple_layout/header'); ?>
<?php $this->view('simple_layout/leftSidebar'); ?>
<style>
<!--
.thumbscl{

 border-radius:6%;
 width: 80px;
 height: 80px !important;

}

table.bp_table th,table.bp_table tr td{
    vertical-align: middle;
}
-->
</style>
<section id="content">
	<div class="page page-forms-validate">
		<div class="pageheader">
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li><a href="<?php echo site_url();?>"><i class="fa fa-home"></i> <?php echo $this->lang->line ( "dashboard" );?></a></li>
					<li><a href="<?php echo site_url($this->uri->segment("1"));?>/booking_list"></i> B2C Flight</a></li>
					<li><a></i> B2C Flight Discount</a></li>
				</ul>
			</div>
		</div>
		<!-- row -->
		<div class="row">
			<!-- col -->
			<div class="col-md-12">
				<!-- tile -->
				<a href="<?php echo site_url();?>b2c_flight/add_discount" class="btn btn-greensea btn-ef btn-ef-7 btn-ef-7h mb-10 pull-right"><i class="fa fa-plus"></i> Add Discount</a>
				<div class="clearfix"></div>
				<section class="tile bp_shadow">
					<!-- tile header -->
					<div class="tile-header dvd dvd-btm">
						<h1 class="custom-font">
							<strong>B2C Flight Discount </strong>
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
									<th>#</th>
									<th>Airline</th>
									<th>Discount</th>
									<th><?php echo $this->lang->line ( "action" );?></th>
								</tr>
							</thead>
							<tbody>
                                     <?php if(isset($result)){
								if(is_array($result)){
									$i=1;
									foreach($result as $bp)
									{
								?>
                                        <tr>
                                            <td>
									             <strong class="text-greensea">Discount ID</strong> : <?php echo $bp->dsafdis_id; ?><br>
									             <strong class="text-greensea">Class</strong> : <?php echo $bp->dsafdis_agent_class; ?> <br>
									             <strong class="text-greensea">Status</strong> :  <?php if($bp->dsafdis_status=="active"){ ?><a href="<?php echo site_url();?>b2c_flight/update_discount_status/?ref_id=<?php echo url_encode($bp->dsafdis_id); ?>&status=inactive" class="label label-success"><?php echo $bp->dsafdis_status;?></a><?php }else{ ?><a href="<?php echo site_url();?>b2c_flight/update_discount_status/?ref_id=<?php echo url_encode($bp->dsafdis_id); ?>&status=active" class="label label-danger"><?php echo $bp->dsafdis_status;?></a><?php }?> <br>
									             <strong class="text-greensea">Entry Date</strong> : <?php echo date_format(date_create($bp->dsafdis_entry_date),"h:i A , d M Y");?> <br>
									             <strong class="text-greensea">Update Date</strong> : <?php echo date_format(date_create($bp->dsafdis_update_date),"h:i A , d M Y");?> <br>
									        </td>
									        <td>
									             <strong class="text-greensea">Airline Type</strong> : <?php echo $bp->dsafdis_airline_type; ?><br>
									             <strong class="text-greensea">Airline Code</strong> : <?php echo $bp->dsafdis_airline_code; ?><br>
									             <strong class="text-greensea">Airline Name</strong> : <?php echo $bp->dsafdis_airline_name; ?><br>
									        </td>
									        <td>
									             <strong class="text-greensea">Discount Type</strong> : <?php echo $bp->dsafdis_amount_type; ?><br>
									             <strong class="text-greensea">On Basic</strong> : <?php echo $bp->dsafdis_on_basic; ?><br>
									             <strong class="text-greensea">On YQ</strong> : <?php echo $bp->dsafdis_on_yq; ?><br>
									             <strong class="text-greensea">Fix</strong> : <?php echo $bp->dsafdis_fix_val; ?><br>
									        </td>
									        <td>
											     <a class="bp_cussor_pointer btn btn-danger btn-rounded btn-xs mb-10" onclick="addidfordelete('<?php echo site_url();?>b2c_flight/delete_discount/?ref_id=<?php echo url_encode($bp->dsafdis_id); ?>')"><?php echo $this->lang->line ( "delete" );?></a>
									        </td>
                                        </tr>
                                       <?php 
									$i++;
								}
								}
								}?>
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