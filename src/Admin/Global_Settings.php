<?php
/* -------------------------------------------------
 * SATORI Studio — Global Settings Admin Screen
 * -------------------------------------------------*/

declare(strict_types=1);

namespace Satori_Studio\Admin;

use Satori_Studio\Core\DesignSystem;
use Satori_Studio\Core\Environment;

/**
 * Admin handler for the SATORI Studio Global Settings page.
 *
 * Responsibilities:
 * - Register the Global Settings option and its fields via the WordPress Settings API.
 * - Render the admin UI for managing colors, typography, and spacing.
 * - Provide helpers for retrieving defaults seeded from the design system tokens.
 *
 * Phase 2E scaffold note: these settings are stored for future phases and do not
 * alter front-end rendering or builder defaults yet.
 */
class Global_Settings {

        /**
         * Option name used to persist global settings.
         */
        const OPTION_NAME = 'satori_studio_global_settings';

        /**
         * Settings group identifier.
         */
        const OPTION_GROUP = 'satori_studio_global_settings_group';

        /**
         * Tab slug for the settings page within the Beaver Builder settings shell.
         */
        const TAB_SLUG = 'satori-global-settings';

        /**
         * Parent menu slug for the SATORI Studio admin menu.
         */
        const PARENT_SLUG = 'fl-builder-settings';

        /**
         * Legacy standalone slug retained only for defensive redirects.
         */
        const LEGACY_PAGE_SLUG = 'satori-studio-global-settings';

        /**
         * Core environment metadata.
         *
         * @var Environment
         */
        private $environment;

        /**
         * Design system tokens.
         *
         * @var DesignSystem
         */
        private $design_system;

        /**
         * Tracks whether hooks have already been registered.
         *
         * @var bool
         */
        private $initialized = false;

        /**
         * Cached defaults derived from the design system tokens.
         *
         * @var array<string, array<string, string>>|null
         */
        private $defaults = null;

        /**
         * Singleton-like reference to the active instance.
         *
         * @var Global_Settings|null
         */
        private static $instance = null;

        /**
         * Capability required to manage Global Settings.
         *
         * @var string
         */
        private $capability = 'manage_options';

        /**
         * Constructor.
         *
         * @param Environment  $environment   Core environment metadata.
         * @param DesignSystem $design_system Design system tokens service.
         */
        public function __construct( Environment $environment, DesignSystem $design_system ) {
                $this->environment   = $environment;
                $this->design_system = $design_system;
                self::$instance      = $this;
        }

        /**
         * Retrieve the active Global_Settings instance.
         *
         * @return Global_Settings|null
         */
        public static function instance() {
                return self::$instance;
        }

        /**
         * Bootstrap the settings page hooks.
         *
         * @return void
         */
        public function init() {
                if ( $this->initialized ) {
                        return;
                }

                $this->initialized = true;

                add_action( 'admin_init', array( $this, 'register_settings' ) );
                add_action( 'admin_init', array( $this, 'redirect_legacy_page' ) );
                add_action( 'admin_init', array( $this, 'redirect_hidden_tab' ) );

                if ( $this->should_expose_ui() ) {
                        add_action( 'fl_builder_admin_settings_nav_after', array( $this, 'render_settings_nav_link' ) );
                        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_assets' ) );
                }
        }

