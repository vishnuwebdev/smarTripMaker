<?php $this->load->view('commenLayout/head');?>
<?php $this->load->view('commenLayout/header');?>
<div class="container-fluid search-fluid">
    <div class="container absolute-container">
        <div class="mainsearchengine clearfix">
           <div role="tabpanel">
               <?php 
               $data['bp_selected_menu']="hotel";
               $this->load->view("search_menu",$data);
               ?>
            <div class="clearfix"></div>
            <div class="tab-content">
                               
              <div role="tabpanel" class="tab-pane active">
                   <div class="searchengine clearfix">
                  <div class="row">
                    <div class="col-sm-4">
                        <div class="clearfix forminputgrabber">
                            <i class="fa fa-map-marker forminputicon"></i>
                            <input type="text" class="input block width-100 border" placeholder="Select City, Location or Hotel Name (Worldwide)">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="clearfix forminputgrabber">
                            <label for="ht-date1" class="fa fa-calendar forminputicon"></label>
                            <input type="text" class="input block width-100 border hidden-xs" placeholder="Check-in" id="checkin_date" name="checkin_date" readonly required="">
                             <input type="text" class="input block width-100 border hidden xs-show" placeholder="Check-In" id="checkin_date_on_mobile" name="checkin_date" readonly required="">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="clearfix forminputgrabber">
                            <label for="ht-date2" class="fa fa-calendar forminputicon"></label>
                            <input type="text" class="input block width-100 border return-background hidden-xs" id="checkout_date" name="checkout_date" placeholder="Check-Out" readonly required="">
                             <input type="text" class="input block width-100 border return-background hidden xs-show" id="checkout_date_on_mobile" name="checkout_date" placeholder="Check-Out" readonly required="">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="clearfix hotelguests searchenginehotelguests">
                                <select class="select block width-100 border bp_room_select" name="room" required="">
                                    <option value="1">1 Room</option>
                                    <option value="2">2 Rooms</option>
                                    <option value="3">3 Rooms</option>
                                    <option value="4">4 Rooms</option>
                                </select>
                            <div class="hotelguestsdetails">
                                <div class="roombox clearfix">
                                    <span class="block fz16 fwb black-color">Room 1:</span>
                                    <div class="roomchildbox clearfix pt15 border-top">
                                           <div class="row mt15">
                                            <div class="col-sm-6">
                                                <span class="block mb10 black-color fz12">Adult's</span>
                                                <select name="" id="" class="block width-100 border radius">
                                                    <option value="1">1 Adult</option>
                                                    <option value="2">2 Adults</option>
                                                    <option value="3">3 Adults</option>
                                                    <option value="4">4 Adults</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-6">
                                                <span class="block mb10 black-color fz12">Child</span>
                                                <select name="" id="" class="block width-100 border radius">
                                                    <option value="1">1 Child</option>
                                                    <option value="2">2 Childs</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="row mt15">
                                            <div class="col-sm-6">
                                                <span class="block mb10 black-color fz12">Child 1 Age</span>
                                                <select name="" id="" class="block width-100 border radius">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                    <option value="7">7</option>
                                                    <option value="8">8</option>
                                                    <option value="9">9</option>
                                                    <option value="10">10</option>
                                                    <option value="11">11</option>
                                                    <option value="12">12</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-6">
                                                <span class="block mb10 black-color fz12">Child 2 Age</span>
                                                <select name="" id="" class="block width-100 border radius">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                    <option value="7">7</option>
                                                    <option value="8">8</option>
                                                    <option value="9">9</option>
                                                    <option value="10">10</option>
                                                    <option value="11">11</option>
                                                    <option value="12">12</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="clearfix">
						<button type="button" id="search_hotel" class="btn btn-primary block pull-right w-100"><i class="fa fa-search"></i> Search Hotel</button>
                            <!--<a href="hotel-result.php" class="btn btn-primary block"><i class="fa fa-search"></i> Search Hotels</a>-->
                        </div>
                    </div>
                  </div>
                </div> 
              </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    <div class="hidden-xs">
        <div id="main-slider" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#main-slider" data-slide-to="0" class="active"></li>
                <li data-target="#main-slider" data-slide-to="1" class=""></li>
                <li data-target="#main-slider" data-slide-to="2" class=""></li>
                <li data-target="#main-slider" data-slide-to="3" class=""></li>
            </ol>
            <div class="carousel-inner">

                 <?php

    if($sliderimg != "0"){ 
         foreach ($sliderimg as $key => $sliderimgvalue) {
              # code...
          ?>

   <div class="item  <?php  if($key == 0){ echo "active"; } ?>">
                    <img src="<?php echo $this->dsa_data->dsa_admin_url; ?>assets/img/slider/main/<?php  echo $sliderimgvalue->sliimg_image; ?>" alt="<?php  echo $sliderimgvalue->sliimg_alt; ?>">
                   
                </div>
           

            <?php } } else{
                ?>
              <div class="item active">
                    <img src="<?php echo site_url();?>assets/images/slide2.jpg" alt="slide2.jpg">
                   
                </div>

                <?php  } ?>
             
            </div>
             <?php

    if($sliderimg != "0" && count($sliderimg) > 1){ 
         ?>
            <a class="left carousel-control wow bounceInUp" href="#main-slider" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
            <a class="right carousel-control wow bounceInUp" href="#main-slider" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
            <?php } ?>
        </div>
    </div>
