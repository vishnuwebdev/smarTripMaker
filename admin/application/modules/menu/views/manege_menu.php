<?php $this->view('simple_layout/header'); ?>
<?php $this->view('simple_layout/leftSidebar'); ?>
<style>
    <!--
    .thumbscl{

        border-radius:6%;
        width: 80px;
        height: 80px !important;

    }

    table.bp_table th,table.bp_table tr td{
        vertical-align: middle;
    }
    -->
</style>
<section id="content">
    <div class="page page-forms-validate">
        <div class="pageheader">
            
            <div class="page-bar">
               
                <ul class="page-breadcrumb" >
                    <li><a href="<?php echo site_url(); ?>"><i class="fa fa-home"></i>
                            <?php echo $this->lang->line("dashboard"); ?></a></li>
                    <li><a href="<?php echo site_url($this->uri->segment("1")); ?>/menu_list"></i><?php echo $this->lang->line("menu"); ?></a></li>
                    <li><a></i> <?php echo $this->lang->line("manege"); ?> <?php echo $this->lang->line("menu"); ?></a></li>
                </ul>
            </div>
        </div>
        <!-- row -->
        <div class="row">
            <!-- col -->
            <div class="col-md-12">
                <!-- tile -->
			<a href="<?php echo site_url() . $this->uri->segment("1"); ?>/add_menu" class="btn btn-greensea btn-ef btn-ef-7 btn-ef-7h mb-10 pull-right">
                    <i class="fa fa-plus"></i> <?php echo $this->lang->line("add"); ?> <?php echo $this->lang->line("menu"); ?> 
               </a>
                <div class="clearfix"></div>
                <section class="tile bp_shadow">
                    <!-- tile header -->
                    <div class="tile-header dvd dvd-btm">
                        <h1 class="custom-font">
                            <strong><?php echo $this->lang->line("manege"); ?> <?php echo $this->lang->line("menu"); ?> </strong> 
                        </h1>
                    </div>
                    <?php
                    if ($this->session->flashdata('alert') !== NULl) {
                        $bhanu_message = $this->session->flashdata('alert');
                        ?>
                        <div
                            class="alert alert-sm alert-border-left <?php echo $bhanu_message['class']; ?> light alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert"
                                    aria-hidden="true">×</button>
                            <i class="fa fa-info pr10"></i> <strong> <?php echo $bhanu_message['message']; ?></strong>
                        </div>

                    <?php } ?>
                    <!-- /tile header -->

                    <!-- tile body -->
                    <!-- tile body -->
                    <div class="tile-body" style="min-height:500px;">
                        <div class="row">
                            <div class="col-md-5">
                                <section class="tile" style="background: #fbfbfb;border: 1px solid #d2d2d2;">

                                    <!-- tile header -->
                                    <div class="tile-header dvd dvd-btm">
                                        <h1 class="custom-font"><strong><?php echo $this->lang->line("all"); ?>  </strong><?php echo $this->lang->line("pages"); ?></h1>

                                    </div>
                                    <!-- /tile header -->
                                    <div class="form-group">
                                           
                                            <div class="col-sm-12 p-15">
                                                <input type='text' placeholder="Search Page" id='txtList' class="form-control" onkeyup="filter(this)" />
                                             
                                            </div>
                                        </div>
             
                                    <!-- tile body -->
                                    <div class="tile-body" style="overflow: scroll;height: 354px;">

                                        <ul class="p-0" id="pagelist">
                                            <?php 
                                            $id = url_decode($this->input->get("menu_id"));
                                            if($allpages != "0"){ 
                                                foreach($allpages as $allpagesss) { ?>
                                            <li class="list-group-item pb-0 pt-0">
                                                <label class="checkbox checkbox-custom-alt checkbox-custom-md ">
                                                    <input type="checkbox" name="pages" class="addtomenu checkboxpage" menuId="<?php  echo $id; ?>" value="<?php  echo $allpagesss->page_id; ?>" pagetitle="<?php  echo $allpagesss->page_title; ?>" pageslug="<?php  echo $allpagesss->page_slug; ?>" pagelanguage = "<?php  echo $allpagesss->page_language; ?>" >
                                                    <i></i> <?php  echo $allpagesss->page_title; ?>
                                                </label></li>
                                                <?php } }else{ ?>
                                                <li class="list-group-item"><label class="checkbox checkbox-custom-alt checkbox-custom-lg">
                                                    Page not found.
                                                </label></li>
                                                <?php } ?>
                                        </ul>

                                    </div>
                                    <!-- /tile body -->

                                </section>

                                <button type="button" onclick="add_custom_link('<?php echo $menuData->menu_language ?>','<?php  echo $id; ?>');"  class="btn btn-success"> Add Custom Link </button>
                            </div>
                            <div class="col-md-6">
                                <section class="tile backboxcolor">
                                 <div class="tile-header dvd dvd-btm">
                                        <h1 class="custom-font"><strong><?php echo $menuData->menu_title ?>  </strong></h1>

                                    </div>
                                    <div class="tile-body" id="allmenuid">
                                <?php 
                                if($menupages != "0"){
                                foreach ($menupages as $menupages){ ?>
                                        <section class="tile border-light-gray" id="menusectionid_<?php echo $menupages->menupage_id; ?>">

                                <!-- tile header -->
                                <div class="tile-header dvd dvd-btm p">
                                    <h1 class="custom-font"><strong><?php echo $menupages->menupage_page_title; ?></strong> <span class="display-title"><?php echo $menupages->menupage_page_display_title; ?></span></h1>
                                    <ul class="controls">
                                        <li><a data-toggle="collapse" href="#collapseExample_<?php echo $menupages->menupage_id; ?>" aria-expanded="false" aria-controls="collapseExample" class="collapsed"> <i class="fa fa-cog"></i>
                                               </a></li>
                                               <li><a onclick="deletemenu('<?php echo $menupages->menupage_id; ?>');" href="#none" class="collapsed"> <i class="fa fa-remove"></i>
                                               </a></li>
                                       
                                            </ul>
                                </div>
                                <!-- /tile header -->

                                <!-- tile body -->
                                <div class="tile-body p-0">

                                    <div class="collapse" id="collapseExample_<?php echo $menupages->menupage_id; ?>" aria-expanded="false" style="height: 0px;">
                                        <div class="well">
                                           <form class="form-horizontal" role="form">
                                               <div class="" id="msgupdated_<?php echo $menupages->menupage_id; ?>"></div>
          
                    <input type="hidden" id="menupageid_<?php echo $menupages->menupage_id; ?>" value="<?php echo $menupages->menupage_id; ?>">
                      <?php if($menupages->menupage_menu_type == "custom"){ ?>
                    <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-3 control-label">Custom Link</label>
                                            <div class="col-sm-9">
                                                <input type="text" id="customlink_<?php echo $menupages->menupage_id; ?>" class="form-control" value="<?php echo $menupages->menupage_page_slug; ?>"  placeholder="Custom Link">
                                                
                                            </div>
                                        </div>
                    <?php } ?>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-3 control-label">Display Title</label>
                                            <div class="col-sm-9">
                                                <input type="text" id="displaytitlemenu_<?php echo $menupages->menupage_id; ?>" class="form-control" value="<?php echo $menupages->menupage_page_display_title; ?>"  placeholder="Display Title">
                                               
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-3 control-label">Order</label>
                                            <div class="col-sm-9">
                                                <input type="number" min="0" id="pageordermenu_<?php echo $menupages->menupage_id; ?>" class="form-control" value="<?php echo $menupages->menupage_order; ?>"  placeholder="oder">
                                            </div>
                                        </div>
                         <div class="form-group">
                                            <label for="targetpage" class="col-sm-3 control-label">Page Target</label>
                                            <div class="col-sm-9">
                                                <label class="checkbox checkbox-custom-alt checkbox-custom-md ">
                                                <input type="checkbox" id="pagetargetcus_<?php echo $menupages->menupage_id; ?>" <?php if($menupages->menupage_menu_target == "_blank"){ echo "checked"; } ?> class="">
                                                <i></i> <?php echo $this->lang->line("page_target"); ?>
                                                </label>
                                                
                                            </div>
                                        </div>
                     <div class="form-group">
                                            
                                            <div class="col-sm-10">
                                                <button type="button" class="btn btn-success btn-ef btn-ef-3 btn-ef-3c" onclick="update_menu('<?php echo $menupages->menupage_id; ?>','<?php echo $menupages->menupage_menu_type; ?>');"><i class="fa fa-arrow-right"></i> <?php echo $this->lang->line("update"); ?></button>         </div>
                                        </div>
                                       
                                        
                                    </form>   </div>
                                    </div>

                                </div>
                                <!-- /tile body -->

                            </section>
                                
                                <?php } }else{ ?>
                                page not added yet.
                                <input type="hidden" name="vcheck" id="valuecheck" value="0">
                                <?php } ?>
                                </div>
                                </section>
                            </div>
                        </div>

                    </div>
                    <!-- /tile body -->
                    <!-- /tile body -->
                    <!-- tile footer -->
                    <div class="tile-footer text-right bg-tr-black lter dvd dvd-top">
                        <!-- SUBMIT BUTTON -->

                    </div>
                    <!-- /tile footer -->
                    </form>
                </section>
                <!-- /tile -->
            </div>
            <!-- /col -->
        </div>
        <!-- /row -->
    </div>
