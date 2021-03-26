$(document).ready(function() {
  $('.radio-flght li label').on('click', function(){
    $(this).parent().addClass('active');
    $(this).parent().siblings('').removeClass('active');
  });

  // Multicity
  var max_fields = 2;
  var wrapper = $(".pickup_fields_wrap");
  var add_button = $(".add_pickup_more");
  var x = 0;
  $(add_button).click(function (e) {
    e.preventDefault();
    if (x < max_fields) {
       x++;
       $(".flght-multi-" + x).css('display', 'flex');
    }
  });
  $(wrapper).on("click", ".remove_field", function (e) {
     e.preventDefault();
       $(this).parents().eq(1).hide();
       resetTheOrder_pickup();
       x--;
   })
   function resetTheOrder_pickup() {
       $.each($(".inputpickpoint"), function (index, value) {
           $(this).attr("name", 'pickup_loc[' + index + '][pickup_point]')
       });
   }
// Multicity End

// $('#gst-details').hide();
// $("#gst-airline input").click(function() {
	
    // if($(this).is(":checked")) {
        // $('#gst-details').slideDown();
    // } else {
      // $('#gst-details').slideUp();
    // }
// });
var $txt = $('.hld-prc');
var divWords = $txt.text().split(/\s+/);
$txt.empty();
$.each(divWords, function(i,w){
  $('<span/>').text(w).appendTo($txt);
});

// Hotel Room Start here
$(".bp_room_select").click(function (){
   $(".hotelguestsdetails").show();
});
$(".bp_room_select").change(function (){
   $(".hotelguestsdetails").show();
  var bp_no_rooms = $(this).val();//this.value;
  var bp_room_data = "";
  // console.log(bp_no_rooms);
  // console.log(156);
  for(var i = 1; i <= bp_no_rooms; i++){
    bp_room_data += '<div class="roombox mt-3">\
                         <span class="d-block rmttl fwd mb-1">Room '+i+':</span>\
                         <div class="roomchildbox border-top pt-2">\
                           <div class="row mb-2">\
                              <div class="col-sm-6">\
                                <label class="">Adult(12+ Yrs)</label>\
                                  <select name="adult_'+i+'" id="adult_'+i+'" class="form-control custom-select">\
                                    <option value="1">1 Adult</option>\
                                    <option value="2">2 Adults</option>\
                                    <option value="3">3 Adults</option>\
                                    <option value="4">4 Adults</option>\
									<option value="5">5 Adults</option>\
                                    <option value="6">6 Adults</option>\
                                    <option value="7">7 Adults</option>\
                                    <option value="8">8 Adults</option>\
                                  </select>\
                              </div>\
                              <div class="col-sm-6">\
                                 <label>Child(2-11 Yrs)</label>\
                                 <select name="child_'+i+'" id="child_'+i+'" class="form-control custom-select" onchange="return bp_child_age(this.value,'+i+');">\
                                    <option value="">0 Child</option>\
                                    <option value="1">1 Child</option>\
                                    <option value="2">2 Children</option>\
                                 </select>\
                              </div>\
                           </div>\
                        <div class="clearfix"></div>\
                        <div id="bp_for_child_dob_'+i+'"></div>\
                        </div>\
                      </div>';    
    }
  $(".bp_room_data").html(bp_room_data);
  });

// Hotel Room Start end

  $('.trvl-tgl').on('click', function(e) {
    $('.traveller-com').slideToggle();
     e.stopPropagation();
  });
   $('.traveller-com').click(function(e){
    e.stopPropagation();
   });
   $(document).click(function(){
      $(".traveller-com").hide();
  });

  $('.searchenginehoteldone, .searchenginehoteldone').on('click', function (){
    $('.traveller-com, .hotelguestsdetails').hide();
  });
  $('.retrun-flt').css('opacity', '0.7');
  $('.radio-flght #round-rad label').on('click', function() {
    $('.retrun-flt').css('opacity', '1');
	 $('#search_type').val('Return');
	  $('#round-trip').attr("checked", true);
	  // $('#one-way').prop("checked", false);
    // $('.retrun-flt .form-control').removeAttr('disabled');
  });
  $('.radio-flght #one-way-rad label').on('click', function() {
    $('.retrun-flt').css('opacity', '0.7');
	$('#search_type').val('OneWay');
    // $('.retrun-flt .form-control').attr('disabled', 'disabled');
  });

  $('.radio-flght li .flght-rad').click(function(){
    $('#multi-flght').hide();
    $('#oneway-flght').show();
  });
  $('.radio-flght li .flght-multi-rad').click(function(){
    $('#oneway-flght').hide();
    $('#multi-flght').show();
  });
//on returndate click
$('#return_date').click(function() {
	  $('.retrun-flt').css('opacity', '1');
	  $('#search_type').val("Return");
	  $('#round-trip').prop("checked", true);
	  $('#round-rad').addClass('active');
	$('#one-way-rad').removeClass('active');

	 // $('#flght-multi-rad').removeClass('active');
	});

//

  $('.fl-foot li a.fl-dts').on('click',  function() {
    $(this).closest('.fl-foot').next('.flt-details-wrap').slideToggle();
  });
  // homepage slider
  $('.homepage-carousel').owlCarousel({
      nav:false,
      singleItem:true,
      items:1,
      loop:true,
      navText:['<i class="icofont-arrow-left"></i>','<i class="icofont-arrow-right"></i>'],
      dots:false,
      autoplay:true,
      autoplayTimeout:2500,
      autoplayHoverPause:true
  })

  // hotel booking slider
  $('.hotel-carousel').owlCarousel({
      nav:true,
      singleItem:true,
      items:1,
      autoHeight:true,
      navText:['<i class="icofont-arrow-left"></i>','<i class="icofont-arrow-right"></i>'],
      dots:false
  });

  $('.pop-crasouel').owlCarousel({
    loop:true,
    margin:20,
    nav:true,
    navText:['<i class="icofont-arrow-left"></i>','<i class="icofont-arrow-right"></i>'],
    responsiveClass:true,
    autoplay:false,
    autoplayTimeout:3500,
    autoplayHoverPause:true,
    responsive:{
        0:{
            items:1,
            nav:true
        },
        600:{
            items:2,
            nav:false
        },
        1000:{
            items:3,
            nav:true,
            loop:false
        }
    }
});
  
$('.td-top-crasouel').owlCarousel({
    loop:true,
    margin:20,
    nav:true,
    navText:['<i class="icofont-arrow-left"></i>','<i class="icofont-arrow-right"></i>'],
    responsiveClass:true,
    autoplay:false,
    autoplayTimeout:3500,
    autoplayHoverPause:true,
    responsive:{
        0:{
            items:1,
            nav:true
        },
        600:{
            items:2,
            nav:false
        },
        1000:{
            items:3,
            nav:true,
            loop:false
        }
    }
});

  

  // $('select').niceSelect();

  $('.traveller-wrap-col .dropdown-toggle-tra').on('click', function() {
      $('.dropdown-menu-nav').toggle();
  });

  var url = window.location.href;
  $('.user-sidebar ul li a[href="'+url+'"]').parent().addClass('active');

  var hre = window.location.href;
  $('.main-navbar ul li a[href="'+hre+'"]').addClass('active');

  $('.searchenginehoteldone').on('click', function() {
     $('.dropdown-menu-nav').hide(); 
  });


  $(".datepicker-cl").datepicker({
	  numberOfMonths: 1,
	  dayNamesMin: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
	  showButtonPanel: true,
	  minDate: 0,
    showOn: 'both',
    buttonText: '',
    dateFormat: 'dd-mm-yy',
      beforeShow: function() 
        {
           $('#ui-datepicker-div').addClass("searchdatepicker");
           $('#depart_date_on_mobile').attr("name","");
        },
      onClose: function (selectedDate)
        {
          $("#bp_check_out_date").datepicker("option", "minDate", selectedDate);
        }
	});

  // Change HNF & SNF Test
  
   $(".htl-booking-side .snf_hnf").click (function () {
    if ($(this).text() == "SNF") {
        $(this).text("HNF");
    }
    else {
         $(this).text("SNF");        
    }
});

$('#flght-stops-num li label input, #flt-depart-tm  li label input').click(function() {
    $(this.parentNode).toggleClass('active', this.checked);
});
$('#flght-stops-num_ret li label input').click(function() {
    $(this.parentNode).toggleClass('active', this.checked);
});

$('#airline-brands li label input').click(function() {
    $(this.parentNode).toggleClass('active', this.checked);
});
$('#airline-brands_ret li label input').click(function() {
    $(this.parentNode).toggleClass('active', this.checked);
});




  // Filter open
$('#filter_btn').click(function(){
    if ($('#sidebar-flght').is(':hidden')) {
       
       $('#sidebar-flght').show('slide',{direction:'left'});
       $("#sidebar-flght").addClass("position");
       $('#contant_hide_on_filter').hide();
    } else {
       $('#sidebar-flght').hide('slide',{direction:'left'});
    }
});
$('#filter_click_submit').click(function(){
     $('#sidebar-flght').hide('slide',{direction:'left'});
     $('#contant_hide_on_filter').show();
});
});