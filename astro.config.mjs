// @ts-check
import { defineConfig } from 'astro/config';
import tailwind from '@astrojs/tailwind';

// https://astro.build/config
export default defineConfig({
  integrations: [
    tailwind({
      // Configure Tailwind CSS options here
      config: { path: './tailwind.config.mjs' }
    })
  ],
  site: 'https://quicksummit.net',
  outDir: './dist',
  base: '/',  // Changed from absolute URL to relative path
  trailingSlash: 'never',
  build: {
    format: 'directory',  // Changed from 'file' to 'directory'
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
