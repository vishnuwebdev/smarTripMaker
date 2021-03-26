<?php $this->view('simple_layout/header'); ?>
<?php $this->view('simple_layout/leftSidebar'); ?>
<section id="content">
	<div class="page page-forms-validate">
		<div class="pageheader">
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li><a href="<?php echo site_url();?>"><i class="fa fa-home"></i> <?php echo $this->lang->line ( "dashbord" );?></a></li>
					<li><a href="<?php echo site_url($this->uri->segment("1"));?>"></i> <?php echo $this->lang->line ( "holiday" );?></a></li>
					<li><a></i><?php echo $this->lang->line ( "edit_category" );?> </a></li>
				</ul>
			</div>
		</div>
		<!-- row -->
		<div class="row">
			<!-- col -->
			<div class="col-md-12">
				<!-- tile -->
				<section class="tile bp_shadow">
					<!-- tile header -->
					<div class="tile-header dvd dvd-btm">
						<h1 class="custom-font">
							 <strong> <?php echo $this->lang->line ( "edit_category" );?> </strong>
						</h1>
					</div>
					<!-- /tile header -->
					<form class="form-horizontal" role="form" action="" method="post" id="add_new_category" enctype="multipart/form-data">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
						<div class="panel panel-info">
							<div class="panel-heading">
								<div class="panel-title hidden-xs"><?php echo $this->lang->line ( "category_detail" );?></div>
							</div>
							<div class="panel-body pn">
								<br>
								<table class="table table-bordered bp_table_td">
									<tbody>
										<tr>
											<td class="warning"><?php echo $this->lang->line ( "category_name" );?>*</td>
											<td><input type="text" name="name" class="form-control" placeholder="Enter Category Name" required value="<?php echo $result->holcat_name; ?>"></td>
											<!--
											<td class="warning"><?php echo $this->lang->line ( "start_price" );?></td>
											<td><input type="text" name="start_price" class="form-control" placeholder="category Start Price" value="<?php echo $result->holcat_start_price; ?>"></td>
											-->
										</tr>
										<tr>
											<td class="warning"><?php echo $this->lang->line ( "status" );?></td>
											<td><select class="form-control" name="status">
													<option value="active" <?php if($result->holcat_status == "active"){echo "selected";}?>><?php echo $this->lang->line ( "active" );?></option>
													<option value="inactive" <?php if($result->holcat_status == "inactive"){echo "selected";}?>><?php echo $this->lang->line ( "inactive" );?></option>
											</select></td>
											<!--
											<td class="warning"><?php echo $this->lang->line ( "feature_image" );?></td>
											<td><input type="file" name="userfile" class="form-control">
											   <input type="hidden" name="holcat_image" value="<?php echo $result->holcat_image; ?>">
											    <div class="pull-left thumb" style="width:80px;">
                                                            <img class="media-object thumbscl" src="<?php echo site_url();?>assets/img/holiday/thumbs/<?php echo $result->holcat_image; ?>" alt="<?php echo $result->holcat_name; ?>">
                                                        </div>
											</td>
											-->
										</tr>
										<!--<tr>
											<td class="warning"><?php echo $this->lang->line ( "language" );?></td>
											<td><select class="form-control" name="language">
										<?php $all_language=$this->all_language;
										?>
										<?php foreach($all_language as $all_languages){ ?> 
										<option value="<?php echo $all_languages;?>" <?php if($result->holcat_language==$all_languages){ echo "selected"; }?>><?php echo $all_languages;?></option>
										<?php }?>
										</select></td>
										
										<td class="warning"><?php echo $this->lang->line ( "order" );?></td>
											<td><input type="text" name="order" value="<?php echo $result->holcat_order;?>" class="form-control"></td>
											
										</tr>-->
									</tbody>
								</table>
							</div>
							<div class="panel-body pn">

								<div class="row box-footer">
									<div class="text-center">
										<button type="submit" class="btn btn-primary">Update</button>
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