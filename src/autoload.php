<?php
/**
 * Simple PSR-4 autoloader for the Satori_Studio namespace.
 */

spl_autoload_register( function ( $class ) {
    $prefix   = 'Satori_Studio\\';
    $base_dir = __DIR__ . '/';
    $len      = strlen( $prefix );

    if ( 0 !== strncmp( $prefix, $class, $len ) ) {
        return;
    }

    $relative_class = substr( $class, $len );
    $file           = $base_dir . str_replace( '\\', '/', $relative_class ) . '.php';

    if ( file_exists( $file ) ) {
        require $file;
    }
} );
