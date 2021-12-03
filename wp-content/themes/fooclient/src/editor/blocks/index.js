/**
 * WordPress dependencies.
 */
import wp from 'wp';
const { registerBlockType } = wp.blocks;

/**
 * Blocks.
 */

import * as accordion from './accordion';

const blocks = [
	accordion,
];

blocks.forEach( ( { name, settings } ) => registerBlockType( name, settings ) );
