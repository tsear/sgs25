<?php
/**
 * Template for Grant Category Taxonomy Archive
 * Displays grants filtered by a specific grant category
 */

get_header();

// Get current category
$current_category = get_queried_object();

// Set up query to show current category in search form
$_GET['grant_category'] = $current_category->slug;
?>

<main class="grant-category-archive">
    <?php get_template_part('template-parts/grants/grants-hero'); ?>
    
    <section class="category-header">
        <div class="container">
            <div class="category-info">
                <h1>Grant Category: <?php echo esc_html($current_category->name); ?></h1>
                <?php if ($current_category->description) : ?>
                    <p class="category-description"><?php echo esc_html($current_category->description); ?></p>
                <?php endif; ?>
                <p class="category-count">
                    <?php 
                    printf(
                        _n(
                            '%s grant opportunity found',
                            '%s grant opportunities found',
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
    
    <?php get_template_part('template-parts/grants/grants-search-form'); ?>
    <?php get_template_part('template-parts/grants/grants-grid'); ?>

    <?php get_template_part('template-parts/newsletter-signup'); ?>
</main>

<?php get_footer(); ?>
