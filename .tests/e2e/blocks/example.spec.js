import {
	createNewPost,
	insertBlock,
	setBrowserViewport,
} from '@wordpress/e2e-test-utils'

describe( 'Example block', () => {
	beforeEach( async () => {
		await setBrowserViewport( 'large' );
		await createNewPost();
	} );

	it( 'Should exist', async () => {
		await insertBlock( 'Example' );
		expect( await page.$( '[data-type="foo-bar/example"]' ) ).not.toBeNull();
	} );
} );
