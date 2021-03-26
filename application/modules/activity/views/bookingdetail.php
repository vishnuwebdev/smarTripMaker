 <?php $this->load->view("holidaylayout/header"); ?>
<div class="container-fluid tourextradetailsfluid pt50 pb50 light-bg">
	<div class="container tourextradetailscontainer">
    <h1 class="block fz24 black-color mb15 fwb">Booking Details</h1>
    <div class="row tourextradetailsrow">
      <div class="col-sm-8">
        <div class="clearfix tourextradetailsleftcol">
          <div class="extraaddtour">
            <h3 class="black-color fwb fz18">Tours Extras</h3>
            <div href="#none" class="extraaddtourbox">
              <div class="row">
                <div class="col-sm-4">
                  <img src="<?php echo site_url(); ?>assets/holiday/images/slide1.jpg" alt="slide1.jpg">
                </div>
                <div class="col-sm-5">
                  <p>Petra from Tel Aviv...</p>
                  <span class="stars">
                    <i class="fa fa-star active"></i>
                    <i class="fa fa-star active"></i>
                    <i class="fa fa-star active"></i>
                    <i class="fa fa-star active"></i>
                    <i class="fa fa-star"></i>
                  </span>
                  <span class="fz18 sub-color mt15 block"><i class="fa fa-inr"></i> 26655</span>
                </div>
                <div class="col-sm-3">
                  <label for="">Yes, Add it </label>
                  <input type="checkbox" name="" id="">
                </div>
              </div>
            </div>
            <div href="#none" class="extraaddtourbox">
              <div class="row">
                <div class="col-sm-4">
                  <img src="<?php echo site_url(); ?>assets/holiday/images/slide1.jpg" alt="slide1.jpg">
                </div>
                <div class="col-sm-5">
                  <p>Petra from Tel Aviv...</p>
                  <span class="stars">
                    <i class="fa fa-star active"></i>
                    <i class="fa fa-star active"></i>
                    <i class="fa fa-star active"></i>
                    <i class="fa fa-star active"></i>
                    <i class="fa fa-star"></i>
                  </span>
                  <span class="fz18 sub-color mt15 block"><i class="fa fa-inr"></i> 26655</span>
                </div>
                <div class="col-sm-3">
                  <label for="">Yes, Add it </label>
                  <input type="checkbox" name="" id="">
                </div>
              </div>
            </div>
            <div href="#none" class="extraaddtourbox">
              <div class="row">
                <div class="col-sm-4">
                  <img src="<?php echo site_url(); ?>assets/holiday/images/slide1.jpg" alt="slide1.jpg">
                </div>
                <div class="col-sm-5">
                  <p>Petra from Tel Aviv...</p>
                  <span class="stars">
                    <i class="fa fa-star active"></i>
                    <i class="fa fa-star active"></i>
                    <i class="fa fa-star active"></i>
                    <i class="fa fa-star active"></i>
                    <i class="fa fa-star"></i>
                  </span>
                  <span class="fz18 sub-color mt15 block"><i class="fa fa-inr"></i> 26655</span>
                </div>
                <div class="col-sm-3">
                  <label for="">Yes, Add it </label>
                  <input type="checkbox" name="" id="">
                </div>
              </div>
            </div>
          </div>
          <div class="clearfix tac mt30">
              <a href="<?php echo site_url(); ?>/holiday/tour_passenger_details" class="btn btn-primary">Next</a>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="tourextradetailsrightcol">
          <img src="<?php echo site_url(); ?>assets/holiday/images/slide1.jpg" alt="slide1.jpg">
          <div class="p15">
            <h1 class="block fz18 black-color mt0 mb15 fwb">Petra from Tel Aviv w/flights and one night in Eilat (64) 
              <span class="block fz14 mt15">
                <i class="fa fa-map-marker"></i> Location(s)<span class="block mt10 fz12">Delhi | Shimla | Manali</span>
              </span>
              <span class="block mt10">
                <span class="stars">
                  <i class="fa fa-star active"></i>
                  <i class="fa fa-star active"></i>
                  <i class="fa fa-star active"></i>
                  <i class="fa fa-star active"></i>
                  <i class="fa fa-star"></i>
                </span>
              </span>
            </h1>
          </div>
          <div class="clearfix p15">
            <ul class="pack-ul-details clearfix">
              <li class="clearfix">
                <span class="left">Days : 1</span>
                <strong class="right">Nights : 0</strong>
              </li>
              <li class="clearfix">
                <span class="left">Date :</span>
                <strong class="right">01/02/2018</strong>
              </li>
              <li class="clearfix">
                <span class="left">Hotel:</span>
                <strong class="right">Sde Dov Airport Tel Aviv</strong>
              </li>
              <li class="clearfix">
                <span class="left">Adults :   1</span>
                <strong class="right"><i class="fa fa-inr"></i> 331</strong>
              </li>
              <li class="clearfix">
                <span class="left">Subtotal</span>
                <strong class="right"><i class="fa fa-inr"></i> 331</strong>
              </li>
              <li class="clearfix">
                <span class="left">Tax & VAT</span>
                <strong class="right"><i class="fa fa-inr"></i> 0</strong>
              </li>
              <li class="clearfix totalpriceofpack">
                <span class="left">Total</span>
                <strong class="right"><i class="fa fa-inr"></i> 331</strong>
              </li>
            </ul>
          </div>
          <div class="p15 alert alert-warning square">
            <p class="para">
              Full payment will be charged to your credit card when you book this service. Please be aware that your bank may convert the payment to your local currency and charge you an additional conversion fee. This means that the amount you see on your credit or bank card statement may be in your local currency and therefore a different figure than the Total Price shown above. If you have any questions about this fee or the exchange rate applied to your booking, please contact your bank.
            </p>
          </div>
        </div>
      </div>
    </div>
	</div>
</div>
 <?php $this->load->view("holidaylayout/footer"); ?>