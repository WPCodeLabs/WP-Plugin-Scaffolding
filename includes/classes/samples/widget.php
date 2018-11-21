<?php

namespace Wpcl\Scaffolding\Classes\Widgets;

use Wpcl\Scaffolding\Plugin as Plugin;

class Widget extends \WP_Widget {

	public $widget_id_base;
	public $widget_name;
	public $widget_options;
	public $control_options;
	private $fields;
	/**
	 * Constructor, initialize the widget
	 * @param $id_base, $name, $widget_options, $control_options ( ALL optional )
	 * @since 1.0.0
	 */
	public function __construct() {
		// Construct some options
		$this->widget_id_base = 'sample_widget_id';

		$this->widget_name = 'Sample Widget';

		$this->widget_options = array(
			'classname' => 'sample_widget_class',
			'description' => 'Sample Widget'
		);

		$this->fields = array(
			'title' => array(
				'type' => 'text',
				'label' => 'Title',
				'default' => null,
			),
			'sample_textarea' => array(
				'type' => 'textarea',
				'label' => 'Sample Textarea',
				'default' => null,
			),
			'sample_checkbox' => array(
				'type' => 'checkbox',
				'label' => 'Sample Checkbox',
				'default' => null,
			),
			'sample_select' => array(
				'type' => 'select',
				'label' => 'Sample Select',
				'default' => null,
				'options' => array(
					'option-1' => __( 'Option 1', 'plugin_name' ),
					'option-2' => __( 'Option 2', 'plugin_name' ),
					'option-3' => __( 'Option 3', 'plugin_name' ),
				),
			),
		);

		// Construct parent
		parent::__construct( $this->widget_id_base, $this->widget_name, $this->widget_options );
	}

	/**
	 * Create back end form for specifying image and content
	 * @param $instance
	 * @see https://codex.wordpress.org/Function_Reference/wp_parse_args
	 * @since 1.0.0
	 */
	public function form( $instance = array() ) {

		foreach( $this->fields as $field => $args ) {

			if( !isset( $instance[$field] ) ) {
				$instance[$field] = $args['default'];
			}

			echo '<p>';

			/**
			 * Maybe do labels first
			 */

			if( in_array( $args['type'], array( 'text', 'textarea', 'select' ) ) ) {
				printf( '<label for="%s">%s</label>', $this->get_field_name( $field ), $args['label'] );
			}

			/**
			 * Do input
			 */

			if( $args['type'] == 'text' ) {
				printf( '<input type="%s" name="%s" id="%s" value="%s" class="widefat" />',
					$args['type'],
					$this->get_field_name( $field ),
					$this->get_field_id( $field ),
					isset( $instance[$field] ) ? esc_attr( $instance[$field] ) : $args['default']
				);
			}

			else if( $args['type'] == 'textarea' ) {

				printf( '<textarea name="%s" id="%s" class="widefat">%s</textarea>',
					$this->get_field_name( $field ),
					$this->get_field_id( $field ),
					esc_attr( $instance[$field] )
				);
			}

			else if( $args['type'] == 'checkbox' ) {

				printf( '<input type="checkbox" name="%s" id="%s" value="1" class="widefat" %s/>',
					$this->get_field_name( $field ),
					$this->get_field_id( $field ),
					checked( intval( $instance[$field] ), 1, false )
				);
			}

			else if( $args['type'] == 'select' ) {

				printf( '<select name="%s" id="%s" class="widefat">',
					$this->get_field_name( $field ),
					$this->get_field_id( $field )
				);

				foreach( $args['options'] as $value => $label ) {
					printf( '<option value="%s"%s>%s</option>',
						esc_attr( $value ),
						selected( $instance[$field], $value, false ),
						$label
					);
				}

				echo '</select>';
			}

			/**
			 * Maybe do labels first
			 */
			if( $args['type'] == 'checkbox' ) {
				printf( '<label for="%s">%s</label>', $this->get_field_name( $field ), $args['label'] );
			}

			echo '<p>';
		}

	}

	/**
	 * Update form values
	 * @param $new_instance, $old_instance
	 * @since 1.0.0
	 */
	public function update( $instance, $old_instance ) {
		foreach( $this->fields as $field => $args ) {

			if( !isset( $instance[$field] ) ) {
				$instance[$field] = isset( $old_instance[$field] ) ? $old_instance[$field] : $args['default'];
				continue;
			}
			else {
				$instance[$field] = sanitize_text_field( $instance[$field] );
			}
		}
		// Return values
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

			$instance['title']  = apply_filters( 'widget_title', $instance['title'], $instance, $this->widget_id_base );

			// Again check if filters cleared name, in the case of 'dont show titles' filter or something
			if( !empty( $instance['title'] ) ) {
				echo $args['before_title'], $instance['title'], $args['after_title'];
			}
		}

		/**
		 * DO WIDGETY STUFF
		 */

		// Display after widgets args
		echo $args['after_widget'];
	} // end widget()

} // end class