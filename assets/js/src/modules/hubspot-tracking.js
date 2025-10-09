/**
 * HubSpot Form Tracking
 * Sends form submissions to HubSpot Forms API
 */

class HubSpotTracking {
    constructor() {
        this.portalId = '44675524';
        this.newsletterFormId = '32a6e78d-b7b9-4e1d-82fb-31693b40260a';
        
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
        
        newsletterForms.forEach(form => {
            form.addEventListener('submit', (e) => {
                this.handleNewsletterSubmission(e, form);
            });
        });
    }

    handleNewsletterSubmission(e, form) {
        const emailInput = form.querySelector('input[type="email"], input[name="email"]');
        
        if (emailInput && emailInput.value) {
            // Send to HubSpot
            this.submitToHubSpot(this.newsletterFormId, {
                email: emailInput.value
            });
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
        }).catch(error => {
            console.warn('HubSpot submission failed:', error);
        });
    }
}

// Initialize
const hubspotTracking = new HubSpotTracking();

export default HubSpotTracking;
