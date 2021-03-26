
<?php $this->load->view('header');?>
<?php

if ($this->session->userdata('Userlogin') != NULL) {
    $loginuser = $this->session->userdata('Userlogin')['userData'];
} else {
    $loginuser = array();
}
$bp_pax_request = $_SESSION ['hotel'] ['array'] ['search_request'] ['RoomGuests'];
// PrintArray($_SESSION ['hotel'] ['array'] ['hotel_info_result']);
$bp_hotel_result = $_SESSION['Hotel_Offline'] ['array'];
$bp_room_detail = $room_details;
$bp_hotel_detail = $hotel_details;
$bp_rooms = $bp_hotel_result['room'] ;
$bp_nights = $bp_hotel_result['nights'] ;
$bp_adults = $bp_hotel_result['adult_1'];
$no_adult = 0;
$no_child = 0;
for($i = 1; $i <= $bp_rooms; $i ++) {
				$data ["adult_" . $i] = $bp_hotel_result['adult_' . $i];
				$no_adult =  $no_adult + $bp_hotel_result['adult_' . $i];
				$data ["child_" . $i] = $bp_hotel_result['child_' . $i];
				$no_child =  $no_child + $bp_hotel_result['child_' . $i];
}

			$_SESSION ['Hotel']['No_Of_Adults'] = $no_adult;
			$_SESSION ['Hotel']['No_Of_child'] = $no_child;
			
			
$bp_customer_price = $bp_room_detail[0]->hoffr_publish_price;
$bp_total_customer_fare = $bp_customer_price * $bp_rooms * $bp_nights;
$bp_base_fare = $bp_room_detail[0]->hoffr_basic_fare * $bp_rooms * $bp_nights;
$bp_tax = $bp_room_detail[0]->hoffr_tax * $bp_rooms * $bp_nights;

$_SESSION ['hotel'] ['array'] ['hotel_detail']=$bp_hotel_detail;
$_SESSION ['hotel'] ['amount'] ['room_detail']=$bp_room_detail;
$_SESSION ['hotel'] ['amount'] ['customer_fare']=$bp_total_customer_fare ;
$_SESSION ['hotel'] ['amount'] ['base_fare']=$bp_base_fare;
$_SESSION ['hotel'] ['amount'] ['tax']=$bp_tax;
//PrintArray ( $this->url );
?>




