<?php
	$active_tab = !$this->input->get('type') ? "flight" : $this->input->get('type');
	$currency = $this->config->item('currency');
	$current_currency = getCurrentCurrency();
?>
<style>
	.nav-link.active{ color: green !important;}
</style>
<header id="header" class="header">
	<div class="container-fluid">
		 <div class="row align-items-center">
		 	<div class="col-lg-3 col-md-3 order-2 order-md-1">
		 		<div class="site-logo">
		 			<a href="<?= site_url() ?>">
						<img src="<?= site_url() ?>admin/assets/img/logos/<?= $this->dsa_data->dsa_logo ?>" alt="logo">
		 			</a>
		 		</div>
		 		<!-- Navbar button for responsive -->
		 		<button class="navbar-toggler d-block d-md-none" type="button" data-toggle="collapse" data-target="#navbarsExample03" aria-controls="navbarsExample03" aria-expanded="false" aria-label="Toggle navigation">
					<i class="icofont-navigation-menu"></i>
				</button>
				<!-- Navbar button End for responsive -->
		 	</div>
		 	<div class="col-lg-4 col-md-4 order-3 order-md-2">
		 		<nav class="navbar navbar-expand-md navbar-dark main-navbar bg-light p-0">
					<div class="collapse navbar-collapse justify-content-center" id="navbarsExample03">
				        <ul class="navbar-nav">	
				        	<!-- <li class="nav-item">
				            	<a class="nav-link <?= ($active_tab=="flight") ? "active" : null ?>" href="<?= site_url() ?>">
				            		<i class="icofont-home"></i> Home 
				            	</a>
				          	</li> -->
				          	<li class="nav-item">
				            	<a class="nav-link" href="<?= site_url() ?>">
									<i class="icofont-airplane"></i> Flights 
								</a>
				          	</li>
				          	<li class="nav-item">
				            	<a class="nav-link" href="<?= site_url() ?>hotel">
									<i class="icofont-juice"></i> Hotel 
								</a>
				          	</li>
				          	<li class="nav-item">
				            	<a class="nav-link <?= ($active_tab=="holiday") ? "active" : null ?>" href="<?= site_url() ?>holiday">
									<i class="icofont-beach"></i> Holiday 
								</a>
				          	</li>
				          	<li class="nav-item">
				            	<a class="nav-link <?= ($active_tab=="visa") ? "active" : null ?>" href="<?= site_url() ?>visa">
									<i class="icofont-visa-alt"></i> Visa
								</a>
				          	</li>
				      	</ul>
				  	</div>
				</nav>
		 	</div>
		 	<div class="col-lg-5 col-md-5 order-1 order-md-3">
		 		<div class="header-right-wrap text-center text-md-right ">
		 			<ul class="list-inline mb-0">
					 	<li class="list-inline-item">
							 <?php
							 	if(getCurrentCurrency() =="AED"){
									// $webLink = "https://api.whatsapp.com/send?phone=+971556135321&submit=Continue";
									$webLink = "https://api.whatsapp.com/send?phone=+971543744833&submit=Continue";
								}else{
									$webLink = "https://api.whatsapp.com/send?phone=+919876764792&submit=Continue";
								}
							 ?>
		 					<a href="<?= $webLink ?>" target="_blank">
		 						<i class="icofont-whatsapp"></i>
		 						<p class="mb-0">Whatsapp</p>
		 					</a>
		 				</li>
		 				<li class="list-inline-item">
							<a href="<?= site_url() ?>blog">
		 						<i class="icofont-users"></i>
		 						<p class="mb-0">Blog</p>
		 					</a>
		 				</li>
		 				<li class="list-inline-item">
		 					<a href="<?= site_url() ?>pages/contact_us">
		 						<i class="icofont-live-support"></i>
		 						<p class="mb-0">24*7 Support</p>								
		 					</a>
		 				</li>
						<?php  if($this->session->userdata("Userlogin") == NULL){ ?> 
							<li class="list-inline-item dropdown ed">
								<a href="javascript:void(0)" id="my-acc" class="dropdown-toggle" data-toggle="dropdown">
									<i class="icofont-user"></i>
									My Account
								</a>
								<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
									<li>
										<a class="dropdown-item" href="<?= site_url() ?>user/login">Login</a>
									</li>
									<li>
										<a class="dropdown-item" href="<?= site_url() ?>user/registration">Signup</a>
									</li>
									<li>
										<a class="dropdown-item" href="<?= site_url() ?>flight/print_eticket">Manage my booking</a>
									</li>
								</ul>
							</li>
						<?php }else { ?>
							<li class="list-inline-item">
								<a class="pl-0" href="javascript:void(0)">
									<strong>Wallet Balance : </strong>
									<?= getTextCurrencySymbol()?> <?= convertPrice($this->user_data->cust_balance); ?>
								</a>
							</li>
							<li class="list-inline-item dropdown">
								<a href="#" class="dropdown-toggle pl-0" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> 
									Hi, <?= $this->session->userdata("Userlogin")["name"] ?> 
									<span class="caret"></span>
								</a>
								<ul class="dropdown-menu">
									<li>
										<a class="dropdown-item" href="<?= site_url() ?>user/dashboard">
											<i class="fa fa-ban" aria-hidden="true"></i> Dashboard
										</a>
									</li>
									<li>
										<a class="dropdown-item" href="<?= site_url() ?>user/editprofile">
											<i class="fa fa-ban" aria-hidden="true"></i> Edit Profile
										</a>
									</li>
									<li>
										<a class="dropdown-item" href="<?= site_url() ?>user/make_payment">
											<i class="fa fa-ban" aria-hidden="true"></i> Payment Upload
										</a>
									</li>                   
									<li>
										<a class="dropdown-item" href="<?= site_url() ?>flight/print_eticket">Flight Booking</a>
									</li>
									<li>
										<a class="dropdown-item" href="<?= site_url() ?>hotel/print_eticket">Hotel Booking</a>
									</li>
									<?php 
										if($this->session->userdata("Userlogin") != NULL){                       
											if(isset($_SESSION['fb_logout_url']) && $_SESSION['fb_logout_url'] != NULL){ 
									?> 
												<li>
													<a class="dropdown-item" href="<?= $_SESSION['fb_logout_url'] ?>">
														<i class="fa fa-ticket" aria-hidden="true"></i>Logout
													</a>
												</li>
											<?php } else { ?>
												<li>
													<a class="dropdown-item" href="<?= site_url() ?>user/logout">
														<i class="fa fa-ticket" aria-hidden="true"></i>Logout
													</a>
												</li>
											<?php } ?>
											<li> 
												<a class="dropdown-item" href="<?= site_url() ?>user/transaction_log">
													<i class="fa fa-list" aria-hidden="true"></i> Transaction Log
												</a>
											</li>
                    				<?php } ?>
                          		</ul>
                         	</li>
                       	<?php } ?>	
						<li class="list-inline-item dropdown ed">
							<a href="javascript:void(0)" id="my-acc" class="dropdown-toggle" data-toggle="dropdown">
		 						<i class="icofont-money"></i>
		 						<?= $current_currency ?>
		 					</a>
		 					<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
							 	<?php foreach($currency as $key => $item) { ?>
									<li>
										<a class="dropdown-item currency_change" href="<?= site_url() ?>front/currency/<?= $item?>"><?= $item ?></a>
									</li>
							 	<?php } ?>	
							</ul>
						</li>
		 			</ul>
		 		</div>
		 	</div>
		 </div>
	</div>
</header>
<div id="loader" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1111" aria-hidden="true">
	<div class="modal-dialog ">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="text-center w-100">Please Wait... </h5>
			</div>
			<div class="modal-body">
				<div class="text-center">
					<div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div><br/><br/><br/>
					<span class="block midfz pt-md-3 border-top">Do not refresh or close the Window</span>
				</div>
			</div>
		</div>
	</div>
</div>
