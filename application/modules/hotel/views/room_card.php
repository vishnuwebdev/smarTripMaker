<?php
    $aminities = $bp_room_details->Amenities;
    $aminities = (isset($aminities) && is_array($aminities)) ? $aminities[0] : null; 
    $offerClass = "";
    if($aminities){
        $ext = explode(",",$aminities);
        foreach($ext as $k => $v ){
            $ext[$k] = strtolower(str_replace(" ","_",trim($v)));
        }
        $offerClass=  implode(" ",$ext);
        
    }
?>    
    <div class="row room_card <?= $offerClass ?>">
        <div class="col-md-10 col-sm-12">
            <div class="dash-title pt-2 pt-md-3">
                <h3 class="fz18"><?php echo $bp_room_details->RoomTypeName;?></h3>
            </div>
            <ul class="list-inline clearfix mb-0 fare-cncl">
                <li class="list-inline-item float-left">
                    <!--<h5>Cancellation Detail</h5>-->
                    <a href=".roomfarebreakup_<?= "cancel_".$bp_room_key ?>" data-toggle="modal" class="badge danger-bg fz10 mb-10">Cancellation Detail</a>
                </li>
                <li class="list-inline-item float-right">
                    <a href=".roomfarebreakup_<?php echo $bp_room_key;?>" data-toggle="modal" class="badge danger-bg fz10 mb-10">Fare breakup</a>
                </li>
            </ul>
            <p style="font-size:0.7rem" class="comment"><?=  $bp_room_details->RoomDescription ?></p>
            <?php /*>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">From Date</th>
                                <th class="text-center">To Date</th>
                                <th class="text-center">Charge</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($bp_room_details->CancellationPolicies as $CancellationPolicies){?>
                                <tr>
                                    <td class="text-center">
                                        <?php echo date_format(date_create($CancellationPolicies->FromDate),"d M Y");?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo date_format(date_create($CancellationPolicies->ToDate),"d M Y");?>
                                    </td>
                                    <td class="text-center">
                                        <?php if($CancellationPolicies->ChargeType == '1'){ ?>
                                        <?php }?>
                                        <?php echo round($CancellationPolicies->Charge);?>
                                        <?php if($CancellationPolicies->ChargeType == '2'){ echo "%"; }?>
                                    </td>
                                </tr>
                            <?php }?>
                        </tbody>
                    </table>
                </div>
                */
            ?>
        </div>
        <div class="col-md-2 col-sm-2">
            <div class="htlcol-price text-right">
                <div class="ttl_price d-block mb-1">
                    <small class="htl-dur">Total price</small>
                    <span class="d-block"><?= $symbol?> 
                        <?php echo round($bp_customer_price*$nights);?>
                    </span>
                </div>

                <div class="ht-Price d-block mb-1">
                    <small class="d-block htl-dur">Price per night</small>
                    <span class="d-block">
                        <?= $symbol?>
                        <?php echo round($bp_customer_price);?>
                    </span>
                </div>
                <?php if(isset($loginBlock)){?>
                    <?php //if($this->session->userdata("Userlogin") != NULL){ ?>
                        <a href="<?php echo site_url();?>hotel/block_room/?room_index=<?php echo $bp_room_details->RoomIndex;?>" class="btn btn-search booknow selectedroom"> 
                            Select
                        </a>
                    <?php  /*}else { ?>	
                        <a href="javascript:void;"	data-ref="<?php echo site_url();?>hotel/block_room/?room_index=<?php echo $bp_room_details->RoomIndex;?>" data-toggle="modal" data-target="#login_modal" class="btn btn-search booknow selectedroom showLogin"> 
                            Select
                        </a>
                    <?php  } */ ?>
                <?php } else{ ?>
                    <a href="<?php echo site_url();?>hotel/block_room/?room_index=<?php echo $bp_room_index_for_select;?>" title="Select" class="btn btn-search bp_hotel_info_find">
                        Select
                    </a>
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- Fare breakup  -->
    <div class="modal fade roomfarebreakup_<?php echo $bp_room_key;?>">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title fwb">Fare Breakup</h4>
                    <button type="button" class="close"
                        data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <span class="d-block black-color p-2 light-bg border">Rate
                            Breakup</span>
                        <table class="table table-bordered">
                            <tbody>
                                <?php foreach($bp_room_details->DayRates as $bp_rate_date_brackup) {?>
                                <tr>
                                    <td class="text-left">
                                        <?php echo date_format(date_create($bp_rate_date_brackup->Date),"d M Y");?>
                                    </td>
                                    <td class="text-right"><?= $symbol?> <?= $symbol?>
                                        <?php echo round($bp_rate_date_brackup->Amount/$nights);?>
                                    </td>
                                </tr>
                                <?php }?>

                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive">
                        <span class="block black-color p710 light-bg border">Rate
                            Summary</span>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td class="text-left">Room Price</td>
                                    <td class="text-right"><?= $symbol?>
                                        <?php echo round($bp_room_details->Price->RoomPrice/$nights);?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left">Tax</td>
                                    <td class="text-right"><?= $symbol?>
                                        <?php echo round(($bp_customer_price - ($bp_room_details->Price->RoomPrice/$nights)));?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left">Total Price</td>
                                    <td class="text-right"><?= $symbol?>
                                        <?php echo round($bp_customer_price);?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade roomfarebreakup_<?= "cancel_".$bp_room_key ?>">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title fwb">Cancellation Detail</h4>
                    <button type="button" class="close"
                        data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <span class="d-block black-color p-2 light-bg border"><?= $bp_room_details->CancellationPolicy ?></span>
                    <!--<p> <?= $bp_room_details->CancellationPolicy ?>  </p>-->
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">From Date</th>
                                    <th class="text-center">To Date</th>
                                    <th class="text-center">Charge</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($bp_room_details->CancellationPolicies as $CancellationPolicies){?>
                                    <tr>
                                        <td class="text-center">
                                            <?php echo date_format(date_create($CancellationPolicies->FromDate),"d M Y");?>
                                        </td>
                                        <td class="text-center">
                                            <?php echo date_format(date_create($CancellationPolicies->ToDate),"d M Y");?>
                                        </td>
                                        <td class="text-center">
                                            <?php if($CancellationPolicies->ChargeType == '1'){ ?>
                                            <?php }?>
                                            <?php echo round($CancellationPolicies->Charge);?>
                                            <?php if($CancellationPolicies->ChargeType == '2'){ echo "%"; }?>
                                        </td>
                                    </tr>
                                <?php }?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
