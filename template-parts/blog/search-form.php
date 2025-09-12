<?php
/**
 * Template part for blog search form
 * Simple search bar for filtering blog posts
 */

$search_query = isset($_GET['s']) ? get_search_query() : '';
?>

<section class="blog-search">
    <div class="container">
        <div class="blog-search__wrapper">
            <!-- Categories Filter -->
            <div class="blog-search__categories">
                <?php
                $categories = get_categories(array(
                    'orderby' => 'name',
                    'order' => 'ASC',
                    'hide_empty' => true
                ));
                
                $current_category = '';
                
                // Check if we're on a category archive page
                if (is_category()) {
                    $current_category_obj = get_queried_object();
                    $current_category = $current_category_obj->slug;
                } elseif (isset($_GET['category'])) {
                    // For manual filtering on blog page
                    $current_category = sanitize_text_field($_GET['category']);
                }
                ?>
                
                <?php if (!empty($categories)) : ?>
                    <div class="blog-search__categories-wrapper">
                        <span class="blog-search__categories-label">Filter:</span>
                        <div class="blog-search__categories-list">
                            <a href="<?php echo get_permalink(get_page_by_path('blog')); ?>" 
                               class="blog-search__category-link <?php echo empty($current_category) ? 'active' : ''; ?>">
                                All
                            </a>
                            <?php foreach ($categories as $category) : ?>
                                <a href="<?php echo get_category_link($category->term_id); ?>" 
                                   class="blog-search__category-link <?php echo ($current_category === $category->slug) ? 'active' : ''; ?>">
                                    <?php echo esc_html($category->name); ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            
            <?php if ($search_query) : ?>
                <div class="blog-search__results-info">
                    <p class="blog-search__results-text">
                        Search results for: <strong>"<?php echo esc_html(strlen($search_query) > 10 ? substr($search_query, 0, 10) . '...' : $search_query); ?>"</strong>
                    </p>
                </div>
            <?php endif; ?>
            
            <form role="search" method="get" class="blog-search__form" action="<?php echo esc_url(home_url('/')); ?>">
                <div class="blog-search__input-wrapper">
                    <svg class="blog-search__icon" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M21 21L16.514 16.506L21 21ZM19 10.5C19 15.194 15.194 19 10.5 19C5.806 19 2 15.194 2 10.5C2 5.806 5.806 2 10.5 2C15.194 2 19 5.806 19 10.5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    
                    <input 
                        type="search" 
                        class="blog-search__input" 
                        placeholder="Search articles..." 
                        value="<?php echo esc_attr($search_query); ?>" 
                        name="s"
                        aria-label="Search blog posts"
                    >
                    
                    <button type="submit" class="blog-search__submit" aria-label="Submit search">
                        <span class="blog-search__submit-text">Search</span>
                    </button>
                    
                    <?php if ($search_query) : ?>
                        <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="blog-search__clear" aria-label="Clear search">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M18 6L6 18M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    <?php endif; ?>
                </div>
                
                <!-- Hidden field to ensure we're searching posts -->
                <input type="hidden" name="post_type" value="post">
            </form>
        </div>
    </div>
</section>
