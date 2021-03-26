<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
	<link rel="stylesheet" href="<?php echo site_url();?>/assets/css/bootstrap.min.css">
	<div style="display: none">
	<style>
		@import url('https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900,900i');
		body{
			font-size: 14px;
			color: #000;
			margin: 0;
			position: relative;
			font-family: 'Roboto', sans-serif;
			padding: 0;
		}
		@media print{
			table{
				width: 100%;
				/* max-width: 540px; */
				margin:0px auto;
				max-width: 100%;
			}
			body {
				-webkit-print-color-adjust: exact;
                -moz-print-color-adjust: exact;
                font-size: 13px;
                color: #000000;
                background: #fff;
            }
            tr,img, table, pre {
                    page-break-inside: avoid;
            }
            a {
			    page-break-inside:avoid
			}
            @page { margin:50px auto;size:  auto; }
            .remove-css{
            	padding:0px !important;
            	background: #fff !important;
            	max-width: 100% !important;
            	width: 100% !important; 
            }
			}
		</style>
	</div>
</head>
<body style="background-color:#eeeeee;padding: 25px 0px;" class="remove-css">
	<div style="max-width: 850px; margin: 0px auto;width: 100%;padding: 25px; font-size: 14px;background: #fff;" class="remove-css">
	 <div id="printticketID">
		<table border="0" cellpadding="0" cellspacing="0" width="800px" style="width: 800px;min-width: 100%; border-spacing: 0px;border-collapse: colapse;">
			<tbody>
				<tr>
					<td style="border:0px none;">
						<a href="<?php echo site_url();?>">
						<img src="<?php echo site_url();?>/admin/assets/img/logos/<?php echo $this->dsa_data->dsa_logo;?>" alt="logo" style="max-width: 60%;">						
						</a>
					</td>
					<td style="text-align: right;font-size: 18px;border:0px none;">
						<strong>E-Ticket</strong>
						<span id="qrcode" style="display: block; "></span>
					</td>
				</tr>
				<tr> 
					<td colspan="2" style="padding-bottom: 15px;">
						<table style="width: 800px;min-width: 100%;border-spacing: 0px;border-collapse: collapse;">
							<tr>
								<td style="border-top: 1px solid #000;border-bottom: 1px solid #000;border-left: 1px solid #000; padding: 8px;">
									<table style="width: 100%; border-spacing: 0px;border-collapse: collapse;">
										<tbody>
											<tr><td style="padding:5px 4px;font-size: 18px; "><strong style="font-size:2rem;"><?php echo $this->dsa_data->dsa_company_name;?></strong></td></tr>
											<tr>
												<td>
												 <?php echo $this->dsa_setting->dsaset_address_1;?>,<br>
												 <?php echo $this->dsa_setting->dsaset_city;?>, 
												 <?php echo $this->dsa_setting->dsaset_state;?>, 
												 <?php echo $this->dsa_setting->dsaset_country;?>
												</td>
											</tr>
											<tr>
												<td>Phone: <?php echo $this->dsa_setting->dsaset_phone;?></td>
											</tr>
											<tr>
												<td>Email ID: <?php echo $this->dsa_setting->dsaset_email;?></td>
											</tr>
										</tbody>
									</table>
								</td>
								<td style="border-top: 1px solid #000;border-bottom: 1px solid #000;border-right: 1px solid #000; padding: 8px;">
									<table style="width: 100%; border-spacing: 0px;border-collapse: collapse;">
										<tbody>
											<tr><td>Reference ID:</td><td><strong>STM00<?php echo $BookingDetails->	fbook_id; ?></strong></td></tr>
											<tr><td>Out Bound PNR:</td><td><strong><?php echo $BookingDetails->fbook_ob_pnr; ?></strong></td></tr>
											<tr><td>IN Bound PNR:</td><td><strong><?php echo $BookingDetails->fbook_ob_pnr; ?></strong></td></tr>
											<tr><td>Issue date:</td><td> <?php echo date_format(date_create($BookingDetails->fbook_entry_date),"d M Y");?></td></tr>
										</tbody>
									</table>
								</td>
							</tr>	
						</table>
					</td>
				</tr>
				<tr>
					<td colspan="2" style="padding: 10px 1px;"> OutBound Passenger Detail</td>
				</tr>
				<tr>
					<td colspan="2" style="padding-bottom: 15px;">
						<table style="width: 800px;min-width: 100%; border-spacing: 0px;border-collapse: collapse;border:1px solid #000;">
							<thead>
								<tr>
									<th style="border-left:1px solid #000;padding: 7px 12px;background-color: #d8d8d8;border-bottom: 1px solid #000;border-right: 1px solid #000;">PASSENGER NAME</th>
									<th style="border-left:1px solid #000; padding: 7px 12px;background-color: #d8d8d8;border-bottom: 1px solid #000;border-right: 1px solid #000;">TICKET NO.</th>
									<th style="border-left:1px solid #000; padding: 7px 12px;background-color: #d8d8d8;border-bottom: 1px solid #000;border-right: 1px solid #000;">TICKET ID.</th>
								</tr>
							</thead>
							<tbody>
							 <?php foreach ($PaxDetails as $PaxDetails_lop){ ?>
								<tr>
									<td style="border-left:1px solid #000; padding: 7px 12px;border-right: 1px solid #000;"> <?php echo $PaxDetails_lop->fpax_title; ?> <?php echo $PaxDetails_lop->fpax_first_name; ?> <?php echo $PaxDetails_lop->fpax_last_name; ?></td>
									<td style="border-left:1px solid #000; padding: 7px 12px;border-right: 1px solid #000;"> <?php echo $BookingDetails->fbook_ob_pnr; ?></td>
									<td style="border-left:1px solid #000; padding: 7px 12px;border-right: 1px solid #000;"><?php echo $BookingDetails->fbook_ob_booking_id; ?></td>
								</tr>
								 <?php } ?>
							</tbody>
						</table>
					</td>
				</tr>
				
				<!--Inbound Passanger--->
				
				<tr>
					<td colspan="2" style="padding: 10px 1px;"> InBound Passenger Detail</td>
				</tr>
				<tr>
					<td colspan="2" style="padding-bottom: 15px;">
						<table style="width: 800px;min-width: 100%; border-spacing: 0px;border-collapse: collapse;border:1px solid #000;">
							<thead>
								<tr>
									<th style="border-left:1px solid #000;padding: 7px 12px;background-color: #d8d8d8;border-bottom: 1px solid #000;border-right: 1px solid #000;">PASSENGER NAME</th>
									<th style="border-left:1px solid #000; padding: 7px 12px;background-color: #d8d8d8;border-bottom: 1px solid #000;border-right: 1px solid #000;">TICKET NO.</th>
									<th style="border-left:1px solid #000; padding: 7px 12px;background-color: #d8d8d8;border-bottom: 1px solid #000;border-right: 1px solid #000;">TICKET ID.</th>
								</tr>
							</thead>
							<tbody>
							 <?php foreach ($PaxDetails as $PaxDetails_lop){ ?>
								<tr>
									<td style="border-left:1px solid #000; padding: 7px 12px;border-right: 1px solid #000;"> <?php echo $PaxDetails_lop->fpax_title; ?> <?php echo $PaxDetails_lop->fpax_first_name; ?> <?php echo $PaxDetails_lop->fpax_last_name; ?></td>
									<td style="border-left:1px solid #000; padding: 7px 12px;border-right: 1px solid #000;"> <?php echo $BookingDetails->fbook_ob_pnr; ?></td>
									<td style="border-left:1px solid #000; padding: 7px 12px;border-right: 1px solid #000;"> <?php echo $BookingDetails->fbook_ob_booking_id; ?></td>
								</tr>
							 <?php }?>
							</tbody>
						</table>
					</td>
				</tr>
				
				
				<tr>
					<td colspan="2" style="padding-bottom: 8px;"> OutBound Flight Detail</td>
				</tr>
				<tr>
					<td colspan="2" style="padding-bottom: 15px;">
						<table style="width: 800px;min-width: 100%; border-spacing: 0px;border-collapse: collapse; border:1px solid #000;">
							<thead>
								<tr>
									<th style="padding: 7px 12px;background-color: #d8d8d8;border-bottom: 1px solid #000;border-right: 1px solid #000;">FLIGHT</th>
									<th style="padding: 7px 12px;background-color: #d8d8d8;border-bottom: 1px solid #000;border-right: 1px solid #000;">DEPARTURE</th>
									<th style="padding: 7px 12px;background-color: #d8d8d8;border-bottom: 1px solid #000;border-right: 1px solid #000;">ARRIVAL</th>
									<th style="padding: 7px 12px;background-color: #d8d8d8;border-bottom: 1px solid #000;border-right: 1px solid #000;">OTHER</th>
									<th style="padding: 7px 12px;background-color: #d8d8d8;border-bottom: 1px solid #000;border-right: 1px solid #000;">STATUS</th>
								</tr>
							</thead>
							<tbody>
							<?php 
							foreach ($SelectedFare->Response->Response->FlightItinerary->Segments as $seg => $segmentloop)
							{	if($segmentloop->TripIndicator == 1){
									?>
								<tr>
									<td style="padding: 7px 12px;border-right: 1px solid #000;">
										<img src="<?php echo site_url(); ?>assets/images/airlines/<?php echo $segmentloop->Airline->AirlineCode; ?>.gif">
										<p style="font-size:14px; text-transform:uppercase; color:#333333; margin:0; font-weight:normal;  "> <?php echo $segmentloop->Airline->AirlineName; ?> 
										<b><?php echo $segmentloop->Airline->AirlineCode; ?>-<?php echo $segmentloop->Airline->FlightNumber; ?></b></p></td>
										
									<td style="padding: 7px 12px;border-right: 1px solid #000;">
										<p style="font-size:14px; text-transform:uppercase; color:#333333; margin:0; font-weight:normal;  "> <?php echo $segmentloop->Origin->Airport->CityName; ?> <br><?php echo GetDateScFull($segmentloop->Origin->DepTime); ?> , <?php echo GetTime($segmentloop->Origin->DepTime); ?>, <br>
										 <?php if(isset($segmentloop->Origin->Terminal)){ 										 
										 if($segmentloop->Origin->Terminal != NULL){
											 echo 'Terminal '.$segmentloop->Origin->Terminal;
										 }
										 
									 } ?>
										
                                        </p>
									</td>
									<td style="padding: 7px 12px;border-right: 1px solid #000;">
										<p style="font-size:14px; text-transform:uppercase; color:#333333; margin:0; font-weight:normal;  "><?php echo $segmentloop->Destination->Airport->CityName; ?> <br><?php echo GetDateScFull($segmentloop->Destination->ArrTime); ?> , <?php echo GetTime($segmentloop->Destination->ArrTime); ?>, <br>
										<?php if(isset($segmentloop->Destination->Terminal)){ 
											 
											 if($segmentloop->Destination->Terminal != NULL){
												 echo 'Terminal '.$segmentloop->Destination->Terminal;
											 }
											 
										 } ?>
                                        </p>
                                        </td>
									<td style="padding: 7px 12px;border-right: 1px solid #000;">CLASS : <?php echo $segmentloop->Airline->FareClass; ?> </td>
									<td style="padding: 7px 12px;">
									<?php if($SelectedFare->Response->Response->TicketStatus ==1){ 
                                     echo 'CONFIRMED';
                                     }
									?>
									</td>
								</tr>
							<?php } }  ?>	
								
							</tbody>
						</table>
					</td>
				</tr>
				
				<!--INbound flights--->
				
				<tr>
					<td colspan="2" style="padding-bottom: 8px;"> InBound Flight Detail</td>
				</tr>
				<tr>
					<td colspan="2" style="padding-bottom: 15px;">
						<table style="width: 800px;min-width: 100%; border-spacing: 0px;border-collapse: collapse; border:1px solid #000;">
							<thead>
								<tr>
									<th style="padding: 7px 12px;background-color: #d8d8d8;border-bottom: 1px solid #000;border-right: 1px solid #000;">FLIGHT</th>
									<th style="padding: 7px 12px;background-color: #d8d8d8;border-bottom: 1px solid #000;border-right: 1px solid #000;">DEPARTURE</th>
									<th style="padding: 7px 12px;background-color: #d8d8d8;border-bottom: 1px solid #000;border-right: 1px solid #000;">ARRIVAL</th>
									<th style="padding: 7px 12px;background-color: #d8d8d8;border-bottom: 1px solid #000;border-right: 1px solid #000;">OTHER</th>
									<th style="padding: 7px 12px;background-color: #d8d8d8;border-bottom: 1px solid #000;border-right: 1px solid #000;">STATUS</th>
								</tr>
							</thead>
						<tbody>
							<?php 
							foreach ($SelectedFare->Response->Response->FlightItinerary->Segments as $seg => $segmentloop){	if($segmentloop->TripIndicator == 2){
									?>
								<tr>
									<td style="padding: 7px 12px;border-right: 1px solid #000;">
										<img src="<?php echo site_url(); ?>assets/images/airlines/<?php echo $segmentloop->Airline->AirlineCode; ?>.gif">
										<p style="font-size:14px; text-transform:uppercase; color:#333333; margin:0; font-weight:normal;  "> <?php echo $segmentloop->Airline->AirlineName; ?> 
										<b><?php echo $segmentloop->Airline->AirlineCode; ?>-<?php echo $segmentloop->Airline->FlightNumber; ?></b></p></td>
										
									<td style="padding: 7px 12px;border-right: 1px solid #000;">
										<p style="font-size:14px; text-transform:uppercase; color:#333333; margin:0; font-weight:normal;  "> <?php echo $segmentloop->Origin->Airport->CityName; ?> <br><?php echo GetDateScFull($segmentloop->Origin->DepTime); ?> , <?php echo GetTime($segmentloop->Origin->DepTime); ?>, <br>
										 <?php if(isset($segmentloop->Origin->Terminal)){ 										 
										 if($segmentloop->Origin->Terminal != NULL){
											 echo 'Terminal '.$segmentloop->Origin->Terminal;
										 }
										 
									 } ?>
										
                                        </p>
									</td>
									<td style="padding: 7px 12px;border-right: 1px solid #000;">
										<p style="font-size:14px; text-transform:uppercase; color:#333333; margin:0; font-weight:normal;  "><?php echo $segmentloop->Destination->Airport->CityName; ?> <br><?php echo GetDateScFull($segmentloop->Destination->ArrTime); ?> , <?php echo GetTime($segmentloop->Destination->ArrTime); ?>, <br>
										<?php if(isset($segmentloop->Destination->Terminal)){ 
											 
											 if($segmentloop->Destination->Terminal != NULL){
												 echo 'Terminal '.$segmentloop->Destination->Terminal;
											 }
											 
										 } ?>
                                        </p>
                                        </td>
									<td style="padding: 7px 12px;border-right: 1px solid #000;">CLASS : <?php echo $segmentloop->Airline->FareClass; ?> </td>
									<td style="padding: 7px 12px;">
									<?php if($SelectedFare->Response->Response->TicketStatus ==1){ 
                                     echo 'CONFIRMED';
                                     }
									?>
									</td>
								</tr>
							<?php } }  ?>
							</tbody>
						</table>
					</td>
				</tr>
				
				<!---->
				
				<tr>
					<td colspan="2">
						<table style="width: 800px;min-width: 100%; border-spacing: 0px;border-collapse: collapse;">
							<tbody>
								<tr colspan="2">
									<td colspan="2" style="font-weight:bold;font-size:15px;text-align:center;padding: 7px 12px;background-color: #d8d8d8;border: 1px solid #000;">PAYMENT DETAILS(OUTBOUND + INBOUND)</td>
								</tr>
								<tr>
									<td style="padding: 7px 12px;border: 1px solid #000;"> THIS IS AN ELECTRONIC TICKET. PLEASE CARRY A POSITIVE IDENTIFICATION FOR CHECK IN.</td>
									<td style="border: 1px solid #000;">
										<table style="width: 100%; border-spacing: 0px;border-collapse: collapse;">
											<tbody>
												<tr>
													<td style="padding: 7px 12px;border-right: 1px solid #000;   border-bottom: 1px solid #000;">AIR FARE:</td>
													<td style="padding: 7px 12px;    border-bottom: 1px solid #000;"><?php echo $SelectedFare->Response->Response->FlightItinerary->Fare->BaseFare; ?></td>
												</tr>
												<tr>
													<td style="padding: 7px 12px;border-right: 1px solid #000;    border-bottom: 1px solid #000;">TAX AND ADDITIONAL CHARGE (+):</td>
													<td style="padding: 7px 12px;    border-bottom: 1px solid #000;"><?php echo $BookingDetails->fbook_customer_fare + $BookingDetails->fbook_transaction_fee - $SelectedFare->Response->Response->FlightItinerary->Fare->BaseFare; ?> </td>
												</tr>
												<tr>
													<td style="padding: 7px 12px;border-right: 1px solid #000;">TOTAL AIR FARE:</td>
													<td style="padding: 7px 12px;"><?php echo $BookingDetails->fbook_customer_fare + $BookingDetails->fbook_transaction_fee; ?> </td>
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
					<td colspan="2" style="padding: 10px 0px; font-size: 13px;">Carriage and other services provided by the carrier are subject to conditions of carriage which hereby incorporated by reference. These conditions may be obtained from the issuing carrier. If the passenger's journey involves an ultimate destination or stop in a country other than country of departure the Warsaw convention may be applicable and the convention governs and in most cases limits the liability of carriers for death or personal injury and in respect of loss of or damage to baggage.</td>
				</tr>
				<tr>
					<td style="background: #d8d8d8; padding:12px 5px; font-size: 18px;">E & O.E</td>
					<td style="background: #d8d8d8; padding:12px 5px; font-size: 18px; text-align: right;">https://smarttripmaker.com</td>
				</tr>
				<tr>
					<td colspan="2" style="color: red; text-align: center; padding-top: 10px; padding-bottom: 10px;">This is Computer Generated Ticket does not required signature.</td>
				</tr>
			</tbody>
		</table>
		
		</div>
		
		<?php if($email_send!="true"){?>
		<div style="text-align: center;" class="d-print-none">
			<div style="padding-top: 10px;padding-bottom: 15px;">

				<div class="btn-group">
					<button onclick="window.close()" class="btn btn-danger">
						<span class="glyphicon glyphicon-remove"></span> Close </button>
				</div>
				<div class="btn-group">
					<button class="btn btn-success" onclick="printticket('printticketID');"><span class="glyphicon glyphicon-print"></span> Print </button>
				</div>
				</div>
			</div>
			<?php }?>
			
		</div>

	<script type="text/javascript" src="assets/js/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="assets/js/jquery.qrcode.min.js"></script>
	<script>
	function printticket(divName) {
                     var printContents = document.getElementById(divName).innerHTML;
                     var originalContents = document.body.innerHTML;

                     document.body.innerHTML = printContents;

                     window.print();

                     document.body.innerHTML = originalContents;
                }
		var pnr = "X94CHJ";
 		$('#qrcode').qrcode({width: 64,height: 64,text: pnr});
	</script>
</body>
</html>