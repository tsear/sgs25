<?php
/**
 * Single Post Content Section
 */
?>

<section class="post-content">
    <div class="post-content__container">
        
        <article class="post-content__article">
            
            <div class="post-content__body">
                <?php the_content(); ?>
            </div>
            
            <!-- Post Tags -->
            <?php if (has_tag()) : ?>
                <div class="post-content__tags">
                    <h3 class="post-content__tags-title">Tags:</h3>
                    <div class="post-content__tags-list">
                        <?php the_tags('', '', ''); ?>
                    </div>
                </div>
            <?php endif; ?>
            
            <!-- Author Info -->
            <div class="post-content__author">
                <div class="post-content__author-avatar">
                    <?php echo get_avatar(get_the_author_meta('ID'), 80); ?>
                </div>
                <div class="post-content__author-info">
                    <h3 class="post-content__author-name">
                        <?php the_author(); ?>
                    </h3>
                    <div class="post-content__author-bio">
                        <?php echo get_the_author_meta('description'); ?>
                    </div>
                </div>
            </div>
            
        </article>
        
    </div>
</section>