<div class="main-field">
     <div class="container">
       <div class="row">
         <div class="col-lg-9 col-md-9 col-sm-12">
           <div class="flght-booking-details">

             <!-- Traveller Details -->
             <div class="col-fly-com">
               <h3 class="review-title">Review Your Booking</h3>
               <div class="col-fly-inn">
                  <div class="reviewhtl-booking">
                    <div class="row">
                      <div class="col-sm-12 col-md-12 mb-10">
                        <div class="rvw-bookur">
                          <span><strong><i class="icofont-hotel"></i>  Hotel :</strong></span>
						              <?php echo($bp_hotel_detail[0]->hofl_hotel_name) ?> 
                          </div>
                        </div>
                      <div class="col-sm-12 col-md-12 mb-10">
                        <div class="rvw-bookur">
                          <span><strong><i class="icofont-google-map"></i>  Address  :</strong></span>
						              <?php echo $bp_hotel_detail[0]->hofl_address;?>, <?php echo $bp_hotel_detail[0]->hofl_city;?>, <?php echo $bp_hotel_detail[0]->hofl_state;?>, <?php echo $bp_hotel_detail[0]->hofl_country;?>, <?php echo $bp_hotel_detail[0]->hofl_pincode;?>
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-6 mb-10">
                        <div class="rvw-bookur">
                          <span><strong><i class="icofont-ui-calendar"></i> Check-in</strong></span>
                          <span class="rvw-dt"><?php echo date_format(date_create($bp_hotel_result['checkIn']),"D, d M Y");?></span>
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-6 mb-10">
                        <div class="rvw-bookur">
                          <span><strong><i class="icofont-ui-calendar"></i> Check-out</strong></span>
                          <span class="rvw-dt"><?php echo date_format(date_create($bp_hotel_result['checkOut']),"D, d M Y");?></span>
                        </div>
                      </div>
                      <div class="col-sm-12 mb-10">
                        <div class="rvw-bookur">
                          <strong><i class="icofont-ui-user-group"></i> Guests: </strong><?php echo $no_adult;?> Adults , <?php echo $no_child;?> Children
                        </div>
                      </div>
                    </div>
                  </div>
               </div>
              </div>
            <!-- Traveller Details End -->
            <form id="id_from" action="<?php echo site_url(); ?>hotel/save_bookingdata" method="post" >
              <!-- Traveller Details -->
             <div class="col-fly-com">
               <h3 class="review-title">Guest Details</h3>
			   <div class="col-fly-inn">
			   <?php foreach($bp_pax_request as $bp_pax_key => $bp_pax_requests){?>
						<h4>Room <?php echo $bp_pax_key+1;?></h4>
						<?php for($i=0;$i<$bp_pax_requests['NoOfAdults'];$i++){ ?>
						<h5>Adult <?php echo $i+1;?></h5>
						<div class="row">
							<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<div class="form-group custom-select-wrap">
									<label>Title*</label> <select class="form-control pax_validation_field first_name_adult_"  name="title_adult_<?php echo $bp_pax_key;?>_<?php echo $i;?>">
										<option>Mr</option>
										<option>Mrs</option>
										<option>Miss</option>
										<option>Ms</option>
									</select>
								</div>
							</div>	
							<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">	
								<div class="form-group custom-select-wrap">
									<label>First Name*</label> <input type="text" name="first_name_adult_<?php echo $bp_pax_key;?>_<?php echo $i;?>" class=" form-control pax_validation_field name_valid " />
								</div>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<div class="form-group custom-select-wrap">
									<label>Surname*</label> <input type="text" name="last_name_adult_<?php echo $bp_pax_key;?>_<?php echo $i;?>" class="form-control pax_validation_field name_valid " />
								</div>
							</div>
						</div>
						<br>
						<?php } if($bp_pax_requests['NoOfChild']>0){?>
						   <?php foreach($bp_pax_requests['ChildAge'] as $bp_key_child => $bp_child_pax_data){?>
						   <h5>Child <?php echo $bp_key_child+1;?> (Age - <?php echo $bp_child_pax_data;?>)</h5>
						   	<div class="row">
							<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">	
								<div class="form-group custom-select-wrap">
									<label>Title*</label> 
										<select  class="form-control " name="title_child_<?php echo $bp_pax_key;?>_<?php echo $bp_key_child;?>">
										<option>Mstr</option>
										<option>Miss</option>
									</select>
								</div>
							</div>	
							<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">	
								<div class="form-group custom-select-wrap">
									<label>First Name*</label> <input type="text" name="first_name_child_<?php echo $bp_pax_key;?>_<?php echo $bp_key_child;?>" class="form-control pax_validation_field name_valid " />
								</div>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">	
								<div class="form-group custom-select-wrap">
									<label>Surname*</label> 
									<input type="text" name="last_name_child_<?php echo $bp_pax_key;?>_<?php echo $bp_key_child;?>" class="form-control name_valid pax_validation_field " />
									<input type="hidden" value="<?php echo $bp_child_pax_data;?>" name="age_child_<?php echo $bp_pax_key;?>_<?php echo $bp_key_child;?>" class="form-control" />
								</div>
							</div>
						</div>
						<br>
						   <?php }?>
						<?php }?>
					<?php }?>

               </div>
			   
              </div>
            <!-- Traveller Details End -->

            <!-- Personal Details -->
              <div class="col-fly-com">
               <h3 class="review-title">Contact Details</h3>
               <div class="col-fly-inn form-inline">
                 <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group ">
                        <label>Enter Your Email:</label>
							<input type="text" id="email_valid" name="email" class="form-control pax_validation_field full white-bg" />
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label>Enter Your Mobile:</label>
                        	<input  type="number"  name="mobile" class="phone form-control pax_validation_field full white-bg" />
                      </div>
                    </div>
                 </div>
               </div>
              </div>
            <!-- Personal Details End -->

            <div class="col-fly-com">
               <h3 class="review-title">Policies</h3>
               <div class="col-fly-inn">
                  <div class="ht-policy row">
						
								<h5>Hotel Policy</h5>
                <p><?php echo $bp_hotel_detail['0']->hofl_terms_condition;?></p>
								
							</div>
					 </div>
               </div>
            </div>
			<div class="clearfix"></div>

             <div class="col-fly-com">
               <h3 class="review-title">Acknowledgement</h3>
			   <div class="clearfix"></div>
               <div class="col-fly-inn">
				<div class="checkbox cstm-check">
          <label>
            <input type="checkbox" value="I have read and accept the Terms and Conditions and Privacy Policy." id="terms">
              <span>I have read and accept the Terms and Conditions and Privacy Policy.</span>
					</label>
				</div>			
				<p class="border-top-text">By completing this booking, you are agreeing with our Terms and Privacy Policy.</p>
               </div>
            </div> 

			<?php

			$bp_dsa_total_balance=$this->dsa_data->dsa_balance+$this->dsa_data->dsa_credit_limit;
			$bp_total_fare=$_SESSION ['hotel'] ['amount'] ['customer_fare'];  

			
				?>
			 <?php  if($getwayList!="0") { ?>	
			<input name="payment_method"  type="hidden" value="<?php  echo $getwayList[0] ->dsapayg_gateway_name ?>">		 
			<button  class="btn btn-org search-btn  mt-2 bp_hotel_info_find1"  id="id_btn"> <i class="icofont-long-arrow-right"></i> Complete Booking </button> 
            <?php } else { echo "Some Technical Error . Please Contact Admin"; } ?>
		    </form>
           </div>

         <div class="col-lg-3 col-md-3 col-sm-12">
           <div class="flght-side-det">
            <div class="review_title clearfix">
              <h4 class="">Fare Details</h4>
            </div>
            <div class="contant">
              <ul class="fare_details">
                  <li>Base Fare <span class="pull-right"><i class=""><?php echo $this->bp_white_label_setting->wls_currency_symbol;?></i> <?php echo dsa_currency_convert($bp_room_detail[0]->hoffr_basic_fare* $bp_rooms * $bp_nights); ?></span></li>
                  <li>Tax (+)<span class="pull-right"><i class=""><?php echo $this->bp_white_label_setting->wls_currency_symbol;?></i> <?php echo dsa_currency_convert($bp_room_detail[0]->hoffr_tax* $bp_rooms * $bp_nights); ?></span></li>
                  <?php if($getwayList!="0"){
					  if($getwayList[0]->dsapayg_type = "fix"){
						  $nkwithconfee =  $getwayList[0]->dsapayg_convenience_fee;
					  } else{
                        //  $nkwithconfee =  ( bp_get_hotel_fare($bp_publish_fare)['final_fare'] * $getwayList[0]->dsapayg_convenience_fee)/100;
						   $nkwithconfee =  ( $bp_total_customer_fare* $getwayList[0]->dsapayg_convenience_fee)/100;
					  }
					  
					  $total_fare = $bp_total_customer_fare + $nkwithconfee;
					  $_SESSION ['hotel'] ['amount'] ['total_payable'] = $total_fare;
                         ?>
                        <li>Convenience Fee<span class="pull-right"><i class=""><?php echo $this->bp_white_label_setting->wls_currency_symbol;?></i> <?php echo dsa_currency_convert($nkwithconfee); ?></span></li>
                        <?php }else { $nkwithconfee = 0; }  ?>
				<li>Total Fare<span class="pull-right"><i class=""><?php echo $this->bp_white_label_setting->wls_currency_symbol;?></i> <?php echo dsa_currency_convert($total_fare); ?></span></li>
                       
              </ul>
            </div>
           </div>
         </div>
       </div>
     </div>
    </div> 




