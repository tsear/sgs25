<?php
/**
 * Search Results Template
 * Displays search results for blog posts
 */

get_header();

get_template_part('template-parts/blog/blog-header');
get_template_part('template-parts/blog/search-form');
get_template_part('template-parts/blog/search-results');

get_footer();
?>