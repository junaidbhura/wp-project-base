// External dependencies.
const MiniCssExtractPlugin = require( 'mini-css-extract-plugin' );
const WebpackNotifierPlugin = require( 'webpack-notifier' );
const UglifyJsPlugin = require( 'uglifyjs-webpack-plugin' );

// Assets path.
const themeAssetsPath = './web/wp-content/themes/fooclient/assets';
const muPluginAssetsPath = './web/wp-content/mu-plugins/foo-bar/assets';

module.exports = ( env ) => {
	// Build configuration.
	const config = [ {
		// Theme config.
		entry: {
			theme: `${ themeAssetsPath }/src/theme/theme.js`,
			editor: `${ themeAssetsPath }/src/editor/editor.js`,
		},
		module: {
			rules: [
				{
					test: /\.(js)$/,
					exclude: /node_modules/,
					loader: 'babel-loader',
					options: {
						babelrc: false,
						presets: [
							[
								'@babel/preset-env',
								{
									modules: false,
								},
							],
						],
					},
				},
				{
					test: /\.(sa|sc|c)ss$/,
					use: [
						MiniCssExtractPlugin.loader,
						{
							loader: 'css-loader',
							options: {
								url: false,
							},
						},
						{
							loader: 'postcss-loader',
							options: {
								plugins: () => [ require( 'autoprefixer' ) ],
							},
						},
						{
							loader: 'sass-loader',
							query: {
								outputStyle: 'compressed',
							},
						},
					],
				},
			],
		},
		resolve: {
			extensions: [ '*', '.js' ],
		},
		output: {
			path: __dirname,
			filename: `${ themeAssetsPath }/dist/[name].js`,
			publicPath: '/',
			libraryTarget: 'this',
		},
		optimization: {
			minimize: true,
			minimizer: [
				new UglifyJsPlugin( {
					uglifyOptions: {
						output: {
							comments: false,
							beautify: false,
						},
					},
				} ),
			],
		},
		plugins: [
			new MiniCssExtractPlugin( {
				filename: `${ themeAssetsPath }/dist/[name].css`,
			} ),
		],
		externals: {
			wp: 'wp',
			jquery: 'jQuery',
		},
	},
	{
		// MU plugin config.
		entry: {
			blocks: `${ muPluginAssetsPath }/src/blocks.js`,
		},
		module: {
			rules: [
				{
					test: /\.(js|jsx)$/,
					exclude: /node_modules/,
					loader: 'babel-loader',
					options: {
						babelrc: false,
						presets: [
							[
								'@babel/preset-env',
								{
									modules: false,
									targets: { browsers: [ 'extends @wordpress/browserslist-config' ] },
								},
							],
						],
						plugins: [
							'@babel/plugin-transform-react-jsx',
							'@babel/plugin-proposal-object-rest-spread',
						],
					},
				},
				{
					test: /\.(sa|sc|c)ss$/,
					use: [
						MiniCssExtractPlugin.loader,
						'css-loader',
						{
							loader: 'postcss-loader',
							options: {
								plugins: () => [ require( 'autoprefixer' ) ],
							},
						},
						{
							loader: 'sass-loader',
							query: {
								outputStyle: 'compressed',
							},
						},
					],
				},
			],
		},
		resolve: {
			extensions: [ '*', '.js', '.jsx' ],
		},
		output: {
			path: __dirname,
			filename: `${ muPluginAssetsPath }/dist/blocks.js`,
			publicPath: '/',
			libraryTarget: 'this',
		},
		optimization: {
			minimize: true,
			minimizer: [
				new UglifyJsPlugin( {
					uglifyOptions: {
						output: {
							comments: false,
							beautify: false,
						},
					},
				} ),
			],
		},
		plugins: [
			new MiniCssExtractPlugin( {
				filename: `${ muPluginAssetsPath }/dist/[name].css`,
			} ),
		],
		externals: {
			react: 'React',
			'react-dom': 'ReactDOM',
			wp: 'wp',
			jquery: 'jQuery',
			gumponents: 'gumponents',
		},
	} ];

	// Notification for dev.
	if ( 'development' === env ) {
		config.plugins.push( new WebpackNotifierPlugin( {
			title: 'Build',
			alwaysNotify: true,
		} ) );
	}

	return config;
};
