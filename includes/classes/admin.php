<?php

/**
 * The plugin file that controls the admin functions
 * @link    https://www.wpcodelabs.com
 * @since   1.0.0
 * @package mdm_wp_cornerstone
 */

namespace Wpcl\Scaffolding\Classes;

class Admin extends \Wpcl\Scaffolding\Plugin implements \Wpcl\Scaffolding\Interfaces\Action_Hook_Subscriber, \Wpcl\Scaffolding\Interfaces\Filter_Hook_Subscriber {

	/**
	 * Get the action hooks this class subscribes to.
	 * @return array
	 */
	public static function get_actions() {
		return array(
			array( 'admin_enqueue_scripts' => 'enqueue_scripts' ),
			array( 'admin_enqueue_scripts' => 'enqueue_styles' ),
		);

	}

	/**
	 * Get the filter hooks this class subscribes to.
	 * @return array
	 */
	public static function get_filters() {
		return array(
			// Put filters here
		);
	}

	/**
	 * Register the javascript for the admin area
	 *
	 * @since 1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( sprintf( '%s_admin', self::$name ), self::url( 'assets/js/admin.min.js' ), array( 'jquery' ), self::$version, true );

		$script_args = apply_filters( self::$name . '_admin_script_args', array(
			'wpajaxurl' => admin_url( 'admin-ajax.php'),
		) );

		wp_localize_script( sprintf( '%s_admin', self::$name ), self::$name, $script_args );
	}

	/**
	 * Register the css for the admin area
	 *
	 * @since 1.0.0
	 */
	public function enqueue_styles() {
		wp_enqueue_style( sprintf( '%s_admin', self::$name ), self::url( 'assets/css/admin.css' ), array(), self::$version, 'all' );
	}

} // end class