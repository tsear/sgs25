<?php
/**
 * Template part for downloads search form
 * Handles search and filtering functionality for downloads
 */

// Get current search query and category filter
$search_query = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : '';
$category_filter = isset($_GET['download_category']) ? sanitize_text_field($_GET['download_category']) : '';

// Get download categories
$download_categories = get_terms(array(
    'taxonomy' => 'download_category',
    'hide_empty' => true,
    'orderby' => 'name',
    'order' => 'ASC'
));

// If download_category taxonomy doesn't exist, fall back to regular categories
if (is_wp_error($download_categories) || empty($download_categories)) {
    $download_categories = get_categories(array(
        'hide_empty' => true,
        'orderby' => 'name', 
        'order' => 'ASC'
    ));
}
?>

<div class="downloads-search" style="position: relative; padding-bottom: 20px;">
    <div class="container">
        <div class="downloads-search-form">
            <form method="get" class="downloads-search__form" role="search">
                <!-- Hidden field to specify post type for search -->
                <input type="hidden" name="post_type" value="downloadable_content">
                
                <div class="downloads-search__row">
                    <!-- Search Input -->
                    <div class="downloads-search__field downloads-search__field--search">
                        <label for="downloads-search-input" class="downloads-search__label">Search Downloads</label>
                        <div class="downloads-search__input-wrapper">
                            <input 
                                type="search" 
                                id="downloads-search-input"
                                name="s" 
                                value="<?php echo esc_attr($search_query); ?>" 
                                placeholder="Search for downloads..." 
                                class="downloads-search__input"
                                autocomplete="off"
                            >
                            <button type="submit" class="downloads-search__submit">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path d="M21 21L16.514 16.506L21 21ZM19 10.5C19 15.194 15.194 19 10.5 19C5.806 19 2 15.194 2 10.5C2 5.806 5.806 2 10.5 2C15.194 2 19 5.806 19 10.5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <span class="sr-only">Search</span>
                            </button>
                        </div>
                    </div>

                    <!-- Category Filter -->
                    <?php if (!empty($download_categories)) : ?>
                        <div class="downloads-search__field downloads-search__field--category">
                            <label for="downloads-category-select" class="downloads-search__label">Filter by Category</label>
                            <div class="downloads-search__select-wrapper">
                                <select name="download_category" id="downloads-category-select" class="downloads-search__select">
                                    <option value="">All Categories</option>
                                    <?php foreach ($download_categories as $category) : ?>
                                        <option value="<?php echo esc_attr($category->slug); ?>" <?php selected($category_filter, $category->slug); ?>>
                                            <?php echo esc_html($category->name); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <svg width="12" height="8" viewBox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg" class="downloads-search__select-arrow" aria-hidden="true">
                                    <path d="M1 1.5L6 6.5L11 1.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Submit Button -->
                    <div class="downloads-search__field downloads-search__field--button">
                        <button type="submit" class="downloads-search__button">
                            Apply Filters
                        </button>
                    </div>
                </div>

                <!-- Clear Filters -->
                <?php if (!empty($search_query) || !empty($category_filter)) : ?>
                    <div class="downloads-search__clear">
                        <a href="<?php echo esc_url(remove_query_arg(array('s', 'download_category'))); ?>" class="downloads-search__clear-link">
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
    
    <!-- Bottom border handled by .downloads-search::after in CSS -->
</div>