/**
 * Rocket Animation - Scroll-triggered rocket movement across page breaker
 * Mobile-optimized: Only runs on desktop devices for performance
 */

class RocketAnimation {
    constructor() {
        // Mobile detection - skip animation on mobile devices
        this.isMobile = this.detectMobile();
        
        // Check if video-features section has mobile-optimized class
        this.videoSection = document.querySelector('.video-features-section');
        this.isMobileOptimized = this.videoSection && this.videoSection.classList.contains('mobile-optimized');
        
        // Skip initialization on mobile or mobile-optimized sections
        if (this.isMobile || this.isMobileOptimized) {
            console.log('Rocket animation skipped for mobile optimization');
            return;
        }
        
        this.rocketSection = document.querySelector('[data-rocket-section]');
        this.rocketElement = document.querySelector('[data-rocket-element]');
        
        if (!this.rocketSection || !this.rocketElement) {
            return;
        }
        
        this.init();
    }
    
    detectMobile() {
        return window.innerWidth <= 768 || 
               /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
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

// Initialize when DOM is ready - only if elements exist
document.addEventListener('DOMContentLoaded', () => {
    const rocketSection = document.querySelector('.rocket-section');
    const rocketElement = document.querySelector('.rocket');
    
    if (rocketSection && rocketElement) {
        new RocketAnimation();
    }
});

export default RocketAnimation;
