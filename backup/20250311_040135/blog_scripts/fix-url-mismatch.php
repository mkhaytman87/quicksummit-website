<?php
/**
 * WordPress URL Mismatch Fix
 * This script fixes the critical issue where Site URL is using HTTP while Home URL is using HTTPS
 */

// Load WordPress
define('WP_USE_THEMES', false);
require_once('wp-load.php');

// Output header
header('Content-Type: text/html; charset=utf-8');
echo '<!DOCTYPE html>
<html>
<head>
    <title>WordPress URL Mismatch Fix</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 0 auto; padding: 20px; }
        h1, h2 { color: #23282d; }
        .success { background-color: #dff0d8; color: #3c763d; padding: 10px; border-radius: 4px; margin: 10px 0; }
        .error { background-color: #f2dede; color: #a94442; padding: 10px; border-radius: 4px; margin: 10px 0; }
        .info { background-color: #d9edf7; color: #31708f; padding: 10px; border-radius: 4px; margin: 10px 0; }
        pre { background: #f1f1f1; padding: 10px; overflow: auto; }
    </style>
</head>
<body>
    <h1>WordPress URL Mismatch Fix</h1>';

// Function to log actions
function log_action($message, $type = 'info') {
    echo "<div class=\"$type\">$message</div>";
}

// Get current URLs
$home_url = get_option('home');
$site_url = get_option('siteurl');

log_action("Current Home URL: $home_url", "info");
log_action("Current Site URL: $site_url", "info");

// Check if there's a mismatch
$home_is_https = (strpos($home_url, 'https://') === 0);
$site_is_https = (strpos($site_url, 'https://') === 0);

if ($home_is_https && !$site_is_https) {
    // Fix: Update Site URL to use HTTPS
    $new_site_url = str_replace('http://', 'https://', $site_url);
    update_option('siteurl', $new_site_url);
    log_action("FIXED: Site URL updated to: $new_site_url", "success");
    
    // Also update wp-config.php if possible
    $wp_config_path = ABSPATH . 'wp-config.php';
    if (file_exists($wp_config_path) && is_writable($wp_config_path)) {
        $wp_config = file_get_contents($wp_config_path);
        
        // Check if WP_SITEURL is defined
        if (strpos($wp_config, "define( 'WP_SITEURL'") !== false) {
            // Update the WP_SITEURL constant
            $wp_config = preg_replace(
                "/define\(\s*'WP_SITEURL',\s*'http:\/\/(.*?)'\s*\);/",
                "define( 'WP_SITEURL', 'https://$1' );",
                $wp_config
            );
            
            if (file_put_contents($wp_config_path, $wp_config)) {
                log_action("FIXED: Updated WP_SITEURL constant in wp-config.php", "success");
            } else {
                log_action("Could not update wp-config.php. Please update it manually.", "error");
            }
        }
    }
} else if (!$home_is_https && $site_is_https) {
    // Fix: Update Home URL to use HTTPS
    $new_home_url = str_replace('http://', 'https://', $home_url);
    update_option('home', $new_home_url);
    log_action("FIXED: Home URL updated to: $new_home_url", "success");
    
    // Also update wp-config.php if possible
    $wp_config_path = ABSPATH . 'wp-config.php';
    if (file_exists($wp_config_path) && is_writable($wp_config_path)) {
        $wp_config = file_get_contents($wp_config_path);
        
        // Check if WP_HOME is defined
        if (strpos($wp_config, "define( 'WP_HOME'") !== false) {
            // Update the WP_HOME constant
            $wp_config = preg_replace(
                "/define\(\s*'WP_HOME',\s*'http:\/\/(.*?)'\s*\);/",
                "define( 'WP_HOME', 'https://$1' );",
                $wp_config
            );
            
            if (file_put_contents($wp_config_path, $wp_config)) {
                log_action("FIXED: Updated WP_HOME constant in wp-config.php", "success");
            } else {
                log_action("Could not update wp-config.php. Please update it manually.", "error");
            }
        }
    }
} else if (!$home_is_https && !$site_is_https) {
    // Fix: Update both URLs to use HTTPS
    $new_home_url = str_replace('http://', 'https://', $home_url);
    $new_site_url = str_replace('http://', 'https://', $site_url);
    
    update_option('home', $new_home_url);
    update_option('siteurl', $new_site_url);
    
    log_action("FIXED: Home URL updated to: $new_home_url", "success");
    log_action("FIXED: Site URL updated to: $new_site_url", "success");
    
    // Also update wp-config.php if possible
    $wp_config_path = ABSPATH . 'wp-config.php';
    if (file_exists($wp_config_path) && is_writable($wp_config_path)) {
        $wp_config = file_get_contents($wp_config_path);
        
        // Check if constants are defined
        $updated = false;
        
        if (strpos($wp_config, "define( 'WP_HOME'") !== false) {
            // Update the WP_HOME constant
            $wp_config = preg_replace(
                "/define\(\s*'WP_HOME',\s*'http:\/\/(.*?)'\s*\);/",
                "define( 'WP_HOME', 'https://$1' );",
                $wp_config
            );
            $updated = true;
        }
        
        if (strpos($wp_config, "define( 'WP_SITEURL'") !== false) {
            // Update the WP_SITEURL constant
            $wp_config = preg_replace(
                "/define\(\s*'WP_SITEURL',\s*'http:\/\/(.*?)'\s*\);/",
                "define( 'WP_SITEURL', 'https://$1' );",
                $wp_config
            );
            $updated = true;
        }
        
        if ($updated && file_put_contents($wp_config_path, $wp_config)) {
            log_action("FIXED: Updated URL constants in wp-config.php", "success");
        } else if ($updated) {
            log_action("Could not update wp-config.php. Please update it manually.", "error");
        }
    }
} else {
    log_action("No URL mismatch detected. Both Home URL and Site URL are using HTTPS.", "success");
}

// Flush rewrite rules
global $wp_rewrite;
$wp_rewrite->flush_rules(true);
log_action("Rewrite rules flushed successfully!", "success");

// Get updated URLs
$updated_home_url = get_option('home');
$updated_site_url = get_option('siteurl');

log_action("Updated Home URL: $updated_home_url", "info");
log_action("Updated Site URL: $updated_site_url", "info");

// Test post URLs
$posts = get_posts(array('posts_per_page' => 3));
echo "<h2>Test Post URLs</h2>";

if (!empty($posts)) {
    echo "<ul>";
    foreach ($posts as $post) {
        $permalink = get_permalink($post->ID);
        echo "<li><a href=\"$permalink\" target=\"_blank\">{$post->post_title}</a></li>";
    }
    echo "</ul>";
    
    log_action("Please test these links to verify the fix worked.", "info");
} else {
    log_action("No posts found to test with.", "info");
}

// Next steps
echo "<h2>Next Steps</h2>
<ol>
    <li>Visit one of the blog posts above to verify the fix worked</li>
    <li>If the issue persists, try clearing your browser cache or testing in an incognito window</li>
    <li>For security, delete this fix-url-mismatch.php file after confirming the fix works</li>
</ol>";

echo '</body>
</html>';
?>
