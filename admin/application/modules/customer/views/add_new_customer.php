<?php $this->view('simple_layout/header'); ?>
<?php $this->view('simple_layout/leftSidebar'); ?>
<section id="content">
	<div class="page page-forms-validate">
		<div class="pageheader">
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li><a href="<?php echo site_url();?>"><i class="fa fa-home"></i>
							Dashboard</a></li>
					<li><a href="<?php echo site_url($this->uri->segment("1"));?>"></i> <?php echo $this->uri->segment("1");?></a></li>
					<li><a></i> Add New Customer</a></li>
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
							Add <strong>New Customer </strong>
						</h1>
					</div>
					<!-- /tile header -->
	<form class="form-horizontal" role="form"
		action="<?php echo site_url("customer/insert_customer_data");?>" method="post" id="add_new_customer">
		<input type="hidden"
			name="<?php echo $this->security->get_csrf_token_name(); ?>"
			value="<?php echo $this->security->get_csrf_hash(); ?>" />
		<div class="panel panel-info">
			<div class="panel-heading">
				<div class="panel-title hidden-xs">Company Basic Information</div>
			</div>
			<div class="panel-body pn">
				<br>
				<div class="table-responsive">
				<table class="table table-bordered bp_table_td">
					<tbody>
						<tr>
							<td class="warning">First Name*</td>
							<td><input type="text" name="cust_first_name"
								class="form-control" placeholder="Enter Customer First Name "></td>
							<td class="warning">Last Name</td>
							<td><input type="text" name="cust_last_name"
								class="form-control" placeholder="enter Customer Last Name "></td>
						</tr>
						<tr>
							<td class="warning">Email*</td>
							<td><input type="text" name="cust_email" class="form-control"
								placeholder="Email ID"></td>
							<td class="warning">Mobile*</td>
							<td><input type="text" name="cust_mobile" class="form-control" placeholder="Mobile Number"></td>
						</tr>
						<tr>
							<td class="warning">Password*</td>
							<td><input type="" name="cust_password" id="agent_password" class="form-control" placeholder="Login Password"
								></td>
							<td class="warning">Confirm Password*</td>
							<td><input type="text" name="confirm_password"  class="form-control" placeholder="Confirm Password"></td>
						</tr>

					</tbody>
				</table>
			</div>
				<br>
			</div>
			
			<div class="panel-heading">
				<div class="panel-title hidden-xs">Contact Information</div>
			</div>
			<div class="panel-body pn">
				<br>
				<div class="table-responsive">
				<table class="table table-bordered bp_table_text_center">
					<tbody>
						<tr>
							<td class="warning">Address</td>
							<td><input type="text" name="cust_address"
								class="form-control" placeholder="Enter Address"></td>
							<td class="warning">City</td>
							<td><input type="text" name="cust_city"
								class="form-control" placeholder="Enter city name">
								</td>
						</tr>
						<tr>
							<td class="warning">State</td>
							<td><input type="text" name="cust_state"
								class="form-control" placeholder="Enter state name"></td>
							<td class="warning">Country</td>
							<td><input type="text" name="cust_country"
								class="form-control" placeholder="Enter Country Name">
								</td>
						</tr>
						<tr>
							<td class="warning">Pincode</td>
							<td><input type="text" name="cust_pincode"
								class="form-control" placeholder="Enter Pincode"></td>
							<td class="warning">Remark</td>
							<td><input type="text" name="cust_remark"
								class="form-control" placeholder="Enter Remark">
								</td>
						</tr>
					</tbody>
				</table>
			</div>
				<br>
				<div class="row box-footer">
          <div class="text-center">
	
            <button type="submit" class="btn btn-primary">Register</button>
            <button type="reset" class="btn btn-danger">Reset </button> 
			
          </div>
		  </div>
				<br>
			</div>
			
		</div>
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
<?php $this->load->view("customer/js");?>