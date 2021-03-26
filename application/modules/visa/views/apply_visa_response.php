<?php 
	$this->load->view('include/head');
	$this->load->view('include/header');
?>
<div class="main-field pt-2 pb-2 pt-md-4 pb-md-4">
	<div class="container" >
		
		<div class="flght-booking-details hotl-booking-wrap hldy-details-wrap" style="margin: 5rem">
		<div class="clearfix">
			<?php/*
				if ($this->session->flashdata('flash_success') != NULl) {
					$bhanu_message = $this->session->flashdata('flash_success');
					$image = site_url().'assets/images/success.gif';
			?>
					<div class="alert alert-sm alert-border-left alert-success  light alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<i class="fa fa-info pr10"></i> <strong> <?php echo $bhanu_message; ?></strong>
					</div>
			<?php } ?>
			<?php
				if ($this->session->flashdata('flash_error') != NULl) {
					$bhanu_message = $this->session->flashdata('flash_error');
					$image = site_url().'assets/images/error.gif';
			?>
					<div class="alert alert-sm alert-border-left alert-danger  light alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<i class="fa fa-info pr10"></i> <strong> <?php echo $bhanu_message; ?></strong>
					</div>
			<?php } */ ?>
		</div>
		<div class="thankyou-confrim">
			<span class="icon">
				<i class="icofont-check-circled"></i>
			</span>
			<h5>Visa Request Successfully Received.</h5>
			<p class="mb-0">We have received your visa application, your visa application no are <?= $visa->unique_order ?>, we will contact you shortly.</p>
			<span class="d-block">A visa request email has been sent to your provided email address.</span>
		</div>
			<!-- <div class="row">
				<div class="col-md-12">
					<center>
						<img src="<?php echo $image; ?>" alt="<?php echo $bhanu_message; ?>"
							title="<?php echo $bhanu_message; ?>" style="width: 50%">
					</center>
				</div>
			</div> -->
		</div>
	</div>
	<?php $this->load->view('include/footer') ?>