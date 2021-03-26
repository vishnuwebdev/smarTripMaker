<?php $this->load->view('include/head') ?>
<?php $this->load->view('include/header')?>



<?php if($bookingdetail == "not"){ ?>

  <h2 class="text-center pt50 pb50">Request Not Found.</h2>

<?php }else{ ?>

  <div class="main-field pt-2 pb-2 pt-md-4 pb-md-4">
    <div class="container">
      <div class="flght-booking-details hotl-booking-wrap hldy-details-wrap">
        <div class="row">
          <div class="col-lg-8 col-md-8 col-sm-12">
            <div class="hotl-booking-temp">
              <!-- Hotel Title here -->
              <h3 class="title-htl"><?php echo $bookingdetail->holiday_name; ?></h3>
              <!-- Hotel Title end here -->
              <!-- slider here -->
              <div class="hotel-carousel owl-carousel">

               <?php
               if(!empty($Bimages)){
                foreach ($Bimages as $key=>$Bimagesss) {
                  if($key == 0){
                    $classactive = "active";
                  } else{

                   $classactive = "";  
                 }
                 ?>
                 <div class="item">
                  <a data-fancybox="gallery" href="<?php echo site_url(); ?>admin/assets/img/holiday/main/<?php echo $Bimagesss->holimg_image ?>">
                    <img src="<?php echo site_url(); ?>admin/assets/img/holiday/main/<?php echo $Bimagesss->holimg_image ?>" alt="htl-01">
                  </a>
                </div>
              <?php } } else{ ?>
                <div class="item">
                  <a data-fancybox="gallery" href="<?php echo site_url(); ?>admin/assets/img/holiday/main/<?php echo $bookingdetail->holiday_feature_image ?>">
                    <img src="<?php echo site_url(); ?>admin/assets/img/holiday/main/<?php echo $bookingdetail->holiday_feature_image ?>" alt="htl-01">
                  </a>
                </div>
              <?php }  ?>

            </div>
            <!-- slider end here -->

          </div>
          <div class="col-md-12">
            <div class="hldy-tour-desc mt-2 mt-md-3">
              <h3 class="htl-title">Tour Overview</h3>
              <p><?php echo $bookingdetail->holiday_long_description; ?></p>
            </div>
          </div> 
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">

          <div class="htl-side-booking-add mb-2 mb-md-4">
           <h3>We Offer Lowest Price Guarantee</h3>
           <div class="hldy-dts-prc text-center p-2 p-md-3">
            <span class="d-block mb-2"><span class="strt-frm">Starting From </span><i class="icofont-rupee"></i> <span class="hld-prc"><?php echo $bookingdetail->holiday_start_price ?></span></span>
            <a href="#book-hldy-pass" data-toggle="modal" class="btn btn-search">Book </a>
          </div>
        </div>

        <!-- Related Tour -->
        <div class="related-tour">
          <h5 class="text-center">Related Tours</h5>
          <ul class="list-unstyled">
           <?php
           if(!empty($Breletedpachage)){
             foreach ($Breletedpachage as $Breletedpachagess){ ?>

              <li>
                <div class="related-tour-com">
                  <div class="relt-img">
                    <a href="<?php echo site_url() ?>holiday/holidaydetail/<?php echo $Breletedpachagess->holiday_slug; ?>">
                      <img src="<?php echo site_url(); ?>admin/assets/img/holiday/thumbs/<?php echo $Breletedpachagess->holiday_feature_image ?>" alt="">
                    </a>
                    <span class="prc-paul"><i class="icofont-rupee"></i> <?php echo $Breletedpachagess->holiday_start_price; ?></span>
                    <h5><?php echo $Breletedpachagess->holiday_name ?></h5>
                  </div>
                </div>
              </li>
            <?php } }else{ ?>
              <p class="text-center">No any record found for this area.</p>	
            <?php } ?>

			  <!--
                <li>
                  <div class="related-tour-com">
                    <div class="relt-img">
                      <a href="javascript:void(0)">
                        <img src="assets/images/orlando.jpg" alt="">
                      </a>
                      <span class="prc-paul"><i class="icofont-rupee"></i> 1500</span>
                      <h5>Scenic Kashmir & Shikara Ride</h5>
                    </div>
                  </div>
                </li>
              -->
            </ul>
          </div>
          <!-- Related Tour End -->
        </div>



        <div class="col-md-12">
          <div class="hotelBox-booking mt-2 mt-md-3">
           <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" data-toggle="tab" href="#itinerary">
                <i class="icofont-map-pins"></i> Itinerary
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#inclusions">
                <i class="icofont-info"></i> Inclusions
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#exclusions">
                <i class="icofont-ban"></i> Exclusions
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#calcell-polici">
                <i class="icofont-close-line"></i> Cancellation Policies
              </a>
            </li>
          </ul>

          <!-- Tab panes -->
          <div class="tab-content">
            <div id="itinerary" class="tab-pane active">
              <?php
              if(!empty($Bitinerary)){
                foreach ($Bitinerary as $Bitinerarysss){ ?>

                  <div class="hldy-content pt-2 pt-md-3">

                    <span class="ithead"><span class="day-no">Day <?php echo $Bitinerarysss->holiti_name; ?></span> <span class="daydetails"><?php echo $Bitinerarysss->holiti_title; ?></span></span>
                    <p>  <?php echo $Bitinerarysss->holiti_detail; ?></p>
                    
                  </div>
                <?php } }else{ ?>
                 <p class="text-center">No any record found for this area.</p>
               <?php } ?>
             </div>

             <div id="inclusions" class="tab-pane fade">					
              <div class="hldy-content pt-2 pt-md-3">
                <ul class="list">
                 <?php 
                 if(!empty($Binclusion)){
                  foreach ($Binclusion as $Binclusionsss){ ?> 
                   <li>
                    <i class="fa <?php echo $Binclusionsss->holinc_icon; ?>"></i>
                    <span><?php echo $Binclusionsss->holinc_name ?></span>
                  </li>
                <?php  } }else{ ?>
                  <li>No any record found for this area.</li>
                <?php } ?>
              </ul>

            </div>

          </div>

          <div id="exclusions" class="tab-pane fade">					

            <div class="hldy-content pt-2 pt-md-3">
              <ul class="list">
               <?php 
               if(!empty($Bexclusion)){
                foreach ($Bexclusion as $Bexclusionsss){ ?>						  
                  <li><i class="fa <?php echo $Bexclusionsss->holexc_icon; ?>"></i>
                    <span><?php echo $Bexclusionsss->holexc_name ?></span>
                  </li>

                <?php  } }else{ ?>
                 <li>No any record found for this area.</li> 
               <?php } ?>
             </ul>
           </div>

         </div>
         <div id="calcell-polici" class="tab-pane fade">
          <div class="hldy-content pt-2 pt-md-3">
            <p>  <?php echo $bookingdetail->holiday_policy ?> </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>



<!-- Fare breakup  -->
<div class="modal fade" id="book-hldy-pass">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title fwb">Welcome, let's get started</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="book-hldy-col">
          <form action="" name="holiday-details">
            <input type="hidden" id="tour_ID" name="tour_ID" value="<?php echo $bookingdetail->holiday_id; ?>">
            <div class="success_msg text-center" style="color:green"></div>
            <div id="error_msg_reg" class="error_msg" style="color:red"></div>                
            <div class="row">
              <div class="col-md-6">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="icofont-ui-user"></i>
                    </span>
                  </div>
                  <input type="text" name="first-name" id="Cust_f_name" class="form-control"  placeholder="Enter First Name" required="">
                </div>
              </div>
              <div class="col-md-6">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="icofont-ui-user"></i>
                    </span>
                  </div>
                  <input type="text" name="last-name" id="Cust_l_name" class="form-control" placeholder="Enter Last Name" required="">
                </div>
              </div>
              <div class="col-md-6">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="icofont-smart-phone"></i>
                    </span>
                  </div>
                  <input type="text" name="mob-no" id="Cust_mobile_no" class="form-control" placeholder="Enter Mobile No.">
                </div>
              </div>
              <div class="col-md-6">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="icofont-envelope-open"></i>
                    </span>
                  </div>
                  <?php if ($this->session->userdata ( 'Userlogin' ) != NULL) {?>
                   <input type="email" name="email" id="Cust_email_reg" class="form-control" placeholder="Enter Email Id" value="<?php echo $this->session->userdata ( 'Userlogin' ) ['userData']->cust_email?>">
                 <?php } else {?>
                  <input type="email" name="email" id="Cust_email_reg" class="form-control" placeholder="Enter Email Id">
                <?php }?>

              </div>
            </div>
            <div class="col-md-6">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="icofont-ui-calendar"></i>
                  </span>
                </div>
                <input type="text" id="datepicker" name="departure-date"  class="form-control" placeholder="Departure Date">
              </div>
            </div>
            <div class="col-md-6">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="icofont-ui-user"></i>
                  </span>
                </div>
                <input type="number" name="total_members" id="member" class="form-control" placeholder="Total Number of Members">
              </div>
            </div>
            <div class="col-md-12">
              <label>Enter Captcha Code Below*</label>
              <p id="captImg"><?php echo $captchaImg; ?></p>
              <p>Can't read the image? click <a href="<?php echo site_url("career");?>" class="refreshCaptcha">here</a> to refresh.</p>
              <input type="text" name="captcha" class="form-control" value="" data-msg-required="Please enter captcha code." required=""/> <br>
            </div>

            <div class="col-md-12">
              <button type="button" onclick="book_registration();" class="btn btn-search">Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>


<div class="modal fade" id="query_submit">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title fwb">Thank You</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body py-5 text-center">
        <div class="book-hldy-col">
         "Thank You for your Query our team will contact you shortly."                   

       </div>

     </div>
   </div>
 </div>
</div>

<?php } ?>

