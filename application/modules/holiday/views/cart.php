<?php
$this->load->view("holidaylayout/header");

// PrintArray($result);
//  die;

                         if (!empty($payment_method)) {
                                foreach ($payment_method as $payment_methods) {
                                    if($payment_methods->dsapayg_gateway_name ="Pay Pal")
                                     {
                                       $paypal_userkey =$payment_methods->dsapayg_gateway_user_id;
                                     }
                                    }
                                }

								if (!empty($result)) {
                                    foreach ($result as $cartdata) {

                                        $booking_id[] =$cartdata['bookingdetail']->holbook_id;

                                     }
                                        
                                     $booking_ids=implode(",", $booking_id);
                                  
                            
                                }


$resultsss = 40
?>
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
   <script>
        paypal.Button.render({

            env: 'sandbox', // sandbox | production

            // PayPal Client IDs - replace with your own
            // Create a PayPal app: https://developer.paypal.com/developer/applications/create
            client: {
                sandbox:    '<?php echo  $paypal_userkey  ?>',
                production: '<insert production client id>'
            },

            // Show the buyer a 'Pay Now' button in the checkout flow
            commit: true,

            // payment() is called when the button is clicked
            payment: function(data, actions) {

                // Make a call to the REST api to create the payment
                return actions.payment.create({
                    payment: {
                        transactions: [
                            {
                              
                                amount: { total: '<?php echo $carttotalPrice  ?>', currency: '<?php echo $this->dsa_setting->dsaset_currency_symbol ?>' }
                            }
                        ]
                    }
                });
            },

            // onAuthorize() is called when the buyer approves the payment
            onAuthorize: function(data, actions) {

                // Make a call to the REST api to execute the payment
                return actions.payment.execute().then(function() {
					//	window.alert('Payment Complete!');
					
					$.ajax({
   			            url: "<?php echo site_url(); ?>holiday/paymentUpadate",
     		            type: "POST",
						data: { paymentBy: "Pay Pal" , bookingIDS:"<?php echo $booking_ids ?>" }, // add a flag
						success: function(data){
						window.location.href = '<?php echo site_url(); ?>holiday/booking_success';
						},
        	
						error: function (jqXHR, textStatus, errorThrown){
						alert('Error!')
					}
    		       });
            
					
					
					
                });
            }

        }, '#paypal-button-container');

    </script>
<style>
    .tour-title{
        background: #a2a2a2;
        color: #fff;
        padding: 7px;
        margin-bottom: 2px;
        margin-left: -10px;
    }
