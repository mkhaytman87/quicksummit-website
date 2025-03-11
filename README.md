# QuickSummit Website

A modern business website built with Astro.js, featuring a WordPress-powered blog integration that delivers fast, SEO-friendly content for an AI solutions company.

## Project Overview

QuickSummit is a business website for a company that offers AI solutions and services to businesses of all sizes. The website is built with modern web technologies and follows best practices for performance, SEO, and security.

### Business Services

QuickSummit offers the following AI-related services:

- **AI Automation & Workflow Optimization**: Process automation, workflow optimization, task scheduling
- **Custom AI Solutions**: Custom AI models, specialized algorithms, business-specific AI
- **Data Analytics & Insights**: Predictive analytics, business intelligence, data visualization
- **AI Integration Services**: API integration, system compatibility, seamless deployment
- **Consulting & Strategy**: Strategic planning, implementation roadmap, ROI assessment
- **Training & Support**: User training, technical support, documentation

## Project Structure

```
quicksummit-build/
├── .astro/              # Astro build cache
├── .git/                # Git repository
├── .github/             # GitHub configuration
├── .vscode/             # VSCode configuration
├── blog/                # WordPress blog installation
├── dist/                # Built static files (output directory)
├── node_modules/        # Node.js dependencies
├── public/              # Static assets
├── quicksummit/         # Project-specific files
├── shared/              # Shared components/utilities
├── src/                 # Source code
│   ├── components/      # Reusable UI components
│   ├── layouts/         # Page layouts
│   └── pages/           # Page components
└── wordpress/           # WordPress-related files
```

### Key Files

- `astro.config.mjs` - Astro configuration
- `tailwind.config.mjs` - Tailwind CSS configuration
- `package.json` - Project dependencies and scripts
- `SECURITY-INCIDENT.md` - Documentation of security incident
- `scripts/quicksummit-deploy.sh` - Deployment script

## Technology Stack

