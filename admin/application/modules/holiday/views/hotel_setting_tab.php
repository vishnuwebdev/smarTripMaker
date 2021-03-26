<ul class="nav nav-tabs nav-justified mt-20 mb-20 tabs-dark">
	<li role="presentation" <?php if($bp_active_tab=="hotel_type"){?>class="active"<?php }?>><a href="<?php echo site_url().$this->uri->segment ( "1" );?>/hotel_type"><?php echo $this->lang->line ( "hotel_type" );?></a></li>
	<li role="presentation" <?php if($bp_active_tab=="hotel_amenity"){?>class="active"<?php }?>><a href="<?php echo site_url().$this->uri->segment ( "1" );?>/hotel_amenity"><?php echo $this->lang->line ( "hotel_amenity" );?></a></li>
	<li role="presentation" <?php if($bp_active_tab=="room_type"){?>class="active"<?php }?>><a href="<?php echo site_url().$this->uri->segment ( "1" );?>/room_type"><?php echo $this->lang->line ( "room_type" );?></a></li>
	<li role="presentation" <?php if($bp_active_tab=="room_amenity"){?>class="active"<?php }?>><a href="<?php echo site_url().$this->uri->segment ( "1" );?>/room_amenity"><?php echo $this->lang->line ( "room_amenity" );?></a></li>
</ul>