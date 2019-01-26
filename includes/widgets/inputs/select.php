<label for="<?php echo $this->get_field_name( $field ); ?>"><?php echo $args['label']; ?></label>
<select name="<?php echo $this->get_field_name( $field ); ?>" id="<?php echo $this->get_field_id( $field ); ?>" class="widefat">
	<option value="">Choose Option</option>
</select>
<?php if( isset( $args['description'] ) && !empty( $args['description'] ) ) : ?>
	<p class="description"><?php echo esc_attr( $args['description'] ); ?></p>
<?php endif ?>