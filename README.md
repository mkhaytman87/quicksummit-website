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
└── wordpress/
    ├── wp-content/
    │   ├── themes/quicksummit/
    │   └── plugins/
    └── .htaccess
```

## 🧞 Development Commands

| Command           | Action                                       |
|:-----------------|:---------------------------------------------|
| `npm install`     | Install dependencies                        |
| `npm run dev`     | Start local dev server at `localhost:4321`  |
| `npm run build`   | Build your production site to `./dist/`     |
| `npm run preview` | Preview your build locally                  |

## 🔄 Deployment

The site uses GitHub Actions for automated deployment:
1. Make changes locally
2. Commit and push to GitHub
3. GitHub Actions automatically:
   - Builds the Astro site
   - Prepares WordPress files
   - Deploys to the production server

## 🌐 Site Structure

- Main Site: https://quicksummit.net
- Blog: https://quicksummit.net/blog
