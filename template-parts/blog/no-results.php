<?php
/**
 * Template part for displaying no search results or no posts
 */

$search_query = get_search_query();
$category_filter = isset($_GET['category']) ? sanitize_text_field($_GET['category']) : '';
$is_search = !empty($search_query) || !empty($category_filter);
?>

<div class="no-results">
    <div class="no-results__content">
        <?php if ($is_search) : ?>
            <div class="no-results__icon">
                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M21 21L16.514 16.506L21 21ZM19 10.5C19 15.194 15.194 19 10.5 19C5.806 19 2 15.194 2 10.5C2 5.806 5.806 2 10.5 2C15.194 2 19 5.806 19 10.5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M8 8L13 13M13 8L8 13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            
            <h2 class="no-results__title">No articles found</h2>
            
            <p class="no-results__message">
                <?php if (!empty($search_query) && !empty($category_filter)) : ?>
                    Sorry, we couldn't find any articles matching <strong>"<?php echo esc_html($search_query); ?>"</strong> in the <strong><?php echo esc_html($category_filter); ?></strong> category.
                <?php elseif (!empty($search_query)) : ?>
                    Sorry, we couldn't find any articles matching <strong>"<?php echo esc_html($search_query); ?>"</strong>.
                <?php elseif (!empty($category_filter)) : ?>
                    Sorry, we couldn't find any articles in the <strong><?php echo esc_html($category_filter); ?></strong> category.
                <?php endif; ?>
            </p>
            
            <div class="no-results__suggestions">
                <h3 class="no-results__suggestions-title">Try these suggestions:</h3>
                <ul class="no-results__suggestions-list">
                    <li>Check your spelling</li>
                    <li>Use more general keywords</li>
                    <li>Try different search terms</li>
                    <li>Browse all articles below</li>
                </ul>
            </div>
            
            <div class="no-results__actions">
                <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="no-results__button">
                    View All Articles
                </a>
            </div>
            
        <?php else : ?>
            <div class="no-results__icon">
                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M14 2V8H20" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M16 13H8M16 17H8M10 9H8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            
            <h2 class="no-results__title">No articles yet</h2>
            
            <p class="no-results__message">
                We haven't published any articles yet, but we're working on great content for you!
            </p>
            
            <div class="no-results__actions">
                <a href="<?php echo esc_url(home_url()); ?>" class="no-results__button">
                    Back to Home
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>