<?php $this->load->view('include/footer') ?>
<script>

  $( "#datepicker" ).datepicker({
   minDate: new Date(),

 });

</script>
<script type="text/javascript">



  function book_registration() {	

    var cFname = $("#Cust_f_name").val();
    var cLname = $("#Cust_l_name").val();
    var cMobile = $("#Cust_mobile_no").val();
    var cEmail = $("#Cust_email_reg").val();           
    var tour_ID = $("#tour_ID").val(); 
    var datepicker = $("#datepicker").val();
    var member = $("#member").val();
    var captcha = $("input[name=captcha]").val();


    if(cFname ==""){
      $("#error_msg_reg").html("Enter First Name !");
      return false;
    }

    if(cLname ==""){
      $("#error_msg_reg").html("Enter Last Name !");
      return false;
    }
    if(cMobile ==""){

      $("#error_msg_reg").html("Enter Mobile No. !");
      return false;
    } 

    if(cEmail ==""){
      $("#error_msg_reg").html("Enter Email ID");
      return false;
    }

    if(datepicker ==""){
      $("#error_msg_reg").html("Enter Date !");
      return false;
    }

    if(member ==""){
      $("#error_msg_reg").html("Enter Member Number !");
      return false;
    }
    
    if(captcha ==""){
      $("#error_msg_reg").html("Enter Captcha Code !");
      return false;
    }
    

    $.ajax({
      type: "POST",
      url: "<?php echo site_url(); ?>holiday/ajax_booking_query",
      data: {custEmail: cEmail,custFirstName: cFname,custLastName: cLname,custMobleNo: cMobile,tour_ID: tour_ID,cDate:datepicker,cMember:member,Ccaptcha:captcha},
      dataType: "text",
      cache: false,
      success:
      function (data) {
        var obj = jQuery.parseJSON(data);
        console.log(obj);
        if (obj.status == "success") {                         

         $("#query_submit").modal("show");
         $("#book-hldy-pass").modal("hide");

                           // $(".success_msg").html(obj.message);
                           // $("#error_msg_reg").css('display', 'none'); 
						 // $('.book_btn').prop('onclick',null).off('click');							

            }else{
             console.log(obj.message);  

             $("#error_msg_reg").html(obj.message);                          

           }
         }

       });



  }

</script>
