/**
 * Tilda Pink Spotlight Animation System
 * Recreates the exact pink moving spotlight animations from smartgrantsolutions.com
 */

// Pink Spotlight Animation Data (from Tilda export)
const PINK_SPOTLIGHT_ANIMATIONS = {
    'spotlight-1': {
        opts: '[{"opacity":"0","y":"0px","color":"rgba(255,176,63,0.8)"},{"opacity":"0.3","y":"0px","color":"rgba(255,176,63,0.8)","delay":"200"},{"opacity":"1","y":"0px","color":"rgba(216,18,89,0.9)","delay":"600"},{"opacity":"0.7","y":"0px","color":"rgba(255,176,63,0.6)","delay":"1000"}]',
        event: 'blockintoview',
        duration: 800,
        delay: 0
    },
    'spotlight-2': {
        opts: '[{"x":"0px","opacity":"0","color":"rgba(216,18,89,0.7)"},{"x":"20px","opacity":"0.5","color":"rgba(216,18,89,0.8)","delay":"300"},{"x":"40px","opacity":"1","color":"rgba(255,176,63,0.9)","delay":"700"},{"x":"0px","opacity":"0.4","color":"rgba(216,18,89,0.6)","delay":"1200"}]',
        event: 'blockintoview',
        duration: 1000,
        delay: 200
    }
};

// Mouse Parallax Effects
const MOUSE_PARALLAX_CONFIG = {
    intensity: 0.3,
    reverse: false,
    elements: '.spotlight-element'
};

// Animation Controller
class TildaAnimationController {
    constructor() {
        this.animations = new Map();
        this.parallaxElements = [];
        this.mouseX = 0;
        this.mouseY = 0;
        
        this.init();
    }
    
    init() {
        this.setupParallax();
        this.setupSpotlightAnimations();
        this.bindEvents();
    }
    
    setupParallax() {
        // Mouse parallax initialization
        document.addEventListener('mousemove', (e) => {
            this.mouseX = (e.clientX / window.innerWidth) * 2 - 1;
            this.mouseY = (e.clientY / window.innerHeight) * 2 - 1;
            this.updateParallax();
        });
        
        // Find all parallax elements
        this.parallaxElements = document.querySelectorAll('[data-animate-prx="mouse"]');
    }
    
    updateParallax() {
        this.parallaxElements.forEach(element => {
            const intensity = parseFloat(element.dataset.animatePrxIntensity) || MOUSE_PARALLAX_CONFIG.intensity;
            const reverse = element.dataset.animatePrxReverse === 'true';
            
            const moveX = this.mouseX * intensity * (reverse ? -20 : 20);
            const moveY = this.mouseY * intensity * (reverse ? -20 : 20);
            
            element.style.transform = `translate(${moveX}px, ${moveY}px)`;
        });
    }
    
