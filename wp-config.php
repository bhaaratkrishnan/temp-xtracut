<?php
define( 'WP_CACHE', true );
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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'u753036200_2EyVi' );

/** Database username */
define( 'DB_USER', 'u753036200_dG1hk' );

/** Database password */
define( 'DB_PASSWORD', 'pEmDNMQUhg' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1' );

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
define( 'AUTH_KEY',          '6Fyt1FVCrvQC6COOEhraG*BT^OX71%gppPrt+6r#p@q+1Pxaz f_jC<G9;8bys#A' );
define( 'SECURE_AUTH_KEY',   'ih/5GQHXp%2i!TehkWuV1|s1y8;OiB+f!DKWW*2/-z>IP0S4Ti^It[A[,KEKfgK%' );
define( 'LOGGED_IN_KEY',     'X&iaaiUZfvyv d4fieG5q:Jz<0d=D{ymY+(8-kTa,fug,<cbZ,[H{W,3. )P:I$V' );
define( 'NONCE_KEY',         'T56!#gMR=V8O5zdq?pjUK_lIO+>aC*t<2[[,i&EjVK-$;?T#PooUdoJjy_bf.2JZ' );
define( 'AUTH_SALT',         '$BX79l;1Q[m.lZ~#>g|/M;<Zrx@)$4bz7O- 1df>O}.)+e3ahYkHH0TjTs2$a`a2' );
define( 'SECURE_AUTH_SALT',  ':_wmR}ODn@s{-_#&14SD@Fr<MMV:71~*9v#{NE.(Qk[eLE9hQ<3Vu~*%gR,h(.ty' );
define( 'LOGGED_IN_SALT',    '8,<x[@}R;z?0!{(WXYPe]m#%5|.} |(]whaPC1xv_V?TbK]aJ(RnAi[#O?pN!{A?' );
define( 'NONCE_SALT',        '`aKe:Q<xB{H4a3o1`3+*k0%nWw`L3n3x6nrFmU[3%{ew ,o2{65l:_U6 tI*E<U}' );
define( 'WP_CACHE_KEY_SALT', '7Vr`pBR1=!aK.Qn6fifP/ks$rt^djRDE.^Nkt$Ve$eEmH(>iMfaL1*~:Bia[Fr)v' );


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



define( 'FS_METHOD', 'direct' );
define( 'WP_AUTO_UPDATE_CORE', false );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
