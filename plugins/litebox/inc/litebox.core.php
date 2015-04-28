<?php
/**
 * @desc The core integration with WordPress.
 * 
 */

require_once( 'helper.php' );
 
class liteBoxCore{

	/**
	 *singelton instance
	 */
	protected static $instance;
	 
	public static $litebox_options,$class_media,$class_image;

	
	/**
	 * Constructor
	 */
	public function __construct(){
		
		$this->setup_actions();
		$this->setup_shortcode();
		
	}
	
	
	/**
	 * get singelton instance
	 */
	public static function init() {
	
        if( self::$instance == null ) {
			self::$instance = new	self();
		}
		return	self::$instance;
		
    }
	
	
	/**
	 * Hook Jssor Slider into WordPress
	 */
	private	function setup_actions() {
		
		add_action( 'admin_menu', array( $this, 'menus' ) );
		add_action( 'init', array( $this, 'load_plugin_textdomain' ) );
		
	}
	
	
	/**
     * Register the [litebox] shortcode.
     */
    private function setup_shortcode() {

        add_shortcode( 'litebox', array( $this, 'litebox_shortcode' ) );
        
    }
	
	/**
	 * Execute on plugin activate
	 */
	public static function plugin_install() {
	
		add_option( 'litebox_general_options' );
		
	}
	
	
	/**
	 * Execute on plugin uninstall
	 */
	public static function plugin_uninstall() {
	
		delete_option( 'litebox_general_options' );
		
	}
	
	
	/**
	 *Add the menu page
	 */
	public function menus() {
	
		$page = add_options_page( 'Litebox', __( 'Litebox', litebox ), 'manage_options', 'litebox.php', array( $this, 'render_admin_page' ) );
        
		// ensure our JavaScript is only loaded on the Litebox admin page
		add_action( 'admin_print_scripts-' . $page, array( $this, 'register_admin_scripts' ) );
		add_action( 'admin_print_styles-' . $page, array( $this, 'register_admin_styles' ) );
		
	}
	
	
	/**
     * Register admin styles
     */
	public static function register_admin_scripts() {

		wp_enqueue_script( 'cpa_custom_js', LITEBOX_ASSETS_URL . 'js/jquery.custom.js', array( 'jquery', 'wp-color-picker' ), '', true  );	
		wp_enqueue_script( 'bootstrap.js', LITEBOX_ASSETS_URL . 'js/bootstrap.js', array( 'jquery' ), LITEBOX_VERSION);
		wp_enqueue_script( 'tipsy.js', LITEBOX_ASSETS_URL . 'js/jquery.tipsy.js', array( 'jquery' ), LITEBOX_VERSION);
		
	}
	
	
	/**
     * Register admin styles
     */
    public function register_admin_styles() {

		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_style( 'admin-css', LITEBOX_ASSETS_URL . 'css/admin-css.css', false, LITEBOX_VERSION );
		wp_enqueue_style( 'stylesheet.css', LITEBOX_ASSETS_URL . 'css/stylesheet.css', false, LITEBOX_VERSION );
		wp_enqueue_style( 'font-awesome.css', LITEBOX_ASSETS_URL . 'css/font-awesome/css/font-awesome.css', false, LITEBOX_VERSION );
		wp_enqueue_style( 'system-message.css',	LITEBOX_ASSETS_URL . 'css/system-message.css', false, LITEBOX_VERSION );
		wp_enqueue_style( 'tipsy.css', LITEBOX_ASSETS_URL . 'css/tipsy.css', false, LITEBOX_VERSION );
		
    }
	
	
	/**
     * Render the admin page
     */
	public function render_admin_page() {
	
		include_once LITEBOX_PATH . '/views/litebox.admin.layout.php';
		include_once LITEBOX_PATH . '/views/help.php';
		include_once LITEBOX_PATH . '/views/shortcode.php';
		
	}

	/**
     * Initialise translations
     */
    public function load_plugin_textdomain() {

        load_plugin_textdomain( 'litebox', false, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );

    }
    
