<?php $this->load->view("holidaylayout/header"); ?>
<div class="container-fluid dashboardfluid">
  <div class="container dashboardcontainer">
    <h1 class="fz24 black-color mb30 mt0">Hi! Manmeet Kumar, Welcome to Holiday Travels</h1>
    <div class="row userdashboardrow" role="tabpanel">
      <div class="col-sm-3">
        <div class="clearfix dashboardleftcol">
          <ul class="nav nav-tabs dashboardtabs" role="tablist">
            <li role="presentation" class="active">
              <a href="#myprofile" aria-controls="myprofile" role="tab" data-toggle="tab">
                <i class="fa fa-user"></i>
                <span>Profile</span>
              </a>
            </li>
            <li role="presentation">
              <a href="#mybookings" aria-controls="mybookings" role="tab" data-toggle="tab">
                <i class="fa fa-suitcase"></i>
                <span>My Bookings</span>
              </a>
            </li>
            <li role="presentation">
              <a href="#mywishlists" aria-controls="mywishlists" role="tab" data-toggle="tab">
                <i class="fa fa-heart"></i>
                <span>My wishlist</span>
              </a>
            </li>
            <li role="presentation">
              <a href="#mynotifications" aria-controls="mynotifications" role="tab" data-toggle="tab">
                <i class="fa fa-bell"> <sup>7</sup></i>
                <span>Notifications</span>
              </a>
            </li>
            <li role="presentation">
              <a href="#profilesettings" aria-controls="profilesettings" role="tab" data-toggle="tab">
                <i class="fa fa-cog"></i>
                <span>Settings</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-sm-9">
        <div class="clearfix dashboardrightcol">
          <div class="tab-content dashboardtabcontent">
            <div role="tabpanel" class="tab-pane active" id="myprofile">
              <div class="myprofilebox">
                <div class="row">
                  <div class="col-sm-3">
                    <img src="<?php echo site_url(); ?>assets/holiday/images/propic.jpg" alt="" class="myprofileimg">
                    <h3 class="tac fz18 black-color">Manmeet Kumar</h3>
                  </div>
                  <div class="col-sm-9 border-left">
                    <div class="clearfix pl15">
                      <h3 class="fz18 black-color clearfix">Profile Details <a href="#none" class="right">Edit Profile</a></h3>
                      <div class="profiletablegrabber mb0">
                          <table class="table table-hover table-bordered mb0">
                            <tbody>
                              <tr>
                                <td class="firsttd"><b>Full Name</b></td>
                                <td><b>Manmeet Kumar</b></td>
                              </tr>
                              <tr>
                                <td class="firsttd"><b>First Name</b></td>
                                <td><b>Manmeet</b></td>
                              </tr>
                              <tr>
                                <td class="firsttd"><b>Last Name</b></td>
                                <td><b>Kumar</b></td>
                              </tr>
                              <tr>
                                <td class="firsttd"><b>Phone Number</b></td>         
                                <td><b>+91 9650817277</b></td>
                              </tr>
                              <tr>
                                <td class="firsttd"><b>Email ID</b></td>
                                <td><b>busymanmeet@gmail.com</b></td>
                              </tr>
                              <tr>
                                <td class="firsttd"><b>Country</b></td>         
                                <td><b>India</b></td>
                              </tr>
                              <tr>
                                <td class="firsttd"><b>State</b></td>         
                                <td><b>Uttar Pradesh</b></td>
                              </tr>
                              <tr>
                                <td class="firsttd"><b>City</b></td>         
                                <td><b>Unnao</b></td>
                              </tr>
                              <tr>
                                <td class="firsttd"><b>Address</b></td>         
                                <td><b>Unnao Uttar Pradesh</b></td>
                              </tr>
                              <tr>
                                <td class="firsttd"><b>Zipcode</b></td>         
                                <td><b>241504</b></td>
                              </tr>
                            </tbody>
                          </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="editmyprofilebox">
                <div class="row">
                  <div class="col-sm-12">
                    <hr>
                    <img src="<?php echo site_url(); ?>assets/holiday/images/propic.jpg" alt="..." width="100" height="100" class="circle border">
                    <input type="file" name="" id="" class="block mt15">
                    <hr>
                  </div>
                  <div class="col-sm-4">
                    <div class="clearfix mt15">
                      <input type="text" class="input block width-100 border" placeholder="Enter your first name">
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="clearfix mt15">
                      <input type="text" class="input block width-100 border" placeholder="Enter your last name">
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="clearfix mt15">
                      <input type="text" class="input block width-100 border" placeholder="Enter your phone number">
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="clearfix mt15">
                      <input type="text" class="input block width-100 border" placeholder="Enter your email id">
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="clearfix mt15">
                      <input type="text" class="input block width-100 border" placeholder="Enter your country name">
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="clearfix mt15">
                      <input type="text" class="input block width-100 border" placeholder="Enter your state name">
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="clearfix mt15">
                      <input type="text" class="input block width-100 border" placeholder="Enter your city name">
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="clearfix mt15">
                      <input type="text" class="input block width-100 border" placeholder="Enter your address">
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="clearfix mt15">
                      <input type="text" class="input block width-100 border" placeholder="Enter your zipcode">
                    </div>
                  </div>
                  <div class="col-sm-4 col-sm-offset-4">
                    <div class="clearfix mt15">
                      <a href="#none" class="btn btn-primary block">Update my profile</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="mybookings">
              <div class="bookingtypeandstatus clearfix">
                <h3 class="pull-left fz18 black-color mt0">All Your bookings are here!</h3>
                <ul class="list-inline pull-right">
                  <li>Booking Status : </li>
                  <li><span class="label success-bg fz14 fwn">Confirmed</span></li>
                  <li><span class="label danger-bg fz14 fwn">Cancelled</span></li>
                  <li><span class="label warning-bg fz14 fwn">Pending</span></li>
                </ul>
              </div>
              <div class="clearfix mt15">
                <ul class="mybookingtype clearfix">
                  <li class="">
                    <input type="radio" name="tripTypeOption" value="">
                    <span>Flight Bookings</span>
                  </li>
                  <li class="">
                    <input type="radio" name="tripTypeOption" value="">
                    <span>Hotel Bookings</span>
                  </li>                 
                  <li class="active">
                    <input type="radio" name="tripTypeOption" value="" checked>
                    <span>Holiday Bookings</span>
                  </li>
                </ul>
              </div>
              <div class="clearfix tripsbooked">
                <div class="table-responsive">
                  <table class="table table-bordered tripsbookedtable mt20">
                    <thead>
                      <tr>
                        <th>J. Date</th>
                        <th>Itinerary Description</th>
                        <th>Payment Status</th>
                        <th>Ticket Status</th>
                        <th>Booking Details</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>
                          <span class="t-date">
                            <span class="t-month">Dec</span>
                            <span class="t-digit">25</span>
                            <span class="t-year">2017</span>
                          </span>
                        </td>
                        <td>
                          <h3 class="fz14 black-color mt0 mb0">
                            London Tour Package <small class="block fz12 mt5">3 Days 2 Nights</small>
                          </h3>
                        </td>
                        <td><span class="label success-bg fz14 fwn">Confirmed</span></td>
                        <td><span class="label success-bg fz14 fwn">Confirmed</span></td>
                        <td>
                          <span>
                            <span class="block fz12">Booking ID : 1505515</span>
                            <span class="block fz12 mt5">Booked on : 25-12-2017</span>
                          </span>
                        </td>
                        <td>
                          <a href="#none">View Details</a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="mywishlists">
              <div class="tourlistbox border">
                <div class="row">
                  <div class="col-sm-4">
                    <img src="<?php echo site_url(); ?>assets/holiday/images/dom1.jpg" alt="img" class="tourthumb">
                  </div>
                  <div class="col-sm-6">
                    <div class="clearfix pt15 pb15">
                      <h3 class="tourlistheading">Amazing France Tour <small class="block mt5">11 nov 2015 - 22 now 2015</small></h3>
                      <p class="para">Voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores...</p>
                      <div class="whatincludes">
                        <i class="fa fa-plane"></i> +
                        <i class="fa fa-bus"></i>
                        Air + Bus
                        <span class="packdur">Duration / 11 Days</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-2">
                    <div class="clearfix pt15 pb15">
                      <span class="stars">
                        <i class="fa fa-star active"></i>
                        <i class="fa fa-star active"></i>
                        <i class="fa fa-star active"></i>
                        <i class="fa fa-star active"></i>
                        <i class="fa fa-star"></i>
                      </span>
                      <span class="block fz12">270 Reviews</span>
                      <h3 class="sub-color fz18"><i class="fa fa-inr"></i> 23004 <small class="block mt5">Per person</small></h3>
                      <a href="tour-details.php" class="button sub-bg white-color hover-main-bg hover-white-color radius">Select</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="mynotifications">
              <div class="alert alert-success">
                <strong>Success!</strong> Indicates a successful or positive action.
              </div>

              <div class="alert alert-info">
                <strong>Info!</strong> Indicates a neutral informative change or action.
              </div>

              <div class="alert alert-warning">
                <strong>Warning!</strong> Indicates a warning that might need attention.
              </div>

              <div class="alert alert-danger">
                <strong>Danger!</strong> Indicates a dangerous or potentially negative action.
              </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="profilesettings">
              <div class="accountsettingbox">
                <h3 class="fz18 black-color mb0">Account Settings (Change Your Password)</h3>
                <form action="">
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="clearfix mt15">
                        <input type="password" class="input block width-100 border" placeholder="New password">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="clearfix mt15">
                        <input type="password" class="input block width-100 border" placeholder="Retype password">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="clearfix mt15">
                        <a href="#none" class="btn btn-primary block">Update password</a>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $this->load->view("holidaylayout/footer"); ?>