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
              <h3>Hotel Bookings</h3>
            </div><!-- Title end Here  -->
            <div class="profiletablegrabber mb0">
              <div class="table-rsponsive">
			  

		  
     <table class="table table-striped custab table-bordered mt20 table-font-14">
 <thead>
     <tr>
         <th>#</th>
         <th>Detail</th>
         <th>amount</th>
         <th>status</th>
         <th>Date</th>
         <th>Action</th>
     </tr>
 </thead>
 </div>
<?php 
if(is_array($result)){
$i=1;
foreach ($result as $results) { ?>
     <tr>
         <td><?php echo $i;?></td>
         <td>
         <?php 

         ?> 

         <strong> Ref ID: </strong>  <?php echo $results->reculst_id ; ?> <br /> 
         <strong> Number : </strong> <?php echo $results->reculst_mobile_account_number ; ?> <br />
         <strong> Type : </strong>  <?php echo $results->reculst_mobile_account_type ; ?><br />
         <strong> Operator : </strong>  <?php echo $results->reculst_operator_name; ?> <br />
            <?php  if(isset( $results->reculst_transaction_id)){ ?>
                <strong> Operator ID : </strong>  <?php echo $results->reculst_transaction_id ; ?> <br />                       
            <?php } ?>

      
         </td>
          <td>
          <strong> Recharge: </strong><i class="fa fa-inr"></i> <?php echo $results->reculst_customer_fare; ?><br/>
          

           </td>
          
            <td> 
            <?php if( $results->reculst_status =="Pending" ){ ?>   
                <span class="label label-warning"> <?php echo $results->reculst_status; ?> </span>
            <?php } ?>
            <?php if( $results->reculst_status =="Success" ){ ?>   
                <span class="label label-success"> <?php echo $results->reculst_status; ?> </span>
            <?php } ?>

            <?php if( $results->reculst_status =="Fail" ){ ?>   
                <span class="label label-danger"> <?php echo $results->reculst_status; ?> </span>
            <?php } ?>
            
            </td>

         <td>  <?php echo date_format(date_create($results->reculst_entry_date),"h:i A , d M Y") ?> </td>
         <td>
          <a href="<?php echo site_url();?>recharge/recharge_status/?ref_id=<?php echo $results->reculst_recharge_id; ?>" class="label label-warning">Check Status</a> 
         </td>


        
     </tr>
<?php $i++; } } else{ ?>

<tr>
<td colspan="8">No records Found.</td>   
<?php } ?>
</table>
 <div style="text-align: right;"><?php echo $this->pagination->create_links();?></div>
              </div>
            </div>


          </div>
          <!-- dashboard inner End from here -->
        </div>
      </div>
    </div>






<?php $this->load->view("footer"); ?>


<script type="text/javascript">
    $(".statement_type").change(function () {
        if ($(this).val() == "custom") {
            $(".custom_filter").show();
            $(".yearly_filter").hide();
        }else if($(this).val() == "year"){

            $(".yearly_filter").show();
            $(".custom_filter").hide();
        }else if($(this).val() == "min"){
           $(".yearly_filter").hide();
            $(".custom_filter").hide(); 
        }
    });

    $(function () {
        $("#st_fromdate").datepicker({
            dateFormat: 'dd-mm-yy',
            "minDate": new Date(2017, 1 - 1, 1),
            beforeShow: function () {

                $('#ui-datepicker-div').addClass("codatebirth");
            },
            onClose: function (selectedDate) {
                $("#st_todate").datepicker("option", "minDate", selectedDate);
            }
        });
        $("#st_todate").datepicker({
            dateFormat: 'dd-mm-yy',
            "maxDate": 0,
            beforeShow: function () {

                $('#ui-datepicker-div').addClass("codatebirth");
            }

        });
    })
</script>