</style>
<div class="container-fluid tourcartdetailsfluid pt50 pb50 light-bg">
    <div class="container tourcartdetailscontainer">
        <?php if (!empty($result)) { ?>
            <div class="clearfix tourcartdetailsbox">
                <div class="table-responsive">
                    <table class="table table-bordered tourcartitemtable">
                        <thead>
                            <tr>
                                <th>Tour Number</th>
                                <th>Tour Name</th>
                                <th>Traveller(s)</th>
                                <th>Tour Date</th>
                  <!--              <th>Tour Language</th>-->
                                <th>Remove</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($result)) {
							
                                foreach ($result as $cartdata) {
									//print_r($cartdata["tourdetail"]);
									
                                    ?>
                                    <tr>
                                        <td><span><?php echo $cartdata["tourdetail"]->holiday_id; ?></span></td>
                                        <td>
                                            <span class="block"><?php echo $cartdata["tourdetail"]->holiday_name; ?></span>
                                            <span class="block fwb black-color">Pickup Hotel:<?php echo $cartdata["cart_detail"]["tour_hotel"]; ?></span>
                                           <!-- <span class="block fwb black-color">Pickup Time:</span> -->
                                        </td>
                                        <td>
                                            <span class="block"><?php if($cartdata["cart_detail"]["tour_adult_no"]>1){ echo "Adults";} else {echo "Adult";} ?>: <?php echo $cartdata["cart_detail"]["tour_adult_no"]; ?></span>
                                            <span class="block"><?php if($cartdata["cart_detail"]["tour_child_no"]>1){ echo "Children";} else {echo "Child";} ?>: <?php echo $cartdata["cart_detail"]["tour_child_no"]; ?></span>
                                            <span class="block"><?php if($cartdata["cart_detail"]["tour_infant_no"]>1){ echo "Infants";} else {echo "Infant";} ?>: <?php echo $cartdata["cart_detail"]["tour_infant_no"]; ?></span>
                                        </td>
                                        <td><span><?php echo $cartdata["cart_detail"]["tour_start_date"]; ?></span></td>
                          <!--              <td><span>English</span></td>-->
                                        <td>
                                            <a href="<?php echo site_url(); ?>/holiday/remove_from_cart?tour_id=<?php echo $cartdata["tourdetail"]->holiday_id; ?>" class="circle badge white-color sub-bg"><i class="fa fa-times"></i></a>
                                        </td>
                                        <td>
                                            <span>
										<?php set_Currency ($this->dsa_setting->dsaset_currency_symbol,$cartdata["cart_detail"]["tour_total_price"]); ?>
											</span>
                                        </td>
                                    </tr>
                                <?php  } 
                            }
                            ?>
                            <tr class="totaltr">
                                <td colspan="5" class="text-right"><strong>Total</strong></td>
                                <td><?php if (!empty($result)) {
                                 set_Currency ($this->dsa_setting->dsaset_currency_symbol,$cartdata["cart_detail"]["tour_total_price"]);     
                            }
                            ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="addtourcoupon">
                    <form action="">
                        <div class="row">
                            <div class="col-sm-4 col-sm-offset-6">
                                <input type="text" class="input block width-100 border" placeholder="Enter Coupon code to get special discount">
                            </div>
                            <div class="col-sm-2">
                                <a href="#none" class="btn btn-primary block">Add coupon</a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row mt15">
                    <div class="col-sm-2">
                        <a href="<?php echo site_url(); ?>" class="btn btn-default block">Keep shopping</a>
                    </div>
                    <div class="col-sm-4 col-sm-offset-4">
                        <h2 class="fz24 black-color fwb">Your are paying <?php if (!empty($result)) {
                                 set_Currency ($this->dsa_setting->dsaset_currency_symbol,$cartdata["cart_detail"]["tour_total_price"]);
                            }
                            ?></h2>
                    </div>
                    <div class="col-sm-2">
   
                         <?php if($this->session->userdata("Userlogin") == NULL){?>
                                     <a href="#login_signup" data-toggle="modal" class="btn btn-success block">Pay now</a>      
                             <?php } else { ?>
                                     <a href="#Modal_for_confirm" id="cardbtn" data-toggle="modal"  class="btn btn-success block">Pay now</a>   
                             <?php } ?>
                    </div>
                    
                    <div class="col-sm-2" style="padding: 10px ">
                      <?php //print_r($payment_method);
                         if (!empty($payment_method)) {
                                foreach ($payment_method as $payment_methods) {
                                    if($payment_methods->dsapayg_gateway_name ="Pay Pal")
                                     {
                                 ?>
                                                           
   <?php if($this->session->userdata("Userlogin") == NULL){?>
                                     <a href="#login_signup"  data-toggle="modal" > <img width="170" src="<?php echo site_url(); ?>admin/assets/img/logos/paypal.png "> </a>      
                             <?php } else { ?>
                                     <a href="#Modal_for_confirm" id="paypalbtn" data-toggle="modal" ><img width="170" src="<?php echo site_url(); ?>admin/assets/img/logos/paypal.png "></a>   
                             <?php } ?>
                                      
                                
                           <?php }}}?>
                     </div> 
                      <a Style="display:none" href="#Modal_for_confirm" id="cardbtn"  data-toggle="modal" class="btn btn-success block">Pay now</a>
                     <a Style="display:none" href="#Modal_for_confirm" id="paypalbtn" data-toggle="modal" ><img width="170" src="<?php echo site_url(); ?>admin/assets/img/logos/paypal.png "></a>         
                    </div>
                </div>
            </div>
