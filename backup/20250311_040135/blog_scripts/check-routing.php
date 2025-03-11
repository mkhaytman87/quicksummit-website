<?php
/**
 * WordPress Request Routing Check
 * This script helps diagnose how requests are being routed to WordPress
 */

// Output as plain text
header('Content-Type: text/plain');

function log_message($message) {
    echo "$message\n";
}

// 1. Check server environment
log_message("Server Environment:");
log_message("Server Software: " . $_SERVER['SERVER_SOFTWARE']);
log_message("PHP SAPI: " . php_sapi_name());
log_message("Document Root: " . $_SERVER['DOCUMENT_ROOT']);
log_message("Script Filename: " . $_SERVER['SCRIPT_FILENAME']);
log_message("Request URI: " . $_SERVER['REQUEST_URI']);
log_message("PHP Self: " . $_SERVER['PHP_SELF']);

// 2. Check mod_rewrite
log_message("\nmod_rewrite Check:");
if (function_exists('apache_get_modules')) {
    $modules = apache_get_modules();
    $mod_rewrite = in_array('mod_rewrite', $modules);
    log_message("mod_rewrite available: " . ($mod_rewrite ? "Yes" : "No"));
} else {
    log_message("Cannot check Apache modules (not running as Apache module)");
}

// 3. Load WordPress and check routing
log_message("\nWordPress Routing Check:");
define('WP_USE_THEMES', false);
require_once('wp-load.php');

// Get current post for testing
$posts = get_posts(array('posts_per_page' => 1));
if (!empty($posts)) {
    $post = $posts[0];
    $permalink = get_permalink($post->ID);
    
    log_message("\nTest Post Details:");
    log_message("Post ID: " . $post->ID);
    log_message("Post Name: " . $post->post_name);
    log_message("Generated Permalink: " . $permalink);
    
    // Parse URL components
    $url_parts = parse_url($permalink);
    log_message("\nPermalink Structure:");
    log_message("Scheme: " . $url_parts['scheme']);
    log_message("Host: " . $url_parts['host']);
    log_message("Path: " . $url_parts['path']);
    
    // Check if the post exists in the database
    global $wpdb;
    $post_exists = $wpdb->get_var($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE post_name = %s AND post_type = 'post' AND post_status = 'publish'", $post->post_name));
    log_message("\nDatabase Check:");
    log_message("Post exists in database: " . ($post_exists ? "Yes" : "No"));
    
    // Test direct access to post
    $headers = @get_headers($permalink);
    $status = $headers ? substr($headers[0], 9, 3) : 'Unknown';
    log_message("\nDirect Access Test:");
    log_message("HTTP Status: " . $status);
}

// 4. Check .htaccess rules
log_message("\n.htaccess Rules:");
$htaccess = file_get_contents('.htaccess');
log_message($htaccess);

// 5. Check parent directory .htaccess
$parent_htaccess = file_get_contents('../.htaccess');
log_message("\nParent .htaccess Rules:");
log_message($parent_htaccess);

// 6. Recommendations
log_message("\nRecommendations:");
log_message("1. Ensure mod_rewrite is enabled in Apache");
log_message("2. Verify that AllowOverride is set to All in Apache config");
log_message("3. Check that both .htaccess files have correct permissions");
log_message("4. Confirm that the parent .htaccess correctly excludes /blog/");
log_message("5. Make sure WordPress .htaccess has correct RewriteBase");
log_message("6. Consider temporarily switching to default permalinks to test routing");

// 7. Quick Fix Attempt
log_message("\nAttempting Quick Fix:");

// Update parent .htaccess to properly handle blog requests
$parent_htaccess_content = "# Enable rewrite engine
RewriteEngine On

# Handle /blog/ requests - pass through to WordPress
RewriteCond %{REQUEST_URI} ^/blog/
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^blog/(.*)$ /blog/index.php [L]

# Serve files and directories directly if they exist
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d

# Otherwise, route everything through index.html
RewriteRule ^ index.html [L]

# Set proper MIME types
AddType application/javascript .js
AddType text/css .css

# Enable CORS
Header set Access-Control-Allow-Origin \"*\"

# Set security headers
Header set X-Content-Type-Options \"nosniff\"
Header set X-Frame-Options \"SAMEORIGIN\"
Header set X-XSS-Protection \"1; mode=block\"

# Enable compression
AddOutputFilterByType DEFLATE text/html text/plain text/xml text/css application/javascript application/json

# Set caching
<FilesMatch \"\.(html|htm)$\">
    Header set Cache-Control \"max-age=0, no-cache, no-store, must-revalidate\"
    Header set Pragma \"no-cache\"
    Header set Expires \"Wed, 11 Jan 1984 05:00:00 GMT\"
</FilesMatch>

<FilesMatch \"\.(js|css|svg|jpg|jpeg|png|gif|ico)$\">
    Header set Cache-Control \"max-age=31536000, public\"
</FilesMatch>";

file_put_contents('../.htaccess', $parent_htaccess_content);
log_message("Updated parent .htaccess with improved blog handling rules");

// Update WordPress .htaccess
$wp_htaccess_content = "# BEGIN WordPress
<IfModule mod_rewrite.c>
RewriteEngine On
RewriteBase /blog/
RewriteRule ^index\.php$ - [L]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule . /blog/index.php [L]
</IfModule>
# END WordPress";

file_put_contents('.htaccess', $wp_htaccess_content);
log_message("Updated WordPress .htaccess with clean rewrite rules");

// Flush rewrite rules
global $wp_rewrite;
$wp_rewrite->init();
$wp_rewrite->flush_rules(true);
log_message("Flushed WordPress rewrite rules");

log_message("\nFix applied. Please test a blog post URL now.");
?>
