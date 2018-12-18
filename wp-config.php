<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '/GqOo5c8BHJEb/XIlLIWykFVptkEJ1BmxowSrkPzQwPlXnoLnAc7Bwqn2Yb57BWhv3CbjTulbO5Zlus63fw1kA==');
define('SECURE_AUTH_KEY',  'Pa1Q9GCb30+wpXUZVwXBOw798B6p1GwV/4tzfSXH57jjG6Jhv+nVCFJtnkxSOn3vsjByPMqmsdjNTF+GOSPHDw==');
define('LOGGED_IN_KEY',    'yOPR9kQGv6IEB2CRA8rtB5RHK+x6fikQVkMkj2RjIzQKDLMKT9cUPnjfJ1rKb/XgrJ9Yttsn4Z8Xcc370ExQFQ==');
define('NONCE_KEY',        'FdKOnG3lRT/F+EqbDKLvmY4gM1zVrDIwPk81rYhZVyq9en+yJVPvizUn43iuQemey3YC3/GvAW+pv8oD1qwt/A==');
define('AUTH_SALT',        '/Da5csJyE17V1ukGSEsCSDbMThNcACGWiJd8MAS2eZsku9WDfuWF8zJOgp/Gi3lJXRk74CzYlWq2PcfRcU5wQA==');
define('SECURE_AUTH_SALT', '+veJLyvmaB3TJugAWWIcynozrnQ36dVJfDozr6t9NUiYzgG6uDsdaUUWzHcXKXdqhZAlUNou8ioGIs5811lfww==');
define('LOGGED_IN_SALT',   '++XQNQNx5z4BtqS0p5bOKja9x2efSZBn3sIZliwYc2kN2ndJF1fV60F5OXrqnsIxUJ0PpFtkk0FL+roikETjHQ==');
define('NONCE_SALT',       'ybj1wflbHSZ3TCdbQRMhuNDCRtHfp5EhO6AJlGQt4XOTpY5HD2tqJh7tdJS8zOB5I1vKDXjgoXCMtkFofXimQg==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