<?php } else { ?>

            <h2 class="text-center text-center thumbnail pt50 pb50"> Your Cart Is Empty. </h2> 
            <div class="row mt15">
                <div class="col-sm-2 pull-right">
                    <a href="<?php echo site_url(); ?>" class="btn btn-success block">Keep shopping</a>
                </div>
                <div class="col-sm-4 col-sm-offset-4">
                </div>

            </div>
<?php } ?>
    </div>
</div>

<div class="modal fade confirmpop " id="Modal_for_confirm" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4><span class="glyphicon glyphicon-lock"></span> Please Confrim your Tour Detail </h4>
            </div>
            <div class="modal-body" style="padding: 30px 34px 30px 20px;">
                <div class="row">
                    <div class="col-md-8">
<?php
$tour = 1;
if (!empty($result)) {
    foreach ($result as $cartdata) {
        ?>
                                <h3 class="tour-title">Tour Detail <?php echo $tour; ?> </h3>
                                <div class="list-group">
                                    <a href="#" class="list-group-item active">
                                        Traveller Detail-
                                    </a>
                                    <div class="pax_data_apend">

        <?php
        $paxno = 1;
        foreach ($cartdata["bookingPax"] as $paxdeta) {
            ?>
                                            <div class="panel-body"><?php echo $paxno . '. '; ?><?php echo $paxdeta->holpax_type; ?> - <?php echo $paxdeta->holpax_title; ?> <?php echo $paxdeta->holpax_first_name; ?> <?php echo $paxdeta->holpax_last_name; ?>
                                                <span class="pull-right"><?php echo date("d-m-Y", strtotime($paxdeta->holpax_dob)); ?></span>
                                            </div>

            <?php $paxno++;
        }
        ?>
                                    </div>
                                </div>
                                <div class="list-group">
                                    <a href="#" class="list-group-item active">
                                        Tour Details
                                    </a>
                                    <div class="">
                                        <div class="panel-body">
                                            <div class="col-sm-4">
                                                <div class="grabber clearfix">

                                                    <img src="<?php echo site_url(); ?>admin/assets/img/holiday/thumbs/<?php echo $cartdata["tourdetail"]->holiday_feature_image; ?>" alt="<?php echo $cartdata["tourdetail"]->holiday_feature_image; ?>" class="airline-img" style="max-height: 50px;">

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <span class="airlinename read-color block"><b><?php echo $cartdata["tourdetail"]->holiday_name; ?></b></span>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="col-xs-12 col-sm-12">
                                                    <div class="grabber clearfix relative">

                                                        <span class="inline-block pull-right text-left">
                                                            <span class="bigfz block black-color text-uppercase fwb"><b><?php echo $cartdata["bookingdetail"]->holbook_pickup_point; ?></b></span>
                                                            <span class="norfz block read-color"><b><?php echo GetdateDay($cartdata["bookingdetail"]->holbook_tour_start_date); ?></b></span>
                                                        </span>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
								
											 <div class="list-group">
                                    <a href="#" class="list-group-item active">
                                       Extra Tour Details
                                    </a>
                                    <div class="">
                                        <div class="panel-body">
										
										
		 								  <?php
                                            
                                            if ($cartdata["extra"][0] != NULL )  
												{  
                                             
                                             foreach ($cartdata["extra"] as $extra) { ?>
										   
										
										    <div class="col-sm-12" style="padding: 10px;">  
                                            <div class="col-sm-4">
                                                <div class="grabber clearfix">
.
                                               

                                                    <img src="<?php echo site_url(); ?>admin/assets/img/extratour/thumbs/<?php echo $extra[0]->holextra_image ?>" class="airline-img" style="max-height: 50px;">

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <span class="airlinename read-color block"><b><?php echo $extra[0]->holextra_name ?></b></span>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="col-xs-12 col-sm-12">
                                                    <div class="grabber clearfix relative">

                                                        <span class="inline-block pull-right text-left">
                                                            <span class="bigfz block black-color text-uppercase fwb">
										<?php set_Currency ($this->dsa_setting->dsaset_currency_symbol,$extra[0]->holextra_price); ?></span>
                                                           
                                                        </span> 
                                                    </div>
                                                </div>
                                            </div>
											</div>
											<?php	 }
											}
                                            
                                           else {
                                               echo "No Extra Tour Added";
                                           }
										   ?>
											

                                        </div>
                                    </div>
                                </div>
								
				
								
								
								


                                <div class="list-group">
                                    <a href="#" class="list-group-item active">
                                        Contact Detail
                                    </a>
                                    <div class="">
                                        <div class="panel-body">
                                            <ul class="pack-ul-details clearfix">

                                                <li class="clearfix" style="border-top:none">
                                                    <span class="left">Mobile</span>
                                                    <strong class="right"><?php echo $cartdata["bookingdetail"]->holbook_contact_phone; ?></strong>
                                                </li>
                                                <li class="clearfix ">
                                                    <span class="left">Email</span>
                                                    <strong class="right"><?php echo $cartdata["bookingdetail"]->holbook_contact_email; ?></strong>
                                                </li>
                                            </ul>

                                        </div>
                                    </div>
                                </div> 
        <?php $tour++;
    }
} ?>
                    </div>

 <div class="col-md-4">
                       <?php
          $idet = 1;
		 // print_r($_SESSION["Tours_Cart"]);
          foreach ($result as $resultsss ){ 
		  
		 // print_r($resultsss);
		  
		  ?>
            <div class="panel panel-default">
    <div class="panel-heading">Fare Detail Tour <?php echo $idet; ?></div>
    <div class="panel-body">
          
                  <div class="clearfix p15">
            <ul class="pack-ul-details clearfix">
              
              <li class="clearfix" style="border-top:none">
                <span class="left">Base fare</span>
            <strong class="right"><?php set_Currency ($this->dsa_setting->dsaset_currency_symbol,$resultsss["bookingdetail"]->holbook_amount); ?></strong>
              </li>
              
              <li class="clearfix">
                <span class="left">Tax & VAT</span>
                <strong class="right"><?php current_Currency_icon($this->dsa_setting->dsaset_currency_symbol) ?> 0</strong>
              </li>
              <li class="clearfix totalpriceofpack">
                <span class="left">Total</span>
           <strong class="right"><?php set_Currency ($this->dsa_setting->dsaset_currency_symbol,$resultsss["bookingdetail"]->holbook_amount); ?></strong>
              </li>
            </ul>
          </div>
        
        
    </div>
  </div>
          <?php $idet++; } ?>
 </div></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <div style="width: 150px;float: right;margin-left: 20px;" id="paypal-button-container"></div>
                <a href="<?php echo site_url(); ?>/holiday/payment_request/<?php echo $resultsss["bookingdetail"]->holbook_id; ?>" class="btn btn-success proceed_payment_data">Proceed Payment</a>
            </div>
        </div>

    </div>
