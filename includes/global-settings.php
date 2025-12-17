<?php

FLBuilder::register_settings_form('global', array(
	'title' => __( 'Global Settings', 'satori-studio' ),
	'tabs'  => array(
		'general' => array(
			'title'       => __( 'General', 'satori-studio' ),
			'description' => __( '<strong>Note</strong>: These settings apply to all posts and pages.', 'satori-studio' ),
			'sections'    => array(
				'page_heading' => array(
					'title'  => __( 'Default Page Heading', 'satori-studio' ),
					'fields' => array(
						'show_default_heading'     => array(
							'type'    => 'select',
							'label'   => _x( 'Show', 'General settings form field label. Intended meaning: "Show page heading?"', 'satori-studio' ),
							'default' => '0',
							'options' => array(
								'0' => __( 'No', 'satori-studio' ),
								'1' => __( 'Yes', 'satori-studio' ),
							),
							'toggle'  => array(
								'0' => array(
									'fields' => array( 'default_heading_selector' ),
								),
							),
							'help'    => __( 'Choosing no will hide the default theme heading for the "Page" post type. You will also be required to enter some basic CSS for this to work if you choose no.', 'satori-studio' ),
						),
						'default_heading_selector' => array(
							'type'    => 'text',
							'label'   => __( 'CSS Selector', 'satori-studio' ),
							'default' => '.fl-post-header',
							'help'    => __( 'Enter a CSS selector for the default page heading to hide it.', 'satori-studio' ),
						),
					),
				),
				'rows'         => array(
					'title'  => __( 'Rows', 'satori-studio' ),
					'fields' => array(
						'row_margins'               => array(
							'type'       => 'dimension',
							'label'      => __( 'Margins', 'satori-studio' ),
							'slider'     => true,
							'default'    => '0',
							'units'      => array(
								'px',
								'%',
							),
							'responsive' => array(
								'default'      => array(
									'default'    => '0',
									'large'      => '',
									'medium'     => '',
									'responsive' => '',
								),
								'default_unit' => array(
									'default'    => 'px',
									'large'      => 'px',
									'medium'     => 'px',
									'responsive' => 'px',
								),
								'placeholder'  => array(
									'default'    => array(
										'top'    => '0',
										'right'  => '0',
										'bottom' => '0',
										'left'   => '0',
									),
									'large'      => array(
										'top'    => '',
										'right'  => '',
										'bottom' => '',
										'left'   => '',
									),
									'medium'     => array(
										'top'    => '',
										'right'  => '',
										'bottom' => '',
										'left'   => '',
									),
									'responsive' => array(
										'top'    => '',
										'right'  => '',
										'bottom' => '',
										'left'   => '',
									),
								),
							),
						),
						'row_padding'               => array(
							'type'       => 'dimension',
							'label'      => __( 'Padding', 'satori-studio' ),
							'slider'     => true,
							'default'    => '20',
							'units'      => array(
								'px',
								'em',
								'%',
								'vw',
								'vh',
							),
							'responsive' => array(
								'default_unit' => array(
									'default'    => 'px',
									'large'      => 'px',
									'medium'     => 'px',
									'responsive' => 'px',
								),
								'default'      => array(
									'default'    => '20',
									'large'      => '',
									'medium'     => '',
									'responsive' => '',
								),
								'placeholder'  => array(
									'default'    => array(
										'top'    => '0',
										'right'  => '0',
										'bottom' => '0',
										'left'   => '0',
									),
									'large'      => array(
										'top'    => '',
										'right'  => '',
										'bottom' => '',
										'left'   => '',
									),
									'medium'     => array(
										'top'    => '',
										'right'  => '',
										'bottom' => '',
										'left'   => '',
									),
									'responsive' => array(
										'top'    => '',
										'right'  => '',
										'bottom' => '',
										'left'   => '',
									),
								),
							),
						),
						'row_width'                 => array(
							'type'       => 'unit',
							'label'      => __( 'Max Width', 'satori-studio' ),
							'maxlength'  => '4',
							'size'       => '5',
							'sanitize'   => 'absint',
							'help'       => __( 'All rows will default to this width. You can override this and make a row full width in the settings for each row.', 'satori-studio' ),
							'units'      => array(
								'px',
								'vw',
								'%',
							),
							'responsive' => array(
								'default' => array(
									'default'    => '1100',
									'large'      => '',
									'medium'     => '',
									'responsive' => '',
								),
							),
						),
						'row_width_default'         => array(
							'type'    => 'select',
							'label'   => __( 'Default Row Width', 'satori-studio' ),
							'default' => 'fixed',
							'options' => array(
								'fixed' => __( 'Fixed', 'satori-studio' ),
								'full'  => __( 'Full Width', 'satori-studio' ),
							),
							'toggle'  => array(
								'full' => array(
									'fields' => array( 'row_content_width_default' ),
								),
							),
						),
						'row_content_width_default' => array(
							'type'    => 'select',
							'label'   => __( 'Default Row Content Width', 'satori-studio' ),
							'default' => 'fixed',
							'options' => array(
								'fixed' => __( 'Fixed', 'satori-studio' ),
								'full'  => __( 'Full Width', 'satori-studio' ),
							),
						),
					),
				),
				'columns'      => array(
					'title'  => __( 'Columns', 'satori-studio' ),
					'fields' => array(
						'column_margins' => array(
							'type'       => 'dimension',
							'label'      => __( 'Margins', 'satori-studio' ),
							'slider'     => true,
							'default'    => '',
							'units'      => array(
								'px',
								'%',
							),
							'responsive' => array(
								'default'      => array(
									'default'    => '',
									'large'      => '',
									'medium'     => '',
									'responsive' => '',
								),
								'default_unit' => array(
									'default'    => 'px',
									'medium'     => 'px',
									'responsive' => 'px',
								),
								'placeholder'  => array(
									'default'    => array(
										'top'    => '0',
										'right'  => '0',
										'bottom' => '0',
										'left'   => '0',
									),
									'large'      => array(
										'top'    => '',
										'right'  => '',
										'bottom' => '',
										'left'   => '',
									),
									'medium'     => array(
										'top'    => '',
										'right'  => '',
										'bottom' => '',
										'left'   => '',
									),
									'responsive' => array(
										'top'    => '',
										'right'  => '',
										'bottom' => '',
										'left'   => '',
									),
								),
							),
						),
						'column_padding' => array(
							'type'       => 'dimension',
							'label'      => __( 'Padding', 'satori-studio' ),
							'slider'     => true,
							'default'    => '',
							'units'      => array(
								'px',
								'em',
								'%',
							),
							'responsive' => array(
								'default_unit' => array(
									'default'    => 'px',
									'medium'     => 'px',
									'large'      => 'px',
									'responsive' => 'px',
								),
								'default'      => array(
									'default'    => '',
									'large'      => '',
									'medium'     => '',
									'responsive' => '',
								),
								'placeholder'  => array(
									'default'    => array(
										'top'    => '0',
										'right'  => '0',
										'bottom' => '0',
										'left'   => '0',
									),
									'large'      => array(
										'top'    => '',
										'right'  => '',
										'bottom' => '',
										'left'   => '',
									),
									'medium'     => array(
										'top'    => '',
										'right'  => '',
										'bottom' => '',
										'left'   => '',
									),
									'responsive' => array(
										'top'    => '',
										'right'  => '',
										'bottom' => '',
										'left'   => '',
									),
								),
							),
						),
					),
				),
				'modules'      => array(
					'title'  => __( 'Modules', 'satori-studio' ),
					'fields' => array(
						'module_margins' => array(
							'type'       => 'dimension',
							'label'      => __( 'Margins', 'satori-studio' ),
							'slider'     => true,
							'default'    => '20',
							'units'      => array(
								'px',
								'%',
							),
							'responsive' => array(
								'default_unit' => array(
									'default'    => 'px',
									'large'      => 'px',
									'medium'     => 'px',
									'responsive' => 'px',
								),
								'default'      => array(
									'default'    => '20',
									'large'      => '',
									'medium'     => '',
									'responsive' => '',
								),
								'placeholder'  => array(
									'default'    => array(
										'top'    => '0',
										'right'  => '0',
										'bottom' => '0',
										'left'   => '0',
									),

									'large'      => array(
										'top'    => '',
										'right'  => '',
										'bottom' => '',
										'left'   => '',
									),
									'medium'     => array(
										'top'    => '',
										'right'  => '',
										'bottom' => '',
										'left'   => '',
									),
									'responsive' => array(
										'top'    => '',
										'right'  => '',
										'bottom' => '',
										'left'   => '',
									),
								),
							),
						),
					),
				),
				'responsive'   => array(
					'title'  => __( 'Responsive Layout', 'satori-studio' ),
					'fields' => array(
						'responsive_enabled'       => array(
							'type'    => 'select',
							'label'   => _x( 'Enabled', 'General settings form field label. Intended meaning: "Responsive layout enabled?"', 'satori-studio' ),
							'default' => '1',
							'options' => array(
								'0' => __( 'No', 'satori-studio' ),
								'1' => __( 'Yes', 'satori-studio' ),
							),
							'toggle'  => array(
								'1' => array(
									'fields' => array( 'auto_spacing', 'responsive_breakpoint', 'medium_breakpoint', 'large_breakpoint', 'responsive_col_max_width' ),
									'fields' => array( 'auto_spacing', 'responsive_breakpoint', 'medium_breakpoint', 'large_breakpoint', 'responsive_col_max_width', 'responsive_preview' ),
								),
							),
						),
						'auto_spacing'             => array(
							'type'    => 'select',
							'label'   => _x( 'Enable Auto Spacing', 'General settings form field label. Intended meaning: "Enable auto spacing for responsive layouts?"', 'satori-studio' ),
							'default' => '1',
							'options' => array(
								'0' => __( 'No', 'satori-studio' ),
								'1' => __( 'Yes', 'satori-studio' ),
							),
							'help'    => __( 'When auto spacing is enabled, the builder will automatically adjust the margins and padding in your layout once the small device breakpoint is reached. Most users will want to leave this enabled.', 'satori-studio' ),
						),
						'large_breakpoint'         => array(
							'type'        => 'text',
							'label'       => __( 'Large Device Breakpoint', 'satori-studio' ),
							'default'     => '1200',
							'maxlength'   => '4',
							'size'        => '5',
							'description' => 'px',
							'sanitize'    => 'absint',
							'help'        => __( 'The browser width at which the layout will adjust for large devices.', 'satori-studio' ),
						),
						'medium_breakpoint'        => array(
							'type'        => 'text',
							'label'       => __( 'Medium Device Breakpoint', 'satori-studio' ),
							'default'     => '992',
							'maxlength'   => '4',
							'size'        => '5',
							'description' => 'px',
							'sanitize'    => 'absint',
							'help'        => __( 'The browser width at which the layout will adjust for medium devices such as tablets.', 'satori-studio' ),
						),
						'responsive_breakpoint'    => array(
							'type'        => 'text',
							'label'       => __( 'Small Device Breakpoint', 'satori-studio' ),
							'default'     => '768',
							'maxlength'   => '4',
							'size'        => '5',
							'description' => 'px',
							'sanitize'    => 'absint',
							'help'        => __( 'The browser width at which the layout will adjust for small devices such as phones.', 'satori-studio' ),
						),
						'responsive_preview'       => array(
							'type'    => 'select',
							'label'   => __( 'Use responsive settings in previews?', 'satori-studio' ),
							'default' => '0',
							'options' => array(
								'0' => __( 'No', 'satori-studio' ),
								'1' => __( 'Yes', 'satori-studio' ),
							),
							'help'    => __( 'Preview and responsive editing will use these values when enabled.', 'satori-studio' ),
						),
						'responsive_col_max_width' => array(
							'type'    => 'select',
							'label'   => __( 'Enable Column Max Width', 'satori-studio' ),
							'default' => '1',
							'options' => array(
								'0' => __( 'No', 'satori-studio' ),
								'1' => __( 'Yes', 'satori-studio' ),
							),
							'help'    => __( 'When enabled, columns assigned 50% width or less are limited to max width 400px when screen width reaches or goes below the small device breakpoint.', 'satori-studio' ),
						),
						'responsive_base_fontsize' => array(
							'type'        => 'text',
							'label'       => __( 'Base Font Size', 'satori-studio' ),
							'default'     => '16',
							'maxlength'   => '4',
							'size'        => '5',
							'description' => 'px',
							'sanitize'    => 'absint',
							'help'        => __( 'When typography unit is set to vh/vw this unit will be used to calculate the font size.', 'satori-studio' ),
						),
					),
				),
			),
		),
		'css'     => array(
			'title'    => __( 'CSS', 'satori-studio' ),
			'sections' => array(
				'css' => array(
					'title'  => '',
					'fields' => array(
						'css' => array(
							'type'    => 'code',
							'label'   => '',
							'editor'  => 'css',
							'rows'    => '18',
							'preview' => array(
								'type' => 'none',
							),
						),
					),
				),
			),
		),
		'js'      => array(
			'title'    => __( 'JavaScript', 'satori-studio' ),
			'sections' => array(
				'js' => array(
					'title'  => '',
					'fields' => array(
						'js' => array(
							'type'    => 'code',
							'label'   => '',
							'editor'  => 'javascript',
							'rows'    => '18',
							'preview' => array(
								'type' => 'none',
							),
						),
					),
				),
			),
		),
	),
));
