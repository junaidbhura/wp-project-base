module.exports = {
	preset: 'jest-puppeteer',
	rootDir: '.tests/e2e',
	testTimeout: 60000,
	transform: {
		'^.+\\.[jt]sx?$': '@wordpress/scripts/config/babel-transform',
	},
};
