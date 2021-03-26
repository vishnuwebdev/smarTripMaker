<?php $this->view('simple_layout/header'); ?>
<?php $this->view('simple_layout/leftSidebar'); ?>
<style>
.chosen-container{
	width:100% !important;
}
</style>


<link rel="stylesheet" href="<?php echo site_url();?>assets/js/vendor/summernote/summernote.css">
<section id="content">
	<div class="page page-forms-validate">
		<div class="pageheader">
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li><a href="<?php echo site_url();?>"><i class="fa fa-home"></i> <?php echo $this->lang->line ( "dashboard" );?></a></li>
					<li><a href="<?php echo site_url($this->uri->segment("1"));?>"></i> Email</a></li>
					<li><a></i> Email Send</a></li>
				</ul>
			</div>
		</div>
		<!-- row -->
		<div class="row">
			<!-- col -->
			<div class="col-md-12">
				<!-- tile -->
					<a href="<?php echo site_url().$this->uri->segment ( "1" );?>" class="btn btn-greensea btn-ef btn-ef-7 btn-ef-7h mb-10 pull-right"><i class="fa fa-list"></i>Email Report</a>
				<div class="clearfix"></div>
				<section class="tile bp_shadow">
					<!-- tile header -->
					<div class="tile-header dvd dvd-btm">
						<h1 class="custom-font">
							Email Send
						</h1>
					</div>
					<!-- /tile header -->
					<?php $attributes = array('class' => 'form-horizontal','id'=>'add_blog_post'); ?>
					<?php echo form_open_multipart('email/send_email',$attributes); ?>
					<!-- tile body -->
					<div class="tile-body">
					<?php echo form_error('myfield', '<div class="error">', '</div>');?>
					<?php if(validation_errors()!=NULL){?>	
					<div class="alert alert-big alert-lightred alert-dismissable fade in">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <?php echo validation_errors(); ?>
                                    </div>
                                    <?php }?>
					
							<div class="form-group">
								<div class="col-sm-12">
									<div class="table-responsive">
								<table class="table table-bordered bp_table_td">
								<tbody>
								<?php //print_r($agentsS);?>
								<tr class="custom_filter">
								<td  class="warning  custom_filter"> User Type </td>
								<td class="custom_filter"><select class="select block border form-control" id="user_type"  name="type"  autocomplete="off">
									<option value="all">All</option>
									<option value="agent" >Agent</option>
									<option value="customer" >Customer</option>
									<option value="staff" >Staff</option>
								</select> </td>
								
								
								<td  style="display:none;" class="warning  agent_grp1 custom_filter"> Agent Class </td>
								<td style="display:none;" class="custom_filter agent_grp1">
								<select class="form-control agent_cls" name="agent_cls" autocomplete="off">
									<option value=""> Select Class </option>
									<option value="all"> All Class </option>
									<?php foreach($agents_class as $agent_list) { ?>  
										<option  value="<?php echo $agent_list->agclali_name; ?>"> <?php echo $agent_list->agclali_name; ?> </option> 
									<?php }  ?>
									<option value="silver">Silver</option>
								</select> 
								</td>
								

								<td  style="display:none;" class="warning  agent_grp2 custom_filter"> User  </td>
								<td style="display:none;" class="custom_filter agent_grp2">
								<select multiple id="agent_cls_wise" class="chosen-select form-control user_name" name="agent_id[]" autocomplete="off">
								
									<option value="all"> Select all </option>
									<?php foreach($agentsS as $agent_list) { 
									//print_r($agent_list)
									?> 
									<option type="<?php echo $agent_list->agent_class; ?>" value="<?php echo $agent_list->agent_id; ?>"> <?php echo $agent_list->agent_company_name; ?> </option> 
									<?php }  ?>
								</select> </td>
								
								<td  style="display:none;" class="warning  customer_grp custom_filter"> Customer  </td>
								<td style="display:none;" class="custom_filter customer_grp">
								<select multiple class=" chosen-select form-control user_name" name="customer_id[]" autocomplete="off">
									<option value="all"> Select all </option>
									<?php foreach($customers as $customer) { ?>  
										<option value="<?php echo $customer->cust_email; ?>"> <?php echo $customer->cust_first_name; ?> <?php echo $customer->cust_last_name; ?></option> 
									<?php }  ?>
								</select> </td>

								</tbody>
								</table>
							</div>
								</div>
							</div>
							<hr class="line-dashed line-full"/>

                    <!-- <div class="form-group">
								<label class="col-sm-2 control-label">Phone Number: </label>
								<div class="col-sm-9">
									<div class="input text">
									<textarea name="phone_numbers" cols="40" rows="2" class="form-control"></textarea>
									</div>
								</div>
							</div>
							 -->
						
							
							<div class="form-group">
								<label class="col-sm-2 control-label">Subject: </label>
								<div class="col-sm-9">
									<div class="input text">
										<input id="subject" maxlength="50" name="subject" class="form-control"></input>
										</div>
								</div>
							</div>
						
							
								<div class="form-group">
								<label class="col-sm-2 control-label">Message: </label>
								<div class="col-sm-9">
									<div class="input text">
										<textarea id="textareaChars" maxlength="160" name="message" class="form-control"></textarea>
									</div>
								</div>
							</div>
							
						
							
							
					</div>
					<!-- /tile body -->
					<!-- tile footer -->
					<div class="tile-footer text-right bg-tr-black lter dvd dvd-top">
						<!-- SUBMIT BUTTON -->
								<div class="submit">
									<input type="submit" class="btn btn-success" value="<?php echo $this->lang->line ( "submit" );?>">
								</div>
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
<!--/ CONTENT -->

