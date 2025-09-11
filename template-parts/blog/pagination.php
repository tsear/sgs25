<?php
/**
 * Template part for blog pagination
 */

if (get_next_posts_link() || get_previous_posts_link()) : ?>
    <nav class="blog-pagination" aria-label="Blog pagination">
        <div class="blog-pagination__links">
            <?php if (get_previous_posts_link()) : ?>
                <div class="blog-pagination__prev">
                    <?php previous_posts_link('← Newer Posts'); ?>
                </div>
            <?php endif; ?>
            
            <?php if (get_next_posts_link()) : ?>
                <div class="blog-pagination__next">
                    <?php next_posts_link('Older Posts →'); ?>
                </div>
            <?php endif; ?>
        </div>
    </nav>
<?php endif; ?>
