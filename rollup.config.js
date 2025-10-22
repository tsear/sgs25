import { nodeResolve } from '@rollup/plugin-node-resolve';
import commonjs from '@rollup/plugin-commonjs';
import terser from '@rollup/plugin-terser';

export default {
  input: 'assets/js/src/main.js',
  output: {
    file: 'assets/js/dist/main.bundle.js',
    format: 'iife',
    name: 'SGSTheme'
  },
  plugins: [
    nodeResolve({
      browser: true
    }),
    commonjs(),
    terser({
      compress: {
        drop_console: true, // Remove console.log statements
        drop_debugger: true
      },
      format: {
        comments: false // Remove comments
      }
    })
  ]
};
