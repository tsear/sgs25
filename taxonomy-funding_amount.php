<?php
/**
 * Template for Funding Amount Taxonomy Archive
 * Displays grants filtered by a specific funding amount range
 */

get_header();

// Get current funding amount
$current_funding_amount = get_queried_object();

// Set up query to show current funding amount in search form
$_GET['funding_amount'] = $current_funding_amount->slug;
?>

<main class="funding-amount-archive">
    <?php get_template_part('template-parts/grants/grants-hero'); ?>
    
    <section class="funding-amount-header">
        <div class="container">
            <div class="funding-amount-info">
                <h1>Funding Amount: <?php echo esc_html($current_funding_amount->name); ?></h1>
                <?php if ($current_funding_amount->description) : ?>
                    <p class="funding-amount-description"><?php echo esc_html($current_funding_amount->description); ?></p>
                <?php endif; ?>
                <p class="funding-amount-count">
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
</main>

<?php get_footer(); ?>