</div> 
<div class="modal fade" id="login_signup">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&nbsp;</button>
            <div class="modal-body">
                <div role="tabpanel">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#Logintab" aria-controls="Logintab" role="tab" data-toggle="tab">Login</a>
                        </li>
                        <li role="presentation">
                            <a href="#Signuptab" aria-controls="Signuptab" role="tab" data-toggle="tab">Sign up</a>
                        </li>
 			<li role="presentation">
                            <a href="#Guesttab" aria-controls="Guesttab" role="tab" data-toggle="tab">Guest</a>
                        </li>
                    </ul>
                    <div class="tab-content">
    <div role="tabpanel" class="tab-pane" id="Guesttab">
                      <form action="" class="loginsignupform mainloginform">
                      <br>
                                <div class="clearfix inputgrabber mb15">
                                    <i class="fa fa-envelope inputicon"></i>
                                    <input type="email" name="guest_email" class="input block width-100 border radius" required placeholder="Email Address">
                                </div>
                                <div class="clearfix inputgrabber mb15">
                                    <i class="fa fa-mobile inputicon"></i>
                                    <input type="Number" name="guest_mobile"  class="input block width-100 border radius" required placeholder="Mobile">
                                </div>
    
                                 <div class="clearfix mb15">
                                    <a href="#none" class="forgotpassword fz12 btn btn-success width-100 " >Pay</a>
                                 </div>
                             
                               
                                </form>

                        

                         <form action="" class="loginsignupform mainforgetpassform">
                                <p class="para mb15">Please select payment method</p>
                                <div class="clearfix inputgrabber mb15">
                                <i class="fa fa-credit-card inputicon"></i>
                                   <select  id="selectField" class="input block width-100 border radius">
                                        <option >Select payment methods</option>
                                        <option value="pay pal">pay Pal</option>
                                        <option value="card">card</option>
                                   
                                    </select>
                                </div>
                               
                                
                            </form>
                           
                      </div>


