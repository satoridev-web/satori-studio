<?php
/**
 * Core plugin bootstrap for SATORI Studio.
 */

namespace Satori_Studio\Core;

final class Plugin {
    /**
     * Singleton instance.
     *
     * @var Plugin|null
     */
    private static $instance = null;

    /**
     * Full path to the main plugin file.
     *
     * @var string
     */
    private $plugin_file;

    /**
     * Absolute path to the plugin directory.
     *
     * @var string
     */
    private $plugin_dir;

    /**
     * Initialize the plugin instance.
     *
     * @param string $plugin_file Path to the main plugin file.
     * @return Plugin
     */
    public static function init( $plugin_file ) {
        if ( null === self::$instance ) {
            self::$instance = new self( $plugin_file );
        }

        return self::$instance;
    }

    /**
     * Constructor.
     *
     * @param string $plugin_file Path to the main plugin file.
     */
    private function __construct( $plugin_file ) {
        $this->plugin_file = $plugin_file;
        $this->plugin_dir  = plugin_dir_path( $plugin_file );

        $this->bootstrap();
    }

    /**
     * Load the existing builder bootstrapper.
     *
     * @return void
     */
    private function bootstrap() {
        $loader = $this->plugin_dir . 'classes/class-fl-builder-loader.php';

        if ( file_exists( $loader ) ) {
            require_once $loader;
        }

        if ( class_exists( '\FLBuilderLoader' ) ) {
            \FLBuilderLoader::init();
        }
    }
}
