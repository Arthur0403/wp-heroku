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
define('DB_NAME', 'heroku_f989797bec754af');

/** MySQL database username */
define('DB_USER', 'bab34a41e60288');

/** MySQL database password */
define('DB_PASSWORD', '62c3c364');

/** MySQL hostname */
define('DB_HOST', 'us-cdbr-iron-east-01.cleardb.net');

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
define('AUTH_KEY',         '8re5qddgq5awoqz6rjqymqhvhlzbqxeii0cblbdgqgkfuxwrypbyy1gbz15mqnwy');
define('SECURE_AUTH_KEY',  'bslle56jjmbs7yhx1vjwodho3qorb7qa4sndzghny3p3a16bgvl7myq6dpq8xd72');
define('LOGGED_IN_KEY',    '0szublgqujffmzfmnsisxnqasvhelzntqdv9ucma9ireuilwg5hbp0umsydsilas');
define('NONCE_KEY',        '1bgjp6lyslyugoisjhs9ejqhtb9ufuohxmv3wxnsb9bqnot6cbz0pv3xw2fwdkq2');
define('AUTH_SALT',        'hw99a429xzq9smqjbunasurety9fnndqhjunwv3afmp9hb7wtre6tcefsfbszu7t');
define('SECURE_AUTH_SALT', 't47cpuhci79cspqlvr0mmnokz01cmgius3z050bj6auibyrpjyn18lywbpvx7ie5');
define('LOGGED_IN_SALT',   'dedrmhxgb1eqjxtlvcv10n1iprr1xa1apjmom44gobtz9vabu1zk4vpxmhayhfsm');
define('NONCE_SALT',       'yvrp7m0a4bgzgttircggashpoxetp7sovyqogexikxqoeltzmg870qhn16udekdk');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wplu_';

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
