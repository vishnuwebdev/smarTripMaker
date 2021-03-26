<div id="controls">
	<aside id="sidebar">
		<div id="sidebar-wrap">
			<div class="panel-group slim-scroll" role="tablist">
				<div class="panel panel-default">
					<div id="sidebarNav" class="panel-collapse collapse in" role="tabpanel">
						<div class="panel-body meus">
							<ul id="navigation">
                               <li data-price="aaaa" class="refendable11 <?php if($activedata["activemain"] == "dashboard"){ echo "active";} ?>"><a href="<?php echo site_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> <span><?php echo $this->lang->line ( "dashboard" );?></span></a></li>
                               <?php 
                               $dsaStaffmenu = array();
                               if($this->session->userdata("DsaStafflogin") != NULL)
                                 {
                                    $dsastaffdata = dsa_Staff_Data_by_id($this->session->userdata("DsaStafflogin")->dsast_id);
                                    $dsaStaffmenu = explode(",",$dsastaffdata->dsast_permission);
                                 }
                               $allmenu = dsa_menu();
                               $bp_dsa_permission=explode(",",$this->dsa_data->dsa_admin_permission);
                               foreach ($allmenu as $allmenus)
                                 {
                                   if(in_array($allmenus["menu_module_name"], $bp_dsa_permission)) 
                                     {
                                       if($this->session->userdata("DsaStafflogin") != NULL)
                                         {
                                           if(in_array($allmenus["menu_module_name"], $dsaStaffmenu)) 
                                             { 
                          ?>
                                                <li  data-price="<?php echo $allmenus["menu_title"];?>" class="refendable11 <?php if($activedata["activemain"] == $allmenus['menu_active_class']){ echo "active";} ?>"><a role="button" tabindex="0"><i class="fa <?php echo $allmenus['menu_icon']; ?>"></i> <span><?php echo $allmenus["menu_title"];?></span></a>
									                 <ul style="<?php if($activedata["displayblock"]==$allmenus['sub_menu_display_class']){ echo ""; } ?>">
										           <?php 
										              foreach ($allmenus["sub_menu"] as $submenus)
										                { 
										             ?>
                                                          <li class="<?php if($activedata["activeclass"]==$submenus["sub_menu_active_class"]){ echo "active"; } ?>">
                                                              <a href="<?php echo site_url($submenus["sub_menu_link"]); ?>"><i class="fa <?php if(isset($submenus["sub_menu_icon"]) && !empty($submenus["sub_menu_icon"])){ echo $submenus["sub_menu_icon"];}else { echo "fa-caret-right";} ?>"></i>
                                                                 <?php echo $submenus["sub_menu_title"];?>
                                                              </a>
                                                          </li>
                                                            <?php
                                                          } 
                                                             ?>
                                                     </ul>
                                                  </li> 
                                                            <?php 
                                             }
                                         }
                                         else
                                         {
                                         	?>
                                                  <li data-price="<?php echo $allmenus["menu_title"];?>" class="refendable11 <?php if($activedata["activemain"] == $allmenus['menu_active_class']){ echo "active";} ?>"><a role="button" tabindex="0"><i class="fa <?php echo $allmenus['menu_icon']; ?>"></i> <span><?php echo $allmenus["menu_title"];?></span></a>
								                    	<ul style="<?php if($activedata["displayblock"]==$allmenus['sub_menu_display_class']){ echo ""; } ?>">
										                <?php 
										                   foreach ($allmenus["sub_menu"] as $submenus)
										                    { 
										                 ?>
                                                              <li class="<?php if($activedata["activeclass"]==$submenus["sub_menu_active_class"]){ echo "active"; } ?>">
                                                                   <a href="<?php echo site_url($submenus["sub_menu_link"]); ?>"><i class="fa <?php if(isset($submenus["sub_menu_icon"]) && !empty($submenus["sub_menu_icon"])){ echo $submenus["sub_menu_icon"];}else { echo "fa-caret-right";} ?>"></i>
                                                                        <?php echo $submenus["sub_menu_title"];?>
                                                                   </a>
                                                              </li>
                                                          <?php 
										                     } 
										                   ?>
                                                          </ul>
                                                   </li>      
                                                <?php   
                                         } 
                                     }                    
                                 } 
                                 ?>
                                                            
                                                         
					
							</ul>
							<!--/ NAVIGATION Content -->


						</div>
					</div>
				</div>


			</div>

		</div>


	</aside>
	<!--/ SIDEBAR Content -->



</div>
<!--/ CONTROLS Content -->


