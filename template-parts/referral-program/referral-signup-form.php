<?php
/**
 * Self-Service Referral Signup Form
 * Users can generate their own referral link instantly
 */
?>

<section id="signup" class="referral-signup-section">
    <div class="referral-signup-container">
        
        <div class="referral-signup-header">
            <h2 class="signup-title">Get Your Unique Referral Link</h2>
            <p class="signup-subtitle">Fill out the form below and get your personalized referral link instantly. Track all your referrals right from your dashboard.</p>
        </div>

        <!-- Signup Form (HubSpot Embedded) -->
        <div class="referral-signup-form-wrapper">
            <!-- HubSpot Form Container -->
            <div id="hubspot-referral-form"></div>
            
            <!-- Loading State -->
            <div id="form-loading" style="text-align: center; padding: 40px;">
                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#FFB03F" style="animation: spin 1s linear infinite;">
                    <circle cx="12" cy="12" r="10" stroke-width="3" opacity="0.25"/>
                    <path d="M12 2 A10 10 0 0 1 22 12" stroke-width="3" stroke-linecap="round"/>
                </svg>
                <p style="margin-top: 15px; color: #666;">Loading form...</p>
            </div>
            
            <style>
                @keyframes spin {
                    from { transform: rotate(0deg); }
                    to { transform: rotate(360deg); }
                }
            </style>
            
            <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/embed/v2.js"></script>
            <script>
                // Load HubSpot form
                hbspt.forms.create({
                    region: "na1",
                    portalId: "44675524",
                    formId: "e055df41-5242-4142-9924-b94b4830b6e6",
                    target: "#hubspot-referral-form",
                    onFormReady: function($form) {
                        document.getElementById('form-loading').style.display = 'none';
                        console.log('✅ Referral form loaded');
                    },
                    onFormSubmitted: function($form, data) {
                        console.log('🎉 Form submitted to HubSpot');
                        
                        // Get form data
                        const formData = {};
                        data.submissionValues.forEach ? data.submissionValues.forEach(function(field) {
                            formData[field.name] = field.value;
                        }) : Object.assign(formData, data.submissionValues);
                        
                        console.log('📋 Form data:', formData);
                        
                        // Generate referral code via WordPress
                        generateReferralCode(formData);
                    }
                });
                
                // Function to generate referral code after HubSpot submission
                function generateReferralCode(formData) {
                    console.log('🎉 GENERATING REFERRAL CODE', formData);
                    
                    // Find elements
                    const formWrapper = document.querySelector('.referral-signup-form-wrapper');
                    const loadingDiv = document.getElementById('form-loading');
                    const successDiv = document.getElementById('referral-success');
                    const errorDiv = document.getElementById('referral-error');
                    
                    console.log('📦 Found elements:', {
                        formWrapper: !!formWrapper,
                        loadingDiv: !!loadingDiv,
                        successDiv: !!successDiv,
                        errorDiv: !!errorDiv
                    });
                    
                    // Show loading state
                    if (formWrapper) formWrapper.style.display = 'none';
                    if (loadingDiv) {
                        loadingDiv.style.display = 'block';
                        loadingDiv.innerHTML = '<div style="text-align: center; padding: 2rem; background: rgba(0,0,0,0.8); border-radius: 8px;"><div style="border: 4px solid rgba(255, 176, 63, 0.2); border-top-color: #FFB03F; border-radius: 50%; width: 40px; height: 40px; animation: spin 1s linear infinite; margin: 0 auto 1rem;"></div><p style="color: #fff; font-size: 1.1rem; margin: 0;">Processing your referral link...</p></div>';
                    }
                    
                    let firstName = formData.firstname || '';
                    let lastName = formData.lastname || '';
                    let email = formData.email || '';
                    let organization = formData.company || '';
                    let customCode = formData.custom_referral_code || '';
                    
                    console.log('📧 Collected data:', {firstName, lastName, email, organization, customCode});
                    
                    // Check if sgsData exists
                    if (typeof sgsData === 'undefined') {
                        console.error('❌ sgsData is not defined!');
                        if (loadingDiv) loadingDiv.style.display = 'none';
                        alert('Configuration error. Please refresh the page and try again.');
                        return;
                    }
                    
                    console.log('✅ sgsData available:', sgsData);
                    
                    // Create FormData for WordPress AJAX
                    const wpFormData = new FormData();
                    
                    // Generate referral link via WordPress
                    wpFormData.append('action', 'sgs_generate_referral_link');
                    wpFormData.append('nonce', sgsData.referralNonce);
                    wpFormData.append('first_name', firstName);
                    wpFormData.append('last_name', lastName);
                    wpFormData.append('email', email);
                    wpFormData.append('organization', organization);
                    wpFormData.append('custom_code', customCode);
                    wpFormData.append('hubspot_contact_id', '');
                    
                    console.log('🚀 Sending AJAX request to:', sgsData.ajaxUrl);
                    
                    fetch(sgsData.ajaxUrl, {
                        method: 'POST',
                        body: wpFormData
                    })
                        .then(response => {
                            console.log('📡 Response received:', response);
                            return response.json();
                        })
                        .then(result => {
                            console.log('📦 Full Result:', result);
                            console.log('📦 Result.data:', result.data);
                            console.log('📦 Success?', result.success);
                            
                            // Hide loading
                            if (loadingDiv) {
                                console.log('✅ Hiding loading div');
                                loadingDiv.style.display = 'none';
                            }
                            
                            // Hide form wrapper and loading
                            if (formWrapper) formWrapper.style.display = 'none';
                            if (loadingDiv) loadingDiv.style.display = 'none';
                            
                            if (result.success) {
                                console.log('✅ SUCCESS - Code generated:', result.data.referral_code);
                                showSuccessMessage(result.data);
                            } else {
                                // Show error
                                const errorDiv = document.getElementById('referral-error');
                                if (errorDiv) {
                                    errorDiv.style.display = 'block';
                                    document.getElementById('error-message-text').textContent = 
                                        result.data.message || 'Failed to generate link. Please contact support.';
                                }
                            }
                        })
                        .catch(error => {
                            console.error('Link generation error:', error);
                            
                            // Hide loading
                            if (formWrapper) formWrapper.style.display = 'none';
                            if (loadingDiv) loadingDiv.style.display = 'none';
                            
                            // Show error
                            const errorDiv = document.getElementById('referral-error');
                            if (errorDiv) {
                                errorDiv.style.display = 'block';
                                document.getElementById('error-message-text').textContent = 
                                    'Network error. Please try again or contact support.';
                            }
                        });
                }
                
                // Helper function to show success message
                function showSuccessMessage(data) {
                    const successDiv = document.getElementById('referral-success');
                    if (successDiv) {
                        console.log('✅ Showing success message');
                        successDiv.style.display = 'block';
                        
                        const linkInput = document.getElementById('generated-link');
                        const codeDisplay = document.getElementById('referral-code-display');
                        
                        if (linkInput) linkInput.value = data.referral_link;
                        if (codeDisplay) codeDisplay.textContent = data.referral_code;
                        
                        const emailBody = encodeURIComponent(
                            `I thought you might be interested in Smart Grant Solutions for your grant management needs. ` +
                            `Check them out here: ${data.referral_link}`
                        );
                        const emailBtn = document.getElementById('share-email-btn');
                        if (emailBtn) {
                            emailBtn.href = `mailto:?subject=Check out Smart Grant Solutions&body=${emailBody}`;
                        }
                        
                        successDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                }
            </script>

        </div>
        <!-- End of referral-signup-form-wrapper -->

        <!-- Success Message (hidden initially) -->
        <div id="referral-success" class="referral-success-message" style="display: none;">
            <div class="success-icon">✅</div>
            <h3 class="success-title">Your Referral Link is Ready!</h3>
            <p class="success-subtitle">Share this link to start earning rewards:</p>
            
            <div class="referral-link-box">
                <input type="text" 
                       id="generated-link" 
                       readonly 
                       class="referral-link-input">
                <button type="button" 
                        id="copy-link-btn" 
                        class="btn-copy">
                    <span class="copy-text">Copy Link</span>
                    <span class="copied-text" style="display: none;">✓ Copied!</span>
                </button>
            </div>

            <div class="success-details">
                <p><strong>Your Referral Code:</strong> <code id="referral-code-display"></code></p>
                <p><strong>What's Next?</strong></p>
                <ul>
                    <li>Share your link via email, social media, or direct messages</li>
                    <li>When someone clicks your link, they're tracked for 30 days</li>
                    <li>You'll receive email notifications when referrals convert</li>
                    <li>Track your referrals in your dashboard (link sent to your email)</li>
                </ul>
            </div>

            <div class="success-actions">
                <button type="button" 
                        id="create-another" 
                        class="btn-secondary">
                    Create Another Link
                </button>
                <a href="mailto:?subject=Check out Smart Grant Solutions&body=I thought you might be interested in Smart Grant Solutions for your grant management needs. Check them out here: [LINK]" 
                   class="btn-secondary"
                   id="share-email-btn">
                    Share via Email
                </a>
            </div>
        </div>

        <!-- Error Message (hidden initially) -->
        <div id="referral-error" class="referral-error-message" style="display: none;">
            <div class="error-icon">❌</div>
            <h3 class="error-title">Something went wrong</h3>
            <p id="error-message-text" class="error-text"></p>
            <button type="button" id="try-again-btn" class="btn-secondary">
                Try Again
            </button>
        </div>

        <!-- Existing Referrers Section -->
        <div class="existing-referrer-section">
            <p class="existing-referrer-text">
                Already have a referral account? 
                <a href="#" id="login-referrer-link">Access your dashboard</a>
            </p>
        </div>

    </div>
</section>

<style>
.referral-signup-section {
    padding: 80px 20px;
    background: #000000;
    position: relative;
}

.referral-signup-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(255, 176, 63, 0.05) 0%, rgba(0, 0, 0, 0) 50%);
    pointer-events: none;
}

