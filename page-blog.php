<?php
/*
Template Name: Blog Page
*/
/**
 * Blog Page Template
 * Custom page template that displays blog posts
 */

get_header(); ?>

<main id="main" class="site-main blog-page">
    
    <?php get_template_part('template-parts/blog/blog-hero'); ?>
    
    <?php get_template_part('template-parts/blog/search-form'); ?>
    
    <?php get_template_part('template-parts/blog/post-grid'); ?>

    <?php get_template_part('template-parts/newsletter-signup'); ?>

</main>

<?php get_footer();
?>
