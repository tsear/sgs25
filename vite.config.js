import { defineConfig } from 'vite';
import react from '@vitejs/plugin-react';
import { resolve } from 'path';

// https://vitejs.dev/config/
export default defineConfig({
  plugins: [react()],
  
  build: {
    // Output to WordPress assets directory
    outDir: 'assets/dist',
    emptyOutDir: false, // Don't delete existing files in dist
    
    // Modern browser targets (ES2015+)
    target: 'es2015',
    
    // Generate sourcemaps for debugging
    sourcemap: true,
    
    // Minification
    minify: 'terser',
    
    rollupOptions: {
      input: {
        // Entry point for video features component
        'video-features': resolve(__dirname, 'assets/js/react/video-features/index.jsx'),
      },
      output: {
        // Output format
        format: 'es',
        
        // Custom file naming (no hash for WordPress cache busting via filemtime)
        entryFileNames: '[name].js',
        chunkFileNames: '[name].js',
        assetFileNames: '[name].[ext]',
      },
    },
  },
  
  // Dev server settings
  server: {
    port: 3000,
    strictPort: false,
    open: false,
  },
  
  // Resolve aliases
  resolve: {
    alias: {
      '@': resolve(__dirname, 'assets/js/react'),
      '@components': resolve(__dirname, 'assets/js/react/components'),
    },
  },
});
