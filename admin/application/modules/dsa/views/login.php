<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->



    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php echo $this->dsa_data->dsa_meta_title ?></title>
        <link rel="icon" type="image/ico" href="<?php echo site_url(); ?>assets/img/fevicon/<?php echo $this->dsa_data->dsa_fab ?>" />
        <meta name="description" content="<?php echo $this->dsa_data->dsa_meta_desc ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">




        <!-- ============================================
        ================= Stylesheets ===================
        ============================================= -->
        <!-- vendor css files -->
        <link rel="stylesheet" href="<?php echo site_url(); ?>assets/css/vendor/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo site_url(); ?>assets/css/vendor/animate.css">
        <link rel="stylesheet" href="<?php echo site_url(); ?>assets/css/vendor/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo site_url(); ?>assets/js/vendor/animsition/css/animsition.min.css">

        <!-- project main css files -->
        <link rel="stylesheet" href="<?php echo site_url(); ?>assets/css/main.css">
        <!--/ stylesheets -->



        <!-- ==========================================
        ================= Modernizr ===================
        =========================================== -->
        <script src="<?php echo site_url(); ?>assets/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
        <!--/ modernizr -->




    </head>





    <body id="minovate" class="appWrapper">






        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->












        <!-- ====================================================
        ================= Application Content ===================
        ===================================================== -->
        <div id="wrap" class="">




            <div class="page page-core page-login">

                <div class="text-center"><h3 class="text-light text-white"><?php echo $this->dsa_data->dsa_company_name ?></h3></div>

                <div class="container w-420 p-15 bg-white mt-40 text-center">


                    <h2 class="text-light text-greensea">Log In</h2>
                    
                    <?php
                    if ($this->session->flashdata('alert') !== NULl) {
                        $bhanu_message = $this->session->flashdata('alert');
                        ?>

                        <div
                            class="alert alert-sm alert-border-left <?php echo $bhanu_message['class']; ?> light alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert"
                                    aria-hidden="true">×</button>
                            <i class="fa fa-info pr10"></i> <strong> <?php echo $bhanu_message['message']; ?></strong>
                        </div>

                    <?php } ?>
                    <form name="form" class="form-validation mt-20" novalidate="" action="<?php echo site_url("dsa/dsa_login"); ?>" method="post" id="add_new_dsa_agent">
                        
                         <div class="form-group">
                         <select name="user_type" class="form-control">
                             <option value="admin"> <?php echo $this->lang->line("admin"); ?> </option>
                              <option value="staff"><?php echo $this->lang->line("staff"); ?>  </option>
                         </select>
                        </div>
                        
                        <input type="hidden"
                               name="<?php echo $this->security->get_csrf_token_name(); ?>"
                               value="<?php echo $this->security->get_csrf_hash(); ?>" />
                        <div class="form-group">
                            <input type="text" class="form-control underline-input" placeholder="Email" name="username">
                        </div>

                        <div class="form-group">
                            <input type="password" placeholder="Password" class="form-control underline-input" name="password">
                        </div>

                        <div class="form-group text-center mt-20">
                            <button type="submit" class="btn btn-greensea b-0 br-2 mr-5">Login</button>

                        </div>

                    </form>

                    <hr class="b-3x">

                </div>

            </div>



        </div>
        <!--/ Application Content -->














        <!-- ============================================
        ============== Vendor JavaScripts ===============
        ============================================= -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="assets/js/vendor/jquery/jquery-1.11.2.min.js"><\/script>')</script>

        <script src="<?php echo site_url(); ?>assets/js/vendor/bootstrap/bootstrap.min.js"></script>

        <script src="<?php echo site_url(); ?>assets/js/vendor/jRespond/jRespond.min.js"></script>

        <script src="<?php echo site_url(); ?>assets/js/vendor/sparkline/jquery.sparkline.min.js"></script>

        <script src="<?php echo site_url(); ?>assets/js/vendor/slimscroll/jquery.slimscroll.min.js"></script>

        <script src="<?php echo site_url(); ?>assets/js/vendor/animsition/js/jquery.animsition.min.js"></script>

        <script src="<?php echo site_url(); ?>assets/js/vendor/screenfull/screenfull.min.js"></script>
        <!--/ vendor javascripts -->




        <!-- ============================================
        ============== Custom JavaScripts ===============
        ============================================= -->
        <script src="<?php echo site_url(); ?>assets/js/main.js"></script>
        <!--/ custom javascripts -->






        <!-- ===============================================
        ============== Page Specific Scripts ===============
        ================================================ -->
        <script>
            $(window).load(function () {


            });
        </script>
        <!--/ Page Specific Scripts -->





    </body>
</html>
