<?php
/**
 * Archive template for Downloadable Content
 * Displays the downloads archive page at /downloads/
 */

get_header(); ?>

<main id="main" class="site-main downloads-archive">
    
    <section class="downloads-hero">
        <div class="container">
            <div class="downloads-hero-content">
                <h1 class="page-title">Resource Library</h1>
                <p class="page-subtitle">Access our comprehensive collection of grant-winning guides, whitepapers, and educational resources to help you secure funding for your organization.</p>
            </div>
        </div>
    </section>

    <section class="downloads-content">
        <div class="container">
            <div class="downloads-grid">
                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post(); ?>
                        <article class="download-card" data-download-url="<?php echo esc_attr(get_post_meta(get_the_ID(), '_download_file_url', true)); ?>">
                            <div class="download-card-image">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('medium'); ?>
                                <?php else : ?>
                                    <div class="download-placeholder">
                                        <svg width="48" height="48" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"/>
                                        </svg>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="download-card-overlay">
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
                            
                            <div class="download-card-content">
                                <h3 class="download-card-title"><?php the_title(); ?></h3>
                                <p class="download-card-description"><?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p>
                                
                                <?php $categories = get_the_terms(get_the_ID(), 'download_category'); ?>
                                <?php if ($categories && !is_wp_error($categories)) : ?>
                                    <div class="download-card-categories">
                                        <?php foreach ($categories as $category) : ?>
                                            <span class="download-category"><?php echo esc_html($category->name); ?></span>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="download-card-footer">
                                    <button class="download-card-btn download-trigger" 
                                            data-download-url="<?php echo esc_attr(get_post_meta(get_the_ID(), '_download_file_url', true)); ?>"
                                            data-download-title="<?php echo esc_attr(get_the_title()); ?>">
                                        Download Now
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M19 9h-4V3H9v6H5l7 7 7-7zM5 18v2h14v-2H5z"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </article>
                    <?php endwhile; ?>
                <?php else : ?>
                    <div class="no-downloads">
                        <h3>No Downloads Available</h3>
                        <p>We're working on adding new resources. Check back soon!</p>
                    </div>
                <?php endif; ?>
            </div>
            
            <?php
            // Pagination
            the_posts_pagination(array(
                'mid_size' => 2,
                'prev_text' => '← Previous',
                'next_text' => 'Next →',
            ));
            ?>
        </div>
    </section>

    <!-- Download Gate Modal -->
    <div id="download-gate-modal" class="download-modal" style="display: none;">
        <div class="download-modal-overlay"></div>
        <div class="download-modal-content">
            <button class="download-modal-close">&times;</button>
            <div class="download-modal-body">
                <h3>Get Your Free Download</h3>
                <p>Please provide your information to access our resources. You'll only need to do this once!</p>
                
                <!-- HubSpot Form Container -->
                <div id="download-hubspot-form"></div>
                
                <!-- Fallback Form -->
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

    <?php get_template_part('template-parts/newsletter-signup'); ?>

</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const DOWNLOAD_COOKIE = 'sgs_download_access';
    const COOKIE_EXPIRY_DAYS = 365;
    
    // Check if user has download access
    function hasDownloadAccess() {
        return document.cookie.split(';').some(cookie => cookie.trim().startsWith(DOWNLOAD_COOKIE + '='));
    }
    
    // Set download access cookie
    function setDownloadAccess() {
        const expiryDate = new Date();
        expiryDate.setTime(expiryDate.getTime() + (COOKIE_EXPIRY_DAYS * 24 * 60 * 60 * 1000));
        document.cookie = DOWNLOAD_COOKIE + '=true; expires=' + expiryDate.toUTCString() + '; path=/';
    }
    
    // Start download
    function startDownload(url, title) {
        if (!url) {
            alert('Download file not available');
            return;
        }
        
        // Create temporary download link
        const link = document.createElement('a');
        link.href = url;
        link.download = title || 'download';
        link.target = '_blank';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }
    
    // Handle download triggers
    document.addEventListener('click', function(e) {
        if (e.target.closest('.download-trigger')) {
            e.preventDefault();
            const button = e.target.closest('.download-trigger');
            const downloadUrl = button.getAttribute('data-download-url');
            const downloadTitle = button.getAttribute('data-download-title');
            
            if (hasDownloadAccess()) {
                // User already has access, start download immediately
                startDownload(downloadUrl, downloadTitle);
            } else {
                // Show the gate modal
                showDownloadModal(downloadUrl, downloadTitle);
            }
        }
    });
    
    // Show download modal
    function showDownloadModal(downloadUrl, downloadTitle) {
        const modal = document.getElementById('download-gate-modal');
        modal.style.display = 'flex';
        modal.setAttribute('data-download-url', downloadUrl);
        modal.setAttribute('data-download-title', downloadTitle);
        
        // Load HubSpot form
        loadHubSpotForm();
    }
    
    // Hide download modal
    function hideDownloadModal() {
        document.getElementById('download-gate-modal').style.display = 'none';
    }
    
    // Modal close handlers
    document.querySelector('.download-modal-close').addEventListener('click', hideDownloadModal);
    document.querySelector('.download-modal-overlay').addEventListener('click', hideDownloadModal);
    
    // Load HubSpot form
    function loadHubSpotForm() {
        if (window.hbspt) {
            window.hbspt.forms.create({
                region: "na1",
                portalId: "YOUR_PORTAL_ID", // Replace with your HubSpot portal ID
                formId: "YOUR_FORM_ID", // Replace with your HubSpot form ID
                target: "#download-hubspot-form",
                onFormSubmit: function() {
                    handleFormSuccess();
                }
            });
        } else {
            // Show fallback form
            document.getElementById('download-fallback-form').style.display = 'block';
        }
    }
    
    // Handle form success
    function handleFormSuccess() {
        const modal = document.getElementById('download-gate-modal');
        const downloadUrl = modal.getAttribute('data-download-url');
        const downloadTitle = modal.getAttribute('data-download-title');
        
        // Set cookie
        setDownloadAccess();
        
        // Hide modal
        hideDownloadModal();
        
        // Start download
        setTimeout(() => {
            startDownload(downloadUrl, downloadTitle);
        }, 500);
    }
    
    // Fallback form handler
    document.getElementById('download-fallback-form').addEventListener('submit', function(e) {
        e.preventDefault();
        // Here you would normally send data to your server/HubSpot API
        handleFormSuccess();
    });
});
</script>

<?php get_footer(); ?>