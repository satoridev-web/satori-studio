<#
const defaultValue = {
	grow: '',
	shrink: '',
	basis: {
		length: '',
		unit: '',
	},
}
const value = { ...defaultValue, ...data.value }

var basis = wp.template( 'fl-builder-field-unit' )( {
	name: data.name + '[][basis][length]',
	value: value.basis.length,
	unit_name: data.name + '[][basis][unit]',
	unit_value: value.basis.unit,
	field: {
		units: [ 'px', '%', 'em', 'rem', 'vw' ],
		slider: {
			min: 0,
			max: 1500,
			step: 1,
		},
	},
} );
#>
<div class="fl-builder-field-grid">
	<label>
		<?php _e( 'Grow', 'satori-studio' ); ?>
	</label>
	<div class="fl-compound-field-setting">
		<fl-stepper data-name="{{{data.name}}}[grow]" min="0">
			<input type="hidden" name="{{{data.name}}}[grow]" value="{{{value.grow}}}" />
		</fl-stepper>
	</div>
	<label>
		<?php _e( 'Shrink', 'satori-studio' ); ?>
	</label>
	<div class="fl-compound-field-setting">
		<fl-stepper data-name="{{{data.name}}}[shrink]" min="0">
			<input type="hidden" name="{{{data.name}}}[shrink]" value="{{{value.shrink}}}" />
		</fl-stepper>
	</div>
	<label>
		<?php _e( 'Basis', 'satori-studio' ); ?>
	</label>
	<div class="fl-compound-field-setting">
		{{{ basis }}}
	</div>
</div>
