<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('wp-load.php');

echo "Current theme: " . get_template() . "\n";

// Switch to quicksummit theme
switch_theme('quicksummit');

echo "Updated theme to: " . get_template() . "\n";

// Update theme_mods to ensure theme is properly set
update_option('template', 'quicksummit');
update_option('stylesheet', 'quicksummit');

echo "Theme settings updated. Please delete this file for security.\n";
?>
