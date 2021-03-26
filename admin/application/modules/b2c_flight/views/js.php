<script src="<?php echo site_url();?>assets/vendor/plugins/jquery_validation/dist/jquery.validate.js"></script>

<script>
$("#add_discount").validate({
	  rules: {
		  domestic: {
              required : true,
              number : true,
              maxlength: 2
		  },
		  international : {
              required : true,
              number : true,
              maxlength: 2
		  },
		  
	  },
	  messages:{
		  domestic : {
              required : "Please enter Domestic percentage",
              number : "Please enter valid percentage"
		  },
		  international : {
			  required : "Please enter International percentage",
              number : "Please enter valid percentage"
		  },
	  }
		});
</script>

<script>
$(".type_all_airline").change(function(){
	if($(this).val()=="all"){
       $(".hide_1").hide();
       $(".hide_2").hide();
	}else{
		 $(".hide_1").show();
	     $(".hide_2").show();
	}
});
</script>




<link rel="stylesheet" type="text/css"
	href="<?php echo site_url();?>assets/vendor/plugins/jquery_ui/jquery-ui.min.css">
<script type="text/javascript"
	src="<?php echo site_url();?>assets/vendor/plugins/jquery_ui/jquery-ui.min.js"></script>
<script>
var intDomAirports= [<?php foreach ( $result as $bp ) {echo '"'.$bp->airline_name.','.$bp->airline_code.'",';} ?>];
$( "#airport" ).autocomplete({
	source: intDomAirports,
	open: function() { 
      $('#from_oneway').autocomplete("widget").width(300),
      $(".ui-autocomplete").css({"max-height": 250,"overflow":"scroll","overflow-x": "hidden","width":301});
      $(".ui-menu").css({"font-size": 13});	
      $('.ui-autocomplete').off('menufocus hover mouseover mouseenter'); 
  },
});
</script>



