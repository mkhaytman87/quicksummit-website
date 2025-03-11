<?php
define('DB_NAME', 'mkhaytman_wp_db');
define('DB_USER', 'mkhaytman_mkhaytman');
define('DB_PASSWORD', 'NV6&X1;F&O{;87cV');  // Using same password as FTP for now - you should change this
define('DB_HOST', 'localhost');
define('DB_CHARSET', 'utf8mb4');
define('DB_COLLATE', '');

// Authentication Unique Keys and Salts
define('AUTH_KEY',         '(J%/2[GX1;1S2SR/ %*|f16}?R.a2*&; l:%tn&aa5pUr9Ha/%PSG3A5OY@_qtvp');
define('SECURE_AUTH_KEY',  '6:4q+PN:3sA_MURU}E ,s*SlRZJb %1-m9m{Nzp}{`]vH&pT_;LB#Jo*6C,]1xpB');
define('LOGGED_IN_KEY',    'VsqXQoz(K02=/*@fwzOA:<>!T|TADzj|(fmZ!)gG7c~|-PtzjuQ%{UR&[j2IZLgY');
define('NONCE_KEY',        '<_+AxxJHr*H$=(H}0E8y#|@*!hv]0c*c|#>>Ju?J{ -XH*/j!lqQ*4!_K6{}|f3D');
define('AUTH_SALT',        '94;eq|Nldy}j.O:;WVe;;v5FmPK`!T)+x}~`<aZ<dr1)3BA5+1oUZKtT]6VAVj,N');
define('SECURE_AUTH_SALT', 'HjLxuI2uTI|d|y]muEuvlY H=.Y:>!hWp(k-@lQWg-~--lV)0{0!2`Sad0$opo5}');
define('LOGGED_IN_SALT',   'w#(-xukqjSs+Vm877!R9m)HaRsIUNc5b. jEC&KLj,])y.~wzC-|+$5ZuA=)R$B|');
define('NONCE_SALT',       'u-LI1AzuC<(?|kP>L3raxG7[3RbZHQ-oFS>Z:3bp13012[-WaDxvAs3$5?3po+rP');

$table_prefix = 'wp_';

// Enable error reporting
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', true);
@ini_set('display_errors', 1);

// Custom Content Directory
define('WP_CONTENT_DIR', dirname(__FILE__) . '/wp-content');
define('WP_CONTENT_URL', 'https://quicksummit.net/blog/wp-content');

// Specify the blog's URL
define('WP_HOME', 'https://quicksummit.net/blog');
define('WP_SITEURL', 'https://quicksummit.net/blog');

if ( !defined('ABSPATH') )
    define('ABSPATH', dirname(__FILE__) . '/');

require_once(ABSPATH . 'wp-settings.php');
?>
