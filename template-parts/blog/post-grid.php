<?php
/**
 * Template part for blog posts grid
 * Handles the main blog posts loop and layout
 */

// Get search query if it exists
$search_query = get_query_var('s');

// Setup pagination
$posts_per_page = 6;
$paged = get_query_var('paged') ? get_query_var('paged') : 1;

// Build query arguments for blog posts
$blog_args = array(
    'post_type' => 'post',
    'posts_per_page' => $posts_per_page,
    'paged' => $paged,
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC'
);

// Add search query if provided
if (!empty($search_query)) {
    $blog_args['s'] = $search_query;
}

// Execute the query
$blog_query = new WP_Query($blog_args);
?>

<section class="blog-content" style="position: relative;">
    <div class="container">
        <?php if ($blog_query->have_posts()) : ?>
            <div class="blog-posts-grid">
                <?php while ($blog_query->have_posts()) : $blog_query->the_post(); ?>
                    <?php get_template_part('template-parts/blog/post-card'); ?>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            </div>
            
            <?php get_template_part('template-parts/blog/pagination'); ?>
            
        <?php else : ?>
            <?php get_template_part('template-parts/blog/no-results'); ?>
        <?php endif; ?>
    </div>
    
    <!-- Bottom Border -->
    <div class="bottom-border" style="position: absolute; bottom: 0; left: -360px; width: 1920px; height: 1px; background-color: #ffffff; z-index: 3;"></div>
</section>
