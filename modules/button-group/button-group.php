<?php

/**
 * @class FLButtonGroupModule
 */
class FLButtonGroupModule extends FLBuilderModule {

	/**
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(array(
			'name'            => __( 'Button Group', 'satori-studio' ),
			'description'     => __( 'Renders a series of call to action buttons.', 'satori-studio' ),
			'category'        => __( 'Basic', 'satori-studio' ),
			'icon'            => 'button.svg',
			'partial_refresh' => true,
			'include_wrapper' => false,
			'element_setting' => false,
		));
	}

	/**
	 * Return the root CSS selector for the module. In v2 of this module,
	 * the root classes are on the module itself, not an inner div.
	 *
	 * @since 2.9
	 * @param array $classes
	 * @return string
	 */
	public function root_selector( $classes = [] ) {
		if ( 1 < $this->version ) {
			$class = implode( '', $classes );
			return ".fl-node-{$this->node}{$class}";
		}

		$class = implode( ' ', $classes );
		return ".fl-node-{$this->node} {$class}";
	}

	/**
	 * This is used in generating the alignment of the horizontal buttons.
	 *
	 * @method map_horizontal_alignment
	 * @return string
	 */
	public function map_horizontal_alignment( $align ) {
		$map_alignment = array(
			'left'   => 'flex-start',
			'center' => 'center',
			'right'  => 'flex-end',
		);

		return $map_alignment[ $align ];
	}

	/**
	 * @method enqueue_scripts
	 */
	public function enqueue_scripts() {
		$this->add_js( 'jquery-magnificpopup' );
		$this->add_css( 'font-awesome-5' );
		$this->add_css( 'jquery-magnificpopup' );
	}

	/**
	 * @method update
	 * @param object $settings A module settings object.
	 * @return object
	 */
	public function update( $settings ) {
		for ( $i = 0; $i < count( $settings->items ); $i++ ) {
			$button_item = $settings->items[ $i ];

			if ( ! is_object( $button_item ) ) {
				continue;
			}

			// Button Item Background Animation -- Rename 'button_transition' to 'button_item_button_transition'
			if ( isset( $button_item->button_transition ) ) {
				$settings->items[ $i ]->button_item_button_transition = $button_item->button_transition;
				unset( $settings->items[ $i ]->button_transition );
			}
		}
		return $settings;
	}

