# GitHub Workflow SOP
# For QuickSummit Website Development

## Table of Contents
1. [Introduction](#introduction)
2. [Repository Structure](#repository-structure)
3. [Branching Strategy](#branching-strategy)
4. [Local Development Workflow](#local-development-workflow)
5. [Workflow After Server-Side Changes](#workflow-after-server-side-changes)
6. [Code Review Process](#code-review-process)
7. [Deployment Process](#deployment-process)
8. [Version Tagging](#version-tagging)
9. [Issue and Project Management](#issue-and-project-management)

## Introduction

This document outlines the standard GitHub workflow for the QuickSummit website development process. It complements the Server Update SOP and provides specific guidelines for maintaining code consistency when working with both local development and direct server changes.

## Repository Structure

The QuickSummit GitHub repository is organized as follows:

```
quicksummit-website/
├── .github/               # GitHub specific files (workflows, templates)
├── blog/                  # WordPress blog files
├── dist/                  # Compiled Astro output (gitignored)
├── docs/                  # Documentation files
├── node_modules/          # Node dependencies (gitignored)
├── public/                # Static assets
├── scripts/               # Deployment and utility scripts
├── src/                   # Astro source files
│   ├── components/        # Reusable UI components
│   ├── layouts/           # Page layouts
│   ├── pages/             # Page routing
│   └── styles/            # CSS styles
├── .gitignore             # Git ignore file
├── .htaccess              # Server configuration
├── astro.config.mjs       # Astro configuration
├── package.json           # Node dependencies
├── README.md              # Project documentation
└── tsconfig.json          # TypeScript configuration
```

## Branching Strategy

QuickSummit follows a simplified Git Flow branching strategy:

1. **`main`**: Production-ready code, always stable and deployable
2. **`develop`**: Integration branch for feature development
3. **Feature branches**: Created from `develop` for new features
4. **Hotfix branches**: Created from `main` for emergency fixes

Naming conventions:
- Feature branches: `feature/short-description`
- Hotfix branches: `hotfix/short-description`
- Server sync branches: `server-sync/YYYY-MM-DD`

## Local Development Workflow

### Setting Up Local Development Environment

```bash
# Clone the repository
git clone https://github.com/quicksummit/quicksummit-website.git
cd quicksummit-website

# Install dependencies
npm install

# Create a new feature branch from develop
git checkout develop
git pull origin develop
git checkout -b feature/your-feature-name

# Start local development server
npm run dev
```

### Making Changes

1. Make your changes to the necessary files
2. Test changes thoroughly in the local environment
3. Commit changes with descriptive messages:

```bash
# Stage your changes
git add .

# Commit with a descriptive message following conventional commits
git commit -m "feat: add new product showcase component

- Added responsive grid layout
- Implemented hover effects
- Added product filtering functionality

Relates to issue #123"
```

### Submitting Changes

```bash
# Push your branch to GitHub
git push origin feature/your-feature-name

# Create a pull request to the develop branch through GitHub
# Include details about the changes and testing performed
```

## Workflow After Server-Side Changes

When changes are made directly on the server (following the Server Update SOP), it's critical to synchronize those changes with the GitHub repository:

### 1. Document Server Changes

```bash
# While on the server
# Create a changelog entry
echo "$(date) - Modified /path/to/file - Reason: Fixed critical issue" >> ~/changelog.md
```

### 2. Create a Server Sync Branch

```bash
# On your local machine
git checkout main
git pull origin main
git checkout -b server-sync/$(date +%Y-%m-%d)
```

### 3. Copy Changes from Server to Local

```bash
# Using scp or rsync
scp admin@quicksummit.net:/home/admin/web/quicksummit.net/public_html/path/to/changed/file ./path/to/local/repo/file

# Or manually recreate the changes if they were small
```

### 4. Review and Clean Up Changes

```bash
# Check differences
git diff

# Review for sensitive data
grep -r "password\|key\|secret\|token" ./changed/files/
```

### 5. Commit and Push Server Changes

```bash
git add .
git commit -m "sync: server changes made on $(date +%Y-%m-%d)

- Fixed 404 errors in blog posts
- Updated .htaccess configuration
- Created new WordPress templates

These changes were applied directly to the server due to urgent customer needs."

git push origin server-sync/$(date +%Y-%m-%d)
```

### 6. Create Pull Request and Merge

1. Create a pull request from your `server-sync` branch to `main`
2. Include detailed description of changes made on the server
3. Once approved, merge to `main`
4. Create another PR to merge these changes to `develop` to keep both branches in sync

## Code Review Process

All changes, whether from local development or server synchronization, must undergo code review:

### Code Review Checklist

1. **Functionality**: Does the code work as intended?
2. **Quality**: Is the code well-written and maintainable?
3. **Security**: Are there any security concerns?
4. **Performance**: Are there any performance implications?
5. **Documentation**: Are the changes properly documented?
6. **Testing**: Has the code been adequately tested?

### Review Process

1. Assign at least one reviewer to the PR
2. Address all feedback and comments
3. Obtain approval from reviewer(s)
4. Merge only after all checks pass and approvals are received

## Deployment Process

### Standard Deployment (Local to Production)

```bash
# Merge PR to main
# Then deploy using the official deployment script
ssh admin@quicksummit.net
cd ~/scripts
./quicksummit-deploy.sh
```

### Post-Deployment Verification

```bash
# Check for errors
ssh admin@quicksummit.net
cd /home/admin/web/quicksummit.net/logs
tail -100 error.log

# Verify key pages and functionality
```

## Version Tagging

QuickSummit uses semantic versioning (MAJOR.MINOR.PATCH):

```bash
# After merging to main, create a new tag
git checkout main
git pull origin main
git tag -a v1.2.3 -m "Version 1.2.3 - Added product showcase and fixed blog issues"
git push origin v1.2.3
```

For hotfixes:
```bash
git tag -a v1.2.4-hotfix -m "Hotfix: Fixed critical 404 issue on blog posts"
git push origin v1.2.4-hotfix
```

## Issue and Project Management

### Creating Issues

1. Use GitHub Issues for bug tracking and feature requests
2. Use the provided templates
3. Include:
   - Clear description
   - Steps to reproduce (for bugs)
   - Expected vs. actual behavior
   - Screenshots or examples when relevant

### Issue Workflow

1. **Triage**: Assess priority and assign labels
2. **Assignment**: Assign to a team member
3. **Implementation**: Developer creates branch and implements solution
4. **Review**: Code review via pull request
5. **Deployment**: Changes merged and deployed
6. **Verification**: Issue verified as resolved in production
7. **Closure**: Issue closed with reference to the fixing PR

### Project Boards

Use GitHub Projects to track progress:
1. **Backlog**: Issues to be addressed
2. **To Do**: Issues ready for development
3. **In Progress**: Issues being worked on
4. **Review**: PRs awaiting review
5. **Done**: Completed and deployed items
