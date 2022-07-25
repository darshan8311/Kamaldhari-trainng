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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'kedance_db' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         '!a &zHS^,=@RUs6;/c1Jj(wRqhN@.eeWEL~G<L`R0#45NHM7F%(}27ERvAPOqd)~' );
define( 'SECURE_AUTH_KEY',  'vcZ9:?0rI[UKX4:6G-qg*X*7!S@UHR,MNx/?z7~/!Q7l17K )V;o]n{sn?hc*-3l' );
define( 'LOGGED_IN_KEY',    'UQY@D#Y#vuL$9`yA!yX4;cvB+;8FqG6*q{2`:jDrx;B@D?YmkIv,Vz*9qty)Q,pt' );
define( 'NONCE_KEY',        'G<3 3$#427@47)TS}$ZgQ;b!)(cJ(dB$ej7f]-FWi{z*(?XM;=nTVIN}&X0d543$' );
define( 'AUTH_SALT',        'bc/:<plb`xs,Jf0-K6O6`o`M?cibZJBydy_0#^oHUf>&N_iz73v(qV%CBD},eh-Q' );
define( 'SECURE_AUTH_SALT', 'a[B~Be*jcTb8V#[e8+2BD~f2TI/LEQYSx~n=%*BQ>E.8{~MH{a6``cP*}l~L.3U~' );
define( 'LOGGED_IN_SALT',   '|~Pi)aZ}:qt_p&pBMT3XT7Rk^9|m8#{/?4{ay0EL_;K(r-L_w3Hh]8LG`se`TgyJ' );
define( 'NONCE_SALT',       'x-M;_Yg5-$cTog2ae!W-~Vjad%>3YAwb.4z]aic]RD-BGW9@8QrObmu] pY<nGGR' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
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
