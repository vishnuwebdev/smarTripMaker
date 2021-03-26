<?php
$this->load->view("header");

print_r($this->input->get('sessionid'));
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
                  <h4 class="modal-title" id="myModalLabel"><?php echo $_SESSION ['flight'][$this->input->get('sessionid')] ['farequote_data'] ['error']; ?></h4>                 
				 </div>                  				
				
				 <div class="modal-body text-center">
                                    <?php echo $_SESSION ['flight'][$this->input->get('sessionid')] ['farequote_data'] ['error']; ?>
			     </div>
				 
                </div>                
				</div>                
				</div>			
			</div>
</section>			
<?php
$this->load->view("footer"); ?>