<style>
    #Modal_for_confirm{
        overflow-y:scroll 
    }
    
    </style>
                        <div role="tabpanel" class="tab-pane active" id="Logintab">
                            <form action="" class="loginsignupform mainloginform">
                                <div id="error_msg" class="error_msg"></div>
                                <div class="clearfix inputgrabber mb15">
                                    <i class="fa fa-envelope inputicon"></i>
                                    <input type="email" name="email" id="Cust_email" class="input block width-100 border radius" required placeholder="Email Address">
                                </div>
                                <div class="clearfix inputgrabber mb15">
                                    <i class="fa fa-lock inputicon"></i>
                                    <input type="password" name="password" id="Cust_password" class="input block width-100 border radius" required placeholder="Password">
                                </div>
                                <div class="clearfix inputgrabber mb15">
                                    <div class="pull-left">
                                        <input type="checkbox" name="" id="rememberme_pax"> <label for="rememberme_pax" class="inline-block pointer fz12 black-color">Remember me?</label>
                                    </div>
                                    <div class="pull-right">
                                        <a href="#none" class="forgotpassword fz12">Forgot Password?</a>
                                    </div>
                                </div>
                                <div class="clearfix mb15">
                                    <button type="button" onclick="book_login();"  class="btn btn-success block width-100 otpformbtn"><i class="fa fa-sign-in"></i> Login</button>
                                </div>
								
                                <div class="clearfix ordiv">
                                    <span class="or">or</span>
                                </div>
                                <div class="row loginwithrow">
                                    <div class="col-sm-6 loginfb">
                                    <a href="#" class="facebook-anchor">
								    <i class="fa fa-facebook"></i>
	                                <span>Login with facebook</span>
	                                </a>
                                    </div>
                                    <div class="col-sm-6">
 <a href="<?php echo $this->google->loginURL(); ?>"  onclick= "<?php $_SESSION['url']='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] ?>" class="google-anchor">
                                            <i class="fa fa-google-plus"></i>
                                            <span>Login with google</span>
                                        </a>
                                    </div>
                                </div> 
								
                            </form>
                            <form action="" class="loginsignupform mainforgetpassform">
                                <p class="para mb15">Please enter your e-mail address & we will send you a confirmation mail to reset your password.</p>
                                <div class="clearfix inputgrabber mb15">
                                    <i class="fa fa-envelope inputicon"></i>
                                    <input type="email"  pattern="/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/" class="input block width-100 border radius forgot_email"  placeholder="Email Address" required>
                                </div>
                                <div class="clearfix mb15">
                                    <button type="submit" class="btn btn-success block width-100 otpformbtn forgot_submit"><i class="fa fa-external-link"></i> Submit</button>
                                </div>
                                <div class="clearfix">
                                    <a href="#none" class="backtologin inline-block"><i class="fa fa-long-arrow-left"></i> Back to login</a>
                                </div>
                            </form>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="Signuptab">
                            <form action="" class="loginsignupform mainsignupform">
                                <span class="fz18 fwb black-color block mb20">Welcome, let's get started</span>
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
                                    <div class="col-sm-6">
                                        <div class="clearfix inputgrabber mb15">
                                            <i class="fa fa-lock inputicon"></i>
                                            <input type="password" id="Cust_password_reg" class="input block width-100 border radius" required placeholder="Password">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="clearfix inputgrabber mb15">
                                            <i class="fa fa-lock inputicon"></i>
                                            <input type="password" id="Cust_confirm_password" class="input block width-100 border radius" required placeholder="Confirm Password">
                                        </div>
                                    </div>
                                </div>

                                <div class="clearfix mb15">
                                    <button type="button" onclick="book_registration();" class="btn btn-success block width-100 otpformbtn"><i class="fa fa-sign-in"></i> Create Account</button>
                                </div>
                                <div class="clearfix mb15 agreetotheterms">
                                    <input type="checkbox" name="" id="agreetotheterms_create"> <label for="agreetotheterms_create" class="inline-block pointer fz12 black-color vat">By proceeding, you agree with our <a href="<?php echo site_url(); ?>online/Terms-Conditions">Terms of Service</a> & <a href="<?php echo site_url(); ?>online/Privacy-Policy">Privacy Policy</a></label>
                                </div>
                            </form>
                        </div>

						
						
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(".forgot_submit").click(function(){

            email_in = $(".forgot_email").val() ;

            if(!email_in){
                alert("Please enter email");  
                }
            else{

                $.ajax({
   			     url: "<?php echo site_url(); ?>user/forgotpassword",
     		     type: "POST",
        		 data: { email: email_in }, // add a flag
        		 success: function(data){
                  
					alert("We have get your password change request.! please check your Email for reset password.Thanks! ");
				    location.reload(true);
            	 },
                	error: function (jqXHR, textStatus, errorThrown){
                      alert('Error!')
                	}
    	    });
            

            }
 
    
    });
