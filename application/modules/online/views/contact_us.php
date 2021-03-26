 <?php $this->load->view("header"); ?>
<style>
   

    .alert>p {
    color: red;
}
label.error {
    font-size: 13px;
    color: red;
}

</style>

  <section class="innerpage-title pt-3 pb-3">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="inner-page-title-left">
            <h1 class="mb-0">Contact us</h1>
          </div>
        </div>
        <div class="col-md-6">
          <div class="inner-page-title-right text-right">
            <ul class="list-inline">
              <li class=""><a href="<?php echo site_url(); ?>">Home</a></li>
              <li class="">Contact us</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>





  <section id="contact-us" class="inner-page-col">
    <div class="container">
       <div class="inner-content">
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
      <div class="row">
        <div class="col-md-4">
          <div class="contact-left-col">
              <ul class="list-unstyled">
                <li class="">
                  <div class="icon">
                    <i class="icofont-google-map"></i>
                  </div>
                  <div class="con-txt">
                    <h5>Address</h5>
                    <p class="mb-0"><?php echo $this->dsa_setting->dsaset_address_1.',<br>'.$this->dsa_setting->dsaset_city
                    .','.$this->dsa_setting->dsaset_state
                    .',<br>'.$this->dsa_setting->dsaset_country.','.$this->dsa_setting->dsaset_pincode; ?></p>
                  </div>
                </li>
                <li class="">
                  <div class="icon">
                    <i class="icofont-envelope-open"></i>
                  </div>
                  <div class="con-txt">
                    <h5>Email Address</h5>
                    <p class="mb-0"><a href="mailto:<?php echo $this->dsa_setting->dsaset_email; ?>" class="black-color hover-orange-color"><?php echo $this->dsa_setting->dsaset_email; ?></a></p>
                  </div>
                </li>
                <li class="">
                  <div class="icon">
                    <i class="icofont-ui-call"></i>
                  </div>
                  <div class="con-txt">
                    <h5>Phone Number</h5>
                    <p class="mb-0"><a href="tel:<?php echo $this->dsa_setting->dsaset_phone; ?>" class="black-color hover-main-color"><?php echo $this->dsa_setting->dsaset_phone; ?></a></p>
                  </div>
                </li>
              </ul>
            </div>
        </div>
        <div class="col-md-8">
          <div class="contact-us-right">
            <p class="success-message"></p>
          
          <form action="<?php echo site_url(); ?>contact-us" class="mt30" method="POST">
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
                  <input type="text" name="name"  class="form-control input block width-100 border" placeholder="Enter your name">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="clearfix mb15">
                  <span class="fz14 read-color block mb5">Your Phone No.</span>
                  <input type="text" name="mobile" class="form-control input block width-100 border" placeholder="Enter your phone no.">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="clearfix mb15">
                  <span class="fz14 read-color block mb5">Your Email ID</span>
                  <input type="email" name="email" class="form-control input block width-100 border" placeholder="Enter your email id">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="clearfix mb15">
                  <span class="fz14 read-color block mb5">Subject</span>
                  <input type="text" name="subject" class="form-control input block width-100 border" placeholder="Mention Your Subject">
                </div>
              </div>
              <div class="col-sm-12">
                <div class="clearfix mb15">
                  <span class="fz14 read-color block mb5">Your Message</span>
                  <textarea name="message" class="form-control textarea block width-100 border" placeholder="write your message or ask questions..."></textarea>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="clearfix mb15">
                    <button type="submit" class="form-control btn btn-primary block width-100">Submit</button>
                </div>
              </div>
            </div> 
          </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  </section>

 <?php $this->load->view("footer"); ?>