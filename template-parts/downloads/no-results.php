<?php
/**
 * Template part for displaying no search results or no downloads
 */

$search_query = get_search_query();
$category_filter = isset($_GET['download_category']) ? sanitize_text_field($_GET['download_category']) : '';
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
            
            <h2 class="no-results__title">No downloads found</h2>
            
            <p class="no-results__message">
                <?php if (!empty($search_query) && !empty($category_filter)) : ?>
                    Sorry, we couldn't find any downloads matching <strong>"<?php echo esc_html($search_query); ?>"</strong> in the <strong><?php echo esc_html($category_filter); ?></strong> category.
                <?php elseif (!empty($search_query)) : ?>
                    Sorry, we couldn't find any downloads matching <strong>"<?php echo esc_html($search_query); ?>"</strong>.
                <?php elseif (!empty($category_filter)) : ?>
                    Sorry, we couldn't find any downloads in the <strong><?php echo esc_html($category_filter); ?></strong> category.
                <?php endif; ?>
            </p>
            
            <div class="no-results__actions">
                <a href="<?php echo esc_url(remove_query_arg(array('s', 'download_category'))); ?>" class="no-results__reset-btn">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 6L6 18M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Clear filters and view all downloads
                </a>
            </div>
        <?php else : ?>
            <div class="no-results__icon">
                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19 9h-4V3H9v6H5l7 7 7-7zM5 18v2h14v-2H5z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            
            <h2 class="no-results__title">No downloads available yet</h2>
            
            <p class="no-results__message">
                We're working on adding valuable resources for you to download. Check back soon for helpful guides, templates, and tools.
            </p>
            
            <div class="no-results__actions">
                <a href="<?php echo home_url('/contact'); ?>" class="no-results__contact-btn">
                    Contact us to request specific resources
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>