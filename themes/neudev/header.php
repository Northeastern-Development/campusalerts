<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no"/>
	<title><?php wp_title(''); ?></title>
	<link rel="apple-touch-icon" sizes="57x57"  href="https://brand.northeastern.edu/global/assets/favicon/apple-touch-57x57.png?v=2" />
	<link rel="apple-touch-icon" sizes="60x60"  href="https://brand.northeastern.edu/global/assets/favicon/apple-touch-60x60.png?v=2" />
	<link rel="apple-touch-icon" sizes="72x72"  href="https://brand.northeastern.edu/global/assets/favicon/apple-touch-72x72.png?v=2" />
	<link rel="apple-touch-icon" sizes="76x76"  href="https://brand.northeastern.edu/global/assets/favicon/apple-touch-76x76.png?v=2" />
	<link rel="apple-touch-icon" sizes="114x114"  href="https://brand.northeastern.edu/global/assets/favicon/apple-touch-114x114.png?v=2" />
	<link rel="apple-touch-icon" sizes="120x120"  href="https://brand.northeastern.edu/global/assets/favicon/apple-touch-120x120.png?v=2" />
	<link rel="apple-touch-icon" sizes="144x144"  href="https://brand.northeastern.edu/global/assets/favicon/apple-touch-144x144.png?v=2" />
	<link rel="apple-touch-icon" sizes="152x152"  href="https://brand.northeastern.edu/global/assets/favicon/apple-touch-152x152.png?v=2" />
	<link rel="icon" sizes="144x144" type="image/png" href="https://brand.northeastern.edu/global/assets/favicon/android-chrome-144x144.png?v=2" />
	<link rel="icon" sizes="32x32" type="image/png" href="https://brand.northeastern.edu/global/assets/favicon/favicon-32x32.png?v=2" />
	<link rel="icon" sizes="16x16" type="image/png" href="https://brand.northeastern.edu/global/assets/favicon/favicon-16x16.png?v=2" />
	<link rel="manifest" href="https://brand.northeastern.edu/global/assets/favicon/manifest.json" />
	<meta name="msapplication-TileColor" content="#ffffff" />
	<meta name="msapplication-TileImage" content="https://brand.northeastern.edu/global/assets/favicon/mstile-144x144.png?v=2" />
	<meta name="theme-color" content="#ffffff" />
	<meta name="author" content="Northeastern University, https://www.northeastern.edu" />
<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<!-- <p class="testp" style="position:fixed;background:#000;color:#fff;top:100px;left:0;font-weight:bold;font-size:20px;z-index:99999999;"></p> -->

			<?php if(function_exists("NUML_globalheader")){NUML_globalheader();} ?><header class="header clear" role="banner">
				<div id="header">
					<?php require_once(dirname(__FILE__)."/_includes/navigation.php"); ?>
				</div>
			</header>
			<!-- wrapper -->
			<div class="nua__wrapper">
