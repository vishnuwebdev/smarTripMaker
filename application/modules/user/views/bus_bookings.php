<?php $this->load->view("header"); ?>

    
    <div class="dashboardfluid-wrap main-field">
      <div class="container">
        <div class="dashboard-container">
          <!-- Profile Header -->
          <?php $this->load->view("customersidebar"); ?>
          <!-- Profile Header End -->

          <!-- dashboard inner start from here -->
          <div class="dashboard-inner">

            <!-- Title Here -->
            <div class="dash-title">
              <h3>Bus Bookings</h3>
            </div><!-- Title end Here  -->
            <div class="profiletablegrabber mb0">
              <div class="table-rsponsive">
              <table class="table table-striped custab table-bordered mt20 table-font-14">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Pax</th>
                                                <th>Amount</th>
                                                <th>Details</th>
                                                <th>Date</th>
                                                <th>Status </th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        
<?php 
if(count($bBookingList) > 0){
  $i=1;
foreach ($bBookingList as $Listing) { ?>
                                            <tr>
                                                <td><?php echo $Listing->busbook_id; ?></td>
                                                <td>
                                                        <b> <?php echo $Listing->busbook_comtact_title . '. ' . $Listing->busbook_contact_first_name . ' ' . $Listing->busbook_contact_last_name; ?><br> </b>


    </td>
                                                <td>Rs. <?php echo $Listing->busbook_customer_fare; ?></td>
                                                    <td>
                                                    <b>Traveler: </b><?php echo $Listing->busbook_travels  ?><br>
                                                    <b>Bus Type: </b><?php echo $Listing->busbook_bus_type  ?><br>
                                                    <b>Bus Id: </b><?php echo $Listing->busbook_bus_id  ?><br>
                                                    <b>Depart Date: </b> <?php echo $Listing->busbook_depart_date;   ?><br> 
                                                    <b>Arrive Date: </b><?php echo $Listing->busbook_arrive_date; ?> <br>
                                                </td>
                                                <td>
                                                    <b> B Date:</b> <?php echo date_format(date_create($Listing->busbook_entry_date),"h:i A , d M Y") ?>
                                                   

                                                   
                                                </td>

                                                <td> 
                                                     <b>Booking  Status: </b><?php echo $Listing->busbook_status; ?><br>
                                                     <b> PNR: </b><?php echo $Listing->busbook_pnr; ?><br>
                                                     <b> Ticket Number: </b><?php echo $Listing->busbook_ticket_number; ?><br>
                                                   
                                                    </td>



                                                <td class="text-center">
                                                
                                                       <a target="_blank" class="btn btn-info btn-Sd btn-xs" href="<?php echo site_url(); ?>bus/print_voucher?ref_id=<?php echo url_encode($Listing->busbook_id); ?>">Bus Voucher</a> <br>
              
                                                   
                                                </td>
                                            </tr>
 <?php $i++; } } else{ ?>
                          
                       <tr>
                           <td colspan="8">not found any record.</td>   
                  <?php } ?>
                                    </table>
              </div>
            </div>


          </div>
          <!-- dashboard inner End from here -->
        </div>
      </div>
    </div>






<?php $this->load->view("footer"); ?>


    <?php $this->load->view("js"); ?>


