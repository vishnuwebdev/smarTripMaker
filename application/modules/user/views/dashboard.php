 <?php $this->load->view('include/head') ?>
<?php $this->load->view('include/header') ?>

  <section class="user-dashboard dash-wrap">
	<div class="container-fluid">
		<div class="row">
			<?php //include "user-dash-sidebar.php" ?>
			  <?php $this->load->view("customersidebar"); ?>
			 <div class="col-md-9">
			 	<div class="user-sidebar-wrapper pt-2 pt-md-5">
			 		<div class="inner-user-paul">
			 			<div class="card-header-paul">
			 				<div class="row">
			 					<div class="col-md-6">
			 						<div class="card-head-top">
			 							<h1 class="mb-0"><i class="icofont-dashboard"></i> Dashboard</h1>
			 						</div>
			 					</div>
			 					<div class="col-md-6">
			 						<div class="user-login-right">
			 							<h5 class="mb-0"><i class="icofont-info-circle"></i> Welcome, <span class="user-name font-weight-bold"> <?php echo $result->cust_first_name; ?> <?php echo $result->cust_last_name; ?> !</span></h5>
			 						</div>
			 					</div>
			 					<div class="col-md-12">
			 						<div class="breadcrumb-col">
			 							<ul class="list-inline mb-0 breadcrumb">
			 								<li class="list-inline-item mr-0 breadcrumb-item">
			 									<a href="<?php echo site_url() ?>user/dashboard"><i class="icofont-home"></i> Home</a>
						                  	</li>
						                  	<li class="list-inline-item mr-0 breadcrumb-item">Dashboard</li>
						                </ul>
						              </div>
			 					</div>
			 				</div>
			 			</div>
			 			<div class="paul-card-content">
			 				<div class="paul-layout">
			 					<div class="profile-top-bar mb-3 p-2">
			 						<div class="row">
			 							<div class="col-lg-6 col-md-6 col-sm-6">
			 								<div class="profile-img text-center text-md-left">
					                        	<img src="<?php echo site_url();?>admin/assets/img/logos/<?php echo $this->dsa_data->dsa_logo;?>" alt="logo">
					                      	</div>
					                    </div>
					                    <div class="col-lg-6 col-md-6 col-sm-6">
					                      <div class="pro-btn-right clearfix text-center text-md-right pt-2 pt-md-2">
					                        <a href="<?php echo site_url();?>user/editprofile" class="ic-btn">
					                          <i class="icofont-user-suited"></i>Edit Profile</a>
					                      </div>
					                    </div>
					                </div>
					            </div>						
							
					            <div class="uer-dh-desc pt-2">
					            	<div class="table-rsponsive">
					                    <table class="table table-hover table-bordered mb0">
										<thead>
											<tr>
					                          <th class="firsttd" colspan="2">Basic Details</th>
					                        </tr>
										</thead>
					                      <tbody>
					                        <tr>
					                          <td class="firsttd">Company Name</td>
					                          <td><?php echo $result->cust_first_name; ?> <?php echo $result->cust_last_name; ?></td>
					                        </tr>
					                        <tr>
					                          <td class="firsttd">Email Id</td>
					                          <td><?php echo $result->cust_email; ?></td>
					                        </tr>
					                        
					                        <tr>
					                          <td class="firsttd">Phone Number</td>         
					                          <td><?php echo $result->cust_mobile; ?></td>
					                        </tr>
					                        
					                         <tr>
					                          <td class="firsttd">Address</td>         
					                          <td><?php echo $result->cust_address; ?></td>
					                        </tr>
					                        <tr>
					                          <td class="firsttd">City</td>         
					                          <td><?php echo $result->cust_city; ?></td>
					                        </tr>
					                        
					                        <tr>
					                          <td class="firsttd">State</td>         
					                          <td><?php echo $result->cust_state; ?></td>
					                        </tr>
					                        <tr>
					                          <td class="firsttd">Country</td>         
					                          <td><?php echo $result->cust_country; ?></td>
					                        </tr>
					                        <tr>
					                          <td class="firsttd">Zipcode</td>         
					                          <td><?php echo $result->cust_pincode; ?></td>
					                        </tr>
											
					                      </tbody>
					                    </table>
					                </div>
					            </div>
								
								<!--GST DETAILS-->
														
							
					            <div class="uer-dh-desc pt-2">
					            	<div class="table-rsponsive">
					                    <table class="table table-hover table-bordered mb0">
										<thead>
											<tr>
					                          <th class="firsttd" colspan="2">GST Details</th>
					                        </tr>
										</thead>
					                      <tbody>					                       
											<!--GST-->
											 <tr>
					                          <td class="firsttd">GST Company Name</td>         
					                          <td><?php echo $result->cust_gst_name; ?></td>
					                        </tr>
											 <tr>
					                          <td class="firsttd">GST Number</td>         
					                          <td><?php echo $result->cust_gst_number; ?></td>
					                        </tr>
											 <tr>
					                          <td class="firsttd">GST Address</td>         
					                          <td><?php echo $result->cust_gst_address; ?></td>
					                        </tr>
											 <tr>
					                          <td class="firsttd">GST Contact No.</td>         
					                          <td><?php echo $result->cust_gst_mobile; ?></td>
					                        </tr>
											 <tr>
					                          <td class="firsttd">GST Email</td>         
					                          <td><?php echo $result->cust_gst_email; ?></td>
					                        </tr>
											
											<!---->
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
<!-- User dashboard end from here -->

    
 

<?php $this->load->view("include/footer"); ?>
<?php $this->load->view("js"); ?>