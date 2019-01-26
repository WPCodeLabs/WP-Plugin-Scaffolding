<?php

namespace Wpcl\Scaffolding\Widgets;

use Wpcl\Scaffolding\Plugin as Plugin;

class Widget extends \WP_Widget {

	/**
	 * Root ID for all widgets of this type.
	 *
	 * @since 2.8.0
	 * @var mixed|string
	 */
	public $id_base;

	/**
	 * Name for this widget type.
	 *
	 * @since 2.8.0
	 * @var string
	 */
	public $name;

	/**
	 * Option array passed to wp_register_sidebar_widget().
	 *
	 * @since 2.8.0
	 * @var array
	 */
	public $widget_options;

	/**
	 * Option array passed to wp_register_widget_control().
	 *
	 * @since 2.8.0
	 * @var array
	 */
	public $control_options;

	/**
	 * Fields required for this widget
	 *
	 * @since 0.1.0
	 * @var array
	 */
	private $fields;
	/**
	 * Constructor, initialize the widget
	 * @param $id_base, $name, $widget_options, $control_options ( ALL optional )
	 * @since 1.0.0
	 */

	/**
	 * Constructor, initialize the widget
	 * @param $id_base, $name, $widget_options, $control_options ( ALL optional )
	 * @since 1.0.0
	 */
	public function __construct() {
		$this->id_base = 'sample_widget_id';
		$this->name = 'Sample Widget';
		$this->widget_options = array(
			'classname'   => 'sample_widget_class',
			'description' => 'Sample Widget',
			'customize_selective_refresh' => false,
		);
		$this->fields = array(
			'title' => array(
				'type' => 'text',
				'label' => 'Title',
				'default' => '',
			),
			'my_textarea' => array(
				'type' => 'textarea',
				'label' => 'Sample Textarea',
				'default' => '',
			),
			'my_select' => array(
				'type' => 'select',
				'label' => 'Sample Select',
				'default' => '',
				'options' => array(
					'' => __( 'Select Option', 'wpcl_plugin_scaffolding' ),
					'1' => __( 'Option 1', 'wpcl_plugin_scaffolding' ),
					'2' => __( 'Option 2', 'wpcl_plugin_scaffolding' ),
				),
			),
			'my_checkbox' => array(
				'type' => 'checkbox',
				'label' => 'Sample Checkbox',
				'default' => false,
			),
			'my_radio' => array(
				'type' => 'radio',
				'label' => 'Sample Radio',
				'default' => '1',
				'options' => array(
					'1' => __( 'Option 1', 'wpcl_plugin_scaffolding' ),
					'2' => __( 'Option 2', 'wpcl_plugin_scaffolding' ),
				),
			),
		);
		parent::__construct( $this->id_base, $this->name, $this->widget_options );

	}

	/**
	 * Create back end form for specifying image and content
	 * @param $instance
	 * @see https://codex.wordpress.org/Function_Reference/wp_parse_args
	 * @since 1.0.0
	 */
	public function form( $instance ) {

		printf( '<div class="%s_widget_form">', $this->id_base );
		/**
		 * Loop through each field and add to widget form
		 */
		foreach( $this->fields as $field => $args ) {
			/**
			 * Set value, or default
			 */
			if( !isset( $instance[$field] ) || empty( $instance[$field] ) ) {
				$instance[$field] = $args['default'];
			}
			if( file_exists( Plugin::path( "includes/widgets/inputs/{$args['type']}.php" ) ) ) {

				echo '<div class="field" style="margin-bottom: 10px;">';

					include Plugin::path( "includes/widgets/inputs/{$args['type']}.php" );

					if( isset( $args['description'] ) && !empty( $args['description'] ) )  {
						printf( '<p class="description">%s</p>', esc_attr( $args['description'] ) );
					}

				echo '</div>';
			}

		}

		echo '</div>';
	}

	/**
	 * Update form values
	 * @param $new_instance, $old_instance
	 * @since 1.0.0
	 */
	public function update( $new_instance, $old_instance ) {
		/**
		 * Loop through each field and sanitize
		 */
		foreach( $this->fields as $field => $args ) {
			if( isset( $args['sanitize'] ) && function_exists( $args['sanitize'] ) ) {
				$instance[$field] = call_user_func( $args['sanitize'], $new_instance[$field] );
			} else {
				$instance[$field] = sanitize_text_field( $new_instance[$field] );
			}
		}
		return $instance;
	}

	/**
	 * Output widget on the front end
	 * @param $args, $instance
	 * @since 1.0.0
	 */
	public function widget( $args, $instance ) {
		// Display before widget args
		echo $args['before_widget'];
		// Display Title
		if( !empty( $instance['title'] ) ) {
			$instance['title']  = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
			// Again check if filters cleared name, in the case of 'dont show titles' filter or something
			$instance['title']  = ( !empty( $instance['title']  ) ) ? $args['before_title'] . $instance['title']  . $args['after_title'] : '';
			// Display Title
			echo $instance['title'];
		}

		/**
		 * DO WIDGETY STUFF
		 */

		// Display after widgets args
		echo $args['after_widget'];
	} // end widget()

}