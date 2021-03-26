<?php $this->load->view("holidaylayout/header"); ?>
<div class="container-fluid tourpassengerdetailsfluid pt50 pb50 light-bg">
    <div class="container tourpassengerdetailscontainer">
        <h1 class="block fz24 black-color mb15 fwb">Traveller Details</h1>
        <div class="row tourpassengerdetailsrow">
            <div class="col-sm-8">
                <form action="<?php echo site_url(); ?>holiday/add_to_cart" method="post" id="travellerdetails">
                    <input type="hidden" name="adult_no" value="<?php
                    if ($this->input->get("child_no") != NULL) {
                        echo $this->input->get("adult_no");
                    } else {
                        echo "0";
                    }
                    ?>">
                    <input type="hidden" name="child_no" value="<?php
                    if ($this->input->get("child_no") != NULL) {
                        echo $this->input->get("child_no");
                    } else {
                        echo "0";
                    }
                    ?>">
                    <input type="hidden" name="infant_no" value="<?php
                    if ($this->input->get("infant_no") != NULL) {
                        echo $this->input->get("infant_no");
                    } else {
                        echo "0";
                    }
                    ?>">
					 
		    <input type="hidden" name="extra" value="<?php if($this->input->get('extra')) {echo implode(",",$this->input->get('extra'));} else{ echo NULL;} ?>">
            <input type="hidden" name="BookingID" value="<?php echo $bookingdetail->holiday_id; ?>">
		    <input type="hidden" name="pickup_location" value="<?php echo $this->input->get("pickup_location"); ?>">
            <input type="hidden" name="start_date" value="<?php echo $this->input->get("start_date"); ?>">
		    <input type="hidden" name="hotel_name" value="<?php echo $this->input->get("hotel_name"); ?>">
                    <div class="clearfix tourpassengerdetailsleftcol">
                        <div class="tourpassengerdetailsbox">
