<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	    
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/bootstrap-theme.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/style.css" media="screen" />
	
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<div class='left-menu dark'>
		<a href='/' class='link'>HOME</a>
		<a href='#' class='link'>SUBSCRIBE</a>
		<a href="/about" class='link'>ABOUT</a>

		<div id="socialnav" class="">
			<?php wp_nav_menu(array('theme_location' => 'socialnav', 'menu_class' => 'navbar-nav', 'container' => false, 'items_wrap' => '<ul class="social">%3$s</ul>')); ?>
		</div><!-- #navbar -->
	</div>

	
	<div id="page" class="hfeed site">
	<div class='watch-filters'>
		<div class='row'>
			<div>FILTER BY WATCH MANUFACTURER</div>
			<?php
				$manufacturers = get_terms("manufacturer");
				foreach($manufacturers as $m) {
					$url = "/?manufacturer=".$m->slug;
					echo "<div class='col-md-9ths'><a href='$url' class='term'>".$m->name."</a></div>";
				}
			?>
		</div>
		<div class='row'>
			FILTER BY PRICE RANGE
			<?php
				$prices = get_terms("price");
				foreach($prices as $p) {
					$url = "/?price=".$p->slug;
					echo "<a href='$url' class='term'>".$p->name."</a>";
				}
			?>
		</div>
		<div class='filter-submit'>
			<a href='#'>FILTER RESULTS</a>
		</div>
	</div>
		<header id="masthead" class="site-header row dark" role="banner">
			<div class="col-md-1" id="navbtn" data-target="#subnav"></div>
			<div class='col-md-8'>
				<a class="home-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
					<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
				</a>
			</div>
			<div class='col-md-1 col-xs-4 sign-up'>Sign Up</div>
			<div class='col-md-1 col-xs-4 filter'>Filter</div>
			<div class='col-md-1 col-xs-4 search'>Search</div>
		</header><!-- #masthead -->


		<div id="main" class="site-main container-fluid">
