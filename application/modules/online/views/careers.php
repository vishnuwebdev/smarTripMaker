   <?php $this->load->view('header');?>

   <section class="innerpage-title pt-3 pb-3">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="inner-page-title-left">
            <h1 class="mb-0">Careers</h1>
          </div>
        </div>
        <div class="col-md-6">
          <div class="inner-page-title-right text-right">
            <ul class="list-inline">
              <li class=""><a href="<?php echo site_url(); ?>">Home</a></li>
              <li class="">Careers</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>


   <section id="about-us" class="inner-page-col">
      <div class="container">
		<?php
            if ($this->session->flashdata('alert') !== NULl) {
                $bhanu_message = $this->session->flashdata('alert');
                ?>

                <div
                    class="alert alert-sm alert-border-left <?php echo $bhanu_message['class']; ?> light alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert"
                            aria-hidden="true">×</button>
                    <i class="fa fa-info pr10"></i> <strong> <?php echo $bhanu_message['message']; ?></strong>
                </div>

         <?php } ?>
	  
        
         <div class="inner-content">
           <div class="carr-col">
             <div class="row">
               <div class="col-md-10">
                 <h6 id="pro_1" class="title">Customer Care Executive (Female)</h6>
                 <div class="job-title">
                   <p><strong>Job Details :</strong> Sologo needs CCEs (Female only) for customer support (Inbound/Outbound).</p>
                   <p><a href="javascript:void(0)" data-target="#job1" data-toggle="collapse" class="btn btn-rd btn-sm btn-default" aria-expanded="true">View Full Job Details</a></p>
                 </div>

                  <div class="collapse" id="job1" aria-expanded="true" style="">
                      <p>Sologo need people who can work hardly and dedicatedly to provide satisfaction to their customers.</p>
                      <p>Interested candidates send their CV and photograph on email id – hr@sologo.in</p>
                  </div>
                  <ul class="links_bottom list-unstyled list-inline">
                    <li><i class="fa fa-map-marker icon_1"> </i><span class="icon_text"><?php echo $this->dsa_setting->dsaset_address_1.','.$this->dsa_setting->dsaset_city
                    .','.$this->dsa_setting->dsaset_state.','.$this->dsa_setting->dsaset_country.','.$this->dsa_setting->dsaset_pincode; ?> </span></li>
                    <li><i class="fa fa-venus-mars icon_1"> </i><span class="icon_text"> More Than 6 Month(Inbound/Outbound) </span></li>
                    <li><i class="fa fa-money icon_1"> </i><span class="icon_text">Rs. 8000 to Rs. 12000</span></li>
                    <li class="last"><i class="fa fa-male icon_1"> </i><span class="icon_text">Female</span></li>
                </ul>
               </div>
               <div class="col-md-2">
                 <div class="apply-btn">
                   <a href="#applynow" data-toggle="modal" class="btn search-btn">Apply Now</a>
                 </div>
               </div>
             </div>
           </div>

           <div class="carr-col">
             <div class="row">
               <div class="col-md-10">
                 <h6 id="pro_1" class="title">Tellecaller (Female)</h6>
                 <div class="job-title">
                   <p><strong>Job Details :</strong> Sologo needs TCE’s (Female only) to provide updates to Channel Partners, to take feedback and follow ups(Inbound/Outbound).</p>
                   <p><a href="javascript:void(0)" data-target="#job2" data-toggle="collapse" class="btn btn-rd btn-sm btn-default" aria-expanded="true">View Full Job Details</a></p>
                  </div>

                  <div class="collapse" id="job2" aria-expanded="true" style="">
                      <p>Sologoneed people who can work hardly and dedicatedly to provide satisfaction to their customers.</p>
                      <p>Interested candidates send their CV and photograph on email id – hr@sologo.in</p>
                  </div>
                  <ul class="links_bottom list-unstyled list-inline">
                    <li><i class="fa fa-map-marker icon_1"> </i><span class="icon_text"> <?php echo $this->dsa_setting->dsaset_address_1.','.$this->dsa_setting->dsaset_city
                    .','.$this->dsa_setting->dsaset_state.','.$this->dsa_setting->dsaset_country.','.$this->dsa_setting->dsaset_pincode; ?> </span></li>
                    <li><i class="fa fa-venus-mars icon_1"> </i><span class="icon_text">More Than 6 Month (Inbound/Outbound) </span></li>
                    <li><i class="fa fa-money icon_1"> </i><span class="icon_text">Rs. 8000 to Rs. 12000</span></li>
                    <li class="last"><i class="fa fa-male icon_1"> </i><span class="icon_text">Female</span></li>
                </ul>
               </div>
               <div class="col-md-2">
                 <div class="apply-btn">
                   <a href="#applynow" data-toggle="modal" class="btn search-btn">Apply Now</a>
                 </div>
               </div>
             </div>
           </div>
		   
		    <div class="carr-col">
             <div class="row">
               <div class="col-md-10">
                 <h6 id="pro_1" class="title">Sales – Territory Sales Manager (Male)</h6>
                 <div class="job-title">
                   <p><strong>Job Details :</strong> Sologo.in requires young enthusiastic, dynamic and experienced TSMs to appoint channel partners in PAN India. </p>
                   <p><a href="javascript:void(0)" data-target="#job3" data-toggle="collapse" class="btn btn-rd btn-sm btn-default" aria-expanded="true">View Full Job Details</a></p>
                 </div>

                  <div class="collapse" id="job3" aria-expanded="true" style="">
                      <p>Sologo bound to provide satisfaction to their customers. So, we need dedicated smart sales person who can work according to company plan and able to meet goal of the company.</p>
                      <p>Interested candidates send their CV and photograph on email id – hr@sologo.in</p>
                  </div>
                  <ul class="links_bottom list-unstyled list-inline">
                    <li><i class="fa fa-map-marker icon_1"> </i><span class="icon_text"><?php echo $this->dsa_setting->dsaset_address_1.','.$this->dsa_setting->dsaset_city
                    .','.$this->dsa_setting->dsaset_state.','.$this->dsa_setting->dsaset_country.','.$this->dsa_setting->dsaset_pincode; ?></span></li>
                    <li><i class="fa fa-venus-mars icon_1"> </i><span class="icon_text">2 years – 3 years </span></li>
                    <li><i class="fa fa-money icon_1"> </i><span class="icon_text">Rs. 15000 to Rs. 25000</span></li>
                    <li class="last"><i class="fa fa-male icon_1"> </i><span class="icon_text">Male</span></li>
                </ul>
               </div>
               <div class="col-md-2">
                 <div class="apply-btn">
                   <a href="#applynow" data-toggle="modal" class="btn search-btn">Apply Now</a>
                 </div>
               </div>
             </div>
           </div>
		   
		    <div class="carr-col">
             <div class="row">
               <div class="col-md-10">
                 <h6 id="pro_1" class="title">Sales – Area Sales Manager (Male)</h6>
                 <div class="job-title">
                   <p><strong>Job Details :</strong> Sologo requires young enthusiastic, dynamic and experienced ASMs to appoint channel partners in PAN India </p>
                   <p><a href="javascript:void(0)" data-target="#job4" data-toggle="collapse" class="btn btn-rd btn-sm btn-default" aria-expanded="true">View Full Job Details</a></p>
                 </div>

                  <div class="collapse" id="job4" aria-expanded="true" style="">
                      <p>Sologo bound to provide satisfaction to their customers. So, we need dedicated smart sales person who can work according to company plan and able to meet goal of the company.</p>
                      <p>Interested candidates send their CV and photograph on email id – hr@sologo.in</p>
                  </div>
                  <ul class="links_bottom list-unstyled list-inline">
                    <li><i class="fa fa-map-marker icon_1"> </i><span class="icon_text"><?php echo $this->dsa_setting->dsaset_address_1.','.$this->dsa_setting->dsaset_city
                    .','.$this->dsa_setting->dsaset_state.','.$this->dsa_setting->dsaset_country.','.$this->dsa_setting->dsaset_pincode; ?></span></li>
                    <li><i class="fa fa-venus-mars icon_1"> </i><span class="icon_text">3 years – 5 years </span></li>
                    <li><i class="fa fa-money icon_1"> </i><span class="icon_text">Rs. 25000 to Rs. 40000</span></li>
                    <li class="last"><i class="fa fa-male icon_1"> </i><span class="icon_text">Male</span></li>
                </ul>
               </div>
               <div class="col-md-2">
                 <div class="apply-btn">
                   <a href="#applynow" data-toggle="modal" class="btn search-btn">Apply Now</a>
                 </div>
               </div>
             </div>
           </div>
		   
		   
		   <div class="carr-col">
             <div class="row">
               <div class="col-md-10">
                 <h6 id="pro_1" class="title">Sales – State Head Sales Manager (Male)</h6>
                 <div class="job-title">
                   <p><strong>Job Details :</strong> Sologo requires young enthusiastic, dynamic and experienced ASMs to appoint channel partners in PAN India </p>
                   <p><a href="javascript:void(0)" data-target="#job5" data-toggle="collapse" class="btn btn-rd btn-sm btn-default" aria-expanded="true">View Full Job Details</a></p>
                 </div>

                  <div class="collapse" id="job5" aria-expanded="true" style="">
                      <p>Sologo bound to provide satisfaction to their customers. So, we need dedicated smart sales person who can work according to company plan and able to meet goal of the company.</p>
                      <p>Interested candidates send their CV and photograph on email id – hr@sologo.in</p>
                  </div>
                  <ul class="links_bottom list-unstyled list-inline">
                    <li><i class="fa fa-map-marker icon_1"> </i><span class="icon_text"><?php echo $this->dsa_setting->dsaset_address_1.','.$this->dsa_setting->dsaset_city
                    .','.$this->dsa_setting->dsaset_state.','.$this->dsa_setting->dsaset_country.','.$this->dsa_setting->dsaset_pincode; ?></span></li>
                    <li><i class="fa fa-venus-mars icon_1"> </i><span class="icon_text">5 years – 8 years </span></li>
                    <li><i class="fa fa-money icon_1"> </i><span class="icon_text">Rs. 40000 to Rs. 60000</span></li>
                    <li class="last"><i class="fa fa-male icon_1"> </i><span class="icon_text">Male</span></li>
                </ul>
               </div>
               <div class="col-md-2">
                 <div class="apply-btn">
                   <a href="#applynow" data-toggle="modal" class="btn search-btn">Apply Now</a>
                 </div>
               </div>
             </div>
           </div>
		   
		   
         </div>
       </div>
   </section>


   <div class="modal fade" id="applynow" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title text-center">Apply Now</h4>
        </div>
	<form method="post" action="<?php echo site_url(); ?>careers" enctype="multipart/form-data" >
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <input type="text" name="first_name" id="first-name" class="form-control" required="required" placeholder="First Name">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <input type="text" name="last_name" id="last-name" class="form-control" required="required" placeholder="Last Name">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <input type="email" name="email" id="email" class="form-control" required="required" placeholder="Email Address">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <input type="text" name="mob" id="mob" class="form-control" required="required" placeholder="Mobile No.">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <input type="text" name="age" id="age" class="form-control" required="required" placeholder="Age">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <select name="gender" id="gender" class="form-control" required="required">
                  <option value="">Choose what you are?</option>
                  <option value="male">Male</option>
                  <option value="female">Female</option>
                  <option value="other">Other</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <input type="text" name="pincode" id="pincode" class="form-control" required="required" placeholder="Pincode">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <input type="text" name="experience" id="work-experience" class="form-control" required="required" placeholder="Work Experience (in years)">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <input type="text" name="current_salary" id="current-salary" class="form-control" required="required" placeholder="Current Salary">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <input type="text" name="notice_per" id="notice-per" class="form-control" required="required" placeholder="Notice Period (in months)">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <textarea name="current_address" id="current-address" class="form-control" rows="3" placeholder="Current Address" required="required"></textarea>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <span>Upload Your Resume (Max file size 1MB and only PDF)</span>
                <input type="file" name="userfile" id="resume" class="form-control" required="required" pattern="" title="">
              </div>
            </div>
             <div class="col-md-12">
                <div class="form-group">
                  <input type="text" name="sales" id="sales" placeholder="Job Title" class="form-control" value="" required="required"  title="">
                </div>
              </div>
          </div>
		
		  
        </div>
        <div class="modal-footer text-center">
          <button type="submit" id="sub-car" class="btn search-btn ">Submit... </button>
          <button type="button" class="btn search-btn" data-dismiss="modal" style="float: none;
    background: #ff2929;
    border-color: #ff2929;">Close</button>
        </div>
	  </form>
      </div>
      
    </div>
  </div>
   <?php $this->load->view("footer");?>