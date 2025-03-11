<?php
// Set error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Load WordPress
require_once('wp-load.php');

echo "WordPress Routing Fix\n";
echo "===================\n\n";

// 1. Update site URL configuration
echo "1. Checking site URLs...\n";
$home = get_option('home');
$siteurl = get_option('siteurl');

if ($home !== 'https://quicksummit.net/blog' || $siteurl !== 'https://quicksummit.net/blog') {
    update_option('home', 'https://quicksummit.net/blog');
    update_option('siteurl', 'https://quicksummit.net/blog');
    echo "✓ Updated site URLs\n";
}

// 2. Update permalink structure
echo "\n2. Setting permalink structure...\n";
global $wp_rewrite;
$wp_rewrite->set_permalink_structure('/%postname%/');
$wp_rewrite->flush_rules(true);
echo "✓ Updated permalink structure and flushed rules\n";

// 3. Update options that might affect routing
echo "\n3. Updating routing-related options...\n";
update_option('blog_public', '1');
update_option('permalink_structure', '/%postname%/');
echo "✓ Updated routing options\n";

// 4. Clear any caching
echo "\n4. Clearing caches...\n";
wp_cache_flush();
echo "✓ Cleared object cache\n";

// 5. Update .htaccess directly
echo "\n5. Updating .htaccess...\n";
$htaccess_file = __DIR__ . '/.htaccess';

$htaccess_content = "# BEGIN WordPress\n<IfModule mod_rewrite.c>\nRewriteEngine On\nRewriteBase /blog/\nRewriteRule ^index\.php$ - [L]\nRewriteCond %{REQUEST_FILENAME} !-f\nRewriteCond %{REQUEST_FILENAME} !-d\nRewriteRule . /blog/index.php [L]\n</IfModule>\n# END WordPress";

file_put_contents($htaccess_file, $htaccess_content);
echo "✓ Updated .htaccess\n";

// 6. Test post accessibility
echo "\n6. Testing post access...\n";
$posts = get_posts(array('posts_per_page' => 1));
if (!empty($posts)) {
    $post = $posts[0];
    $url = get_permalink($post->ID);
    echo "Test this URL: $url\n";
    
    // Get post path
    $path = parse_url($url, PHP_URL_PATH);
    echo "Post path: $path\n";
    
    // Check if post exists in database
    global $wpdb;
    $exists = $wpdb->get_var($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE ID = %d AND post_status = 'publish'", $post->ID));
    echo "Post exists in database: " . ($exists ? "Yes" : "No") . "\n";
    
    // Try to fetch post content
    $post_content = $wpdb->get_var($wpdb->prepare("SELECT post_content FROM $wpdb->posts WHERE ID = %d", $post->ID));
    echo "Post has content: " . (!empty($post_content) ? "Yes" : "No") . "\n";
}

// 7. Add debugging to wp-config.php
echo "\n7. Enabling debugging...\n";
$config_file = __DIR__ . '/wp-config.php';
if (file_exists($config_file)) {
    $config_content = file_get_contents($config_file);
    if (strpos($config_content, "define( 'WP_DEBUG'") === false) {
        $debug_settings = "\n\n// Enable debugging\ndefine( 'WP_DEBUG', true );\ndefine( 'WP_DEBUG_LOG', true );\ndefine( 'WP_DEBUG_DISPLAY', false );\n";
        $config_content = str_replace("/* That's all, stop editing! */", $debug_settings . "\n/* That's all, stop editing! */", $config_content);
        file_put_contents($config_file, $config_content);
        echo "✓ Added debug settings to wp-config.php\n";
    }
}

// 8. Check theme template files
echo "\n8. Checking theme templates...\n";
$theme = wp_get_theme();
$theme_dir = get_template_directory();
echo "Current theme: " . $theme->get('Name') . "\n";
echo "Theme directory: $theme_dir\n";

$required_files = array(
    'singular.php',
    'index.php',
    'functions.php',
    'style.css'
);

foreach ($required_files as $file) {
    $file_path = $theme_dir . '/' . $file;
    if (file_exists($file_path)) {
        echo "✓ Found $file\n";
    } else {
        echo "✗ Missing $file\n";
    }
}

echo "\nAll fixes applied. Please:\n";
echo "1. Clear your browser cache\n";
echo "2. Try accessing a blog post\n";
echo "3. Check wp-content/debug.log for errors\n";

// 9. Test direct file access
echo "\n9. Testing file access...\n";
$test_files = array(
    '/wp-includes/version.php',
    '/wp-content/themes/' . $theme->get_stylesheet() . '/style.css',
    '/index.php'
);

foreach ($test_files as $file) {
    $full_path = __DIR__ . $file;
    echo "Testing $file: " . (file_exists($full_path) ? "Exists" : "Missing") . "\n";
}
?>
