 <?php $this->load->view("holidaylayout/header"); ?>
<style>
   

    .alert>p {
    color: red;
}
label.error {
    font-size: 13px;
    color: red;
}

</style>
<div class="container-fluid contactus-fluid">
	<div class="container white-bg pt30 pb15">
		<h1 class="mainheading">Contact us <small>We are here to help you</small></h1>
                
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
    <hr>
    <div class="row">
      <div class="col-sm-4">
        <div class="grabber conbox clearfix">
          <div class="width-30 pull-left">
            <i class="fa fa-phone main-bg white-color"></i>
          </div>
          <div class="width-70 pull-right pl15">
            <h3 class="mt25 mb10 fz18 main-color">Have Questions? Call Us !</h3>
            <a href="tel:+91 9650817277" class="black-color hover-main-color fz18"><?php echo $this->dsa_phone; ?></a>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="grabber conbox">
          <div class="width-30 pull-left">
            <i class="fa fa-envelope orange-bg white-color"></i>
          </div>
          <div class="width-70 pull-right pl15">
            <h3 class="mt25 mb10 fz18 orange-color">Write us on !</h3>
            <a href="mailto:support@holidaytravels.com" class="black-color hover-orange-color fz18"><?php echo $this->dsa_email; ?></a>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="grabber conbox addconbox">
          <div class="width-30 pull-left">
            <i class="fa fa-map-marker success-bg white-color"></i>
          </div>
          <div class="width-70 pull-right pl15">
            <h3 class="mt25 mb10 fz18 success-color">Our Address</h3>
            <a href="#none" class="black-color hover-success-color fz18"><?php echo $this->dsa_address; ?></a>
          </div>
        </div>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-sm-6">
        <div class="grabber">
          <h3 class="mt0 mb0 fz24 main-color">Contact us</h3>
          <span class="black-color fz12">Contact us about anything related to our services.</span>
          <p class="success-message"></p>
          
          <form action="<?php echo site_url(); ?>query/contact_query" class="mt30" method="POST">
              	<?php if(validation_errors()!=NULL){?>	
					<div class="alert alert-big alert-lightred alert-dismissable fade in">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <?php echo validation_errors(); ?>
                                    </div>
                                    <?php }?>
            <div class="row">
              <div class="col-sm-6">
                <div class="clearfix mb15">
                  <span class="fz14 read-color block mb5">Your Name</span>
                  <input type="text" name="name"  class="input block width-100 border" placeholder="Enter your name">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="clearfix mb15">
                  <span class="fz14 read-color block mb5">Your Phone No.</span>
                  <input type="text" name="mobile" class="input block width-100 border" placeholder="Enter your phone no.">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="clearfix mb15">
                  <span class="fz14 read-color block mb5">Your Email ID</span>
                  <input type="email" name="email" class="input block width-100 border" placeholder="Enter your email id">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="clearfix mb15">
                  <span class="fz14 read-color block mb5">Subject</span>
                  <input type="text" name="subject" class="input block width-100 border" placeholder="Mention Your Subject">
                </div>
              </div>
              <div class="col-sm-12">
                <div class="clearfix mb15">
                  <span class="fz14 read-color block mb5">Your Message</span>
                  <textarea name="message" class="textarea block width-100 border" placeholder="write your message or ask questions..."></textarea>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="clearfix mb15">
                    <button type="submit" class="btn btn-primary block width-100">Submit</button>
                </div>
              </div>
            </div> 
          </form>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="grabber">
          <h3 class="mt0 mb0 fz24 main-color">Find us on Map</h3>
          <span class="black-color fz12">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium nisi in sunt</span>
          <div class="mapgrabber border">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d224368.3937149836!2d77.25804206335621!3d28.51698340416994!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390ce5a43173357b%3A0x37ffce30c87cc03f!2sNoida%2C+Uttar+Pradesh!5e0!3m2!1sen!2sin!4v1517141111192" width="540" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
          </div>
        </div>
      </div>
    </div>
	</div>
</div>
 <?php $this->load->view("holidaylayout/footer"); ?>