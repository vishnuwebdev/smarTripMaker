<?php $this->view('simple_layout/header'); ?>
<?php $this->view('simple_layout/leftSidebar'); ?>
<section id="content">
	<div class="page page-forms-validate bp_page">
		<div class="pageheader bp_pageheader">
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li><a href="<?php echo site_url();?>"><i class="fa fa-home"></i> <?php echo $this->lang->line ( "dashboard" );?></a></li>
					<li><a href="<?php echo site_url($this->uri->segment("1"));?>"></i> <?php echo $this->lang->line ( "holiday" );?></a></li>
					<li><a></i> <?php echo $this->lang->line ( "add_package_exclusion" );?></a></li>
				</ul>
			</div>
		</div>
		<!-- row -->
		<div class="row">
			<!-- col -->
			<div class="col-md-12">
				<!-- tile -->
				<a href="<?php echo site_url();?>holiday/exclusion_list" class="btn btn-greensea btn-ef btn-ef-7 btn-ef-7h mb-10 pull-right"><i class="fa fa-list"></i> <?php echo $this->lang->line ( "exclusion_list" );?></a>
				<div class="clearfix"></div>
				<section class="tile bp_shadow">
					<!-- tile header -->
					<!-- 					<div class="tile-header dvd dvd-btm"> -->
					<!-- 						<h1 class="custom-font"> -->
					<!-- 							Add New <strong> Inclusion </strong> -->
					<!-- 						</h1> -->
					<!-- 					</div> -->
					<!-- /tile header -->
					<form class="form-horizontal" role="form" action="" method="post" id="add_new_exclusion">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
						<div class="panel panel-info">
							<div class="panel-heading">
								<div class="panel-title hidden-xs">
									 <strong> <?php echo $this->lang->line ( "add_package_exclusion" );?> </strong>
								</div>
							</div>
							<div class="panel-body pn">
								<br>
								<table class="table table-bordered bp_table_td">
									<tbody>
										<tr>
											<td class="warning"><?php echo $this->lang->line ( "exclusion_name" );?>*</td>
											<td><input type="text" name="name" class="form-control" placeholder="Enter Exclusion Name" required></td>
											<td class="warning"><?php echo $this->lang->line ( "status" );?></td>
											<td><select class="form-control" name="status">
													<option value="active"><?php echo $this->lang->line ( "active" );?></option>
													<option value="inactive"><?php echo $this->lang->line ( "inactive" );?></option>
											</select></td>
										</tr>
										<!--<tr>
											<td class="warning"><?php echo $this->lang->line ( "detail" );?></td>
											<td><textarea class="form-control" name="detail"></textarea></td>
											<td class="warning"><?php echo $this->lang->line ( "auto_selected" );?></td>
											<td><select class="form-control" name="select">
													<option value="yes"><?php echo $this->lang->line ( "yes" );?></option>
													<option value="no"><?php echo $this->lang->line ( "no" );?></option>
											</select></td>
										</tr>-->
										<tr>
											<td class="warning"><?php echo $this->lang->line ( "enter_icon_code" );?></td>
											<td><input type="text" name="icon" class="form-control" placeholder="Ex- fa-adjust"></td>
											<td class="warning"><?php echo $this->lang->line ( "icon_code" );?></td>
											<td><a target="_blank" href="<?php echo site_url();?>online/font_awesome" class="btn btn-xs btn-info"><?php echo $this->lang->line ( "click_for_icon_list" );?></a></td>
										</tr>
										<!--<tr>
											<td class="warning"><?php echo $this->lang->line ( "language" );?></td>
											<td><select class="form-control" name="language">
										<?php $all_language=$this->all_language;
										?>
										<?php foreach($all_language as $all_languages){ ?> 
										<option value="<?php echo $all_languages;?>" <?php if($this->dsa_set_language==$all_languages){ echo "selected"; }?>><?php echo $all_languages;?></option>
										<?php }?>
										</select></td>
										</tr>
										-->

									</tbody>
								</table>

							</div>


							<div class="panel-body pn">

								<div class="row box-footer">
									<div class="text-center">

										<button type="submit" class="btn btn-primary"><?php echo $this->lang->line ( "submit" );?></button>
										<button type="reset" class="btn btn-danger"><?php echo $this->lang->line ( "reset" );?></button>

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