<div class="modal fade confirmpop " id="Modal_for_confirm" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4><span class="glyphicon glyphicon-lock"></span> Please Confirm your Flight </h4>
        </div>
        <div class="modal-body" style="padding: 30px 34px 30px 20px;">
         <div class="row">
             <div class="col-md-8">
                 <div class="list-group">
    <a href="#" class="list-group-item active">
    Passenger Detail-
    </a>
                 <div class="pax_data_apend">
                     
  
</div>
                 </div>
                 
                 <div class="list-group">
    <a href="#" class="list-group-item active">
    Contact Detail
    </a>
                 <div class="">
                  <li class="list-group-item email_confirm"></li>
                  <li class="list-group-item contact_confirm"></li>  
  
              </div>
                 </div>
                 
                 <div class="list-group">
    <a href="#" class="list-group-item active">
    Journey Details
    </a>
                 
                 </div>
             </div>
             
             <div class="col-md-4">
                 <div class="row airlines">
                    <ul class="fare_details">
                        <li>Base Fare <span class="pull-right"><i class=""><?php echo $this->bp_white_label_setting->wls_currency_symbol;?></i> <?php echo 0; ?></span></li>
                        <li>Tax <span class="pull-right"><i class=""><?php echo $this->bp_white_label_setting->wls_currency_symbol;?></i> <?php echo 0; ?></span></li>
                        <li>Total Fare <span class="pull-right"><i class=""><?php echo $this->bp_white_label_setting->wls_currency_symbol;?></i> <?php echo 0; ?></span></li>
                    </ul>
                </div>
             </div>
              </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

       	 <button type="button" class="btn btn-success proceed_payment_data">Proceed Payment</button>


        </div>
      </div>


      
    </div>
  </div> 



	<div id="hotel_confirm_pop_up" class="modal fade flights-search-popup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1111" aria-hidden="true">
			<div class="modal-dialog ">				
				<div class="modal-content">					
					<div class="modal-body">
						<div class="row">							
							<div class="col-sm-12 col-md-12 modal-body-right">
								<div class="inner">
									<form>
										<div class="row">
										        <div class="col-sm-12 col-md-12">
													<div class="text-align-center" style="color:#000">
												       	<img class="loader-img" src="<?php echo site_url(); ?>assets/images/logo.png">
														<h3>Please Wait</h3>
														<span class="block midfz">Do not refresh or close the Window</span>
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
	<?php $this->load->view('footer');?>
<?php $this->load->view('hotel/js');?>
