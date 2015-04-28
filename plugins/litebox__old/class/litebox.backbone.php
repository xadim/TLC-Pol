<?php
	
/** 
  * @desc The project backbone.
  * 
*/

require_once("litebox.admin.php");

class liteBox extends liteBoxAdmin{
	
	
	/**
	 * __construct function.
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct(){
		
		self::loadOptions();
		
		add_action('admin_init', array(&$this, 'loadOptions'));
		add_action('admin_menu', array(__CLASS__, "menus"));
		
		
		if(is_admin()){
			add_action('admin_enqueue_scripts', array(__CLASS__, "adminHeadFiles"));
			
		}else{
			add_action('wp_enqueue_scripts', array(__CLASS__, "litebox_wp_latest_jquery"));
			add_shortcode('litebox', array(__CLASS__,'litebox_shortcode'));
		}
		register_activation_hook( __FILE__, array("liteBoxCore", 'install'));
	}
	
	
	
}
	
?>