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
define('DB_NAME', 'jennyada_lifeline');

/** MySQL database username */
define('DB_USER', 'jennyada_ll');

/** MySQL database password */
define('DB_PASSWORD', '1if31in3Wordpress');

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
define('AUTH_KEY',         'E{dz&$ydZYdU#6ZyTmgRB1mxKJ{`9Y_Y]h^U6sIxQfK+#Lzn{> 5K0rEsLw*<_iw');
define('SECURE_AUTH_KEY',  'cq%+.zFp=qh,iCv=,wK~M1P^7:S2]wX_UrA(m{f~/xuK;X8GUlQ|*.E&%[~y#Gp{');
define('LOGGED_IN_KEY',    'X9a+}TTFNV1PQn|u{-I4{xNj|^cL2-jp5[Cv,xB;w?La_.I@~:v7q/-+wv_.:h[%');
define('NONCE_KEY',        '<^9j3NDtk52A .op~!Z#$|<QnH7{oF/[Ix#@ivM_%/J!9uM ~VHnDn!OwhlG{5}8');
define('AUTH_SALT',        'Cj*u60w@fJLe&$EzI1TO{LQ,<>w1[neT.fbPP;]K,v^}-:Tl7cM.zh^P{x|>5H}7');
define('SECURE_AUTH_SALT', '3{:s3Ke+A[A}(W??_n~MM}z28s|d^^POY(-M*R J79j!+fAzHG??_#=yDa~SB6@N');
define('LOGGED_IN_SALT',   'C]jw6?D3++$@$2.fJxkiAjS#:s`c%h*yRT7{Rby5<r<8Ge^m|5eB570a=#.{^#q-');
define('NONCE_SALT',       'S&peWRD$V?/p&q[OX2K;?~zke5KEY=-I!x6*y?ERuE6y9Z?`]5qoo.D#8Eh32V2{');

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
