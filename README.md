# QuickSummit.net - Business AI Solutions Website

A modern, performant website built with Astro and Tailwind CSS showcasing our AI solutions and services for businesses.

## 🚀 Features

- ⚡️ Built with Astro for maximum performance
- 💨 Styled with Tailwind CSS
- 🎨 Clean, modern design with gradient accents
- 📱 Fully responsive across all devices
- 🔄 Server-side rendering
- 🔍 SEO optimized
- 🌐 Integrated WordPress blog
- 🎯 Service-specific landing pages
- 📊 Google Analytics integration

## 🛠️ Tech Stack

- [Astro](https://astro.build) - The web framework for content-driven websites
- [Tailwind CSS](https://tailwindcss.com) - Utility-first CSS framework
- [WordPress](https://wordpress.org) - Blog and CMS integration
- Node.js / npm

## 🏗️ Project Structure

```
/
├── public/              # Static assets
│   ├── favicon.svg
│   └── images/
├── src/
│   ├── components/      # UI components
│   ├── layouts/         # Page layouts
│   ├── pages/          # Page components
│   │   └── services/   # Service landing pages
│   └── styles/         # Global styles
├── wordpress/          # WordPress integration
│   ├── wp-content/
│   │   ├── themes/
│   │   └── plugins/
└── package.json
```

## 🚀 Getting Started

### Prerequisites

- Node.js (version 16 or later)
- npm
- WordPress (for blog functionality)

### Development

1. Clone the repository:
   ```bash
   git clone https://github.com/mkhaytman87/quicksummit-website.git
   cd quicksummit-website
   ```

2. Install dependencies:
   ```bash
   npm install
   ```

3. Start the development server:
   ```bash
   npm run dev
   ```

4. Open [http://localhost:3000](http://localhost:3000) in your browser

### Building for Production

```bash
npm run build
```

The built files will be in the `dist/` directory.

## 📝 Content Management

### Adding New Services

1. Create a new service page in `src/pages/services/`
2. Update the services array in `src/pages/services.astro`
3. Add the service to the navigation dropdown in `src/components/SharedHeader.astro`

### Blog Posts

Blog content is managed through WordPress in the `/blog` subdirectory. The theme and custom plugins are version controlled in the `wordpress/` directory.

## 🚀 Deployment

The site is automatically deployed via GitHub Actions when changes are pushed to the main branch. The deployment process:

1. Builds the Astro site
2. Copies WordPress theme and plugins
3. Deploys to production server via SFTP

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Submit a pull request

## 📄 License

This project is proprietary and confidential. All rights reserved.

## 👥 Team

- Mark Khaytman - Lead Developer
- [Add team members as needed]

## 📞 Support

For support or inquiries, please [contact us](https://quicksummit.net/contact) or open an issue in the repository.