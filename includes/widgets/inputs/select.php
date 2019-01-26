<?php
/**
 * Normalize the arguments required for this field type
 */
$defaults = array(
	'label' => '',
	'class' => 'widefat',
	'options' => array(
		'' => __( 'Select Option', 'wpcl_plugin_scaffolding' ),
	),
);
$args = array_merge( $defaults, $args );
/**
 * Do label
 */
printf( '<label for="%s">%s</label>',
	$this->get_field_name( $field ),
	esc_attr( $args['label'] )
);
/**
 * Open select
 */
printf( '<select name="%s" id="%s" class="%s">',
	$this->get_field_name( $field ),
	$this->get_field_id( $field ),
	$args['class']
);
/**
 * Do Options
 */
foreach( $args['options'] as $value => $label ) {
	printf( '<option value="%s"%s>%s</option>',
		$value,
		selected( $instance[$field], $value, false ),
		$label
	);
}
/**
 * Close Select
 */
echo '</select>';