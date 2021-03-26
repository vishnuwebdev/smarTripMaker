
<?php $this->load->view('header');?>


<?php
$bp_pax_request = $_SESSION ['hotel'] ['array'] ['search_request'] ['RoomGuests'];
$bp_pax_details = $_SESSION['Hotel']['Pax_info'];
// PrintArray($_SESSION ['hotel'] ['array'] ['hotel_info_result']);
$bp_hotel_result = $_SESSION['Hotel_Offline'] ['array'];
$bp_room_detail = $_SESSION ['hotel'] ['array'] ['hotel_room_result'];
$bp_rooms = $bp_hotel_result['room'];
$bp_nights = $bp_hotel_result['nights'];
// echo"<pre>";
// print_r($bp_room_detail);
// die;
$bp_rooms = $bp_hotel_result['room'] ;
$bp_nights = $bp_hotel_result['nights'] ;
$bp_adults = $bp_hotel_result['adult_1'];
$no_adult = 0;
$no_child = 0;
for($i = 1; $i <= $bp_rooms; $i ++) {
				$data ["adult_" . $i] = $bp_hotel_result['adult_' . $i];
				$no_adult =  $no_adult + $bp_hotel_result['adult_' . $i];
				$data ["child_" . $i] = $bp_hotel_result['child_' . $i];
				$no_child =  $no_child + $bp_hotel_result['child_' . $i];
}

			$_SESSION ['Hotel']['No_Of_Adults'] = $no_adult;
			$_SESSION ['Hotel']['No_Of_child'] = $no_child;
			

