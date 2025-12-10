<?php
/* -------------------------------------------------
 * SATORI Studio — Core Environment
 * -------------------------------------------------*/

/**
 * Core environment container for SATORI Studio metadata.
 *
 * Responsibilities:
 * - Provide a single source of truth for plugin file paths, URLs, version
 *   data, and identifying slugs.
 * - Normalise frequently reused metadata so other systems do not duplicate
 *   filesystem/URL resolution logic.
 *
 * Lifecycle & usage notes:
 * - Instantiated once by the Plugin bootstrap and typically accessed via the
 *   services container or helper functions.
 * - Values are resolved during construction and then cached as read-only
 *   properties for fast reuse.
 *
 * @package Satori_Studio\Core
 */

namespace Satori_Studio\Core;

class Environment {

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
	 * Plugin URL.
	 *
	 * @var string
	 */
	private $plugin_url;

	/**
	 * Plugin basename.
	 *
	 * @var string
	 */
	private $basename;

	/**
	 * Plugin version string.
	 *
	 * @var string
	 */
	private $version;

	/**
	 * Plugin slug.
	 *
	 * @var string
	 */
	private $slug;

	/**
	 * Constructor.
	 *
	 * @param string $plugin_file Path to the main plugin file.
	 */
	public function __construct( $plugin_file ) {
		$this->plugin_file = $plugin_file;
		$this->plugin_dir  = plugin_dir_path( $plugin_file );
		$this->plugin_url  = plugin_dir_url( $plugin_file );
		$this->basename    = plugin_basename( $plugin_file );
		$this->version     = $this->resolve_version();
		$this->slug        = $this->resolve_slug();
	}

	/**
	 * Get the main plugin file path.
	 *
	 * @return string
	 */
	public function get_plugin_file() {
		return $this->plugin_file;
	}

	/**
	 * Get the plugin directory path.
	 *
	 * @return string
	 */
	public function get_plugin_dir() {
		return $this->plugin_dir;
	}

	/**
	 * Get the plugin URL.
	 *
	 * @return string
	 */
	public function get_plugin_url() {
		return $this->plugin_url;
	}

	/**
	 * Get the plugin basename.
	 *
	 * @return string
	 */
	public function get_basename() {
		return $this->basename;
	}

	/**
	 * Get the plugin version string.
	 *
	 * @return string
	 */
	public function get_version() {
		return $this->version;
	}

	/**
	 * Get the plugin slug.
	 *
	 * @return string
	 */
	public function get_slug() {
		return $this->slug;
	}

	/**
	 * Determine the plugin version.
	 *
	 * @return string
	 */
	private function resolve_version() {
		if ( defined( 'FL_BUILDER_VERSION' ) ) {
			return FL_BUILDER_VERSION;
		}
		
		if ( function_exists( 'get_file_data' ) ) {
			$plugin_data = get_file_data(
				$this->plugin_file,
				array(
					'Version' => 'Version',
				)
			);
		
			if ( isset( $plugin_data['Version'] ) && '' !== $plugin_data['Version'] ) {
				return $plugin_data['Version'];
			}
		}
		
		return '';
	}

	/**
	 * Determine the plugin slug.
	 *
	 * @return string
	 */
	private function resolve_slug() {
		$slug = dirname( $this->basename );
		
		if ( '.' === $slug ) {
			return basename( $this->basename, '.php' );
		}
		
		return $slug;
	}
}
