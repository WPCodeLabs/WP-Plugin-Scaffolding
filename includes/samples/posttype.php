<?php

namespace Wpcl\Scaffolding\PostTypes;

class PostType extends \Wpcl\Scaffolding\Plugin {

	/**
	 * Get post type arguments
	 *
	 * I recommend using a tool such as GenerateWP to easily generate post type arguments
	 *
	 * @see https://generatewp.com/post-type/
	 * @since 1.0.0
	 */
	public static function get_post_type_args() {
		$labels = array(
			'name'                  => _x( 'Samples', 'Post Type General Name', 'wpcl_plugin_scaffolding' ),
			'singular_name'         => _x( 'Sample', 'Post Type Singular Name', 'wpcl_plugin_scaffolding' ),
			'menu_name'             => __( 'Sample Post Type', 'wpcl_plugin_scaffolding' ),
			'name_admin_bar'        => __( 'Sample Post Type', 'wpcl_plugin_scaffolding' ),
			'archives'              => __( 'Item Archives', 'wpcl_plugin_scaffolding' ),
			'attributes'            => __( 'Item Attributes', 'wpcl_plugin_scaffolding' ),
			'parent_item_colon'     => __( 'Parent Item:', 'wpcl_plugin_scaffolding' ),
			'all_items'             => __( 'All Items', 'wpcl_plugin_scaffolding' ),
			'add_new_item'          => __( 'Add New Item', 'wpcl_plugin_scaffolding' ),
			'add_new'               => __( 'Add New', 'wpcl_plugin_scaffolding' ),
			'new_item'              => __( 'New Item', 'wpcl_plugin_scaffolding' ),
			'edit_item'             => __( 'Edit Item', 'wpcl_plugin_scaffolding' ),
			'update_item'           => __( 'Update Item', 'wpcl_plugin_scaffolding' ),
			'view_item'             => __( 'View Item', 'wpcl_plugin_scaffolding' ),
			'view_items'            => __( 'View Items', 'wpcl_plugin_scaffolding' ),
			'search_items'          => __( 'Search Item', 'wpcl_plugin_scaffolding' ),
			'not_found'             => __( 'Not found', 'wpcl_plugin_scaffolding' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'wpcl_plugin_scaffolding' ),
			'featured_image'        => __( 'Featured Image', 'wpcl_plugin_scaffolding' ),
			'set_featured_image'    => __( 'Set featured image', 'wpcl_plugin_scaffolding' ),
			'remove_featured_image' => __( 'Remove featured image', 'wpcl_plugin_scaffolding' ),
			'use_featured_image'    => __( 'Use as featured image', 'wpcl_plugin_scaffolding' ),
			'insert_into_item'      => __( 'Insert into item', 'wpcl_plugin_scaffolding' ),
			'uploaded_to_this_item' => __( 'Uploaded to this item', 'wpcl_plugin_scaffolding' ),
			'items_list'            => __( 'Items list', 'wpcl_plugin_scaffolding' ),
			'items_list_navigation' => __( 'Items list navigation', 'wpcl_plugin_scaffolding' ),
			'filter_items_list'     => __( 'Filter items list', 'wpcl_plugin_scaffolding' ),
		);
		$rewrite = array(
			'slug'                  => 'samples',
			'with_front'            => true,
			'pages'                 => true,
			'feeds'                 => true,
		);
		$args = array(
			'label'                 => __( 'Sample', 'wpcl_plugin_scaffolding' ),
			'description'           => __( 'Post Type Description', 'wpcl_plugin_scaffolding' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'author', 'thumbnail', 'revisions', 'excerpt', 'genesis-seo', 'genesis-cpt-archives-settings', 'genesis-layouts', 'genesis-scripts' ),
			'taxonomies'            => array( 'category', 'post_tag', 'sample' ),
			'hierarchical'          => true,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'menu_icon'             => 'dashicons-admin-post',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
			'rewrite'               => $rewrite,
		);

		return $args;
	}
}