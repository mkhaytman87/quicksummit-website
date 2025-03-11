<?php
// Load WordPress
require_once('wp-load.php');

// Switch back to OceanWP theme
switch_theme('oceanwp');

// Update .htaccess with more specific rules
$htaccess_content = "# BEGIN WordPress
<IfModule mod_rewrite.c>
RewriteEngine On
RewriteBase /blog/
RewriteRule ^index\.php$ - [L]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule . /blog/index.php [QSA,L]
</IfModule>
# END WordPress";

file_put_contents('.htaccess', $htaccess_content);

// Flush rewrite rules
global $wp_rewrite;
$wp_rewrite->init();
$wp_rewrite->flush_rules(true);

echo "Switched back to OceanWP theme and updated routing rules.\n";
echo "Please test your blog posts now.\n";

// Test a post URL
$posts = get_posts(array('posts_per_page' => 1));
if (!empty($posts)) {
    $post = $posts[0];
    $url = get_permalink($post->ID);
    echo "\nTest this URL: $url\n";
}
?>
