<?php
/* -------------------------------------------------
 * SATORI Studio — Admin Branding Settings
 * -------------------------------------------------*/

declare(strict_types=1);

namespace Satori_Studio\Admin;

use Satori_Studio\Core\Environment;

/**
 * Admin handler for the SATORI Studio Branding tab.
 *
 * Responsibilities:
 * - Register and sanitize branding options (brand mark attachment + admin accent color).
 * - Render the Branding tab inside the existing settings shell.
 * - Provide canonical helpers for retrieving branding values with fallbacks.
 * - Scope all assets and styling to SATORI Studio admin surfaces only.
 */
class Branding {

        /**
         * Option name used to persist admin branding settings.
         */
        const OPTION_NAME = 'satori_studio_admin_branding';

        /**
         * Settings group identifier.
         */
        const OPTION_GROUP = 'satori_studio_admin_branding_group';

        /**
         * Tab slug used within the Beaver Builder settings shell.
         */
        const TAB_SLUG = 'satori-admin-branding';

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
         * Capability required to manage admin branding.
         *
         * @var string
         */
        private $capability = 'manage_options';

        /**
         * Singleton-like reference to the active instance.
         *
         * @var Branding|null
         */
        private static $instance = null;

        /**
         * Track whether hooks are registered.
         *
         * @var bool
         */
        private $initialized = false;

        /**
         * Constructor.
         *
         * @param Environment $environment Core environment metadata.
         */
        public function __construct( Environment $environment ) {
                $this->environment = $environment;
                self::$instance    = $this;
        }

        /**
         * Retrieve the active Branding instance.
         *
         * @return Branding|null
         */
        public static function instance() {
                return self::$instance;
        }

        /**
         * Bootstrap settings registration, rendering, and assets.
         *
         * @return void
         */
        public function init() {
                if ( $this->initialized ) {
                        return;
                }

                $this->initialized = true;

                add_action( 'admin_init', array( $this, 'register_settings' ) );
                add_action( 'fl_builder_admin_settings_nav_after', array( $this, 'render_nav_link' ), 11 );
                add_action( 'fl_builder_admin_settings_render_forms', array( $this, 'render_settings_panel' ) );
                add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_assets' ) );
        }

        /**
         * Register the admin branding option and sanitize callbacks.
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
        }

        /**
         * Sanitize branding settings before saving.
         *
         * @param array $settings Raw settings array from the request.
         * @return array
         */
        public function sanitize_settings( $settings ) {
                $sanitized   = $this->get_defaults();
                $settings    = is_array( $settings ) ? $settings : array();
                $attachment  = isset( $settings['mark_attachment_id'] ) ? absint( $settings['mark_attachment_id'] ) : 0;
                $adminAccent = isset( $settings['admin_accent'] ) ? $settings['admin_accent'] : '';

                $sanitized['mark_attachment_id'] = $attachment;
                $sanitized['admin_accent']       = $this->sanitize_hex_value( $adminAccent );

                return $sanitized;
        }

        /**
         * Retrieve the persisted branding configuration merged with defaults.
         *
         * @return array
         */
        public function get_branding() {
                $stored    = get_option( self::OPTION_NAME, array() );
                $defaults  = $this->get_defaults();
                $branding  = is_array( $stored ) ? array_merge( $defaults, $stored ) : $defaults;

                $branding['mark_attachment_id'] = absint( $branding['mark_attachment_id'] );
                $branding['admin_accent']       = $this->sanitize_hex_value( $branding['admin_accent'] );

                /**
                 * Filter the admin branding configuration.
                 *
                 * @param array $branding Branding configuration.
                 */
                return apply_filters( 'satori_studio_admin_branding', $branding );
        }

        /**
         * Retrieve the admin accent color, sanitized.
         *
         * @return string
         */
        public function get_admin_accent() {
                $branding = $this->get_branding();

                return isset( $branding['admin_accent'] ) ? $branding['admin_accent'] : '';
        }

