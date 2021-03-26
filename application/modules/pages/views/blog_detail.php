<?php $this->load->view('header'); ?>
<!-- <div class="page-header page-title-left mini">
            <div class="container">
                <div class="col-md-12">
                    <h1 class="title">View News</h1>
                    <ul class="breadcrumb">
                        <li>
                            <a href="<?php echo site_url(); ?>">Home</a>
                        </li>
                        <li class="active">View News</li>
                    </ul>
                </div>
            </div>
    </div>-->
<div class="page-header page-title-left mini">
            <div class="container">
                <div class="col-md-12">
				<div class="col-md-9">
				   <h4>View Blog</h4>
						
				</div>

                </div>
            </div>
</div>
	
		
	
	
	
	
    <div class="container">
				<div class="row">
				<br />
					<div class="col-md-8 col-md-offset-2">
					<h4><?php echo $result->b_title;?></h4>
					 <div class="post-meta">
									<span class="time"><i class="fa fa-calendar"></i> <?php echo date_format(date_create($result->b_update_date),"d M Y");?></span>
									
						</div>
						<hr />
						<div class="post-image opacity"><img src="<?php echo site_url();?>admin/assets/img/blog/<?php echo $result->b_image;?>" width="1170" height="382" alt="<?php echo $result->b_title;?>" title="<?php echo $result->b_title;?>"></div>
						<div class="post-content top-pad-20">
						    <p><?php echo $result->b_detail;?></p>
							
						</div>
					   
					</div>
				
				</div>
				<br />
   </div>
    
	<?php $this->load->view('footer'); ?>