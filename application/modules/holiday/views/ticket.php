<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="<?php echo site_url(); ?>assets/holiday/css/font-awesome.min.css">
  <title>E-Ticket</title>
</head>

<body>
  <head><style type="text/css">

    .main_tbl{
	margin:0 auto; width:100%; border-collapse:collapse; background-color:#EEEEEE; font-family:'Roboto', Arial !important
}
.main_tbl_td1{
	padding:20px 23px 0 23px
}
.main_tbl2{
	background-color:#FFF; margin:0 auto; border-radius:5px;width:850px;
}
.main_tbl3{
	margin:0 auto;width:800px;
}
.logo_td{
	padding: 12px 0 8px 0;
}
.logo_td a{
	color:#128ced; text-decoration:none;outline:0;
}
.title{
	margin:0; font-weight:bold; font-size:18px; color:#444; font-family:'Roboto', Arial !important
}
.comp_add_td{
	padding:0 0 30px 0; vertical-align:middle
}
.comp_add_tbl{
	border-collapse:collapse; background-color:#FaFaFa; margin:0 auto; border:1px solid #E5E5E5;width:800px;
}
.comp_name_label{
	vertical-align:top; padding:18px 18px 8px 23px; font-family:'Roboto', Arial !important
}
.comp_name_label p{
	font-size:16px; color:#333333; text-transform:uppercase; font-weight:900; margin:0; font-family:'Roboto', Arial !important
}
.address{
	vertical-align:top; padding:0 18px 18px 23px; font-family:'Roboto', Arial !important
}
.address_details{
	font-family:'Roboto', Arial !important;
}
.address_details p{
	font-size:16px; color:#000; margin:0;padding:0; font-family:'Roboto', Arial !important
}
.pnr_details{
	vertical-align:top; border-right:1px solid #E5E5E5;width:276;
}
.pnr_title{
	vertical-align:top; padding:18px 18px 8px 23px; font-family:'Roboto', Arial !important
}
.pnr_title p{
	font-size:16px; color:#333333; text-transform:uppercase; font-weight:900; margin:0; font-family:'Roboto', Arial !important
}
.td_pd{
	vertical-align:top; padding:0 18px 18px 23px
}
.pnr_label{
	font-family:'Roboto', Arial !important
}
.pnr_label p{
	font-size:16px; color:#000; margin:0 0 5px 0; font-family:'Roboto', Arial !important
}
.details_label_title{
	margin: 0;
	padding: 10px 20px;
	
   }
.ticket_list_tbl{
	margin-bottom: 15px!important;border-collapse:collapse; background-color:#FaFaFa; margin:0 auto; width:800px;border-color: #E5E5E5 !important;border: 1px solid;
}
.ticket_list_tbl thead{
	
        border-color: #E5E5E5 !important;
        border: 1px solid;
}
.ticket_list_tbl thead tr td{
	font-family:'Roboto', Arial !important; text-align:center; border-radius:4px; vertical-align:middle;padding: 7px 12px;border-right: 1px solid #E5E5E5;
}
.ticket_list_tbl thead tr td p{
	font-size:14px; text-transform:uppercase; color:#333333; margin:0; font-weight:900; font-family:'Roboto', Arial !important;
}
.ticket_list_tbl tbody tr td{
	padding:10px 0 10px 0px;text-align:center; font-family:'Roboto', Arial !important;width:117px;border-right: 1px solid #E5E5E5;border-bottom: 1px solid #E5E5E5;
}
.ticket_list_tbl tbody tr td p{
	font-size:14px; text-transform:uppercase; color:#333333; margin:0; font-weight:normal; font-family:'Roboto', Arial !important; 
}
td.width_lg {
    width: 300px !important;
}
.description{
	padding: 0 21px;text-align: justify;font-size: 12px;margin: 0;
}
.eoe_tbl1{
	border-collapse:collapse;background-color:#FFF; font-family:'Roboto', Arial !important; border-radius:5px;width:850px;
}
.eoe_tbl1_td{
	vertical-align:middle;border-radius: 0px 0px 5px 5px; color:#000;
}
.eoe_tbl2{
 width:100%; border-radius:5px 5px 0 0; border-collapse:collapse; background: #2a2d94;
}
.eoe_tbl2 tr td{
	vertical-align:middle; padding:22px 4px; font-family:'Roboto', Arial !important
}
.eoe_tbl2 tr td p{
	color:#FFF; font-size:18px; margin:0; font-family:'Roboto', Arial !important
}
.eoe_tbl2 tr td p a{
	text-decoration:none; color:#FFF; font-weight:bold;outline:0;
}
.txt-align{
	text-align:right;
	padding-right: 21px;
}
.color_red{
	color:red;
}