        /**
         * Register the Global Settings option, sections, and fields.
         *
         * @return void
         */
        public function register_settings() {
                register_setting(
                        self::OPTION_GROUP,
                        self::OPTION_NAME,
                        array(
                                'type'              => 'array',
                                'sanitize_callback' => array( $this, 'sanitize_settings' ),
                                'default'           => $this->get_defaults(),
                        )
                );

                add_settings_section(
                        'satori_studio_global_settings_colors',
                        __( 'Colors', 'satori-studio' ),
                        array( $this, 'render_colors_section_intro' ),
                        self::TAB_SLUG
                );

                $color_fields = array(
                        'primary'            => array(
                                'label'                => __( 'Primary color', 'satori-studio' ),
                                'supports_transparent' => true,
                        ),
                        'accent'             => array(
                                'label'                => __( 'Accent color', 'satori-studio' ),
                                'supports_transparent' => true,
                        ),
                        'neutral_background' => array(
                                'label'                => __( 'Neutral background', 'satori-studio' ),
                                'supports_transparent' => true,
                        ),
                        'neutral_surface'    => array(
                                'label'                => __( 'Neutral surface', 'satori-studio' ),
                                'supports_transparent' => true,
                        ),
                        'neutral_border'     => array(
                                'label'                => __( 'Neutral border', 'satori-studio' ),
                                'supports_transparent' => true,
                        ),
                );

                foreach ( $color_fields as $key => $field_config ) {
                        $label = isset( $field_config['label'] ) ? $field_config['label'] : '';

                        add_settings_field(
                                'satori_studio_global_settings_color_' . $key,
                                $label,
                                array( $this, 'render_color_input_field' ),
                                self::TAB_SLUG,
                                'satori_studio_global_settings_colors',
                                array(
                                        'section' => 'colors',
                                        'key'     => $key,
                                        'type'    => 'text',
                                        'supports_transparent' => isset( $field_config['supports_transparent'] ) && true === $field_config['supports_transparent'],
                                )
                        );
                }

                add_settings_section(
                        'satori_studio_global_settings_typography',
                        __( 'Typography', 'satori-studio' ),
                        array( $this, 'render_typography_section_intro' ),
                        self::TAB_SLUG
                );

                $typography_fields = array(
                        'base_font_family'   => __( 'Base font family', 'satori-studio' ),
                        'base_font_size'     => __( 'Base font size', 'satori-studio' ),
                        'heading_font_family'=> __( 'Heading font family', 'satori-studio' ),
                );

                foreach ( $typography_fields as $key => $label ) {
                        add_settings_field(
                                'satori_studio_global_settings_typography_' . $key,
                                $label,
                                array( $this, 'render_text_input_field' ),
                                self::TAB_SLUG,
                                'satori_studio_global_settings_typography',
                                array(
                                        'section' => 'typography',
                                        'key'     => $key,
                                        'type'    => 'text',
                                )
                        );
                }

                add_settings_section(
                        'satori_studio_global_settings_spacing',
                        __( 'Spacing', 'satori-studio' ),
                        array( $this, 'render_spacing_section_intro' ),
                        self::TAB_SLUG
                );

                $spacing_fields = array(
                        'base_unit'              => array(
                                'label' => __( 'Base unit', 'satori-studio' ),
                                'step'  => 1,
                        ),
                        'section_padding_default'=> array(
                                'label' => __( 'Section padding default', 'satori-studio' ),
                                'step'  => 1,
                        ),
                );

                foreach ( $spacing_fields as $key => $field_config ) {
                        $label = isset( $field_config['label'] ) ? $field_config['label'] : '';

                        add_settings_field(
                                'satori_studio_global_settings_spacing_' . $key,
                                $label,
                                array( $this, 'render_spacing_input_field' ),
                                self::TAB_SLUG,
                                'satori_studio_global_settings_spacing',
                                array(
                                        'section' => 'spacing',
                                        'key'     => $key,
                                        'type'    => 'text',
                                        'step'    => isset( $field_config['step'] ) ? $field_config['step'] : 1,
                                )
                        );
                }
        }


        /**
         * Enqueue assets required for the Global Settings admin screen.
         *
         * @return void
         */
        public function enqueue_admin_assets() {
                if ( ! $this->should_expose_ui() ) {
                        return;
                }

                if ( ! $this->is_global_settings_screen() ) {
                        return;
                }

                wp_enqueue_style( 'wp-color-picker' );
                wp_enqueue_script( 'wp-color-picker' );

                wp_enqueue_script(
                        'satori-studio-global-settings',
                        $this->environment->get_plugin_url() . 'assets/js/admin-global-settings.js',
                        array( 'wp-color-picker', 'jquery' ),
                        $this->environment->get_version(),
                        true
                );

                wp_localize_script(
                        'satori-studio-global-settings',
                        'SatoriGlobalSettingsL10n',
                        array(
                                'defaultLabel'    => __( 'Default', 'satori-studio' ),
                                'transparentLabel'=> __( 'Transparent', 'satori-studio' ),
                        )
                );
        }

