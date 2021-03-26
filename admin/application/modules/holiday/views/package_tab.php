<?php $this->view('simple_layout/header'); ?>
<?php $this->view('simple_layout/leftSidebar'); ?>
<section id="content">
	<div class="page page-forms-validate">
		<div class="pageheader">
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li><a href="<?php echo site_url();?>"><i class="fa fa-home"></i> <?php echo $this->lang->line ( "dashboard" );?></a></li>
					<li><a href="<?php echo site_url($this->uri->segment("1"));?>"></i> <?php echo $this->lang->line ( "holiday" );?></a></li>
					<li><a></i> <?php echo $this->lang->line ( "edit_package" );?> <b>(<?php echo $result->holiday_name;?>)</b></a></li>
				</ul>
			</div>
		</div>
		<!-- row -->
		<div class="row">
			<!-- col -->
			<div class="col-md-12">
				<!-- tile -->
				<a href="<?php echo site_url();?>holiday/add_package" class="btn btn-greensea btn-ef btn-ef-7 btn-ef-7h mb-10 pull-right"><i class="fa fa-plus"></i> <?php echo $this->lang->line ( "add_package" );?></a>
				<a href="<?php echo site_url().$this->uri->segment("1");?>" class="btn btn-greensea btn-ef btn-ef-7 btn-ef-7h mb-10 pull-right mr-10"><i class="fa fa-list"></i> <?php echo $this->lang->line ( "package_list" );?></a>
				<div class="clearfix"></div>
				<section class="tile bp_shadow">
					<!-- tile header -->
<ul class="nav nav-tabs nav-justified tabs-dark">
	<li role="presentation" <?php if($bp_active_tab=="edit_package"){?>class="active"<?php }?>><a href="<?php echo site_url().$this->uri->segment ( "1" );?>/edit_package_detail/?ref_id=<?php echo url_encode($id); ?>"><?php echo $this->lang->line ( "basic" );?></a></li>
	<li role="presentation" <?php if($bp_active_tab=="inclusion_exclusion"){?>class="active"<?php }?>><a href="<?php echo site_url().$this->uri->segment ( "1" );?>/inclusion_exclusion/?ref_id=<?php echo url_encode($id); ?>"><?php echo $this->lang->line ( "inclusion" );?>/<?php echo $this->lang->line ( "exclusion" );?></a></li>
	 <li role="presentation" <?php if($bp_active_tab=="package_extra"){?>class="active"<?php }?>><a href="<?php echo site_url().$this->uri->segment ( "1" );?>/tour_extra/?ref_id=<?php echo url_encode($id); ?>"><?php echo $this->lang->line ( "tour_extra" );?></a></li> 
	<li role="presentation" <?php if($bp_active_tab=="package_itinerary"){?>class="active"<?php }?>><a href="<?php echo site_url().$this->uri->segment ( "1" );?>/tour_itinerary/?ref_id=<?php echo url_encode($id); ?>"><?php echo $this->lang->line ( "tour_itinerary" );?></a></li>
	<li role="presentation" <?php if($bp_active_tab=="tour_image"){?>class="active"<?php }?>><a href="<?php echo site_url().$this->uri->segment ( "1" );?>/tour_images/?ref_id=<?php echo url_encode($id); ?>"><?php echo $this->lang->line ( "tour_images" );?></a></li>
	
</ul>