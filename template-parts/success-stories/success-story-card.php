<?php
/**
 * Template part for displaying success story cards
 * Used in success stories archive and search results
 */

// Get success story-specific meta fields
$organization = get_post_meta(get_the_ID(), 'organization_name', true);
$outcome = get_post_meta(get_the_ID(), 'key_outcome', true);
$grant_amount = get_post_meta(get_the_ID(), 'grant_amount', true);
?>

<article class="success-story-card">
    <a href="<?php the_permalink(); ?>" class="success-story-card__link">
        <?php if (has_post_thumbnail()) : ?>
            <div class="success-story-card__image">
                <?php the_post_thumbnail('medium', array('alt' => get_the_title())); ?>
            </div>
        <?php endif; ?>
        
        <div class="success-story-card__content">
            <div class="success-story-card__meta">
                <span class="success-story-card__date">
                    <?php echo get_the_date('l, F j'); ?>
                </span>
                
                <?php if ($grant_amount) : ?>
                    <span class="success-story-card__amount">
                        <?php echo esc_html($grant_amount); ?>
                    </span>
                <?php endif; ?>
            </div>
            
            <h3 class="success-story-card__title">
                <?php the_title(); ?>
            </h3>
            
            <?php if ($organization) : ?>
                <div class="success-story-card__organization">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path d="M17 21V19C17 17.9391 16.5786 16.9217 15.8284 16.1716C15.0783 15.4214 14.0609 15 13 15H5C3.93913 15 2.92172 15.4214 2.17157 16.1716C1.42143 16.9217 1 17.9391 1 19V21M13 7C13 9.20914 11.2091 11 9 11C6.79086 11 5 9.20914 5 7C5 4.79086 6.79086 3 9 3C11.2091 3 13 4.79086 13 7ZM23 21V19C22.9993 18.1137 22.7044 17.2528 22.1614 16.5523C21.6184 15.8519 20.8581 15.3516 20 15.13M16 3.13C16.8604 3.35031 17.623 3.85071 18.1676 4.55232C18.7122 5.25392 19.0078 6.11683 19.0078 7.005C19.0078 7.89317 18.7122 8.75608 18.1676 9.45768C17.623 10.1593 16.8604 10.6597 16 10.88" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <?php echo esc_html($organization); ?>
                </div>
            <?php endif; ?>
            
            <div class="success-story-card__excerpt">
                <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
            </div>
            
            <?php 
            // Get success story categories
            $story_terms = get_the_terms(get_the_ID(), 'success_story_category');
            if (!$story_terms || is_wp_error($story_terms)) {
                $story_terms = get_the_category();
            }
            
            if ($story_terms && !is_wp_error($story_terms)) : ?>
                <div class="success-story-card__categories">
                    <?php foreach ($story_terms as $term) : ?>
                        <span class="success-story-card__category">
                            <?php echo esc_html($term->name); ?>
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
    </a>
</article>
