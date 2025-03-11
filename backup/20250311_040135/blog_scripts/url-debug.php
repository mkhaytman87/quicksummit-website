<?php
/**
 * WordPress URL Debugging Script
 * This script helps diagnose issues with WordPress permalinks and URL handling
 */

// Load WordPress
define('WP_USE_THEMES', false);
require_once('wp-load.php');

// Output header
header('Content-Type: text/html; charset=utf-8');
echo '<!DOCTYPE html>
<html>
<head>
    <title>WordPress URL Debugging</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 1000px; margin: 0 auto; padding: 20px; }
        h1, h2 { color: #23282d; }
        pre { background: #f1f1f1; padding: 15px; overflow: auto; }
        .section { margin-bottom: 30px; border: 1px solid #ddd; padding: 20px; border-radius: 4px; }
        .success { color: green; }
        .error { color: red; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>WordPress URL Debugging</h1>';

// Function to output a section
function output_section($title, $content) {
    echo "<div class=\"section\">
        <h2>$title</h2>
        $content
    </div>";
}

// 1. WordPress Configuration
$home_url = home_url();
$site_url = site_url();
$permalink_structure = get_option('permalink_structure');
$using_index = strpos($_SERVER['REQUEST_URI'], 'index.php') !== false ? 'Yes' : 'No';

$config_content = "
<table>
    <tr><th>Setting</th><th>Value</th></tr>
    <tr><td>WordPress Version</td><td>" . get_bloginfo('version') . "</td></tr>
    <tr><td>Home URL</td><td>$home_url</td></tr>
    <tr><td>Site URL</td><td>$site_url</td></tr>
    <tr><td>Permalink Structure</td><td>$permalink_structure</td></tr>
    <tr><td>Using index.php in URL</td><td>$using_index</td></tr>
    <tr><td>WP_HOME constant</td><td>" . (defined('WP_HOME') ? WP_HOME : 'Not defined') . "</td></tr>
    <tr><td>WP_SITEURL constant</td><td>" . (defined('WP_SITEURL') ? WP_SITEURL : 'Not defined') . "</td></tr>
</table>";

output_section("WordPress Configuration", $config_content);

// 2. Server Information
$server_content = "
<table>
    <tr><th>Variable</th><th>Value</th></tr>
    <tr><td>SERVER_NAME</td><td>{$_SERVER['SERVER_NAME']}</td></tr>
    <tr><td>HTTP_HOST</td><td>{$_SERVER['HTTP_HOST']}</td></tr>
    <tr><td>REQUEST_URI</td><td>{$_SERVER['REQUEST_URI']}</td></tr>
    <tr><td>SCRIPT_NAME</td><td>{$_SERVER['SCRIPT_NAME']}</td></tr>
    <tr><td>PHP_SELF</td><td>{$_SERVER['PHP_SELF']}</td></tr>
    <tr><td>DOCUMENT_ROOT</td><td>{$_SERVER['DOCUMENT_ROOT']}</td></tr>
    <tr><td>SCRIPT_FILENAME</td><td>{$_SERVER['SCRIPT_FILENAME']}</td></tr>
    <tr><td>SERVER_SOFTWARE</td><td>{$_SERVER['SERVER_SOFTWARE']}</td></tr>
</table>";

output_section("Server Information", $server_content);

// 3. WordPress Rewrite Rules
global $wp_rewrite;
$rewrite_rules = $wp_rewrite->rewrite_rules();
$rewrite_content = "<p>Total Rules: " . count($rewrite_rules) . "</p><pre>";
$i = 0;
foreach ($rewrite_rules as $pattern => $replacement) {
    $rewrite_content .= htmlspecialchars("$pattern => $replacement") . "\n";
    $i++;
    if ($i > 20) {
        $rewrite_content .= "... (showing first 20 of " . count($rewrite_rules) . " rules)\n";
        break;
    }
}
$rewrite_content .= "</pre>";

output_section("WordPress Rewrite Rules", $rewrite_content);

// 4. Test Post URLs
$posts = get_posts(array('posts_per_page' => 5));
$post_content = "";

if (!empty($posts)) {
    $post_content .= "<table>
        <tr>
            <th>Post ID</th>
            <th>Post Title</th>
            <th>Permalink</th>
            <th>Status</th>
        </tr>";
    
    foreach ($posts as $post) {
        $permalink = get_permalink($post->ID);
        
        // Test if the URL is accessible
        $headers = @get_headers($permalink);
        $status = $headers ? substr($headers[0], 9, 3) : 'Unknown';
        $status_class = $status == '200' ? 'success' : 'error';
        
        $post_content .= "<tr>
            <td>{$post->ID}</td>
            <td>{$post->post_title}</td>
            <td><a href=\"$permalink\" target=\"_blank\">$permalink</a></td>
            <td class=\"$status_class\">$status</td>
        </tr>";
    }
    
    $post_content .= "</table>";
} else {
    $post_content = "<p>No posts found.</p>";
}

output_section("Test Post URLs", $post_content);

// 5. .htaccess Content
$htaccess_path = ABSPATH . '.htaccess';
$htaccess_content = "";

if (file_exists($htaccess_path) && is_readable($htaccess_path)) {
    $htaccess_content = "<pre>" . htmlspecialchars(file_get_contents($htaccess_path)) . "</pre>";
} else {
    $htaccess_content = "<p class=\"error\">Could not read .htaccess file.</p>";
}

output_section("WordPress .htaccess Content", $htaccess_content);

// 6. Parent .htaccess Content (if exists)
$parent_htaccess_path = dirname(ABSPATH) . '/.htaccess';
$parent_htaccess_content = "";

if (file_exists($parent_htaccess_path) && is_readable($parent_htaccess_path)) {
    $parent_htaccess_content = "<pre>" . htmlspecialchars(file_get_contents($parent_htaccess_path)) . "</pre>";
    output_section("Parent Directory .htaccess Content", $parent_htaccess_content);
}

// 7. Active Plugins
$active_plugins = get_option('active_plugins');
$plugins_content = "<ul>";

if (!empty($active_plugins)) {
    foreach ($active_plugins as $plugin) {
        $plugins_content .= "<li>$plugin</li>";
    }
} else {
    $plugins_content .= "<li>No active plugins.</li>";
}

$plugins_content .= "</ul>";
output_section("Active Plugins", $plugins_content);

// 8. Troubleshooting Recommendations
echo '<div class="section">
    <h2>Troubleshooting Recommendations</h2>
    <ol>
        <li><strong>Check URL Configuration</strong>: Ensure Home URL and Site URL are correctly set and match your actual domain.</li>
        <li><strong>Verify .htaccess Rules</strong>: Make sure both WordPress and parent .htaccess files are not conflicting.</li>
        <li><strong>Test mod_rewrite</strong>: Create a simple rewrite test to verify mod_rewrite is working.</li>
        <li><strong>Check Theme Templates</strong>: Ensure single.php exists and is properly formatted.</li>
        <li><strong>Consider URL Structure</strong>: If using a subdirectory for WordPress, ensure paths are correct.</li>
        <li><strong>Advanced Fix</strong>: Try adding this to wp-config.php:
            <pre>
// Force WordPress to use specific URL structure
define(\'WP_HOME\', \'http://\' . $_SERVER[\'HTTP_HOST\'] . \'/blog\');
define(\'WP_SITEURL\', \'http://\' . $_SERVER[\'HTTP_HOST\'] . \'/blog\');
            </pre>
        </li>
        <li><strong>Last Resort</strong>: If all else fails, consider:
            <ul>
                <li>Temporarily switching to default theme</li>
                <li>Deactivating all plugins</li>
                <li>Manually updating database options for home and siteurl</li>
                <li>Checking for URL rewriting conflicts with main site</li>
            </ul>
        </li>
    </ol>
</div>';

echo '</body>
</html>';
?>
