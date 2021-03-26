<?php $this->view('simple_layout/header'); ?>
<?php $this->view('simple_layout/leftSidebar'); ?>
<style>.sundaymon .col-md-2 {
        width: 12%;
    }
    .border{
        border: 1px solid #cecece;
        padding: 8px;
    }
</style>
<section id="content">
	<div class="page page-forms-validate">
		<div class="pageheader">
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li><a href="<?php echo site_url();?>"><i class="fa fa-home"></i> <?php echo $this->lang->line ( "dashboard" );?></a></li>
					<li><a href="<?php echo site_url($this->uri->segment("1"));?>"></i> <?php echo $this->lang->line ( "holiday" );?></a></li>
					<li><a></i> <?php echo $this->lang->line ( "add_package" );?></a></li>
				</ul>
			</div>
		</div>
		<!-- row -->
		<div class="row">
			<!-- col -->
			<div class="col-md-12">
				<!-- tile -->
				<a href="<?php echo site_url().$this->uri->segment("1");?>" class="btn btn-greensea btn-ef btn-ef-7 btn-ef-7h mb-10 pull-right mr-10"><i class="fa fa-list"></i> <?php echo $this->lang->line ( "package_list" );?></a>
				<div class="clearfix"></div>
				<section class="tile bp_shadow">
					<!-- tile header -->
					<div class="tile-header dvd dvd-btm">
						<h1 class="custom-font">
							<strong><?php echo $this->lang->line ( "add_package" );?> </strong>
						</h1>
					</div>
					<!-- /tile header -->
					<form class="form-horizontal" role="form" action="" method="post" id="add_package" enctype="multipart/form-data">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
						<!-- tile body -->
						<div class="tile-body">
					<?php echo form_error('myfield', '<div class="error">', '</div>');?>
					<?php if(validation_errors()!=NULL){?>	
					<div class="alert alert-big alert-lightred alert-dismissable fade in">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <?php echo validation_errors(); ?>
                                    </div>
                                    <?php }?>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "name" );?>:</label>
								<div class="col-sm-9">
									<div class="input text">
										<input type="text" name="name" placeholder="Package Name" class="form-control bp_package_name">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "slug" );?>:</label>
								<div class="col-sm-9">
									<div class="input text">
										<input type="text" name="slug" placeholder="Package Slug" class="form-control bp_package_slug">
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "keyword" );?>:</label>
								<div class="col-sm-9">
									<div class="input text">
										<textarea name="search_keyword" placeholder="Add multiple Keyword comma (,) seprated" class="form-control bp_package_slug"></textarea>
										
									</div>
								</div>
							</div>



							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "start_price" );?>:</label>
								<div class="col-sm-9">
									<div class="input text">
										<input type="text" name="price" placeholder="Start Price ex- 5000" class="form-control">
									</div>
								</div>
							</div>
						

							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "nights" );?> :</label>
								<div class="col-sm-9">
									<div class="input text">
										<select class="form-control" name="night">
										<?php
										for($i = 0; $i <= 30; $i ++) {
											?>
										<option value="<?php echo $i;?>"><?php echo $i;?> <?php echo $this->lang->line ( "nights" );?></option>
										<?php }?>
										</select>
									</div>
								</div>
							</div>
						
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "package_category" );?>:</label>
								<div class="col-sm-9">
								<?php
								
