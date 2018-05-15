<?php
/**
 * FooClient Autoloader.
 *
 * @package FooClient
 */

namespace FooClient;

/**
 * Main bootstrap function.
 */
function bootstrap() {

	/**
	 * Structure: 'directory' => 'namespace'
	 */
	$modules = array(
		'bar' => 'FooClient\Bar',
	);
	foreach ( $modules as $dir => $namespace ) {
		load_module( $dir, $namespace );
	}

}

/**
 * Load a module.
 *
 * @param string $dir The directory.
 * @param string $namespace The namespace.
 */
function load_module( $dir = '', $namespace = '' ) {
	$path = __DIR__ . DIRECTORY_SEPARATOR . $dir . DIRECTORY_SEPARATOR . $dir . '.php';
	if ( file_exists( $path ) ) {
		require_once $path;

		$setup_function = $namespace . '\setup';
		if ( function_exists( $setup_function ) ) {
			$setup_function();
		}
	}
}
