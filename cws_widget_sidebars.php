<?php
/**
 * Plugin Name: Consult Webs Sidebars
 * Plugin URI:  https://bitbucket.org/cwdevelopers/consult_webs_widget_sidebars
 * Description: Create several commonly used sidebars for rapid theme development
 * Version:     1.0.2
 * Author:      Consult Webs
 * Author URI:  https://consultwebs.com
 * License:     GPLv2+
 */

define( 'CWS_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

/**
 * Register Sidebars and Widgets
 */
include( CWS_PLUGIN_PATH . 'includes/register-sidebars.php' );
include( CWS_PLUGIN_PATH . 'includes/register-widgets.php' );

/**
 * Include plugin functions
 */
include( CWS_PLUGIN_PATH . 'includes/cww-functions.php' );

/**
 * Build Sidebars and Widgets
 */
include( CWS_PLUGIN_PATH . 'includes/related-info-widget.php' );
include( CWS_PLUGIN_PATH . 'includes/featured-post-widget.php' );
include( CWS_PLUGIN_PATH . 'includes/testimony-widget.php' );
include( CWS_PLUGIN_PATH . 'includes/attorneys-widget.php' );
include( CWS_PLUGIN_PATH . 'includes/image-widget.php' );
include( CWS_PLUGIN_PATH . 'includes/results-widget.php' );
include( CWS_PLUGIN_PATH . 'includes/faq-widget.php' );
include( CWS_PLUGIN_PATH . 'includes/form-widget.php' );