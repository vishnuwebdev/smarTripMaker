<?php $this->load->view('include/head') ?>
<?php $this->load->view('include/header') ?>

<?php $data['active_tab'] = "hotel";?>
<section class="slider-search-wrap position-relative">
<!-- slider start from here -->
<?php
       if(empty($this->uri->segment('1')))
    {
      $active_tab = "flight";
    } else {
      $active_tab = $this->uri->segment('1');
    }
          
?>
  <!-- search section start from here -->
  <div class="search-wrapper">
    <div class="container">
      <div class="search-tabbar">
        <div class="search-buttons-col pb-3">
          <ul class="nav nav-tabs">
            <li class="nav-item">
              <a class="nav-link <?php if($active_tab=="flight") { echo "active";} ?>" href="<?php echo site_url();?>">
                <i class="icofont-ui-flight"></i> <span>Flight</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php if($active_tab=="hotel") { echo "active";} ?>"  href="<?php echo site_url('hotel')?>">
                <i class="icofont-hotel"></i>
                <span>Hotel</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php if($active_tab=="holiday") { echo "active";} ?>" href="<?php echo site_url();?>holiday">
                <i class="icofont-beach-bed"></i>
                <span>Holiday</span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link <?php if($active_tab=="visa") { echo "active";} ?>" href="<?php echo site_url();?>visa">
              <i class="icofont-visa-alt"></i>
                <span>Visa</span>
              </a>
            </li>


          </ul>
        </div>
        <div class="search-tabbar-wrap">
          <div class="tab-content">
          <div class="tab-pane <?php if($active_tab=="visa") { echo "in active";} ?>" id="hotel-tab">
              <?php $this->load->view("visa/visa_search");?>
              </div>
            
          </div>
        </div>
      </div>
    </div>
  </div><!--/ search section end from here -->

  <!-- slider section start from here -->
  <div class="slider-wrap">
    <div class="owl-carousel homepage-carousel">
      <?php if(!empty($sliderimg)){ foreach($sliderimg as $slider_data){ ?>
        <div class="item">
          <img src="<?php echo site_url(); ?>admin/assets/img/slider/main/<?php echo $slider_data->sliimg_image ?>" alt="<?php echo $slider_data->sliimg_title; ?>">
        </div>
      <?php } } else{ ?>
        <div class="item">
          <img src="assets/images/slider-02.jpg" alt="slider-02">
        </div>
      <?php }?>
    </div>
  </div>

</section>

 <!-- slider section end from here -->
<!-- our facilities -->
<section class="our-facilities">
  <div class="container">
    <div class="facilit-col">
      <div class="row">
        <div class="col-md-6">
          <div class="our-facilitie-col">
            <i class="icofont-check-circled"></i>
            <span class="facility-text">Over a Million Flights Hotels & Packages.</span>
          </div>
        </div>
        <div class="col-md-6">
          <div class="our-facilitie-col">
            <i class="icofont-check-circled"></i>
            <span class="facility-text">No Cancellation Fee to Change or Cancel Almost any Hotel Reservation.</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section><!--/ our facilities end -->

<?php if(!empty($package1)){ ?>
<!-- Today???s Popular Destinations -->
<section class="popular-destination pt-2 pb-2 pt-md-4 pb-md-4">
  <div class="container">
    <h2 class="heading-2"><?php echo $category1?></h2>
    <div class="pop-crasouel owl-carousel">
    <?php  foreach ($package1 as $Key => $pckg) {?>
      <div class="item">
        <div class="popl-dest">
          <div class="popl-dest-img">
            <a href="<?php echo site_url() ?>holiday/holidaydetail/<?php echo $pckg->holiday_slug; ?>" class="d-block">
              <img src="<?php echo site_url(); ?>/admin/assets/img/holiday/main/<?php echo $pckg->holiday_feature_image; ?>" alt="<?php echo $pckg->holiday_name; ?>">
            </a>
          </div>
          <div class="popl-dest-desc">
            <a href="<?php echo site_url() ?>holiday/holidaydetail/<?php echo $pckg->holiday_slug; ?>" class="d-block">
            <h4>
              <?php echo $pckg->holiday_name; ?>
            </h4>
            <p><?php echo $pckg->holiday_short_description; ?></p>
            </a>
          </div>
        </div>
      </div>
      <?php } ?> 
    </div>
  </div>
</section><!--./ Today???s Popular Destinations -->
<?php } ?> 