	/**
	 * hex2rgb function.
	 * 
	 * @access public
	 * @param mixed $hex
	 * @return void
	 */
	public static function hex2rgb( $hex ) {
		
		$hex = str_replace( '#', '', $hex );

		if ( strlen( $hex ) == 3 ) {
			$r = hexdec( substr( $hex, 0, 1 ).substr( $hex, 0, 1 ) );
			$g = hexdec( substr( $hex, 1, 1 ).substr( $hex, 1, 1 ) );
			$b = hexdec( substr( $hex, 2, 1 ).substr( $hex, 2, 1 ) );
		} else {
			$r = hexdec( substr( $hex, 0, 2 ) );
			$g = hexdec( substr( $hex, 2, 2 ) );
			$b = hexdec( substr( $hex,4 , 2 ) );
		}
		$rgb = array( $r, $g, $b );

		return implode( ',', $rgb ); // returns the rgb values separated by commas
		
	}
	
	
	/**
	 * loadOptions function
	 */
	public static function loadOptions() {
	
		self::$litebox_options = (array) wp_unslash( json_decode( get_option( 'litebox_general_options', true ) ) );
		return self::$litebox_options;
		
	}

	 
	/**
	 * updateOptions function
	 */
	public static function updateOptions( $options ) {
		
		//Unset unwanted options
		unset( $options[0]["_wpnonce"] );
		unset( $options[0]["submit"] );

		//form the options object or load it
		self::$litebox_options = empty( self::$litebox_options ) === TRUE ? array() : self::$litebox_options;

		//update the options and add new ones
		foreach( $options as $key => $opt ) {
			self::$litebox_options[$key] = $opt;
		}

		update_option( 'litebox_general_options', json_encode( self::$litebox_options ) );
		
	}
	 
	 
	/**
	 * winPos function
	 */
	public static function winPos( $inset ) {
	
		return ( self::$litebox_options[0]->$inset ) ? self::$litebox_options[0]->$inset : '10';
		
	}
	 
	
	/**
	 * callback function
	 */
	public static function callbacks( $inset ) {
	 
		if( self::$litebox_options[0]->$inset ) {
			$function = self::$litebox_options[0]->$inset;
			$function = str_replace( '`', '"',$function );
			return $function;
		} else {
			return'function() {}';
		}
		
	}	 

