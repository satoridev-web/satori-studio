<?php
/* -------------------------------------------------
 * SATORI Studio — Services Container
 * -------------------------------------------------*/

/**
 * Lightweight services container for SATORI Studio.
 *
 * Responsibilities:
 * - Register factories for shared services (identified by string IDs).
 * - Lazily instantiate services on first access and cache the instances for
 *   reuse across the plugin lifecycle.
 *
 * Lifecycle & usage notes:
 * - Created by the Plugin bootstrap and provided to callers via
 *   Plugin::get_services() or helper functions.
 * - set() should be called during plugin bootstrap to register factories; get()
 *   can be called later without worrying about instantiation order.
 * - The container is intentionally minimal and does not throw on missing
 *   services—get() simply returns null when an ID is undefined.
 *
 * @package Satori_Studio\Core\Services
 */

namespace Satori_Studio\Core\Services;

class Container {

	/**
	 * Registered service definitions.
	 *
	 * @var array<string, callable>
	 */
	private $definitions = array();

	/**
	 * Instantiated services.
	 *
	 * @var array<string, mixed>
	 */
	private $instances = array();

	/**
	 * Register a new service factory.
	 *
	 * Factories should be cheap closures; the container will only invoke them on
	 * first access and then cache the returned instance.
	 *
	 * @param string   $id      Service identifier.
	 * @param callable $factory Factory callback returning the service instance.
	 * @return void
	 */
	public function set( $id, callable $factory ) {
		$this->definitions[ $id ] = $factory;
	}

	/**
	 * Determine whether a service is defined or instantiated.
	 *
	 * @param string $id Service identifier.
	 * @return bool
	 */
	public function has( $id ) {
		return isset( $this->definitions[ $id ] ) || isset( $this->instances[ $id ] );
	}

	/**
	 * Retrieve a service instance by identifier.
	 *
	 * Services are lazily instantiated on first access. When no definition
	 * exists, null is returned instead of throwing.
	 *
	 * @param string $id Service identifier.
	 * @return mixed|null
	 */
	public function get( $id ) {
		if ( isset( $this->instances[ $id ] ) ) {
			return $this->instances[ $id ];
		}

		if ( ! isset( $this->definitions[ $id ] ) ) {
			return null;
		}

		$this->instances[ $id ] = call_user_func( $this->definitions[ $id ], $this );
		return $this->instances[ $id ];
	}
}
