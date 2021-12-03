<?php
/**
 * Plugin Name: Foo Client Feature.
 * Description:  Foo Client Feature functionality.
 * Author: Junaid Bhura
 * Author URI: https://junaid.dev
 * Version: 1.0.0
 *
 * @package foo-feature
 */

namespace Foo\Feature;

require_once __DIR__ . '/inc/namespace.php';

// Kick it off.
add_action( 'plugins_loaded', __NAMESPACE__ . '\\bootstrap' );
