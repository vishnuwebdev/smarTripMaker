<?php $this->load->view("include/head"); ?>
<?php $this->load->view("include/header"); ?>

<body>

 <section class="user-dashboard dash-wrap">
	<div class="container-fluid">
		<div class="row">
		  <?php $this->load->view("customersidebar"); ?>
			 <div class="col-md-9">
			 	<div class="user-sidebar-wrapper pt-2 pt-md-5">
			 		<div class="inner-user-paul">
			 			<div class="card-header-paul">
			 				<div class="row">
			 					<div class="col-md-6">
			 						<div class="card-head-top">
			 							<h1 class="mb-0"><i class="icofont-airplane"></i> Flight Booking</h1>
			 						</div>
			 					</div>
			 					<div class="col-md-6">
			 						<div class="user-login-right">
			 							<h5 class="mb-0"><i class="icofont-info-circle"></i> Welcome, <span class="user-name font-weight-bold"><?php echo $this->session->userdata("Userlogin")["name"]; ?>!</span> </h5>
			 						</div>
			 					</div>
			 					<div class="col-md-12">
			 						<div class="breadcrumb-col">
			 							<ul class="list-inline mb-0 breadcrumb">
			 								<li class="list-inline-item mr-0 breadcrumb-item">
			 									<a href="<?php echo site_url() ?>user/dashboard"><i class="icofont-home"></i> Home</a>
						                  	</li>
						                  	<li class="list-inline-item mr-0 breadcrumb-item">Flight Booking</li>
						                </ul>
						              </div>
			 					</div>
			 				</div>
			 			</div>
			 			<div class="paul-card-content">
			 				<div class="paul-layout">
					            <div class="uer-dh-desc pt-2">
					            	<div class="table-rsponsive">
					                    <table class="table table-hover table-bordered">
						                  <thead>
						                      <tr>
						                        <!--  <th>Sr</th>
						                          <th>B_id</th>
						                          <th>Pass Detail</th>
						                          <th>Fare Amount</th>
						                          <th>Departure airport </th>
						                          <th>Departure airport </th>
						                          <th class="text-center">Action</th>-->
												 <th>ID</th>
                                                <th>Pax</th>
                                                <th>Amount</th>
                                                <th>Segment</th>
                                                <th>Date</th>
                                                <th>Status </th>
                                                <th>Action</th>
						                      </tr>
						                  </thead>
						                  <tbody>
										  
						                   <?php 
if(count($FBookingList) > 0){
	$i=1;
foreach ($FBookingList as $Listing) { ?>
                                            <tr>
                                                <td><?php echo $Listing['booklist']->fbook_id; ?></td>
                                                <td><?php foreach ($Listing["paxlist"] as $paxlist) { ?>
                                                        <b> <?php echo $paxlist->fpax_title . '. ' . $paxlist->fpax_first_name . ' ' . $paxlist->fpax_last_name; ?><br> </b>


    <?php } ?></td>
                                                <td>Rs. 
												<?php echo $Listing['booklist']->fbook_customer_fare + $Listing['booklist']->fbook_ib_customer_fare; ?>
												
												</td>
												
												
                                                <td><b>From: </b><?php echo $Listing['booklist']->fbook_depart_city . ', ' . $Listing['booklist']->fbook_depart_airport_code; ?><br>
                                                    <b>To: </b> <?php echo $Listing['booklist']->fbook_arrive_city . ', ' . $Listing['booklist']->fbook_arrive_airport_code; ?><br> 
                                                    <b>B Type: </b><?php echo $Listing['booklist']->fbook_booking_type; ?> <br>
                                                </td>
                                                <td>
                                                    <b> B Date:</b> <?php echo date_format(date_create($Listing['booklist']->fbook_entry_date),"h:i A , d M Y") ?>
                                                    <br>
													<b>D. Date: </b><?php echo $Listing['booklist']->fbook_depart_date; ?>
                                                    <br>
                                                    <?php
                                                    if (!empty($Listing['booklist']->fbook_return_date)) {
                                                        echo '<b>R. Date: </b>' . $Listing['booklist']->fbook_return_date;
                                                    }
                                                    ?>
                                                   
                                                </td>


                                                <td> 
                                                     <b>Booking Status: </b><?php echo $Listing['booklist']->fbook_ob_booking_status; ?><br>
                                                   
                                                    </td>



                                                <td class="text-center">
												
                                                   <!--<a target="_blank" class="btn btn-info btn-Sd btn-xs" href="<?php echo site_url(); ?>flight/print_ticket_spc?ref_id=<?php echo url_encode($Listing['booklist']->fbook_id); ?>"><span class="glyphicon glyphicon-edit"></span> Print Ticket</a> <br><br>
												   -->
												  
<a target="_blank" class="btn btn-info btn-Sd btn-xs" href="<?php echo site_url(); ?>flight/print_ticket?ref_id=<?php echo bp_hash($Listing['booklist']->fbook_id); ?>"><span class="glyphicon glyphicon-edit"></span> Print Ticket </a> <br><br>												  
												   
                                                    <a target="_blank" class="btn btn-primary btn-Sd btn-xs" href="<?php echo site_url(); ?>flight/print_invoice?ref_id=<?php echo bp_hash($Listing['booklist']->fbook_id); ?>"><span class="fa fa-print"></span> Print Invoice</a> <br><br>
													
                                                    <!-- <a href="<?php echo site_url(); ?>flight/cancel_request?ref_id=<?php echo url_encode($Listing['booklist']->fbook_id); ?>" class="btn btn-warning btn-Sd btn-xs"><span class="glyphicon glyphicon-remove"></span>Cancel Flight</a> -->
                                                   
                                                </td>
                                            </tr>
 <?php $i++; } } else{ ?>
                          
                       <tr>
                           <td colspan="8">not found any record.</td>   
                  <?php } ?>
											
						                  </tbody>
						                </table>
					                </div>
					            </div>
			 				</div>
			 			</div>
			 		</div>
			 	</div>
			 </div>
		</div>
	</div>
</section>

<?php $this->load->view("include/footer"); ?>


    <?php $this->load->view("js"); ?>