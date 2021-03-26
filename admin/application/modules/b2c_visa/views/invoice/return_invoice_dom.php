<!DOCTYPE html>
<?php //print_r($SelectedFare->Response->FlightItinerary->Passenger[0]->Fare); 
//die;
$add_transction_disc = $BookingDetails->fbook_transaction_fee;
$BookingDetails->fbook_customer_fare = $BookingDetails->fbook_customer_fare + $add_transction_disc;
?>
<html >
<head>
  <meta charset="UTF-8">
  <title>Invoice</title>
</head>

<body>
  <head><style type="text/css">
    @import url(https://fonts.googleapis.com/css?family=Roboto:400,300,500,700,700italic,900);
    body { font-family: 'Roboto', Arial, sans-serif !important; }
    a[href^="tel"]{
        color:inherit;
        text-decoration:none;
        outline:0;
    }
    a:hover, a:active, a:focus{
        outline:0;
    }
    a:visited{
        color:#FFF;
    }
    span.MsoHyperlink {
        mso-style-priority:99;
        color:inherit;
    }
    span.MsoHyperlinkFollowed {
        mso-style-priority:99;
        color:inherit;
    }
</style>
</head><body style="margin: 0; padding: 0;background-color:#EEEEEE;">
<table cellspacing="0" style="margin:0 auto; width:100%; border-collapse:collapse; background-color:#EEEEEE; font-family:'Roboto', Arial !important">
    <tbody>
    <tr>
        <td align="center" style="padding:20px 23px 0 23px">
            <table width="800" style="background-color:#FFF; margin:0 auto; border-radius:5px">
                <tbody>
                
<tr>
    <td align="center" cellspacing="0" style="padding:0 0 0px 0; vertical-align:middle">
        <table width="700" style="border-collapse:collapse; background-color:white; margin:0 auto; border-bottom:2px solid #E5E5E5">
            <tbody>
            <tr>
                <td style="vertical-align:top">
                    <table width="100%" style="border-collapse:collapse">
                        <tbody>
                        <tr>
                            <td style="vertical-align:top; padding:18px 18px 8px 0px; font-family:'Roboto', Arial !important">
                                <p style="font-size:16px; color:#333333; text-transform:uppercase; font-weight:900; margin:0; font-family:serif !important">
                                    <?php echo $this->user_data->dsa_company_name;?>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align:top; padding:0 18px 0px 0px; font-family:'Roboto', Arial !important">
                                <table width="100%" style="border-collapse:collapse">
                                    <tbody>
                                    <tr>
                                        <td style="font-family:'Roboto', Arial !important;">
                                          <p style="font-size:12px; color:#000; margin:0;padding:0; font-family:serif;">
                                               <?php echo $this->dsa_setting->dsaset_address_1;?>,<br> <?php echo $this->dsa_setting->dsaset_city;?>, <?php echo $this->dsa_setting->dsaset_state;?>, <?php echo $this->dsa_setting->dsaset_country;?>
                                            </p>
                                            
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="font-family:serif !important;">
                                            <p style="font-size:12px; color:#000; margin:0 0 5px 0; font-family:serif !important">
                                                (E): <?php echo $this->dsa_setting->dsaset_email;?>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-family:serif !important">
                                            <p style="font-size:12px; color:#000; margin:0 0 5px 0; font-family:serif !important">
                                                (H): <?php echo $this->dsa_setting->dsaset_phone;?>
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
				<td width="276" style="vertical-align:top;">
                    <table style="width:100%; border-collapse:collapse">
                        <tbody>
                        <tr style="">
                            <td style="vertical-align:top;">
                                <table style="width:100%; border-collapse:collapse">
                        <tbody>
                        <tr style="">
                            <td style="vertical-align:top; padding:11px 18px 12px 16px;background: #d4d4d4;">
                                <table width="100%" style="border-collapse:collapse">
                                    <tbody>
                                    <tr>
                                        <td style="font-family:serif !important;padding-top: 0px;">
                                            <p style="font-size:14px; color:#000; margin:0 0 5px 0; font-family:serif !important;text-align: center;">
                                                <b>(Air Invoice : <?php echo $BookingDetails->fbook_ref_id; ?>)</b>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-family:serif !important">
                                            <p style="font-size:12px; color:#000; margin:0 0 5px 0; font-family:serif !important">
                                                <b><?php echo date_format(date_create($BookingDetails->fbook_entry_date),"d M Y");?></b>
                                            </p>
                                        </td>
										<td style="font-family:serif !important">
                                            <p style="font-size:12px; color:#000; margin:0 0 5px 0; font-family:serif !important">
                                                
                                            </p>
                                        </td>
                                    </tr>
                                      <tr>
                                        <td style="font-family:serif !important">
                                            <p style="font-size:12px; color:#000; margin:0 0 10px 0; font-family:serif !important">
                                                <b>Airline OB PNR : <?php echo $BookingDetails->fbook_ob_pnr; ?></b>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-family:serif !important">
                                            <p style="font-size:12px; color:#000; margin:0 0 10px 0; font-family:serif !important">
                                                <b>Airline IB PNR : <?php echo $BookingDetails->fbook_ib_pnr; ?></b>
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
            </tbody>
        </table>
    </td>
</tr> 

<tr>
    <td align="center" cellspacing="0" style="padding:0 0 20px 0; vertical-align:middle">
        <table width="700" style="border-collapse:collapse; background-color:white; margin:0 auto; border-bottom:1px dotted #E5E5E5">
            <tbody>
            <tr>
                <td style="vertical-align:top">
                    
                </td>
				<td width="276" style="vertical-align:top;">
                    
                </td>
            </tr>
            </tbody>
        </table>
    </td>
</tr>   

<!---====GST DETAILS=====-->				
				 <tr style="">
				<td align="center" cellspacing="0" style="padding:0; vertical-align:top">
					<table border="1" width="700" style="margin-bottom: 50px !important; border-collapse:collapse; background-color:#FaFaFa; margin:0 auto; border-color: #E5E5E5">
						<thead style="background: #d4d4d4;">
								<tr>
							<th style="width: 63%;" >
							 <p style="font-size:14px; color:#000; margin:0 0 5px 0; font-family:serif !important;text-align: center;">
								<b>Company GST Details</b>
							</p>
							</th>
							<?php if($customer_detail !="") {?>
							<th>
							 <p style="font-size:14px; color:#000; margin:0 0 5px 0; font-family:serif !important;text-align: center;">
								<b>Customer GST Details</b>
							</p>
							</th>
							<?php } else { }?>
								</tr>							
						</thead>
						<tbody>						   
						<tr>
							<td style="padding:0px;">
								<table style="width: 100%; border-spacing: 0px;">
									<tr>
									<td style="padding: 7px 12px;border-bottom: 1px solid #E5E5E5;">
									<p style="font-size:12px; color:#333333; margin:0; font-family:serif !important; ">GST Company Name : SMART RIDE TRIP PLANNER PRIVATE LIMITED </p>
									</td>
									
									</tr>
									<tr>
									<td style="padding: 7px 12px;border-bottom: 1px solid #E5E5E5;"> 
									<p style="font-size:12px; color:#333333; margin:0; font-family:serif !important; ">GST Number : 03ABBCS8350AIZU </p>
									</td>									
									</tr>
									<tr>
									<td style="padding: 7px 12px;">
									<p style="font-size:12px; color:#333333; margin:0; font-family:serif !important; ">	GST Address : SEC-32,SMART RIDE TRIP PLANNER PRIVATE LIMITED, EXT-6 SUNNY ENCLAVE, DESU MAJRA, MOHALI KHARAR, SAS NAGAR, PUNJAB. 140301  </p>
									</td>								 	
									</tr>									
								</table>
							</td>
							
							<?php if($customer_detail !="") {?>
							<td style="padding:0px; vertical-align: text-bottom">
								<table style="width: 100%; border-spacing: 0px;">
									<tr>
									<td style="padding: 7px 12px;border-bottom: 1px solid #E5E5E5;">
									<p style="font-size:12px; color:#333333; margin:0; font-family:serif !important; ">GST Company Name : <?php echo $customer_detail->cust_gst_name?> </p>
									</td>
									
									</tr>
									<tr>
									<td style="padding: 7px 12px;border-bottom: 1px solid #E5E5E5;"> 
									<p style="font-size:12px; color:#333333; margin:0; font-family:serif !important; ">GST Number : <?php echo $customer_detail->cust_gst_number?> </p>
									</td>									
									</tr>
									<tr>
									<td style="padding: 7px 12px;">
									<p style="font-size:12px; color:#333333; margin:0; font-family:serif !important; ">	GST Address : <?php echo $customer_detail->cust_gst_address?> </p>
									</td>									
									</tr>									
								</table>
							</td>
							<?php } else { }?>
							
						</tr>
						  
						</tbody>
					</table>
				</td>
                  </tr>			
							
				<!--END GST DETAILS-->   


<tr>
    <td align="center" cellspacing="0" style="padding:20px 0 20px 0; vertical-align:middle">
        <table width="700" style="border-collapse:collapse; background-color:white; margin:0 auto; border-bottom:1px dotted #E5E5E5">
            <tbody>
            <tr>
                <td style="vertical-align:top">
                    Out Bond Detail
                </td>
				<td width="276" style="vertical-align:top;">
                    
                </td>
            </tr>
            </tbody>
        </table>
    </td>
</tr>                        
                        <tr style="">
                            <td align="center" cellspacing="0" style="padding:0; vertical-align:top">
                                <table border="1" width="700" style="margin-bottom: 50px !important;border-collapse:collapse; background-color:#FaFaFa; margin:0 auto; border-color: #E5E5E5">
                                    <thead style="background: #d4d4d4;">
                                        <tr>
                                            <td style="font-family:'Roboto', Arial !important; text-align:center; border-radius:4px; vertical-align:middle;padding: 7px 12px;">
                                                <p style="font-size:12px; color:#333333; margin:0; font-family:serif !important; ">
                                                    Passenger</p>
                                            </td>
                                            <td style="font-family:'Roboto', Arial !important; text-align:center; border-radius:4px; vertical-align:middle;padding: 7px 12px;">
                                                <p style="font-size:12px; color:#333333; margin:0; font-family:serif !important; ">
                                                    Sector</p>
                                            </td>
                                            
                                            <td style="font-family:'Roboto', Arial !important; text-align:center; border-radius:4px; vertical-align:middle;padding: 7px 12px;">
                                                <p style="font-size:12px; color:#333333; margin:0; font-family:serif !important; ">
                                                    Travel on</p>
                                            </td>
											<td style="font-family:'Roboto', Arial !important; text-align:center; border-radius:4px; vertical-align:middle;padding: 7px 12px;">
                                                <p style="font-size:12px; color:#333333; margin:0; font-family:serif !important; ">
                                                    Airline PNR</p>
                                            </td>
											<td style="font-family:'Roboto', Arial !important; text-align:center; border-radius:4px; vertical-align:middle;padding: 7px 12px;">
                                                <p style="font-size:12px; color:#333333; margin:0; font-family:serif !important; ">
                                                    Basic</p>
                                            </td>
											<td style="font-family:'Roboto', Arial !important; text-align:center; border-radius:4px; vertical-align:middle;padding: 7px 12px;">
                                                <p style="font-size:12px; color:#333333; margin:0; font-family:serif !important; ">
                                                    YQ</p>
                                            </td>
											<td style="font-family:'Roboto', Arial !important; text-align:center; border-radius:4px; vertical-align:middle;padding: 7px 12px;">
                                                <p style="font-size:12px; color:#333333; margin:0; font-family:serif !important; ">
                                                    Other</p>
                                            </td>
											<td style="font-family:'Roboto', Arial !important; text-align:center; border-radius:4px; vertical-align:middle;padding: 7px 12px;">
                                                <p style="font-size:12px; color:#333333; margin:0; font-family:serif !important; ">
                                                    Total</p>
                                            </td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($SelectedFare->Response->Response->FlightItinerary->Passenger as $PaxDetails_lop){ ?>
                                    <tr>
                                        <td align="left" style="padding:10px 0 10px 0px;text-align:center; font-family:serif !important" width="117">
										<p style="font-size:12px; color:#333333; margin:0; font-weight:normal; font-family:serif !important; ">
                                            <?php echo $PaxDetails_lop->Title; ?> <?php echo $PaxDetails_lop->FirstName; ?> <?php echo $PaxDetails_lop->LastName; ?></p></td>
                                        <td align="left" style="padding:10px 0 10px 0px;text-align:center; font-family:serif !important" width="117">
										<p style="font-size:12px; color:#333333; margin:0; font-weight:normal; font-family:serif !important; ">
                                            <?php echo $BookingDetails->fbook_depart_airport_code; ?> -> <?php echo $BookingDetails->fbook_arrive_airport_code; ?></p></td>
                                        
                                        <td align="left" style="padding:10px 0 10px 0px;text-align:center; font-family:serif !important" width="117">
										<p style="font-size:12px; color:#333333; margin:0; font-weight:normal; font-family:serif !important; ">
                                            <?php echo GetDateScFull($SelectedFare->Response->Response->FlightItinerary->Segments[0]->Origin->DepTime); ?>, <?php echo GetTime($SelectedFare->Response->Response->FlightItinerary->Segments[0]->Origin->DepTime); ?></p></td>
										<td align="left" style="padding:10px 0 10px 0px;text-align:center; font-family:serif !important" width="117">
										<p style="font-size:12px; color:#333333; margin:0; font-weight:normal; font-family:serif !important; ">
                                            <?php echo $BookingDetails->fbook_ob_pnr; ?></p></td>
										<td align="left" style="padding:10px 0 10px 0px;text-align:center; font-family:serif !important" width="117">
										<p style="font-size:12px; color:#333333; margin:0; font-weight:normal; font-family:serif !important; ">
                                          <?php echo $this->dsa_data->dsa_currency; ?>   <?php echo $PaxDetails_lop->Fare->BaseFare; ?></p></td>
										<td align="left" style="padding:10px 0 10px 0px;text-align:center; font-family:serif !important" width="117">
										<p style="font-size:12px; color:#333333; margin:0; font-weight:normal; font-family:serif !important; ">
                                          <?php echo $this->dsa_data->dsa_currency; ?>   <?php echo round($PaxDetails_lop->Fare->YQTax); ?></p></td>
										<td align="left" style="padding:10px 0 10px 0px;text-align:center; font-family:serif !important" width="117">
										<p style="font-size:12px; color:#333333; margin:0; font-weight:normal; font-family:serif !important; ">
                                           <?php echo $this->dsa_data->dsa_currency; ?>  <?php echo $BookingDetails->fbook_customer_fare - ($PaxDetails_lop->Fare->BaseFare + round($PaxDetails_lop->Fare->YQTax)); ?></p></td>
										<td align="left" style="padding:10px 0 10px 0px;text-align:center; font-family:serif !important" width="117">
										<p style="font-size:12px; color:#333333; margin:0; font-weight:normal; font-family:serif !important; ">
                                            <?php echo $this->dsa_data->dsa_currency; ?> <?php echo round($BookingDetails->fbook_customer_fare);?></p></td>
                                            
                                    </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </td>
                        </tr>

                        <tr>
    <td align="center" cellspacing="0" style="padding:0 0 20px 0; vertical-align:middle">
        <table width="700" style="border-collapse:collapse; background-color:white; margin:0 auto; border-bottom:1px dotted #E5E5E5">
            <tbody>
            <tr>
                <td style="vertical-align:top">
                   Inbond Detail 
                </td>
				<td width="276" style="vertical-align:top;">
                    
                </td>
            </tr>
            </tbody>
        </table>
    </td>
</tr>                        
                        <tr style="">
                            <td align="center" cellspacing="0" style="padding:0; vertical-align:top">
                                <table border="1" width="700" style="margin-bottom: 100px !important;border-collapse:collapse; background-color:#FaFaFa; margin:0 auto; border-color: #E5E5E5">
                                    <thead style="background: #d4d4d4;">
                                        <tr>
                                            <td style="font-family:'Roboto', Arial !important; text-align:center; border-radius:4px; vertical-align:middle;padding: 7px 12px;">
                                                <p style="font-size:12px; color:#333333; margin:0; font-family:serif !important; ">
                                                    Passenger</p>
                                            </td>
                                            <td style="font-family:'Roboto', Arial !important; text-align:center; border-radius:4px; vertical-align:middle;padding: 7px 12px;">
                                                <p style="font-size:12px; color:#333333; margin:0; font-family:serif !important; ">
                                                    Sector</p>
                                            </td>
                                            
                                            <td style="font-family:'Roboto', Arial !important; text-align:center; border-radius:4px; vertical-align:middle;padding: 7px 12px;">
                                                <p style="font-size:12px; color:#333333; margin:0; font-family:serif !important; ">
                                                    Travel on</p>
                                            </td>
											<td style="font-family:'Roboto', Arial !important; text-align:center; border-radius:4px; vertical-align:middle;padding: 7px 12px;">
                                                <p style="font-size:12px; color:#333333; margin:0; font-family:serif !important; ">
                                                    Airline PNR</p>
                                            </td>
											<td style="font-family:'Roboto', Arial !important; text-align:center; border-radius:4px; vertical-align:middle;padding: 7px 12px;">
                                                <p style="font-size:12px; color:#333333; margin:0; font-family:serif !important; ">
                                                    Basic</p>
                                            </td>
											<td style="font-family:'Roboto', Arial !important; text-align:center; border-radius:4px; vertical-align:middle;padding: 7px 12px;">
                                                <p style="font-size:12px; color:#333333; margin:0; font-family:serif !important; ">
                                                    YQ</p>
                                            </td>
											<td style="font-family:'Roboto', Arial !important; text-align:center; border-radius:4px; vertical-align:middle;padding: 7px 12px;">
                                                <p style="font-size:12px; color:#333333; margin:0; font-family:serif !important; ">
                                                    Other</p>
                                            </td>
											<td style="font-family:'Roboto', Arial !important; text-align:center; border-radius:4px; vertical-align:middle;padding: 7px 12px;">
                                                <p style="font-size:12px; color:#333333; margin:0; font-family:serif !important; ">
                                                    Total</p>
                                            </td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($SelectedFareIB->Response->Response->FlightItinerary->Passenger as $PaxDetails_lop){ ?>
                                    <tr>
                                        <td align="left" style="padding:10px 0 10px 0px;text-align:center; font-family:serif !important" width="117">
										<p style="font-size:12px; color:#333333; margin:0; font-weight:normal; font-family:serif !important; ">
                                            <?php echo $PaxDetails_lop->Title; ?> <?php echo $PaxDetails_lop->FirstName; ?> <?php echo $PaxDetails_lop->LastName; ?></p></td>
                                        <td align="left" style="padding:10px 0 10px 0px;text-align:center; font-family:serif !important" width="117">
										<p style="font-size:12px; color:#333333; margin:0; font-weight:normal; font-family:serif !important; ">
                                            <?php echo $BookingDetails->fbook_arrive_airport_code; ?> -> <?php echo $BookingDetails->fbook_depart_airport_code; ?></p></td>
                                        
                                        <td align="left" style="padding:10px 0 10px 0px;text-align:center; font-family:serif !important" width="117">
										<p style="font-size:12px; color:#333333; margin:0; font-weight:normal; font-family:serif !important; ">
                                            <?php echo GetDateScFull($SelectedFareIB->Response->Response->FlightItinerary->Segments[0]->Origin->DepTime); ?>, <?php echo GetTime($SelectedFareIB->Response->Response->FlightItinerary->Segments[0]->Origin->DepTime); ?></p></td>
										<td align="left" style="padding:10px 0 10px 0px;text-align:center; font-family:serif !important" width="117">
										<p style="font-size:12px; color:#333333; margin:0; font-weight:normal; font-family:serif !important; ">
                                            <?php echo $BookingDetails->fbook_ib_pnr; ?></p></td>
										<td align="left" style="padding:10px 0 10px 0px;text-align:center; font-family:serif !important" width="117">
										<p style="font-size:12px; color:#333333; margin:0; font-weight:normal; font-family:serif !important; ">
                                           <?php echo $this->dsa_data->dsa_currency; ?> <?php echo $PaxDetails_lop->Fare->BaseFare; ?></p></td>
										<td align="left" style="padding:10px 0 10px 0px;text-align:center; font-family:serif !important" width="117">
										<p style="font-size:12px; color:#333333; margin:0; font-weight:normal; font-family:serif !important; ">
                                           <?php echo $this->dsa_data->dsa_currency; ?> <?php echo round($PaxDetails_lop->Fare->YQTax); ?></p></td>
										<td align="left" style="padding:10px 0 10px 0px;text-align:center; font-family:serif !important" width="117">
										<p style="font-size:12px; color:#333333; margin:0; font-weight:normal; font-family:serif !important; ">
                                          <?php echo $this->dsa_data->dsa_currency; ?>  <?php echo $BookingDetails->fbook_ib_customer_fare - ($PaxDetails_lop->Fare->BaseFare + round($PaxDetails_lop->Fare->YQTax)); ?></p></td>
										<td align="left" style="padding:10px 0 10px 0px;text-align:center; font-family:serif !important" width="117">
										<p style="font-size:12px; color:#333333; margin:0; font-weight:normal; font-family:serif !important; ">
                                           <?php echo $this->dsa_data->dsa_currency; ?> <?php echo round($BookingDetails->fbook_ib_customer_fare);?></p></td>
                                            
                                    </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
						<tr>
							<td align="center" cellspacing="0" style="padding:0 0 2px 0; vertical-align:middle;border-top: 1.1px solid gray;">
								<table width="700" style="border-collapse:collapse; background-color:white; margin:0 auto; border-bottom:1px solid gray">
									<tbody>
									<tr>
										<p style="font-size:12px; color:#000; margin:0;padding:0; font-family:serif;text-align:center">
											<b>(Reimbursement of air ticket issued by airlines)</b>
										</p>
									</tr>
									<tr>
										<td style="vertical-align:top; padding:2px 18px 0px 0px; font-family:serif !important;width: 70%;">
											<p style="font-size:12px; color:#333333; font-weight:900; margin:0; font-family:serif !important">
												
											</p>
										</td>
										<td style="vertical-align:top; padding:2px 18px 0px 0px; font-family:serif !important">
											<p style="font-size:12px; color:#333333; font-weight:900; margin:0; font-family:serif !important">
												<b>Gross Total (OB)</b>
											</p>
										</td>
										<td style="vertical-align:top; padding:2px 0px 0px 0px; font-family:serif !important;text-align:right;">
											<p style="font-size:12px; color:#333333; font-weight:900; margin:0; font-family:serif !important">
												<b> <?php echo $this->dsa_data->dsa_currency; ?> <?php echo round($BookingDetails->fbook_customer_fare);?></b>
											</p>
										</td>
									</tr>
									<tr>
										<td style="vertical-align:top; padding:2px 18px 0px 0px; font-family:serif !important;width: 70%;">
											<p style="font-size:12px; color:#333333; font-weight:900; margin:0; font-family:serif !important">
												
											</p>
										</td>
										<td style="vertical-align:top; padding:2px 18px 0px 0px; font-family:serif !important">
											<p style="font-size:12px; color:#333333; font-weight:900; margin:0; font-family:serif !important">
												<b>Gross Total(IB)</b>
											</p>
										</td>
										<td style="vertical-align:top; padding:2px 0px 0px 0px; font-family:serif !important;text-align:right;">
											<p style="font-size:12px; color:#333333; font-weight:900; margin:0; font-family:serif !important">
												<b> <?php echo $this->dsa_data->dsa_currency; ?> <?php echo round($BookingDetails->fbook_ib_customer_fare);?></b>
											</p>
										</td>
									</tr>
									
									<tr style="background: #d4d4d4;">
										<td style="vertical-align:top; padding:2px 18px 0px 0px; font-family:serif !important;width: 70%;">
											<p style="font-size:12px; color:#333333; font-weight:900; margin:0; font-family:serif !important">
											<?php 	echo getCurrencynumToWord(round($BookingDetails->fbook_customer_fare) + round($BookingDetails->fbook_ib_customer_fare)); ?>
											</p>
										</td>
										<td style="vertical-align:top; padding:2px 18px 0px 0px; font-family:serif !important">
											<p style="font-size:12px; color:#333333; margin:0; font-family:serif !important">
												<b>Total Amount in</b>
											</p>
										</td>
										<td style="vertical-align:top; padding:2px 0px 0px 0px; font-family:serif !important;text-align:right;">
											<p style="font-size:12px; color:#333333; margin:0; font-family:serif !important">
												<b><?php echo $this->dsa_data->dsa_currency; ?> <?php echo round($BookingDetails->fbook_customer_fare) + round($BookingDetails->fbook_ib_customer_fare);?></b>
											</p>
										</td>
									</tr>
									<tr style="border-bottom: 1px solid gray;">
										<td style="vertical-align:top; padding:2px 0px 0px 0px; font-family:serif !important;width: 70%;">
											<p style="font-size:12px; color:#333333; margin:0; font-family:serif !important">
												<b>Terms :</b><br># Without original invoice no refund is permissible.<br># Interest @ 24% will be charged on delayed payment.<br># Cheque to be drawn in favour of "company name".<br># Kindly check all details carefully to avoid un-necessary complications.
											</p>
										</td>
										<td style="vertical-align:top; padding:2px 18px 0px 0px; font-family:serif !important;">
											<p style="font-size:12px; color:#333333; margin:0; font-family:serif !important">
												
											</p>
										</td>
										<td style="vertical-align:top; padding:2px 0px 0px 0px; font-family:serif !important;text-align:right;">
											<p style="font-size:12px; color:#333333; margin:0; font-family:serif !important">
												E. & O. E.
											</p>
										</td>
									</tr>
									</tbody>
								</table>
							</td>
						</tr>
                        <tr>
							<td align="center" cellspacing="0" style="padding:0 0 2px 0; vertical-align:middle;">
								<table width="700" style="border-collapse:collapse; background-color:white; margin:0 auto; border-bottom:1px solid gray">
									<tbody>
									<tr style="height: 100px;">
										<td style="vertical-align:top; padding:2px 0px 0px 0px; font-family:serif !important;">
											<p style="font-size:12px; color:#333333; margin:0; font-family:serif !important">
												
											</p>
										</td>
										<td style="vertical-align:top; padding:2px 18px 0px 0px; font-family:serif !important;">
											<p style="font-size:12px; color:#333333; margin:0; font-family:serif !important">
												
											</p>
										</td>
										<td style="vertical-align:top; padding:2px 0px 0px 0px; font-family:serif !important;text-align:right;">
											<p style="font-size:12px; color:#333333; margin:0; font-family:serif !important">
												for  <?php echo $this->user_data->dsa_company_name;?>
											</p>
										</td>
									</tr>
									<tr style="border-bottom: 1px solid gray;">
										<td style="vertical-align:top; padding:2px 0px 0px 0px; font-family:serif !important;">
											<p style="font-size:12px; color:#333333; margin:0; font-family:serif !important">
												Receiver's Signature
											</p>
										</td>
										<td style="vertical-align:top; padding:2px 18px 0px 0px; font-family:serif !important;">
											<p style="font-size:12px; color:#333333; margin:0; font-family:serif !important">
												
											</p>
										</td>
										<td style="vertical-align:top; padding:2px 0px 0px 0px; font-family:serif !important;text-align:right;">
											<p style="font-size:12px; color:#333333; margin:0; font-family:serif !important">
												 Authorized Signatory 
											</p>
										</td>
									</tr>
									</tbody>
								</table>
							</td>
						</tr>
                        <tr>
							<td align="center" cellspacing="0" style="padding:0 0 20px 0; vertical-align:middle;">
								<table width="700" style="border-collapse:collapse; background-color:white; margin:0 auto;">
									<tbody>
									<tr>
										<td style="vertical-align:top; padding:2px 0px 0px 0px; font-family:serif !important;">
											<p style="font-size:12px; color:#333333; margin:0; font-family:serif !important">
												<!-- (Prepared by: xyz) -->
											</p>
										</td>
										<td style="vertical-align:top; padding:2px 18px 0px 0px; font-family:serif !important; text-align:center;">
											<p style="font-size:12px; color:#333333; margin:0; font-family:serif !important">
												This is a Computer generated document and does not require any signature.
											</p>
										</td>
										<td style="vertical-align:top; padding:2px 0px 0px 0px; font-family:serif !important;text-align:right;">
											<p style="font-size:12px; color:#333333; margin:0; font-family:serif !important">
												<!-- (ID: <?php echo $BookingDetails->fbook_ref_id; ?>) -->
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
</body>
</body>
</html>
