/**
 * Contact Page Module
 * Handles contact page interactions and form enhancements
 */

export default class ContactPage {
    constructor() {
        this.form = null;
        this.submitButton = null;
        this.messageContainer = null;
        this.init();
    }

    init() {
        this.bindSmoothScroll();
        this.enhanceHubSpotForm();
        this.setupFormValidation();
        this.createMessageContainer();
    }

    /**
     * Smooth scroll to form functionality
     */
    bindSmoothScroll() {
        const scrollButton = document.querySelector('.scroll-to-form');
        if (scrollButton) {
            scrollButton.addEventListener('click', (e) => {
                e.preventDefault();
                const form = document.querySelector('.contact-form-section') || document.querySelector('.contact-form');
                if (form) {
                    form.scrollIntoView({ 
                        behavior: 'smooth',
                        block: 'start'
                    });
                    
                    // Focus first form input for accessibility
                    setTimeout(() => {
                        const firstInput = form.querySelector('input[type="text"], input[type="email"]');
                        if (firstInput) {
                            firstInput.focus();
                        }
                    }, 800);
                }
            });
        }
    }

    /**
     * Enhance HubSpot form with additional functionality
     */
    enhanceHubSpotForm() {
        // Wait for HubSpot form to load
        const checkFormLoaded = () => {
            const hubspotForm = document.querySelector('#hubspot-form-contact .hs-form');
            if (hubspotForm) {
                this.form = hubspotForm;
                this.submitButton = hubspotForm.querySelector('input[type="submit"]');
                this.addFormEnhancements();
                return true;
            }
            return false;
        };

        // Retry mechanism for HubSpot form loading
        let attempts = 0;
        const maxAttempts = 20;
        const checkInterval = setInterval(() => {
            attempts++;
            if (checkFormLoaded() || attempts >= maxAttempts) {
                clearInterval(checkInterval);
                if (attempts >= maxAttempts) {
                    console.log('HubSpot form failed to load, using fallback');
                    this.initFallbackForm();
                }
            }
        }, 200);
    }

    /**
     * Add enhancements to the loaded HubSpot form
     */
    addFormEnhancements() {
        if (!this.form) return;

        // Add loading state capability
        this.form.addEventListener('submit', () => {
            this.showLoadingState();
        });

        // Add real-time validation
        const inputs = this.form.querySelectorAll('input, textarea');
        inputs.forEach(input => {
            input.addEventListener('blur', (e) => {
                this.validateField(e.target);
            });
        });

        // Enhance accessibility
        this.enhanceAccessibility();
    }

    /**
     * Client-side form validation
     */
    setupFormValidation() {
        // This will be called for both HubSpot and fallback forms
        document.addEventListener('input', (e) => {
            if (e.target.closest('.contact-form-section') || e.target.closest('#hubspot-form-contact')) {
                this.validateField(e.target);
            }
        });
    }

