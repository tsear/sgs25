/**
 * Rocket Animation - Scroll-triggered rocket movement across page breaker
 */

class RocketAnimation {
    constructor() {
        this.rocketSection = document.querySelector('[data-rocket-section]');
        this.rocketElement = document.querySelector('[data-rocket-element]');
        
        if (!this.rocketSection || !this.rocketElement) {
            return;
        }
        
        this.init();
    }
    
    init() {
        // Add scroll listener with throttling for performance
        let ticking = false;
        
        const updateRocket = () => {
            this.updateRocketPosition();
            ticking = false;
        };
        
        const handleScroll = () => {
            if (!ticking) {
                requestAnimationFrame(updateRocket);
                ticking = true;
            }
        };
        
        window.addEventListener('scroll', handleScroll, { passive: true });
        
        // Initial position
        this.updateRocketPosition();
    }
    
    updateRocketPosition() {
        const rect = this.rocketSection.getBoundingClientRect();
        const windowHeight = window.innerHeight;
        const sectionTop = rect.top;
        const sectionBottom = rect.bottom;
        
        // Check if section is in viewport
        if (sectionBottom < 0 || sectionTop > windowHeight) {
            return;
        }
        
        // Calculate progress through the section (0 = top enters viewport, 1 = bottom leaves viewport)
        const totalDistance = windowHeight + rect.height;
        const progress = Math.max(0, Math.min(1, (windowHeight - sectionTop) / totalDistance));
        
        // Calculate rocket position
        const containerWidth = this.rocketSection.offsetWidth - 120; // Account for rocket width and padding
        const rocketPosition = progress * containerWidth;
        
        // Apply transform (no rotation)
        this.rocketElement.style.transform = `translateY(-50%) translateX(${rocketPosition}px)`;
    }
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    new RocketAnimation();
});

export default RocketAnimation;
