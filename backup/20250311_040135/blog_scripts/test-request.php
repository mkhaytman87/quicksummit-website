<?php
// Set error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Output as plain text
header('Content-Type: text/plain');

echo "WordPress Request Test\n";
echo "=====================\n\n";

// 1. Check if we can load WordPress
echo "1. Loading WordPress...\n";
define('WP_DEBUG', true);
require_once('wp-load.php');

// 2. Test database connection
echo "\n2. Testing database connection...\n";
global $wpdb;
if ($wpdb->check_connection()) {
    echo "✓ Database connection successful\n";
    echo "Database prefix: " . $wpdb->prefix . "\n";
} else {
    echo "✗ Database connection failed!\n";
}

// 3. Check post in database directly
echo "\n3. Checking post in database...\n";
$post_name = 'using-ai-for-stock-analysis-a-case-study-on-nvda-through-2024-q4-earnings';
$post = $wpdb->get_row($wpdb->prepare("
    SELECT ID, post_title, post_status, post_type, guid 
    FROM {$wpdb->posts} 
    WHERE post_name = %s 
    AND post_type = 'post'
", $post_name));

if ($post) {
    echo "✓ Post found in database:\n";
    echo "  ID: {$post->ID}\n";
    echo "  Title: {$post->post_title}\n";
    echo "  Status: {$post->post_status}\n";
    echo "  GUID: {$post->guid}\n";
} else {
    echo "✗ Post not found in database!\n";
}

// 4. Check rewrite rules
echo "\n4. Current rewrite rules:\n";
global $wp_rewrite;
$rules = get_option('rewrite_rules');
if ($rules) {
    foreach (array_slice($rules, 0, 5) as $pattern => $redirect) {
        echo "$pattern => $redirect\n";
    }
    echo "... (showing first 5 rules only)\n";
} else {
    echo "No rewrite rules found!\n";
}

// 5. Test URL generation
echo "\n5. Testing URL generation...\n";
if ($post) {
    $url = get_permalink($post->ID);
    echo "Generated URL: $url\n";
    
    // Parse URL components
    $parts = parse_url($url);
    echo "\nURL components:\n";
    foreach ($parts as $key => $value) {
        echo "  $key: $value\n";
    }
}

// 6. Check critical WordPress options
echo "\n6. WordPress configuration:\n";
$critical_options = array(
    'home',
    'siteurl',
    'permalink_structure',
    'blog_public',
    'template',
    'stylesheet'
);

foreach ($critical_options as $option) {
    echo "$option: " . get_option($option) . "\n";
}

// 7. Fix attempt
echo "\n7. Attempting fixes...\n";

// Update permalinks to match the URL structure
update_option('permalink_structure', '/%postname%/');

// Ensure home and site URLs are correct
update_option('home', 'https://quicksummit.net/blog');
update_option('siteurl', 'https://quicksummit.net/blog');

// Clear rewrite rules and regenerate
$wp_rewrite->init();
$wp_rewrite->flush_rules(true);

// Update .htaccess with more specific rules
$htaccess_content = "# BEGIN WordPress
<IfModule mod_rewrite.c>
RewriteEngine On
RewriteBase /blog/
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^index\.php$ - [L]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule . /blog/index.php [L]
</IfModule>
# END WordPress";

file_put_contents('.htaccess', $htaccess_content);

// Update parent .htaccess with more specific WordPress handling
$parent_htaccess = "# Enable rewrite engine
RewriteEngine On

# WordPress blog handling
RewriteCond %{REQUEST_URI} ^/blog/
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^blog/(.*)$ /blog/index.php [QSA,L]

# Static files and directories
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^ index.html [L]

# Security headers and other settings
Header set X-Content-Type-Options \"nosniff\"
Header set X-Frame-Options \"SAMEORIGIN\"
Header set X-XSS-Protection \"1; mode=block\"

# Compression and caching
AddOutputFilterByType DEFLATE text/html text/plain text/xml text/css application/javascript
<FilesMatch \"\.(js|css|jpg|jpeg|png|gif|ico)$\">
    Header set Cache-Control \"max-age=31536000\"
</FilesMatch>";

file_put_contents('../.htaccess', $parent_htaccess);

echo "✓ Updated permalink structure\n";
echo "✓ Updated home and site URLs\n";
echo "✓ Flushed rewrite rules\n";
echo "✓ Updated .htaccess files with more specific rules\n";

// 8. Final test
echo "\n8. Final test...\n";
if ($post) {
    $final_url = get_permalink($post->ID);
    echo "Test this URL: $final_url\n";
}

echo "\nDone. Please test the blog post URLs again after clearing your browser cache.\n";
echo "If still seeing 404s, check Apache's error logs for more details.\n";
?>
