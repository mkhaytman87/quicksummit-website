#!/bin/bash
# GitHub Synchronization Script for QuickSummit Project
# Created: March 11, 2025
# Purpose: Sync local changes with GitHub repository following server updates

# Set variables
DATE_TAG=$(date +%Y-%m-%d)
BRANCH_NAME="server-sync/${DATE_TAG}"
COMMIT_MESSAGE="Server sync: Fix blog 404 issues and cleanup redundancies

- Fixed blog post 404 issues
- Consolidated WordPress directories
- Removed redundant files and diagnostic scripts
- Updated .htaccess files for proper routing
- Added SOPs for server updates and GitHub workflow"

# Check if we're in a git repository
if [ ! -d ".git" ]; then
    echo "Error: Not a git repository. Make sure you're in the project root directory."
    exit 1
fi

echo "Starting GitHub synchronization process..."

# 1. Make sure we have the latest changes from the remote repository
echo "Fetching latest changes from GitHub..."
git fetch origin
echo "Done."

# 2. Check current branch
CURRENT_BRANCH=$(git branch --show-current)
echo "Current branch: $CURRENT_BRANCH"

# 3. Create a new sync branch from main
echo "Creating new sync branch: $BRANCH_NAME"
git checkout -b "$BRANCH_NAME" origin/main || {
    echo "Failed to create new branch. Check if it already exists."
    echo "You can use 'git branch -D $BRANCH_NAME' to delete an existing branch."
    exit 1
}
echo "Branch created successfully."

# 4. Show status of changes
echo "Current git status:"
git status

# 5. Add all changes
echo "Adding all changes to git..."
git add .

# 6. Check what will be committed
echo "The following changes will be committed:"
git status

# 7. Ask for confirmation
echo ""
read -p "Do you want to proceed with the commit? (y/n): " proceed

if [[ "$proceed" != "y" && "$proceed" != "Y" ]]; then
    echo "Commit aborted."
    exit 0
fi

# 8. Commit the changes
echo "Committing changes..."
git commit -m "$COMMIT_MESSAGE"

# 9. Push the branch to GitHub
echo "Would you like to push the branch to GitHub now? (y/n): "
read push_now

if [[ "$push_now" == "y" || "$push_now" == "Y" ]]; then
    echo "Pushing branch to GitHub..."
    git push origin "$BRANCH_NAME"
    echo "Branch pushed successfully. Please create a pull request on GitHub to merge these changes."
    echo "Pull request URL: https://github.com/quicksummit/quicksummit-website/compare/main...$BRANCH_NAME"
else
    echo "Branch not pushed. You can push it later with:"
    echo "  git push origin $BRANCH_NAME"
fi

echo "Synchronization process completed."
echo "Remember to create a pull request on GitHub to merge these changes into main."
