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
            <div class="blog-search__label">
                <span class="blog-search__label-text">Find articles:</span>
            </div>
            
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
            
            <?php if ($search_query) : ?>
                <div class="blog-search__results-info">
                    <p class="blog-search__results-text">
                        Search results for: <strong>"<?php echo esc_html($search_query); ?>"</strong>
                    </p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
