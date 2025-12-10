<?php
/* -------------------------------------------------
 * SATORI Studio — Core Plugin Bootstrap
 * -------------------------------------------------*/

/**
 * Core plugin bootstrap for SATORI Studio.
 *
 * Responsibilities:
 * - Provide a modern entry point for plugin bootstrap while deferring to the
 *   legacy FLBuilder loader (classes/class-fl-builder-loader.php) for runtime
 *   behaviour.
 * - Create and expose the shared Environment and Services container used by
 *   the wider codebase.
 * - Act as a foundation for future SATORI-specific systems such as services,
 *   registries, settings handlers, and architecture upgrades.
 *
 * Lifecycle & usage notes:
 * - Instantiated as a singleton via Plugin::init(), typically from the main
 *   plugin file.
 * - Environment and Container are created once during construction and
 *   returned on demand; no further boot hooks are required here.
 * - This class is intentionally conservative and does NOT alter FLBuilder's
 *   behaviour; it simply wraps and prepares the codebase for controlled
 *   modernization.
 *
 * @package Satori_Studio\Core
 */

namespace Satori_Studio\Core;

use Satori_Studio\Core\Services\Container;
use Satori_Studio\Core\Environment;

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
	 * Services container for shared systems.
	 *
	 * @var Container
	 */
	private $services;

	/**
	 * Initialize or retrieve the singleton plugin instance.
	 *
	 * Expected usage: called from the main plugin entry point to prime the core
	 * systems (environment + services) while keeping the legacy bootstrap
	 * intact.
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
		$this->services    = new Container();

		$this->register_services();

		$this->bootstrap();
	}

	/**
	 * Get the core environment object.
	 *
	 * The Environment is created during construction and reused for the lifetime
	 * of the plugin instance.
	 *
	 * @return Environment
	 */
	public function get_environment() {
		return $this->environment;
	}

	/**
	 * Get the services container.
	 *
	 * The container is initialized once during construction and used to lazily
	 * create shared systems.
	 *
	 * @return Container
	 */
	public function get_services() {
		return $this->services;
	}

	/**
	 * Retrieve a service by identifier.
	 *
	 * Services are resolved lazily; requesting a service will instantiate it on
	 * first access if a definition exists.
	 *
	 * @param string $id Service identifier.
	 * @return mixed|null
	 */
	public function service( $id ) {
		return $this->services->get( $id );
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

	/**
	 * Register core services.
	 *
	 * Currently wires the Environment instance into the container so other
	 * systems can access it via the shared service ID without duplicating
	 * initialization.
	 *
	 * @return void
	 */
	private function register_services() {
		$this->services->set(
			'environment',
			function () {
				return $this->environment;
			}
		);
	}
}
