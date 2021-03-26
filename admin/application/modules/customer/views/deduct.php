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
					<li><a></i> Deduct</a></li>
				</ul>
			</div>
		</div>
		<!-- row -->
		<div class="row">
			<!-- col -->
			<div class="col-md-12">
				<!-- tile -->
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
				<section class="tile bp_shadow">
	<form class="form-horizontal" role="form"
		action="<?php echo site_url("customer/update_deduct");?>" method="post" id="add_customer_topup">
		<input type="hidden"
			name="<?php echo $this->security->get_csrf_token_name(); ?>"
			value="<?php echo $this->security->get_csrf_hash(); ?>" />
				<input type="hidden" value="<?php echo bp_hash($result->cust_id);?>" name="cust_id">
		<div class="panel panel-info">
			<div class="panel-heading">
				<strong>Virtual Deduct </strong>
			</div>
			<div class="panel-body pn">
				<br>
				<div class="table-responsive">
					<table class="table table-bordered bp_table_td">
						<tbody>
							<tr>
								<td class="warning">Customer First Name</td>
								<td><?php echo $result->cust_first_name;?></td>
								<td class="warning">Customer Last Name</td>
								<td><?php echo $result->cust_last_name;?></td>
							</tr>
							<tr>
								<td class="warning">Balance</td>
								<td><?php echo $result->cust_balance;?></td>
							</tr>
							<tr>
								<td class="warning">Amount*</td>
								<td><input type="text" name="balance"
									class="form-control only_number" placeholder="Enter Amount"></td>
								<td class="warning">Remark*</td>
								<td><input type="text" name="remark"
									class="form-control" placeholder="Enter Remark"></td>
							</tr>

						</tbody>
					</table>
				</div>
			
			
			
			<div class="panel-body pn">
				 <div class="text-center">
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
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
<script>

 $('.only_number').keypress(function (event) {
            return isNumber(event, this)
  });

function isNumber(evt, element) {

        var charCode = (evt.which) ? evt.which : event.keyCode

        if (
            (charCode != 45 || $(element).val().indexOf('-') != -1) &&      // “-” CHECK MINUS, AND ONLY ONE.
            (charCode != 46 || $(element).val().indexOf('.') != -1) &&      // “.” CHECK DOT, AND ONLY ONE.
            (charCode < 48 || charCode > 57))
            return false;

        return true;
}    
</script>