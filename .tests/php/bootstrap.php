<?php
/**
 * Bootstrap for unit tests.
 */

// Error reporting.
ini_set( 'error_reporting', E_ALL );
ini_set( 'display_errors', '1' );
ini_set( 'display_startup_errors', '1' );

// Load functions.
require_once getenv( 'WP_PHPUNIT__DIR' ) . '/includes/functions.php';

/**
 * Manually load our environment.
 */
function _manually_load_environment() {
	// Options.
	update_option( 'permalink_structure', '/blog/%postname%' );

	// Activate plugins.
	$plugins_to_activate = array(
	);
	update_option( 'active_plugins', $plugins_to_activate );

	// Switch theme.
	add_filter( 'stylesheet', function () {
		return 'fooclient';
	} );
}
tests_add_filter( 'muplugins_loaded', '_manually_load_environment' );

// Boostrap tests.
require_once getenv( 'WP_PHPUNIT__DIR' ) . '/includes/bootstrap.php';
