 <?php $this->load->view("header"); ?>
<div class="container-fluid tourextradetailsfluid pt50 pb50 light-bg">
	<div class="container tourextradetailscontainer">
    <h1 class="block fz24 black-color mb15 fwb">Booking Details</h1>
    <div class="row tourextradetailsrow">
      <div class="col-sm-8">
        <div class="clearfix tourextradetailsleftcol">
		<form action="<?php echo site_url(); ?>holiday/tour_passenger_details" id="formid">
          <div class="extraaddtour">
            <h3 class="black-color fwb fz18">Tours Extras</h3>
  <?php

              if (!empty($holiday_extra)) {
                    foreach ($holiday_extra as $holiday_extras) {
                     
                      ?>

            <div href="#none" class="extraaddtourbox">
              <div class="row">
                <div class="col-sm-4">
                  <img src="<?php echo site_url(); ?>admin/assets/img/extratour/thumbs/<?php echo $holiday_extras->holextra_image ?>" alt="slide1.jpg">
                </div>
                <div class="col-sm-5">
                  <p><?php echo $holiday_extras->holextra_name ?></p>
               
                  <span class="fz18 sub-color mt15 block">
				  <?php  set_Currency ($this->dsa_setting->dsaset_currency_symbol,$holiday_extras->holextra_price); ?>
				 </span>
                </div>
                <div class="col-sm-3">
                  <label for="">Yes, Add it </label>
                 <input type="checkbox" class="tot_amount" name="extra[]" price="<?php current_Currency_total($holiday_extras->holextra_price) ?> " value="<?php echo $holiday_extras->holextra_id ?>">
                </div>
              </div>
            </div>


        <?php     
                  }
          }  else {

                 echo " No Data Available" ;
            }
        ?>     


          </div>
          
          <div class="clearfix tac mt30">
		  
		  
                    
          
                
                <?php echo validation_errors(); ?>
                <input type="hidden" name="tour_ID" value="<?php echo $this->input->get("tour_ID"); ?>">
			        	<input type="hidden" name="pickup_location" value="<?php echo $this->input->get("pickup_location"); ?>">
                <input type="hidden" name="start_date" value="<?php echo $this->input->get("start_date"); ?>">
                <input type="hidden" name="tour_ID" value="<?php echo $this->input->get("tour_ID"); ?>">
                <input type="hidden" name="adult_no" value="<?php echo $this->input->get("adult_no"); ?>">
                <input type="hidden" name="adult_totol_price" value="<?php echo $this->input->get("adult_totol_price"); ?>">
                <input type="hidden" name="child_no" value="<?php echo $this->input->get("child_no"); ?>">
                <input type="hidden" name="child_totol_price" value="<?php echo $this->input->get("child_totol_price"); ?>">
                <input type="hidden" name="infant_no" value="<?php echo $this->input->get("infant_no"); ?>">
                <input type="hidden" name="infant_totol_price" value="<?php echo $this->input->get("infant_totol_price"); ?>">
                <input type="hidden" name="hotel_name" value="<?php echo $this->input->get("hotel_name"); ?>">
                <input type="hidden" name="extra_total" id="total1">


              <button type="submit" class="btn btn-primary">Next</button>
       
          </div>
		    </form>
        </div>
      </div>


        <div class="col-sm-4">

<?php
// PrintArray($bookingdetail);
// die;
?>
<div class="tourextradetailsrightcol">
<img src="<?php echo site_url(); ?>admin/assets/img/holiday/main/<?php echo $bookingdetail->holiday_feature_image; ?>" alt="<?php echo $bookingdetail->holiday_feature_image; ?>">
<div class="p15">
<h1 class="block fz18 black-color mt0 mb15 fwb"><?php echo $bookingdetail->holiday_name; ?> 
<span class="block fz14 mt15">
<i class="fa fa-map-marker"></i> Location(s)<span class="block mt10 fz12">

<?php
if ($bookingdetail->holiday_location != NULL) {
$loc = explode(",", $bookingdetail->holiday_location);
$locfinal = "";
foreach ($loc as $locsss) {
$locfinal .= $locsss . ' | ';
}
print_r($locfinal);
?>


<?php } ?>

</span>
</span>
<span class="block mt10">
<span class="stars">
<?php for ($i = 1; $i <= $bookingdetail->holiday_rating; $i++) { ?>
    <i class="fa fa-star active"></i>
<?php } ?>

