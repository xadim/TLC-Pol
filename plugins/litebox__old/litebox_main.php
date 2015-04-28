<?php
/*
    Plugin Name: Litebox Media
    Plugin URI: http://phpcentre.net/wordpress-plugin-litebox
    Description: This plugin will enable a popup modal for the video,audio,image,iframe and inline content in your wordpress theme. You can embed litebox via shortcode in everywhere you want, even in theme files. 
    Author: PhPCentre 
    Version: 1.2
    Author URI: http://phpcentre.net

    Copyright (c) 2013-2014, PhPCentre

	Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
	
	The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
	
	THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/


 

 
 if ( ! defined( 'WPINC' ) ) {
    die;
}

require_once(plugin_dir_path( __FILE__ ) . "/class/litebox.backbone.php");

$liteBox = new liteBox();

?>