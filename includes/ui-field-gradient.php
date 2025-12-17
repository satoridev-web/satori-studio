<#

var defaults = {
	type: 'linear',
	angle: 90,
	position: 'center center',
	colors: [ '', '' ],
	stops: [ 0, 100 ],
};

if ( typeof data.field.defaults !== 'undefined' ) {
	defaults = jQuery.extend( true, defaults, data.field.defaults );
}

var value = '' === data.value ? defaults : jQuery.extend( true, defaults, data.value );

var type = wp.template( 'fl-builder-field-select' )( {
	name: data.name + '[][type]',
	value: value.type,
	field: {
		className: 'fl-gradient-picker-type-select',
		options: {
			'linear': '<?php esc_attr_e( 'Linear', 'satori-studio' ); ?>',
			'radial': '<?php esc_attr_e( 'Radial', 'satori-studio' ); ?>',
		},
	},
} );

var angle = wp.template( 'fl-builder-field-unit' )( {
	name: data.name + '[][angle]',
	value: value.angle,
	field: {
		className: 'fl-gradient-picker-angle',
		slider: { max: 360 },
	},
} );

var position = wp.template( 'fl-builder-field-select' )( {
	name: data.name + '[][position]',
	value: value.position,
	field: {
		className: 'fl-gradient-picker-position',
		options: {
			'left top': '<?php esc_attr_e( 'Left Top', 'satori-studio' ); ?>',
			'left center': '<?php esc_attr_e( 'Left Center', 'satori-studio' ); ?>',
			'left bottom': '<?php esc_attr_e( 'Left Bottom', 'satori-studio' ); ?>',
			'right top': '<?php esc_attr_e( 'Right Top', 'satori-studio' ); ?>',
			'right center': '<?php esc_attr_e( 'Right Center', 'satori-studio' ); ?>',
			'right bottom': '<?php esc_attr_e( 'Right Bottom', 'satori-studio' ); ?>',
			'center top': '<?php esc_attr_e( 'Center Top', 'satori-studio' ); ?>',
			'center center': '<?php esc_attr_e( 'Center Center', 'satori-studio' ); ?>',
			'center bottom': '<?php esc_attr_e( 'Center Bottom', 'satori-studio' ); ?>',
		},
	},
} );

var color0 = wp.template( 'fl-builder-field-color' )( {
	name: data.name + '[][colors][0]',
	value: value.colors[ 0 ],
	field: {
		className: 'fl-gradient-picker-color',
		show_reset: true,
		show_alpha: true,
	},
	deferRendering: true,
} );

var stop0 = wp.template( 'fl-builder-field-unit' )( {
	name: data.name + '[][stops][0]',
	value: value.stops[ 0 ],
	field: {
		slider: true,
	},
} );

var color1 = wp.template( 'fl-builder-field-color' )( {
	name: data.name + '[][colors][1]',
	value: value.colors[ 1 ],
	field: {
		className: 'fl-gradient-picker-color',
		show_reset: true,
		show_alpha: true,
	},
	deferRendering: true,
} );

var stop1 = wp.template( 'fl-builder-field-unit' )( {
	name: data.name + '[][stops][1]',
	value: value.stops[ 1 ],
	field: {
		slider: true,
	},
} );

#>
<div class="fl-gradient-picker">
	<div class="fl-gradient-picker-type">
		{{{type}}}
		<div class="fl-gradient-picker-angle-wrap">
			{{{angle}}}
		</div>
		{{{position}}}
	</div>
	<div class="fl-gradient-picker-colors">
		<div class="fl-gradient-picker-color-row">
			{{{color0}}}
			<div class="fl-gradient-picker-stop">
				{{{stop0}}}
			</div>
		</div>
		<div class="fl-gradient-picker-color-row">
			{{{color1}}}
			<div class="fl-gradient-picker-stop">
				{{{stop1}}}
			</div>
		</div>
	</div>
</div>
