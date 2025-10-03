<?php
/**
 * Template Name: Industries Page
 * Description: Industries we serve page
 */

get_header(); ?>

<main id="main" class="site-main industries-page">
    
    <?php get_template_part('template-parts/industries/industries-hero'); ?>
    
    <?php get_template_part('template-parts/industries/industries-overview'); ?>
    
    <?php get_template_part('template-parts/industries/industries-sectors'); ?>

</main>

<?php get_footer(); ?>
