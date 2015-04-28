<div id="LiteboxShortcode" style="display: none;">
		<h2><?php _e( "Shortcode Parameters", litebox ); ?></h2>
		<p><?php _e( "Customize some of the ways your litebox popup are presented on your page by using shortcode parameters. Here is the complete list", litebox ); ?>:</p>

		<table id="shortcodes">
			<thead>
				<tr>
					<th><?php _e( "PARAMETER", litebox); ?></th>
					<th><?php _e( "DEFAULT", litebox ); ?></th>
					<th><?php _e( "EXAMPLE", litebox ); ?></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><i>href</i> -- <?php _e( "This parameter could be the url of video you want to embed,the url of the iframe/image content or the id of your inline content", litebox ); ?></td>
					<td><?php _e( "none", litebox ); ?></td>
					<td>[litebox <i>href</i>="http://www.youtube.com/watch?v=EmSOTxW3lNI"]<br><br>
						[litebox <i>href</i>="http://cnn.com"]<br><br>
						[litebox <i>href</i>="../wp-content/uploads/2014/07/HD-1.jpg"]<br><br>
						[litebox <i>href</i>="#inline"]
					</td>
				</tr>
				<tr>
					<td><i>anch</i> -- <?php _e( "This parameter is for the anchor text that should be displayed", litebox ); ?></td>
					<td><?php _e( "none", litebox ); ?></td>
					<td>[litebox href="http://cnn.com" <i>anch</i>="cnn"]</td>
				</tr>
				<tr>
					<td><i>class</i> -- <?php _e( "This parameter is used to assign a class name to the link", litebox ); ?></td>
					<td><?php _e( "none", litebox ); ?></td>
					<td>[litebox href="http://cnn.com" <i>class</i>="your_class"]</td>
				</tr>
				<tr>
					<td><i>id</i> -- <?php _e( "This parameter is used to assign a unique id to the link", litebox ); ?></td>
					<td><?php _e( "none", litebox ); ?></td>
					<td>[litebox href="http://cnn.com" <i>id</i>="your_id"]</td>
				</tr>
				<tr>
					<td><i>group</i> -- <?php _e( "This parameter is used to group items together. See the demo page for sample", litebox ); ?></td>
					<td><?php _e( "none", litebox ); ?></td>
					<td>[litebox href="../wp-content/uploads/2014/07/HD-1.jpg"	<i>group</i>="ghd"]<br><br>
						[litebox href="../wp-content/uploads/2014/07/HD-2.jpg"	<i>group</i>="ghd"]
					</td>
				</tr>
				<tr>
					<td><i>color</i> -- <?php _e( "This parameter is use to set the color of the overlay,if not set the default will be used", litebox ); ?></td>
					<td><?php _e( "default", litebox ); ?> <i>#000</i>, but can be changed in the options page</td>
					<td>[litebox href="http://awmi.net" <i>color</i>="#1e8cbe"]</td>
				</tr>
				<tr>
					<td><i>incolor</i> -- <?php _e( "This parameter is use to set the color of the inline container,if not set the default will be used", litebox ); ?></td>
					<td><?php _e( "default", litebox ); ?> <i>#f f f</i>, but can be changed in the options page</td>
					<td>[litebox href="#div_id" <i>incolor</i>="#1e8cbe"]</td>
				</tr>
				<tr>
					<td><i>inhead</i> -- <?php _e( "This parameter is use to set the header text of the inline container,if not set the default will be used", litebox ); ?></td>
					<td><?php _e( "default", litebox ); ?> <i>Modal</i></td>
					<td>[litebox href="#div_id" <i>inhead</i>="Head"]</td>
				</tr>
				<tr>
					<td><i>infcolor</i> -- <?php _e( "This parameter is use to set the font color of the inline container,if not set the default will be used", litebox ); ?></td>
					<td><?php _e( "default", litebox ); ?> <i>#000</i>, <?php _e( "but can be changed in the options page", litebox ); ?></td>
					<td>[litebox href="#div_id" <i>infcolor</i>="#1e8cbe"]</td>
				</tr>
				<tr>
					<td><i>inffamily</i> -- <?php _e( "This parameter is use to set the font family of the inline container,if not set the default will be used", litebox ); ?></td>
					<td><?php _e( "default", litebox ); ?> <i>Lato, Calibri, Arial, sans-serif</i>, <?php _e( "but can be changed in the options page", litebox ); ?></td>
					<td>[litebox href="#div_id" <i>inffamily</i>="Tahoma, Geneva, sans-serif"]</td>
				</tr>
				<tr>
					<td><i>opacity</i> -- <?php _e( "This parameter is used to set the opacity of the overlay,if not set the default will be used", litebox ); ?></td>
					<td><?php _e( "default", litebox ); ?> <i>0.8</i>, <?php _e( "but can be changed in the options page", litebox ); ?></td>
					<td>[litebox href="http://awmi.net" <i>opacity</i>="0.5"]</td>
				</tr>
				<tr>
					<td><i>iconhover</i> -- <?php _e( "This parameter is used to set hover effect on images and media thumbnail ", litebox ); ?></td>
					<td><?php _e( "default", litebox ); ?> <i>false</i></td>
					<td>[litebox href="path/to/image/or/media" <i>iconhover</i>="true"]</td>
				</tr>
				<tr>
					<td><i>grayeffect</i> -- <?php _e( "This parameter is used to set gray effect on images only", litebox ); ?></td>
					<td><?php _e( "default", litebox ); ?> <i>false</i></td>
					<td>[litebox href="path/to/image/or/media" <i>grayeffect</i>="true"]</td>
				</tr>
				<tr>
					<td><i>indicators</i> -- <?php _e( "This parameter is used to set indicators for group images only", litebox ); ?></td>
					<td><?php _e( "default", litebox ); ?> <i>false</i></td>
					<td>[litebox href="path/to/image" <i>indicators</i>="true"]</td>
				</tr>
				<tr>
					<td><i>top</i> -- <?php _e( "This parameter is used to set the top position of the litebox popup in percent, if not set the default will be used", litebox ); ?></td>
					<td><?php _e( "default", litebox ); ?> <i>10%</i>, <?php _e( "but can be changed in the options page", litebox ); ?></td>
					<td>[litebox href="http://awmi.net" <i>top</i>="30"]</td>
				</tr>
				<tr>
					<td><i>right</i> -- <?php _e( "This parameter is used to set the right position of the litebox popup in percent, if not set the default will be used", litebox ); ?></td>
					<td><?php _e( "default", litebox ); ?> <i>10%</i>, <?php _e( "but can be changed in the options page", litebox ); ?></td>
					<td>[litebox href="http://awmi.net" <i>right</i>="40"]</td>
				</tr>
				<tr>
					<td><i>bottom</i> -- <?php _e( "This parameter is used to set the bottom position of the litebox popup in percent, if not set the default will be used", litebox ); ?></td>
					<td><?php _e( "default", litebox ); ?> <i>10%</i>, <?php _e( "but can be changed in the options page", litebox ); ?></td>
					<td>[litebox href="http://awmi.net" <i>bottom</i>="20"]</td>
				</tr>
				<tr>
					<td><i>left</i> -- <?php _e( "This parameter is used to set the left position of the litebox popup in percent, if not set the default will be used", litebox ); ?></td>
					<td><?php _e( "default", litebox ); ?> <i>10%</i>, <?php _e( "but can be changed in the options page", litebox ); ?></td>
					<td>[litebox href="http://awmi.net" <i>left</i>="5"]</td>
				</tr>
			</tbody>
		</table>
	</div>