	/**
     * Shortcode used to display litebox
     *
     * @return string HTML output of the shortcode
     */
	public function litebox_shortcode( $atts ) {
	
		liteBoxCore::loadOptions();
		$background = ( self::$litebox_options[0]->background_color ) ?  self::$litebox_options[0]->background_color : '0,0,0';
		$opacity = ( self::$litebox_options[0]->opacity ) ? self::$litebox_options[0]->opacity : 0.8;
		$inColor = ( self::$litebox_options[0]->inline_container_color ) ? self::$litebox_options[0]->inline_container_color : '#fff';
		$infColor = ( self::$litebox_options[0]->inline_font_color ) ? self::$litebox_options[0]->inline_font_color : '#000';
		$infFamily =( self::$litebox_options[0]->inline_font_family ) ? self::$litebox_options[0]->inline_font_family : 'Lato, Calibri, Arial, sans-serif';
		
		add_action( 'wp_footer', array( $this, 'litebox_plugin_main_js' ) );
			
		$a = shortcode_atts( array(
			'href' => '',
			'anch' => '',
			'class' => '',
			'id' => '',
			'group' => '',
			'color' => $background,
			'incolor' => $inColor,
			'inhead' => 'Modal',
			'infcolor' => $infColor,
			'inffamily' => $infFamily,
			'opacity' => $opacity,
			'iconhover' => '',
			'grayeffect' => '',
			'indicators' => '',
			'top' => self::winPos( 'win_pos_top' ),
			'right' => self::winPos( 'win_pos_right' ),
			'bottom' => self::winPos( 'win_pos_bottom' ),
			'left' => self::winPos( 'win_pos_left' ),

		), $atts );
		
		$pattern = '/\.(jpeg|jpg|gif|png|bmp)/';
		$pattern2 = '/(youtube|youtu|vimeo|dailymotion|hulu|ustream|viddler|animoto|nfb|screenr|funnyordie|ted|coub|blip|ora|aol|college|jest|rdio|mixcloud|soundcloud|dotsub|chirb)/';
		$gutter_IM = ( self::$litebox_options[0]->gutter_margin_image ) ? self::$litebox_options[0]->gutter_margin_image : '7';
		$thumbW_IM = ( self::$litebox_options[0]->thumb_width_image ) ? self::$litebox_options[0]->thumb_width_image : '100';
		$thumbH_IM = ( self::$litebox_options[0]->thumb_height_image ) ? self::$litebox_options[0]->thumb_height_image : '100';
		$gutter_VD = ( self::$litebox_options[0]->gutter_margin_video ) ? self::$litebox_options[0]->gutter_margin_video : '7';
		$thumbW_VD = ( self::$litebox_options[0]->thumb_width_video ) ? self::$litebox_options[0]->thumb_width_video : '100';
		$thumbH_VD = ( self::$litebox_options[0]->thumb_height_video ) ? self::$litebox_options[0]->thumb_height_video : '100';
		
		$thumb = new thumbnail( $a['href'] );
		//$src = $thumb->Media_ID()[0];
		//$src2 = $thumb->Media_ID()[1];
	
		$color = self::hex2rgb( $a['color'] );
		$icon = "url('../wp-content/plugins/litebox/assets/imgs/slickhover/zoom.png') center center no-repeat #fff";
		$icon2 = "url('../wp-content/plugins/litebox/assets/imgs/slickhover/play.png') center center no-repeat #fff";
	 
		if (preg_match( $pattern,$a['href']	) ) {
			if ( $a['grayeffect'] ) {
				$item='item';	 
			} else {
				$item='';
			}	 
		}
		
		if ( preg_match( $pattern,$a['href'] ) ) {
			if ( $a['iconhover'] ) {
				$class1 = 'hover_image';
				self::$class_image = '.'.$class1;
				$backgroundicon1 = 'background:'.$icon.';';
			} else {
				$backgroundicon1='';
			}	
		} 
		 
		if ( preg_match( $pattern2, $a['href'] ) ) {
			if ( $a['iconhover'] ) {
				$class2 = 'hover_media';
				self::$class_media = '.'.$class2;
				$backgroundicon2 = 'background:'.$icon2.';';
			} else {
				$backgroundicon2 = '';
			}	
		}
	
		$list = '<div></div>';
	
		if ( preg_match( $pattern, $a['href'] ) ) {
			if ( !empty( $a['group'] ) ) {
				if( !empty( $a['indicators'] ) ) {
					$list .= '<div class="' . $item . '" style="position:relative;display:inline-block;float:left;' . $backgroundicon1 . '"><a class="litebox ' . esc_attr( $a['class'] ) . '" id="' . esc_attr( $a['id'] ) . '"	data-top="10%" data-right="10%"	data-bottom="10%" data-left="10%" data-colopa="rgba(' . $color . ',' . $a['opacity'] . ')" target="_self" href="' . esc_attr( $a['href'] ) . '" data-litebox-group="' . esc_attr( $a['group'] ) . '" data-indicator="true"><img	class="litebox-image ' . $class1 . '" style="max-width:' . $thumbW_IM . 'px;height:' . $thumbH_IM . 'px;margin:' . $gutter_IM . 'px;" src="' . ( $a['href'] ) . '"></a></div>';
				} else {
					if (!empty($a['anch']))
		  	{
	   			$list .='<div class="'.$item.'" style="position:relative;display:inline-block;float:left;'.$backgroundicon1.'">
	   			<a class="litebox '.esc_attr($a['class']).'" id="'.esc_attr($a['id']).'"  data-top="'.esc_attr($a['top']).'%" data-right="'.esc_attr($a['right']).'%"  
	   			data-bottom="'.esc_attr($a['bottom']).'%" data-left="'.esc_attr($a['left']).'%" data-colopa="rgba('.$color.','.$a['opacity'].')" 
	   			target="_self" href="'.esc_attr($a['href']).'" data-litebox-group="'.esc_attr($a['group']).'">
	   			'.($a['anch']).'</a></div>';
	   		}else
	   		{
	   			$list .='<div class="'.$item.'" style="position:relative;display:inline-block;float:left;'.$backgroundicon1.'">
<a class="litebox '.esc_attr($a['class']).'" id="'.esc_attr($a['id']).'"  data-top="'.esc_attr($a['top']).'%" data-right="'.esc_attr($a['right']).'%"  
data-bottom="'.esc_attr($a['bottom']).'%" data-left="'.esc_attr($a['left']).'%" data-colopa="rgba('.$color.','.$a['opacity'].')" target="_self" 
href="'.esc_attr($a['href']).'" data-litebox-group="'.esc_attr($a['group']).'">
	<img src="'.($a['href']).'">
</a></div>';
	   
	   		}}
			} else {
				$list .='<div class="' . $item . '" style="position:relative;display:inline-block;float:left;' . $backgroundicon1 . '"><a class="litebox ' . esc_attr( $a['class'] ) . '" id="' . esc_attr( $a['id'] ) . '" data-top="'.esc_attr( $a['top'] ) . '%" data-right="' . esc_attr( $a['right'] ) . '%"	data-bottom="' . esc_attr( $a['bottom'] ) . '%" data-left="' . esc_attr( $a['left'] ) . '%" data-colopa="rgba(' . $color . ',' . $a['opacity'] . ')" target="_self" href="' . esc_attr( $a['href'] ) . '"><img class="litebox-image ' . $class1 . '" style="max-width:' . $thumbW_IM . 'px;height:' . $thumbH_IM . 'px;margin:' . $gutter_IM . 'px;" src="' . ($a['href']) . '"></a></div>';	
			}
		} else if ( substr( ( $a['href'] ), 0, 1 ) == '#' ) {
			if ( !empty( $a['group'] ) ) {
				$list .= '<a class="litebox ' . esc_attr( $a['class'] ) . '"	id="' . esc_attr( $a['id'] ) . '" data-top="' . esc_attr( $a['top'] ) . '%" data-right="' . esc_attr( $a['right'] ) . '%"	data-bottom="' . esc_attr( $a['bottom'] ) . '%" data-left="' . esc_attr( $a['left'] ) . '%" data-colopa="rgba(' . $color.',' . $a['opacity'] . ')" target="_self" href="' . esc_attr( $a['href'] ) . '" data-litebox-group="' . esc_attr( $a['group'] ) . '" data-incolor="' . esc_attr( $a['incolor'] ) . '" data-inhead="' . esc_attr( $a['inhead'] ) . '" data-infcolor="' . esc_attr( $a['infcolor'] ) . '" data-inffamily="' . esc_attr( $a['inffamily'] ) . '">' . esc_attr( $a['anch'] ) . '</a>';	
			} else {
				$list .= '<a class="litebox ' . esc_attr( $a['class'] ) . '"	id="' . esc_attr( $a['id'] ) . '" data-top="' . esc_attr( $a['top'] ) . '%" data-right="' . esc_attr( $a['right'] ) . '%"	data-bottom="' . esc_attr( $a['bottom'] ) . '%" data-left="' . esc_attr( $a['left'] ) . '%" data-colopa="rgba(' . $color.',' . $a['opacity'] . ')" target="_self" href="' . esc_attr( $a['href'] ) . '" data-incolor="' . esc_attr( $a['incolor'] ) . '" data-inhead="' . esc_attr( $a['inhead'] ) . '" data-infcolor="' . esc_attr( $a['infcolor'] ) . '" data-inffamily="' . esc_attr( $a['inffamily'] ) . '">' . esc_attr( $a['anch'] ) . '</a>';	
			}
		} else if ( preg_match( $pattern2, $a['href'] ) ) {
			if ( !empty( $a['group'] ) ) {
				$list .= '<div style="position:relative;display:inline-block;float:left;' . $backgroundicon2 . '"><a data-src="' . $src2 . '" class="litebox ' . esc_attr( $a['class'] ) . '"	id="' . esc_attr( $a['id'] ) . '" data-top="' . esc_attr( $a['top'] ) . '%" data-right="' . esc_attr( $a['right'] ) . '%"	data-bottom="' . esc_attr( $a['bottom'] ) . '%" data-left="'.esc_attr( $a['left'] ) . '%" data-colopa="rgba(' . $color . ',' . $a['opacity'] . ')" target="_self" href="' . esc_attr( $a['href'] ) . '" data-litebox-group="' . esc_attr( $a['group'] ) .'"><img class="litebox-media ' . $class2 . '" style="max-width:' . $thumbW_VD . 'px;height:' . $thumbH_VD . 'px;margin:' . $gutter_VD . 'px;"	src="' . $src . '" /></a></div>';	
			} else {
				$list .= '<div style="position:relative;display:inline-block;float:left;' . $backgroundicon2 . '"><a data-src="' . $src2 . '" class="litebox ' . esc_attr( $a['class'] ) . '"	id="' . esc_attr( $a['id'] ) .'" data-top="' . esc_attr( $a['top'] ) . '%" data-right="' . esc_attr( $a['right'] ) . '%"	data-bottom="' . esc_attr( $a['bottom'] ) . '%" data-left="' . esc_attr( $a['left']) . '%" data-colopa="rgba(' . $color . ',' . $a['opacity'] . ')" target="_self" href="' . esc_attr( $a['href'] ) . '"><img class="litebox-media ' . $class2 . '" style="max-width:' . $thumbW_VD . 'px;height:' . $thumbH_VD . 'px;margin:' . $gutter_VD . 'px;" src="' . $src . '" /></a></div>';	
			}
		} else {
			if ( !empty( $a['group'] ) ) {
				$list .= '<a	class="litebox ' . esc_attr( $a['class'] ) . '"	id="' . esc_attr( $a['id'] ) . '" data-top="' . esc_attr( $a['top'] ) . '%" data-right="' . esc_attr( $a['right'] ) . '%"	data-bottom="' . esc_attr( $a['bottom'] ) . '%" data-left="' . esc_attr( $a['left'] ) . '%" data-colopa="rgba( ' . $color . ',' . $a['opacity'] . ')" target="_self" href="' . esc_attr( $a['href'] ) . '" data-litebox-group="' . esc_attr( $a['group'] ) . '">' . esc_attr( $a['anch'] ) . '</a>';	
			} else {
				$list .= '<a class="litebox ' . esc_attr( $a['class'] ) . '"	id="' . esc_attr( $a['id'] ) . '" data-top="' . esc_attr( $a['top'] ) . '%" data-right="' . esc_attr( $a['right'] ) . '%"	data-bottom="' . esc_attr( $a['bottom'] ) . '%" data-left="' . esc_attr( $a['left'] ) . '%" data-colopa="rgba( ' . $color . ',' . $a['opacity'] . ')" target="_self" href="' . esc_attr( $a['href'] ) . '">' . esc_attr( $a['anch'] ) . '</a>';	
			}
		}
	
		return $list;
	}
	 
	 
	/**
     * Function for HTML input text element
     */
	public static function displayInput( $title, $optionName, $label,$cssClass='', $size='', $placeholder='') {
		
		?>	
		<div class="LiteboxSetting">
			<div class="LiteboxSettingTitle"><?php echo $title ; ?></div>
				<div class="LiteboxSettingItem">
					<input size="<?php echo $size ?>" placeholder="<?php echo $placeholder; ?>" id="<?php echo $optionName; ?>" name="<?php echo $optionName;?>" type="text" value="<?php echo self::$litebox_options[0]->$optionName ?>" class="text <?php echo $cssClass; ?>" />
					<label for="<?php echo $optionName; ?>"><?php echo esc_html( $label ); ?></label>
				</div>
		 	<div class="LiteboxSettingClear"></div>
		</div>
		<?php
		
	}
		
