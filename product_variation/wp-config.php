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
define( 'DB_NAME', 'product_variation' );

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
define( 'AUTH_KEY',         'Ser.)G(sy9=HV.Z:;8>e8kqYJj~@g<jK:8~TU2rV[P|4I-2~+gX(d>Q*T Q7Ma#?' );
define( 'SECURE_AUTH_KEY',  '4qhEI}ZLX]n4A3^oRm.#~b|+yl-% }ow~}xD4O,.hY04j`%=/KibGD0T%?UC{x.E' );
define( 'LOGGED_IN_KEY',    'F(5CM+~xwY!>+MS,uNggBqZzV8AL^4+n-p@6A VyWgqL2!KGMg}`g<oOKE;S$Ye0' );
define( 'NONCE_KEY',        '#%qT;blu ZDx~pgJueKh4xGuF9g2XMP 9Xt//`26yF=ZC{>bp*?FQ:i@SH,z7y5u' );
define( 'AUTH_SALT',        'Nc3Ac|>*I`4cK6*U:vW}t*MM][dN@#ACK/qX2II@W;r@R1;b]W9l[!E`-+5r#)~G' );
define( 'SECURE_AUTH_SALT', 't(A9/|CP|w`A8v6hv(GKb$Xw]RrzhGC+8|kHHr<qxDDp]pe>?6[]aAr<{y1CmN%r' );
define( 'LOGGED_IN_SALT',   's3h2cJ2C&sr/8Y@[ Fq>fj8CTH%~ytlEb0m(}c4g*`.JGE4[=aF5swXCb7 <Kbag' );
define( 'NONCE_SALT',       'ZB8,AetOXK J-t_Z4:J4pbv!Gy_(MSGc[#Q(2!hSJdCMMy,Vd+08kp=TCku/Pt_#' );

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
