<?php

/**
 * Class that handles showing admin advanced options.
 *
 * @since 2.6
 */
final class FLBuilderAdminAdvanced {

	/**
	 * The advanced settings default groups
	 * @since 2.6
	 */
	public static function get_groups() {
		return array(
			'ui'       => array(
				'label' => __( 'Builder UI', 'satori-studio' ),
			),
			'admin'    => array(
				'label' => __( 'WP Admin', 'satori-studio' ),
			),
			'assets'   => array(
				'label' => __( 'Assets', 'satori-studio' ),
			),
			'frontend' => array(
				'label' => __( 'Frontend', 'satori-studio' ),
			),
		);
	}

	/**
	 * Return all advanced settings as an array
	 * @since 2.6
	 */
	static public function get_settings() {
		$settings = array(
			'iframe_ui'              => array(
				'label'       => self::__( 'Responsive iFrame UI', 'satori-studio' ),
				'default'     => 1,
				'callback'    => array( __CLASS__, 'disable_iframe_ui' ),
				'group'       => 'ui',
				'description' => self::__( 'The iFrame UI provides accurate responsive editing. Disable it if you are having issues with third-party or legacy add-ons.', 'satori-studio' ),
			),
			'outline_enabled'        => array(
				'label'    => self::__( 'Outline Panel', 'satori-studio' ),
				'default'  => 1,
				'callback' => array( __CLASS__, 'disable_outline' ),
				'group'    => 'ui',
				'link'     => 'https://docs.wpbeaverbuilder.com/beaver-builder/user-interface/outline-panel/',
			),
			'inline_editing_enabled' => array(
				'label'    => self::__( 'Inline Editing', 'satori-studio' ),
				'default'  => 1,
				'callback' => array( __CLASS__, 'disable_inline_edit' ),
				'group'    => 'ui',
				'link'     => 'https://docs.wpbeaverbuilder.com/beaver-builder/basics/inline-editing/',
			),
			'notifications_enabled'  => array(
				'label'       => self::__( "What's New", 'satori-studio' ),
				'default'     => 1,
				'callback'    => array( __CLASS__, 'disable_notifications' ),
				'group'       => 'ui',
				'description' => self::__( 'When disabled, alerts will not be received for new posts on the blog in the UI', 'satori-studio' ),
			),
			'lasttab_enabled'        => array(
				'label'       => self::__( 'Remember last used tab', 'satori-studio' ),
				'default'     => 1,
				'callback'    => array( __CLASS__, 'disable_lastused' ),
				'group'       => 'ui',
				'description' => self::__( 'When disabled, the Builder will not remember the last tab used in the row/column/module settings.', 'satori-studio' ),
			),
			'rowshapes_enabled'      => array(
				'label'       => self::__( 'Custom Row Shapes', 'satori-studio' ),
				'default'     => 1,
				'callback'    => array( __CLASS__, 'disable_rowshapes' ),
				'group'       => 'ui',
				'description' => self::__( 'When enabled, a custom row shapes tab will be added to the Global Settings.', 'satori-studio' ),
			),
			'node_code'              => array(
				'label'       => self::__( 'Enable Code Settings', 'satori-studio' ),
				'default'     => 1,
				'callback'    => array( __CLASS__, 'disable_node_code' ),
				'group'       => 'ui',
				'action'      => 'plugins_loaded',
				'priority'    => 9,
				'description' => self::__( 'When enabled, CSS and JS settings will be available for rows, columns, and modules.', 'satori-studio' ),
			),
			'limitrevisions_enabled' => array(
				'label'       => self::__( 'Limit WP revisions for layouts', 'satori-studio' ),
				'default'     => 1,
				'callback'    => array( __CLASS__, 'limit_revisions' ),
				'group'       => 'ui',
				'hasdepend'   => true,
				'description' => self::__( 'WP by default does not limit the amount of revisions.', 'satori-studio' ),
			),
			'limitrevisions_num'     => array(
				'label'       => self::__( 'Revisions Limit', 'satori-studio' ),
				'default'     => 10,
				'type'        => 'text',
				'depends'     => 'limitrevisions_enabled',
				'group'       => 'ui',
				'description' => self::__( 'Set to 0 to completely disable revisions for layouts/pages controlled by the Builder', 'satori-studio' ),
			),
			'limithistory_enabled'   => array(
				'label'       => self::__( 'Limit the amount of undo/redo history in Builder UI', 'satori-studio' ),
				'default'     => 0,
				'callback'    => array( __CLASS__, 'limithistory_enabled' ),
				'group'       => 'ui',
				'hasdepend'   => true,
				'description' => self::__( 'History is limited to 20 by default in the Builder undo/redo UI', 'satori-studio' ),
			),
			'limithistory_num'       => array(
				'label'       => self::__( 'History Limit', 'satori-studio' ),
				'default'     => 5,
				'type'        => 'text',
				'depends'     => 'limithistory_enabled',
				'group'       => 'ui',
				'description' => self::__( 'Set to 0 to completely disable undo/redo history', 'satori-studio' ),
			),
			'modsec_enabled'         => array(
				'label'    => self::__( 'Mod Security fix', 'satori-studio' ),
				'default'  => 0,
				'callback' => array( __CLASS__, 'enable_modsec' ),
				'group'    => 'ui',
				'link'     => 'https://docs.wpbeaverbuilder.com/beaver-builder/troubleshooting/common-issues/403-forbidden-or-blocked-error/',
			),
			'sort_enabled'           => array(
				'label'       => self::__( 'Add Filtering Option ', 'satori-studio' ),
				'default'     => 1,
				'callback'    => array( __CLASS__, 'disable_sorting' ),
				'group'       => 'admin',
				'description' => self::__( 'When enabled, a filter option is added for Builder enabled posts/pages in the post/page list', 'satori-studio' ),
			),
			'duplicate_enabled'      => array(
				'label'    => self::__( 'Show duplicate action links in post/page list view', 'satori-studio' ),
				'default'  => 1,
				'callback' => array( __CLASS__, 'disable_duplicate' ),
				'group'    => 'admin',
			),
			'duplicatemenu_enabled'  => array(
				'label'    => self::__( 'Show duplicate action link in WP Admin Bar', 'satori-studio' ),
				'default'  => 0,
				'callback' => array( __CLASS__, 'disable_duplicate_menu' ),
				'group'    => 'admin',
			),
			'google_enabled'         => array(
				'label'       => 'Google Fonts',
				'description' => self::__( 'When disabled, no Google Fonts will be enqueued or available in style options.', 'satori-studio' ),
				'default'     => 1,
				'callback'    => array( __CLASS__, 'disable_google' ),
				'group'       => 'assets',
			),
			'google_auto'            => array(
				'label'       => 'Google Fonts Auto Update',
				'description' => self::__( 'System will automatically update the available fonts', 'satori-studio' ),
				'default'     => 1,
				'callback'    => array( __CLASS__, 'google_auto' ),
				'group'       => 'assets',
			),
			'awesome_enabled'        => array(
				'label'       => self::__( 'Font Awesome', 'satori-studio' ),
				'description' => self::__( 'When disabled, Font Awesome will not be enqueued, even if modules require it.', 'satori-studio' ),
				'default'     => 1,
				'callback'    => array( __CLASS__, 'disable_awesome' ),
				'group'       => 'assets',
			),
			'gd_crop_enabled'        => array(
				'label'    => self::__( 'Prefer GD for image cropping', 'satori-studio' ),
				'default'  => 0,
				'callback' => array( __CLASS__, 'enable_gd_crop' ),
				'group'    => 'assets',
			),
			'inline_enabled'         => array(
				'label'       => 'Render CSS/JS assets inline',
				'default'     => 0,
				'callback'    => array( __CLASS__, 'render_inline' ),
				'group'       => 'frontend',
				'description' => self::__( 'Instead of loading Builder CSS and JavaScript as an asset file, assets will render inline', 'satori-studio' ),
				'link'        => 'https://docs.wpbeaverbuilder.com/beaver-builder/developer/how-to-tips/load-css-and-javascript-inline/',
			),
			'modules_enabled'        => array(
				'label'       => self::__( 'Show advanced module usage', 'satori-studio' ),
				'default'     => 0,
				'action'      => 'plugins_loaded',
				'callback'    => array( __CLASS__, 'modules_enabled' ),
				'group'       => 'admin',
				'description' => self::__( 'Show detailed module usage on modules tab. Any disabled modules will be fully disabled and no longer render unless it is a dependency for another module.', 'satori-studio' ),
				'link'        => 'https://docs.wpbeaverbuilder.com/beaver-builder/developer/tutorials-guides/common-beaver-builder-plugin-filter-examples/#show-which-modules-are-in-use-in-a-website',
			),

			'small_data_enabled'     => array(
				'label'       => self::__( 'Small Data Mode', 'satori-studio' ),
				'default'     => 0,
				'callback'    => array( __CLASS__, 'small_data_enabled' ),
				'group'       => 'ui',
				'description' => self::__( 'When enabled, fields that are empty/blank will not be saved to the database.', 'satori-studio' ),
			),
			'node_labels_enabled'    => array(
				'label'       => self::__( 'Node Labels', 'satori-studio' ),
				'default'     => 1,
				'callback'    => array( __CLASS__, 'node_labels_enabled' ),
				'group'       => 'ui',
				'description' => self::__( 'Show custom labels for Nodes.', 'satori-studio' ),
			),
			'shortcodes_enabled'     => array(
				'label'    => self::__( 'Render shortcodes in CSS/JS', 'satori-studio' ),
				'default'  => 0,
				'callback' => array( __CLASS__, 'shortcodes_enabled' ),
				'group'    => 'ui',
				'link'     => 'https://docs.wpbeaverbuilder.com/beaver-builder/advanced-builder-techniques/shortcodes/use-shortcodes-in-tools-menu-css-or-js/',
			),
			'acf_blocks_enabled'     => array(
				'label'       => self::__( 'ACF Blocks', 'satori-studio' ),
				'default'     => 1,
				'callback'    => array( __CLASS__, 'disable_acf_blocks' ),
				'group'       => 'ui',
				'description' => self::__( 'When enabled, this allows blocks built with ACF to be used in the builder.', 'satori-studio' ),
			),
			'collapse_default'       => array(
				'label'       => self::__( 'Collapse All Settings', 'satori-studio' ),
				'default'     => 0,
				'callback'    => array( __CLASS__, 'collapse_default' ),
				'group'       => 'ui',
				'description' => self::__( 'When enabled, settings window sections will be collapsed.', 'satori-studio' ),
			),
			'theme_colors'           => array(
				'label'       => self::__( 'Load Theme Colors', 'satori-studio' ),
				'default'     => 0,
				'group'       => 'ui',
				'description' => self::__( 'When enabled, Theme colors will be shown in color pickers.', 'satori-studio' ),
			),
			'core_colors'            => array(
				'label'       => self::__( 'Load WordPress Colors', 'satori-studio' ),
				'default'     => 0,
				'group'       => 'ui',
				'description' => self::__( 'When enabled, WordPress Core colors will be shown in color pickers.', 'satori-studio' ),
			),
			'module_wrappers'        => array(
				'label'       => self::__( 'Force Module Wrapper Divs', 'satori-studio' ),
				'default'     => 0,
				'callback'    => array( __CLASS__, 'module_wrappers' ),
				'group'       => 'frontend',
				'description' => self::__( 'Forces modules to render their wrapper divs, even if they have been removed in a recent update.', 'satori-studio' ),
			),
		);
		if ( ! self::is_plugins_loaded_action() && FLBuilderModel::is_white_labeled() ) {
			unset( $settings['notifications_enabled'] );
		}
		return $settings;
	}

