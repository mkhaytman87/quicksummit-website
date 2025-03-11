<?php
// Set error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Load WordPress
require_once('wp-load.php');

// Get the first post
$post = get_posts(array('posts_per_page' => 1))[0];

// Get post data directly from database
global $wpdb;
$post_data = $wpdb->get_row($wpdb->prepare("
    SELECT ID, post_title, post_name, post_status, guid, post_type 
    FROM {$wpdb->posts} 
    WHERE ID = %d
", $post->ID));

// Output post data
header('Content-Type: text/html');
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo esc_html($post_data->post_title); ?></title>
</head>
<body>
    <h1>WordPress Post Test</h1>
    <hr>
    
    <h2>Post Details:</h2>
    <ul>
        <li>ID: <?php echo $post_data->ID; ?></li>
        <li>Title: <?php echo esc_html($post_data->post_title); ?></li>
        <li>Status: <?php echo $post_data->post_status; ?></li>
        <li>Type: <?php echo $post_data->post_type; ?></li>
        <li>Slug: <?php echo $post_data->post_name; ?></li>
    </ul>

    <h2>Generated URLs:</h2>
    <ul>
        <li>get_permalink(): <?php echo get_permalink($post_data->ID); ?></li>
        <li>GUID: <?php echo $post_data->guid; ?></li>
        <li>Direct link: <a href="/blog/<?php echo $post_data->post_name; ?>/">Post link</a></li>
    </ul>

    <h2>WordPress Configuration:</h2>
    <ul>
        <li>home: <?php echo get_option('home'); ?></li>
        <li>siteurl: <?php echo get_option('siteurl'); ?></li>
        <li>permalink_structure: <?php echo get_option('permalink_structure'); ?></li>
        <li>Active theme: <?php echo wp_get_theme()->get('Name'); ?></li>
    </ul>

    <h2>Server Information:</h2>
    <ul>
        <li>REQUEST_URI: <?php echo $_SERVER['REQUEST_URI']; ?></li>
        <li>SCRIPT_NAME: <?php echo $_SERVER['SCRIPT_NAME']; ?></li>
        <li>PHP_SELF: <?php echo $_SERVER['PHP_SELF']; ?></li>
        <li>DOCUMENT_ROOT: <?php echo $_SERVER['DOCUMENT_ROOT']; ?></li>
    </ul>

    <h2>Theme Template Files:</h2>
    <?php
    $theme_dir = get_template_directory();
    $required_files = array(
        'singular.php',
        'index.php',
        'functions.php',
        'style.css',
        'partials/single/layout.php'
    );
    ?>
    <ul>
    <?php foreach ($required_files as $file): ?>
        <li><?php echo $file; ?>: <?php echo file_exists($theme_dir . '/' . $file) ? '✓' : '✗'; ?></li>
    <?php endforeach; ?>
    </ul>

    <h2>Current .htaccess Content:</h2>
    <pre><?php echo htmlspecialchars(file_get_contents('.htaccess')); ?></pre>

    <h2>Parent .htaccess Content:</h2>
    <pre><?php echo htmlspecialchars(file_get_contents('../.htaccess')); ?></pre>
</body>
</html>
<?php
// Also write debug info to a log file
$debug_info = array(
    'post_data' => $post_data,
    'options' => array(
        'home' => get_option('home'),
        'siteurl' => get_option('siteurl'),
        'permalink_structure' => get_option('permalink_structure')
    ),
    'server' => $_SERVER,
    'theme_files' => array_map(function($file) use ($theme_dir) {
        return array(
            'file' => $file,
            'exists' => file_exists($theme_dir . '/' . $file)
        );
    }, $required_files)
);

file_put_contents('debug.log', date('Y-m-d H:i:s') . "\n" . print_r($debug_info, true) . "\n\n", FILE_APPEND);
?>
