<?php $this->view('simple_layout/header'); ?>
<?php $this->view('simple_layout/leftSidebar'); ?>
<style>
/* <!--
.thumbscl{

 border-radius:6%;
 width: 80px;
 height: 80px !important;

}

table.bp_table th,table.bp_table tr td{
    vertical-align: middle;
}
--> */
</style>
<section id="content">
	<div class="page page-forms-validate">
		<div class="pageheader">
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li><a href="<?php echo site_url();?>"><i class="fa fa-home"></i> <?php echo $this->lang->line ( "dashboard" );?></a></li>
					<li><a href="<?php echo site_url($this->uri->segment("1"));?>/booking_list"> <?php echo $this->lang->line ( "b2c" );?> <?php echo $this->lang->line ( "flight" );?> </a></li>
					<li><a href="<?php echo site_url($this->uri->segment("1"));?>"> <strong><?php echo $this->lang->line ( "b2c" )." ".$this->lang->line ( "flight_markup_list" );?> </strong></li>
				</ul>
			</div>
		</div>
		<!-- row -->
		<div class="row">
			<!-- col -->
			<div class="col-md-12">
				<!-- tile -->
				<a href="<?php echo site_url();?>b2c_flight/add_b2c_flight_markup" class="btn btn-greensea btn-ef btn-ef-7 btn-ef-7h mb-10 pull-right"><i class="fa fa-plus"></i> <?php echo $this->lang->line ( "add_flight_markup" );?></a>
				<div class="clearfix"></div>
				<section class="tile bp_shadow">
					<!-- tile header -->
					<div class="tile-header dvd dvd-btm">
						<h1 class="custom-font">
							<strong><?php echo $this->lang->line ( "b2c" )." ".$this->lang->line ( "flight_markup_list" );?> </strong>
						</h1>
					</div>
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
						<div class="table-responsive">
						<table class="table table-bordered bp_table">
							<thead>
								<tr>
									<th>#</th>
									<th>Dom/Int</th>
									<th><?php echo $this->lang->line ( "amount_type" );?></th>
									<th><?php echo $this->lang->line ( "amount" );?></th>
									<th><?php echo $this->lang->line ( "markup_type" );?></th>
									<th><?php echo $this->lang->line ( "airline_name" );?></th>
									<th><?php echo $this->lang->line ( "airline_code" );?></th>
									<th><?php echo $this->lang->line ( "updated_on" );?></th>
									<th><?php echo $this->lang->line ( "action" );?></th>
								</tr>
							</thead>
							<tbody>
                                     <?php if(isset($markup)){
								if(is_array($markup)){
									$i=1;
									foreach($markup as $bp)
									{
								?>
                                        <tr>
                                            <td><?php echo $i;?> </td>
                                             <td><?php echo $bp->dsamark_dom_int; ?></td>
                                            <td><?php echo $bp->dsamark_amount_type; ?></td>
                                            <td><?php echo $bp->dsamark_value; ?></td>
                                            <td><?php echo $bp->dsamark_markup_type; ?></td>
                                            <td><?php echo $bp->dsamark_airline_name; ?></td>
                                            <td><?php echo $bp->dsamark_airline_code; ?></td>
                                           <td><?php echo date_format(date_create($bp->dsamark_update_date),"h:i A , d M Y");?></td>
                                            <td>
                                                <button class="btn btn-danger btn-rounded btn-ef btn-ef-5 btn-ef-5b btn-xs"  onclick="addidfordelete('<?php echo site_url().$this->uri->segment ( "1" );?>/delete_b2c_flight_markup/?ref_id=<?php echo url_encode($bp->dsamark_id); ?>')"><i class="fa fa-trash"></i> <span><?php echo $this->lang->line ( "delete" );?></span></button>
                                               
                                                </td>
                                        </tr>
                                       <?php 
									$i++;
								}
								}
								}?>
							</tbody>
						</table>
					</div>
						<div style="text-align: right;"><?php echo $this->pagination->create_links();?></div>
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
                        <a class="btn btn-success btn-ef btn-ef-3 btn-ef-3c" id="deletePoll"><i class="fa fa-arrow-right"></i> <?php echo $this->lang->line ( "submit" );?></a>
                        <button class="btn btn-lightred btn-ef btn-ef-4 btn-ef-4c" data-dismiss="modal"><i class="fa fa-arrow-left"></i> <?php echo $this->lang->line ( "cancel" );?></button>
                    </div>
                </div>
            </div>
        </div>
<!--/ CONTENT -->
<?php $this->load->view("simple_layout/footer");?>
<?php $this->load->view("blog/js");?>
<?php $this->load->view("blog/data_table_js");?>