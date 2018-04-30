<?php

namespace Wpcl\WpPluginScaffolding\Classes\PostTypes;

class Testimonials extends \Wpcl\WpPluginScaffolding\Classes\PostTypes implements \Wpcl\WpPluginScaffolding\Interfaces\Filter_Hook_Subscriber {

	/**
	 * Get the action hooks this class subscribes to.
	 * @return array
	 */
	public static function get_filters() {
		return array(
			array( 'the_content' => 'create_quote' ),
			array( 'the_excerpt' => 'create_quote' ),
		);
	}

	public function create_quote( $content ) {
		if( get_post_type() === 'testimonials' ) {
			// Get citation
			$citation = get_post_meta( get_the_id(), 'citation', true );
			// Wrap content in blockquote
			$output  = '<blockquote class="testinomial">';
			$output .= $content;
			$output .= !empty( $citation ) ? sprintf( '<cite>%s</cite>', esc_attr( $citation ) ) : '';
			$output .= '</blockquote>';
			return $output;
		}
		return $content;
	}

	/**
	 * Get post type arguments
	 * @since 1.0.0
	 */
	public static function get_post_type_args() {
		$labels = array(
			'name'                  => _x( 'Testimonials', 'Post Type General Name', self::$name ),
			'singular_name'         => _x( 'Testimonial', 'Post Type Singular Name', self::$name ),
			'menu_name'             => __( 'Testimonials', self::$name ),
			'name_admin_bar'        => __( 'Testimonial', self::$name ),
			'archives'              => __( 'Item Archives', self::$name ),
			'attributes'            => __( 'Item Attributes', self::$name ),
			'parent_item_colon'     => __( 'Parent Item:', self::$name ),
			'all_items'             => __( 'All Items', self::$name ),
			'add_new_item'          => __( 'Add New Item', self::$name ),
			'add_new'               => __( 'Add New', self::$name ),
			'new_item'              => __( 'New Item', self::$name ),
			'edit_item'             => __( 'Edit Item', self::$name ),
			'update_item'           => __( 'Update Item', self::$name ),
			'view_item'             => __( 'View Item', self::$name ),
			'view_items'            => __( 'View Items', self::$name ),
			'search_items'          => __( 'Search Item', self::$name ),
			'not_found'             => __( 'Not found', self::$name ),
			'not_found_in_trash'    => __( 'Not found in Trash', self::$name ),
			'featured_image'        => __( 'Featured Image', self::$name ),
			'set_featured_image'    => __( 'Set featured image', self::$name ),
			'remove_featured_image' => __( 'Remove featured image', self::$name ),
			'use_featured_image'    => __( 'Use as featured image', self::$name ),
			'insert_into_item'      => __( 'Insert into item', self::$name ),
			'uploaded_to_this_item' => __( 'Uploaded to this item', self::$name ),
			'items_list'            => __( 'Items list', self::$name ),
			'items_list_navigation' => __( 'Items list navigation', self::$name ),
			'filter_items_list'     => __( 'Filter items list', self::$name ),
		);
		$args = array(
			'label'                 => __( 'Testimonial', self::$name ),
			'description'           => __( 'Testimonial information page.', self::$name ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'author', 'thumbnail', 'revisions', 'excerpt', 'genesis-seo', 'genesis-cpt-archives-settings', 'genesis-layouts', 'genesis-scripts' ),
			'taxonomies'            => array( 'category', 'post_tag' ),
			'hierarchical'          => true,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'menu_icon'             => 'dashicons-format-quote',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
		);
		return $args;
	}

}