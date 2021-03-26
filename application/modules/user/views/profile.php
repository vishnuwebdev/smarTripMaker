<?php $this->load->view("header"); ?>

 <style type="text/css">
        .wrapper {
        display: flex;
}

#sidebar {
        min-width: 250px;
        max-width: 250px;
        height: 100vh;
}
.tac {
    text-align: center;
}
.border-left {
    border-left: 1px solid #dddddd;
}
.table {
    width: 100%;
    max-width: 100%;
    margin-bottom: 20px;
}

.text_cap{
	text-transform: capitalize;
}

.fz18 {
    font-size: 18px;
}
.profiletablegrabber b {
    font-weight: normal;
}
    </style>
<body>

   
      
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
              <h3>Profile</h3>
            </div><!-- Title end Here  -->

            <div class="profile-top-bar mb-20">
              <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                  <div class="profile-img">
                    <?php if($result->cust_profile_pic !=""){?>
                         <img  class="myprofileimg"  src="<?php echo site_url();?>assets/profile_pic/<?php echo $result->cust_profile_pic; ?>" >
                    <?php }else{?>
                     
                            <img src="http://beta.booking-tours.com/assets/holiday/images/propic.jpg" alt="" class="myprofileimg">
                    <?php } ?>
                  </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                  <div class="pro-btn-right clearfix">
                    <a href="<?php echo site_url(); ?>user/editprofile" class="btn-org btn-flght pull-right"><i class="icofont-user-suited"></i>Edit Profile</a>
                  </div>
                </div>
                 
              </div>
            </div>

            <div class="profiletablegrabber mb0">
            <div class="row">
                                    <div class="col-sm-12">
                                     
                                            <h3 style="margin-top:15px" class="fz18 black-color clearfix">Profile Details <!-- <a href="http://beta.booking-tours.com/user/editprofile" class="right">Edit Profile</a> --> </h3>
                                            <div class="profiletablegrabber mb0">
                                                <div class="table-responsive">
                                                <table class="table table-hover table-bordered mb0">
                                                    <tbody>
                                                        <tr>
                                                            <td class="firsttd"><b>Full Name</b></td>
                                                            <td><b><?php echo $result->cust_first_name ." ".$result->cust_last_name  ?></b></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="firsttd"><b>First Name</b></td>
                                                            <td><b><?php echo $result->cust_first_name ?></b></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="firsttd"><b>Last Name</b></td>
                                                            <td><b><?php echo $result->cust_last_name; ?></b></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="firsttd"><b>Phone Number</b></td>         
                                                            <td><b><?php echo $result->cust_mobile; ?></b></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="firsttd"><b>Email ID</b></td>
                                                            <td><b><?php echo $result->cust_email; ?></b></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="firsttd"><b>Pancard Number</b></td>         
                                                            <td><b><?php echo $result->cust_pan_number; ?></b></td>
                                                        </tr>
                                                       <!--  <tr>
                                                            <td class="firsttd"><b>State</b></td>         
                                                            <td><b></b></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="firsttd"><b>City</b></td>         
                                                            <td><b></b></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="firsttd"><b>Address</b></td>         
                                                            <td><b></b></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="firsttd"><b>Zipcode</b></td>         
                                                            <td><b></b></td>
                                                        </tr> -->
                                                    </tbody>
                                                </table>
                                            </div>
                                            </div>
                                       
                                    </div>
                                </div>
            </div>


          </div>
          <!-- dashboard inner End from here -->
        </div>
      </div>
    </div>




<?php $this->load->view("footer"); ?>
<?php $this->load->view("js"); ?>

<script>
$('#upload_profile').click(function(){
	$('#update_data').submit();
})
</script>