	static private function __( $text, $domain ) {
		if ( self::is_plugins_loaded_action() ) {
			return $text;
		}
		return __( $text, $domain ); //phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText, WordPress.WP.I18n.NonSingularStringLiteralDomain
	}

	static private function is_plugins_loaded_action() {
		return 'plugins_loaded' === current_action();
	}

	static private function disable_sorting() {
		add_filter( 'fl_builder_admin_edit_sort_bb_enabled', '__return_false', 11 );
	}
	static private function disable_iframe_ui() {
		add_filter( 'fl_builder_iframe_ui_enabled', '__return_false', 11 );
	}
	static private function disable_outline() {
		add_filter( 'fl_builder_outline_panel_enabled', '__return_false', 11 );
	}
	static private function disable_inline_edit() {
		add_filter( 'fl_inline_editing_enabled', '__return_false', 11 );
	}
	static private function disable_notifications() {
		add_filter( 'fl_disable_notifications', '__return_true', 11 );
	}
	static private function disable_lastused() {
		add_filter( 'fl_remember_settings_tabs_enabled', '__return_false', 11 );
	}
	static private function disable_duplicate() {
		add_filter( 'fl_builder_duplicate_enabled', '__return_false', 11 );
	}
	static private function disable_duplicate_menu() {
		add_filter( 'fl_builder_duplicatemenu_enabled', '__return_true', 11 );
	}
	static private function disable_google() {
		add_filter( 'fl_builder_font_families_google', '__return_empty_array', 11 );
		add_filter( 'fl_enable_google_fonts_enqueue', '__return_false', 11 );
	}
	static private function google_auto() {
		add_filter( 'fl_builder_google_auto', '__return_true' );
	}
	static private function disable_awesome() {
		if ( ! isset( $_GET['fl_builder'] ) ) {
			add_action( 'wp_enqueue_scripts', function () {
				wp_dequeue_style( 'font-awesome' );
				wp_dequeue_style( 'font-awesome-5' );
				wp_deregister_style( 'font-awesome' );
				wp_deregister_style( 'font-awesome-5' );
			}, 10001 );
		}
	}
	static private function render_inline() {
		add_filter( 'fl_builder_render_assets_inline', '__return_true', 1000 );
	}
	static private function modules_enabled() {
		add_filter( 'is_module_disable_enabled', '__return_true', 11 );
	}

