<?php
/**
 * Search Results Template for Success Stories
 * Displays search results specifically for success story post type
 */

get_header();

get_template_part('template-parts/success-stories/success-stories-hero');
get_template_part('template-parts/success-stories/success-stories-search-form');
get_template_part('template-parts/success-stories/success-stories-search-results');
get_template_part('template-parts/newsletter-signup');

get_footer();
?>
