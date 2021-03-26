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
	<div style="max-width: 850px; margin: 0px auto;width: 100%;padding: 25px; font-size: 14px;background: #fff;" class="remove-css">
	 <div id="printticketID">
		<table border="0" cellpadding="0" cellspacing="0" width="800px" style="width: 800px;min-width: 100%; border-spacing: 0px;border-collapse: colapse;">
			<tbody>
				<tr>
					<td style="border:0px none;">
						<a href="<?php echo site_url();?>">
						<img src="<?php echo site_url();?>/admin/assets/img/logos/<?php echo $this->dsa_data->dsa_logo;?>" alt="logo" style="max-width: 150px;">
						
						</a>
					</td>
					<!--<td style="text-align: right;font-size: 18px;border:0px none;">
						<strong>E-Ticket</strong>
						<span id="qrcode" style="display: block; "></span>
					</td>-->
				</tr>
				<tr> 
					<td colspan="2" style="padding-bottom: 15px;">
						<table style="border-spacing: 0px;border-collapse: collapse;width: 800px;min-width: 100%;">
							<tr>
								<td style="border-top: 1px solid #000;border-bottom: 1px solid #000;border-left: 1px solid #000; padding: 8px;">
									<table style="border-spacing: 0px;border-collapse: collapse;">
										<tbody>
											<tr><td style="padding:5px 4px;font-size: 18px; "><strong><?php echo $this->dsa_data->dsa_company_name;?></strong></td></tr>
											<tr>
												<td>
												 <?php echo $this->dsa_setting->dsaset_address_1;?>,<br> <?php echo $this->dsa_setting->dsaset_city;?>, <?php echo $this->dsa_setting->dsaset_state;?>, <?php echo $this->dsa_setting->dsaset_country;?>
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
									<table style="border-spacing: 0px;border-collapse: collapse;">
										<tbody>
											<tr><td>Reference ID:</td><td><strong>STM00<?php echo $BookingDetails->fbook_id; ?></strong></td></tr>
											
											<tr><td>Issue date:</td><td> <?php echo date_format(date_create($BookingDetails->fbook_entry_date),"d M Y");?></td></tr>
										</tbody>
									</table>
								</td>
							</tr>	
						</table>
					</td>
				</tr>
				<tr>
					<td colspan="2" style="padding: 10px 1px;"> Customer Detail</td>
				</tr>
				<tr>
					<td colspan="2" style="padding-bottom: 15px;">
						<table style="width: 800px;min-width: 100%; border-spacing: 0px;border-collapse: collapse;border:1px solid #000;">
							<thead>
								<tr>
									<th style="border-left:1px solid #000;padding: 7px 12px;background-color: #d8d8d8;border-bottom: 1px solid #000;border-right: 1px solid #000;">NAME</th>
									<th style="border-left:1px solid #000; padding: 7px 12px;background-color: #d8d8d8;border-bottom: 1px solid #000;border-right: 1px solid #000;">EMAIL ID</th>
									<th style="border-left:1px solid #000; padding: 7px 12px;background-color: #d8d8d8;border-bottom: 1px solid #000;border-right: 1px solid #000;">MOBILE NO.</th>
									<th style="border-left:1px solid #000; padding: 7px 12px;background-color: #d8d8d8;border-bottom: 1px solid #000;border-right: 1px solid #000;">TOTAL PASSANGER</th>
									
								</tr>
							</thead>
							<tbody>
							
								<tr>
									<td style="border-left:1px solid #000; padding: 7px 12px;border-right: 1px solid #000;"> <?php echo $BookingDetails->fbook_contact_name; ?> <?php echo $PaxDetails_lop->fpax_first_name; ?> <?php echo $PaxDetails_lop->fpax_last_name; ?></td>
									<td style="border-left:1px solid #000; padding: 7px 12px;border-right: 1px solid #000;"><?php echo $BookingDetails->fbook_contact_email; ?></td>
									<td style="border-left:1px solid #000; padding: 7px 12px;border-right: 1px solid #000;"> <?php echo $BookingDetails->fbook_contact_phone; ?></td>
									
									<td style="border-left:1px solid #000; padding: 7px 12px;border-right: 1px solid #000;">
										<p style="font-size:14px; text-transform:uppercase; color:#333333; margin:0; font-weight:normal;  ">  
										<?php echo $BookingDetails->fbook_adult + $BookingDetails->fbook_child + $BookingDetails->fbook_infant ; ?>
										 </p>
                                      </td>
									
								</tr>
							 
							</tbody>
						</table>
					</td>
				</tr>
				<tr>
					<td colspan="2" style="padding-bottom: 8px;"> Flight Detail</td>
				</tr>
				<tr>
					<td colspan="2" style="padding-bottom: 15px;">
						<table style="width: 800px;min-width: 100%; border-spacing: 0px;border-collapse: collapse; border:1px solid #000;">
							<thead>
								<tr>
									<th style="padding: 7px 12px;background-color: #d8d8d8;border-bottom: 1px solid #000;border-right: 1px solid #000;">FLIGHT</th>
									<th style="padding: 7px 12px;background-color: #d8d8d8;border-bottom: 1px solid #000;border-right: 1px solid #000;">SEGMENT</th>
									<th style="padding: 7px 12px;background-color: #d8d8d8;border-bottom: 1px solid #000;border-right: 1px solid #000;">DEPART DATE</th>
									<?php if($BookingDetails->fbook_return_date!=""){?>
									<th style="padding: 7px 12px;background-color: #d8d8d8;border-bottom: 1px solid #000;border-right: 1px solid #000;">RETURN DATE</th>
									<?php }?>
									<th style="padding: 7px 12px;background-color: #d8d8d8;border-bottom: 1px solid #000;border-right: 1px solid #000;">STATUS</th>
									<th style="padding: 7px 12px;background-color: #d8d8d8;border-bottom: 1px solid #000;border-right: 1px solid #000;">TOTAL FARE</th>
								
								</tr>
							</thead>
							<tbody>
							
								<tr>
									<td style="padding: 7px 12px;border-right: 1px solid #000;">
										  <img src="<?php echo site_url(); ?>assets/images/airlines/<?php echo $BookingDetails->fbook_airline_code; ?>.gif">
										<p style="font-size:14px; text-transform:uppercase; color:#333333; margin:0; font-weight:normal;  "> <?php echo $BookingDetails->fbook_airline_name; ?></p></td>
									<td style="padding: 7px 12px;border-right: 1px solid #000;">
										<p style="font-size:14px; text-transform:uppercase; color:#333333; margin:0; font-weight:normal;  "> 
										<?php echo $BookingDetails->fbook_depart_city; ?> - <?php echo $BookingDetails->fbook_arrive_city; ?>  
										
                                        </p>
									</td>
									<td style="padding: 7px 12px;border-right: 1px solid #000;">
									<?php echo date_format(date_create($BookingDetails->fbook_depart_date),"d M Y");?>
									</td>
									<?php if($BookingDetails->fbook_return_date!=""){?>
									<td style="padding: 7px 12px;border-right: 1px solid #000;">
									<?php echo date_format(date_create($BookingDetails->fbook_return_date),"d M Y");?>
									</td>
									<?php }?>
									
									<td style="padding: 7px 12px;border-right: 1px solid #000;">
									<?php echo $BookingDetails->fbook_ob_booking_status ;?>
									</td>
									<td style="padding: 7px 12px;border-right: 1px solid #000;">
									<?php echo ($BookingDetails->fbook_customer_fare + $BookingDetails->fbook_ib_customer_fare + $BookingDetails->fbook_transaction_fee) ;?>
									</td>
								</tr>
							
							</tbody>

						</table>
					</td>
				</tr>
								
				
			</tbody>
		</table>
		<br>
	</div>	
			
		</div>


</body>
</html>