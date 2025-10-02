/**
 * Value Proposition Animations
 * Handles staggered fade-in-up animations for the three columns
 */

class ValuePropAnimations {
    constructor() {
        this.columns = document.querySelectorAll('.fade-column');
        this.observer = null;
        this.init();
    }

    init() {
        if (this.columns.length === 0) return;
        
        // Set up intersection observer to trigger animations when section comes into view
        this.setupIntersectionObserver();
    }

    setupIntersectionObserver() {
        const options = {
            threshold: 0.3, // Trigger when 30% of the section is visible
            rootMargin: '0px 0px -100px 0px' // Start animation slightly before fully in view
        };

        this.observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    this.animateColumns();
                    // Disconnect observer after animation starts (run only once)
                    this.observer.disconnect();
                }
            });
        }, options);

        // Observe the value proposition section
        const valueProvSection = document.querySelector('#value-proposition');
        if (valueProvSection) {
            this.observer.observe(valueProvSection);
        }
    }

    animateColumns() {
        this.columns.forEach((column, index) => {
            const delay = parseInt(column.dataset.delay) || index;
            
            setTimeout(() => {
                // Add the appropriate delay class and animate-in class
                if (delay === 1) {
                    column.classList.add('delay-1');
                } else if (delay === 2) {
                    column.classList.add('delay-2');
                }
                
                column.classList.add('animate-in');
            }, delay * 300); // Base delay of 300ms between each column
        });
    }
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    new ValuePropAnimations();
});

export default ValuePropAnimations;
