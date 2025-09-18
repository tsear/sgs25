<?php
/**
 * Template part for displaying grant opportunity cards
 * Used in grants archive and search results
 */

// Get grant-specific meta fields (customize these based on your grant_opportunity post type)
$deadline = get_post_meta(get_the_ID(), 'grant_deadline', true);
$amount = get_post_meta(get_the_ID(), 'grant_amount', true);
$organization = get_post_meta(get_the_ID(), 'grant_organization', true);
?>

<article class="grant-card">
    <a href="<?php the_permalink(); ?>" class="grant-card__link">
        <?php if (has_post_thumbnail()) : ?>
            <div class="grant-card__image">
                <?php the_post_thumbnail('medium', array('alt' => get_the_title())); ?>
            </div>
        <?php endif; ?>
        
        <div class="grant-card__content">
            <div class="grant-card__meta">
                <?php if ($deadline) : ?>
                    <span class="grant-card__deadline">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path d="M8 2V6M16 2V6M3 10H21M5 4H19C20.1046 4 21 4.89543 21 6V20C21 21.1046 20.1046 22 19 22H5C3.89543 22 3 21.1046 3 20V6C3 4.89543 3.89543 4 5 4Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Deadline: <?php echo esc_html(date('M j, Y', strtotime($deadline))); ?>
                    </span>
                <?php else : ?>
                    <span class="grant-card__date">
                        <?php echo get_the_date('l, F j'); ?>
                    </span>
                <?php endif; ?>
                
                <?php if ($amount) : ?>
                    <span class="grant-card__amount">
                        <?php echo esc_html($amount); ?>
                    </span>
                <?php endif; ?>
            </div>
            
            <h3 class="grant-card__title">
                <?php the_title(); ?>
            </h3>
            
            <?php if ($organization) : ?>
                <div class="grant-card__organization">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path d="M17 21V19C17 17.9391 16.5786 16.9217 15.8284 16.1716C15.0783 15.4214 14.0609 15 13 15H5C3.93913 15 2.92172 15.4214 2.17157 16.1716C1.42143 16.9217 1 17.9391 1 19V21M13 7C13 9.20914 11.2091 11 9 11C6.79086 11 5 9.20914 5 7C5 4.79086 6.79086 3 9 3C11.2091 3 13 4.79086 13 7ZM23 21V19C22.9993 18.1137 22.7044 17.2528 22.1614 16.5523C21.6184 15.8519 20.8581 15.3516 20 15.13M16 3.13C16.8604 3.35031 17.623 3.85071 18.1676 4.55232C18.7122 5.25392 19.0078 6.11683 19.0078 7.005C19.0078 7.89317 18.7122 8.75608 18.1676 9.45768C17.623 10.1593 16.8604 10.6597 16 10.88" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <?php echo esc_html($organization); ?>
                </div>
            <?php endif; ?>
            
            <div class="grant-card__excerpt">
                <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
            </div>
            
            <?php 
            // Get grant categories
            $grant_terms = get_the_terms(get_the_ID(), 'grant_category');
            if (!$grant_terms || is_wp_error($grant_terms)) {
                $grant_terms = get_the_category();
            }
            
            if ($grant_terms && !is_wp_error($grant_terms)) : ?>
                <div class="grant-card__categories">
                    <?php foreach ($grant_terms as $term) : ?>
                        <span class="grant-card__category">
                            <?php echo esc_html($term->name); ?>
                        </span>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </a>
</article>
