<?php
/**
 * FooClient Autoloader.
 *
 * @package FooClient
 */

namespace FooClient;

/**
 * Autoloader.
 *
 * @param string $class Class name.
 */
function autoloader( $class ) {
	$prefix = __NAMESPACE__ . '\\';

	if ( 0 !== strpos( $class, $prefix ) ) {
		return;
	}

	$class_path      = explode( '\\', strtolower( str_replace( $prefix, '', $class ) ) );
	$total_fragments = count( $class_path );

	if ( 1 === $total_fragments ) {
		$file = $class_path[0] . DIRECTORY_SEPARATOR . 'class-' . str_replace( '_', '-', $class_path[0] ) . '.php';
	} else {
		$class_path[ $total_fragments - 1 ] = 'class-' . str_replace( '_', '-', $class_path[ $total_fragments - 1 ] ) . '.php';
		$class_path[0]                      = $class_path[0] . DIRECTORY_SEPARATOR . 'inc';
		$file                               = implode( DIRECTORY_SEPARATOR, $class_path );
	}

	$path = FOO_MU_PATH . DIRECTORY_SEPARATOR . $file;

	if ( file_exists( $path ) ) {
		require_once $path;
	}
}
spl_autoload_register( __NAMESPACE__ . '\\autoloader' );
