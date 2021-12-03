/**
 * Global variables.
 */
const { customElements, HTMLElement } = window;

/**
 * Internal dependencies.
 */
import { slideElementUp, slideElementDown } from '../../global/utility';

/**
 * Accordion Class.
 */
class Accordion extends HTMLElement {
	/**
	 * Constructor.
	 */
	constructor() {
		super();
		this.content = this.querySelector( '.accordion__content' );

		this.querySelector( '.accordion__handle' ).addEventListener( 'click', this.buttonClicked.bind( this ) );
	}

	/**
	 * Event: Button clicked.
	 */
	buttonClicked() {
		this.toggleAttribute( 'active' );

		if ( ! this.hasAttribute( 'active' ) ) {
			slideElementUp( this.content, 600 );
		} else {
			slideElementDown( this.content, 600 );
		}
	}
}

/**
 * Initialize.
 */
customElements.define( 'foo-accordion', Accordion );
