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
			 							<h1 class="mb-0"><i class="icofont-airplane"></i> Holiday Bookings</h1>
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
						                  	<li class="list-inline-item mr-0 breadcrumb-item">Holiday Bookings</li>
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
						<th>Requested By</th> 
                          <th>Package Name</th> 
						  <th>Booking Date</th>                          
                          <th>Nights</th>   
						  <th>Starting Price</th>                          
                      </tr>
                  </thead>
                  <?php
                 // print_r(count($FBookingList));
                 // die;
                  if(count($result) > 0){
                      $i=1;
                  foreach ($result as $bp){ ?>
                          <tr>
                              <td>
                                <?php echo $i++ ?> <br>                                
                              </td>
								<td>
								<strong>Name: </strong>	<?php echo $bp->com_name; ?> <br/>
								<strong>Email: </strong>	<?php echo $bp->com_email; ?> <br/>
								<strong>Mobile: </strong>	<?php echo $bp->com_mobile; ?>
								</td>
								<td>
									<?php echo $bp->holiday_name; ?>
								</td>
								<td>
								 <?php echo date_format(date_create($bp->holiday_entry_date),"h:i A , d M Y");?>
								</td>
								<td>
								<?php echo $bp->holiday_night?>	
								</td>
								<td>
									<?php echo $bp->holiday_start_price?>
								</td>
                             
                          </tr>
                  <?php } } else{ ?>
                          
                       <tr>
                           <td colspan="7">Not Found Any Records.</td> 
						</tr>
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