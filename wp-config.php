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
define('WP_CACHE', true); //Added by WP-Cache Manager
define( 'WPCACHEHOME', '/var/www/html/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'wordpress');

/** MySQL database password */
define('DB_PASSWORD', 'ybkJiFtMHU');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'OC_*Dt>&l2dC.V,.+7a$SsA:$vkPp)+jw[kXgcpG4?eM)p7Xw7{-,/6%EEn!9b}u');
define('SECURE_AUTH_KEY',  'P1%}Jj]>fw~9KND<}2q@+;d7R bDki~4UXnc-krPnDnZ-;92i~Q:X2^iPE^p76=*');
define('LOGGED_IN_KEY',    '.90`jz@=>M skv$Goz?ZWzzR>(b1?^S-!eq;}m@Q~9DJX6Ke3>}o4cn(TvM?O{1A');
define('NONCE_KEY',        '@bqI5O_|7A T=%BI[mI)fNgb}C<t.`~?}[d$`JKB7]r-#3L7&Z>T,48 !eTKNsgc');
define('AUTH_SALT',        'stWZf`Z35,[p^lJ#g3ZT4l?f=*de6A~w]G1x$:veOGp,`Ah`]O&rvM/CQl@$^im-');
define('SECURE_AUTH_SALT', '>`U0gk03Hv(0g!ACrVfPinRTa%p!YHFY`@,VuhZU{Z<]FU]@CB3{;Zy)CyA4NhjH');
define('LOGGED_IN_SALT',   'ryf7z01c}b(,~25AWdt:dfFkaI[N.q_<q# esVJ1Ravl49}c*#2tA-xK!Qv0]Wh6');
define('NONCE_SALT',       '1v0,9=hrbh<f$O2-&h4%g#1nd_!FqacZh#OvM-Z!t8)*msP1}=8S2+7abUt~ZG(m');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
