<?php $this->view('simple_layout/header'); ?>
<?php $this->view('simple_layout/leftSidebar'); ?>
<section id="content">
	<div class="page page-forms-validate">
		<div class="pageheader">
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li><a href="<?php echo site_url();?>"><i class="fa fa-home"></i> <?php echo $this->lang->line ( "dashbord" );?></a></li>
					<li><a href="<?php echo site_url($this->uri->segment("1"));?>"></i> <?php echo $this->lang->line ( "holiday" );?></a></li>
					<li><a></i><?php echo $this->lang->line ( "edit_hotel_amenity" );?> </a></li>
				</ul>
			</div>
		</div>
		<!-- row -->
		<div class="row">
			<!-- col -->
			<div class="col-md-12">
				<!-- tile -->
				<a href="<?php echo site_url().$this->uri->segment ( '1' ) ;?>/hotel_amenity" class="btn btn-greensea btn-ef btn-ef-7 btn-ef-7h mb-10 pull-right"><i class="fa fa-list"></i> <?php echo $this->lang->line ( "hotel_amenity_list" );?></a>
				<div class="clearfix"></div>
				<section class="tile bp_shadow">
					<!-- tile header -->
					<div class="tile-header dvd dvd-btm">
						<h1 class="custom-font">
							 <strong> <?php echo $this->lang->line ( "edit_hotel_amenity" );?> </strong>
						</h1>
					</div>
					<!-- /tile header -->
					<form class="form-horizontal" role="form" action="" method="post" id="add_hotel_amenity" enctype="multipart/form-data">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
						<div class="panel panel-info">
							<div class="panel-heading">
								<div class="panel-title hidden-xs"><?php echo $this->lang->line ( "hotel_amenity" );?> </div>
							</div>
							<div class="panel-body pn">
								<br>
								<table class="table table-bordered bp_table_td">
									<tbody>
										<tr>
											<td class="warning"><?php echo $this->lang->line ( "hotel_amenity" );?>*</td>
											<td><input type="text" name="name" class="form-control" placeholder="Enter Hotel Type" value="<?php echo $result->hohex_name?>"></td>
											<td class="warning"><?php echo $this->lang->line ( "status" );?></td>
											<td><select class="form-control" name="status">
													<option value="active" <?php if($result->hohex_status == "active"){echo "selected";}?>><?php echo $this->lang->line ( "active" );?></option>
													<option value="inactive" <?php if($result->hohex_status == "inactive"){echo "selected";}?>><?php echo $this->lang->line ( "inactive" );?></option>
											</select></td>
										</tr>
										<tr>
											<td class="warning"><?php echo $this->lang->line ( "enter_icon_code" );?></td>
											<td><input type="text" name="icon" class="form-control" placeholder="Ex- fa-adjust" value="<?php echo $result->hohex_icon?>"></td>
											<td class="warning"><?php echo $this->lang->line ( "icon_code" );?></td>
											<td><a target="_blank" href="<?php echo site_url();?>online/font_awesome" class="btn btn-xs btn-info"><?php echo $this->lang->line ( "click_for_icon_list" );?></a></td>
										</tr>
										<tr>
											<td class="warning"><?php echo $this->lang->line ( "language" );?></td>
											<td><select class="form-control" name="language">
										<?php $all_language=$this->all_language;
										?>
										<?php foreach($all_language as $all_languages){ ?> 
										<option value="<?php echo $all_languages;?>" <?php if($result->hohex_language==$all_languages){ echo "selected"; }?>><?php echo $all_languages;?></option>
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