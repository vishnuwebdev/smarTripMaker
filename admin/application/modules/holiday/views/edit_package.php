<style>.sundaymon .col-md-2 {
        width: 12%;
    }
    .border{
        border: 1px solid #cecece;
        padding: 8px;
    }
</style>
<?php

// PrintArray(unserialize($result->holiday_sunday_monday));
//die;
$bp_active_tab_data['bp_active_tab'] = "edit_package";
$this->load->view("package_tab", $bp_active_tab_data);
?>
<!-- /tile header -->
<form class="form-horizontal" role="form" action="" method="post" id="add_package" enctype="multipart/form-data">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
    <!-- tile body -->
    <div class="tile-body">
        <?php echo form_error('myfield', '<div class="error">', '</div>'); ?>
        <?php if (validation_errors() != NULL) { ?>	
            <div class="alert alert-big alert-lightred alert-dismissable fade in">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo validation_errors(); ?>
            </div>
        <?php } ?>
        <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $this->lang->line("name"); ?>:</label>
            <div class="col-sm-9">
                <div class="input text">
                    <input type="text" name="name" value="<?php echo $result->holiday_name; ?>" placeholder="Package Name" class="form-control bp_package_name">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $this->lang->line("slug"); ?>:</label>
            <div class="col-sm-9">
                <div class="input text">
                    <input type="text" name="slug" value="<?php echo $result->holiday_slug; ?>" placeholder="Package Slug" class="form-control bp_package_slug">
                </div>
            </div>
        </div>


        <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $this->lang->line ( "keyword" );?>:</label>
            <div class="col-sm-9">
                <div class="input text">
                    <textarea name="search_keyword" placeholder="Add multiple Keyword comma (,) seprated" class="form-control bp_package_slug"><?php echo $result->search_keyword; ?></textarea>
                    
                </div>
            </div>
        </div>



        <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $this->lang->line("start_price"); ?>:</label>
            <div class="col-sm-9">
                <div class="input text">
                    <input type="text" name="price" value="<?php echo $result->holiday_start_price; ?>" placeholder="Start Price ex- 5000" class="form-control">
                </div>
            </div>
        </div>
      

        <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $this->lang->line("nights"); ?> :</label>
            <div class="col-sm-9">
                <div class="input text">
                    <select class="form-control" name="night">
                        <?php for ($i = 0; $i <= 30; $i++) { ?>
                            <option value="<?php echo $i; ?>" <?php if ($result->holiday_night == $i) {
                            echo "selected";
                        } ?>><?php echo $i; ?> <?php echo $this->lang->line("nights"); ?></option>
<?php } ?>
                    </select>
                </div>
            </div>
        </div>
      
        <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $this->lang->line("category"); ?>:</label>
            <div class="col-sm-9">
                <?php
                $bp_category_for_select = explode(",", $result->holiday_category_id);
                if (is_array($bp_category_for_select)) {
                    foreach ($bp_category_for_select as $bp_category_foreach) {
                        $bp_package_category_list[$bp_category_foreach] = $bp_category_foreach;
                    }
                }
                ?>
