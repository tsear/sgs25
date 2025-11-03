<?php
/**
 * Template part for displaying blog post cards
 * Used in blog archive and search results
 */

// Get blog-specific meta fields
$author = get_the_author();
?>

<article class="post-card">
    <a href="<?php the_permalink(); ?>" class="post-card__link">
        <?php if (has_post_thumbnail()) : ?>
            <div class="post-card__image">
                <?php the_post_thumbnail('medium', array('alt' => get_the_title())); ?>
            </div>
        <?php endif; ?>
        
        <div class="post-card__content">
            <div class="post-card__meta">
                <span class="post-card__date">
                    <?php echo get_the_date('l, F j'); ?>
                </span>
            </div>
            
            <h3 class="post-card__title">
                <?php the_title(); ?>
            </h3>
            
            <?php if ($author) : ?>
                <div class="post-card__organization">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path d="M17 21V19C17 17.9391 16.5786 16.9217 15.8284 16.1716C15.0783 15.4214 14.0609 15 13 15H5C3.93913 15 2.92172 15.4214 2.17157 16.1716C1.42143 16.9217 1 17.9391 1 19V21M13 7C13 9.20914 11.2091 11 9 11C6.79086 11 5 9.20914 5 7C5 4.79086 6.79086 3 9 3C11.2091 3 13 4.79086 13 7ZM23 21V19C22.9993 18.1137 22.7044 17.2528 22.1614 16.5523C21.6184 15.8519 20.8581 15.3516 20 15.13M16 3.13C16.8604 3.35031 17.623 3.85071 18.1676 4.55232C18.7122 5.25392 19.0078 6.11683 19.0078 7.005C19.0078 7.89317 18.7122 8.75608 18.1676 9.45768C17.623 10.1593 16.8604 10.6597 16 10.88" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <?php echo esc_html($author); ?>
                </div>
            <?php endif; ?>
            
            <div class="post-card__excerpt">
                <?php 
                // Priority: RankMath → Yoast → WordPress Excerpt → Trimmed content
                $excerpt = '';
                
                // Check RankMath first
                $rankmath_desc = get_post_meta(get_the_ID(), 'rank_math_description', true);
                if (!empty($rankmath_desc)) {
                    $excerpt = $rankmath_desc;
                }
                
                // Fallback to Yoast if RankMath not found
                if (empty($excerpt)) {
                    $yoast_desc = get_post_meta(get_the_ID(), '_yoast_wpseo_metadesc', true);
                    if (!empty($yoast_desc)) {
                        $excerpt = $yoast_desc;
                    }
                }
                
                // Fallback to WordPress excerpt
                if (empty($excerpt)) {
                    $excerpt = get_the_excerpt();
                }
                
                // Final fallback to trimmed content
                if (empty($excerpt)) {
                    $excerpt = wp_trim_words(get_the_content(), 25, '...');
                }
                
                // Display the excerpt (trim to fit our 4-line constraint)
                echo wp_trim_words($excerpt, 25, '...');
                ?>
            </div>
            
            <?php 
            // Get blog categories
            $blog_terms = get_the_category();
            
            if ($blog_terms && !is_wp_error($blog_terms)) : ?>
                <div class="post-card__categories">
                    <?php foreach ($blog_terms as $term) : ?>
                        <span class="post-card__category">
                            <?php echo esc_html($term->name); ?>
                        </span>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <div class="post-card__footer">
                <a href="<?php the_permalink(); ?>" class="post-card__read-more">
                    Read Article
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </div>
        </div>
    </a>
</article>
