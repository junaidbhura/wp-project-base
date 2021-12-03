/**
 * WordPress dependencies.
 */
import wp from 'wp';
const { registerBlockType } = wp.blocks;

/**
 * Blocks.
 */

const blocks = [
];

blocks.forEach( ( { name, settings } ) => registerBlockType( name, settings ) );
