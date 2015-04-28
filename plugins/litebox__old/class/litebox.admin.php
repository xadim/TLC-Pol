<?php

/**
 * @desc The admin panel class.
 * 
 */

require_once("litebox.core.php");

class liteBoxAdmin extends liteBoxCore{
    
     
	/**
	 * __construct function.
	 *
	 * @access public
	 * @return void
	 */
	public function __construct(){
		liteBoxCore::loadOptions();
		
	}

    /**
	 * menus function.
	 *
	 * @access public
	 * @static
	 * @return void
	 */
	public static function menus(){
		 add_options_page( 'Litebox', 'Litebox','manage_options','litebox.php',array(__CLASS__, 'menuPageLayout'));
         
	}


	/**
	 * menuPageLayout function.
	 *
	 * @access public
	 * @static
	 * @return void
	 */
	public static function menuPageLayout(){
		include(sprintf("misc/litebox.admin.layout.php", dirname(__FILE__)));
	}


	/**
	 * adminHeadFiles function.
	 *
	 * @access public
	 * @static
	 * @return void
	 */
	public static function adminHeadFiles(){

		if(is_admin()){
		wp_enqueue_script( 'cpa_custom_js', plugin_dir_url(__FILE__).'misc/js/jquery.custom.js', array( 'jquery', 'wp-color-picker' ), '', true  );	
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_style( 'admin-css', plugin_dir_url(__FILE__).'misc/css/admin-css.css');
		}
	}

}	
	
   


?>