	static private function small_data_enabled() {
		add_filter( 'fl_builder_enable_small_data_mode', '__return_true', 12 );
	}

	static private function enable_gd_crop() {
		add_filter( 'wp_image_editors', function () {
			return array( 'WP_Image_Editor_GD', 'WP_Image_Editor_Imagick' );
		}, 100 );
	}
	static private function disable_rowshapes() {
		add_filter( 'fl_builder_register_settings_form', function ( $form, $id ) {
			if ( 'global' == $id && isset( $form['tabs']['shapes'] ) ) {
				unset( $form['tabs']['shapes'] );
			}
			return $form;
		}, 11, 2 );
	}

	static private function disable_node_code() {
		add_filter( 'fl_builder_enable_node_code_settings', '__return_false', 1000 );
	}

	static private function limit_revisions() {
		add_filter( 'wp_revisions_to_keep', function ( $num, $post ) {
			$enabled = get_post_meta( $post->ID, '_fl_builder_enabled', true );
			if ( $enabled ) {
				return (int) get_option( '_fl_builder_limitrevisions_num', 11 ) + 1;
			}
			return $num;
		}, 10, 2 );
	}

	static private function limithistory_enabled() {
		add_filter( 'fl_history_states_max', function () {
			return (int) get_option( '_fl_builder_limithistory_num', 5 );
		} );
	}

