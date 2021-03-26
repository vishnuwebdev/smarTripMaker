<?php
$this->load->view('header');

  if(null !==$this->input->get('date')){
       $date = $this->input->get('date');
    }else{
        
        $date = "";
    }
    if(null !==$this->input->get('paxno') && is_numeric($this->input->get('paxno'))){
       $paxno = $this->input->get('paxno');
    }else{
        
        $paxno = 0;
    }

 ?>
<style>
    .error_msg{
    padding: 10px;
    color: red;
    font-size: 17px;
    }
    
</style>
<?php if($bookingdetail == "not"){ ?>
<h2 class="text-center pt50 pb50">Request Not Found.</h2>
<?php }else{ ?>
<div class="container-fluid tourdetailsfluid pt50 pb50 light-bg">
	<div class="container tourdetailscontainer">
    <h1 class="block fz24 black-color mb15 fwb"><?php echo $bookingdetail->holiday_name; ?>
      <span class="block fz12 mt10">
        <i class="fa fa-map-marker"></i> Location(s) &emsp; <span><?php echo $bookingdetail->holiday_city_route; ?></span>
      </span>
    
    </h1>
    <div class="row tourdetailsrow">
      <div class="col-sm-8">
        <div class="clearfix tourdetailsleftcol">
          <div role="tabpanel" class="tourglimpse">
            <ul class="nav nav-tabs" role="tablist">
              <li role="presentation" class="active">
                <a href="#tourphotos" aria-controls="tourphotos" role="tab" data-toggle="tab">Photos</a>
              </li>
             <!-- <li role="presentation">
                <a href="#tourvideo" aria-controls="tourvideo" role="tab" data-toggle="tab">Video</a>
              </li> -->
            </ul>
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane active" id="tourphotos">
                  <div id="tourDetailImgs" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <?php 
//                        print_r($Bimages);
//                        die;
                        if(!empty($Bimages)){
                        
                        foreach ($Bimages as $key=>$Bimagesss) {
                           if($key == 0){
                               $classactive = "active";
                           } else{
                             $classactive = "";  
                           }
                            ?>
                        <div class="item <?php echo $classactive; ?>">
                            <img src="<?php echo $this->dsa_data->dsa_admin_url; ?>assets/img/holiday/main/<?php echo $Bimagesss->holimg_image ?>" alt="<?php echo $Bimagesss->holimg_image ?>">
                        </div>
                        <?php } } ?>
                    </div>
                    <ol class="carousel-indicators">
                        <?php
                        if(!empty($Bimages)){
                        foreach ($Bimages as $key=>$Bimagesss) {
                           if($key == 0){
                               $classactive = "active";
                           } else{
                             $classactive = "";  
                           }
                            ?>
                      <li data-target="#tourDetailImgs" data-slide-to="<?php echo $key; ?>" class="<?php echo $classactive; ?>">
                        <img src="<?php echo $this->dsa_data->dsa_admin_url ?>assets/img/holiday/thumbs/<?php echo $Bimagesss->holimg_image ?>" alt="...">
                      </li>
                        <?php } }else{ ?>
                     
                      <h3 class="text-center">No any record found for this area.</h3>
          
          <?php } ?>
                    </ol>
                    <a href="javascript:void(0);" class="showprev pull-left"><i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i></a>
                    <a href="javascript:void(0);" class="shownext pull-right"><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a>
                    <a class="left carousel-control wow bounceInUp" href="#tourDetailImgs" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
                    <a class="right carousel-control wow bounceInUp" href="#tourDetailImgs" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
                </div>
              </div>
              <div role="tabpanel" class="tab-pane" id="tourvideo">
                <iframe class="tourvideoiframe" src="https://www.youtube.com/embed/nPOO1Coe2DI" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
              </div>
            </div>
          </div>
          <div class="resttourinfo">
            <h3 class="fz18 black-color fwb">Tour Overview</h3>
            <p class="para">
              <?php echo $bookingdetail->holiday_long_description; ?>
            </p>
            <div role="tabpanel" class="packdetailstabpanel">
              <ul class="nav nav-tabs packnavtabs" role="tablist">
                <li role="presentation" class="active">
                  <a href="#itinerary" aria-controls="itinerary" role="tab" data-toggle="tab">Itinerary</a>
                </li>
                <li role="presentation">
                  <a href="#inclusion" aria-controls="inclusion" role="tab" data-toggle="tab">Inclusions</a>
                </li>
                <li role="presentation">
                  <a href="#exclusion" aria-controls="exclusion" role="tab" data-toggle="tab">Exclusions</a>
                </li>
                <li role="presentation">
                  <a href="#termsandcond" aria-controls="termsandcond" role="tab" data-toggle="tab">Terms & Conditions</a>
                </li>
              </ul>
              <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="itinerary">
                    
                    <?php 
                    //print_r($Bitinerary);
                    //die;
                    if(!empty($Bitinerary)){
                    foreach ($Bitinerary as $Bitinerarysss){ ?>
                    <div class="itineraryday">
                      <span class="ithead"><span class="day-no">Day <?php echo $Bitinerarysss->holiti_name; ?></span> <span class="daydetails"><?php echo $Bitinerarysss->holiti_title; ?></span></span>
                      <?php echo $Bitinerarysss->holiti_detail; ?>
                    </div>
                    <?php } }else{ ?>
                   <h3 class="text-center">No any record found for this area.</h3>
          
          <?php } ?>
                </div>
                <div role="tabpanel" class="tab-pane" id="inclusion">
                  <ul class="clearfix inclusionexclusionlist">
                      <?php 
                      if(!empty($Binclusion)){
                      foreach ($Binclusion as $Binclusionsss){ ?>
                          
                          
                     
                    <li>
                      <i class="fa <?php echo $Binclusionsss->holinc_icon; ?>"></i>
                      <span><?php echo $Binclusionsss->holinc_name ?></span>
                    </li>
                    <?php  } }else{ ?>
                    <h3 class="text-center">No any record found for this area.</h3>
          
          <?php } ?>
                  </ul>
                </div>
                <div role="tabpanel" class="tab-pane" id="exclusion">
                  <ul class="clearfix inclusionexclusionlist">
                    <?php 
                    if(!empty($Bexclusion)){
                    foreach ($Bexclusion as $Bexclusionsss){ ?>
                          
                          
                     
                    <li>
                      <i class="fa <?php echo $Bexclusionsss->holexc_icon; ?>"></i>
                      <span><?php echo $Bexclusionsss->holexc_name ?></span>
                    </li>
                    <?php  } }else{ ?>
                    <h3 class="text-center">No any record found for this area.</h3>
          
          <?php } ?>
                  </ul>
                </div>
                <div role="tabpanel" class="tab-pane" id="termsandcond">
                  <p class="para">
                   <?php echo $bookingdetail->holiday_policy ?> 
                  </p>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="tourdetailsrightcol">
            <form action="<?php echo site_url(); ?>holiday/tour_passenger_details" id="formid">
                
                <?php echo validation_errors(); ?>
                <input type="hidden" name="tour_ID" value="<?php echo $bookingdetail->holiday_id; ?>">
                <input type="hidden" name="start_date" value="<?php echo $this->input->get("date"); ?>">
         
       <!--   <div class="table-responsive">          
            <table class="table table-bordered">
              <tbody>

                <tr>
                  <td class="text-left">Tour Date</td>
                  <td class="text-left">
                  <input type="text" class="input  width-100 border datepicker" placeholder="Date" name="date" readonly id="date1">
                  </td>
                </tr>
              </tbody>
            </table>
          </div> -->
         <!-- <div class="table-responsive">          
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Who</th>
                  <th>No.</th>
                  <th class="text-center">Price</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="text-left">Adults</td>
                  <td class="text-left">
                      <?php //print_r($bookingdetail->holiday_start_price);
                      //die; ?>
                      <select name="adult_no" class="form-control" required="" id="adult_no">
                                            <option value="1" selected>1</option>
                                            <?php for($i=2;$i<=50;$i++){
                                                     ?>
                                            <option <?php if($paxno == $i ){ echo "selected"; } ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                            <?php } ?>
                                            
                                        </select>
                  </td>
                  <td>  
                      <input type="hidden" id="adult_totol_price" name="adult_totol_price" value="<?php echo $bookingdetail->holiday_start_price * $paxno;?>">
                    <?php echo $this->dsa_data->dsa_currency; ?> <span id="adult_price_in"><?php echo $bookingdetail->holiday_start_price * $paxno;?></span>
                  </td>
                </tr>
                <tr>
                  <td class="text-left">Child</td>
                  <td class="text-left">
                    <select name="child_no" class="form-control"  id="child_no">
                      <option value="0">0</option>
                    
                                            <?php for($i=1;$i<=50;$i++){
                                                     ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                            <?php } ?>
                                            
                    </select>
                  </td>
                  <td>  
                  <?php echo $this->dsa_data->dsa_currency; ?> <span id="child_price_in">0</span>
                  <input type="hidden" name="child_totol_price" value="0" id="child_totol_price">
                  </td>
                </tr>
              </tbody>
            </table>
          </div> -->
          <div class="clearfix tac">
              <h2 class="main-color fwb fz24"><?php echo $this->dsa_data->dsa_currency; ?> <span id="totalpriceofall"><?php echo $bookingdetail->holiday_start_price; ?></span></h2>
            
    
              <a href="#login_signup" data-toggle="modal" class="btn btn-primary inline-block">Book now</a>

         <!--   <a href="#none" class="btn btn-default inline-block"><i class="fa fa-heart"></i> Add to wishlist</a> -->
          </div>
            </form>
        </div>
        <div class="relatedtour">
          <h3 class="black-color fwb fz18">Related Activity</h3>
          <?php
          if(!empty($Breletedpachage)){
          foreach ($Breletedpachage as $Breletedpachagess){ ?>
          <a href="<?php echo site_url() ?>activity/activitydetail/<?php echo $Breletedpachagess->holiday_slug; ?>" class="relatedtourbox">
            <div class="row">
              <div class="col-sm-3">
                <img src="<?php echo $this->dsa_data->dsa_admin_url; ?>assets/img/holiday/thumbs/<?php echo $Breletedpachagess->holiday_feature_image ?>" alt="<?php echo $Breletedpachagess->holiday_feature_image ?>">
              </div>
              <div class="col-sm-5">
                <p><?php echo $Breletedpachagess->holiday_name ?></p>
                <span class="stars">
                   <?php for($i=1;$i<=$Breletedpachagess->holiday_rating;$i++) {  ?>
				        
                        <i class="fa fa-star active"></i>
                          <?php } ?>
                        
                        <?php for($k=1;$k<=5-$Breletedpachagess->holiday_rating;$k++) {?>
                         <i class="fa fa-star"></i>
                          <?php  } ?>
                </span>
              </div>
              <div class="col-sm-4">
                <span class="fz16"><?php echo $this->dsa_data->dsa_currency; ?> <?php echo $Breletedpachagess->holiday_start_price ?></span>
              </div>
            </div>
          </a>
          <?php } }else{ ?>
          <h3 class="text-center">No any record found for this area.</h3>
          
          <?php } ?>
        </div>
      </div>
    </div>
	</div>
</div>
<?php } ?>
<div class="modal fade" id="login_signup">
    <div class="modal-dialog">
        <div class="modal-content" style="padding:30px">
            <button type="button" class="close" style="float:right;background:#fff" data-dismiss="modal" aria-hidden="true"> X</button>
            <div class="modal-body" style="margin-top:20px">
			
                 <form action="" class="loginsignupform mainsignupform">
				  <input type="hidden" id="tour_ID" name="tour_ID" value="<?php echo $bookingdetail->holiday_id; ?>">
				  
				  
                                <span class="fz18 fwb black-color block mb10">Welcome, let's get started</span>
								
								  <div  class="success_msg"></div>
                                  <div id="error_msg_reg" class="error_msg"></div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="clearfix inputgrabber mb15">
                                            <i class="fa fa-user inputicon"></i>
                                            <input type="text" id="Cust_f_name" class="input block width-100 border radius" required placeholder="First Name">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="clearfix inputgrabber mb15">
                                            <i class="fa fa-user inputicon"></i>
                                            <input type="text" id="Cust_l_name" class="input block width-100 border radius" required placeholder="Last Name">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="clearfix inputgrabber mb15">
                                            <i class="fa fa-phone inputicon"></i>
                                            <input type="text" id="Cust_mobile_no" class="input block width-100 border radius" required placeholder="Enter Mobile no.">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="clearfix inputgrabber mb15">
                                            <i class="fa fa-envelope inputicon"></i>
                                            <input type="email" id="Cust_email_reg" class="input block width-100 border radius" required placeholder="Email Address">
                                        </div>
                                    </div>
                                </div>

                                <div class="clearfix mb15">
                                    <button type="button" onclick="book_registration();" class="btn btn-success block width-100 otpformbtn"><i class="fa fa-sign-in"></i> Submit </button>
                                </div>
                                <div class="clearfix mb15 agreetotheterms">
                                    <input type="checkbox" name="" id="agreetotheterms_create"> <label for="agreetotheterms_create" class="inline-block pointer fz12 black-color vat">By proceeding, you agree with our <a href="#none">Terms of Service</a> & <a href="#none">Privacy Policy</a></label>
                                </div>
                            </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="loader"  role="dialog">
  <div class="modal-dialog">
  
    <!-- Modal content-->
    <div class="modal-content_T" style="text-align:center">
      <img src="<?php echo  $this->dsa_data->dsa_admin_url; ?>assets/images/preloader.gif" height="150" width="150" >
    </div>
    
  </div>
