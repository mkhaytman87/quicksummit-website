# QuickSummit Website

A modern business website built with Astro.js, featuring a WordPress-powered blog integration that delivers fast, SEO-friendly content.

## Project Structure

```
quicksummit-build/
├── blog/               # WordPress blog installation
├── chunks/            # Astro build chunks
├── images/           # Static image assets
├── pages/            # Astro page components
└── ...               # Other static assets and build files
```

## Technologies Used

- [Astro.js](https://astro.build/) - Static site generator for high-performance web apps
- [WordPress](https://wordpress.org/) - Blog platform (installed in /blog subdirectory)
- MariaDB - Database server for WordPress content
- Nginx - Web server with custom configuration for WordPress in subdirectory

## Development

The project uses a multi-stage deployment process to ensure safe updates to the production environment:

1. Files are built in `quicksummit-build/`
2. Files are copied to `deploy-temp/` for staging
3. The deployment script (`scripts/quicksummit-deploy.sh`) validates and copies files to production

### Prerequisites

- Node.js and npm for Astro.js development
- Local WordPress installation for blog development
- MariaDB/MySQL for database management
- Access to production server for deployments

### WordPress Configuration

The WordPress blog is configured to run in the `/blog` subdirectory with the following setup:

- Database configuration in `wp-config.php` with secure credentials
- Permalinks configured for SEO-friendly URLs (/%postname%/)
- Blog accessible at `https://quicksummit.net/blog`
- Debug mode available for development (controlled in wp-config.php)

### Deployment Process

To deploy updates:

```bash
# Copy files to deploy-temp
cp -r quicksummit-build/* deploy-temp/

# Run deployment script
bash scripts/quicksummit-deploy.sh
```

#### Post-Deployment Checks

After deployment, verify:
- WordPress blog loads at `/blog`
- Individual blog posts are accessible
- Static assets are properly served
- No database connection errors

## Pages & Features

- `/` - Main landing page with business overview
- `/services` - Comprehensive services overview
- `/blog` - WordPress-powered blog with:
  - SEO-optimized URLs
  - Responsive design
  - Fast loading times
  - Integrated with main site design

## Security Best Practices

- WordPress database credentials are securely stored
- Regular database backups are essential
- Keep WordPress core, themes, and plugins updated
- Monitor access logs for suspicious activity
- Use strong passwords for all admin accounts
- Regularly update SSL certificates

## Troubleshooting

Common issues and solutions:

1. Database Connection Errors
   - Verify database credentials in wp-config.php
   - Check MariaDB service status
   - Ensure proper user permissions

2. URL/Permalink Issues
   - Clear WordPress permalink cache
   - Verify .htaccess configuration
   - Check Nginx rewrite rules

3. Deployment Problems
   - Verify file permissions
   - Check deployment logs
   - Ensure proper build process

## Maintenance

Regular maintenance tasks:
- Database backups (weekly recommended)
- WordPress updates
- Plugin updates
- Security audits
- Performance monitoring

## License

All rights reserved. This project and its contents are proprietary.

## Support

For technical issues or questions:
1. Check the troubleshooting section
2. Review deployment logs
3. Contact the development team