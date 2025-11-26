<?php
/**
 * Archive template for Downloadable Content
 * Displays the downloads archive page at /downloads/
 */

get_header(); ?>

<main id="main" class="site-main downloads-archive">
    
    <?php get_template_part('template-parts/downloads/downloads-hero'); ?>
    
    <?php get_template_part('template-parts/downloads/downloads-search-form'); ?>
    
    <?php get_template_part('template-parts/downloads/downloads-grid'); ?>

</main>

<?php get_footer(); ?>