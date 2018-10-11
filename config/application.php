<?php
/**
 * WordPress Configuration.
 */

/**
 * Environments.
 */
if ( file_exists( dirname( __FILE__ ) . '/environments/local.php' ) ) {
	include dirname( __FILE__ ) . '/environments/local.php';

	defined( 'ENV_DEVELOPMENT' ) || define( 'ENV_DEVELOPMENT', true );
	defined( 'WP_DEBUG' ) || define( 'WP_DEBUG', true );
} elseif ( file_exists( dirname( __FILE__ ) . '/environments/production.php' ) ) {
	include dirname( __FILE__ ) . '/environments/production.php';

	defined( 'ENV_DEVELOPMENT' ) || define( 'ENV_DEVELOPMENT', false );
}

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 */
define( 'AUTH_KEY',         '' );
define( 'SECURE_AUTH_KEY',  '' );
define( 'LOGGED_IN_KEY',    '' );
define( 'NONCE_KEY',        '' );
define( 'AUTH_SALT',        '' );
define( 'SECURE_AUTH_SALT', '' );
define( 'LOGGED_IN_SALT',   '' );
define( 'NONCE_SALT',       '' );

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * Database Charset to use in creating database tables.
 */
if ( ! defined( 'DB_CHARSET' ) ) {
	define( 'DB_CHARSET', 'utf8mb4' );
}

/**
 * The Database Collate type. Don't change this if in doubt.
 */
if ( ! defined( 'DB_COLLATE' ) ) {
	define( 'DB_COLLATE', 'utf8mb4_general_ci' );
}

/**
 * Define path & url for Content.
 */
defined( 'WP_CONTENT_DIR' ) || define( 'WP_CONTENT_DIR', dirname( __DIR__ ) . '/web/wp-content' );
defined( 'WP_CONTENT_URL' ) || define( 'WP_CONTENT_URL', WP_HOME . '/wp-content' );

/**
 * Prevent editing of files through the admin.
 * Enable installing and upgrading plugins f|| dev sites.
 */
define( 'DISALLOW_FILE_EDIT', true );
if ( defined( 'ENV_DEVELOPMENT' ) ) {
	define( 'DISALLOW_FILE_MODS', ! ENV_DEVELOPMENT );
}

/**
 * Enable WordPress cache for production sites.
 */
if ( ! defined( 'ENV_DEVELOPMENT' ) || false === ENV_DEVELOPMENT ) {
	defined( 'WP_CACHE' ) || define( 'WP_CACHE', true );
}

/**
 * Disable WordPress cron.
 */
if ( defined( 'ENV_DEVELOPMENT' ) ) {
	define( 'DISABLE_WP_CRON', ! ENV_DEVELOPMENT );
}

/**
 * WP CLI Fix.
 *
 * @see https://make.wordpress.org/cli/handbook/common-issues/#php-notice-undefined-index-on-_server-superglobal
 */
if ( defined( 'WP_CLI' ) && WP_CLI && ! isset( $_SERVER['HTTP_HOST'] ) ) {
	$_SERVER['HTTP_HOST'] = '';
}

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/wp/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
