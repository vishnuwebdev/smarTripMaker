<ul class="nav nav-tabs nav-justified mt-20 mb-20 tabs-dark">
	<li role="presentation" <?php if($bp_active_tab=="payment_mode"){?>class="active"<?php }?>><a href="<?php echo site_url().$this->uri->segment ( "1" );?>/payment_mode"><?php echo $this->lang->line ( "payment_mode" );?></a></li>
	<li role="presentation" <?php if($bp_active_tab=="contact_detail"){?>class="active"<?php }?>><a href="<?php echo site_url().$this->uri->segment ( "1" );?>/contact_detail"><?php echo $this->lang->line ( "contact_detail" );?></a></li>
	<li role="presentation" <?php if($bp_active_tab=="meal"){?>class="active"<?php }?>><a href="<?php echo site_url().$this->uri->segment ( "1" );?>/meal"><?php echo $this->lang->line ( "meal" );?></a></li>
	
</ul>