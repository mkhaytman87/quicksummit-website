#!/bin/bash
# Script to clean up redundancies in the QuickSummit project
# Created: March 11, 2025

# Create backup directory
BACKUP_DATE=$(date +%Y%m%d_%H%M%S)
BACKUP_DIR="/home/linuxuser/quicksummit-build/backup/$BACKUP_DATE"
mkdir -p "$BACKUP_DIR"
echo "Created backup directory: $BACKUP_DIR"

# 1. Back up wordpress directory before removing
echo "Backing up wordpress directory..."
cp -r /home/linuxuser/quicksummit-build/wordpress "$BACKUP_DIR/wordpress_backup"
echo "Wordpress directory backed up to $BACKUP_DIR/wordpress_backup"

# 2. Back up diagnostic scripts from blog directory
echo "Backing up diagnostic PHP scripts..."
mkdir -p "$BACKUP_DIR/blog_scripts"

# List of diagnostic scripts to back up and remove
SCRIPTS=(
  "check-routing.php"
  "check-theme.php"
  "debug-url.php"
  "fix-404.php"
  "fix-blog-404.php"
  "fix-routing.php"
  "fix-url-mismatch.php"
  "flush-rules.php"
  "quick-fix.php"
  "refresh-permalinks.php"
  "reset-permalinks.php"
  "switch-back.php"
  "switch-theme.php"
  "test-post.php"
  "test-request.php"
  "url-debug.php"
  "verify-install.php"
  "info.php"
  "wp-settings-check.php"
  "db-fix.php"
)

# Back up each script if it exists
for script in "${SCRIPTS[@]}"; do
  if [ -f "/home/linuxuser/quicksummit-build/blog/$script" ]; then
    cp "/home/linuxuser/quicksummit-build/blog/$script" "$BACKUP_DIR/blog_scripts/"
    echo "Backed up: $script"
  fi
done

# 3. Back up wordpress_latest.zip
if [ -f "/home/linuxuser/quicksummit-build/wordpress_latest.zip" ]; then
  echo "Backing up wordpress_latest.zip..."
  cp /home/linuxuser/quicksummit-build/wordpress_latest.zip "$BACKUP_DIR/"
  echo "wordpress_latest.zip backed up to $BACKUP_DIR/"
fi

# Create a log of all backups
echo "Creating backup log..."
echo "QuickSummit Redundancy Cleanup Backup" > "$BACKUP_DIR/backup_log.txt"
echo "Date: $(date)" >> "$BACKUP_DIR/backup_log.txt"
echo "=======================================" >> "$BACKUP_DIR/backup_log.txt"
echo "Items backed up:" >> "$BACKUP_DIR/backup_log.txt"
echo "1. wordpress directory" >> "$BACKUP_DIR/backup_log.txt"
echo "2. Diagnostic PHP scripts from blog directory:" >> "$BACKUP_DIR/backup_log.txt"
ls -la "$BACKUP_DIR/blog_scripts" | awk '{print "   - " $9}' >> "$BACKUP_DIR/backup_log.txt"
if [ -f "$BACKUP_DIR/wordpress_latest.zip" ]; then
  echo "3. wordpress_latest.zip" >> "$BACKUP_DIR/backup_log.txt"
fi
echo "=======================================" >> "$BACKUP_DIR/backup_log.txt"

echo "Backup complete. Now removing redundant files..."

# Remove redundant files/directories
echo "Removing wordpress directory..."
rm -rf /home/linuxuser/quicksummit-build/wordpress

# Remove diagnostic scripts
echo "Removing diagnostic PHP scripts..."
for script in "${SCRIPTS[@]}"; do
  if [ -f "/home/linuxuser/quicksummit-build/blog/$script" ]; then
    rm "/home/linuxuser/quicksummit-build/blog/$script"
    echo "Removed: $script"
  fi
done

# Remove wordpress_latest.zip
if [ -f "/home/linuxuser/quicksummit-build/wordpress_latest.zip" ]; then
  echo "Removing wordpress_latest.zip..."
  rm /home/linuxuser/quicksummit-build/wordpress_latest.zip
  echo "Removed wordpress_latest.zip"
fi

echo "Clean up complete. All removed items were backed up to: $BACKUP_DIR"
echo "Run 'git status' to see changes before committing to the repository."