<?php
if ($this->input->get("adult_no") != NULL) {
    for ($i = 1; $i <= $this->input->get("adult_no"); $i++) {
        ?>
                                    <div class="clearfix">
                                        <h3>Traveller <?php echo $i; ?> Details <span class="badge sub-bg fz12">Adult</span></h3>

                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="clearfix mt15">
                                                    <label for="">Title</label>
                                                    <select class="select block width-100 border title_auto_fill" name="adult[<?php echo $i; ?>][title_adult]" required="" key_unique="adult_<?php echo $i; ?>">
                                                        <option value="">Select Title--</option>
                                                        <option value="Mr">Mr</option>
                                                      <!--  <option value="Mrs">Mrs</option>
                                                        <option value="Miss">Miss</option> -->
                                                        <option value="Ms">Ms</option>
                                                    </select>
                                                </div>
                                            </div>  
                                            <div class="col-sm-4">
                                                <div class="clearfix mt15">
                                                    <label for="">First Name</label>
                                                    <input type="text" name="adult[<?php echo $i; ?>][first_name_adult]" class="input block width-100 border" placeholder="Enter your name" required="">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="clearfix mt15">
                                                    <label for="">Last Name</label>
                                                    <input type="text" name="adult[<?php echo $i; ?>][last_name_adult]" class="input block width-100 border" placeholder="Enter your name" required="">
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="clearfix mt15">
                                                    <label for="">Date of birth</label>
                                                    <input type="text" name="adult[<?php echo $i; ?>][date_of_birth_adult]" class="input block width-100 border datepicker" placeholder="Date of birth" readonly required="">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="clearfix mt15">
                                                    <label for="">Gender</label>
                                                    <input class="input block width-100 border gender_auto_fill" name="adult[<?php echo $i; ?>][gender_adult]" required="" readonly="" key_unique="adult_<?php echo $i; ?>">

                                                </div>
                                            </div>  
                                            <div class="col-sm-4">
                                                <div class="clearfix mt15">
                                                    <label for="">Passport expiry date</label>
                                                    <input type="text" name="adult[<?php echo $i; ?>][pass_expire_adult]" class="input block width-100 border datepicker" placeholder="Passport expiry date" readonly required="" >
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="clearfix mt15">
                                                    <label for="">Passport number</label>
                                                    <input type="text" name="adult[<?php echo $i; ?>][passport_no_adult]" class="input block width-100 border" placeholder="Passport number" required="">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="clearfix mt15">
                                                    <label for="">Passport nationality</label>
                                                    <select class="select block width-100 border" name="adult[<?php echo $i; ?>][pass_issue_country_adult]" required="">
                                                        <option value="">Select</option>
        <?php foreach ($allcountry as $allcountries) { ?>
                                                            <option value="<?php echo $allcountries->country_code . '_' . $allcountries->country_name; ?>"><?php echo $allcountries->country_name; ?></option>
                                    <?php } ?>
                                                    </select>
                                                </div>
                                            </div>  
                                        </div>

                                    </div>
    <?php }
}
?>
<?php
if ($this->input->get("child_no") != NULL && $this->input->get("child_no") > 0) {
    for ($i = 1; $i <= $this->input->get("child_no"); $i++) {
        ?>
                                    <div class="clearfix">
                                        <h3>Traveller <?php echo $i; ?> Details <span class="badge sub-bg fz12">Child</span></h3>

                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="clearfix mt15">
                                                    <label for="">Title</label>
                                                    <select class="select block width-100 border title_auto_fill" name="child[<?php echo $i; ?>][title_child]" required="" key_unique="adult_<?php echo $i; ?>">
                                                        <option value="">Select Title--</option>
                                                        <option value="Mstr">Mstr</option>
                                                        <option value="Miss">Miss</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="clearfix mt15">
                                                    <label for="">First Name</label>
                                                    <input type="text" name="child[<?php echo $i; ?>][first_name_child]" class="input block width-100 border" placeholder="Enter your name" required="">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="clearfix mt15">
                                                    <label for="">Last Name</label>
                                                    <input type="text" name="child[<?php echo $i; ?>][last_name_child]" class="input block width-100 border" placeholder="Enter your name" required="">
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="clearfix mt15">
                                                    <label for="">Date of birth</label>
                                                    <input type="text" name="child[<?php echo $i; ?>][date_of_birth_child]" class="input block width-100 border datepicker" placeholder="Date of birth" readonly required="">
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="clearfix mt15">
                                                    <label for="">Gender</label>
                                                    <input class="input block width-100 border gender_auto_fill" name="child[<?php echo $i; ?>][gender_child]" required="" readonly="" key_unique="adult_<?php echo $i; ?>">

                                                </div>
                                            </div> 
                                            <div class="col-sm-4">
                                                <div class="clearfix mt15">
                                                    <label for="">Passport number</label>
                                                    <input type="text" name="child[<?php echo $i; ?>][passport_no_child]" class="input block width-100 border" placeholder="Passport number" required="">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="clearfix mt15">
                                                    <label for="">Passport expiry date</label>
                                                    <input type="text" name="child[<?php echo $i; ?>][pass_expire_child]" class="input block width-100 border datepicker" placeholder="Passport expiry date" readonly required="">
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="clearfix mt15">
                                                    <label for="">Passport nationality</label>
                                                    <select class="select block width-100 border" name="child[<?php echo $i; ?>][pass_issue_country_child]">
                                                        <option value="">Select</option>
                                                       <?php foreach ($allcountry as $allcountries) { ?>
                                                            <option value="<?php echo $allcountries->country_code . '_' . $allcountries->country_name; ?>"><?php echo $allcountries->country_name; ?></option>
                                    <?php } ?>
                                                    </select>
                                                </div>
                                            </div>  

                                        </div>

                                    </div>
    <?php }
}
?>

