<?php
/**
 * Template part for testimonials search form
 * Handles search and filtering functionality for testimonials
 */

// Get current search and filter values
$search_query = get_query_var('s', '');
$category_filter = get_query_var('success_story_category', '');

// Get testimonial categories for filtering
$story_categories = get_terms(array(
    'taxonomy' => 'success_story_category',
    'hide_empty' => true,
    'orderby' => 'name',
    'order' => 'ASC'
));

// Handle case where get_terms returns WP_Error
if (is_wp_error($story_categories)) {
    $story_categories = array();
}
?>

<div class="success-stories-search" style="position: relative; padding-bottom: 20px;">
    <div class="container">
        <div class="success-stories-search-form">
            <form method="get" class="success-stories-search__form" role="search">
                <!-- Hidden field to specify post type for search -->
                <input type="hidden" name="post_type" value="success_story">
                
                <div class="success-stories-search__row">
                    <!-- Search Input -->
                    <div class="success-stories-search__field success-stories-search__field--search">
                        <label for="success-stories-search-input" class="success-stories-search__label">Search Testimonials</label>
                        <div class="success-stories-search__input-wrapper">
                            <input 
                                type="search" 
                                id="success-stories-search-input"
                                name="s" 
                                value="<?php echo esc_attr($search_query); ?>" 
                                placeholder="Search testimonials..." 
                                class="success-stories-search__input"
                                autocomplete="off"
                            >
                            <button type="submit" class="success-stories-search__submit">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path d="M21 21L16.514 16.506L21 21ZM19 10.5C19 15.194 15.194 19 10.5 19C5.806 19 2 15.194 2 10.5C2 5.806 5.806 2 10.5 2C15.194 2 19 5.806 19 10.5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <span class="sr-only">Search</span>
                            </button>
                        </div>
                    </div>

                    <!-- Category Filter -->
                    <?php if (!empty($story_categories)) : ?>
                        <div class="success-stories-search__field success-stories-search__field--category">
                            <label for="success-stories-category-select" class="success-stories-search__label">Filter by Category</label>
                            <div class="success-stories-search__select-wrapper">
                                <select name="success_story_category" id="success-stories-category-select" class="success-stories-search__select">
                                    <option value="">All Categories</option>
                                    <?php foreach ($story_categories as $category) : ?>
                                        <option value="<?php echo esc_attr($category->slug); ?>" <?php selected($category_filter, $category->slug); ?>>
                                            <?php echo esc_html($category->name); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <svg width="12" height="8" viewBox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg" class="success-stories-search__select-arrow" aria-hidden="true">
                                    <path d="M1 1.5L6 6.5L11 1.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Submit Button -->
                    <div class="success-stories-search__field success-stories-search__field--button">
                        <button type="submit" class="success-stories-search__button">
                            Apply Filters
                        </button>
                    </div>
                </div>

                <!-- Clear Filters -->
                <?php if (!empty($search_query) || !empty($category_filter)): ?>
                    <div class="success-stories-search__clear">
                        <a href="<?php echo esc_url(remove_query_arg(array('s', 'success_story_category'))); ?>" class="success-stories-search__clear-link">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path d="M18 6L6 18M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Clear all filters
                        </a>
                    </div>
                <?php endif; ?>
            </form>
        </div>
    </div>
    
    <!-- Bottom border handled by .success-stories-search::after in CSS -->
</div>
