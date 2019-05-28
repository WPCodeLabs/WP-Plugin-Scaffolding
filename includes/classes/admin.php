<?php

namespace Wpcl\Scaffolding\Classes;

class Admin extends \Wpcl\Scaffolding\Plugin implements \Wpcl\Scaffolding\Interfaces\Action_Hook_Subscriber, \Wpcl\Scaffolding\Interfaces\Filter_Hook_Subscriber {

	/**
	 * Get the action hooks this class subscribes to.
	 * @return array
	 */
	public function get_actions() {
		return array(
			array( 'admin_enqueue_scripts' => 'enqueue_scripts' ),
			array( 'admin_enqueue_scripts' => 'enqueue_styles' ),
		);

	}

	/**
	 * Get the filter hooks this class subscribes to.
	 * @return array
	 */
	public function get_filters() {
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
		wp_enqueue_script( 'wpcl_plugin_scaffolding_admin', self::url( 'assets/js/admin.js' ), array( 'jquery' ), WPCL_PLUGIN_SCAFFOLDING_VERSION, true );
		wp_localize_script( 'wpcl_plugin_scaffolding_admin', 'wpcl_plugin_scaffolding', array( 'wpajaxurl' => admin_url( 'admin-ajax.php') ) );
	}

	/**
	 * Register the css for the admin area
	 *
	 * @since 1.0.0
	 */
	public function enqueue_styles() {
		wp_enqueue_style( 'wpcl_plugin_scaffolding_admin', self::url( 'assets/css/admin.css' ), array(), WPCL_PLUGIN_SCAFFOLDING_VERSION, 'all' );
	}

} // end class