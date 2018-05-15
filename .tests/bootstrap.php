<?php
/**
 * Bootstrap for unit tests.
 */

ini_set( 'error_reporting', E_ALL );
ini_set( 'display_errors', '1' );
ini_set( 'display_startup_errors', '1' );

$test_root = dirname( __FILE__ ) . '/lib';

require $test_root . '/includes/functions.php';
require $test_root . '/includes/bootstrap.php';