	static private function enable_modsec() {
		add_filter( 'fl_is_modsec_fix_enabled', '__return_true', 11 );
	}

	static private function node_labels_enabled() {
		add_filter( 'fl_node_labels_disabled', '__return_true' );
	}

	static private function shortcodes_enabled() {
		add_filter( 'fl_enable_shortcode_css_js', '__return_true' );
		add_filter( 'fl_ace_editor_settings', function ( $args ) {
			$args['useWorker'] = false;
			return $args;
		});
	}

	static private function disable_acf_blocks() {
		add_filter( 'fl_disable_acf_blocks', '__return_true' );
	}

	static private function collapse_default() {
		add_filter( 'fl_builder_ui_collapse_sections', '__return_true' );
	}

	static private function module_wrappers() {
		add_filter( 'fl_builder_force_module_wrappers', '__return_true' );
	}

	/**
	 * @since 2.6
	 */
	static public function init() {
		add_action( 'init', array( __CLASS__, 'register_settings' ) );
		add_action( 'after_setup_theme', __CLASS__ . '::register_user_access_settings' );
		add_action( 'wp_ajax_fl_advanced_submit', array( __CLASS__, 'advanced_submit' ) );
		add_action( 'plugins_loaded', array( __CLASS__, 'init_hooks' ), 5 );
		self::global_styles();
	}


