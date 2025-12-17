<?php

$global_settings = FLBuilderModel::get_global_settings();

FLBuilder::register_settings_form('module_advanced', array(
	'title'    => __( 'Advanced', 'satori-studio' ),
	'sections' => array(
		'margins'       => array(
			'title'  => __( 'Spacing', 'satori-studio' ),
			'fields' => array(
				'margin' => array(
					'type'       => 'dimension',
					'label'      => __( 'Margins', 'satori-studio' ),
					'slider'     => true,
					'units'      => array(
						'px',
						'%',
					),
					'preview'    => array(
						'type'     => 'css',
						'selector' => '.fl-module-content',
						'property' => 'margin',
					),
					'responsive' => array(
						'default_unit' => array(
							'default'    => $global_settings->module_margins_unit,
							'large'      => $global_settings->module_margins_large_unit,
							'medium'     => $global_settings->module_margins_medium_unit,
							'responsive' => $global_settings->module_margins_responsive_unit,
						),
						'placeholder'  => array(
							'default'    => array(
								'top'    => empty( $global_settings->module_margins_top ) ? '' : $global_settings->module_margins_top,
								'right'  => empty( $global_settings->module_margins_right ) ? '' : $global_settings->module_margins_right,
								'bottom' => empty( $global_settings->module_margins_bottom ) ? '' : $global_settings->module_margins_bottom,
								'left'   => empty( $global_settings->module_margins_left ) ? '' : $global_settings->module_margins_left,
							),
							'large'      => FLBuilderModel::get_node_spacing_breakpoint_placeholders( 'module', 'margins', 'large' ),
							'medium'     => FLBuilderModel::get_node_spacing_breakpoint_placeholders( 'module', 'margins', 'medium' ),
							'responsive' => FLBuilderModel::get_node_spacing_breakpoint_placeholders( 'module', 'margins', 'responsive' ),
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
					'description' => sprintf( __( 'Optional. Set the <a%s>capability</a> required for users to view this module.', 'satori-studio' ), ' href="http://codex.wordpress.org/Roles_and_Capabilities#Capability_vs._Role_Table" target="_blank"' ),
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
					'default'  => 'div',
					'sanitize' => array( 'FLBuilderUtils::esc_tags', 'div' ),
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
					'help'     => __( 'Optional. Choose an appropriate HTML5 content sectioning element to use for this module to improve accessibility and machine-readability.', 'satori-studio' ),
					'preview'  => array(
						'type' => 'none',
					),
				),
				'id'                => array(
					'type'    => 'text',
					'label'   => __( 'ID', 'satori-studio' ),
					'help'    => __( "A unique ID that will be applied to this module's HTML. Must start with a letter and only contain dashes, underscores, letters or numbers. No spaces.", 'satori-studio' ),
					'preview' => array(
						'type' => 'none',
					),
				),
				'class'             => array(
					'type'    => 'text',
					'label'   => __( 'Class', 'satori-studio' ),
					'help'    => __( "A class that will be applied to this module's HTML. Must start with a letter and only contain dashes, underscores, letters or numbers. Separate multiple classes with spaces.", 'satori-studio' ),
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
					'content' => '<button style="margin-right:10px" class="fl-builder-button fl-builder-button-small module-export-all" title="Copy Settings">Copy Settings</button><button class="fl-builder-button fl-builder-button-small module-export-style" title="Copy Styles">Copy Styles</button>',
				),
				'import' => array(
					'type'    => 'raw',
					'label'   => __( 'Import', 'satori-studio' ),
					'preview' => 'none',
					'content' => '<div class="module-import-wrap"><input type="text" class="module-import-input" placeholder="Paste settings or styles here..." /><button class="fl-builder-button fl-builder-button-small module-import-apply">Import</button></div><div class="module-import-error"></div>',
				),
			),
		),
	),
));

FLBuilder::register_settings_form( 'auto_style', [
	'title'    => __( 'Style', 'satori-studio' ),
	'sections' => [
		'color'  => [
			'title'  => __( 'Color & Background', 'satori-studio' ),
			'fields' => [
				'color'      => [
					'label'   => __( 'Color', 'satori-studio' ),
					'type'    => 'x_color',
					'preview' => [
						'property' => 'color',
					],
				],
				'background' => [
					'label' => __( 'Background', 'satori-studio' ),
					'type'  => 'background',
				],
			],
		],
		'layout' => [
			'title'     => __( 'Layout', 'satori-studio' ),
			'collapsed' => true,
			'fields'    => [
				'display' => [
					'label'     => __( 'Display', 'satori-studio' ),
					'type'      => 'x_button-group',
					'options'   => [
						''     => __( 'None', 'satori-studio' ),
						'flex' => __( 'Flex', 'satori-studio' ),
						'grid' => __( 'Grid', 'satori-studio' ),
					],
					'collapsed' => true,
					'preview'   => [
						'property' => 'display',
					],
				],
			],
		],
	],
] );