        /**
         * Retrieve the brand mark URL with a fallback placeholder.
         *
         * @return string
         */
        public function get_brand_mark_url() {
                $branding = $this->get_branding();
                $mark_id  = isset( $branding['mark_attachment_id'] ) ? absint( $branding['mark_attachment_id'] ) : 0;
                $url      = '';

                if ( $mark_id ) {
                        $url = wp_get_attachment_image_url( $mark_id, 'full' );
                }

                if ( empty( $url ) ) {
                        $url = $this->get_placeholder_brand_mark();
                }

                /**
                 * Filter the admin brand mark URL.
                 *
                 * @param string $url      Brand mark URL after fallbacks.
                 * @param array  $branding Branding configuration.
                 */
                return apply_filters( 'satori_studio_admin_brand_mark_url', $url, $branding );
        }

        /**
         * Determine whether the current request is on the Branding tab.
         *
         * @return bool
         */
        private function is_branding_screen() {
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
         * Enqueue assets required for the Branding tab and inject accent styling.
         *
         * @return void
         */
        public function enqueue_admin_assets() {
                if ( $this->is_builder_settings_screen() ) {
                        wp_enqueue_media();
                        wp_enqueue_style( 'wp-color-picker' );
                        wp_enqueue_script( 'wp-color-picker' );

                        wp_enqueue_script(
                                'satori-studio-admin-branding',
                                $this->environment->get_plugin_url() . 'assets/js/admin-branding.js',
                                array( 'jquery', 'wp-color-picker', 'media-editor' ),
                                $this->environment->get_version(),
                                true
                        );
                }

                if ( $this->is_satori_admin_screen() ) {
                        $accent = $this->get_admin_accent();
                        $css    = '';

                        if ( ! empty( $accent ) ) {
                                $css = sprintf( 'body.satori-studio-admin { --satori-admin-accent: %s; }', esc_attr( $accent ) );
                        }

                        if ( ! empty( $css ) ) {
                                wp_add_inline_style( 'satori-studio-admin', $css );
                        }
                }
        }

        /**
         * Render the Branding link inside the Beaver Builder settings nav.
         *
         * @return void
         */
        public function render_nav_link() {
                if ( ! $this->is_builder_settings_screen() ) {
                        return;
                }

                printf(
                        '<li class="satori-studio-branding-link"><a href="#%1$s">%2$s</a></li>',
                        esc_attr( self::TAB_SLUG ),
                        esc_html__( 'Branding', 'satori-studio' )
                );
        }

        /**
         * Render the Branding tab panel.
         *
         * @return void
         */
        public function render_settings_panel() {
                $capability = $this->get_capability();

                if ( ! $this->is_builder_settings_screen() ) {
                        return;
                }

                if ( ! current_user_can( $capability ) ) {
                        return;
                }

                $branding    = $this->get_branding();
                $brand_mark  = $this->get_brand_mark_url();
                $placeholder = $this->get_placeholder_brand_mark();
                $accent      = isset( $branding['admin_accent'] ) ? $branding['admin_accent'] : '';
                $attachment  = isset( $branding['mark_attachment_id'] ) ? absint( $branding['mark_attachment_id'] ) : 0;
                ?>
                <div id="fl-<?php echo esc_attr( self::TAB_SLUG ); ?>-form" class="fl-settings-form satori-admin-branding">
                        <h3 class="fl-settings-form-header"><?php esc_html_e( 'Branding', 'satori-studio' ); ?></h3>
                        <form action="options.php" method="post">
                                <div class="fl-settings-form-content">
                                        <p class="description">
                                                <?php esc_html_e( "Upload a logo and optional accent color used only in SATORI Studio's admin screens. This does not change your website design or front-end styles.", 'satori-studio' ); ?>
                                        </p>

                                        <?php settings_fields( self::OPTION_GROUP ); ?>

                                        <div class="satori-admin-branding__field satori-admin-branding__brand-mark">
                                                <label class="satori-admin-branding__label" for="satori_studio_admin_branding_mark_attachment_id">
                                                        <?php esc_html_e( 'Brand mark', 'satori-studio' ); ?>
                                                </label>
                                                <div class="satori-admin-branding__logo-control">
                                                        <div class="satori-admin-branding__logo-preview" aria-live="polite">
                                                                <img
                                                                        src="<?php echo esc_url( $brand_mark ); ?>"
                                                                        data-placeholder="<?php echo esc_url( $placeholder ); ?>"
                                                                        alt="<?php esc_attr_e( 'Brand mark preview', 'satori-studio' ); ?>"
                                                                />
                                                        </div>
                                                        <div class="satori-admin-branding__logo-actions">
                                                                <input
                                                                        type="hidden"
                                                                        id="satori_studio_admin_branding_mark_attachment_id"
                                                                        name="<?php echo esc_attr( self::OPTION_NAME . '[mark_attachment_id]' ); ?>"
                                                                        value="<?php echo esc_attr( $attachment ); ?>"
                                                                />
                                                                <button type="button" class="button satori-admin-branding__choose">
                                                                        <?php esc_html_e( 'Choose logo', 'satori-studio' ); ?>
                                                                </button>
                                                                <button type="button" class="button button-link-delete satori-admin-branding__remove" <?php disabled( 0, $attachment ); ?>>
                                                                        <?php esc_html_e( 'Remove logo', 'satori-studio' ); ?>
                                                                </button>
                                                        </div>
                                                </div>
                                        </div>

                                        <div class="satori-admin-branding__field satori-admin-branding__accent">
                                                <label class="satori-admin-branding__label" for="satori_studio_admin_branding_accent">
                                                        <?php esc_html_e( 'Admin accent color (optional)', 'satori-studio' ); ?>
                                                </label>
                                                <input
                                                        type="text"
                                                        id="satori_studio_admin_branding_accent"
                                                        class="regular-text satori-admin-branding__accent-input"
                                                        name="<?php echo esc_attr( self::OPTION_NAME . '[admin_accent]' ); ?>"
                                                        value="<?php echo esc_attr( $accent ); ?>"
                                                        placeholder="<?php echo esc_attr( '#0EA5E9' ); ?>"
                                                />
                                                <p class="description satori-admin-branding__hint">
                                                        <?php esc_html_e( 'Applied only to SATORI Studio admin UI accents.', 'satori-studio' ); ?>
                                                </p>
                                        </div>
                                </div>
                                <?php submit_button( __( 'Save Changes', 'satori-studio' ) ); ?>
                        </form>
                </div>
                <?php
        }

        /**
         * Provide default branding values.
         *
         * @return array
         */
        private function get_defaults() {
                return array(
                        'mark_attachment_id' => 0,
                        'admin_accent'      => '',
                );
        }

        /**
         * Sanitize a hex color value while allowing empty strings.
         *
         * @param string $value Raw hex string.
         * @return string
         */
        private function sanitize_hex_value( $value ) {
                $value = is_string( $value ) ? trim( $value ) : '';

                if ( '' === $value ) {
                        return '';
                }

                $value = ltrim( $value, '#' );
                $value = sanitize_hex_color( '#' . $value );

                return $value ? $value : '';
        }

        /**
         * Retrieve the placeholder brand mark URL.
         *
         * @return string
         */
        private function get_placeholder_brand_mark() {
                return $this->environment->get_plugin_url() . 'img/beaver.png';
        }

        /**
         * Define the capability required to access the Branding tab.
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
         * Retrieve the capability required to access the Branding tab.
         *
         * @return string
         */
        public function get_capability() {
                return apply_filters( 'satori_studio_admin_branding_capability', $this->capability );
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
         * Determine whether the current admin request belongs to SATORI Studio screens.
         *
         * @return bool
         */
        private function is_satori_admin_screen() {
                if ( ! function_exists( 'get_current_screen' ) ) {
                        return false;
                }

                $screen = get_current_screen();

                if ( ! $screen ) {
                        return false;
                }

                $needles = array(
                        'fl-builder',
                        'satori-studio',
                        $this->environment->get_slug(),
                );

                foreach ( $needles as $needle ) {
                        if ( empty( $needle ) ) {
                                continue;
                        }

                        if ( false !== strpos( $screen->id, $needle ) || false !== strpos( $screen->base, $needle ) ) {
                                return true;
                        }
                }

                return false;
        }
}
