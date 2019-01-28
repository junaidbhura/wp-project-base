<?php
/**
 * Configuration overrides for WP_ENV === 'production'
 *
 * @package config
 */

use Roots\WPConfig\Config;

Config::define( 'DISALLOW_WP_CRON', true );
