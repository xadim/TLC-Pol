<?php

	$saved = false;
	if ( isset( $_POST['submit'] ) ) {	
		$options = array( $_POST );
		$saved = true;
		liteBoxCore::updateOptions( $options );
	}

	liteBoxCore::loadOptions();

 
	if( $saved ){
?>
		<div style="width:95%;margin-left:2px;" id="update_slider_success_message" class="message green">
			<span>
				<strong><?php _e( "Settings Saved", litebox ); ?></strong>
			</span>
		</div>
<?php
	}
	add_thickbox(); 
 ?>
	<div style="margin:5px 2px 2px;width:96%;" id='setting-error-settings_updated' class='updated settings-error'> 
		<p><strong><?php _e( "Litebox related: ", litebox ); ?></strong>
			<a href="#TB_inline?height=500&width=800&inlineId=LiteboxHelp" class="thickbox" rel="Litebox Help"><?php _e( "View Help", litebox ); ?></a> | 
			<a href="#TB_inline?height=500&width=800&inlineId=LiteboxShortcode" class="thickbox" rel="Litebox Shortcode"><?php _e( "Shortcode Parameter", litebox ); ?></a> | 
			<a href="http://wordpress.org/plugins/litebox/" target="_blank" ><?php _e( "Litebox on WordPress", litebox ); ?></a> | 
			<a href="http://phpcentre.net/wordpress-plugin-litebox" target="_blank" ><?php _e( "Report a Bug", litebox ); ?></a> |
			<a href="http://phpcentre.net/wordpress-plugin-litebox" target="_blank" ><?php _e( "Litebox Demo", litebox ); ?></a>
		</p>
	</div>
 <!--suppress ALL -->
    <form method="post" action="" id="global_settings" class="layout-form">
        <div id="poststuff" style="width: 99% !important;">
	        <div id="post-body" class="metabox-holder">
				<div id="postbox-container-2" class="postbox-container">
					<div id="advanced" class="meta-box-sortables">
						<div id="litebox_get_started" class="postbox" >
							<div class="handlediv" data-target="#ux_global_settings" title="Click to toggle" data-toggle="collapse"><br></div>
							<h3 class="hndle"><span><?php _e( "Litebox Settings", litebox ); ?></span></h3>
				            <div class="inside">
								<div id="ux_global_settings" class="litebox_layout">
							        <input type="submit" name="submit" class="btn btn-info" value="<?php _e( "Update Settings", litebox ); ?>" />
									<div class="separator-doubled"></div>
									<div class="fluid-layout">
										<div class="layout-span6">
											<div class="widget-layout">
												<div class="widget-layout-title">
													<h4>
														<?php _e("Basic Settings", litebox); ?>
														
													</h4>
								                    <span class="tools">
														<a data-target="#basic_settings" data-toggle="collapse">
															<i class="icon-chevron-down"></i>
														</a>
													</span>
												</div>
												<div id="basic_settings" class="collapse in">
													<div class="widget-layout-body">
														<div class="layout-control-group">
															<label class="layout-control-label" title="<?php _e( "Fade in time of the litebox, default : 400", litebox ); ?>"><?php _e( "Reveal Speed", litebox ); ?></label>
															<div class="layout-controls">
																<input type="number" min="0" max="1000" class="layout-span10" id="reveal_speed" placeholder="400"
									                            name="reveal_speed" value="<?php echo self::$litebox_options[0]->reveal_speed ?>"/>		
															</div>
								                        </div>  
											        </div>
													<div class="widget-layout-body">
														<div class="layout-control-group">
															<label class="layout-control-label" title="<?php _e( "Background color of the litebox overlay, default : '#000'. This option can be overwritten with the shortcode attribute 'color'", litebox ); ?>"><?php _e( "Overlay Color", litebox ); ?></label>
															<div class="layout-controls">
																<input type="text" class="cpa-color-picker" id="background_color" 
									                            name="background_color" value="<?php echo self::$litebox_options[0]->background_color ?>"/>		
															</div>
								                        </div>  
											        </div>
													<div class="widget-layout-body">
														<div class="layout-control-group">
															<label class="layout-control-label" title="<?php _e( "Opacity of the litebox overlay, default : '0.8'. This option can be overwritten with the shortcode attribute 'opacity'", litebox ); ?>"><?php _e( "Overlay Opacity", litebox ); ?></label>
															<div class="layout-controls">
																<input type="text"  class="layout-span10" id="opacity" placeholder="0.8"
									                            name="opacity" value="<?php echo self::$litebox_options[0]->opacity ?>"/>		
															</div>
								                        </div>  
											        </div>
													<div class="widget-layout-body">
														<div class="layout-control-group">
															<label class="layout-control-label" title="<?php _e( "Default : '10%'. This option can be overwritten using the shortcode attribute 'top'",litebox ); ?>" ><?php _e( "Modal Top Position", litebox ); ?></label>
															<div class="layout-controls">
																<input type="number" min="0" max="100" class="layout-span9 item" id="win_pos_top" placeholder="10"
									                            name="win_pos_top" value="<?php echo self::$litebox_options[0]->win_pos_top ?>"/>		
															    <span class="span1" style="padding-top:3px;">%</span>
															</div>
								                        </div>  
											        </div>
													<div class="widget-layout-body">
														<div class="layout-control-group">
															<label class="layout-control-label" title="<?php _e( "Default : '10%'. This option can be overwritten using the shortcode attribute 'right'",litebox ); ?>" ><?php _e( "Modal Right Position", litebox ); ?></label>
															<div class="layout-controls">
																<input type="number" min="0" max="100" class="layout-span9 item" id="win_pos_right" placeholder="10"
									                            name="win_pos_right" value="<?php echo self::$litebox_options[0]->win_pos_right ?>"/>		
															    <span class="span1" style="padding-top:3px;">%</span>
															</div>
								                        </div>  
											        </div>
													<div class="widget-layout-body">
														<div class="layout-control-group">
															<label class="layout-control-label" title="<?php _e( "Default : '10%'. This option can be overwritten using the shortcode attribute 'bottom'",litebox ); ?>"><?php _e( "Modal Bottom Position", litebox ); ?></label>
															<div class="layout-controls">
																<input type="number" min="0" max="100" class="layout-span9 item" id="win_pos_bottom" placeholder="10"
									                            name="win_pos_bottom" value="<?php echo self::$litebox_options[0]->win_pos_bottom ?>"/>		
															    <span class="span1" style="padding-top:3px;">%</span>
															</div>
								                        </div>  
											        </div>
													<div class="widget-layout-body">
														<div class="layout-control-group">
															<label class="layout-control-label" title="<?php _e( "Default : '10%'. This option can be overwritten using the shortcode attribute 'left'",litebox ); ?>"><?php _e( "Modal Left Position", litebox ); ?></label>
															<div class="layout-controls">
																<input type="number" min="0" max="100" class="layout-span9 item" id="win_pos_left" placeholder="10"
									                            name="win_pos_left" value="<?php echo self::$litebox_options[0]->win_pos_left ?>"/>		
															    <span class="span1" style="padding-top:3px;">%</span>
															</div>
								                        </div>  
											        </div>
													<div class="widget-layout-body">
														<div class="layout-control-group">
															<label class="layout-control-label" title="<?php _e( "Force the litebox modal to close on click on any part of the overlay, default : 'TRUE'", litebox ); ?>"><?php _e( "Overlay Close", litebox ); ?></label>
															<div class="layout-controls">
																<select id="overlay_close" class="layout-span10" name="overlay_close">
																	<option value="true" <?php echo $selected = ( self::$litebox_options[0]->overlay_close == 'true' ) ? 'selected="selected"' : ''; ?>><?php _e( "TRUE", litebox ); ?></option>
																	<option value="false" <?php echo $selected = ( self::$litebox_options[0]->overlay_close == 'false' ) ? 'selected="selected"' : ''; ?>><?php _e( "FALSE", litebox ); ?></option>
																</select>
															</div>
														</div>
													</div>
													<div class="widget-layout-body">
														<div class="layout-control-group">
															<label class="layout-control-label" title="<?php _e( "Force the litebox modal to close using esckey, default : 'TRUE'", litebox ); ?>"><?php _e( "Escape Key", litebox ); ?></label>
															<div class="layout-controls">
																<select id="escape_key" class="layout-span10" name="escape_key">
																	<option value="true" <?php echo $selected = ( self::$litebox_options[0]->escape_key == 'true' ) ? 'selected="selected"' : ''; ?>><?php _e( "TRUE", litebox ); ?></option>
																	<option value="false" <?php echo $selected = ( self::$litebox_options[0]->escape_key == 'false' ) ? 'selected="selected"' : ''; ?>><?php _e( "FALSE", litebox ); ?></option>
																</select>
															</div>
														</div>
													</div>
											    </div>
											</div>
											<div class="widget-layout">
												<div class="widget-layout-title">
													<h4><?php _e("Advanced Settings", litebox); ?></h4>
														<span class="tools">
															<a data-target="#advanced_settings" data-toggle="collapse">
					                                            <i class="icon-chevron-down"></i>
					                                        </a>
														</span>
												</div>
												<div id="advanced_settings" class="collapse in">
												    <div class="widget-layout-body">
														<div class="layout-control-group">
															<label class="layout-control-label" title="<?php _e( "Calls a JavaScript function when the litebox is initiated, default : 'function( ) { }'", litebox ); ?>"><?php _e( "CallbackInit", litebox ); ?></label>
															<div class="layout-controls">
																<input type="text" class="layout-span10" id="callback_init" placeholder="function( ) { }"
									                            name="callback_init" value="<?php echo self::$litebox_options[0]->callback_init ?>"/>		
															    </div>
								                        </div>  
											        </div>
												    <div class="widget-layout-body">
														<div class="layout-control-group">
															<label class="layout-control-label" title="<?php _e( "Calls a JavaScript function before the litebox is opened, default : 'function( ) { }'", litebox ); ?>"><?php _e( "CallbackBeforeOpen", litebox ); ?></label>
															<div class="layout-controls">
																<input type="text" class="layout-span10" id="callback_beforeopen" placeholder="function( ) { }"
									                            name="callback_beforeopen" value="<?php echo self::$litebox_options[0]->callback_beforeopen ?>"/>		
															    </div>
								                        </div>  
											        </div>
													<div class="widget-layout-body">
														<div class="layout-control-group">
															<label class="layout-control-label" title="<?php _e( "Calls a JavaScript function after the litebox is opened, default : 'function( ) { }'", litebox ); ?>"><?php _e( "CallbackAfterOpen", litebox ); ?></label>
															<div class="layout-controls">
																<input type="text" class="layout-span10" id="callback_afteropen" placeholder="function( ) { }"
									                            name="callback_afteropen" value="<?php echo self::$litebox_options[0]->callback_afteropen ?>"/>		
															    </div>
								                        </div>  
											        </div>
													<div class="widget-layout-body">
														<div class="layout-control-group">
															<label class="layout-control-label" title="<?php _e( "Calls a JavaScript function before the litebox is closed, default : 'function( ) { }'", litebox ); ?>"><?php _e( "CallbackBeforeClose", litebox ); ?></label>
															<div class="layout-controls">
																<input type="text" class="layout-span10" id="callback_beforeclose" placeholder="function( ) { }"
									                            name="callback_beforeclose" value="<?php echo self::$litebox_options[0]->callback_beforeclose ?>"/>		
															    </div>
								                        </div>  
											        </div>
													<div class="widget-layout-body">
														<div class="layout-control-group">
															<label class="layout-control-label" title="<?php _e( "Calls a JavaScript function after the litebox is closed, default : 'function( ) { }'", litebox ); ?>"><?php _e( "CallbackAfterClose", litebox ); ?></label>
															<div class="layout-controls">
																<input type="text" class="layout-span10" id="callback_afterclose" placeholder="function( ) { }"
									                            name="callback_afterclose" value="<?php echo self::$litebox_options[0]->callback_afterclose ?>"/>		
															    </div>
								                        </div>  
											        </div>
													<div class="widget-layout-body">
														<div class="layout-control-group">
															<label class="layout-control-label" title="<?php _e( "Calls a JavaScript function when the litebox encounters an error, default : 'function( ) { }'", litebox ); ?>"><?php _e( "CallbackError", litebox ); ?></label>
															<div class="layout-controls">
																<input type="text" class="layout-span10" id="callback_error" placeholder="function( ) { }"
									                            name="callback_error" value="<?php echo self::$litebox_options[0]->callback_error ?>"/>		
															    </div>
								                        </div>  
											        </div>
													<div class="widget-layout-body">
														<div class="layout-control-group">
															<label class="layout-control-label" title="<?php _e( "Calls a JavaScript function when the Prev button of the litebox is triggered, default : 'function( ) { }'", litebox ); ?>"><?php _e( "CallbackPrev", litebox ); ?></label>
															<div class="layout-controls">
																<input type="text" class="layout-span10" id="callback_prev" placeholder="function( ) { }"
									                            name="callback_prev" value="<?php echo self::$litebox_options[0]->callback_prev ?>"/>		
															    </div>
								                        </div>  
											        </div>
													<div class="widget-layout-body">
														<div class="layout-control-group">
															<label class="layout-control-label" title="<?php _e( "Calls a JavaScript function when the Next button of the litebox is triggered, default : 'function( ) { }'", litebox ); ?>"><?php _e( "CallbackNext", litebox ); ?></label>
															<div class="layout-controls">
																<input type="text" class="layout-span10" id="callback_next" placeholder="function( ) { }"
									                            name="callback_next" value="<?php echo self::$litebox_options[0]->callback_next ?>"/>		
															    </div>
								                        </div>  
											        </div>
													<div class="widget-layout-body">
														<div class="layout-control-group">
															<label class="layout-control-label" title="<?php _e( "Error message that is displayed upon the plugin encountering an error, default : 'Error loading content'", litebox ); ?>"><?php _e( "ErroMessage", litebox ); ?></label>
															<div class="layout-controls">
																<input type="text" class="layout-span10" id="error_message" placeholder="function( ) { }"
									                            name="error_message" value="<?php echo self::$litebox_options[0]->error_message ?>"/>		
															    </div>
								                        </div>  
											        </div>
												</div>
											</div>
								        </div>
										<div class="layout-span6">
											<div class="widget-layout">
												<div class="widget-layout-title">
													<h4><?php _e("Inline Settings", litebox); ?></h4>
														<span class="tools">
															<a data-target="#inline_settings" data-toggle="collapse">
					                                            <i class="icon-chevron-down"></i>
					                                        </a>
														</span>
												</div>
												<div id="inline_settings" class="collapse in">
												    <div class="widget-layout-body">
														<div class="layout-control-group">
															<label class="layout-control-label" title="<?php _e( "Background color of the inline container, default : '#f f f' . This option can be overwritten with the shortcode attribute 'incolor'", litebox ); ?>"><?php _e( "Inline Container Color", litebox ); ?></label>
															<div class="layout-controls">
																<input type="text" class="cpa-color-picker" id="inline_container_color" 
									                            name="inline_container_color" value="<?php echo self::$litebox_options[0]->inline_container_color ?>"/>		
															</div>
								                        </div>  
											        </div>
												    <div class="widget-layout-body">
														<div class="layout-control-group">
															<label class="layout-control-label" title="<?php _e( "Font color of the inline container, default : '#0 0 0' . This option can be overwritten with the shortcode attribute 'infcolor'", litebox ); ?>"><?php _e( "Inline Font Color", litebox ); ?></label>
															<div class="layout-controls">
																<input type="text" class="cpa-color-picker" id="inline_font_color" 
									                            name="inline_font_color" value="<?php echo self::$litebox_options[0]->inline_font_color ?>"/>		
															</div>
								                        </div>  
											        </div>
													<div class="widget-layout-body">
														<div class="layout-control-group">
															<label class="layout-control-label" title="<?php _e( "Font family of the inline container, default : 'Lato, Calibri, Arial, sans-serif' . This option can be overwritten with the shortcode attribute 'inffamily'", litebox ); ?>"><?php _e( "Inline Font Family", litebox ); ?></label>
															<div class="layout-controls">
																<input type="text" class="layout-span10" id="inline_font_family" placeholder="Lato, Calibri, Arial, sans-serif"
									                            name="inline_font_family" value="<?php echo self::$litebox_options[0]->inline_font_family ?>"/>		
															</div>
								                        </div>  
											        </div>
												</div>
											</div>
											<div class="widget-layout">
												<div class="widget-layout-title">
													<h4><?php _e( "Image Settings", litebox ); ?></h4>
														<span class="tools">
															<a data-target="#image_settings" data-toggle="collapse">
					                                            <i class="icon-chevron-down"></i>
					                                        </a>
														</span>
												</div>
												<div id="image_settings" class="collapse in">
												    <div class="widget-layout-body">
														<div class="layout-control-group">
															<label class="layout-control-label" title="<?php _e( "Default : '100px'", litebox ); ?>"><?php _e( "Thumbnail Width", litebox ); ?></label>
															<div class="layout-controls">
																<input type="number" min="0" max="1000" class="layout-span9 item" id="thumb_width_image" placeholder="100"
									                            name="thumb_width_image" value="<?php echo self::$litebox_options[0]->thumb_width_image ?>"/>		
															    <span class="span1" style="padding-top:3px;">px</span>
															</div>
								                        </div>  
											        </div>
												    <div class="widget-layout-body">
														<div class="layout-control-group">
															<label class="layout-control-label" title="<?php _e( "Default : '100px'", litebox ); ?>"><?php _e( "Thumbnail Height", litebox ); ?></label>
															<div class="layout-controls">
																<input type="number" min="0" max="1000" class="layout-span9 item" id="thumb_height_image" placeholder="100"
									                            name="thumb_height_image" value="<?php echo self::$litebox_options[0]->thumb_height_image ?>"/>		
															    <span class="span1" style="padding-top:3px;">px</span>
															</div>
								                        </div>  
											        </div>
													<div class="widget-layout-body">
														<div class="layout-control-group">
															<label class="layout-control-label" title="<?php _e( "Default : '7px'", litebox ); ?>"><?php _e( "Thumbnail Gutter", litebox ); ?></label>
															<div class="layout-controls">
																<input type="number" min="0" max="1000" class="layout-span9 item" id="gutter_margin_image" placeholder="7"
									                            name="gutter_margin_image" value="<?php echo self::$litebox_options[0]->gutter_margin_image ?>"/>		
															    <span class="span1" style="padding-top:3px;">px</span>
															</div>
								                        </div>  
											        </div>
												</div>
											</div>
											<div class="widget-layout">
												<div class="widget-layout-title">
													<h4><?php _e("Video/Audio Settings", litebox); ?></h4>
														<span class="tools">
															<a data-target="#video_settings" data-toggle="collapse">
					                                            <i class="icon-chevron-down"></i>
					                                        </a>
														</span>
												</div>
												<div id="video_settings" class="collapse in">
												    <div class="widget-layout-body">
														<div class="layout-control-group">
															<label class="layout-control-label" title="<?php _e( "Default : '100px'", litebox ); ?>"><?php _e( "Thumbnail Width", litebox ); ?></label>
															<div class="layout-controls">
																<input type="number" min="0" max="1000" class="layout-span9 item" id="thumb_width_video" placeholder="100"
									                            name="thumb_width_video" value="<?php echo self::$litebox_options[0]->thumb_width_video ?>"/>		
															    <span class="span1" style="padding-top:3px;">px</span>
															</div>
								                        </div>  
											        </div>
												    <div class="widget-layout-body">
														<div class="layout-control-group">
															<label class="layout-control-label" title="<?php _e( "Default : '100px'", litebox ); ?>"><?php _e( "Thumbnail Height", litebox ); ?></label>
															<div class="layout-controls">
																<input type="number" min="0" max="1000" class="layout-span9 item" id="thumb_height_video" placeholder="100"
									                            name="thumb_height_video" value="<?php echo self::$litebox_options[0]->thumb_height_video ?>"/>		
															    <span class="span1" style="padding-top:3px;">px</span>
															</div>
								                        </div>  
											        </div>
													<div class="widget-layout-body">
														<div class="layout-control-group">
															<label class="layout-control-label" title="<?php _e( "Default : '7px'", litebox ); ?>"><?php _e( "Thumbnail Gutter", litebox ); ?></label>
															<div class="layout-controls">
																<input type="number" min="0" max="1000" class="layout-span9 item" id="gutter_margin_video" placeholder="7"
									                            name="gutter_margin_video" value="<?php echo self::$litebox_options[0]->gutter_margin_video ?>"/>		
															    <span class="span1" style="padding-top:3px;">px</span>
															</div>
								                        </div>  
											        </div>
												</div>
											</div>
										</div>	
								    </div>
								</div>
							</div>	
				        </div>
				    </div>
				</div>				
	        </div>
		</div>
	<form>
	
	<script>
		jQuery(".litebox_layout label").tipsy({live: true, delayIn: 500, html: true, gravity: 'n'});
	</script>