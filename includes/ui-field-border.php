<#
var i18n = {
	general: '<?php esc_attr_e( 'General', 'satori-studio' ); ?>',
	radius: '<?php esc_attr_e( 'Radius', 'satori-studio' ); ?>',
	shadow: '<?php esc_attr_e( 'Shadow', 'satori-studio' ); ?>',
	separator: '<?php esc_attr_e( '&amp;', 'satori-studio' ); ?>'
};

var defaults = {
	style: '',
	color: '',
	width: {
		top: '',
		right: '',
		bottom: '',
		left: '',
	},
	radius: {
		top_left: '',
		top_right: '',
		bottom_left: '',
		bottom_right: '',
	},
	shadow: {
		color: '',
		horizontal: '',
		vertical: '',
		blur: '',
		spread: '',
	},
};

var disabledDefaults = {
	default: {},
	large: {},
	medium: {},
	responsive: {}
};

var shadowRadiusLabel = [];
var value = '' === data.value ? defaults : jQuery.extend( true, defaults, data.value );
var device = data.device ? data.device : 'default';
var disabledFields = {};
var disabled = [];

if (typeof data.field.disabled !== 'undefined') {
	disabledFields = jQuery.extend( true, disabledDefaults, data.field.disabled )
} else {
	disabledFields = disabledDefaults
}

jQuery.each(disabledFields[device], function(i,v){
	disabled.push(v)
})

// Helper function to check if a field is enabled.
var flBorderControlEnabled = function( field ) {
	if (jQuery.inArray(field, disabled ) !== -1 ) {
		return false
	}
	return true;
}

// set label
if (flBorderControlEnabled('radius')) {
	shadowRadiusLabel.push(i18n.radius)
}

if (flBorderControlEnabled('shadow')) {
	shadowRadiusLabel.push(i18n.shadow)
}

var style = wp.template( 'fl-builder-field-select' )( {
	name: data.name + '[][style]',
	value: value.style,
	field: {
		options: {
			'': '<?php esc_attr_e( 'Default', 'satori-studio' ); ?>',
			'none': '<?php esc_attr_e( 'None', 'satori-studio' ); ?>',
			'solid': '<?php esc_attr_e( 'Solid', 'satori-studio' ); ?>',
			'dashed': '<?php esc_attr_e( 'Dashed', 'satori-studio' ); ?>',
			'dotted': '<?php esc_attr_e( 'Dotted', 'satori-studio' ); ?>',
			'double': '<?php esc_attr_e( 'Double', 'satori-studio' ); ?>',
		},
	},
} );

var color = wp.template( 'fl-builder-field-color' )( {
	name: data.name + '[][color]',
	value: value.color,
	field: {
		className: 'fl-border-field-color',
		show_reset: true,
		show_alpha: true,
	},
	deferRendering: true,
} );

var width = wp.template( 'fl-builder-field-dimension' )( {
	name: data.name,
	rootName: data.name,
	names: {
		top: data.name + '[][width][top]',
		right: data.name + '[][width][right]',
		bottom: data.name + '[][width][bottom]',
		left: data.name + '[][width][left]',
	},
	values: {
		top: value.width.top,
		right: value.width.right,
		bottom: value.width.bottom,
		left: value.width.left,
	},
	field: {
		units: [ 'px' ],
		slider: true,
	},
} );

var radius = wp.template( 'fl-builder-field-dimension' )( {
	name: data.name,
	rootName: data.name,
	names: {
		top_left: data.name + '[][radius][top_left]',
		top_right: data.name + '[][radius][top_right]',
		bottom_left: data.name + '[][radius][bottom_left]',
		bottom_right: data.name + '[][radius][bottom_right]',
	},
	values: {
		top_left: value.radius.top_left,
		top_right: value.radius.top_right,
		bottom_left: value.radius.bottom_left,
		bottom_right: value.radius.bottom_right,
	},
	field: {
		units: [ 'px' ],
		slider: true,
		keys: {
			top_left: '',
			top_right: '',
			bottom_left: '',
			bottom_right: '',
		},
	},
} );

var shadow = wp.template( 'fl-builder-field-shadow' )( {
	name: data.name + '[][shadow]',
	value: value.shadow,
	field: {
		show_spread: true,
	},
	deferColorPickers: true,
} );

#>
<div class="fl-compound-field fl-border-field">
	<div class="fl-compound-field-section fl-border-field-section-general">
		<# if ( shadowRadiusLabel.length > 0 ) { #>
			<div class="fl-compound-field-section-toggle">
				<i class="dashicons dashicons-arrow-right-alt2"></i>
				{{{i18n.general}}}
			</div>
		<# } #>
		<div class="fl-compound-field-row">
			<div class="fl-compound-field-setting fl-border-field-style" data-property="border-style">
				<label class="fl-compound-field-label">
					<?php _e( 'Style', 'satori-studio' ); ?>
				</label>
				{{{style}}}
			</div>
			<div class="fl-compound-field-setting fl-border-field-color" data-property="border-color">
				<label class="fl-compound-field-label">
					<?php _e( 'Color', 'satori-studio' ); ?>
				</label>
				{{{color}}}
			</div>
		</div>
		<div class="fl-compound-field-row">
			<div class="fl-compound-field-setting fl-border-field-width" data-property="border-width">
				<label class="fl-compound-field-label">
					<?php _e( 'Width', 'satori-studio' ); ?>
				</label>
				{{{width}}}
			</div>
		</div>
	</div>
	<# if ( shadowRadiusLabel.length > 0 ) { #>
		<div class="fl-compound-field-section fl-border-field-section-radius">
			<div class="fl-compound-field-section-toggle">
				<i class="dashicons dashicons-arrow-right-alt2"></i>
				{{{shadowRadiusLabel.join(' ' + i18n.separator + ' ')}}}
			</div>
			<# if ( flBorderControlEnabled( 'radius' ) ) { #>
				<div class="fl-compound-field-row">
					<div class="fl-compound-field-setting fl-border-field-radius" data-property="border-radius">
						<label class="fl-compound-field-label">
							<?php _e( 'Radius', 'satori-studio' ); ?>
						</label>
						{{{radius}}}
					</div>
				</div>
			<# } #>
			<# if ( flBorderControlEnabled( 'shadow' ) ) { #>
				<div class="fl-compound-field-row">
					<div class="fl-compound-field-setting fl-border-field-shadow" data-property="box-shadow">
						<label class="fl-compound-field-label">
							<?php _e( 'Box Shadow', 'satori-studio' ); ?>
						</label>
						{{{shadow}}}
					</div>
				</div>
			<# } #>
		</div>
	<# } #>
</div>
