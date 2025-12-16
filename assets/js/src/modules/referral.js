/**
 * Referral Tracking Module
 * 
 * Reads the referral cookie and injects it into all HubSpot forms
 * so HubSpot can track which referral link brought the lead
 */

export function initReferral() {
    console.log('🔗 Referral tracking initialized');
    
    // Check URL for referral code first
    const urlParams = new URLSearchParams(window.location.search);
    const refFromUrl = urlParams.get('referral_source');
    
    if (refFromUrl) {
        console.log(`📥 Referral code from URL: ${refFromUrl}`);
        setReferralCode(refFromUrl);
    }
    
    // Get referral code from cookie
    const referralCode = getReferralCode();
    
    if (!referralCode) {
        console.log('No referral code found in cookies or URL');
        return;
    }
    
    console.log(`✅ Referral code detected: ${referralCode}`);
    
    // Inject into existing forms on page
    injectReferralIntoForms(referralCode);
    
    // Watch for HubSpot forms that load dynamically
    watchForHubSpotForms(referralCode);
    
    // Watch for any new forms added to DOM
    observeNewForms(referralCode);
}

/**
 * Set referral code in cookie
 */
function setReferralCode(code) {
    const expiryDays = 30;
    const d = new Date();
    d.setTime(d.getTime() + (expiryDays * 24 * 60 * 60 * 1000));
    const expires = `expires=${d.toUTCString()}`;
    
    document.cookie = `sgs_referral_public=${encodeURIComponent(code)}; ${expires}; path=/; SameSite=Lax`;
    console.log(`✅ Referral code saved to cookie: ${code}`);
}

/**
 * Get referral code from cookie
 */
function getReferralCode() {
    const cookies = document.cookie.split(';');
    
    for (let cookie of cookies) {
        const [name, value] = cookie.trim().split('=');
        if (name === 'sgs_referral_public') {
            return decodeURIComponent(value);
        }
    }
    
    return null;
}

/**
 * Inject referral code into existing forms
 */
function injectReferralIntoForms(referralCode) {
    // Find all forms on the page
    const forms = document.querySelectorAll('form');
    
    forms.forEach(form => {
        addReferralFieldToForm(form, referralCode);
    });
}

/**
 * Add hidden referral field to a specific form
 */
function addReferralFieldToForm(form, referralCode) {
    // Check if field already exists
    const existingField = form.querySelector('input[name="referral_source"]');
    if (existingField) {
        existingField.value = referralCode;
        console.log('Updated existing referral field in form');
        return;
    }
    
    // Create hidden field
    const hiddenField = document.createElement('input');
    hiddenField.type = 'hidden';
    hiddenField.name = 'referral_source';
    hiddenField.value = referralCode;
    
    form.appendChild(hiddenField);
    console.log(`Added referral field to form: ${referralCode}`);
}

/**
 * Watch for HubSpot forms that load via their embed API
 */
function watchForHubSpotForms(referralCode) {
    // Set up global callback for HubSpot forms
    window.addEventListener('message', (event) => {
        if (event.data.type === 'hsFormCallback' && event.data.eventName === 'onFormReady') {
            const formId = event.data.id;
            console.log(`✅ HubSpot form ready: ${formId}`);
            
            // Use HubSpot's API to set the field value
            if (window.hbspt && window.hbspt.forms && window.hbspt.forms.getForm) {
                try {
                    const form = window.hbspt.forms.getForm(formId);
                    if (form) {
                        form.setFieldValue('referral_source', referralCode);
                        console.log(`✅ Set referral_source to: ${referralCode}`);
                    }
                } catch (error) {
                    console.error('Error setting HubSpot field:', error);
                }
            }
        }
    });
}

/**
 * Use MutationObserver to watch for forms added dynamically
 */
function observeNewForms(referralCode) {
    const observer = new MutationObserver((mutations) => {
        mutations.forEach((mutation) => {
            mutation.addedNodes.forEach((node) => {
                // Check if the added node is a form
                if (node.tagName === 'FORM') {
                    addReferralFieldToForm(node, referralCode);
                }
                
                // Check if the added node contains forms
                if (node.querySelectorAll) {
                    const forms = node.querySelectorAll('form');
                    forms.forEach(form => {
                        addReferralFieldToForm(form, referralCode);
                    });
                }
            });
        });
    });
    
    // Start observing the document body
    observer.observe(document.body, {
        childList: true,
        subtree: true
    });
    
    console.log('MutationObserver watching for new forms');
}

/**
 * Display referral info banner (persistent)
 */
export function showReferralDebugInfo() {
    const referralCode = getReferralCode();
    
    if (!referralCode) {
        return;
    }
    
    // Check if banner already exists
    if (document.getElementById('sgs-referral-banner')) {
        return;
    }
    
    const banner = document.createElement('div');
    banner.id = 'sgs-referral-banner';
    banner.style.cssText = `
        position: fixed;
        top: 70px;
        right: 20px;
        background: #333;
        color: #fff;
        padding: 8px 12px;
        border-radius: 5px;
        font-family: monospace;
        font-size: 11px;
        z-index: 9999;
        box-shadow: 0 2px 10px rgba(0,0,0,0.3);
        cursor: pointer;
        transition: background 0.2s;
    `;
    banner.innerHTML = `🔗 <strong>${referralCode}</strong>`;
    
    // Build referral URL pointing to contact page
    const referralUrl = `https://smartgrantsolutions.com/contact/?referral_source=${referralCode}`;
    
    // Click to copy full referral URL
    banner.addEventListener('click', () => {
        navigator.clipboard.writeText(referralUrl).then(() => {
            const originalBg = banner.style.background;
            banner.style.background = '#FFB03F';
            banner.innerHTML = `✓ <strong>Copied!</strong>`;
            
            setTimeout(() => {
                banner.style.background = originalBg;
                banner.innerHTML = `🔗 <strong>${referralCode}</strong>`;
            }, 1500);
        }).catch(() => {
            // Fallback for older browsers
            const tempInput = document.createElement('input');
            tempInput.value = referralUrl;
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand('copy');
            document.body.removeChild(tempInput);
            
            const originalBg = banner.style.background;
            banner.style.background = '#FFB03F';
            banner.innerHTML = `✓ <strong>Copied!</strong>`;
            
            setTimeout(() => {
                banner.style.background = originalBg;
                banner.innerHTML = `🔗 <strong>${referralCode}</strong>`;
            }, 1500);
        });
    });
    
    document.body.appendChild(banner);
}
