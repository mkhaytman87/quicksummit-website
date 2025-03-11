<?php
/**
 * Quick Fix Script for WordPress 404 Errors
 * This script attempts multiple fixes in sequence to resolve 404 errors
 */

// Load WordPress
define('WP_USE_THEMES', false);
require_once('wp-load.php');

// Output as plain text for easier reading
header('Content-Type: text/plain');

// Function to log actions
function log_action($message) {
    echo "$message\n";
}

// 1. Check and fix theme templates
function check_theme_templates() {
    $theme = wp_get_theme();
    $theme_dir = get_template_directory();
    
    log_action("\nChecking theme templates...");
    log_action("Current theme: " . $theme->get('Name'));
    log_action("Theme directory: $theme_dir");
    
    // Check if singular.php exists (OceanWP uses this instead of single.php)
    if (!file_exists("$theme_dir/singular.php")) {
        log_action("ERROR: singular.php is missing!");
        return false;
    }
    
    log_action("SUCCESS: Theme templates look good");
    return true;
}

// 2. Fix permalinks and rewrite rules
function fix_permalinks() {
    global $wp_rewrite;
    
    log_action("\nFixing permalinks...");
    
    // Update permalink structure
    $old_structure = get_option('permalink_structure');
    update_option('permalink_structure', '/%postname%/');
    log_action("Updated permalink structure from '$old_structure' to '/%postname%/'");
    
    // Flush rewrite rules
    $wp_rewrite->init();
    $wp_rewrite->flush_rules(true);
    log_action("Flushed rewrite rules");
    
    return true;
}

// 3. Check and fix .htaccess
function fix_htaccess() {
    log_action("\nChecking .htaccess...");
    
    $htaccess = ABSPATH . '.htaccess';
    if (!file_exists($htaccess)) {
        log_action("ERROR: .htaccess does not exist!");
        return false;
    }
    
    $content = file_get_contents($htaccess);
    if (strpos($content, 'RewriteBase /blog/') === false) {
        log_action("ERROR: .htaccess missing proper RewriteBase!");
        
        // Create proper .htaccess content
        $new_content = "# BEGIN WordPress\n<IfModule mod_rewrite.c>\nRewriteEngine On\nRewriteBase /blog/\nRewriteRule ^index\\.php$ - [L]\nRewriteCond %{REQUEST_FILENAME} !-f\nRewriteCond %{REQUEST_FILENAME} !-d\nRewriteRule . /blog/index.php [L]\n</IfModule>\n# END WordPress";
        
        if (file_put_contents($htaccess, $new_content)) {
            log_action("SUCCESS: Updated .htaccess with correct rules");
        } else {
            log_action("ERROR: Could not update .htaccess!");
            return false;
        }
    } else {
        log_action("SUCCESS: .htaccess looks good");
    }
    
    return true;
}

// 4. Check and fix database URLs
function fix_urls() {
    log_action("\nChecking WordPress URLs...");
    
    $home = get_option('home');
    $siteurl = get_option('siteurl');
    
    log_action("Current home URL: $home");
    log_action("Current site URL: $siteurl");
    
    // Both URLs should be HTTPS and end with /blog
    $expected_home = 'https://quicksummit.net/blog';
    $expected_site = 'https://quicksummit.net/blog';
    
    if ($home !== $expected_home || $siteurl !== $expected_site) {
        update_option('home', $expected_home);
        update_option('siteurl', $expected_site);
        log_action("Updated URLs to use HTTPS and correct path");
    } else {
        log_action("SUCCESS: URLs are correctly configured");
    }
    
    return true;
}

// 5. Test post accessibility
function test_posts() {
    log_action("\nTesting post accessibility...");
    
    $posts = get_posts(array('posts_per_page' => 3));
    if (empty($posts)) {
        log_action("ERROR: No posts found!");
        return false;
    }
    
    log_action("Found " . count($posts) . " posts to test:");
    foreach ($posts as $post) {
        $url = get_permalink($post->ID);
        log_action("Post #{$post->ID}: {$post->post_title}");
        log_action("URL: $url");
        
        // Test URL accessibility
        $headers = @get_headers($url);
        $status = $headers ? substr($headers[0], 9, 3) : 'Unknown';
        log_action("Status: $status");
    }
    
    return true;
}

// 6. Check wp-config.php settings
function check_config() {
    log_action("\nChecking wp-config.php settings...");
    
    // Check if WP_HOME and WP_SITEURL are defined correctly
    if (!defined('WP_HOME') || !defined('WP_SITEURL')) {
        log_action("ERROR: WP_HOME or WP_SITEURL not defined!");
        return false;
    }
    
    if (WP_HOME !== 'https://quicksummit.net/blog' || WP_SITEURL !== 'https://quicksummit.net/blog') {
        log_action("ERROR: WP_HOME or WP_SITEURL have incorrect values!");
        return false;
    }
    
    log_action("SUCCESS: wp-config.php settings look good");
    return true;
}

// Run all checks and fixes
log_action("Starting WordPress 404 Quick Fix...\n");

$success = true;
$success &= check_theme_templates();
$success &= fix_permalinks();
$success &= fix_htaccess();
$success &= fix_urls();
$success &= check_config();
$success &= test_posts();

if ($success) {
    log_action("\nAll fixes have been applied successfully!");
    log_action("Please try accessing your blog posts now.");
    log_action("If issues persist, try clearing your browser cache or testing in an incognito window.");
} else {
    log_action("\nSome issues were encountered during the fix process.");
    log_action("Please review the logs above for specific errors.");
}

// Add debug information
log_action("\nDebug Information:");
log_action("WordPress Version: " . get_bloginfo('version'));
log_action("Theme: " . wp_get_theme()->get('Name'));
log_action("PHP Version: " . PHP_VERSION);
log_action("Web Server: " . $_SERVER['SERVER_SOFTWARE']);
?>
