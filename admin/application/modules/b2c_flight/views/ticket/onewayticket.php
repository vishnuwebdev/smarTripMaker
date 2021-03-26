<!DOCTYPE html>
<?php // PrintArray($SelectedFare);
//die; 
$add_transction_disc = $BookingDetails->fbook_transaction_fee;
$BookingDetails->fbook_customer_fare = $BookingDetails->fbook_customer_fare + $add_transction_disc;
if($add_transction_disc==""){
		$add_transction_disc = "0.00";
	}
        $Fld_Id = $BookingDetails->fbook_id;
	if($BookingDetails->fbook_is_domestic=="true"){
		$booking_type = 'domestic';
	}else{
		$booking_type = 'international';
	}
 $OB_ticket=$SelectedFare->Response->Response->FlightItinerary;
	$bp_sms_ticket_one['Title']=$OB_ticket->Passenger[0]->Title;
	$bp_sms_ticket_one['FirstName']=$OB_ticket->Passenger[0]->FirstName;
	$bp_sms_ticket_one['LastName']=$OB_ticket->Passenger[0]->LastName;
	$bp_sms_ticket_one['AirlineCode']=$OB_ticket->Segments[0]->Airline->AirlineCode;
	$bp_sms_ticket_one['AirlineName']=$OB_ticket->Segments[0]->Airline->AirlineName;
	$bp_sms_ticket_one['FlightNumber']=$OB_ticket->Segments[0]->Airline->FlightNumber;
	$bp_sms_ticket_one['DepTime']=$OB_ticket->Segments[0]->Origin->DepTime;
	$bp_sms_ticket_one['PNR']=$OB_ticket->PNR;
	$bp_sms_ticket_one['Origin']=$OB_ticket->Origin;
	$bp_sms_ticket_one['Destination']=$OB_ticket->Destination;
	$bp_sms_ticket_oneway_string="Dear ".$bp_sms_ticket_one['FirstName'].", Your booking detail is PNR  ".$bp_sms_ticket_one['PNR'].", ".$bp_sms_ticket_one['Origin']."-".$bp_sms_ticket_one['Destination'].", Flight ".$bp_sms_ticket_one['AirlineName']." ".$bp_sms_ticket_one['AirlineCode']."-".$bp_sms_ticket_one['FlightNumber']." (".date_format(date_create($bp_sms_ticket_one['DepTime']),"d M Y")."),Lead Pax - ".$bp_sms_ticket_one['Title'].". ".$bp_sms_ticket_one['FirstName']." ".$bp_sms_ticket_one['LastName'].".". PHP_EOL ." ". PHP_EOL ." ".$this->user_data->dsa_company_name."";
 ?>
