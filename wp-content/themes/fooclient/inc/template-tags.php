<?php
/**
 * Template tags.
 *
 * @package fooclient
 */

/**
 * Inline SVG icon.
 *
 * @param string $name Icon name.
 */
function svg_icon( string $name = '' ) {
	$file = get_template_directory() . '/src/assets/svg/' . $name . '.svg';
	if ( file_exists( $file ) ) {
		require $file;
	}
}

/**
 * An image from within the theme.
 *
 * @param string $path  Relative path from the `assets` directory.
 * @param array  $attrs Image attributes.
 */
function theme_image( string $path = '', array $attrs = array() ) {
	$file = get_template_directory_uri() . '/assets/' . $path;
	echo wp_kses_post(
		sprintf(
			'<img src="%s" %s>',
			$file,
			implode(
				' ',
				array_map(
					function ( $value, $key ) {
						return $key . '="' . $value . '"';
					},
					$attrs,
					array_keys( $attrs )
				)
			)
		)
	);
}

/**
 * Render a component.
 *
 * @param string $name       Component name.
 * @param array  $attributes Attributes to pass to component.
 * @param bool   $echo       Echo the component.
 *
 * @return false|string|void
 */
function foo_component( string $name = '', array $attributes = [], bool $echo = true ) {
	$path = get_stylesheet_directory() . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'front-end' . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . $name . DIRECTORY_SEPARATOR . 'index.php';
	if ( ! file_exists( $path ) ) {
		return false;
	}

	ob_start();
	require $path;
	$component = ob_get_clean();

	foo_component_enqueue_assets( $name );

	if ( false === $echo ) {
		return $component;
	}

	echo $component; // phpcs:ignore -- No need to escape it, since all escaping happens in the component.
}

/**
 * Enqueue a component's assets, if any.
 *
 * @param string $name Component name.
 */
function foo_component_enqueue_assets( string $name = '' ) {
	$path       = get_stylesheet_directory() . DIRECTORY_SEPARATOR . 'dist' . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . $name . DIRECTORY_SEPARATOR;
	$has_style  = false;
	$has_script = false;

	static $theme_version = null;
	if ( null === $theme_version ) {
		$theme_version = wp_get_theme()->get( 'Version' );
	}

	if ( file_exists( $path . 'style.css' ) ) {
		$has_style = true;
	}
	if ( file_exists( $path . 'index.js' ) ) {
		$has_script = true;
	}

	if ( $has_style || $has_script ) {
		$handle = $name . '-component';

		add_action(
			'wp_enqueue_scripts',
			function () use ( $has_style, $has_script, $handle, $name, $theme_version ) {
				if ( $has_style ) {
					wp_enqueue_style( $handle, get_stylesheet_directory_uri() . '/dist/components/' . $name . '/style.css', [], $theme_version );
				}
				if ( $has_script ) {
					wp_enqueue_script( $handle, get_stylesheet_directory_uri() . '/dist/components/' . $name . '/index.js', [], $theme_version, true );
				}
			},
			30
		);
	}
}

/**
 * Wrapper function for template parts.
 *
 * @param string $name Template part name.
 * @param array  $args Template part args.
 * @param bool   $echo Echo template part.
 *
 * @return void|string
 */
function foo_get_template_part( string $name = '', array $args = [], bool $echo = true ) {
	if ( $echo ) {
		get_template_part( 'parts/' . $name, null, $args );
	} else {
		ob_start();
		get_template_part( 'parts/' . $name, null, $args );
		return ob_get_clean();
	}
}

/**
 * Start building template content.
 */
function foo_template_header() {
	ob_start();
}

/**
 * Finish building template content.
 */
function foo_template_footer() {
	// Get built content.
	$content = ob_get_clean();

	// Render built content after header.
	// This is to trigger all hooks before the header is called.
	get_header();
	echo $content; // phpcs:ignore -- No need to escape it, since all escaping happens in the template / components.
	get_footer();
}
