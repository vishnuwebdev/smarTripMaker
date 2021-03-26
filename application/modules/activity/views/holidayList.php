    <?php $this->load->view("holidaylayout/header");
    if(null !==$this->input->get()){
       $date = $this->input->get('date');
	   $tour_type = $this->input->get('tour_type');
	   $tour_location = $this->input->get('location');
	    
    }else{
        
        $date = "";
    }
    if(null !==$this->input->get('guest_no')){
       $paxno = $this->input->get('guest_no');
    }else{
        
        $paxno = "";
    }
    
    ?>
	
<div class="container-fluid tourlistfluid pt50 pb50 light-bg">

    <div class="container tourlistcontainer">
	<?php  if(null !=$this->input->get()){ ?>
	<span class="block fz14 dull-color mb10"><?php echo $tour_location ?> on <?php echo $date ?></span>
	<?php }?>
    <div class="row tourlistrow">
      
        <div class="col-sm-4 filtersection">
        <h4 class="resultfound"><i class="fa fa-search sub-color fz14 fwb inline-block"></i>&nbsp;<span class="fwb black-color fz14"><?php echo $total_result ?> Results Found.</span></h4>
        <div class="filtersectionbox">
            <form >
          <div class="clearfix mofifyyoursearch">
            <div class="row">
                <div class="col-sm-12">
                    <div class="clearfix forminputgrabber">
                        <i class="fa fa-map-marker forminputicon"></i>
                        <input type="text" class="input block width-100 border" placeholder="Your Destination" name="location" id="tour_locaton" value="<?php echo $tour_location ?>" required="">
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="clearfix mt15">
                        <select class="select block width-100 border" name="tour_type"  required="">
                            
							<?php foreach ($this->all_sub_category as $allsubcats){ 
							if( $allsubcats->holsubc_id == $tour_type) {
							?>
                            <option value="<?php echo $allsubcats->holsubc_id; ?>" selected><?php echo $allsubcats->holsubc_name; ?></option>
							<?php } }?>
							
                            <option value="">Any</option>
                             <?php foreach ($this->all_sub_category as $allsubcat){ ?>          
                  <option value="<?php echo $allsubcat->holsubc_id; ?>"><?php echo $allsubcat->holsubc_name; ?></option>
                    <?php } ?>
                                           
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="clearfix mt15 forminputgrabber">
                        <label for="date1" class="fa fa-calendar forminputicon"></label>
                        <input type="text" class="input block width-100 border datepicker" placeholder="Date" value="<?php echo $date ?>" name="date" readonly="" id="date1" required="">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="clearfix mt15">
                         <select name="guest_no" class="select block width-100 border" required="">
                          <?php  if(null ==$this->input->get()){ ?>
                             <option value="1" selected>Guest(1)</option>
                          <?php } 
                         else {  ?>        
											<option value="<?php echo $paxno  ?>" selected><?php echo $paxno  ?></option>
                       <?php } ?>     
                                            <?php for($i=1;$i<=50;$i++){ ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                            <?php } ?>

                                       
                                        </select>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="clearfix mt15">
                        <button type="submit" class="btn btn-primary block col-md-12"><i class="fa fa-search"></i> Find Packages</button>
                    </div>
                </div>
            </div>
          </div>
           </form>
        </div>
        <div class="filtersectionbox">
          <span class="filterheading">Price</span>
          <div class="clearifx">
	       <div style="margin: 15px 0px" id = "slider-3"></div> 
     
            <p>
         <label for = "price">Range:</label>
         <input type = "text" id = "price" style = "border:0; color:#b9cd6d; font-weight:bold;">
             </p>
      
		 
          </div>
        </div>

