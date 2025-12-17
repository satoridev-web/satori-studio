<?php

FLBlock::register( 'test-block', [
	'name'        => __( 'Test', 'satori-studio' ),
	'description' => __( 'Test block for next-gen module rendering.', 'satori-studio' ),
	'category'    => __( 'Basic', 'satori-studio' ),
	'icon'        => 'layout.svg',
	'url'         => FL_BUILDER_URL . 'blocks/test-block/',
	'dir'         => FL_BUILDER_DIR . 'blocks/test-block/',
	'form'        => [
		'content' => [
			'title'    => __( 'Content', 'satori-studio' ),
			'sections' => [
				'general' => [
					'title'  => '',
					'fields' => [
						'content' => [
							'type'    => 'textarea',
							'label'   => __( 'Content', 'satori-studio' ),
							'preview' => array(
								'type'     => 'text',
								'selector' => '{node}.fl-test-block-content',
							),
						],
						'color'   => [
							'type'       => 'color',
							'label'      => __( 'Color', 'satori-studio' ),
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '{node}',
								'property' => 'color',
							),
						],
					],
				],
			],
		],
	],
] );
