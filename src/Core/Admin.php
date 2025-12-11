<?php
declare(strict_types=1);
/* -------------------------------------------------
 * SATORI Studio — Admin Integration
 * -------------------------------------------------*/

namespace Satori_Studio\Core;

use WP_Screen;

class Admin {

        /**
         * Core environment metadata.
         *
         * @var Environment
         */
        private $environment;

        /**
         * Constructor.
         *
         * @param Environment $environment Core environment metadata.
         */
        public function __construct( Environment $environment ) {
                $this->environment = $environment;

                if ( ! is_admin() ) {
                        return;
                }

                add_filter( 'admin_body_class', array( $this, 'append_body_class' ) );
                add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_tokens' ) );
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
}
