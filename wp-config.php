<?php
/**
 * The base configurations of the WordPress.
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
define('DB_NAME', 'database_name_here');

/** MySQL database username */
define('DB_USER', 'username_here');

/** MySQL database password */
define('DB_PASSWORD', 'password_here');

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
define('AUTH_KEY',         '+jm=(bQ+=L$3eyJ5rB>M Q.t[No-V1|-fgI+T2{dS:Gw>^O+0=TJMj5f8?*DOLSg');
define('SECURE_AUTH_KEY',  '4UF%w9A=R!T%R&5$gdo2fm.rC.,|mX|$Kvvv%T!`E9|rREs{v+uXOKSRLSNk;8t7');
define('LOGGED_IN_KEY',    '|ZLyFm?=JV(suL)(D4&H?ywJgjz;cVC|M-lk&z<#/Y|V;q2O)>/:=?GX^B;mvh$v');
define('NONCE_KEY',        '|EjLbs--jX+#jp|{Py,qtmwgvZ|]O[a#**?/*cRBf27c0+}(14!*y|4,2^2B SXi');
define('AUTH_SALT',        'zG6ES0Ju`srn[F7Y4,G47T_e@`RbroJlHua3>L pL3~Wo1-c-@eD>x|RQ1_+5&Sd');
define('SECURE_AUTH_SALT', 'G[t!Vmo<?$Z6x.K4M;eW^t`^#ybM;w$6dLy{}3]7T{?%M`|QB>qW,H,^![z-<h-9');
define('LOGGED_IN_SALT',   '7hUAfgl0%e {(@(Qf,6hc>j(2F-!M%qRWz03U5-1T.|K5e9m-if WZ!f?51p&w.Q');
define('NONCE_SALT',       'MQe}fe-+szYBzyOK5h@*|T{T5x(-#_R%kK~#LvSW>~j|1dviUe|TSq+pnlgG%<f?');

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
