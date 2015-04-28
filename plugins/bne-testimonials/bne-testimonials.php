<?php
/*
 * Plugin Name: BNE Testimonials
 * Version: 1.6.3
 * Plugin URI: http://www.bluenotesentertainment.com/blog/new-testimonial-plugin-for-wordpress/
 * Description: Adds a Custom Post Type to display Testimonials on any page, post, or sidebar. Display the testimonials as a list or slider powered by Flexslider. Shortcodes: [bne_testimonials_list] & [bne_testimonials_slider]. Includes corresponding widget options.
 * Author: Kerry Kline, Bluenotes Entertainment
 * Author URI: http://www.bluenotesentertainment.com
 * Requires at least: 3.7
 * License: GPL2

    Copyright 2013-2014  Bluenotes Entertainment

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License version 2,
    as published by the Free Software Foundation.

    You may NOT assume that you can use any other version of the GPL.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    The license for this software can likely be found here:
    http://www.gnu.org/licenses/gpl-2.0.html

*/


// Exit if accessed directly
if ( !defined('ABSPATH') ) exit;



/* ===========================================================
 *	Plugin Constants
 * ======================================================== */

define( 'BNE_TESTIMONIALS_VERSION', '1.6.3' );
define( 'BNE_TESTIMONIALS_DIR', dirname( __FILE__ ) );
define( 'BNE_TESTIMONIALS_URI', plugins_url( '', __FILE__ ) );
define( 'BNE_TESTIMONIALS_BASENAME', plugin_basename( __FILE__ ) );



/* ===========================================================
 *	Plugin Includes
 * ======================================================== */


// CPT Settings and Admin Plugin Functions
include_once( BNE_TESTIMONIALS_DIR . '/includes/cpt.php' );

// Taxonomy
include_once( BNE_TESTIMONIALS_DIR . '/includes/taxonomy.php' );

// Shortcodes
include_once( BNE_TESTIMONIALS_DIR . '/includes/shortcode-list.php' );
include_once( BNE_TESTIMONIALS_DIR . '/includes/shortcode-slider.php' );

// Widgets
include_once( BNE_TESTIMONIALS_DIR . '/includes/widget-slider.php' );
include_once( BNE_TESTIMONIALS_DIR . '/includes/widget-list.php' );

// Admin Help Page
include_once( BNE_TESTIMONIALS_DIR . '/includes/help.php' );



/* ===========================================================
 *	Scripts and Styles
 * ======================================================== */


/*
 *	Register Plugin CSS and JS
 *	@since v1.5
 *	@updated Dec 27 2013
*/
function bne_testimonials_register_scripts() {
	
	// Register the CSS
	wp_register_style( 'bne-testimonial-styles', BNE_TESTIMONIALS_URI . '/assets/css/bne-testimonials.css', '', BNE_TESTIMONIALS_VERSION, 'all' );

	// Register the JS
	wp_register_script( 'flexslider', BNE_TESTIMONIALS_URI . '/assets/js/flexslider.min-v2.2.0.js', array('jquery'), '2.2.0', true );
	
	// Load the plugin CSS
	wp_enqueue_style( 'bne-testimonial-styles' );
			
}
add_action( 'wp_enqueue_scripts', 'bne_testimonials_register_scripts' );



/*
 *	Testimonial List Script Enqueue (Called from shortcode/widget)
 *	@since v1.5
 *	@updated Dec 27 2013
*/
function bne_testimonials_list_enqueue_scripts() {
	//wp_enqueue_style( 'bne-testimonial-styles');				
}



/*
 *	Testimonial Slider Script Enqueue (Called from shortcode/widget)
 *	@since v1.5
 *	@updated Dec 20 2013
*/
function bne_testimonials_slider_enqueue_scripts() {
	wp_enqueue_script( 'jquery' ); // just in case...
	wp_enqueue_script( 'flexslider' );
	//wp_enqueue_style( 'bne-testimonial-styles');				
}



/* ===========================================================
 *	Testimonial Output Functions
 * ======================================================== */


/*
 *	Testimonial Single Structure and Layout Order
 *
 *	$options - Pulls in Array Options
 *
 *	@since v1.6
 *	@updated Dec 27 2013
*/
function bne_testimonials_single_structure( $options ) {
	
	// Empty String
	$shortcode_output = '';

	

	// Testimonial Thumbnail
	if ( $options['image'] != 'false' ) {
		//$shortcode_output .= bne_testimonials_featured_image( $options );
	}

	// Testimonial Title
	if ( $options['name'] != 'false' ) {
		$shortcode_output .= bne_testimonials_title( $options );
	}

	// Testimonial Whole Content												
	$shortcode_output .= '
	<div class="col-md-8 bne_testimonials_whole_content">'.bne_testimonials_the_whole_content( $options ).'</div>
	<div class="col-md-1"></div>
	</div>';

	// Testimonial Tagline and Website URL
	if ( !empty( $options['tagline'] ) || !empty( $options['website_url'] ) ) {
		//$shortcode_output .= bne_testimonials_details( $options );
	}
	
	// Testimonial Content												
	//$shortcode_output .= bne_testimonials_the_content( $options );
	
	return apply_filters( 'bne_testimonials_single_structure', $shortcode_output, $options );
}