<html >
    <head>
        <meta charset="UTF-8">
        <title></title>
            <link rel="stylesheet" href="<?php echo site_url(); ?>assets/css/bootstrap.min.css">
		    <link rel="stylesheet" href="<?php echo site_url(); ?>assets/css/vendor/bootstrap.min.css">
            <div style="display:none">
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
                @media print {
                    @page{margin:0mm;size:auto;}
                    .hidden-pdf{
                        display: none
                    }
                    table, body{
                        background: #fff !important;
                    }
                }
            </style>
        </div>
    </head>

    <body style="margin: 0; padding: 0;background-color:#EEEEEE;">
        <div id="printticketID">
        <table cellspacing="0" style="margin:0 0; width:100%; border-collapse:collapse; background-color:#EEEEEE;">
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
                                                    <td align="left" style="padding: 12px 0 8px 0;">
                                                        <a  target="_blank" style="color:#d8d8d8; text-decoration:none;outline:0;">
                                                            <img src="<?php echo site_url();?>assets/img/logos/<?php echo $this->dsa_data->dsa_logo;?>" border="0"></a>
                                                    </td>
                                                    <td align="right" style="">
                                                        <h2 style="margin:0; font-weight:bold; font-size:18px; color:#444; ">
                                                            E-Ticket
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
                                                                            <?php  echo $this->user_data->dsa_company_name;?>
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
														 <?php echo $this->dsa_setting->dsaset_address_1;?>,<br> <?php echo $this->dsa_setting->dsaset_city;?>, <?php echo $this->dsa_setting->dsaset_state;?>, <?php echo $this->dsa_setting->dsaset_country;?>
													</p>
												</td>
											</tr>
											<tr>
												<td style="">
													<p style="font-size:16px; color:#000; margin:0;padding:0; ">
														Phone: <?php echo $this->dsa_setting->dsaset_phone;?><br>
														Email ID: <?php echo $this->dsa_setting->dsaset_email;?>
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
                                                                           
                                                                        </p>
                                                                    </td>
                                                                </tr>
                                                                <tr style="">
                                                                    <td style="vertical-align:top; padding:0 18px 18px 23px">
                                                                        <table width="100%" style="border-collapse:collapse">
                                                                            <tbody>
																			 <tr>
																				<td style="">
																					<p style="font-size:16px; color:#000; margin:0 0 5px 0; ">
																						Reference ID:
																					</p>
																				</td>
																				<td align="left" style="">
																					<p style="font-size:16px; color:#000; margin:0 0 5px 0; ">
																						<b> STM00<?php echo $BookingDetails->fbook_id; ?></b>
																					</p>
																				</td>
																			</tr>
                                                                                <tr>
                                                                                    <td style="">
                                                                                        <p style="font-size:16px; color:#000; margin:0 0 5px 0; ">
                                                                                            Out Bound PNR:
                                                                                        </p>
                                                                                    </td>
                                                                                    <td align="left" style="">
                                                                                        <p style="font-size:16px; color:#000; margin:0 0 5px 0; ">
                                                                                            <b> <?php echo $BookingDetails->fbook_ob_pnr; ?></b>
                                                                                        </p>
                                                                                    </td>
                                                                                </tr>
                                                                                
                                                                                <tr>
                                                                                    <td style="">
                                                                                        <p style="font-size:16px; color:#000; margin:0 0 10px 0; ">
                                                                                            Issue date: 
                                                                                        </p>
                                                                                    </td>
                                                                                    <td align="left" style="">
                                                                                        <p style="font-size:16px; color:#000; margin:0 0 10px 0; ">
                                                                                            <?php echo date_format(date_create($BookingDetails->fbook_entry_date),"d M Y");?>



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
                                <tr>
                                    <td>
                                        <p style="margin: 0;padding-left: 20px;">OutBound Passenger Detail</p>
                                    </td>
                                </tr>                    
                                <tr>
                                    <td align="center" cellspacing="0" style="padding-bottom:10px; vertical-align:middle">
                                        <table border="1" width="800" style="margin-bottom: 15px!important;border-collapse:collapse; background-color:#ffffff; margin:0 0; border-color: #E5E5E5">
                                            <thead style="background-color: #d8d8d8;">
                                                <tr>
                                                    <td style=" text-align:center; border-radius:4px; vertical-align:middle;padding: 7px 12px;">
                                                        <p style="font-size:14px; text-transform:uppercase; color:#333333; margin:0;">
                                                            <strong>Passenger Name</strong></p>
                                                    </td>
                                                    <td style=" text-align:center; border-radius:4px; vertical-align:middle;padding: 7px 12px;">
                                                        <p style="font-size:14px; text-transform:uppercase; color:#333333; margin:0;">
                                                            <strong>Ticket no.</strong></p>
                                                    </td>
                                                    <td style=" text-align:center; border-radius:4px; vertical-align:middle;padding: 7px 12px;">
                                                        <p style="font-size:14px; text-transform:uppercase; color:#333333; margin:0;">
                                                            <strong>Ticket Id.</strong></p>
                                                    </td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($SelectedFare->Response->Response->FlightItinerary->Passenger as $PaxDetails_lop){ ?>
                                                <tr>
                                                    <td style="padding:10px 0 10px 0px;text-align:center; " width="117"><p style="font-size:14px; text-transform:uppercase; color:#333333; margin:0; font-weight:normal;  ">
                                                            <?php echo $PaxDetails_lop->Title; ?> <?php echo $PaxDetails_lop->FirstName; ?> <?php echo $PaxDetails_lop->LastName; ?></p></td>
                                                    <td style="padding:10px 0 10px 0px;text-align:center; " width="117"><p style="font-size:14px; text-transform:uppercase; color:#333333; margin:0; font-weight:normal;  ">
                                                            <?php echo $PaxDetails_lop->Ticket->TicketNumber; ?></p></td>
                                                    <td align="left" style="padding:10px 0 10px 0px;text-align:center; " width="117"><p style="font-size:14px; text-transform:uppercase; color:#333333; margin:0; font-weight:normal;  ">
                                                            <?php echo $PaxDetails_lop->Ticket->TicketId; ?></p></td>

                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                                 
                              
                                <tr>
                                    <td>
                                        <p style="margin: 0;padding-left: 20px;">OutBound Flight Detail</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" cellspacing="0" style="padding-bottom:10px;vertical-align:middle">
                                        <table border="1" width="800" style="margin-bottom: 15px!important;border-collapse:collapse; background-color:#ffffff; margin:0 0; border-color: #E5E5E5">
                                            <thead style="background-color: #d8d8d8;">
                                                <tr>
                                                    <td style=" text-align:center; border-radius:4px; vertical-align:middle;padding: 7px 12px;">
                                                        <p style="font-size:14px; text-transform:uppercase; color:#333333; margin:0;">
                                                            <strong>Flight</strong></p>
                                                    </td>
                                                    <td style=" text-align:center; border-radius:4px; vertical-align:middle;padding: 7px 12px;">
                                                        <p style="font-size:14px; text-transform:uppercase; color:#333333; margin:0;">
                                                            <strong>Departure</strong></p>
                                                    </td>
                                                    <td style=" text-align:center; border-radius:4px; vertical-align:middle;padding: 7px 12px;">
                                                        <p style="font-size:14px; text-transform:uppercase; color:#333333; margin:0;">
                                                            <strong>Arrival</strong></p>
                                                    </td>
                                                     <td style=" text-align:center; border-radius:4px; vertical-align:middle;padding: 7px 12px;">
                                                        <p style="font-size:14px; text-transform:uppercase; color:#333333; margin:0;">
                                                            <strong>Other</strong></p>
                                                    </td>
                                                    <td style=" text-align:center; border-radius:4px; vertical-align:middle;padding: 7px 12px;">
                                                        <p style="font-size:14px; text-transform:uppercase; color:#333333; margin:0;">
                                                            <strong>Status</strong></p>
                                                    </td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
        foreach ($SelectedFare->Response->Response->FlightItinerary->Segments as $seg => $segmentloop){
            
            
            //PrintArray($segmentloop->AirlinePNR);
            //die;
            if($segmentloop->TripIndicator == 1){
         ?>
                                                <tr>
                                                    <td style="padding:10px 0 10px 0px;text-align:center; " width="117">
                                                        <img src="<?php echo site_url(); ?>assets/images/airlines/<?php echo $segmentloop->Airline->AirlineCode; ?>.gif">
                                                        <p style="font-size:14px; text-transform:uppercase; color:#333333; margin:0; font-weight:normal;  ">
                                                            <?php echo $segmentloop->Airline->AirlineName; ?> <b><?php echo $segmentloop->Airline->AirlineCode; ?>-<?php echo $segmentloop->Airline->FlightNumber; ?></b></p></td>
                                                    <td style="padding:10px 0 10px 0px;text-align:center; " width="117"><p style="font-size:14px; text-transform:uppercase; color:#333333; margin:0; font-weight:normal;  ">
                                                            <?php echo $segmentloop->Origin->Airport->CityName; ?> <br><?php echo GetDateScFull($segmentloop->Origin->DepTime); ?> , <?php echo GetTime($segmentloop->Origin->DepTime); ?>, <br>
                                                             <?php if(isset($segmentloop->Origin->Terminal)){ 
                                                                 
                                                                 if($segmentloop->Origin->Terminal != NULL){
                                                                     echo 'Terminal '.$segmentloop->Origin->Terminal;
                                                                 }
                                                                 
                                                             } ?></p></td>
                                                    <td style="padding:10px 0 10px 0px;text-align:center; " width="117"><p style="font-size:14px; text-transform:uppercase; color:#333333; margin:0; font-weight:normal;  ">
                                                           <?php echo $segmentloop->Destination->Airport->CityName; ?> <br><?php echo GetDateScFull($segmentloop->Destination->ArrTime); ?> , <?php echo GetTime($segmentloop->Destination->ArrTime); ?>, <br>
                                                             <?php if(isset($segmentloop->Destination->Terminal)){ 
                                                                 
                                                                 if($segmentloop->Destination->Terminal != NULL){
                                                                     echo 'Terminal '.$segmentloop->Destination->Terminal;
                                                                 }
                                                                 
                                                             } ?></p></td>
                                                    
                                                     <td style="padding:10px 0 10px 0px;text-align:center; " width="117"><p style="font-size:14px; text-transform:uppercase; color:#333333; margin:0; font-weight:normal;  ">
                                                             Class : <?php echo $segmentloop->Airline->FareClass; ?>  <br>
                                                              <?php if(isset($segmentloop->AirlinePNR)){ 
                                                                 
                                                                 if($segmentloop->AirlinePNR != NULL){
                                                                     echo 'Airline PNR : '.$segmentloop->AirlinePNR;
                                                                 }
                                                                 
                                                                 } ?><br>
                                                             <?php if(isset($segmentloop->Baggage)){ 
                                                                 
                                                                 if($segmentloop->Baggage != NULL){
                                                                     echo 'Baggage : '.$segmentloop->Baggage;
                                                                 }
                                                                 
                                                             } ?></p></td>
                                                    <td style="padding:10px 0 10px 0px;text-align:center; " width="117"><p style="font-size:14px; text-transform:uppercase; color:#333333; margin:0; font-weight:normal;  ">
                                                            <?php if($SelectedFare->Response->Response->TicketStatus ==1){ 
                                                                
     echo 'Confirmed';
                                                            }
?></p></td>

                                                </tr>
        <?php } }  ?>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                
                               
                                <tr class="payment_details">
                                    <td align="center" cellspacing="0" style="padding-bottom:10px; vertical-align:middle">
                                        <table border="1" width="800" style="margin-bottom: 15px!important;border-collapse:collapse; background-color:#ffffff; margin:0 0; border-color: #E5E5E5">
                                            <thead style="background-color: #d8d8d8;">
                                                <tr>
                                                    <td colspan="3" style=" text-align:center; border-radius:4px; vertical-align:middle;padding: 7px 12px;">
                                                        <p style="font-size:14px; text-transform:uppercase; color:#333333; margin:0;">
                                                            <strong>Payment Details</strong></p>
                                                    </td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td rowspan="3" align="left" style="padding:10px 4px 10px 10px;;text-align:left; " width="300"><p style="font-size:14px; text-transform:uppercase; color:#333333; margin:0; font-weight:normal;  ">
                                                            This is an electronic ticket.<br>Please carry a positive identification for check in.</p></td>
                                                    <td align="left" style="padding:10px 4px 10px 10px;;text-align:left; " width="117"><p style="font-size:14px; text-transform:uppercase; color:#333333; margin:0; font-weight:normal;  ">
                                                            Air Fare:</p></td>
                                                    <td align="left" style="padding:10px 0 10px 0px;text-align:center; " width="117"><p style="font-size:14px; text-transform:uppercase; color:#333333; margin:0; font-weight:normal;  ">
                                                    <?php echo $this->dsa_data->dsa_currency   ?> <?php echo $SelectedFare->Response->Response->FlightItinerary->Fare->BaseFare; ?></p></td>

                                                </tr>
                                                <tr>
                                                    <td align="left" style="padding:10px 4px 10px 10px;;text-align:left; " width="117"><p style="font-size:14px; text-transform:uppercase; color:#333333; margin:0; font-weight:normal;  ">
                                                            Tax and Additional Charge (+):</p></td>
                                                    <td align="left" style="padding:10px 0 10px 0px;text-align:center; " width="117"><p style="font-size:14px; text-transform:uppercase; color:#333333; margin:0; font-weight:normal;  ">
                                                    <?php echo $this->dsa_data->dsa_currency   ?> <?php echo $BookingDetails->fbook_customer_fare - $SelectedFare->Response->Response->FlightItinerary->Fare->BaseFare; ?></p></td>

                                                </tr>
                                                <tr>
                                                    <td align="left" style="padding:10px 4px 10px 10px;;text-align:left; " width="117"><p style="font-size:14px; text-transform:uppercase; color:#333333; margin:0; font-weight:normal;  ">
                                                            Total Air Fare:</p></td>
                                                    <td align="left" style="padding:10px 0 10px 0px;text-align:center; " width="117"><p style="font-size:14px; text-transform:uppercase; color:#333333; margin:0; font-weight:600;  ">
                                                    <?php echo $this->dsa_data->dsa_currency   ?> <?php echo $BookingDetails->fbook_customer_fare; ?></p></td>

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
                                    <td colspan="4" style="vertical-align:middle;background-color: #d8d8d8;border-radius: 0px 0px 5px 5px;">
                                        <table style="background-color:#d8d8d8; width:100%; border-radius:5px 5px 0 0; border-collapse:collapse">
                                            <tbody>
                                                <tr>
                                                    <td align="center" style="vertical-align:middle; padding:22px 4px; ">
                                                        <p style="color:#171616; font-size:18px; margin:0; ">
                                                            E & O.E
                                                        </p>
                                                    </td>
                                                    <td align="right" style="vertical-align:middle; padding:22px 50px 22px 0; ">
                                                        <p style="font-size:18px; margin:0; text-align: right;">
                                                            <a  style="text-decoration:none; color:#171616; font-weight:bold;outline:0;"><?php echo site_url(); ?></a>
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
                        <p style="color:red;text-align: center;">This is Computer Generated Ticket does not required signature.</p>
                    </td>
                </tr>
                
                 <tr>
                    <td align="center"></td>  
                    
                </tr>
             
            </tbody>
        </table>
        </div>
    
        <?php if($isEmail == "false"){ ?>
        <div style="text-align: center;">
		<div class="hidden-pdf" style="padding-top: 10px;padding-bottom: 15px;">
		<div class="btn-group">
		  <button data-toggle="modal" data-target="#sendmailmodel"  class="btn btn-primary"><span class="glyphicon glyphicon-envelope"></span> E-mail Ticket </button>
		</div>
                            
		</div>
		</div>
	<?php } ?>
 
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
					var ref_id = '<?php echo $BookingDetails->fbook_id; ?>';
                    $.ajax({
                        type:"GET",
                        url:"<?php echo site_url('b2c_flight/get_booking'); ?>",
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

