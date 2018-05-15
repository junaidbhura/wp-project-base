<?php
/**
 * Main Functions File.
 *
 * @package FooClient
 * @subpackage Theme
 */

/**
 * Theme Setup.
 */
function foo_theme_setup() {

	/**
	 * Theme Support.
	 */
	add_theme_support( 'title-tag' );

}
add_action( 'after_setup_theme', 'foo_theme_setup' );

/**
 * Enqueue Scripts.
 */
function foo_enqueue_scripts() {

	/**
	 * Enqueue CSS.
	 */
	wp_enqueue_style( 'fooclient', get_bloginfo( 'template_url' ) . '/assets/css/fooclient.min.css', null, '1', 'all' );

	/**
	 * Enqueue JavaScript.
	 */
	wp_deregister_script( 'jquery' );
	wp_enqueue_script( 'jquery', get_bloginfo( 'template_url' ) . '/assets/js/jquery.js', null, '1.11.2', true );
	wp_enqueue_script( 'main', get_bloginfo( 'template_url' ) . '/assets/js/main.js', array( 'jquery' ), '1', true );

}
add_action( 'wp_enqueue_scripts', 'foo_enqueue_scripts' );
