<label for="<?php echo $this->get_field_name( $field ); ?>"><?php echo $args['label']; ?></label>
<input type="text" name="<?php echo $this->get_field_name( $field ); ?>" id="<?php echo $this->get_field_id( $field ); ?>" class="widefat" value="<?php echo esc_attr( $instance[$field] ); ?>">
<?php if( isset( $args['description'] ) && !empty( $args['description'] ) ) : ?>
	<p class="description"><?php echo esc_attr( $args['description'] ); ?></p>
<?php endif ?>