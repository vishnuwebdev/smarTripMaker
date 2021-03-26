<?php $this->load->view('include/head') ?>
<?php $this->load->view('include/header') ?>

 <style type="text/css">
.wrapper {
    display: flex;
}

#sidebar {
        min-width: 250px;
        max-width: 250px;
        height: 100vh;
}
    </style>
<body>
<section class="user-dashboard dash-wrap">
	<div class="container-fluid">
    <div class="clearfix">
	    <?php
	      if ($this->session->flashdata('flash_success') != NULl) {
	      $bhanu_message = $this->session->flashdata('flash_success');
	      ?>

	      <div
	      class="alert alert-sm alert-border-left alert-success  light alert-dismissable">
	      <button type="button" class="close" data-dismiss="alert"
	      aria-hidden="true">×</button>
	      <i class="fa fa-info pr10"></i> <strong> <?php echo $bhanu_message; ?></strong>
	    </div>
	    <?php } ?>
	    <?php
	      if ($this->session->flashdata('flash_error') != NULl) {
	      $bhanu_message = $this->session->flashdata('flash_error');
	      ?>

	      <div
	      class="alert alert-sm alert-border-left alert-danger  light alert-dismissable">
	      <button type="button" class="close" data-dismiss="alert"
	      aria-hidden="true">×</button>
	      <i class="fa fa-info pr10"></i> <strong> <?php echo $bhanu_message; ?></strong>
	    </div>
	  <?php } ?>
	</div>
		
		<div class="row">
			  <?php $this->load->view("customersidebar"); ?>
			 <div class="col-md-9">
			 	<div class="user-sidebar-wrapper pt-2 pt-md-5">
			 		<div class="inner-user-paul">
			 			<div class="card-header-paul">
			 				<div class="row">
			 					<div class="col-md-6">
			 						<div class="card-head-top">
			 							<h1 class="mb-0"><i class="icofont-edit"></i>  Edit Profile</h1>
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
						                  	<li class="list-inline-item mr-0 breadcrumb-item"> Edit Profile</li>
						                </ul>
						              </div>
			 					</div>
			 				</div>
			 			</div>
				  <?php
					if ($this->session->flashdata('edit_profile') !== NULl) {
						$bhanu_message = $this->session->flashdata('edit_profile');
						?>
						<div
							class="alert alert-sm alert-border-left <?php echo $bhanu_message['class']; ?> light alert-dismissable">
							<button type="button" class="close" data-dismiss="alert"
									aria-hidden="true">×</button>
							<i class="fa fa-info pr10"></i> <strong> <?php echo $bhanu_message['message']; ?></strong>
						</div>
				<?php } ?>
			 			<div class="paul-card-content">
			 				<div class="paul-layout">
			 					<div class="uer-dh-desc pt-2">
					            	<form action="<?php echo site_url();?>user/editprofile" method="post" id="edit_form">
									<input type="hidden" name="id" value="<?php echo url_encode($result->cust_id); ?>">
									<h5>Basic Details</h5>					                   
									   <div class="row">
					                      <div class="col-md-4 col-sm-6 col-12">
					                        <div class="form-group">
					                          <label>First Name</label>
					                          <input type="text" name="first_name" class="form-control" placeholder="Enter name" value ="<?php echo $result->cust_first_name?>">
					                        </div>
					                      </div>
										   <div class="col-md-4 col-sm-6 col-12">
					                        <div class="form-group">
					                          <label>Last Name</label>
					                          <input type="text" name="last_name" class="form-control" placeholder="Enter name" value="<?php echo $result->cust_last_name; ?>">
					                        </div>
					                      </div>
					                      <div class="col-md-4 col-sm-6 col-12">
					                        <div class="form-group">
					                          <label>Your Mobile</label>
					                          <input type="text" name="cust_mobile" class="form-control" placeholder="Enter your last mobile no." value="<?php echo $result->cust_mobile; ?>">
					                        </div>
					                      </div> 
					                      <div class="col-md-4 col-sm-6 col-12">
					                        <div class="form-group">
					                          <label>Email</label>
					                          <input type="email" name="agent_pincode" class="form-control" placeholder="Enter your email" value="<?php echo $result->cust_email; ?>" readonly>
					                        </div>
					                      </div>
										  
										   <div class="col-md-4 col-sm-6 col-12">
					                        <div class="form-group">
					                          <label>Address</label>
					                          <input type="text" name="cust_add" class="form-control" placeholder="Enter your address" value="<?php echo $result->cust_address; ?>" >
					                        </div>
					                      </div>
										  
										   <div class="col-md-4 col-sm-6 col-12">
					                        <div class="form-group">
					                          <label>State</label>
					                          <input type="text" name="cust_state" class="form-control" placeholder="Enter your state" value="<?php echo $result->cust_state; ?>">
					                        </div>
					                      </div>
										  
										   <div class="col-md-4 col-sm-6 col-12">
					                        <div class="form-group">
					                          <label>City</label>
					                          <input type="text" name="cust_city" class="form-control" placeholder="Enter your city" value="<?php echo $result->cust_city; ?>">
					                        </div>
					                      </div>
										  
										  <div class="col-md-4 col-sm-6 col-12">
					                        <div class="form-group">
					                          <label>Pincode</label>
					                          <input type="text" name="cust_pin" class="form-control" placeholder="Enter your zipcode" value="<?php echo $result->cust_pincode; ?>">
					                        </div>
					                      </div>
										  
										  <div class="col-md-4 col-sm-6 col-12">
					                        <div class="form-group">
					                          <label>Country</label>
					                          <input type="text" name="cust_country" class="form-control" placeholder="Enter your country" value="<?php echo $result->cust_country; ?>">
					                        </div>
					                      </div>
										  
										  </div>
										  <!--GST DETAIL-->
										 <h5>GST Details</h5>
										   <div class="row">
										  
										  <div class="col-md-4 col-sm-6 col-12">
					                        <div class="form-group">
					                          <label>GST Company Name</label>
					                          <input type="text" name="gst_name" class="form-control" placeholder="Enter your country" value="<?php echo $result->cust_gst_name; ?>">
					                        </div>
					                      </div>
										  
										  <div class="col-md-4 col-sm-6 col-12">
					                        <div class="form-group">
					                          <label>GST Number</label>
					                          <input type="text" name="gst_number" class="form-control" placeholder="Enter your GST Number" value="<?php echo $result->cust_gst_number; ?>">
					                        </div>
					                      </div>
										  
										  <div class="col-md-4 col-sm-6 col-12">
					                        <div class="form-group">
					                          <label>Company Address</label>
					                          <input type="text" name="gst_address" class="form-control" placeholder="Enter your GST Address" value="<?php echo $result->cust_gst_address; ?>">
					                        </div>
					                      </div>
										  
										  <div class="col-md-4 col-sm-6 col-12">
					                        <div class="form-group">
					                          <label>Company Contact No.</label>
					                          <input type="text" name="gst_mobile" class="form-control" placeholder="Enter your GST Mobile" value="<?php echo $result->cust_gst_mobile; ?>">
					                        </div>
					                      </div>
										  
										  <div class="col-md-4 col-sm-6 col-12">
					                        <div class="form-group">
					                          <label>Company Email</label>
					                          <input type="text" name="gst_email" class="form-control" placeholder="Enter your GST Email" value="<?php echo $result->cust_gst_email; ?>">
					                        </div>
					                      </div>
										  <!--END GST DETAILs-->
										  
										  
					                      <div class="col-md-12">
					                        <div class="form-group">
					                          <button class="btn btn-search">Update my profile</button>
					                        </div>
					                      </div>

					                    </div>
					                  </form>
					            </div>
			 				</div>
			 			</div>
			 		</div>
			 	</div>
			 </div>
		</div>
	</div>
</section>
<!---------------->

  

    
  

<?php $this->load->view("include/footer"); ?>
<?php $this->load->view("js"); ?>

<script>
$('#upload_profile').click(function(){
	$('#update_data').submit();
})
</script>