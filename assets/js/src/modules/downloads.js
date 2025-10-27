/**
 * Downloads Gateway Module
 * Handles download modal, form submission, and access control
 */

export default class DownloadsGateway {
    constructor() {
        console.log('🚀 DOWNLOADS GATEWAY: Constructor called');
        this.DOWNLOAD_COOKIE = 'sgs_download_access';
        this.COOKIE_EXPIRY_DAYS = 365;
        
        console.log('🚀 DOWNLOADS GATEWAY: About to initialize');
        this.init();
        console.log('🚀 DOWNLOADS GATEWAY: Initialization complete');
    }

    init() {
        console.log('🔧 DOWNLOADS GATEWAY: Init method called');
        
        // Check current state
        const modal = document.getElementById('download-gate-modal');
        const triggers = document.querySelectorAll('.download-trigger');
        const currentCookies = document.cookie;
        
        console.log('🔧 DOWNLOADS GATEWAY: Current state:', {
            modalExists: !!modal,
            modal: modal,
            triggerCount: triggers.length,
            triggers: triggers,
            allCookies: currentCookies,
            hasDownloadAccess: this.hasDownloadAccess()
        });
        
        // Initialize download functionality
        console.log('🔧 DOWNLOADS GATEWAY: Binding events...');
        this.bindEvents();
        console.log('🔧 DOWNLOADS GATEWAY: Events bound successfully');
    }

    hasDownloadAccess() {
        const cookies = document.cookie.split(';');
        const hasAccess = cookies.some(cookie => 
            cookie.trim().startsWith(this.DOWNLOAD_COOKIE + '=')
        );
        console.log('Checking download access:', {
            allCookies: document.cookie,
            cookieName: this.DOWNLOAD_COOKIE,
            hasAccess: hasAccess
        });
        return hasAccess;
    }

    setDownloadAccess() {
        const expiryDate = new Date();
        expiryDate.setTime(expiryDate.getTime() + (this.COOKIE_EXPIRY_DAYS * 24 * 60 * 60 * 1000));
        const cookieString = `${this.DOWNLOAD_COOKIE}=true; expires=${expiryDate.toUTCString()}; path=/; SameSite=Lax`;
        document.cookie = cookieString;
        console.log('Setting download cookie:', {
            cookieString: cookieString,
            cookieAfterSet: document.cookie
        });
    }

    startDownload(url, title) {
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

    showDownloadModal(downloadUrl, downloadTitle, downloadId) {
        const modal = document.getElementById('download-gate-modal');
        console.log('Showing download modal:', {
            modal: modal,
            modalExists: !!modal,
            downloadUrl: downloadUrl,
            downloadTitle: downloadTitle,
            downloadId: downloadId
        });
        
        if (!modal) {
            console.error('Download modal not found!');
            // Fall back to direct download
            this.startDownload(downloadUrl, downloadTitle);
            return;
        }
        
        modal.style.display = 'flex';
        modal.setAttribute('data-download-url', downloadUrl);
        modal.setAttribute('data-download-title', downloadTitle);
        modal.setAttribute('data-download-id', downloadId || '');
        this.loadHubSpotForm();
    }

    hideDownloadModal() {
        const modal = document.getElementById('download-gate-modal');
        if (modal) modal.style.display = 'none';
    }

    loadHubSpotForm() {
        if (window.hbspt) {
            window.hbspt.forms.create({
                region: "na1",
                portalId: "44675524",
                formId: "5a31b16f-5013-4aa8-81a4-87b2135b8d0e",
                target: "#download-hubspot-form",
                onFormSubmit: () => {
                    this.handleFormSuccess();
                }
            });
        } else {
            const fallbackForm = document.getElementById('download-fallback-form');
            if (fallbackForm) fallbackForm.style.display = 'block';
        }
    }

    handleFormSuccess() {
        console.log('handleFormSuccess called');
        const modal = document.getElementById('download-gate-modal');
        const downloadUrl = modal.getAttribute('data-download-url');
        const downloadTitle = modal.getAttribute('data-download-title');
        const downloadId = modal.getAttribute('data-download-id');
        
        console.log('Download details:', { downloadUrl, downloadTitle, downloadId });
        
        this.setDownloadAccess();
        this.hideDownloadModal();
        
        // Track download
        if (downloadId) {
            this.trackDownload(downloadId);
        }
        
        setTimeout(() => {
            console.log('Starting download:', downloadUrl);
            this.startDownload(downloadUrl, downloadTitle);
        }, 500);
    }

    trackDownload(downloadId) {
        fetch('/wp-admin/admin-ajax.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                action: 'sgs_track_download',
                download_id: downloadId
            })
        }).catch(error => {
            console.log('Download tracking failed:', error);
        });
    }

    bindEvents() {
        console.log('🎯 DOWNLOADS GATEWAY: bindEvents called');
        
        // Handle download trigger clicks
        document.addEventListener('click', (e) => {
            console.log('🎯 DOWNLOADS GATEWAY: Click detected', {
                target: e.target,
                hasDownloadTriggerClass: e.target.classList.contains('download-trigger'),
                closestDownloadTrigger: e.target.closest('.download-trigger')
            });
            if (e.target.classList.contains('download-trigger') || e.target.closest('.download-trigger')) {
                e.preventDefault();
                const button = e.target.closest('.download-trigger') || e.target;
                const downloadUrl = button.getAttribute('data-download-url');
                const downloadTitle = button.getAttribute('data-download-title');
                const downloadId = button.getAttribute('data-download-id');
                
                console.log('Download trigger clicked:', {
                    button: button,
                    downloadUrl: downloadUrl,
                    downloadTitle: downloadTitle,
                    downloadId: downloadId,
                    hasAccess: this.hasDownloadAccess()
                });
                
                if (!downloadUrl) {
                    alert('Download file not available');
                    return;
                }
                
                if (this.hasDownloadAccess()) {
                    console.log('User has download access - starting download directly');
                    if (downloadId) {
                        this.trackDownload(downloadId);
                    }
                    this.startDownload(downloadUrl, downloadTitle);
                } else {
                    console.log('User needs to complete modal first');
                    this.showDownloadModal(downloadUrl, downloadTitle, downloadId);
                }
            }
        });
        
        // Handle modal close events
        const closeBtn = document.querySelector('.download-modal-close');
        const overlay = document.querySelector('.download-modal-overlay');
        
        if (closeBtn) closeBtn.addEventListener('click', () => this.hideDownloadModal());
        if (overlay) overlay.addEventListener('click', () => this.hideDownloadModal());
        
        // Handle form submission
        const fallbackForm = document.getElementById('download-fallback-form');
        if (fallbackForm) {
            fallbackForm.addEventListener('submit', (e) => {
                e.preventDefault(); // STOP THE REDIRECT
                console.log('Form submitted - triggering download immediately');
                
                // Just trigger the download - HubSpot will collect the data automatically
                this.handleFormSuccess();
            });
        }
    }
}