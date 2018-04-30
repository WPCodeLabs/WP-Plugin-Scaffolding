<?php

/**
 * The main plugin file definition
 * This file isn't instatiated directly, it acts as a shared parent for other classes
 * @link    http://midwestfamilymarketing.com
 * @since   1.0.0
 * @package wp_plugin_scaffolding
 */

namespace Wpcl\WpPluginScaffolding;

class Plugin {

	/**
	 * Plugin Name
	 * @since 1.0.0
	 * @access protected
	 * @var (string) $name : The unique identifier for this plugin
	 */
	protected static $name = 'wp_plugin_scaffolding';

	/**
	 * Plugin Version
	 * @since 1.0.0
	 * @access protected
	 * @var (string) $version : The version number of the plugin, used to version scripts / styles
	 */
	protected static $version = '1.0.0';

	/**
	 * Plugin Path
	 * @since 1.0.0
	 * @access protected
	 * @var (string) $path : The path to the plugins location on the server, is inherited by child classes
	 */
	protected static $path;

	/**
	 * Plugin URL
	 * @since 1.0.0
	 * @access protected
	 * @var (string) $url : The URL path to the location on the web, accessible by a browser
	 */
	protected static $url;

	/**
	 * Plugin Slug
	 * @since 1.0.0
	 * @access protected
	 * @var (string) $slug : Basename of the plugin, needed for Wordpress to set transients, and udpates
	 */
	protected static $slug;

	/**
	 * Plugin Options
	 * @since 1.0.0
	 * @access protected
	 * @var (array) $settings : The array that holds plugin options
	 */
	protected $loader;

	/**
	 * Instances
	 * @since 1.0.0
	 * @access protected
	 * @var (array) $instances : Collection of instantiated classes
	 */
	protected static $instances = array();

	/**
	 * Registers our plugin with WordPress.
	 */
	public static function register( $class_name = null ) {
		// Get called class
		$class_name = !is_null( $class_name ) ? $class_name : get_called_class();
		// Instantiate class
		$class = $class_name::get_instance( $class_name );
		// Create API manager
		$class->loader = \Wpcl\WpPluginScaffolding\Loader::get_instance();
		// Register stuff
		$class->loader->register( $class );
		// Return instance
		return $class;
	}

	/**
	 * Gets an instance of our class.
	 */
	public static function get_instance( $class_name = null ) {
		// Use late static binding to get called class
		$class = !is_null( $class_name ) ? $class_name : get_called_class();
		// Get instance of class
		if( !isset(self::$instances[$class] ) ) {
			self::$instances[$class] = new $class();
		}
		return self::$instances[$class];
	}

	/**
	 * Constructor
	 * @since 1.0.0
	 * @access protected
	 */
	protected function __construct() {
		self::$path = plugin_dir_path( WP_PLUGIN_SCAFFOLDING_ROOT );
		self::$url  = plugin_dir_url( WP_PLUGIN_SCAFFOLDING_ROOT );
		self::$slug = plugin_basename( WP_PLUGIN_SCAFFOLDING_ROOT );
	}

	/**
	 * Helper function to use relative URLs
	 * @since 1.0.0
	 * @access protected
	 */
	public static function url( $url = '' ) {
		return self::$url . ltrim( $url, '/' );
	}

	/**
	 * Helper function to use relative paths
	 * @since 1.0.0
	 * @access protected
	 */
	public static function path( $path = '' ) {
		return self::$path . ltrim( $path, '/' );
	}

	public function test() {
		$classes = $this->get_child_classes( self::path( 'includes/classes' ) );
		// Loop through each post type
		foreach( $classes as $class_name ) {
			// Append namespace
			$class_name = '\\Wpcl\\WpPluginScaffolding\\Classes\\' . $class_name;
			// Register
			$class_name::register();
		}
	}

	protected static function get_child_classes( $path = null ) {
		// Try to create path from called class if no path is passed in
		if( empty( $path ) ) {
			// Use ReflectionClass to get the shortname
			$reflection = new \ReflectionClass( get_called_class() );
			// Attempt to construct to path
			$path = self::path( sprintf( 'includes/classes/%s/', strtolower( $reflection->getShortName() ) ) );
		}
		// Bail if our path is not a directory
		if( !is_dir( $path ) ) {
			return array();
		}
		// Empty array to hold post types
		$classes = array();
		// Get all files in directory
		$files = scandir( $path );

		// If empty, we can bail
		if( !is_array( $files ) || empty( $files ) ) {
			return array();
		}
		// Iterate over all found files
		foreach( $files as $file ) {
			if( strpos( $file, '.php' ) === false ) {
				continue;
			}
			$classes[] = str_replace( '.php', '', $file );
		}
		// Return child classes;
		return $classes;
	}

} // end class