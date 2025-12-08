<?php
/* -------------------------------------------------
 * SATORI Studio — Core Plugin Bootstrap
 * -------------------------------------------------*/

/**
 * Core plugin bootstrap for SATORI Studio.
 *
 * Responsibilities:
 * - Provide a modern entry point for plugin bootstrap.
 * - Load the legacy FLBuilder loader
 *   (classes/class-fl-builder-loader.php).
 * - Act as a foundation for future SATORI-specific systems such as
 *   services, registries, settings handlers, and architecture upgrades.
 *
 * IMPORTANT:
 * This class is intentionally conservative in Phase 2.
 * It does NOT alter the behaviour of FLBuilder or its loader.
 * It simply wraps and prepares the codebase for controlled modernization.
 *
 * @package Satori_Studio\Core
 */

namespace Satori_Studio\Core;

class Plugin {

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
	 * Core environment metadata for the plugin.
	 *
	 * @var Environment
	 */
	private $environment;

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
	public function __construct( $plugin_file ) {
		$this->plugin_file = $plugin_file;
		$this->plugin_dir  = plugin_dir_path( $plugin_file );
		$this->environment = new Environment( $plugin_file );

		$this->bootstrap();
	}

	/**
	 * Get the core environment object.
	 *
	 * @return Environment
	 */
	public function get_environment() {
		return $this->environment;
	}

	/**
	 * Load and delegate to the legacy FLBuilder bootstrapper.
	 *
	 * This maintains full compatibility with the original Beaver Builder Lite
	 * while preparing the architecture for SATORI Studio expansions.
	 *
	 * @return void
	 */
	private function bootstrap() {

		// Path to the legacy loader.
		$loader = $this->plugin_dir . 'classes/class-fl-builder-loader.php';

		// Load the original builder loader if it exists.
		if ( file_exists( $loader ) ) {
			require_once $loader;
		}

		// Do NOT call FLBuilderLoader::init() here.
		// The legacy loader already runs init() internally.
	}
}
