<?php $this->load->view('include/head');?>
<?php $this->load->view('include/header');?>
<section>
			<div class="container">
				<div class="row">
					<div class="col-12">
					<br>
					        <?php
                    if (isset($_SESSION['bp_error_message'])) {
                        ?>
                        <div
                            class="alert alert-sm alert-border-left <?php echo $_SESSION['bp_error_class']; ?> light alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert"
                                    aria-hidden="true">×</button>
                            <i class="fa fa-info pr10"></i> <strong> <?php echo $_SESSION['bp_error_message']; ?></strong>
                        </div>
                    <?php }else{ ?>
                    <div
                            class="alert alert-sm alert-border-left alert-danger light alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert"
                                    aria-hidden="true">×</button>
                            <i class="fa fa-info pr10"></i> <strong> Oops! Something went wrong. Please go to home - >  <a href="<?php echo site_url();?>">Click for Home</a></strong>
                        </div>
                    <?php }?>
					</div>
				</div>
			</div>
		</section>
<?php $this->load->view('include/footer') ?>