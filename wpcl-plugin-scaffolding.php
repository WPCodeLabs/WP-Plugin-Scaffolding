<?php
/**
 * The plugin bootstrap file
 * This file is read by WordPress to generate the plugin information in the plugin admin area.
 * This file also defines plugin parameters, registers the activation and deactivation functions, and defines a function that starts the plugin.
 * @link    https://bitbucket.org/midwestdigitalmarketing/cornerstone/
 * @since   1.0.0
 * @package wpcl_plugin_scaffolding
 *
 * @wordpress-plugin
 * Plugin Name: WPCL Plugin Scaffolding
 * Plugin URI:  https://bitbucket.org/midwestdigitalmarketing/cornerstone/
 * Description: Plugin Scaffolding
 * Version:     1.0.0
 * Author:      WP Code Labs
 * Author URI:  https://www.wpcodelabs.com
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: wpcl_plugin_scaffolding
 */

define( 'WPCL_PLUGIN_SCAFFOLDING_ROOT', __FILE__ );

define( 'WPCL_PLUGIN_SCAFFOLDING_VERSION', '1.0.0' );

// If this file is called directly, abort
if ( !defined( 'WPINC' ) ) {
    die( 'Bugger Off Script Kiddies!' );
}

/**
 * Class autoloader
 * Do some error checking and string manipulation to accomodate our namespace
 * and autoload the class based on path
 * @since 1.0.0
 * @see http://php.net/manual/en/function.spl-autoload-register.php
 * @param (string) $className : fully qualified classname to load
 */
function wpcl_plugin_scaffolding_autoload_register( $className ) {
	// Reject it if not a string
	if( !is_string( $className ) ) {
		return false;
	}
	// Check and make damned sure we're only loading things from this namespace
	if( strpos( $className, 'Wpcl\Scaffolding' ) === false ) {
		return false;
	}
	// Replace backslashes
	$className = strtolower( str_replace( '\\', '/', $className ) );
	// Ensure there is no slash at the beginning of the classname
	$className = ltrim( $className, '/' );
	// Replace some known constants
	$className = str_ireplace( 'Wpcl/Scaffolding/', '', $className );
	// Append full path to class
	$path  = sprintf( '%1$sincludes/%2$s.php', plugin_dir_path( WPCL_PLUGIN_SCAFFOLDING_ROOT ), $className );
	// include the class...
	if( file_exists( $path ) ) {
		include_once( $path );
	}
}

/**
 * Code to run during plugin activation
 */
function wpcl_plugin_scaffolding_activate() {
	\Wpcl\Scaffolding\Activator::activate();
}

/**
 * Kick off the plugin
 * Check PHP version and make sure our other funcitons will be supported
 * Register autoloader function
 * Register activation & deactivation hooks
 * Create an instance of our main plugin class
 * Finally, Burn Baby Burn...
 */
function wpcl_plugin_scaffolding_run() {
	// If version is less than minimum, register notice
	if( version_compare( '5.3.0', phpversion(), '>=' ) ) {
		// Deactivate plugin
		deactivate_plugins( plugin_basename( __FILE__ ) );
		// Print message to user
		wp_die( 'Irks! This plugin requires minimum PHP v5.3.0 to run. Please update your version of PHP.' );
	}
	// Register Autoloader
	spl_autoload_register( 'wpcl_plugin_scaffolding_autoload_register' );
	// Add activation hook
	register_activation_hook( WPCL_PLUGIN_SCAFFOLDING_ROOT, 'wpcl_plugin_scaffolding_activate' );
	// Instantiate our plugin
	$plugin = \Wpcl\Scaffolding\Plugin::get_instance();
	// Test our plugin
	$plugin->burn_baby_burn();

}
wpcl_plugin_scaffolding_run();