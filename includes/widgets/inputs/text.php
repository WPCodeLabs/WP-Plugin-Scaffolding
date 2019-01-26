<?php
/**
 * Normalize the arguments required for this field type
 */
$defaults = array(
	'label' => '',
	'class' => 'widefat',
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
 * Do Input
 */
printf( '<input name="%s" id="%s" class="%s" type="text" value="%s"/>',
	$this->get_field_name( $field ),
	$this->get_field_id( $field ),
	$args['class'],
	esc_attr( $instance[$field] )
);