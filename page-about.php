<?php
/**
 * Template Name: About Page
 * Description: About us page
 */

get_header(); ?>

<main id="main" class="site-main about-page">
    
    <?php get_template_part('template-parts/about/about-hero'); ?>
    
    <?php get_template_part('template-parts/about/about-overview'); ?>
    
    <?php get_template_part('template-parts/about/about-team'); ?>

</main>

<?php get_footer(); ?>
