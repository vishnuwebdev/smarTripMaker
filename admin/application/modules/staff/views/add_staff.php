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
					<li><a></i> Add New Staff</a></li>
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
							Add <strong>New Staff </strong>
						</h1>
					</div>
					<!-- /tile header -->
	<form class="form-horizontal" role="form" action="" method="post" id="add_new_customer">
		<input type="hidden"
			name="<?php echo $this->security->get_csrf_token_name(); ?>"
			value="<?php echo $this->security->get_csrf_hash(); ?>" />
		<div class="panel panel-info">
			<div class="panel-heading">
				<div class="panel-title hidden-xs">Staff Basic Information</div>
			</div>
			<div class="panel-body pn">
				<br>
				<div class="table-responsive">
				<table class="table table-bordered bp_table_td">
					<tbody>
						<tr>
							<td class="warning">First Name*</td>
							<td><input type="text" name="first_name"
								class="form-control" placeholder="Enter Staff First Name "></td>
							<td class="warning">Last Name</td>
							<td><input type="text" name="last_name"
								class="form-control" placeholder="enter Staff Last Name "></td>
						</tr>
						<tr>
							<td class="warning">Email*</td>
							<td><input type="text" name="email" class="form-control"
								placeholder="Email ID"></td>
							<td class="warning">Mobile*</td>
							<td><input type="text" name="mobile" class="form-control" placeholder="Mobile Number"></td>
						</tr>
						<tr>
							<td class="warning">Password*</td>
							<td><input type="" name="password" id="agent_password" class="form-control" placeholder="Login Password"
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
				<div class="panel-title hidden-xs">Software Access</div>
			</div>
			<div class="panel-body pn">
				<br>
				<table class="table table-bordered bp_table_text_center">
					<tbody>
						<tr>
							<td class="warning">Modules</td>
							<td><select multiple class="form-control my_select_box_pickup" name="permission[]">
                                                   <?php
                                                   $bp_dsa_permission=explode(",",$this->dsa_data->dsa_admin_permission);
                                                   foreach($result as $results){ 
                                                   	if (in_array ( $results->dsasm_module_name, $bp_dsa_permission )) {
                                                   	?> 
										<option value="<?php echo $results->dsasm_module_name;?>"><?php echo $results->dsasm_module_display_name;?></option>
										<?php } }?>
                                                </select></td>
						</tr>
					</tbody>
				</table>
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
<?php $this->load->view("staff/js");?>
  <script src="<?php echo site_url();?>assets/js/vendor/chosen/chosen.jquery.min.js"></script>
  <script>
  $(".my_select_box_pickup").chosen({

      width: "100%"
  });
  </script>