        /**
         * Render the main settings page markup.
         *
         * @return void
         */
        public function render_settings_page() {
                if ( ! $this->should_expose_ui() ) {
                        $this->redirect_hidden_tab();
                        return;
                }

                $capability = $this->get_capability();

                if ( ! current_user_can( $capability ) ) {
                        wp_die( esc_html__( 'Sorry, you are not allowed to access this page.', 'satori-studio' ) );
                }

                ?>
                <div id="fl-<?php echo esc_attr( self::TAB_SLUG ); ?>-form" class="fl-settings-form satori-global-settings">
                        <h3 class="fl-settings-form-header"><?php esc_html_e( 'Global Settings', 'satori-studio' ); ?></h3>
                        <form action="options.php" method="post">
                                <div class="fl-settings-form-content">
                                        <p class="description">
                                                <?php esc_html_e( 'Set your site-wide design defaults (colors, typography, and spacing) for SATORI Studio. These settings are saved for future use and do not change your existing pages automatically.', 'satori-studio' ); ?>
                                        </p>
                                        <?php $this->render_preview_card(); ?>
                                        <?php settings_fields( self::OPTION_GROUP ); ?>
                                        <?php do_settings_sections( self::TAB_SLUG ); ?>
                                </div>
                                <?php submit_button( __( 'Save Changes', 'satori-studio' ) ); ?>
                        </form>
                </div>
                <?php
        }

        /**
         * Render a text input field for a given settings key.
         *
         * @param array $args Field arguments including section and key identifiers.
         * @return void
         */
        public function render_text_input_field( $args ) {
                $section = isset( $args['section'] ) ? $args['section'] : '';
                $key     = isset( $args['key'] ) ? $args['key'] : '';
                $type    = isset( $args['type'] ) ? $args['type'] : 'text';
                $input_class = isset( $args['input_class'] ) ? $args['input_class'] : 'regular-text';
                $data_attrs  = isset( $args['data'] ) && is_array( $args['data'] ) ? $args['data'] : array();

                if ( empty( $section ) || empty( $key ) ) {
                        return;
                }

                $settings = $this->get_settings();
                $value    = isset( $settings[ $section ][ $key ] ) ? $settings[ $section ][ $key ] : '';
                $placeholder = isset( $args['placeholder'] ) ? $args['placeholder'] : '';
                ?>
                <input
                        type="<?php echo esc_attr( $type ); ?>"
                        name="<?php echo esc_attr( self::OPTION_NAME . "[$section][$key]" ); ?>"
                        value="<?php echo esc_attr( $value ); ?>"
                        class="<?php echo esc_attr( $input_class ); ?>"
                        placeholder="<?php echo esc_attr( $placeholder ); ?>"
                        <?php foreach ( $data_attrs as $data_key => $data_value ) : ?>
                                data-<?php echo esc_attr( $data_key ); ?>="<?php echo esc_attr( $data_value ); ?>"
                        <?php endforeach; ?>
                />
                <?php
        }

        /**
         * Render a color input field with default and transparency helpers.
         *
         * @param array $args Field arguments including section and key identifiers.
         * @return void
         */
        public function render_color_input_field( $args ) {
                $section = isset( $args['section'] ) ? $args['section'] : '';
                $key     = isset( $args['key'] ) ? $args['key'] : '';
                $supports_transparent = isset( $args['supports_transparent'] ) ? (bool) $args['supports_transparent'] : false;

                if ( empty( $section ) || empty( $key ) ) {
                        return;
                }

                $settings             = $this->get_settings();
                $value          = isset( $settings[ $section ][ $key ] ) ? $settings[ $section ][ $key ] : '';
                $default_value  = $this->get_default_value( $section, $key );
                $is_transparent = '' === $value || 'transparent' === strtolower( $value );
                $input_name     = self::OPTION_NAME . "[$section][$key]";
                ?>
                <div class="satori-global-settings__color-control<?php echo $is_transparent ? ' is-transparent' : ''; ?>" data-color-key="<?php echo esc_attr( $key ); ?>">
                        <input
                                type="text"
                                name="<?php echo esc_attr( $input_name ); ?>"
                                value="<?php echo esc_attr( $is_transparent ? '' : $value ); ?>"
                                class="wp-color-picker satori-global-color"
                                data-default-color="<?php echo esc_attr( $default_value ); ?>"
                                data-color-key="<?php echo esc_attr( $key ); ?>"
                                autocomplete="off"
                        />
                        <?php if ( $supports_transparent ) : ?>
                                <label class="satori-global-settings__transparent">
                                        <input
                                                type="checkbox"
                                                class="satori-global-color__transparent-toggle"
                                                <?php checked( $is_transparent ); ?>
                                        />
                                        <span><?php esc_html_e( 'Transparent', 'satori-studio' ); ?></span>
                                </label>
                        <?php endif; ?>
                </div>
                <?php
        }

