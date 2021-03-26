<?php $this->view('simple_layout/header'); ?>
<?php $this->view('simple_layout/leftSidebar'); ?>
<section id="content">
    <div class="page page-forms-validate">
        <div class="pageheader">
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li><a href="<?php echo site_url(); ?>"><i class="fa fa-home"></i>
                            <?php echo $this->lang->line("dashboard"); ?></a></li>
                    <li><a href="<?php echo site_url($this->uri->segment("1")); ?>"></i><?php echo $this->lang->line("testimonial"); ?></a></li>
                    <li><a></i><?php echo $this->lang->line("add"); ?> <?php echo $this->lang->line("testimonial"); ?></a></li>
                </ul>
            </div>
        </div>
        <!-- row -->
        <div class="row">
            <!-- col -->
            <div class="col-md-12">
                <!-- tile -->
                <section class="tile bp_shadow">
                    <!-- tile header -->
                    <div class="tile-header dvd dvd-btm">
                        <h1 class="custom-font">
                            <?php echo $this->lang->line("add"); ?>  <strong><?php echo $this->lang->line("testimonial"); ?>  </strong>
                        </h1>
                    </div>
                    <!-- /tile header -->
                    <?php $attributes = array('class' => 'form-horizontal', 'id' => 'add_testimonial'); ?>
                    <?php echo form_open_multipart('testimonial/add_testimonial', $attributes); ?>
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
                            <label class="col-sm-2 control-label"><?php echo $this->lang->line("testimonial"); ?>  <?php echo $this->lang->line("name"); ?> </label>
                            <div class="col-sm-9">
                                <div class="input text">
                                    <?php echo form_input(array('name' => 'testimonial_name', 'class' => 'form-control'), set_value('testimonial_name')); ?>
                                    <?php echo form_error('testimonial_name', '<div class="error">', '</div>'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><?php echo $this->lang->line("testimonial"); ?>  <?php echo $this->lang->line("company"); ?> <?php echo $this->lang->line("name"); ?> </label>
                            <div class="col-sm-9">
                                <div class="input text">
                                    <input type="text" name="company_name"
                                           placeholder="" class="form-control" value="<?php echo set_value('company_name'); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><?php echo $this->lang->line("designation"); ?>  </label>
                            <div class="col-sm-9">
                                <div class="input text">
                                    <input type="text" name="designation"
                                           placeholder="" class="form-control" value="<?php echo set_value('designation'); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><?php echo $this->lang->line("testimonial"); ?>  <?php echo $this->lang->line("phone"); ?>  </label>
                            <div class="col-sm-9">
                                <div class="input text">
                                    <input type="text" name="phone"
                                           placeholder="" class="form-control" value="<?php echo set_value('phone'); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><?php echo $this->lang->line("testimonial"); ?>  <?php echo $this->lang->line("email"); ?>  </label>
                            <div class="col-sm-9">
                                <div class="input text">
                                    <input type="text" name="email"
                                           placeholder="" class="form-control" value="<?php echo set_value('email'); ?>">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label"><?php echo $this->lang->line("testimonial"); ?>  <?php echo $this->lang->line("description"); ?>  </label>
                            <div class="col-sm-9">
                                <div class="input text">
                                    <textarea class="form-control" name="description" rows="8"><?php echo set_value('description'); ?></textarea>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><?php echo $this->lang->line("testimonial"); ?>  <?php echo $this->lang->line("star"); ?>  </label>
                            <div class="col-sm-9">
                                <div class="input text">
                                    <select class="form-control" name="star">
                                        <option value="1">1 Star</option>
                                        <option value="2">2 Star</option>
                                        <option value="3">3 Star</option>
                                        <option value="4">4 Star</option>
                                        <option value="5">5 Star</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><?php echo $this->lang->line("testimonial"); ?>  <?php echo $this->lang->line("status"); ?>  </label>
                            <div class="col-sm-9">
                                <div class="input text">
                                    <select class="form-control" name="status">
                                        <option value="active"><?php echo $this->lang->line("active"); ?> </option>
                                        <option value="inactive"><?php echo $this->lang->line("inactive"); ?> </option>
                                    </select>
                                </div>
                            </div>
                        </div>



                        <div class="form-group">
                            <label class="col-sm-2 control-label"><?php echo $this->lang->line("language"); ?> </label>
                            <div class="col-sm-9">
                                <div class="input text">
                                    <select class="form-control" name="language">
                                        <?php $all_language = $this->all_language;
                                        ?>
                                        <?php foreach ($all_language as $all_languages) { ?> 
                                            <option value="<?php echo $all_languages; ?>" <?php if ($this->dsa_set_language == $all_languages) {
                                            echo "selected";
                                        } ?>><?php echo $all_languages; ?></option>
<?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                         <div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $this->lang->line ( "testimonial" );?> <?php echo $this->lang->line ( "site_type" );?> </label>
								<div class="col-sm-9">
									<div class="input text">
										<select class="form-control" name="testimositetype">
										
										<option value="B2c" >B2c</option>
										<option value="B2b" >B2b</option>
										</select>
									</div>
								</div>
							</div>
                    </div>
                    <!-- /tile body -->
                    <!-- tile footer -->
                    <div class="tile-footer text-right bg-tr-black lter dvd dvd-top">
                        <!-- SUBMIT BUTTON -->
                        <div class="submit">
                            <input type="submit" class="btn btn-success" value="<?php echo $this->lang->line("submit"); ?> ">
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
<?php $this->load->view("blog/js"); ?>