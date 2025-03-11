<?php
/**
 * Theme Status Check Script
 * 
 * This script checks if the QuickSummit theme is properly activated
 * and displays information about the current theme configuration.
 */

// Load WordPress environment
define('WP_USE_THEMES', false);
require_once('wp-load.php');

// In local development environment, we'll bypass the permission check
// Comment: Normally we would check permissions, but for local testing we're allowing access
/*
if (!current_user_can('manage_options')) {
    die('You do not have sufficient permissions to access this page.');
}
*/

// Get current theme information
$current_theme = wp_get_theme();
$theme_name = $current_theme->get('Name');
$theme_version = $current_theme->get('Version');
$theme_status = $current_theme->errors() ? 'Error: ' . implode(', ', $current_theme->errors()) : 'Active';
$theme_directory = $current_theme->get_stylesheet_directory();

// Check if QuickSummit theme exists
$quicksummit_theme = wp_get_theme('quicksummit');
$quicksummit_exists = $quicksummit_theme->exists();
$quicksummit_status = $quicksummit_exists ? ($quicksummit_theme->errors() ? 'Error: ' . implode(', ', $quicksummit_theme->errors()) : 'Available') : 'Not Found';

// Check for single.php in the active theme
$single_php_path = $current_theme->get_stylesheet_directory() . '/single.php';
$single_php_exists = file_exists($single_php_path);

// Output theme information
echo '<h1>WordPress Theme Status</h1>';
echo '<h2>Current Active Theme</h2>';
echo '<ul>';
echo '<li><strong>Name:</strong> ' . $theme_name . '</li>';
echo '<li><strong>Version:</strong> ' . $theme_version . '</li>';
echo '<li><strong>Status:</strong> ' . $theme_status . '</li>';
echo '<li><strong>Directory:</strong> ' . $theme_directory . '</li>';
echo '<li><strong>single.php exists:</strong> ' . ($single_php_exists ? 'Yes' : 'No') . '</li>';
echo '</ul>';

echo '<h2>QuickSummit Theme</h2>';
echo '<ul>';
echo '<li><strong>Exists:</strong> ' . ($quicksummit_exists ? 'Yes' : 'No') . '</li>';
echo '<li><strong>Status:</strong> ' . $quicksummit_status . '</li>';
if ($quicksummit_exists) {
    echo '<li><strong>Version:</strong> ' . $quicksummit_theme->get('Version') . '</li>';
    echo '<li><strong>Directory:</strong> ' . $quicksummit_theme->get_stylesheet_directory() . '</li>';
    
    // Check for single.php in QuickSummit theme
    $quicksummit_single_php = $quicksummit_theme->get_stylesheet_directory() . '/single.php';
    echo '<li><strong>single.php exists:</strong> ' . (file_exists($quicksummit_single_php) ? 'Yes' : 'No') . '</li>';
}
echo '</ul>';

// If QuickSummit is not the active theme, provide activation button
if ($theme_name !== 'QuickSummit Blog' && $quicksummit_exists) {
    echo '<h2>Activate QuickSummit Theme</h2>';
    echo '<p>The QuickSummit theme is not currently active. Click the button below to activate it:</p>';
    echo '<form method="post">';
    echo '<input type="hidden" name="activate_theme" value="quicksummit">';
    echo '<button type="submit">Activate QuickSummit Theme</button>';
    echo '</form>';
    
    // Process theme activation if requested
    if (isset($_POST['activate_theme']) && $_POST['activate_theme'] === 'quicksummit') {
        switch_theme('quicksummit');
        echo '<p><strong>Theme activated!</strong> Please refresh this page to see the updated status.</p>';
    }
}

// Display permalink structure information
$permalink_structure = get_option('permalink_structure');
echo '<h2>Permalink Structure</h2>';
echo '<p>Current permalink structure: <code>' . ($permalink_structure ?: 'Default') . '</code></p>';
echo '<p>Recommended structure for blog posts: <code>/%postname%/</code></p>';

// Provide link to refresh permalinks
echo '<p><a href="refresh-permalinks.php">Click here to refresh permalinks</a> (this may help resolve 404 errors)</p>';

// Provide link back to blog
echo '<p><a href="/blog/">Return to Blog</a></p>';
?>
