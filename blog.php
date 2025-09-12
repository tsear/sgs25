<?php
/**
 * Blog Page Template
 * Custom page template that displays blog posts
 */

get_header();

get_template_part('template-parts/blog/blog-header');
get_template_part('template-parts/blog/search-form');
get_template_part('template-parts/blog/post-grid');

get_footer();
?>