</script>

<script>
	// Initiate Facebook JS SDK
	window.fbAsyncInit = function() {
		FB.init({
			appId   : '<?php echo $this->config->item('facebook_app_id'); ?>', // Your app id
			cookie  : true,  // enable cookies to allow the server to access the session
			xfbml   : false,  // disable xfbml improves the page load time
			version : 'v2.5', // use version 2.4
			status  : true // Check for user login status right away
		});

		FB.getLoginStatus(function(response) {
			console.log('getLoginStatus', response);
			loginCheck(response);
		});
	};

	// Check login status
	function statusCheck(response)
	{
		console.log('statusCheck', response.status);
		if (response.status === 'connected')
		{
			$('.login').hide();
			$('.form').fadeIn();
			
		   FB.getLoginStatus(function(response) {
				getUser();
          }, true);
				
		}
		else if (response.status === 'not_authorized')
		{
			// User logged into facebook, but not to our app.
		}
		else
		{
			// User not logged into Facebook.
		}
	}

	// Get login status
	function loginCheck()
	{	
		FB.getLoginStatus(function(response) {
			console.log('loginCheck', response);
			statusCheck(response);
			
		});
	}

	// Here we run a very simple test of the Graph API after login is
	// successful.  See statusChangeCallback() for when this call is made.
	function getUser()
	{
   
		$('.login').hide();
		$('.form').fadeIn();

		FB.api('/me','get', {fields: 'id,first_name,last_name,gender,email,address' }, function(response) {
			console.log('getUser', response);
		 var sts= response.id+","+response.first_name+","+response.last_name+","+response.gender+","+response.email+","+response.address;
			$.ajax({
   			     url: "<?php echo site_url(); ?>user/returnurl",
     		            type: "POST",
        		 data: { userdata: sts , setid: true }, // add a flag
        		 success: function(data){
                  
					window.location.href = 'http://<?php echo $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] ?>';
				
        	 },
        	error: function (jqXHR, textStatus, errorThrown){
            alert('Error!')
        	}
    		});
		});
	}
	$(function(){
		// Trigger login
		$('.loginfb').on('click', 'a', function() {
			FB.login(function(){
				loginCheck();
			}, {scope: '<?php echo implode(",", $this->config->item('facebook_permissions')); ?>'});

			
			
		});

		
	});

	(function(d, s, id){
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) {return;}
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/en_US/sdk.js";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
</script>
<script>
  function book_login() {
            var cEmail = $("#Cust_email").val();
            var cPassword = $("#Cust_password").val();
            $.ajax({
                type: "POST",
                url: "<?php echo site_url(); ?>user/login_ajax",
                data: {custEmail: cEmail, custPassword: cPassword},
                dataType: "text",
                cache: false,
                success:
                        function (data) {
                            // alert(data); 
                            var obj = jQuery.parseJSON(data);
                            console.log(obj);
                            if (obj.status == "success") {
                                
                              // alert($("#adult_no").val());
                         //   if($("#adult_no").val() == ""){

                                location.reload();
                                //return false;
                                
                            //  }else{
                           //   $("#formid").submit();   
                        //} 
                       
                              
                            }else{
                                
                            $("#error_msg").html(obj.message);
                           
                         }
                    }
            });
        }
        
        function book_registration() {
            var cEmail = $("#Cust_email_reg").val();
            var cPassword = $("#Cust_password_reg").val();
            var cFname = $("#Cust_f_name").val();
            var cLname = $("#Cust_l_name").val();
            var cMobile = $("#Cust_mobile_no").val();
            var cConfirmPass = $("#Cust_confirm_password").val();
            
            
            if(cEmail ==""){
                $("#error_msg_reg").html("Enter Email ID");
                return false;
            }
            if(cPassword ==""){
                $("#error_msg_reg").html("Enter Password!");
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
            
            if(cConfirmPass ==""){
                $("#error_msg_reg").html("Enter Confirm Password !");
                return false;
            }
            
            
             if(cPassword == cConfirmPass){
            $.ajax({
                type: "POST",
                url: "<?php echo site_url(); ?>user/ajax_registration",
                data: {custEmail: cEmail,custFirstName: cFname,custLastName: cLname,custMobleNo: cMobile, custPassword: cPassword},
                dataType: "text",
                cache: false,
                success:
                        function (data) {
                             // alert(data); 
                             
                            var obj = jQuery.parseJSON(data);
                            console.log(obj);
                            if (obj.status == "success") {
                                
                              // alert($("#adult_no").val());
                            if($("#adult_no").val() == ""){
                                
                                location.reload();
                                //return false;
                                
                              }else{
								  
                              $("#formid").submit();   
                          } 
                       
                              
                            }else{
                              console.log(obj.message);  
                            $("#error_msg_reg").html(obj.message);
                           
                         }
                    }
            });
           }else{
           $("#error_msg_reg").html("Password not match !");
           }
        }
$(document).ready(function() {
 $('#Modal_for_confirm').on('hidden.bs.modal', function () {
           $('body').removeAttr('style');
             });

        $('#selectField').change(function(){
            if($('#selectField').val() == 'pay pal'){
               $('#login_signup').modal('toggle');
               $("#paypalbtn").click();
               $("body").css("overflow-y", "hidden");
            }

            if($('#selectField').val() == 'card'){
               $('#login_signup').modal('toggle');
               $("#cardbtn").click();
               $("body").css("overflow-y", "hidden");
            }
           
        });
        $("#paypalbtn").click(function(){    
           // alert("i'm working");       
            $(".proceed_payment_data").hide();
            $("#paypal-button-container").show();
        });


        $("#cardbtn").click(function(){    
           // alert("i'm working");       
            $(".proceed_payment_data").show();
            $("#paypal-button-container").hide();

        });
    });
</script>
<?php $this->load->view("holidaylayout/footer"); ?>
