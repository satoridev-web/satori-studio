<?php
/**
 * Plugin Name:       SATORI Studio
 * Plugin URI:        https://satori.com.au/satori-studio
 * Description:       SATORI Studio delivers a drag and drop frontend WordPress page builder that works with almost any theme. Maintained by Satori Graphics Pty Ltd. Forked from Beaver Builder Lite by The Beaver Builder Team and distributed under the GPL v2+ license.
 * Version:           2.9.4.1
 * Author:            Satori Graphics Pty Ltd
 * Author URI:        https://satoristudio.com/
 * Text Domain:       satori-studio
 * Domain Path:       /languages
 * License:           GPL-2.0-or-later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.html
 * Requires at least: 5.2
 * Tested up to:      6.9
 * Requires PHP:      7.0
 *
 * Fork Origin:       Beaver Builder Lite by The Beaver Builder Team (FastLine Media LLC).
 *
 * @package Satori_Studio
 */

require_once __DIR__ . '/src/autoload.php';

\Satori_Studio\Core\Plugin::init( __FILE__ );

/* -------------------------------------------------
 * Core helper API — bootstrap + service accessors
 * -------------------------------------------------*/

if ( ! function_exists( 'satori_studio' ) ) {
        /**
         * Retrieve the SATORI Studio core plugin instance.
         *
         * Safe to call after the main plugin file has loaded; subsequent calls
         * reuse the same singleton instance.
         *
         * @return \Satori_Studio\Core\Plugin
         */
        function satori_studio() {
                return \Satori_Studio\Core\Plugin::init( __FILE__ );
        }
}

if ( ! function_exists( 'satori_studio_service' ) ) {
        /**
         * Retrieve a service from the SATORI Studio core container.
         *
         * Intended for use after plugin bootstrap (e.g. on or after
         * `plugins_loaded`). Known service IDs include 'environment' for core
         * metadata; future services will follow the same pattern.
         *
         * @param string $id Service identifier.
         * @return mixed|null Returns the service instance if defined; null when
         *                    the ID is unknown.
         */
        function satori_studio_service( $id ) {
                return satori_studio()->service( $id );
        }
}

if ( ! function_exists( 'satori_studio_env' ) ) {
        /**
         * Convenience wrapper to access the core Environment service.
         *
         * Returns null when the service container is unavailable (for example
         * if called before the helper functions are defined).
         *
         * @return \Satori_Studio\Core\Environment|null
         */
        function satori_studio_env() {
                return function_exists( 'satori_studio_service' )
                        ? satori_studio_service( 'environment' )
                        : null;
        }
}

if ( ! function_exists( 'satori_studio_environment' ) ) {
        /**
         * Alias for satori_studio_env() to match descriptive naming styles.
         *
         * @return \Satori_Studio\Core\Environment|null
         */
        function satori_studio_environment() {
                return satori_studio_env();
        }
}

if ( ! function_exists( 'satori_studio_design_system' ) ) {
        /**
         * Convenience wrapper to access the DesignSystem service.
         *
         * Returns null when the service container is unavailable. The service is
         * read-only and safe for use inside filters/actions when consuming design
         * tokens. Future phases will connect these tokens to CSS/JS outputs and
         * builder controls.
         *
         * @return \Satori_Studio\Core\DesignSystem|null
         */
        function satori_studio_design_system() {
                return function_exists( 'satori_studio_service' )
                        ? satori_studio_service( 'design_system' )
                        : null;
        }
}

if ( ! function_exists( 'satori_studio_features' ) ) {
        /**
         * Convenience wrapper to access the Features registry service.
         *
         * Returns null when the service container is unavailable. The registry
         * is filterable via `satori_studio_feature_flags` for downstream code
         * that needs to toggle modules or UI visibility.
         *
         * @return \Satori_Studio\Core\Features|null
         */
        function satori_studio_features() {
                return function_exists( 'satori_studio_service' )
                        ? satori_studio_service( 'features' )
                        : null;
        }
}

if ( ! function_exists( 'satori_studio_feature_enabled' ) ) {
        /**
         * Determine whether a feature flag is enabled in the registry.
         *
         * Returns false when the registry is unavailable or the slug is
         * undefined. Intended for lightweight gating of legacy or optional UI
         * such as upsell panels.
         *
         * @param string $slug Feature slug to check.
         * @return bool
         */
        function satori_studio_feature_enabled( $slug ) {
                if ( empty( $slug ) ) {
                        return false;
                }

                $features = satori_studio_features();

                if ( ! $features ) {
                        return false;
                }

                return $features->is_enabled( $slug );
        }
}
