# Standard Operating Procedures (SOPs)
# Server Update and GitHub Synchronization

## Table of Contents
1. [Introduction](#introduction)
2. [Direct Server Update SOP](#direct-server-update-sop)
3. [GitHub Repository Synchronization SOP](#github-repository-synchronization-sop)
4. [Emergency Hotfix SOP](#emergency-hotfix-sop)
5. [Rollback Procedure SOP](#rollback-procedure-sop)
6. [Security Considerations](#security-considerations)
7. [Appendix: Checklists](#appendix-checklists)

## Introduction

This document outlines the standard operating procedures for:
1. Making direct updates to the QuickSummit production server
2. Ensuring proper synchronization with the GitHub repository
3. Implementing emergency hotfixes
4. Rolling back changes if necessary

These SOPs are essential for maintaining consistency, security, and reliability when working with the QuickSummit website infrastructure.

## Direct Server Update SOP

### When to Use Direct Server Updates
- **Emergency fixes** that need immediate attention
- **WordPress-specific changes** that require direct database or file access
- **Configuration tweaks** that need to be tested in the production environment
- **Performance optimizations** that need to be evaluated in real-time

### Pre-Update Checklist
- [ ] Identify the specific issue requiring a direct server update
- [ ] Document the current state and expected outcome
- [ ] Create a local backup of files to be modified
- [ ] Create a server backup of files to be modified

### Server Update Procedure

#### 1. Secure Server Access
```bash
# Use SSH key-based authentication
ssh admin@quicksummit.net

# Navigate to web directory
cd /home/admin/web/quicksummit.net/public_html
```

#### 2. Create Server-Side Backup
```bash
# Create date-based backup directory
BACKUP_DATE=$(date +%Y%m%d_%H%M%S)
mkdir -p ~/backups/$BACKUP_DATE

# Backup files to be modified
cp /path/to/file/being/modified ~/backups/$BACKUP_DATE/
```

#### 3. Implement Changes

**Method A: Direct Edit (for small changes)**
```bash
# Edit file with nano or vi
sudo nano /path/to/file/being/modified

# Check syntax for critical files
if [[ "$file" == *.php ]]; then
  php -l /path/to/file/being/modified
fi

if [[ "$file" == *.htaccess ]]; then
  apachectl -t  # Check Apache config
fi
```

**Method B: Script Deployment (for multiple changes)**
```bash
# Create update script locally
# Transfer to server
scp update-script.sh admin@quicksummit.net:~/scripts/

# Make executable and run
chmod +x ~/scripts/update-script.sh
sudo ~/scripts/update-script.sh
```

#### 4. Test Changes
- Verify the changes fixed the intended issue
- Check for any unintended side effects
- Test core website functionality

#### 5. Document Changes
```bash
# Create change log entry
echo "$(date) - $(whoami) - Modified /path/to/file - Reason: Fixed blog 404 issue" >> ~/change-logs/server-updates.log
```

### Post-Update Checklist
- [ ] Verify the issue is resolved
- [ ] Document all changes made (files, configurations, database)
- [ ] Update GitHub repository (see GitHub Synchronization SOP)
- [ ] Communicate changes to team members

## GitHub Repository Synchronization SOP

### Principles
1. **GitHub as source of truth**: The GitHub repository should always reflect the current production state
2. **Atomic commits**: Each logical change should be its own commit
3. **Traceability**: All changes should link to issues or tickets
4. **Documentation**: Commit messages should clearly explain what, why, and how

### Synchronization Procedure After Direct Server Changes

#### 1. Clone or Update Local Repository
```bash
# If not already cloned
git clone git@github.com:quicksummit/quicksummit-website.git

# If already cloned, update
cd quicksummit-website
git fetch origin
git pull origin main
```

#### 2. Copy Server Changes to Local Repository
```bash
# Option 1: Pull changes directly from server
scp admin@quicksummit.net:/home/admin/web/quicksummit.net/public_html/path/to/changed/file ./path/in/repo/

# Option 2: If changes made locally first, skip this step
```

#### 3. Review Changes
```bash
# Review differences
git diff

# Ensure no sensitive data is included
# Check for password/API keys in:
grep -r "password\|key\|secret\|token" ./path/in/repo/
```

#### 4. Create Branch for Server Changes
```bash
# Create branch with descriptive name
git checkout -b server-hotfix-blog-404-fix

# Add modified files
git add path/to/changed/files

# Commit with detailed message
git commit -m "Fix: Blog post 404 errors
- Updated root .htaccess to properly handle blog URLs
- Created single.php template for post display
- Consolidated WordPress directories
- Relates to issue #42"
```

#### 5. Push and Create Pull Request
```bash
# Push branch to GitHub
git push origin server-hotfix-blog-404-fix

# Create pull request through GitHub interface
# Include details about server changes and testing
```

#### 6. Peer Review and Merge
- Have another team member review the changes
- Merge the pull request to main branch
- Delete the feature branch after merging

#### 7. Tag Production Release
```bash
# Create production tag
git tag -a v1.2.3-hotfix -m "Production hotfix for blog 404 issues"
git push origin v1.2.3-hotfix
```

### Continuous Integration Considerations
- Ensure CI/CD pipelines are aware of direct server changes
- If CI/CD deploys automatically, consider temporarily disabling during hotfix period

## Emergency Hotfix SOP

### When to Use Emergency Hotfixes
- Critical security vulnerabilities
- Website downtime issues
- Data integrity emergencies
- Major functionality breakage affecting business operations

### Emergency Hotfix Procedure

#### 1. Assessment and Communication
- Identify the severity and impact of the issue
- Notify appropriate stakeholders
- Create an incident ticket/issue

#### 2. Implement Server Fix
- Follow the Direct Server Update SOP with these additional steps:
  - Log start time of emergency intervention
  - Document initial state before any changes
  - Make minimal changes necessary to resolve the issue

#### 3. Expedited Testing
- Verify the fix addresses the critical issue
- Perform focused testing on affected functionality
- Document any remaining non-critical issues for later resolution

#### 4. Immediate Repository Synchronization
- Follow GitHub Synchronization SOP with expedited review
- Tag the emergency hotfix explicitly

#### 5. Post-Incident Review
- Conduct a post-mortem analysis
- Document root cause and resolution
- Identify preventative measures for future

## Rollback Procedure SOP

### When to Rollback
- When a change causes unexpected critical issues
- When a fix does not resolve the intended problem
- When multiple interdependent changes cause conflicts

### Rollback Procedure

#### 1. Decision to Rollback
- Assess the impact of keeping the change vs. rolling back
- Document the decision and rationale
- Communicate with stakeholders

#### 2. Execute Server Rollback
```bash
# Restore from backup
cp ~/backups/$BACKUP_DATE/file.php /home/admin/web/quicksummit.net/public_html/path/to/file.php

# If database changes were made:
mysql -u username -p database_name < ~/backups/$BACKUP_DATE/database.sql

# If multiple files were changed, use script:
bash ~/scripts/rollback.sh $BACKUP_DATE
```

#### 3. Verify Rollback
- Confirm the system is restored to previous state
- Verify core functionality works as expected
- Document any remaining issues

#### 4. Repository Synchronization After Rollback
- Create a new branch from the last known good state
- Cherry-pick any good changes from the failed update
- Update documentation to reflect rollback

## Security Considerations

### Sensitive Data Protection
- Never store credentials, API keys, or sensitive data in scripts or version control
- Use environment variables or secure credential storage
- Redact sensitive information from logs and documentation

### Access Control
- Use principle of least privilege for server access
- Implement multi-factor authentication for admin accounts
- Regularly rotate SSH keys and credentials

### Audit Trail
- Maintain detailed logs of all server changes
- Include timestamp, user, files changed, and reason
- Periodically review logs for unauthorized changes

### File Integrity
- Consider implementing file integrity monitoring
- Compare production files with repository versions
- Automate detection of unauthorized changes

## Appendix: Checklists

### Direct Server Update Checklist
```markdown
## Pre-Update
- [ ] Document the issue and solution plan
- [ ] Create local backups
- [ ] Create server backups
- [ ] Notify team of impending changes

## During Update
- [ ] Execute changes following the SOP
- [ ] Validate syntax and configuration
- [ ] Test changes thoroughly

## Post-Update
- [ ] Document all changes made
- [ ] Synchronize with GitHub repository
- [ ] Update change log
- [ ] Notify team of completed changes
```

### GitHub Synchronization Checklist
```markdown
- [ ] Pull latest changes from main branch
- [ ] Copy server changes to local repository
- [ ] Review for sensitive data
- [ ] Create feature branch
- [ ] Commit with detailed message
- [ ] Push and create pull request
- [ ] Peer review
- [ ] Merge to main branch
- [ ] Tag production release
```
