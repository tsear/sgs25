<?php
/**
 * Template part for blog posts grid
 * Handles the main blog posts loop and layout with "Show More" functionality
 */

// Get search query and category filter if they exist
$search_query = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : '';
$category_filter = isset($_GET['category']) ? sanitize_text_field($_GET['category']) : '';

// Check if we're on an archive page
$is_archive = is_category() || is_tag() || is_author() || is_search();

if ($is_archive) {
    // Use the main WordPress query for archive pages
    global $wp_query;
    $all_posts = $wp_query;
    $total_posts = $all_posts->found_posts;
} else {
    // Build query args for all posts (for regular blog page with manual filtering)
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

    // Add category filter if category is selected (for manual filtering on blog page)
    if (!empty($category_filter)) {
        // Try both category_name (slug) and category ID
        $category_obj = get_category_by_slug($category_filter);
        if ($category_obj) {
            $all_posts_args['cat'] = $category_obj->term_id;
        } else {
            $all_posts_args['category_name'] = $category_filter;
        }
    }

    // Get all posts for counting and show more functionality
    $all_posts = new WP_Query($all_posts_args);
    $total_posts = $all_posts->found_posts;
}
$posts_per_load = 6; // Show 6 posts initially, then 6 more on each "Show More" click

// Get posts to actually display initially
// Use ALL posts for show more functionality on all pages
$display_query = $all_posts;
?>

<section class="blog-content" style="position: relative;">
    <div class="container">
        <?php if ($display_query->have_posts()) : ?>
            <div class="blog-posts-grid" data-posts-per-load="<?php echo $posts_per_load; ?>">
                <?php 
                $post_count = 0;
                while ($display_query->have_posts()) : $display_query->the_post(); 
                    $post_count++;
                    $hidden_class = ($post_count > $posts_per_load) ? ' blog-post-hidden' : '';
                ?>
                    <div class="blog-post-item<?php echo $hidden_class; ?>">
                        <?php get_template_part('template-parts/blog/post-card'); ?>
                    </div>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
            
            <?php if ($total_posts > $posts_per_load) : ?>
                <div class="blog-show-more">
                    <button class="blog-show-more__btn" data-total-posts="<?php echo $total_posts; ?>" data-posts-per-load="<?php echo $posts_per_load; ?>"
                        <?php if ($is_archive) : ?>
                            data-archive-type="<?php 
                                if (is_category()) echo 'category'; 
                                elseif (is_tag()) echo 'tag'; 
                                elseif (is_author()) echo 'author'; 
                                elseif (is_search()) echo 'search';
                            ?>"
                            data-archive-id="<?php 
                                if (is_category() || is_tag() || is_author()) echo get_queried_object_id(); 
                            ?>"
                            <?php if (is_search()) : ?>data-search-query="<?php echo esc_attr(get_search_query()); ?>"<?php endif; ?>
                        <?php endif; ?>
                        <?php if (!empty($category_filter)) : ?>data-category-filter="<?php echo esc_attr($category_filter); ?>"<?php endif; ?>
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
    <div class="bottom-border" style="position: absolute; bottom: 0; left: -360px; width: 1920px; height: 1px; background-color: #ffffff; z-index: 3;"></div>
</section>

<?php wp_reset_postdata(); ?>
