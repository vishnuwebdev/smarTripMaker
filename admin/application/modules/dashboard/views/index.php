<?php $this->view('simple_layout/header'); ?>
<style>
    .p-28{
        padding: 28px;
    }
    .card-container .card .back > .row > div {
    height: 100%;
    padding: 0px 15px;
}
.card-container .card .back > .row {
    height: 100%;
    margin: 0px -15px;
}
.bg-blue{
    background-color: #555555 !important;
}
</style>
<?php $this->view('simple_layout/leftSidebar'); ?>

            <!-- ====================================================
            ================= CONTENT ===============================
            ===================================================== -->
            <section id="content">

                <div class="page page-dashboard">

                    <div class="pageheader">

                        <h2>Dashboard</h2>

                        <div class="page-bar">

                            <ul class="page-breadcrumb">
                                <li>
                                    <a href="<?php echo site_url(); ?>"><i class="fa fa-home"></i> Dashboard</a>
                                </li>
                               
                            </ul>

                            <div class="page-toolbar">
                                
                            </div>

                        </div>

                    </div>

                    <!-- cards row -->
                    <div class="row">
                        <div class="card-container col-lg-3 col-sm-6 col-sm-12">
                            <div class="card">
                                <div class="front bg-blue">

                                    <!-- row -->
                                    <div class="row">
                                        <!-- col -->
                                       <div class="col-xs-4">
                                            <i class="fa fa-plane fa-3x"></i>
                                        </div>
                                        <!-- /col -->
                                        <!-- col -->
                                        <div class="col-xs-8">
                                            <p class="text-elg text-strong mb-0"><?php echo $b2c_day_total_flight_booking; ?> </p>
                                            <span>Flight Booking</span>
                                        </div>
                                        <!-- /col -->
                                    </div>
                                    <!-- /row -->

                                </div>
                                <a href="<?php echo site_url(); ?>b2c_flight/booking_list" class="back bg-blue p-28">

                                    <!-- row -->
                                    <div class="row">
                                        <!-- col -->
                                       <div class="col-xs-4">
                                            <i class="fa fa-plane fa-3x"></i>
                                        </div>
                                        <!-- /col -->
                                        <!-- col -->
                                        <div class="col-xs-8">
                                            <p class="text-elg text-strong mb-0"><?php echo $b2c_day_total_flight_booking; ?> </p>
                                            <span> Flight Booking</span>
                                        </div>
                                        <!-- /col -->
                                    </div>
                                    <!-- /row -->

                                </a>
                            </div>
                        </div>

                        <!-- col -->
                        <div class="card-container col-lg-3 col-sm-6 col-sm-12">
                            <div class="card">
                                <div class="front bg-slategray">

                                    <!-- row -->
                                    <div class="row">
                                        <!-- col -->
                                       <div class="col-xs-4">
                                            <i class="fa fa-bed fa-3x"></i>
                                        </div>
                                        <!-- /col -->
                                        <!-- col -->
                                        <div class="col-xs-8">
                                            <p class="text-elg text-strong mb-0"><?php echo $b2c_day_total_month_hotel; ?> </p>
                                            <span>Hotel Booking</span>
                                        </div>
                                        <!-- /col -->
                                    </div>
                                    <!-- /row -->

                                </div>
                                <a href="<?php echo site_url(); ?>b2c_hotel/booking_list" class="back bg-blue p-28">

                                    <!-- row -->
                                    <div class="row">
                                        <!-- col -->
                                       <div class="col-xs-4">
                                            <i class="fa fa-bed fa-3x"></i>
                                        </div>
                                        <!-- /col -->
                                        <!-- col -->
                                        <div class="col-xs-8">
                                            <p class="text-elg text-strong mb-0"><?php echo $b2c_day_total_month_hotel; ?> </p>
                                            <span>Hotel Booking</span>
                                        </div>
                                        <!-- /col -->
                                    </div>
                                    <!-- /row -->

                                </a>
                            </div>
                        </div>
                        <!-- col -->
                        <div class="card-container col-lg-3 col-sm-6 col-sm-12">
                            <div class="card">
                                <div class="front bg-blue">

                                    <!-- row -->
                                    <div class="row">
                                        <!-- col -->
                                       <div class="col-xs-4">
                                            <i class="fa fa-question-circle fa-3x"></i>
                                        </div>
                                        <!-- /col -->
                                        <!-- col -->
                                        <div class="col-xs-8">
                                            <p class="text-elg text-strong mb-0"><?php echo $totalQueries; ?> </p>
                                            <span>Total Queries</span>
                                        </div>
                                        <!-- /col -->
                                    </div>
                                    <!-- /row -->

                                </div>
                                <a href="<?php echo site_url(); ?>query" class="back bg-blue p-28">

                                    <!-- row -->
                                    <div class="row">
                                        <!-- col -->
                                       <div class="col-xs-4">
                                            <i class="fa fa-question-circle fa-3x"></i>
                                        </div>
                                        <!-- /col -->
                                        <!-- col -->
                                        <div class="col-xs-8">
                                            <p class="text-elg text-strong mb-0"><?php echo $totalQueries; ?> </p>
                                            <span>Total Queries</span>
                                        </div>
                                        <!-- /col -->
                                    </div>
                                    <!-- /row -->

                                </a>
                            </div>
                        </div>
                        <!-- col -->
                        <div class="card-container col-lg-3 col-sm-6 col-sm-12">
                            <div class="card">
                                <div class="front bg-slategray">

                                    <!-- row -->
                                    <div class="row">
                                        <!-- col -->
                                        <div class="col-xs-4">
                                            <i class="fa fa-clock-o fa-3x"></i>
                                        </div>
                                        <!-- /col -->
                                        <!-- col -->
                                        <div class="col-xs-8">
                                            <p class="text-elg text-strong mb-0"><?php
                                            $d=strtotime($this->dsa_data->dsa_last_login);

                                            
                                            echo date("H:i", $d); ?> </p>
                                            <span><?php echo date("d M", $d); ?></span>
                                        </div>
                                        <!-- /col -->
                                    </div>
                                    <!-- /row -->

                                </div>
                                <div class="back bg-slategray p-28">

                                    <!-- row -->
                                    <div class="row">
                                        <!-- col -->
                                        <div class="col-xs-4">
                                            <i class="fa fa-clock-o fa-3x"></i>
                                        </div>
                                        <!-- /col -->
                                        <!-- col -->
                                        <div class="col-xs-8">
                                            <p class="text-elg text-strong mb-0"><?php
                                            $d=strtotime($this->dsa_data->dsa_last_login);

                                            
                                            echo date("H:i", $d); ?> </p>
                                            <span><?php echo date("d M", $d); ?></span>
                                        </div>
                                        <!-- /col -->
                                    </div>
                                    <!-- /row -->

                                </div>
                            </div>
                        </div>
                      
                    </div>
                    <!-- /row -->


                    <div class="row">

                   <div class="col-md-4">

                           


                            <!-- tile -->
                            <section class="tile bg-slategray widget-calendar">

                                <!-- tile header -->
                                <div class="tile-header dvd dvd-btm">
                                    <h1 class="custom-font"><strong>Today </strong>Calendar</h1>
                                    <ul class="controls">
                                        <li class="dropdown">

                                            <a role="button" tabindex="0" class="dropdown-toggle settings" data-toggle="dropdown">
                                                <i class="fa fa-cog"></i>
                                                <i class="fa fa-spinner fa-spin"></i>
                                            </a>

                                            <ul class="dropdown-menu pull-right with-arrow animated littleFadeInUp">
                                                <li>
                                                    <a role="button" tabindex="0" class="tile-toggle">
                                                        <span class="minimize"><i class="fa fa-angle-down"></i>&nbsp;&nbsp;&nbsp;Minimize</span>
                                                        <span class="expand"><i class="fa fa-angle-up"></i>&nbsp;&nbsp;&nbsp;Expand</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a role="button" tabindex="0" class="tile-refresh">
                                                        <i class="fa fa-refresh"></i> Refresh
                                                    </a>
                                                </li>
                                                <li>
                                                    <a role="button" tabindex="0" class="tile-fullscreen">
                                                        <i class="fa fa-expand"></i> Fullscreen
                                                    </a>
                                                </li>
                                            </ul>

                                        </li>
                                        <li class="remove"><a role="button" tabindex="0" class="tile-close"><i class="fa fa-times"></i></a></li>
                                    </ul>
                                </div>
                                <!-- /tile header -->

                                <!-- tile body -->
                                <div class="tile-body p-0">
                                    <div id="mini-calendar"></div>
                                </div>
                                <!-- /tile body -->

                            </section>
                            <!-- /tile -->



                        </div>
                        <div class="col-md-8">
                        <?php $bp_dsa_permission=explode(",",$this->dsa_data->dsa_admin_permission); 
                            
                            if(in_array("b2c_flight", $bp_dsa_permission) || in_array("b2b_flight", $bp_dsa_permission)  ){
                                 if($this->session->userdata("DsaStafflogin") == NULL)
                                 {
                            ?>
                            <div class="tile-header tile dvd dvd-btm p-10" style="font-size: 12px;">

                        
                                    
                            <h4 class="custom-font"><strong>Today </strong>Bookings</h4>
                            <table class="table table-bordered bp_table">
                            <thead>
                                <tr>
                                    <th><?php echo $this->lang->line ( "status" );?></th>
                                    <th><?php echo $this->lang->line ( "segment" );?></th>
                                    <!--<th><?php echo $this->lang->line ( "passenger" );?></th>-->
                                    <th><?php echo $this->lang->line ( "fare" );?></th>
                                    <th><?php echo $this->lang->line ( "other" );?></th>
                                   <!-- <th><?php echo $this->lang->line ( "agent" );?> <?php echo $this->lang->line ( "id" );?></th> -->
                                </tr>
                            </thead>
                            <tbody>
                                                           
                                     <?php
                                     if($result != "0"){
                                     if(isset($result)){
                                if(is_array($result)){
                                    $i=1;
                                    foreach($result as $bp)
                                    {
                                ?>
                                        <tr>
                                            <td>
                                                <strong><?php echo $this->lang->line ( "id" );?></strong> - <?php echo $bp->fbook_id; ?><br>
                                                <strong><?php echo $this->lang->line ( "booking_status" );?></strong> - <?php echo $bp->fbook_ob_booking_status; ?><br>
                                                <?php if($bp->fbook_booking_type=="Return"){?>
                                                <strong><?php echo $this->lang->line ( "return_booking_status" );?></strong> - <?php echo $bp->fbook_ib_booking_status; ?><br>
                                                <?php }?>
                                                <strong><?php echo $this->lang->line ( "payment_status" );?></strong> - <?php echo $bp->fbook_payment_status; ?><br>
                                                <!-- <a href="<?php echo site_url().$this->uri->segment ( "1" );?>/booking_detail/?ref_id=<?php echo url_encode($bp->fbook_id); ?>" class="btn btn-warning btn-rounded btn-xs "><span><?php echo $this->lang->line ( "booking_detail" );?></span></a> -->
                                            </td>
                                           <td>
                                                <strong><?php echo $this->lang->line ( "from" );?></strong> - <?php echo $bp->fbook_depart_city; ?><br>
                                                <strong><?php echo $this->lang->line ( "to" );?></strong> - <?php echo $bp->fbook_arrive_city; ?><br>
                                                
                                           </td>
<!--                                           <td>
                                             <?php
                                             $booking_id=$bp->fbook_id;
                                             if(is_array($pax[$booking_id])){
                                                $i=1;
                                             foreach($pax[$booking_id] as $paxs){
                                                echo "<strong>".$i.".</strong>  ".$paxs->fpax_title." ".$paxs->fpax_first_name." ".$paxs->fpax_last_name."<br>";
                                                $i++;} }?>
                                           </td>-->
                                           <td>
                                                <strong><?php echo $this->lang->line ( "total_fare" );?></strong> - <?php echo $bp->fbook_total_fare; ?><br>
                                                 <?php if($bp->fbook_payment_status=="B2B"){?>
                                                  <strong><?php echo $this->lang->line ( "paid_by_agent" );?></strong> - <?php echo $bp->fbook_agent_fare; ?><br>
                                                 <?php }?>
                                                <strong><?php echo $this->lang->line ( "paid_by_customer" );?></strong> - <?php echo $bp->fbook_customer_fare; ?><br>
                                                 <!-- <a href="<?php echo site_url().$this->uri->segment ( "1" );?>/booking_detail/?ref_id=<?php echo url_encode($bp->fbook_id); ?>" class="btn btn-primary btn-rounded btn-xs"><span><?php echo $this->lang->line ( "ticket" );?></span></a>
                                                 <a href="<?php echo site_url().$this->uri->segment ( "1" );?>/booking_detail/?ref_id=<?php echo url_encode($bp->fbook_id); ?>" class="btn btn-info btn-rounded btn-xs"><span><?php echo $this->lang->line ( "invoice" );?></span></a> -->
                                           </td>
                                           <td>
                                                
                                                  <strong><?php echo $this->lang->line ( "depart_date" );?></strong> - <?php echo date_format(date_create($bp->fbook_depart_date),"h:i A , d M Y");?><br>
                                                 <strong><?php echo $this->lang->line ( "depart_pnr" );?></strong> - <?php echo $bp->fbook_ob_pnr; ?><br>
                                                 <?php if($bp->fbook_booking_type=="Return"){?>
                                                  <strong><?php echo $this->lang->line ( "return_date" );?></strong> - <?php echo date_format(date_create($bp->fbook_return_date),"h:i A , d M Y");?><br>
                                                  <strong><?php echo $this->lang->line ( "return_pnr" );?></strong> - <?php echo $bp->fbook_ib_pnr; ?><br>
                                                 <?php }?>
            
                                           </td>
                                           <!-- <td> <strong>AG-<?php echo $bp->fbook_agent_id;?></td> -->
                                        </tr>
                                       <?php 
                                    $i++;
                                }
                                }else{
                                                                    
                                                                }
                                     }} else {?>
                                        <tr> 
                                            <td colspan="5"> 
                                      
                                         <strong>Result Not Found. </td>
                                        </tr>
                                     <?php } ?>
                            </tbody>
                        </table>
                                    
                                </div>
                                <?php } } ?>
                        </div>
                    </div>
                   
                </div>

                
            </section>
            <!--/ CONTENT -->
            <input type="date" class="datepicker" >


<?php $this->view('simple_layout/footer'); ?>
             <script src="<?php echo site_url();?>assets/js/vendor/daterangepicker/moment.min.js"></script>
             <script src="<?php echo site_url();?>assets/js/vendor/daterangepicker/daterangepicker.js"></script>
                 <script src="<?php echo site_url();?>assets/js/vendor/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
            <script>
                 //Initialize mini calendar datepicker
                $('#mini-calendar').datetimepicker({
                    inline: true
                });
                
                function show_balance(){
  
      $.post( "<?php echo site_url(); ?>/dashboard/show_balance_ajax", { name: "John",'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>' })
  .done(function( data ) {
      $(".showSMSBalance").html(data);
    // alert( "Data Loaded: " + data );
  });
                }
                </script>