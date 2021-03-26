 <?php $this->load->view('include/head') ?>
<?php $this->load->view('include/header') ?>

<body>

   <!-- User dashboard start from here -->
<section class="user-dashboard dash-wrap">
	<div class="container-fluid">
		<div class="row">
			  <?php $this->load->view("customersidebar"); ?>
			 <div class="col-md-9">
			 	<div class="user-sidebar-wrapper pt-2 pt-md-5">
			 		<div class="inner-user-paul">
			 			<div class="card-header-paul">
			 				<div class="row">
			 					<div class="col-md-6">
			 						<div class="card-head-top">
			 							<h1 class="mb-0"><i class="icofont-bank-alt"></i> Transaction Log</h1>
			 						</div>
			 					</div>
			 					<div class="col-md-6">
			 						<div class="user-login-right">
			 							<h5 class="mb-0"><i class="icofont-info-circle"></i> Welcome, <span class="user-name font-weight-bold"><?php echo $this->session->userdata("Userlogin")["name"]; ?>!</span> </h5>
			 						</div>
			 					</div>
			 					<div class="col-md-12">
			 						<div class="breadcrumb-col">
			 							<ul class="list-inline mb-0 breadcrumb">
			 								<li class="list-inline-item mr-0 breadcrumb-item">
			 									<a href="<?php echo site_url() ?>user/dashboard"><i class="icofont-home"></i> Home</a>
						                  	</li>
						                  	<li class="list-inline-item mr-0 breadcrumb-item">Transaction Log</li>
						                </ul>
						              </div>
			 					</div>
			 				</div>
			 			</div>
			 			<div class="paul-card-content">
			 				<div class="paul-layout">
							<form class="form-horizontal" role="form" action="" method="get" id="search_filter" novalidate="novalidate">
			 					<div class="profile-top-bar mb-3 p-2">
			 						<div class="row">
					                    <div class="col-lg-3 col-md-3 col-sm-6">
					                      <div class="profile-img pt-md-2">
					                          <h5 class="text-head">Select Filter Type</h5>
					                      </div>
					                    </div>
					                    <div class="col-lg-6 col-md-6 col-sm-6">
					                      <div class="form-group mb-2 mb-md-0">
					                        <select name="" class="form-control statement_type" id="select-filter">
					                          <option value="min">Mini Statement</option>
					                          <option value="year">Yearly</option>
					                          <option value="custom">Custom</option>
					                        </select>
					                      </div>
					                    </div>
										
			
										
										
					                    <div class="col-lg-3 col-md-3 col-sm-6">
					                      <div class="pro-btn-right p-0 clearfix text-md-right text-center">
					                     <!--   <a href="javascript:void(0)" class="ic-btn"><i class="icofont-search"></i>Search</a>-->
											<button type="submit" class="ic-btn"><i class="icofont-search"></i>Search</button>
					                      </div>
					                    </div>
					                     
					                  </div>
					            </div>
								
								<div class="transaction-log-wrap">
									<table class="table table-striped  table-bordered">
										<tbody>
											 <tr class="yearly_filter" style="display: none;" >
												<td class="warning">Year</td>
												<td><select class="select block border form-control" name="state_year" required="" autocomplete="off" aria-invalid="false">
												   <?php echo date("Y");
												   for($i=2017;$i <= date("Y");$i++){
												   ?>
														<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
												   <?php } ?>

												</select></td>
												<td class="warning">Month</td>
												<td><select class="select block border form-control" name="state_month" autocomplete="off">
													<option value="">--select month--</option>
													<option value="01">Jan</option>
													<option value="02">Feb</option>
													<option value="03">Mar</option>
													<option value="04">Apr</option>
													<option value="05">May</option>
													<option value="06">Jun</option>
													<option value="07">Jul</option>
													<option value="08">Aug</option>
													<option value="09">Sep</option>
													<option value="10">Oct</option>
													<option value="11">Nov</option>
													<option value="12">Dec</option>
												</select></td>
											</tr>
											
											   <tr class="custom_filter" style="display:none;">
												<td class="warning">From</td>
												<td><input type="text" class="form-control" id="st_fromdate" name="st_fromdate" value="" placeholder="From Date..." autocomplete="off" required=""></td>
												<td class="warning">To</td>
												<td><input type="text" class="form-control" id="st_todate" name="st_todate" value="" placeholder="To Date..." autocomplete="off"></td>
											</tr>
										</tbody>
									</table>
								</div>
								
								</form>
								
					            <div class="uer-dh-desc pt-2">
					            	<div class="table-rsponsive">
					                    <table class="table table-striped  table-bordered">
					                      <thead>
					                        <tr>
					                          <th>#</th>
					                          <th>Detail</th>
					                          <th>Debit</th>
					                          <th>Credit</th>
					                          <th>Balance</th>
					                          <th>Date</th>
					                        </tr>
					                      </thead>
					                      <tbody>
										  <?php 
											if(is_array($result)){
											$i=1;
											// echo "<pre>";
									 // print_r($result);die;
											foreach ($result as $results) { ?>
					                        <tr>
					                          <td><?php echo $i; ?></td>
					                          <td><?php echo $results->balance_log_detail; ?></td>
					                          <td><i class="icofont-rupee"></i> <?php echo $results->balance_log_debit; ?></td>
					                          <td> <i class="icofont-rupee"></i> <?php echo $results->balance_log_credit; ?></td>
					                          <td><i class="icofont-rupee"></i> <?php echo $results->balance_log_balance; ?></td>
					                          <td><i class="icofont-clock-time"></i>
											 <?php echo date_format(date_create($results->balance_log_entry_date),"h:i A , d M Y") ?> </td>
					                        </tr>
					                       <?php $i++; } } else{ ?>         
										   <tr>
											  <td colspan="8">No records Found.</td>  
											</tr>											  
										<?php } ?>
					                      </tbody>
					                    </table>
					                </div>
					            </div>
			 				</div>
			 			</div>
			 		</div>
			 	</div>
			 </div>
		</div>
	</div>
</section>

<?php $this->load->view("include/footer"); ?>


    <?php $this->load->view("js"); ?>
	


<script type="text/javascript">
    $(".statement_type").change(function () {
        if ($(this).val() == "custom") {
            $(".custom_filter").show();
            $(".yearly_filter").hide();
        }else if($(this).val() == "year"){

            $(".yearly_filter").show();
            $(".custom_filter").hide();
        }else if($(this).val() == "min"){
           $(".yearly_filter").hide();
            $(".custom_filter").hide(); 
        }
    });

    $(function () {
        $("#st_fromdate").datepicker({
            dateFormat: 'dd-mm-yy',
            "minDate": new Date(2017, 1 - 1, 1),
            beforeShow: function () {

                $('#ui-datepicker-div').addClass("codatebirth");
            },
            onClose: function (selectedDate) {
                $("#st_todate").datepicker("option", "minDate", selectedDate);
            }
        });
        $("#st_todate").datepicker({
            dateFormat: 'dd-mm-yy',
            "maxDate": 0,
            beforeShow: function () {

                $('#ui-datepicker-div').addClass("codatebirth");
            }

        });
    })
</script>