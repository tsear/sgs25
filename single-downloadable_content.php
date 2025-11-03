<?php
/**
 * Single Downloadable Content Template
 * Displays individual download information (no forms, just info)
 */

get_header();
?>

<main id="main" class="site-main download-single">
    
    <?php while (have_posts()) : the_post(); ?>
        
        <?php
        // Check if Elementor is editing this post
        if (class_exists('\Elementor\Plugin') && \Elementor\Plugin::$instance->documents->get(get_the_ID())->is_built_with_elementor()) {
            // Let Elementor handle the entire post content
            the_content();
        } else {
            // Use our custom download template for non-Elementor posts
            ?>
            
            <section class="download-hero">
                <div class="container">
                    <div class="download-hero-content">
                        <h1 class="download-title"><?php the_title(); ?></h1>
                        <div class="download-meta">
                            <?php $content_type = get_post_meta(get_the_ID(), '_download_content_type', true); ?>
                            <?php if ($content_type) : ?>
                                <span class="download-type"><?php echo esc_html(ucfirst($content_type)); ?></span>
                            <?php endif; ?>
                            
                            <?php $file_size = get_post_meta(get_the_ID(), '_download_file_size', true); ?>
                            <?php if ($file_size) : ?>
                                <span class="download-size"><?php echo esc_html($file_size); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>
            
            <?php
            // Continue with the rest of the original template...
            ?>
        
        <section class="download-hero">
            <div class="container">
                <div class="download-hero-content">
                    <h1 class="download-title"><?php the_title(); ?></h1>
                    <div class="download-meta">
                        <?php $content_type = get_post_meta(get_the_ID(), '_download_content_type', true); ?>
                        <?php if ($content_type) : ?>
                            <span class="download-type"><?php echo esc_html(ucfirst($content_type)); ?></span>
                        <?php endif; ?>
                        
                        <?php $file_size = get_post_meta(get_the_ID(), '_download_file_size', true); ?>
                        <?php if ($file_size) : ?>
                            <span class="download-size"><?php echo esc_html($file_size); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section><?php } ?>
        
        <section class="download-hero">
            <div class="container">
                <div class="download-hero-content">
                    <h1 class="download-title"><?php the_title(); ?></h1>
                    <div class="download-meta">
                        <?php $content_type = get_post_meta(get_the_ID(), '_download_content_type', true); ?>
                        <?php if ($content_type) : ?>
                            <span class="download-type"><?php echo esc_html(ucfirst($content_type)); ?></span>
                        <?php endif; ?>
                        
                        <?php $file_size = get_post_meta(get_the_ID(), '_download_file_size', true); ?>
                        <?php if ($file_size) : ?>
                            <span class="download-size"><?php echo esc_html($file_size); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>

        <section class="download-content">
            <div class="container">
                <div class="download-content-grid">
                    <div class="download-info">
                        <div class="download-description">
                            <?php the_content(); ?>
                        </div>
                        
                        <?php $preview_content = get_post_meta(get_the_ID(), '_preview_content', true); ?>
                        <?php if ($preview_content) : ?>
                            <div class="download-preview">
                                <h3>What You'll Get:</h3>
                                <div class="preview-content">
                                    <?php echo nl2br(esc_html($preview_content)); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        
                        <div class="download-action">
                            <button class="download-main-btn download-trigger" 
                                    data-download-url="<?php echo esc_attr(get_post_meta(get_the_ID(), '_download_file_url', true)); ?>"
                                    data-download-title="<?php echo esc_attr(get_the_title()); ?>">
                                Download Now
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M19 9h-4V3H9v6H5l7 7 7-7zM5 18v2h14v-2H5z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                    
                    <div class="download-sidebar">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="download-image">
                                <?php the_post_thumbnail('large'); ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php $categories = get_the_terms(get_the_ID(), 'download_category'); ?>
                        <?php if ($categories && !is_wp_error($categories)) : ?>
                            <div class="download-categories">
                                <h4>Categories</h4>
                                <?php foreach ($categories as $category) : ?>
                                    <span class="download-category"><?php echo esc_html($category->name); ?></span>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>

        <!-- Related Downloads -->
        <?php
        $related_downloads = new WP_Query(array(
            'post_type' => 'downloadable_content',
            'posts_per_page' => 3,
            'post__not_in' => array(get_the_ID()),
            'orderby' => 'rand'
        ));
        
        if ($related_downloads->have_posts()) :
        ?>
        <section class="related-downloads">
            <div class="container">
                <h2>You Might Also Like</h2>
                <div class="related-downloads-grid">
                    <?php while ($related_downloads->have_posts()) : $related_downloads->the_post(); ?>
                        <article class="download-card">
                            <div class="download-card-image">
                                <?php if (has_post_thumbnail()) : ?>
                                    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium'); ?></a>
                                <?php endif; ?>
                            </div>
                            <div class="download-card-content">
                                <h3 class="download-card-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>
                                <p class="download-card-description">
                                    <?php echo wp_trim_words(get_the_excerpt(), 15, '...'); ?>
                                </p>
                                <button class="download-card-btn download-trigger" 
                                        data-download-url="<?php echo esc_attr(get_post_meta(get_the_ID(), '_download_file_url', true)); ?>"
                                        data-download-title="<?php echo esc_attr(get_the_title()); ?>">
                                    Download Now
                                </button>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>
            </div>
        </section>
        <?php
        wp_reset_postdata();
        endif;
        ?>

    <?php endwhile; ?>
    
