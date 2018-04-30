<?php

/**
 * The plugin file that controls the admin functions
 * @link    http://midwestfamilymarketing.com
 * @since   1.0.0
 * @package mdm_wp_cornerstone
 */

namespace Wpcl\WpPluginScaffolding\Classes;

class Admin extends \Wpcl\WpPluginScaffolding\Plugin implements \Wpcl\WpPluginScaffolding\Interfaces\Action_Hook_Subscriber {

	/**
	 * Get the action hooks this class subscribes to.
	 * @return array
	 */
	public static function get_actions() {
		// Return our custom actions
		return array(
			array( 'admin_enqueue_scripts' => 'enqueue_scripts' ),
			array( 'admin_enqueue_scripts' => 'enqueue_styles' ),
		);
	}

	public function enqueue_scripts() {
		// Register all public scripts, including dependencies
		wp_register_script( sprintf( '%s_admin', self::$name ), self::url( 'assets/js/admin.min.js' ), array( 'jquery' ), self::$version, true );
		// Enqueue public script
		wp_enqueue_script( sprintf( '%s_admin', self::$name ) );
		// Localize public script
		wp_localize_script( sprintf( '%s_admin', self::$name ), self::$name, array( 'wpajaxurl' => admin_url( 'admin-ajax.php') ) );
	}

	public function enqueue_styles() {
		// Register admin styles
		wp_register_style( sprintf( '%s_admin', self::$name ), self::url( 'assets/css/admin.css' ), array(), self::$version, 'all' );
		// Enqueue admin style
		wp_enqueue_style(  sprintf( '%s_admin', self::$name ) );
	}

} // end class