<?php
/**
 * Template Name: Grants Page
 * Description: Grants opportunities listing page
 */

get_header(); ?>

<main id="main" class="site-main grants-page">
    
    <?php get_template_part('template-parts/grants/grants-hero'); ?>
    
    <?php get_template_part('template-parts/grants/grants-search-form'); ?>
    
    <?php get_template_part('template-parts/grants/grants-grid'); ?>

</main>

<?php get_footer(); ?>