</style>
</head><body style="margin: 0; padding: 0;background-color:#EEEEEE;">
<table class="main_tbl" cellspacing="0">
    <tbody>
    <tr>
        <td class="main_tbl_td1" align="center">
            <table class="main_tbl2">
                <tbody>
                <tr>
                    <td align="center">
                        <table class="main_tbl3">
                            <tbody>
<tr>
    <td class="logo_td" align="left"><a href="<?php echo site_url(); ?>" target="_blank">
 
    <img src="<?php echo site_url(); ?>admin/assets/img/logos/logo.png" border="0"> </a>
    </td>
	<td align="right" style="font-family:'Roboto', Arial !important">
                                    <h2 class="title">
                                        E-Booking
                                    </h2>
                                </td>
</tr>                           
                            
                            </tbody>
                        </table>
                    </td>
                </tr>
<tr>
    <td class="comp_add_td" align="center" cellspacing="0">
        <table class="comp_add_tbl">
            <tbody>
            <tr>
                    <td style="vertical-align:top">
                            <table width="100%" style="border-collapse:collapse">
                                <tbody>
                                <tr>
                                    <td class="comp_name_label">
                                        <p>
                                          <?php echo $this->dsa_data->dsa_company_name ; ?>
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="address">
                                        <table width="100%" style="border-collapse:collapse">
                                            <tbody>
                                            <tr>
                                                <td class="address_details">
                                                    <p>
                                                        <?php echo $this->dsa_setting->dsaset_address_1 ; ?>
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="address_details">
                                                    <p>
                                                    Phone: <?php echo $this->dsa_setting->dsaset_phone ; ?>
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
            </tbody>
        </table>
    </td>
