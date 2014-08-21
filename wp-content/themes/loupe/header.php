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

<?php
	$manufacturers_filter = array();
	if(isset($_GET['manufacturer'])) {        
        $manufacturers_filter = explode(",", $_GET['manufacturer']);
	}

	$prices_filter = array();
	if(isset($_GET['price'])) {        
        $prices_filter = explode(",", $_GET['price']);
	}

	$filter_search = array("manufacturers"=>$manufacturers_filter, "prices"=>$prices_filter);

?>
	<script>
		var filter_search = <?php echo json_encode($filter_search); ?>;
	</script>
	
	<div id="page" class="hfeed site">
	<div class='watch-filters'>
		<div class='row manufacturers'>
			<div class='header'>FILTER BY WATCH MANUFACTURER</div>
			<?php
				$manufacturers = get_terms("manufacturer");
				foreach($manufacturers as $m) {
					//$url = "/?manufacturer=".$m->slug;
					$class = "";
					if(in_array($m->slug, $manufacturers_filter)) {
						$class = " active";
					}
					echo "<div class='col-md-9ths term-wrapper$class' data-slug='".$m->slug."'><span class='toggle'></span><a href='#' class='term'>".$m->name."</a></div>";
				}
			?>
		</div>
		<div class='row prices'>
			<div class='header'>FILTER BY PRICE RANGE</div>
			<?php
				$prices = get_terms("price");
				foreach($prices as $p) {
					//$url = "/?price=".$p->slug;
					$class = "";
					if(in_array($p->slug, $prices_filter)) {
						$class = " active";
					}
					echo "<div class='col-md-9ths term-wrapper$class' data-slug='".$p->slug."'><span class='toggle'></span><a href='#' class='term'>".$p->name."</a></div>";
				}
			?>
		</div>
		<div class='filter-submit'>
			<a href='#'>FILTER RESULTS</a>
		</div>
	</div>

	<div class='left-menu dark'>
		<a href='/' class='link'>HOME</a>
		<a href='#' class='link'>SUBSCRIBE</a>
		<a href="/about" class='link'>ABOUT</a>

		<div id="socialnav" class="">
			<?php wp_nav_menu(array('theme_location' => 'socialnav', 'menu_class' => 'navbar-nav', 'container' => false, 'items_wrap' => '<ul class="social">%3$s</ul>')); ?>
		</div><!-- #navbar -->
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
			<div id='search-box' class=''><?php get_search_form(true); ?></div>
			<div class='col-md-1 col-xs-4 search'>Search</div>
		</header><!-- #masthead -->


		<div id="main" class="site-main container-fluid">
