<?php $this->load->view('include/head') ?>
<?php $this->load->view('include/header'); ?>
<style>
.ui-datepicker-trigger {
    display: none !important;
}
</style>
<div class="main-field pt-2 pb-2 pt-md-4 pb-md-4">
<div class="container">
	<div class="clearfix">
		<?php
			if ($this->session->flashdata('flash_success') != NULl) {
			  $bhanu_message = $this->session->flashdata('flash_success');
			  ?>
		<div
			class="alert alert-sm alert-border-left alert-success  light alert-dismissable">
			<button type="button" class="close" data-dismiss="alert"
				aria-hidden="true">×</button>
			<i class="fa fa-info pr10"></i> <strong> <?php echo $bhanu_message; ?></strong>
		</div>
		<?php } ?>
		<?php
		if ($this->session->flashdata('flash_error') != NULL) {
			$bhanu_message = $this->session->flashdata('flash_error'); ?>
			<div class="alert alert-sm alert-border-left alert-danger  light alert-dismissable">
				<button type="button" class="close" data-dismiss="alert"
					aria-hidden="true">×</button>
				<i class="fa fa-info pr10"></i> <strong> <?php echo $bhanu_message; ?></strong>
			</div>
		<?php } ?>
	</div>
	<div class="flght-booking-details hotl-booking-wrap hldy-details-wrap">
		<div class="row">
			<div class="col-lg-8 col-md-8 col-sm-12">
				<div class="hotl-booking-temp">
					<!-- Hotel Title here -->
					<h3 class="title-htl"><?php echo $bookingdetail->holiday_name; ?></h3>
					<!-- Hotel Title end here -->
					<!-- slider here -->
				</div>
			</div>
			<div class="paul-card-content">
				<div class="paul-layout">
					<h4 class="htl-title">Upload Documents</h4>
					<ul>
						<li>Upload colored passport copies.</li>
						<li>Passport should be valid 6 months from the date of entry in UAE.</li>
						<li>Upload photograph with white background</li>
					</ul>
					<form name="frmTransaction" enctype="multipart/form-data" id="contact-form" method="POST" action="<?php echo site_url('visa/search');?>"  >
					<div class="row">
						<div class="wrapper">
							<?php
							echo form_hidden('visa_type',set_value('visa_type', isset($visa_id)? bp_hash($visa_id) :'' ));
							echo form_hidden('visa_country',set_value('visa_country', isset($location_id)? bp_hash($location_id) :'' )); ?>
							<!--<input type="hidden" name="visa_country" value="">
							<input type="hidden" name="visa_type" value="">-->
							<div class="box">
								<div class="js--image-preview"></div>
								<div class="upload-options">
									<label>
									<input type="file" name="passportFront" class="image-upload" accept="image/*" required="" />
									</label>
								</div>
							</div>
							<div class="box">
								<div class="js--image-preview"></div>
								<div class="upload-options1">
									<label>
									<input type="file" name="passportBack" class="image-upload" accept="image/*" required=""/>
									</label>
								</div>
							</div>
							<div class="box">
								<div class="js--image-preview"></div>
								<div class="upload-options2">
									<label>
									<input type="file" name="photograph" class="image-upload" accept="image/*" required="" />
									</label>
								</div>
							</div>
						</div>
						<div class="col-lg-12">
							<br />
							<h4 class="htl-title">Fill Form</h4>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="deposit-amount">First Name</label>
								<input type="text" name="firstName" id="firstName" class="form-control" placeholder="First Name" required="required" value="">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="deposit-amount">Last Name</label>
								<input type="text" name="lastName" id="deposit-amount" class="form-control" placeholder="Last Name" required="required" value="">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label for="deposit-amount">Email Address</label>
								<input type="text" name="email" id="email" class="form-control" placeholder="Email Address" required="required" value="" />
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="deposit-amount">Phone No.</label>
								<input type="text" name="phone" id="phone_no" class="form-control" placeholder="Phone No." required="required" value="" />
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="gender">Gender</label>
								<select name="gender" required="required" class="form-control">
									<option value="">Select Gender</option>
									<option value="Male">Male</option>
									<option value="Female">Female</option>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="nationality">Nationality</label>
								<select required="required" class="form-control" name="nationality">
									<option value="">Select Nationality</option>
									<?php 
										for($i=0; $i<count($nationality); $i++) { 
										//   if($nationality[$i]->nationality == 'Indian'){
									?>
										<option value="<?php echo $nationality[$i]->nationality ?>"><?php echo $nationality[$i]->nationality ?></option>
										<?php /* }*/ } ?>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="deposit-amount">Date of Birth</label>
								<input type="text" name="dob" readonly required="required" id="dateofBirth" class="form-control" placeholder="yyyy-mm-dd">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="deposit-amount">Departure Date</label>
								<input required="required" readonly type="text" name="departureDate" id="departure-date" class="form-control" placeholder="yyyy-mm-dd" value=""  >
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="deposit-amount">Return Date</label>
								<input type="text" readonly name="arrivalDate" required="required" id="arrivalDate" class="form-control" placeholder="yyyy-mm-dd" value=""  >
							</div>
						</div>
						<div class="col-md-4">
							<label for="">Destination</label>
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text">
									<i class="icofont-pin"></i>
									</span>
								</div>
								<select id="select-destination" class="form-control custom-select" name="destination">
									<option value="">Select Destination</option>
									<?php 
									if(!empty($location_list)) { 
										foreach($location_list as $locationdata){
											if(isset($location_id) && $location_id == $locationdata->location_id) {
												$loc_selected = 'selected="selected"'; 
											} else {
												$loc_selected = ''; 
											} ?>
											<option value="<?php echo bp_hash($locationdata->location_id); ?>" <?php echo $loc_selected; ?>><?php echo $locationdata->location_location; ?></option>
										<?php } 
									} ?>
								</select>
							</div>
						</div>
						<div class="col-md-8">
							<div class="form-group mb-3">
								<label for="">Visa Type</label>
								<select id="select-rating" class="form-control bp_hotel_search_validation custom-select" name="visa_id" required="">
									<option value="">Select Visa Type</option>
									<?php if(!empty($visalist)) { 
										$visa_amount = 0; 
										foreach($visalist as $visadata){ 
										  if(isset($visa_id) && $visa_id == $visadata->id) {
										    $selected = 'selected="selected"'; 
										    $visa_amount = convertPrice($visadata->visa_amount);
										  } else {
										    $selected = ''; 
										  }
										  ?>
									<option value="<?php echo bp_hash($visadata->id); ?>" <?php echo $selected; ?>><?php echo $visadata->visa_title.'(<b>Visa Fee : '.convertPrice($visadata->visa_amount).'</b>)'; ?></option>
									<?php } } ?>  
								</select>
							</div>
						</div>
						<?php 
							if($this->session->userdata("Userlogin") != NULL){
							  $bp_customer_total_balance=$this->user_data->cust_balance;
							  $bp_total_fare = $visa_amount;
							  if($bp_customer_total_balance > 0){ ?>
						<div class="col-md-12">
							<div class="checkbox">
								<label><input name="payment_method" class="term_condition" type="checkbox" value="customerCash"> Use Customer Wallet Amount <b>Available Balance is: </b><i class="icofont-rupee"></i><?php echo $bp_customer_total_balance; ?> </label>
							</div>
						</div>
						<?php } ?>
						<?php } ?>
						<div class="col-md-12">
							<div class="form-group">
								<?php echo form_button(array("type" => "submit", "class" => "btn btn-success", "content" => "Submit &rarr;")) ?>
							</div>
						</div>
					</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('include/footer') ?>