	/**
	 * Ensure backwards compatibility with old settings.
	 *
	 * @param object $settings A module settings object.
	 * @param object $helper A settings compatibility helper.
	 * @return object
	 */
	public function filter_settings( $settings, $helper ) {

		// Convert 'space_between' Unit field to 'button_spacing' Dimension field.
		// @since 2.4.1
		if ( isset( $settings->space_between ) ) {

			// Left and Top Spacing
			foreach ( array( '_left', '_left_large', '_left_medium', '_left_responsive', '_top', '_top_large', '_top_medium', '_top_responsive' ) as $key ) {
				$settings->{ 'button_spacing' . $key } = 0;
			}

			// Right Spacing -- apply on horizontal layout.
			if ( 'horizontal' === $settings->layout ) {
				foreach ( array( '_right', '_right_large', '_right_medium', '_right_responsive' )  as $key ) {
					$settings->{ 'button_spacing' . $key } = intval( $settings->space_between );
				}
			}

			// Bottom Spacing
			foreach ( array( '_bottom', '_bottom_large', '_bottom_medium', '_bottom_responsive' )  as $key ) {
				$settings->{ 'button_spacing' . $key } = intval( $settings->space_between );
			}

			unset( $settings->space_between );
		}

		if ( isset( $settings->space_between_unit ) ) {
			foreach ( array( '_unit', '_large_unit', '_medium_unit', '_responsive_unit' ) as $unit ) {
				$settings->{'button_spacing' . $unit } = $settings->space_between_unit;
			}
			unset( $settings->space_between_unit );
		}

		// Width changed from Full 'full' to Default ''.
		// @since 2.4.2
		if ( 'full' === $settings->width ) {
			$settings->width = '';
		}

		// Handle individual button settings.
		for ( $i = 0; $i < count( $settings->items ); $i++ ) {

			$button_item = $settings->items[ $i ];

			if ( ! is_object( $button_item ) ) {
				continue;
			}

			// Button Item Typography -- Rename 'typography' to 'button_item_typography'.
			if ( empty( $button_item->button_item_typography ) && ! empty( $button_item->typography ) ) {
				$settings->items[ $i ]->button_item_typography = $button_item->typography;
			}

			// Button Item Text Color -- Rename 'text_color' to 'button_item_text_color'.
			if ( empty( $button_item->button_item_text_color ) && ! empty( $button_item->text_color ) ) {
				$settings->items[ $i ]->button_item_text_color = $button_item->text_color;
			}

			// Button Item Background Color -- Rename 'bg_color' to 'button_item_bg_color'.
			if ( empty( $button_item->button_item_bg_color ) && ! empty( $button_item->bg_color ) ) {
				$settings->items[ $i ]->button_item_bg_color = $button_item->bg_color;
			}

			// Button Item Text Hover Color -- Rename 'text_hover_color' to 'button_item_text_hover_color'.
			if ( empty( $button_item->button_item_text_hover_color ) && ! empty( $button_item->text_hover_color ) ) {
				$settings->items[ $i ]->button_item_text_hover_color = $button_item->text_hover_color;
			}

			// Button Item Background Hover Color -- Rename 'bg_hover_color' to 'button_item_bg_hover_color'
			if ( empty( $button_item->button_item_bg_hover_color ) && ! empty( $button_item->bg_hover_color ) ) {
				$settings->items[ $i ]->button_item_bg_hover_color = $button_item->bg_hover_color;
			}

			// Button Item Border Hover Color -- Rename 'border_hover_color' to 'button_item_border_hover_color'
			if ( empty( $button_item->button_item_border_hover_color ) && ! empty( $button_item->border_hover_color ) ) {
				$settings->items[ $i ]->button_item_border_hover_color = $button_item->border_hover_color;
			}

			// Button Item Background Style -- Rename 'style' to 'button_item_style'.
			if ( empty( $button_item->button_item_style ) && ! empty( $button_item->style ) ) {
				$settings->items[ $i ]->button_item_style = $button_item->style;
			}

			// Button Item Background Gradient -- Rename 'bg_gradient' to 'button_item_bg_gradient'
			if ( empty( $button_item->button_item_bg_gradient ) && ! empty( $button_item->bg_gradient ) ) {
				$settings->items[ $i ]->button_item_bg_gradient = $button_item->bg_gradient;
			}

			// Button Item Background Hover Gradient -- Rename 'bg_gradient_hover' to 'button_item_bg_gradient_hover'
			if ( empty( $button_item->button_item_bg_gradient_hover ) && ! empty( $button_item->bg_gradient_hover ) ) {
				$settings->items[ $i ]->button_item_bg_gradient_hover = $button_item->bg_gradient_hover;
			}

			// Button Item Background Animation -- Rename 'button_transition' to 'button_item_button_transition'
			if ( isset( $button_item->button_transition ) ) {
				$settings->items[ $i ]->button_item_button_transition = $button_item->button_transition;
				unset( $settings->items[ $i ]->button_transition );
			}

			// Button Item Border -- Rename 'border' to 'button_item_border'.
			if ( empty( $button_item->button_item_border ) && ! empty( $button_item->border ) ) {
				$settings->items[ $i ]->button_item_border = $button_item->border;
			}
		}

		return $settings;
	}
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('FLButtonGroupModule', array(
	'buttons' => array(
		'title'    => __( 'Buttons', 'satori-studio' ),
		'sections' => array(
			'general' => array(
				'title'  => '',
				'fields' => array(
					'button_group_label' => array(
						'type'        => 'text',
						'label'       => __( 'Button Group Label', 'satori-studio' ),
						'placeholder' => __( 'Button Group Label', 'satori-studio' ),
						'connections' => array( 'string' ),
						'help'        => __( 'A unique identifier for the Button Group. This helps in accessibility.', 'satori-studio' ),
					),
					'items'              => array(
						'type'         => 'form',
						'label'        => __( 'Button', 'satori-studio' ),
						'form'         => 'buttons_form', // ID from registered form below
						'preview_text' => 'text', // Name of a field to use for the preview text
						'multiple'     => true,
					),
				),
			),
		),
	),
	'style'   => array(
		'title'    => __( 'Style', 'satori-studio' ),
		'sections' => array(
			'style'  => array(
				'title'  => '',
				'fields' => array(
					'layout'         => array(
						'type'    => 'select',
						'label'   => __( 'Layout', 'satori-studio' ),
						'default' => 'horizotal',
						'options' => array(
							'horizontal' => __( 'Horizontal', 'satori-studio' ),
							'vertical'   => __( 'Vertical', 'satori-studio' ),
						),
					),
					'width'          => array(
						'type'    => 'select',
						'label'   => __( 'Width', 'satori-studio' ),
						'default' => '',
						'options' => array(
							''       => __( 'Default', 'satori-studio' ),
							'custom' => __( 'Custom', 'satori-studio' ),
						),
						'toggle'  => array(
							'custom' => array(
								'fields' => array( 'custom_width' ),
							),
						),
					),
					'custom_width'   => array(
						'type'    => 'unit',
						'label'   => __( 'Custom Width', 'satori-studio' ),
						'default' => '200',
						'slider'  => array(
							'px' => array(
								'min'  => 0,
								'max'  => 1000,
								'step' => 10,
							),
						),
						'units'   => array(
							'px',
							'vw',
							'%',
						),
					),
					'align'          => array(
						'type'       => 'align',
						'label'      => __( 'Align', 'satori-studio' ),
						'default'    => 'left',
						'responsive' => true,
						'preview'    => array(
							'type' => 'refresh',
						),
					),
					'padding'        => array(
						'type'       => 'dimension',
						'label'      => __( 'Container Padding', 'satori-studio' ),
						'responsive' => true,
						'slider'     => true,
						'units'      => array( 'px' ),
						'help'       => __( 'This applies to the entire Button Group module itself.', 'satori-studio' ),
					),
					'button_padding' => array(
						'type'       => 'dimension',
						'label'      => __( 'Button Padding', 'satori-studio' ),
						'responsive' => true,
						'slider'     => true,
						'units'      => array( 'px' ),
						'help'       => __( 'Apply padding to all buttons. This can be overridden in the individual button settings.', 'satori-studio' ),
					),
					'button_spacing' => array(
						'type'         => 'dimension',
						'label'        => __( 'Button Spacing', 'satori-studio' ),
						'responsive'   => true,
						'slider'       => true,
						'default'      => '5',
						'default_unit' => 'px',
						'units'        => array(
							'px',
							'em',
							'%',
							'vw',
						),
					),
				),
			),
			'text'   => array(
				'title'  => __( 'Text', 'satori-studio' ),
				'fields' => array(
					'text_color'       => array(
						'type'        => 'color',
						'connections' => array( 'color' ),
						'label'       => __( 'Text Color', 'satori-studio' ),
						'default'     => '',
						'show_reset'  => true,
						'show_alpha'  => true,
					),
					'text_hover_color' => array(
						'type'        => 'color',
						'connections' => array( 'color' ),
						'label'       => __( 'Text Hover Color', 'satori-studio' ),
						'default'     => '',
						'show_reset'  => true,
						'show_alpha'  => true,
					),
					'typography'       => array(
						'type'       => 'typography',
						'label'      => __( 'Typography', 'satori-studio' ),
						'responsive' => true,
					),
				),
			),
			'colors' => array(
				'title'  => __( 'Background', 'satori-studio' ),
				'fields' => array(
					'style'             => array(
						'type'    => 'select',
						'label'   => __( 'Background Style', 'satori-studio' ),
						'default' => 'flat',
						'options' => array(
							'flat'         => __( 'Flat', 'satori-studio' ),
							'gradient'     => __( 'Auto Gradient', 'satori-studio' ),
							'adv-gradient' => __( 'Advanced Gradient', 'satori-studio' ),
						),
						'preview' => array(
							'type' => 'refresh',
						),
						'toggle'  => array(
							'flat'         => array(
								'fields' => array( 'button_transition' ),
							),
							'adv-gradient' => array(
								'fields' => array( 'bg_gradient', 'bg_gradient_hover' ),
							),
						),
						'hide'    => array(
							'adv-gradient' => array(
								'fields' => array( 'bg_color', 'bg_hover_color' ),
							),
						),
					),
					'bg_color'          => array(
						'type'        => 'color',
						'connections' => array( 'color' ),
						'label'       => __( 'Background Color', 'satori-studio' ),
						'default'     => '',
						'show_reset'  => true,
						'show_alpha'  => true,
						'preview'     => array(
							'type' => 'refresh',
						),
					),
					'bg_hover_color'    => array(
						'type'        => 'color',
						'connections' => array( 'color' ),
						'label'       => __( 'Background Hover Color', 'satori-studio' ),
						'default'     => '',
						'show_reset'  => true,
						'show_alpha'  => true,
						'preview'     => array(
							'type'     => 'css',
							'selector' => '.fl-button-group-buttons a.fl-button:hover',
							'property' => 'background-color',
						),
					),
					'button_transition' => array(
						'type'    => 'select',
						'label'   => __( 'Background Animation', 'satori-studio' ),
						'default' => 'disable',
						'options' => array(
							'disable' => __( 'Disabled', 'satori-studio' ),
							'enable'  => __( 'Enabled', 'satori-studio' ),
						),
						'preview' => array(
							'type' => 'none',
						),
					),
					'bg_gradient'       => array(
						'type'    => 'gradient',
						'label'   => __( 'Background Gradient', 'satori-studio' ),
						'preview' => array(
							'type' => 'refresh',
						),
					),
					'bg_gradient_hover' => array(
						'type'    => 'gradient',
						'label'   => __( 'Background Hover Gradient', 'satori-studio' ),
						'preview' => array(
							'type' => 'refresh',
						),
					),
				),
			),
			'border' => array(
				'title'  => __( 'Border', 'satori-studio' ),
				'fields' => array(
					'border'             => array(
						'type'       => 'border',
						'label'      => __( 'Border', 'satori-studio' ),
						'responsive' => true,
						'preview'    => array(
							'type' => 'refresh',
						),
					),
					'border_hover_color' => array(
						'type'        => 'color',
						'connections' => array( 'color' ),
						'label'       => __( 'Border Hover Color', 'satori-studio' ),
						'default'     => '',
						'show_reset'  => true,
						'show_alpha'  => true,
						'preview'     => array(
							'type' => 'none',
						),
					),
				),
			),
		),
	),
));


/**
 * Register a settings form to use in the "form" field type above.
 */
FLBuilder::register_settings_form('buttons_form', array(
	'title' => __( 'Add Button', 'satori-studio' ),
	'tabs'  => array(
		'general' => array(
			'title'    => __( 'General', 'satori-studio' ),
			'sections' => array(
				'general'  => array(
					'title'  => '',
					'fields' => array(
						'text'           => array(
							'type'        => 'text',
							'label'       => __( 'Text', 'satori-studio' ),
							'default'     => __( 'Click Here', 'satori-studio' ),
							'preview'     => array(
								'type' => 'refresh',
							),
							'connections' => array( 'string' ),
						),
						'icon'           => array(
							'type'        => 'icon',
							'label'       => __( 'Icon', 'satori-studio' ),
							'show_remove' => true,
							'show'        => array(
								'fields' => array( 'icon_position', 'icon_animation' ),
							),
							'preview'     => array(
								'type' => 'none',
							),
						),
						'icon_position'  => array(
							'type'    => 'select',
							'label'   => __( 'Icon Position', 'satori-studio' ),
							'default' => 'before',
							'options' => array(
								'before' => __( 'Before Text', 'satori-studio' ),
								'after'  => __( 'After Text', 'satori-studio' ),
							),
							'preview' => array(
								'type' => 'none',
							),
						),
						'icon_animation' => array(
							'type'    => 'select',
							'label'   => __( 'Icon Visibility', 'satori-studio' ),
							'default' => 'disable',
							'options' => array(
								'disable' => __( 'Always Visible', 'satori-studio' ),
								'enable'  => __( 'Fade In On Hover', 'satori-studio' ),
							),
							'preview' => array(
								'type' => 'none',
							),
						),
						'click_action'   => array(
							'type'    => 'select',
							'label'   => __( 'Click Action', 'satori-studio' ),
							'default' => 'link',
							'options' => array(
								'link'     => __( 'Link', 'satori-studio' ),
								'lightbox' => __( 'Lightbox', 'satori-studio' ),
							),
							'toggle'  => array(
								'link'     => array(
									'fields' => array( 'link' ),
								),
								'lightbox' => array(
									'sections' => array( 'lightbox' ),
								),
							),
							'preview' => array(
								'type' => 'none',
							),
						),
						'link'           => array(
							'type'          => 'link',
							'label'         => __( 'Link', 'satori-studio' ),
							'placeholder'   => 'https://www.example.com',
							'show_target'   => true,
							'show_nofollow' => true,
							'show_target'   => true,
							'show_download' => true,
							'preview'       => array(
								'type' => 'none',
							),
							'connections'   => array( 'url' ),
						),
					),
				),
				'lightbox' => array(
					'title'  => __( 'Lightbox Content', 'satori-studio' ),
					'fields' => array(
						'lightbox_content_type' => array(
							'type'    => 'select',
							'label'   => __( 'Content Type', 'satori-studio' ),
							'default' => 'html',
							'options' => array(
								'html'  => __( 'HTML', 'satori-studio' ),
								'video' => __( 'Video', 'satori-studio' ),
							),
							'preview' => array(
								'type' => 'none',
							),
							'toggle'  => array(
								'html'  => array(
									'fields' => array( 'lightbox_content_html' ),
								),
								'video' => array(
									'fields' => array( 'lightbox_video_link' ),
								),
							),
						),
						'lightbox_content_html' => array(
							'type'        => 'code',
							'editor'      => 'html',
							'label'       => '',
							'rows'        => '19',
							'preview'     => array(
								'type' => 'none',
							),
							'connections' => array( 'string' ),
						),
						'lightbox_video_link'   => array(
							'type'        => 'text',
							'label'       => __( 'Video Link', 'satori-studio' ),
							'placeholder' => 'https://vimeo.com/122546221',
							'preview'     => array(
								'type' => 'none',
							),
							'connections' => array( 'custom_field' ),
						),
					),
				),
			),
		),
		'style'   => array(
			'title'    => __( 'Style', 'satori-studio' ),
			'sections' => array(
				'style'              => array(
					'title'  => '',
					'fields' => array(
						'padding' => array(
							'type'       => 'dimension',
							'label'      => __( 'Padding', 'satori-studio' ),
							'responsive' => true,
							'slider'     => true,
							'units'      => array( 'px' ),
						),
					),
				),
				'text'               => array(
					'title'  => __( 'Text', 'satori-studio' ),
					'fields' => array(
						'button_item_text_color'       => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Text Color', 'satori-studio' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
						),
						'button_item_text_hover_color' => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Text Hover Color', 'satori-studio' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
						),
						'button_item_typography'       => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'satori-studio' ),
							'responsive' => true,
						),
					),
				),
				'colors'             => array(
					'title'  => __( 'Background', 'satori-studio' ),
					'fields' => array(
						'button_item_style'             => array(
							'type'    => 'select',
							'label'   => __( 'Background Style', 'satori-studio' ),
							'default' => 'flat',
							'options' => array(
								'flat'         => __( 'Flat', 'satori-studio' ),
								'gradient'     => __( 'Auto Gradient', 'satori-studio' ),
								'adv-gradient' => __( 'Advanced Gradient', 'satori-studio' ),
							),
							'toggle'  => array(
								'flat'         => array(
									'fields' => array( 'button_item_button_transition' ),
								),
								'adv-gradient' => array(
									'fields' => array( 'button_item_bg_gradient', 'button_item_bg_gradient_hover' ),
								),
							),
							'hide'    => array(
								'adv-gradient' => array(
									'fields' => array( 'button_item_bg_color', 'button_item_bg_hover_color' ),
								),
							),
						),
						'button_item_bg_color'          => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Background Color', 'satori-studio' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type' => 'none',
							),
						),
						'button_item_bg_hover_color'    => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Background Hover Color', 'satori-studio' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type' => 'none',
							),
						),
						'button_item_button_transition' => array(
							'type'    => 'select',
							'label'   => __( 'Background Animation', 'satori-studio' ),
							'default' => '',
							'options' => array(
								''        => __( 'Default', 'satori-studio' ),
								'disable' => __( 'Disabled', 'satori-studio' ),
								'enable'  => __( 'Enabled', 'satori-studio' ),
							),
							'preview' => array(
								'type' => 'none',
							),
						),
						'button_item_bg_gradient'       => array(
							'type'    => 'gradient',
							'label'   => __( 'Background Gradient', 'satori-studio' ),
							'preview' => array(
								'type' => 'refresh',
							),
						),
						'button_item_bg_gradient_hover' => array(
							'type'    => 'gradient',
							'label'   => __( 'Background Hover Gradient', 'satori-studio' ),
							'preview' => array(
								'type' => 'refresh',
							),
						),
					),
				),
				'button_item_border' => array(
					'title'  => __( 'Border', 'satori-studio' ),
					'fields' => array(
						'button_item_border'             => array(
							'type'       => 'border',
							'label'      => __( 'Border', 'satori-studio' ),
							'responsive' => true,
							'preview'    => array(
								'type' => 'none',
							),
						),
						'button_item_border_hover_color' => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Border Hover Color', 'satori-studio' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type' => 'none',
							),
						),
					),
				),
			),
		),
	),
));
