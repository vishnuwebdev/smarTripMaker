<?php
$this->load->view("header");


?>
<body>

   


<div class="page-title-container">
            <div class="container">
                <div class="page-title pull-left">
                    <h2 class="entry-title"></h2>
                </div>
               
            </div>
</div>
<section id="content" class="gray-area" style="padding-top:0;">
            <div class="container">
                <div class="row">
				<div class="modal-dialog" role="document">
                <div class="modal-content">
                 
				 <div class="modal-header text-center">
                  <h4 class="modal-title" id="myModalLabel">Thank you For Payment 
				  <br/> Please Wait While we are Generating Your Voucher</h4>                 
				 </div>                  				
				
                    <div class="modal-body text-center"><img class="img-responsive" src="<?php echo base_url();?>assets/images/loader1.gif"> 
				   <br/><b>Please Wait</b></br>Don't Close or Refresh Window
			     </div>
				 
                </div>                
				</div>                
				</div>			
			</div>
</section>			
<?php $this->load->view("footer"); ?>
<script type="text/javascript">
		$(function(){
			   window.location.href="<?php echo site_url();?>flight/ticket_booking/<?php echo $booking_id;?>";
		});
</script>
