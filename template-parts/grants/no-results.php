<?php
/**
 * Template part for displaying no search results or no grants
 */

$search_query = get_search_query();
$category_filter = isset($_GET['grant_category']) ? sanitize_text_field($_GET['grant_category']) : '';
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
            
            <h2 class="no-results__title">No grants found</h2>
            
            <p class="no-results__message">
                <?php if (!empty($search_query) && !empty($category_filter)) : ?>
                    Sorry, we couldn't find any grants matching <strong>"<?php echo esc_html($search_query); ?>"</strong> in the <strong><?php echo esc_html($category_filter); ?></strong> category.
                <?php elseif (!empty($search_query)) : ?>
                    Sorry, we couldn't find any grants matching <strong>"<?php echo esc_html($search_query); ?>"</strong>.
                <?php elseif (!empty($category_filter)) : ?>
                    Sorry, we couldn't find any grants in the <strong><?php echo esc_html($category_filter); ?></strong> category.
                <?php endif; ?>
            </p>
            
            <div class="no-results__suggestions">
                <h3 class="no-results__suggestions-title">Try these suggestions:</h3>
                <ul class="no-results__suggestions-list">
                    <li>Check your spelling</li>
                    <li>Use more general keywords</li>
                    <li>Try different search terms</li>
                    <li>Browse all grants below</li>
                </ul>
            </div>
            
            <div class="no-results__actions">
                <?php 
                $grants_page_id = get_page_by_path('grants');
                $grants_url = $grants_page_id ? get_permalink($grants_page_id) : home_url('/grants/');
                ?>
                <a href="<?php echo esc_url($grants_url); ?>" class="no-results__button">
                    View All Grants
                </a>
            </div>
            
        <?php else : ?>
            <div class="no-results__icon">
                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2L3.09 8.26L12 14L20.91 8.26L12 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M3.09 15.74L12 22L20.91 15.74" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M3.09 8.26L12 14.52L20.91 8.26" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            
            <h2 class="no-results__title">No grant opportunities yet</h2>
            
            <p class="no-results__message">
                We haven't published any grant opportunities yet, but we're working on connecting you with funding sources!
            </p>
            
            <div class="no-results__actions">
                <a href="<?php echo esc_url(home_url()); ?>" class="no-results__button">
                    Back to Home
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>
