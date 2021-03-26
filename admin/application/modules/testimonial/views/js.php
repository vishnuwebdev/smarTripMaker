<script src="<?php echo site_url(); ?>assets/vendor/plugins/jquery_validation/dist/jquery.validate.js"></script>
<script>
    $("#add_meal").validate({
        rules: {
            amount: "required",

        },
        messages: {
            amount: "Please Enter Amount",

        }
    });


    $(".addtomenu").click(function () {
        var pageid = $(this).val();
        var pagetitle = $(this).attr("pagetitle");
        var pageslug = $(this).attr("pageslug");
        var pagelanguage = $(this).attr("pagelanguage");
        var menuId = $(this).attr("menuId");
        $("#pageid").val(pageid);
        $("#pagetitle").val(pagetitle);
        $("#pageslug").val(pageslug);
        $("#pagelanguage").val(pagelanguage);
        $("#menuId").val(menuId);
        


        $("#addpagetomenu").modal("show");
        // alert($(this).attr("pageid"));  
    });

    function add_to_menu() {
        var pageid = $("#pageid").val();
        var pagetitle = $("#pagetitle").val();
        var pageslug = $("#pageslug").val();
        var pagedisplaytitle = $("#displaytitle").val();
        var pagelanguage = $("#pagelanguage").val();
        var pageorder = $("#pageorder").val();
        var menuid =  $("#menuId").val();
        var menutype = "page";
        var menutarget = "";
        if($('#pagetarget').is(":checked") == true){
         menutarget = "_blank";  
        }else{
          menutarget = "_self"; 
        }
        //alert(menutarget);
        $.ajax({
            type: "POST",
            url: "<?php echo site_url(); ?>menu/add_to_menu_ajax",
            data: {pageID: pageid,
                pageTitle: pagetitle,
                pageDisplayTitle: pagedisplaytitle,
                pageSlug: pageslug,
                pageLanguage: pagelanguage,
                pageOrder:pageorder,
                menuID:menuid,
                menuType:menutype,
                menuTarget:menutarget
           },
            dataType: "text",
            cache: false,
            success:
                    function (data) {
                       // alert(data);
if($("#valuecheck").val()==0){
                            $("#allmenuid").html(data);
                        }else{
                            $("#allmenuid").append(data);
                        }
                              $("#addpagetomenu").modal("hide");
                              $('input[class="checkboxpage"]').prop('checked', false);

                        }
                    
        });

    }
    
  
    function update_menu(menupid,menutype) {
     
        var pagedisplaytitle = $("#displaytitlemenu_"+menupid).val();
        var customlink = "";
        var pageorder = $("#pageordermenu_"+menupid).val();
        
        var menupageid = $("#menupageid_"+menupid).val();
        if(menutype =="custom"){
         customlink = $("#customlink_"+menupid).val();
        }
          var menutarget = "";
        if($('#pagetargetcus_'+menupid).is(":checked") == true){
         menutarget = "_blank";  
        }else{
          menutarget = "_self"; 
        }
      //  alert(customlink);
        $.ajax({
            type: "POST",
            url: "<?php echo site_url(); ?>menu/update_menu_ajax",
            data: {
                
                pageDisplayTitle: pagedisplaytitle,
               
                pageOrder:pageorder,
                customLink:customlink,
                menupageID:menupageid,
                menuType:menutype,
                menuTarget:menutarget
           },
            dataType: "text",
            cache: false,
            success:
                    function (data) {
                       // alert(data);
 var obj = jQuery.parseJSON(data);
                         $("#msgupdated_"+menupid).html('<div class="alert alert-success">'+obj.massege+'</div>'); 
                         
                         $("#msgupdated_"+menupid).fadeTo(1500, 500).slideUp(500, function(){
    $("#msgupdated_"+menupid).slideUp(500);
});
                        }
                    
        });

    }
    
    function deletemenu(menupageid){
     
        $.ajax({
            type: "POST",
            url: "<?php echo site_url(); ?>menu/delete_menu_page_ajax",
            data: {
                
           
                menupageID:menupageid
           },
            dataType: "text",
            cache: false,
            success:
                    function (data) {
                        //alert(data);
 var obj = jQuery.parseJSON(data);
                         
                         if(obj.status == "success"){
                         $("#menusectionid_"+menupageid).hide("slow");
                     }
                          
                        }
                    
        });

    }
    
    function filter(element) {
    var value = $(element).val();
    $("#pagelist li label").each(function () {
        if ($(this).text().search(new RegExp(value, "i")) > -1) {
            $(this).show();
           // $(this).prevAll('.header').first().show();
        } else {
            $(this).hide();
        }
    });
}

function add_custom_link(pagelanguage,menuId) {
     
        
        $("#pagelanguagecus").val(pagelanguage);
        $("#menuIdcus").val(menuId);
    $("#addcustomlink").modal("show");
    
    }
       function add_custom_menu() {
        var pagelink =  $("#customlink").val();
        var pagedisplaytitle = $("#displaytitlecus").val();
        var pagelanguage = $("#pagelanguagecus").val();
        var pageorder = $("#pageordercus").val();
        var menuid =  $("#menuIdcus").val();
        var menutype = "custom";
        var menutarget = "";
        if($('#pagetargetcus').is(":checked") == true){
         menutarget = "_blank";  
        }else{
          menutarget = "_self"; 
        }
       // alert(pagedisplaytitle);
        
        if(ValidURL(pagelink) == false){
             
        $("#errormsg").html("<div class='alert alert-danger'>please enter valid Url.</div>");
        return false;
        }
        if(pagedisplaytitle == ""){
           $("#errormsg").html("<div class='alert alert-danger'>please enter display Title.</div>");
          return false; 
          }
          
        $.ajax({
            type: "POST",
            url: "<?php echo site_url(); ?>menu/add_custom_menu_ajax",
            data: {
                pageTitle:pagedisplaytitle,
                pageDisplayTitle: pagedisplaytitle,
                pageSlug: pagelink,
                pageLanguage: pagelanguage,
                pageOrder:pageorder,
                menuID:menuid,
                menuType:menutype,
                menuTarget:menutarget
           },
            dataType: "text",
            cache: false,
            success:
                    function (data) {
                       // alert(data);
if($("#valuecheck").val()==0){
                            $("#allmenuid").html(data);
                        }else{
                            $("#allmenuid").append(data);
                        }
                              $("#addcustomlink").modal("hide");
                              
                        }
                    
        });

    }
    
    function ValidURL(str) {
  var regex = /(http|https):\/\/(\w+:{0,1}\w*)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%!\-\/]))?/;
  if(!regex .test(str)) {
   // alert("Please enter valid URL.");
    return false;
  } else {
    return true;
  }
}
function addidfordelete(url){

	$('#delPollModal').modal('show');
	$('#deletePoll').click(function () {
	      // similar behavior as clicking on a link
	      window.location.href = url;
	    })
}

</script>
