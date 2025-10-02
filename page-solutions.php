<?php
/**
 * Template Name: Solutions Page
 * Description: Our solutions page
 */

get_header(); ?>

<main id="main" class="site-main solutions-page">
    
    <?php get_template_part('template-parts/solutions/solutions-hero'); ?>
    
    <?php get_template_part('template-parts/solutions/solutions-overview'); ?>
    
    <?php get_template_part('template-parts/solutions/solutions-features'); ?>
    
    <?php get_template_part('template-parts/solutions/solutions-benefits'); ?>
    
    <?php get_template_part('template-parts/solutions/solutions-cta'); ?>

</main>

<?php get_footer(); ?>
