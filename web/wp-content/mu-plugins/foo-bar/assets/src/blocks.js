/**
 * Blocks.
 */

import wp from 'wp';

// Get block functions.
const { registerBlockType } = wp.blocks;

// Import our blocks.
import * as example from './example';

// Create a list of blocks to loop through.
const blocks = [
	example,
];

// Register the blocks
blocks.forEach( ( { name, settings } ) => {
	registerBlockType( name, settings );
} );
