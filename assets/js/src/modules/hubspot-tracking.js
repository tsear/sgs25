/**
 * HubSpot Form Tracking
 * Sends form submissions to HubSpot Forms API
 */

class HubSpotTracking {
    constructor() {
        // Get configuration from WordPress theme options
        const config = window.sgsHubSpotConfig || {};
        
        this.portalId = config.portalId || '44675524';
        this.forms = config.forms || {};
        this.newsletterFormId = this.forms.newsletter || '32a6e78d-b7b9-4e1d-82fb-31693b40260a';
        
        console.log('HubSpot tracking initialized with Portal ID:', this.portalId);
        console.log('Newsletter Form ID:', this.newsletterFormId);
        
        this.init();
    }

    init() {
        // Wait for DOM and HubSpot to be ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => this.bindForms());
        } else {
            this.bindForms();
        }
    }

    bindForms() {
        // Find newsletter forms - covers both component (.newsletter-form__form) and footer (.newsletter-form)
        const newsletterForms = document.querySelectorAll('.newsletter-form__form, .newsletter-form');
        
        console.log('HubSpot tracking: Found', newsletterForms.length, 'newsletter forms'); // Debug log
        
        newsletterForms.forEach((form, index) => {
            console.log('HubSpot tracking: Binding form', index + 1, form); // Debug log
            form.addEventListener('submit', (e) => {
                this.handleNewsletterSubmission(e, form);
            });
        });
    }

    handleNewsletterSubmission(e, form) {
        e.preventDefault(); // Prevent default form submission
        
        const emailInput = form.querySelector('input[type="email"], input[name="email"]');
        
        if (emailInput && emailInput.value) {
            console.log('HubSpot tracking: Submitting email:', emailInput.value); // Debug log
            
            // Send to HubSpot
            this.submitToHubSpot(this.newsletterFormId, {
                email: emailInput.value
            });
            
            // Show success message
            const messageElement = form.querySelector('.newsletter-form__message');
            if (messageElement) {
                messageElement.textContent = 'Thank you for subscribing!';
                messageElement.style.color = 'green';
            }
            
            // Clear form
            emailInput.value = '';
        }
    }

    submitToHubSpot(formId, data) {
        const fields = Object.entries(data).map(([name, value]) => ({
            name: name,
            value: value
        }));

        const submitData = {
            fields: fields,
            context: {
                pageUri: window.location.href,
                pageName: document.title
            }
        };

        fetch(`https://api.hsforms.com/submissions/v3/integration/submit/${this.portalId}/${formId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(submitData)
        })
        .then(response => {
            console.log('HubSpot submission response:', response.status);
            return response.json();
        })
        .then(data => {
            console.log('HubSpot submission success:', data);
        })
        .catch(error => {
            console.warn('HubSpot submission failed:', error);
        });
    }
}

// Initialize
const hubspotTracking = new HubSpotTracking();

export default HubSpotTracking;
