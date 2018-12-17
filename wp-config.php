<?php

require( __DIR__ . '/vendor/autoload.php' );

if ( ! defined( 'APP_DOMAIN' ) ) {
	define( 'APP_DOMAIN', $_SERVER['HTTP_HOST'] );
}

// Set correct protocol for servers behind proxy
// See : https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/X-Forwarded-Proto
if (
	! empty( $_SERVER['HTTP_X_FORWARDED_PROTO'] )
	&& stripos( $_SERVER['HTTP_X_FORWARDED_PROTO'], 'https' ) !== false
) {
	$_SERVER['HTTPS'] = 'on';
}

// Set correct remote IP for servers behind proxy
// See : https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/X-Forwarded-For
if ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
	$forwardip              = explode( ',', $_SERVER['HTTP_X_FORWARDED_FOR'] );
	$_SERVER['REMOTE_ADDR'] = $forwardip[0];
}

// Ensure we use the correct port when in HTTPS behind proxy
$_SERVER['SERVER_PORT'] = ( $_SERVER['HTTPS'] === 'on' ) ? 443 : 80;

define( 'WP_HOME', 'https://' . APP_DOMAIN );
define( 'WP_SITEURL', 'https://' . APP_DOMAIN . '/wp' );

define( 'WP_CONTENT_DIR', __DIR__ . '/content' );
define( 'WP_CONTENT_URL', WP_HOME . '/content' );

if ( ! defined( 'DB_HOST' ) ) {
	define( 'DB_HOST', 'localhost' );
}

if ( ! defined( 'DB_CHARSET' ) ) {
	define( 'DB_CHARSET', 'utf8' );
}

if ( ! defined( 'DB_COLLATE' ) ) {
	define( 'DB_COLLATE', '' );
}

if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}
if ( WP_DEBUG ) {
	define( 'WP_DEBUG_LOG', true );
	if ( ! defined( 'WP_DEBUG_DISPLAY' ) ) {
		define( 'WP_DEBUG_DISPLAY', false );
	}

	define( 'SAVEQUERIES', true );
	define( 'SCRIPT_DEBUG', true );
	define( 'CONCATENATE_SCRIPTS', false );
}

if ( ! defined( 'DISALLOW_FILE_EDIT' ) ) {
	define( 'DISALLOW_FILE_EDIT', true );
}

if ( ! isset( $table_prefix ) ) {
	$table_prefix = 'wp_';
}

// https://api.wordpress.org/secret-key/1.1/salt/
if ( file_exists( __DIR__ . '/salt.php' ) ) {
	require( __DIR__ . '/salt.php' );
}

if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/wp' );
}

require_once( ABSPATH . 'wp-settings.php' );