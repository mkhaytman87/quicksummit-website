<?php
// Load WordPress environment
define('WP_USE_THEMES', false);
require_once('wp-load.php');

echo "<pre>";
echo "SERVER INFORMATION:\n";
echo "==================\n";
echo "PHP_SELF: " . $_SERVER['PHP_SELF'] . "\n";
echo "REQUEST_URI: " . $_SERVER['REQUEST_URI'] . "\n";
echo "SCRIPT_NAME: " . $_SERVER['SCRIPT_NAME'] . "\n";
echo "DOCUMENT_ROOT: " . $_SERVER['DOCUMENT_ROOT'] . "\n";
echo "SCRIPT_FILENAME: " . $_SERVER['SCRIPT_FILENAME'] . "\n";
echo "SERVER_NAME: " . $_SERVER['SERVER_NAME'] . "\n";
echo "HTTP_HOST: " . $_SERVER['HTTP_HOST'] . "\n";
echo "SERVER_PORT: " . $_SERVER['SERVER_PORT'] . "\n";

echo "\nWORDPRESS CONFIGURATION:\n";
echo "=======================\n";
echo "WP_HOME: " . (defined('WP_HOME') ? WP_HOME : "Not defined") . "\n";
echo "WP_SITEURL: " . (defined('WP_SITEURL') ? WP_SITEURL : "Not defined") . "\n";
echo "home_url(): " . home_url() . "\n";
echo "site_url(): " . site_url() . "\n";
echo "get_option('home'): " . get_option('home') . "\n";
echo "get_option('siteurl'): " . get_option('siteurl') . "\n";
echo "ABSPATH: " . ABSPATH . "\n";

echo "\nWORDPRESS REWRITE RULES:\n";
echo "=======================\n";
global $wp_rewrite;
print_r($wp_rewrite->rewrite_rules());

echo "\nACTIVE PLUGINS:\n";
echo "==============\n";
print_r(get_option('active_plugins'));

echo "</pre>";
?>
