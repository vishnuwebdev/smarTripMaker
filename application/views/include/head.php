<!DOCTYPE html>
<html lang="">
	<head>
		
		<!-- Meta Tag Start From here -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- Meta Tag end From here -->
		<meta name="agd-partner-manual-verification" />
		<!-- Project Title Here -->
		<title>Smart Trip Maker</title>
		<!-- Project Title end Here -->

		<!-- Project Stylesheet Here -->
		<link rel="stylesheet" href="<?php echo site_url();?>assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo site_url();?>assets/css/icofont.min.css">
		<link rel="stylesheet" href="<?php echo site_url();?>assets/css/jquery-ui.min.css">
		<link rel="stylesheet" href="<?php echo site_url();?>assets/css/owl.carousel.min.css">
		<link rel="stylesheet" href="<?php echo site_url();?>assets/css/jquery.fancybox.min.css">
		<link rel="stylesheet" href="<?php echo site_url();?>assets/css/style.css">
		<link rel="stylesheet" href="<?php echo site_url();?>assets/css/header-footer.css">
		<link rel="stylesheet" href="<?php echo site_url();?>assets/css/media.css">
		<link href="https://fonts.googleapis.com/css?family=Rubik:300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
		<link rel="stylesheet" href="<?php echo site_url();?>assets/css/slick.css">
		<link rel="stylesheet" href="<?php echo site_url();?>plugin/toaster/jquery.toast.min.css">
		<!-- Project Stylesheet end Here -->

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->

		<!-- Favicon  -->
		<link rel="apple-touch-icon" sizes="57x57" href="<?php echo site_url();?>assets/favicon/apple-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="<?php echo site_url();?>assets/favicon/apple-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="<?php echo site_url();?>assets/favicon/apple-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="<?php echo site_url();?>assets/favicon/apple-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="<?php echo site_url();?>assets/favicon/apple-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="<?php echo site_url();?>assets/favicon/apple-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="<?php echo site_url();?>assets/favicon/apple-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="<?php echo site_url();?>assets/favicon/apple-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="<?php echo site_url();?>assets/favicon/apple-icon-180x180.png">
		
		<!--
		<link rel="icon" type="image/png" sizes="192x192"  href="<?php echo site_url();?>assets/favicon/android-icon-192x192.png">
		<link rel="icon" type="image/png" sizes="32x32" href="<?php echo site_url();?>assets/favicon/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="96x96" href="<?php echo site_url();?>assets/favicon/favicon-96x96.png">
		<link rel="icon" type="image/png" sizes="16x16" href="<?php echo site_url();?>assets/favicon/favicon-16x16.png">
		-->
		<link rel="icon" href="<?php echo site_url();?>admin/assets/img/fevicon/<?php echo $this->dsa_data->dsa_fab; ?>">
		
		<link rel="manifest" href="<?php echo site_url();?>assets/favicon/manifest.json">
		<meta name="msapplication-TileColor" content="#ffffff">
		<meta name="msapplication-TileImage" content="<?php echo site_url();?>assets/favicon/ms-icon-144x144.png">
		<meta name="theme-color" content="#ffffff">	
			
		<!-- Global site tag (gtag.js) - Google Analytics -->

		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-113017432-1"></script>
		<script>

			window.dataLayer = window.dataLayer || [];
			function gtag(){ dataLayer.push(arguments); }
			gtag('js', new Date());
			gtag('config', 'UA-113017432-1');
			var currentCurrency = "<?= getCurrentCurrency() ?>";
			var configKey = "<?= FIXER_ACCESS_KEY ?>";
			var convertType = "<?= CURRENCY_CONVERT_TYPE ?>";
			var URI = "<?= FIXER_SSL_URL ?>";
			
			function covertAmount(amount,to = currentCurrency,from =convertType) {
				return new Promise(function (resolve, reject) {
					var RequestURL = URI+"?access_key="+configKey+"&from="+from+"&to="+to+"&amount="+amount;
					let xhr = new XMLHttpRequest();
					xhr.open("GET", RequestURL);
					xhr.onload = function () {
						if (this.status >= 200 && this.status < 300) {
							var response = JSON.parse(xhr.response);
							if(typeof response != "undefined" && typeof response.result != 'undefined'){
								var convertAmount  = parseFloat(response.result);
								resolve(convertAmount);
							}else{
								resolve(amount);
							}
						} else {
							reject({
								status: this.status,
								statusText: xhr.statusText
							});
						}
					};
					xhr.onerror = function () {
						reject({
							status: this.status,
							statusText: xhr.statusText
						});
					};
					xhr.send();
				});
			}

			// var amt = covertAmount(200);
			// amt.then(item=>console.log(item)).catch(err=>console.log(err));
			
			
		</script>
		
	</head>
	<body>