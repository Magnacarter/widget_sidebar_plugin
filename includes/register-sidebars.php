<?php

/**
 * Register sidebars
 *
 * @action after_setup_theme
 *
 * @return void
 */
function cws_after_setup_theme() {
	// Sidebar areas
	register_sidebar(
		array(
			'name'          => 'Front Page Template Sidebar',
			'id'            => 'front_page_sidebar',
			'description'   => 'Displays in right hand rail',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => 'Blog Template Sidebar',
			'id'            => 'blog_sidebar',
			'description'   => 'Displays in the right hand rail',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => 'Our Firm Template Sidebar',
			'id'            => 'our_firm_sidebar',
			'description'   => 'Displays in right hand rail',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => 'Generic Template Sidebar',
			'id'            => 'generic_sidebar',
			'description'   => 'Displays in right hand rail',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => 'Legal Services Template Sidebar',
			'id'            => 'legal_services_sidebar',
			'description'   => 'Displays in right hand rail',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => 'Location Template Sidebar',
			'id'            => 'location_sidebar',
			'description'   => 'Displays in right hand rail',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => 'Contact Template Sidebar',
			'id'            => 'contact_sidebar',
			'description'   => 'Displays in right hand rail',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => 'Attorney Bio Template Sidebar',
			'id'            => 'attorney_bio_sidebar',
			'description'   => 'Displays in right hand rail',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => 'PA Landing Page Template Sidebar',
			'id'            => 'pa_landing_page_sidebar',
			'description'   => 'Displays in right hand rail',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>',
		)
	);
}
add_action( 'after_setup_theme', 'cws_after_setup_theme' );