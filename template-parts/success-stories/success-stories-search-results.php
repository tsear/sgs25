<?php
/**
 * Template part for success stories search results
 * Displays search results specifically for success stories
 */

// Get search query and category filter
$search_query = get_search_query();
$category_filter = isset($_GET['success_story_category']) ? sanitize_text_field($_GET['success_story_category']) : '';

// Build query args for search results
$search_args = array(
    'post_type' => 'success_story',
    'post_status' => 'publish',
    'posts_per_page' => -1, // Get all search results
    'orderby' => 'relevance',
    'order' => 'DESC',
    's' => $search_query
);

// Add category filter if category is selected
if (!empty($category_filter)) {
    // Check if success_story_category taxonomy exists
    if (taxonomy_exists('success_story_category')) {
        $search_args['tax_query'] = array(
            array(
                'taxonomy' => 'success_story_category',
                'field'    => 'slug',
                'terms'    => $category_filter,
            ),
        );
    } else {
        // Fall back to regular category if success_story_category doesn't exist
        $category_obj = get_category_by_slug($category_filter);
        if ($category_obj) {
            $search_args['cat'] = $category_obj->term_id;
        } else {
            $search_args['category_name'] = $category_filter;
        }
    }
}

// Get search results
$search_results = new WP_Query($search_args);

$total_posts = $search_results->found_posts;
$posts_per_load = 6; // Show 6 posts initially, then 6 more on each "Show More" click
?>

<div class="success-stories-grid" style="position: relative;">
    <div class="container">
        <?php if ($search_results->have_posts()) : ?>
            <!-- Display search query and results count -->
            <div class="search-results-info">
                <h2>Search Results for "<?php echo esc_html($search_query); ?>"
                    <?php if (!empty($category_filter)) : ?>
                        <?php 
                        if (taxonomy_exists('success_story_category')) {
                            $category = get_term_by('slug', $category_filter, 'success_story_category');
                        } else {
                            $category = get_category_by_slug($category_filter);
                        }
                        ?>
                        <?php if ($category) : ?>
                            in <span style="color: #d81259;"><?php echo esc_html($category->name); ?></span>
                        <?php endif; ?>
                    <?php endif; ?>
                </h2>
                <p class="search-results-count"><?php echo $total_posts; ?> result<?php echo ($total_posts !== 1) ? 's' : ''; ?> found</p>
            </div>
            
            <div class="success-stories-grid__results">
                <div class="success-stories-grid__container" data-posts-per-load="<?php echo $posts_per_load; ?>">
                    <?php 
                    $story_count = 0;
                    while ($search_results->have_posts()) : $search_results->the_post(); 
                        $story_count++;
                        $hidden_class = ($story_count > $posts_per_load) ? ' story-post-hidden' : '';
                    ?>
                        <div class="success-story-item<?php echo $hidden_class; ?>">
                            <?php get_template_part('template-parts/success-stories/success-story-card'); ?>
                        </div>
                    <?php endwhile; wp_reset_postdata(); ?>
                </div>
                
                <?php if ($total_posts > $posts_per_load) : ?>
                    <div class="success-stories-show-more">
                        <button class="success-stories-show-more__btn" data-total-posts="<?php echo $total_posts; ?>" data-posts-per-load="<?php echo $posts_per_load; ?>"
                            data-archive-type="search"
                            data-search-query="<?php echo esc_attr($search_query); ?>"
                            <?php if (!empty($category_filter)) : ?>data-category-filter="<?php echo esc_attr($category_filter); ?>"<?php endif; ?>
                        >
                            Show More Stories
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path d="M12 5V19M5 12L19 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </div>
                <?php endif; ?>
            </div>
            
        <?php else : ?>
            <!-- No results found -->
            <?php get_template_part('template-parts/success-stories/success-stories-no-results'); ?>
        <?php endif; ?>
    </div>
</div>
