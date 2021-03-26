<!DOCTYPE html>
<?php
// $bp_pax_request = $_SESSION ['hotel'] ['array'] ['search_request'] ['RoomGuests'];
$bp_pax_details = $pax_details;
// PrintArray($_SESSION ['hotel'] ['array'] ['hotel_info_result']);
$bp_hotel_result = $booking_details;
$bp_room_detail = $room_details;
// $bp_rooms = $bp_hotel_result['room'];
// $bp_nights = $bp_hotel_result['nights'];
// echo"<pre>";
// print_r($bp_room_detail);
// die;
// $bp_rooms = $bp_hotel_result['room'] ;
// $bp_nights = $bp_hotel_result['nights'] ;
// $bp_adults = $bp_hotel_result['adult_1'];
// $no_adult = 0;
// $no_child = 0;
// for($i = 1; $i <= $bp_rooms; $i ++) {
				// $data ["adult_" . $i] = $bp_hotel_result['adult_' . $i];
				// $no_adult =  $no_adult + $bp_hotel_result['adult_' . $i];
				// $data ["child_" . $i] = $bp_hotel_result['child_' . $i];
				// $no_child =  $no_child + $bp_hotel_result['child_' . $i];
// }

			// $_SESSION ['Hotel']['No_Of_Adults'] = $no_adult;
			// $_SESSION ['Hotel']['No_Of_child'] = $no_child;
			

// $bp_hotel_detail = $_SESSION ['hotel'] ['array'] ['hotel_detail'];
// $bp_room_detail = $_SESSION ['hotel'] ['amount'] ['room_detail'];
// $bp_total_customer_fare = $_SESSION ['hotel'] ['amount'] ['customer_fare'];
// $bp_base_fare = $_SESSION ['hotel'] ['amount'] ['base_fare'];
// $bp_tax = $_SESSION ['hotel'] ['amount'] ['tax'];
// $room_details = $_SESSION['Hotel_offline']['room_details'];
// $hotel_details = $_SESSION['Hotel_offline']['hotel_details'];
?>



<html>

<head>
    <!-- Meta Tag Start From here -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Meta Tag end From here -->
    <meta name="agd-partner-manual-verification" />
    <title>HOTEL VOUCHER</title>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
    <style>
        img{
            width: 50%;
            height: 5%;
        }
    </style>
</head>

