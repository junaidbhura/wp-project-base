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
								'@babel/preset-env',
								{
									modules: false,
									targets: { browsers: [
										'ie >= 10',
										'Firefox >= 32',
										'Chrome >= 40',
										'Safari >= 6',
										'Opera >= 12',
									] },
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
								plugins: () => [ require( 'autoprefixer' )( {
									browsers: [
										'ie >= 10',
										'Firefox >= 32',
										'Chrome >= 40',
										'Safari >= 6',
										'Opera >= 12',
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
