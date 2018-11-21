<?php

/**
 * The main plugin file definition
 * This file isn't instatiated directly, it acts as a shared parent for other classes
 * @link    http://midwestdigitalmarketing.com
 * @since   1.0.0
 * @package wpcl_plugin_scaffolding
 */

namespace Wpcl\Scaffolding;

class Plugin {

	/**
	 * Plugin Name
	 * @since 1.0.0
	 * @access protected
	 * @var (string) $name : The unique identifier for this plugin
	 */
	protected static $name = 'wpcl_plugin_scaffolding';

	/**
	 * Plugin Version
	 * @since 1.0.0
	 * @access protected
	 * @var (string) $version : The version number of the plugin, used to version scripts / styles
	 */
	protected static $version = '0.1.0';

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
		$class->loader = \Wpcl\Scaffolding\Loader::get_instance();
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
		// Nothing to do here at this time
	}

	/**
	 * Helper function to use relative URLs
	 * @since 1.0.0
	 * @access protected
	 */
	public static function url( $url = '' ) {
		return plugin_dir_url( WPCL_PLUGIN_SCAFFOLDING_ROOT ) . ltrim( $url, '/' );
	}

	/**
	 * Helper function to use relative paths
	 * @since 1.0.0
	 * @access protected
	 */
	public static function path( $path = '' ) {
		return plugin_dir_path( WPCL_PLUGIN_SCAFFOLDING_ROOT ) . ltrim( $path, '/' );
	}

	public function burn_baby_burn() {

		foreach( array( 'Admin', 'FrontEnd', 'PostTypes', 'Taxonomies', 'Widgets' ) as $class ) {

			$class = '\\Wpcl\\Scaffolding\\Classes\\' . $class;

			$class::register();
		}

		load_plugin_textdomain( self::$name, false, basename( dirname( WPCL_PLUGIN_SCAFFOLDING_ROOT ) ) . '/languages' );
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

	public static function expose( $item ) {
		if( is_admin() ) {
			echo '<pre style="margin-left: 200px">';
		} else {
			echo '<pre>';
		}
		print_r( $item );
		echo '</pre>';
	}

} // end class