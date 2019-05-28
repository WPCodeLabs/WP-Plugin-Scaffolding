<?php

namespace Wpcl\Scaffolding;

class Plugin {

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

		$classes = array( 'Admin', 'Frontend', 'PostTypes', 'Taxonomies', 'Widgets' );

		foreach( $classes as $class ) {

			$class = '\\Wpcl\\Scaffolding\\Classes\\' . $class;

			$class::register();
		}

		load_plugin_textdomain( 'wpcl_plugin_scaffolding', false, basename( dirname( WPCL_PLUGIN_SCAFFOLDING_ROOT ) ) . '/languages' );
	}

} // end class