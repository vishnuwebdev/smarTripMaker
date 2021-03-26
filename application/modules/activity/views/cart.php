<?php
$this->load->view("holidaylayout/header");

// PrintArray($result);
//  die;
$resultsss = 40
?>
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
   <script>
        paypal.Button.render({

            env: 'sandbox', // sandbox | production

            // PayPal Client IDs - replace with your own
            // Create a PayPal app: https://developer.paypal.com/developer/applications/create
            client: {
                sandbox:    'AZDxjDScFpQtjWTOUtWKbyN_bDt4OgqaF4eYXlewfBP4-8aqX3PiV8e1GWU6liB2CUXlkA59kJXE7M6R',
                production: '<insert production client id>'
            },

            // Show the buyer a 'Pay Now' button in the checkout flow
            commit: true,

            // payment() is called when the button is clicked
            payment: function(data, actions) {

                // Make a call to the REST api to create the payment
                return actions.payment.create({
                    payment: {
                        transactions: [
                            {
                              
                                amount: { total: '<?php echo $carttotalPrice  ?>', currency: '<?php echo $this->dsa_data->dsa_currency ?>' }
                            }
                        ]
                    }
                });
            },

            // onAuthorize() is called when the buyer approves the payment
            onAuthorize: function(data, actions) {

                // Make a call to the REST api to execute the payment
                return actions.payment.execute().then(function() {
                    window.alert('Payment Complete!');
                });
            }

        }, '#paypal-button-container');

    </script>
<style>
    .tour-title{
        background: #a2a2a2;
        color: #fff;
        padding: 7px;
        margin-bottom: 2px;
        margin-left: -10px;
    }
</style>
<div class="container-fluid tourcartdetailsfluid pt50 pb50 light-bg">
    <div class="container tourcartdetailscontainer">
        <?php if (!empty($result)) { ?>
            <div class="clearfix tourcartdetailsbox">
                <div class="table-responsive">
                    <table class="table table-bordered tourcartitemtable">
                        <thead>
                            <tr>
                                <th>Tour Number</th>
                                <th>Tour Name</th>
                                <th>Traveller(s)</th>
                                <th>Tour Date</th>
                  <!--              <th>Tour Language</th>-->
                                <th>Remove</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($result)) {
                                foreach ($result as $cartdata) {
                                    ?>
                                    <tr>
                                        <td><span><?php echo $cartdata["tourdetail"]->holiday_id; ?></span></td>
                                        <td>
                                            <span class="block"><?php echo $cartdata["tourdetail"]->holiday_name; ?></span>
                                            <span class="block fwb black-color">Pickup Hotel:</span>
                                            <span class="block fwb black-color">Pickup Time:</span>
                                        </td>
                                        <td>
                                            <span class="block">Adults: <?php echo $cartdata["cart_detail"]["tour_adult_no"]; ?></span>
                                            <span class="block">Children: <?php echo $cartdata["cart_detail"]["tour_child_no"]; ?></span>
                                            <span class="block">Infant: <?php echo $cartdata["cart_detail"]["tour_infant_no"]; ?></span>
                                        </td>
                                        <td><span><?php echo $cartdata["cart_detail"]["tour_start_date"]; ?></span></td>
                          <!--              <td><span>English</span></td>-->
                                        <td>
                                            <a href="<?php echo site_url(); ?>/holiday/remove_from_cart?tour_id=<?php echo $cartdata["tourdetail"]->holiday_id; ?>" class="circle badge white-color sub-bg"><i class="fa fa-times"></i></a>
                                        </td>
                                        <td>
                                            <span><?php echo $this->dsa_data->dsa_currency; ?> <?php echo $cartdata["cart_detail"]["tour_total_price"]; ?></span>
                                        </td>
                                    </tr>
                                <?php }
                            }
                            ?>
                            <tr class="totaltr">
                                <td colspan="5" class="text-right"><strong>Total</strong></td>
                                <td><?php if (!empty($result)) {
                            echo $this->dsa_data->dsa_currency;
                                ?> <?php echo $carttotalPrice;
                            }
                            ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="addtourcoupon">
                    <form action="">
                        <div class="row">
                            <div class="col-sm-4 col-sm-offset-6">
                                <input type="text" class="input block width-100 border" placeholder="Enter Coupon code to get special discount">
                            </div>
                            <div class="col-sm-2">
                                <a href="#none" class="btn btn-primary block">Add coupon</a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row mt15">
                    <div class="col-sm-2">
                        <a href="<?php echo site_url(); ?>" class="btn btn-default block">Keep shopping</a>
                    </div>
                    <div class="col-sm-4 col-sm-offset-4">
                        <h2 class="fz24 black-color fwb">Your are paying <?php if (!empty($result)) {
                                echo $this->dsa_data->dsa_currency;
                                ?> <?php echo $carttotalPrice;
                            }
                            ?></h2>
                    </div>
                    <div class="col-sm-2">
   
                        <a href="#Modal_for_confirm" data-toggle="modal" class="btn btn-success block">Pay now</a>
                    </div>
                    
                    <div class="col-sm-2" style="padding: 10px ">
                      <center>     <div id="paypal-button-container"></div></center>    
                       
                    </div>
                </div>
            </div>
