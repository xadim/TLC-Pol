<?php 
if(isset($_POST["submit"])){	
$options=array($_POST);
liteBoxCore::updateOptions($options);
}
liteBoxCore::loadOptions();

 ?>
<div class="wrap">
<h2><?php _e('Litebox - A light weight Popup window', 'litebox'); ?></h2>

<?php add_thickbox(); ?>
<div id='setting-error-settings_updated' class='updated settings-error'> 
<p><strong><?php _e('Litebox related: ', 'litebox'); ?></strong>
	<a href="#TB_inline?height=500&width=800&inlineId=LiteboxHelp" class="thickbox" rel="Litebox Help"><?php _e('View Help', 'litebox'); ?></a> | 
	<a href="#TB_inline?height=500&width=800&inlineId=LiteboxShortcode" class="thickbox" rel="Litebox Shortcode"><?php _e('Shortcode Parameter', 'litebox'); ?></a> | 
	<a href="http://wordpress.org/plugins/litebox/" target="_blank" ><?php _e('Litebox on WordPress', 'litebox'); ?></a> | 
	<a href="http://phpcentre.net/wordpress-plugin-litebox" target="_blank" ><?php _e('Report a Bug', 'litebox'); ?></a> |
	<a href="http://phpcentre.net/wordpress-plugin-litebox" target="_blank" ><?php _e('Litebox Demo', 'litebox'); ?></a>
