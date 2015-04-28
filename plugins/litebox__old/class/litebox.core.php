<?php
require_once("helper.php");
/**
 * @desc The core integration with WordPress.
 * 
 */


 
class liteBoxCore{

	public static $litebox_options;
	
	public static $class_media;
	
	public static $class_image;
     
	/**
	 * __construct function.
	 *
	 * @access public
	 * @return void
	 */
	public function __construct(){
		self::loadOptions();
		return $this;
	}

	/**
	 * install function.
	 *
	 * @access public
	 * @static
	 * @return void
	 */
	static function install() {
		add_option("litebox_general_options");
	}
	
	/**
	 * hex2rgb function.
	 * 
	 * @access public
	 * @param mixed $hex
	 * @return void
	 */
	public function hex2rgb($hex) {
		$hex = str_replace("#", "", $hex);

		if(strlen($hex) == 3) {
			$r = hexdec(substr($hex,0,1).substr($hex,0,1));
			$g = hexdec(substr($hex,1,1).substr($hex,1,1));
			$b = hexdec(substr($hex,2,1).substr($hex,2,1));
		} else {
			$r = hexdec(substr($hex,0,2));
			$g = hexdec(substr($hex,2,2));
			$b = hexdec(substr($hex,4,2));
		}
		$rgb = array($r, $g, $b);

		return implode(",", $rgb); // returns the rgb values separated by commas
	}
	
	/**
	 * loadOptions function.
	 *
	 * @access public
	 * @return object
	 */
	public static function loadOptions(){
		self::$litebox_options = (array)  stripslashes_deep(get_option("litebox_general_options", true));
		return $this;
	}

   
	/**
	 * updateOptions function.
	 *
	 * @access public
	 * @static
	 * @param mixed $options
	 * @return void
	 */
	public static function updateOptions($options){
		//Unset unwanted options
		unset($options[0]["_wpnonce"]);
		unset($options[0]["submit"]);


		//form the options object or load it
		self::$litebox_options = (empty(self::$litebox_options) === TRUE ? array() : self::$litebox_options);

		//update the options and add new ones
		foreach($options as $key => $opt){
			self::$litebox_options[$key] = $opt;
		}

		update_option("litebox_general_options", self::$litebox_options);
		return $this;
	}
	 
	 
    /**
     * winPos function
     * 
     * @access public 
     * @param string $inset
     * @return integer
     */
	public static function winPos($inset){
	  return (self::$litebox_options[0][$inset])?self::$litebox_options[0][$inset]:'10';
	}
	 
	
    /**
     * callbacks function
     * 
     * @access public 
     * @param string $inset
     * @return string
     */
	public static function callbacks($inset){
	 if(self::$litebox_options[0][$inset]){
	  $function=self::$litebox_options[0][$inset];
	  $function=str_replace('`','"',$function);
	  return $function;
	  }else{
     return'function() {}';
	 }
    }	 

