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
			 							<h1 class="mb-0"><i class="icofont-airplane"></i> Hotel Bookings</h1>
			 						</div>
			 					</div>
			 					<div class="col-md-6">
			 						<div class="user-login-right">
			 							<h5 class="mb-0"><i class="icofont-info-circle"></i> Welcome, <span class="user-name font-weight-bold"><?php echo $this->session->userdata("Userlogin")["name"]; ?>!</span></h5>
			 						</div>
			 					</div>
			 					<div class="col-md-12">
			 						<div class="breadcrumb-col">
			 							<ul class="list-inline mb-0 breadcrumb">
			 								<li class="list-inline-item mr-0 breadcrumb-item">
			 									<a href="<?php echo site_url() ?>user/dashboard"><i class="icofont-home"></i> Home</a>
						                  	</li>
						                  	<li class="list-inline-item mr-0 breadcrumb-item">Hotel Bookings</li>
						                </ul>
						              </div>
			 					</div>
			 				</div>
			 			</div>
			 			<div class="paul-card-content">
			 				<div class="paul-layout">
					            <div class="uer-dh-desc pt-2">
					            	<div class="table-rsponsive">
					                      <table class="table table-striped custab table-bordered">
                  <thead>
                      <tr>
                          <th>#</th>
                          <th>Pass Detail</th>
                         
                          <th>Hotel Details</th>
                        
                          <th class="text-center">Action</th>
                      </tr>
                  </thead>
                  <?php
                 // print_r(count($FBookingList));
                 // die;
                  if(count($HBookingList) > 0){
                      $i=1;
                  foreach ($HBookingList as $Listing){ ?>
                          <tr>
                              <td>
                                <strong>Sr</strong> - <?php echo $i++ ?> <br>
                                <strong>Booking ID</strong> - <?php echo $Listing['booklist']->hotboli_id; ?><br>
                                <strong>Booking Date</strong> - <?php echo date_format(date_create($Listing['booklist']->hotboli_entry_date),"h:i A , d M Y");?><br>
                                <strong>Update Date</strong> - <?php echo date_format(date_create($Listing['booklist']->hotboli_update_date),"h:i A , d M Y");?><br>
                                <strong>Fare</strong> -Rs. <?php echo $Listing['booklist']->hotboli_customer_fare; ?>
                              </td>
                            
                            
                           
                              <td><?php foreach ($Listing["paxlist"] as $paxlist){  ?>
                                  <b> <?php echo $paxlist->hotbopax_title.'. '.$paxlist->hotbopax_first_name.' '.$paxlist->hotbopax_last_name; ?><br> </b>
                                  
                            <?php   } ?></td>
                              
                              <td>
                                    <strong>Hotel Name </strong> - <?php echo $Listing['booklist']->hotboli_hotel_name  ?><br>
                                    <strong>City</strong> - <?php echo $Listing['booklist']->hotboli_city_name; ?><br>
                                    <strong>Location</strong> - <?php echo $Listing['booklist']->hotboli_location; ?><br>
                                    <strong>Check In</strong> - <?php echo date_format(date_create($Listing['booklist']->hotboli_check_in_date),"d M Y"); ?><br>
                                    <strong>Check Out</strong> - <?php echo date_format(date_create($Listing['booklist']->hotboli_check_out_date),"d M Y"); ?><br>
                    
                              </td>
                             
                              <td class="text-center">
                               <?php if ($Listing['booklist']->hotboli_payment_status=="Success"){ ?>
                               <a target="_blank" class="btn btn-info btn-Sd btn-xs" href="<?php echo site_url(); ?>user/print_ticket_admin?ref_id=<?php echo url_encode($Listing['booklist']->hotboli_id); ?>">Hotel Voucher</a> <br> 
                               <?php }?> 

                             </td>
                          </tr>
                  <?php } } else{ ?>
                          
                       <tr>
                           <td colspan="7">Not Found Any Records.</td>   
                  <?php } ?>
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