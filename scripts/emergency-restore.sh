#!/bin/bash

# QuickSummit Website Emergency Restore Script
# Created: March 11, 2025
# Purpose: Restore deleted files from the most recent backup

# Exit on error
set -e

# Configuration
REMOTE_USER="admin"
REMOTE_HOST="quicksummit.net"
REMOTE_DIR="/home/admin/web/quicksummit.net/public_html"

# Log function
log() {
    echo "[$(date +%H:%M:%S)] $1"
}

# Find the most recent backup directory on the server
log "Finding the most recent backup on the server..."
LATEST_BACKUP=$(ssh $REMOTE_USER@$REMOTE_HOST "ls -td /home/admin/backups/* | head -n 1")

if [ -z "$LATEST_BACKUP" ]; then
    log "ERROR: No backup found on the server!"
    exit 1
fi

log "Found backup directory: $LATEST_BACKUP"

# Check if we have a full backup in the backup directory
BACKUP_FILES_COUNT=$(ssh $REMOTE_USER@$REMOTE_HOST "find $LATEST_BACKUP -type f | wc -l")
log "Backup contains $BACKUP_FILES_COUNT files"

if [ "$BACKUP_FILES_COUNT" -lt 10 ]; then
    log "WARNING: This backup appears to be incomplete (only contains $BACKUP_FILES_COUNT files)"
    log "Looking for a more complete backup..."
    
    # Try to find a more complete backup
    for backup_dir in $(ssh $REMOTE_USER@$REMOTE_HOST "ls -td /home/admin/backups/*"); do
        count=$(ssh $REMOTE_USER@$REMOTE_HOST "find $backup_dir -type f | wc -l")
        log "Checking backup $backup_dir: $count files"
        if [ "$count" -gt 100 ]; then
            LATEST_BACKUP=$backup_dir
            BACKUP_FILES_COUNT=$count
            log "Found better backup: $LATEST_BACKUP with $BACKUP_FILES_COUNT files"
            break
        fi
    done
fi

# Check for a full site backup in the backup directory
if ssh $REMOTE_USER@$REMOTE_HOST "test -d $LATEST_BACKUP/public_html"; then
    log "Found a full site backup at $LATEST_BACKUP/public_html"
    BACKUP_SOURCE="$LATEST_BACKUP/public_html"
else
    log "Using backup at $LATEST_BACKUP"
    BACKUP_SOURCE="$LATEST_BACKUP"
fi

# Restore files from backup
log "Restoring files from $BACKUP_SOURCE to $REMOTE_DIR"
ssh $REMOTE_USER@$REMOTE_HOST "rsync -avz $BACKUP_SOURCE/ $REMOTE_DIR/"

# Verify restoration
log "Verifying restoration..."
FILE_COUNT=$(ssh $REMOTE_USER@$REMOTE_HOST "find $REMOTE_DIR -type f | wc -l")
log "Production site now has $FILE_COUNT files"

log "Emergency restoration completed!"
log "The website should now be restored from backup."
log "Please verify that the website is functioning correctly."

# Apply our specific changes safely (only the header and services page)
log "Now applying our specific changes to the header and services page..."
LOCAL_DIR="/home/linuxuser/quicksummit-build"

# Create a directory for the specific files
mkdir -p $LOCAL_DIR/specific-updates/components
mkdir -p $LOCAL_DIR/specific-updates/services

# Copy only the specific files we want to update
cp $LOCAL_DIR/dist/components/SharedHeader.* $LOCAL_DIR/specific-updates/components/
cp $LOCAL_DIR/dist/services/index.html $LOCAL_DIR/specific-updates/services/

# Deploy only these specific files
rsync -avz $LOCAL_DIR/specific-updates/components/ $REMOTE_USER@$REMOTE_HOST:$REMOTE_DIR/components/
rsync -avz $LOCAL_DIR/specific-updates/services/ $REMOTE_USER@$REMOTE_HOST:$REMOTE_DIR/services/

log "Specific updates applied successfully!"
log "The website should now be restored with our header and services page updates."
