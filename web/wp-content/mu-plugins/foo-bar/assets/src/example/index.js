/**
 * Block: Example.
 */

/**
 * WordPress dependencies.
 */
import wp from 'wp';
const { __ } = wp.i18n;

/**
 * External dependencies.
 */
import classnames from 'classnames';

/**
 * Block data.
 */
export const name = 'foo-bar/example';

export const settings = {
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
};
