<?php
/**
 * Archive template for Grant Opportunities
 * Displays the grants archive page at /grants/
 */

get_header(); ?>

<main id="main" class="site-main grants-archive">
    
    <?php get_template_part('template-parts/grants/grants-hero'); ?>
    
    <?php get_template_part('template-parts/grants/grants-search-form'); ?>
    
    <?php get_template_part('template-parts/grants/grants-grid'); ?>

    <?php get_template_part('template-parts/newsletter-signup'); ?>

</main>

<?php get_footer(); ?>
