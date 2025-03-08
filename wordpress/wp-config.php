<?php
// Load environment variables if available
if (file_exists(dirname(__FILE__) . '/.env')) {
    // Include directly since it contains PHP define statements
    include dirname(__FILE__) . '/.env';
}

// Database Configuration
define('DB_NAME', defined('DB_NAME_ENV') ? DB_NAME_ENV : 'mkhaytman_wp_db');
define('DB_USER', defined('DB_USER_ENV') ? DB_USER_ENV : 'mkhaytman_mkhaytman');
define('DB_PASSWORD', defined('DB_PASSWORD_ENV') ? DB_PASSWORD_ENV : 'NV6&X1;F&O{;87cV');
define('DB_HOST', defined('DB_HOST_ENV') ? DB_HOST_ENV : 'localhost');
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

// Enable detailed error reporting
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', true);
define('SCRIPT_DEBUG', true);
@ini_set('display_errors', 1);
@ini_set('log_errors', 1);
@ini_set('error_log', dirname(__FILE__) . '/wp-content/debug.log');

// Custom Content Directory
define('WP_CONTENT_DIR', dirname(__FILE__) . '/wp-content');
define('WP_CONTENT_URL', 'https://quicksummit.net/blog/wp-content');

// Specify the blog's URL
define('WP_HOME', 'https://quicksummit.net/blog');
define('WP_SITEURL', 'https://quicksummit.net/blog');

// Additional Security Measures
define('DISALLOW_FILE_EDIT', true);  // Disable file editing from WordPress admin
define('DISALLOW_FILE_MODS', true);  // Disable plugin/theme installation from WordPress admin
define('AUTOMATIC_UPDATER_DISABLED', false);  // Keep automatic updates enabled for security
define('WP_AUTO_UPDATE_CORE', 'minor');  // Enable automatic updates for minor WordPress versions

// Disable XML-RPC by default (uncomment if needed)
// define('XMLRPC_ENABLED', false);

// Force SSL for admin and login
define('FORCE_SSL_ADMIN', true);
define('FORCE_SSL_LOGIN', true);

if ( !defined('ABSPATH') )
    define('ABSPATH', dirname(__FILE__) . '/');

require_once(ABSPATH . 'wp-settings.php');
?>
