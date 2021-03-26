<?php $this->load->view('header'); ?>
   <!-- <div class="page-header page-title-left mini">
            <div class="container">
                <div class="col-md-12">
                    <h1 class="title">News</h1>
                    <ul class="breadcrumb">
                        <li>
                            <a href="<?php echo site_url(); ?>">Home</a>
                        </li>
                        <li class="active">News</li>
                    </ul>
                </div>
            </div>
    </div>-->
	
<style>
.package-wrap .post-image img {
    width: 100%;
    max-width: 100%;
    height: 150px;
    object-fit: cover;
}
.package-wrap .packe-col {
    padding: 15px;
    min-height: 149px;
}
.package-wrap {
    background: #fff;
    box-shadow: 0 0 3px rgba(0, 0, 0, 0.3);
    margin-bottom: 30px;
}

.package-wrap .packe-col h2 {
    margin: 0;
    margin-bottom: 9px;
    font-size: 19px;
    font-weight: 600;
}
.post-meta .time {
    padding: 5px 0px;
    color: #ea4520;
    display: block;
}
</style>	
	
		<div class="page-header page-title-left mini">
            <div class="container">
                <div class="col-md-12">
				<div class="col-md-9">
				   <h4>Blog</h4>
						
				</div>

                </div>
            </div>
</div>

	
	<div class="container">
                <div class="row">
				
				
                       <?php
						//PrintArray($result);die;
if ($result != 0) {
									$i = 1;
									foreach ( $result as $bp ) {				
										?>
										
						
						
						<div class="col-md-4">
				       
					    <div class="package-wrap">				
										
                        <div class="post-item">
                            <div class="post-image ">
								
                                <img src="<?php echo site_url();?>admin/assets/img/blog/<?php echo $bp->b_image;?>" alt=""  title="" />
								
                            </div>
							<div class="packe-col">
												<div class="blog-list-details">
													<h2 class="post-title">
														 <a href="<?php echo site_url("blog-detail/".$bp->b_link); ?>"><?php echo $bp->b_title;?></a>
													</h2>
												</div>
												<div class="post-meta"> 
													<span class="time">
														<i class="fa fa-calendar"></i>
														<?php echo date_format(date_create($bp->b_update_date),"d M Y");?>												</span> 
												</div>
												<div class="post-meta"> 
													<p><?php echo $bp->b_detail;?></p>
												</div>
							</div>
                           
                          
                           
                        </div>
						      </div>
				
					    
				</div>
                        <?php } } else { ?>
						<div>
						Data Not Found
						</div>
						<?php } ?>
              
            
 </div>
 </div>
<?php $this->load->view('footer'); ?>