        /**
         * Render a spacing input field with steppers.
         *
         * @param array $args Field arguments including section and key identifiers.
         * @return void
         */
        public function render_spacing_input_field( $args ) {
                $section = isset( $args['section'] ) ? $args['section'] : '';
                $key     = isset( $args['key'] ) ? $args['key'] : '';
                $type    = isset( $args['type'] ) ? $args['type'] : 'text';
                $step    = isset( $args['step'] ) ? (float) $args['step'] : 1;

                if ( empty( $section ) || empty( $key ) ) {
                        return;
                }

                $settings       = $this->get_settings();
                $value          = isset( $settings[ $section ][ $key ] ) ? $settings[ $section ][ $key ] : '';
                $default_value  = $this->get_default_value( $section, $key );
                $unit_hint      = $this->extract_unit( $value );

                if ( empty( $unit_hint ) ) {
                        $unit_hint = $this->extract_unit( $default_value );
                }
                ?>
                <div class="satori-spacing-control">
                        <div class="satori-spacing-control__stepper">
                                <button type="button" class="button satori-stepper__button" data-direction="decrement" aria-label="<?php esc_attr_e( 'Decrease value', 'satori-studio' ); ?>">-</button>
                                <input
                                        type="<?php echo esc_attr( $type ); ?>"
                                        name="<?php echo esc_attr( self::OPTION_NAME . "[$section][$key]" ); ?>"
                                        value="<?php echo esc_attr( $value ); ?>"
                                        class="regular-text satori-spacing-field"
                                        data-step="<?php echo esc_attr( $step ); ?>"
                                        data-unit="<?php echo esc_attr( $unit_hint ); ?>"
                                        data-default-value="<?php echo esc_attr( $default_value ); ?>"
                                />
                                <button type="button" class="button satori-stepper__button" data-direction="increment" aria-label="<?php esc_attr_e( 'Increase value', 'satori-studio' ); ?>">+</button>
                        </div>
                </div>
                <?php
        }

