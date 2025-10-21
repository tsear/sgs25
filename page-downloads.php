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
            
            <!-- Fallback/Custom form for downloads -->
            <form id="download-fallback-form" style="display: block;">
                <div class="form-group">
                    <label for="download_firstname">First Name *</label>
                    <input type="text" id="download_firstname" name="firstname" required>
                </div>
                
                <div class="form-group">
                    <label for="download_lastname">Last Name *</label>
                    <input type="text" id="download_lastname" name="lastname" required>
                </div>
                
                <div class="form-group">
                    <label for="download_email">Email Address *</label>
                    <input type="email" id="download_email" name="email" required>
                </div>
                
                <div class="form-group">
                    <label for="download_company">Company</label>
                    <input type="text" id="download_company" name="company">
                </div>
                
                <div class="form-group">
                    <label for="download_interest">What interests you most?</label>
                    <select id="download_interest" name="download_interest">
                        <option value="">Select one...</option>
                        <option value="Grant Writing">Grant Writing</option>
                        <option value="Compliance Management">Compliance Management</option>
                        <option value="Financial Reporting">Financial Reporting</option>
                        <option value="Opportunity Research">Opportunity Research</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                
                <button type="submit" class="download-submit-btn">Get Download Access</button>
            </form>
        </div>
    </div>
</div>

<script>
// Download gateway JavaScript
document.addEventListener('DOMContentLoaded', function() {
    console.log('Downloads page JavaScript loaded'); // Debug
    
    // Check if modal exists
    const modal = document.getElementById('download-gate-modal');
    console.log('Modal element found:', !!modal); // Debug
    
    // Check if download buttons exist
    const downloadButtons = document.querySelectorAll('.download-trigger');
    console.log('Download buttons found:', downloadButtons.length); // Debug
    
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
            
            console.log('Download button clicked:', { downloadUrl, downloadTitle }); // Debug
            
            if (hasDownloadAccess()) {
                console.log('User has download access, starting download'); // Debug
                startDownload(downloadUrl, downloadTitle);
            } else {
                console.log('User needs to complete form, showing modal'); // Debug
                showDownloadModal(downloadUrl, downloadTitle);
            }
        }
    });
    
    function showDownloadModal(downloadUrl, downloadTitle) {
        console.log('Showing download modal:', { downloadUrl, downloadTitle }); // Debug
        const modal = document.getElementById('download-gate-modal');
        if (!modal) {
            console.error('Modal element not found!'); // Debug
            return;
        }
        modal.style.display = 'flex';
        modal.setAttribute('data-download-url', downloadUrl);
        modal.setAttribute('data-download-title', downloadTitle);
        loadHubSpotForm();
    }
    
    function hideDownloadModal() {
        const modal = document.getElementById('download-gate-modal');
        if (modal) {
            modal.style.display = 'none';
        }
    }
    
    // Add event listeners with error checking
    const closeButton = document.querySelector('.download-modal-close');
    const overlay = document.querySelector('.download-modal-overlay');
    
    if (closeButton) {
        closeButton.addEventListener('click', hideDownloadModal);
    } else {
        console.warn('Modal close button not found');
    }
    
    if (overlay) {
        overlay.addEventListener('click', hideDownloadModal);
    } else {
        console.warn('Modal overlay not found');
    }
    
    function loadHubSpotForm() {
        // We're now using the API approach, so just show the custom form
        document.getElementById('download-fallback-form').style.display = 'block';
        document.getElementById('download-hubspot-form').style.display = 'none';
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
    
    function submitDownloadForm(formData) {
        return fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                action: 'sgs_submit_hubspot_form',
                form_type: 'download',
                form_data: JSON.stringify(formData),
                nonce: '<?php echo wp_create_nonce('sgs_hubspot_form_nonce'); ?>'
            })
        })
        .then(response => response.json())
        .catch(error => {
            console.error('Form submission error:', error);
            return { success: false, data: 'Network error' };
        });
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
        
        // Get form data
        const formData = {
            firstname: document.getElementById('download_firstname').value,
            lastname: document.getElementById('download_lastname').value,
            email: document.getElementById('download_email').value,
            company: document.getElementById('download_company').value,
            download_interest: document.getElementById('download_interest').value
        };
        
        // Validate required fields
        if (!formData.firstname || !formData.lastname || !formData.email) {
            alert('Please fill in all required fields.');
            return;
        }
        
        // Show loading state
        const submitBtn = this.querySelector('.download-submit-btn');
        const originalText = submitBtn.textContent;
        submitBtn.textContent = 'Submitting...';
        submitBtn.disabled = true;
        
        // Submit form
        submitDownloadForm(formData)
            .then(response => {
                if (response.success) {
                    handleFormSuccess();
                } else {
                    alert('Submission failed: ' + (response.data || 'Unknown error'));
                }
            })
            .catch(error => {
                console.error('Form submission error:', error);
                alert('Submission failed. Please try again.');
            })
            .finally(() => {
                // Reset button state
                submitBtn.textContent = originalText;
                submitBtn.disabled = false;
            });
    });
});
</script>

<?php get_footer(); ?>