<?php if(!empty($blogs)){ ?>
<!---BLOG-->
<section class="today-top-packages pt-2 pb-2 pt-md-5 pb-md-5">
  <div class="container">
    <h2 class="heading-2">Blogs</h2>
    <div class="td-top-crasouel owl-carousel">
    <?php foreach ($blogs as $Key => $blog_list) {?>   
      <div class="item">
        <a href="<?php echo site_url() ?>blog/blogdetail/<?php echo $blog_list->b_link; ?>" class="d-block">
          <div class="tdy-pckg">
            <div class="tdy-pckg-img">          
              <img src="/admin/assets/img/blog/<?php echo $blog_list->b_image; ?>" alt="<?php echo $blog_list->b_title; ?>">
            </div>
            <div class="tdy-pckg-desc">         
              <h5><?php echo $blog_list->b_title; ?></h5>
              <p class="mb-0">
              <?php echo $blog_list->b_meta_description; ?></span></p>          
            </div>
          </div>
        </a>
      </div>  
      <?php } ?> 
    </div>
  </div>
</section>
<!--------->
<?php } /* ?> 
<section class="today-top-packages pt-2 pb-2 pt-md-5 pb-md-5">
  <div class="container">
  <h2 class="heading-2">FAQ</h2>
<div id="accordion">
  <h3>Section 1</h3>
  <div>
    <p>
    Mauris mauris ante, blandit et, ultrices a, suscipit eget, quam. Integer
    ut neque. Vivamus nisi metus, molestie vel, gravida in, condimentum sit
    amet, nunc. Nam a nibh. Donec suscipit eros. Nam mi. Proin viverra leo ut
    odio. Curabitur malesuada. Vestibulum a velit eu ante scelerisque vulputate.
    </p>
  </div>
  <h3>Section 2</h3>
  <div>
    <p>
    Sed non urna. Donec et ante. Phasellus eu ligula. Vestibulum sit amet
    purus. Vivamus hendrerit, dolor at aliquet laoreet, mauris turpis porttitor
    velit, faucibus interdum tellus libero ac justo. Vivamus non quam. In
    suscipit faucibus urna.
    </p>
  </div>
  <h3>Section 3</h3>
  <div>
    <p>
    Nam enim risus, molestie et, porta ac, aliquam ac, risus. Quisque lobortis.
    Phasellus pellentesque purus in massa. Aenean in pede. Phasellus ac libero
    ac tellus pellentesque semper. Sed ac felis. Sed commodo, magna quis
    lacinia ornare, quam ante aliquam nisi, eu iaculis leo purus venenatis dui.
    </p>
    <ul>
      <li>List item one</li>
      <li>List item two</li>
      <li>List item three</li>
    </ul>
  </div>
  <h3>Section 4</h3>
  <div>
    <p>
    Cras dictum. Pellentesque habitant morbi tristique senectus et netus
    et malesuada fames ac turpis egestas. Vestibulum ante ipsum primis in
    faucibus orci luctus et ultrices posuere cubilia Curae; Aenean lacinia
    mauris vel est.
    </p>
    <p>
    Suspendisse eu nisl. Nullam ut libero. Integer dignissim consequat lectus.
    Class aptent taciti sociosqu ad litora torquent per conubia nostra, per
    inceptos himenaeos.
    </p>
  </div>
</div>
</div>
</section>
*/ ?>
    <!-- Adventure  -->
    <div id="visa_search_popup" class="modal flights-search-popup fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1111" aria-hidden="true">
      <div class="modal-dialog ">       
        <div class="modal-content">         
          <div class="modal-header text-center no-padding">
              <h5 class="w-100">Smart Trip Maker</h5>
            </div>
          <div class="modal-body">
            <div class="text-center">
              <!-- Loader start from here -->
                    <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
                  <!-- Loader end from here -->
                  <h3>
                      <span>Please Wait ...</span>
                      <span>We are searching the visa for you</span>
                  </h3>
                  <div class="destination-wrap">
                    <span class="bp_hotel_search_loaction"></span>
                  </div>
                  <span class="block midfz">Do not refresh or close the Window</span>
                  
            </div>
          </div>          
        </div>
      </div>
    </div>

<!-- Today???s Top Packages end -->
<?php $this->load->view('include/footer') ?>
<?php $this->load->view('hotel/js') ?>


<script>
    $(".visa_search_button").click(function(){
		var data_error=0;
        $(".bp_hotel_search_validation").each(function () {
			if ($(this).val() == "")
			{   data_error=1;
				$(this).css({"border": "2px solid red"});
				window.scroll(0, 0)
			} else
			{
				$(this).css({"border": ""});

			}
		});
		if(data_error == 0){
			$('#visa_search_popup').modal('show'); 
			$("#visa_search_form").submit();
		}else{
			return false;
		}
	});
</script>

<script>
	$(document).ready(function(){
    $( "#accordion" ).accordion();
		$('#select-rating').prop('disabled', 'disabled');
		$("#select-destination").change(function(e) {
			
			var location_id = $(this).val();
			e.preventDefault();
			
			$.ajax({
					type: "POST",
					url: '<?php echo site_url("visa/get_visa_list_by_location_id/");?>',
					dataType: "json",
					data : {
						id: location_id, 
					},
					success: function(response) {	
						if ( response ){
							$('#select-rating').children('option:not(:first)').remove();
							$.each(response,function(i,obj) {
								var div_data="<option value="+obj.id+">"+obj.visa_title+" (<b>Visa Fee : "+obj.visa_amount+"</b>)</option>";
								$(div_data).appendTo('#select-rating'); 
							});  
							$('#select-rating').prop("disabled", false);
						}
						else{
							$('#select-rating').children('option:not(:first)').remove();
							$('#select-rating').prop('disabled', 'disabled');
						}
					}
			});
		});
	});
</script>




