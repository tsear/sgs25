<?php
/**
 * Template part for grants grid
 * Handles the main grants loop and layout with "Show More" functionality
 */

// Get search query and category filter if they exist
$search_query = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : '';
$category_filter = isset($_GET['grant_category']) ? sanitize_text_field($_GET['grant_category']) : '';

// Check if we're on an archive page
$is_archive = is_category() || is_tag() || is_author() || is_search();

if ($is_archive) {
    // Use the main WordPress query for archive pages
    global $wp_query;
    $all_grants = $wp_query;
    $total_grants = $all_grants->found_posts;
} else {
    // Build query args for all grants (for regular grants page with manual filtering)
    $all_grants_args = array(
        'post_type' => 'grant_opportunity',
        'post_status' => 'publish',
        'posts_per_page' => -1, // Get all grants
        'orderby' => 'date',
        'order' => 'DESC'
    );

    // Add search parameter if search query exists
    if (!empty($search_query)) {
        $all_grants_args['s'] = $search_query;
    }

    // Add category filter if category is selected (for manual filtering on grants page)
    if (!empty($category_filter)) {
        // Try grant_category taxonomy first
        $grant_category_obj = get_term_by('slug', $category_filter, 'grant_category');
        if ($grant_category_obj) {
            $all_grants_args['tax_query'] = array(
                array(
                    'taxonomy' => 'grant_category',
                    'field'    => 'slug',
                    'terms'    => $category_filter,
                ),
            );
        } else {
            // Fall back to regular category if grant_category doesn't exist
            $category_obj = get_category_by_slug($category_filter);
            if ($category_obj) {
                $all_grants_args['cat'] = $category_obj->term_id;
            } else {
                $all_grants_args['category_name'] = $category_filter;
            }
        }
    }

    // Get all grants for counting and show more functionality
    $all_grants = new WP_Query($all_grants_args);
    $total_grants = $all_grants->found_posts;
}
$grants_per_load = 6; // Show 6 grants initially, then 6 more on each "Show More" click

// Get grants to actually display initially
// Use ALL grants for show more functionality on all pages
$display_query = $all_grants;
?>

<section class="grants-content" style="position: relative;">
    <div class="container">
        <?php if ($display_query->have_posts()) : ?>
            <div class="grants-posts-grid" data-posts-per-load="<?php echo $grants_per_load; ?>">
                <?php 
                $grant_count = 0;
                while ($display_query->have_posts()) : $display_query->the_post(); 
                    $grant_count++;
                    $hidden_class = ($grant_count > $grants_per_load) ? ' grants-post-hidden' : '';
                ?>
                    <div class="grants-post-item<?php echo $hidden_class; ?>">
                        <?php get_template_part('template-parts/grants/grant-card'); ?>
                    </div>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
            
            <?php if ($total_grants > $grants_per_load) : ?>
                <div class="grants-show-more">
                    <button class="grants-show-more__btn" data-total-posts="<?php echo $total_grants; ?>" data-posts-per-load="<?php echo $grants_per_load; ?>"
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
                        <span class="grants-show-more__text">Show More</span>
                        <div class="grants-show-more__loader" style="display: none;">
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
            <?php get_template_part('template-parts/grants/no-results'); ?>
        <?php endif; ?>
    </div>
    
    <!-- Bottom Border -->
    <div class="bottom-border" style="position: absolute; bottom: 0; left: -360px; width: 1920px; height: 1px; background-color: #ffffff; z-index: 3;"></div>
</section>

<?php wp_reset_postdata(); ?>
