<?php

/**
 * @class FLButtonModule
 */
class FLButtonModule extends FLBuilderModule {

	/**
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(array(
			'name'            => __( 'Button', 'satori-studio' ),
			'description'     => __( 'A simple call to action button.', 'satori-studio' ),
			'category'        => __( 'Basic', 'satori-studio' ),
			'icon'            => 'button.svg',
			'partial_refresh' => true,
			'include_wrapper' => false,
			'element_setting' => false,
		));
	}

	/**
	 * Ensure backwards compatibility with old settings.
	 *
	 * @since 2.2
	 * @param object $settings A module settings object.
	 * @param object $helper A settings compatibility helper.
	 * @return object
	 */
	public function filter_settings( $settings, $helper ) {

		// Handle old responsive button align.
		if ( isset( $settings->mobile_align ) ) {
			$settings->align_responsive = $settings->mobile_align;
			unset( $settings->mobile_align );
		}

		if ( ! empty( $settings->style ) && 'gradient' === $settings->style ) {
			if ( ! empty( $settings->bg_gradient ) ) {
				$button_gradient = is_array( $settings->bg_gradient ) ? $settings->bg_gradient : json_decode( json_encode( $settings->bg_gradient ), true );
				if ( ! empty( $button_gradient['colors'][0] ) || ! empty( $button_gradient['colors'][1] ) ) {
					$settings->style = 'adv-gradient';
				}
			}
		}

		// Handle old font size setting.
		if ( isset( $settings->font_size ) ) {
			$settings->typography                = array();
			$settings->typography['font_size']   = array(
				'length' => $settings->font_size,
				'unit'   => isset( $settings->font_size_unit ) ? $settings->font_size_unit : 'px',
			);
			$settings->typography['line_height'] = array(
				'length' => $settings->font_size,
				'unit'   => isset( $settings->font_size_unit ) ? $settings->font_size_unit : 'px',
			);
			unset( $settings->font_size );
			unset( $settings->font_size_unit );
		}

		// Handle old padding setting.
		if ( isset( $settings->padding ) && is_numeric( $settings->padding ) ) {
			$settings->padding_top    = $settings->padding;
			$settings->padding_bottom = $settings->padding;
			$settings->padding_left   = $settings->padding * 2;
			$settings->padding_right  = $settings->padding * 2;
			unset( $settings->padding );
		}

		// Handle old gradient style setting.
		if ( isset( $settings->three_d ) && $settings->three_d ) {
			$settings->style = 'gradient';
		}

		// Handle old border settings.
		if ( ! empty( $settings->bg_color ) && ( ! isset( $settings->border ) || empty( $settings->border ) ) ) {
			$settings->border = array();

			// Border style, color, and width
			if ( isset( $settings->border_size ) && isset( $settings->style ) && 'transparent' === $settings->style ) {
				$settings->border['style'] = 'solid';
				$settings->border['color'] = FLBuilderColor::adjust_brightness( $settings->bg_color, 12, 'darken' );
				$settings->border['width'] = array(
					'top'    => $settings->border_size,
					'right'  => $settings->border_size,
					'bottom' => $settings->border_size,
					'left'   => $settings->border_size,
				);
				unset( $settings->border_size );
				if ( ! empty( $settings->bg_hover_color ) ) {
					$settings->border_hover_color = FLBuilderColor::adjust_brightness( $settings->bg_hover_color, 12, 'darken' );
				}
			}

			// Border radius
			if ( isset( $settings->border_radius ) ) {
				$settings->border['radius'] = array(
					'top_left'     => $settings->border_radius,
					'top_right'    => $settings->border_radius,
					'bottom_left'  => $settings->border_radius,
					'bottom_right' => $settings->border_radius,
				);
				unset( $settings->border_radius );
			}
		}

		// Handle old transparent background style.
		if ( isset( $settings->style ) && 'transparent' === $settings->style ) {
			$settings->style = 'flat';
			$helper->handle_opacity_inputs( $settings, 'bg_opacity', 'bg_color' );
			$helper->handle_opacity_inputs( $settings, 'bg_hover_opacity', 'bg_hover_color' );
		}

		// Return the filtered settings.
		return $settings;
	}

	/**
	 * @method enqueue_scripts
	 */
	public function enqueue_scripts() {
		if ( $this->settings && 'lightbox' == $this->settings->click_action ) {
			$this->add_js( 'jquery-magnificpopup' );
			$this->add_css( 'font-awesome-5' );
			$this->add_css( 'jquery-magnificpopup' );
		}
	}

	/**
	 * @method update
	 */
	public function update( $settings ) {
		// Remove the old three_d setting.
		if ( isset( $settings->three_d ) ) {
			unset( $settings->three_d );
		}

		return $settings;
	}

	/**
	 * @method get_classname
	 */
	public function get_classname() {
		$classname = 'fl-button-wrap';

		if ( ! empty( $this->settings->width ) ) {
			$classname .= ' fl-button-width-' . $this->settings->width;
		}
		if ( ! empty( $this->settings->align ) ) {
			$classname .= ' fl-button-' . $this->settings->align;
		}
		if ( ! empty( $this->settings->icon ) ) {
			$classname .= ' fl-button-has-icon';
		}

		return $classname;
	}

