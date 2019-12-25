// External dependencies.
const MiniCssExtractPlugin = require( 'mini-css-extract-plugin' );
const WebpackNotifierPlugin = require( 'webpack-notifier' );
const UglifyJsPlugin = require( 'uglifyjs-webpack-plugin' );

module.exports = ( env ) => {
	// Build configuration.
	const config = {
		entry: {
			blocks: './assets/src/blocks.js',
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
			filename: 'assets/dist/[name].js',
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
				filename: 'assets/dist/[name].css',
			} ),
		],
		externals: {
			react: 'React',
			'react-dom': 'ReactDOM',
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
