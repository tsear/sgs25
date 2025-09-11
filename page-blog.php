<?php
/**
 * Blog Page Template
 * Custom page template that displays blog posts
 */

get_header();

// Store the original query
global $wp_query;
$original_query = $wp_query;

// Create a new query for blog posts
$blog_query = new WP_Query(array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'posts_per_page' => 6, // Adjust as needed
    'paged' => get_query_var('paged', 1)
));

// Replace the main query temporarily
$wp_query = $blog_query;

get_template_part('template-parts/blog/blog-header');
get_template_part('template-parts/blog/post-grid');

// Restore the original query
wp_reset_postdata();
$wp_query = $original_query;

get_footer();
?>
