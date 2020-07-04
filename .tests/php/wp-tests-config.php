<?php

$_SERVER['HTTP_HOST'] = 'localhost';

if ( ! empty( getenv( 'GITHUB_ACTIONS' ) ) ) {
	define( 'DB_NAME', 'wp_tests' );
	define( 'DB_USER', 'root' );
	define( 'DB_PASSWORD', 'root' );
	define( 'DB_HOST', 'mysql' );
} else {
	require_once 'wp-tests-config-local.php';
}

define( 'WP_TESTS_DOMAIN', 'localhost' );
define( 'WP_TESTS_EMAIL', 'admin@example.org' );
define( 'WP_TESTS_TITLE', 'Test Blog' );

define( 'WP_PHP_BINARY', 'php' );
define( 'WP_TESTS_MULTISITE', false );

// Define Site URL.
if ( ! defined( 'WP_SITEURL' ) ) {
	define( 'WP_SITEURL', 'http://' . $_SERVER['HTTP_HOST'] );
}

// Define Home URL.
if ( ! defined( 'WP_HOME' ) ) {
	define( 'WP_HOME', 'http://' . $_SERVER['HTTP_HOST'] );
}

// Define Path & URL for Content.
define( 'WP_CONTENT_DIR', dirname( __DIR__ ) . '/../web/wp-content' );
define( 'WP_CONTENT_URL', WP_HOME . '/wp-content' );

$table_prefix = 'wptests_';

// Prevent editing of files through WP Admin.
define( 'DISALLOW_FILE_EDIT', true );
define( 'DISALLOW_FILE_MODS', true );

// Absolute path to the WordPress directory.
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __DIR__ ) . '/../web/wp/' );
}
