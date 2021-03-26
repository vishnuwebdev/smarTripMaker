<?php $this->load->view('include/head');
$this->load->view('include/header'); ?>
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
			<div class="modal-dialog" role="document" style="margin-top: 0;max-width: 100%;width: 60%;color: #000;">
                <div class="modal-content">
                 
				 <div class="modal-header text-center">
                  <h4 class="modal-title" id="myModalLabel">Error Message</h4>                 
				 </div>                  				
				
				 <div class="modal-body p-4 text-center" style="color:#000">
                 <?php echo $_SESSION ['flight'][$this->input->get('sessionid')] ['farequote_data'] ['error']; ?>
			     </div>
				 
                </div>                
				</div>                
				</div>			
			</div>
</section>			
<?php
$this->load->view("include/footer"); ?>