.referral-signup-container {
    max-width: 700px;
    margin: 0 auto;
    position: relative;
    z-index: 1;
}

.referral-signup-header {
    text-align: center;
    margin-bottom: 50px;
}

.signup-title {
    font-family: 'DM Sans', sans-serif;
    font-size: 48px;
    font-weight: 700;
    color: #ffffff;
    margin-bottom: 20px;
    line-height: 1.2;
}

.signup-subtitle {
    font-family: 'Inter', sans-serif;
    font-size: 18px;
    color: rgba(255, 255, 255, 0.8);
    line-height: 1.6;
    max-width: 600px;
    margin: 0 auto;
}

.referral-signup-form-wrapper {
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 16px;
    padding: 50px;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
}

/* Hide HubSpot's default inline message since we handle success ourselves */
#hubspot-referral-form .submitted-message {
    display: none !important;
}

/* HubSpot Form Styling */
#hubspot-referral-form .hs-form {
    font-family: 'Inter', sans-serif;
}

#hubspot-referral-form .hs-form-field {
    margin-bottom: 25px;
}

#hubspot-referral-form .hs-form-field label {
    display: block;
    font-weight: 600;
    color: #ffffff;
    margin-bottom: 8px;
    font-size: 14px;
    font-family: 'Inter', sans-serif;
}