	/**
	 * @since 2.8.1
	 */
	static public function global_styles() {
		add_filter( 'fl_builder_global_colors_json', function ( $json ) {
			if ( ! get_option( '_fl_builder_core_colors' ) ) {
				unset( $json['themeJSON']['color']['palette']['default'] );
			}
			if ( ! get_option( '_fl_builder_theme_colors' ) ) {
				unset( $json['themeJSON']['color']['palette']['theme'] );
			}
			return $json;
		});
	}

	static public function advanced_submit() {
		if ( isset( $_POST['action'] ) && wp_verify_nonce( $_POST['_wpnonce'], 'advanced' ) ) {
			$setting = $_POST['setting'];
			if ( ! isset( $_POST['type'] ) ) {
					$value = 'true' === $_POST['value'] ? '1' : '0';
			} else {
				$value = (int) $_POST['value'];
			}
			update_option( "_fl_builder_{$setting}", $value );
			wp_send_json_success();
		} else {
			wp_send_json_error();
		}
	}

	/**
	 * Register the new user level to view options
	 * @since 2.6
	 */
	static public function register_user_access_settings() {
		FLBuilderUserAccess::register_setting( 'fl_builder_advanced_options', array(
			'default'     => array( 'administrator' ),
			'group'       => __( 'Admin', 'satori-studio' ),
			'label'       => __( 'Advanced Settings', 'satori-studio' ),
			'description' => __( 'The selected roles will be able to access the Advanced Settings. Note: user roles without the <code>manage_options</code> capability cannot access these settings.', 'satori-studio' ),
			'order'       => '110',
		) );
	}

	/**
	 * @since 2.6
	 */
	static public function init_hooks() {
		foreach ( self::get_settings() as $key => $setting ) {
			$option = get_option( "_fl_builder_{$key}" );
			// Make sure option is actually set to save db queries.
			if ( false === $option ) {
				update_option( "_fl_builder_{$key}", $setting['default'] );
				$option = $setting['default'];
			}
			if ( $option != $setting['default'] && isset( $setting['callback'] ) ) {
				$action   = isset( $setting['action'] ) ? $setting['action'] : 'init';
				$priority = isset( $setting['priority'] ) ? $setting['priority'] : 11;
				add_action( $action, function () use ( $setting ) {
					call_user_func( $setting['callback'] );
				}, $priority );
			}
		}
	}

	/**
	 * Register the new settings
	 * @since 2.6
	 */
	static public function register_settings() {
		foreach ( self::get_settings() as $key => $setting ) {
			FLBuilderAdminSettings::register_setting( '_fl_builder_' . $key );
		}
	}
}

FLBuilderAdminAdvanced::init();
