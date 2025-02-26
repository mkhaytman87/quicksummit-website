<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('wp-load.php');

echo "WordPress Version: " . get_bloginfo('version') . "\n";
echo "Current Theme: " . get_template() . "\n";
echo "Theme Directory: " . get_template_directory() . "\n";

echo "\nChecking theme files:\n";
$required_files = array(
    'style.css',
    'index.php',
    'header.php',
    'footer.php',
    'functions.php'
);

foreach ($required_files as $file) {
    $path = get_template_directory() . '/' . $file;
    echo $file . ": " . (file_exists($path) ? "Found" : "Missing") . "\n";
    if (file_exists($path)) {
        echo "File size: " . filesize($path) . " bytes\n";
        echo "File permissions: " . substr(sprintf('%o', fileperms($path)), -4) . "\n";
    }
}

echo "\nActive plugins:\n";
$active_plugins = get_option('active_plugins');
foreach ($active_plugins as $plugin) {
    echo "- " . $plugin . "\n";
}

echo "\nChecking theme directory permissions:\n";
$theme_dir = get_template_directory();
echo "Theme directory permissions: " . substr(sprintf('%o', fileperms($theme_dir)), -4) . "\n";
?>
