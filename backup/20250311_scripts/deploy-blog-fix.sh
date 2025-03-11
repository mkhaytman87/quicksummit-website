#!/bin/bash
# WordPress Blog Fix Deployment Script
# This script deploys the necessary files to fix the blog post 404 issue

# Set variables
SOURCE_DIR="/home/linuxuser/quicksummit-build/blog"
DEST_DIR="/home/admin/web/quicksummit.net/public_html/blog"
ROOT_DIR="/home/admin/web/quicksummit.net/public_html"
THEME_DIR="wp-content/themes/quicksummit"
BACKUP_DIR="/home/linuxuser/quicksummit-build/backup/$(date +%Y%m%d)"

# Create backup directory
mkdir -p $BACKUP_DIR

echo "Starting deployment of blog fixes..."

# 1. Back up current files
echo "Backing up current files..."
if [ -f "$ROOT_DIR/.htaccess" ]; then
    cp "$ROOT_DIR/.htaccess" "$BACKUP_DIR/.htaccess.bak"
    echo ".htaccess backup created at $BACKUP_DIR/.htaccess.bak"
fi

if [ -d "$ROOT_DIR/wordpress" ]; then
    echo "Backing up wordpress directory..."
    mkdir -p "$BACKUP_DIR/wordpress_backup"
    cp -r "$ROOT_DIR/wordpress" "$BACKUP_DIR/wordpress_backup/"
    echo "wordpress directory backed up to $BACKUP_DIR/wordpress_backup/"
fi

if [ -d "$DEST_DIR/$THEME_DIR" ]; then
    cp -r "$DEST_DIR/$THEME_DIR" "$BACKUP_DIR/"
    echo "Theme backup created at $BACKUP_DIR/quicksummit"
fi

# 2. Update the root .htaccess file with our fixed version
echo "Updating root .htaccess file..."
cp "/home/linuxuser/quicksummit-build/.htaccess" "$ROOT_DIR/.htaccess"
echo "Root .htaccess updated successfully"

# 3. Deploy single.php to the theme directory
echo "Deploying single.php template..."
if [ -f "$SOURCE_DIR/$THEME_DIR/single.php" ]; then
    # Create theme directory if it doesn't exist
    mkdir -p "$DEST_DIR/$THEME_DIR"
    # Copy the file
    cp "$SOURCE_DIR/$THEME_DIR/single.php" "$DEST_DIR/$THEME_DIR/"
    echo "single.php deployed successfully"
else
    echo "ERROR: single.php not found at $SOURCE_DIR/$THEME_DIR/single.php"
    exit 1
fi

# 4. Deploy style.css with single post styles
echo "Deploying updated style.css..."
if [ -f "$SOURCE_DIR/$THEME_DIR/style.css" ]; then
    cp "$SOURCE_DIR/$THEME_DIR/style.css" "$DEST_DIR/$THEME_DIR/"
    echo "style.css deployed successfully"
else
    echo "ERROR: style.css not found at $SOURCE_DIR/$THEME_DIR/style.css"
    exit 1
fi

# 5. Deploy permalink reset script
echo "Deploying permalink reset script..."
if [ -f "$SOURCE_DIR/reset-permalinks.php" ]; then
    cp "$SOURCE_DIR/reset-permalinks.php" "$DEST_DIR/"
    echo "reset-permalinks.php deployed successfully"
else
    echo "ERROR: reset-permalinks.php not found at $SOURCE_DIR/reset-permalinks.php"
    exit 1
fi

# 6. Copy any unique files from wordpress directory to blog directory (if wordpress dir exists)
if [ -d "$ROOT_DIR/wordpress" ] && [ -d "$ROOT_DIR/blog" ]; then
    echo "Consolidating wordpress directory with blog directory..."
    
    # Copy any custom plugins from wordpress to blog
    if [ -d "$ROOT_DIR/wordpress/wp-content/plugins" ]; then
        echo "Copying custom plugins..."
        cp -r "$ROOT_DIR/wordpress/wp-content/plugins/"* "$ROOT_DIR/blog/wp-content/plugins/"
    fi
    
    # Copy any theme files that might be missing
    if [ -d "$ROOT_DIR/wordpress/wp-content/themes" ]; then
        echo "Copying theme files..."
        mkdir -p "$ROOT_DIR/blog/wp-content/themes"
        cp -r "$ROOT_DIR/wordpress/wp-content/themes/"* "$ROOT_DIR/blog/wp-content/themes/"
    fi
    
    # Add redirect in wordpress directory to point to blog
    echo "Creating redirect from /wordpress to /blog..."
    echo '<?php header("Location: /blog/"); ?>' > "$ROOT_DIR/wordpress/index.php"
    
    echo "WordPress and blog directories consolidated"
fi

# 7. Fix blog .htaccess if needed
echo "Ensuring blog .htaccess has correct rules..."
cat > "$DEST_DIR/.htaccess" << 'EOL'
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

echo "Deployment completed successfully!"
echo "IMPORTANT: Visit https://quicksummit.net/blog/reset-permalinks.php in your browser to reset permalinks and fix the 404 errors"
echo "After confirming the fix works, remember to delete reset-permalinks.php from the server for security"
