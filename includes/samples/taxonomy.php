<?php

namespace Wpcl\Scaffolding\Taxonomies;

class Taxonomy extends \Wpcl\Scaffolding\Plugin {

	/**
	 * Get taxomony arguments
	 *
	 * I recommend using a tool such as GenerateWP to easily generate taxonomy arguments
	 *
	 * @see  https://generatewp.com/taxonomy/
	 * @since 1.0.0
	 */
	public static function get_tax_args() {
		$labels = array(
			'name'                       => _x( 'Sample Taxonomies', 'Taxonomy General Name', 'wpcl_plugin_scaffolding' ),
			'singular_name'              => _x( 'Sample Taxonomy', 'Taxonomy Singular Name', 'wpcl_plugin_scaffolding' ),
			'menu_name'                  => __( 'Sample Taxonomy', 'wpcl_plugin_scaffolding' ),
			'all_items'                  => __( 'All Items', 'wpcl_plugin_scaffolding' ),
			'parent_item'                => __( 'Parent Item', 'wpcl_plugin_scaffolding' ),
			'parent_item_colon'          => __( 'Parent Item:', 'wpcl_plugin_scaffolding' ),
			'new_item_name'              => __( 'New Item Name', 'wpcl_plugin_scaffolding' ),
			'add_new_item'               => __( 'Add New Item', 'wpcl_plugin_scaffolding' ),
			'edit_item'                  => __( 'Edit Item', 'wpcl_plugin_scaffolding' ),
			'update_item'                => __( 'Update Item', 'wpcl_plugin_scaffolding' ),
			'view_item'                  => __( 'View Item', 'wpcl_plugin_scaffolding' ),
			'separate_items_with_commas' => __( 'Separate items with commas', 'wpcl_plugin_scaffolding' ),
			'add_or_remove_items'        => __( 'Add or remove items', 'wpcl_plugin_scaffolding' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'wpcl_plugin_scaffolding' ),
			'popular_items'              => __( 'Popular Items', 'wpcl_plugin_scaffolding' ),
			'search_items'               => __( 'Search Items', 'wpcl_plugin_scaffolding' ),
			'not_found'                  => __( 'Not Found', 'wpcl_plugin_scaffolding' ),
			'no_terms'                   => __( 'No items', 'wpcl_plugin_scaffolding' ),
			'items_list'                 => __( 'Items list', 'wpcl_plugin_scaffolding' ),
			'items_list_navigation'      => __( 'Items list navigation', 'wpcl_plugin_scaffolding' ),
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
			'show_in_rest'               => true,
		);
		return $args;
	}

	/**
	 * Return the post type(s) this taxonomy should attach to
	 *
	 * @return array : Array of all post types this taxonomy belongs to
	 */
	public static function get_tax_post_types() {
		return array( 'posttype' );
	}
}