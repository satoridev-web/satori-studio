<#

var defaults = {
	style: '',
	delay: 0.0,
	duration: 1.0,
};

var value = '' === data.value ? defaults : jQuery.extend( true, defaults, data.value );

#>
<?php

$styles = array(
	''       => _x( 'None', 'Animation style.', 'satori-studio' ),
	'fade'   => array(
		'label'   => _x( 'Fade', 'Animation style.', 'satori-studio' ),
		'options' => array(
			'fade-in'    => _x( 'Fade In', 'Animation style.', 'satori-studio' ),
			'fade-left'  => _x( 'Fade Left', 'Animation style.', 'satori-studio' ),
			'fade-right' => _x( 'Fade Right', 'Animation style.', 'satori-studio' ),
			'fade-up'    => _x( 'Fade Up', 'Animation style.', 'satori-studio' ),
			'fade-down'  => _x( 'Fade Down', 'Animation style.', 'satori-studio' ),
		),
	),
	'slide'  => array(
		'label'   => _x( 'Slide', 'Animation style.', 'satori-studio' ),
		'options' => array(
			'slide-in-left'  => _x( 'Slide Left', 'Animation style.', 'satori-studio' ),
			'slide-in-right' => _x( 'Slide Right', 'Animation style.', 'satori-studio' ),
			'slide-in-up'    => _x( 'Slide Up', 'Animation style.', 'satori-studio' ),
			'slide-in-down'  => _x( 'Slide Down', 'Animation style.', 'satori-studio' ),
		),
	),
	'zoom'   => array(
		'label'   => _x( 'Zoom', 'Animation style.', 'satori-studio' ),
		'options' => array(
			'zoom-in'    => _x( 'Zoom In', 'Animation style.', 'satori-studio' ),
			'zoom-left'  => _x( 'Zoom Left', 'Animation style.', 'satori-studio' ),
			'zoom-right' => _x( 'Zoom Right', 'Animation style.', 'satori-studio' ),
			'zoom-up'    => _x( 'Zoom Up', 'Animation style.', 'satori-studio' ),
			'zoom-down'  => _x( 'Zoom Down', 'Animation style.', 'satori-studio' ),
		),
	),
	'bounce' => array(
		'label'   => _x( 'Bounce', 'Animation style.', 'satori-studio' ),
		'options' => array(
			'bounce'       => _x( 'Bounce', 'Animation style.', 'satori-studio' ),
			'bounce-in'    => _x( 'Bounce In', 'Animation style.', 'satori-studio' ),
			'bounce-left'  => _x( 'Bounce Left', 'Animation style.', 'satori-studio' ),
			'bounce-right' => _x( 'Bounce Right', 'Animation style.', 'satori-studio' ),
			'bounce-up'    => _x( 'Bounce Up', 'Animation style.', 'satori-studio' ),
			'bounce-down'  => _x( 'Bounce Down', 'Animation style.', 'satori-studio' ),
		),
	),
	'rotate' => array(
		'label'   => _x( 'Rotate', 'Animation style.', 'satori-studio' ),
		'options' => array(
			'rotate-in'         => _x( 'Rotate In', 'Animation style.', 'satori-studio' ),
			'rotate-down-left'  => _x( 'Rotate Down Left', 'Animation style.', 'satori-studio' ),
			'rotate-down-right' => _x( 'Rotate Down Right', 'Animation style.', 'satori-studio' ),
			'rotate-up-left'    => _x( 'Rotate Up Left', 'Animation style.', 'satori-studio' ),
			'rotate-up-right'   => _x( 'Rotate Up Right', 'Animation style.', 'satori-studio' ),
		),
	),
	'flip'   => array(
		'label'   => _x( 'Flip', 'Animation style.', 'satori-studio' ),
		'options' => array(
			'flip-vertical'   => _x( 'Flip Vertical', 'Animation style.', 'satori-studio' ),
			'flip-horizontal' => _x( 'Flip Horizontal', 'Animation style.', 'satori-studio' ),
		),
	),
	'fancy'  => array(
		'label'   => _x( 'Fancy', 'Animation style.', 'satori-studio' ),
		'options' => array(
			'fancy-flash'       => _x( 'Flash', 'Animation style.', 'satori-studio' ),
			'fancy-pulse'       => _x( 'Pulse', 'Animation style.', 'satori-studio' ),
			'fancy-rubber-band' => _x( 'Rubber Band', 'Animation style.', 'satori-studio' ),
			'fancy-shake'       => _x( 'Shake', 'Animation style.', 'satori-studio' ),
			'fancy-swing'       => _x( 'Swing', 'Animation style.', 'satori-studio' ),
			'fancy-tada'        => _x( 'Tada', 'Animation style.', 'satori-studio' ),
			'fancy-wobble'      => _x( 'Wobble', 'Animation style.', 'satori-studio' ),
			'fancy-jello'       => _x( 'Jello', 'Animation style.', 'satori-studio' ),
			'fancy-light-speed' => _x( 'Light Speed', 'Animation style.', 'satori-studio' ),
			'fancy-jack-box'    => _x( 'Jack in the Box', 'Animation style.', 'satori-studio' ),
			'fancy-roll-in'     => _x( 'Roll In', 'Animation style.', 'satori-studio' ),
		),
	),
);

?>
<#

var style = wp.template( 'fl-builder-field-select' )( {
	name: data.name + '[][style]',
	value: value.style,
	field: {
		options: <?php echo json_encode( $styles ); ?>,
	},
} );

var delay = wp.template( 'fl-builder-field-unit' )( {
	name: data.name + '[][delay]',
	value: value.delay,
	field: {
		units: [ 'seconds' ],
		slider: true,
	},
} );

var duration = wp.template( 'fl-builder-field-unit' )( {
	name: data.name + '[][duration]',
	value: value.duration,
	field: {
		units: [ 'seconds' ],
		slider: true,
	},
} );

#>
<div class="fl-compound-field fl-animation-field">
	<div class="fl-compound-field-section">
		<div class="fl-compound-field-row">
			<div class="fl-compound-field-setting fl-animation-field-style">
				{{{style}}}
			</div>
		</div>
		<div class="fl-compound-field-row">
			<div class="fl-compound-field-setting fl-animation-field-delay">
				{{{delay}}}
				<label class="fl-compound-field-label fl-compound-field-label-bottom">
					<?php _e( 'Delay', 'satori-studio' ); ?>
				</label>
			</div>
			<div class="fl-compound-field-setting fl-animation-field-duration">
				{{{duration}}}
				<label class="fl-compound-field-label fl-compound-field-label-bottom">
					<?php _e( 'Duration', 'satori-studio' ); ?>
				</label>
			</div>
		</div>
	</div>
</div>
