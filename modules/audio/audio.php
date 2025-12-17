<?php

/**
 * @class FLAudioModule
 */
class FLAudioModule extends FLBuilderModule {

	/**
	 * @property $data
	 */
	public $data = null;

	/**
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(array(
			'name'            => __( 'Audio', 'satori-studio' ),
			'description'     => __( 'Render a WordPress audio shortcode.', 'satori-studio' ),
			'category'        => __( 'Basic', 'satori-studio' ),
			'icon'            => 'format-audio.svg',
			'partial_refresh' => true,
			'include_wrapper' => false,
			'element_setting' => false,
		));
	}

	/**
	 * @method get_data
	 */
	public function get_data() {
		if ( ! $this->data ) {

			// Get audio data if user selected only one audio file
			if ( is_array( $this->settings->audios ) && count( $this->settings->audios ) == 1 ) {
				$this->data = FLBuilderPhoto::get_attachment_data( $this->settings->audios[0] );

				if ( ! $this->data && isset( $this->settings->data ) ) {
					$this->data = $this->settings->data;
				}
			}
		}

		return $this->data;
	}

	/**
	 * @method update
	 * @param $settings {object}
	 */
	public function update( $settings ) {
		// Cache the attachment data.
		if ( 'media_library' == $settings->audio_type ) {

			// Get audio data if user selected only one audio file
			if ( is_array( $settings->audios ) && count( $settings->audios ) == 1 ) {
				$audios = FLBuilderPhoto::get_attachment_data( $settings->audios[0] );

				if ( $audios ) {
					$settings->data = $audios;
				}
			}
		}

		return $settings;
	}
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('FLAudioModule', array(
	'general' => array(
		'title'    => __( 'General', 'satori-studio' ),
		'sections' => array(
			'general' => array(
				'title'  => '',
				'fields' => array(
					'audio_type'   => array(
						'type'    => 'select',
						'label'   => __( 'Audio Type', 'satori-studio' ),
						'default' => 'wordpress',
						'options' => array(
							'media_library' => __( 'Media Library', 'satori-studio' ),
							'link'          => __( 'Link', 'satori-studio' ),
						),
						'toggle'  => array(
							'link'          => array(
								'fields' => array( 'link' ),
							),
							'media_library' => array(
								'fields' => array( 'audios' ),
							),
						),
					),
					'audios'       => array(
						'type'   => 'multiple-audios',
						'label'  => __( 'Audio', 'satori-studio' ),
						'toggle' => array(
							'playlist'     => array(
								'fields' => array( 'style', 'tracklist', 'tracknumbers', 'images', 'artists' ),
							),
							'single_audio' => array(
								'fields' => array( 'autoplay', 'loop' ),
							),
						),
					),
					'link'         => array(
						'type'        => 'text',
						'label'       => __( 'Link', 'satori-studio' ),
						'connections' => array( 'url' ),
					),

					/**
					 * Single audio options
					 */
					'autoplay'     => array(
						'type'    => 'select',
						'label'   => __( 'Auto Play', 'satori-studio' ),
						'default' => '0',
						'options' => array(
							'0' => __( 'No', 'satori-studio' ),
							'1' => __( 'Yes', 'satori-studio' ),
						),
						'preview' => array(
							'type' => 'none',
						),
					),
					'loop'         => array(
						'type'    => 'select',
						'label'   => __( 'Loop', 'satori-studio' ),
						'default' => '0',
						'options' => array(
							'0' => __( 'No', 'satori-studio' ),
							'1' => __( 'Yes', 'satori-studio' ),
						),
						'preview' => array(
							'type' => 'none',
						),
					),

					/**
					 * Playlist options - show only if user selected more than one files
					 */
					'style'        => array(
						'type'    => 'select',
						'label'   => __( 'Style', 'satori-studio' ),
						'default' => 'light',
						'options' => array(
							'light' => __( 'Light', 'satori-studio' ),
							'dark'  => __( 'Dark', 'satori-studio' ),
						),
					),
					'tracklist'    => array(
						'type'    => 'select',
						'label'   => __( 'Show Playlist', 'satori-studio' ),
						'default' => '1',
						'options' => array(
							'0' => __( 'No', 'satori-studio' ),
							'1' => __( 'Yes', 'satori-studio' ),
						),
						'toggle'  => array(
							'1' => array(
								'fields' => array( 'tracknumbers' ),
							),
						),
					),
					'tracknumbers' => array(
						'type'    => 'select',
						'label'   => __( 'Show Track Numbers', 'satori-studio' ),
						'default' => '1',
						'options' => array(
							'0' => __( 'No', 'satori-studio' ),
							'1' => __( 'Yes', 'satori-studio' ),
						),
						'preview' => array(
							'type' => 'none',
						),
					),
					'images'       => array(
						'type'    => 'select',
						'label'   => __( 'Show Thumbnail', 'satori-studio' ),
						'default' => '1',
						'options' => array(
							'0' => __( 'No', 'satori-studio' ),
							'1' => __( 'Yes', 'satori-studio' ),
						),
					),
					'artists'      => array(
						'type'    => 'select',
						'label'   => __( 'Show Artist Name', 'satori-studio' ),
						'default' => '1',
						'options' => array(
							'0' => __( 'No', 'satori-studio' ),
							'1' => __( 'Yes', 'satori-studio' ),
						),
					),
				),
			),
		),
	),
));