    /**
     * 
     * litebox_shortcode function
     * 
     * @access public
	 * @param mixed $atts   
     * @param string $content
     * @return mixed
     */
    public function litebox_shortcode( $atts ) {
	$background=(self::$litebox_options[0]['background_color'])? self::hex2rgb(self::$litebox_options[0]['background_color']):'0,0,0';
	$opacity=(self::$litebox_options[0]['opacity'])?self::$litebox_options[0]['opacity']:0.8;
	$inColor=(self::$litebox_options[0]['inline_container_color'])?self::$litebox_options[0]['inline_container_color']:'#fff';
	$infColor=(self::$litebox_options[0]['inline_font_color'])?self::$litebox_options[0]['inline_font_color']:'#000';
	$infFamily=(self::$litebox_options[0]['inline_font_family'])?self::$litebox_options[0]['inline_font_family']:"Lato, Calibri, Arial, sans-serif";
	
	add_action('wp_footer', array(__CLASS__, "litebox_plugin_main_js"));
			
	
	$a = shortcode_atts( array(
                'href'  => '',
				'anch'  => '',
				'class' => '',
				'id'    => '',
				'group' => '',
				'color' => $background,
				'incolor' => $inColor,
				'inhead' => 'Modal',
				'infcolor' => $infColor,
				'inffamily' =>$infFamily,
				'opacity' => $opacity,
				'iconhover' => '',
				'grayeffect' => '',
				'indicators' => '',
				'top'   => self::winPos(win_pos_top),
				'right' => self::winPos(win_pos_right),
				'bottom' => self::winPos(win_pos_bottom),
				'left'  => self::winPos(win_pos_left),

	), $atts );
    $pattern='/\.(jpeg|jpg|gif|png|bmp)/';
	$pattern2='/(youtube|youtu|vimeo|dailymotion|hulu|ustream|viddler|animoto|nfb|screenr|funnyordie|ted|coub|blip|ora|aol|college|jest|rdio|mixcloud|soundcloud|dotsub|chirb)/';
	$gutter_IM=(self::$litebox_options[0]['gutter_margin_image'])?self::$litebox_options[0]['gutter_margin_image']:'7';
	$thumbW_IM=(self::$litebox_options[0]['thumb_width_image'])?self::$litebox_options[0]['thumb_width_image']:'100';
	$thumbH_IM=(self::$litebox_options[0]['thumb_height_image'])?self::$litebox_options[0]['thumb_height_image']:'100';
	$gutter_VD=(self::$litebox_options[0]['gutter_margin_video'])?self::$litebox_options[0]['gutter_margin_video']:'7';
	$thumbW_VD=(self::$litebox_options[0]['thumb_width_video'])?self::$litebox_options[0]['thumb_width_video']:'100';
	$thumbH_VD=(self::$litebox_options[0]['thumb_height_video'])?self::$litebox_options[0]['thumb_height_video']:'100';
	
	
	$thumb=new thumbnail($a['href']);
	$src=$thumb->Media_ID()[0];
	$src2=$thumb->Media_ID()[1];
	
	$color= self::hex2rgb($a['color']);
	$icon="url('../wp-content/plugins/litebox/class/misc/imgs/slickhover/zoom.png') center center no-repeat #fff";
    
	$icon2="url('../wp-content/plugins/litebox/class/misc/imgs/slickhover/Play.png') center center no-repeat #fff";
   
	if(preg_match($pattern,$a['href'])){
	  if($a['grayeffect']){
	    $item="item";   
	  }else{
      $item="";
     }	 
    }
    
	if(preg_match($pattern,$a['href'])){
	  if($a['iconhover']){
	    $class1="hover_image";
		self::$class_image='.'.$class1;
	   $backgroundicon1 = "background:".$icon.";";
      }else{
      $backgroundicon1="";
     }	
    } 
     
	if(preg_match($pattern2,$a['href'])){
	if($a['iconhover']){
	   $class2="hover_media";
	   self::$class_media='.'.$class2;
	   $backgroundicon2 = "background:".$icon2.";";
      }else{
      $backgroundicon2="";
     }	
    }
	
	$list = '
	<script type="text/javascript">
	 </script>';
	
	 
	if(preg_match($pattern,$a['href'])){
	   if (!empty($a['group'])){
	      if(!empty($a['indicators'])){
		  $list .='<div class="'.$item.'" style="position:relative;display:inline-block;float:left;'.$backgroundicon1.'"><a class="litebox '.esc_attr($a['class']).'" id="'.esc_attr($a['id']).'"  data-top="10%" data-right="10%"  data-bottom="10%" data-left="10%" data-colopa="rgba('.$color.','.$a['opacity'].')" target="_self" href="'.esc_attr($a['href']).'" data-litebox-group="'.esc_attr($a['group']).'" data-indicator="true"><img  class="litebox-image '.$class1.'" style="max-width:'.$thumbW_IM.'px;height:'.$thumbH_IM.'px;margin:'.$gutter_IM.'px;" src="'.($a['href']).'"></a></div>';
		  }else{
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
	   
	   		}
	     }
	   }else{
	   $list .='<div class="'.$item.'" style="position:relative;display:inline-block;float:left;'.$backgroundicon1.'"><a class="litebox '.esc_attr($a['class']).'" id="'.esc_attr($a['id']).'" data-top="'.esc_attr($a['top']).'%" data-right="'.esc_attr($a['right']).'%"  data-bottom="'.esc_attr($a['bottom']).'%" data-left="'.esc_attr($a['left']).'%" data-colopa="rgba('.$color.','.$a['opacity'].')"  target="_self" href="'.esc_attr($a['href']).'"><img class="litebox-image '.$class1.'" style="max-width:'.$thumbW_IM.'px;height:'.$thumbH_IM.'px;margin:'.$gutter_IM.'px;" src="'.($a['href']).'"></a></div>';	
	   }
	}elseif(substr(($a['href']),0, 1) == '#'){
	  
	   if (!empty($a['group'])){
	   $list .='<a class="litebox '.esc_attr($a['class']).'"  id="'.esc_attr($a['id']).'" data-top="'.esc_attr($a['top']).'%" data-right="'.esc_attr($a['right']).'%"  data-bottom="'.esc_attr($a['bottom']).'%" data-left="'.esc_attr($a['left']).'%" data-colopa="rgba('.$color.','.$a['opacity'].')" target="_self" href="'.esc_attr($a['href']).'" data-litebox-group="'.esc_attr($a['group']).'" data-incolor="'.esc_attr($a['incolor']).'" data-inhead="'.esc_attr($a['inhead']).'" data-infcolor="'.esc_attr($a['infcolor']).'" data-inffamily="'.esc_attr($a['inffamily']).'">'.esc_attr($a['anch']).'</a>';	
	    }else{
	$list .='<a class="litebox '.esc_attr($a['class']).'"  id="'.esc_attr($a['id']).'" data-top="'.esc_attr($a['top']).'%" data-right="'.esc_attr($a['right']).'%"  data-bottom="'.esc_attr($a['bottom']).'%" data-left="'.esc_attr($a['left']).'%" data-colopa="rgba('.$color.','.$a['opacity'].')" target="_self" href="'.esc_attr($a['href']).'" data-incolor="'.esc_attr($a['incolor']).'" data-inhead="'.esc_attr($a['inhead']).'" data-infcolor="'.esc_attr($a['infcolor']).'" data-inffamily="'.esc_attr($a['inffamily']).'">'.esc_attr($a['anch']).'</a>';	
	 }
	}elseif(preg_match($pattern2,$a['href'])) {
	
	if (!empty($a['group'])){
	
    $list .='<div style="position:relative;display:inline-block;float:left;'.$backgroundicon2.'"><a data-src="'.$src2.'" class="litebox '.esc_attr($a['class']).'"  id="'.esc_attr($a['id']).'" data-top="'.esc_attr($a['top']).'%" data-right="'.esc_attr($a['right']).'%"  data-bottom="'.esc_attr($a['bottom']).'%" data-left="'.esc_attr($a['left']).'%" data-colopa="rgba('.$color.','.$a['opacity'].')" target="_self" href="'.esc_attr($a['href']).'" data-litebox-group="'.esc_attr($a['group']).'"><img class="litebox-media '.$class2.'" style="max-width:'.$thumbW_VD.'px;height:'.$thumbH_VD.'px;margin:'.$gutter_VD.'px;"  src="'.$src.'" /></a></div>';	
	}else{
	$list .='<div style="position:relative;display:inline-block;float:left;'.$backgroundicon2.'"><a data-src="'.$src2.'" class="litebox '.esc_attr($a['class']).'"  id="'.esc_attr($a['id']).'" data-top="'.esc_attr($a['top']).'%" data-right="'.esc_attr($a['right']).'%"  data-bottom="'.esc_attr($a['bottom']).'%" data-left="'.esc_attr($a['left']).'%" data-colopa="rgba('.$color.','.$a['opacity'].')" target="_self" href="'.esc_attr($a['href']).'"><img class="litebox-media '.$class2.'" style="max-width:'.$thumbW_VD.'px;height:'.$thumbH_VD.'px;margin:'.$gutter_VD.'px;" src="'.$src.'" /></a></div>';	
	 }
	}else{
	  if (!empty($a['group'])){
	 $list .='<a  class="litebox '.esc_attr($a['class']).'"  id="'.esc_attr($a['id']).'" data-top="'.esc_attr($a['top']).'%" data-right="'.esc_attr($a['right']).'%"  data-bottom="'.esc_attr($a['bottom']).'%" data-left="'.esc_attr($a['left']).'%" data-colopa="rgba('.$color.','.$a['opacity'].')" target="_self" href="'.esc_attr($a['href']).'" data-litebox-group="'.esc_attr($a['group']).'">'.esc_attr($a['anch']).'</a>';	
	}else{
	$list .='<a class="litebox '.esc_attr($a['class']).'"  id="'.esc_attr($a['id']).'" data-top="'.esc_attr($a['top']).'%" data-right="'.esc_attr($a['right']).'%"  data-bottom="'.esc_attr($a['bottom']).'%" data-left="'.esc_attr($a['left']).'%" data-colopa="rgba('.$color.','.$a['opacity'].')" target="_self" href="'.esc_attr($a['href']).'">'.esc_attr($a['anch']).'</a>';	
	  }
	 }
	
