<?php
/**
 * Single Post Navigation Section
 */

$prev_post = get_previous_post();
$next_post = get_next_post();
?>

<?php if ($prev_post || $next_post) : ?>
<section class="post-navigation">
    <div class="post-navigation__container">
        
        <div class="post-navigation__grid">
            
            <!-- Previous Post -->
            <div class="post-navigation__item post-navigation__item--prev">
                <?php if ($prev_post) : ?>
                    <a href="<?php echo get_permalink($prev_post->ID); ?>" class="post-navigation__link">
                        <div class="post-navigation__direction">← Previous Article</div>
                        <h3 class="post-navigation__title"><?php echo get_the_title($prev_post->ID); ?></h3>
                        <?php if (has_post_thumbnail($prev_post->ID)) : ?>
                            <div class="post-navigation__image">
                                <?php echo get_the_post_thumbnail($prev_post->ID, 'medium'); ?>
                            </div>
                        <?php endif; ?>
                    </a>
                <?php endif; ?>
            </div>
            
            <!-- Back to Blog -->
            <div class="post-navigation__item post-navigation__item--home">
                <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>" class="post-navigation__link post-navigation__link--home">
                    <div class="post-navigation__home-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3 12L5 10M5 10L12 3L19 10M5 10V20C5 20.5523 5.44772 21 6 21H9M19 10L21 12M19 10V20C19 20.5523 18.5523 21 18 21H15M9 21C9.55228 21 10 20.5523 10 20V16C10 15.4477 10.4477 15 11 15H13C13.5523 15 14 15.4477 14 16V20C14 20.5523 14.4477 21 15 21M9 21H15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <span>Back to Blog</span>
                </a>
            </div>
            
            <!-- Next Post -->
            <div class="post-navigation__item post-navigation__item--next">
                <?php if ($next_post) : ?>
                    <a href="<?php echo get_permalink($next_post->ID); ?>" class="post-navigation__link">
                        <div class="post-navigation__direction">Next Article →</div>
                        <h3 class="post-navigation__title"><?php echo get_the_title($next_post->ID); ?></h3>
                        <?php if (has_post_thumbnail($next_post->ID)) : ?>
                            <div class="post-navigation__image">
                                <?php echo get_the_post_thumbnail($next_post->ID, 'medium'); ?>
                            </div>
                        <?php endif; ?>
                    </a>
                <?php endif; ?>
            </div>
            
        </div>
        
    </div>
</section>
<?php endif; ?>