#hubspot-referral-form .hs-input {
    width: 100% !important;
    padding: 14px 18px !important;
    background: rgba(255, 255, 255, 0.08) !important;
    border: 1px solid rgba(255, 255, 255, 0.2) !important;
    border-radius: 8px !important;
    color: #ffffff !important;
    font-size: 16px !important;
    font-family: 'Inter', sans-serif !important;
    transition: all 0.3s ease !important;
}

#hubspot-referral-form .hs-input:focus {
    outline: none !important;
    border-color: #FFB03F !important;
    background: rgba(255, 255, 255, 0.12) !important;
    box-shadow: 0 0 0 3px rgba(255, 176, 63, 0.1) !important;
}

#hubspot-referral-form .hs-input::placeholder {
    color: rgba(255, 255, 255, 0.4) !important;
}

#hubspot-referral-form .hs-form-booleancheckbox-display {
    display: flex;
    align-items: flex-start;
    gap: 12px;
}

#hubspot-referral-form .hs-form-booleancheckbox-display input {
    margin-top: 3px;
    width: 18px;
    height: 18px;
    cursor: pointer;
    accent-color: #FFB03F;
}

#hubspot-referral-form .hs-form-booleancheckbox-display span {
    color: rgba(255, 255, 255, 0.8);
    font-size: 14px;
    line-height: 1.5;
}

