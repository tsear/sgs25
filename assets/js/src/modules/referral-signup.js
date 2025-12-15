/**
 * Referral Signup Form Handler
 * Handles self-service referral link generation
 */

export function initReferralSignupForm() {
    const form = document.getElementById('referral-signup-form');
    if (!form) return;
    
    console.log('Referral signup form initialized');
    
    const formWrapper = form.closest('.referral-signup-form-wrapper');
    const successMessage = document.getElementById('referral-success');
    const errorMessage = document.getElementById('referral-error');
    
    // Form submission
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        
        const submitBtn = form.querySelector('.btn-submit');
        const btnText = submitBtn.querySelector('.btn-text');
        const btnLoading = submitBtn.querySelector('.btn-loading');
        
        // Show loading state
        submitBtn.disabled = true;
        btnText.style.display = 'none';
        btnLoading.style.display = 'inline-flex';
        
        // Collect form data
        const formData = new FormData(form);
        formData.append('action', 'sgs_referral_signup');
        formData.append('nonce', sgsData.nonce);
        formData.append('first_name', form.querySelector('#referrer_first_name').value);
        formData.append('last_name', form.querySelector('#referrer_last_name').value);
        formData.append('email', form.querySelector('#referrer_email').value);
        formData.append('organization', form.querySelector('#referrer_organization').value);
        formData.append('custom_code', form.querySelector('#custom_code').value);
        
        try {
            const response = await fetch(sgsData.ajaxUrl, {
                method: 'POST',
                body: formData
            });
            
            const result = await response.json();
            
            if (result.success) {
                // Show success message
                form.style.display = 'none';
                successMessage.style.display = 'block';
                
                // Populate success message
                document.getElementById('generated-link').value = result.data.referral_link;
                document.getElementById('referral-code-display').textContent = result.data.referral_code;
                
                // Update email share button
                const emailBtn = document.getElementById('share-email-btn');
                const emailBody = encodeURIComponent(
                    `I thought you might be interested in Smart Grant Solutions for your grant management needs. ` +
                    `They have an excellent system for managing compliance and financial reporting. ` +
                    `Check them out here: ${result.data.referral_link}`
                );
                emailBtn.href = `mailto:?subject=Check out Smart Grant Solutions&body=${emailBody}`;
                
                // Scroll to success message
                successMessage.scrollIntoView({ behavior: 'smooth', block: 'center' });
                
            } else {
                // Show error message
                form.style.display = 'none';
                errorMessage.style.display = 'block';
                document.getElementById('error-message-text').textContent = 
                    result.data.message || 'Something went wrong. Please try again.';
            }
            
        } catch (error) {
            console.error('Referral signup error:', error);
            form.style.display = 'none';
            errorMessage.style.display = 'block';
            document.getElementById('error-message-text').textContent = 
                'Network error. Please check your connection and try again.';
        } finally {
            // Reset button state
            submitBtn.disabled = false;
            btnText.style.display = 'inline';
            btnLoading.style.display = 'none';
        }
    });
    
    // Copy link button
    const copyBtn = document.getElementById('copy-link-btn');
    if (copyBtn) {
        copyBtn.addEventListener('click', () => {
            const linkInput = document.getElementById('generated-link');
            linkInput.select();
            document.execCommand('copy');
            
            // Show copied feedback
            const copyText = copyBtn.querySelector('.copy-text');
            const copiedText = copyBtn.querySelector('.copied-text');
            copyText.style.display = 'none';
            copiedText.style.display = 'inline';
            
            setTimeout(() => {
                copyText.style.display = 'inline';
                copiedText.style.display = 'none';
            }, 2000);
        });
    }
    
    // Create another link button
    const createAnotherBtn = document.getElementById('create-another');
    if (createAnotherBtn) {
        createAnotherBtn.addEventListener('click', () => {
            form.reset();
            form.style.display = 'block';
            successMessage.style.display = 'none';
            errorMessage.style.display = 'none';
            form.scrollIntoView({ behavior: 'smooth', block: 'center' });
        });
    }
    
    // Try again button
    const tryAgainBtn = document.getElementById('try-again-btn');
    if (tryAgainBtn) {
        tryAgainBtn.addEventListener('click', () => {
            form.style.display = 'block';
            successMessage.style.display = 'none';
            errorMessage.style.display = 'none';
            form.scrollIntoView({ behavior: 'smooth', block: 'center' });
        });
    }
    
    // Login link (placeholder - you can implement this later)
    const loginLink = document.getElementById('login-referrer-link');
    if (loginLink) {
        loginLink.addEventListener('click', (e) => {
            e.preventDefault();
            alert('Referral dashboard coming soon! Check your email for your referral link.');
        });
    }
}
