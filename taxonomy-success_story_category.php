<?php
/**
 * Template for Success Story Category Taxonomy Archive
 * Displays success stories filtered by a specific category
 */

get_header();

// Get current category
$current_category = get_queried_object();

// Set up query to show current category in search form
$_GET['success_story_category'] = $current_category->slug;
?>

<main class="success-story-category-archive">
    <?php get_template_part('template-parts/success-stories/success-stories-hero'); ?>
    
    <section class="category-header">
        <div class="container">
            <div class="category-info">
                <h1>Story Category: <?php echo esc_html($current_category->name); ?></h1>
                <?php if ($current_category->description) : ?>
                    <p class="category-description"><?php echo esc_html($current_category->description); ?></p>
                <?php endif; ?>
                <p class="category-count">
                    <?php 
                    printf(
                        _n(
                            '%s success story found',
                            '%s success stories found',
                            $wp_query->found_posts,
                            'sgs'
                        ),
                        number_format_i18n($wp_query->found_posts)
                    );
                    ?>
                </p>
            </div>
        </div>
    </section>
    
    <?php get_template_part('template-parts/success-stories/success-stories-search-form'); ?>
    <?php get_template_part('template-parts/success-stories/success-stories-grid'); ?>
</main>

<?php get_footer(); ?>
