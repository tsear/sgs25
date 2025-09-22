<?php
/**
 * Template part for grants search results
 * Displays search results specifically for grant opportunities
 */

// Get search query and category filter
$search_query = get_search_query();
$category_filter = isset($_GET['grant_category']) ? sanitize_text_field($_GET['grant_category']) : '';

// Build query args for search results
$search_args = array(
    'post_type' => 'grant_opportunity',
    'post_status' => 'publish',
    'posts_per_page' => -1, // Get all search results
    'orderby' => 'relevance',
    'order' => 'DESC',
    's' => $search_query
);

// Add category filter if category is selected
if (!empty($category_filter)) {
    $search_args['tax_query'] = array(
        array(
            'taxonomy' => 'grant_category',
            'field'    => 'slug',
            'terms'    => $category_filter,
        ),
    );
}

// Get search results
$search_results = new WP_Query($search_args);

$total_posts = $search_results->found_posts;
$posts_per_load = 6; // Show 6 posts initially, then 6 more on each "Show More" click
?>

<section class="grants-content" style="position: relative;">
    <div class="container">
        <?php if ($search_results->have_posts()) : ?>
            <!-- Display search query and results count -->
            <div class="search-results-info">
                <h2>Search Results for "<?php echo esc_html($search_query); ?>"
                    <?php if (!empty($category_filter)) : ?>
                        <?php $category = get_term_by('slug', $category_filter, 'grant_category'); ?>
                        <?php if ($category) : ?>
                            in <span style="color: #d81259;"><?php echo esc_html($category->name); ?></span>
                        <?php endif; ?>
                    <?php endif; ?>
                </h2>
                <p class="search-results-count"><?php echo $total_posts; ?> result<?php echo ($total_posts !== 1) ? 's' : ''; ?> found</p>
            </div>
            
            <div class="grants-posts-grid" data-posts-per-load="<?php echo $posts_per_load; ?>">
                <?php 
                $grant_count = 0;
                while ($search_results->have_posts()) : $search_results->the_post(); 
                    $grant_count++;
                    $hidden_class = ($grant_count > $posts_per_load) ? ' grants-post-hidden' : '';
                ?>
                    <div class="grants-post-item<?php echo $hidden_class; ?>">
                        <?php get_template_part('template-parts/grants/grant-card'); ?>
                    </div>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
            
            <?php if ($total_posts > $posts_per_load) : ?>
                <div class="grants-show-more">
                    <button class="grants-show-more__btn" data-total-posts="<?php echo $total_posts; ?>" data-posts-per-load="<?php echo $posts_per_load; ?>"
                        data-archive-type="search"
                        data-search-query="<?php echo esc_attr($search_query); ?>"
                        <?php if (!empty($category_filter)) : ?>data-category-filter="<?php echo esc_attr($category_filter); ?>"<?php endif; ?>
                    >
                        Show More Grants
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path d="M12 5V19M5 12L19 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>
            <?php endif; ?>
            
        <?php else : ?>
            <!-- No results found -->
            <?php get_template_part('template-parts/grants/grants-no-results'); ?>
        <?php endif; ?>
    </div>
</section>
