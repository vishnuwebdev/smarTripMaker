<?php $this->view('simple_layout/header'); ?>
<?php $this->view('simple_layout/leftSidebar'); ?>
<section id="content">
	<div class="page page-forms-validate">
		<div class="pageheader">
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li><a href="<?php echo site_url();?>"><i class="fa fa-home"></i> <?php echo $this->lang->line ( "dashbord" );?></a></li>
					<li><a href="<?php echo site_url($this->uri->segment("1"));?>"></i> <?php echo $this->lang->line ( "holiday" );?></a></li>
					<li><a></i><?php echo $this->lang->line ( "edit_contact_detail" );?> </a></li>
				</ul>
			</div>
		</div>
		<!-- row -->
		<div class="row">
			<!-- col -->
			<div class="col-md-12">
				<!-- tile -->
				<a href="<?php echo site_url().$this->uri->segment ( '1' ) ;?>/add_contact_detail" class="btn btn-greensea btn-ef btn-ef-7 btn-ef-7h mb-10 pull-right mr-10"><i class="fa fa-plus"></i> <?php echo $this->lang->line ( "add_contact_detail" );?></a>
				<a href="<?php echo site_url().$this->uri->segment ( '1' ) ;?>/contact_detail" class="btn btn-greensea btn-ef btn-ef-7 btn-ef-7h mb-10 pull-right mr-10"><i class="fa fa-list"></i> <?php echo $this->lang->line ( "contact_detail_list" );?></a>
				<div class="clearfix"></div>
				<section class="tile bp_shadow">
					<!-- tile header -->
					<div class="tile-header dvd dvd-btm">
						<h1 class="custom-font">
							 <strong> <?php echo $this->lang->line ( "edit_contact_detail" );?> </strong>
						</h1>
					</div>
					<!-- /tile header -->
					<form class="form-horizontal" role="form" action="" method="post" id="add_contact_detail" enctype="multipart/form-data">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
						<div class="panel panel-info">
							<div class="panel-heading">
								<div class="panel-title hidden-xs"><?php echo $this->lang->line ( "contact_detail" );?> </div>
							</div>
							<div class="panel-body pn">
								<br>
								<table class="table table-bordered bp_table_td">
									<tbody>
										<tr>
											<td class="warning"><?php echo $this->lang->line ( "service" );?></td>
											<td><input type="text" name="service_name" class="form-control" placeholder="Enter Service Name" value="<?php echo $result->holcond_support_name;?>"></td>
											<td class="warning"><?php echo $this->lang->line ( "contact_person_name" );?></td>
											<td><input type="text" name="name" class="form-control" placeholder="Enter Contact Name" value="<?php echo $result->holcond_name;?>"></td>
										</tr>
										<tr>
											<td class="warning"><?php echo $this->lang->line ( "phone" );?></td>
											<td><input type="text" name="phone" class="form-control" placeholder="Enter Contact Phone Number" value="<?php echo $result->holcond_phone;?>"></td>
											<td class="warning"><?php echo $this->lang->line ( "email" );?></td>
											<td><input type="text" name="email" class="form-control" placeholder="Enter Contact Email" value="<?php echo $result->holcond_email;?>"></td>
										</tr>
										<tr>
											<td class="warning"><?php echo $this->lang->line ( "language" );?></td>
											<td><select class="form-control" name="language">
										<?php $all_language=$this->all_language;
										?>
										<?php foreach($all_language as $all_languages){ ?> 
										<option value="<?php echo $all_languages;?>" <?php if($result->holcond_language==$all_languages){ echo "selected"; }?>><?php echo $all_languages;?></option>
										<?php }?>
										</select></td>
										</tr>
										
									</tbody>
								</table>

							</div>


							<div class="panel-body pn">

								<div class="row box-footer">
									<div class="text-center">

										<button type="submit" class="btn btn-primary"><?php echo $this->lang->line ( "update" );?></button>

									</div>
								</div>
								<br>
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
<?php $this->load->view($this->uri->segment("1")."/js");?>