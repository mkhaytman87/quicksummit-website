#!/bin/bash

# QuickSummit Website GitHub Restore Script
# Purpose: Restore the website from GitHub repository

# Configuration
REMOTE_USER="admin"
REMOTE_HOST="quicksummit.net"
REMOTE_DIR="/home/admin/web/quicksummit.net/public_html"
GITHUB_REPO="https://github.com/quicksummit/quicksummit-website.git"
TEMP_DIR="/tmp/quicksummit-restore-$(date +%s)"

echo "Starting GitHub restoration process..."

# Clone the repository to a temporary directory
echo "Cloning GitHub repository..."
git clone $GITHUB_REPO $TEMP_DIR

# Build the site
echo "Building the site..."
cd $TEMP_DIR
npm install
npm run build

# Deploy to the server (without --delete flag)
echo "Deploying to server..."
rsync -avz $TEMP_DIR/dist/ $REMOTE_USER@$REMOTE_HOST:$REMOTE_DIR/

# Clean up
echo "Cleaning up..."
rm -rf $TEMP_DIR

echo "Restoration from GitHub completed."
echo "Please verify that the website is functioning correctly."
