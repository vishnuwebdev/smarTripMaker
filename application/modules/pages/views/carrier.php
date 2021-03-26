
 <?php $this->load->view('include/head') ?>
<?php $this->load->view('include/header') ?>
 
<!-- Inner Page Header -->
<section class="inner-header pt-2 pb-2 pt-md-4 pb-md-4">
	<div class="container">
		<div class="section-heading--title position-relative">
			<h1 class="text-center title-show-title">Career</h1>
			<h1 class="text-center title-back-title">Career</h1>
			
		</div>
	</div>
</section>
<!-- Inner Page Header end -->

<!-- Main Wrapper Start from here -->
<main class="main-contant-wrap pt-md-3 pb-md-3"> 
	<div class="container">
		<div class="contact-page-temp p-2 pt-md-3 pb-md-3">
			<div class="contact-form pt-2 pb-2 pt-md-4 pb-md-4">
				<div class="section-heading--title position-relative">
					<h1 class="text-center contact-head">Query Form <span class="d-block">For Job Vaccancy</span></h1>
				</div>				
                <?php
                if ($this->session->flashdata('alertmsg') !== NULl) {
                    $bhanu_message = $this->session->flashdata('alertmsg');
                    ?>
                    <div
                        class="alert alert-sm alert-border-left <?php echo $bhanu_message['class']; ?> light alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert"
                                aria-hidden="true">×</button>
                        <i class="fa fa-info pr10"></i> <strong> <?php echo $bhanu_message['message']; ?></strong>
                    </div>
                <?php } ?>
                <?php $log_wrong= $this->session->flashdata('wrong_cap');
                if(!empty($log_wrong)){?>
                    <div class="alert alert-danger mt-lg" id="contactSuccess">
                        Captcha code does not match, please try again.
                    </div>
                <?php }?>
                <div class="col-lg-8 col-md-10 offset-md-1 offset-lg-2">
                    <form class="form" id="carrier-form" method="post" action="<?php echo site_url();?>pages/carrier" enctype="multipart/form-data">
                    	<div class="row">
                    		<div class="col-lg-6">
                    			<div class="form-group">
                    				<label>Name</label>
                    				<input id="form_name" type="text" class="form-control" name="name" placeholder="Name" required="required">
                    			</div>
                    		</div>
                    		<div class="col-lg-6">
                    			<div class="form-group">
                    				<label>Email</label>
                    				<input id="form_email" type="email" class="form-control" name="email" placeholder="Email" required="required">
                    			</div>
                    		</div>
                            <div class="col-md-6">
                                <div class="form-group">
                                	<label>Phone</label>
                                    <input id="form_phone" type="text" class="form-control" name="mobile" placeholder="Phone">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                	<label>Subject</label>
                                    <input id="form_subject" type="text" class="form-control" name="subject" placeholder="Subject">
                                </div>
                            </div>
                            <div class="col-md-12">
								<!-- <label class="col-sm-2 control-label">Resume</label> -->
							<div class="form-group mb-2">
								<div class="">
									<label>Select Resume</label>
								    <input class="form-control" type="file" name="userfile" id="imagefile" required />
								    <!-- <label class="custom-file-label" for="customFile">Select Resume</label> -->
								    <label class="green_lab">doc/pdf</label>
								    <label id="lbl_uploadMessage" style="color:red"></label>
								</div>
							</div>
							</div>
                            <div class="col-md-12">
                                <div class="form-group">
                                	<label>Message</label>
                                    <textarea id="form_message" rows="4" class="form-control" name="message" placeholder="Message*" required="required"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label>Enter Captcha Code Below*</label>
                                <p id="captImg"><?php echo $captchaImg; ?></p>
                                <p>Can't read the image? click <a href="<?php echo site_url("career");?>" class="refreshCaptcha">here</a> to refresh.</p>
                                  <input type="text" name="captcha" class="form-control" value="" data-msg-required="Please enter captcha code." required=""/> <br>
                            </div>

                            <div class="col-md-12 text-center">
                                <button type="submit" id="resume" class="btn btn-search"><span>Submit</span></button>
                            </div>
                        </div> 
                    </form>
                </div>
			</div>
		</div>
	</div>
</main><!--/ Main Wrapper Start from here -->
 
 <?php $this->load->view("include/footer"); ?>
 
 <script>
  $('#imagefile').bind('change', function () {

        //converts the file size from bytes to MB
        var fileSize = this.files[0].size / 1024 / 1024 /5;      
        var fileName = this.files[0].name;
        //finds where the extension starts
        var dotPosition = fileName.lastIndexOf(".");
        //gets only the extension
        var fileExt = fileName.substring(dotPosition);
        //alert(fileExt)
        //checks whether the file is .png and less than 1 MB
        if (fileExt == ".docx" || fileExt == ".pdf") {
            $('#resume').prop('disabled', false);
            $('#lbl_uploadMessage').text("")
            return true;

        }
        else
        {
            if (fileSize >1) {
            $('#lbl_uploadMessage').text('Select a file of size less than 5MB !')
                }
             else{
                $('#lbl_uploadMessage').text('Please select .docx or .pdf file !')
            }
            $('#resume').prop('disabled', true);

            return false;
        }

    });
 
 </script>
 
 
 
 <script>
 
 $("#carrier-form").validate({
	  rules: {
		  name:{
	        required: true,
			number:false,
		},
		
		subject:{
	        required: true,			
		},
		  mobile:{
			required: true,
			number:true,
			minlength: 10,
			maxlength: 10
		    
			  },
		   email:{
				required: true,
				email: true,				
		    },
			
			message:{
	        required: true,			
		},
		file:{
	        required: true,			
		},
	},
	  messages:{
		
	}
		});
 </script>