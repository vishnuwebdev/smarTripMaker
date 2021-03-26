<?php $this->view('simple_layout/header'); ?>
<?php $this->view('simple_layout/leftSidebar'); ?>
<section id="content">
	<div class="page page-forms-validate">
		<div class="pageheader">
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li><a href="<?php echo site_url();?>"><i class="fa fa-home"></i> <?php echo $this->lang->line ( "dashbord" );?></a></li>
					<li><a href="<?php echo site_url($this->uri->segment("1"));?>"></i> <?php echo $this->lang->line ( "holiday" );?></a></li>
					<li><a></i><?php echo $this->lang->line ( "edit_sub_category" );?> </a></li>
				</ul>
			</div>
		</div>
		<!-- row -->
		<div class="row">
			<!-- col -->
			<div class="col-md-12">
				<!-- tile -->
				<a href="<?php echo site_url();?>holiday/sub_category_list" class="btn btn-greensea btn-ef btn-ef-7 btn-ef-7h mb-10 pull-right"><i class="fa fa-list"></i><?php echo $this->lang->line ( "sub_category_list" );?> </a>
				<div class="clearfix"></div>
				<section class="tile bp_shadow">
					<!-- tile header -->
					<div class="tile-header dvd dvd-btm">
						<h1 class="custom-font">
							 <strong> <?php echo $this->lang->line ( "edit_sub_category" );?>  </strong>
						</h1>
					</div>
					<!-- /tile header -->
					<form class="form-horizontal" role="form" action="" method="post" id="add_new_category" enctype="multipart/form-data">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
						<div class="panel panel-info">
							<div class="panel-heading">
								<div class="panel-title hidden-xs"><?php echo $this->lang->line ( "sub_category_detail" );?> </div>
							</div>
							<div class="panel-body pn">
								<br>
								<table class="table table-bordered bp_table_td">
									<tbody>
										<tr>
											<td class="warning"><?php echo $this->lang->line ( "name" );?>*</td>
											<td><input type="text" name="name" class="form-control" value="<?php echo $result->holsubc_name;?>" placeholder="Enter Category Name" required></td>
											<!--
											<td class="warning"><?php echo $this->lang->line ( "start_price" );?></td>
											<td><input type="text" name="start_price" class="form-control" value="<?php echo $result->holsubc_start_price;?>" placeholder="category Start Price"></td>
											-->
											</tr>
											<tr>
											<td class="warning"><?php echo $this->lang->line ( "status" );?></td>
											<td><select class="form-control" name="status">
													<option value="active" <?php if($result->holsubc_status=="active"){echo "selected";}?>><?php echo $this->lang->line ( "active" );?></option>
													<option value="inactive" <?php if($result->holsubc_status=="inactive"){echo "selected";}?>><?php echo $this->lang->line ( "inactive" );?></option>
											</select></td>
										</tr>
										<tr>
											
											<td class="warning"><?php echo $this->lang->line ( "parent_category" );?></td>
											<td><select class="form-control" name="parent_category">
													<?php if(is_array($category_list)){ foreach($category_list as $bp){
									        if($bp->holcat_status == "active"){
									        	?>
									      <option value="<?php echo $bp->holcat_id;?>" <?php if($result->holsubc_parent_catrgory==$bp->holcat_id){echo "selected";}?>><?php echo $bp->holcat_name;?> </option>
									       <?php } } }?>
											</select></td>
											
											<!--
												<td class="warning"><?php echo $this->lang->line ( "language" );?></td>
											<td><select class="form-control" name="language">
										<?php $all_language=$this->all_language;
										?>
										<?php foreach($all_language as $all_languages){ ?> 
										<option value="<?php echo $all_languages;?>" <?php if($result->holsubc_language==$all_languages){ echo "selected"; }?>><?php echo $all_languages;?></option>
										<?php }?>
										</select></td>
										-->
										</tr>
										<tr>
										
											<td class="warning"><?php echo $this->lang->line ( "feature_image" );?></td>
											<td><input type="file" name="userfile" class="form-control">
											<input type="hidden" name="" value="<?php echo $result->holsubc_image; ?>">
											 <div class="pull-left thumb" style="width:80px;">
                                            <img class="media-object thumbscl" src="<?php echo site_url();?>assets/img/holiday/thumbs/<?php echo $result->holsubc_image; ?>" alt="<?php echo $result->holsubc_name; ?>">
                                                </div>
											</td>
											
										
										</tr>
										<!--
										<tr>
										<td class="warning"><?php echo $this->lang->line ( "order" );?></td>
											<td><input type="text" name="order" value="<?php echo $result->holsubc_order;?>" class="form-control"></td>
										</tr>
										-->
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