<script type="text/javascript">
	$(document).ready(function(){
		$('#select-rating').prop('disabled', 'disabled');
		$('#select-destination').prop('disabled', 'disabled');

		$('#departure-date,#arrivalDate').datepicker({
			numberOfMonths: 1,
			dayNamesMin: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
			"minDate": 0,
			// showOn: 'both',
			buttonText: '',
			dateFormat: 'yy-mm-dd',
			beforeShow: function () {
				$('#ui-datepicker-div').addClass("searchdatepicker");
			},
			onClose: function (selectedDate){
				$("#return_date").datepicker("option", "minDate", selectedDate);
			}
		});

		$('#dateofBirth').datepicker({
			numberOfMonths: 1,
			dayNamesMin: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
			// "minDate": 0,
			// showOn: 'both',
			buttonText: '',
			dateFormat: 'yy-mm-dd',
			beforeShow: function () {
				$('#ui-datepicker-div').addClass("searchdatepicker");
			},
			onClose: function (selectedDate){
				$("#return_date").datepicker("option", "minDate", selectedDate);
			}
		});
	});
	
	function book_registration() {	
		var cFname = $("#Cust_f_name").val();
		var cLname = $("#Cust_l_name").val();
		var cMobile = $("#Cust_mobile_no").val();
		var cEmail = $("#Cust_email_reg").val();           
		var tour_ID = $("#tour_ID").val(); 
		if(cFname ==""){
			$("#error_msg_reg").html("Enter First Name !");
			return false;
		}
		if(cLname ==""){
			$("#error_msg_reg").html("Enter Last Name !");
			return false;
		}
		if(cMobile ==""){
			$("#error_msg_reg").html("Enter Moble No. !");
			return false;
		} 
		if(cEmail ==""){
			$("#error_msg_reg").html("Enter Email ID");
			return false;
		} 
	
		$.ajax({
			type: "POST",
			url: "<?php echo site_url(); ?>holiday/ajax_booking_query",
			data: {custEmail: cEmail,custFirstName: cFname,custLastName: cLname,custMobleNo: cMobile,tour_ID: tour_ID},
			dataType: "text",
			cache: false,
			success:
			function (data) {
				var obj = jQuery.parseJSON(data);
				if (obj.status == "success") {                         
					$("#query_submit").modal("show");
					$("#book-hldy-pass").modal("hide");
					// $(".success_msg").html(obj.message);
					// $("#error_msg_reg").css('display', 'none'); 
					// $('.book_btn').prop('onclick',null).off('click');							
				}else{
					$("#error_msg_reg").html(obj.message);                          
				}
			}
		});	
	}

	
	$("#contact-form").validate({
		rules: {
			name:{ required: true,number:false,},  
			subject:{ required: true},
			mobile:{ required: true,number:true,minlength: 10,maxlength: 10 },
			email:{ required: true, email: true},
			message:{required: true},
		},
		messages:{}
	});
	
	
	$(function () {
		var url = window.location.pathname; 
		var accordion_head = $('.accordion > li > a'),
		accordion_body = $('.accordion li > .sub-menu');
		$('.accordion > li > ul > li > a').each(function () {  
			var linkPage = this.href.substring(this.href.lastIndexOf('/') + 1);
			if (linkPage=="profile") { 
				$(this).css("background-color","white");
			} 
		});
	})

	
	function initImageUpload(box) {
		let uploadField = box.querySelector('.image-upload');
		uploadField.addEventListener('change', getFile);
		function getFile(e){
			let file = e.currentTarget.files[0];
			checkType(file);
		}
		function previewImage(file){
			let thumb = box.querySelector('.js--image-preview'),
			reader = new FileReader();
			reader.onload = function() {
				thumb.style.backgroundImage = 'url(' + reader.result + ')';
			}
			reader.readAsDataURL(file);
			thumb.className += ' js--no-default';
		}
		function checkType(file){
			let imageType = /image.*/;
			if (!file.type.match(imageType)) {
				throw 'Datei ist kein Bild';
			} else if (!file){
				throw 'Kein Bild gewählt';
			} else {
				previewImage(file);
			}
		}
	}
	
	// initialize box-scope
	var boxes = document.querySelectorAll('.box');
	for (let i = 0; i < boxes.length; i++) {
		let box = boxes[i];
		initDropEffect(box);
		initImageUpload(box);
	}

	/// drop-effect
	function initDropEffect(box){
		let area, drop, areaWidth, areaHeight, maxDistance, dropWidth, dropHeight, x, y;
		// get clickable area for drop effect
		area = box.querySelector('.js--image-preview');
		area.addEventListener('click', fireRipple);
		function fireRipple(e){
			area = e.currentTarget
			// create drop
			if(!drop){
				drop = document.createElement('span');
				drop.className = 'drop';
				this.appendChild(drop);
			}
			// reset animate class
			drop.className = 'drop';
			// calculate dimensions of area (longest side)
			areaWidth = getComputedStyle(this, null).getPropertyValue("width");
			areaHeight = getComputedStyle(this, null).getPropertyValue("height");
			maxDistance = Math.max(parseInt(areaWidth, 10), parseInt(areaHeight, 10));
			// set drop dimensions to fill area
			drop.style.width = maxDistance + 'px';
			drop.style.height = maxDistance + 'px';
			// calculate dimensions of drop
			dropWidth = getComputedStyle(this, null).getPropertyValue("width");
			dropHeight = getComputedStyle(this, null).getPropertyValue("height");
			// calculate relative coordinates of click
			// logic: click coordinates relative to page - parent's position relative to page - half of self height/width to make it controllable from the center
			x = e.pageX - this.offsetLeft - (parseInt(dropWidth, 10)/2);
			y = e.pageY - this.offsetTop - (parseInt(dropHeight, 10)/2) - 30;
			// position drop and animate
			drop.style.top = y + 'px';
			drop.style.left = x + 'px';
			drop.className += ' animate';
			e.stopPropagation();
		}
	}
	
</script>

