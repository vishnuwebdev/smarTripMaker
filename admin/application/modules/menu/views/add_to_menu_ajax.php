<?php 
//print_r($menudata["menupage_menu_target"]);
//die; ?>
<section class="tile border-light-gray" id="menusectionid_<?php echo $menupageid; ?>">

                                <!-- tile header -->
                                <div class="tile-header dvd dvd-btm p">
                                    <h1 class="custom-font"><strong><?php echo $menudata["menupage_page_title"]; ?></strong><span class="display-title"><?php echo $menudata["menupage_page_display_title"]; ?></span></h1>
                                    <ul class="controls">
                                        <li><a data-toggle="collapse" href="#collapseExample_<?php echo $menupageid; ?>" aria-expanded="false" aria-controls="collapseExample" class="collapsed"> <i class="fa fa-cog"></i>
                                               </a></li>
                                       <li><a href="#none" onclick="deletemenu('<?php echo $menupageid; ?>');"  class="collapsed"> <i class="fa fa-remove"></i>
                                               </a></li>
                                            </ul>
                                </div>
                                <!-- /tile header -->

                                <!-- tile body -->
                                <div class="tile-body p-0">

                                    <div class="collapse" id="collapseExample_<?php echo $menupageid; ?>" aria-expanded="false" style="height: 0px;">
                                        <div class="well">
                                         <form class="form-horizontal" role="form">
                 <div class="" id="msgupdated_<?php echo $menupageid; ?>"></div>
                    <input type="hidden" id="menupageid_<?php echo $menupageid; ?>" value="<?php echo $menupageid; ?>">
                    <?php if($menuType == "custom"){ ?>
                    <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Custom Link</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="customlink_<?php echo $menupageid; ?>" class="form-control" value="<?php echo $menudata["menupage_page_slug"] ?>"  placeholder="Custom Link">
                                                
                                            </div>
                                        </div>
                    <?php } ?>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Display Title</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="displaytitlemenu_<?php echo $menupageid; ?>" class="form-control" value="<?php echo $menudata["menupage_page_display_title"] ?>"  placeholder="Display Title">
                                             
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-2 control-label">Order</label>
                                            <div class="col-sm-10">
                                                <input type="number" min="0" value="0" id="pageordermenu_<?php echo $menupageid; ?>" class="form-control" value="<?php echo $menudata["menupage_order"] ?>"  placeholder="oder">
                                            </div>
                                        </div>
                    <div class="form-group">
                                            <label for="targetpage" class="col-sm-3 control-label">Page Target</label>
                                            <div class="col-sm-9">
                                                <label class="checkbox checkbox-custom-alt checkbox-custom-md ">
                                                <input type="checkbox" id="pagetargetcus_<?php echo $menupageid; ?>" <?php if($menudata["menupage_menu_target"] == "_blank"){ echo "checked"; } ?> class="">
                                                <i></i> <?php echo $this->lang->line("page_target"); ?>
                                                </label>
                                                
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            
                                            <div class="col-sm-10">
                                                <button type="button" class="btn btn-success btn-ef btn-ef-3 btn-ef-3c" onclick="update_menu('<?php echo $menupageid; ?>');"><i class="fa fa-arrow-right"></i> <?php echo $this->lang->line("update"); ?></button>         </div>
                                        </div>
                                        
                                    </form>
                                        </div>
                                    </div>

                                </div>
                                <!-- /tile body -->

                            </section>