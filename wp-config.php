<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'u1764051_wp411' );

/** Database username */
define( 'DB_USER', 'u1764051_wp411' );

/** Database password */
define( 'DB_PASSWORD', '.0p7wS3D(c' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'danvcmfqhrrvyawvotmxbwgbbzo77n5ml50eubqfgjja6z5xqgl9gov8xdysrxwm' );
define( 'SECURE_AUTH_KEY',  'rfwrseh93zziogx87xx3ni7nxfq5bshwghhpmj31t1kls8yrbv7rornjebaaximg' );
define( 'LOGGED_IN_KEY',    'sqccijkdkqlpcbwof9xjdhsxixqpov175od0gwywzpyseyx3ziadii4iufpmjqnt' );
define( 'NONCE_KEY',        'v5cde3ummtdfq3ymbadyrlcm63ewfehao2bpdtksksb3dn66clsqvouz48trsjrd' );
define( 'AUTH_SALT',        'puzlvcq0msiuebishxq2husx5tius3iszultnscpsc8frmgleep7pp7vxy6tr2yo' );
define( 'SECURE_AUTH_SALT', '0sgsxwprh3fhkc5ehzoadvmelvdyr2iltjf6vajyepbea0bwkakjoyy1x5v4ghzz' );
define( 'LOGGED_IN_SALT',   'ajvoktfmloyclxx9dcc2cnp7pcad3nngfjghzsm6rru1jvmol8g5fa8guxxnwgux' );
define( 'NONCE_SALT',       'fpa8hnbxayzilm54j6ojipxeyavmmeiyhvlmvr8aavignmhpthtmwbhcfdyqshzd' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wpor_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
