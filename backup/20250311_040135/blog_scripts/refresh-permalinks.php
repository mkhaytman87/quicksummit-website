<?php
/**
 * Permalink Refresh Script
 * 
 * This script flushes the WordPress rewrite rules to fix permalink issues
 * that may cause 404 errors for individual posts.
 */

// Load WordPress environment
define('WP_USE_THEMES', false);
require_once('wp-load.php');

// Check if user has permission to run this script
if (!current_user_can('manage_options')) {
    die('You do not have sufficient permissions to access this page.');
}

// Flush rewrite rules
flush_rewrite_rules(true);

// Update permalink structure to ensure it's set to post name
$permalink_structure = '/%postname%/';
update_option('permalink_structure', $permalink_structure);

// Flush again after updating
flush_rewrite_rules(true);

echo '<h1>Permalinks Refreshed</h1>';
echo '<p>The permalink structure has been set to: ' . $permalink_structure . '</p>';
echo '<p>Rewrite rules have been flushed. This should resolve 404 issues for individual posts.</p>';
echo '<p><a href="/blog/">Return to Blog</a></p>';
?>
