<script type="text/javascript">

FLBuilderAdminSettingsConfig = {
	roles: <?php echo json_encode( FLBuilderUserAccess::get_all_roles() ); ?>,
	userAccess: <?php echo json_encode( FLBuilderUserAccess::get_saved_settings() ); ?>
};

FLBuilderAdminSettingsStrings = {
	deselectAll: '<?php esc_attr_e( 'Deselect All', 'satori-studio' ); ?>',
	noneSelected: '<?php esc_attr_e( 'None Selected', 'satori-studio' ); ?>',
	select: '<?php esc_attr_e( 'Select...', 'satori-studio' ); ?>',
	selected: '<?php esc_attr_e( 'Selected', 'satori-studio' ); ?>',
	selectAll: '<?php esc_attr_e( 'Select All', 'satori-studio' ); ?>',
	selectFile: '<?php esc_attr_e( 'Select File', 'satori-studio' ); ?>',
	uninstall: '<?php esc_attr_e( 'Please type "uninstall" in the box below to confirm that you really want to uninstall the page builder and all of its data.', 'satori-studio' ); ?>'
};

</script>
