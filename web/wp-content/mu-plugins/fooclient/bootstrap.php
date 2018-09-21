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

	load_module( 'bar' );

}

/**
 * Load a module.
 *
 * @param string $dir The module's directory.
 * @param string $hook The hook to use for the module's setup function.
 * @param string $namespace The module's namespace.
 */
function load_module( $dir = '', $hook = 'plugins_loaded', $namespace = '' ) {
	$path = __DIR__ . DIRECTORY_SEPARATOR . $dir . DIRECTORY_SEPARATOR . $dir . '.php';
	if ( file_exists( $path ) ) {
		require_once $path;

		if ( ! empty( $hook ) ) {
			if ( empty( $namespace ) ) {
				$namespace = __NAMESPACE__ . '\\' . str_replace( ' ', '', ucwords( str_replace( '-', ' ', $dir ) ) );
			}

			$setup_function = $namespace . '\setup';
			if ( function_exists( $setup_function ) ) {
				add_action( $hook, $setup_function );
			}
		}
	}
}
