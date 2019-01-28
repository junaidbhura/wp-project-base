/**
 * Example Component.
 */

import $ from 'jquery';

$( document ).on( 'click.example', '.example .btn', ( e ) => {
	const button = e.target;
	$( button ).parent().toggleClass( 'example--active' );
} );