    /**
     * Validate individual form field
     */
    validateField(field) {
        const fieldContainer = field.closest('.hs-form-field') || field.parentElement;
        const fieldType = field.type || 'text';
        const value = field.value.trim();
        let isValid = true;
        let errorMessage = '';

        // Remove existing error styling
        this.clearFieldError(fieldContainer);

        // Required field validation
        if (field.hasAttribute('required') && !value) {
            isValid = false;
            errorMessage = 'This field is required.';
        }

        // Email validation
        if (fieldType === 'email' && value) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(value)) {
                isValid = false;
                errorMessage = 'Please enter a valid email address.';
            }
        }

        // Phone validation (if present)
        if (fieldType === 'tel' && value) {
            const phoneRegex = /^[\+]?[\d\s\-\(\)]{10,}$/;
            if (!phoneRegex.test(value)) {
                isValid = false;
                errorMessage = 'Please enter a valid phone number.';
            }
        }

        // Apply validation styling
        if (!isValid) {
            this.showFieldError(fieldContainer, errorMessage);
        }

        return isValid;
    }

    /**
     * Show field error state
     */
    showFieldError(fieldContainer, message) {
        fieldContainer.classList.add('hs-form-field--error');
        
        // Create or update error message
        let errorElement = fieldContainer.querySelector('.field-error-message');
        if (!errorElement) {
            errorElement = document.createElement('div');
            errorElement.className = 'field-error-message';
            errorElement.setAttribute('role', 'alert');
            fieldContainer.appendChild(errorElement);
        }
        errorElement.textContent = message;
    }

    /**
     * Clear field error state
     */
    clearFieldError(fieldContainer) {
        fieldContainer.classList.remove('hs-form-field--error');
        const errorElement = fieldContainer.querySelector('.field-error-message');
        if (errorElement) {
            errorElement.remove();
        }
    }

    /**
     * Show loading state during form submission
     */
    showLoadingState() {
        if (this.submitButton) {
            this.submitButton.disabled = true;
            this.submitButton.style.opacity = '0.7';
            this.submitButton.value = 'Sending...';
        }

        this.showMessage('Sending your message...', 'loading');
    }

    /**
     * Create message container for form feedback
     */
    createMessageContainer() {
        if (document.querySelector('.form-message-container')) return;

        const container = document.createElement('div');
        container.className = 'form-message-container';
        container.setAttribute('role', 'status');
        container.setAttribute('aria-live', 'polite');
        
        const formSection = document.querySelector('.contact-form-section');
        if (formSection) {
            formSection.insertBefore(container, formSection.firstChild);
            this.messageContainer = container;
        }
    }

    /**
     * Show form messages (success, error, loading)
     */
    showMessage(message, type = 'info') {
        if (!this.messageContainer) {
            this.createMessageContainer();
        }

        this.messageContainer.innerHTML = `
            <div class="form-message form-message--${type}">
                <span class="form-message__text">${message}</span>
            </div>
        `;

        // Auto-hide info/loading messages after 5 seconds
        if (type === 'loading' || type === 'info') {
            setTimeout(() => {
                if (this.messageContainer) {
                    this.messageContainer.innerHTML = '';
                }
            }, 5000);
        }
    }

    /**
     * Enhance accessibility features
     */
    enhanceAccessibility() {
        if (!this.form) return;

        // Add proper labels and ARIA attributes
        const inputs = this.form.querySelectorAll('input, textarea, select');
        inputs.forEach(input => {
            const label = this.form.querySelector(`label[for="${input.id}"]`);
            if (label) {
                // Ensure proper association
                input.setAttribute('aria-describedby', `${input.id}-help`);
                
                // Add required indicator to label
                if (input.hasAttribute('required')) {
                    label.classList.add('required');
                    if (!label.querySelector('.required-indicator')) {
                        const indicator = document.createElement('span');
                        indicator.className = 'required-indicator';
                        indicator.textContent = '*';
                        indicator.setAttribute('aria-label', 'required');
                        label.appendChild(indicator);
                    }
                }
            }
        });

        // Add form aria-label
        this.form.setAttribute('aria-label', 'Contact form');
    }

    /**
     * Fallback form initialization (if HubSpot fails)
     */
    initFallbackForm() {
        console.log('Initializing fallback contact form');
        
        const fallbackForm = document.querySelector('#fallback-contact-form');
        if (fallbackForm) {
            fallbackForm.style.display = 'block';
            this.form = fallbackForm;
            this.submitButton = fallbackForm.querySelector('button[type="submit"]');
            
            // Add form submission handler
            fallbackForm.addEventListener('submit', (e) => {
                e.preventDefault();
                this.handleFallbackFormSubmission(fallbackForm);
            });
            
            // Add real-time validation
            const inputs = fallbackForm.querySelectorAll('input, textarea');
            inputs.forEach(input => {
                input.addEventListener('blur', (e) => {
                    this.validateField(e.target);
                });
            });
        }
    }
    
    /**
     * Handle fallback form submission via AJAX
     */
    handleFallbackFormSubmission(form) {
        // Validate form before submission
        const inputs = form.querySelectorAll('input[required], textarea[required]');
        let isValid = true;
        
        inputs.forEach(input => {
            if (!this.validateField(input)) {
                isValid = false;
            }
        });
        
        // Check reCAPTCHA
        const recaptchaResponse = grecaptcha?.getResponse();
        if (!recaptchaResponse) {
            this.showMessage('Please complete the reCAPTCHA verification.', 'error');
            return;
        }
        
        if (!isValid) {
            this.showMessage('Please correct the errors above and try again.', 'error');
            return;
        }
        
        // Show loading state
        this.showLoadingState();
        
        // Prepare form data
        const formData = new FormData(form);
        formData.append('g-recaptcha-response', recaptchaResponse);
        
        // Submit via AJAX
        fetch(form.action, {
            method: 'POST',
            body: formData,
            credentials: 'same-origin'
        })
        .then(response => response.json())
        .then(data => {
            this.hideLoadingState();
            
            if (data.success) {
                this.showMessage(data.data.message, 'success');
                form.reset();
                grecaptcha?.reset();
            } else {
                this.showMessage(data.data.message || 'An error occurred. Please try again.', 'error');
                grecaptcha?.reset();
            }
        })
        .catch(error => {
            this.hideLoadingState();
            console.error('Form submission error:', error);
            this.showMessage('Network error. Please check your connection and try again.', 'error');
            grecaptcha?.reset();
        });
    }
    
    /**
     * Hide loading state
     */
    hideLoadingState() {
        if (this.submitButton) {
            this.submitButton.disabled = false;
            this.submitButton.style.opacity = '1';
            
            // Restore original button text
            if (this.submitButton.tagName === 'INPUT') {
                this.submitButton.value = 'Send Message';
            } else {
                this.submitButton.textContent = 'Send Message';
            }
        }
    }
}