<?php 
    $this->load->view("include/head"); 
    $this->load->view("include/header"); 
?>
    <div class="page-title-container">
        <div class="container">
            <div class="page-title pull-left">
                <h2 class="entry-title">Payment</h2>
            </div>
        </div>
    </div>
    <section id="content" class="gray-area" style="padding-top:0;">
        <div class="container">
            <div class="row" >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h4 class="modal-title" id="myModalLabel">Loading Payment Gateway</h4>
                    </div>
                    <div class="modal-body text-center">
                    <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
                <!-- <img src="<?php echo base_url();?>assets/images/loader1.gif">--> <br/>
                    <b>Please Wait</b></br>
                        Don't Close or Refresh Window </div>
                    </div>
                </div>
            </div>
        </div>
    </section>		
    
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        var options = {
            "key": "<?= RAZOR_API_KEY ?>", 
            "amount": "<?= $gatewayData['amount'] ?>", 
            "currency": "<?= $gatewayData['currency'] ?>",
            "name": "SmartTripMaker",
            "description": "Visa transaction request payment",
            // "image": "https://example.com/your_logo",
            "order_id": "<?= $gatewayData['id'] ?>",
            "handler": function (response){
                handleResponse("success",response);
            },
            "prefill": {
                "name": "<?= $paymentData['delivery_name'] ?>",
                "email": "<?= $email ?>",
                "contact": "+91<?= $phone ?>"
            },
            "notes": {
                "order_id": "<?= $paymentData['order_id']?>"
            },
            "theme": {
                "color": "#3399cc"
            }
        };
        var rzp1 = new Razorpay(options);
        rzp1.on('payment.failed', function (response){
            handleResponse("failed",response);
        });
        setTimeout(function(){ rzp1.open(); }, 3000);
        
        function handleResponse(status,response){
            var requestData = { status : status,response : response};
            $.ajax({
                type: "POST",
                url: "<?= site_url() ?>visa/handleResponse",
                data: requestData,
                success: function(result){
                    result = JSON.parse(result);
                    window.location.href = "<?= site_url() ?>"+result.route;
                }
            });
        }
    </script>
<?php $this->load->view("include/footer");?>