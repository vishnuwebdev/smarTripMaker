<?php $this->load->view('include/head') ?>
<?php $this->load->view('include/header') ?>








<!-- Today’s Popular Destinations -->
<section class="popular-destination pt-2 pb-2 pt-md-4 pb-md-4">
	<div class="container">
		<h2 class="heading-2">Blogs</h2>
		<div class="pop-crasouel owl-carousel">
		
		<?php if(!empty($blogs))
			{ foreach ($blogs as $Key => $blog_list)
			{?>
		
			<div class="item">
				<div class="popl-dest">
					<div class="popl-dest-img">
						<a href="<?php echo site_url() ?>blog/blogdetail/<?php echo $blog_list->b_link; ?>" class="d-block">
							<img src="<?php echo site_url(); ?>/admin/assets/img/blog/<?php echo $blog_list->b_image; ?>" alt="<?php echo $blog_list->b_title; ?>">
						</a>
					</div>
					<div class="popl-dest-desc">
						<h4>
							<a href="<?php echo site_url() ?>blog/blogdetail/<?php echo $blog_list->b_link; ?>" class="d-block">
								<?php echo $blog_list->b_title; ?>
							</a>
						</h4>
						<p><?php echo $blog_list->b_meta_description; ?></p>
					</div>
				
				</div>
			</div>
			
			<?php } }?>	
			
		
		</div>
	</div>
</section><!--./ Today’s Popular Destinations -->







<!-- Today’s Top Packages end -->
<?php $this->load->view('include/footer') ?>
<?php $this->load->view('front/js') ?>






