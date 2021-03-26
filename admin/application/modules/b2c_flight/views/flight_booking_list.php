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


th{
	width: 25%;
}
</style>
<section id="content">
	<div class="page page-forms-validate">
		<div class="pageheader">
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li><a href="<?php echo site_url();?>"><i class="fa fa-home"></i> <?php echo $this->lang->line ( "dashboard" );?></a></li>
					<li><a href="<?php echo site_url($this->uri->segment("1"));?>/booking_list"></i> <?php echo $this->lang->line ( "flight" );?></a></li>
					<li><a></i> <?php echo $this->lang->line ( "flight_booking_list" );?></a></li>
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
							<strong><?php echo $this->lang->line ( "flight_booking_list" );?> </strong>
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
									<th><?php echo $this->lang->line ( "segment" );?></th>
									<th><?php echo $this->lang->line ( "passenger" );?></th>
									<th><?php echo $this->lang->line ( "fare" );?></th>
								
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
                                                <strong class="text-greensea"><?php echo $this->lang->line ( "id" );?></strong> - <?php echo $bp->fbook_id; ?><br>
												
												<strong class="text-greensea">Ref. ID</strong> - STM00<?php echo $bp->fbook_id; ?><br>
												
                                                <strong class="text-greensea"><?php echo $this->lang->line ( "booking_status" );?></strong> - <?php echo $bp->fbook_ob_booking_status; ?><br>
                                                <?php if($bp->fbook_booking_type=="Return"){?>
                                                <strong class="text-greensea"><?php echo $this->lang->line ( "return_booking_status" );?></strong> - <?php echo $bp->fbook_ib_booking_status; ?><br>
                                                <?php }?>
                                                <strong class="text-greensea"><?php echo $this->lang->line ( "payment_status" );?></strong> - <?php echo $bp->fbook_payment_status; ?><br>
                                                <!--  <a href="<?php echo site_url().$this->uri->segment ( "1" );?>/booking_detail/?ref_id=<?php echo url_encode($bp->fbook_id); ?>" class="btn btn-warning btn-rounded btn-xs "><span><?php echo $this->lang->line ( "booking_detail" );?></span></a> -->
												<strong class="text-greensea"><?php echo $this->lang->line ( "date" );?></strong> - <?php echo date_format(date_create($bp->fbook_entry_date),"h:i A , d M Y");?><br>
											
											
											</td>



                                           <td>
                                                <strong class="text-greensea"><?php echo $this->lang->line ( "from" );?></strong> - <?php echo $bp->fbook_depart_city; ?><br>
                                                <strong class="text-greensea"><?php echo $this->lang->line ( "to" );?></strong> - <?php echo $bp->fbook_arrive_city; ?><br>
                                                <strong class="text-greensea"><?php echo $this->lang->line ( "type" );?></strong> - <?php echo $bp->fbook_booking_type; ?><br>

											
                                                  <strong class="text-greensea"><?php echo $this->lang->line ( "depart_date" );?></strong> - <?php echo date_format(date_create($bp->fbook_depart_date),"d M Y");?><br>
                                                 <strong class="text-greensea"><?php echo $this->lang->line ( "depart_pnr" );?></strong> - <?php echo $bp->fbook_ob_pnr; ?><br>
                                                 <?php if($bp->fbook_booking_type=="Return"){?>
                                                  <strong class="text-greensea"><?php echo $this->lang->line ( "return_date" );?></strong> - <?php echo date_format(date_create($bp->fbook_return_date),"d M Y");?><br>
                                                  <strong class="text-greensea"><?php echo $this->lang->line ( "return_pnr" );?></strong> - <?php echo $bp->fbook_ib_pnr; ?><br>
                                                 <?php }?>
                                           </td>
                                           <td>
                                             <?php
												$booking_id=$bp->fbook_id;
												if(is_array($pax[$booking_id])){
													$i=1;
													foreach($pax[$booking_id] as $paxs){
														echo "<strong>".$i.".</strong>  ".$paxs->fpax_title." ".$paxs->fpax_first_name." ".$paxs->fpax_last_name."<br>";
														$i++;
													} 
												} ?>

												<br/>
												<strong class="text-greensea"><?php echo $this->lang->line ('contact' ) .' '. $this->lang->line('detail') ;?></strong><br />
												<strong class="text-greensea"><?php echo $this->lang->line ( "phone" );?></strong> -	<?php echo $pax[$booking_id][0]->fpax_mobile ; ?><br />
												<strong class="text-greensea"><?php echo $this->lang->line ( "email" );?></strong> -	<?php echo $pax[$booking_id][0]->fpax_email ; ?>
												<br/>

											    <?php if($bp->fbook_ob_booking_status=="Success"){?>
													<a target="_blank" href="<?php echo site_url().$this->uri->segment ( "1" );?>/print_ticket/?ref_id=<?php echo url_encode($bp->fbook_id); ?>" class="btn btn-primary btn-rounded btn-xs"><span><?php echo $this->lang->line ( "ticket" );?></span></a>
													<a target="_blank" href="<?php echo site_url().$this->uri->segment ( "1" );?>/print_invoice/?ref_id=<?php echo url_encode($bp->fbook_id); ?>" class="btn btn-info btn-rounded btn-xs"><span><?php echo $this->lang->line ( "invoice" );?></span></a><br>
                                         		
												 <?php }?>
                                           </td>
                                           <td>
										   <?php if($bp->fbook_booking_type=="Return"){?>
										   <strong>OnWay Fare Details</strong><br>
										   <?php } ?>
                                                <strong class="text-greensea" ><?php echo $this->lang->line ( "offer" ).' '.$this->lang->line('fare');?></strong> - <?php echo $bp->fbook_total_fare; ?><br>
                                                 
                                                <strong class="text-greensea"><?php echo $this->lang->line ( "paid_by_customer" );?></strong> - <?php echo $bp->fbook_customer_fare; ?><br>
                                               <?php if($bp->fbook_booking_type=="Return"){?>
											   <strong>Return Fare Details</strong><br>
											   <strong class="text-greensea" ><?php echo $this->lang->line ( "offer" ).' '.$this->lang->line('fare');?></strong> - <?php echo $bp->fbook_ib_total_fare; ?><br>
                                                
                                                <strong class="text-greensea"><?php echo $this->lang->line ( "paid_by_customer" );?></strong> - <?php echo $bp->fbook_ib_customer_fare; ?><br>
                                               <?php } ?>
												<strong class="text-greensea">Transaction Fees</strong> - <?php echo $bp->fbook_transaction_fee; ?><br>
										 
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