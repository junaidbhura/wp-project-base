<?php
/**
 * WordPress Configuration.
 *
 * @package WordPress
 */

use function Env\env;

/**
 * Composer Autoloader.
 */
require_once __DIR__ . '/vendor/autoload.php';

/**
 * Use Dotenv to set required environment variables and load .env file in root.
 */
$dotenv = Dotenv\Dotenv::createImmutable( __DIR__ );
if ( file_exists( __DIR__ . '/.env' ) ) {
	$dotenv->load();
	$dotenv->required( [ 'WP_HOME', 'WP_SITEURL' ] );
	if ( ! env( 'DATABASE_URL' ) ) {
		$dotenv->required( [ 'DB_NAME', 'DB_USER', 'DB_PASSWORD' ] );
	}
}

/**
 * Set up our global environment constant and load its config first.
 * Default: development
 */
define( 'WP_ENVIRONMENT_TYPE', env( 'WP_ENVIRONMENT_TYPE' ) ? env( 'WP_ENVIRONMENT_TYPE' ) : 'development' );

/**
 * URLs.
 */
if ( isset( $_SERVER['HTTP_HOST'] ) ) {
	define( 'WP_HOME', 'https://' . $_SERVER['HTTP_HOST'] );
	define( 'WP_SITEURL', 'https://' . $_SERVER['HTTP_HOST'] . '/wp' );
} else {
	define( 'WP_HOME', env( 'WP_HOME' ) );
	define( 'WP_SITEURL', env( 'WP_SITEURL' ) );
}

/**
 * Custom Content Directory.
 */
define( 'CONTENT_DIR', '/wp-content' );
define( 'WP_CONTENT_DIR', __DIR__ . CONTENT_DIR );
define( 'WP_CONTENT_URL', WP_HOME . CONTENT_DIR );

/**
 * DB settings.
 */
define( 'DB_NAME', env( 'DB_NAME' ) );
define( 'DB_USER', env( 'DB_USER' ) );
define( 'DB_PASSWORD', env( 'DB_PASSWORD' ) );
define( 'DB_HOST', env( 'DB_HOST' ) ? env( 'DB_HOST' ) : 'localhost' );
define( 'DB_CHARSET', 'utf8mb4' );
define( 'DB_COLLATE', '' );
$table_prefix = env( 'DB_PREFIX' ) ?: 'wp_'; // phpcs:ignore

if ( env( 'DATABASE_URL' ) ) {
	$dsn = (object) wp_parse_url( env( 'DATABASE_URL' ) );

	define( 'DB_NAME', substr( $dsn->path, 1 ) );
	define( 'DB_USER', $dsn->user );
	define( 'DB_PASSWORD', isset( $dsn->pass ) ? $dsn->pass : null );
	define( 'DB_HOST', isset( $dsn->port ) ? "{$dsn->host}:{$dsn->port}" : $dsn->host );
}

/**
 * Authentication Unique Keys and Salts.
 */
define( 'AUTH_KEY', env( 'AUTH_KEY' ) );
define( 'SECURE_AUTH_KEY', env( 'SECURE_AUTH_KEY' ) );
define( 'LOGGED_IN_KEY', env( 'LOGGED_IN_KEY' ) );
define( 'NONCE_KEY', env( 'NONCE_KEY' ) );
define( 'AUTH_SALT', env( 'AUTH_SALT' ) );
define( 'SECURE_AUTH_SALT', env( 'SECURE_AUTH_SALT' ) );
define( 'LOGGED_IN_SALT', env( 'LOGGED_IN_SALT' ) );
define( 'NONCE_SALT', env( 'NONCE_SALT' ) );

/**
 * Local Settings.
 */
define( 'SAVEQUERIES', true );
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_DISPLAY', true );
define( 'SCRIPT_DEBUG', true );
define( 'DISALLOW_WP_CRON', false );
ini_set( 'display_errors', 1 ); // phpcs:ignore

/**
 * Allow WordPress to detect HTTPS when used behind a reverse proxy or a load balancer.
 *
 * @see https://codex.wordpress.org/Function_Reference/is_ssl#Notes
 */
if ( isset( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) && 'https' === $_SERVER['HTTP_X_FORWARDED_PROTO'] ) {
	$_SERVER['HTTPS'] = 'on';
}

/**
 * Redis Cache.
 */
$redis_server = array(
	'host' => env( 'CACHE_HOST' ),
	'port' => env( 'CACHE_PORT' ),
);

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/wp/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
