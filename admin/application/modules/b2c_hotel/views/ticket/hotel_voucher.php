<!DOCTYPE html>
<?php
    if($hotel_info_result){
        $bp_hotel_detail = $hotel_info_result->HotelInfoResult->HotelDetails;
    }
     $bp_hotel_book_request=$requset_data; 
    $bp_rooms = $hotel_booking->hotboli_room;
    $bp_adult = $hotel_booking->hotboli_adult;
    $bp_child = $hotel_booking->hotboli_child;
    //$bp_base_price=$hotel_booking->hotboli_customer_fare;

		// echo "<pre>";
		// print_r($bp_hotel_book_request);die;
	$bp_base_price=round($bp_hotel_book_request['HotelRoomsDetails'][0]['Price']['RoomPrice']);
    $bp_publish_fare=$hotel_booking->hotboli_customer_fare + $hotel_booking->hotboli_transaction_fee;
    $bp_tax=$bp_publish_fare-$bp_base_price;
   
    $room_name = $bp_hotel_book_request['HotelRoomsDetails'][0]['RoomTypeName'];
    $primary_pax = $bp_hotel_book_request['HotelRoomsDetails'][0]['HotelPassenger'][0]['FirstName']." ".$bp_hotel_book_request['HotelRoomsDetails'][0]['HotelPassenger'][0]['LastName'];
    $bp_sms_ticket_oneway_string= "Hotel Booking Confirm Number:".$hotel_booking->hotboli_book_confim_number." Check In:".$hotel_booking->hotboli_check_in_date." Check Out:".$hotel_booking->hotboli_check_out_date." Primary guest :".$primary_pax;
?>