</tr>   

 <?php
          $idet = 1;
          foreach ($result as $resultsss){ ?>
		        <tr>
                            <td>
                                <p class="details_label_title" style="background-color: #2a2d94;color:#fff;"><b><?php echo $resultsss["tourdetail"]->holiday_name; ?> </b></p>
                            </td>
                </tr> 
		  
                        <tr>
                            <td>
                                <p class="details_label_title"><?php echo $resultsss["tourdetail"]->holiday_name; ?> : Passenger Detail</p>
                            </td>
                        </tr>                    
                        <tr>
                            <td align="center" cellspacing="0" style="padding:0; vertical-align:middle">
                                <table class="ticket_list_tbl">
                                    <thead>
                                        <tr>
                                            <td>
                                                <p>
                                                    Passenger Name</p>
                                            </td>
                                            <td>
                                                <p>Passenger type
                                                    </p>
                                            </td>
                                            <td>
                                                <p>
                                                    Passprot Number</p>
                                            </td>
                                        </tr>
                                    </thead>
                                    <tbody>
            <?php
            $paxno = 1;
            foreach ($resultsss["bookingPax"] as $paxdeta){ ?>
                                    <tr>
                                        <td align="left"><p>
                                            <?php echo $paxno.'. '; ?> <?php echo $paxdeta->holpax_title; ?> <?php echo $paxdeta->holpax_first_name; ?> <?php echo $paxdeta->holpax_last_name; ?></p></td>
                                        <td align="left"><p>
                                           <?php echo $paxdeta->holpax_type; ?></p></td>
                                        <td><p>
                                           <?php echo $paxdeta->holpax_passport_number; ?></p></td>
                                            
                                    </tr>
            <?php $paxno++; } ?>  
                                    </tbody>
                                </table>
                            </td>
                        </tr>



                        
                        
                        
                        
                            <tr>
                                <td>
                                    <p class="details_label_title"><?php echo $resultsss["tourdetail"]->holiday_name; ?> :Booking Detail</p>
                                </td>
                            </tr>
                            <tr>
                                <td align="center" cellspacing="0" style="padding:0; vertical-align:middle">
                                    <table class="ticket_list_tbl">
                                        <thead>
                                            <tr>
                                                <td>
                                                    <p>
                                                        Tour</p>
                                                </td>
                                                <td>
                                                    <p>
                                                        Pick Point</p>
                                                </td>
                                                <td>
                                                    <p>
                                                        Date</p>
                                                </td>
                                                <td>
                                                    <p>
                                                        Status</p>
                                                </td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td align="left">
                                                <img src="<?php echo site_url(); ?>admin/assets/img/holiday/thumbs/<?php echo $resultsss["tourdetail"]->holiday_feature_image; ?>">
                                                <p>
                                                <?php echo $resultsss["tourdetail"]->holiday_name; ?></p></td>
                                            <td align="left"><p>
                                               <?php echo $resultsss["bookingdetail"]->holbook_pickup_point; ?></p></td>
                                            <td align="left"><p>
                                                <?php echo GetdateDay($resultsss["bookingdetail"]->holbook_tour_start_date); ?></p></td>
                                            <td align="left"><p>
                                            <?php echo $resultsss["bookingdetail"]->holbook_booking_status; ?>     </p></td>
                                                    
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                    

      <?php                         
if ($resultsss["extra"][0] != NULL )  
{    

 ?>                      
                            <tr>
                            <td>
                                <p class="details_label_title"><?php echo $resultsss["tourdetail"]->holiday_name; ?> : Extra Tour</p>
                            </td>
                        </tr>                    
                        <tr>
                            <td align="center" cellspacing="0" style="padding:0; vertical-align:middle">
                                <table class="ticket_list_tbl">
                                    <thead>
                                        <tr>
                                            <td>
                                                <p>
                                                   Extra Tour </p>
                                            </td>
                                            <td>
                                                <p>Extra Tour Name
                                                    </p>
                                            </td>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                        <?php
  
                        foreach ($resultsss["extra"] as $extra) {
                        ?>


                                    <tr>
                                        <td align="left"><p>
                                        <img src="<?php echo site_url(); ?>admin/assets/img/extratour/thumbs/<?php echo $extra[0]->holextra_image ?>" class="airline-img" style="max-height: 50px;">   </p></td>
                                        <td align="left"><p>
                                        <?php echo $extra[0]->holextra_name ?> </p></td>
                                            
                                    </tr>
            <?php  } ?>  
                                    </tbody>
                                </table>
                            </td>
                        </tr>


<?php } ?>


                            
                    <tr>
                            <td>
                                <p class="details_label_title"><?php echo $resultsss["tourdetail"]->holiday_name; ?> : Contact Person</p>
                            </td>
                        </tr>                    
                        <tr>
                            <td align="center" cellspacing="0" style="padding:0; vertical-align:middle">
                                <table class="ticket_list_tbl">
                                    <thead>
                                        <tr>
                                            <td>
                                                <p>
                                                    Name</p>
                                            </td>
                                            <td>
                                                <p>phone
                                                    </p>
                                            </td>
                                            <td>
                                                <p>
                                                    Email</p>
                                            </td>
                                        </tr>
                                    </thead>
                                    <tbody>
            
                                    <tr>
                                        <td align="left"><p>
                                      <?php echo $resultsss["bookingdetail"]->holbook_contact_person_name; ?>   </p></td>
                                        <td align="left"><p>
                                        <?php echo $resultsss["bookingdetail"]->holbook_contact_phone; ?>  </p></td>
                                        <td><p>
                                        <?php echo $resultsss["bookingdetail"]->holbook_contact_email; ?>   </p></td>
                                            
                                    </tr> 
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                                 
                    <tr>
					
					<td> &nbsp;</td>
					
                     </tr>					
                            
                            
                            
                     <?php $idet++; } ?>        
                            
                            
                        <tr>
                            <td align="center" cellspacing="0" style="padding:0; vertical-align:middle">
                                <table class="ticket_list_tbl">
                                    <thead >
                                        <tr>
                                            <td colspan="3" style="font-family:'Roboto', Arial !important; text-align:center; border-radius:4px; vertical-align:middle;padding: 7px 12px;">
                                                <p style="font-size:14px; text-transform:uppercase; color:#333333; margin:0; font-weight:900; font-family:'Roboto', Arial !important; ">
                                                    Payment Details</p>
                                            </td>
                                        </tr>
                                    </thead>
                                    <?php
                                             $total = 0;
                                   foreach ($result as $resultsss ){ 
                                       
                                  $total=$total+$resultsss["bookingdetail"]->holbook_amount;
                                  }
                                   
                                   ?>
                                    <tbody>
                                    <tr>
                                        <td class="width_lg" rowspan="3" align="left"><p >
                                            This is an electronic ticket.<br>Please carry a positive identification for check in.</p></td>
                                        <td align="left"><p>
                                            Fare:</p></td>
                                        <td align="left"><p>
										   <?php  set_Currency ($this->dsa_setting->dsaset_currency_symbol,$total); ?>
                                    </tr>
                                    <tr>
                                        <td align="left"><p>
                                            Fee & Surcharge:</p></td>
                                        <td align="left"><p>
                                         <?php current_Currency_icon($this->dsa_setting->dsaset_currency_symbol) ?>   0</p></td>
                                            
                                    </tr>
                                    <tr>
                                        <td align="left"><p>
                                            Total Air Fare:</p></td>
                                        <td align="left"><p>
                                            <?php  set_Currency ($this->dsa_setting->dsaset_currency_symbol,$total); ?></p></td>
                                            
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                               <p class="description">Carriage and other services provided by the carrier are subject to conditions of carriage which hereby incorporated by reference. These conditions may be obtained from the issuing carrier. If the passenger's journey involves an ultimate destination or stop in a country other than country of departure the Warsaw convention may be applicable and the convention governs and in most cases limits the liability of carriers for death or personal injury and in respect of loss of or damage to baggage.</p>
                            </td>
                        </tr>
    
    </tbody>
            </table>
        </td>
    </tr>
<tr>
    <td align="center">
        <table class="eoe_tbl1" width="850" style="">
            <tbody>
            <tr>
                <td class="eoe_tbl1_td" colspan="4">
                    <table class="eoe_tbl2" style="">
                        <tbody>
                        <tr>
                            <td align="center">
                                <p>
                                    E & O.E
                                </p>
                            </td>
                            <td>
                                <p class="txt-align">
                                     <a href="<?php echo site_url(); ?>" target="_blank"><?php echo site_url(); ?></a>
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
        <p class="color_red">This is Computer Generated Invoice does not required signature.</p>
    </td>
</tr>
<!-- <tr>
    <td align="center" style="padding-top:0px; padding-bottom:10px">
        <table style="width:100%">
            <tbody>
            <tr>
                <td align="center" style="font-family:'Roboto', Arial !important">
                    <a href="https://www.tripsarathi.com" target="_blank" style="color:#128ced; text-decoration:none;outline:0;"><img src="img/logo.png" border="0"></a>
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
