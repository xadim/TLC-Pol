<?php
/*
 * Plugin Name: Litebox Media
 * Plugin URI: http://phpcentre.net/wordpress-plugin-litebox
 * Description: This plugin will enable a popup modal for the video,audio,image,iframe and inline content in your wordpress theme. You can embed litebox via shortcode in everywhere you want, even in theme files. 
 * Author: PhPCentre 
 * Version: 1.3
 * Author URI: http://phpcentre.net
 * License: MIT License
 * Copyright: 2014 PhP Centre
 * Text Domain: litebox
*/

	
	if ( ! defined( 'ABSPATH' ) ) {
		
		exit; // disable direct access
	}

	if ( !defined( 'LITEBOX_VERSION' ) ) define( 'LITEBOX_VERSION', '1.3' );
	if ( !defined( 'LITEBOX_BASE_URL' ) ) define( 'LITEBOX_BASE_URL', trailingslashit( plugins_url( 'litebox' ) ) );
	if ( !defined( 'LITEBOX_ASSETS_URL' ) ) define( 'LITEBOX_ASSETS_URL', trailingslashit( LITEBOX_BASE_URL . 'assets' ) );
	if ( !defined( 'LITEBOX_PATH' ) ) define( 'LITEBOX_PATH', plugin_dir_path( __FILE__ ) );
	if ( !defined( 'litebox' ) ) define( 'litebox', 'litebox' );
	
	require_once( LITEBOX_PATH . '/inc/litebox.core.php' );

	add_action( 'plugins_loaded', array( 'liteBoxCore', 'init' ) );
	
	register_activation_hook( __FILE__, array( 'liteBoxCore', 'plugin_install' ) );
	
	register_uninstall_hook( __FILE__, array( 'liteBoxCore', 'plugin_uninstall' ) );

?>