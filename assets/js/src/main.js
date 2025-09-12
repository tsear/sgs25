/**
 * Smart Grant Solutions Theme JavaScript
 * Main entry point with modular imports
 */

import BlogShowMore from './modules/blog-showmore.js';
import BlogSearch from './modules/blog-search.js';

// Blog module initialization
document.addEventListener('DOMContentLoaded', function() {
    // Initialize blog modules
    if (document.querySelector('.blog-posts-grid')) {
        new BlogShowMore('.blog-posts-grid');
    }
    
    if (document.querySelector('.blog-search-form')) {
        new BlogSearch('.blog-search-form', '.blog-posts-grid');
    }
});
