<?php
/**
 * Front-end functions.
 *
 * @package fooclient
 */

/**
 * Theme Setup.
 */
function foo_theme_setup() {

	// Theme Support.
	add_theme_support( 'title-tag' );
	add_theme_support( 'custom-logo' );

	// Remove standard WordPress stuff.
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );

}
add_action( 'after_setup_theme', 'foo_theme_setup' );

/**
 * Navigation Menus.
 */
function foo_register_nav_menus() {
	$nav_menus = apply_filters(
		'foo_nav_menus',
		[
			'main' => 'Main Menu',
		]
	);
	register_nav_menus( $nav_menus );
}
add_action( 'after_setup_theme', 'foo_register_nav_menus' );

/**
 * Enqueue Scripts.
 */
function foo_enqueue_scripts() {

	// Enqueue CSS.
	wp_enqueue_style( 'fooclient', get_bloginfo( 'template_url' ) . '/assets/dist/theme.css', null, '1', 'all' );

	// Enqueue JavaScript.
	wp_deregister_script( 'jquery' );
	wp_enqueue_script( 'jquery', get_bloginfo( 'template_url' ) . '/assets/lib/jquery.min.js', null, '3.3.1', true );
	wp_enqueue_script( 'fooclient', get_bloginfo( 'template_url' ) . '/assets/dist/theme.js', array( 'jquery' ), '1', true );

}
add_action( 'wp_enqueue_scripts', 'foo_enqueue_scripts' );

/**
 * Load template part and pass arguments to it.
 *
 * @param  string $file          Path to the file.
 * @param  array  $template_args Arguments to pass.
 * @return mixed
 *
 * @see https://github.com/humanmade/hm-core/blob/master/hm-core.functions.php
 */
function foo_get_template_part( $file, $template_args = array() ) {
	$template_args = wp_parse_args( $template_args );

	// Get file path.
	if ( file_exists( get_stylesheet_directory() . '/' . $file . '.php' ) ) {
		$file = get_stylesheet_directory() . '/' . $file . '.php';
	} elseif ( file_exists( get_template_directory() . '/' . $file . '.php' ) ) {
		$file = get_template_directory() . '/' . $file . '.php';
	}

	// Load file.
	ob_start();
	require $file;
	$data = ob_get_clean();

	// Check if data is to be returned.
	if ( ! empty( $template_args['return'] ) ) {
		if ( false === $template_args['return'] ) {
			return false;
		} else {
			return $data;
		}
	}

	// Echo data.
	echo $data; // @codingStandardsIgnoreLine
	return null;
}
