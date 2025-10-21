<?php
/**
 * Template part for displaying download cards
 * Used in downloads archive and search results
 */

// Get download-specific meta fields
$file_url = get_post_meta(get_the_ID(), '_download_file_url', true);
$file_size = get_post_meta(get_the_ID(), '_download_file_size', true);
$content_type = get_post_meta(get_the_ID(), '_download_content_type', true);
$author = get_the_author();
?>

<article class="download-card">
    <div class="download-card__wrapper">
        <?php if (has_post_thumbnail()) : ?>
            <div class="download-card__image">
                <?php the_post_thumbnail('medium', array('alt' => get_the_title())); ?>
                <?php if ($content_type) : ?>
                    <span class="download-type-badge"><?php echo esc_html(ucfirst($content_type)); ?></span>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        
        <div class="download-card__content">
            <div class="download-card__meta">
                <span class="download-card__date">
                    <?php echo get_the_date('M j, Y'); ?>
                </span>
                
                <?php if ($file_size) : ?>
                    <span class="download-size">
                        <?php echo esc_html($file_size); ?>
                    </span>
                <?php endif; ?>
            </div>
            
            <h3 class="download-card__title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h3>
            
            <div class="download-card__description">
                <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
            </div>
            
            <?php 
            // Get download categories
            $download_terms = get_the_terms(get_the_ID(), 'download_category');
            if (!$download_terms || is_wp_error($download_terms)) {
                $download_terms = get_the_category();
            }
            
            if ($download_terms && !is_wp_error($download_terms)) : ?>
                <div class="download-card__categories">
                    <?php foreach ($download_terms as $term) : ?>
                        <span class="download-category">
                            <?php echo esc_html($term->name); ?>
                        </span>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <div class="download-card__footer">
                <button class="download-card-btn download-trigger" 
                        data-download-url="<?php echo esc_attr($file_url); ?>"
                        data-download-title="<?php echo esc_attr(get_the_title()); ?>">
                    Download Now
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M19 9h-4V3H9v6H5l7 7 7-7zM5 18v2h14v-2H5z"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</article>