<?php $this->view('simple_layout/header'); ?>
<?php $this->view('simple_layout/leftSidebar'); ?>
<section id="content">
    <div class="page page-forms-validate">
        <div class="pageheader">
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li><a href="<?php echo site_url(); ?>"><i class="fa fa-home"></i>
                            Dashboard</a></li>
                    <li><a href="<?php echo site_url($this->uri->segment("1")); ?>"> <?php echo $this->uri->segment("1"); ?></a></li>
                    <li><a>Booking Detail</a></li>
                </ul>
            </div>
        </div>
        <!-- row -->
        <div class="row">
            <!-- col -->
            <div class="col-md-12">
                <!-- tile -->
                <?php
					if ($this->session->flashdata ( 'alert' ) !== NULl) {
						$bhanu_message = $this->session->flashdata ( 'alert' );
						?>
																													<div
						class="alert alert-sm alert-border-left <?php echo $bhanu_message['class'];?> light alert-dismissable">
						<button type="button" class="close" data-dismiss="alert"
							aria-hidden="true">×</button>
						<i class="fa fa-info pr10"></i> <strong> <?php echo $bhanu_message['message'];?></strong>
					</div>
              
			<?php }?>
                <section class="tile bp_shadow">
                    <div class="tile-header dvd dvd-btm">
                        <h1 class="custom-font">
                            View <strong> Booking </strong> Detail
                        </h1>
                    </div>

                    <div class="panel panel-info">
                       
                        <div class="panel-heading">
                            <div class="panel-title hidden-xs">Contact Information</div>
                        </div>
                        <div class="panel-body pn">
                            <br>
                            <table class="table table-bordered bp_table_td">
                                <tbody>
                                    <tr>
                                        <td class="warning">Customer Name</td>
                                        <td><?php echo $bookingDetail->holbook_contact_person_name; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="warning">Mobile</td>
                                        <td><?php echo $bookingDetail->holbook_contact_phone; ?></td>
                                    </tr>
                                    <tr>
                                        
                                        <td class="warning">Email</td>
                                        <td><?php echo $bookingDetail->holbook_contact_email; ?></td>
                                    </tr>


                                </tbody>
                            </table>
                            <br>
                        </div>
                        <div class="panel-heading">
                            <div class="panel-title hidden-xs">Holiday Information</div>
                        </div>
                        <div class="panel-body pn">
                            <br>
                            <table class="table table-bordered bp_table_td">
                                <tbody>
                                     <tr>
                                        <td class="warning">Holiday Image</td>
                                        <td><img style="float:left" src="<?php echo site_url(); ?>assets/img/holiday/thumbs/<?php echo $tourDetail->holiday_feature_image ?>" 
                                                          class="img-thumbnail" alt="<?php echo $tourDetail->holiday_name ?>" width="75" height="75"><br></td>
                                        
                                    </tr>
                                    <tr>
                                        <td class="warning">Holiday Name</td>
                                        <td><?php echo $tourDetail->holiday_name; ?></td>
                                        
                                    </tr>
                                    <tr>
                                        <td class="warning">Location</td>
                                        <td><?php echo $tourDetail->holiday_location; ?></td>
                                        
                                    </tr>
                                    <tr>
                                        <td class="warning">Start Date</td>
                                        <td><?php echo $bookingDetail->holbook_tour_start_date; ?></td>
                                        
                                    </tr>
                                    <tr>
                                        <td class="warning">Pickup Point</td>
                                        <td><?php echo $bookingDetail->holbook_pickup_point; ?></td>
                                        
                                    </tr>
                                    <tr>
                                        <td class="warning">Total(Night)</td>
                                        <td><?php echo $tourDetail->holiday_night; ?></td>
                                        
                                    </tr>
                                   


                                </tbody>
                            </table>
                            <br>
                        </div>
                        <div class="panel-heading">
                            <div class="panel-title hidden-xs">Pax Information</div>
                        </div>
                        <div class="panel-body pn">
                            <br>
                            <table class="table table-bordered bp_table_text_center">
                                <thead>
                                                    <tr><td>Number</td>
                                                    <td>Full Name</td>
                                                    <td>Passport Number</td>
                                                    <td>Date of birth</td>
                                                    <td>Passport expiry date</td>
                                                   <td>Passport nationality</td>
                                                    
                                                </tr></thead>
                                <tbody>
                                
                                    <?php if(is_array($paxDetail))
                                                 { $i=1;
                                                     foreach($paxDetail as $paxs) {?>      
                                                       <tr>
                                                            <td><?php echo $i ?></td>
                                                            <td><?php echo $paxs->holpax_first_name." ".$paxs->holpax_last_name ?></td>
                                                            <td><?php echo $paxs->holpax_passport_number ?></td>
                                                            <td><?php echo $paxs->holpax_dob ?></td>
                                                            <td><?php echo $paxs->holpax_passport_expiry ?></td>
                                                            <td><?php echo $paxs->holpax_passport_issue_country ?></td>
                                                       
                        
                                                        </tr>
                                                         <?php $i++; } } else { ?>
    
                                            <tr><td colspan="6"> No Traveller Available</td></tr>
    
                                         <?php } ?>
                                </tbody>
                            </table>
                            <br>

                        </div>

                        
                        <div class="panel-heading">
                            <div class="panel-title hidden-xs">Fare Information</div>
                        </div>
                        <div class="panel-body pn">
                            <br>
                            <table class="table table-bordered bp_table_text_center">
                                  <tbody>

                                        <tr>
                                            <td>Description</td>   
                                            <td>Person</td>   
                                            <td>Price per person</td> 
                                            <td>Total</td> 
                                            <!--<td>Commission by %</td>--> 

                                        </tr>
                                        <tr>
                                            <td>Adults</td>
                                            <td class="font_cl">
                                                <b id="adultCount_159">
                                                   <?php echo $bookingDetail->holbook_adult ?>                                               </b>
                                               </td>
                                            <td class="font_cl">
                                                <b id="adultPrice_159">
                                             <?php echo $this->dsa_data->dsa_currency ?>    <?php echo $bookingDetail->holbook_adult_price ?> </b>
                                               
                                            </td>
                                            <td class="font_cl" align="right">
                                                <b id="adultFinalPrice_159">
                                                 <?php echo $this->dsa_data->dsa_currency; ?>    <?php echo $bookingDetail->holbook_adult * $bookingDetail->holbook_adult_price ?>                                              </b>
                                              </td>
                                            <!--<td class="font_cl" align="right">$0</td>-->  
                                        </tr>
                                        <tr>
                                            <td>Child</td>
                                            <td class="font_cl">
                                                <b id="childCount_159">
                                                  <?php echo $bookingDetail->holbook_child ?>                                        </b>
                                                </td>

                                            <td class="font_cl">
                                                <b id="childPrice_159">
                                              <?php echo $this->dsa_data->dsa_currency ?>       <?php echo $bookingDetail->holbook_child_price ?>                                                </b>
                                               </td>
                                            <td class="font_cl" align="right">
                                                <b id="childFinalPrice_159">
                                               <?php echo $this->dsa_data->dsa_currency ?>    <?php echo $bookingDetail->holbook_child * $bookingDetail->holbook_child_price ?>                                           </b>
                                                 </b>
                                            </td>
                                            <!--<td class="font_cl" align="right">$0</td>-->  
                                        </tr>
                                        <tr>
                                            <td>Infant </td>
                                            <td class="font_cl">
                                                <b id="infantCount_159">
                                                    <?php echo $bookingDetail->holbook_infant ?>                                      </b>
                                               </td>
                                            <td class="font_cl">
                                                <b id="infantPrice_159">
                                                <?php echo $this->dsa_data->dsa_currency; ?>    <?php echo $bookingDetail->holbook_infant_price ?>                                               </b>
                                               
                                            </td>
                                            <td class="font_cl" align="right">
                                                <b id="infantFinalPrice_159">
                                              <?php echo $this->dsa_data->dsa_currency; ?>    <?php echo $bookingDetail->holbook_infant * $bookingDetail->holbook_infant_price ?>                                          </b>
                                                                                </b>
                                            </td>
                                            <!--<td class="font_cl" align="right">$0</td>-->  
                                        </tr>

                                        <tr>
                                        <td colspan="3" align="right"><b>TOTAL</b></td> 

                                        <!-- nirali 23Dec -->
                                        <td class="font_cl" align="right">
                                            
                                            <b id="editTotal_159"><?php echo $this->dsa_data->dsa_currency; ?> <?php echo $bookingDetail->holbook_amount ?>    </b>
                                           

                                        </td>

                                        

                                        <!-- <td class="font_cl" align="right"><b>$0</b></td>-->

                                        </tr><tr> 
                                        </tr><tr>
                                                                                    </tr><tr>
                                            <td colspan="3" align="right">Tax &amp; VAT</td>
                                            <td class="font_cl" align="right" id="taxAndVat_159">
                                               <?php echo $this->dsa_data->dsa_currency; ?>0                                            </td>
                                            <!--<td class="font_cl" align="right">-</td>-->
                                        </tr>
                                          
                                        <tr>
                                                     
                                            <td colspan="3" align="right"><b>GRAND TOTAL</b></td>
                                            <td class="font_cl" align="right" id="grandTotal_159"><b class="gto"><?php echo $this->dsa_data->dsa_currency; ?> <?php echo $bookingDetail->holbook_amount ?></b></td>
                                           
                                        </tr>
                                                                            </tbody>
                            </table>
                            <br>

                        </div>
                    </div>

                </section>
                <!-- /tile -->
            </div>
            <!-- /col -->
        </div>
        <!-- /row -->
    </div>
</section>
  <div class="modal fade" id="delPollModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title custom-font">! Warning</h3>
                    </div>
                    <div class="modal-body">
                        Are you sure ! you want to delete this  ?
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-success btn-ef btn-ef-3 btn-ef-3c" id="deletePoll"><i class="fa fa fa-trash"></i> Delete</a>
                        <button class="btn btn-lightred btn-ef btn-ef-4 btn-ef-4c" data-dismiss="modal"><i class="fa fa-arrow-left"></i> Cancel</button>
                    </div>
                </div>
            </div>
        </div>
<!--/ CONTENT -->
<?php $this->load->view("simple_layout/footer"); ?>
<?php $this->load->view($this->uri->segment("1") . "/js"); ?>