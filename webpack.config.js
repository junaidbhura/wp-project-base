// External dependencies.
const defaultConfig = require( '@wordpress/scripts/config/webpack.config' );
const WebpackNotifierPlugin = require( 'webpack-notifier' );

// Assets paths.
const themeAssetsPath = `${ process.cwd() }/web/wp-content/themes/fooclient/assets`;
const muPluginAssetsPath = `${ process.cwd() }/web/wp-content/mu-plugins/foo-bar/assets`;

// Custom configuration.
const customConfig = {
	...defaultConfig,
	externals: {
		react: 'React',
		'react-dom': 'ReactDOM',
		wp: 'wp',
		jquery: 'jQuery',
		gumponents: 'gumponents',
	},
};

if ( 'development' === customConfig.mode ) {
	customConfig.plugins.push(
		new WebpackNotifierPlugin( {
			title: 'Build',
			alwaysNotify: true,
		} )
	);
}

// Build configuration.
module.exports = () => {
	const config = [
		{
			// MU Plugin.
			...customConfig,
			entry: {
				blocks: `${ muPluginAssetsPath }/src/blocks.js`,
			},
			output: {
				...customConfig.output,
				path: `${ muPluginAssetsPath }/dist`,
			},
		},
		{
			// Theme.
			...customConfig,
			entry: {
				theme: `${ themeAssetsPath }/src/theme/theme.js`,
				editor: `${ themeAssetsPath }/src/editor/editor.js`,
			},
			output: {
				...customConfig.output,
				path: `${ themeAssetsPath }/dist`,
			},
		},
	];

	return config;
};
