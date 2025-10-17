<?php
/**
 * Template Name: Contact Page
 * Description: Contact page with HubSpot form integration
 */

get_header(); ?>

<main id="main" class="site-main contact-page">
    
    <?php get_template_part('template-parts/contact/contact-hero'); ?>
    
    <?php get_template_part('template-parts/contact/contact-form'); ?>

    <?php get_template_part('template-parts/contact/contact-cta'); ?>

</main>

<?php get_footer(); ?>
