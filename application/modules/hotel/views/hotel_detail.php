<?php 
  $this->load->view('include/head');
  $this->load->view('include/header');
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
  $bp_search_request = $_SESSION ['hotel'] ['search_data'];
  $checkin_date=$bp_search_request['checkIn'];
  $checkout_date =$bp_search_request['checkOut'];
  $diff = strtotime($checkout_date) - strtotime( $checkin_date);
  $nights = $diff/86400;
  $currencyCode = getCurrentCurrency();
	if(count($bp_room_detail) > 0){
		$currencyCode = $bp_room_detail[0]->Price->CurrencyCode;
  }
  $symbol = getCurrencySymbol($currencyCode); 
//   $checkInDate = $bp_hotel_result->HotelSearchResult->CheckInDate;
//   $checkOutDate = $bp_hotel_result->HotelSearchResult->CheckOutDate;
?>
<style>
	/* a { color: #0254EB; }
	a:visited { color: #0254EB; } */
	a.morelink { text-decoration:none; outline: none; }
	.morecontent span { display: none; }
	.comment { width: 100%;  margin: 10px; }
</style>
<!-----starts------>
<div class="main-field pt-2 pb-2 pt-md-4 pb-md-4">
	<div class="container">
		<div class="flght-booking-details hotl-booking-wrap">
			<div class="row">
				<div class="col-lg-8 col-md-8 col-sm-12">
					<div class="hotl-booking-temp">
						<!-- Hotel Title here -->
						<h3 class="title-htl"><?php echo $bp_hotel_detail->HotelName;?> </h3>
						<!-- Hotel Title end here -->
						<!-- slider here -->
						<div class="hotel-carousel owl-carousel">
							<?php if(isset($bp_hotel_detail->Images)){?>
								<?php if(is_array($bp_hotel_detail->Images)){?>
									<?php foreach($bp_hotel_detail->Images as $hptel_image_key => $bp_hotel_images){?>
										<div class="item">
											<a data-fancybox="gallery" href="<?php echo $bp_hotel_images;?>">
												<img src="<?php echo $bp_hotel_images;?>" alt="">
											</a>
										</div>
									<?php }?>
								<?php }?>
							<?php }?>
						</div>
						<!-- slider end here -->

					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-12">

					<div class="htl-side-booking-add">
						<h3>We Offer Lowest Price Guarantee</h3>
						<ul class="list-unstyled mb-0">
							<li><i class="icofont-google-map"></i> <?php echo $bp_hotel_detail->Address;?></li>
							<?php if($bp_hotel_detail->CountryName!=""){?>
							<li><i class="icofont-map"></i> <?php echo $bp_hotel_detail->CountryName;?></li>
							<?php }?>
							<li><i class="icofont-pin"></i> <?php echo $bp_hotel_detail->PinCode;?></li>
							<?php if($bp_hotel_detail->HotelContactNo!=""){?>
							<li> <i class="icofont-phone"></i><strong>Contact Number :
								</strong><?php echo $bp_hotel_detail->HotelContactNo;?></li>
							<?php }?>
							<?php if($bp_hotel_detail->FaxNumber!=""){?>
							<li><i class="icofont-fax"></i> <strong>Fax Number :
								</strong><?php echo $bp_hotel_detail->FaxNumber;?>
							</li>
							<?php }?>
							<?php if($bp_hotel_detail->Email!=""){?>
							<li><i class="icofont-envelope-open"></i> <strong>Email :
								</strong><?php echo $bp_hotel_detail->Email;?>
							</li>
							<?php }?>
							<?php if($bp_hotel_detail->Latitude!=""){?>
							<li> <i class="icofont-map"></i> <strong>Latitude :
								</strong><?php echo $bp_hotel_detail->Latitude;?></li>
							<?php }?>
							<?php if($bp_hotel_detail->Longitude!=""){?>
							<li> <i class="icofont-map"></i> <strong>Longitude :
								</strong><?php echo $bp_hotel_detail->Longitude;?>
							</li>
							<?php }?>
							<?php if(isset($bp_hotel_result->HotelSearchResult->CheckInDate)){?>
								<li> 
								<i class="icofont-calendar"></i>
									<strong>CheckIn : </strong>
									<?= date("d-m-y",strtotime($bp_hotel_result->HotelSearchResult->CheckInDate)) ?>
								</li>
							<?php }?>
							<?php if(isset($bp_hotel_result->HotelSearchResult->CheckOutDate)){?>
								<li> 
								<i class="icofont-calendar"></i>
									<strong>CheckOut : </strong>
									<?=  date("d-m-Y",strtotime($bp_hotel_result->HotelSearchResult->CheckInDate)) ?>
								</li>
							<?php }?>
						</ul>
					</div>
				</div>

				<div class="col-md-12">
					<div class="hotelBox-booking mt-2 mt-md-3">
						<ul class="nav nav-tabs" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" data-toggle="tab" href="#availability">
									<i class="icofont-home"></i> Availability
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" data-toggle="tab" href="#hotel-info">
									<i class="icofont-info"></i> Hotel Information
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" data-toggle="tab" href="#hotel-facility">
									<i class="icofont-hotel-boy-alt"></i> Hotel Facility
								</a>
							</li>
						</ul>

						<!-- Tab panes -->
						<div class="tab-content">
							<div id="availability" class="tab-pane active">
								<?php 
									$offerMealData = [];
									foreach($bp_room_detail as $item){
										$aminities = $item->Amenities;
										$aminities = (isset($aminities) && is_array($aminities)) ? $aminities[0] : null; 
										if($aminities){
											$ext = explode(",",$aminities);
											$offerMealData = array_merge($offerMealData,array_values($ext));
										}
									}
									$offerMealData = array_unique($offerMealData);
									if(is_array($offerMealData)){ 
										echo "<br/>";
										foreach($offerMealData as $offer){
											$offerValue = strtolower(str_replace(" ","_",trim($offer)));
								?>	
									<input type="checkbox" name="offer[]" value="<?= $offerValue ?>" class="offer_check" /> <?= $offer ?> &nbsp;&nbsp;
								<?php }  } ?>
								
								<?= 
									$this->load->view("room_information",[
										"bp_rooms" => $bp_rooms,
										"bp_room_result" => $bp_room_result,
										"bp_room_detail" => $bp_room_detail,
										"nights" => $nights,
										"symbol" => $symbol
									],TRUE)
								?>
							</div>

							<div id="hotel-info" class="tab-pane fade">
								<div class="dash-title pt-2 pt-md-3">
									<h3>General: </h3>
								</div>
								<ul class="list">
									<li class="comment"><?php echo trim(html_entity_decode($bp_hotel_detail->Description));?>.</li>
								</ul>
							</div>
							<div id="hotel-facility" class="tab-pane fade">
								<div class="dash-title pt-2 pt-md-3">
									<h3>Hotel Facility</h3>
								</div>
								<div class="row">
									<?php foreach($bp_hotel_detail->HotelFacilities as $bp_HotelFacilities) { ?>
									<div class="col-md-3">
										<div class="htl-facil">
											<p><i class="icofont-money"></i> <?php echo $bp_HotelFacilities;?></p>
										</div>
									</div>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>




<!------end----->


<div class="modal fade flights-search-popup" id="login_modal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="text-center w-100">Login </h5>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
				<div id="successMessage"> </div>
				<div class="text-center">
					<form action="" method="post" role="form" id="login" class="loginsignupform">
						<input type="hidden" name="ref" value="" id="ref_box" />
						<div class="form-group lg-col">
							<input id="email_ajax" type="email" name="email" class="form-control" autocomplete="off"
								placeholder="Enter Your Email Id" required>
							<span><i class="icofont-envelope-open"></i></span>
						</div>
						<div class="form-group lg-col">
							<input id="password_ajax" type="password" name="password" class="form-control"
								placeholder="Enter Your Password" required>
							<span><i class="icofont-lock"></i></span>
						</div>
						<button type="submit" class="btn btn-login login_in">
							<i class="icofont-long-arrow-right login_in"></i>
						</button>
					</form>
				</div>
			</div>
			<div class="modal-footer">
			</div>
		</div>
	</div>
</div>

<?php $this->load->view('include/footer');?>
<script src="<?php echo site_url();?>assets/js/jquery_lazy_master/jquery.lazy.min.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
		$(".bp_roomconditions").click(function () {
			var block_class = $(this).attr("condition_block");
			$("." + block_class).stop().slideToggle(300);
		});

		$(".showLogin").on("click",function(){
			$("#ref_box").val("");
			var ref = $(this).attr("data-ref");
			$("#ref_box").val(ref);
			$("#login_modal").modal("show");
		});

		$(".login_in").click(function (e) {
			e.preventDefault();
			$("#loader").css("zIndex","99999999");
			$("#loader").modal("show");
			var emailid = $("#email_ajax").val();
			var password = $("#password_ajax").val();
			var ref = $("#ref_box").val();
			$.ajax({
				type: "POST",
				url: "<?php echo site_url(); ?>hotel/login",
				data: {email: emailid,password: password},
				dataType: "text",
				cache: false,
				success: function (data) {
					$("#loader").modal("hide");
					var obj = jQuery.parseJSON(data);
					if (obj.status == "success") {
						location.href =ref;
						$('#successMessage').html(obj.message);
						$("#successMessage").addClass("alert alert-success");
					} else {
						$('#successMessage').html(obj.message);
						$("#successMessage").addClass("alert alert-danger");
					}
				}
			});
			return false;
		});
	});
	$(document).on("click",".offer_check",function(){
		handleCardOffer();
	});
	function handleCardOffer(){
		$(document).find(".room_card").hide();
		var i = 0;
		$(".offer_check").each(function(index, item){
			if($(item).is(":checked")){
				i++;
				var offer = $(item).val();
				$(document).find(".room_card."+offer).show();
			}
		});
		if(i == 0){
			$(document).find(".room_card").show();
		}
	}

