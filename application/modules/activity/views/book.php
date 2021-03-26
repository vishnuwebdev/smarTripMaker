<?php $this->load->view("commenLayout/head"); ?>


<body>

    <?php $this->load->view("commenLayout/header"); ?>

 
<style>
   .airlinename.read-color {
   
    margin-bottom: 4px;
    font-size: 16px;
} 
</style>

<div class="container-fluid tourextradetailsfluid pt50 pb50 light-bg">
   
	<div class="container tourextradetailscontainer thumbnail">
             <div class="alert alert-success">
                 
                     <h3><strong>Success!</strong> Booking successfully Done.</h3>
                 <h4>Thank you for booking Your Order Confirmed</h4>
                 <h4>A confirmation email has been send your provided email</h4>
                     
                 </div>
                
                 

    <h1 class="block fz24 black-color mb15 fwb">Booking Details </h1>
    <div class="row tourextradetailsrow">
   
        
      <div class="col-sm-8">
          
          <?php
          $idet = 1;
          foreach ($result as $resultsss){ ?>
          <div class="panel panel-default">
              <div class="panel-heading"><b>Tour Detail <?php  echo $idet; ?></b></div>
            <div class="panel-body">
                <div class="col-sm-4">
                   <div class="grabber clearfix">
                       
                       <img src="<?php echo site_url(); ?>admin/assets/img/holiday/thumbs/<?php echo $resultsss["tourdetail"]->holiday_feature_image; ?>" alt="<?php echo $resultsss["tourdetail"]->holiday_feature_image; ?>" class="airline-img" style="max-height: 50px;">
                          
                        </div>
                </div>
                <div class="col-md-4">
                    <span class="airlinename read-color block"><b><?php echo $resultsss["tourdetail"]->holiday_name; ?></b></span>
                </div>
                <div class="col-sm-4">
                    <div class="col-xs-12 col-sm-12">
            <div class="grabber clearfix relative">
             
             
              <span class="inline-block pull-right text-left">
                <span class="bigfz block black-color text-uppercase fwb"><b><?php echo $resultsss["bookingdetail"]->holbook_pickup_point; ?></b></span>
                <span class="norfz block read-color"><b><?php echo $resultsss["bookingdetail"]->holbook_tour_start_date ?></b></span>
              </span>
            </div>
          </div>
                    
                </div>
                
            </div>
        </div>
           <div class="panel panel-default">
             <div class="panel-heading"><b>Passenger Details Tour <?php echo $idet; ?></b></div>
            <?php
            $paxno = 1;
            foreach ($resultsss["bookingPax"] as $paxdeta){ ?>
            <div class="panel-body"><?php echo $paxno.'. '; ?><?php echo $paxdeta->holpax_type; ?> - <?php echo $paxdeta->holpax_title; ?> <?php echo $paxdeta->holpax_first_name; ?> <?php echo $paxdeta->holpax_last_name; ?> <span class="pull-right"><?php echo date("d-m-Y", strtotime($paxdeta->holpax_dob)); ?></span></div>
           </div>
          <?php $paxno++; } ?>
           <div class="panel panel-default">
            <div class="panel-heading">Contact Details Tour <?php echo $idet; ?></div>
            <div class="panel-body">
                <div class="clearfix p15">
            <ul class="pack-ul-details clearfix">
              
              <li class="clearfix" style="border-top:none">
                <span class="left">Mobile</span>
                <strong class="right"><?php echo $resultsss["bookingdetail"]->holbook_contact_phone; ?></strong>
              </li>
              <br>
              <li class="clearfix ">
                <span class="left">Email</span>
                <strong class="right"><?php echo $resultsss["bookingdetail"]->holbook_contact_email; ?></strong>
              </li>
            </ul>
          </div>
                
            </div>
        </div>
 
          <?php $idet++; } ?>
      
           
        </div>
        
   
      
      <div class="col-sm-4">
          <?php
          $idet = 1;
          foreach ($result as $resultsss ){ ?>
            <div class="panel panel-default">
    <div class="panel-heading">Fare Detail Tour <?php echo $idet; ?></div>
    <div class="panel-body">
          
                  <div class="clearfix p15">
            
              
             
                  <div class="col-md-6">
                <span class="left">Base fare</span>
                </div>
                  <div class="col-md-6">
                <strong class="right"><?php echo $this->dsa_data->dsa_currency.' '.$resultsss["bookingdetail"]->holbook_amount; ?></strong>
                  </div>
             
             
            
                <div class="col-md-6">
                <span class="left">Tax & VAT</span>
                </div>
                   <div class="col-md-6">
                <strong class="right"><?php echo $this->dsa_data->dsa_currency ?> 0</strong>
                </div>
              
           
                <div class="col-md-6">
                <span class="left">Total</span>
                </div>
                   <div class="col-md-6">
                <strong class="right"><?php echo $this->dsa_data->dsa_currency; ?> <?php echo $resultsss["bookingdetail"]->holbook_amount; ?></strong>
                  
         
          </div>
        
        
    </div>
  </div>
          <?php $idet++; } ?>

 
          <div class="col-sm-6">
        

 
        <!--    <a href="<?php echo site_url(); ?>holiday/print_ticket" class="btn btn-success">Print Voucher</a>   
    
      </div> 
  
<!--        <div class="col-sm-6">
        
   <a href="#" class="btn btn-success">Print invoice</a>  
    
          </div>  -->

     
      </div>
    </div>
	</div>
</div>








<?php $this->load->view("commenLayout/footer"); ?>


<?php $this->load->view("js"); ?>

