import { nodeResolve } from '@rollup/plugin-node-resolve';
import commonjs from '@rollup/plugin-commonjs';

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
    commonjs()
  ]
};
