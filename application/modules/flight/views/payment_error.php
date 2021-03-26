<?php $this->load->view('include/head');
$this->load->view('include/header'); ?>
<section id="content">
  <div class="container" style="margin-bottom:3%;margin-top:3%">  
		        <div class="row">
              <div class="col-md-12 travelo-box box-full text-center">
                <span class="cancel-icon">
                    <i class="icofont-close"></i>
                </span>
                <div class="thank-cont">
                    <h2>Payment unsuccessful!!!</h2>
                    <span class="thank-id">Booking ID : <?php echo $_SESSION['flight']['search_RequestData']["BookingId"];?> <?php echo $booking_id;?></span>
                    <p>For Any Help Contact Us <i class="icofont-hand-down"></i></p><br>
                    <p><strong>Email ID</strong> : <?php echo $this->dsa_setting->dsaset_email; ?></p>
                     <p><strong>Mobile Number </strong>: <?php echo $this->dsa_setting->dsaset_phone; ?></p>
                </div>
						  
					<!-- <div class="panel panel-default">  
       					  <div class="panel-heading">
						  <tr><th>Your Booking ID:</th> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <td></td></tr> 
						  </div>
					 </div>

					 
					  <div class="panel panel-default">  
       					  <div class="panel-heading"></div>
							  <table class="table">
								<tr><th>Contact No:</th><td></td></tr> 
								<tr><th>Email ID:</th><td></td></tr> 
							</table>
					  </div> -->
					  
					  
			 </div>
             <!-- <div class="col-xs-12 col-md-4 " ><div class="travelo-box box-full">
                        <div class="contact-form">
                            <h2>Need Help Send Query!!!</h2>
                            <form action="<?php echo site_url();?>online/help_query" method="post">
                                <div class="row">
                                    <div >
                                        <div class="form-group">
                                            <label>Your Name</label>
                                            <input type="text" name="name" class="input-text full-width">
                                        </div>
                                        <div class="form-group">
                                            <label>Your Email</label>
                                            <input type="text" name="email" class="input-text full-width">
                                        </div>
                                        <div class="form-group">
                                            <label>Subject</label>
                                            <input type="text" name="subject" class="input-text full-width">
                                        </div>
										<div class="form-group">
                                            <label>Your Message</label>
                                            <textarea name="message" rows="5" class="input-text full-width" placeholder="write message here"></textarea>
                                        </div>
										<button class="btn-medium full-width">SEND MESSAGE</button>
                                    </div>
                                   
                                </div>

                                
                            </form>
                        </div>
                    </div></div> -->
        </div>
		
		
		
  </div>
</section>

<?php $this->load->view('include/footer'); ?>