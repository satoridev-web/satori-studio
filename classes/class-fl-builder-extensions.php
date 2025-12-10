<?php

/**
 * Helper class for builder extensions.
 *
 * @since 1.0
 */
final class FLBuilderExtensions {

	/**
	 * Initializes any extensions found in the extensions directory.
	 *
	 * @since 1.8
	 * @param string $path Path to extensions to initialize.
	 * @return void
	 */
        static public function init( $path = null ) {
                $path       = $path ? trailingslashit( $path ) : FL_BUILDER_DIR . 'extensions/';
                $extensions = glob( $path . '*' );
                $features   = null;

                if ( class_exists( '\\Satori_Studio\\Core\\Plugin' ) && defined( 'FL_BUILDER_FILE' ) ) {
                        $features = \Satori_Studio\Core\Plugin::init( FL_BUILDER_FILE )->service( 'features' );
                }

                if ( ! is_array( $extensions ) ) {
                        return;
                }

                foreach ( $extensions as $extension ) {

                        // Phase 1B: consult the feature registry before loading extensions.
                        $slug = basename( $extension );

                        if ( $features && method_exists( $features, 'is_enabled' ) && ! $features->is_enabled( 'extension-' . $slug ) ) {
                                continue;
                        }

                        if ( ! is_dir( $extension ) ) {
                                continue;
                        }

                        $path = trailingslashit( $extension ) . $slug . '.php';

			if ( file_exists( $path ) ) {
				require_once $path;
			}
		}
	}
}

FLBuilderExtensions::init();
