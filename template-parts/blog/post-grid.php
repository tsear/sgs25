<?php
/**
 * Template part for blog posts grid
 * Handles the main blog posts loop and layout
 */
?>

<section class="blog-content" style="position: relative;">
    <div class="container">
        <?php if (have_posts()) : ?>
            <div class="blog-posts-grid">
                <?php while (have_posts()) : the_post(); ?>
                    <?php get_template_part('template-parts/blog/post-card'); ?>
                <?php endwhile; ?>
            </div>
            
            <?php get_template_part('template-parts/blog/pagination'); ?>
            
        <?php else : ?>
            <?php get_template_part('template-parts/blog/no-results'); ?>
        <?php endif; ?>
    </div>
    
    <!-- Bottom Border -->
    <div class="bottom-border" style="position: absolute; bottom: 0; left: -360px; width: 1920px; height: 1px; background-color: #ffffff; z-index: 3;"></div>
</section>
