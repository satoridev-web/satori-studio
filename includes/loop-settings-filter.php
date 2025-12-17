<?php

FLBuilder::register_settings_form('custom_fields_form', array(
	'title' => __( 'Add Field', 'satori-studio' ),
	'tabs'  => array(
		'customfield' => array(
			'title'    => __( 'Field', 'satori-studio' ),
			'sections' => array(
				'general' => array(
					'title'  => '',
					'fields' => array(
						'filter_meta_label'   => array(
							'type'  => 'text',
							'help'  => __( 'To identify the custom field.', 'satori-studio' ),
							'label' => __( 'Label', 'satori-studio' ),
						),
						'filter_meta_key'     => array(
							'type'  => 'text',
							'help'  => __( 'Custom field key.', 'satori-studio' ),
							'label' => __( 'Meta Key', 'satori-studio' ),
						),
						'filter_meta_value'   => array(
							'type'  => 'text',
							'help'  => __( 'Custom field value.', 'satori-studio' ),
							'label' => __( 'Meta Value', 'satori-studio' ),
						),
						'filter_meta_type'    => array(
							'type'    => 'select',
							'help'    => __( 'Custom field type.', 'satori-studio' ),
							'label'   => __( 'Type', 'satori-studio' ),
							'default' => 'CHAR',
							'options' => array(
								'NUMERIC'  => __( 'Numeric', 'satori-studio' ),
								'BINARY'   => __( 'Binary', 'satori-studio' ),
								'CHAR'     => __( 'Text', 'satori-studio' ),
								'DATE'     => __( 'Date', 'satori-studio' ),
								'DATETIME' => __( 'Date Time', 'satori-studio' ),
								'DECIMAL'  => __( 'Decimal', 'satori-studio' ),
								'SIGNED'   => __( 'Signed', 'satori-studio' ),
								'TIME'     => __( 'Time', 'satori-studio' ),
								'UNSIGNED' => __( 'Unsigned', 'satori-studio' ),
							),
						),
						'filter_meta_compare' => array(
							'type'    => 'select',
							'help'    => __( 'Operator to test.', 'satori-studio' ),
							'label'   => __( 'Compare', 'satori-studio' ),
							'default' => '=',
							'options' => array(
								'='          => __( 'Equals', 'satori-studio' ),
								'!='         => __( 'Does not equal', 'satori-studio' ),
								'>'          => __( 'Greater than', 'satori-studio' ),
								'<'          => __( 'Less than', 'satori-studio' ),
								'>='         => __( 'Greater than or equal to', 'satori-studio' ),
								'<='         => __( 'Less than or equal to', 'satori-studio' ),
								'EXISTS'     => __( 'Exists', 'satori-studio' ),
								'NOT EXISTS' => __( 'Not Exists', 'satori-studio' ),
							),
							'toggle'  => array(
								'='  => array(
									'fields' => array( 'filter_meta_value' ),
								),
								'!=' => array(
									'fields' => array( 'filter_meta_value' ),
								),
								'>'  => array(
									'fields' => array( 'filter_meta_value' ),
								),
								'<'  => array(
									'fields' => array( 'filter_meta_value' ),
								),
								'>=' => array(
									'fields' => array( 'filter_meta_value' ),
								),
								'<=' => array(
									'fields' => array( 'filter_meta_value' ),
								),
							),
						),
					),
				),
			),
		),
	),
));
