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
					<li><a href="<?php echo site_url();?>"><i class="fa fa-home"></i>
							<?php echo $this->lang->line ( "dashboard" );?></a></li>
					<li><a href="#"></i><?php echo $this->lang->line ( "coupon" );?></a></li>
				</ul>
			</div>
		</div>
        <!-- row -->
        <div class="row">
            <!-- col -->
            <div class="col-md-12">
                <!-- tile --><button class="btn btn-greensea btn-ef btn-ef-7 btn-ef-7h mb-10 pull-right" onclick="openModel();"><i class="fa fa-envelope"></i> <?php echo $this->lang->line ( "generate" );?> <?php echo $this->lang->line ( "coupon" );?></button>
                <div class="clearfix" ></div>
                <section class="tile bp_shadow">
                    <!-- tile header -->
                    <div class="tile-header dvd dvd-btm">
                        <h1 class="custom-font">
                            <strong><?php echo $this->lang->line ( "coupon" );?> </strong> <?php echo $this->lang->line ( "list" );?>
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
                        <div class="row">
                            <div class="col-md-6">
                                <div id="tableTools"></div>
                            </div>
                            <div class="col-md-6">
                                <div id="colVis"></div>
                            </div>
                        </div>
                        <table class="table table-bordered bp_table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?php echo $this->lang->line ( "amount" );?></th>
                                    <th><?php echo $this->lang->line ( "amount" );?> <?php echo $this->lang->line ( "type" );?></th>
                                    <th><?php echo $this->lang->line ( "coupon" );?></th>
                                    <th><?php echo $this->lang->line ( "remark" );?></th>
                                    <th><?php echo $this->lang->line ( "start" );?> <?php echo $this->lang->line ( "date" );?></th>
                                    <th><?php echo $this->lang->line ( "expiry" );?> <?php echo $this->lang->line ( "date" );?></th>
                                    <th><?php echo $this->lang->line ( "status" );?></th>
                                    <th><?php echo $this->lang->line ( "insert" );?> <?php echo $this->lang->line ( "date" );?></th>
                                    <th><?php echo $this->lang->line ( "action" );?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($result)) {
                                    if (is_array($result)) {
                                        $i = 1;
                                        foreach ($result as $bp) {
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?> </td>
                                                <td><?php if($bp->coupon_amount_type=="percent"){ echo $bp->coupon_amount.'%';}else{ echo $bp->coupon_amount;} ?></td>
                                                <td><?php echo $bp->coupon_amount_type; ?></td>
                                                <td><?php echo $bp->coupon_code; ?></td>
                                                 <td><?php echo $bp->coupon_remark; ?></td>
                                                <td><?php echo $bp->coupon_start_date; ?></td>
                                                <td><?php echo $bp->coupon_end_date; ?></td>
                                                <td><?php if ($bp->coupon_status == "active") { ?><a href="<?php echo site_url(); ?>coupon/update_coupon_status/?ref_id=<?php echo url_encode($bp->coupon_id); ?>&status=inactive" class="label label-success"><?php echo  $this->lang->line ( $bp->coupon_status );?></a><?php } else { ?><a href="<?php echo site_url(); ?>coupon/update_coupon_status/?ref_id=<?php echo url_encode($bp->coupon_id); ?>&status=active" class="label label-danger"><?php echo  $this->lang->line ( $bp->coupon_status );?></a><?php } ?></td>
                                                <td><?php echo $bp->coupon_insert_date; ?></td>
                                                <td>
                                                    
                                                    <button class="btn btn-danger btn-rounded btn-ef btn-ef-5 btn-ef-5b btn-xs"  onclick="addidfordelete('<?php echo site_url(); ?>coupon/deletecoupon/?coupon_id=<?php echo url_encode($bp->coupon_id); ?>')"><i class="fa fa-trash"></i> <span><?php echo $this->lang->line ( "delete" );?></span></button>

                                                </td>
                                            </tr>
                                            <?php
                                            $i++;
                                        }
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
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
       
            <?php $attributes = array('class' => '','id'=>'coupenform'); 
         echo form_open_multipart('coupon/add_coupon',$attributes); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title custom-font"><?php echo $this->lang->line ( "coupon" );?> <?php echo $this->lang->line ( "management" );?></h3>
                </div>
                <div class="modal-body">
                    <div class="tile-body">

                        <div class="row">

                            <div class="form-group col-md-6">
                                <label for="name"><?php echo $this->lang->line ( "coupon" );?> <?php echo $this->lang->line ( "amount" );?>: </label>
                                <input type="text" name="coupon_amount" id="name" class="form-control" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="contactemail"><?php echo $this->lang->line ( "coupon" );?> <?php echo $this->lang->line ( "amount" );?> <?php echo $this->lang->line ( "type" );?> : </label>
                                <select name="coupon_amount_type" class="form-control" required>
                                    <option value="">---<?php echo $this->lang->line ( "select" );?> <?php echo $this->lang->line ( "amount" );?> <?php echo $this->lang->line ( "type" );?>---</option>
                                    <option value="percent"><?php echo $this->lang->line ( "percent" );?></option>
                                    <option value="fixed"><?php echo $this->lang->line ( "fixed" );?></option>
                                </select>
                            </div>

                        </div>
                        <div class="row">
                        <div class="form-group col-md-6">
                            <label for="contactemail"><?php echo $this->lang->line ( "start" );?> <?php echo $this->lang->line ( "date" );?> : </label>
                            <div class="input-group " data-format="L" id='startdate'>
                                <input type="text" name="start_date" class="form-control" required>
                                <span class="input-group-addon">
                                    <span class="fa fa-calendar"></span>
                                </span>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="contactemail"><?php echo $this->lang->line ( "expiry" );?> <?php echo $this->lang->line ( "date" );?> : </label>
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
                            <label for="contactemail"><?php echo $this->lang->line ( "coupon" );?> : </label>
                           
                                <input type="text" name="coupon_no" value="<?php echo uniqid(); ?>" class="form-control" style="text-transform:uppercase" required>
                                
                           
                        </div>
                       <div class="form-group col-md-6">
                                <label for="name"><?php echo $this->lang->line ( "coupon" );?> <?php echo $this->lang->line ( "use" );?> <?php echo $this->lang->line ( "limit" );?>: </label>
                                <input type="text" name="coupon_use_limit" id="name" class="form-control" required>
                            </div>

                             <div class="form-group col-md-6">
                                <label for="name"> <?php echo $this->lang->line ( "coupon" );?> <?php echo $this->lang->line ( "remark" );?>: </label>
                                <input type="text" name="coupon_remark" id="remark" class="form-control" required>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success btn-ef btn-ef-3 btn-ef-3c"><i class="fa fa"></i> <?php echo $this->lang->line ( "generate" );?> </button>
                    <button class="btn btn-lightred btn-ef btn-ef-4 btn-ef-4c" data-dismiss="modal"><i class="fa fa-arrow-left"></i> <?php echo $this->lang->line ( "cancel" );?></button>
                </div>
            </div>
        </form>
    </div>
</div>
 <div class="modal fade" id="delPollModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title custom-font">! <?php echo $this->lang->line ( "warning" );?></h3>
                    </div>
                    <div class="modal-body">
                        <?php echo $this->lang->line ( "do_you_want_to_delete" );?>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-success btn-ef btn-ef-3 btn-ef-3c" id="deletePoll"><i class="fa fa fa-trash"></i> <?php echo $this->lang->line ( "delete" );?></a>
                        <button class="btn btn-lightred btn-ef btn-ef-4 btn-ef-4c" data-dismiss="modal"><i class="fa fa-arrow-left"></i> <?php echo $this->lang->line ( "cancel" );?></button>
                    </div>
                </div>
            </div>
        </div>
<!--/ CONTENT -->

<?php $this->load->view("simple_layout/footer"); ?>

<script type="text/javascript" >
    function addidfordelete(url){

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