=== LiteBox ===
Tags: lightbox, gallery, image, video, audio, iframe, modal, popup, popup window, onclick popup, video popup , image popup, youtube, vimeo,  
Requires at least: 3.5
Tested up to: 3.9.1
Stable tag: 1.2
License: MIT X11-License
License URI: http://opensource.org/licenses/MIT

A Simple plugin that enables a popup modal for your video,Audio,image,iframe,inline content.

== Description ==

This plugin will enable you to easily add Video,Audio,Image,Iframe,and Inline content to your Wordpress site.Using it is as  simple as adding the shortcodes to your post and page or if preferred adding the shortcodes to the required theme template files.
A demo can be found here [here](http://phpcentre.net/wordpress-plugin-litebox)


= Plugin Features =
* Support for Video and Audio content.
* Support for image,iframe,inline content.
* Lots of admin options to play with
* Lots of shortcodes parameter to customize each popup modal.
* Thumbnail Support.
* Gallery Support.
* Support for javascript functions that can be executed at various times during
  the popup event.


= Supported Video Sites =
* youtube
* vimeo
* dailyMotion
* hulu
* ustream
* viddler
* animoto
* nfb
* screenr
* funnyordie
* ted
* coub
* blip
* ora.tv
* on.aol.com
* collegehumor
* jest
* dotsub

= Supported Audio Sites =
* rdio
* mixcloud
* soundcloud
* chirb


= Video Example =

Add the shortcodes to your post or pages. The href attribute should be the url of your video or Audio content
  <pre>
  [litebox href="http://www.youtube.com/watch?v=EmSOTxW3lNI"] 
   </pre>

 = Audio Example =
<pre>
 [litebox href="http://soundcloud.com/forss/flickermood"]
 </pre>
 
= Iframe Example =  
The anch should be the anchor text.
 <pre>
 [litebox href="http://cnn.com" anch="Iframe"  ]
 </pre>
  
= Inline Example =
<pre>
[litebox href="#inline" anch="Inline" ]
</pre>

= Single Image Example = 
<pre>
[litebox href="../wp-content/uploads/2014/07/HD-1.jpg" ]
[litebox href="../wp-content/uploads/2014/07/HD-2.jpg" ]
[litebox href="../wp-content/uploads/2014/07/HD-3.jpg" ]
[litebox href="../wp-content/uploads/2014/07/HD-4.jpg" ]
</pre>
 
= Group Image Example =
For group images use the group attribute , the value can be any string, but must the same for the entire images. 
<pre>
[litebox href="../wp-content/uploads/2014/07/HD-1.jpg"  group="ghd"]
[litebox href="../wp-content/uploads/2014/07/HD-2.jpg"  group="ghd"]
[litebox href="../wp-content/uploads/2014/07/HD-3.jpg"  group="ghd"]
[litebox href="../wp-content/uploads/2014/07/HD-4.jpg"  group="ghd"]
</pre>
 
= Shortcode Theme file Example =
Add the function with the shortcodes to your theme template files 
 <pre>
   &lt;?php 
   echo do_shortcode('[litebox href="http://vimeo.com/45427826" ]'); 
   ?&gt;
</pre>

== Installation ==

= System requirements =
* PHP 5
* Web browser with enabled Javscript (required for litebox)

= Installation =
1. Download the .zip file of the plugin and extract the content.
2. Upload the complete `litebox` folder to the `/wp-content/plugins/` directory.
3. Activate the plugin through the 'Plugins' menu in WordPress.
4. Go to to litebox settings page and select the default options which should be used.
5. That's it! You're done. Now you can place your shortcodes to your post/pages or your theme files.

== Frequently Asked Questions ==

= How do I install this plugin? =
You can install as others regular wordpress plugin. No different way. Please see on installation tab.

= Why can't I see the popup window onclick =
Make sure the syntax of your javascript function is correct.

= Why is the popup window blank =
Check the parameters of the url attribute you provided.

= How can I style the anchor text =
Use the class -litebox- to style the anchor text in your css file. 
  
== Screenshots ==
1. Youtube popup example
2. Vimeo popup example
3. Options Page - Basic Settings
4. Options Page - Advanced Settings


== Changelog ==
= 1.2 =
* Added support for more video sites.
* Added support for audio content.
* Added thumbnail support for video and audio content.
* Added more shortcode parameters.
* Added more admin options.
* Dropped support for kickstater vidoes.

= 1.1 = 
* Shortcodes re-written  for better plugin performance.
* Added support for image,iframe and inline content.
* Added support for image gallery. 
* Added support for overlay opacity customization.
* Added admin option for image settings,
* Now able to customize the litebox overlay color,opacity and position of each individual links. 
* Added more shortcodes attributes. 
* BugFix: The callback functions are now executed at the right time.

= 1.0 =
* Initial Release

== Upgrade Notice ==