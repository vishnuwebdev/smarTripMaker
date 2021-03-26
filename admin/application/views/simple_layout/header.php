<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->



    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php echo $this->dsa_data->dsa_meta_title?></title>
        <link rel="icon" type="image/ico" href="<?php echo site_url();?>assets/img/fevicon/<?php echo $this->dsa_data->dsa_fab?>" />
        <meta name="description" content="<?php echo $this->dsa_data->dsa_meta_desc?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">




        <!-- ============================================
        ================= Stylesheets ===================
        ============================================= -->
        <!-- vendor css files -->
       
        <link rel="stylesheet" href="<?php echo site_url();?>assets/css/vendor/animate.css">
        <link rel="stylesheet" href="<?php echo site_url();?>assets/css/vendor/font-awesome.min.css">
         <link rel="stylesheet" href="<?php echo site_url();?>assets/css/vendor/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo site_url();?>assets/js/vendor/animsition/css/animsition.min.css">
        <link rel="stylesheet" href="<?php echo site_url();?>assets/js/vendor/daterangepicker/daterangepicker-bs3.css">
        <link rel="stylesheet" href="<?php echo site_url();?>assets/js/vendor/morris/morris.css">
        <link rel="stylesheet" href="<?php echo site_url();?>assets/js/vendor/datetimepicker/css/bootstrap-datetimepicker.min.css">
        <link rel="stylesheet" href="<?php echo site_url();?>assets/js/vendor/datatables/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="<?php echo site_url();?>assets/js/vendor/datatables/datatables.bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo site_url();?>assets/js/vendor/chosen/chosen.css">

        <!-- project main css files -->
        <link rel="stylesheet" href="<?php echo site_url();?>assets/css/main.css">
         <link rel="stylesheet" href="<?php echo site_url();?>assets/css/custom.css">
         <link rel="stylesheet" href="<?php echo site_url();?>assets/css/menu.css">
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
        <!--/ stylesheets -->



        <!-- ==========================================
        ================= Modernizr ===================
        =========================================== -->
        <script src="<?php echo site_url();?>assets/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
        <!--/ modernizr -->




    </head>




<!-- Add on mobile for side bar menu sidebar-xs -->
    <body id="minovate" class="appWrapper">






        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->












        <!-- ====================================================
        ================= Application Content ===================
        ===================================================== -->
        <div id="wrap" class="animsition">






            <!-- ===============================================
            ================= HEADER Content ===================
            ================================================ -->
            <section id="header">
                <header class="clearfix">

                    <!-- Branding -->
                    <div class="branding">
                        <a class="brand" href="<?php echo site_url();?>" style="padding-left: 0px;">
                            <span><strong><?php echo $this->dsa_data->dsa_company_name?></strong></span>
                        </a>
                        <a role="button" tabindex="0" class="offcanvas-toggle visible-xs-inline"><i class="fa fa-bars"></i></a>
                    </div>
                    <!-- Branding end -->
                        
                     <!-- <ul class="nav-left pull-left list-unstyled list-inline">
                        <li class="sidebar-collapse divided-right">
                            <a role="button" tabindex="0" class="collapse-sidebar">
                                <i class="fa fa-outdent"></i>
                            </a>
                        </li>
                    </ul>  -->  
                    
                    <!-- Right-side navigation -->
                    <ul class="nav-right pull-right list-inline">
                 
                        <?php if($this->session->userdata("DsaStafflogin") != NULL){ 
                            $staffdata = $this->session->userdata("DsaStafflogin");
                            ?>
                        <li class="dropdown nav-profile">
                            
                            <a href class="dropdown-toggle" data-toggle="dropdown">
                                <span><b>Staff :</b> <?php echo $staffdata->dsast_first_name." ".$staffdata->dsast_last_name; ?><i class="fa fa-angle-down"></i></span>
                            </a>     
                             
                              <ul class="dropdown-menu  dropdown-menu-left" role="menu">
                               
                                <li>
                                    <a role="button" tabindex="0" href="<?php echo site_url('/logout'); ?>">
                                        <i class="fa fa-sign-out"></i>Logout
                                    </a>
                                </li>

                            </ul>
   
                            
                        </li>
                        <li class="dropdown nav-profile">

                            <a href class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?php echo site_url();?>assets/img/fevicon/<?php echo $this->dsa_data->dsa_fab?>" alt="" class="img-circle size-30x30">
                                <span><?php echo $this->dsa_data->dsa_company_name?></span>
                            </a>
                        </li>
                      <?php   }else{ ?>
                        <li class="dropdown nav-profile">

                            <a href class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?php echo site_url();?>assets/img/fevicon/<?php echo $this->dsa_data->dsa_fab?>" alt="" class="img-circle size-30x30">
                                <span><?php echo $this->dsa_data->dsa_company_name?> <i class="fa fa-angle-down"></i></span>
                            </a>

                            <ul class="dropdown-menu  dropdown-menu-right" role="menu">
                                <li>
                                    <a role="button" tabindex="0" href="<?php echo site_url('dsa/changepassword'); ?>">
                                        <i class="fa fa-cog"></i>Change Password
                                    </a>
                                </li>
                                <li class="divider"></li>
                               
                                <li>
                                    <a role="button" tabindex="0" href="<?php echo site_url('/logout'); ?>">
                                        <i class="fa fa-sign-out"></i>Logout
                                    </a>
                                </li>

                            </ul>

                        </li>
                      <?php } ?>
               

                      
                    </ul>
                    <!-- Right-side navigation end -->



                </header>

            </section>
            <!--/ HEADER Content  -->