<?php

FLBuilder::register_settings_form('col', array(
	'title' => __( 'Column', 'satori-studio' ),
	'tabs'  => array(
		'style'    => array(
			'title'    => __( 'Style', 'satori-studio' ),
			'sections' => array(
				'general'     => array(
					'title'  => '',
					'fields' => array(
						'size'              => array(
							'type'       => 'unit',
							'label'      => __( 'Width', 'satori-studio' ),
							'default'    => '',
							'responsive' => true,
							'slider'     => true,
							'units'      => array(
								'%',
							),
							'preview'    => array(
								'type' => 'refresh',
							),
						),
						'min_height'        => array(
							'type'       => 'unit',
							'label'      => __( 'Minimum Height', 'satori-studio' ),
							'responsive' => true,
							'units'      => array(
								'px',
								'vh',
								'vw',
							),
							'slider'     => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.fl-col-content',
								'property' => 'min-height',
							),
						),
						'equal_height'      => array(
							'type'    => 'select',
							'label'   => __( 'Equalize Heights', 'satori-studio' ),
							'help'    => __( 'Setting this to yes will make all of the columns in this group the same height regardless of how much content is in each of them.', 'satori-studio' ),
							'default' => 'no',
							'options' => array(
								'no'  => __( 'No', 'satori-studio' ),
								'yes' => __( 'Yes', 'satori-studio' ),
							),
							'toggle'  => array(
								'yes' => array(
									'fields' => array( 'content_alignment' ),
								),
							),
							'preview' => array(
								'type' => 'none',
							),
						),
						'aspect_ratio'      => array(
							'type'       => 'text',
							'label'      => __( 'Aspect Ratio', 'satori-studio' ),
							'default'    => '',
							'help'       => 'Use the forward slash notation: width/height.',
							'responsive' => true,
							'sanitize'   => 'FLBuilderUtils::sanitize_aspect_css',
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.fl-col-content',
								'property' => 'aspect-ratio',
							),
						),
						'content_alignment' => array(
							'type'    => 'select',
							'label'   => __( 'Vertical Alignment', 'satori-studio' ),
							'default' => 'top',
							'options' => array(
								'top'    => __( 'Top', 'satori-studio' ),
								'center' => __( 'Center', 'satori-studio' ),
								'bottom' => __( 'Bottom', 'satori-studio' ),
							),
							'preview' => array(
								'type' => 'none',
							),
						),
					),
				),
				'text'        => array(
					'title'  => __( 'Text', 'satori-studio' ),
					'fields' => array(
						'text_color'    => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Color', 'satori-studio' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type' => 'none',
							),
						),
						'link_color'    => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Link Color', 'satori-studio' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type' => 'none',
							),
						),
						'hover_color'   => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Link Hover Color', 'satori-studio' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type' => 'none',
							),
						),
						'heading_color' => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Heading Color', 'satori-studio' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type' => 'none',
							),
						),
					),
				),
				'background'  => array(
					'title'  => __( 'Background', 'satori-studio' ),
					'fields' => array(
						'bg_type'    => array(
							'type'    => 'select',
							'label'   => __( 'Type', 'satori-studio' ),
							'default' => 'color',
							'options' => array(
								'none'     => _x( 'None', 'Background type.', 'satori-studio' ),
								'color'    => _x( 'Color', 'Background type.', 'satori-studio' ),
								'gradient' => _x( 'Gradient', 'Background type.', 'satori-studio' ),
								'photo'    => _x( 'Photo', 'Background type.', 'satori-studio' ),
								'multiple' => _x( 'Multiple Backgrounds', 'Background type.', 'satori-studio' ),
							),
							'toggle'  => array(
								'color'    => array(
									'sections' => array( 'bg_color' ),
								),
								'gradient' => array(
									'sections' => array( 'bg_gradient' ),
								),
								'photo'    => array(
									'sections' => array( 'bg_photo', 'bg_overlay', 'bg_color' ),
								),
								'multiple' => array(
									'fields' => array( 'background' ),
								),
							),
							'preview' => array(
								'type' => 'none',
							),
						),
						'background' => array(
							'type'       => 'background',
							'label'      => __( 'Background Layers', 'satori-studio' ),
							'responsive' => [
								'default' => [
									'default' => [
										[
											'id'    => 1,
											'type'  => 'color',
											'state' => [
												'color' => '',
											],
										],
									],
								],
							],
							'preview'    => array(
								'type'      => 'css',
								'auto'      => true,
								'property'  => 'background',
								'selector'  => '> .fl-col-content',
								'sub_value' => [
									'setting_name' => 'css',
								],
								'enabled'   => [
									'bg_type' => 'multiple',
								],
							),
						),
					),
				),
				'bg_photo'    => array(
					'title'  => __( 'Background Photo', 'satori-studio' ),
					'fields' => array(
						'bg_image'      => array(
							'type'        => 'photo',
							'show_remove' => true,
							'label'       => __( 'Photo', 'satori-studio' ),
							'responsive'  => true,
							'connections' => array( 'photo' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '> .fl-col-content',
								'property' => 'background-image',
							),
						),
						'bg_repeat'     => array(
							'type'       => 'select',
							'label'      => __( 'Repeat', 'satori-studio' ),
							'default'    => 'none',
							'responsive' => true,
							'options'    => array(
								'no-repeat' => _x( 'None', 'Background repeat.', 'satori-studio' ),
								'repeat'    => _x( 'Tile', 'Background repeat.', 'satori-studio' ),
								'repeat-x'  => _x( 'Horizontal', 'Background repeat.', 'satori-studio' ),
								'repeat-y'  => _x( 'Vertical', 'Background repeat.', 'satori-studio' ),
							),
							'preview'    => array(
								'type'     => 'css',
								'selector' => '> .fl-col-content',
								'property' => 'background-repeat',
							),
						),
						'bg_position'   => array(
							'type'       => 'select',
							'label'      => __( 'Position', 'satori-studio' ),
							'default'    => 'center center',
							'responsive' => true,
							'options'    => array(
								'left top'      => __( 'Left Top', 'satori-studio' ),
								'left center'   => __( 'Left Center', 'satori-studio' ),
								'left bottom'   => __( 'Left Bottom', 'satori-studio' ),
								'right top'     => __( 'Right Top', 'satori-studio' ),
								'right center'  => __( 'Right Center', 'satori-studio' ),
								'right bottom'  => __( 'Right Bottom', 'satori-studio' ),
								'center top'    => __( 'Center Top', 'satori-studio' ),
								'center center' => __( 'Center', 'satori-studio' ),
								'center bottom' => __( 'Center Bottom', 'satori-studio' ),
								'custom_pos'    => __( 'Custom Position', 'satori-studio' ),
							),
							'toggle'     => array(
								'custom_pos' => array(
									'fields' => array(
										'bg_x_position',
										'bg_y_position',
									),
								),
							),
							'preview'    => array(
								'type'     => 'css',
								'selector' => '> .fl-col-content',
								'property' => 'background-position',
							),
						),
						'bg_x_position' => array(
							'type'         => 'unit',
							'label'        => __( 'X Position', 'satori-studio' ),
							'units'        => array( 'px', '%' ),
							'default_unit' => '%',
							'responsive'   => true,
							'slider'       => array(
								'min'  => 0,
								'max'  => 1000,
								'step' => 10,
							),
							'preview'      => array(
								'type'     => 'css',
								'selector' => '> .fl-col-content',
								'property' => 'background-position-x',
							),
						),
						'bg_y_position' => array(
							'type'         => 'unit',
							'label'        => __( 'Y Position', 'satori-studio' ),
							'units'        => array( 'px', '%' ),
							'default_unit' => '%',
							'responsive'   => true,
							'slider'       => array(
								'min'  => 0,
								'max'  => 1000,
								'step' => 10,
							),
							'preview'      => array(
								'type'     => 'css',
								'selector' => '> .fl-col-content',
								'property' => 'background-position-y',
							),
						),
						'bg_attachment' => array(
							'type'       => 'select',
							'label'      => __( 'Attachment', 'satori-studio' ),
							'default'    => 'scroll',
							'responsive' => true,
							'options'    => array(
								'scroll' => __( 'Scroll', 'satori-studio' ),
								'fixed'  => __( 'Fixed', 'satori-studio' ),
							),
							'preview'    => array(
								'type'     => 'css',
								'selector' => '> .fl-col-content',
								'property' => 'background-attachment',
							),
						),
						'bg_size'       => array(
							'type'       => 'select',
							'label'      => __( 'Scale', 'satori-studio' ),
							'default'    => 'cover',
							'responsive' => true,
							'options'    => array(
								'auto'    => _x( 'None', 'Background scale.', 'satori-studio' ),
								'contain' => __( 'Fit', 'satori-studio' ),
								'cover'   => __( 'Fill', 'satori-studio' ),
							),
							'preview'    => array(
								'type'     => 'css',
								'selector' => '> .fl-col-content',
								'property' => 'background-size',
							),
						),
					),
				),
				'bg_overlay'  => array(
					'title'  => __( 'Background Overlay', 'satori-studio' ),
					'fields' => array(
						'bg_overlay_type'     => array(
							'type'    => 'select',
							'label'   => __( 'Overlay Type', 'satori-studio' ),
							'default' => 'color',
							'options' => array(
								'none'     => __( 'None', 'satori-studio' ),
								'color'    => __( 'Color', 'satori-studio' ),
								'gradient' => __( 'Gradient', 'satori-studio' ),
							),
							'toggle'  => array(
								'color'    => array(
									'fields' => array( 'bg_overlay_color' ),
								),
								'gradient' => array(
									'fields' => array( 'bg_overlay_gradient' ),
								),
							),
							'preview' => array(
								'type' => 'none',
							),
						),
						'bg_overlay_color'    => array(
							'type'        => 'color',
							'label'       => __( 'Overlay Color', 'satori-studio' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type' => 'none',
							),
						),
						'bg_overlay_gradient' => array(
							'type'    => 'gradient',
							'label'   => __( 'Overlay Gradient', 'satori-studio' ),
							'preview' => array(
								'type'     => 'css',
								'selector' => '> .fl-col-content:after',
								'property' => 'background-image',
							),
						),
					),
				),
				'bg_color'    => array(
					'title'  => __( 'Background Color', 'satori-studio' ),
					'fields' => array(
						'bg_color' => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Color', 'satori-studio' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type' => 'none',
							),
						),
					),
				),
				'bg_gradient' => array(
					'title'  => __( 'Background Gradient', 'satori-studio' ),
					'fields' => array(
						'bg_gradient' => array(
							'type'       => 'gradient',
							'label'      => __( 'Gradient', 'satori-studio' ),
							'responsive' => true,
							'preview'    => array(
								'type' => 'refresh',
							),
						),
					),
				),
				'border'      => array(
					'title'  => __( 'Border', 'satori-studio' ),
					'fields' => array(
						'border' => array(
							'type'       => 'border',
							'label'      => __( 'Border', 'satori-studio' ),
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '> .fl-col-content',
							),
						),
					),
				),
			),
		),
		'advanced' => array(
			'title'    => __( 'Advanced', 'satori-studio' ),
			'sections' => array(
				'margins'       => array(
					'title'  => __( 'Spacing', 'satori-studio' ),
					'fields' => array(
						'margin'  => array(
							'type'       => 'dimension',
							'label'      => __( 'Margins', 'satori-studio' ),
							'slider'     => true,
							'default'    => '',
							'units'      => array(
								'px',
								'%',
							),
							'preview'    => array(
								'type'     => 'css',
								'selector' => '> .fl-col-content',
								'property' => 'margin',
							),
							'responsive' => array(
								'default_unit' => array(
									'default'    => $global_settings->column_margins_unit,
									'large'      => $global_settings->column_margins_large_unit,
									'medium'     => $global_settings->column_margins_medium_unit,
									'responsive' => $global_settings->column_margins_responsive_unit,
								),
								'default'      => array(
									'default'    => '',
									'large'      => '',
									'medium'     => '',
									'responsive' => '',
								),
								'placeholder'  => array(
									'default'    => array(
										'top'    => empty( $global_settings->column_margins_top ) ? '0' : $global_settings->column_margins_top,
										'right'  => empty( $global_settings->column_margins_right ) ? '0' : $global_settings->column_margins_right,
										'bottom' => empty( $global_settings->column_margins_bottom ) ? '0' : $global_settings->column_margins_bottom,
										'left'   => empty( $global_settings->column_margins_left ) ? '0' : $global_settings->column_margins_left,
									),
									'large'      => FLBuilderModel::get_node_spacing_breakpoint_placeholders( 'column', 'margins', 'large' ),
									'medium'     => FLBuilderModel::get_node_spacing_breakpoint_placeholders( 'column', 'margins', 'medium' ),
									'responsive' => FLBuilderModel::get_node_spacing_breakpoint_placeholders( 'column', 'margins', 'responsive' ),
								),
							),
						),
						'padding' => array(
							'type'       => 'dimension',
							'label'      => __( 'Padding', 'satori-studio' ),
							'slider'     => true,
							'default'    => '',
							'units'      => array(
								'px',
								'em',
								'%',
							),
							'preview'    => array(
								'type'     => 'css',
								'selector' => '> .fl-col-content',
								'property' => 'padding',
							),
							'responsive' => array(
								'default_unit' => array(
									'default'    => $global_settings->column_padding_unit,
									'large'      => $global_settings->column_padding_large_unit,
									'medium'     => $global_settings->column_padding_medium_unit,
									'responsive' => $global_settings->column_padding_responsive_unit,
								),
								'default'      => array(
									'default'    => '',
									'large'      => '',
									'medium'     => '',
									'responsive' => '',
								),
								'placeholder'  => array(
									'default'    => array(
										'top'    => empty( $global_settings->column_padding_top ) ? '0' : $global_settings->column_padding_top,
										'right'  => empty( $global_settings->column_padding_right ) ? '0' : $global_settings->column_padding_right,
										'bottom' => empty( $global_settings->column_padding_bottom ) ? '0' : $global_settings->column_padding_bottom,
										'left'   => empty( $global_settings->column_padding_left ) ? '0' : $global_settings->column_padding_left,
									),
									'large'      => FLBuilderModel::get_node_spacing_breakpoint_placeholders( 'column', 'padding', 'large' ),
									'medium'     => FLBuilderModel::get_node_spacing_breakpoint_placeholders( 'column', 'padding', 'medium' ),
									'responsive' => FLBuilderModel::get_node_spacing_breakpoint_placeholders( 'column', 'padding', 'responsive' ),
								),
							),
						),
					),
				),
				'visibility'    => array(
					'title'  => __( 'Visibility', 'satori-studio' ),
					'fields' => array(
						'responsive_display'         => array(
							'type'         => 'button-group',
							'label'        => __( 'Breakpoint', 'satori-studio' ),
							'options'      => FLBuilderModel::get_node_breakpoint_options(),
							'tooltip'      => FLBuilderModel::get_node_breakpoint_tooltips(),
							'default'      => 'desktop,large,medium,mobile',
							'multi-select' => array(
								'min' => 1,
							),
							'preview'      => array(
								'type' => 'none',
							),
						),
						'responsive_order'           => array(
							'type'    => 'select',
							'label'   => __( 'Reverse Column Order', 'satori-studio' ),
							'help'    => __( 'The order of the columns in this group when they are stacked for medium and small devices.', 'satori-studio' ),
							'default' => '',
							'options' => array(
								''              => __( 'Disabled', 'satori-studio' ),
								'mobile'        => __( 'Small', 'satori-studio' ),
								'medium'        => __( 'Medium', 'satori-studio' ),
								'mobile,medium' => __( 'Small and Medium', 'satori-studio' ),
							),
							'preview' => array(
								'type' => 'none',
							),
						),
						'visibility_display'         => array(
							'type'    => 'select',
							'label'   => __( 'Display', 'satori-studio' ),
							'options' => array(
								''           => __( 'Always', 'satori-studio' ),
								'logged_out' => __( 'Logged Out User', 'satori-studio' ),
								'logged_in'  => __( 'Logged In User', 'satori-studio' ),
								'0'          => __( 'Never', 'satori-studio' ),
							),
							'toggle'  => array(
								'logged_in' => array(
									'fields' => array( 'visibility_user_capability' ),
								),
							),
							'preview' => array(
								'type' => 'none',
							),
						),
						'visibility_user_capability' => array(
							'type'        => 'text',
							'label'       => __( 'User Capability', 'satori-studio' ),
							/* translators: %s: wporg docs link */
							'description' => sprintf( __( 'Optional. Set the <a%s>capability</a> required for users to view this column.', 'satori-studio' ), ' href="http://codex.wordpress.org/Roles_and_Capabilities#Capability_vs._Role_Table" target="_blank"' ),
							'preview'     => array(
								'type' => 'none',
							),
						),
					),
				),
				'animation'     => array(
					'title'  => __( 'Animation', 'satori-studio' ),
					'fields' => array(
						'animation' => array(
							'type'    => 'animation',
							'label'   => __( 'Animation', 'satori-studio' ),
							'preview' => array(
								'type'     => 'animation',
								'selector' => '{node}',
							),
						),
					),
				),
				'css_selectors' => array(
					'title'  => __( 'HTML Element', 'satori-studio' ),
					'fields' => array(
						'container_element' => array(
							'type'     => 'select',
							'label'    => __( 'Container Element', 'satori-studio' ),
							'sanitize' => array( 'FLBuilderUtils::esc_tags', 'div' ),
							'default'  => 'div',
							/**
							 * Filter to add/remove container types.
							 * @see fl_builder_node_container_element_options
							 */
							'options'  => apply_filters( 'fl_builder_node_container_element_options', array(
								'div'     => '&lt;div&gt;',
								'section' => '&lt;section&gt;',
								'article' => '&lt;article&gt;',
								'aside'   => '&lt;aside&gt;',
								'main'    => '&lt;main&gt;',
								'header'  => '&lt;header&gt;',
								'footer'  => '&lt;footer&gt;',
							) ),
							'help'     => __( 'Optional. Choose an appropriate HTML5 content sectioning element to use for this column to improve accessibility and machine-readability.', 'satori-studio' ),
							'preview'  => array(
								'type' => 'none',
							),
						),
						'id'                => array(
							'type'    => 'text',
							'label'   => __( 'ID', 'satori-studio' ),
							'help'    => __( "A unique ID that will be applied to this column's HTML. Must start with a letter and only contain dashes, underscores, letters or numbers. No spaces.", 'satori-studio' ),
							'preview' => array(
								'type' => 'none',
							),
						),
						'class'             => array(
							'type'    => 'text',
							'label'   => __( 'CSS Class', 'satori-studio' ),
							'help'    => __( "A class that will be applied to this column's HTML. Must start with a letter and only contain dashes, underscores, letters or numbers. Separate multiple classes with spaces.", 'satori-studio' ),
							'preview' => array(
								'type' => 'none',
							),
						),
						'node_label'        => array(
							'type'     => 'text',
							'label'    => __( 'Label', 'satori-studio' ),
							'help'     => __( 'A label that will applied and used in the UI for easy identification.', 'satori-studio' ),
							'sanitize' => 'strip_tags',
							'preview'  => array(
								'type' => 'none',
							),
						),
					),
				),
				'export_import' => array(
					'title'     => __( 'Export/Import', 'satori-studio' ),
					'collapsed' => true,
					'fields'    => array(
						'export' => array(
							'type'    => 'raw',
							'label'   => __( 'Export', 'satori-studio' ),
							'preview' => 'none',
							'content' => '<button style="margin-right:10px" class="fl-builder-button fl-builder-button-small col-export-all" title="Copy Settings">Copy Settings</button><button class="fl-builder-button fl-builder-button-small col-export-style" title="Copy Styles">Copy Styles</button>',
						),
						'import' => array(
							'type'    => 'raw',
							'label'   => __( 'Import', 'satori-studio' ),
							'preview' => 'none',
							'content' => '<div class="col-import-wrap"><input type="text" class="col-import-input" placeholder="Paste settings or styles here..." /><button class="fl-builder-button fl-builder-button-small col-import-apply">Import</button></div><div class="col-import-error"></div>',
						),
					),
				),
			),
		),
	),
));
