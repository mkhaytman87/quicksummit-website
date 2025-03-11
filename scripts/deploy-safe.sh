#!/bin/bash

# QuickSummit Website Safe Deployment Script
# Created: March 11, 2025
# Purpose: Deploy only header and services page updates to production

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

# Start SSH agent and add key if not already running
if [ -z "$SSH_AUTH_SOCK" ]; then
    eval $(ssh-agent -s)
    ssh-add ~/.ssh/id_rsa 2>/dev/null || log "No SSH key found. You'll be prompted for passwords."
fi

# Create a single SSH connection for all commands
log "Setting up SSH connection"
ssh -o ControlMaster=auto -o ControlPath=~/.ssh/controlmasters/%r@%h:%p -o ControlPersist=10m $REMOTE_USER@$REMOTE_HOST "mkdir -p $BACKUP_DIR"

# Backup specific files on remote server
log "Backing up header and services files on remote server"
ssh $REMOTE_USER@$REMOTE_HOST "cp $REMOTE_DIR/components/SharedHeader.* $BACKUP_DIR/ 2>/dev/null || true"
ssh $REMOTE_USER@$REMOTE_HOST "cp $REMOTE_DIR/services/index.html $BACKUP_DIR/ 2>/dev/null || true"

# Deploy only the specific updated files
log "Deploying ONLY updated header and services files to production server"
rsync -avz $LOCAL_DIR/dist/components/SharedHeader.* $REMOTE_USER@$REMOTE_HOST:$REMOTE_DIR/components/
rsync -avz $LOCAL_DIR/dist/services/index.html $REMOTE_USER@$REMOTE_HOST:$REMOTE_DIR/services/

# Verify deployment
log "Verifying deployment"
ssh $REMOTE_USER@$REMOTE_HOST "ls -la $REMOTE_DIR/services/index.html"
ssh $REMOTE_USER@$REMOTE_HOST "ls -la $REMOTE_DIR/components/SharedHeader.*"

# Close SSH control connection
ssh -O exit -o ControlPath=~/.ssh/controlmasters/%r@%h:%p $REMOTE_USER@$REMOTE_HOST 2>/dev/null || true

log "Safe deployment completed!"
log "Only the header and services page were updated."
log "Changes deployed:"
log "1. Updated header with service page dropdown menu"
log "2. Enhanced services page with links to individual service pages"
log "3. Added featured solutions section to services page"

log "If you encounter any issues, restore from backup at: $BACKUP_DIR"
