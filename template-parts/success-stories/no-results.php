<?php
/**
 * Template part for displaying no success stories found message
 */

$search_query = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : '';
$category_filter = isset($_GET['success_story_category']) ? sanitize_text_field($_GET['success_story_category']) : '';
$has_filters = !empty($search_query) || !empty($category_filter);
?>

<div class="success-stories-no-results">
    <div class="success-stories-no-results__content">
        <div class="success-stories-no-results__icon">
            <svg width="64" height="64" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="12" cy="12" r="10" stroke="#6B7280" stroke-width="2"/>
                <path d="M16 16L12 12L16 8" stroke="#6B7280" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M8 12H16" stroke="#6B7280" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>

        <h3 class="success-stories-no-results__title">
            <?php if ($has_filters): ?>
                No success stories match your search
            <?php else: ?>
                No success stories found
            <?php endif; ?>
        </h3>

        <p class="success-stories-no-results__description">
            <?php if ($has_filters): ?>
                We couldn't find any success stories matching your current filters. Try adjusting your search terms or clearing your filters to see more results.
            <?php else: ?>
                There are currently no success stories available. Please check back later for inspiring stories from our community.
            <?php endif; ?>
        </p>

        <div class="success-stories-no-results__actions">
            <?php if ($has_filters): ?>
                <a href="<?php echo esc_url(remove_query_arg(array('s', 'success_story_category'))); ?>" class="success-stories-no-results__clear-button">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 6L6 18M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Clear all filters
                </a>
            <?php endif; ?>

            <a href="<?php echo esc_url(home_url('/grants')); ?>" class="success-stories-no-results__browse-button">
                Browse Grant Opportunities
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
        </div>

        <?php if ($has_filters): ?>
            <div class="success-stories-no-results__suggestions">
                <h4 class="success-stories-no-results__suggestions-title">Search suggestions:</h4>
                <ul class="success-stories-no-results__suggestions-list">
                    <li>Try using broader search terms</li>
                    <li>Check your spelling</li>
                    <li>Remove category filters</li>
                    <li>Use different keywords related to your organization type</li>
                </ul>
            </div>
        <?php endif; ?>
    </div>
</div>
