/**
 * Minimal Referral Tracking
 * Captures referral_source from URL, stores in cookie, populates form field
 */

export function initReferral() {
    // Get referral from URL
    const urlParams = new URLSearchParams(window.location.search);
    const refCode = urlParams.get('referral_source');
    
    // Save to cookie if present in URL
    if (refCode) {
        const d = new Date();
        d.setTime(d.getTime() + (30 * 24 * 60 * 60 * 1000)); // 30 days
        document.cookie = `sgs_referral_public=${encodeURIComponent(refCode)}; expires=${d.toUTCString()}; path=/; SameSite=Lax`;
    }
    
    // Get code from cookie
    const cookies = document.cookie.split(';');
    let storedCode = null;
    for (let cookie of cookies) {
        const [name, value] = cookie.trim().split('=');
        if (name === 'sgs_referral_public') {
            storedCode = decodeURIComponent(value);
            break;
        }
    }
    
    // Populate field if code exists and we're on a page with the field
    if (storedCode) {
        const setField = () => {
            const field = document.querySelector('input[name="referral_source"]');
            if (field && !field.value) {
                field.value = storedCode;
            }
        };
        
        // Try immediately and after delay (for HubSpot forms)
        setField();
        setTimeout(setField, 500);
        setTimeout(setField, 1000);
    }
}