- **Frontend**:
  - [Astro.js](https://astro.build/) (v5.1.5) - Static site generator
  - [Tailwind CSS](https://tailwindcss.com/) (v3.4.17) - Utility-first CSS framework
  - JavaScript/TypeScript - Programming languages

- **Backend**:
  - [WordPress](https://wordpress.org/) - Blog platform (installed in /blog subdirectory)
  - [MariaDB](https://mariadb.org/) - Database server for WordPress content

- **Server**:
  - [Nginx](https://nginx.org/) - Web server with custom configuration
  - Apache-compatible configuration (.htaccess) - URL rewriting and handling

- **Deployment**:
  - Custom deployment script (`scripts/quicksummit-deploy.sh`)
  - Multi-stage deployment process

## Development Environment Setup

### Prerequisites

- Node.js (v16+) and npm for Astro.js development
- Local WordPress installation for blog development
- MariaDB/MySQL for database management
- Access to production server for deployments

### Installation

1. Clone the repository:
   ```bash
   git clone [repository-url]
   cd quicksummit-build
   ```

2. Install dependencies:
   ```bash
   npm install
   ```

3. Start the development server:
   ```bash
   npm run dev
   ```

4. For WordPress development, set up a local WordPress installation in the `/blog` directory.

## WordPress Integration

The WordPress blog is configured to run in the `/blog` subdirectory with the following setup:

- Database configuration in `wp-config.php` with credentials:
  - Database name: `mkhaytman_wp_db`
  - Database user: `wp_quicksummit`
  - Database password: `QuickSummit2024` (Note: Consider changing in production)
  - Database host: `localhost`

- WordPress Configuration:
  - Debug mode is currently enabled in the deployed version (`WP_DEBUG` set to `true`)
  - A new configuration file (`wp-config-new.php`) exists with debug mode disabled, suggesting plans to update the configuration
  - Permalinks configured for SEO-friendly URLs (/%postname%/)
  - Blog accessible at `https://quicksummit.net/blog`

- WordPress .htaccess Configuration:
  ```
  # BEGIN WordPress
  <IfModule mod_rewrite.c>
  RewriteEngine On
  RewriteBase /blog/
  RewriteRule ^index\.php$ - [L]
  RewriteCond %{REQUEST_FILENAME} !-f
  RewriteCond %{REQUEST_FILENAME} !-d
  RewriteRule . /blog/index.php [L]
  </IfModule>
  # END WordPress
  ```

## URL Structure and Handling

The website uses clean URLs without .html extensions. This is configured in the `.htaccess` file with the following rules:

- Redirect any direct .html requests to clean URLs
- Handle the /services/ directory specifically
- Map clean URLs to actual .html files
- Set default index pages
- Define MIME types for various file extensions

## Deployment Process

The project uses a multi-stage deployment process to ensure safe updates to the production environment:

1. Files are built in `quicksummit-build/`
   ```bash
   cd /home/linuxuser/quicksummit-build
   npm install
   npm run build
   ```

2. Files are copied to `deploy-temp/` for staging
   ```bash
   cp -r quicksummit-build/* deploy-temp/
   ```

3. The deployment script (`scripts/quicksummit-deploy.sh`) validates and copies files to production at `/home/admin/web/quicksummit.net/public_html`
   ```bash
   bash scripts/quicksummit-deploy.sh
   ```

### Post-Deployment Checks

After deployment, verify:
- WordPress blog loads at `/blog`
- Individual blog posts are accessible
- Static assets are properly served
- No database connection errors

## Security Considerations

### Recent Security Incident (March 2025)

A malicious deployment script was discovered in the root directory of the project. The script has been isolated and renamed to `deploy.sh.malicious` for analysis purposes.

**Malicious Script Analysis**:
- Location: `/home/linuxuser/deploy.sh`
- Discovered: March 2025
- Current Status: Renamed to `deploy.sh.malicious` and isolated
- Behavior: The script contained destructive commands that could have deleted system files
- Severity: Critical (could result in complete system destruction if executed)

**Mitigation Steps Taken**:
- Script has been renamed and isolated for analysis
- Correct deployment script verified at `/home/linuxuser/scripts/quicksummit-deploy.sh`
- File permissions and ownership have been verified
- Deployment process now uses the verified script in the `scripts/` directory

**Security Recommendations**:
- Implement file integrity monitoring
- Regular audit of deployment scripts
- Restrict sudo access
- Implement change management procedures
- Regular security audits of deployment processes

### WordPress Security Best Practices

- WordPress database credentials are securely stored
- Regular database backups are essential
- Keep WordPress core, themes, and plugins updated
- Monitor access logs for suspicious activity
- Use strong passwords for all admin accounts
- Regularly update SSL certificates

## Maintenance Tasks

Regular maintenance tasks:
- Database backups (weekly recommended)
- WordPress updates
- Plugin updates
- Security audits
- Performance monitoring

## Troubleshooting

Common issues and solutions:

1. **Database Connection Errors**
   - Verify database credentials in wp-config.php
   - Check MariaDB service status
   - Ensure proper user permissions

2. **URL/Permalink Issues**
   - Clear WordPress permalink cache
   - Verify .htaccess configuration
   - Check Nginx rewrite rules
   - Ensure theme has a `single.php` file for individual post display
   - Refresh permalinks in WordPress admin (Settings > Permalinks > Save)

3. **Deployment Problems**
   - Verify file permissions
   - Check deployment logs
   - Ensure proper build process

## Astro Configuration

The Astro configuration file (`astro.config.mjs`) contains the following settings:

```javascript
export default defineConfig({
  integrations: [
    tailwind({
      config: { path: './tailwind.config.mjs' }
    })
  ],
  site: 'https://quicksummit.net',
  outDir: './dist',
  base: 'https://quicksummit.net',
  trailingSlash: 'never',
  build: {
    format: 'file',
    inlineStylesheets: 'never'
  },
  vite: {
    build: {
      cssCodeSplit: false,
      rollupOptions: {
        output: {
          assetFileNames: '[name][extname]'
        }
      },
      minify: false
    }
  }
});
```

## Contact Information

For technical issues or questions:
1. Check the troubleshooting section
2. Review deployment logs
3. Contact the development team at contact@quicksummit.net

## License

All rights reserved. This project and its contents are proprietary.