</div>

<div class="container-fluid main-bg whychooseusfluid">
    <div class="container">
        <h1 class="mainheading">Why Choose Us <small>We value your dreams</small></h1>
        <div class="row whychooseusrow">
            <div class="col-sm-3">
                <div class="clearfix whybox">
                    <i class="fa fa-globe"></i>
                    <h3>Wide Variety Of Destinations</h3>
                    <p>With <?php echo $this->user_data->agent_company_name; ?>, you’ll find a perfect destination among hundreds available.</p>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="clearfix whybox">
                    <i class="fa fa-thumbs-up"></i>
                    <h3>Highly Qualified Service</h3>
                    <p>Our high level of service is officially recognized by thousands of clients.</p>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="clearfix whybox">
                    <i class="fa fa-clock-o"></i>
                    <h3>24/7 Support</h3>
                    <p>Our travel agents are always there to support you during your trip.</p>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="clearfix whybox">
                    <i class="fa fa-money"></i>
                    <h3>Best Price Guarantee</h3>
                    <p>We guarantee you’ll get top-notch comfort at an affordable price.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid main-bg newsletterfluid">
    <div class="container">
        <h3 class="fz24 white-color tac mt0">Newsletter Sign Up 
            <small class="block mt15 fz14 white-color">Want to keep up to date with all our latest news and offers?</small>
            <small  class="block mt5 fz14 white-color">Enter your email address below to be added to our mailing list.</small>
        </h3>
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <form class="mt15">
                  <div class="input-group">
                    <input type="email" class="form-control input" placeholder="Enter Your Email Address" required>
                    <div class="input-group-btn">
                      <button style="height:44px !important;" class="btn btn-primary" type="submit">Subscribe</button>
                    </div>
                  </div>
                </form>
            </div>
        </div>
    </div>
