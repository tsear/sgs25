<?php
/**
 * Search Results Template
 * Displays search results and routes to appropriate post type search templates
 */

// Check if a specific post type was requested
$post_type = isset($_GET['post_type']) ? sanitize_text_field($_GET['post_type']) : '';

// If searching for grants, use grants search template
if ($post_type === 'grant_opportunity') {
    get_header();
    get_template_part('template-parts/grants/grants-hero');
    get_template_part('template-parts/grants/grants-search-form');
    get_template_part('template-parts/grants/grants-search-results');
    get_footer();
    return;
}

// If searching for success stories, use success stories search template
if ($post_type === 'success_story') {
    get_header();
    get_template_part('template-parts/success-stories/success-stories-hero');
    get_template_part('template-parts/success-stories/success-stories-search-form');
    get_template_part('template-parts/success-stories/success-stories-search-results');
    get_template_part('template-parts/newsletter-signup');
    get_footer();
    return;
}

// Default blog search (for regular posts or when no post type specified)
get_header();

get_template_part('template-parts/blog/blog-header');
get_template_part('template-parts/blog/search-form');
get_template_part('template-parts/blog/search-results');

get_footer();
?>