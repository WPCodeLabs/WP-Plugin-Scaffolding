<?php

namespace Wpcl\Scaffolding\Classes;

class FrontEnd extends \Wpcl\Scaffolding\Plugin implements \Wpcl\Scaffolding\Interfaces\Action_Hook_Subscriber, \Wpcl\Scaffolding\Interfaces\Filter_Hook_Subscriber, \Wpcl\Scaffolding\Interfaces\Shortcode_Hook_Subscriber {

	/**
	 * Get the action hooks this class subscribes to.
	 * @return array
	 */
	public function get_actions() {
		return array(
			array( 'wp_enqueue_scripts' => 'enqueue_scripts' ),
			array( 'wp_enqueue_scripts' => 'enqueue_styles' ),
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
	 * Get the shortcode hooks this class subscribes to.
	 * @return array
	 */
	public function get_shortcodes() {
		return array(
			array( 'sample_shortcode' => 'sample_shortcode' ),
		);
	}


	/**
	 * Register the javascript for the frontend
	 *
	 * @since 1.0.0
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( 'wpcl_plugin_scaffolding_public', self::url( 'assets/js/public.js' ), array( 'jquery' ), WPCL_PLUGIN_SCAFFOLDING_VERSION, true );
		wp_localize_script( 'wpcl_plugin_scaffolding_public', 'wpcl_plugin_scaffolding', array( 'wpajaxurl' => admin_url( 'admin-ajax.php') ) );
	}


	/**
	 * Register the stylesheets for the frontend
	 *
	 * @since 1.0.0
	 */
	public function enqueue_styles() {
		wp_enqueue_style( 'wpcl_plugin_scaffolding_public', self::url( 'assets/css/public.css' ), array(), WPCL_PLUGIN_SCAFFOLDING_VERSION, 'all' );
	}

	/**
	 * Sample Shortcode
	 */
	public function sample_shortcode( $atts = array() ) {
		$atts = shortcode_atts( array( 'message' => 'Sample Shortcode Message' ), $atts, 'sample_shortcode' );
		return '<p>' . esc_attr( $atts['message'] ) . '</p>';
	}

} // end class