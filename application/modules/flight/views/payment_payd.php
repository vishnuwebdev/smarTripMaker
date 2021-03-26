<?php $this->load->view('include/head');
$this->load->view('include/header'); ?>
    <?php
        // Date in the past
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Cache-Control: no-cache");
        header("Pragma: no-cache");
        @extract($SearchData);
    ?>
    <script src="<?php echo site_url() ?>assets/js/jquery.js"></script>
    <script src="<?php echo site_url() ?>assets/js/bootstrap.min.js"></script>
    <section id="content" class="gray-area" style="padding-top:0;">
        <div class="container">
            <div class="row" >
                <div class="modal-dialog flights-search-popup" role="document">
                    <div class="modal-content">
                        <div class="modal-header text-center">
                            <h4 class="modal-title" id="myModalLabel">Redirecting To Payment Gateway</h4>
                        </div>
                        <div class="modal-body text-center"> 
                            <img class="loader-img" src="<?php echo site_url(); ?>admin/assets/img/logos/<?php echo $this->dsa_data->dsa_logo ?>" style="max-width: 50%;">
                            <h3>Please Wait</h3>
                            <span class="block midfz">Don't Close or Refresh Window </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>    
    <?php 
        $merchant_data='';
        $working_key= $ccavenueConfig->working_key;//Shared by CCAVENUES
        $access_code= $ccavenueConfig->access_code;//Shared by CCAVENUES
        foreach ($gateway_data as $key => $value){
            $merchant_data.=$key.'='.urlencode($value).'&';
        }
        $encrypted_data=cc_encrypt($merchant_data,$working_key); // Method for encrypting the data.
    ?>
        <form method="post" id="payment_form" name="redirect" action="<?php echo $ccavenueConfig->status == 1 ? $ccavenueConfig->live_url : $ccavenueConfig->demo_url?>"> 
            <?php
                echo "<input type=hidden name=encRequest value=$encrypted_data>";
                echo "<input type=hidden name=access_code value=$access_code>";
            ?>
        </form>
        <script>
            function formAutoSubmit () {
                var payform = document.getElementById("payment_form");
                payform.submit();
            }
            window.onload = formAutoSubmit;
        </script>
    <?php $this->load->view("include/footer");?>