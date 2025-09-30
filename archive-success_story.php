<?php
/**
 * Archive template for Success Stories
 * Displays the success stories archive page at /success-stories/
 */

get_header(); ?>

<main id="main" class="site-main success-stories-archive">
    
    <?php get_template_part('template-parts/success-stories/success-stories-hero'); ?>

    <?php get_template_part('template-parts/success-stories/success-stories-search-form'); ?>
    
    <?php get_template_part('template-parts/success-stories/success-stories-grid'); ?>

    <?php get_template_part('template-parts/newsletter-signup'); ?>

</main>

<?php get_footer(); ?>
