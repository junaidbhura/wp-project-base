<?php
/**
 * Bootstrap for unit tests.
 */

use function Env\env;

/**
 * Composer autoloader.
 */
require_once __DIR__ . '/../../vendor/autoload.php';

/**
 * Use Dotenv to set required environment variables and load .env file in root.
 */
$dotenv = Dotenv\Dotenv::createImmutable( __DIR__ . '/../../' );
if ( file_exists( __DIR__ . '/../../.env' ) ) {
	$dotenv->load();
	$dotenv->required( [ 'WP_HOME', 'WP_SITEURL' ] );
	if ( ! env( 'TESTS_DATABASE_URL' ) ) {
		$dotenv->required( [ 'TESTS_DB_NAME', 'TESTS_DB_USER', 'TESTS_DB_PASSWORD' ] );
	}
}

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
