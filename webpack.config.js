// External dependencies.
const MiniCssExtractPlugin = require( 'mini-css-extract-plugin' );
const WebpackNotifierPlugin = require( 'webpack-notifier' );
const UglifyJsPlugin = require( 'uglifyjs-webpack-plugin' );

// Assets path.
const assetsPath = './web/wp-content/themes/fooclient/assets';

module.exports = ( env ) => {
	// Build configuration.
	const config = {
		entry: {
			theme: `${ assetsPath }/src/theme/theme.js`,
			editor: `${ assetsPath }/src/editor/editor.js`,
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
								require( 'babel-preset-env' ),
								{
									modules: false,
									targets: { browsers: [
										'ie >= 10',
										'Firefox >= 30',
										'Chrome >= 35',
										'Safari >= 6',
										'Opera >= 26',
									] },
								},
							],
						],
						plugins: [
							require( 'babel-plugin-transform-class-properties' ),
							require( 'babel-plugin-transform-object-rest-spread' ),
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
								plugins: () => [ require( 'autoprefixer' )( {
									browsers: [
										'ie >= 10',
										'Firefox >= 30',
										'Chrome >= 35',
										'Safari >= 6',
										'Opera >= 26',
									],
								} ) ],
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
			filename: `${ assetsPath }/dist/[name].js`,
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
				filename: `${ assetsPath }/dist/[name].css`,
			} ),
		],
		externals: {
			wp: 'wp',
			jquery: 'jQuery',
		},
	};

	// Notification for dev.
	if ( 'development' === env ) {
		config.plugins.push( new WebpackNotifierPlugin( {
			title: 'Build',
			alwaysNotify: true,
		} ) );
	}

	return config;
};