        /**
         * Render a lightweight preview card for the Global Settings inputs.
         *
         * @return void
         */
        private function render_preview_card() {
                $settings    = $this->get_settings();
                $colors      = isset( $settings['colors'] ) && is_array( $settings['colors'] ) ? $settings['colors'] : array();
                $typography  = isset( $settings['typography'] ) && is_array( $settings['typography'] ) ? $settings['typography'] : array();
                $spacing     = isset( $settings['spacing'] ) && is_array( $settings['spacing'] ) ? $settings['spacing'] : array();

                $color_chips = array(
                        'primary'         => __( 'Primary', 'satori-studio' ),
                        'accent'          => __( 'Accent', 'satori-studio' ),
                        'neutral_surface' => __( 'Surface', 'satori-studio' ),
                );

                $base_font_family = isset( $typography['base_font_family'] ) ? $typography['base_font_family'] : '';
                $base_font_size   = isset( $typography['base_font_size'] ) ? $typography['base_font_size'] : '';
                $heading_font     = isset( $typography['heading_font_family'] ) ? $typography['heading_font_family'] : '';

                $base_unit        = isset( $spacing['base_unit'] ) ? $spacing['base_unit'] : '';
                $section_padding  = isset( $spacing['section_padding_default'] ) ? $spacing['section_padding_default'] : '';
                ?>
                <div class="satori-global-settings__preview-card" role="presentation">
                        <div class="satori-global-settings__preview-header"><?php esc_html_e( 'Preview', 'satori-studio' ); ?></div>
                        <div class="satori-global-settings__preview-body">
                                <div class="satori-global-settings__preview-row satori-global-settings__preview-row--colors">
                                        <?php foreach ( $color_chips as $key => $label ) :
                                                $value          = isset( $colors[ $key ] ) ? $colors[ $key ] : '';
                                                $is_transparent = '' === $value || 'transparent' === strtolower( $value );
                                                $swatch_classes = 'satori-global-settings__chip-swatch';

                                                if ( $is_transparent ) {
                                                        $swatch_classes .= ' is-transparent';
                                                }

                                                ?>
                                                <div class="satori-global-settings__chip" data-color-key="<?php echo esc_attr( $key ); ?>">
                                                        <span class="<?php echo esc_attr( $swatch_classes ); ?>" style="<?php echo $is_transparent ? '' : 'background-color: ' . esc_attr( $value ) . ';'; ?>"></span>
                                                        <span class="satori-global-settings__chip-label"><?php echo esc_html( $label ); ?></span>
                                                        <?php if ( '' !== $value || $is_transparent ) : ?>
                                                                <span class="satori-global-settings__chip-value"><?php echo esc_html( $is_transparent ? __( 'Transparent', 'satori-studio' ) : $value ); ?></span>
                                                        <?php endif; ?>
                                                </div>
                                        <?php endforeach; ?>
                                </div>

                                <div
                                        class="satori-global-settings__typography-sample"
                                        style="font-family: <?php echo esc_attr( $base_font_family ); ?>; font-size: <?php echo esc_attr( $base_font_size ); ?>;"
                                >
                                        <div class="satori-global-settings__typography-eyebrow"><?php esc_html_e( 'Typography', 'satori-studio' ); ?></div>
                                        <div class="satori-global-settings__typography-heading"><?php esc_html_e( 'Studio preview', 'satori-studio' ); ?></div>
                                        <div class="satori-global-settings__typography-meta">
                                                <?php if ( '' !== $heading_font ) : ?>
                                                        <span><?php printf( esc_html__( 'Headings: %s', 'satori-studio' ), esc_html( $heading_font ) ); ?></span>
                                                <?php endif; ?>
                                                <?php if ( '' !== $base_font_size ) : ?>
                                                        <span><?php printf( esc_html__( 'Base size: %s', 'satori-studio' ), esc_html( $base_font_size ) ); ?></span>
                                                <?php endif; ?>
                                        </div>
                                </div>

                                <div class="satori-global-settings__spacing-hint">
                                        <div class="satori-global-settings__spacing-title"><?php esc_html_e( 'Spacing', 'satori-studio' ); ?></div>
                                        <div class="satori-global-settings__spacing-meta">
                                                <?php if ( '' !== $base_unit ) : ?>
                                                        <span><?php printf( esc_html__( 'Base unit: %s', 'satori-studio' ), esc_html( $base_unit ) ); ?></span>
                                                <?php endif; ?>
                                                <?php if ( '' !== $section_padding ) : ?>
                                                        <span><?php printf( esc_html__( 'Section padding: %s', 'satori-studio' ), esc_html( $section_padding ) ); ?></span>
                                                <?php endif; ?>
                                        </div>
                                </div>
                        </div>
                </div>
                <?php
        }

        /**
         * Sanitize the global settings payload.
         *
         * @param array|string $input Raw input from the settings form.
         * @return array<string, array<string, string>>
         */
        public function sanitize_settings( $input ) {
                $defaults   = $this->get_defaults();
                $sanitized  = $defaults;

                if ( ! is_array( $input ) ) {
                        return $sanitized;
                }

                $sections = array( 'colors', 'typography', 'spacing' );

                foreach ( $sections as $section ) {
                        if ( ! isset( $defaults[ $section ] ) ) {
                                continue;
                        }

                        $section_input = isset( $input[ $section ] ) && is_array( $input[ $section ] ) ? $input[ $section ] : array();

                        foreach ( $defaults[ $section ] as $key => $default_value ) {
                                if ( isset( $section_input[ $key ] ) ) {
                                        $raw_value = wp_unslash( $section_input[ $key ] );

                                        if ( 'colors' === $section ) {
                                                $sanitized[ $section ][ $key ] = $this->sanitize_color_value( $raw_value, true );
                                                continue;
                                        }

                                        $sanitized[ $section ][ $key ] = sanitize_text_field( $raw_value );
                                }
                        }
                }

                return $sanitized;
        }

        /**
         * Retrieve the merged settings array with defaults applied.
         *
         * @return array<string, array<string, string>>
         */
        public function get_settings() {
                $defaults = $this->get_defaults();
                $stored   = get_option( self::OPTION_NAME, array() );

                if ( ! is_array( $stored ) ) {
                        $stored = array();
                }

                $settings = array();

                foreach ( $defaults as $section => $values ) {
                        $saved_section    = isset( $stored[ $section ] ) && is_array( $stored[ $section ] ) ? $stored[ $section ] : array();
                        $settings[ $section ] = array_merge( $values, $saved_section );
                }

                return $settings;
        }

