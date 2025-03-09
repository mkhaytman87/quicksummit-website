# QuickSummit Website

The QuickSummit website, built with Astro and WordPress integration.

## 🚀 Project Structure

```
/
├── public/
│   └── Static assets (images, etc)
├── src/
│   ├── components/
│   ├── layouts/
│   └── pages/
├── wordpress/
│   ├── wp-content/
│   │   ├── themes/quicksummit/
│   │   └── plugins/quicksummit-shared-header/
│   └── .htaccess
└── .github/
    └── workflows/
        └── deploy.yml (Automated deployment configuration)
```

## 🧞 Development Commands

| Command           | Action                                       |
|:-----------------|:---------------------------------------------|
| `npm install`     | Install dependencies                        |
| `npm run dev`     | Start local dev server at `localhost:4321`  |
| `npm run build`   | Build your production site to `./dist/`     |
| `npm run preview` | Preview your build locally                  |

## 🔄 Deployment

The site uses GitHub Actions for automated deployment via SFTP:
1. Make changes locally
2. Commit and push to GitHub
3. GitHub Actions automatically:
   - Builds the Astro site
   - Prepares WordPress files (themes and plugins)
   - Creates necessary directory structure
   - Deploys to the production server via SFTP

## 🌐 Site Structure

- Main Site: https://quicksummit.net (Astro-based static site)
- Blog: https://quicksummit.net/blog (WordPress)

## 📝 Recent Updates

### Shared Navigation
- Implemented a WordPress plugin (`quicksummit-shared-header`) that injects the main site's navigation into the blog
- Added conditional logic in the WordPress theme to prevent duplicate navigation bars
- Fixed routing between main site and blog using `.htaccess` configurations

### Automated Deployment
- Set up GitHub Actions workflow for building and deploying both Astro and WordPress components
- Configured SFTP deployment for reliable file transfers
- Implemented directory creation to ensure proper structure on the server

## 🔮 Future Improvements

### Navigation Enhancement: Headless WordPress Approach

**Current Implementation:**
- The shared header is duplicated in two places (Astro layout and WordPress plugin)
- Hard-coded URLs in the WordPress plugin
- Potential for styling inconsistencies

**Planned Improvement (Headless WordPress):**
- Use WordPress as a backend-only CMS for navigation data
- Create a WP REST API endpoint to expose navigation structure
- Astro dynamically pulls menu data from WordPress
- Benefits:
  - Single source of truth for navigation
  - Leverage WordPress's menu management system
  - Eliminate code duplication
  - Content editors can update navigation without developer involvement

### Other Planned Enhancements:
- Implement database backup automation
- Improve page loading performance
- Add better error handling in deployment workflow
- Consider moving static assets to a CDN
