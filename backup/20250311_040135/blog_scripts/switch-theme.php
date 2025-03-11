<?php
// Load WordPress
require_once('wp-load.php');

// Switch to Twenty Twenty-Four theme
switch_theme('twentytwentyfour');

// Flush rewrite rules again just to be safe
global $wp_rewrite;
$wp_rewrite->flush_rules(true);

echo "Switched to Twenty Twenty-Four theme and flushed rewrite rules.\n";
echo "Please test your blog posts now.\n";
?>