$bp_hotel_detail = $_SESSION ['hotel'] ['array'] ['hotel_detail'];
$bp_room_detail = $_SESSION ['hotel'] ['amount'] ['room_detail'];
$bp_total_customer_fare = $_SESSION ['hotel'] ['amount'] ['customer_fare'];
$bp_base_fare = $_SESSION ['hotel'] ['amount'] ['base_fare'];
$bp_tax = $_SESSION ['hotel'] ['amount'] ['tax'];
?>
<style>
vishank, 3:39 PM
<style>
.pl-26{
padding-left: 26px;
}
.pt-7{
padding-top: 7px; 
}
.pt-30{
padding-top: 30px;
}
.pt-4{
padding-top: 4px;
}
.height-84{
height: 84px;
}
.mt-25{
margin-top: 25px;
}
.detail-col-left h2{
color: #009fda;
margin: 0;
}
.detail-col-right h3{
color: #009fda;
margin: 0;
}
.bg-custom {
background: #02a0de;
color: white;
}
.text-white {
color: white;
}
.p-2 {
padding: 10px;
}
.m-0{
margin: 0;
}
.p-1{
padding: 5px;
}
.detail-section h6{
font-size: 15px;
}
.detail-section h5{
font-size: 14px;
}
.detail-col-right h6{
font-size: 15px;
}
.font-bold {
font-weight: bold;
}
.detail-col-right, .detail-col-left {
margin-top: 60px;
}
.full-col {
float: left;
width: 100%;
padding: 5px 5px;
border-bottom: 1px solid #cfcfcf;
font-size: 14px;
}
.full-col.padding-bottom-70 {
padding-bottom: 70px;	
}
.full-col.padding-top-0 {
padding-top: 0;
}
.detail-col-right h3, .detail-col-right h4 {
font-size: 20px;
color: #1e1e1e;
font-family: 'rubikmedium';
margin: 0;
}
.detail-col-right h4 {
font-size: 16px;
}
.detail-col-right h4.purple {
color: #02a0de;
}
.full-col .col-sm-12 {
margin-top: 10px;
}
.full-col .col-sm-12.margin-top-0 {
margin-top: 0;
}
.full-col h6 {
font-size: 14px;
color: #02a0de;
font-family: 'rubikmedium';
margin: 0;
}
.full-col p {
margin: 0;
}
@media (max-width: 767px){
body{
font-size: 11px !important;
}
.xs-help-block{
position: absolute !important;
top: -65px !important;
width: 100% !important;
left: 0px !important;
background: #e91e63 !important;
color: white !important;
text-align: center !important;
}
.xs-balance-details{
float: none !important;

}
.xs-navbar-header{
margin-top: 20px !important;
}
.navbar-default .navbar-toggle {
border: none;
margin: 0;
background: #e91e63 !important;
height: 33px;
}
.xs-navbar-brand{
height: 40px !important;
width: 80%;
}
.logo_wologin{
width: 100% !important;
padding: 0 !important;
}
.xs-show{
display: block !important;
}
.container-fluid{
padding-left: 0;
padding-right: 0;
}
.footerfluid1{
padding-top: 0px;
padding-bottom: 0px;
}
.xs-text-center{
text-align: center !important;
}
.login_button_xs{
margin-top: -42px;
}
.no-padding-xs{
padding:0;
}
.search_result_info p {
margin: 0;
line-height: 17px;
}
.loginmodal-container{
border-radius: 0 !important;
padding: 15px !important;
}
.pt-0-xs{
padding-top: 0 !important;
}
.pl-0-xs{
padding-left: 0 !important;
}
.pr-0-xs{
padding-right: 0 !important;
}
.height-auto-xs{
height:auto !important;
}
.mb-0-xs{
margin-bottom: 0 !important;
}
.pt-5-xs{
padding-top: 5px !important;
}
.signup-clearfix{
padding: 10px !important;
}
.loginpagerow>div{
margin-bottom: 0px;
}
.xs-text-right{
text-align:right;
}
.xs-desp {
display: block !important;
}
.search_result_info_arrow {
position: absolute;
left: 48%;
color: white;
top: 5px;
}
.modify_btn button{
font-size: 9px;
padding: 1px;
height: 25px;
}
.airlines p {
margin-bottom: 0 !important;
line-height: 20px;
}
.btn{
height: auto !important;
font-size: 11px !important;
padding: 5px 10px !important;
}
.airline_price{
font-size: 18px !important;
margin-top: 0 !important;
margin-bottom: 3px !important;
}
.contant .row{
margin-bottom: 5px !important;

}
.mb-10-xs{
margin-bottom: 10px !important;
}
.pl-10-xs{
padding-left: 10px !important;
}
.filter-btn{
position: absolute;
left: 42%;
top: 1px;
}
.hidden-on-mob{
display: none;
}
.position {
position: absolute;
background: #ece4e4;
width: 100%;
z-index: 1000;
top: 0px;
padding-top: 15px;
}
.filter_click_submit{
position: fixed;
left: 0;
width: 100%;
bottom: 0;
font-size: 15px !important;
background: #3072ac;
}
.pl-5-xs{
padding-left: 5px;
}
.pr-5-xs{
padding-right: 5px;
}
.container-auto{
width: 100% !important;
}
.sm-scroll_div {
overflow-y: auto;
height: 500px;
}
.pull-left-xs{
float: left !important;
}
.pull-right-xs{
float: right !important;
}
.dots-sm {
margin: 0 !important;
line-height: 0 !important;
}
.duration_on_sm {
position: absolute;
top: 25px;
left: 36%;
width: 65%;
}
.airline_price_rtn-sm {
font-size: 16px !important;
margin-top: 10px !important;
text-align: right !important;
}
#footer_fix_price_details h2 {
margin-top: 11px !important;
font-size: 23px !important;
}
#footer_fix_price_details {
padding: 3px 15px !important;
height: 50px !important;
}
.pt-10-xs{
padding-top: 10px !important;
}
.nonrefund-xs{
position: absolute !important;
top: -15px !important;
font-size: 9px !important;
}
.refund-xs{
position: absolute !important;
top: -18px !important;
font-size: 9px !important;
}
.text-center-xs{
text-align: center !important;
}
.xs-pt-10{
padding-top: 10px;
}
.booking-review p{
line-height: 14px !important;
}
.xs-promo {
width: 70% !important;
float: left !important;
}
.xs-promo-aply {
float: right;
}
.pl-0-xs{
padding-left: 0;
}
img.logo{
width: 69%;
padding-top: 16px;
}
}
.body_backgorund{
background:white;
}
.border {
border: 1px solid gainsboro;
}
</style>
</style>

	<section>
			<div class="container">
				<div class="row">
					<div class="col-sm-12 col-md-12 col-lg-8 detail-col-left">
						<h2 class="purple">Guest Details</h2>
						<!-- <ul class="steps">
							<li class="done">
								<span class="number">1</span>
								<span class="label">Rooms</span>
							</li>
							<li class="done">
								<span class="number">2</span>
								<span class="label">Guest Details</span>
							</li>
							<li class="current">
								<span class="number">3</span>
								<span class="label">Confirmation</span>
							</li>
						</ul> -->
						<div class="detail-section">
                               <div class="row">
									<div class="col-sm-12 col-md-6">
										<h3>HOTEL VOUCHER</h3>
									</div>
									<div class="col-sm-12 col-md-6 text-right">
										<h6><b> Your Booking Id: <?php echo $_SESSION ['booking_id'];?></b></h6>
									</div>
                              </div>
								<h5 class="mt-5">
									PLEASE PRESENT THIS VOUCHER UPON ARRIVAL
								</h5>
								<h5 class="bg-custom mb-0 mt-5 p-2 text-white"><?php echo $hotel_details->hofl_hotel_name;?></h5>
                            <p class="border p-2 mb-0"><?php echo $hotel_details->hofl_address;?>, <?php echo $hotel_details->hofl_city;?>, <?php echo $hotel_details->hofl_state;?>, <?php echo $hotel_details->hofl_country;?>, <?php echo $hotel_details->hofl_pincode;?></p>
                            <p class="border p-2"><b>Hotel Contact Number : </b>   <?php if($hotel_details->hofl_phone){echo "<i class='fa fa-phone'></i>".$hotel_details->hofl_phone;} else{ echo "Contact details are not available"; } ?></p>
								<div class="p-3 ">
									<div class="col-12 col-md-4 p-0 text-center">
										<p class="bg-custom m-0 p-1 border-right text-white"><strong class="bg-custom p">Check-in</strong></p>
										<p class="border m-0 p-1"><?php echo $bp_hotel_result['checkIn'];?></p>
									</div>
									<div class="col-12 col-md-4 p-0 text-center">
										<p class="bg-custom m-0 p-1 border-right text-white"><strong class="bg-custom p">Check-out</strong></p>
										<p class="border m-0 p-1"><?php echo $bp_hotel_result['checkOut'];?></p>
									</div>
                                    <div class="col-12 col-md-4 p-0 text-center">
                                    <p class="bg-custom m-0 p-1 text-white"><strong class="bg-custom p">Guest</strong></p>
										<p class="border m-0 p-1"><?php echo $_SESSION ['Hotel']['No_Of_Adults'];?> Adults, <?php echo $_SESSION ['Hotel']['No_Of_child'];?> Children</p>
									</div>
									
								
								</div>
								<?php foreach($bp_pax_details as $bp_pax_key => $bp_pax_reqdetails){?>
									<div style="margin-top:80px">
										<div class="bg-custom margin-bottom-10 mt-10 p-1 text-white">
											<h4 class="m-0"><?php echo $bp_room_detail[0]->hoffr_room_type;?></h4>
										</div>
										<div class="margin-bottom-10">
										    <?php foreach($bp_pax_reqdetails as $bp_pax_key => $bp_pax_requests){ ?>
											  <p class="border m-0 p-1"><?php echo $bp_pax_requests['Title'];?> <?php echo $bp_pax_requests['FirstName'];?> <?php echo $bp_pax_requests['LastName'];?></p>
											  <?php }?>
										</div> 
									</div>
									<?php }?>
                             <div class="row">
									<div class="col-md-12 col-sm-12 font-bold text-center p-2">
										Booking ID: <?php echo $_SESSION ['booking_id'];?>
									</div>
                              </div>
						</div>
					</div>
					<div class="col-sm-12 col-md-12 col-lg-4 detail-col-right">
							<div class="inner">
					<div class="full-col">
						<h3>Your Stay</h3>
						<div class="row">
							<div class="col-sm-12 col-md-6">
								<h6>Check-in</h6>
								<p>After 12:00 PM</p>
							</div>
							<div class="col-sm-12 col-md-6">
								<h6>Check-out</h6>
								<p>Before 12:00 PM</p>
							</div>
							<div class="col-sm-12">
								<br /><?php echo $_SESSION ['Hotel']['No_Of_Adults'];?> Adults , <?php echo $_SESSION ['Hotel']['No_Of_child'];?> Children
							</div>
						</div>
					</div>
					<div class="full-col">
						<div class="row">
							<div class="col-sm-12 col-md-6">Room Price</div>
							<div class="col-sm-12 col-md-6 text-right">
								<i class=""></i><?php echo $this->bp_white_label_setting->wls_currency_symbol;?>  <?php echo dsa_currency_convert($bp_base_fare);?>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12 col-md-6">Tax</div>
							<div class="col-sm-12 col-md-6 text-right">
							<i class=""></i><?php echo $this->bp_white_label_setting->wls_currency_symbol;?> <?php echo dsa_currency_convert($bp_tax);?>
							</div>
						</div>
					</div>
					<div class="full-col padding-top-0">
						<div class="row total">
							<div class="col-sm-12 col-md-6">Total</div>
							<div class="col-sm-12 col-md-6 text-right">
								<i class=""></i><?php echo $this->bp_white_label_setting->wls_currency_symbol;?> <?php echo dsa_currency_convert($bp_total_customer_fare);?> <span class="light-gray-text"></span>
							</div>
						</div>
					</div>
				</div>
				<div class="full-col" style="border:none">
						<div class="row total">
							<a target="_blank" href="<?php echo site_url(); ?>hotel/voucher_print/?ref_id=<?php echo bp_hash($_SESSION ['booking_id']); ?>" style="float:right color:#fff" class="btn btn-primary bp_hotel_info_find"  id="id_btn">Print Voucher</a> 
						</div>
				</div>
			</div> 
					
					
					
					
				</div>
			</div>
		</section>
<?php $this->load->view('footer') ; ?>