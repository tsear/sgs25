<?php
/**
 * Template Name: Product Page
 * Description: Product and services showcase page
 */

get_header(); ?>

<main id="main" class="site-main product-page">
    
    <?php get_template_part('template-parts/products/product-hero'); ?>
    
    <?php get_template_part('template-parts/products/product-overview'); ?>

    <?php get_template_part('template-parts/funnel-cta'); ?>
    
    <?php get_template_part('template-parts/products/product-approach'); ?>

</main>

<?php get_footer(); ?>
