#!/bin/bash

# QuickSummit Website Deployment Script
# Created: March 11, 2025
# Purpose: Deploy header and services page updates to production

# Exit on error
set -e

# Configuration
TIMESTAMP=$(date +%Y%m%d_%H%M%S)
LOCAL_DIR="/home/linuxuser/quicksummit-build"
REMOTE_USER="admin"
REMOTE_HOST="quicksummit.net"
REMOTE_DIR="/home/admin/web/quicksummit.net/public_html"
BACKUP_DIR="/home/admin/backups/$TIMESTAMP"

# Log function
log() {
    echo "[$(date +%H:%M:%S)] $1"
}

# Create remote backup
log "Creating remote backup directory: $BACKUP_DIR"
ssh $REMOTE_USER@$REMOTE_HOST "mkdir -p $BACKUP_DIR"

# Backup specific files on remote server
log "Backing up header and services files on remote server"
ssh $REMOTE_USER@$REMOTE_HOST "cp $REMOTE_DIR/components/SharedHeader.astro $BACKUP_DIR/ 2>/dev/null || true"
ssh $REMOTE_USER@$REMOTE_HOST "cp $REMOTE_DIR/pages/services/index.html $BACKUP_DIR/ 2>/dev/null || true"

# Deploy the built files
log "Deploying updated files to production server"
rsync -avz --delete $LOCAL_DIR/dist/ $REMOTE_USER@$REMOTE_HOST:$REMOTE_DIR/

# Verify deployment
log "Verifying deployment"
ssh $REMOTE_USER@$REMOTE_HOST "ls -la $REMOTE_DIR/services/"
ssh $REMOTE_USER@$REMOTE_HOST "ls -la $REMOTE_DIR/components/"

log "Deployment completed successfully!"
log "Changes deployed:"
log "1. Updated header with service page dropdown menu"
log "2. Enhanced services page with links to individual service pages"
log "3. Added featured solutions section to services page"

log "If you encounter any issues, restore from backup at: $BACKUP_DIR"
