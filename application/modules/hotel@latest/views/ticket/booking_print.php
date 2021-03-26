<!DOCTYPE html>
<?php
$bp_hotel_result = $_SESSION ['hotel'] ['array'] ['search_result'];
$bp_hotel_detail = $_SESSION ['hotel'] ['array'] ['hotel_info_result']->HotelInfoResult->HotelDetails;
$bp_room_result = $_SESSION ['hotel'] ['array'] ['hotel_room_result']->GetHotelRoomResult;
$bp_room_detail = $_SESSION ['hotel'] ['array'] ['hotel_room_result']->GetHotelRoomResult->HotelRoomsDetails;
$bp_post_data_from_result = $_SESSION ['hotel'] ['array'] ['hotel_info_request_post'];
$bp_rooms = 0;
$bp_adult = 0;
$bp_child = 0;
foreach ( $bp_hotel_result->HotelSearchResult->RoomGuests as $no_of_room_loop ) {
	$bp_rooms = $bp_rooms + 1;
	$bp_adult = $bp_adult + $no_of_room_loop->NoOfAdults;
	$bp_child = $bp_child + $no_of_room_loop->NoOfChild;
}
$bp_pax_request = $_SESSION ['hotel'] ['array'] ['search_request'] ['RoomGuests'];
$bp_hotel_block_result=$_SESSION ['hotel'] ['array'] ['hotel_block_result']->BlockRoomResult;
$bp_hotel_one_room_detail=$_SESSION ['hotel'] ['array'] ['hotel_block_result']->BlockRoomResult->HotelRoomsDetails[0];
$bp_base_price=$bp_hotel_one_room_detail->Price->RoomPrice;
$bp_publish_fare=$bp_hotel_one_room_detail->Price->PublishedPrice;
$bp_tax=$bp_publish_fare-$bp_base_price;
$_SESSION ['hotel'] ['array'] ['publish_fare'];
$bp_book_result=$_SESSION ['hotel'] ['array'] ['hotel_book_result'];
$bp_hotel_book_request=$_SESSION ['hotel'] ['array'] ['hotel_book_request']; 
$bp_customer_price=bp_get_hotel_fare($bp_hotel_one_room_detail->Price->OfferedPriceRoundedOff,$bp_hotel_one_room_detail->Price->PublishedPriceRoundedOff)['final_fare'];
?>


<!------new---->

<!------new end---->
<html >
    <head>
        <meta charset="UTF-8">
        <title>HOTEL VOUCHER</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>

    <body>
    <head>

    </head>
	<body style="margin: 0; padding: 0;background-color:#EEEEEE;">
	<div style="max-width: 862px; margin: 15px auto; width: 100%;    padding: 25px; font-size: 14px;background: #fff;">
       <table border="0" cellpadding="0" cellspacing="0" style="width: 100%; border-spacing: 0px;border-collapse
		: colapse;">
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
                                                    <td align="left" style="padding: 12px 0 8px 0;"><a href="<?php echo site_url();?>admin/assets/img/logos/<?php echo $this->dsa_data->dsa_logo;?>" target="_blank" style="color:#d8d8d8; text-decoration:none;outline:0;"><img width="20%" src="<?php echo site_url();?>admin/assets/img/logos/<?php echo $this->dsa_data->dsa_logo;?>" border="0"></a>
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
                                                                            <?php echo $this->dsa_data->dsa_company_name;?>
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
                                                                                            <?php echo $this->dsa_data->dsa_address;?>,<br> <?php echo $this->dsa_data->dsa_city;?>, <?php echo $this->dsa_data->dsa_state;?>, <?php echo $this->dsa_data->dsa_country;?>
                                                                                            <?php echo $this->dsa_data->dsa_support_mobile;?>
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
                                                                           <?php echo $bp_book_result->BookResult->ConfirmationNo;?>
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
                                                
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
								
								  <tr>
                                    <td align="center" cellspacing="0" style="padding:0; vertical-align:middle">
                                        <table border="" width="800" style="margin-bottom: 15px!important;border-collapse:collapse; background-color:#ffffff; margin:0 0;border: 1px solid #E5E5E5;">
                                            <thead style="background-color: #00a0db;">
                                                <tr>
                                                    <td style=" text-align:center; border-radius:4px; vertical-align:middle;padding: 7px 12px;">
                                                        <p style="font-size:14px; text-transform:uppercase; color:#FFF; margin:0; font-weight:900;  ">
                                                           Hotel Contact Number</p>
                                                    </td>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
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
															<?php echo $bp_hotel_result->HotelSearchResult->CheckInDate;?>
														   </b>
														</p>
													</td>
													
													<td align="left" style="padding:10px 0 10px 0px;text-align:center; " width="117">
                                                       
                                                        <p style="font-size:14px; text-transform:uppercase; color:#333333; margin:0; font-weight:normal;  ">
                                                           <b> 
															<?php echo $bp_hotel_result->HotelSearchResult->CheckOutDate;?>
														   </b>
														</p>
													</td>
													
													<td align="left" style="padding:10px 0 10px 0px;text-align:center; " width="117">
                                                       
                                                        <p style="font-size:14px; text-transform:uppercase; color:#333333; margin:0; font-weight:normal;  ">
                                                           <b> 
															<?php echo $bp_adult;?> Adults, <?php echo $bp_child;?> Children
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
															Booking ID: <?php echo $bp_book_result->BookResult->BookingRefNo;?>
														   </b>
														</p>
													</td>
												</tr>
								
                                
                               
                                <tr>
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
                                                    <i class="fa fa-inr"></i>    <?php echo round($bp_hotel_one_room_detail->Price->RoomPrice);?> </p></td>

                                                </tr>
                                                <tr>
                                                    <td align="left" style="padding:10px 4px 10px 10px;;text-align:left; " width="117"><p style="font-size:14px; text-transform:uppercase; color:#333333; margin:0; font-weight:normal;  ">
                                                            Tax and Additional Charge (+):</p></td>
                                                    <td align="left" style="padding:10px 0 10px 0px;text-align:center; " width="117"><p style="font-size:14px; text-transform:uppercase; color:#333333; margin:0; font-weight:normal;  ">
                                                    <i class="fa fa-inr"></i><?php echo round($bp_customer_price-$bp_hotel_one_room_detail->Price->RoomPrice);?></p></td>

                                                </tr>
                                                <tr>
                                                    <td align="left" style="padding:10px 4px 10px 10px;;text-align:left; " width="117"><p style="font-size:14px; text-transform:uppercase; color:#333333; margin:0; font-weight:normal;  ">
                                                            Total Fare:</p></td>
                                                    <td align="left" style="padding:10px 0 10px 0px;text-align:center; " width="117"><p style="font-size:14px; text-transform:uppercase; color:#333333; margin:0; font-weight:600;  ">
                                                    <i class="fa fa-inr"></i>   <?php echo $bp_customer_price;?> </p></td>

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
    </body>
</body>
</html>