</div>
 <style>
  #confirmprice div.modal-header {
      background-color: rgb(42, 45, 148);
      color:white !important;
      text-align: center;
      
  }
  #confirmprice div.modal-footer {
      background-color: rgb(42, 45, 148);
  }
  
  .clearfix {
    display: inherit;
}
  .waiting-loader {
    width: 100%;
    max-width: 50px;
    max-height: 200px;
    display: block;
    margin: 15px auto;
}
  </style>

 
  <div class="modal fade" id="searchingpopup" role="dialog" style="background: #0006;">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
      <!--
        <div class="modal-header" style="">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4><span class="glyphicon glyphicon-lock"></span> Please Wait</h4>
        </div> -->
        
        <div class="modal-body" style="padding:15px ;">
         <div class="text-align-center" style="color:#000">
             <img style="width:100%;"  src="https://booking.dofyrooms.com/assets/images/loading.gif">
             
             <h3 style="font-size: 18px;">We are searching the best flights for you</h3>
          <h3 class="clearfix" style="font-size: 19px;
    font-weight: bold;">
          <span class="oneway_m">
           <span class="from_location_m">
              DEL
            </span>
            <i class="fa fa-long-arrow-right"></i>
            <span class="to_location_m">
              BOM
            </span>
          </span>
          
          <span class="return_m">
            <span class="from_location_m" >
              DEL
            </span>
            <i class="fa fa-exchange"></i>
            <span class="to_location_m">
              BOM
            </span>
        </span>
            
          </h3>
        
          <h4 class="clearfix">
            <span class=" ">
            <span class="oneway_m_d">
              Depart <span class="depart_date_m"> 20-02-2018 </span>
            </span>
         </span>
            &emsp;
        <span class="return_m_d">
            <span class="">
              Return <span class="return_date_m">22-02-2018</span>
            </span>
        </span>
        
          </h4>
          <h4 class="clearfix">
            <span>
             <span class="num_adult">
              1 </span> Adult(s)
            </span>
            <span>
            <span class="num_child">
              0 </span> Child(s)
            </span>
            <span>
            <span class="num_infant">
              0 </span> Infant(s)
            </span>
          </h4>
          <span class="block midfz">Do not refresh or close the Window</span>
             
             
             
             
              </div>
        </div>
        
      </div>
      
    </div>
  </div> 
<?php $this->load->view('commenLayout/footer');?>
<?php $this->load->view('b2b/js');?>
<script src="<?php echo site_url(); ?>assets/js/autocom.js"></script>
<script>
  $(".searchengineguestinfo").click(function(){
    $(".hotelguestsdetails").show();
});
</script>
<script>
$("#bp_room_select").change(function (){
	 $(".hotelguestsdetails").show();
	var bp_no_rooms = this.value;
	var bp_room_data = "";
	for(var i = 1; i <= bp_no_rooms; i++){
	 pxcre += '<p class="rm1">room '+i+'</p>\<div class="col-md-6">\
				<label for="spinner8">Adult</label>\
				<select name="adult_'+i+'" id="adult_'+i+'" class="form-control cush1 adts ">\
				<option value="1">1</option>\
				<option value="2">2</option>\
				<option value="3">3</option>\
				<option value="4">4</option>\
			  </select>\</div>\<div class="col-md-6">\
				<label for="spinner8">Children</label>\
				<select  name="child_'+i+'" id="child_'+i+'"  class="form-control cush1 adts"  onchange="return setChild(this.value,'+i+');">\<option value="">Children</option>\<option value="1">01</option>\
					  <option value="2">02</option>\ </select>\
			</div>\<div id="ageSec_'+i+'"> </div>';	
	  bp_room_data += '<p class="rm1">room '+i+'</p>\<div class="col-md-6">\
		<label for="spinner8">Adult</label>\
		<select name="adult_'+i+'" id="adult_'+i+'" class="form-control cush1 adts ">\
		<option value="1">1</option>\
		<option value="2">2</option>\
		<option value="3">3</option>\
		<option value="4">4</option>\
	  </select>\</div>\<div class="col-md-6">\
		<label for="spinner8">Children</label>\
		<select  name="child_'+i+'" id="child_'+i+'"  class="form-control cush1 adts"  onchange="return setChild(this.value,'+i+');">\<option value="">Children</option>\<option value="1">01</option>\
			  <option value="2">02</option>\ </select>\
	</div>\<div id="ageSec_'+i+'"> </div>';	 	
	
		}
	$(".paxsec").html(pxcre);
	
	});
});
</script>