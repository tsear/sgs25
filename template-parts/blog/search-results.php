<?php
/**
 * Template part for blog search results
 * Displays search results specifically for blog posts
 */

// Get search query and category filter
$search_query = get_search_query();
$category_filter = isset($_GET['category']) ? sanitize_text_field($_GET['category']) : '';

// Build query args for search results
$search_args = array(
    'post_type' => 'post',
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
            'taxonomy' => 'category',
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

<section class="blog-content" style="position: relative;">
    <div class="container">
        <?php if ($search_results->have_posts()) : ?>
            <!-- Display search query and results count -->
            <div class="search-results-info">
                <h2>Search Results for "<?php echo esc_html($search_query); ?>"
                    <?php if (!empty($category_filter)) : ?>
                        <?php $category = get_term_by('slug', $category_filter, 'category'); ?>
                        <?php if ($category) : ?>
                            in <span style="color: #fcaf3d;"><?php echo esc_html($category->name); ?></span>
                        <?php endif; ?>
                    <?php endif; ?>
                </h2>
                <p class="search-results-count"><?php echo $total_posts; ?> result<?php echo ($total_posts !== 1) ? 's' : ''; ?> found</p>
            </div>
            
            <div class="blog-posts-grid" data-posts-per-load="<?php echo $posts_per_load; ?>">
                <?php 
                $post_count = 0;
                while ($search_results->have_posts()) : $search_results->the_post(); 
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
</section>

<?php wp_reset_postdata(); ?>