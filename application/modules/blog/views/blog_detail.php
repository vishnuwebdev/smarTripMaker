<?php $this->load->view('include/head') ?>
<?php $this->load->view('include/header') ?>


<!-- Inner Page Header -->
<section class="inner-header pt-2 pb-2 pt-md-4 pb-md-4">
	<div class="container">
		<div class="section-heading--title position-relative">
		  <?php if($result == "0"){ ?>		     
      <h1 class="main-color tac maincontentmainheading">Request url not Found.</h1>      
      <?php }else{ ?>
			<h1 class="text-center title-show-title"><?php echo $result->b_title; ?></h1>
			<h1 class="text-center title-back-title"><?php echo $result->b_title; ?></h1>
			
		</div>
	</div>
</section>
<!-- Inner Page Header end -->

<!-- Main Wrapper Start from here -->
<main class="main-contant-wrap pt-md-3 pb-md-3"> 
	<div class="container">
		<div class="about-page-temp innerpage-com p-2 pt-md-3 pb-md-3">
			<div class="ctc-add-details pr-4 pl-4">
				<p><?php echo $result->b_detail; ?></p>
			</div>
		</div>
	</div>
</main><!--/ Main Wrapper Start from here -->
  <?php } ?>


    <?php $this->load->view('include/footer'); ?>