</section>

<div class="modal fade" id="addpagetomenu" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title custom-font">! <?php echo $this->lang->line("add"); ?> <?php echo $this->lang->line("menu"); ?></h3>
            </div>
            <div class="modal-body">
               <form class="form-horizontal" role="form">
                   <input type="hidden" id="pageid" value="">
                   <input type="hidden" id="pageslug" value="">
                   <input type="hidden" id="pagetitle" value="">
                    <input type="hidden" id="pagelanguage" value="">
                    <input type="hidden" id="menuId" value="">
                   
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-3 control-label">Display Title</label>
                                            <div class="col-sm-9">
                                                <input type="text" id="displaytitle" class="form-control" placeholder="Display Title">
                                                
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-3 control-label">Order</label>
                                            <div class="col-sm-9">
                                                <input type="number" id="pageorder" min="0" value="0" class="form-control" placeholder="oder">
                                            </div>
                                        </div>
                    
                                       <div class="form-group">
                                            <label for="targetpage" class="col-sm-3 control-label">Page Target</label>
                                            <div class="col-sm-9">
                                                <label class="checkbox checkbox-custom-alt checkbox-custom-md ">
                                                <input type="checkbox" id="pagetarget" class="">
                                                <i></i> <?php echo $this->lang->line("page_target"); ?>
                                                </label>
                                                
                                            </div>
                                        </div>
                                       
                                        
                                    </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success btn-ef btn-ef-3 btn-ef-3c" onclick="add_to_menu();"><i class="fa fa-arrow-right"></i> <?php echo $this->lang->line("add"); ?></button>
                <button class="btn btn-lightred btn-ef btn-ef-4 btn-ef-4c" data-dismiss="modal"><i class="fa fa-arrow-left"></i> <?php echo $this->lang->line("cancel"); ?></button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="addcustomlink" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title custom-font"><?php echo $this->lang->line("add"); ?> <?php echo $this->lang->line("custom"); ?> <?php echo $this->lang->line("link"); ?></h3>
            </div>
            <div class="modal-body">
               <form class="form-horizontal" role="form">
                 <div id="errormsg"></div>
                    <input type="hidden" id="pagelanguagecus" value="">
                    <input type="hidden" id="menuIdcus" value="">
                   
                     <div class="form-group">
                         
                                            <label for="inputEmail3" class="col-sm-2 control-label">Url Link</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="customlink" class="form-control" placeholder="Add Link">
                                                
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputtitle" class="col-sm-2 control-label">Display Title</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="displaytitlecus" class="form-control" placeholder="Display Title">
                                               
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputorder" class="col-sm-2 control-label">Order</label>
                                            <div class="col-sm-10">
                                                <input type="number" id="pageordercus" min="0" value="0" class="form-control" placeholder="Order">
                                            </div>
                                        </div>
                                       <div class="form-group">
                                            <label for="targetpage" class="col-sm-3 control-label">Page Target</label>
                                            <div class="col-sm-9">
                                                <label class="checkbox checkbox-custom-alt checkbox-custom-md ">
                                                <input type="checkbox" id="pagetargetcus" class="">
                                                <i></i> <?php echo $this->lang->line("page_target"); ?>
                                                </label>
                                                
                                            </div>
                                        </div>
                                        
                                    </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success btn-ef btn-ef-3 btn-ef-3c" onclick="add_custom_menu();"><i class="fa fa-arrow-right"></i> <?php echo $this->lang->line("add"); ?></button>
                <button class="btn btn-lightred btn-ef btn-ef-4 btn-ef-4c" data-dismiss="modal"><i class="fa fa-arrow-left"></i> <?php echo $this->lang->line("cancel"); ?></button>
            </div>
        </div>
    </div>
</div>
<!--/ CONTENT -->
<?php $this->load->view("simple_layout/footer"); ?>
<?php $this->load->view("menu/js"); ?>