if (is_array ( $bp_package_category )) {
									foreach ( $bp_package_category as $bp ) {
										if ($bp->holcat_status == "active") {
											?>
									     <div class="col-md-3">
										<label class="checkbox-inline"> <input type="checkbox" name="category[]" value="<?php echo $bp->holcat_id;?>---<?php echo $bp->holcat_name;?>"> <?php echo $bp->holcat_name;?> 
                                                </label>
									</div>
									       <?php } } }?>
									
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "sub_category" );?> </label>
								<div class="col-sm-9">
									<div class="input text">
										<select multiple class="my_select_box_pickup form-control" name="sub_category[]">
                                                   <?php foreach($bp_sub_category as $bp_sub_categorys){ ?> 
										<option value="<?php echo $bp_sub_categorys->holsubc_id;?>"><?php echo $bp_sub_categorys->holsubc_name;?> </option>
										<?php }?>
                                                </select>
									</div>
								</div>
							</div>
						
						
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "feature_image" );?> </label>
								<div class="col-sm-9">
									<div class="input text">
										<input class="form-control" type="file" name="userfile" />
									</div>
								</div>
							</div>
							
							
							
							
							
					
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "featured" );?> :</label>
								<div class="col-sm-9">
									<div class="input text">
										<select class="form-control" name="featured">
											<option value="yes"><?php echo $this->lang->line ( "yes" );?></option>
											<option value="not">No</option>
										</select>
									</div>
								</div>
							</div>
				
							<hr class="line-dashed line-full" />

							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "short_description" );?>:</label>
								<div class="col-sm-9">
									<textarea name="short_desc" id=""></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "long_description" );?>:</label>
								<div class="col-sm-9">
									<textarea name="long_desc" id=""></textarea>
								</div>
							</div>

						</div>
						<!-- /tile body -->
						<!-- tile footer -->
						<div class="tile-footer text-right bg-tr-black lter dvd dvd-top">
							<!-- SUBMIT BUTTON -->
							<div class="submit">
								<input type="submit" class="btn btn-success" value="<?php echo $this->lang->line ( "submit" );?>">
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

<?php $this->load->view("simple_layout/footer");?>
<script src="<?php echo site_url();?>assets/js/vendor/chosen/chosen.jquery.min.js"></script>
<script src="<?php echo site_url();?>assets/vendor/ckeditor/ckeditor.js"></script>
<script>
   $(".my_select_box_pickup").chosen({
  
    width: "100%"
  });   
    
var editor=CKEDITOR.replace( 'short_desc' ,{height: 150});
var editor=CKEDITOR.replace( 'long_desc' ,{height: 300});
</script>
<?php $this->load->view("holiday/js");?>
<script>
$(".bp_package_name").keyup(function(){
	var bp_package_name=$(this).val();
	//var bp_package_slug=bp_package_name.replaceAll(" ","-");
	$(".bp_package_slug").val(bp_package_name);
});
$(document).ready(function () {
        var max_fields = 10; //maximum input boxes allowed
        var wrapper = $(".input_fields_wrap"); //Fields wrapper
        var add_button = $(".add_field_button"); //Add button ID

        var x = 0; //initlal text box count
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
<script>
var count=parseInt("1");
$(".add_more_button").click(function(){
	var data='<div class="input text"><div class="col-md-3"><label class="checkbox-inline"><input type="text" name="day_lang[]" class="form-control"></label></div><div class="col-md-1"><label class="checkbox-inline"><input type="checkbox" name="sunday_monday[]" value="sun"> Sun</label></div><div class="col-md-1"><label class="checkbox-inline"><input type="checkbox" name="sunday_monday[]" value="mon"> Mon</label></div><div class="col-md-1">
<label class="checkbox-inline">
        <input type="checkbox" name="sunday_monday[]" value="tue"> Tue
    </label>
</div>
<div class="col-md-1">
    <label class="checkbox-inline">
        <input type="checkbox" name="sunday_monday[]" value="wed"> Wed
    </label>
</div>
<div class="col-md-1">
    <label class="checkbox-inline">
        <input type="checkbox" name="sunday_monday[]" value="thu"> Thu
    </label>
</div>
<div class="col-md-1">
    <label class="checkbox-inline">
        <input type="checkbox" name="sunday_monday[]" value="fri"> Fri
    </label>
</div>
<div class="col-md-1">
    <label class="checkbox-inline">
        <input type="checkbox" name="sunday_monday[]" value="sat"> Sat
    </label>
</div>
</div>';
	$(".for_day_add").append("this is ");
});


</script>