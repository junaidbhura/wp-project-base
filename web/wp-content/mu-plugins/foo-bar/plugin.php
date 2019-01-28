<?php
/**
 * Plugin Name: FooClient Bar feature.
 * Description: Bar feature for Foo Client.
 * Author: Junaid Bhura
 * Author URI: https://junaidbhura.com
 * Version: 1.0.0
 *
 * @package foo-bar
 */

namespace FooClient\Bar;

require_once __DIR__ . '/inc/autoload.php';
require_once __DIR__ . '/inc/namespace.php';

// Kick it off.
add_action( 'plugins_loaded', __NAMESPACE__ . '\\bootstrap' );