<?php
if (is_array($bp_package_category)) {
    foreach ($bp_package_category as $bp) {
        if ($bp->holcat_status == "active") {
            ?>
                            <div class="col-md-3">
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="category[]" <?php if (isset($bp_package_category_list[$bp->holcat_id])) {
                echo "checked";
            } ?> value="<?php echo $bp->holcat_id; ?>---<?php echo $bp->holcat_name; ?>"> <?php echo $bp->holcat_name; ?> 
                                </label>
                            </div>
                        <?php }
                    }
                } ?>

            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $this->lang->line("sub_category"); ?> </label>
            <div class="col-sm-9">
                        <?php
                        $bp_sub_category_for_select = explode(",", $result->holiday_sub_category_id);
                        if (is_array($bp_sub_category_for_select)) {
                            foreach ($bp_sub_category_for_select as $bp_sub_category_for_selects) {
                                $bp_package_sub_category_list[$bp_sub_category_for_selects] = $bp_sub_category_for_selects;
                            }
                        }
                        ?>
                <div class="input text">
                    <select multiple class="my_select_box_pickup form-control" name="sub_category[]">
                    <?php foreach ($bp_sub_category as $bp_sub_categorys) { ?> 
                            <option value="<?php echo $bp_sub_categorys->holsubc_id; ?>" <?php if (in_array($bp_sub_categorys->holsubc_id, $bp_package_sub_category_list)) {
                        echo "selected";
                    } ?>><?php echo $bp_sub_categorys->holsubc_name; ?></option>
                    <?php } ?>
                    </select>
                </div>
            </div>
        </div>
 
   
      
        <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $this->lang->line("feature_image"); ?> </label>
            <div class="col-sm-9">
                <div class="input text">
                    <input type="hidden" name="package_image" value="<?php echo $result->holiday_feature_image; ?>">
                    <input class="form-control" type="file" name="userfile" />
                    <div class="pull-left thumb" style="width:80px;">
                <?php if ($result->holiday_feature_image != "") { ?>
                            <img class="media-object thumbscl" src="<?php echo site_url(); ?>assets/img/holiday/thumbs/<?php echo $result->holiday_feature_image; ?>" alt="<?php echo $result->holiday_name; ?>">
                <?php } else { ?>
                            <img class="media-object thumbscl" src="<?php echo site_url(); ?>assets/images/not_found.png" alt="<?php echo $result->holiday_name; ?>">
                <?php } ?>
                    </div>
                </div>
            </div>
        </div>
		
		
      
	
 
        
        
        <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $this->lang->line("featured"); ?> :</label>
            <div class="col-sm-9">
                <div class="input text">
                    <select class="form-control" name="featured">
                        <option value="yes" <?php if ($result->holiday_is_featured == "yes") {
                        echo "selected";
                    } ?>><?php echo $this->lang->line("yes"); ?></option>
                        <option value="not" <?php if ($result->holiday_is_featured == "not") {
                        echo "selected";
                    } ?>><?php echo $this->lang->line("no"); ?></option>
                    </select>
                </div>
            </div>
        </div>
   
        <hr class="line-dashed line-full"/>

        <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $this->lang->line("short_description"); ?>:</label>
            <div class="col-sm-9">
                <textarea name="short_desc" id=""><?php echo $result->holiday_short_description; ?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $this->lang->line("long_description"); ?>:</label>
            <div class="col-sm-9">
                <textarea name="long_desc" id=""><?php echo $result->holiday_long_description; ?></textarea>
            </div>
        </div>

    </div>
    <!-- /tile body -->
    <!-- tile footer -->
    <div class="tile-footer text-right bg-tr-black lter dvd dvd-top">
        <!-- SUBMIT BUTTON -->
        <div class="submit">
            <input type="submit" class="btn btn-success" value="<?php echo $this->lang->line("update"); ?>">
        </div>
    </div>
    <!-- /tile footer -->
</form>
</section>
<!-- /tile -->
</div>
<!-- /col -->
</div>
<!-- /row -->
</div>
</section>
<!--/ CONTENT -->

<?php $this->load->view("simple_layout/footer"); ?>
<script src="<?php echo site_url(); ?>assets/js/vendor/chosen/chosen.jquery.min.js"></script>
<script src="<?php echo site_url(); ?>assets/vendor/ckeditor/ckeditor.js"></script>	
<script>
    $(".my_select_box_pickup").chosen({

        width: "100%"
    });
    var editor = CKEDITOR.replace('short_desc', {height: 150});
    var editor = CKEDITOR.replace('long_desc', {height: 300});
