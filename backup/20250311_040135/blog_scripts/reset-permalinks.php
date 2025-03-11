<?php
/**
 * Simple Permalink Reset Script
 * Upload this to your production server and run it once to fix 404 errors
 */

// Load WordPress
define('WP_USE_THEMES', false);
require_once('wp-load.php');

// Reset permalinks to post name structure
update_option('permalink_structure', '/%postname%/');

// Force flush rewrite rules
global $wp_rewrite;
$wp_rewrite->flush_rules(true);

echo '<h1>WordPress Permalinks Reset</h1>';
echo '<p>Permalinks have been reset to: /%postname%/</p>';
echo '<p>Rewrite rules have been flushed.</p>';
echo '<p>This should resolve 404 errors for individual blog posts.</p>';
echo '<p><a href="/blog/">Return to Blog</a></p>';
?>
