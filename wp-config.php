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
define('DB_NAME', 'delicappDBiucir');

/** MySQL database username */
define('DB_USER', 'delicappDBiucir');

/** MySQL database password */
define('DB_PASSWORD', 'lx4AJRXglu');

/** MySQL hostname */
define('DB_HOST', '127.0.0.1');

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
define('AUTH_KEY',         'pmjMYF}FQ7,v$7,rbj$nvfMnUfM3MYE{3^6<3^m^{$fMX4!sZk~kRZGgoVdJ08N8G');
define('SECURE_AUTH_KEY',  'H2_t;*pW+lWKeO9]O5H1_~pal[-KhtdK1yfqXEXjQ7<ITA.u*3^mXj.qXiPiPbL2T');
define('LOGGED_IN_KEY',    'T.|0@oRczgN4FgN4,0J0@>v3^nzgzgrcJjQcIJUB>v^dO1D[D:-#t:-|wdwdlVCd');
define('NONCE_KEY',        '~_s~lRlwdK1CdK4!:G:-|sqbHTATAL2.D]6.q.;*mTt*mS9LeP6D;O5_;+2*lxeB>');
define('AUTH_SALT',        'gnUEM7MYI{$7I$ju<ufMXVC[-|8|wdo[zgNZsZK08cJ0C|C[4!o>z,rYr@kR8J#x');
define('SECURE_AUTH_SALT', '@F}@,r>v!nU1D]xh+#teLlxdK5OaH:-9G:~lw]wdpW-hOZGZGS8|.yiPbubITAbH');
define('LOGGED_IN_SALT',   'ufPjPbIPbH;+<A<xeq]xemWqXiP6z,nUcJckRYB>4Q7F}z^4B,r@g^}vbjQjrYfM');
define('NONCE_SALT',       'VwdpZGdOVG[GS8|s~8|w@o!oVhNsZGRCVC[4!iP6H;H;A<u;*]xex.qWDPpWDO5P5');

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
define('WP_DEBUG', false);define('FS_METHOD', 'direct');

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