	return $list;
   }
   
   
	/**
     *
     * displayInput function
     *	 
     * @access public 
     * @param string $title 
     * @param string $optionName 
     * @param string $label 
     * @param string $cssClass 
     * @param integer $size
     * @return void	 
     */
	public static function displayInput($title, $optionName, $label,$cssClass='',$size='',$placeholder=''){
		
		
		?>	
	 <div class="LiteboxSetting">
		<div class="LiteboxSettingTitle"><?php echo ($title); ?></div>
		 <div class="LiteboxSettingItem">
			<input size="<?php echo $size ?>" placeholder="<?php echo $placeholder; ?>" id="<?php echo $optionName; ?>" name="<?php echo $optionName;?>" type="text" value="<?php echo self::$litebox_options[0][$optionName] ?>" class="text <?php echo $cssClass; ?>" />
			<label for="<?php echo $optionName; ?>"><?php echo esc_html($label); ?></label>
	   	 </div>
	   	<div class="LiteboxSettingClear"></div>
	 </div>
	      <?php
		}
		
	/**
    * displayNumberInput function
	*
	* @access public
    * @param String $title
	* @param String $optionName
	* @param String $label
	* @return void
    */
	public static function displayNumberInput($title, $optionName, $label,$unit,$placeholder,$max){
		
		
		?>	
	 <div class="LiteboxSetting2">
		<div class="LiteboxSettingTitle2"><?php echo ($title); ?></div>
		 <div class="LiteboxSettingItem">
			<input style="width:50px;height:25px;" max="<?php echo $max ?>" min="0" placeholder="<?php echo $placeholder; ?>" id="<?php echo $optionName; ?>" name="<?php echo $optionName;?>" type="number" value="<?php echo self::$litebox_options[0][$optionName] ?>" class="text <?php echo $cssClass; ?>" /><?php echo $unit; ?>
			<label style="margin-left:15px;" for="<?php echo $optionName; ?>"><?php echo $label; ?></label>
	   	</div>
	   	<div class="LiteboxSettingClear"></div>
	 </div>
	      <?php
		}	
    
	
	/**
	 * displaySelect function
	 *
	 * @access public
	 * @param String $title
	 * @param String $optionName
	 * @param Array $values
	 * @return void
	 */
	public function displaySelect($title, $optionName, $values){
			
			?>
	  			
	  <div class="LiteboxSetting">	
		<div class="LiteboxSettingTitle"><?php echo esc_html($title); ?></div>
		 <div class="LiteboxSettingItem">
	        <select name="<?php echo $optionName ?>" id="<?php echo $optionName ?>">
			<?php
			
			foreach ($values as $key=>$value){
				$selected = (self::$litebox_options[0][$optionName] == $value) ? 'selected="selected"' : '';
				echo '<option value="'.$value.'" '.$selected.'>'. esc_html($key).'</option>';
			}
			?> 
	        </select>       
		 </div>
	    <div class="LiteboxSettingClear"></div>
	  </div> 
	    <?php 
	    } 
	
    /**
     * litebox_wp_latest_jquery function 
     * 
     * @access public
     * @return void
     */
	public function litebox_wp_latest_jquery() {
	wp_enqueue_script('jquery');
    }


    /**
     * litebox_plugin_main_js function
     * 
     * @access public
     * @return void
     */
    public static function litebox_plugin_main_js() {
	$revealspeed=(self::$litebox_options[0]['reveal_speed'])? self::$litebox_options[0]['reveal_speed']:400;
    $overlay=(self::$litebox_options[0]['overlay_close'])?self::$litebox_options[0]['overlay_close']:'true';
	$escape=(self::$litebox_options[0]['escape_key'])?self::$litebox_options[0]['escape_key']:'true';
	$errorMge=(self::$litebox_options[0]['error_message'])?self::$litebox_options[0]['error_message']:'Error loading content.';
	$class_M=self::$class_media;
	$class_I=self::$class_image;
	
	wp_enqueue_script( 'litebox-grayscale-js', plugin_dir_url(__FILE__).'misc/js/grayeffect.js', array('jquery'), 1.0);
	wp_enqueue_script( 'litebox-icon-js', plugin_dir_url(__FILE__).'misc/js/jquery.slickhover.js', array('jquery'), 1.0);
    wp_enqueue_script( 'litebox-js', plugin_dir_url(__FILE__).'misc/js/litebox.js', array('jquery'), 1.0);
    wp_enqueue_script( 'images-loaded-js', plugin_dir_url(__FILE__).'misc/js/images-loaded.min.js');
    wp_enqueue_style( 'litebox-css', plugin_dir_url(__FILE__).'misc/css/litebox.css');
	 echo '<script>jQuery(document).ready(function(){jQuery(".litebox").liteBox({revealSpeed:'.$revealspeed.',overlayClose:'.$overlay.',escKey: '.$escape.',callbackInit:'.self::callbacks(callback_init).',callbackBeforeOpen: '.self::callbacks(callback_beforeopen).',callbackAfterOpen: '.self::callbacks(callback_afteropen).',callbackBeforeClose: '.self::callbacks(callback_beforeclose).',callbackAfterClose:'.self::callbacks(callback_afterclose).',callbackError:'.self::callbacks(callback_error).',callbackPrev:'.self::callbacks(callback_prev).',callbackNext:'.self::callbacks(callback_next).',errorMessage:\''.$errorMge.'\',}); });</script>';
	 echo '<script>jQuery(document).ready(function(){jQuery("'.$class_M.'").slickhover(); });</script>';
      echo '<script>jQuery(document).ready(function(){jQuery("'.$class_I.'").slickhover(); });</script>';
  
  } 
		
		
}

?>