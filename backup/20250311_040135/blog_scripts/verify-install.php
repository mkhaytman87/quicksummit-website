<?php
/**
 * WordPress Installation Verification Script
 * This script checks and fixes WordPress installation issues
 */

// Output as plain text
header('Content-Type: text/plain');

function log_message($message) {
    echo "$message\n";
}

// 1. Check WordPress core files
log_message("Checking WordPress core files...");
$required_files = array(
    'wp-load.php',
    'wp-config.php',
    'wp-settings.php',
    'wp-blog-header.php',
    'wp-includes/version.php',
    'wp-admin/admin.php',
    'wp-content/index.php'
);

$missing_files = array();
foreach ($required_files as $file) {
    if (!file_exists($file)) {
        $missing_files[] = $file;
    }
}

if (!empty($missing_files)) {
    log_message("Missing core files:");
    foreach ($missing_files as $file) {
        log_message("- $file");
    }
} else {
    log_message("All core files present");
}

// 2. Check WordPress database connection
log_message("\nChecking database connection...");
require_once('wp-load.php');
global $wpdb;

if ($wpdb->check_connection()) {
    log_message("Database connection successful");
} else {
    log_message("ERROR: Database connection failed!");
}

// 3. Check theme files
log_message("\nChecking theme files...");
$theme = wp_get_theme();
$theme_dir = get_template_directory();

log_message("Active theme: " . $theme->get('Name'));
log_message("Theme directory: $theme_dir");

$required_theme_files = array(
    'singular.php',
    'functions.php',
    'style.css',
    'index.php',
    'partials/single/layout.php'
);

foreach ($required_theme_files as $file) {
    $full_path = $theme_dir . '/' . $file;
    if (!file_exists($full_path)) {
        log_message("WARNING: Missing theme file: $file");
    }
}

// 4. Check URL configuration
log_message("\nChecking URL configuration...");
$home_url = get_option('home');
$site_url = get_option('siteurl');
$expected_url = 'https://quicksummit.net/blog';

log_message("Home URL: $home_url");
log_message("Site URL: $site_url");

if ($home_url !== $expected_url || $site_url !== $expected_url) {
    log_message("WARNING: URLs don't match expected value ($expected_url)");
    
    // Fix URLs
    update_option('home', $expected_url);
    update_option('siteurl', $expected_url);
    log_message("Fixed: Updated URLs to $expected_url");
}

// 5. Check .htaccess
log_message("\nChecking .htaccess configuration...");
$htaccess = '.htaccess';
if (!file_exists($htaccess)) {
    log_message("ERROR: .htaccess file missing!");
} else {
    $content = file_get_contents($htaccess);
    if (strpos($content, 'RewriteBase /blog/') === false) {
        log_message("WARNING: .htaccess missing RewriteBase /blog/");
        
        // Fix .htaccess
        $wp_htaccess = "# BEGIN WordPress\n<IfModule mod_rewrite.c>\nRewriteEngine On\nRewriteBase /blog/\nRewriteRule ^index\\.php$ - [L]\nRewriteCond %{REQUEST_FILENAME} !-f\nRewriteCond %{REQUEST_FILENAME} !-d\nRewriteRule . /blog/index.php [L]\n</IfModule>\n# END WordPress";
        file_put_contents($htaccess, $wp_htaccess);
        log_message("Fixed: Updated .htaccess with correct WordPress rules");
    } else {
        log_message(".htaccess configuration looks good");
    }
}

// 6. Check permalink structure
log_message("\nChecking permalink structure...");
$permalink_structure = get_option('permalink_structure');
log_message("Current permalink structure: $permalink_structure");

if ($permalink_structure !== '/%postname%/') {
    update_option('permalink_structure', '/%postname%/');
    log_message("Fixed: Updated permalink structure to /%postname%/");
    
    // Flush rewrite rules
    global $wp_rewrite;
    $wp_rewrite->init();
    $wp_rewrite->flush_rules(true);
    log_message("Fixed: Flushed rewrite rules");
}

// 7. Test post accessibility
log_message("\nTesting post accessibility...");
$posts = get_posts(array('posts_per_page' => 3));
foreach ($posts as $post) {
    $url = get_permalink($post->ID);
    log_message("\nPost #{$post->ID}: {$post->post_title}");
    log_message("URL: $url");
    
    // Test URL accessibility
    $headers = @get_headers($url);
    $status = $headers ? substr($headers[0], 9, 3) : 'Unknown';
    log_message("Status: $status");
}

// 8. Summary and recommendations
log_message("\nSummary and Recommendations:");
log_message("1. If you see any 'Fixed:' messages above, those issues have been automatically corrected");
log_message("2. If you see any 'WARNING:' messages, review those items carefully");
log_message("3. Clear your browser cache and test the blog posts again");
log_message("4. If issues persist, check the server's mod_rewrite configuration");
log_message("5. Consider temporarily switching to the default WordPress theme to rule out theme issues");

?>
