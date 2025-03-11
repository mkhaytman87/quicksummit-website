# Scripts Directory

This directory is intentionally kept empty in the repository for security reasons.

## Purpose

This directory is reserved for deployment scripts, utilities, and other automation tools that are used for local development and server management. 

## Security Notice

For security purposes, actual deployment scripts with sensitive paths, commands, or configuration details should:

1. Be kept out of version control
2. Only be created locally as needed
3. Never contain credentials or sensitive tokens
4. Be removed after use or stored securely outside the repository

## Reference Documentation

For information about deployment processes and server management, please refer to the following documentation:

- `/docs/server-update-sop.md` - Standard Operating Procedures for server updates
- `/docs/github-workflow-sop.md` - GitHub workflow and synchronization procedures

## Deployment Scripts

When deployment scripts are needed, they should be:
- Created using the templates and procedures in the SOPs
- Thoroughly tested on staging environments before production use
- Backed up securely outside of version control
- Reviewed for security concerns before execution
