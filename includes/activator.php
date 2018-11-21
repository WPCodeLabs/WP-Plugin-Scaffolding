<?php

/**
 * Fired during plugin activation
 *
 * This class defines all code necessary to run during the plugin's activation.
 * @link    https://www.wpcodelabs.com
 * @since   1.0.0
 * @package mdm_wp_cornerstone
 */

namespace Wpcl\Scaffolding;

class Activator {

	/**
	 * Activate Plugin
	 *
	 * Register Post Types, Register Taxonomies, and Flush Permalinks
	 * @since 1.0.0
	 */
	public static function activate() {
		// Register post types
		\Wpcl\Scaffolding\Classes\PostTypes::add_post_types();
		// Register taxonomies
		\Wpcl\Scaffolding\Classes\Taxonomies::add_taxonomies();
		// Flush rewrite rules
		self::flush_permalinks();
	}

	/**
	 * Flush permalinks
	 */
	public static function flush_permalinks() {
		global $wp_rewrite;
		$wp_rewrite->init();
		$wp_rewrite->flush_rules();
	}

} // end class