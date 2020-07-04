/**
 * WordPress dependencies.
 */
import wp from 'wp';
const { registerBlockType } = wp.blocks;

/**
 * Internal dependencies.
 */
import * as example from './example';

/**
 * Register blocks.
 */
const blocks = [
	example,
];

blocks.forEach( ( { name, settings } ) => registerBlockType( name, settings ) );
