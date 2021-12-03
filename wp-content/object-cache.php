<?php
// Load the Redis plugin.
if ( ! empty( $_ENV['CACHE_HOST'] ) ) {
	require_once WP_CONTENT_DIR . '/plugins/wp-redis/object-cache.php';
}
