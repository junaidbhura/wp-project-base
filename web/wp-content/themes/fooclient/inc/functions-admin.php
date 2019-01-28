<?php
/**
 * Admin functions.
 *
 * @package fooclient
 */

/**
 * Enqueue Editor Assets.
 */
function foo_enqueue_block_editor_assets() {
	wp_enqueue_style(
		'fooclient-editor',
		get_stylesheet_directory_uri() . '/assets/dist/editor.css',
		array( 'wp-edit-blocks' ),
		1
	);
}
add_action( 'enqueue_block_editor_assets', 'foo_enqueue_block_editor_assets' );