<body>

    <head>

    </head>

    <body style="margin: 0; padding: 0;background-color:#EEEEEE;">
        <table cellspacing="0" style="margin:0 0; width:100%; border-collapse:collapse; background-color:#EEEEEE; ">
            <tbody>
                <tr>
                    <td align="center" style="padding:20px 23px 0 23px">
                        <!--  -->
                        <table width="850" style="background-color:#FFF; margin:0 0; border-radius:5px">
                            <tbody>
                                <tr>
                                    <td align="center">
                                        <table width="800" style="margin:0 0">
                                            <tbody>
                                                <tr>
                                                    <td align="left" style="padding: 12px 0 8px 0;"><a
                                                            href="<?php echo $this->dsa_data->dsa_admin_url;?>assets/img/logos/<?php echo $this->dsa_data->dsa_logo;?>"
                                                            target="_blank"
                                                            style="color:#d8d8d8; text-decoration:none;outline:0;"><img
                                                                width="20%"
                                                                src="<?php echo $this->dsa_data->dsa_admin_url;?>assets/img/logos/<?php echo $this->dsa_data->dsa_logo;?>"
                                                                border="0"></a>
                                                    </td>
                                                    <td align="right" style="">
                                                        <h2
                                                            style="margin:0; font-weight:bold; font-size:18px; color:#444; ">
                                                            HOTEL VOUCHER
                                                        </h2>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" cellspacing="0"
                                        style="padding:0 0 30px 0; vertical-align:middle">
                                        <table width="800"
                                            style="border-collapse:collapse; background-color:#ffffff; margin:0 0; border:1px solid #E5E5E5">
                                            <tbody>
                                                <tr>
                                                    <td style="vertical-align:top">
                                                        <table width="100%" style="border-collapse:collapse">
                                                            <tbody>
                                                                <tr>
                                                                    <td
                                                                        style="vertical-align:top; padding:18px 18px 8px 23px; ">
                                                                        <p
                                                                            style="font-size:16px; color:#333333; text-transform:uppercase; font-weight:900; margin:0; ">
                                                                            <?php echo $this->dsa_data->dsa_company_name;?>
                                                                        </p>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td
                                                                        style="vertical-align:top; padding:0 18px 18px 23px; ">
                                                                        <table width="100%"
                                                                            style="border-collapse:collapse">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td style="">
                                                                                        <p
                                                                                            style="font-size:16px; color:#000; margin:0;padding:0; ">
                                                                                            <?php echo $this->dsa_data->dsa_address;?>,<br>
                                                                                            <?php echo $this->dsa_data->dsa_city;?>,
                                                                                            <?php echo $this->dsa_data->dsa_state;?>,
                                                                                            <?php echo $this->dsa_data->dsa_country;?>
                                                                                            <?php echo $this->dsa_data->dsa_support_mobile;?>
                                                                                        </p>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td style="">
                                                                                        <p
                                                                                            style="font-size:16px; color:#000; margin:0;padding:0; ">
                                                                                            Phone:
                                                                                            <?php echo $this->dsa_data->dsa_support_mobile;?><br>
                                                                                            Email ID:
                                                                                            <?php echo $this->dsa_data->dsa_support_email;?>
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
                                                    <td width="276"
                                                        style="vertical-align:top; border-right:1px solid #E5E5E5">
                                                        <table style="width:100%; border-collapse:collapse">
                                                            <tbody>
                                                                <tr>
                                                                    <td
                                                                        style="vertical-align:top; padding:18px 18px 8px 23px; ">
                                                                        <p
                                                                            style="font-size:16px; color:#333333; text-transform:uppercase; font-weight:900; margin:0; ">
                                                                            Your Booking Id:
                                                                            <?php echo $booking_details->hoffbo_id;?>
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
                                        <p style="margin: 0;padding-left: 20px;">PLEASE PRESENT THIS VOUCHER UPON
                                            ARRIVAL</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" cellspacing="0" style="padding:0; vertical-align:middle">
                                        <table border="" width="800"
                                            style="margin-bottom: 15px!important;border-collapse:collapse; background-color:#ffffff; margin:0 0;border: 1px solid #E5E5E5;">
                                            <thead style="background-color: #00a0db;">
                                                <tr>
                                                    <td
                                                        style=" text-align:center; border-radius:4px; vertical-align:middle;padding: 7px 12px;">
                                                        <p
                                                            style="font-size:14px; text-transform:uppercase; color:#FFF; margin:0; font-weight:900;  ">
                                                            <?php echo $hotel_details->hofl_hotel_name;?></p>
                                                    </td>

                                                </tr>
                                            </thead>
                                            <tbody>

                                                <tr>
                                                    <td align="left" style="padding:10px 0 10px 0px;text-align:center; "
                                                        width="117">
                                                        <p
                                                            style="font-size:14px; text-transform:uppercase; color:#333333; margin:0; font-weight:normal;  ">
                                                            <p><?php echo $hotel_details->hofl_address;?>,
                                                                <?php echo $hotel_details->hofl_city;?>,
                                                                <?php echo $hotel_details->hofl_state;?>,
                                                                <?php echo $hotel_details->hofl_country;?>,
                                                                <?php echo $hotel_details->hofl_pincode;?></p>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td align="left" style="padding:10px 0 10px 0px;text-align:center; "
                                                        width="117">
                                                        <p
                                                            style="font-size:14px; text-transform:uppercase; color:#333333; margin:0; font-weight:normal;  ">
                                                            <p><b>Hotel Contact Number : </b>
                                                                <?php if($hotel_details->hofl_phone){echo "<i class='fa fa-phone'></i>".$hotel_details->hofl_phone;} else{ echo "Contact details are not available"; } ?>
                                                            </p>
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
                                        <table border="1" width="800"
                                            style="margin-bottom: 15px!important;border-collapse:collapse; background-color:#ffffff; margin:0 0; border: 1px solid #E5E5E5;">
                                            <thead style="background-color: #00a0db;">
                                                <tr>
                                                    <td
                                                        style=" text-align:center; border-radius:4px; vertical-align:middle;padding: 7px 12px;">
                                                        <p
                                                            style="font-size:14px; text-transform:uppercase; color:#fff; margin:0; font-weight:900;  ">
                                                            Check-in</p>
                                                    </td>
                                                    <td
                                                        style=" text-align:center; border-radius:4px; vertical-align:middle;padding: 7px 12px;">
                                                        <p
                                                            style="font-size:14px; text-transform:uppercase; color:#fff; margin:0; font-weight:900;  ">
                                                            Check-out</p>
                                                    </td>
                                                    <td
                                                        style=" text-align:center; border-radius:4px; vertical-align:middle;padding: 7px 12px;">
                                                        <p
                                                            style="font-size:14px; text-transform:uppercase; color:#fff; margin:0; font-weight:900;  ">
                                                            Guests</p>
                                                    </td>


                                                </tr>
                                            </thead>
                                            <tbody>

                                                <tr>
                                                    <td align="left" style="padding:10px 0 10px 0px;text-align:center; "
                                                        width="117">

                                                        <p
                                                            style="font-size:14px; text-transform:uppercase; color:#333333; margin:0; font-weight:normal;  ">
                                                            <b>
                                                                <?php echo $booking_details->hoffbo_start_date;?>
                                                            </b>
                                                        </p>
                                                    </td>

                                                    <td align="left" style="padding:10px 0 10px 0px;text-align:center; "
                                                        width="117">

                                                        <p
                                                            style="font-size:14px; text-transform:uppercase; color:#333333; margin:0; font-weight:normal;  ">
                                                            <b>
                                                                <?php echo $booking_details->hoffbo_end_date;?>
                                                            </b>
                                                        </p>
                                                    </td>

                                                    <td align="left" style="padding:10px 0 10px 0px;text-align:center; "
                                                        width="117">

                                                        <p
                                                            style="font-size:14px; text-transform:uppercase; color:#333333; margin:0; font-weight:normal;  ">
                                                            <b>
                                                                <?php echo $booking_details->hoffbo_max_adult;?>Adults,
                                                                <?php echo $booking_details->hoffbo_max_child;?>
                                                                Children
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



                                        <table border="1" width="800"
                                            style="margin-bottom: 15px!important;border-collapse:collapse; background-color:#ffffff; margin:0 0; border: 1px solid #E5E5E5;">
                                            <thead style="background-color: #00a0db;">
                                                <tr>
                                                    <td
                                                        style=" text-align:center; border-radius:4px; vertical-align:middle;padding: 7px 12px;">
                                                        <p
                                                            style="font-size:14px; text-transform:uppercase; color:#fff; margin:0; font-weight:900;  ">
                                                            <?php echo $room_details->hoffr_room_type;?></p>
                                                    </td>



                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach($bp_pax_details as $bp_pax_key => $bp_pax_reqdetails){?>
                                                <tr>
                                                    <td align="left" style="padding:10px 0 10px 0px;text-align:center; "
                                                        width="117">

                                                        <p
                                                            style="font-size:14px; text-transform:uppercase; color:#333333; margin:0; font-weight:normal;  ">

                                                            <b>
                                                                <?php echo $bp_pax_reqdetails->hotbopax_title;?>
                                                                <?php echo $bp_pax_reqdetails->hotbopax_first_name;?>
                                                                <?php echo $bp_pax_reqdetails->hotbopax_last_name;?>
                                                            </b><br>

                                                        </p>
                                                    </td>
                                                </tr>
                                                <?php }?>
                                            </tbody>
                                        </table>



                                    </td>
                                </tr>


                                <tr>
                                    <td align="left" style="padding:10px 0 10px 0px;text-align:center; " width="117">

                                        <p
                                            style="font-size:14px; text-transform:uppercase; color:#333333; margin:0; font-weight:normal;  ">
                                            <b>
                                                Booking ID: <?php echo $booking_details->hoffbo_id;?>
                                            </b>
                                        </p>
                                    </td>
                                </tr>



                                <tr>
                                    <td align="center" cellspacing="0" style="padding:0; vertical-align:middle">
                                        <table border="1" width="800"
                                            style="margin-bottom: 15px!important;border-collapse:collapse; background-color:#ffffff; margin:0 0; border: 1px solid #E5E5E5;">
                                            <thead style="background-color: #00a0db;">
                                                <tr>
                                                    <td colspan="3"
                                                        style=" text-align:center; border-radius:4px; vertical-align:middle;padding: 7px 12px;">
                                                        <p
                                                            style="font-size:14px; text-transform:uppercase; color:#fff; margin:0; font-weight:900;  ">
                                                            Payment Details</p>
                                                    </td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td rowspan="3" align="left"
                                                        style="padding:10px 4px 10px 10px;;text-align:left; "
                                                        width="300">
                                                        <p
                                                            style="font-size:14px; text-transform:uppercase; color:#333333; margin:0; font-weight:normal;  ">
                                                            This is an electronic ticket.<br>Please carry a positive
                                                            identification for check in.</p>
                                                    </td>
                                                    <td align="left"
                                                        style="padding:10px 4px 10px 10px;;text-align:left; "
                                                        width="117">
                                                        <p
                                                            style="font-size:14px; text-transform:uppercase; color:#333333; margin:0; font-weight:normal;  ">
                                                            Room Price:</p>
                                                    </td>
                                                    <td align="left" style="padding:10px 0 10px 0px;text-align:center; "
                                                        width="117">
                                                        <p
                                                            style="font-size:14px; text-transform:uppercase; color:#333333; margin:0; font-weight:normal;  ">
                                                            <i
                                                                class=""></i><?php echo $this->bp_white_label_setting->wls_currency_symbol;?>
                                                            <?php echo dsa_currency_convert($booking_details->hoffbo_basic_fare);?>
                                                        </p>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td align="left"
                                                        style="padding:10px 4px 10px 10px;;text-align:left; "
                                                        width="117">
                                                        <p
                                                            style="font-size:14px; text-transform:uppercase; color:#333333; margin:0; font-weight:normal;  ">
                                                            Tax and Additional Charge (+):</p>
                                                    </td>
                                                    <td align="left" style="padding:10px 0 10px 0px;text-align:center; "
                                                        width="117">
                                                        <p
                                                            style="font-size:14px; text-transform:uppercase; color:#333333; margin:0; font-weight:normal;  ">
                                                            <i
                                                                class=""></i><?php echo $this->bp_white_label_setting->wls_currency_symbol;?>
                                                            <?php echo dsa_currency_convert($booking_details->hoffbo_tax);?>
                                                        </p>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td align="left"
                                                        style="padding:10px 4px 10px 10px;;text-align:left; "
                                                        width="117">
                                                        <p
                                                            style="font-size:14px; text-transform:uppercase; color:#333333; margin:0; font-weight:normal;  ">
                                                            Total Fare:</p>
                                                    </td>
                                                    <td align="left" style="padding:10px 0 10px 0px;text-align:center; "
                                                        width="117">
                                                        <p
                                                            style="font-size:14px; text-transform:uppercase; color:#333333; margin:0; font-weight:600;  ">
                                                            <i
                                                                class=""></i><?php echo $this->bp_white_label_setting->wls_currency_symbol;?>
                                                            <?php echo dsa_currency_convert($booking_details->hoffbo_publish_fare);?>
                                                        </p>
                                                    </td>

                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p style="padding: 0 21px;text-align: justify;font-size: 12px;margin: 0;">
                                            Carriage and other services provided by the carrier are subject to
                                            conditions of carriage which hereby incorporated by reference. These
                                            conditions may be obtained from the issuing carrier. If the passenger's
                                            journey involves an ultimate destination or stop in a country other than
                                            country of departure the Warsaw convention may be applicable and the
                                            convention governs and in most cases limits the liability of carriers for
                                            death or personal injury and in respect of loss of or damage to baggage.</p>
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
                                    <td colspan="4"
                                        style="vertical-align:middle;background-color: #00a0db;border-radius: 0px 0px 5px 5px;">
                                        <table
                                            style="background-color:#00a0db; width:100%; border-radius:5px 5px 0 0; border-collapse:collapse">
                                            <tbody>
                                                <tr>
                                                    <td align="center"
                                                        style="vertical-align:middle; padding:22px 4px; ">
                                                        <p style="color:#FFF; font-size:18px; margin:0; ">
                                                            E & O.E
                                                        </p>
                                                    </td>
                                                    <td align="right"
                                                        style="vertical-align:middle; padding:22px 50px 22px 0; ">
                                                        <p style="color:#FFF; font-size:18px; margin:0; ">
                                                            <a href="<?php echo $this->dsa_data->dsa_b2c_url; ?>"
                                                                target="_blank"
                                                                style="text-decoration:none; color:#fff; font-weight:bold;outline:0;"><?php echo $this->dsa_data->dsa_b2c_url; ?></a>
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
    </body>
</body>

</html>