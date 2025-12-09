<?php
/* -------------------------------------------------
 * SATORI Studio — Services Container
 * -------------------------------------------------*/

/**
 * Lightweight services container for SATORI Studio.
 *
 * Provides lazy-loaded service definitions and retrieval for reusable
 * systems across the plugin.
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
