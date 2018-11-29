/**
 * Gulp Tasks.
 */

/**
 * Modules.
 */
var gulp         = require( 'gulp' ),
	sass         = require( 'gulp-sass' ),
	autoprefixer = require( 'gulp-autoprefixer' ),
	plumber      = require( 'gulp-plumber' ),
	rename       = require( 'gulp-rename' ),
	notify       = require( 'gulp-notify' );

var pathToTheme = 'web/wp-content/themes/fooclient';

/**
 * Build CSS.
 */
gulp.task( 'build-css', function() {
	return gulp.src( pathToTheme + '/assets/css/fooclient/fooclient.scss' )
		.pipe( plumber( {
			errorHandler: notify.onError( {
				'title': 'Gulp: CSS Build Error',
				'message': 'Line: <%= error.line %> in "<%= error.file.replace( /^.*[\\\/]/, \'\' ) %>"'
			} )
		} ) )
		.pipe( sass( {
			outputStyle: 'compressed'
		} ) )
		.pipe( autoprefixer( {
			cascade: false,
			remove: false,
			browsers: [
				'ie >= 10',
				'Firefox >= 16',
				'Chrome >= 22',
				'Safari >= 6',
				'Opera >= 12'
			]
		} ) )
		.pipe( rename( { extname: '.min.css' } ) )
		.pipe( gulp.dest( pathToTheme + '/assets/css' ) )
		.pipe( notify( {
			'title': 'Gulp: Success',
			'message': 'CSS Build Complete!'
		} ) );
} );

/**
 * Watch Files.
 */
gulp.task( 'watch', function() {
	gulp.watch( pathToTheme + '/assets/css/fooclient/*.scss', gulp.series['build-css'] );
	gulp.watch( pathToTheme + '/assets/css/fooclient/*/*.scss', gulp.series['build-css'] );
	gulp.watch( pathToTheme + '/assets/css/fooclient/*/*/*.scss', gulp.series['build-css'] );
} );

/**
 * Default Task.
 */
gulp.task( 'default', gulp.series( 'build-css', 'watch' ) );
