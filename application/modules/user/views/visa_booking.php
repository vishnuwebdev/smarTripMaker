<?php $this->load->view("include/head"); ?>
<?php $this->load->view("include/header"); ?>

<body>

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
			 							<h1 class="mb-0"><i class="icofont-airplane"></i> Visa Bookings</h1>
			 						</div>
			 					</div>
			 					<div class="col-md-6">
			 						<div class="user-login-right">
			 							<h5 class="mb-0"><i class="icofont-info-circle"></i> Welcome, <span class="user-name font-weight-bold"><?php echo $this->session->userdata("Userlogin")["name"]; ?>!</span></h5>
			 						</div>
			 					</div>
			 					<div class="col-md-12">
			 						<div class="breadcrumb-col">
			 							<ul class="list-inline mb-0 breadcrumb">
			 								<li class="list-inline-item mr-0 breadcrumb-item">
			 									<a href="<?php echo site_url() ?>user/dashboard"><i class="icofont-home"></i> Home</a>
						                  	</li>
						                  	<li class="list-inline-item mr-0 breadcrumb-item">Visa Bookings</li>
						                </ul>
						              </div>
			 					</div>
			 				</div>
			 			</div>
			 			<div class="paul-card-content">
			 				<div class="paul-layout">
					            <div class="uer-dh-desc pt-2">
					            	<div class="table-rsponsive">
					                      <table class="table table-striped custab table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
						    <th>Status</th> 
                            <th>Order ID</th> 
                            <th>Visa Type</th>                          
                            <th>Visa Amount</th>   
                            <th>Visa Request Date</th>                          
                        </tr>
                    </thead>
                  <?php
                    if(count($result) > 0){
                        $i=1;
                        foreach ($result as $bp){ ?>
                          <tr>
                              <td>
                                <?php echo $i++ ?> <br>                                
                              </td>
								<td>
                                    <strong class="text-greensea">Ref. ID</strong> <?php echo $bp->id; ?><br>
								</td>
								<td>
                                   <?= $bp->unique_order?>
								</td>
								<td>
                                    <?php
                                        $title = $visa_amount = "";
                                        foreach($visa_type as $item){
                                            if($bp->request_visa_id == $item->id){
                                                $title = $item->visa_title;
                                                $visa_amount = $item->visa_amount;
                                            }
                                        }
                                    ?>
                                    <?= $title ?>
								</td>
								<td>
								    <?php echo $visa_amount;?>
								</td>
								<td>
                                    <?php echo date_format(date_create($createdOn),"h:i A , d M Y");?>
								</td>
                          </tr>
                    <?php } } else{ ?>      
                       <tr>
                           <td colspan="7">Not Found Any Records.</td> 
						</tr>
                    <?php } ?>
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