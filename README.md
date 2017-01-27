=== consultwebs.com Widget Sidebars ===
Contributors: adamcarter
Tags: sidebars, custom widgets, form, featured post, testimony, realted pages, customizable
Requires at least: 3.0.1
Tested up to: 4.7
Stable tag: 4.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

consultwebs.com sidebar widgets.

== Description ==

**Development of this plugin is done [on BitBucket](https://bitbucket.org/cwdevelopers/consult_webs_widget_sidebars). Pull requests welcome. Please see [issues](https://bitbucket.org/cwdevelopers/consult_webs_widget_sidebars) reported there before going to the plugin forum.**

== Installation ==

1. Add one of the possible widget area ID's to the "is_active_sidebar()" and "dynamic_sidebar()" functions. Example: 

```html
<div id="primary" class="widget-area" role="complementary">
	<?php
		if ( is_active_sidebar( 'our_firm_sidebar' ) ) {
			dynamic_sidebar( 'our_firm_sidebar' );
		} else {
			echo 'Please insert a sidebar.';
		}
	?>
</div>
```

2. Possible widget area ID's
```html
	our_firm_sidebar
	blog_sidebar
	pa_landing_page_sidebar
	attorney_bio_sidebar
	contact_sidebar
	location_sidebar
	legal_services_sidebar
	generic_sidebar
```

3. For testimonial sidebar, make sure there is a custom post type of 'testimonial'. The title should be the person's name
	and the content should be the testimony.

4. Add images in the cws_image widget. Once the image uploader opens, select the "Media Library" tab. Next, select "show"
	to the right of the image. Last, click on the "Attachment Post URL" button and click "Insert to Post" button.

== Filters ==

cw_build_form : return $html; If the design calls for a form that is too customized you can rebuild it here. While this
sort of negates the point of having the widget, it does allow you to not have to call an addtional include in your 
php template, keeping it semantic. 

EX:
```php
function my_form( $html ) {
	$html = null;
	$hello = "Hello World";
	$html .= sprintf( '<div><h1>%s</h1></div>', $hello );
	return $html;
}
add_filter( 'cw_build_form', 'my_form' );
```

== Screenshots ==

1. 

== Changelog ==

Initial release

= 1.0.0 - April 08, 2016 =

Update

= 1.0.1 - December 30, 2016 =

Update

= 1.0.2 - January 2, 2017 =

Update

= 1.0.3 - January 4, 2017 =

Props [Magnacarter](https://github.com/Magnacarter)