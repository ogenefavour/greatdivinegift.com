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

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'britoeqa_portalfront');

/** MySQL database username */
define('DB_USER', 'britoeqa_portal');

/** MySQL database password */
define('DB_PASSWORD', 'favouredtech2018');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '12dD7F.Aa&Qa<`N0WSyNKUE*2onryaXYQm)3|cPV$.m+p|QIPxAGaF?OaOCytrue');
define('SECURE_AUTH_KEY',  '}_ &KPf91E= UW{l9iU,MI4_@?A#<154h1T-zq1g}Y}t>$D@PU6{gUnW;kSQ!D{b');
define('LOGGED_IN_KEY',    'nt7?yl@BXx&[?S.|Fa>n6.](w2NxZu-Gil]@H{MTtn@<Uj+F4EJl[J8Da:O[`,~W');
define('NONCE_KEY',        'FR:/j+wTU.H+)+Dy}4>pXp{T?rD+$NGq#dtpnmBA<<J>-mY:cW1Y-e!i}_O(,DWO');
define('AUTH_SALT',        'j  bfn.0tXU;yv&fjKYDBySTf6 k[y7{Yt$Gzdu%L)<n~$f$M{ghu*B+Gp~zN:Bs');
define('SECURE_AUTH_SALT', 'DcB2k5gR>T+2EYH ge!n_,ecZhSfhh?MM%r8I(0l|w3[MX?JKmH5F7PtLg>X1Pxj');
define('LOGGED_IN_SALT',   'YHc?~bRO-23X1q< C0mRcI`hHg);[)68D1J0&RtW~iBf@dbLHD(=@&=KM/hvTYe5');
define('NONCE_SALT',       '<r 6<c5OBhr$H0+E<1apFiu*^rC^ZH+q;d(Z}=K2eW)nS0*[e[=pfgsTm5N|{sn$');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'portal';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