</div>

 <?php $this->load->view("footer"); ?>
<script type="text/javascript">
    
    $("#adult_no").change(function(){
        
        //alert($(this).val());
        $("#adult_price_in").html($(this).val()* <?php echo $bookingdetail->holiday_start_price; ?>);
        $("#adult_totol_price").val($(this).val()* <?php echo $bookingdetail->holiday_start_price; ?>);
        
        updateTotalPrice($("#adult_totol_price").val(),$("#child_totol_price").val());
    })
    
    $("#child_no").change(function(){
        
        //alert($(this).val());
        $("#child_price_in").html($(this).val()* <?php echo $bookingdetail->holiday_start_price; ?>);
        $("#child_totol_price").val($(this).val()* <?php echo $bookingdetail->holiday_start_price; ?>);
        updateTotalPrice($("#adult_totol_price").val(),$("#child_totol_price").val());
    });
    
    function updateTotalPrice(adultprice,childprice){
        
       $("#totalpriceofall").text((+adultprice) + (+childprice));
    }
    
      //logi detail section 
    function book_registration() {
	
  var cEmail = $("#Cust_email_reg").val();
  var cFname = $("#Cust_f_name").val();
  var cLname = $("#Cust_l_name").val();
  var cMobile = $("#Cust_mobile_no").val();
  var tour_ID = $("#tour_ID").val();
  
  
  if(cEmail ==""){
      $("#error_msg_reg").html("Enter Email ID");
      return false;
  }
  
  if(cFname ==""){
      $("#error_msg_reg").html("Enter First Name !");
      return false;
  }
  if(cLname ==""){
      $("#error_msg_reg").html("Enter Last Name !");
      return false;
  }
  if(cMobile ==""){
      $("#error_msg_reg").html("Enter Moble No. !");
      return false;
  }

else{
$('#loader').modal({
backdrop: 'static',
keyboard: false
});
$("#loader").modal('show');
}

  $.ajax({
      type: "POST",
      url: "<?php echo site_url(); ?>holiday/ajax_booking_query",
      data: {custEmail: cEmail,custFirstName: cFname,custLastName: cLname,custMobleNo: cMobile,tour_ID: tour_ID},
      dataType: "text",
      cache: false,
      success:
              function (data) {
                  
                  var obj = jQuery.parseJSON(data);
                  console.log(obj);
                  if (obj.status == "success") {
                      
                  $(".success_msg").html(obj.message);
                    $("#loader").modal('hide');
                  }else{
                    console.log(obj.message);  
                  $("#error_msg_reg").html(obj.message);
                 
               }
          }
   });
 
}



        
  
    </script>