	/**
     * Function for HTML input number element
     */
	public static function displayNumberInput( $title, $optionName, $label, $unit, $placeholder, $max) {
		
		?>	
		<div class="LiteboxSetting2">
			<div class="LiteboxSettingTitle2"><?php echo $title; ?></div>
				<div class="LiteboxSettingItem">
					<input style="width:50px;height:25px;" max="<?php echo $max ?>" min="0" placeholder="<?php echo $placeholder; ?>" id="<?php echo $optionName; ?>" name="<?php echo $optionName;?>" type="number" value="<?php echo self::$litebox_options[0]->$optionName ?>" class=" <?php echo $cssClass; ?>" /><?php echo $unit; ?>
					<label style="margin-left:15px;" for="<?php echo $optionName; ?>"><?php echo $label; ?></label>
				</div>
		 	<div class="LiteboxSettingClear"></div>
		</div>
		<?php
		
	}	
		
	
	/**
     * Function for HTML input select element
     */
	public function displaySelect( $title, $optionName, $values ) {
			
		?>
		<div class="LiteboxSetting">	
			<div class="LiteboxSettingTitle"><?php echo esc_html( $title	); ?></div>
				<div class="LiteboxSettingItem">
					<select name="<?php echo $optionName ?>" id="<?php echo $optionName ?>">
					<?php
						foreach ( $values as $key=>$value ) {
							$selected = ( self::$litebox_options[0]->$optionName == $value ) ? 'selected="selected"' : '';
							echo '<option value="'.$value.'" '.$selected.'>'. esc_html( $key ).'</option>';
						}
					?> 
					</select>			 
				</div>
			<div class="LiteboxSettingClear"></div>
		</div> 
		<?php
		
	} 
	
	


