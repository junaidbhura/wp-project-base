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

/**
 * Build CSS.
 */
gulp.task( 'build-css', function() {
	return gulp.src( 'assets/css/fooclient/fooclient.scss' )
		.pipe( plumber({
			errorHandler: notify.onError({
				'title': 'Gulp: CSS Build Error',
				'message': 'Line: <%= error.line %> in "<%= error.file.replace( /^.*[\\\/]/, \'\' ) %>"'
			})
		}) )
		.pipe( sass({
			outputStyle: 'compressed'
		}) )
		.pipe( autoprefixer({
			cascade: false,
			remove: false,
			browsers: [
				'ie >= 10',
				'Firefox >= 16',
				'Chrome >= 22',
				'Safari >= 6',
				'Opera >= 12'
			]
		}) )
		.pipe( rename( { extname: '.min.css' } ) )
		.pipe( gulp.dest( 'assets/css' ) )
		.pipe( notify({
			'title': 'Gulp: Success',
			'message': 'CSS Build Complete!'
		}) );
});

/**
 * Watch Files.
 */
gulp.task( 'watch', function() {
	gulp.watch( 'assets/css/fooclient/*.scss', ['build-css'] );
	gulp.watch( 'assets/css/fooclient/*/*.scss', ['build-css'] );
	gulp.watch( 'assets/css/fooclient/*/*/*.scss', ['build-css'] );
});

/**
 * Default Task.
 */
gulp.task( 'default', [ 'build-css', 'watch' ] );
