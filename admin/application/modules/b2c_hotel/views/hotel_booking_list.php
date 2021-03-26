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
					<li><a href="<?php echo site_url($this->uri->segment("1"));?>/booking_list"></i> Hotel</a></li>
					<li><a></i> Hotel Booking List</a></li>
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
							<strong>Hotel Booking List </strong>
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
									<th><?php echo $this->lang->line ( "status" );?></th>
									<th><?php echo $this->lang->line ( "segment" );?></th>
									<th><?php echo $this->lang->line ( "passenger" );?></th>
									<th><?php echo $this->lang->line ( "fare" );?></th>
									<th><?php echo $this->lang->line ( "action" );?></th>
								</tr>
							</thead>
							<tbody>



                        <?php if(isset($result) && is_array($result)){
								if(isset($result)){
									$i=1;
									foreach($result as $bp)
									{
								?>
                                        <tr>
                                            <td>
                                                <strong>ID</strong> - <?php echo $bp->hotboli_id; ?><br>
                                                <strong>Booking Status</strong> - <?php echo $bp->hotboli_booking_status; ?><br>
                                                <strong>Payment Status</strong> - <?php echo $bp->hotboli_payment_status; ?><br>
												<strong>Booking ID</strong> - <?php echo $bp->hotboli_booking_id; ?><br>
												<strong>Booking PNR</strong> - <?php echo $bp->hotboli_book_confim_number; ?><br>
                                            </td>
                                           <td>
                                                <strong>City</strong> - <?php echo $bp->hotboli_city_name; ?><br>
                                                <strong>Location</strong> - <?php echo $bp->hotboli_location; ?><br>
                                                <strong>Check In</strong> - <?php echo date_format(date_create($bp->hotboli_check_in_date),"d M Y"); ?><br>
                                                <strong>Check Out</strong> - <?php echo date_format(date_create($bp->hotboli_check_out_date),"d M Y"); ?><br>
												<strong>Booking Date</strong> - <?php echo date_format(date_create($bp->hotboli_entry_date),"h:i A , d M Y");?><br>
                                           </td>
                                           <td>
                                             <?php
                                             $booking_id=$bp->hotboli_id;
                                             if(is_array($pax[$booking_id])){
                                             	$i=1;
                                             foreach($pax[$booking_id] as $paxs){
                                                echo "<strong>".$i.".</strong>  ".$paxs->hotbopax_title." ".$paxs->hotbopax_first_name." ".$paxs->hotbopax_last_name."<br>";
                                                $i++;} }?>
                                           </td>
                                           <td>
                                                <strong>Fare </strong> - <?php echo $bp->hotboli_customer_fare; ?><br>
												<strong>Transaction Fees </strong> - <?php echo $bp->hotboli_transaction_fee; ?><br>
											</td>
                                           <td>
                                                  <?php if ($bp->hotboli_payment_status=="Success"){ ?>
                                                  <a target="_blank" class="btn btn-info btn-Sd btn-xs" href="<?php echo site_url(); ?>b2c_hotel/print_ticket_admin?ref_id=<?php echo url_encode($bp->hotboli_id); ?>">Hotel Voucher</a> <br>
                                         <?php } else {} ?>
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
<?php $this->load->view($this->uri->segment("1")."/js");?>
<?php $this->load->view($this->uri->segment("1")."/data_table_js");?>