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
  base: '/',
  trailingSlash: 'never',
  build: {
    format: 'file', // Reverting to 'file' format which works better with our CSS setup
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