<?php } else { ?>

            <h2 class="text-center text-center thumbnail pt50 pb50"> Your Cart Is Empty. </h2> 
            <div class="row mt15">
                <div class="col-sm-2 pull-right">
                    <a href="<?php echo site_url(); ?>" class="btn btn-success block">Keep shopping</a>
                </div>
                <div class="col-sm-4 col-sm-offset-4">
                </div>

            </div>
<?php } ?>
    </div>
</div>

<div class="modal fade confirmpop " id="Modal_for_confirm" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4><span class="glyphicon glyphicon-lock"></span> Please Confrim your Tour Detail </h4>
            </div>
            <div class="modal-body" style="padding: 30px 34px 30px 20px;">
                <div class="row">
                    <div class="col-md-8">
<?php
$tour = 1;
if (!empty($result)) {
    foreach ($result as $cartdata) {
        ?>
                                <h3 class="tour-title">Tour Detail <?php echo $tour; ?> </h3>
                                <div class="list-group">
                                    <a href="#" class="list-group-item active">
                                        Traveller Detail-
                                    </a>
                                    <div class="pax_data_apend">

        <?php
        $paxno = 1;
        foreach ($cartdata["bookingPax"] as $paxdeta) {
            ?>
                                            <div class="panel-body"><?php echo $paxno . '. '; ?><?php echo $paxdeta->holpax_type; ?> - <?php echo $paxdeta->holpax_title; ?> <?php echo $paxdeta->holpax_first_name; ?> <?php echo $paxdeta->holpax_last_name; ?>
                                                <span class="pull-right"><?php echo date("d-m-Y", strtotime($paxdeta->holpax_dob)); ?></span>
                                            </div>

            <?php $paxno++;
        }
        ?>
                                    </div>
                                </div>
                                <div class="list-group">
                                    <a href="#" class="list-group-item active">
                                        Tour Details
                                    </a>
                                    <div class="">
                                        <div class="panel-body">
                                            <div class="col-sm-4">
                                                <div class="grabber clearfix">

                                                    <img src="<?php echo site_url(); ?>admin/assets/img/holiday/thumbs/<?php echo $cartdata["tourdetail"]->holiday_feature_image; ?>" alt="<?php echo $cartdata["tourdetail"]->holiday_feature_image; ?>" class="airline-img" style="max-height: 50px;">

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <span class="airlinename read-color block"><b><?php echo $cartdata["tourdetail"]->holiday_name; ?></b></span>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="col-xs-12 col-sm-12">
                                                    <div class="grabber clearfix relative">

                                                        <span class="inline-block pull-right text-left">
                                                            <span class="bigfz block black-color text-uppercase fwb"><b><?php echo $cartdata["bookingdetail"]->holbook_pickup_point; ?></b></span>
                                                            <span class="norfz block read-color"><b><?php echo GetdateDay($cartdata["bookingdetail"]->holbook_tour_start_date); ?></b></span>
                                                        </span>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>


                                <div class="list-group">
                                    <a href="#" class="list-group-item active">
                                        Contact Detail
                                    </a>
                                    <div class="">
                                        <div class="panel-body">
                                            <ul class="pack-ul-details clearfix">

                                                <li class="clearfix" style="border-top:none">
                                                    <span class="left">Mobile</span>
                                                    <strong class="right"><?php echo $cartdata["bookingdetail"]->holbook_contact_phone; ?></strong>
                                                </li>
                                                <li class="clearfix ">
                                                    <span class="left">Email</span>
                                                    <strong class="right"><?php echo $cartdata["bookingdetail"]->holbook_contact_email; ?></strong>
                                                </li>
                                            </ul>

                                        </div>
                                    </div>
                                </div> 
        <?php $tour++;
    }
} ?>
                    </div>

 <div class="col-md-4">
                       <?php
          $idet = 1;
		 // print_r($_SESSION["Tours_Cart"]);
          foreach ($result as $resultsss ){ 
		  
		 // print_r($resultsss);
		  
		  ?>
            <div class="panel panel-default">
    <div class="panel-heading">Fare Detail Tour <?php echo $idet; ?></div>
    <div class="panel-body">
          
                  <div class="clearfix p15">
            <ul class="pack-ul-details clearfix">
              
              <li class="clearfix" style="border-top:none">
                <span class="left">Base fare</span>
                <strong class="right"><?php echo $this->dsa_data->dsa_currency.' '.$resultsss["bookingdetail"]->holbook_amount; ?></strong>
              </li>
              
              <li class="clearfix">
                <span class="left">Tax & VAT</span>
                <strong class="right"><?php echo $this->dsa_data->dsa_currency ?> 0</strong>
              </li>
              <li class="clearfix totalpriceofpack">
                <span class="left">Total</span>
                <strong class="right"><?php echo $this->dsa_data->dsa_currency; ?> <?php echo $resultsss["bookingdetail"]->holbook_amount; ?></strong>
              </li>
            </ul>
          </div>
        
        
    </div>
  </div>
          <?php $idet++; } ?>
 </div></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <a href="<?php echo site_url(); ?>/holiday/payment_request/<?php echo $resultsss["bookingdetail"]->holbook_id; ?>" class="btn btn-success proceed_payment_data">Proceed Payment</a>
            </div>
        </div>

    </div>
</div> 
<?php $this->load->view("holidaylayout/footer"); ?>
