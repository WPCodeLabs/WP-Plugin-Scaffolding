<?php

/**
 * The plugin file that controls the widget hooks
 * @link    https://www.wpcodelabs.com
 * @since   1.0.0
 * @package wpcl_plugin_scaffolding
 */

namespace Wpcl\Scaffolding\Classes;

class Widgets extends \Wpcl\Scaffolding\Plugin implements \Wpcl\Scaffolding\Interfaces\Action_Hook_Subscriber {

	protected static $widgets = array();

	/**
	 * Get the action hooks this class subscribes to.
	 * @return array
	 */
	public static function get_actions() {
		return array(
			array( 'widgets_init' => 'add_widgets' ),
		);
	}

	public function add_widgets() {
		// Get all widgets
		$widgets = self::get_child_classes();
		// Register each
		foreach( $widgets as $widget ) {
			// Append namespace to widget
			$widget = '\\Wpcl\\Scaffolding\\Classes\\Widgets\\' . $widget;
			// Register with wordpress
			register_widget( $widget );
		}
	}
} // end class