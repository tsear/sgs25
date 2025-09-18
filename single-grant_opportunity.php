<?php
/**
 * Single Grant Opportunity Template
 * Template for displaying individual grant opportunities
 */

get_header(); ?>

<main class="single-grant">
    <?php while (have_posts()) : the_post(); ?>
        
        <?php get_template_part('template-parts/blog/post-hero'); ?>
        
        <?php get_template_part('template-parts/blog/post-content'); ?>
        
        <?php get_template_part('template-parts/blog/post-navigation'); ?>
        
    <?php endwhile; ?>
    
    <?php get_template_part('template-parts/blog/related-posts'); ?>
</main>

<?php get_footer(); ?>