#hubspot-referral-form .hs-form-booleancheckbox-display a {
    color: #FFB03F;
    text-decoration: none;
}

#hubspot-referral-form .hs-form-booleancheckbox-display a:hover {
    text-decoration: underline;
}

#hubspot-referral-form .hs-error-msgs {
    list-style: none;
    padding: 0;
    margin: 8px 0 0 0;
}

#hubspot-referral-form .hs-error-msg {
    color: #ff6b6b;
    font-size: 13px;
    margin-top: 5px;
}

#hubspot-referral-form .hs-richtext {
    color: rgba(255, 255, 255, 0.6);
    font-size: 13px;
    margin-top: 5px;
}

#hubspot-referral-form .hs-button {
    width: 100% !important;
    padding: 18px 40px !important;
    background: #FFB03F !important;
    color: #000000 !important;
    border: none !important;
    border-radius: 8px !important;
    font-size: 16px !important;
    font-weight: 600 !important;
    font-family: 'Inter', sans-serif !important;
    cursor: pointer !important;
    transition: all 0.3s ease !important;
    text-transform: uppercase !important;
    letter-spacing: 0.5px !important;
    margin-top: 10px !important;
}

#hubspot-referral-form .hs-button:hover {
    background: #F5A635 !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 6px 20px rgba(255, 176, 63, 0.4) !important;
}

#hubspot-referral-form .hs-button:disabled {
    background: rgba(255, 255, 255, 0.2) !important;
    cursor: not-allowed !important;
    transform: none !important;
}

.btn-loading svg {
    animation: spin 1s linear infinite;
}

@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

.referral-success-message,
.referral-error-message {
    text-align: center;
    padding: 50px;
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 16px;
}

.success-icon,
.error-icon {
    font-size: 64px;
    margin-bottom: 20px;
}

.success-title,
.error-title {
    font-family: 'DM Sans', sans-serif;
    font-size: 32px;
    font-weight: 700;
    color: #ffffff;
    margin-bottom: 15px;
}

.success-subtitle {
    font-size: 16px;
    color: rgba(255, 255, 255, 0.8);
    margin-bottom: 30px;
}

.error-text {
    color: rgba(255, 255, 255, 0.8);
    font-size: 16px;
    margin: 20px 0;
}

.referral-link-box {
    display: flex;
    gap: 12px;
    margin: 30px 0;
    padding: 20px;
    background: rgba(0, 0, 0, 0.3);
    border: 1px solid rgba(255, 176, 63, 0.3);
    border-radius: 12px;
}

.referral-link-input {
    flex: 1;
    padding: 14px 18px;
    background: rgba(255, 255, 255, 0.08);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 8px;
    color: #FFB03F;
    font-family: 'Courier New', monospace;
    font-size: 14px;
    font-weight: 600;
}

.btn-copy {
    padding: 14px 28px;
    background: #FFB03F;
    color: #000000;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    font-family: 'Inter', sans-serif;
    cursor: pointer;
    transition: all 0.3s;
    text-transform: uppercase;
    font-size: 14px;
    letter-spacing: 0.5px;
}

.btn-copy:hover {
    background: #F5A635;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(255, 176, 63, 0.4);
}

.success-details {
    text-align: left;
    background: rgba(255, 176, 63, 0.1);
    padding: 20px;
    border-radius: 8px;
    margin: 20px 0;
}

