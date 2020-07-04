/**
 * Block: Example.
 */

import wp from 'wp';
import classnames from 'classnames';

const { registerBlockType } = wp.blocks;
const { __ } = wp.i18n;

registerBlockType(
	'foo-bar/example',
	{
		title: __( 'Example', 'foo-bar' ),
		description: __( 'Example block.', 'foo-bar' ),
		icon: 'screenoptions',
		category: 'layout',
		keywords: [
			__( 'example', 'foo-bar' ),
		],
		supports: {
			className: false,
		},
		edit( { className } ) {
			return (
				<div className={ classnames( className, 'foo-bar-example' ) }>
					Example
				</div>
			);
		},
		save() {
			return (
				<div className="foo-bar-example">
					Example
				</div>
			);
		},
	}
);
