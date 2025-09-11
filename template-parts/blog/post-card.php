<?php
/**
 * Template part for displaying blog post cards
 * Used in blog archive and search results
 */
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
            
            <div class="post-card__excerpt">
                <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
            </div>
        </div>
    </a>
</article>
