<?php
/**
 * Related Posts Section
 */

// Get related posts based on categories
$categories = get_the_category();
$category_ids = array();

if ($categories) {
    foreach ($categories as $category) {
        $category_ids[] = $category->term_id;
    }
}

$related_posts = new WP_Query(array(
    'category__in' => $category_ids,
    'post__not_in' => array(get_the_ID()),
    'posts_per_page' => 3,
    'orderby' => 'rand'
));
?>

<?php if ($related_posts->have_posts()) : ?>
<section class="related-posts">
    <div class="related-posts__container">
        
        <!-- Section Title with Dividers -->
        <div class="related-posts__header">
            <div class="related-posts__divider"></div>
            <h2 class="related-posts__title">Read Other Articles</h2>
            <div class="related-posts__divider"></div>
        </div>
        
        <!-- Related Posts Grid -->
        <div class="related-posts__grid">
            <?php while ($related_posts->have_posts()) : $related_posts->the_post(); ?>
                
                <article class="related-posts__card">
                    <a href="<?php the_permalink(); ?>" class="related-posts__link">
                        
                        <!-- Featured Image -->
                        <div class="related-posts__image">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('medium', array('class' => 'related-posts__img')); ?>
                            <?php else : ?>
                                <div class="related-posts__placeholder">
                                    <svg width="60" height="60" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4 16L8.586 11.414C9.367 10.633 10.633 10.633 11.414 11.414L16 16M14 14L15.586 12.414C16.367 11.633 17.633 11.633 18.414 12.414L20 14M14 8H14.01M6 20H18C19.1046 20 20 19.1046 20 18V6C20 4.89543 19.1046 4 18 4H6C4.89543 4 4 4.89543 4 6V18C4 19.1046 4.89543 20 6 20Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                            <?php endif; ?>
                            <div class="related-posts__separator"></div>
                        </div>
                        
                        <!-- Post Content -->
                        <div class="related-posts__content">
                            <div class="related-posts__meta">
                                <span class="related-posts__date"><?php echo get_the_date('l, F j'); ?></span>
                            </div>
                            <h3 class="related-posts__card-title"><?php the_title(); ?></h3>
                            <div class="related-posts__excerpt">
                                <?php echo wp_trim_words(get_the_excerpt(), 15, '...'); ?>
                            </div>
                        </div>
                        
                    </a>
                </article>
                
            <?php endwhile; ?>
        </div>
        
    </div>
</section>

<?php 
wp_reset_postdata();
endif; 
?>
