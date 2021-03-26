
<?php $this->view('simple_layout/header'); ?>
<?php $this->view('simple_layout/leftSidebar'); ?>					
<!-- /tile header -->


<section id="content" class="animated fadeIn">
<div class="pageheader">
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li><a href="<?php echo site_url(); ?>"><i class="fa fa-home"></i>
                            <?php echo $this->lang->line("dashboard"); ?></a></li>
                    <li><a href="<?php echo site_url($this->uri->segment("1")); ?>"></i><?php echo $this->lang->line("holiday"); ?>
                            <?php echo $this->lang->line("coupon"); ?></a></li>
                </ul>
            </div>
        </div>

	<div class="tile-header dvd dvd-btm">
		<h1 class="custom-font">
			<strong>Add Promotion Text</strong>
			
					<a href="<?php echo site_url() ?>sitesetting/prom_text" class="btn btn-greensea btn-ef btn-ef-7 btn-ef-7h pull-right"><i class="fa fa-list"></i> Text List</a>
		</h1>
	</div>

	<div class="panel panel-visible" id="spy3">
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
			<div class="panel-body">
            
            <section class="tile bp_shadow">
            <form class="form-horizontal" role="form" action="" method="post" id="" enctype="multipart/form-data">
         	<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
			 <div class="tile-body">
							
							<div class="form-group">
								<label class="col-sm-2 control-label">Title:</label>
								<div class="col-sm-9">
									<div class="input text">
									        <input type="text" name="title" value="" placeholder="Text Title" class="form-control">
									</div>
								</div>
							</div>
						
							<div class="form-group">
								<label class="col-sm-2 control-label">Detail:</label>
								<div class="col-sm-9">
									<div class="input text">
									        <textarea name="detail" class="form-control"></textarea>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Status:</label>
								<div class="col-sm-9">
									<div class="input text">
									        <select name="status" class="form-control">
									           <option value="active" >Active</option>
									           <option value="inactive">Inactive</option>
									        </select>
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-2 control-label">Status:</label>
								<div class="col-sm-9">
									<div class="input text">
									        <select name="position" class="form-control">
									           <option value="left" >Left</option>
									           <option value="Right">Right</option>
									        </select>
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-2 control-label"></label>
								<div class="col-sm-9">
									<div class="submit">
										<input type="submit" class="btn btn-success" value="Update">
									</div>
								</div>
							</div>

							
							
							
					</div>
					<!-- /tile body -->
					
					<!-- /tile body -->
					<!-- tile footer -->
					
					<!-- /tile footer -->
					</form>
				</section>
                      
		</div>
	</div>


</section>
<!--/ CONTENT -->

<?php $this->load->view("simple_layout/footer");?>
 
  <script src="<?php echo site_url();?>assets/vendor/ckeditor/ckeditor.js"></script>	
<script>
var editor=CKEDITOR.replace( 'detaila' ,{height: 300});
</script>
<?php $this->load->view("holiday/js");?>
<script>
$(".bp_package_name").keyup(function(){
	var bp_package_name=$(this).val();
	//var bp_package_slug=bp_package_name.replaceAll(" ","-");
	$(".bp_package_slug").val(bp_package_name);
});
</script>