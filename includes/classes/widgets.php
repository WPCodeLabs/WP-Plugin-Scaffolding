<?php

/**
 * The plugin file that controls the widget hooks
 * @link    http://midwestfamilymarketing.com
 * @since   1.0.0
 * @package wp_plugin_scaffolding
 */

namespace Wpcl\WpPluginScaffolding\Classes;

class Widgets extends \Wpcl\WpPluginScaffolding\Plugin implements \Wpcl\WpPluginScaffolding\Interfaces\Action_Hook_Subscriber {

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
			$widget = '\\Wpcl\\WpPluginScaffolding\\Classes\\Widgets\\' . $widget;
			// Register with wordpress
			register_widget( $widget );
		}
	}
} // end class