<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "Checking themes directory...\n";
$themes_dir = dirname(__FILE__) . '/wp-content/themes';
echo "Themes directory: $themes_dir\n";

if (is_dir($themes_dir)) {
    echo "Themes directory exists!\n\nAvailable themes:\n";
    $themes = scandir($themes_dir);
    foreach ($themes as $theme) {
        if ($theme != '.' && $theme != '..') {
            echo "- $theme\n";
            
            // Check theme directory permissions
            $theme_path = $themes_dir . '/' . $theme;
            echo "  Permissions: " . substr(sprintf('%o', fileperms($theme_path)), -4) . "\n";
            
            // List files in theme directory
            if (is_dir($theme_path)) {
                $files = scandir($theme_path);
                echo "  Files:\n";
                foreach ($files as $file) {
                    if ($file != '.' && $file != '..') {
                        echo "    - $file\n";
                    }
                }
            }
            echo "\n";
        }
    }
} else {
    echo "Themes directory does not exist!\n";
    
    // Try to create themes directory
    if (@mkdir($themes_dir, 0755, true)) {
        echo "Created themes directory successfully.\n";
    } else {
        echo "Failed to create themes directory.\n";
        echo "Error: " . error_get_last()['message'] . "\n";
    }
}

// Check wp-content permissions
$wp_content = dirname(__FILE__) . '/wp-content';
echo "\nwp-content permissions: " . substr(sprintf('%o', fileperms($wp_content)), -4) . "\n";
?>
