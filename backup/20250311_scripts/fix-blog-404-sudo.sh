#!/bin/bash
# Simplified script to fix blog post 404 issues
# This script only updates the necessary files on the production server

# Set variables
PROD_ROOT="/home/admin/web/quicksummit.net/public_html"
BLOG_DIR="$PROD_ROOT/blog"
WP_DIR="$PROD_ROOT/wordpress"
BACKUP_DIR="$PROD_ROOT/backup/$(date +%Y%m%d)"
SOURCE_DIR="/home/linuxuser/quicksummit-build"

# Create backup directory
echo "Creating backup directory..."
mkdir -p $BACKUP_DIR

# 1. Back up current .htaccess
echo "Backing up current .htaccess..."
if [ -f "$PROD_ROOT/.htaccess" ]; then
    cp "$PROD_ROOT/.htaccess" "$BACKUP_DIR/.htaccess.bak"
    echo "Backup created: $BACKUP_DIR/.htaccess.bak"
fi

# 2. Update the root .htaccess file
echo "Updating root .htaccess..."
cat > "$PROD_ROOT/.htaccess" << 'EOL'
# Enable rewrite engine
RewriteEngine On

# WordPress blog handling - Fixed to properly handle blog post URLs
RewriteCond %{REQUEST_URI} ^/blog
RewriteRule ^blog(/.*)?$ /blog$1 [QSA,PT,L]

# Remove the wordpress path if it's used (redirect to blog)
RewriteRule ^wordpress(/.*)?$ /blog$1 [R=301,L]

# Static files and directories handling for main site
RewriteCond %{REQUEST_URI} !^/blog
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^ index.html [L]

# Security headers and other settings
Header set X-Content-Type-Options "nosniff"
Header set X-Frame-Options "SAMEORIGIN"
Header set X-XSS-Protection "1; mode=block"

# Compression and caching
AddOutputFilterByType DEFLATE text/html text/plain text/xml text/css application/javascript
<FilesMatch "\.(js|css|jpg|jpeg|png|gif|ico)$">
    Header set Cache-Control "max-age=31536000"
</FilesMatch>
EOL
echo "Root .htaccess updated successfully"

# 3. Update blog .htaccess
echo "Updating blog .htaccess..."
cat > "$BLOG_DIR/.htaccess" << 'EOL'
# BEGIN WordPress
<IfModule mod_rewrite.c>
RewriteEngine On
RewriteBase /blog/
RewriteRule ^index\.php$ - [L]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule . /blog/index.php [QSA,L]
</IfModule>
# END WordPress
EOL
echo "Blog .htaccess updated successfully"

# 4. Create theme directory if it doesn't exist
echo "Checking QuickSummit theme directory..."
THEME_DIR="$BLOG_DIR/wp-content/themes/quicksummit"
if [ ! -d "$THEME_DIR" ]; then
    echo "Creating QuickSummit theme directory..."
    mkdir -p "$THEME_DIR"
fi

# 5. Deploy single.php to theme directory
echo "Deploying single.php template..."
cat > "$THEME_DIR/single.php" << 'EOL'
<?php get_header(); ?>

<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <div class="single-post">
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <header class="single-post__header">
                            <h1 class="single-post__title"><?php the_title(); ?></h1>
                            <div class="single-post__meta">
                                <span class="single-post__date"><?php the_date(); ?></span>
                                <span class="single-post__author">by <?php the_author(); ?></span>
                                <?php if (has_category()) : ?>
                                    <span class="single-post__categories"><?php the_category(', '); ?></span>
                                <?php endif; ?>
                            </div>
                        </header>

                        <?php if (has_post_thumbnail()) : ?>
                            <div class="single-post__featured-image">
                                <?php the_post_thumbnail('large'); ?>
                            </div>
                        <?php endif; ?>

                        <div class="single-post__content">
                            <?php the_content(); ?>
                        </div>

                        <?php if (has_tag()) : ?>
                            <div class="single-post__tags">
                                <?php the_tags('<span class="tag-label">Tags:</span> ', ', '); ?>
                            </div>
                        <?php endif; ?>
                    </article>

                    <div class="post-navigation">
                        <div class="post-navigation__prev">
                            <?php previous_post_link('%link', '&larr; Previous Post'); ?>
                        </div>
                        <div class="post-navigation__next">
                            <?php next_post_link('%link', 'Next Post &rarr;'); ?>
                        </div>
                    </div>

                    <?php if (comments_open() || get_comments_number()) : ?>
                        <div class="post-comments">
                            <?php comments_template(); ?>
                        </div>
                    <?php endif; ?>

                <?php endwhile; else : ?>
                    <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-lg-4">
            <?php get_sidebar(); ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
EOL
echo "single.php deployed successfully"

# 6. Create reset-permalinks.php script
echo "Creating permalink reset script..."
cat > "$BLOG_DIR/reset-permalinks.php" << 'EOL'
<?php
// Load WordPress environment
define('WP_USE_THEMES', false);
require_once('wp-load.php');

// Set error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start output buffering
ob_start();

echo '<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WordPress Permalinks Reset</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            color: #2c3e50;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
            padding: 15px;
            margin: 15px 0;
            border-radius: 4px;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
            padding: 15px;
            margin: 15px 0;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <h1>WordPress Permalinks Reset</h1>';

// Set permalink structure to pretty permalinks with %postname%
$permalink_structure = '/%postname%/';
update_option('permalink_structure', $permalink_structure);

// Flush rewrite rules
flush_rewrite_rules();

echo '<div class="success">
    <p><strong>Success!</strong> Permalinks have been reset to: ' . $permalink_structure . '</p>
    <p>WordPress rewrite rules have been flushed.</p>
</div>';

echo '<p>Try accessing a blog post now:</p>';
echo '<ul>';

// Get 5 most recent posts
$recent_posts = wp_get_recent_posts(array(
    'numberposts' => 5,
    'post_status' => 'publish'
));

if (count($recent_posts) > 0) {
    foreach ($recent_posts as $post) {
        echo '<li><a href="' . get_permalink($post['ID']) . '" target="_blank">' . $post['post_title'] . '</a></li>';
    }
} else {
    echo '<li>No posts found</li>';
}

echo '</ul>';

echo '<p><a href="/blog/">Return to Blog</a></p>';
echo '</body></html>';

// End output buffering and send to browser
ob_end_flush();
EOL
echo "reset-permalinks.php created successfully"

# 7. If wordpress directory exists, redirect to blog
if [ -d "$WP_DIR" ]; then
    echo "Creating redirect from wordpress to blog..."
    cat > "$WP_DIR/index.php" << 'EOL'
<?php
// Redirect to blog
header("Location: /blog/");
exit;
EOL
    echo "Wordpress redirect created successfully"
fi

echo "Fix script completed successfully!"
echo "IMPORTANT: Visit https://quicksummit.net/blog/reset-permalinks.php in your browser to reset permalinks and fix the 404 errors"
echo "After confirming the fix works, remember to delete reset-permalinks.php from the server for security"
