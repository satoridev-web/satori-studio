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
         * Register the SATORI Studio menu and Global Settings submenu.
         *
         * @return void
         */
        public function register_menus() {
                if ( ! $this->global_settings ) {
                        return;
                }

                $capability  = 'manage_options';
                $parent_slug = $this->environment->get_slug();

                if ( empty( $parent_slug ) ) {
                        $parent_slug = Global_Settings::PARENT_SLUG;
                }

                global $admin_page_hooks;

                if ( ! isset( $admin_page_hooks[ $parent_slug ] ) ) {
                        add_menu_page(
                                __( 'SATORI Studio', 'satori-studio' ),
                                __( 'SATORI Studio', 'satori-studio' ),
                                $capability,
                                $parent_slug,
                                array( $this->global_settings, 'render_settings_page' ),
                                'dashicons-admin-customizer'
                        );
                }

                add_submenu_page(
                        $parent_slug,
                        __( 'SATORI Studio — Global Settings', 'satori-studio' ),
                        __( 'Global Settings', 'satori-studio' ),
                        $capability,
                        Global_Settings::MENU_SLUG,
                        array( $this->global_settings, 'render_settings_page' )
                );
        }
}
