<?php
 /**
 *The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'WP1');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'Evostorm!');

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
define('AUTH_KEY',         'q)xdJ}|?d&2`aaGN>W&aI$,Py-k/#=:1+23r+fGVVB|.JMZqiN %Pcl!/e%+lah-');
define('SECURE_AUTH_KEY',  '1MJXNz+)^v9g+{K,l@?`XWE-H@|R?oo]8z1D2@oja^KX&(+|`ZnYV8Wgn0Gfw+cj');
define('LOGGED_IN_KEY',    '.3_rzRA&@+f33+3Dd!ho1)>S1mG r.O_)3<;Si-k%4|nKhf?)ryHW-Y^$x}Oir@W');
define('NONCE_KEY',        '$-:g~P>ltCuurCT,ItnKA!cyonecYU~:x%q2/CBgxdWzvx$>>VTQ:1(k|Q<5WlNI');
define('AUTH_SALT',        'FHkcV 5$mAmC7++P <+:[fjC>S+kU=/MoM.WC7Or+bp0WXl|S:WykG.SeoJ%d2~D');
define('SECURE_AUTH_SALT', 'bSW+DDEK9Vs1R0lyB[Wu0T+-PN wZe$fyaB85*u6;#XrZf|$+SI|Kx+2yUb-sCt+');
define('LOGGED_IN_SALT',   'WW-!,M%YCK#:dc|~MF:*4Jty#.[s*epO5>YEHjk@HeJ}m+<i4<N,O-J%dogYBy>3');
define('NONCE_SALT',       '}mrX|nScIV:$5<wL^?(/i?ST*V8]^Jv?L)<OJd@c-Q71ox$;;-77cQiaHK~#65e3');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

?>
