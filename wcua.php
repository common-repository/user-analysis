<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              wpwork.com
 * @since             1.0.1
 * @package           Wcua
 *
 * @wordpress-plugin
 * Plugin Name:      WooCommerce User Analysis
 * Plugin URI:       wcua.rudrakshsoftware.com	
 * Description:     	WooCommerce User Analysis tracks the subscriber's engagement for individual products on your woo-commerce site.
 * Version:           1.0.1
 * Author:            wpwork
 * Author URI:        http://wpwork.in/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wcua
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if( !defined( "WCUA_DB_PREFIX" ) ){
	global $wpdb;
	define( "WCUA_DB_PREFIX" , $wpdb->prefix.'wc' );
}
if ( !defined( "WCUA_URL" ) ){
	define( "WCUA_URL" , plugin_dir_url( __FILE__ ) );
}
if ( !defined( "WCUA_PATH" ) ){
	define( "WCUA_PATH" , plugin_dir_path( __FILE__ ) );
}
if ( !defined( "WCUA_TEMPLATE_PATH" ) ){
	define( "WCUA_TEMPLATE_PATH" , plugin_dir_path( __FILE__ ).'template/' );
}
if ( !defined( "WCUA_IMAGE_PATH" ) ){
	define( "WCUA_IMAGE_PATH" , plugin_dir_url( __FILE__ ).'admin/image/' );
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WCUA_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wcua-activator.php
 */
function activate_wcua() {
	
		require_once plugin_dir_path( __FILE__ ) . 'includes/class-wcua-activator.php';
		Wcua_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wcua-deactivator.php
 */
function deactivate_wcua() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wcua-deactivator.php';
	Wcua_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wcua' );
register_deactivation_hook( __FILE__, 'deactivate_wcua' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wcua.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wcua() {

	$plugin = new Wcua();
	$plugin->run();

}
run_wcua();
