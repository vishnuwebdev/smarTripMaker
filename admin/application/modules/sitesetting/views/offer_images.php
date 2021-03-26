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
                <ul class="page-breadcrumb">
                    <li><a href="<?php echo site_url(); ?>"><i class="fa fa-home"></i>
                            <?php echo $this->lang->line("dashboard"); ?></a></li>
                    <li><a href="<?php echo site_url() ?>">
                            Offer Images</a></li>
                </ul>
            </div>
        </div>
        <!-- row -->
        <div class="row">
            <!-- col -->
            <div class="col-md-12">
                <a href="<?php echo site_url() ?>sitesetting/add_offer_image" class="btn btn-greensea btn-ef btn-ef-7 btn-ef-7h mb-10 pull-right"><i class="fa fa-list"></i> <?php echo $this->lang->line("add_new_image"); ?></a>
                <div class="clearfix" ></div>
                <section class="tile bp_shadow">
                    <!-- tile header -->
                    <div class="tile-header dvd dvd-btm">
                        <h1 class="custom-font">
                            <strong>Offer Images </strong> <?php echo $this->lang->line("list"); ?>
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
                    <div class="tile-body">
                              <div class="clearfix"></div>
                    <div class="table-responsive">
                        <table class="table table-bordered bp_table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Url</th>
									<th>Action</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($bp_iamges)) {
                                    if (is_array($bp_iamges)) {
                                        $i = 1;
                                        foreach ($bp_iamges as $bp) {
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?> </td>
                                                <td><div class="pull-left thumb" style="width: 80px;">
                                                        <?php if ($bp->hos_image != "") { ?>
                                                            <img class="media-object thumbscl" src="<?php echo site_url(); ?>assets/img/offer/thumbs/<?php echo $bp->hos_image; ?>" alt="">
                                                        <?php } ?>
                                                          
                                                        
                                                    </div></td>
                                                <td><?php echo $bp->hos_title; ?></td>
                                                <td><?php echo $bp->hos_url; ?></td>
												  <td><a href="<?php echo site_url(); ?>sitesetting/edit_offer_image?image_id=<?php echo url_encode($bp->hos_id); ?>" class="btn btn-primary btn-rounded btn-ef btn-xs btn-ef-5 btn-ef-5b"><i class="fa fa-pencil"></i> <span>Edit</span></a>
                                                    <button class="btn btn-danger btn-rounded btn-ef btn-ef-5 btn-ef-5b btn-xs" onclick="confirm_pop_up('<?php echo site_url(); ?>sitesetting/delete_offer_image/?sliimg_id=<?php echo url_encode($bp->hos_id); ?>')">
                                                        <i class="fa fa-trash"></i> <span>Delete</span>
                                                    </button></td>
                                            </tr>
                                            <?php
                                            $i ++;
                                        }
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                        <div style="text-align: right;"><?php echo $this->pagination->create_links(); ?></div>
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

<div class="modal fade" id="modelcoupon" tabindex="-1" role="dialog" aria-labelledby="addcoupon" aria-hidden="true">
    <div class="modal-dialog">

        <?php
        $attributes = array('class' => '', 'id' => 'coupenform');
        echo form_open_multipart('coupon/add_holiday_coupon', $attributes);
        ?>
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title custom-font"><?php echo $this->lang->line("coupon"); ?> <?php echo $this->lang->line("management"); ?></h3>
            </div>
            <div class="modal-body">
                <div class="tile-body">

                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="control-label row col-md-12">Package Category:</label>


                            <?php
                            if (is_array($bp_package_category)) {
                                foreach ($bp_package_category as $bp) {
                                    if ($bp->holcat_status == "active") {
                                        ?>
                                        <div class="col-md-3">
                                            <label class="checkbox-inline">
                                                <input type="checkbox" name="category[]"  value="<?php echo $bp->holcat_id; ?>"> <?php echo $bp->holcat_name; ?>
                                            </label>
                                        </div>
                                    <?php
                                    }
                                }
                            }
                            ?>


                        </div>
                        <div class="form-group col-md-6">
                            <label for="name"><?php echo $this->lang->line("coupon"); ?> <?php echo $this->lang->line("amount"); ?>: </label>
                            <input type="text" name="coupon_amount" id="name" class="form-control" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="contactemail"><?php echo $this->lang->line("coupon"); ?> <?php echo $this->lang->line("amount"); ?> <?php echo $this->lang->line("type"); ?> : </label>
                            <select name="coupon_amount_type" class="form-control" required>
                                <option value="">---<?php echo $this->lang->line("select"); ?> <?php echo $this->lang->line("amount"); ?> <?php echo $this->lang->line("type"); ?>---</option>
                                <option value="percent"><?php echo $this->lang->line("percent"); ?></option>
                                <option value="fix"><?php echo $this->lang->line("fixed"); ?></option>
                            </select>
                        </div>

                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="contactemail"><?php echo $this->lang->line("start"); ?> <?php echo $this->lang->line("date"); ?> : </label>
                            <div class="input-group " data-format="L" id='startdate'>
                                <input type="text" name="start_date" class="form-control" required>
                                <span class="input-group-addon">
                                    <span class="fa fa-calendar"></span>
                                </span>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="contactemail"><?php echo $this->lang->line("expiry"); ?> <?php echo $this->lang->line("date"); ?> : </label>
                            <div class="input-group" data-format="L" id="enddate">
                                <input type="text" name="expiry_date" class="form-control" required>
                                <span class="input-group-addon">
                                    <span class="fa fa-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="contactemail"><?php echo $this->lang->line("coupon"); ?> : </label>

                            <input type="text" name="coupon_no" value="<?php echo uniqid(); ?>" class="form-control" style="text-transform:uppercase" required>


                        </div>
                        <div class="form-group col-md-6">
                            <label for="name"><?php echo $this->lang->line("coupon"); ?> <?php echo $this->lang->line("use"); ?> <?php echo $this->lang->line("limit"); ?>: </label>
                            <input type="text" name="coupon_use_limit" id="name" class="form-control" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="name"> <?php echo $this->lang->line("coupon"); ?> <?php echo $this->lang->line("remark"); ?>: </label>
                            <input type="text" name="coupon_remark" id="remark" class="form-control" required>
                        </div>
                    </div>


                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success btn-ef btn-ef-3 btn-ef-3c"><i class="fa fa"></i> <?php echo $this->lang->line("generate"); ?> </button>
                <button class="btn btn-lightred btn-ef btn-ef-4 btn-ef-4c" data-dismiss="modal"><i class="fa fa-arrow-left"></i> <?php echo $this->lang->line("cancel"); ?></button>
            </div>
        </div>
        </form>
    </div>
</div>
<div class="modal fade" id="delPollModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title custom-font">! <?php echo $this->lang->line("warning"); ?></h3>
            </div>
            <div class="modal-body">
<?php echo $this->lang->line("do_you_want_to_delete"); ?>
            </div>
            <div class="modal-footer">
                <a class="btn btn-success btn-ef btn-ef-3 btn-ef-3c" id="deletePoll"><i class="fa fa fa-trash"></i> <?php echo $this->lang->line("delete"); ?></a>
                <button class="btn btn-lightred btn-ef btn-ef-4 btn-ef-4c" data-dismiss="modal"><i class="fa fa-arrow-left"></i> <?php echo $this->lang->line("cancel"); ?></button>
            </div>
        </div>
    </div>
</div>
<!--/ CONTENT -->

<?php $this->load->view("simple_layout/footer"); ?>

<script type="text/javascript" >
    function confirm_pop_up(url) {

        $('#delPollModal').modal('show');
        $('#deletePoll').click(function () {

            // similar behavior as clicking on a link
            window.location.href = url;
        })
    }
    function openModel() {

        $('#modelcoupon').modal('show');

    }

</script>

<?php $this->load->view("coupon/js"); ?>
<?php
// $this->load->view("pages/data_table_js");?>