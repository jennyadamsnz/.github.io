<?php
/**
 * Plugin Name: Accessible Poetry - WordPress Accessibility Plugin
 * Plugin URI: http://www.accessible-poetry.com/
 * Description: The Accessibility plugin that makes any WordPress site accessible for people with disabilities. this plugin provides set of advanced accessibility tools.
 * Version: 2.1.3
 * Author: Amit Moreno
 * Author URI: http://www.amitmoreno.com/
 * Text Domain: acp
 * Domain Path: /lang
 * License: GPL2
 */

// Include the lib functions
require_once('inc/acp-lib.php');

// Include the admin panel
require_once('inc/acp-panel.php');

// Include the Toolbar
require_once('inc/acp-toolbar.php');

// Include the missing alt's panel
require_once('inc/acp_imagealt.php');

// Include the skiplinks
require_once('inc/acp_skiplinks.php');

// include front class
require_once 'inc/acp-front.php';

/*
 * Load the plugin localization files
 */
function acp_localization() {
   load_plugin_textdomain( 'acp', false, plugin_basename( dirname( __FILE__ ) ) . '/lang/' );
}
add_action( 'plugins_loaded', 'acp_localization' );