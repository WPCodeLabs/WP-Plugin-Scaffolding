<?php
/**
 * Normalize the arguments required for this field type
 */
$defaults = array(
	'label' => '',
	'class' => 'widefat',
	'rows'   => 10,
	'cols'  => 30,
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
printf( '<textarea name="%s" id="%s" class="%s" rows="%d" cols="%d">%s</textarea>',
	$this->get_field_name( $field ),
	$this->get_field_id( $field ),
	$args['class'],
	$args['rows'],
	$args['cols'],
	esc_attr( $instance[$field] )
);