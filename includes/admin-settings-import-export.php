<div id="fl-import-export-form" class="fl-settings-form">
	<h3 class="fl-settings-form-header"><?php _e( 'Import / Export Settings', 'satori-studio' ); ?></h3>
	<p class="warning"><?php _e( 'Exports completed with versions prior to 2.8.1 are not compatible due to a change in format of export data.', 'satori-studio' ); ?></p>
	<p>
		<input class='global_all' type='checkbox' checked name='global_all' /> <?php _e( 'All Settings', 'satori-studio' ); ?>
		<p class='extra' style='display:none'>
			<input class='admin' type='checkbox' checked name='admin' /> <?php _e( 'Admin Settings', 'satori-studio' ); ?><br />
			<input class='global' type='checkbox' checked name='global' /> <?php _e( 'Global Settings', 'satori-studio' ); ?><br />
			<input class='styles' type='checkbox' checked name='styles' /> <?php _e( 'Global Styles', 'satori-studio' ); ?><br />
			<input class='colors' type='checkbox' checked name='colors' /> <?php _e( 'Global Colors', 'satori-studio' ); ?><br />
		</p>
			<input type="button" class="button button-primary export" value="<?php _e( 'Export Settings', 'satori-studio' ); ?>" />
	</p>
	<hr />
	<p>
		<input type="button" class="button button-primary import" value="<?php _e( 'Import Settings', 'satori-studio' ); ?>" />
	</p>
		<hr />
	<p>
		<input style="background:red;border-color:red" type="button" class="button button-primary reset" value="<?php _e( 'Reset Settings', 'satori-studio' ); ?>" />
	</p>
		<hr />
	<?php wp_nonce_field( 'fl_builder_import_export' ); ?>
	<p>
		<?php
		$link = sprintf( '<a target="_blank" href="https://docs.wpbeaverbuilder.com/beaver-builder/management-migration/import-export-settings">%s</a>', esc_attr__( 'documentation', 'satori-studio' ) );
		// translators: %s: Link to documentation
		printf( __( 'See %s for more information.', 'satori-studio' ), $link );
		?>
	</p>
</div>
