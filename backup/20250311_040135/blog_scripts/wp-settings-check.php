<?php
/**
 * WordPress Settings Check Script
 * 
 * This script displays important WordPress settings that may affect blog post URLs
 * and helps diagnose 404 errors for individual posts.
 */

// Load WordPress environment
define('WP_USE_THEMES', false);
require_once('wp-load.php');

// Check if user has permission to run this script
if (!current_user_can('manage_options')) {
    die('You do not have sufficient permissions to access this page.');
}

echo '<h1>WordPress Settings Check</h1>';

// Check active theme
$current_theme = wp_get_theme();
echo '<h2>Active Theme</h2>';
echo '<ul>';
echo '<li><strong>Theme Name:</strong> ' . $current_theme->get('Name') . '</li>';
echo '<li><strong>Theme Directory:</strong> ' . $current_theme->get_stylesheet_directory() . '</li>';
echo '</ul>';

// Check permalink structure
$permalink_structure = get_option('permalink_structure');
echo '<h2>Permalink Settings</h2>';
echo '<ul>';
echo '<li><strong>Current Structure:</strong> ' . ($permalink_structure ?: 'Default') . '</li>';
echo '<li><strong>Recommended:</strong> /%postname%/</li>';
echo '</ul>';

// Check if pretty permalinks are enabled
$using_pretty_permalinks = $permalink_structure !== '';
echo '<p><strong>Pretty Permalinks Enabled:</strong> ' . ($using_pretty_permalinks ? 'Yes' : 'No') . '</p>';

// Check .htaccess file
$htaccess_path = ABSPATH . '.htaccess';
$htaccess_exists = file_exists($htaccess_path);
$htaccess_writable = $htaccess_exists && is_writable($htaccess_path);
echo '<h2>.htaccess Status</h2>';
echo '<ul>';
echo '<li><strong>Exists:</strong> ' . ($htaccess_exists ? 'Yes' : 'No') . '</li>';
echo '<li><strong>Writable:</strong> ' . ($htaccess_writable ? 'Yes' : 'No') . '</li>';
if ($htaccess_exists) {
    echo '<li><strong>Content:</strong> <pre>' . htmlspecialchars(file_get_contents($htaccess_path)) . '</pre></li>';
}
echo '</ul>';

// Check if mod_rewrite is available
echo '<h2>Server Configuration</h2>';
echo '<ul>';
echo '<li><strong>mod_rewrite Available:</strong> ' . (function_exists('apache_get_modules') && in_array('mod_rewrite', apache_get_modules()) ? 'Yes' : 'Unknown (cannot detect in PHP development server)') . '</li>';
echo '</ul>';

// Check site URL and home URL
$site_url = get_option('siteurl');
$home_url = get_option('home');
echo '<h2>WordPress URLs</h2>';
echo '<ul>';
echo '<li><strong>Site URL:</strong> ' . $site_url . '</li>';
echo '<li><strong>Home URL:</strong> ' . $home_url . '</li>';
echo '</ul>';

// Check if site URL and home URL match
$urls_match = $site_url === $home_url;
echo '<p><strong>URLs Match:</strong> ' . ($urls_match ? 'Yes' : 'No - This may cause issues!') . '</p>';

// Check for a sample post to test
$args = array(
    'post_type' => 'post',
    'posts_per_page' => 1,
    'post_status' => 'publish'
);
$posts = get_posts($args);

if (!empty($posts)) {
    $post = $posts[0];
    $post_url = get_permalink($post->ID);
    $post_slug = $post->post_name;
    
    echo '<h2>Sample Post</h2>';
    echo '<ul>';
    echo '<li><strong>Post Title:</strong> ' . $post->post_title . '</li>';
    echo '<li><strong>Post ID:</strong> ' . $post->ID . '</li>';
    echo '<li><strong>Post Slug:</strong> ' . $post_slug . '</li>';
    echo '<li><strong>Post URL:</strong> <a href="' . $post_url . '" target="_blank">' . $post_url . '</a></li>';
    echo '</ul>';
    
    // Check if the post URL contains the correct structure
    $expected_url = $home_url . '/' . ($permalink_structure ? str_replace('%postname%', $post_slug, ltrim($permalink_structure, '/')) : '?p=' . $post->ID);
    $url_structure_correct = ($post_url === $expected_url);
    echo '<p><strong>URL Structure Correct:</strong> ' . ($url_structure_correct ? 'Yes' : 'No - Expected: ' . $expected_url) . '</p>';
    
    // Add a test link
    echo '<p><a href="' . $post_url . '" target="_blank">Test this post link</a></p>';
} else {
    echo '<h2>No Published Posts Found</h2>';
    echo '<p>Create a published post to test permalink functionality.</p>';
}

// Add fix options
echo '<h2>Fix Options</h2>';
echo '<form method="post">';
echo '<p><button type="submit" name="fix_permalinks">Refresh Permalinks</button> - Updates permalink structure and flushes rewrite rules</p>';
echo '<p><button type="submit" name="fix_theme">Activate QuickSummit Theme</button> - Ensures the QuickSummit theme is active</p>';
echo '<p><button type="submit" name="fix_urls">Fix Site URLs</button> - Ensures site URL and home URL are set correctly</p>';
echo '</form>';

// Process fix requests
if (isset($_POST['fix_permalinks'])) {
    // Set permalink structure to post name
    update_option('permalink_structure', '/%postname%/');
    // Flush rewrite rules
    flush_rewrite_rules(true);
    echo '<div style="background-color: #dff0d8; color: #3c763d; padding: 15px; margin: 15px 0; border-radius: 4px;">';
    echo '<strong>Success!</strong> Permalinks have been refreshed. The structure is now set to /%postname%/.';
    echo '</div>';
    echo '<p><a href="' . $_SERVER['PHP_SELF'] . '">Refresh this page</a> to see the updated settings.</p>';
}

if (isset($_POST['fix_theme'])) {
    // Activate QuickSummit theme
    switch_theme('quicksummit');
    echo '<div style="background-color: #dff0d8; color: #3c763d; padding: 15px; margin: 15px 0; border-radius: 4px;">';
    echo '<strong>Success!</strong> The QuickSummit theme has been activated.';
    echo '</div>';
    echo '<p><a href="' . $_SERVER['PHP_SELF'] . '">Refresh this page</a> to see the updated settings.</p>';
}

if (isset($_POST['fix_urls'])) {
    // Set site URL and home URL to the same value
    $current_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
    $blog_path = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
    $blog_url = $current_url . $blog_path;
    
    update_option('siteurl', $blog_url);
    update_option('home', $blog_url);
    
    echo '<div style="background-color: #dff0d8; color: #3c763d; padding: 15px; margin: 15px 0; border-radius: 4px;">';
    echo '<strong>Success!</strong> Site URL and Home URL have been updated to: ' . $blog_url;
    echo '</div>';
    echo '<p><a href="' . $_SERVER['PHP_SELF'] . '">Refresh this page</a> to see the updated settings.</p>';
}

// Add link back to blog
echo '<p><a href="/blog/">Return to Blog</a></p>';
?>