<!--

        <div class="filtersectionbox">
          <span class="filterheading">Tour Duration</span>
          <div class="clearifx">
             <ul class="checkbox-ul">
               <li><input type="checkbox"> <span>2-4 Days</span></li>
               <li><input type="checkbox"> <span>2-4 Days</span></li>
               <li><input type="checkbox"> <span>2-4 Days</span></li>
               <li><input type="checkbox"> <span>2-4 Days</span></li>
             </ul>
          </div>
        </div>
        <div class="filtersectionbox">
          <span class="filterheading">Tour Type</span>
          <div class="clearifx">
             <ul class="checkbox-ul">
               <li><input type="checkbox"> <span>Bus Tour</span></li>
               <li><input type="checkbox"> <span>Avia</span></li>
               <li><input type="checkbox"> <span>Avia=Bus</span></li>
             </ul>
          </div>
        </div>
        <div class="filtersectionbox">
          <span class="filterheading">Continent</span>
          <div class="clearifx">
             <ul class="checkbox-ul">
               <li><input type="checkbox"> <span>Europe</span></li>
               <li><input type="checkbox"> <span>Asia</span></li>
               <li><input type="checkbox"> <span>North America</span></li>
               <li><input type="checkbox"> <span>South America</span></li>
               <li><input type="checkbox"> <span>Africa</span></li>
               <li><input type="checkbox"> <span>australia</span></li>
             </ul>
          </div>
        </div>
-->



      </div>
     
        <div class="col-sm-8 tourlistcol">
          <?php //PrintArray($result);
          //die;  
          if($result !=0){ 
              foreach ($result as $alltours){
              ?>
        <div class="tourlistbox" price="<?php echo $alltours->holiday_start_price; ?>">
          <div class="row">
            <div class="col-sm-4">
              <img src="<?php echo $this->admin_site_url; ?>assets/img/holiday/thumbs/<?php echo $alltours->holiday_feature_image; ?>" alt="img" class="tourthumb">
            </div>
            <div class="col-sm-6">
              <div class="clearfix pt15 pb15">
                <h3 class="tourlistheading"><?php echo $alltours->holiday_name; ?> <small class="block mt5"></small></h3>
                <p class="para"><?php echo word_limiter(strip_tags($alltours->holiday_short_description), 18); ?></p>
                <div class="whatincludes">
<!--                  <i class="fa fa-plane"></i> +
                  <i class="fa fa-bus"></i>
                  Air + Bus-->
                  <span class="packdur">Duration / <?php echo $alltours->holiday_night+1; ?> Days</span>
                </div>
              </div>
            </div>
            <div class="col-sm-2">
              <div class="clearfix pt15 pb15">
                <span class="stars">
                   <?php if ($alltours->holiday_rating > 0) {
                                                  for ($i = 0; $i < $alltours->holiday_rating; $i ++) {
                                                                ?>
                                                                <i class="fa fa-star active"></i>
                                                                <?php
                                                            }
                                                        }
                                                        ?> 
                                        <?php for ($i = 1; $i <= 5 - $alltours->holiday_rating; $i++) { ?>
                                        <i class="fa fa-star"></i>
                                    <?php } ?>
                 
                </span>
                <span class="block fz12">270 Reviews</span>
                <h3 class="sub-color fz18"><?php echo $this->dsa_data->dsa_currency; ?> <?php echo $alltours->holiday_start_price; ?> <small class="block mt5">Per person</small></h3>
                <a href="<?php echo site_url() ?>holiday/holidaydetail/<?php echo $alltours->holiday_slug; ?>?tour_id=<?php echo $alltours->holiday_id; ?>&date=<?php echo $date; ?>&paxno=<?php echo $paxno; ?>" class="button sub-bg white-color hover-main-bg hover-white-color radius">Select</a>
              </div>
            </div>
          </div>
        </div>
              <?php }}else{ ?>
                  
                  <h2 class="text-center"> No any records Founds For this area. </h2>
           <?php   } ?>
        <div class="clearfix">
          <?php echo $this->pagination->create_links();?>
        </div>
      </div>
    </div>
	</div>
</div>


    <?php $this->load->view("holidaylayout/footer"); ?>
<script>
      $('#date1').datepicker('setDate', '1');
    </script>
