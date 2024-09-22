<?php

/**

 * The base configuration for WordPress

 *

 * The wp-config.php creation script uses this file during the installation.

 * You don't have to use the website, you can copy this file to "wp-config.php"

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

define( 'DB_NAME', 'ideasystems_neom1' );


/** Database username */

define( 'DB_USER', 'ideasystems_neom1' );


/** Database password */

define( 'DB_PASSWORD', 'X.NymSc6QaPMgfcDfnY63' );


/** Database hostname */

define( 'DB_HOST', 'localhost' );


/** Database charset to use in creating database tables. */

define( 'DB_CHARSET', 'utf8' );


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

define('AUTH_KEY',         'RFIXt0fPFy9MChRATq6xVzVP8OXfEz8yN87QxTdJs7mC8aayQ445C8H1xNWhrrGg');

define('SECURE_AUTH_KEY',  'i2p4Nn1PTLQAQGz3EgSrw2jxm5jRY07BRatAklGxZtYTO3T4UsnmlAb1bDeGO8NK');

define('LOGGED_IN_KEY',    'bB0NzMB8YL87TnK43wDd0vBK3NMBthgqf5MhiPJUyMTEPT1QWt5HCJvTme8QDK3e');

define('NONCE_KEY',        'ZaqDi0BlXZ8FVn5rHbcJ06ef2nKa5hTr2Xv7WYNvO92ZuY04BXJlQYd57VXBrBPg');

define('AUTH_SALT',        '3Dtdn98kIliO45Q5xBRrGwMvmdjJYe4DAp9Kx52K9uCGFt1bYBENPOW9FeVA9tQH');

define('SECURE_AUTH_SALT', 'r4jpuYcROiyUwtpZTOEOTGPyiXeRa8zybKEuctWzt9O8XX6bswwzI5MuDjrYuS72');

define('LOGGED_IN_SALT',   'Rpes3tFQD20y93tHUlwwUKRbGI9NZ7rJ13jrUicj5MKe04MQB10JxOFFwlioARWh');

define('NONCE_SALT',       '4yB5OcBVNVD6wOY33Goop3ElA5wrTx183F4dUWjf8n6KRhTXA2P0Fd3TmuJ8m7Xa');


/**

 * Other customizations.

 */

define('WP_TEMP_DIR',dirname(__FILE__).'/wp-content/uploads');



/**#@-*/


/**

 * WordPress database table prefix.

 *

 * You can have multiple installations in one database if you give each

 * a unique prefix. Only numbers, letters, and underscores please!

 */

$table_prefix = 'una4_';


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




define( 'DISALLOW_FILE_EDIT', true );
define( 'CONCATENATE_SCRIPTS', false );
/* That's all, stop editing! Happy publishing. */


/** Absolute path to the WordPress directory. */

if ( ! defined( 'ABSPATH' ) ) {

	define( 'ABSPATH', __DIR__ . '/' );

}


/** Sets up WordPress vars and included files. */

require_once ABSPATH . 'wp-settings.php';

