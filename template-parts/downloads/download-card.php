<?php
/**
 * Template part for displaying download cards
 * Used in downloads archive and search results
 */

// Get download-specific meta fields
$file_attachment_id = get_post_meta(get_the_ID(), '_download_file_attachment', true);
$file_url = $file_attachment_id ? wp_get_attachment_url($file_attachment_id) : '';
$file_size = get_post_meta(get_the_ID(), '_download_file_size', true);
$file_type = get_post_meta(get_the_ID(), '_download_file_type', true);
$download_count = get_post_meta(get_the_ID(), '_download_count', true);
$featured = get_post_meta(get_the_ID(), '_download_featured', true);
$preview_text = get_post_meta(get_the_ID(), '_download_preview_text', true);
$author_name = get_post_meta(get_the_ID(), '_download_author', true);
$publish_date = get_post_meta(get_the_ID(), '_download_publish_date', true);
$tags = get_post_meta(get_the_ID(), '_download_tags', true);

// Auto-detect file size if not set
if (!$file_size && $file_attachment_id) {
    $file_path = get_attached_file($file_attachment_id);
    if ($file_path && file_exists($file_path)) {
        $file_size_bytes = filesize($file_path);
        $file_size = size_format($file_size_bytes);
        update_post_meta(get_the_ID(), '_download_file_size', $file_size);
    }
}

// Use custom author if set
$display_author = $author_name ?: get_the_author();

// Use custom publish date if set
$display_date = $publish_date ? date('M j, Y', strtotime($publish_date)) : get_the_date('M j, Y');

// Use preview text or excerpt
$description = $preview_text ?: get_the_excerpt();
?>

<article class="download-card <?php echo $featured ? 'download-card--featured' : ''; ?>">
    <div class="download-card__wrapper">
        <?php if (has_post_thumbnail()) : ?>
            <div class="download-card__image">
                <?php the_post_thumbnail('medium', array('alt' => get_the_title())); ?>
                <?php if ($file_type) : ?>
                    <span class="download-type-badge"><?php echo esc_html($file_type); ?></span>
                <?php endif; ?>
                <?php if ($featured) : ?>
                    <span class="download-featured-badge">Featured</span>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        
        <div class="download-card__content">
            <div class="download-card__meta">
                <span class="download-card__date">
                    <?php echo esc_html($display_date); ?>
                </span>
                
                <?php if ($file_size) : ?>
                    <span class="download-size">
                        <?php echo esc_html($file_size); ?>
                    </span>
                <?php endif; ?>

                <?php if ($download_count) : ?>
                    <span class="download-count">
                        <?php echo number_format($download_count); ?> downloads
                    </span>
                <?php endif; ?>
            </div>
            
            <h3 class="download-card__title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h3>

            <?php if ($display_author) : ?>
                <div class="download-card__author">
                    By <?php echo esc_html($display_author); ?>
                </div>
            <?php endif; ?>
            
            <div class="download-card__description">
                <?php echo wp_trim_words($description, 20, '...'); ?>
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

            <?php if ($tags) : 
                $tag_array = array_map('trim', explode(',', $tags));
                ?>
                <div class="download-card__tags">
                    <?php foreach ($tag_array as $tag) : ?>
                        <span class="download-tag"><?php echo esc_html($tag); ?></span>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <div class="download-card__footer">
                <button class="download-card-btn download-trigger" 
                        data-download-url="<?php echo esc_attr($file_url); ?>"
                        data-download-title="<?php echo esc_attr(get_the_title()); ?>"
                        data-download-id="<?php echo get_the_ID(); ?>"
                        <?php echo !$file_url ? 'disabled' : ''; ?>>
                    <?php echo $file_url ? 'Download Now' : 'File Not Available'; ?>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M19 9h-4V3H9v6H5l7 7 7-7zM5 18v2h14v-2H5z"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</article>