<?php
/**
 * Template Name: Success Stories Page
 * Description: Success stories listing page
 */

get_header(); ?>

<main id="main" class="site-main success-stories-page">
    
    <?php get_template_part('template-parts/success-stories/success-stories-hero'); ?>
    
    <?php get_template_part('template-parts/success-stories/success-stories-search-form'); ?>
    
    <?php get_template_part('template-parts/success-stories/success-stories-grid'); ?>

</main>

<?php get_footer(); ?>
