<?php
declare(strict_types=1);
/* -------------------------------------------------
 * SATORI Studio — Admin Integration
 * -------------------------------------------------*/

namespace Satori_Studio\Core;

use Satori_Studio\Admin\Global_Settings;
use WP_Screen;

class Admin {

        /**
         * Legacy Beaver Builder settings slug leveraged for the SATORI Studio menu.
         */
        private const SETTINGS_SLUG = 'fl-builder-settings';

        /**
         * Core environment metadata.
         *
         * @var Environment
         */
        private $environment;

        /**
         * Design system tokens service.
         *
         * @var DesignSystem
         */
        private $design_system;

        /**
         * Global settings admin handler.
         *
         * @var Global_Settings|null
         */
        private $global_settings = null;

        /**
         * Prevents hooks from registering multiple times.
         *
         * @var bool
         */
        private static $initialized = false;

        /**
         * Constructor.
         *
         * @param Environment  $environment   Core environment metadata.
         * @param DesignSystem $design_system Design system tokens service.
         */
        public function __construct( Environment $environment, DesignSystem $design_system ) {
                $this->environment   = $environment;
                $this->design_system = $design_system;
                $this->global_settings = new Global_Settings( $environment, $design_system );

                $this->init();
        }

        /**
         * Register admin hooks for the plugin.
         *
         * @return void
         */
        public function init() {
                if ( self::$initialized || ! is_admin() ) {
                        return;
                }

                self::$initialized = true;

                add_filter( 'admin_body_class', array( $this, 'append_body_class' ) );
                add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_tokens' ) );
                add_action( 'admin_menu', array( $this, 'register_menus' ) );
                add_action( 'admin_menu', array( __CLASS__, 'remove_legacy_settings_submenu' ), 99 );

                $this->global_settings->init();
        }

        /**
         * Append the SATORI Studio admin class on applicable screens.
         *
         * @param string $classes Admin body classes string.
         * @return string
         */
        public function append_body_class( $classes ) {
                $screen = $this->get_current_screen();

                if ( ! $this->is_satori_screen( $screen ) ) {
                        return $classes;
                }

                if ( false === strpos( $classes, 'satori-studio-admin' ) ) {
                        $classes .= ' satori-studio-admin';
                }

                return $classes;
        }

        /**
         * Enqueue admin token stylesheet on SATORI Studio screens.
         *
         * @return void
         */
        public function enqueue_admin_tokens() {
                $screen = $this->get_current_screen();

                if ( ! $this->is_satori_screen( $screen ) ) {
                        return;
                }

                wp_enqueue_style(
                        'satori-studio-admin',
                        $this->environment->get_plugin_url() . 'assets/css/admin.css',
                        array(),
                        $this->environment->get_version()
                );
        }

        /**
         * Determine whether the current screen belongs to SATORI Studio.
         *
         * @param WP_Screen|null $screen Current screen instance.
         * @return bool
         */
        private function is_satori_screen( $screen ) {
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

        /**
         * Safely retrieve the current screen.
         *
         * @return WP_Screen|null
         */
        private function get_current_screen() {
                if ( function_exists( 'get_current_screen' ) ) {
                        return get_current_screen();
                }

                return null;
        }

        /**
         * Register the SATORI Studio menu.
         *
         * @return void
         */
        public function register_menus() {
                if ( ! $this->global_settings ) {
                        return;
                }

                $capability    = 'manage_options';
                $settings_slug = self::SETTINGS_SLUG;

                $this->global_settings->set_capability( $capability );

                $global_settings_capability = $this->global_settings->get_capability();

                global $admin_page_hooks;

                if ( ! isset( $admin_page_hooks[ $settings_slug ] ) ) {
                        add_menu_page(
                                __( 'SATORI Studio Settings', 'satori-studio' ),
                                __( 'SATORI Studio', 'satori-studio' ),
                                $capability,
                                $settings_slug,
                                array( '\\FLBuilderAdminSettings', 'render' ),
                                'dashicons-admin-customizer'
                        );
                }

                add_submenu_page(
                        $settings_slug,
                        __( 'SATORI Studio Settings', 'satori-studio' ),
                        __( 'SATORI Studio', 'satori-studio' ),
                        $capability,
                        $settings_slug,
                        array( '\\FLBuilderAdminSettings', 'render' )
                );

                add_submenu_page(
                        $settings_slug,
                        __( 'Global Settings', 'satori-studio' ),
                        __( 'Global Settings', 'satori-studio' ),
                        $global_settings_capability,
                        Global_Settings::MENU_SLUG,
                        array( $this->global_settings, 'render_settings_page' )
                );

                // Hide the Global Settings submenu entry from the WordPress sidebar while keeping the page registered.
                remove_submenu_page( $settings_slug, Global_Settings::MENU_SLUG );
                // Global Settings is intentionally accessible only via the in-app sidebar link
                // within the SATORI Studio Settings screen and by direct URL.
        }

        /**
         * Remove the legacy Settings → SATORI Studio submenu registered by the legacy settings page.
         *
         * @return void
         */
        public static function remove_legacy_settings_submenu(): void {
                remove_submenu_page( 'options-general.php', 'fl-builder-settings' );
        }
}
