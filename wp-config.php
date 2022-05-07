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
define( 'DB_NAME', 'sab_bd' );

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
define( 'AUTH_KEY',         'IR{*]p#2lwyBx@</-MY6BXy$_c#n*C_Z5ijaeTWX;ylt-}:NAr!I)np.fg3lVoAE' );
define( 'SECURE_AUTH_KEY',  'd[;Ebl#Na*DM5I<>OfHT;6(FABIt1=x^EWM`#lf:XM35J4(7sqbVmt2os(%ZTM4L' );
define( 'LOGGED_IN_KEY',    'E<}*<rPp+O;|+nRf5$S1vuH/9(`^XSLdj[{NqRuBG0Hp]BZ-~ROuaGE[VH;QcCjh' );
define( 'NONCE_KEY',        'KBu$Ksv7$*tf$3}4pe0NK(5}K-:V}srgNk%}NePnvGy!PH$W>lSt|1W.N[wGbM$2' );
define( 'AUTH_SALT',        'pX?I!mqu%<U(BmM6z)x_.4@SY:FVGxbK*M.oCb)-FnygUevY]4!3L!4)^pw~8lot' );
define( 'SECURE_AUTH_SALT', '}8|Y^.z^miR(8+ens1Qr=rK;M&1(h&4{nUZZM[53`4`3s>H75Lm6pa Mli6Q+jV$' );
define( 'LOGGED_IN_SALT',   '1#x*G~5]zvrX,_hOmq#dDja9(i)b*QBWZS[Qi[y<*.qT%/U30GZ^u;,84jj5[DwA' );
define( 'NONCE_SALT',       'c2u*sg&leKtMA|ppY?$]Y6E+s7,oozHk[,3}86.sDvJ7#0~|TbfCdm_(D<fMkaOl' );

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