</main>

<!-- Include the same modal and script from archive page -->
<div id="download-gate-modal" class="download-modal" style="display: none;">
    <div class="download-modal-overlay"></div>
    <div class="download-modal-content">
        <button class="download-modal-close">&times;</button>
        <div class="download-modal-body">
            <h3>Get Your Free Download</h3>
            <p>Please provide your information to access our resources. You'll only need to do this once!</p>
            
            <div id="download-hubspot-form"></div>
            
            <form id="download-fallback-form" style="display: none;">
                <div class="form-group">
                    <label for="download-first-name">First Name *</label>
                    <input type="text" id="download-first-name" name="first_name" required>
                </div>
                <div class="form-group">
                    <label for="download-last-name">Last Name *</label>
                    <input type="text" id="download-last-name" name="last_name" required>
                </div>
                <div class="form-group">
                    <label for="download-email">Email Address *</label>
                    <input type="email" id="download-email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="download-organization">Organization</label>
                    <input type="text" id="download-organization" name="organization">
                </div>
                <button type="submit" class="download-submit-btn">Get Downloads Access</button>
            </form>
        </div>
    </div>
</div>

<script>
// Same JavaScript as archive page
document.addEventListener('DOMContentLoaded', function() {
    const DOWNLOAD_COOKIE = 'sgs_download_access';
    const COOKIE_EXPIRY_DAYS = 365;
    
    function hasDownloadAccess() {
        return document.cookie.split(';').some(cookie => cookie.trim().startsWith(DOWNLOAD_COOKIE + '='));
    }
    
    function setDownloadAccess() {
        const expiryDate = new Date();
        expiryDate.setTime(expiryDate.getTime() + (COOKIE_EXPIRY_DAYS * 24 * 60 * 60 * 1000));
        document.cookie = DOWNLOAD_COOKIE + '=true; expires=' + expiryDate.toUTCString() + '; path=/';
    }
    
    function startDownload(url, title) {
        if (!url) {
            alert('Download file not available');
            return;
        }
        
        const link = document.createElement('a');
        link.href = url;
        link.download = title || 'download';
        link.target = '_blank';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }
    
    document.addEventListener('click', function(e) {
        if (e.target.closest('.download-trigger')) {
            e.preventDefault();
            const button = e.target.closest('.download-trigger');
            const downloadUrl = button.getAttribute('data-download-url');
            const downloadTitle = button.getAttribute('data-download-title');
            
            if (hasDownloadAccess()) {
                startDownload(downloadUrl, downloadTitle);
            } else {
                showDownloadModal(downloadUrl, downloadTitle);
            }
        }
    });
    
    function showDownloadModal(downloadUrl, downloadTitle) {
        const modal = document.getElementById('download-gate-modal');
        modal.style.display = 'flex';
        modal.setAttribute('data-download-url', downloadUrl);
        modal.setAttribute('data-download-title', downloadTitle);
        loadHubSpotForm();
    }
    
    function hideDownloadModal() {
        document.getElementById('download-gate-modal').style.display = 'none';
    }
    
    document.querySelector('.download-modal-close').addEventListener('click', hideDownloadModal);
    document.querySelector('.download-modal-overlay').addEventListener('click', hideDownloadModal);
    
    function loadHubSpotForm() {
        if (window.hbspt) {
            window.hbspt.forms.create({
                region: "na1",
                portalId: "YOUR_PORTAL_ID",
                formId: "YOUR_FORM_ID",
                target: "#download-hubspot-form",
                onFormSubmit: function() {
                    handleFormSuccess();
                }
            });
        } else {
            document.getElementById('download-fallback-form').style.display = 'block';
        }
    }
    
    function handleFormSuccess() {
        const modal = document.getElementById('download-gate-modal');
        const downloadUrl = modal.getAttribute('data-download-url');
        const downloadTitle = modal.getAttribute('data-download-title');
        
        setDownloadAccess();
        hideDownloadModal();
        
        setTimeout(() => {
            startDownload(downloadUrl, downloadTitle);
        }, 500);
    }
    
    document.getElementById('download-fallback-form').addEventListener('submit', function(e) {
        e.preventDefault();
        handleFormSuccess();
    });
});
</script>

<?php get_footer(); ?>