<?php

namespace Wpcl\Scaffolding\Classes;

class PostTypes extends \Wpcl\Scaffolding\Plugin implements \Wpcl\Scaffolding\Interfaces\Action_Hook_Subscriber {
	/**
	 * Get the action hooks this class subscribes to.
	 * @return array
	 */
	public function get_actions() {
		return array(
			array( 'init' => 'add_post_types' ),
		);
	}

	/**
	 * Register each custom post type with wordpressw
	 */
	public static function add_post_types() {
		// Get all post types
		$post_types = array(
			'SamplePostType',
		);
		// Loop through each post type
		foreach( $post_types as $post_type ) {
			// Append namespace to post type
			$class = '\\Wpcl\\Scaffolding\\PostTypes\\' . $post_type;
			// Initialize post type
			$pt = $class::register();
			// Register with wordpress
			register_post_type( $post_type, $pt::get_post_type_args() );
		}
	}
}