</script>
<?php $this->load->view("holiday/js"); ?>
<script>
    $(".bp_package_name").keyup(function () {
        var bp_package_name = $(this).val();
        //var bp_package_slug=bp_package_name.replaceAll(" ","-");
        $(".bp_package_slug").val(bp_package_name);
    });

    $(document).ready(function () {
        var max_fields = 10; //maximum input boxes allowed
        var wrapper = $(".input_fields_wrap"); //Fields wrapper
        var add_button = $(".add_field_button"); //Add button ID

        var x = <?php echo $countlang - 1; ?>; //initlal text box count
        $(add_button).click(function (e) { //on add input button click
            e.preventDefault();
            if (x < max_fields) { //max input box allowed
                x++; //text box increment
                
                var htmladddata = '<div class="section_language clearfix mt-10"> <div class="border col-md-11"> <div class="row"> <div class="col-sm-6"> <div class="input text"> <input class="form-control inputlanname" name="multi_lan['+x+'][language_name]" value=""> </div></div>\n\
          <div class="col-sm-6"> <div class="input text"> <input class="form-control inputlanprice" name="multi_lan['+x+'][lan_price]" value=""> </div></div></div>\n\
                                  <div class="row"> <div class="input text sundaymon"> <div class="col-md-2"> <label class="checkbox-inline checkbox checkbox-custom-alt checkbox-custom-sm"> \n\
                                  <input type="checkbox" class="sunday_sunday" name="multi_lan['+x+'][sunday_monday][]" value="sun"><i></i> Sun </label> </div>\n\
                                  <div class="col-md-2"> <label class="checkbox-inline checkbox-inline checkbox checkbox-custom-alt checkbox-custom-sm"> <input class="sunday_sunday" type="checkbox" name="multi_lan['+x+'][sunday_monday][]" value="mon"><i></i> Mon </label> </div>\n\
<div class="col-md-2"> <label class="checkbox-inline checkbox-inline checkbox checkbox-custom-alt checkbox-custom-sm"> <input class="sunday_sunday" type="checkbox" name="multi_lan['+x+'][sunday_monday][]" value="tue"><i></i> Tue </label> </div>\n\
<div class="col-md-2"> <label class="checkbox-inline checkbox-inline checkbox checkbox-custom-alt checkbox-custom-sm"> <input class="sunday_sunday" type="checkbox" name="multi_lan['+x+'][sunday_monday][]" value="wed"><i></i> Wed </label> </div>\n\
<div class="col-md-2"> <label class="checkbox-inline checkbox-inline checkbox checkbox-custom-alt checkbox-custom-sm"> <input class="sunday_sunday" type="checkbox" name="multi_lan['+x+'][sunday_monday][]" value="thu"><i></i> Thu </label> </div>\n\
<div class="col-md-2"> <label class="checkbox-inline checkbox-inline checkbox checkbox-custom-alt checkbox-custom-sm"> <input class="sunday_sunday" type="checkbox" name="multi_lan['+x+'][sunday_monday][]" value="fri"><i></i> Fri </label> </div>\n\
<div class="col-md-2"> <label class="checkbox-inline checkbox-inline checkbox checkbox-custom-alt checkbox-custom-sm"> <input class="sunday_sunday" type="checkbox" name="multi_lan['+x+'][sunday_monday][]" value="sat"><i></i> Sat </label> </div></div></div></div>\n\
<div class="col-md-1"> <button type="button" class="btn btn-danger remove_field"><i class="fa fa-trash"></i></button> </div></div>'
                $(wrapper).append(htmladddata); //add input box
            }
        });

        $(wrapper).on("click", ".remove_field", function (e) { //user click on remove text
            e.preventDefault();
            $(this).parents().eq(1).remove();
            resetTheOrder();
            x--;
        })
    });
   
     function resetTheOrder(){
        $.each($(".inputlanname"),function(index,value){
       // alert(index);
        $(this).attr("name",'multi_lan['+index+'][language_name]')
       // $(value).attr('name','multi_lan['+index+'][lan_price]');
     });
     
     $.each($(".inputlanprice"),function(index,value){
      //  alert(index);
        
        $(this).attr('name','multi_lan['+index+'][lan_price]');
     });
     
     $.each($(".section_language"),function(index,value){
      //  alert(index);
        $(this).find('input[class="sunday_sunday"]').attr("name",'multi_lan['+index+'][sunday_monday][]')
       // $(value).attr('name','multi_lan['+index+'][lan_price]');
     });
     
     
    }
</script>