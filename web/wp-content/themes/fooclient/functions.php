<?php
/**
 * Main Functions File.
 *
 * @package fooclient
 */

if ( is_admin() ) {
	require_once 'inc/functions-admin.php';
} else {
	require_once 'inc/functions-frontend.php';
}
