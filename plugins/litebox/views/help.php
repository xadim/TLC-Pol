<div id="LiteboxHelp" style="display: none;">
		<p><?php _e( "Just insert the litebox shortcode into your posts/pages - That`s it!", litebox); ?></p>

		<h2><?php _e( "Litebox-Shortcode", litebox ); ?></h2>
		<p><?php _e( "The easy way to use Litebox is to set your href and anch parameter insert the shortcode.", litebox ); ?><br><?php _e( "For a full list of all possible parameters,see the shortcode parameter section.", litebox ); ?></p>

		<h4><?php _e( "Video Example", litebox ); ?></h4>
		<pre>
			[litebox href="http://www.youtube.com/watch?v=EmSOTxW3lNI" anch="youtube"]
		</pre>

		<h4><?php _e( "Iframe Example", litebox ); ?></h4>
		<pre>
			[litebox href="http://cnn.com" anch="Iframe"]
		</pre>

		<h4><?php _e( "Inline Example", litebox ); ?></h4>
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

		<h4><?php _e( "Single Image Example", litebox ); ?></h4>
		<pre>
			[litebox href="../wp-content/uploads/2014/07/HD-1.jpg" class="single_img"]
		</pre>

		<h4><?php _e( "Group Image Example", litebox ); ?></h4>
		<pre>
			[litebox href="../wp-content/uploads/2014/07/HD-1.jpg" class="single_img" group="ghd"]
			[litebox href="../wp-content/uploads/2014/07/HD-2.jpg" class="single_img" group="ghd"]

		</pre>


		<h4><?php _e( "Theme File Example", litebox ); ?></h4>
		<pre>
			&lt;?php echo do_shortcode('[litebox href="http://www.youtube.com/watch?v=EmSOTxW3lNI" anch="youtube"]'); ?&gt;
		</pre>

		<p><strong><?php _e( "Note", litebox ); ?>:</strong><?php _e( " When using the advanced options,its is recommended to use single quote in your function.", litebox ); ?><br><?php _e( "If you must use double quote,use this key", litebox ); ?> ` <?php _e( "it will be coverted to double quote for you.", litebox ); ?></p>
	</div>