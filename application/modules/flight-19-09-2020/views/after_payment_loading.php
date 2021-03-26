<?php $this->load->view('include/head');
$this->load->view('include/header'); ?>
<script src="<?php echo site_url() ?>assets/js/jquery.js"></script>
<script src="<?php echo site_url() ?>assets/js/bootstrap.min.js"></script>


<section id="content" class="gray-area" style="padding-top:0;">
            <div class="container">
                <div class="row">
				<div class="modal-dialog" role="document">
                <div class="modal-content">
                 
				 <div class="modal-header text-center">
                  <h4 class="modal-title" id="myModalLabel">Thank You For Payment 
				  <br/> Please Wait While we are Generating Your Ticket</h4>                 
				 </div>                  				
				
				 <div class="modal-body text-center"><img src="<?php echo base_url();?>assets/images/loader1.GIF"> 
				   <br/><b>Please Wait</b></br>Don't Close or Refresh Window
			     </div>
				 
                </div>                
				</div>                
				</div>			
			</div>
</section>			
<?php $this->load->view("include/footer");?>
<script type="text/javascript">
		$(function(){
			  window.location.href="<?php echo site_url();?>flight/ticket_booking/<?php echo $booking_id;?>";
		});
</script>