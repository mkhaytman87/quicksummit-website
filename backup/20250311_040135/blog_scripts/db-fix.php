<?php
/**
 * WordPress Database Fix for 404 Errors
 * This script directly updates critical database settings that might be causing 404 errors
 */

// Load WordPress
define('WP_USE_THEMES', false);
require_once('wp-load.php');

// Output header
header('Content-Type: text/html; charset=utf-8');
echo '<!DOCTYPE html>
<html>
<head>
    <title>WordPress Database Fix</title>
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
    <h1>WordPress Database Fix for 404 Errors</h1>';

// Function to log actions
function log_action($message, $type = 'info') {
    echo "<div class=\"$type\">$message</div>";
}

// Get WordPress database prefix
global $wpdb;
$prefix = $wpdb->prefix;

// 1. Fix Permalink Structure
$permalink_structure = get_option('permalink_structure');
log_action("Current permalink structure: $permalink_structure", "info");

if ($permalink_structure !== '/%postname%/') {
    update_option('permalink_structure', '/%postname%/');
    log_action("FIXED: Permalink structure updated to /%postname%/", "success");
} else {
    log_action("Permalink structure is already set correctly", "success");
}

// 2. Fix rewrite rules option
$rewrite_rules = get_option('rewrite_rules');
if (empty($rewrite_rules)) {
    log_action("Rewrite rules are empty or corrupted. Regenerating...", "error");
    global $wp_rewrite;
    $wp_rewrite->flush_rules(true);
    log_action("FIXED: Rewrite rules regenerated", "success");
} else {
    log_action("Rewrite rules exist in the database", "success");
}

// 3. Check and fix theme options
$current_theme = wp_get_theme();
$theme_name = $current_theme->get('Name');
log_action("Current theme: $theme_name", "info");

// Make sure theme is properly activated
$stylesheet = get_option('stylesheet');
$template = get_option('template');
log_action("Current stylesheet: $stylesheet", "info");
log_action("Current template: $template", "info");

// 4. Direct database fixes for critical options
log_action("Applying direct database fixes...", "info");

// Fix option_siteurl if needed
$site_url = $wpdb->get_var("SELECT option_value FROM {$wpdb->options} WHERE option_name = 'siteurl'");
if (strpos($site_url, 'http://') === 0) {
    $https_site_url = str_replace('http://', 'https://', $site_url);
    $wpdb->query($wpdb->prepare("UPDATE {$wpdb->options} SET option_value = %s WHERE option_name = 'siteurl'", $https_site_url));
    log_action("FIXED: Updated siteurl in database to use HTTPS", "success");
}

// Fix option_home if needed
$home_url = $wpdb->get_var("SELECT option_value FROM {$wpdb->options} WHERE option_name = 'home'");
if (strpos($home_url, 'http://') === 0) {
    $https_home_url = str_replace('http://', 'https://', $home_url);
    $wpdb->query($wpdb->prepare("UPDATE {$wpdb->options} SET option_value = %s WHERE option_name = 'home'", $https_home_url));
    log_action("FIXED: Updated home in database to use HTTPS", "success");
}

// 5. Fix post permalinks in database
log_action("Checking post permalinks in database...", "info");

// Get sample post
$post = $wpdb->get_row("SELECT ID, post_name, post_status FROM {$wpdb->posts} WHERE post_type = 'post' AND post_status = 'publish' LIMIT 1");
if ($post) {
    log_action("Sample post ID: {$post->ID}, Slug: {$post->post_name}, Status: {$post->post_status}", "info");
    
    // Check if post has a valid post_name (slug)
    if (empty($post->post_name)) {
        log_action("Post slug is empty. This can cause 404 errors.", "error");
        
        // Generate a slug from the title
        $post_title = $wpdb->get_var($wpdb->prepare("SELECT post_title FROM {$wpdb->posts} WHERE ID = %d", $post->ID));
        $post_name = sanitize_title($post_title);
        
        // Update the post_name
        $wpdb->update(
            $wpdb->posts,
            array('post_name' => $post_name),
            array('ID' => $post->ID)
        );
        
        log_action("FIXED: Generated and updated post slug to: $post_name", "success");
    }
}

// 6. Rebuild permalink structure and flush rewrite rules
log_action("Rebuilding permalink structure and flushing rewrite rules...", "info");

// Force update permalink structure
update_option('permalink_structure', '/%postname%/');

// Flush rewrite rules
global $wp_rewrite;
$wp_rewrite->init();
$wp_rewrite->flush_rules(true);

log_action("FIXED: Permalink structure rebuilt and rewrite rules flushed", "success");

// 7. Update .htaccess file
$htaccess_path = ABSPATH . '.htaccess';
if (file_exists($htaccess_path) && is_writable($htaccess_path)) {
    log_action("Updating .htaccess file...", "info");
    
    // Get the rewrite rules from WordPress
    $rules = $wp_rewrite->mod_rewrite_rules();
    
    if (!empty($rules)) {
        // Create a new .htaccess with the WordPress rules
        $htaccess_content = "# BEGIN WordPress\n<IfModule mod_rewrite.c>\nRewriteEngine On\nRewriteBase /blog/\nRewriteRule ^index\.php$ - [L]\nRewriteCond %{REQUEST_FILENAME} !-f\nRewriteCond %{REQUEST_FILENAME} !-d\nRewriteRule . /blog/index.php [L]\n</IfModule>\n# END WordPress\n";
        
        if (file_put_contents($htaccess_path, $htaccess_content)) {
            log_action("FIXED: .htaccess updated with WordPress rewrite rules", "success");
        } else {
            log_action("Could not update .htaccess. Please check file permissions.", "error");
        }
    }
}

// 8. Test post URLs
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

// 9. Provide additional troubleshooting steps
echo "<h2>Next Steps</h2>
<ol>
    <li>Visit one of the blog posts above to verify the fix worked</li>
    <li>If the issue persists, try clearing your browser cache or testing in an incognito window</li>
    <li>For security, delete this db-fix.php file after confirming the fix works</li>
</ol>

<h2>If Issues Persist</h2>
<p>If you're still experiencing 404 errors after applying these fixes, consider these last-resort options:</p>
<ol>
    <li><strong>Reinstall WordPress Core</strong>: This can fix corrupted core files without affecting your content</li>
    <li><strong>Deactivate All Plugins</strong>: A plugin might be interfering with permalink handling</li>
    <li><strong>Switch to Default Theme</strong>: Try using the default WordPress theme temporarily</li>
    <li><strong>Check Server Configuration</strong>: Ensure mod_rewrite is enabled and working properly</li>
</ol>";

echo '</body>
</html>';
?>
