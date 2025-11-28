<?php
/**
 * Template Name: Testimonials Page
 * Mirrors the Success Stories experience so we get the searchable CPT grid.
 */

get_header(); ?>

<main id="main" class="site-main success-stories-page testimonials-page">
    <?php get_template_part('template-parts/success-stories/success-stories-hero'); ?>
    <?php get_template_part('template-parts/success-stories/success-stories-search-form'); ?>
    <?php get_template_part('template-parts/success-stories/success-stories-grid'); ?>
    <?php get_template_part('template-parts/newsletter-signup'); ?>
</main>

<?php get_footer(); ?>
