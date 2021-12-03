/**
 * WordPress dependencies.
 */
import wp from 'wp';
const { __ } = wp.i18n;
const {
	useBlockProps,
	RichText,
	InnerBlocks,
} = wp.blockEditor;

/**
 * External dependencies.
 */
import classnames from 'classnames';

/**
 * Styles.
 */
import '../../../front-end/components/accordion/style.scss';
import './editor.scss';

/**
 * Block data.
 */
export const name = 'foo/accordion';

export const settings = {
	apiVersion: 2,
	title: __( 'Accordion', 'foo' ),
	description: __( 'Accordion block.', 'foo' ),
	icon: 'screenoptions',
	category: 'layout',
	keywords: [
		__( 'accordion', 'foo' ),
	],
	attributes: {
		title: {
			type: 'string',
		},
	},
	supports: {
		alignWide: false,
		anchor: false,
		className: false,
		html: false,
		color: false,
		customClassName: false,
	},
	edit( { attributes, setAttributes, className } ) {
		return (
			<div {
				/* eslint-disable-next-line react-hooks/rules-of-hooks */
				...useBlockProps( {
					className: classnames( className, 'accordion' ),
				} )
			}>
				<RichText
					tagName="h3"
					placeholder={ __( 'Write title…', 'mp' ) }
					value={ attributes.title }
					onChange={ ( title ) => setAttributes( { title } ) }
					multiline={ false }
				/>
				<div className="accordion__content">
					<InnerBlocks />
				</div>
			</div>
		);
	},
	save() {
		return <InnerBlocks.Content />;
	},
};