<?php for ($i = 1; $i <= 5 - $bookingdetail->holiday_rating; $i++) { ?>
    <i class="fa fa-star"></i>
<?php } ?>
</span>
</span>
</h1>
</div>
<div class="clearfix p15">
<ul class="pack-ul-details clearfix">
<li class="clearfix">
<span class="left"><?php if($bookingdetail->holiday_night+1>1){ echo "Days";} else {echo "Day";} ?>: <?php echo $bookingdetail->holiday_night + 1; ?> </span>
<strong class="right"><?php if($bookingdetail->holiday_night>1){ echo "Nights";} else {echo "Night";} ?> : <?php echo $bookingdetail->holiday_night; ?></strong>
</li>
<li class="clearfix">
<span class="left">Date :</span>
<strong class="right"><?php echo $this->input->get("start_date"); ?></strong>
</li>
<!--              <li class="clearfix">
        <span class="left">Hotel:</span>
        <strong class="right">Sde Dov Airport Tel Aviv</strong>
      </li>-->
<li class="clearfix">
<span class="left"><?php if($this->input->get("adult_no")>1){ echo "Adults";} else {echo "Adult";} ?> :   <?php echo $paxnoadult = $this->input->get("adult_no"); ?></span>
<strong class="right"><?php current_Currency_icon($this->dsa_setting->dsaset_currency_symbol) ?> <?php echo $adulttotal = current_Currency_total_exp($bookingdetail->holiday_start_price) * $paxnoadult; ?></strong>
</li>
<?php
$childtotal = 0;
if ($this->input->get("child_no") != NULL) {
?>
<li class="clearfix">
<span class="left"><?php if($this->input->get("child_no")>1){ echo "Children";} else {echo "Child";} ?>:  <?php echo $paxnochild = $this->input->get("child_no"); ?></span>
<strong class="right"><?php current_Currency_icon($this->dsa_setting->dsaset_currency_symbol) ?> <?php echo $childtotal = current_Currency_total_exp($bookingdetail->holiday_start_price) * $paxnochild; ?></strong>
</li>
<?php } ?>
<?php
$infanttotal = 0;
if ($this->input->get("infant_no") != NULL) {
?>

<li class="clearfix">
<span class="left"><?php if($this->input->get("infant_no")>1){ echo "Infants";} else {echo "Infant";} ?>:   <?php echo $paxnoinfant = $this->input->get("infant_no"); ?></span>
<strong class="right"><?php current_Currency_icon($this->dsa_setting->dsaset_currency_symbol) ?> <?php echo $infanttotal = current_Currency_total_exp($bookingdetail->holiday_start_price) * $paxnoinfant; ?></strong>
</li>

<?php } ?>

<li class="clearfix">
<span class="left">Extra Tour Total</span> 
<strong class="right"><?php current_Currency_icon($this->dsa_setting->dsaset_currency_symbol) ?>   <span id="totalext">0</span></strong>
</li>

<li class="clearfix">
<span class="left">Subtotal</span>
<strong class="right" id="sub_amount"  price="<?php echo $finalsubtotal = $adulttotal + $childtotal + $infanttotal; ?>"><?php current_Currency_icon($this->dsa_setting->dsaset_currency_symbol) ?> <?php echo $finalsubtotal = $adulttotal + $childtotal + $infanttotal; ?></strong>
</li>
<li class="clearfix">
<span class="left">Tax & VAT</span>
<strong class="right"><?php current_Currency_icon($this->dsa_setting->dsaset_currency_symbol) ?> <?php
$taxandVat = 0;
echo $taxandVatfinal = $taxandVat;
?></strong>
</li>
<li class="clearfix totalpriceofpack">
<span class="left">Total</span>
<strong class="right"  ><?php current_Currency_icon($this->dsa_setting->dsaset_currency_symbol) ?> <span id="all_tot"> <?php echo $finalsubtotal + $taxandVatfinal; ?></span></strong>
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
 <?php $this->load->view("footer"); ?>

 <?php
		if(isset($_COOKIE["selected_currency"])) {
            $data_set=explode(",",$_COOKIE["selected_currency"]);
			
				 $ratio =(float)$data_set[9] ;	
            
        }

        else{
           $ratio=1 ; 
        }
 
 
 ?>

 

 <script>
$(function() {

function getTotal(isInit) {

  var total = 0;
  var selector = isInit ? ".tot_amount" : ".tot_amount:checked";
  $(selector).each(function() {
      total += parseFloat($(this).attr("price"));
  });
  //$("#tot_amount").val(sum.toFixed(3));

  if (total == 0) {
    $("#totalext").text("0");
    all_total =parseFloat( $('#sub_amount').attr("price"));
    $('#all_tot').text(all_total+total);

  } else {
    $("#totalext").text(total);
    $('#total1').val(total/<?php echo $ratio  ?>);
     
    all_total =parseFloat( $('#sub_amount').attr("price"));
    $('#all_tot').text(all_total+total);

    
  }

}

 $(".tot_amount").click(function(event) {
   getTotal();

  



});

  
});

</script>