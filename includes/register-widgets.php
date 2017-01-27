<?php
/**
 * Register Widgets
 */

/**
 * Register our custom widget
 *
 * @action widgets_init
 *
 * @return void
 */
function cws_register_widgets() {
	register_widget( 'CWS_Related_Info' );
	register_widget( 'CWS_Featured_Post' );
	register_widget( 'CWS_Testimony' );
	register_widget( 'CWS_Attorneys' );
	register_widget( 'CWS_Image' );
	register_widget( 'CWS_Results' );
	register_widget( 'CWS_Faq_Accordion' );
	register_widget( 'CWS_Sidebar_Form' );
}
add_action( 'widgets_init', 'cws_register_widgets' );