/**
 * Block: Example.
 */

import wp from 'wp';
import classnames from 'classnames';

const { __ } = wp.i18n;

export const name = 'foo-bar/example';

export const settings = {

	title: __( 'Example', 'foo-bar' ),

	description: __( 'Example.', 'foo-bar' ),

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
