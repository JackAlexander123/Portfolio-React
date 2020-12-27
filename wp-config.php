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
define('AUTH_KEY',         'us3/sXDcVpW0HaK2HuchP5C8GYarpibbNE/9FO4eXnhb+QDRmDWKI29JDtlYfOLI4t8qJh4dxVUH52NMVPSOYg==');
define('SECURE_AUTH_KEY',  'DcFTJmZrN0VPhxtjR6PEkxYarE66jKMTgaGbTle73ZT/gwXJqaWQi91DG0J1o6v4rpx4YMh0fMZz63a628Nhog==');
define('LOGGED_IN_KEY',    'c6bZvHWoGEeRfcVgMt7rjEoM7OPVJcf0hVDGaSX2iGTZn7x5/YM06RRRYvcPFte6MuY8DG3irwCdG95bRRttBA==');
define('NONCE_KEY',        'b7dSA4TdrRdKKOOtMR9jSSoZgo6aifWEvyeP8PekBYZ7C2A+uXyqFjC/k47GC8r37zw+cMQVmZubryvjHDyDwA==');
define('AUTH_SALT',        'XzUhJUuJIHw6xS3yZ99ciEQOWIG2I/VOHImSUxjkPC8O3/kfI5AWrh2Sszc+Wzlko5PNk6/TYP27AdnJuAb9LA==');
define('SECURE_AUTH_SALT', 'yW67QMS+2pS0ditN8feGbFNDQwhHqDXu3KyuptLPwRdrahi7CZW4SuvIADwNPgNl3UspBfCFlSB++SRmlEje8g==');
define('LOGGED_IN_SALT',   '43GgnuGhmZgHd6Nzy0Udtw0EEURm8X6GdFu2JkrwQCLlCyUF+4qLcytObt/Kzok0DnbzJpWKu9fiKESsdTi2UA==');
define('NONCE_SALT',       '+GUt7OCAbpSHLLYTZzxIKkovatADI4ru0UkXGNjdv7nVzUaMRE60DM9Dll6h6txjR9/Tp0EpbCMj9lOerGpkvA==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


define( 'WP_DEBUG', true );

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
