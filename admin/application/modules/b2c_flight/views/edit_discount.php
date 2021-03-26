<?php $this->view('simple_layout/header'); ?>
<?php $this->view('simple_layout/leftSidebar'); ?>
<section id="content">
	<div class="page page-forms-validate">
		<div class="pageheader">
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li><a href="<?php echo site_url();?>"><i class="fa fa-home"></i> Dashboard</a></li>
					<li><a href="<?php echo site_url($this->uri->segment("1"));?>/booking_list"></i> <?php echo $this->uri->segment("1");?></a></li>
					<li><a></i> Add B2B Discount</a></li>
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
																													<div class="alert alert-sm alert-border-left <?php echo $bhanu_message['class'];?> light alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<i class="fa fa-info pr10"></i> <strong> <?php echo $bhanu_message['message'];?></strong>
				</div>
              
			<?php }?>
				<section class="tile bp_shadow">
					<form class="form-horizontal" role="form" action="" method="post" id="add_agent_class">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
						<div class="panel panel-info">
							<div class="panel-heading">
								<strong>Add B2B Discount </strong>
							</div>
							<div class="panel-body pn">
								<br>
								<table class="table table-bordered bp_table_td">
									<tbody>
										<tr>
											<td class="warning">Airline Type</td>
											<td>
											    <select class="form-control" name="airline_type">
											       <option value="airline_wise">Airline Wise</option>
											       <option value="all">All</option>  
							                    </select>
                                            </td>
											<td class="warning">Amount Type</td>
											<td>
											    <select class="form-control amount_type_select" name="amount_type">
							                       <option value="basic_yq">Basic & YQ</option>
							                       <option value="fix">Fix</option>
							                    </select>
                                            </td>
                                            <td class="warning">Agent Class</td>
											<td>
											    <select class="form-control" name="class">
							     <option value="silver"><?php echo $this->lang->line ( "silver" );?></option>
							     <?php 
							     foreach($agent_class_list as $agent_class_lists){?>
							     <option value="<?php echo $agent_class_lists->agclali_name;?>"><?php echo $agent_class_lists->agclali_name;?></option>
							     <?php }?>
							     </select>
                                            </td>
										</tr>
											<tr>
											<td class="warning basic_yq_show_hide">Basic</td>
											<td class="basic_yq_show_hide"><input type="text" class="form-control" name="basic"></td>
											<td class="warning basic_yq_show_hide">YQ</td>
											<td class="basic_yq_show_hide"><input type="text" class="form-control" name="yq"></td>
											<td class="warning">Airline</td>
											<td>
											     <select class="form-control chosen_single_select" name="airline_code">
											     <option value="0___all">All Airline</option>
											       <?php 
							     foreach($airline_list as $airline_list){?>
							     <option value="<?php echo $airline_list->airline_code;?>___<?php echo $airline_list->airline_name;?>"><?php echo $airline_list->airline_name;?></option>
							     <?php }?>
							                     </select>
							               </td>
											<td class="warning fix_amount_show" style="display:none;">Fix Amount</td>
											<td class="fix_amount_show" style="display:none;"><input type="text" class="form-control" name="fix_amount"></td>
										</tr>
										</tbody>
										</table>
							</div>
							<div class="panel-body pn">
								<div class="text-center">
									<button type="submit" class="btn btn-primary">Update</button>
								</div>
							</div>
						</div>
					</form>
				</section>
				<!-- /tile -->
			</div>
			<!-- /col -->
		</div>
		<!-- /row -->
	</div>
</section>
<!--/ CONTENT -->
<?php $this->load->view("simple_layout/footer");?>
<script type="text/javascript">
$(".amount_type_select").change(function(){
	var bp_value=$(this).val();
	if(bp_value=="fix"){
		 $(".basic_yq_show_hide").hide();
	       $(".fix_amount_show").show();
	}else{
       $(".basic_yq_show_hide").show();
       $(".fix_amount_show").hide();
	}
});
</script>
  <script src="<?php echo site_url();?>assets/js/vendor/chosen/chosen.jquery.min.js"></script>
  <script>
  $(".chosen_single_select").chosen({
      width: "100%"
  });
  </script>
