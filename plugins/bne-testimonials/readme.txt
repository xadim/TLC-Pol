=== BNE Testimonials ===
Author URI: http://www.bluenotesentertainment.com
Contributors: bluenotes
Tags: testimonials, flexslider, feedback, reviews
Requires at least: 3.7
Tested up to: 4.0
Stable tag: 1.6.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html


Display testimonials and reviews on any page as a list or slider using a shortcodes or provided widgets.


== Description ==

Adds a new Post Type to display Testimonials on your website as a list or slider (flexslider). Each testimonial includes a title, featured image, tagline, website, message, and includes a custom taxonomy to seperate your testimonials into different groups (categories). Supports multiple uses on any page or post.

Available Shortcodes: [bne_testimonials_list] & [bne_testimonials_slider]. Also includes widget versions of the list and slider display. View the [live demo](http://www.bluenotesentertainment.com/products/testimonials-wordpress-pro/ "BNE Testimonials PRO"). You can see how the list and slider displays will look including different image styles. Free version does not include Masonry or form submission. 

= Display your testimonials as a List =
The list view allows you display your testimonials in a unified format must like an archive blog page. You can specify when elements are now shown and the style of the testimonial photo (featured image). You can also arrange your testimonials based on publish date, name, or random. Set your testimonials into categories to display multiple instances throughout your page. Use the shortcode [bne_testimonials_list]

= Display your testimonials as a Slider =
The slider version is built using Flexslider.js. Does everything as the list view but as a slideshow using either Fade or Slide transitions. Set your testimonials into categories to display multiple instances throughout your page.  Use the shortcode [bne_testimonials_slider]

= Upgrade to the Pro Version! =
We have a PRO version of BNE Testimonials on our [website](http://www.bluenotesentertainment.com/products/testimonials-wordpress-pro/ "BNE Testimonials PRO"). The Pro version adds a 3rd view, Masonry, and a front-end form to submit new testimonials with admin notifications. In addition, more developer tools, support, and page pagination for list and masonry.



== Installation ==

1. Upload "bne-testimonials" folder to the "/wp-content/plugins/" directory
2. Activate the plugin through the "Plugins" menu in WordPress
3. A new menu item will be added called "Testimonials."
4. Add either "[bne_testimonials_list]" or "[bne_testimonials_slider]" to a post/page or use the available widgets in a sidebar. 



== Frequently Asked Questions ==

= Are there any available filters for developers to expand on this? =
Yes, there are over 20 available filters to use to change the layout, and to add content above/below the testimonials. Each variation has their own filters. Please review the help page for a list of available filters you could use.

= What options are there for the list and slider shortcodes? =
You can view all available arguments to add to the shortcodes that changes the default behavior by viewing the help page.

= I can't add a testimonial featured image! =
99% of the time, if you do not see the featured image box or when you set an image it disappears, it's usually the result your theme only providing post-thumbnail support for a set number of post-types. Or there is another plugin conflicting and causing a JS error within the admin.

= What size are the testimonial featured images? =
By default, the crop size used is “thumbnail” which is defined on your site from Settings > Media. Usually this will be 150×150 but may be different depending on your website or theme. On the font side, the image will be reduced using CSS to 100×100 to better fit the testimonial format.

= Is there support? =
Of course, but it is limited. We do not provide customizations or modifications beyond what the plugin currently provides. If you find any bugs or cannot get our plugin to work, please let us know so that we can look into it. Code is never perfect but it is poetry and there is always room for improvement.

= Can you add feature X and Y? =
Possible, but most likely not in the free version. If you would like to see new features added, check out the [pro version](http://www.bluenotesentertainment.com/products/testimonials-wordpress-pro/ "PRO version of BNE Testimonials") first. Perhaps your wanted featured is already there.


== Screenshots ==

1. Testimonial Post List Admin Screen
2. Testimoinal Post Edit Admin Screen




== Changelog ==

= 1.6.4 (August 27, 2014) =
* Fix: An issue would arise on the testimonial post list where if an image was placed in the editor the table columns would shift. Changed to using get_the_excerpt here.
* Add: Sanitize the data output of the website url and tagline fields.
* Compatibility Check: Works great in WP 4.0


= 1.6.3 (May 25, 2014) =
* Removed html tag limitations on get_the_content. All html tags and styles will now output normally from the visual/text editor.
* Replaced default admin messages when published/editing a testimonial.
* Adjusted featured image support for themes that don't provide or limit certain post types from using it.



= 1.6.2 (April 22, 2014) =
* Updated Help page to announce PRO version of BNE Testimonials.
* IMPORTANT NOTICE: Filter name "bne_testimonial_single_structure" is now "bne_testimonials_single_structure". This matches the pro version of the same filter name. If you have used this filter to adjust the testimonial structure output, you need also reflect this name change in your custom function used.
* BNE Testimonials is now hosted on the WP Plugin repository! Therefore, we removed our private update function. All future updates will be delivered from WordPress.org.


= 1.6.1 (March 13, 2014) =
* Fix: Corrected an issue within the flexslider.js v2.2 if the slider animation is set to fade and smoothHeight is set to true. What happened is that all slides would retain the inline css of "display:block" even though that particular slide was not an active slide.


= 1.6 (December 27, 2013) =
* Added: Testimonial Title, Featured Image, Tagline/Website URL and Content can now be filtered with your own functions.
* Added: Testimonial Single structure that organizes the above content areas can now be filtered to change their placement or to create your own single  testimonial template.
* Added: Missing Name parameter for list shortcode
* Removed: "If Function Exist" statements were removed since they wouldn't have worked as the plugin is called prior to your theme's functions file... silly me...


= 1.5 (December 6, 2013) =
* Added: <img> tags will now output from the WP editor.
* Moved: Enqueue CSS and JS into their own functions and called via the shortcode/widget for greater placement compatibility in a page/sidebar or theme template file. To prevent the CSS file from being placed into the bottom of the body, it is now enqueued globally... small drawback for validation and flexibility.
* Added: "If Function Exist" statements for CSS/JS, and content output functions.
* Added: Thumbnail support check for themes that do not already provide this.
* Added: 4 filters to the shortcode and widget testimonials to allow greater customization: "bne_testimonials_list_above", "bne_testimonials_list_below", "bne_testimonials_list_single_above", "bne_testimonials_list_single_below", "bne_testimonials_slider_above", "bne_testimonials_slider_below", "bne_testimonials_slider_single_above", and "bne_testimonials_slider_single_below".
* Added: WP 3.8 Menu icon Compatibility (dashicons).
* Updated: flexslider.js to v2.2 (v2.1 is still there for legacy)
* Better organization of plugin functions and code.


= 1.4 (October 31, 2013) =
* Added "speed" parameter to the slider shortcode and slider widget. This determines the speed of the slideshow cycling, in milliseconds. Default is 7000.
* Added optional css option to list and slider widgets which was previously added to the shortcode versions in the previous update.
* Added new Testimonial Order type, "title". You can now display your testimonials in order of publish date, random, or alphabetical.
* Added order_direction parameter for list/slider shortcodes and corresponding option for the list/slider widgets. This goes with the Testimonial Order setting (date, name, random) to display your order query in Ascending or Descending order.
* Added lightbox rel parameter for list/slider shortcodes and a rel option for the list/slider widgets. This allows for the use of an already installed lightbox either from another plugin or from your theme which uses the rel attribute.
* Added a function to create a random ID to be applied to each testimonial slider. This allows multiple sliders on a page to use their own flexslider API based on their ID. This is mostly relevant for the new speed option so each slider can have it own speed setting without effecting the other.
* Arranged the widget options into formatted sections.


= 1.3.1 (Sept 24, 2013) =
* Added an empty class shortcode parameter to target individual list/slider testimonials for easy css customizations.
* Removed an extra comma that was placed on the list shortcode markup.


= 1.3 (Sept 12, 2013) =
* Changed: The get_the_content "hack" with a better and a much simpler one that strips everything out except the following post tags: b, strong, i, em, a, br, h1, h2, h3. The prevents other plugins from throwing in their filtered items such as, social icons, onto every testimonial entry.
* Changed: The list and slider shortcodes into their own included files.
* Added: Featured Image frame styles with their corresponding shortcode/widget attributes: square (default), circle, flat-square, flat-circle.
* Updated the help page.
* Cleaned up and organized code.


= 1.2.2 (Aug 27, 2013) =
* Further Accommodate some random theme styles. 
* Allow the taxonomy to be filterable in the Show all Post Edit Screen.


= 1.2.1 (Aug 8, 2013) =
* Accommodate some random theme styles that uses flexslider.


= 1.2 (Aug 4, 2013) =
* Added Custom Taxonomies (Categories)
* Added a category="" parameter into both shortcodes and Widgets as a dropdown option.
* Adjusted the title tags to h4 for widgets and h3 for shortcodes.
* Updated help.php with new info.
* Enabled the auto update class. All future updates can be pulled using the WordPress update API.


= 1.1 (July 31, 2013) =
* Added List and Slider Widget Options.
* Corrected some typos.
* Adjusted the .bne-testimonial-slider-wrapper. Made “testimonial” singular.
* Adjusted the .bne-testimonial-list-wrapper.  Made “testimonial” singular.
* Added auto update class

= 1.0 =
* This is the first release.