<html >
    <head>
        <meta charset="UTF-8">
        <title>HOTEL VOUCHER</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo site_url(); ?>assets/css/vendor/bootstrap.min.css">
    </head>

    <body>
    <head>
	<style type="text/css">
            @import url(https://fonts.googleapis.com/css?family=Roboto:400,300,500,700,700italic,900);
            body { font-family: 'Roboto', Arial, sans-serif !important; }
            a[href^="tel"]{
                
                text-decoration:none;
                outline:0;
            }
            a:hover, a:active, a:focus{
                outline:0;
            }
            a:visited{
                color:#FFF;
            }
            
        </style>
    </head><body style="margin: 0; padding: 0;background-color:#EEEEEE;">
    <div id="printticketID">
        <table cellspacing="0" style="margin:0 0; width:100%; border-collapse:collapse; background-color:#EEEEEE; ">
            <tbody>
                <tr>
                    <td align="center" style="padding:20px 23px 0 23px">
                        <table width="850" style="background-color:#FFF; margin:0 0; border-radius:5px">
                            <tbody>
                                <tr>
                                    <td align="center">
                                        <table width="800" style="margin:0 0">
                                            <tbody>
                                                <tr>
                                                <td>
                                                <?php 
                                                    if(!empty($this->user_data->agent_logo)){
                                                        ?>
                                                        <a  target="_blank" style="color:#d8d8d8; text-decoration:none;outline:0;">
                                                            <img src="<?php echo site_url(); ?>assets/img/companyLogo/<?php echo $this->user_data->agent_logo;?>" border="0"></a>
                                                      
                                                        <?php } else {  ?>
                                                        <a  target="_blank" style="color:#d8d8d8; text-decoration:none;outline:0;">
                                                            <img src="<?php echo site_url();?>/assets/img/logos/<?php echo $this->dsa_data->dsa_logo;?>" width="20%" border="0"></a>
                                                        <?php } ?>
                                                    </td>
                                                    <td align="right" style="">
                                                        <h2 style="margin:0; font-weight:bold; font-size:18px; color:#444; ">
                                                            HOTEL VOUCHER
                                                        </h2>
                                                    </td>
                                                </tr>                           

                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" cellspacing="0" style="padding:0 0 30px 0; vertical-align:middle">
                                        <table width="800" style="border-collapse:collapse; background-color:#ffffff; margin:0 0; border:1px solid #E5E5E5">
                                            <tbody>
                                                <tr>
                                                    <td style="vertical-align:top">
                                                        <table width="100%" style="border-collapse:collapse">
                                                            <tbody>
                                                                <tr>
                                                                    <td style="vertical-align:top; padding:18px 18px 8px 23px; ">
                                                                        <p style="font-size:16px; color:#333333; text-transform:uppercase; font-weight:900; margin:0; ">
                                                                             <?php echo $this->user_data->dsa_company_name;?>
                                                                        </p>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="vertical-align:top; padding:0 18px 18px 23px; ">
                                                                        <table width="100%" style="border-collapse:collapse">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td style="">
                                                                                        <p style="font-size:16px; color:#000; margin:0;padding:0; ">
                                                                                        <?php  if(empty($this->user_data->agent_address)){ ?>
                                                                                            <?php echo $this->dsa_data->dsa_address;?>,<br> 
                                                                                                <?php echo $this->dsa_data->dsa_city;?>, 
                                                                                                <?php echo $this->dsa_data->dsa_state;?>, 
                                                                                                <?php echo $this->dsa_data->dsa_country;?>
                                                                                           
                                                                                            <?php }else{
                                                                                                echo $this->user_data->agent_address.', ';
                                                                                                echo $this->user_data->agent_city.', ';
                                                                                                echo $this->user_data->agent_state.', ';
                                                                                                echo $this->user_data->agent_country.', ';
                                                                                                
                                                                                                
                                                                                            } ?>
                                                                                           
                                                                                        </p>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td style="">
                                                                                        <p style="font-size:16px; color:#000; margin:0;padding:0; ">
                                                                                            Phone: <?php echo $this->dsa_data->dsa_support_mobile;?><br>
                                                                                            Email ID: <?php echo $this->dsa_data->dsa_support_email;?>
                                                                                        </p>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                    <td width="276" style="vertical-align:top; border-right:1px solid #E5E5E5">
                                                        <table style="width:100%; border-collapse:collapse">
                                                            <tbody>
                                                                <tr>
                                                                    <td style="vertical-align:top; padding:18px 18px 8px 23px; ">
                                                                        <p style="font-size:16px; color:#333333; text-transform:uppercase; font-weight:900; margin:0; ">
                                                                           <?php echo $hotel_booking->hotboli_book_confim_number;?>
                                                                        </p>
                                                                    </td>
                                                                </tr>
                                                              
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>    
                                <tr>
                                    <td>
                                        <p style="margin: 0;padding-left: 20px;">PLEASE PRESENT THIS VOUCHER UPON ARRIVAL</p>
                                    </td>
                                </tr>                    
                                <tr>

                                    <td align="center" cellspacing="0" style="padding:0; vertical-align:middle">
                                        <table border="" width="800" style="margin-bottom: 15px!important;border-collapse:collapse; background-color:#ffffff; margin:0 0;border: 1px solid #E5E5E5;">
                                            <thead style="background-color: #00a0db;">
                                                <tr>
                                                    <td style=" text-align:center; border-radius:4px; vertical-align:middle;padding: 7px 12px;">
                                                        <p style="font-size:14px; text-transform:uppercase; color:#FFF; margin:0; font-weight:900;  ">
                                                           <?php echo $bp_hotel_detail->HotelName;?></p>
                                                    </td>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                               
                                                <tr>
                                                    <td align="left" style="padding:10px 0 10px 0px;text-align:center; " width="117"><p style="font-size:14px; text-transform:uppercase; color:#333333; margin:0; font-weight:normal;  ">
														<p><?php echo $bp_hotel_detail->Address;?></p>
												   </td>

                                                </tr>
												<tr>
                                                    <td align="left" style="padding:10px 0 10px 0px;text-align:center; " width="117"><p style="font-size:14px; text-transform:uppercase; color:#333333; margin:0; font-weight:normal;  ">
													    <p><b>Hotel Contact Number : </b> <?php if($bp_hotel_detail->HotelContactNo){echo "<i class='fa fa-phone'></i>".$bp_hotel_detail->HotelContactNo;} else{ echo "Contact details are not available"; } ?></p>
													</td>

                                                </tr>
                                                
                                            </tbody>
                                        </table>
                                    </td>

                                </tr>
                                                 
                              
                                <tr>
                                    
                                </tr>
                                <tr>
                                    <td align="center" cellspacing="0" style="padding:0; vertical-align:middle">
                                        <table border="1" width="800" style="margin-bottom: 15px!important;border-collapse:collapse; background-color:#ffffff; margin:0 0; border: 1px solid #E5E5E5;">
                                            <thead style="background-color: #00a0db;">
                                                <tr>
                                                    <td style=" text-align:center; border-radius:4px; vertical-align:middle;padding: 7px 12px;">
                                                        <p style="font-size:14px; text-transform:uppercase; color:#fff; margin:0; font-weight:900;  ">
                                                            Check-in</p>
                                                    </td>
                                                    <td style=" text-align:center; border-radius:4px; vertical-align:middle;padding: 7px 12px;">
                                                        <p style="font-size:14px; text-transform:uppercase; color:#fff; margin:0; font-weight:900;  ">
                                                            Check-out</p>
                                                    </td>
                                                    <td style=" text-align:center; border-radius:4px; vertical-align:middle;padding: 7px 12px;">
                                                        <p style="font-size:14px; text-transform:uppercase; color:#fff; margin:0; font-weight:900;  ">
                                                            Guests</p>
                                                    </td>
                                                     
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                <tr>
                                                    <td align="left" style="padding:10px 0 10px 0px;text-align:center; " width="117">
                                                       
                                                        <p style="font-size:14px; text-transform:uppercase; color:#333333; margin:0; font-weight:normal;  ">
                                                           <b> 
															<?php echo $hotel_booking->hotboli_check_in_date;?>
														   </b>
														</p>
													</td>
													
													<td align="left" style="padding:10px 0 10px 0px;text-align:center; " width="117">
                                                       
                                                        <p style="font-size:14px; text-transform:uppercase; color:#333333; margin:0; font-weight:normal;  ">
                                                           <b> 
															<?php echo $hotel_booking->hotboli_check_out_date;?>
														   </b>
														</p>
													</td>
													
													<td align="left" style="padding:10px 0 10px 0px;text-align:center; " width="117">
                                                       
                                                        <p style="font-size:14px; text-transform:uppercase; color:#333333; margin:0; font-weight:normal;  ">
                                                           <b> 
															<?php echo $hotel_booking->hotboli_adult;?> Adults, <?php echo $hotel_booking->hotboli_child;?> Children
														   </b>
														</p>
													</td>
												</tr>
                                                  
										</tbody>
                                        </table>
                                    </td>
                                </tr>
								
								
								<tr>
                                    <td align="center" cellspacing="0" style="padding:0; vertical-align:middle">
									
									<?php foreach($bp_hotel_book_request['HotelRoomsDetails'] as $bp_hotel_room_detail_loop){?>
									
                                        <table border="1" width="800" style="margin-bottom: 15px!important;border-collapse:collapse; background-color:#ffffff; margin:0 0; border: 1px solid #E5E5E5;">
                                            <thead style="background-color: #00a0db;">
                                                <tr>
                                                    <td style=" text-align:center; border-radius:4px; vertical-align:middle;padding: 7px 12px;">
                                                        <p style="font-size:14px; text-transform:uppercase; color:#fff; margin:0; font-weight:900;  ">
                                                            <?php echo $bp_hotel_room_detail_loop['RoomTypeName'];?></p>
                                                    </td>
                                             
                                                     
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                  
                                                <tr>
                                                    <td align="left" style="padding:10px 0 10px 0px;text-align:center; " width="117">
                                                       
                                                        <p style="font-size:14px; text-transform:uppercase; color:#333333; margin:0; font-weight:normal;  ">
                                                            <?php foreach($bp_hotel_room_detail_loop['HotelPassenger'] as $bp_hotel_pax_loop){?>
														   <b> 
															 <?php echo $bp_hotel_pax_loop['Title'];?> <?php echo $bp_hotel_pax_loop['FirstName'];?> <?php echo $bp_hotel_pax_loop['LastName'];?> 
														   </b><br>
														    <?php }?>
														</p>
													</td>
												</tr>
										</tbody>
                                        </table>
									<?php }?>
										
										
                                    </td>
                                </tr>
												
												
												<tr>
                                                    <td align="left" style="padding:10px 0 10px 0px;text-align:center; " width="117">
                                                       
                                                        <p style="font-size:14px; text-transform:uppercase; color:#333333; margin:0; font-weight:normal;  ">
                                                           <b> 
															Booking ID: <?php echo $hotel_booking->hotboli_id;?>
														   </b>
														</p>
													</td>
												</tr>
								
                                
                               
                                <tr class="payment_details" >
                                    <td align="center" cellspacing="0" style="padding:0; vertical-align:middle">
                                        <table border="1" width="800" style="margin-bottom: 15px!important;border-collapse:collapse; background-color:#ffffff; margin:0 0; border: 1px solid #E5E5E5;">
                                            <thead style="background-color: #00a0db;">
                                                <tr>
                                                    <td colspan="3" style=" text-align:center; border-radius:4px; vertical-align:middle;padding: 7px 12px;">
                                                        <p style="font-size:14px; text-transform:uppercase; color:#fff; margin:0; font-weight:900;  ">
                                                            Payment Details</p>
                                                    </td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td rowspan="3" align="left" style="padding:10px 4px 10px 10px;;text-align:left; " width="300"><p style="font-size:14px; text-transform:uppercase; color:#333333; margin:0; font-weight:normal;  ">
                                                            This is an electronic ticket.<br>Please carry a positive identification for check in.</p></td>
                                                    <td align="left" style="padding:10px 4px 10px 10px;;text-align:left; " width="117"><p style="font-size:14px; text-transform:uppercase; color:#333333; margin:0; font-weight:normal;  ">
                                                            Room Price:</p></td>
                                                    <td align="left" style="padding:10px 0 10px 0px;text-align:center; " width="117"><p style="font-size:14px; text-transform:uppercase; color:#333333; margin:0; font-weight:normal;  ">
                                                    <i class="fa fa-inr"></i>  <?php echo $bp_base_price;?> </p></td>

                                                </tr>
                                                <tr>
                                                    <td align="left" style="padding:10px 4px 10px 10px;;text-align:left; " width="117"><p style="font-size:14px; text-transform:uppercase; color:#333333; margin:0; font-weight:normal;  ">
                                                            Tax and Additional Charge (+):</p></td>
                                                    <td align="left" style="padding:10px 0 10px 0px;text-align:center; " width="117"><p style="font-size:14px; text-transform:uppercase; color:#333333; margin:0; font-weight:normal;  ">
                                                    <i class="fa fa-inr"></i>    <?php echo $bp_tax;?> </p></td>

                                                </tr>
                                                <tr>
                                                    <td align="left" style="padding:10px 4px 10px 10px;;text-align:left; " width="117"><p style="font-size:14px; text-transform:uppercase; color:#333333; margin:0; font-weight:normal;  ">
                                                            Total Fare:</p></td>
                                                    <td align="left" style="padding:10px 0 10px 0px;text-align:center; " width="117"><p style="font-size:14px; text-transform:uppercase; color:#333333; margin:0; font-weight:600;  ">
                                                    <i class="fa fa-inr"></i>   <?php echo  $bp_publish_fare;?> </p></td>

                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p style="padding: 0 21px;text-align: justify;font-size: 12px;margin: 0;">Carriage and other services provided by the carrier are subject to conditions of carriage which hereby incorporated by reference. These conditions may be obtained from the issuing carrier. If the passenger's journey involves an ultimate destination or stop in a country other than country of departure the Warsaw convention may be applicable and the convention governs and in most cases limits the liability of carriers for death or personal injury and in respect of loss of or damage to baggage.</p>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <table width="850" style="border-collapse:collapse;background-color:#FFF;  border-radius:5px">
                            <tbody>
                                <tr>
                                    <td colspan="4" style="vertical-align:middle;background-color: #00a0db;border-radius: 0px 0px 5px 5px;">
                                        <table style="background-color:#00a0db; width:100%; border-radius:5px 5px 0 0; border-collapse:collapse">
                                            <tbody>
                                                <tr>
                                                    <td align="center" style="vertical-align:middle; padding:22px 4px; ">
                                                        <p style="color:#FFF; font-size:18px; margin:0; ">
                                                            E & O.E
                                                        </p>
                                                    </td>
                                                    <td align="right" style="vertical-align:middle; padding:22px 50px 22px 0; ">
                                                        <p style="color:#FFF; font-size:18px; margin:0; ">
                                                            <a href="<?php echo site_url(); ?>" target="_blank" style="text-decoration:none; color:#fff; font-weight:bold;outline:0;"><?php echo site_url(); ?></a>
                                                        </p>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <p style="color:red;">This is Computer Generated Invoice does not required signature.</p>
                    </td>
                </tr>
                <!-- <tr>
                    <td align="center" style="padding-top:0px; padding-bottom:10px">
                        <table style="width:100%">
                            <tbody>
                            <tr>
                                <td align="center" style="">
                                    <a href="https://www.tripsarathi.com" target="_blank" style="color:#00a0db  ; text-decoration:none;outline:0;"><img src="img/logo.png" border="0"></a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr> -->
            </tbody>
        </table>
		</div>
		<?php if($isEmail == "false"){ ?>
        <div style="text-align: center;">
		<div class="" style="padding-top: 10px;padding-bottom: 15px;">
									<div class="btn-group">
                                      <button data-toggle="modal" data-target="#sendmailmodel"  class="btn btn-primary"><span class="glyphicon glyphicon-envelope"></span> E-mail Ticket </button>
									</div>
                            
		</div>
		</div>
	<?php } ?>
  
    </body>
</body>
</html>

<?php if($isEmail == "false"){ ?>
<div class="modal fade bs-example-modal-sm" id="sendmailmodel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document" style="top: 80px;">
            <div class="modal-content" style="border: 30px solid #eeeeee;">
            <div class="modal-body">
			 <div class="modal-header">
				 <button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Email E-Ticket</h4>					
			 </div>
              <div class="form-group">
			    <div id="error_msg_email" class = "alert alert-danger" style="display:none;"></div>
                <label for="recipient-name" class="control-label">Subject</label>
                <input type="text" id="subject"   class="form-control" required id="recipient-name"/>
              </div>
              <div class="form-group">
                <label for="recipient-name" class="control-label"> To Email </label>
                <input type="text" id="mail_id_user" required class="form-control"/>
              </div>
            </div>
                <div class="modal-footer">
                <div class="bp_email_data_put" style="display:none;">
                
                </div>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="button" onclick="sendmail()"  class="btn btn-primary">Send</button>
                </div>
              </div>
            </div>
          </div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="<?php echo site_url(); ?>assets/js/vendor/bootstrap/bootstrap.min.js"></script>
<script>
             function printticket(divName) {
                     var printContents = document.getElementById(divName).innerHTML;
                     var originalContents = document.body.innerHTML;

                     document.body.innerHTML = printContents;

                     window.print();

                     document.body.innerHTML = originalContents;
                }
                
            function sendmail(){
					var email_reg = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
                    var valuesubj= document.getElementById('subject').value;
                    var mnailiduser= document.getElementById('mail_id_user').value;
                    if(valuesubj==""){
						$('#error_msg_email').html("Please enter a subject");
						$('#error_msg_email').show();
						return false;
					}
					if(mnailiduser==""){
						$('#error_msg_email').html("Please enter an email");
						$('#error_msg_email').show();
						return false;
					}
					if(email_reg.test(mnailiduser)==false){
						$('#error_msg_email').html("Please enter a valid email address");
						$('#error_msg_email').show();
						return false;
					}
					$('#error_msg_email').hide();
					var ref_id = '<?php echo $hotel_booking->hotboli_id; ?>';
                    $.ajax({
                        type:"GET",
                        url:"<?php echo site_url('b2c_hotel/get_voucher'); ?>",
                        data:{ref_id:ref_id,valuesubj:valuesubj,mnailiduser:mnailiduser},
						
                        beforeSend:function(){
              	    	  $(".bp_email_data_put").html('<img src="<?php echo site_url();?>assets/images/loading2.gif">');
              	    	  $('.bp_email_data_put').show();
              	      },
                        success:function(data)  {
                            // alert(data);
                        	 $('.bp_email_data_put').hide();
                           alert("Mail Successfully Send");
                        },
                    });
                }
				</script>
	<?php } ?>
 


   


