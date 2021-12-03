<?php
/**
 * Core functions and definitions.
 *
 * @package fooclient
 */

namespace Foo\Theme\Core;

/**
 * Setup.
 */
function setup() {
	add_action( 'after_setup_theme', __NAMESPACE__ . '\\theme_support' );
	add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\\register_styles' );
	add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\\register_scripts' );
	add_action( 'init', __NAMESPACE__ . '\\nav_menus' );
}

/**
 * Set up theme defaults and registers support for various WordPress features.
 */
function theme_support() {
	// Content-width.
	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 1280;
	}

	// Post thumbnails.
	add_theme_support( 'post-thumbnails' );

	// Misc. support.
	add_theme_support( 'title-tag' );
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'script',
			'style',
		)
	);
	add_theme_support( 'align-wide' );
	add_theme_support( 'responsive-embeds' );

	// Cleanup.
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
}

/**
 * Register and Enqueue Styles.
 */
function register_styles() {
	// Dequeue WordPress styles.
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'global-styles' );

	// Register and enqueue styles.
	$theme_version = wp_get_theme()->get( 'Version' );

	wp_enqueue_style( 'foo-global', get_template_directory_uri() . '/dist/global.css', array(), $theme_version );
}

/**
 * Register and Enqueue Scripts.
 */
function register_scripts() {
	// Register and enqueue scripts.
	$theme_version = wp_get_theme()->get( 'Version' );

	if ( ! is_user_logged_in() ) {
		wp_deregister_script( 'jquery' );
	}
	wp_deregister_script( 'wp-embed' );
	wp_enqueue_script( 'global', get_template_directory_uri() . '/dist/global.js', array(), $theme_version, true );
}

/**
 * Register navigation menus.
 */
function nav_menus() {
	$locations = [
		'main' => 'Main Menu',
	];
	register_nav_menus( $locations );
}
