<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'redowl');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         'O|{9om+v40fWNqirdygrSz>E|wLpTP7G}@-HsV0Wz@DYrMIVi%q;Y{Sa9bA4r4}|');
define('SECURE_AUTH_KEY',  '_:aq|m9y!|H$^*SB&/g4CJ[N8+W`z:d{y|O>7W2F-SQ|f/+aT?IH}/NI,-OI{Xpl');
define('LOGGED_IN_KEY',    'G,95c/;2c<]&j6,-) ]q)B|j^Y4tE02WjIXe5,!ja)#><.zVqnaQzQhwb)=_DwKP');
define('NONCE_KEY',        '(OlFgOBfMC~#9J* PnN}S$t>Er4d[[&GQjDl,)>D.4$jOL,Id~(oB_*I`Fc}^K)z');
define('AUTH_SALT',        'De<S=hVq>(+9A`</(P_cR{sPSlQfnY]F+.1[&H~GNkQ.`N8ApEX|EZ[;c[BxP^0,');
define('SECURE_AUTH_SALT', 'aQaP+}fzIHxapplOK.A a$56 ?B-HPO~k}y7X@a>+T+U(O({@X;c<DDW/w+@=gzn');
define('LOGGED_IN_SALT',   'bB-v=xn&rT#1w!}|*v&^~ZxN{pUKm,Y{oi8yRg+-cqX1:}|--UliT&3>78wLL<[y');
define('NONCE_SALT',       ')pO#hr<k_8u%F+R$r -?ipaHD0o*wkN/|w[N#bp&E}}9$Ub(CLV)+8>Iy,[wz=;l');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
