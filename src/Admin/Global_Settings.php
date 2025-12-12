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
         * Menu slug for the settings page.
         */
        const MENU_SLUG = 'satori-studio-global-settings';

        /**
         * Parent menu slug for the SATORI Studio admin menu.
         */
        const PARENT_SLUG = 'fl-builder-settings';

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
         * Constructor.
         *
         * @param Environment  $environment   Core environment metadata.
         * @param DesignSystem $design_system Design system tokens service.
         */
        public function __construct( Environment $environment, DesignSystem $design_system ) {
                $this->environment   = $environment;
                $this->design_system = $design_system;
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
                add_action( 'fl_builder_admin_settings_nav_after', array( $this, 'render_settings_nav_link' ) );
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
                        self::MENU_SLUG
                );

                $color_fields = array(
                        'primary'            => __( 'Primary color', 'satori-studio' ),
                        'accent'             => __( 'Accent color', 'satori-studio' ),
                        'neutral_background' => __( 'Neutral background', 'satori-studio' ),
                        'neutral_surface'    => __( 'Neutral surface', 'satori-studio' ),
                        'neutral_border'     => __( 'Neutral border', 'satori-studio' ),
                );

                foreach ( $color_fields as $key => $label ) {
                        add_settings_field(
                                'satori_studio_global_settings_color_' . $key,
                                $label,
                                array( $this, 'render_text_input_field' ),
                                self::MENU_SLUG,
                                'satori_studio_global_settings_colors',
                                array(
                                        'section' => 'colors',
                                        'key'     => $key,
                                        'type'    => 'text',
                                        'placeholder' => '#000000',
                                )
                        );
                }

                add_settings_section(
                        'satori_studio_global_settings_typography',
                        __( 'Typography', 'satori-studio' ),
                        array( $this, 'render_typography_section_intro' ),
                        self::MENU_SLUG
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
                                self::MENU_SLUG,
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
                        self::MENU_SLUG
                );

                $spacing_fields = array(
                        'base_unit'              => __( 'Base unit', 'satori-studio' ),
                        'section_padding_default'=> __( 'Section padding default', 'satori-studio' ),
                );

                foreach ( $spacing_fields as $key => $label ) {
                        add_settings_field(
                                'satori_studio_global_settings_spacing_' . $key,
                                $label,
                                array( $this, 'render_text_input_field' ),
                                self::MENU_SLUG,
                                'satori_studio_global_settings_spacing',
                                array(
                                        'section' => 'spacing',
                                        'key'     => $key,
                                        'type'    => 'text',
                                )
                        );
                }
        }

        /**
         * Render the main settings page markup.
         *
         * @return void
         */
        public function render_page() {
                $this->render_settings_page();
        }

        /**
         * Render the main settings page markup.
         *
         * @return void
         */
        public function render_settings_page() {
                if ( ! current_user_can( 'manage_options' ) ) {
                        wp_die( esc_html__( 'Sorry, you are not allowed to access this page.', 'satori-studio' ) );
                }

                ?>
                <div class="wrap satori-global-settings">
                        <h1><?php esc_html_e( 'SATORI Studio — Global Settings', 'satori-studio' ); ?></h1>
                        <p class="description">
                                <?php esc_html_e( 'Configure global color, typography, and spacing tokens. Phase 2E stores these values without altering front-end rendering or builder defaults.', 'satori-studio' ); ?>
                        </p>
                        <form action="options.php" method="post">
                                <?php settings_fields( self::OPTION_GROUP ); ?>
                                <?php do_settings_sections( self::MENU_SLUG ); ?>
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
                        class="regular-text"
                        placeholder="<?php echo esc_attr( $placeholder ); ?>"
                />
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
                                        $sanitized[ $section ][ $key ] = sanitize_text_field( wp_unslash( $section_input[ $key ] ) );
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
         * Render the Global Settings link into the Beaver Builder admin nav.
         *
         * The Beaver Builder settings nav only renders an unordered list. This
         * helper injects a contextual link to the SATORI Studio Global Settings
         * screen without altering Beaver Builder Lite internals.
         *
         * @return void
         */
        public function render_settings_nav_link() {
                if ( ! $this->is_builder_settings_screen() ) {
                        return;
                }

                $url  = admin_url( 'admin.php?page=' . self::MENU_SLUG );
                $text = esc_html__( 'Global Settings', 'satori-studio' );

                printf(
                        '<li class="satori-studio-global-settings-link"><a href="%1$s">%2$s</a></li>',
                        esc_url( $url ),
                        $text
                );
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
         * Retrieve default settings seeded from the design system tokens.
         *
         * @return array<string, array<string, string>>
         */
        public function get_defaults() {
                $colors     = $this->design_system->get_color_palette();
                $spacing    = $this->design_system->get_spacing_scale();
                $typography = $this->design_system->get_typography_scale();

                $default_font_family = "'Inter', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif";

                return array(
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