	/**
	 * Returns button link rel based on settings
	 * @since 1.10.9
	 */
	public function get_rel() {
		$rel = array();
		if ( '_blank' == $this->settings->link_target ) {
			$rel[] = 'noopener';
		}
		if ( isset( $this->settings->link_nofollow ) && 'yes' == $this->settings->link_nofollow ) {
			$rel[] = 'nofollow';
		}
		$rel = implode( ' ', $rel );
		if ( $rel ) {
			$rel = ' rel="' . $rel . '" ';
		}
		return $rel;
	}

	public function get_role() {
		if ( isset( $this->settings->click_action ) && 'lightbox' === $this->settings->click_action ) {
			return ' role="button"';
		}
	}

	public function use_default_border() {
		if ( ! class_exists( 'FLBuilderGlobalStyles' ) ) {
			return true;
		}
		return empty( ( FLBuilderGlobalStyles::get_settings() )->button_border['style'] ) && empty( FLBuilderUtils::get_bb_theme_option( 'fl-button-border-color' ) );
	}

	public function use_default_border_hover() {
		if ( ! class_exists( 'FLBuilderGlobalStyles' ) ) {
			return true;
		}
		return empty( ( FLBuilderGlobalStyles::get_settings() )->button_border_hover_color ) && empty( FLBuilderUtils::get_bb_theme_option( 'fl-button-border-hover-color' ) );
	}
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('FLButtonModule', array(
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
							'type'     => 'text',
							'selector' => '.fl-button-text',
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
			'style'  => array(
				'title'  => '',
				'fields' => array(
					'width'        => array(
						'type'    => 'select',
						'label'   => __( 'Width', 'satori-studio' ),
						'default' => 'auto',
						'options' => array(
							'auto'   => _x( 'Auto', 'Width.', 'satori-studio' ),
							'full'   => __( 'Full Width', 'satori-studio' ),
							'custom' => __( 'Custom', 'satori-studio' ),
						),
						'toggle'  => array(
							'auto'   => array(
								'fields' => array( 'align' ),
							),
							'full'   => array(),
							'custom' => array(
								'fields' => array( 'align', 'custom_width' ),
							),
						),
					),
					'custom_width' => array(
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
						'preview' => array(
							'type'     => 'css',
							'selector' => 'a.fl-button',
							'property' => 'width',
						),
					),
					'align'        => array(
						'type'       => 'align',
						'label'      => __( 'Align', 'satori-studio' ),
						'default'    => 'left',
						'responsive' => true,
						'preview'    => array(
							'type'     => 'css',
							'selector' => '{node}.fl-button-wrap, .fl-button-wrap',
							'property' => 'text-align',
						),
					),
					'padding'      => array(
						'type'       => 'dimension',
						'label'      => __( 'Padding', 'satori-studio' ),
						'responsive' => true,
						'slider'     => true,
						'units'      => array( 'px' ),
						'preview'    => array(
							'type'     => 'css',
							'selector' => 'a.fl-button',
							'property' => 'padding',
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
						'preview'     => array(
							'type'      => 'css',
							'selector'  => 'a.fl-button, a.fl-button *',
							'property'  => 'color',
							'important' => true,
						),
					),
					'text_hover_color' => array(
						'type'        => 'color',
						'connections' => array( 'color' ),
						'label'       => __( 'Text Hover Color', 'satori-studio' ),
						'default'     => '',
						'show_reset'  => true,
						'show_alpha'  => true,
						'preview'     => array(
							'type'      => 'css',
							'selector'  => 'a.fl-button:hover, a.fl-button:hover *',
							'property'  => 'color',
							'important' => true,
						),
					),
					'typography'       => array(
						'type'       => 'typography',
						'label'      => __( 'Typography', 'satori-studio' ),
						'responsive' => true,
						'preview'    => array(
							'type'     => 'css',
							'selector' => 'a.fl-button',
						),
					),
				),
			),
			'icons'  => array(
				'title'  => __( 'Icon', 'satori-studio' ),
				'fields' => array(
					'duo_color1' => array(
						'label'       => __( 'DuoTone Icon Primary Color', 'satori-studio' ),
						'type'        => 'color',
						'connections' => array( 'color' ),
						'default'     => '',
						'show_reset'  => true,
						'show_alpha'  => true,
						'preview'     => array(
							'type'      => 'css',
							'selector'  => 'i.fl-button-icon.fad:before',
							'property'  => 'color',
							'important' => true,
						),
					),
					'duo_color2' => array(
						'label'       => __( 'DuoTone Icon Secondary Color', 'satori-studio' ),
						'type'        => 'color',
						'connections' => array( 'color' ),
						'default'     => '',
						'show_reset'  => true,
						'show_alpha'  => true,
						'preview'     => array(
							'type'      => 'css',
							'selector'  => 'i.fl-button-icon.fad:after',
							'property'  => 'color',
							'important' => true,
						),
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
							'type' => 'none',
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
							'type' => 'none',
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
							'type'      => 'css',
							'selector'  => 'a.fl-button',
							'important' => true,
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