</p>
</div>
<!-- settings !-->
<form method="post" action="">
    
	
	<!-- basic settings !-->
    <h3><?php _e('Basic Settings','litebox'); ?></h3>
	<div class="LiteboxBlockcontent">
	    <p><?php _e('These options are the basic options for the popup window box, any changes made here <br>will overide the default settings of the modal window.The default settings are listed <br>beside each form field.', 'litebox');?><br />
	    <?php _e('', 'litebox'); ?></p>
		
	    <!-- reveal speed -->
		<?php liteBoxCore::displayInput(__('Reveal Speed', 'litebox'), 'reveal_speed','','',10,400); ?>
	    <div class="default_text"><?php _e('The fade in time of the litebox, default:<span class="defaults">\'400\'</span>.','litebox'); ?></div>
		
		<!-- background color -->
		<?php liteBoxCore::displayInput(__('Overlay Color', 'litebox'), 'background_color','','cpa-color-picker'); ?>
	    <div class="default_text"><?php _e('Background color of the overlay, default:<span class="defaults">\'#000\'</span>.<br> This option can be overwritten with the shortcode <br> attribute <span class="defaults">\'color\'</span>.', 'litebox'); ?></div>
		
		
		<!-- opacity -->
		<?php liteBoxCore::displayInput(__('Opacity', 'litebox'), 'opacity','','',5,0.8); ?>
	    <div class="default_text"><?php _e('Opacity of the overlay, default:<span class="defaults">\'0.8\'</span>. This option can <br>be overwritten with the shortcode attribute <span class="defaults">\'opacity\'</span>.', 'litebox'); ?></div>
		
		
        <!-- window position -->
		<div class="default_text2"><?php _e('Window Position', 'litebox'); ?></div>
		<?php liteBoxCore::displayNumberInput(__('top, default:<span class="defaults">\'10%\'</span>. This option can be overwritten <br>using the shortcode attribute <span class="defaults">\'top\'</span>.', 'litebox'), 'win_pos_top','	TOP','%',10,100); ?>
		<?php liteBoxCore::displayNumberInput(__('right, default:<span class="defaults">\'10%\'</span>. This option can be overwritten <br>using the shortcode attribute <span class="defaults">\'right\'</span>.', 'litebox'), 'win_pos_right','RIGHT','%',10,100); ?>
	    <?php liteBoxCore::displayNumberInput(__('bottom, default:<span class="defaults">\'10%\'</span>. This option can be overwritten <br>using the shortcode attribute <span class="defaults">\'bottom\'</span>.', 'litebox'), 'win_pos_bottom','BOTTOM','%',10,100); ?>
	    <?php liteBoxCore::displayNumberInput(__('left, default:<span class="defaults">\'10%\'</span>. This option can be overwritten <br>using the shortcode attribute <span class="defaults">\'left\'</span>.', 'litebox'), 'win_pos_left','LEFT','%',10,100); ?>
	    
		
		<!--overlayclose -->
		<?php liteBoxCore::displaySelect(__('Overlay Close', 'litebox'), 'overlay_close', array(__('TRUE', 'litebox') => 'true', __('FALSE', 'litebox') =>'false')); ?>
		<div class="default_text"><?php _e('Force the window to close with click on any part <br>of the overlay, default:<span class="defaults">\'TRUE\'</span>.', 'litebox'); ?></div>
        
		<!-- esckey -->
		<?php liteBoxCore::displaySelect(__('Escape Key', 'litebox'), 'escape_key', array(__('TRUE', 'litebox') => 'true', __('FALSE', 'litebox') => 'false')); ?>
		<div class="default_text"><?php _e('Force the window to close with esckey, <br>default:<span class="defaults">\'TRUE\'</span>.', 'litebox '); ?></div> 
         		 
	</div>
	
	<!-- inline settings !-->
    <h3><?php _e('Inline Settings','litebox'); ?></h3>
	<div class="LiteboxBlockcontent">
	  <p><?php _e('These options are for the default settings of the inline feature,the  container/font color,<br>the font-family of the  inline content can be set here . Check the default settings <br>beside each input field', 'litebox');?><br />
	  
	  	<!-- inline container color -->
		<?php liteBoxCore::displayInput(__('Inline Container Color', 'litebox'), 'inline_container_color','','cpa-color-picker'); ?>
	    <div class="default_text"><?php _e('Background color of the inline container,  default:<span class="defaults">\'#f f f\'</span> . This option can be overwritten<br> with the shortcode  attribute <span class="defaults">\'incolor\'</span>.', 'litebox'); ?></div>
		
		<!-- inline font color -->
		<?php liteBoxCore::displayInput(__('Inline Font Color', 'litebox'), 'inline_font_color','','cpa-color-picker'); ?>
	    <div class="default_text"><?php _e('Background color of the inline container, default:<span class="defaults">\'#0 0 0\'</span> . This option can be overwritten <br>with the shortcode  attribute <span class="defaults">\'infcolor\'</span>.', 'litebox'); ?></div>
		
		<!-- inline font-family -->
		<?php liteBoxCore::displayInput(__('Inline Font Family', 'litebox'), 'inline_font_family','','',30,"Lato, Calibri, Arial, sans-serif"); ?>
	    <div class="default_text"><?php _e('Opacity of the overlay, default:<span class="defaults">\'Lato, Calibri, Arial, sans-serif\'</span> . This option can be overwritten with <br>the shortcode  attribute <span class="defaults">\'inffamily\'</span>.', 'litebox'); ?></div>
		    
      		 
	</div>
	
	<!-- image settings !-->
    <h3><?php _e('Image Settings','litebox'); ?></h3>
	<div class="LiteboxBlockcontent">
	  <p><?php _e('These options are for images,you can set the size of the thumbnail and the gutter <br>between the thumbnails. Check the defaults settings beside each input field.', 'litebox');?><br />
	  
	  <!-- thumbnail size !-->
	  <div class="default_text2"><?php _e('Thumbnail Size', 'litebox'); ?></div>
	  <?php liteBoxCore::displayNumberInput(__('width, default:<span class="defaults">\'100px\'</span>.', 'litebox'), 'thumb_width_image','WIDTH','px',100,1000); ?>
	  <?php liteBoxCore::displayNumberInput(__('length, default:<span class="defaults">\'100px\'</span>.', 'litebox'), 'thumb_height_image','HEIGHT','px',100,1000); ?>
	   
	   <!-- gutter !-->
      <div class="default_text2"><?php _e('Gutter', 'litebox'); ?></div>
	  <?php liteBoxCore::displayNumberInput(__('Margin, default:<span class="defaults">\'7px\'</span>.', 'litebox'), 'gutter_margin_image','MARGIN','px',7,100); ?>
			   
      		 
	</div>
	
	<!-- video/audio settings !-->
    <h3><?php _e('Video/Audio Settings','litebox'); ?></h3>
	<div class="LiteboxBlockcontent">
	  <p><?php _e('These options are for the video and Audio content,you can set the size of the thumbnail <br>and the gutter between the thumbnails. Check the default settings beside each input field.', 'litebox');?><br />
	  
	  <!-- thumbnail size !-->
	  <div class="default_text2"><?php _e('Thumbnail Size', 'litebox'); ?></div>
	  <?php liteBoxCore::displayNumberInput(__('width, default:<span class="defaults">\'100px\'</span>.', 'litebox'), 'thumb_width_video','WIDTH','px',100,1000); ?>
	  <?php liteBoxCore::displayNumberInput(__('length, default:<span class="defaults">\'100px\'</span>.', 'litebox'), 'thumb_height_video','HEIGHT','px',100,1000); ?>
	   
	   <!-- gutter !-->
      <div class="default_text2"><?php _e('Gutter', 'litebox'); ?></div>
	  <?php liteBoxCore::displayNumberInput(__('Margin, default:<span class="defaults">\'7px\'</span>.', 'litebox'), 'gutter_margin_video','MARGIN','px',7,100); ?>
			   
      		 
	</div>
	
	<!-- ADVANCED SETTINGS -->
	<h3><?php _e('Advanced Settings', 'litebox'); ?></h3>
	<p><strong><?php _e('Warning: These options are for advanced users only!', 'litebox'); ?></strong></p>
     <div class="LiteboxBlockcontent">

		<!-- Change wpautop filter priority !-->    
	    <h4><?php _e('Litebox Advanced Options', 'litebox'); ?></h4>
	    <p><?php _e('The input options avaliable here all requires javascript functions. It is recommended to use single quotes in  your functions,<br>but if you must use double quotes,use the key ` for double quotes. For example(`hello`). Do not bother to escape your <br>functions it will be handled for you. ', 'litebox'); ?><br />
	 
	 
	    <!-- callbackInit -->
		<?php liteBoxCore::displayInput(__('CallbackInit', 'litebox'), 'callback_init','','',35,'function( ) { }'); ?>
	    <div class="default_text"><?php _e('Calls a JavaScript function when the <br> lightbox is initiated, default:<span class="defaults">\'function( ) { }\'</span>.', 'litebox'); ?></div>
		
		<!-- callbackBeforeOpen -->
		<?php liteBoxCore::displayInput(__('CallbackBeforeOpen', 'litebox'), 'callback_beforeopen','','',35,'function( ) { }'); ?>
	    <div class="default_text"><?php _e('Calls a JavaScript function before the <br>lightbox is opened, default:<span class="defaults">\'function( ) { }\'</span>.', 'litebox'); ?></div>
		
		<!-- callbackAfterOpen -->
		<?php liteBoxCore::displayInput(__('CallbackAfterOpen', 'litebox'), 'callback_afteropen','','',35,'function( ) { }'); ?>
	    <div class="default_text"><?php _e('Calls a JavaScript function after the <br>lightbox is opened, default:<span class="defaults">\'function( ) { }\'</span>.', 'litebox'); ?></div>
		
		<!-- callbackBeforeClose -->
		<?php liteBoxCore::displayInput(__('CallbackBeforeClose', 'litebox'), 'callback_beforeclose','','',35,'function( ) { }'); ?>
	    <div class="default_text"><?php _e('Calls a JavaScript function before the <br>litebox is closed, default:<span class="defaults">\'function( ) { }\'</span>.', 'litebox'); ?></div>
		 
		<!--callbackAfterClose  -->
		<?php liteBoxCore::displayInput(__('CallbackAfterClose', 'litebox'), 'callback_afterclose','','',35,'function( ) { }'); ?>
	    <div class="default_text"><?php _e('Calls a JavaScript function after the <br>litebox is closed, default:<span class="defaults">\'function( ) { }\'</span>.', 'litebox'); ?></div>
		 
		<!-- callbackError -->
		<?php liteBoxCore::displayInput(__('CallbackError', 'litebox'), 'callback_error','','',35,'function( ) { }'); ?>
	    <div class="default_text"><?php _e('Calls a JavaScript function when the <br>litebox encounters an error, default:<span class="defaults">\'function( ) { }\'</span>.', 'litebox'); ?></div>
		 
		<!-- callbackPrev -->
		<?php liteBoxCore::displayInput(__('CallbackPrev', 'litebox'), 'callback_prev','','',35,'function( ) { }'); ?>
	    <div class="default_text"><?php _e('Calls a JavaScript function when the <br>Prev button of the litebox is triggered, default:<span class="defaults">\'function( ) { }\'</span>.', 'litebox'); ?></div>
		  
		<!-- callbackNext -->
		<?php liteBoxCore::displayInput(__('CallbackNext', 'litebox'), 'callback_next','','',35,'function( ) { }'); ?>
	    <div class="default_text"><?php _e('Calls a JavaScript function when the <br>Next button of the litebox is triggered, default:<span class="defaults">\'function( ) { }\'</span>.', 'litebox'); ?></div>
		  
		<!-- erroMessage -->
		<?php liteBoxCore::displayInput(__('ErrorMessage', 'litebox'), 'error_message',' ','',35,'Error loading content'); ?>
	    <div class="default_text"><?php _e('Error message that is displayed upon the plugin <br> encountering an error, default:<span class="defaults">\'Error loading content\'</span>.', 'litebox'); ?></div>
		
	 </div> 

    <!-- submit !-->
    <?php submit_button(); ?>

