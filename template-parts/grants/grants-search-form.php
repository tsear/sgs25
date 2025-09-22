<?php
/**
 * Template part for grants search form
 * Handles search and filtering functionality for grants
 */

// Get current search query and category filter
$search_query = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : '';
$category_filter = isset($_GET['grant_category']) ? sanitize_text_field($_GET['grant_category']) : '';

// Get grant categories (assuming we have grant category taxonomy)
$grant_categories = get_terms(array(
    'taxonomy' => 'grant_category',
    'hide_empty' => true,
    'orderby' => 'name',
    'order' => 'ASC'
));

// If grant_category taxonomy doesn't exist, fall back to regular categories
if (is_wp_error($grant_categories) || empty($grant_categories)) {
    $grant_categories = get_categories(array(
        'hide_empty' => true,
        'orderby' => 'name', 
        'order' => 'ASC'
    ));
}
?>

<div class="grants-search" style="position: relative;">
    <div class="container">
        <div class="grants-search-form">
            <form method="get" class="grants-search__form" role="search">
                <!-- Hidden field to specify post type for search -->
                <input type="hidden" name="post_type" value="grant_opportunity">
                
                <div class="grants-search__row">
                    <!-- Search Input -->
                    <div class="grants-search__field grants-search__field--search">
                        <label for="grants-search-input" class="grants-search__label">Search Grants</label>
                        <div class="grants-search__input-wrapper">
                            <input 
                                type="search" 
                                id="grants-search-input"
                                name="s" 
                                value="<?php echo esc_attr($search_query); ?>" 
                                placeholder="Search for grant opportunities..." 
                                class="grants-search__input"
                                autocomplete="off"
                            >
                            <button type="submit" class="grants-search__submit">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path d="M21 21L16.514 16.506L21 21ZM19 10.5C19 15.194 15.194 19 10.5 19C5.806 19 2 15.194 2 10.5C2 5.806 5.806 2 10.5 2C15.194 2 19 5.806 19 10.5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <span class="sr-only">Search</span>
                            </button>
                        </div>
                    </div>

                    <!-- Category Filter -->
                    <?php if (!empty($grant_categories)) : ?>
                        <div class="grants-search__field grants-search__field--category">
                            <label for="grants-category-select" class="grants-search__label">Filter by Category</label>
                            <div class="grants-search__select-wrapper">
                                <select name="grant_category" id="grants-category-select" class="grants-search__select">
                                    <option value="">All Categories</option>
                                    <?php foreach ($grant_categories as $category) : ?>
                                        <option value="<?php echo esc_attr($category->slug); ?>" <?php selected($category_filter, $category->slug); ?>>
                                            <?php echo esc_html($category->name); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <svg width="12" height="8" viewBox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg" class="grants-search__select-arrow" aria-hidden="true">
                                    <path d="M1 1.5L6 6.5L11 1.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Submit Button -->
                    <div class="grants-search__field grants-search__field--button">
                        <button type="submit" class="grants-search__button">
                            Apply Filters
                        </button>
                    </div>
                </div>

                <!-- Clear Filters -->
                <?php if (!empty($search_query) || !empty($category_filter)) : ?>
                    <div class="grants-search__clear">
                        <a href="<?php echo esc_url(remove_query_arg(array('s', 'grant_category'))); ?>" class="grants-search__clear-link">
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
