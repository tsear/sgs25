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

// Build query arguments for blog posts - get ALL posts for show more functionality
$blog_args = array(
    'post_type' => 'post',
    'posts_per_page' => -1, // Get all posts
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
$total_posts = $blog_query->found_posts;
$posts_per_load = 6; // Show 6 posts initially, then 6 more on each "Show More" click
?>

<section class="blog-content" style="position: relative;">
    <div class="container">
        <?php if ($blog_query->have_posts()) : ?>
            <div class="blog-posts-grid" data-posts-per-load="<?php echo $posts_per_load; ?>">
                <?php 
                $post_count = 0;
                while ($blog_query->have_posts()) : $blog_query->the_post(); 
                    $post_count++;
                    $hidden_class = ($post_count > $posts_per_load) ? ' blog-post-hidden' : '';
                ?>
                    <div class="blog-post-item<?php echo $hidden_class; ?>">
                        <?php get_template_part('template-parts/blog/post-card'); ?>
                    </div>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            </div>
            
            <?php if ($total_posts > $posts_per_load) : ?>
                <div class="blog-show-more">
                    <button class="blog-show-more__btn" data-total-posts="<?php echo $total_posts; ?>" data-posts-per-load="<?php echo $posts_per_load; ?>"
                        <?php if (!empty($search_query)) : ?>data-search-filter="<?php echo esc_attr($search_query); ?>"<?php endif; ?>
                    >
                        <span class="blog-show-more__text">Show More</span>
                        <div class="blog-show-more__loader" style="display: none;">
                            <svg width="20" height="20" viewBox="0 0 50 50">
                                <circle cx="25" cy="25" r="20" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-dasharray="31.416" stroke-dashoffset="31.416">
                                    <animate attributeName="stroke-array" dur="2s" values="0 31.416;15.708 15.708;0 31.416" repeatCount="indefinite"/>
                                    <animate attributeName="stroke-dashoffset" dur="2s" values="0;-15.708;-31.416" repeatCount="indefinite"/>
                                </circle>
                            </svg>
                        </div>
                    </button>
                </div>
            <?php endif; ?>
            
        <?php else : ?>
            <?php get_template_part('template-parts/blog/no-results'); ?>
        <?php endif; ?>
    </div>
    
    <!-- Bottom Border -->
    <div class="bottom-border" style="position: absolute; bottom: 0; left: 50%; width: 100vw; height: 1px; background-color: #ffffff; z-index: 3; transform: translateX(-50%);"></div>
</section>