</form>	 


<div id="LiteboxHelp" style="display: none;">
    <p><?php _e('Just insert an litebox shortcode into your posts/pages - That`s it!', 'litebox'); ?></p>

    <h2><?php _e('Litebox-Shortcode', 'litebox'); ?></h2>
    <p><?php _e('The  easy way to use Litebox is to insert the your href and anch parameter inside the shortcode.<br> For a full list of all possible parameters,see the shortcode parameter section.', 'litebox'); ?></p>

    <h4><?php _e('Video Example', 'litebox'); ?></h4>
    <pre>
      [litebox href="http://www.youtube.com/watch?v=EmSOTxW3lNI"]
    </pre>

    <h4><?php _e('Iframe Example', 'litebox'); ?></h4>
    <pre>
      [litebox href="http://cnn.com" anch="Iframe"]
    </pre>

   <h4><?php _e('Inline Example', 'litebox'); ?></h4>
   <pre>
     [litebox href="#inline" anch="Inline" top="10" right="30" bottom="10" left="30"]
   
    &lt;div style="display:none;" &gt;
       &lt;div id="inline"&gt;
         &lt;p&gt; Hello there &lt;/p&gt;
         &lt;p&gt; Hello there &lt;/p&gt;
         &lt;p&gt; Hello there &lt;/p&gt;
         &lt;p&gt; Hello there &lt;/p&gt;
         &lt;p&gt; Hello there &lt;/p&gt;
         &lt;p&gt; Hello there &lt;/p&gt;
         &lt;p&gt; Hello there &lt;/p&gt;
      &lt;/div&gt;
    &lt;/div&gt;  
   
   </pre>

   <h4><?php _e('Single Image Example', 'litebox'); ?></h4>
   <pre>
     [litebox href="../wp-content/uploads/2014/07/HD-1.jpg" ]
   </pre>

   <h4><?php _e('Group Image Example', 'litebox'); ?></h4>
   <pre>
     [litebox href="../wp-content/uploads/2014/07/HD-1.jpg"  group="ghd"]
     [litebox href="../wp-content/uploads/2014/07/HD-2.jpg"  group="ghd"]

  </pre>


  <h4><?php _e('Theme File Example', 'litebox'); ?></h4>
  <pre>
   &lt;?php echo do_shortcode('[litebox href="http://www.youtube.com/watch?v=EmSOTxW3lNI"]'); ?&gt;
  </pre>

  <p><?php _e('<strong>Note:</strong> When using the advanced options,its is recommended to use single quote in your function.<br>If you must use double quote,use this key ` it will be coverted to double quote for you.', 'litebox'); ?></p>
