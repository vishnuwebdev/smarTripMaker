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
					<li><a href="<?php echo site_url();?>"><i class="fa fa-home"></i> <?php echo $this->lang->line ( "dashboard" );?></a></li>
					<li><a href="<?php echo site_url($this->uri->segment("1"));?>"></i> <?php echo $this->lang->line ( "staff" );?></a></li>
					<li><a></i> <?php echo $this->lang->line ( "staff_list" );?></a></li>
				</ul>
			</div>
		</div>
		<!-- row -->
		<div class="row">
			<!-- col -->
			<div class="col-md-12">
				<!-- tile -->
				<a href="<?php echo site_url();?>staff/add_new_staff" class="btn btn-greensea btn-ef btn-ef-7 btn-ef-7h mb-10 pull-right ml-10"><i class="fa fa-plus"></i> <?php echo $this->lang->line ( "add_staff" );?></a>
				<div class="clearfix"></div>
				<section class="tile bp_shadow">
					<!-- tile header -->
					<div class="tile-header dvd dvd-btm">
						
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
						<table style="word-break: break-all;" class="table table-bordered bp_table">
							<thead>
								<tr>
									<th>#</th>
									<th><?php echo $this->lang->line ( "name" );?></th>
									<th><?php echo $this->lang->line ( "email" );?></th>
									<th><?php echo $this->lang->line ( "permission" );?></th>
									<th><?php echo $this->lang->line ( "status" );?></th>
									<th><?php echo $this->lang->line ( "updated_on" );?></th>
									<th><?php echo $this->lang->line ( "action" );?></th>
								</tr>
							</thead>
							<tbody>
                                     <?php if(isset($result)){
								if(is_array($result)){
									$i=1;
									foreach($result as $bp)
									{
								?>
                                        <tr>
                                            <td><?php echo $i;?> </td>
                                            <td><?php echo $bp->dsast_first_name; ?> <?php echo $bp->dsast_last_name; ?></td>
                                            <td><?php echo $bp->dsast_email; ?></td>
                                             <td><?php echo $bp->dsast_permission; ?></td>
                                            <td><?php if($bp->dsast_status=="active"){ ?><a href="<?php echo site_url().$this->uri->segment ( "1" );?>/update_staff_status/?ref_id=<?php echo url_encode($bp->dsast_id); ?>&status=inactive" class="label label-success"><?php echo $this->lang->line ( "active" );?></a><?php }else{ ?><a href="<?php echo site_url().$this->uri->segment ( "1" );?>/update_staff_status/?ref_id=<?php echo url_encode($bp->dsast_id); ?>&status=active" class="label label-danger"><?php echo $this->lang->line ( "inactive" );?></a><?php }?></td>
                                           <td><?php echo date_format(date_create($bp->dsast_update_date),"h:i A , d M Y");?></td>
                                            <td>
                                                <a href="<?php echo site_url().$this->uri->segment ( "1" );?>/edit_staff_detail/?ref_id=<?php echo url_encode($bp->dsast_id); ?>" class="btn btn-primary btn-rounded btn-ef btn-xs btn-ef-5 btn-ef-5b"><i class="fa fa-pencil"></i> <span><?php echo $this->lang->line ( "edit" );?></span></a>
                                                <button class="btn btn-danger btn-rounded btn-ef btn-ef-5 btn-ef-5b btn-xs"  onclick="addidfordelete('<?php echo site_url().$this->uri->segment ( "1" );?>/delete_staff/?ref_id=<?php echo url_encode($bp->dsast_id); ?>')"><i class="fa fa-trash"></i> <span><?php echo $this->lang->line ( "delete" );?></span></button>
                                               
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