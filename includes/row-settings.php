<?php

$global_settings = FLBuilderModel::get_global_settings();

$row_settings = array(
	'title' => __( 'Row', 'satori-studio' ),
	'tabs'  => array(

		'style'    => array(
			'title'    => __( 'Style', 'satori-studio' ),
			'sections' => array(
				'general'          => array(
					'title'  => '',
					'fields' => array(
						'width'             => array(
							'type'    => 'select',
							'label'   => __( 'Width', 'satori-studio' ),
							'default' => $global_settings->row_width_default,
							'options' => array(
								'fixed' => __( 'Fixed', 'satori-studio' ),
								'full'  => __( 'Full Width', 'satori-studio' ),
							),
							'toggle'  => array(
								'full' => array(
									'fields' => array( 'content_width' ),
								),
							),
							'help'    => __( 'Full width rows span the width of the page from edge to edge. Fixed rows are no wider than the Row Max Width set in the Global Settings.', 'satori-studio' ),
							'preview' => array(
								'type' => 'refresh',
							),
						),
						'content_width'     => array(
							'type'    => 'select',
							'label'   => __( 'Content Width', 'satori-studio' ),
							'default' => $global_settings->row_content_width_default,
							'options' => array(
								'fixed' => __( 'Fixed', 'satori-studio' ),
								'full'  => __( 'Full Width', 'satori-studio' ),
							),
							'help'    => __( 'Full width content spans the width of the page from edge to edge. Fixed content is no wider than the Row Max Width set in the Global Settings.', 'satori-studio' ),
							'preview' => array(
								'type' => 'refresh',
							),
						),
						'max_content_width' => array(
							'type'       => 'unit',
							'label'      => __( 'Fixed Width', 'satori-studio' ),
							'units'      => array(
								'px',
								'vw',
								'%',
							),
							'responsive' => array(
								'placeholder'  => array(
									'default'    => $global_settings->row_width,
									'large'      => $global_settings->row_width_large,
									'medium'     => $global_settings->row_width_medium,
									'responsive' => $global_settings->row_width_responsive,
								),
								'default_unit' => array(
									'default'    => $global_settings->row_width_unit,
									'large'      => $global_settings->row_width_large_unit,
									'medium'     => $global_settings->row_width_medium_unit,
									'responsive' => $global_settings->row_width_responsive_unit,
								),
								'slider'       => array(
									'default'    => array(
										'px' => array(
											'min'  => 0,
											'max'  => 1920,
											'step' => 1,
										),
									),
									'large'      => array(
										'px' => array(
											'min'  => 0,
											'max'  => 1200,
											'step' => 1,
										),
									),
									'medium'     => array(
										'px' => array(
											'min'  => 0,
											'max'  => 971,
											'step' => 1,
										),
									),
									'responsive' => array(
										'px' => array(
											'min'  => 0,
											'max'  => 728,
											'step' => 1,
										),
									),
								),
							),
							'preview'    => array(
								'type' => 'none',
							),
						),
						'full_height'       => array(
							'type'    => 'select',
							'label'   => __( 'Height', 'satori-studio' ),
							'default' => 'default',
							'options' => array(
								'default' => __( 'Default', 'satori-studio' ),
								'full'    => __( 'Full Height', 'satori-studio' ),
								'custom'  => __( 'Minimum Height', 'satori-studio' ),
							),
							'help'    => __( 'Full height rows fill the height of the browser window. Minimum height rows are at least as tall as the value entered.', 'satori-studio' ),
							'toggle'  => array(
								'custom' => array(
									'fields' => array( 'min_height' ),
								),
							),
							'preview' => array(
								'type' => 'refresh',
							),
						),
						'min_height'        => array(
							'type'       => 'unit',
							'label'      => __( 'Minimum Height', 'satori-studio' ),
							'responsive' => true,
							'units'      => array(
								'px',
								'vw',
								'vh',
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
								'selector' => '.fl-row-content-wrap',
								'property' => 'min-height',
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
								'selector' => '.fl-row-content-wrap',
								'property' => 'aspect-ratio',
							),
						),
						'content_alignment' => array(
							'type'    => 'select',
							'label'   => __( 'Vertical Alignment', 'satori-studio' ),
							'default' => 'center',
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
				'colors'           => array(
					'title'  => __( 'Colors', 'satori-studio' ),
					'fields' => array(
						'text_color'    => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Text Color', 'satori-studio' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.fl-row-content-wrap *',
								'property' => 'color',
							),
						),
						'link_color'    => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Link Color', 'satori-studio' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.fl-row-content-wrap a',
								'property' => 'color',
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
								'type'     => 'css',
								'selector' => '.fl-row-content-wrap :is(h1, h2, h3, h4, h5, h6)',
								'property' => 'color',
							),
						),
					),
				),
				'background'       => array(
					'title'  => __( 'Background', 'satori-studio' ),
					'fields' => array(
						'bg_type'    => array(
							'type'    => 'select',
							'label'   => __( 'Type', 'satori-studio' ),
							'default' => 'none',
							'options' => array(
								'none'     => _x( 'None', 'Background type.', 'satori-studio' ),
								'css'      => array(
									'label'   => __( 'Simple', 'satori-studio' ),
									'options' => array(
										'color'    => _x( 'Color', 'Background type.', 'satori-studio' ),
										'gradient' => _x( 'Gradient', 'Background type.', 'satori-studio' ),
										'photo'    => _x( 'Photo', 'Background type.', 'satori-studio' ),
										'multiple' => _x( 'Multiple Backgrounds', 'Background type.', 'satori-studio' ),
									),
								),
								'advanced' => array(
									'label'   => __( 'Advanced', 'satori-studio' ),
									'options' => array(
										'video'     => _x( 'Video', 'Background type.', 'satori-studio' ),
										'embed'     => _x( 'Embedded Code', 'Background type.', 'satori-studio' ),
										'slideshow' => array(
											'label'   => _x( 'Slideshow', 'Background type.', 'satori-studio' ),
											'premium' => true,
										),
										'parallax'  => array(
											'label'   => _x( 'Parallax', 'Background type.', 'satori-studio' ),
											'premium' => true,
										),
									),
								),
							),
							'toggle'  => array(
								'color'     => array(
									'sections' => array( 'bg_color' ),
								),
								'gradient'  => array(
									'sections' => array( 'bg_gradient' ),
								),
								'photo'     => array(
									'sections' => array( 'bg_color', 'bg_photo', 'bg_overlay' ),
								),
								'video'     => array(
									'sections' => array( 'bg_color', 'bg_video', 'bg_overlay' ),
								),
								'slideshow' => array(
									'sections' => array( 'bg_color', 'bg_slideshow', 'bg_overlay' ),
								),
								'parallax'  => array(
									'sections' => array( 'bg_color', 'bg_parallax', 'bg_overlay' ),
								),
								'pattern'   => array(
									'sections' => array( 'bg_pattern', 'bg_color', 'bg_overlay' ),
								),
								'embed'     => array(
									'sections' => array( 'bg_embed_section' ),
								),
								'multiple'  => array(
									'fields' => array( 'background' ),
								),
							),
							'preview' => array(
								'type' => 'refresh',
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
								'selector'  => '> .fl-row-content-wrap',
								'property'  => 'background',
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
				'bg_photo'         => array(
					'title'  => __( 'Background Photo', 'satori-studio' ),
					'fields' => array(
						'bg_image_source' => array(
							'type'    => 'select',
							'label'   => __( 'Photo Source', 'satori-studio' ),
							'default' => 'library',
							'options' => array(
								'library' => __( 'Media Library', 'satori-studio' ),
								'url'     => __( 'URL', 'satori-studio' ),
							),
							'toggle'  => array(
								'library' => array(
									'fields' => array( 'bg_image' ),
								),
								'url'     => array(
									'fields' => array( 'bg_image_url', 'caption' ),
								),
							),
							'preview' => array(
								'type' => 'none',
							),
						),
						'bg_image_url'    => array(
							'type'        => 'text',
							'label'       => __( 'Photo URL', 'satori-studio' ),
							'placeholder' => 'https://www.example.com/my-photo.jpg',
							'connections' => array( 'photo' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '> .fl-row-content-wrap',
								'property' => 'background-image',
							),
						),
						'bg_image'        => array(
							'type'        => 'photo',
							'show_remove' => true,
							'label'       => __( 'Photo', 'satori-studio' ),
							'responsive'  => true,
							'connections' => array( 'photo' ),
							'preview'     => array(
								'type' => 'refresh',
							),
						),
						'bg_repeat'       => array(
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
								'selector' => '> .fl-row-content-wrap',
								'property' => 'background-repeat',
							),
						),
						'bg_position'     => array(
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
								'selector' => '> .fl-row-content-wrap',
								'property' => 'background-position',
							),
						),
						'bg_x_position'   => array(
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
								'selector' => '> .fl-row-content-wrap',
								'property' => 'background-position-x',
							),
						),
						'bg_y_position'   => array(
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
								'selector' => '> .fl-row-content-wrap',
								'property' => 'background-position-y',
							),
						),
						'bg_attachment'   => array(
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
								'selector' => '> .fl-row-content-wrap',
								'property' => 'background-attachment',
							),
						),
						'bg_size'         => array(
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
								'selector' => '> .fl-row-content-wrap',
								'property' => 'background-size',
							),
						),
					),
				),
				'bg_video'         => array(
					'title'  => __( 'Background Video', 'satori-studio' ),
					'fields' => array(
						'bg_video_source'      => array(
							'type'    => 'select',
							'label'   => __( 'Source', 'satori-studio' ),
							'default' => 'wordpress',
							'options' => array(
								'wordpress'     => __( 'Media Library', 'satori-studio' ),
								'video_url'     => 'URL',
								'video_service' => __( 'YouTube or Vimeo', 'satori-studio' ),
							),
							'toggle'  => array(
								'wordpress'     => array(
									'fields' => array( 'bg_video', 'bg_video_webm' ),
								),
								'video_url'     => array(
									'fields' => array( 'bg_video_url_mp4', 'bg_video_url_webm' ),
								),
								'video_service' => array(
									'fields' => array( 'bg_video_service_url' ),
								),
							),
							'preview' => array(
								'type' => 'refresh',
							),
						),
						'bg_video'             => array(
							'type'        => 'video',
							'show_remove' => true,
							'label'       => __( 'Video (MP4)', 'fl-builder' ),
							'help'        => __( 'A video in the MP4 format to use as the background of this row. Most modern browsers support this format.', 'satori-studio' ),
							'preview'     => array(
								'type' => 'refresh',
							),
						),
						'bg_video_webm'        => array(
							'type'        => 'video',
							'show_remove' => true,
							'label'       => __( 'Video (WebM)', 'fl-builder' ),
							'help'        => __( 'A video in the WebM format to use as the background of this row. This format is required to support browsers such as FireFox and Opera.', 'satori-studio' ),
							'preview'     => array(
								'type' => 'refresh',
							),
						),
						'bg_video_url_mp4'     => array(
							'type'        => 'text',
							'label'       => __( 'Video URL (MP4)', 'fl-builder' ),
							'help'        => __( 'A video in the MP4 to use as the background of this row. Most modern browsers support this format.', 'satori-studio' ),
							'preview'     => array(
								'type' => 'refresh',
							),
							'connections' => array( 'custom_field' ),
						),
						'bg_video_url_webm'    => array(
							'type'        => 'text',
							'label'       => __( 'Video URL (WebM)', 'fl-builder' ),
							'help'        => __( 'A video in the WebM format to use as the background of this row. This format is required to support browsers such as FireFox and Opera.', 'satori-studio' ),
							'preview'     => array(
								'type' => 'refresh',
							),
							'connections' => array( 'custom_field' ),
						),
						'bg_video_service_url' => array(
							'type'        => 'text',
							'label'       => __( 'YouTube Or Vimeo URL', 'satori-studio' ),
							'help'        => __( 'A video from YouTube or Vimeo to use as the background of this row. Most modern browsers support this format.', 'satori-studio' ),
							'preview'     => array(
								'type' => 'refresh',
							),
							'connections' => array( 'custom_field' ),
						),
						'bg_video_audio'       => array(
							'type'    => 'select',
							'label'   => __( 'Enable Audio', 'satori-studio' ),
							'default' => 'no',
							'options' => array(
								'no'  => __( 'No', 'satori-studio' ),
								'yes' => __( 'Yes', 'satori-studio' ),
							),
							'preview' => array(
								'type' => 'refresh',
							),
						),
						'bg_video_mobile'      => array(
							'type'    => 'select',
							'label'   => __( 'Enable Video in Mobile', 'satori-studio' ),
							'help'    => __( 'If set to "Yes", audio is disabled on mobile devices.', 'satori-studio' ),
							'default' => 'no',
							'options' => array(
								'no'  => __( 'No', 'satori-studio' ),
								'yes' => __( 'Yes', 'satori-studio' ),
							),
							'preview' => array(
								'type' => 'none',
							),
						),
						'bg_video_fallback'    => array(
							'type'        => 'photo',
							'show_remove' => true,
							'label'       => __( 'Fallback Photo', 'satori-studio' ),
							'help'        => __( 'A photo that will be displayed if the video fails to load.', 'satori-studio' ),
							'preview'     => array(
								'type' => 'refresh',
							),
							'connections' => array( 'photo' ),
						),
					),
				),
				'bg_slideshow'     => array(
					'title'  => __( 'Background Slideshow', 'satori-studio' ),
					'fields' => array(
						'ss_source'             => array(
							'type'    => 'select',
							'label'   => __( 'Source', 'satori-studio' ),
							'default' => 'wordpress',
							'options' => array(
								'wordpress' => __( 'Media Library', 'satori-studio' ),
								'smugmug'   => 'SmugMug',
							),
							'help'    => __( 'Pull images from the WordPress media library or a gallery on your SmugMug site by inserting the RSS feed URL from SmugMug. The RSS feed URL can be accessed by using the get a link function in your SmugMug gallery.', 'satori-studio' ),
							'toggle'  => array(
								'wordpress' => array(
									'fields' => array( 'ss_photos' ),
								),
								'smugmug'   => array(
									'fields' => array( 'ss_feed_url' ),
								),
							),
							'preview' => array(
								'type' => 'none',
							),
						),
						'ss_photos'             => array(
							'type'        => 'multiple-photos',
							'label'       => __( 'Photos', 'satori-studio' ),
							'preview'     => array(
								'type' => 'none',
							),
							'connections' => array( 'multiple-photos' ),
						),
						'ss_feed_url'           => array(
							'type'        => 'text',
							'label'       => __( 'Feed URL', 'satori-studio' ),
							'preview'     => array(
								'type' => 'none',
							),
							'connections' => array( 'custom_field' ),
						),
						'ss_speed'              => array(
							'type'        => 'unit',
							'label'       => __( 'Speed', 'satori-studio' ),
							'default'     => '3',
							'size'        => '5',
							'sanitize'    => 'FLBuilderUtils::sanitize_non_negative_number',
							'slider'      => true,
							'description' => _x( 'seconds', 'Value unit for form field of time in seconds. Such as: "5 seconds"', 'satori-studio' ),
							'preview'     => array(
								'type' => 'none',
							),
						),
						'ss_transition'         => array(
							'type'    => 'select',
							'label'   => __( 'Transition', 'satori-studio' ),
							'default' => 'fade',
							'options' => array(
								'none'            => _x( 'None', 'Slideshow transition type.', 'satori-studio' ),
								'fade'            => __( 'Fade', 'satori-studio' ),
								'kenBurns'        => __( 'Ken Burns', 'satori-studio' ),
								'slideHorizontal' => __( 'Slide Horizontal', 'satori-studio' ),
								'slideVertical'   => __( 'Slide Vertical', 'satori-studio' ),
								'blinds'          => __( 'Blinds', 'satori-studio' ),
								'bars'            => __( 'Bars', 'satori-studio' ),
								'barsRandom'      => __( 'Random Bars', 'satori-studio' ),
								'boxes'           => __( 'Boxes', 'satori-studio' ),
								'boxesRandom'     => __( 'Random Boxes', 'satori-studio' ),
								'boxesGrow'       => __( 'Boxes Grow', 'satori-studio' ),
							),
							'preview' => array(
								'type' => 'none',
							),
						),
						'ss_transitionDuration' => array(
							'type'        => 'unit',
							'label'       => __( 'Transition Speed', 'satori-studio' ),
							'default'     => '1',
							'size'        => '5',
							'sanitize'    => 'FLBuilderUtils::sanitize_non_negative_number',
							'slider'      => true,
							'description' => _x( 'seconds', 'Value unit for form field of time in seconds. Such as: "5 seconds"', 'satori-studio' ),
							'preview'     => array(
								'type' => 'none',
							),
						),
						'ss_randomize'          => array(
							'type'    => 'select',
							'label'   => __( 'Randomize Photos', 'satori-studio' ),
							'default' => 'false',
							'options' => array(
								'false' => __( 'No', 'satori-studio' ),
								'true'  => __( 'Yes', 'satori-studio' ),
							),
							'preview' => array(
								'type' => 'none',
							),
						),
					),
				),
				'bg_parallax'      => array(
					'title'  => __( 'Background Parallax', 'satori-studio' ),
					'fields' => array(
						'bg_parallax_image'  => array(
							'type'        => 'photo',
							'show_remove' => true,
							'label'       => __( 'Photo', 'satori-studio' ),
							'responsive'  => true,
							'preview'     => array(
								'type' => 'refresh',
							),
							'connections' => array( 'photo' ),
						),
						'bg_parallax_speed'  => array(
							'type'    => 'select',
							'label'   => __( 'Speed', 'satori-studio' ),
							'default' => 'fast',
							'options' => array(
								'2' => __( 'Fast', 'satori-studio' ),
								'5' => _x( 'Medium', 'Speed.', 'satori-studio' ),
								'8' => __( 'Slow', 'satori-studio' ),
							),
							'preview' => array(
								'type' => 'none',
							),
						),
						'bg_parallax_offset' => array(
							'type'        => 'unit',
							'label'       => __( 'Image Offset', 'satori-studio' ),
							'responsive'  => true,
							'placeholder' => '0',
							'default'     => 0,
							'slider'      => array(
								'min'  => 0,
								'max'  => 1000,
								'step' => 10,
							),
							'preview'     => array(
								'type' => 'refresh',
							),
						),
					),
				),
				'bg_overlay'       => array(
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
							'connections' => array( 'color' ),
							'label'       => __( 'Overlay Color', 'satori-studio' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type' => 'none',
							),
						),
						'bg_overlay_gradient' => array(
							'type'    => 'gradient',
							'label'   => __( 'Overlay Gradient', 'satori-studio' ),
							'preview' => array(
								'type'     => 'css',
								'selector' => '> .fl-row-content-wrap:after',
								'property' => 'background-image',
							),
						),
					),
				),
				'bg_color'         => array(
					'title'  => __( 'Background Color', 'satori-studio' ),
					'fields' => array(
						'bg_color' => array(
							'type'        => 'color',
							'label'       => __( 'Color', 'satori-studio' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type' => 'refresh',
							),
							'connections' => array( 'color' ),
						),
					),
				),
				'bg_gradient'      => array(
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
				'bg_embed_section' => array(
					'title'  => __( 'Background Embedded Code', 'satori-studio' ),
					'fields' => array(
						'bg_embed_code' => array(
							'type'        => 'code',
							'editor'      => 'html',
							'rows'        => '8',
							'preview'     => array(
								'type' => 'refresh',
							),
							'connections' => array( 'string' ),
						),
					),
				),
				'border'           => array(
					'title'  => __( 'Border', 'satori-studio' ),
					'fields' => array(
						'border' => array(
							'type'       => 'border',
							'label'      => __( 'Border', 'satori-studio' ),
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.fl-row-content-wrap',
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
							'units'      => array(
								'px',
								'%',
								'vw',
								'vh',
							),
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.fl-row-content-wrap',
								'property' => 'margin',
							),
							'responsive' => array(
								'default_unit' => array(
									'default'    => $global_settings->row_margins_unit,
									'large'      => $global_settings->row_margins_large_unit,
									'medium'     => $global_settings->row_margins_medium_unit,
									'responsive' => $global_settings->row_margins_responsive_unit,
								),
								'placeholder'  => array(
									'default'    => array(
										'top'    => empty( $global_settings->row_margins_top ) ? '0' : $global_settings->row_margins_top,
										'right'  => empty( $global_settings->row_margins_right ) ? '0' : $global_settings->row_margins_right,
										'bottom' => empty( $global_settings->row_margins_bottom ) ? '0' : $global_settings->row_margins_bottom,
										'left'   => empty( $global_settings->row_margins_left ) ? '0' : $global_settings->row_margins_left,
									),
									'large'      => FLBuilderModel::get_node_spacing_breakpoint_placeholders( 'row', 'margins', 'large' ),
									'medium'     => FLBuilderModel::get_node_spacing_breakpoint_placeholders( 'row', 'margins', 'medium' ),
									'responsive' => FLBuilderModel::get_node_spacing_breakpoint_placeholders( 'row', 'margins', 'responsive' ),
								),
							),
						),
						'padding' => array(
							'type'       => 'dimension',
							'label'      => __( 'Padding', 'satori-studio' ),
							'slider'     => true,
							'units'      => array(
								'px',
								'em',
								'%',
								'vw',
								'vh',
							),
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.fl-row-content-wrap',
								'property' => 'padding',
							),
							'responsive' => array(
								'default_unit' => array(
									'default'    => $global_settings->row_padding_unit,
									'large'      => $global_settings->row_padding_large_unit,
									'medium'     => $global_settings->row_padding_medium_unit,
									'responsive' => $global_settings->row_padding_responsive_unit,
								),
								'placeholder'  => array(
									'default'    => array(
										'top'    => empty( $global_settings->row_padding_top ) ? '0' : $global_settings->row_padding_top,
										'right'  => empty( $global_settings->row_padding_right ) ? '0' : $global_settings->row_padding_right,
										'bottom' => empty( $global_settings->row_padding_bottom ) ? '0' : $global_settings->row_padding_bottom,
										'left'   => empty( $global_settings->row_padding_left ) ? '0' : $global_settings->row_padding_left,
									),
									'large'      => FLBuilderModel::get_node_spacing_breakpoint_placeholders( 'row', 'padding', 'large' ),
									'medium'     => FLBuilderModel::get_node_spacing_breakpoint_placeholders( 'row', 'padding', 'medium' ),
									'responsive' => FLBuilderModel::get_node_spacing_breakpoint_placeholders( 'row', 'padding', 'responsive' ),
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
							'description' => sprintf( __( 'Optional. Set the <a%s>capability</a> required for users to view this row.', 'satori-studio' ), ' href="http://codex.wordpress.org/Roles_and_Capabilities#Capability_vs._Role_Table" target="_blank"' ),
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
							'default'  => apply_filters( 'fl_builder_row_container_element_default', 'div' ),
							'sanitize' => array( 'FLBuilderUtils::esc_tags', apply_filters( 'fl_builder_row_container_element_default', 'div' ) ),
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
							)),
							'help'     => __( 'Optional. Choose an appropriate HTML5 content sectioning element to use for this row to improve accessibility and machine-readability.', 'satori-studio' ),
							'preview'  => array(
								'type' => 'none',
							),
						),
						'id'                => array(
							'type'    => 'text',
							'label'   => __( 'ID', 'satori-studio' ),
							'help'    => __( "A unique ID that will be applied to this row's HTML. Must start with a letter and only contain dashes, underscores, letters or numbers. No spaces.", 'satori-studio' ),
							'preview' => array(
								'type' => 'none',
							),
						),
						'class'             => array(
							'type'    => 'text',
							'label'   => __( 'Class', 'satori-studio' ),
							'help'    => __( "A class that will be applied to this row's HTML. Must start with a letter and only contain dashes, underscores, letters or numbers. Separate multiple classes with spaces.", 'satori-studio' ),
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
							'content' => '<button style="margin-right:10px" class="fl-builder-button fl-builder-button-small row-export-all" title="Copy Settings">Copy Settings</button><button class="fl-builder-button fl-builder-button-small row-export-style" title="Copy Styles">Copy Styles</button>',
						),
						'import' => array(
							'type'    => 'raw',
							'label'   => __( 'Import', 'satori-studio' ),
							'preview' => 'none',
							'content' => '<div class="row-import-wrap"><input type="text" class="row-import-input" placeholder="Paste settings or styles here..." /><button class="fl-builder-button fl-builder-button-small row-import-apply">Import</button></div><div class="row-import-error"></div>',
						),
					),
				),
			),
		),
	),
);

// Merge Shape Layer Sections
$style_sections                            = $row_settings['tabs']['style']['sections'];
$shape_sections                            = FLBuilderArt::get_shape_settings_sections();
$row_settings['tabs']['style']['sections'] = array_merge( $style_sections, $shape_sections );

// Register
FLBuilder::register_settings_form( 'row', $row_settings );