</div>

<div id="LiteboxShortcode" style="display: none;">
<h2><?php _e('Shortcode Parameters', 'litebox'); ?></h2>
<p><?php _e('Customize some of the ways your litebox popup are presented on your page by using shortcode parameters. Here is the complete list:', 'litebox'); ?></p>

<table id="shortcodes">
 <thead>
  <tr>
    <th>PARAMETER</th>
	<th>DEFAULT</th>
	<th>EXAMPLE</th>
  </tr>
  </thead>
  <tbody>
  <tr>
    <td><i>href</i> -- This parameter could be the url of video you want to embed,the url of the iframe/image  content or the id of your inline content</td>
	<td>none</td>
	<td >[litebox <i>href</i>="http://www.youtube.com/watch?v=EmSOTxW3lNI"]<br><br>
	[litebox <i>href</i>="http://cnn.com"]<br><br>
	[litebox <i>href</i>="../wp-content/uploads/2014/07/HD-1.jpg"]<br><br>
	[litebox <i>href</i>="#inline"]
	</td>
  </tr>
  <tr>
    <td><i>anch</i> -- This parameter is for the anchor text that should be displayed</td>
	<td>none</td>
	<td>[litebox href="http://cnn.com" <i>anch</i>="cnn"]</td>
  </tr>
  <tr>
    <td><i>class</i> -- This parameter is used to assign a class name to the link</td>
	<td>none</td>
	<td>[litebox href="http://cnn.com" <i>class</i>="your_class"]</td>
  </tr>
  <tr>
    <td><i>id</i> -- This parameter is used to assign a unique id to the link</td>
	<td>none</td>
	<td>[litebox href="http://cnn.com" <i>id</i>="your_id"]</td>
  </tr>
  <tr>
    <td><i>group</i> -- This parameter is used to group items together. See the demo page for sample</td>
	<td>none</td>
	<td>[litebox href="../wp-content/uploads/2014/07/HD-1.jpg"  <i>group</i>="ghd"]<br><br>
	[litebox href="../wp-content/uploads/2014/07/HD-2.jpg"  <i>group</i>="ghd"]
     </td>
  </tr>
  <tr>
    <td><i>color</i> --This parameter is use to set the color of the overlay,if not set the default will be used</td>
	<td>default <i>#000</i>, but can be changed in the options page</td>
	<td>[litebox href="http://awmi.net" <i>color</i>="#1e8cbe"]</td>
  </tr>
  <tr>
    <td><i>incolor</i> --This parameter is use to set the color of the inline container,if not set the default will be used</td>
	<td>default <i>#f f f</i>, but can be changed in the options page</td>
	<td>[litebox href="#div_id" <i>incolor</i>="#1e8cbe"]</td>
  </tr>
  <tr>
    <td><i>inhead</i> --This parameter is use to set the header text of the inline container,if not set the default will be used</td>
	<td>default <i>Modal</i></td>
	<td>[litebox href="#div_id" <i>inhead</i>="Head"]</td>
  </tr>
  <tr>
    <td><i>infcolor</i> --This parameter is use to set the font color of the inline container,if not set the default will be used</td>
	<td>default <i>#000</i>, but can be changed in the options page</td>
	<td>[litebox href="#div_id" <i>infcolor</i>="#1e8cbe"]</td>
  </tr>
  <tr>
    <td><i>inffamily</i> --This parameter is use to set the font family of the inline container,if not set the default will be used</td>
	<td>default <i>Lato, Calibri, Arial, sans-serif</i>, but can be changed in the options page</td>
	<td>[litebox href="#div_id" <i>inffamily</i>="Tahoma, Geneva, sans-serif"]</td>
  </tr>
  <tr>
    <td><i>opacity</i> -- This parameter is used to set the opacity of the overlay,if not set the default will be used</td>
	<td>default <i>0.8</i>, but can be changed in the options page</td>
	<td>[litebox href="http://awmi.net" <i>opacity</i>="0.5"]</td>
  </tr>
  <tr>
    <td><i>iconhover</i> -- This parameter is used to set hover effect on  images and media thumbnail </td>
	<td>default <i>false</i></td>
	<td>[litebox href="path/to/image/or/media" <i>iconhover</i>="true"]</td>
  </tr>
  <tr>
    <td><i>grayeffect</i> -- This parameter is used to set gray effect on images only</td>
	<td>default <i>false</i></td>
	<td>[litebox href="path/to/image/or/media" <i>grayeffect</i>="true"]</td>
  </tr>
  <tr>
    <td><i>indicators</i> -- This parameter is used to set indicators for group images only</td>
	<td>default <i>false</i></td>
	<td>[litebox href="path/to/image" <i>indicators</i>="true"]</td>
  </tr>
  <tr>
    <td><i>top</i> -- This parameter is used to set the top position of the litebox popup in percent, if not set the default will be used</td>
	<td>default <i>10%</i>, but can be changed in the options page</td>
	<td>[litebox href="http://awmi.net" <i>top</i>="30"]</td>
  </tr>
  <tr>
    <td><i>right</i> -- This parameter is used to set the right position of the litebox popup in percent, if not set the default will be used</td>
	<td>default <i>10%</i>, but can be changed in the options page</td>
	<td>[litebox href="http://awmi.net" <i>right</i>="40"]</td>
  </tr>
  <tr>
    <td><i>bottom</i> -- This parameter is used to set the bottom position of the litebox popup in percent, if not set the default will be used</td>
	<td>default <i>10%</i>, but can be changed in the options page</td>
	<td>[litebox href="http://awmi.net" <i>bottom</i>="20"]</td>
  </tr>
  <tr>
    <td><i>left</i> -- This parameter is used to set the left position of the litebox popup in percent, if not set the default will be used</td>
	<td>default <i>10%</i>, but can be changed in the options page</td>
	<td>[litebox href="http://awmi.net" <i>left</i>="5"]</td>
  </tr>
 </tbody>
</table>

</div>
	