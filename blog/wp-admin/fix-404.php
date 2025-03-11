<?php
/**
 * WordPress Blog Post 404 Fix
 * 
 * This script fixes 404 errors for individual blog posts by:
 * 1. Ensuring the single.php template exists
 * 2. Resetting permalink structure
 * 3. Flushing rewrite rules
 */

// Load WordPress with admin privileges
define('WP_USE_THEMES', false);
require_once('../wp-load.php');

// Ensure we have admin access
require_once(ABSPATH . 'wp-admin/includes/admin.php');

// Output header
echo '<!DOCTYPE html>
<html>
<head>
    <title>WordPress Blog Post 404 Fix</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 0 auto; padding: 20px; }
        h1 { color: #23282d; }
        .success { background-color: #dff0d8; color: #3c763d; padding: 10px; border-radius: 4px; margin: 10px 0; }
        .error { background-color: #f2dede; color: #a94442; padding: 10px; border-radius: 4px; margin: 10px 0; }
        .info { background-color: #d9edf7; color: #31708f; padding: 10px; border-radius: 4px; margin: 10px 0; }
        code { background: #f1f1f1; padding: 2px 4px; border-radius: 3px; }
    </style>
</head>
<body>
    <h1>WordPress Blog Post 404 Fix</h1>';

// Function to log actions
function log_action($message, $type = 'info') {
    echo "<div class=\"$type\">$message</div>";
}

// 1. Check if single.php exists in the active theme
$theme_dir = get_template_directory();
$single_template = $theme_dir . '/single.php';

if (!file_exists($single_template)) {
    log_action("Creating single.php template...", "info");
    
    // Create a basic single.php template
    $single_content = <<<'EOT'
<?php
/**
 * The template for displaying all single posts
 */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <?php
        // Start the loop
        while (have_posts()) :
            the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                    <div class="entry-meta">
                        <?php echo get_the_date(); ?> by <?php the_author(); ?>
                    </div>
                </header>

                <div class="entry-content">
                    <?php the_content(); ?>
                </div>

                <footer class="entry-footer">
                    <?php if (has_category()): ?>
                    <div class="cat-links">
                        Categories: <?php the_category(', '); ?>
                    </div>
                    <?php endif; ?>
                    
                    <?php if (has_tag()): ?>
                    <div class="tag-links">
                        Tags: <?php the_tags('', ', ', ''); ?>
                    </div>
                    <?php endif; ?>
                </footer>
            </article>
            
            <?php
            // If comments are open or we have at least one comment, load up the comment template.
            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;
        endwhile;
        ?>
    </main>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
EOT;

    // Write the template file
    if (file_put_contents($single_template, $single_content)) {
        log_action("single.php template created successfully!", "success");
    } else {
        log_action("Failed to create single.php template. Please check file permissions.", "error");
    }
} else {
    log_action("single.php template already exists.", "success");
}

// 2. Reset permalink structure
$permalink_structure = get_option('permalink_structure');
log_action("Current permalink structure: <code>$permalink_structure</code>", "info");

if ($permalink_structure !== '/%postname%/') {
    update_option('permalink_structure', '/%postname%/');
    log_action("Permalink structure updated to: <code>/%postname%/</code>", "success");
} else {
    log_action("Permalink structure is already set to: <code>/%postname%/</code>", "success");
}

// 3. Flush rewrite rules
log_action("Flushing rewrite rules...", "info");
global $wp_rewrite;
$wp_rewrite->flush_rules(true);
log_action("Rewrite rules flushed successfully!", "success");

// 4. Check .htaccess file
$htaccess_path = ABSPATH . '.htaccess';
$htaccess_content = '';

if (file_exists($htaccess_path)) {
    $htaccess_content = file_get_contents($htaccess_path);
    log_action(".htaccess file found.", "info");
} else {
    log_action(".htaccess file not found. WordPress will attempt to create it if the directory is writable.", "info");
}

// 5. Display test links
$first_post = get_posts(array('posts_per_page' => 1));
$test_url = '';

if (!empty($first_post)) {
    $test_url = get_permalink($first_post[0]->ID);
    log_action("Test your fix by visiting this blog post: <a href=\"$test_url\" target=\"_blank\">$test_url</a>", "info");
} else {
    log_action("No posts found to test with. Please create a post first.", "info");
}

// 6. Provide additional information
echo '<h2>Next Steps</h2>
<ol>
    <li>Visit a blog post to verify the fix: ' . (!empty($test_url) ? "<a href=\"$test_url\" target=\"_blank\">$test_url</a>" : "Create a post first") . '</li>
    <li>If issues persist, check that your server has mod_rewrite enabled</li>
    <li>For security, delete this fix-404.php file after confirming the fix works</li>
</ol>

<h2>Troubleshooting</h2>
<p>If you still experience 404 errors, try these additional steps:</p>
<ol>
    <li>Check that your server has mod_rewrite enabled</li>
    <li>Verify that AllowOverride is set to All in your Apache configuration</li>
    <li>Make sure the .htaccess file is writable by the web server</li>
    <li>Try manually adding the WordPress rewrite rules to your .htaccess file</li>
</ol>';

echo '</body>
</html>';
?>
