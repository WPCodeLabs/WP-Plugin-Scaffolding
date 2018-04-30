<?php
/**
 * The plugin bootstrap file
 * This file is read by WordPress to generate the plugin information in the plugin admin area.
 * This file also defines plugin parameters, registers the activation and deactivation functions, and defines a function that starts the plugin.
 * @link    https://github.com/WPCodeLabs/WP-Plugin-Scaffolding
 * @since   1.0.0
 * @package wp_plugin_scaffolding
 *
 * @wordpress-plugin
 * Plugin Name: WP Plugin Scaffolding
 * Plugin URI:  https://github.com/WPCodeLabs/WP-Plugin-Scaffolding
 * Description: A plugin for querying and displaying any type of post from WordPress
 * Version:     0.1.0
 * Author:      WP Code Labs
 * Author URI:  https://www.wpcodelabs.com
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: wp_plugin_scaffolding
 */

define( 'WP_PLUGIN_SCAFFOLDING_ROOT', __FILE__ );

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
function wp_plugin_scaffolding_autoload_register( $className ) {
	// Reject it if not a string
	if( !is_string( $className ) ) {
		return false;
	}
	// Check and make damned sure we're only loading things from this namespace
	if( strpos( $className, 'Wpcl\WpPluginScaffolding' ) === false ) {
		return false;
	}
	// Replace backslashes
	$className = strtolower( str_replace( '\\', '/', $className ) );
	// Ensure there is no slash at the beginning of the classname
	$className = ltrim( $className, '/' );
	// Replace some known constants
	$className = str_ireplace( 'Wpcl/WpPluginScaffolding/', '', $className );
	// Append full path to class
	$path  = sprintf( '%1$sincludes/%2$s.php', plugin_dir_path( __FILE__ ), $className );
	// include the class...
	if( file_exists( $path ) ) {
		include_once( $path );
	}
}

/**
 * Kick off the plugin
 * Check PHP version and make sure our other funcitons will be supported
 * Register autoloader function
 * Register activation & deactivation hooks
 * Create an install of our controller
 * Finally, Burn Baby Burn...
 */
function run_wp_plugin_scaffolding() {
	// If version is less than minimum, register notice
	if( version_compare( '5.3.0', phpversion(), '>=' ) ) {
		// Deactivate plugin
		deactivate_plugins( plugin_basename( __FILE__ ) );
		// Print message to user
		wp_die( 'Irks! This plugin requires minimum PHP v5.3.0 to run. Please update your version of PHP.' );
	}
	// Register Autoloader
	spl_autoload_register( 'wp_plugin_scaffolding_autoload_register' );
	// Instantiate our plugin
	$plugin = \Wpcl\WpPluginScaffolding\Plugin::get_instance();
	// Test our plugin
	$plugin->test();

}
run_wp_plugin_scaffolding();

function wp_plugin_debug_styles() {
	echo '<style>.xdebug-var-dump{margin-left:200px;</style>';
}
add_action( 'admin_head', 'wp_plugin_debug_styles' );