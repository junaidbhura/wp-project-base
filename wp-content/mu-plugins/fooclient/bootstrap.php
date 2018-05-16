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

	load_module( 'bar', 'FooClient\Bar' );

}

/**
 * Load a module.
 *
 * @param string $dir The module's directory.
 * @param string $namespace The module's namespace.
 * @param string $hook The hook to use for the module's setup function.
 */
function load_module( $dir = '', $namespace = '', $hook = 'plugins_loaded' ) {
	$path = __DIR__ . DIRECTORY_SEPARATOR . $dir . DIRECTORY_SEPARATOR . $dir . '.php';
	if ( file_exists( $path ) ) {
		require_once $path;

		if ( ! empty( $namespace ) && ! empty( $hook ) ) {
			$setup_function = $namespace . '\setup';
			if ( function_exists( $setup_function ) ) {
				add_action( $hook, $setup_function );
			}
		}
	}
}