<?php
if ($this->input->get("infant_no") != NULL && $this->input->get("infant_no") > 0) {
    for ($i = 1; $i <= $this->input->get("infant_no"); $i++) {
        ?>
                                    <div class="clearfix">
                                        <h3>Traveller <?php echo $i; ?> Details <span class="badge sub-bg fz12">Infant</span></h3>

                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="clearfix mt15">
                                                    <label for="">First Name</label>
                                                    <input type="text" name="infant[<?php echo $i; ?>][first_name_infant]" class="input block width-100 border" placeholder="Enter your name" required="">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="clearfix mt15">
                                                    <label for="">Last Name</label>
                                                    <input type="text" name="infant[<?php echo $i; ?>][last_name_infant]" class="input block width-100 border" placeholder="Enter your name" required="">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="clearfix mt15">
                                                    <label for="">Passport number</label>
                                                    <input type="text" name="infant[<?php echo $i; ?>][passport_no_infant]" class="input block width-100 border" placeholder="Passport number" required="">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="clearfix mt15">
                                                    <label for="">Date of birth</label>
                                                    <input type="text" name="infant[<?php echo $i; ?>][date_of_birth_infant]" class="input block width-100 border datepicker" placeholder="Date of birth" readonly required="">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="clearfix mt15">
                                                    <label for="">Passport expiry date</label>
                                                    <input type="text" name="infant[<?php echo $i; ?>][pass_expire_date_infant]" class="input block width-100 border datepicker" placeholder="Passport expiry date" readonly required="">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="clearfix mt15">
                                                    <label for="">Passport issue date</label>
                                                    <input type="text" name="infant[<?php echo $i; ?>][pass_issue_date_infant]" class="input block width-100 border datepicker" placeholder="Passport issue date" readonly required="">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="clearfix mt15">
                                                    <label for="">Passport nationality</label>
                                                    <select class="select block width-100 border" name="infant[<?php echo $i; ?>][pass_issue_country_infant]" required="">
                                                        <option value="">Select</option>
                                                      <?php foreach ($allcountry as $allcountries) { ?>
                                                            <option value="<?php echo $allcountries->country_code . '_' . $allcountries->country_name; ?>"><?php echo $allcountries->country_name; ?></option>
                                    <?php } ?>
                                                    </select>
                                                </div>
                                            </div>  


                                        </div>

                                    </div>
    <?php }
}
?>
                            <div class="clearfix">
                                <h3><b>Contact Details</b></h3>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="clearfix mt15">
                                            <label for="">Email ID.</label>
                                            <input type="email" name="contact_email" class="input block width-100 border" placeholder="Email ID" required="">
                                        </div>
                                    </div>  
                                    <div class="col-sm-6">
                                        <div class="clearfix mt15">
                                            <label for="">Mobile Number</label>
                                            <input type="number" name="contact_mobile" class="input block width-100 border" placeholder="Mobile number"  required="">
                                        </div>
                                    </div>
                                </div></div>
                            <div class="clearfix mb15 agreetotheterms">
                                <input type="checkbox" name="" id="agreetotheterms_pax" required=""> <label for="agreetotheterms_pax" class="inline-block pointer fz12 black-color vat">By proceeding, you agree with our <a href="https://www.easymyworld.com/online/Privacy-Policy">Terms of Service</a> &amp; <a href="https://www.easymyworld.com/online/Terms-Conditions">Privacy Policy</a></label>
                            </div>
                        </div>
                        <div class="clearfix tac mb30">
                            <a href="<?php echo site_url() ?>holiday/holidaydetail/<?php echo $bookingdetail->holiday_slug; ?>" class="btn btn-danger">Go Back</a>
                            <button type="submit" class="btn btn-primary" >Add to Cart</button>
                        </div>
                    </div>
                </form>
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
                                    <span class="left"><?php if($this->input->get("child_no")>1){ echo "Children";} else {echo "Child";} ?> :   <?php echo $paxnochild = $this->input->get("child_no"); ?></span>
                                    <strong class="right"><?php current_Currency_icon($this->dsa_setting->dsaset_currency_symbol) ?> <?php echo $childtotal = current_Currency_total_exp($bookingdetail->holiday_start_price) * $paxnochild; ?></strong>
                                </li>
			<?php } ?>
					<?php
							$infanttotal = 0;
							if ($this->input->get("infant_no") != NULL) {
					?>
                                <li class="clearfix">
                                    <span class="left"><?php if($this->input->get("infant_no")>1){ echo "Infants";} else {echo "Infant";} ?> :   <?php echo $paxnoinfant = $this->input->get("infant_no"); ?></span>
                                    <strong class="right"><?php current_Currency_icon($this->dsa_setting->dsaset_currency_symbol) ?> <?php echo $infanttotal = current_Currency_total_exp($bookingdetail->holiday_start_price) * $paxnoinfant; ?></strong>
                                </li>
			<?php } ?>


 <li class="clearfix">
                                <span class="left">Extra Tour Total</span>
								<strong class="right"><?php current_Currency_icon($this->dsa_setting->dsaset_currency_symbol) ?> <?php  if($this->input->get("extra_total")){ echo current_Currency_total_exp($this->input->get("extra_total")); } else{ echo "0"; } ?> </strong>
                            </li>

                            <li class="clearfix">
                                <span class="left">Subtotal</span>
                                <strong class="right"><?php current_Currency_icon($this->dsa_setting->dsaset_currency_symbol) ?> <?php echo $finalsubtotal = $adulttotal + $childtotal + $infanttotal + current_Currency_total_exp($this->input->get("extra_total")); ?></strong>
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
                                <strong class="right"><?php current_Currency_icon($this->dsa_setting->dsaset_currency_symbol) ?> <?php echo $finalsubtotal + $taxandVatfinal; ?></strong>
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


    <script type="text/javascript">
        //Title And Gender Connection(Gender autofill).......................................
        $(function () {
            $(".title_auto_fill").change(function () {
                // alert();
                
                var title_value = $(this).val();
                var name = $(this).attr("key_unique");
                $(".gender_auto_fill").each(function () {
                    if ($(this).attr("key_unique") == name)
                    {
                        if (title_value != "")
                        {
                            if (title_value == "Mr" || title_value == "Mstr")
                            {
                                $(this).val("Male");
                            } else
                            {
                                $(this).val("Female");
                            }
                        } else
                        {
                            $(this).val("");
                        }
                    }
                });

            });
        });
        //----------------------------------------------------------------------------------

        //logi detail section 
   $('.datepicker').datepicker({
    startYear: '-70y'
});

    </script>
