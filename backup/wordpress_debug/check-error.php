<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "Current working directory: " . getcwd() . "\n";
echo "Looking for wp-config.php...\n";

if (file_exists('wp-config.php')) {
    echo "wp-config.php found!\n";
    require_once('wp-config.php');
    
    echo "Checking database connection...\n";
    try {
        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        if ($mysqli->connect_error) {
            echo "Database connection failed: " . $mysqli->connect_error . "\n";
        } else {
            echo "Database connection successful!\n";
            
            // Try to get WordPress tables
            $result = $mysqli->query("SHOW TABLES LIKE 'wp_%'");
            echo "WordPress tables found: " . $result->num_rows . "\n";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage() . "\n";
    }
} else {
    echo "wp-config.php not found!\n";
    
    // List all files in current directory
    echo "\nDirectory contents:\n";
    $files = scandir('.');
    foreach ($files as $file) {
        echo $file . "\n";
    }
}
?>