    setupSpotlightAnimations() {
        // Create pink spotlight elements
        this.createSpotlightElements();
        
        // Setup intersection observer for scroll-triggered animations
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    this.triggerAnimation(entry.target);
                }
            });
        }, { threshold: 0.1 });
        
        // Observe elements with spotlight animations
        document.querySelectorAll('[data-animate-sbs-event="blockintoview"]').forEach(el => {
            observer.observe(el);
        });
    }
    
    createSpotlightElements() {
        // Hero section pink spotlight
        const heroSpotlight = document.createElement('div');
        heroSpotlight.className = 'pink-spotlight hero-spotlight';
        heroSpotlight.setAttribute('data-animate-sbs-event', 'blockintoview');
        heroSpotlight.setAttribute('data-animate-sbs-opts', PINK_SPOTLIGHT_ANIMATIONS['spotlight-1'].opts);
        heroSpotlight.setAttribute('data-animate-prx', 'mouse');
        heroSpotlight.style.cssText = `
            position: absolute;
            top: 20%;
            left: 70%;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(216,18,89,0.8) 0%, rgba(255,176,63,0.4) 50%, transparent 70%);
            border-radius: 50%;
            filter: blur(20px);
            opacity: 0;
            z-index: 5;
            pointer-events: none;
        `;
        
        const heroSection = document.querySelector('.hero-section, .hero-container, #hero');
        if (heroSection) {
            heroSection.style.position = 'relative';
            heroSection.appendChild(heroSpotlight);
        }
        
        // Secondary moving spotlight
        const secondarySpotlight = document.createElement('div');
        secondarySpotlight.className = 'pink-spotlight secondary-spotlight';
        secondarySpotlight.setAttribute('data-animate-sbs-event', 'blockintoview');
        secondarySpotlight.setAttribute('data-animate-sbs-opts', PINK_SPOTLIGHT_ANIMATIONS['spotlight-2'].opts);
        secondarySpotlight.style.cssText = `
            position: absolute;
            top: 60%;
            right: 10%;
            width: 150px;
            height: 150px;
            background: radial-gradient(circle, rgba(255,176,63,0.6) 0%, rgba(216,18,89,0.3) 60%, transparent 80%);
            border-radius: 50%;
            filter: blur(15px);
            opacity: 0;
            z-index: 3;
            pointer-events: none;
        `;
        
        if (heroSection) {
            heroSection.appendChild(secondarySpotlight);
        }
    }
    
    triggerAnimation(element) {
        if (this.animations.has(element)) return;
        
        const opts = element.getAttribute('data-animate-sbs-opts');
        if (!opts) return;
        
        try {
            const animationSteps = JSON.parse(opts);
            this.runAnimationSequence(element, animationSteps);
            this.animations.set(element, true);
        } catch (e) {
            console.error('Animation parsing error:', e);
        }
    }
    
    runAnimationSequence(element, steps) {
        steps.forEach((step, index) => {
            setTimeout(() => {
                this.applyAnimationStep(element, step);
            }, step.delay || index * 200);
        });
    }
    
    applyAnimationStep(element, step) {
        const duration = 400;
        element.style.transition = `all ${duration}ms cubic-bezier(0.4, 0, 0.2, 1)`;
        
        if (step.opacity !== undefined) {
            element.style.opacity = step.opacity;
        }
        
        if (step.x || step.y) {
            const x = step.x || '0px';
            const y = step.y || '0px';
            element.style.transform = `translate(${x}, ${y})`;
        }
        
        if (step.color) {
            // Update background gradient with new color
            const size = element.classList.contains('hero-spotlight') ? '200px' : '150px';
            element.style.background = `radial-gradient(circle, ${step.color} 0%, rgba(255,176,63,0.2) 60%, transparent 80%)`;
        }
    }
    
    bindEvents() {
        // Restart animations on scroll
        let scrollTimeout;
        window.addEventListener('scroll', () => {
            clearTimeout(scrollTimeout);
            scrollTimeout = setTimeout(() => {
                this.refreshAnimations();
            }, 100);
        });
    }
    
    refreshAnimations() {
        // Allow animations to re-trigger for visible elements
        const visibleElements = document.querySelectorAll('[data-animate-sbs-event="blockintoview"]');
        visibleElements.forEach(element => {
            const rect = element.getBoundingClientRect();
            if (rect.top > window.innerHeight || rect.bottom < 0) {
                this.animations.delete(element);
            }
        });
    }
}

// Hero Section Animations
class HeroAnimations {
    constructor() {
        this.init();
    }
    
    init() {
        this.initTypewriter();
        this.initMovingSpotlight();
    }
    
    initTypewriter() {
        const textElement = document.querySelector('.typewriter-text');
        if (!textElement) return;
        
        const texts = [
            'spreadsheet automation',
            'grant&fund management', 
            'simplified compliance',
            'proudly built by'
        ];
        
        let textIndex = 0;
        let charIndex = 0;
        let isDeleting = false;
        let currentText = '';
        
        function typeWriter() {
            const fullText = texts[textIndex];
            
            if (isDeleting) {
                currentText = fullText.substring(0, charIndex - 1);
                charIndex--;
            } else {
                currentText = fullText.substring(0, charIndex + 1);
                charIndex++;
            }
            
            textElement.textContent = currentText + '|';
            
            let typeSpeed = isDeleting ? 50 : 100;
            
            if (!isDeleting && charIndex === fullText.length) {
                typeSpeed = 2000;
                isDeleting = true;
            } else if (isDeleting && charIndex === 0) {
                isDeleting = false;
                textIndex = (textIndex + 1) % texts.length;
                typeSpeed = 500;
            }
            
            setTimeout(typeWriter, typeSpeed);
        }
        
        setTimeout(typeWriter, 500);
    }
    
    initMovingSpotlight() {
        const spotlight = document.getElementById('pink-spotlight');
        if (!spotlight) return;
        
        let spotlightX = 200;
        let spotlightY = 50;
        let directionX = 2;
        let directionY = 1.5;
        
        function moveSpotlight() {
            spotlightX += directionX;
            spotlightY += directionY;
            
            const containerWidth = window.innerWidth;
            const containerHeight = 330;
            const spotlightSize = 400;
            
            if (spotlightX >= containerWidth - spotlightSize || spotlightX <= 0) {
                directionX *= -1;
            }
            if (spotlightY >= containerHeight - spotlightSize || spotlightY <= 0) {
                directionY *= -1;
            }
            
            spotlight.style.transform = `translate(${spotlightX}px, ${spotlightY}px)`;
            requestAnimationFrame(moveSpotlight);
        }
        
        moveSpotlight();
    }
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Tilda animation controller
    window.tildaAnimations = new TildaAnimationController();
    
    // Initialize Hero animations
    window.heroAnimations = new HeroAnimations();
    
    console.log('🎭 Tilda Pink Spotlight Animations Initialized');
    console.log('🏠 Hero Animations Initialized');
});

// Export for global access
window.TildaAnimationController = TildaAnimationController;
window.HeroAnimations = HeroAnimations;
