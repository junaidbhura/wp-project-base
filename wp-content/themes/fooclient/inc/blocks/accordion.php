<?php
/**
 * Block: Accordion.
 *
 * @package fooclient
 */

namespace Foo\Theme\Blocks\Accordion;

const BLOCK_NAME = 'foo/accordion';
const COMPONENT  = 'accordion';

add_action( 'template_redirect', __NAMESPACE__ . '\\register' );

/**
 * Register block on the front-end.
 */
function register() {
	add_filter( 'pre_render_block', __NAMESPACE__ . '\\render', 10, 2 );
}

/**
 * Render this block.
 *
 * @param mixed $content Original content.
 * @param array $block   Parsed block.
 *
 * @return mixed
 */
function render( $content = null, array $block = [] ) {
	// Check for block.
	if ( BLOCK_NAME !== $block['blockName'] ) {
		return $content;
	}

	// Build component attributes.
	$attributes = [
		'title' => $block['attrs']['title'] ?? '',
	];

	if ( ! empty( $block['innerBlocks'] ) ) {
		$attributes['content'] = implode( '', array_map( 'render_block', $block['innerBlocks'] ) );
	}

	// Return rendered component.
	return foo_component( COMPONENT, $attributes, false );
}