        /**
         * Sanitize a color value, allowing a transparent sentinel.
         *
         * @param string $value             Raw value from the request.
         * @param bool   $allow_transparent Whether to allow the transparent sentinel.
         * @return string
         */
        private function sanitize_color_value( $value, $allow_transparent = false ) {
                $raw_value = is_string( $value ) ? trim( $value ) : '';

                if ( '' === $raw_value ) {
                        return '';
                }

                if ( $allow_transparent && 'transparent' === strtolower( $raw_value ) ) {
                        return 'transparent';
                }

                $raw_value = ltrim( $raw_value, '#' );
                $sanitized = sanitize_hex_color( '#' . $raw_value );

                return $sanitized ? $sanitized : '';
        }

        /**
         * Render the Global Settings link into the Beaver Builder admin nav.
         *
         * The Beaver Builder settings nav only renders an unordered list. This
         * helper injects a contextual link to the SATORI Studio Global Settings
         * screen without altering Beaver Builder Lite internals.
         *
         * @return void
         */
        public function render_settings_nav_link() {
                if ( ! $this->should_expose_ui() ) {
                        return;
                }

                if ( ! $this->is_builder_settings_screen() ) {
                        return;
                }

                printf(
                        '<li class="satori-studio-global-settings-link"><a href="#%1$s">%2$s</a></li>',
                        esc_attr( self::TAB_SLUG ),
                        esc_html__( 'Global Settings', 'satori-studio' )
                );
        }

        /**
         * Redirect requests from the legacy standalone slug to the tabbed settings shell.
         *
         * @return void
         */
        public function redirect_legacy_page() {
                if ( ! isset( $_GET['page'] ) ) {
                        return;
                }

                $requested_page = sanitize_key( wp_unslash( $_GET['page'] ) );

                if ( self::LEGACY_PAGE_SLUG !== $requested_page ) {
                        return;
                }

                if ( ! current_user_can( $this->get_capability() ) ) {
                        return;
                }

                wp_safe_redirect( $this->get_settings_redirect_url() );
                exit;
        }

        /**
         * Define the capability required to access the Global Settings page.
         *
         * @param string $capability Capability string aligned to the parent settings page.
         * @return void
         */
        public function set_capability( $capability ) {
                if ( ! is_string( $capability ) || empty( $capability ) ) {
                        return;
                }

                $this->capability = $capability;
        }

        /**
         * Retrieve the capability required to access the Global Settings page.
         *
         * @return string
         */
        public function get_capability() {
                return apply_filters( 'satori_studio_global_settings_capability', $this->capability );
        }

        /**
         * Determine whether the current admin request is for the Global Settings tab.
         *
         * @return bool
         */
        private function is_global_settings_screen() {
                if ( ! $this->is_builder_settings_screen() ) {
                        return false;
                }

                $page = isset( $_GET['page'] ) ? sanitize_key( wp_unslash( $_GET['page'] ) ) : '';

                if ( self::PARENT_SLUG !== $page ) {
                        return false;
                }

                $tab = isset( $_GET['tab'] ) ? sanitize_key( wp_unslash( $_GET['tab'] ) ) : '';

                if ( '' !== $tab && self::TAB_SLUG !== $tab ) {
                        return false;
                }

                return true;
        }

        /**
         * Determine whether the current admin screen is the Beaver Builder settings page.
         *
         * @return bool
         */
        private function is_builder_settings_screen() {
                if ( ! function_exists( 'get_current_screen' ) ) {
                        return false;
                }

                $screen = get_current_screen();

                if ( ! $screen ) {
                        return false;
                }

                $needles = array(
                        'fl-builder-settings',
                        'fl-builder-multisite-settings',
                        'fl-builder',
                        'satori-studio',
                );

                foreach ( $needles as $needle ) {
                        if ( false !== strpos( $screen->id, $needle ) || false !== strpos( $screen->base, $needle ) ) {
                                return true;
                        }
                }

                return false;
        }

        /**
         * Determine whether the Global Settings UI should be exposed.
         *
         * @return bool
         */
        private function should_expose_ui() {
                $visible = false;

                /**
                 * Filter whether the Global Settings admin UI should be exposed.
                 *
                 * @param bool $visible Whether to render the Global Settings UI.
                 */
                return (bool) apply_filters( 'satori_studio_show_global_settings_ui', $visible );
        }

