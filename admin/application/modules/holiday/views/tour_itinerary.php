
					<?php
					$bp_active_tab_data ['bp_active_tab'] = "package_itinerary";
					$this->load->view ( "package_tab", $bp_active_tab_data );
					?>
<!-- /tile header -->
					<!-- tile body -->
					<div class="tile-body">
						<a href="<?php echo site_url().$this->uri->segment ( "1" );?>/add_package_itinerary/?ref_id=<?php echo url_encode($id); ?>" class="btn btn-greensea btn-ef btn-ef-7 btn-ef-7h mb-10 pull-right"><i class="fa fa-plus"></i> <?php echo $this->lang->line ( "add_itinerary" );?></a>
				<div class="clearfix"></div>
						<table class="table table-bordered bp_table">
							<thead>
								<tr>
									<th>#</th>
									<th> <?php echo $this->lang->line ( "name" );?></th>
									<th> <?php echo $this->lang->line ( "title" );?></th>
									<th> <?php echo $this->lang->line ( "remark" );?></th>
									<th> <?php echo $this->lang->line ( "updated_on" );?></th>
									<th> <?php echo $this->lang->line ( "action" );?></th>
								</tr>
							</thead>
							<tbody>
                                     <?php if(isset($bp_itinerary)){
								if(is_array($bp_itinerary)){
									$i=1;
									foreach($bp_itinerary as $bp)
									{
								?>
                                        <tr>
                                            <td><?php echo $i;?> </td>
                                            <td>Day <?php echo $bp->holiti_name; ?></td>
                                            <td><?php echo $bp->holiti_title; ?></td>
                                            <td><?php echo $bp->holiti_remark; ?></td>
                                           <td><?php echo date_format(date_create($bp->holiti_update_date),"h:i A , d M Y");?></td>
                                            <td>
                                                <a href="<?php echo site_url().$this->uri->segment ( "1" );?>/edit_itinerary_detail/?ref_id=<?php echo url_encode($id); ?>&itinerary_id=<?php echo url_encode($bp->holiti_id); ?>" class="btn btn-primary btn-rounded btn-ef btn-xs btn-ef-5 btn-ef-5b"><i class="fa fa-pencil"></i> <span> <?php echo $this->lang->line ( "edit" );?></span></a>
                                                <button class="btn btn-danger btn-rounded btn-ef btn-ef-5 btn-ef-5b btn-xs"  onclick="confirm_pop_up('<?php echo site_url().$this->uri->segment ( "1" );?>/delete_itinerary/?ref_id=<?php echo url_encode($id); ?>&itinerary_id=<?php echo url_encode($bp->holiti_id); ?>')"><i class="fa fa-trash"></i> <span> <?php echo $this->lang->line ( "delete" );?></span></button>
                                               
                                                </td>
                                        </tr>
                                       <?php 
									$i++;
								}
								}
								}?>
							</tbody>
						</table>
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
                        <h3 class="modal-title custom-font">!  <?php echo $this->lang->line ( "warning" );?></h3>
                    </div>
                    <div class="modal-body">
                         <?php echo $this->lang->line ( "do_you_want_to_delete" );?>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-success btn-ef btn-ef-3 btn-ef-3c" id="deletePoll"><i class="fa fa-arrow-right"></i> Submit</a>
                        <button class="btn btn-lightred btn-ef btn-ef-4 btn-ef-4c" data-dismiss="modal"><i class="fa fa-arrow-left"></i> Cancel</button>
                    </div>
                </div>
            </div>
        </div>
<!--/ CONTENT -->
<?php $this->load->view("simple_layout/footer");?>
<?php $this->load->view($this->uri->segment ( "1" )."/js");?>
<?php $this->load->view($this->uri->segment ( "1" )."/data_table_js");?>