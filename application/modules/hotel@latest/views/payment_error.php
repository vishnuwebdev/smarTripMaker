<?php $this->load->view('include/head'); ?> 
<?php $this->load->view('include/header'); ?> 
<section id="content" class="gray-area" style="padding-top:0;">
  <div class="container" style="margin-bottom:3%;margin-top:3%">  
    <div class="row">
  		<div class="col-md-12 travelo-box box-full text-center">
			<span class="cancel-icon">
		        <i class="icofont-close"></i>
		    </span>
		    <div class="thank-cont">
		    	<!-- <h2>Sorry ! Due to Technical Error process failed.</h2> -->
		        <!-- <span class="thank-id"></span> -->
		        <p>Sorry ! Due to Technical Error process failed.</p><br>
		        <a  href="<?php echo site_url(); ?>" class="btn btn-green "> Go To Home</a>
		    </div>
		</div>
	</div>
</div>
    <!-- <div class="container">
        <div class="row">
		<div class="modal-dialog" role="document">
        <div class="modal-content">
         
		 <div class="modal-header text-center">
          <h4 class="modal-title" id="myModalLabel">
		  <br/> Sorry ! Due to Technical Error process failed. </h4>                 
		 </div>                  				
		
            <div class="modal-body text-center">
                <div class="alert alert-danger">
                    Sorry Payment transaction Canceled . Please Try Again.
                </div>
                <a  href="<?php echo site_url(); ?>" class="btn btn-info"> Go To Home</a>
	     </div>
		 
        </div>                
		</div>                
		</div>			
	</div> -->
</section>  
<?php $this->load->view('include/footer'); ?> 