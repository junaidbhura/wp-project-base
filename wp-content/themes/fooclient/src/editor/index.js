/**
 * Styles.
 */
import './editor.scss';

/**
 * Blocks.
 */
import './blocks';

/**
 * WordPress dependencies.
 */
import wp from 'wp';
const {
	unregisterBlockType,
	registerBlockStyle,
	unregisterBlockStyle,
} = wp.blocks;

/**
 * Blacklist Blocks.
 */
const blacklistBlocks = [
	'core/audio',
	'core/video',
	'core/code',
	'core/preformatted',
	'core/pullquote',
	'core/verse',
	'core/media-text',
	'core/nextpage',
	'core/more',
	'core/spacer',
	'core/archives',
	'core/calendar',
	'core/categories',
	'core/latest-comments',
	'core/latest-posts',
	'core/rss',
	'core/search',
	'core/tag-cloud',
	'core/gallery',
	'core/cover',
	'core/table',
	'core/group',
	'core/separator',
	'core/site-logo',
	'core/site-tagline',
	'core/site-title',
	'core/query-title',
	'core/post-terms',
	'core/page-list',
	'core/columns',
	'core/query',
	'core/post-title',
	'core/post-content',
	'core/post-date',
	'core/post-excerpt',
	'core/post-featured-image',
	'core/loginout',
	'core/social-links',
];

wp.domReady( () => {
	blacklistBlocks.forEach( ( block ) => unregisterBlockType( block ) );
} );

/**
 * Block Styles.
 */
wp.domReady( () => {
	// Buttons.
	unregisterBlockStyle( 'core/button', 'fill' );
	unregisterBlockStyle( 'core/button', 'outline' );

	// Paragraph.
	registerBlockStyle( 'core/paragraph', {
		name: 'default',
		label: 'Default',
		isDefault: true,
	} );
	registerBlockStyle( 'core/paragraph', {
		name: 'large',
		label: 'Large',
	} );
	registerBlockStyle( 'core/paragraph', {
		name: 'h1',
		label: 'H1',
	} );
	registerBlockStyle( 'core/paragraph', {
		name: 'h2',
		label: 'H2',
	} );
	registerBlockStyle( 'core/paragraph', {
		name: 'h3',
		label: 'H3',
	} );
	registerBlockStyle( 'core/paragraph', {
		name: 'h4',
		label: 'H4',
	} );

	// Heading.
	registerBlockStyle( 'core/heading', {
		name: 'default',
		label: 'Default',
		isDefault: true,
	} );
	registerBlockStyle( 'core/heading', {
		name: 'h1',
		label: 'H1',
	} );
	registerBlockStyle( 'core/heading', {
		name: 'h2',
		label: 'H2',
	} );
	registerBlockStyle( 'core/heading', {
		name: 'h3',
		label: 'H3',
	} );
	registerBlockStyle( 'core/heading', {
		name: 'h4',
		label: 'H4',
	} );
	registerBlockStyle( 'core/heading', {
		name: 'display',
		label: 'Display',
	} );

	// Image.
	unregisterBlockStyle( 'core/image', 'rounded' );
} );