.success-details p,
.success-details strong {
    color: rgba(255, 255, 255, 0.9);
}

.success-details code {
    background: rgba(0, 0, 0, 0.3);
    padding: 4px 10px;
    border-radius: 6px;
    font-weight: 600;
    color: #FFB03F;
    border: 1px solid rgba(255, 176, 63, 0.3);
}

.success-details ul {
    margin: 15px 0 0 20px;
    color: rgba(255, 255, 255, 0.8);
}

.success-details li {
    margin: 8px 0;
    line-height: 1.6;
}

.success-actions {
    display: flex;
    gap: 15px;
    justify-content: center;
    margin-top: 30px;
    flex-wrap: wrap;
}

.btn-secondary {
    padding: 14px 28px;
    background: transparent;
    color: #ffffff;
    border: 2px solid rgba(255, 255, 255, 0.3);
    border-radius: 8px;
    font-weight: 600;
    font-family: 'Inter', sans-serif;
    cursor: pointer;
    text-decoration: none;
    transition: all 0.3s;
    display: inline-block;
}

.btn-secondary:hover {
    border-color: #FFB03F;
    background: rgba(255, 176, 63, 0.1);
    color: #FFB03F;
    transform: translateY(-2px);
}

.existing-referrer-section {
    text-align: center;
    margin-top: 40px;
    padding: 25px;
}

.existing-referrer-text {
    color: rgba(255, 255, 255, 0.6);
    font-size: 14px;
}

.existing-referrer-text a {
    color: #FFB03F;
    text-decoration: none;
    font-weight: 600;
    transition: color 0.3s;
}

.existing-referrer-text a:hover {
    color: #F5A635;
    text-decoration: underline;
}

@media (max-width: 768px) {
    .signup-title {
        font-size: 36px;
    }
    
    .signup-subtitle {
        font-size: 16px;
    }
    
    .referral-signup-form-wrapper {
        padding: 30px 20px;
    }
    
    .success-actions {
        flex-direction: column;
    }
    
    .referral-link-box {
        flex-direction: column;
    }
    
    .btn-copy,
    .btn-secondary {
        width: 100%;
        text-align: center;
    }
    
    .referral-success-message,
    .referral-error-message {
        padding: 30px 20px;
    }
    
    .success-title,
    .error-title {
        font-size: 24px;
    }
}
</style>

<script>
// Copy link button functionality
document.addEventListener('DOMContentLoaded', function() {
    const copyBtn = document.getElementById('copy-link-btn');
    if (copyBtn) {
        copyBtn.addEventListener('click', function() {
            const linkInput = document.getElementById('generated-link');
            if (linkInput) {
                // Select and copy the text
                linkInput.select();
                linkInput.setSelectionRange(0, 99999); // For mobile
                
                // Copy to clipboard
                navigator.clipboard.writeText(linkInput.value).then(function() {
                    // Show success feedback
                    const copyText = copyBtn.querySelector('.copy-text');
                    const copiedText = copyBtn.querySelector('.copied-text');
                    
                    if (copyText && copiedText) {
                        copyText.style.display = 'none';
                        copiedText.style.display = 'inline';
                        
                        // Reset after 2 seconds
                        setTimeout(function() {
                            copyText.style.display = 'inline';
                            copiedText.style.display = 'none';
                        }, 2000);
                    }
                }).catch(function(err) {
                    console.error('Failed to copy:', err);
                    // Fallback for older browsers
                    document.execCommand('copy');
                });
            }
        });
    }
    
    // "Create Another Link" button
    const createAnotherBtn = document.getElementById('create-another');
    if (createAnotherBtn) {
        createAnotherBtn.addEventListener('click', function() {
            location.reload();
        });
    }
    
    // "Try Again" button
    const tryAgainBtn = document.getElementById('try-again-btn');
    if (tryAgainBtn) {
        tryAgainBtn.addEventListener('click', function() {
            location.reload();
        });
    }
});
</script>
