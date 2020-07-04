<?php
/**
 * Bootstrap for unit tests.
 */

ini_set( 'error_reporting', E_ALL );
ini_set( 'display_errors', '1' );
ini_set( 'display_startup_errors', '1' );

require_once dirname( __DIR__ ) . '/../vendor/autoload.php';
require_once getenv( 'WP_PHPUNIT__DIR' ) . '/includes/functions.php';
require_once getenv( 'WP_PHPUNIT__DIR' ) . '/includes/bootstrap.php';
