<select name="<?php echo $name; ?>_matching">
	<?php /* translators: %s: an object like posts or taxonomie */ ?>
	<option value="1" <?php selected( $settings->{ $name . '_matching' }, '1' ); ?>><?php printf( _x( 'Match these %s...', '%s is an object like posts or taxonomies.', 'satori-studio' ), $label ); ?></option>
	<?php /* translators: %s: an object like posts or taxonomie */ ?>
	<option value="0" <?php selected( $settings->{ $name . '_matching' }, '0' ); ?>><?php printf( _x( 'Match all %s except...', '%s is an object like posts or taxonomies.', 'satori-studio' ), $label ); ?></option>
	<?php if ( 'fl_as_terms' === $field['action'] ) : ?>
		<?php /* translators: %s: an object like posts or taxonomie */ ?>
		<option value="related" <?php selected( $settings->{ $name . '_matching' }, 'related' ); ?>><?php printf( _x( 'Match all related %s except...', '%s is an object like posts or taxonomies.', 'satori-studio' ), $label ); ?></option>
	<?php endif; ?>

	<?php if ( 'fl_as_users' === $field['action'] ) : ?>
		<option value="author" <?php selected( $settings->{ $name . '_matching' }, 'author' ); ?>><?php _e( 'Current author', 'satori-studio' ); ?></option>
		<option value="loggedin" <?php selected( $settings->{ $name . '_matching' }, 'loggedin' ); ?>><?php _e( 'Current logged in user', 'satori-studio' ); ?></option>
	<?php endif; ?>
</select>
