<?php
/**
 * Template part for blog search form
 * Handles search and filtering functionality for blog posts
 */

// Get current search query and category filter
$search_query = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : '';
$category_filter = isset($_GET['category']) ? sanitize_text_field($_GET['category']) : '';

// Get blog categories
$blog_categories = get_categories(array(
    'hide_empty' => true,
    'orderby' => 'name',
    'order' => 'ASC'
));
?>

<div class="blog-search" style="position: relative;">
    <div class="container">
        <div class="blog-search-form">
            <form method="get" class="blog-search__form" role="search">
                <!-- Hidden field to specify post type for search -->
                <input type="hidden" name="post_type" value="post">
                
                <div class="blog-search__row">
                    <!-- Search Input -->
                    <div class="blog-search__field blog-search__field--search">
                        <label for="blog-search-input" class="blog-search__label">Search Blog</label>
                        <div class="blog-search__input-wrapper">
                            <input 
                                type="search" 
                                id="blog-search-input"
                                name="s" 
                                value="<?php echo esc_attr($search_query); ?>" 
                                placeholder="Search articles..." 
                                class="blog-search__input"
                                autocomplete="off"
                            >
                            <button type="submit" class="blog-search__submit">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path d="M21 21L16.514 16.506L21 21ZM19 10.5C19 15.194 15.194 19 10.5 19C5.806 19 2 15.194 2 10.5C2 5.806 5.806 2 10.5 2C15.194 2 19 5.806 19 10.5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <span class="sr-only">Search</span>
                            </button>
                        </div>
                    </div>

                    <!-- Category Filter -->
                    <?php if (!empty($blog_categories)) : ?>
                        <div class="blog-search__field blog-search__field--category">
                            <label for="blog-category-select" class="blog-search__label">Filter by Category</label>
                            <div class="blog-search__select-wrapper">
                                <select name="category" id="blog-category-select" class="blog-search__select">
                                    <option value="">All Categories</option>
                                    <?php foreach ($blog_categories as $category) : ?>
                                        <option value="<?php echo esc_attr($category->slug); ?>" <?php selected($category_filter, $category->slug); ?>>
                                            <?php echo esc_html($category->name); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <svg width="12" height="8" viewBox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg" class="blog-search__select-arrow" aria-hidden="true">
                                    <path d="M1 1.5L6 6.5L11 1.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Submit Button -->
                    <div class="blog-search__field blog-search__field--button">
                        <button type="submit" class="blog-search__button">
                            Apply Filters
                        </button>
                    </div>
                </div>

                <!-- Clear Filters -->
                <?php if (!empty($search_query) || !empty($category_filter)) : ?>
                    <div class="blog-search__clear">
                        <a href="<?php echo esc_url(remove_query_arg(array('s', 'category'))); ?>" class="blog-search__clear-link">
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
