// External dependencies.
const MiniCssExtractPlugin = require( 'mini-css-extract-plugin' );
const WebpackNotifierPlugin = require( 'webpack-notifier' );
const TerserPlugin = require( 'terser-webpack-plugin' );
const WebpackWatchedGlobEntries = require( 'webpack-watched-glob-entries-plugin' );
const RemoveEmptyScriptsPlugin = require( 'webpack-remove-empty-scripts' );
const path = require( 'path' );

// Theme path.
const themePath = `./wp-content/themes/fooclient`;

// Config.
module.exports = ( env ) => {
	// Build configuration.
	const buildConfig = {
		entry: {
			global: `${ themePath }/src/front-end/global/index.js`,
			editor: `${ themePath }/src/editor/index.js`,
		},
		module: {
			rules: [
				{
					test: /\.(js)$/,
					exclude: /node_modules/,
					loader: 'babel-loader',
					options: {
						presets: [
							'@babel/preset-env',
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
						{
							loader: 'css-loader',
							options: {
								url: false,
							},
						},
						{
							loader: 'postcss-loader',
							options: {
								plugins: () => [
									require( 'autoprefixer' ),
								],
							},
						},
						{
							loader: 'sass-loader',
							options: {
								sassOptions: {
									outputStyle: 'compressed',
								},
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
			filename: `${ themePath }/dist/[name].js`,
			publicPath: '/',
		},
		optimization: {
			removeEmptyChunks: true,
			minimize: true,
			minimizer: [ new TerserPlugin( {
				parallel: true,
				terserOptions: {
					format: {
						comments: false,
					},
				},
				extractComments: false,
			} ) ],
		},
		plugins: [
			new RemoveEmptyScriptsPlugin(),
			new MiniCssExtractPlugin( {
				filename: `${ themePath }/dist/[name].css`,
			} ),
		],
		externals: {
			wp: 'wp',
			gumponents: 'gumponents',
		},
		performance: {
			hints: false,
		},
	};

	// Notification for dev.
	if ( 'development' in env ) {
		buildConfig.plugins.push( new WebpackNotifierPlugin( {
			title: 'Build',
			alwaysNotify: true,
		} ) );
	}

	// Components config.
	const componentsConfig = {
		...buildConfig,
		entry: WebpackWatchedGlobEntries.getEntries(
			[
				path.resolve( __dirname, `${ themePath }/src/front-end/components/**/index.js` ),
				path.resolve( __dirname, `${ themePath }/src/front-end/components/**/style.scss` ),
			],
		),
		output: {
			...buildConfig.output,
			filename: `${ themePath }/dist/components/[name].js`,
		},
		plugins: [
			new RemoveEmptyScriptsPlugin(),
			new MiniCssExtractPlugin( {
				filename: `${ themePath }/dist/components/[name].css`,
			} ),
			new WebpackWatchedGlobEntries(),
		],
	};

	// Return combined config.
	return [ buildConfig, componentsConfig ];
};
