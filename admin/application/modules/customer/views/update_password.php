<?php $this->view('simple_layout/header'); ?>
<?php $this->view('simple_layout/leftSidebar'); ?>
<section id="content">
	<div class="page page-forms-validate">
		<div class="pageheader">
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li><a href="<?php echo site_url();?>"><i class="fa fa-home"></i>
							Dashboard</a></li>
					<li><a href="<?php echo site_url($this->uri->segment("1"));?>"> <?php echo $this->uri->segment("1");?></a></li>
					<li><a>Update Password</a></li>
				</ul>
			</div>
		</div>
		<!-- row -->
		<div class="row">
			<!-- col -->
			<div class="col-md-12">
				<!-- tile -->
				<section class="tile bp_shadow">
	<form class="form-horizontal" role="form"
		action="" method="post" id="update_password">
		<input type="hidden"
			name="<?php echo $this->security->get_csrf_token_name(); ?>"
			value="<?php echo $this->security->get_csrf_hash(); ?>" />
		<div class="panel panel-info">
			<div class="panel-heading">
				<div class="panel-title hidden-xs">Update <strong> Password </strong></div>
			</div>
			<div class="panel-body pn">
				<br>
				<table class="table table-bordered bp_table_td">
					<tbody>
						<tr>
							<td class="warning">Password*</td>
							<td><input type="password" name="password" id="password"
								class="form-control" placeholder="Enter Password"></td>
							<td class="warning">Confirm Password *</td>
							<td><input type="password" name="confirm_password"
								class="form-control" placeholder="Enter Confirm Password"></td>
						</tr>
						
 
					</tbody>
				</table>
				
			</div>
			<div class="text-center">
            <button type="submit" class="btn btn-primary">Update Password</button>		
          </div>
		<br>
			
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
<?php $this->load->view($this->uri->segment("1")."/js");?>