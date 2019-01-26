<?php
/**
 * Normalize the arguments required for this field type
 */
$defaults = array(
	'label' => '',
	'class' => '',
	'value' => '1'
);
$args = array_merge( $defaults, $args );
/**
 * Do Input
 */
printf( '<input name="%s" id="%s" class="%s" type="checkbox" value="%s" %s/>',
	$this->get_field_name( $field ),
	$this->get_field_id( $field ),
	$args['class'],
	$args['value'],
	checked( $instance[$field], $args['value'], false )
);
/**
 * Do label
 */
printf( '<label for="%s">%s</label>',
	$this->get_field_name( $field ),
	esc_attr( $args['label'] )
);