        /**
         * Redirect attempts to access the hidden Global Settings tab.
         *
         * @return void
         */
        public function redirect_hidden_tab() {
                if ( $this->should_expose_ui() ) {
                        return;
                }

                if ( ! isset( $_GET['page'] ) ) {
                        return;
                }

                $page = sanitize_key( wp_unslash( $_GET['page'] ) );

                if ( self::PARENT_SLUG !== $page ) {
                        return;
                }

                $tab = isset( $_GET['tab'] ) ? sanitize_key( wp_unslash( $_GET['tab'] ) ) : '';

                if ( self::TAB_SLUG !== $tab ) {
                        return;
                }

                $capability = $this->get_capability();

                if ( ! current_user_can( $capability ) ) {
                        return;
                }

                wp_safe_redirect( $this->get_settings_redirect_url() );
                exit;
        }

        /**
         * Retrieve the redirect target for settings requests.
         *
         * @return string
         */
        private function get_settings_redirect_url() {
                $redirect_url = add_query_arg(
                        array(
                                'page' => self::PARENT_SLUG,
                        ),
                        admin_url( 'admin.php' )
                );

                if ( $this->should_expose_ui() ) {
                        $redirect_url .= '#' . self::TAB_SLUG;
                }

                return $redirect_url;
        }

        /**
         * Retrieve default settings seeded from the design system tokens.
         *
         * @return array<string, array<string, string>>
         */
        public function get_defaults() {
                if ( null !== $this->defaults ) {
                        return $this->defaults;
                }

                $colors     = $this->design_system->get_color_palette();
                $spacing    = $this->design_system->get_spacing_scale();
                $typography = $this->design_system->get_typography_scale();

                $default_font_family = "'Inter', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif";

                $this->defaults = array(
                        'colors' => array(
                                'primary'            => isset( $colors['primary'] ) ? $colors['primary'] : '#1D4ED8',
                                'accent'             => isset( $colors['accent'] ) ? $colors['accent'] : '#0EA5E9',
                                'neutral_background' => isset( $colors['neutral-100'] ) ? $colors['neutral-100'] : '#F3F4F6',
                                'neutral_surface'    => isset( $colors['neutral-200'] ) ? $colors['neutral-200'] : '#E5E7EB',
                                'neutral_border'     => isset( $colors['neutral-300'] ) ? $colors['neutral-300'] : '#D1D5DB',
                        ),
                        'typography' => array(
                                'base_font_family'    => $default_font_family,
                                'base_font_size'      => isset( $typography['base'] ) ? $typography['base'] : '1rem',
                                'heading_font_family' => $default_font_family,
                        ),
                        'spacing' => array(
                                'base_unit'              => isset( $spacing['sm'] ) ? $spacing['sm'] : '8px',
                                'section_padding_default' => isset( $spacing['xl'] ) ? $spacing['xl'] : '24px',
                        ),
                );

                return $this->defaults;
        }

        /**
         * Retrieve an individual default value for a settings key.
         *
         * @param string $section Settings section key.
         * @param string $key     Field key.
         * @return string
         */
        private function get_default_value( $section, $key ) {
                $defaults = $this->get_defaults();

                if ( isset( $defaults[ $section ][ $key ] ) ) {
                        return $defaults[ $section ][ $key ];
                }

                return '';
        }

        /**
         * Extract the trailing unit from a numeric value string.
         *
         * @param string $value Value to parse.
         * @return string
         */
        private function extract_unit( $value ) {
                if ( ! is_string( $value ) || '' === $value ) {
                        return '';
                }

                if ( preg_match( '/[\d.]+\s*([a-z%]+)$/i', $value, $matches ) && isset( $matches[1] ) ) {
                        return $matches[1];
                }

                return '';
        }

        /**
         * Render introductory text for the Colors section.
         *
         * @return void
         */
        public function render_colors_section_intro() {
                echo '<p class="description">' . esc_html__( 'Define primary and neutral palette values. These are simple hex strings for now.', 'satori-studio' ) . '</p>';
        }

        /**
         * Render introductory text for the Typography section.
         *
         * @return void
         */
        public function render_typography_section_intro() {
                echo '<p class="description">' . esc_html__( 'Set base typography defaults such as font families and base size.', 'satori-studio' ) . '</p>';
        }

        /**
         * Render introductory text for the Spacing section.
         *
         * @return void
         */
        public function render_spacing_section_intro() {
                echo '<p class="description">' . esc_html__( 'Spacing values align to the design system scale and are stored for future use.', 'satori-studio' ) . '</p>';
        }
}
