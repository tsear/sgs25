<?php
/**
 * Template Name: Downloads Page
 * Description: Downloadable content listing page
 */

get_header(); ?>

<main id="main" class="site-main downloads-page">
    
    <?php get_template_part('template-parts/downloads/downloads-hero'); ?>
    
    <?php get_template_part('template-parts/downloads/downloads-search-form'); ?>
    
    <?php get_template_part('template-parts/downloads/downloads-grid'); ?>

</main>

<!-- Include the download gate modal -->
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
// Download gateway JavaScript
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
        const downloadId = modal.getAttribute('data-download-id');
        
        setDownloadAccess();
        hideDownloadModal();
        
        // Track download
        if (downloadId) {
            trackDownload(downloadId);
        }
        
        setTimeout(() => {
            startDownload(downloadUrl, downloadTitle);
        }, 500);
    }
    
    function trackDownload(downloadId) {
        fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                action: 'sgs_track_download',
                download_id: downloadId,
                nonce: '<?php echo wp_create_nonce('sgs_download_nonce'); ?>'
            })
        }).catch(error => {
            console.log('Download tracking failed:', error);
        });
    }
    
    function showDownloadModal(downloadUrl, downloadTitle, downloadId) {
        const modal = document.getElementById('download-gate-modal');
        modal.style.display = 'flex';
        modal.setAttribute('data-download-url', downloadUrl);
        modal.setAttribute('data-download-title', downloadTitle);
        modal.setAttribute('data-download-id', downloadId || '');
        loadHubSpotForm();
    }
    
    // Update download trigger listeners
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('download-trigger') || e.target.closest('.download-trigger')) {
            e.preventDefault();
            const button = e.target.closest('.download-trigger') || e.target;
            const downloadUrl = button.getAttribute('data-download-url');
            const downloadTitle = button.getAttribute('data-download-title');
            const downloadId = button.getAttribute('data-download-id');
            
            if (!downloadUrl) {
                alert('Download file not available');
                return;
            }
            
            if (hasDownloadAccess()) {
                if (downloadId) {
                    trackDownload(downloadId);
                }
                startDownload(downloadUrl, downloadTitle);
            } else {
                showDownloadModal(downloadUrl, downloadTitle, downloadId);
            }
        }
    });
    
    document.getElementById('download-fallback-form').addEventListener('submit', function(e) {
        e.preventDefault();
        handleFormSuccess();
    });
});
</script>

<?php get_footer(); ?>