/*
 *	Testimonial Featured Image
 *	$options - Pulls in Array Options
 *
 *	@since v1.6
 *	@updated Dec 27 2013
*/
function bne_testimonials_featured_image( $options ) {
	
	// If Lightbox Rel is set, apply it to the featured image
	if ($options['lightbox_rel']) {
		$shortcode_output = '<a href="'.$options['lightbox_url'].'" rel="'.$options['lightbox_rel'].'" title="'.$options['lightbox_title'].'">';
			$shortcode_output .= $options['featured_image'];
		$shortcode_output .= '</a>';
	}
	
	// No Lightbox Rel is set, only display the featured image (normal)
	else {
		$shortcode_output = $options['featured_image'];
	}
	
	//return apply_filters( 'bne_testimonials_featured_image', $shortcode_output, $options );
}



/*
 *	Testimonial Title 
 *	$options - Pulls in Array Options
 *
 *	@since v1.6
 *	@updated Dec 20 2013
*/
function bne_testimonials_title( $options ) {
	$get_content = get_the_title();  
	//$first_lines = trim_text($get_content, 28);
	$comma = ',';
	//code to get the first and last name of the congresman
	$result = substr($get_content, 0, strpos($get_content, $comma));
	//get the number of characters
	$str = $result;
	$number = strlen($str); 
	//get the rest of the string
	$r_position = substr($get_content, ($number+2));
	$r_position2 = substr($r_position, 0, strpos($r_position, $comma));
	$str2 = $r_position2;
	$number2 = strlen($str2); 
	$r_pos = substr($r_position, ($number2+2));

//echo "<p>'.$r_position2.'</p>
//	<p>'.$r_pos.'</p>";
if ($get_content) {
	
	$shortcode_output = '
	<div class="row">
	<div class=" col-md-1"></div>
	<div class="col-md-2 bne-testimonial-titleline">
	<h3>'.$get_content.'</h3>
	<p>'.get_field("role").'</p>
	<p>'.get_field("run_for").'</p>
	</div>
	';
}else{
	$shortcode_output = '
	<div class="row">
	<div class=" col-md-2"></div>
	';
}	
	return apply_filters( 'bne_testimonials_title', $shortcode_output, $options );
}


function bne_testimonials_the_whole_content( $options ) {
	//<img src="http://www.designsabove.com/tlcpolitical/wp-content/plugins/bne-testimonials/assets/images/accolade_left.png">
	// Format the Content
	$get_content = wpautop( get_the_content() );  
	$shortcode_output = $get_content;



	return apply_filters( 'bne_testimonials_the_whole_content', $shortcode_output, $options );
}




/*
 *	Testimonial Tagline and Website URL Ouput
 *	$options - Pulls in Array Options
 *
 *	@since v1.6
 *	@updated Dec 27 2013
*/
function bne_testimonials_details( $options ) {
	
	$shortcode_output = '<div>';
	
		// Tagline/Company Name Only
		if ( empty( $options['website_url'] ) ) {
			$shortcode_output .= '

			<div class="row">
				<div class="col-xs-1 col-sm-1 col-md-1"></div>
				<div class="col-xs-10 col-sm-10 col-md-10 bne-testimonial-tagline"><h3>'.$options['tagline'].'</h3></div>
				<div class="col-xs-1 col-sm-1 col-md-1"></div>
			</div>
			';
		}
		
		// Website URL Only
		if ( empty( $options['tagline'] ) ) {
			$shortcode_output .= '<span class="bne-testimonial-website-url"><a href="'.$options['website_url'].'" target="_blank">'.$options['website_url'].'</a></span>';
		}
		
		// Tagline/Company Name and Website URL
		if ( !empty( $options['tagline'] ) && !empty( $options['website_url'] ) ) {
			$shortcode_output .= '<span class="bne-testimonial-website-url"><a href="'.$options['website_url'].'" target="_blank" title="'.$options['tagline'].'">'.$options['tagline'].'</a></span>';
		}
	
	$shortcode_output .= '</div><!-- bne-testimonial-details (end) -->';
	
	return apply_filters( 'bne_testimonials_details', $shortcode_output, $options );
}


function trim_text($text, $count){
$text = str_replace("  ", " ", $text);
$string = explode(" ", $text);
for ( $wordCounter = 0; $wordCounter <= $count; $wordCounter++ ){
$trimed .= $string[$wordCounter];
if ( $wordCounter < $count ){ $trimed .= " "; }
else { $trimed .= "..."; }
}
$trimed = trim($trimed);
return $trimed;
} 


/*
 *	Testimonial Post Content Output
 *
 *	@param $options - Pulls in Array
 *
 *	@since v1.1
 *	@updated May 23 2014
*/
function bne_testimonials_the_content( $options ) {
	//<img src="http://www.designsabove.com/tlcpolitical/wp-content/plugins/bne-testimonials/assets/images/accolade_left.png">
	// Format the Content

	$get_content = wpautop( get_the_content() );  
	//$first_lines = trim_text($get_content, 28);
	$comma = ',';
	$result = substr($get_content, 0, strpos($get_content, $comma)); // $result = php


	$shortcode_output = '
	<div class="row">
		<div class="col-xs-1 col-sm-1 col-md-1"></div>
		<div class="col-xs-10 col-sm-10 col-md-10 bne-testimonial-description">'.$result.'</div>
		<div class="col-xs-1 col-sm-1 col-md-1"></div>
	</div>';

	return apply_filters( 'bne_testimonials_the_content', $shortcode_output, $options );
}









