<#
const strings = {
	columns: '<?php _e( 'Columns', 'satori-studio' ); ?>',
	rows: '<?php _e( 'Rows', 'satori-studio' ); ?>',
	auto_columns: '<?php _e( 'Auto Columns', 'satori-studio' ); ?>',
	auto_rows: '<?php _e( 'Auto Rows', 'satori-studio' ); ?>',
	clear: '<?php _e( 'Clear', 'satori-studio' ); ?>',
	addNew: '<?php _e( 'Add New...', 'satori-studio' ); ?>',
	clone: '<?php _e( 'Duplicate', 'satori-studio' ); ?>',
	delete: '<?php _e( 'Remove', 'satori-studio' ); ?>',
}
const defaults = {
	columns: [],
	rows: [],
	auto_columns: [],
	auto_rows: []
}
const value = { ...defaults, ...data.value }
#>
<fl-grid-tracklist
	name='{{{ data.name }}}'
	value='{{{ JSON.stringify( value ) }}}'
	strings='{{{ JSON.stringify( strings ) }}}'
></fl-grid-tracklist>
