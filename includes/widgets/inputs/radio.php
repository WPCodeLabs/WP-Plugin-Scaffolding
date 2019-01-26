<?php
/**
 * Normalize the arguments required for this field type
 */
$defaults = array(
	'label'   => '',
	'class'   => 'widefat',
	'default' => '1',
	'options' => array(
		'1' => __( 'Option 1', 'wpcl_plugin_scaffolding' ),
		'2' => __( 'Option 2', 'wpcl_plugin_scaffolding' ),
	),
);
$args = array_merge( $defaults, $args );
/**
 * Open group
 */
echo '<radiogroup>';
/**
 * do legend
 */
printf( '<legend>%s</legend>',
	$args['label']
);
/**
 * Do Options
 */
foreach( $args['options'] as $value => $label ) {
	printf( '<input name="%s" id="%s" class="%s" type="radio" value="%s"%s/>',
		$this->get_field_name( $field ),
		$this->get_field_id( $field ),
		$args['class'],
		$value,
		checked( $instance[$field], $value, false )
	);
	printf( '<label for="%s">%s</label>',
		$this->get_field_name( $field ),
		esc_attr( $label )
	);
	echo '</br>';
}
/**
 * Close group
 */
echo '</radiogroup>';