<?php
/**
 * Template part for blog posts grid
 * Handles the main blog posts loop and layout with "Show More" functionality
 */

// Get search query if it exists
$search_query = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : '';

// Build query args for all posts (matching current search if any)
$all_posts_args = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'posts_per_page' => -1, // Get all posts
    'orderby' => 'date',
    'order' => 'DESC'
);

// Add search parameter if search query exists
if (!empty($search_query)) {
    $all_posts_args['s'] = $search_query;
}

// Get all posts for counting and show more functionality
$all_posts = new WP_Query($all_posts_args);

$total_posts = $all_posts->found_posts;
$posts_per_load = 6; // Show 6 posts initially, then 6 more on each "Show More" click
?>

<section class="blog-content" style="position: relative;">
    <div class="container">
        <?php if ($all_posts->have_posts()) : ?>
            <div class="blog-posts-grid" data-posts-per-load="<?php echo $posts_per_load; ?>">
                <?php 
                $post_count = 0;
                while ($all_posts->have_posts()) : $all_posts->the_post(); 
                    $post_count++;
                    $hidden_class = ($post_count > $posts_per_load) ? ' blog-post-hidden' : '';
                ?>
                    <div class="blog-post-item<?php echo $hidden_class; ?>">
                        <?php get_template_part('template-parts/blog/post-card'); ?>
                    </div>
                <?php endwhile; ?>
            </div>
            
            <?php if ($total_posts > $posts_per_load) : ?>
                <div class="blog-show-more">
                    <button class="blog-show-more__btn" data-total-posts="<?php echo $total_posts; ?>" data-posts-per-load="<?php echo $posts_per_load; ?>">
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
    <div class="bottom-border" style="position: absolute; bottom: 0; left: -360px; width: 1920px; height: 1px; background-color: #ffffff; z-index: 3;"></div>
</section>

<?php wp_reset_postdata(); ?>
