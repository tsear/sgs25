<?php
/**
 * Template part for displaying a success story card
 * Used in the success stories grid
 */

$post_id = get_the_ID();
$organization = get_post_meta($post_id, 'organization_name', true);
$outcome = get_post_meta($post_id, 'key_outcome', true);
$grant_amount = get_post_meta($post_id, 'grant_amount', true);
?>

<article class="success-story-card">
    <div class="success-story-card__inner">
        <?php if (has_post_thumbnail()): ?>
            <div class="success-story-card__image">
                <a href="<?php the_permalink(); ?>" class="success-story-card__image-link">
                    <?php the_post_thumbnail('medium', array(
                        'class' => 'success-story-card__thumbnail',
                        'alt' => get_the_title()
                    )); ?>
                </a>
            </div>
        <?php endif; ?>

        <div class="success-story-card__content">
            <?php if (!empty($organization)): ?>
                <div class="success-story-card__organization">
                    <?php echo esc_html($organization); ?>
                </div>
            <?php endif; ?>

            <h3 class="success-story-card__title">
                <a href="<?php the_permalink(); ?>" class="success-story-card__title-link">
                    <?php the_title(); ?>
                </a>
            </h3>

            <div class="success-story-card__excerpt">
                <?php 
                $excerpt = get_the_excerpt();
                if (strlen($excerpt) > 120) {
                    $excerpt = substr($excerpt, 0, 120) . '...';
                }
                echo wp_kses_post($excerpt);
                ?>
            </div>

            <div class="success-story-card__meta">
                <?php if (!empty($grant_amount)): ?>
                    <div class="success-story-card__grant-amount">
                        <strong>Grant Amount:</strong> <?php echo esc_html($grant_amount); ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($outcome)): ?>
                    <div class="success-story-card__outcome">
                        <strong>Key Outcome:</strong> <?php echo esc_html($outcome); ?>
                    </div>
                <?php endif; ?>

                <div class="success-story-card__date">
                    <time datetime="<?php echo get_the_date('c'); ?>">
                        <?php echo get_the_date(); ?>
                    </time>
                </div>
            </div>

            <?php 
            // Get success story categories
            $categories = get_the_terms($post_id, 'success_story_category');
            if (!$categories || is_wp_error($categories)) {
                $categories = get_the_category($post_id);
            }
            ?>

            <?php if (!empty($categories)): ?>
                <div class="success-story-card__categories">
                    <?php foreach ($categories as $category): ?>
                        <span class="success-story-card__category">
                            <?php echo esc_html($category->name); ?>
                        </span>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <div class="success-story-card__footer">
                <a href="<?php the_permalink(); ?>" class="success-story-card__read-more">
                    Read Full Story
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</article>