/**
 * jQuery Shorten plugin 1.0.0
 * Copyright (c) 2013 Viral Patel
 * //www.viralpatel.net
 * Dual licensed under the MIT license:
 *  http://www.opensource.org/licenses/mit-license.php
*/
(function($) {
	$.fn.shorten = function (settings) {
		var config = {
			showChars: 100,
			ellipsesText: "...",
			moreText: '<i class="icofont-double-right"></i>'+"Show more",
			lessText: '<i class="icofont-double-left"></i>'+"Show less"
		};
		if (settings) {
			$.extend(config, settings);
		}
		$(document).off("click", '.morelink');
		$(document).on({click: function () {
				var $this = $(this);
				if ($this.hasClass('less')) {
					$this.removeClass('less');
					$this.html(config.moreText);
				} else {
					$this.addClass('less');
					$this.html(config.lessText);
				}
				$this.parent().prev().toggle();
				$this.prev().toggle();
				return false;
			}
		}, '.morelink');
		return this.each(function () {
			var $this = $(this);
			if($this.hasClass("shortened")) return;
			$this.addClass("shortened");
			var content = $this.html();
			if (content.length > config.showChars) {
				var c = content.substr(0, config.showChars);
				var h = content.substr(config.showChars, content.length - config.showChars);
				var html = c + '<span class="moreellipses">' + config.ellipsesText + ' </span><span class="morecontent"><span>' + h + '</span> <a href="#" class="morelink">' + config.moreText + '</a></span>';
				$this.html(html);
				$(".morecontent span").hide();
			}
		});
	};
 })(jQuery);

 $(".comment").shorten();

</script>
<script>
	$('.lazy').Lazy();
</script>