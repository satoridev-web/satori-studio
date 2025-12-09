<?php
/**
 * Plugin Name:       SATORI Studio Page Builder (Lite)
 * Plugin URI:        https://satoristudio.com/
 * Description:       SATORI Studio delivers a drag and drop frontend WordPress page builder that works with almost any theme. Maintained by Satori Studio and based on the Beaver Builder Lite codebase.
 * Version:           2.9.4.1
 * Author:            SATORI Studio
 * Author URI:        https://satoristudio.com/
 * Text Domain:       satori-studio
 * Domain Path:       /languages
 * License:           GPL-2.0-or-later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.html
 * Requires at least: 5.2
 * Tested up to:      6.9
 * Requires PHP:      7.0
 *
 * @package Satori_Studio
 */

require_once __DIR__ . '/src/autoload.php';

\Satori_Studio\Core\Plugin::init( __FILE__ );

if ( ! function_exists( 'satori_studio' ) ) {
        /**
         * Retrieve the SATORI Studio core plugin instance.
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
         * @param string $id Service identifier.
         * @return mixed|null
         */
        function satori_studio_service( $id ) {
                return satori_studio()->service( $id );
        }
}
