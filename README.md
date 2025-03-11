# QuickSummit Website

A modern, high-performance website for QuickSummit, an AI consulting firm specializing in custom-trained AI solutions. This project integrates a static Astro.js frontend with a WordPress blog.

## Project Overview

- **Frontend Framework**: [Astro.js](https://astro.build/)
- **Blog Platform**: WordPress (PHP/MySQL)
- **Core Services**:
  - **AI Consultation**: Strategy, implementation, and optimization
  - **Custom AI Training**: Specialized models for business needs
  - **Integration Services**: API integration, system compatibility, seamless deployment

## Technology Stack

### Frontend
- **Astro.js**: Static site generation with dynamic capabilities
- **TailwindCSS**: Utility-first CSS framework for styling
- **AlpineJS**: Lightweight JavaScript for interactive components
- **TypeScript**: Type-safe JavaScript implementation

### Blog
- **WordPress**: Content management system for the blog
- **QuickSummit Theme**: Custom WordPress theme with responsive design
- **Essential Plugins**: Performance optimization and SEO enhancement

## Project Structure

```
quicksummit-website/
├── .github/               # GitHub specific files (workflows, templates)
├── blog/                  # WordPress blog files
├── dist/                  # Compiled Astro output (gitignored)
├── docs/                  # Documentation and SOPs
├── node_modules/          # Node dependencies (gitignored)
├── public/                # Static assets
├── scripts/               # Deployment scripts (kept empty in repo for security)
├── src/                   # Astro source files
│   ├── components/        # Reusable UI components
│   ├── layouts/           # Page layouts
│   ├── pages/             # Page routing
│   └── styles/            # CSS styles
├── .gitignore             # Git ignore file
├── .htaccess              # Server configuration
├── astro.config.mjs       # Astro configuration
├── package.json           # Node dependencies
├── PROGRESS.md            # Detailed task tracking and issue resolution
└── tsconfig.json          # TypeScript configuration
```

## Local Development

### Prerequisites
- Node.js (v16+)
- npm or yarn
- PHP 8.0+
- MySQL 5.7+

### Setup
1. Clone the repository
   ```bash
   git clone https://github.com/quicksummit/quicksummit-website.git
   cd quicksummit-website
   ```

2. Install dependencies
   ```bash
   npm install
   ```

3. Start development server
   ```bash
   npm run dev
   ```

4. Set up WordPress (if working with the blog)
   ```bash
   # Follow the instructions in docs/wordpress-setup.md
   ```

## Documentation

Comprehensive documentation is available in the `docs/` directory:

- **Server Updates**: [docs/server-update-sop.md](docs/server-update-sop.md) - Standard Operating Procedures for deploying updates to the production server
- **GitHub Workflow**: [docs/github-workflow-sop.md](docs/github-workflow-sop.md) - Detailed procedures for maintaining code consistency between server changes and the GitHub repository
- **Progress Tracking**: [PROGRESS.md](PROGRESS.md) - Detailed log of issue resolutions, cleanup efforts, and project enhancements

## Deployment Process

The project uses a multi-stage deployment process to ensure safe updates to the production environment:

1. Code is developed and tested locally using the development server
2. Changes are committed to the repository following the GitHub workflow SOP
3. The deployment script validates and copies files to production at `/home/admin/web/quicksummit.net/public_html`
4. Post-deployment checks verify functionality

### Post-Deployment Checks

After deployment, verify:
- Homepage loads correctly
- Blog posts are accessible
- All interactive elements function properly
- Forms submit correctly
- No console errors appear

## Security Considerations

A malicious deployment script was discovered in the root directory of the project. The script has been isolated and renamed to `deploy.sh.malicious` for analysis purposes.

### Security Measures

- All deployment scripts have been removed from version control for security
- Security audit completed on March 11, 2025
- Production credentials are stored securely and never committed to the repository
- Correct deployment process documented in SOPs
- Regular security audits of deployment processes

## Known Issues

See [PROGRESS.md](PROGRESS.md) for the latest status of known issues and their resolutions.

## Troubleshooting

### Common Issues

1. **WordPress 404 Errors**
   - Check .htaccess configuration
   - Verify permalink settings in WordPress admin
   - See the resolution details in PROGRESS.md

2. **Astro Build Failures**
   - Verify node modules are installed correctly
   - Check for TypeScript errors
   - Ensure all imports are valid

3. **Deployment Problems**
   - Follow the server update SOP
   - Check deployment logs
   - Verify file permissions on the server

## Contributing

1. Follow the GitHub workflow SOP in `docs/github-workflow-sop.md`
2. Create feature branches from `develop`
3. Submit pull requests with comprehensive descriptions
4. Ensure all code passes linting and builds successfully

## License

Proprietary - Copyright 2025 QuickSummit AI Consulting
