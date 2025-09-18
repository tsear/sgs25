<?php
/**
 * Template part for success stories search form
 * Handles search and filtering functionality for success stories
 */

// Get current search query and category filter
$search_query = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : '';
$category_filter = isset($_GET['success_story_category']) ? sanitize_text_field($_GET['success_story_category']) : '';

// Get success story categories (assuming we have success story category taxonomy)
$story_categories = get_terms(array(
    'taxonomy' => 'success_story_category',
    'hide_empty' => true,
    'orderby' => 'name',
    'order' => 'ASC'
));

// If success_story_category taxonomy doesn't exist, fall back to regular categories
if (is_wp_error($story_categories) || empty($story_categories)) {
    $story_categories = get_categories(array(
        'hide_empty' => true,
        'orderby' => 'name', 
        'order' => 'ASC'
    ));
}
?>

<div class="success-stories-search" style="position: relative;">
    <div class="container">
        <div class="success-stories-search-form">
            <form method="get" class="success-stories-search__form" role="search">
                <div class="success-stories-search__row">
                    <!-- Search Input -->
                    <div class="success-stories-search__field success-stories-search__field--search">
                        <label for="success-stories-search-input" class="success-stories-search__label">Search Success Stories</label>
                        <div class="success-stories-search__input-wrapper">
                            <input 
                                type="search" 
                                id="success-stories-search-input"
                                name="s" 
                                value="<?php echo esc_attr($search_query); ?>" 
                                placeholder="Search success stories..." 
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
                    <div class="success-stories-search__field success-stories-search__field--category">
                        <label for="success-stories-category-select" class="success-stories-search__label">Category</label>
                        <div class="success-stories-search__select-wrapper">
                            <select name="success_story_category" id="success-stories-category-select" class="success-stories-search__select">
                                <option value="">All Categories</option>
                                <?php if (!empty($story_categories)): ?>
                                    <?php foreach ($story_categories as $category): ?>
                                        <option value="<?php echo esc_attr($category->slug); ?>" <?php selected($category_filter, $category->slug); ?>>
                                            <?php echo esc_html($category->name); ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <svg class="success-stories-search__select-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path d="M19 9L12 16L5 9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="success-stories-search__field success-stories-search__field--submit">
                        <button type="submit" class="success-stories-search__button">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path d="M21 21L16.514 16.506L21 21ZM19 10.5C19 15.194 15.194 19 10.5 19C5.806 19 2 15.194 2 10.5C2 5.806 5.806 2 10.5 2C15.194 2 19 5.806 19 10.5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Search Stories
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
    
    <!-- Bottom Border -->
    <div class="bottom-border" style="position: absolute; bottom: 0; left: 50%; width: 100vw; height: 1px; background-color: #ffffff; z-index: 3; transform: translateX(-50%);"></div>
</div>
