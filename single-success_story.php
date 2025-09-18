<?php
/**
 * Single Success Story Template
 * Template for displaying individual success stories
 */

get_header(); ?>

<main class="single-success-story">
    <?php while (have_posts()) : the_post(); ?>
        
        <?php get_template_part('template-parts/blog/post-hero'); ?>
        
        <?php get_template_part('template-parts/blog/post-content'); ?>
        
        <?php get_template_part('template-parts/blog/post-navigation'); ?>
        
    <?php endwhile; ?>
    
    <?php get_template_part('template-parts/blog/related-posts'); ?>
</main>

<?php get_footer(); ?>
