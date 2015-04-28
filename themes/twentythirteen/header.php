<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"> <!--<![endif]-->
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
    <link rel="shortcut icon" href="http://tlcpolitical.com/wp-content/themes/twentythirteen/images/favicon.ico">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
    <!--[if (IE 11) ]>
    <link rel="stylesheet" type="text/css" href="http://tlcpolitical.com/wp-content/themes/twentythirteen/css/ie.css">
    <!-->
    <?php wp_enqueue_script("jquery"); ?>
	<?php wp_head(); ?>

	<?php 

                    $home= "http://tlcpolitical.com/";
                    $services= "http://tlcpolitical.com/services/";
                    $tlc_political_team= "http://tlcpolitical.com/tlc-political-team/";
                    $clases="http://tlcpolitical.com/services/";
                    $theLatest="http://tlcpolitical.com/the-latest-news/";
                    $clients="http://tlcpolitical.com/clients/";
                    $contactus="http://tlcpolitical.com/contact/";
                    $thank="http://tlcpolitical.com/thank-you/";
                    $monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; 
                    if ($monUrl==$home)
                    {
                        $headerClass = "site-header";
                    }
                    elseif ($monUrl==$services)
                    {
                        $headerClass = "servicePageheader";
                    }
                    elseif ($monUrl==$tlc_political_team)
                    {
                        $headerClass = "tlc_political_team_header";
                    }
                    elseif ($monUrl==$theLatest)
                    {
                        $headerClass = "the_latestPageheader";
                    }
                    elseif ($monUrl==$clients)
                    {
                        $headerClass = "clientsPageheader";
                    }
                    elseif ($monUrl==$contactus)
                    {
                        $headerClass = "contactPageheader";
                    }
                    elseif ($monUrl==$thank)
                    {
                        $headerClass = "contactPageheader";
                    }
                    else
                    {
                        $headerClass = "content-header";
                    }
?>

</head>

<body <?php body_class(); ?>>
		<header id="masthead" class="<?php echo $headerClass;?> site" role="banner">
			
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
						<div class="logo"></div>
                        <?php //_e( '<img class="logo" src="http://www.tlcpolitical.com/wp-content/themes/twentythirteen/images/logo-grey.png">'); ?>
					</a>
					
			

			<div id="navbar" class="navbar">
				<nav id="site-navigation" class="navigation main-navigation" role="navigation">
					<h3 class="menu-toggle"><?php _e( '<img class="hamburger" src="http://tlcpolitical.com/wp-content/themes/twentythirteen/images/hamburger.png">', '' ); ?></h3>
					
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
					
				</nav><!-- #site-navigation -->
			</div><!-- #navbar -->
		</header><!-- #masthead -->

