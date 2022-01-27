<?php
//Begin Really Simple SSL session cookie settings
@ini_set('session.cookie_httponly', true);
@ini_set('session.cookie_secure', true);
@ini_set('session.use_only_cookies', true);
//END Really Simple SSL

/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache

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
define( 'DB_NAME', 'edu_db' );

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
define( 'AUTH_KEY',         'vz>Og{hNFp0RRjPLV)wiZh6R<>u^Q{GVdM+kVq=*n){@Nph}r?eS-Uj|HF-1h8 =' );
define( 'SECURE_AUTH_KEY',  'ar3!V|.6%=$@`3Y ^89.z2SZe=F$TCp_@)=}5O})^(N:WU4x2}>G7wvl2t=L)V-D' );
define( 'LOGGED_IN_KEY',    '07!<X/0sjJ-p}z3-89HiTKA0z?jF1Fdag_IEn<M AN~G&8z?[S^ZtTb+57X+lT7K' );
define( 'NONCE_KEY',        'CLwRciv3D?t#zk[@Exow{#$l.DUM[;!lPttM9n,3so<Ja/Y7&8^`>QHP-P>N*FQf' );
define( 'AUTH_SALT',        '2GjUUM nh}d,-oDF9FR`=%,66MU12,j &&QQ4(;[%<Eod=(uq5lADp4XI<PY..am' );
define( 'SECURE_AUTH_SALT', 'P}2#f`Kz$n_yLnAy7rc7#i$zMtp!jXpt^&ZdnY XIKRa^Y!7:4fMx4WM!4Jj|mI_' );
define( 'LOGGED_IN_SALT',   'mx|![=3*e#,~1`gA7i2-y9E@SLXocTO/Yi5o*C,{:&ewIyp_1:I){=8&Qn FFpbL' );
define( 'NONCE_SALT',       '#M]P{vDTX0fed3#JCK T*b?/Z6L_UE<=B)jx>Aws9Khi=hzM9}h;=p.aHC&=wVpp' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'edu_';

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