	/**
	 * Register frontend script/css for litebox
	 */
	public function litebox_plugin_main_js() {
	
		liteBoxCore::loadOptions();
		$revealspeed = ( self::$litebox_options[0]->reveal_speed ) ? self::$litebox_options[0]->reveal_speed : 400;
		$overlay = ( self::$litebox_options[0]->overlay_close ) ? self::$litebox_options[0]->overlay_close : 'true';
		$escape = ( self::$litebox_options[0]->escape_key ) ? self::$litebox_options[0]->escape_key : 'true';
		$errorMge = ( self::$litebox_options[0]->error_message ) ? self::$litebox_options[0]->error_message : 'Error loading content.';
		$class_M = self::$class_media;
		$class_I = self::$class_image;
	
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'litebox-grayscale-js', LITEBOX_ASSETS_URL . 'js/script.js', array( 'jquery' ), LITEBOX_VERSION );
		wp_enqueue_script( 'litebox-icon-js', LITEBOX_ASSETS_URL . 'js/jquery.slickhover.js', array('jquery'), LITEBOX_VERSION );
		wp_enqueue_script( 'litebox-js', LITEBOX_ASSETS_URL . 'js/litebox.js', array( 'jquery' ), LITEBOX_VERSION );
		wp_enqueue_script( 'images-loaded-js', LITEBOX_ASSETS_URL . 'js/images-loaded.min.js', array( 'jquery' ), LITEBOX_VERSION );
		wp_enqueue_style( 'litebox-css', LITEBOX_ASSETS_URL . 'css/litebox.css', false, LITEBOX_VERSION );
		echo '<script>jQuery(document).ready(function(){jQuery(".litebox").liteBox({revealSpeed:' . $revealspeed . ',overlayClose:' . $overlay . ',escKey: ' . $escape . ',callbackInit:' . self::callbacks( callback_init ) . ',callbackBeforeOpen: ' . self::callbacks( callback_beforeopen ) . ',callbackAfterOpen: ' . self::callbacks( callback_afteropen ) . ',callbackBeforeClose: ' . self::callbacks( callback_beforeclose ) . ',callbackAfterClose:' . self::callbacks( callback_afterclose ) . ',callbackError:' . self::callbacks( callback_error ) . ',callbackPrev:' . self::callbacks( callback_prev ) . ',callbackNext:' . self::callbacks( callback_next ) . ',errorMessage:\'' . $errorMge . '\',}); });</script>';
		echo '<script>jQuery(document).ready(function(){jQuery("' . $class_M . '").slickhover(); });</script>';
		echo '<script>jQuery(document).ready(function(){jQuery("' . $class_I . '").slickhover(); });</script>';
	
	}
	
}
?>