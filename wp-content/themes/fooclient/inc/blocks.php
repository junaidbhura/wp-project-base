<?php
/**
 * Blocks functions.
 *
 * @package fooclient
 */

namespace Foo\Theme\Blocks;

/**
 * Setup.
 */
function setup() {
	add_action( 'init', __NAMESPACE__ . '\\register_blocks' );
}

/**
 * Register all blocks.
 */
function register_blocks() {
	require_once __DIR__ . '/blocks/accordion.php';
}
