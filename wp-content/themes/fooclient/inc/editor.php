<?php
/**
 * Editor functions.
 *
 * @package fooclient
 */

namespace Foo\Theme\Editor;

use WP_Screen;

/**
 * Setup.
 */
function setup() {
	add_action( 'current_screen', __NAMESPACE__ . '\\block_editor_styles' );
	add_action( 'enqueue_block_editor_assets', __NAMESPACE__ . '\\enqueue_block_editor_assets' );
	add_action( 'admin_enqueue_scripts', __NAMESPACE__ . '\\remove_styles_from_tinymce' );
}

/**
 * Setup Block Editor styles.
 *
 * @param WP_Screen $screen Screen object.
 */
function block_editor_styles( WP_Screen $screen ) {
	// Ignore if not block editor.
	if ( empty( $screen->is_block_editor ) || true !== $screen->is_block_editor || empty( $screen->post_type ) ) {
		return;
	}

	// Add theme support.
	add_theme_support( 'editor-styles' );

	// Add styles depending on post type.
	add_editor_style( 'dist/editor.css' );
}

/**
 * Enqueue Editor Assets.
 */
function enqueue_block_editor_assets() {
	// CSS.
	wp_enqueue_style( 'foo-editor-custom', get_stylesheet_directory_uri() . '/src/editor/custom.css', array(), 1 );

	// JavaScript.
	$theme_version = wp_get_theme()->get( 'Version' );
	$deps          = [
		'wp-i18n',
		'wp-blocks',
		'wp-components',
		'wp-editor',
		'wp-plugins',
		'wp-edit-post',
		'lodash',
	];

	wp_enqueue_script(
		'foo-editor',
		get_stylesheet_directory_uri() . '/dist/editor.js',
		$deps,
		$theme_version,
		false
	);
}

/**
 * Remove block editor styles from TinyMCE.
 */
function remove_styles_from_tinymce() {
	remove_editor_styles();
}
