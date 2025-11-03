<?php
/**
 * Single Success Story Template
 * Template for displaying individual success stories
 */

get_header(); ?>

<main class="single-success-story">
    <?php while (have_posts()) : the_post(); ?>
        
        <?php
        // Check if this post is built with Elementor
        $is_elementor = false;
        if (class_exists('\Elementor\Plugin')) {
            try {
                $document = \Elementor\Plugin::$instance->documents->get(get_the_ID());
                $is_elementor = $document && $document->is_built_with_elementor();
            } catch (Exception $e) {
                $is_elementor = false;
            }
        }
        
        if ($is_elementor) {
            // Let Elementor handle the entire post content
            the_content();
        } else {
            // Use our custom template parts for non-Elementor posts
            get_template_part('template-parts/blog/post-hero');
            get_template_part('template-parts/blog/post-content');
            get_template_part('template-parts/blog/post-navigation');
        }
        ?>
        
    <?php endwhile; ?>
    
    <?php 
    // Only show related posts if not built with Elementor
    if (!$is_elementor) {
        get_template_part('template-parts/blog/related-posts');
    }
    ?>
</main>

<?php get_footer(); ?>
