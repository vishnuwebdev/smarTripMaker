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
                 
				                  				
				
				 <div class="modal-body text-center">
                                    <div class="card">
				<div class="card-header">Something Wrong</div>
				<div class="card-body">
				 <?php
				 $bp_error=$_SESSION ['flight'] ['bp_error'];
				 if(isset($bp_error)){
				 ?>
					<div class="alert alert-sm alert-border-left <?php echo $bp_error['class']; ?> light alert-dismissable">
						
						<i class="fa fa-info pr10"></i> <strong> <?php echo $bp_error['message']; ?></strong>
					</div>
					<?php }?>
				</div>
			</div>
			     </div>
				 
                </div>                
				</div>                
				</div>			
			</div>
</section>			
<?php
$this->load->view("footer"); ?>