<?php $this->load->view("simple_layout/footer");?>
<script src="<?php echo site_url();?>assets/js/vendor/chosen/chosen.jquery.min.js"></script>	

<script>
$("#user_type").change(function() {
		var type = $(this).val();
		if(type=="all"){
			/* $(".user_name > option").each(function() {
					$(this).show()
			}); */
			
			$('.customer_grp').hide();
			$('.agent_grp2').hide();
			$('.agent_grp1').hide();
			
		} else if(type=="agent"){
			/* $(".user_name > option").each(function() {
				if($(this).attr('type') != type || $(this).attr('type') == "all" ){
					$(this).hide();
				} else {
					$(this).show();
				}
			}); */
			
			$('.customer_grp').hide();
			$('.agent_grp2').hide();
			$('.agent_grp1').show();
		} else if(type=="customer"){
			$('.customer_grp').show();
			$('.agent_grp2').hide();
			$('.agent_grp1').hide();
		}

		
	});
	
	
	
	$(".agent_cls").change(function() {
		var type = $(this).val();
		//console.log(agent_class);
		if(type=="all"){
			$('.agent_grp2').hide();
		} else {
			
			$('.customer_grp').hide();
			//$('.agent_grp2').show();
			$('.agent_grp1').show();
			
			$.ajax({url: "<?php echo site_url();?>email/agent",
			data: { 'type' :type },
			type: "get", 
			success: function(result){
			console.log(result);
           	
			if(result)
            {				
				
				var obj = jQuery.parseJSON(result);		
				$('select#agent_cls_wise').html('');
				$("<option />").val("all").text("Select all").appendTo($('select#agent_cls_wise'));
				for(var i=0;i<obj.length;i++)
				{
					$("<option />").val(obj[i].agent_email)
									.text(obj[i].agent_contact_person).attr('type',obj[i].agent_class)
									 .appendTo($('select#agent_cls_wise'));
				}  
				$("#agent_cls_wise").trigger("chosen:updated");	 
				$('.agent_grp2').show();
			} else {
				alert("Agent not Found of "+ type +" Class");
			}	
			}});
			
			
		} 

		
	});

</script>
