<?php
/**
 * Template part for success stories grid
 * Displays success stories with pagination and filtering
 */

// Get current query parameters
$search_query = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : '';
$category_filter = isset($_GET['success_story_category']) ? sanitize_text_field($_GET['success_story_category']) : '';
$posts_per_page = 6;
$paged = get_query_var('paged') ? get_query_var('paged') : 1;

// Build query arguments for success stories
$stories_args = array(
    'post_type' => 'success_story',
    'posts_per_page' => $posts_per_page,
    'paged' => $paged,
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC'
);

// Add search query if provided
if (!empty($search_query)) {
    $stories_args['s'] = $search_query;
}

// Add category filter if provided
if (!empty($category_filter)) {
    // Check if success_story_category taxonomy exists
    if (taxonomy_exists('success_story_category')) {
        $stories_args['tax_query'] = array(
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
            $stories_args['cat'] = $category_obj->term_id;
        } else {
            $stories_args['category_name'] = $category_filter;
        }
    }
}

// Get success stories
$stories_query = new WP_Query($stories_args);

// For show more functionality, get all stories matching current filters
$total_stories = 0;
if ($stories_query->have_posts()) {
    // Build args for counting all stories
    $all_stories_args = $stories_args;
    $all_stories_args['posts_per_page'] = -1;
    unset($all_stories_args['paged']);

    // Get all stories for counting and show more functionality
    $all_stories = new WP_Query($all_stories_args);
    $total_stories = $all_stories->found_posts;
}
?>

<div class="success-stories-grid" style="position: relative;">
    <div class="container">
        <?php if ($stories_query->have_posts()): ?>
            <div class="success-stories-grid__results">
                <div class="success-stories-grid__count">
                    <span class="success-stories-grid__count-text">
                        <?php 
                        printf(
                            _n(
                                '%s success story found',
                                '%s success stories found',
                                $total_stories,
                                'textdomain'
                            ),
                            number_format_i18n($total_stories)
                        );
                        ?>
                    </span>
                </div>

                <div class="success-stories-grid__container">
                    <?php while ($stories_query->have_posts()): ?>
                        <?php $stories_query->the_post(); ?>
                        <?php get_template_part('template-parts/success-stories/success-story-card'); ?>
                    <?php endwhile; ?>
                </div>

                <?php if ($stories_query->max_num_pages > 1): ?>
                    <div class="success-stories-grid__pagination">
                        <div class="success-stories-grid__pagination-info">
                            <span>
                                <?php 
                                $showing_from = (($paged - 1) * $posts_per_page) + 1;
                                $showing_to = min($paged * $posts_per_page, $total_stories);
                                printf(
                                    'Showing %d - %d of %d success stories',
                                    $showing_from,
                                    $showing_to,
                                    $total_stories
                                );
                                ?>
                            </span>
                        </div>

                        <div class="success-stories-grid__pagination-nav">
                            <?php
                            echo paginate_links(array(
                                'total' => $stories_query->max_num_pages,
                                'current' => $paged,
                                'prev_text' => '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg> Previous',
                                'next_text' => 'Next <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
                                'type' => 'list',
                                'end_size' => 1,
                                'mid_size' => 2,
                            ));
                            ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <?php get_template_part('template-parts/success-stories/no-results'); ?>
        <?php endif; ?>
    </div>
    
    <!-- Bottom border handled by .success-stories-grid::after in CSS -->
</div>

<?php wp_reset_postdata(); ?>
