<!DOCTYPE html>
<?php 
$add_transction_disc = $BookingDetails->fbook_transaction_fee;
$BookingDetails->fbook_ib_customer_fare = $BookingDetails->fbook_ib_customer_fare + $add_transction_disc;
?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
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
				max-width: 540px;
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
	<div style="max-width: 1050px; margin: 0px auto;width: 100%;padding: 25px; font-size: 14px;background: #fff;" class="remove-css">
		<table border="0" cellpadding="0" cellspacing="0" style="width: 800px;min-width: 100%; border-spacing: 0px;border-collapse
		: colapse;">
			<tbody>
				<tr>
					<td style="border:0px none;">
					<a href="index.php">
							<img src="<?php echo site_url();?>/admin/assets/img/logos/<?php echo $this->dsa_data->dsa_logo;?>" alt="logo" style="max-width: 47%;">
						</a>
					</td>
					<td style="text-align: right;font-size: 18px;border:0px none;">
						<strong>Air Invoice</strong>
						<span id="qrcode" style="display: block; "></span>
					</td>
				</tr>
				<tr> 
					<td colspan="2" style="padding-bottom: 15px;">
						<table style="width: 800px;min-width: 100%; border-spacing: 0px;border-collapse: collapse;">
							<tr>
								<td style="border-top: 1px solid #000;border-bottom: 1px solid #000;border-left: 1px solid #000; padding: 8px;">
									<table style="border-spacing: 0px;border-collapse: collapse;">
										<tbody>
											<tr><td style="padding:5px 4px;font-size: 18px; "><strong style="font-size:2rem;">  <?php echo $this->dsa_data->dsa_company_name;?></strong></td></tr>
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
											<tr><td>Airline OB PNR:</td><td><strong><?php echo $BookingDetails->fbook_ob_pnr; ?></strong></td></tr>
											<tr><td>Airline IB PNR:</td><td><strong><?php echo $BookingDetails->fbook_ib_pnr; ?></strong></td></tr>
											<tr><td>Issue date:</td><td><?php echo date_format(date_create($BookingDetails->fbook_entry_date),"d M Y");?></td></tr>
										</tbody>
									</table>
								</td>
							</tr>	
						</table>
					</td>
				</tr>
				<!--===GST DETAILS===-->
				
				<tr>
					<td colspan="2" style="padding-bottom: 15px;">
						<table style="width: 800px;min-width: 100%; border-spacing: 0px;border-collapse: collapse;">
							<thead>
								<tr>
								<th style="padding: 7px 12px;background-color: #d8d8d8;border: 1px solid #000;">Company GST Details</th>
							<?php							
								if ($this->session->userdata ( 'Userlogin' ) != NULL) {								
								?>
								<th style="border-left:1px solid #000; padding: 7px 12px;background-color: #d8d8d8;border-bottom: 1px solid #000;border-right: 1px solid #000;">Customer GST Details</th>
							<?php } else{?>
							<?php }?>
								</tr>
							</thead>
							<tbody>
							<tr>
							<td style="padding:0px;border: 1px solid #000;">
								<table style="width: 100%; border-spacing: 0px;">
									<tr>
									<td style="padding: 7px 12px;border-bottom: 1px solid #000;">
									GST Company Name : SMART RIDE TRIP PLANNER PRIVATE LIMITED	
									</td>
									
									</tr>
									<tr>
									<td style="padding: 7px 12px;border-bottom: 1px solid #000;"> 
									GST Number : 03ABBCS8350AIZU
									</td>
									
									</tr>
									<tr>
									<td style="padding: 7px 12px;">
										GST Address : SEC-32,SMART RIDE TRIP PLANNER PRIVATE LIMITED, EXT-6 SUNNY ENCLAVE, DESU MAJRA, MOHALI KHARAR, SAS NAGAR, PUNJAB. 140301 
									</td>
									
									</tr>
									
								</table>
							</td>
							
							<?php							
							if ($this->session->userdata ( 'Userlogin' ) != NULL) {								
							?>	

							<td style="border-left: 1px solid #000;    padding: 0;    vertical-align: text-bottom;">
								<table style="width: 800px;min-width: 100%; border-spacing: 0px;">
									<tr>
										<td style="padding: 7px 12px;border-bottom: 1px solid #000;">
									GST Company Name : <?php echo $this->session->userdata("Userlogin")["userData"]->cust_gst_name; ?>
								</td>
									</tr>
									<tr>
										<td style="padding: 7px 12px;border-bottom: 1px solid #000;"> 
									GST Number : <?php echo $this->session->userdata("Userlogin")["userData"]->cust_gst_number; ?>
								</td>
									</tr>
									<tr>
										<td style="padding: 7px 12px;">
									GST Address : <?php echo $this->session->userdata("Userlogin")["userData"]->cust_gst_address; ?>
								</td>
								</tr>
									
								</table>
							</td>
							<?php } else {?>
							
							<?php }?>
							</tr>	
							</tbody>

						</table>
					</td>
				</tr>				
				<!--END GST DETAILS-->
				<!--INBOUND --->
				<tr>
					<td colspan="2" style="padding: 10px 1px;">  In Bound Detail</td>
				</tr>
				<tr>
					<td colspan="2" style="padding-bottom: 15px;">
						<table style="width: 800px;min-width: 100%; border-spacing: 0px;border-collapse: collapse;border:1px solid #000;">
							<thead>
								<tr>
									<th style="border-left:1px solid #000;padding: 7px 12px;background-color: #d8d8d8;border-bottom: 1px solid #000;border-right: 1px solid #000;">Passenger</th>
									<th style="border-left:1px solid #000; padding: 7px 12px;background-color: #d8d8d8;border-bottom: 1px solid #000;border-right: 1px solid #000;">Sector</th>
									<th style="border-left:1px solid #000; padding: 7px 12px;background-color: #d8d8d8;border-bottom: 1px solid #000;border-right: 1px solid #000;">Travel on</th>
									<th style="border-left:1px solid #000;padding: 7px 12px;background-color: #d8d8d8;border-bottom: 1px solid #000;border-right: 1px solid #000;">Airline PNR</th>
									<th style="border-left:1px solid #000; padding: 7px 12px;background-color: #d8d8d8;border-bottom: 1px solid #000;border-right: 1px solid #000;">Basic</th>
									<th style="border-left:1px solid #000; padding: 7px 12px;background-color: #d8d8d8;border-bottom: 1px solid #000;border-right: 1px solid #000;">YQ</th>
									<th style="border-left:1px solid #000; padding: 7px 12px;background-color: #d8d8d8;border-bottom: 1px solid #000;border-right: 1px solid #000;">Other</th>
									<th style="border-left:1px solid #000; padding: 7px 12px;background-color: #d8d8d8;border-bottom: 1px solid #000;border-right: 1px solid #000;">Baggage</th>
									<th style="border-left:1px solid #000; padding: 7px 12px;background-color: #d8d8d8;border-bottom: 1px solid #000;border-right: 1px solid #000;">Total</th>
								</tr>
							</thead>
							<tbody>
								 <?php foreach ($SelectedFareIB->Response->Response->FlightItinerary->Passenger as $PaxDetails_lop){ ?>
									<tr>
										<td style="border-left:1px solid #000; padding: 7px 12px;border-right: 1px solid #000;"> <?php echo $PaxDetails_lop->Title; ?> <?php echo $PaxDetails_lop->FirstName; ?> <?php echo $PaxDetails_lop->LastName; ?></td>
										<td style="border-left:1px solid #000; padding: 7px 12px;border-right: 1px solid #000;"><?php echo $BookingDetails->fbook_depart_airport_code; ?> -> <?php echo $BookingDetails->fbook_arrive_airport_code; ?></td>
										<td style="border-left:1px solid #000; padding: 7px 12px;border-right: 1px solid #000;"><?php echo GetDateScFull($SelectedFareIB->Response->Response->FlightItinerary->Segments[0]->Origin->DepTime); ?>, <?php echo GetTime($SelectedFareIB->Response->Response->FlightItinerary->Segments[0]->Origin->DepTime); ?></td>
										<td style="border-left:1px solid #000; padding: 7px 12px;border-right: 1px solid #000;"> <?php echo $BookingDetails->fbook_ob_pnr; ?></td>
										<td style="border-left:1px solid #000; padding: 7px 12px;border-right: 1px solid #000;"><?= $currency ?> <?php echo $PaxDetails_lop->Fare->BaseFare; ?></td>
										<td style="border-left:1px solid #000; padding: 7px 12px;border-right: 1px solid #000;"><?= $currency ?> <?php echo round($PaxDetails_lop->Fare->YQTax); ?></td>
										<?php  $baggage =  isset($BookingDetails->fbook_ob_baggage_amount) ? $BookingDetails->fbook_ob_baggage_amount : 0 ?>
										<td style="border-left:1px solid #000; padding: 7px 12px;border-right: 1px solid #000;"><?= $currency ?> <?php echo $BookingDetails->fbook_customer_fare - ($PaxDetails_lop->Fare->BaseFare + round($PaxDetails_lop->Fare->YQTax)) - $baggage; ?></td>
										<td style="border-left:1px solid #000; padding: 7px 12px;border-right: 1px solid #000;"><?= $currency ?> <?php echo isset($BookingDetails->fbook_ob_baggage_amount) ? $BookingDetails->fbook_ob_baggage_amount : '-'; ?></td>
										<td style="border-left:1px solid #000; padding: 7px 12px;border-right: 1px solid #000;"><?= $currency ?> <?php echo round($BookingDetails->fbook_customer_fare);?></td>
									</tr>
							 	<?php }?>
							</tbody>

						</table>
					</td>
				</tr>
				
				
				<!-----INBOUND------>
				<tr>
					<td colspan="2" style="padding: 10px 1px;">  Out Bound Detail</td>
				</tr>
				<tr>
					<td colspan="2" style="padding-bottom: 15px;">
						<table style="width: 800px;min-width: 100%; border-spacing: 0px;border-collapse: collapse;border:1px solid #000;">
							<thead>
								<tr>
									<th style="border-left:1px solid #000;padding: 7px 12px;background-color: #d8d8d8;border-bottom: 1px solid #000;border-right: 1px solid #000;">Passenger</th>
									<th style="border-left:1px solid #000; padding: 7px 12px;background-color: #d8d8d8;border-bottom: 1px solid #000;border-right: 1px solid #000;">Sector</th>
									<th style="border-left:1px solid #000; padding: 7px 12px;background-color: #d8d8d8;border-bottom: 1px solid #000;border-right: 1px solid #000;">Travel on</th>
									<th style="border-left:1px solid #000;padding: 7px 12px;background-color: #d8d8d8;border-bottom: 1px solid #000;border-right: 1px solid #000;">Airline PNR</th>
									<th style="border-left:1px solid #000; padding: 7px 12px;background-color: #d8d8d8;border-bottom: 1px solid #000;border-right: 1px solid #000;">Basic</th>
									<th style="border-left:1px solid #000; padding: 7px 12px;background-color: #d8d8d8;border-bottom: 1px solid #000;border-right: 1px solid #000;">YQ</th>
									<th style="border-left:1px solid #000; padding: 7px 12px;background-color: #d8d8d8;border-bottom: 1px solid #000;border-right: 1px solid #000;">Other</th>
									<th style="border-left:1px solid #000; padding: 7px 12px;background-color: #d8d8d8;border-bottom: 1px solid #000;border-right: 1px solid #000;">Baggage</th>
									<th style="border-left:1px solid #000; padding: 7px 12px;background-color: #d8d8d8;border-bottom: 1px solid #000;border-right: 1px solid #000;">Total</th>
								</tr>
							</thead>
							<tbody>
							 <?php foreach ($SelectedFare->Response->Response->FlightItinerary->Passenger as $PaxDetails_lop){ ?>
								<tr>
									<td style="border-left:1px solid #000; padding: 7px 12px;border-right: 1px solid #000;"> <?php echo $PaxDetails_lop->Title; ?> <?php echo $PaxDetails_lop->FirstName; ?> <?php echo $PaxDetails_lop->LastName; ?></td>
									<td style="border-left:1px solid #000; padding: 7px 12px;border-right: 1px solid #000;"><?php echo $BookingDetails->fbook_arrive_airport_code; ?> -> <?php echo $BookingDetails->fbook_depart_airport_code; ?></td>
									<td style="border-left:1px solid #000; padding: 7px 12px;border-right: 1px solid #000;"><?php echo GetDateScFull($SelectedFare->Response->Response->FlightItinerary->Segments[0]->Origin->DepTime); ?>, <?php echo GetTime($SelectedFare->Response->Response->FlightItinerary->Segments[0]->Origin->DepTime); ?></td>
									<td style="border-left:1px solid #000; padding: 7px 12px;border-right: 1px solid #000;"> <?php echo $BookingDetails->fbook_ib_pnr; ?></td>
									<td style="border-left:1px solid #000; padding: 7px 12px;border-right: 1px solid #000;"><?= $currency ?> <?php echo $PaxDetails_lop->Fare->BaseFare; ?></td>
									<td style="border-left:1px solid #000; padding: 7px 12px;border-right: 1px solid #000;"><?= $currency ?> <?php echo round($PaxDetails_lop->Fare->YQTax); ?></td>
									<?php  $baggage =  isset($BookingDetails->fbook_ib_baggage_amount) ? $BookingDetails->fbook_ib_baggage_amount : 0 ?>
									<td style="border-left:1px solid #000; padding: 7px 12px;border-right: 1px solid #000;"><?= $currency ?> <?php echo $BookingDetails->fbook_ib_customer_fare - ($PaxDetails_lop->Fare->BaseFare + round($PaxDetails_lop->Fare->YQTax)) -$baggage; ?></td>
									<td style="border-left:1px solid #000; padding: 7px 12px;border-right: 1px solid #000;"><?= $currency ?> <?php echo isset($BookingDetails->fbook_ib_baggage_amount) ? $BookingDetails->fbook_ib_baggage_amount : '-'; ?></td>
									<td style="border-left:1px solid #000; padding: 7px 12px;border-right: 1px solid #000;"><?= $currency ?> <?php echo round($BookingDetails->fbook_ib_customer_fare);?></td>
								</tr>
							 <?php }?>
						</tbody>
						</table>
					</td>
				</tr>
				
				
				
				
				
				<!--=========-->
				<tr>
					<td colspan="2" style="padding-bottom: 15px;">
						<table style="width: 800px;min-width: 100%; border-spacing: 0px;border-collapse: collapse;border:1px solid #000;">
							<tr>
								<td style="border-right:1px solid #000; padding: 6px;">(Reimbursement of air ticket issued by airlines)</td>
								<td style="padding: 6px;"><strong>Gross Total</strong></td>
								<td style="padding: 6px;"><?= $currency ?> <?php echo (round($BookingDetails->fbook_customer_fare) + round($BookingDetails->fbook_ib_customer_fare)); ?></td>
							</tr>
						</table>
					</td>
				</tr>
			</tbody>
		</table>
		</div>

	<script type="text/javascript" src="assets/js/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="assets/js/jquery.qrcode.min.js"></script>
	<script>
		var pnr = "X94CHJ";
 		$('#qrcode').qrcode({width: 64,height: 64,text: pnr});
	</script>
</body>
</html>