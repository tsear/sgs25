/**
 * Smart Grant Solutions Theme JavaScript
 * Main entry point with modular imports
 */

console.log('🔥🔥🔥 MAIN.JS: File is loading!');
console.log('🔥🔥🔥 MAIN.JS: Browser is:', navigator.userAgent);

import BlogShowMore from './modules/blog-showmore.js';
import BlogSearch from './modules/blog-search.js';
import initNewsletter from './modules/newsletter.js';
import FinancialComplianceSlider from './modules/rss-feed-fincom.js';
import ValuePropAnimations from './modules/value-prop-animations.js';
import MissionGrantsSlider from './modules/rss-feed-mission-div.js';
import RocketAnimation from './modules/rocket-animation.js';
import initMobileMenu from './modules/mobile-menu.js';
import DownloadsGateway from './modules/downloads.js';
import ContactPage from './modules/contact-page.js';
import LandingHeroTypewriter from './modules/landing-hero.js';
import './modules/hubspot-tracking.js';
import './footer-badge-carousel.js';

/**
 * Typed Animation Class
 * Recreates the exact Tilda t635 typed text animation
 */
class TypedAnimation {
    constructor(selector, options = {}) {
        this.element = document.querySelector(selector);
        if (!this.element) return;
        
        this.texts = options.texts || [
            'spreadsheet automation',
            'grant&fund management', 
            'simplified compliance',
            'proudly built by'
        ];
        
        this.typeSpeed = options.typeSpeed || 80;
        this.backSpeed = options.backSpeed || 40;
        this.startDelay = options.startDelay || 1000;
        this.backDelay = options.backDelay || 2000;
        this.loop = options.loop !== false;
        
        this.currentTextIndex = 0;
        this.currentCharIndex = 0;
        this.isDeleting = false;
        this.timeoutId = null;
        
        this.init();
    }
    
    init() {
        // Add cursor blinking styles
        if (!document.querySelector('#typed-cursor-styles')) {
            const style = document.createElement('style');
            style.id = 'typed-cursor-styles';
            style.innerHTML = `
                .typed-cursor {
                    animation: typed-blink 1s infinite;
                    color: #ffffff;
                    font-weight: 400;
                }
                @keyframes typed-blink {
                    0%, 50% { opacity: 1; }
                    51%, 100% { opacity: 0; }
                }
            `;
            document.head.appendChild(style);
        }
        
        setTimeout(() => this.type(), this.startDelay);
    }
    
    type() {
        const currentText = this.texts[this.currentTextIndex];
        
        if (this.isDeleting) {
            this.element.innerHTML = currentText.substring(0, this.currentCharIndex - 1) + '<span class="typed-cursor">|</span>';
            this.currentCharIndex--;
            
            if (this.currentCharIndex === 0) {
                this.isDeleting = false;
                this.currentTextIndex = (this.currentTextIndex + 1) % this.texts.length;
                this.timeoutId = setTimeout(() => this.type(), 500);
            } else {
                this.timeoutId = setTimeout(() => this.type(), this.backSpeed);
            }
        } else {
            this.element.innerHTML = currentText.substring(0, this.currentCharIndex + 1) + '<span class="typed-cursor">|</span>';
            this.currentCharIndex++;
            
            if (this.currentCharIndex === currentText.length) {
                this.isDeleting = true;
                this.timeoutId = setTimeout(() => this.type(), this.backDelay);
            } else {
                this.timeoutId = setTimeout(() => this.type(), this.typeSpeed);
            }
        }
    }
    
    destroy() {
        if (this.timeoutId) {
            clearTimeout(this.timeoutId);
        }
    }
}

/**
 * Main Theme Class
 */
class SGSTheme {
    constructor() {
        this.init();
    }
    
    init() {
        // Always initialize core features
        this.initTypedAnimation();
        this.initMobileMenu();
        this.addCustomStyles();
        
        // Conditionally initialize based on page content
        this.initConditionalModules();
    }
    
    initConditionalModules() {
        // Blog modules - only on blog/post pages
        if (document.querySelector('.blog-content, .blog-container, .post-content, .blog-search-container')) {
            console.log('Initializing blog modules...');
            this.initBlogModules();
        }

        // ✅ Grants page - initialize show more for grants
        if (document.querySelector('.grants-posts-grid, .grants-show-more')) {
            console.log('Initializing grants show more...');
            new BlogShowMore();
        }
        
        // Newsletter - only if form container exists
        if (document.querySelector('#newsletter-form, .newsletter-container')) {
            console.log('Initializing newsletter...');
            this.initNewsletter();
        }
        
        // Financial Compliance slider - only if slider exists
        if (document.querySelector('[data-fc-slider]')) {
            console.log('Initializing financial compliance slider...');
            this.initFinancialCompliance();
        }
        
        // Mission Grants slider - only if slider exists  
        if (document.querySelector('[data-mission-slider]')) {
            console.log('Initializing mission grants slider...');
            this.initMissionGrants();
        }
        
        // Downloads gateway - only on downloads page
        if (document.querySelector('#download-gate-modal')) {
            console.log('Initializing downloads gateway...');
            this.initDownloads();
        }
        
        // Contact page - only on contact page
        if (document.querySelector('.page-template-page-contact')) {
            console.log('Initializing contact page...');
            this.initContactPage();
        }
    }
    
    initTypedAnimation() {
        // Initialize landing hero typewriter if element exists
        const typedElement = document.querySelector('#hero-typed-text');
        if (typedElement) {
            this.landingHero = new LandingHeroTypewriter();
        }
    }
    
    initBlogModules() {
        // Only initialize if blog elements exist
        if (document.querySelector('.blog-content, .blog-container, .post-content')) {
            this.blogShowMore = new BlogShowMore();
            this.blogSearch = new BlogSearch();
        }
    }
    
    initFinancialCompliance() {
        // Only initialize if slider exists
        if (document.querySelector('[data-fc-slider]')) {
            console.log('Financial compliance slider found, initializing...');
            this.financialComplianceSlider = new FinancialComplianceSlider();
        }
    }
    
    initMissionGrants() {
        // Only initialize if slider exists
        if (document.querySelector('[data-mission-slider]')) {
            console.log('Mission grants slider found, initializing...');
            new MissionGrantsSlider();
        }
    }
    
    initNewsletter() {
        // Only initialize if newsletter form exists
        if (document.querySelector('#newsletter-form, .newsletter-container')) {
            console.log('Newsletter form found, initializing...');
            initNewsletter();
        }
    }
    
    initMobileMenu() {
        // Initialize mobile menu functionality
        console.log('Initializing mobile menu...');
        initMobileMenu();
    }
    
    initDownloads() {
        console.log('🚀🚀🚀 MAIN.JS: initDownloads called');
        console.log('🚀🚀🚀 MAIN.JS: Document ready state:', document.readyState);
        console.log('🚀🚀🚀 MAIN.JS: Looking for modal...');
        
        const tryInitialize = () => {
            const modal = document.querySelector('#download-gate-modal');
            const triggers = document.querySelectorAll('.download-trigger');
            
            console.log('🚀🚀🚀 MAIN.JS: tryInitialize called', {
                modal: modal,
                modalExists: !!modal,
                triggerCount: triggers.length,
                triggers: triggers,
                bodyClasses: document.body.className
            });
            
            if (modal) {
                console.log('🚀🚀🚀 MAIN.JS: Download modal found, initializing downloads gateway...');
                this.downloadsGateway = new DownloadsGateway();
                console.log('🚀🚀🚀 MAIN.JS: Downloads gateway created:', this.downloadsGateway);
                return true;
            }
            console.log('🚀🚀🚀 MAIN.JS: Download modal not found yet, will retry...');
            return false;
        };
        
        // Try immediately first
        if (!tryInitialize()) {
            // If not found, retry up to 5 times with increasing delays
            let attempts = 0;
            const maxAttempts = 5;
            
            const retry = () => {
                attempts++;
                console.log(`Download modal retry attempt ${attempts}/${maxAttempts}`);
                
                if (tryInitialize()) {
                    console.log('Download modal found on retry - downloads ready!');
                    return; // Success!
                }
                
                if (attempts < maxAttempts) {
                    // Exponential backoff: 100ms, 200ms, 400ms, 800ms, 1600ms
                    setTimeout(retry, 100 * Math.pow(2, attempts - 1));
                } else {
                    console.log('Download modal not found after all retries - downloads unavailable on this page');
                }
            };
            
            // Start retry sequence
            setTimeout(retry, 100);
        }
    }
    
    addCustomStyles() {
        // Add any dynamic styles
        if (!document.querySelector('#sgs-dynamic-styles')) {
            const style = document.createElement('style');
            style.id = 'sgs-dynamic-styles';
            style.innerHTML = `
                .blog-button:hover {
                    color: #ffffff !important;
                    transform: translateY(-2px);
                    box-shadow: 0 4px 8px rgba(216, 18, 89, 0.3);
                }
            `;
            document.head.appendChild(style);
        }
    }
    
    initContactPage() {
        // Initialize contact page functionality
        console.log('Contact page detected, initializing ContactPage module...');
        
        try {
            this.contactPage = new ContactPage();
            console.log('Contact page module initialized successfully');
        } catch (error) {
            console.error('Error initializing contact page:', error);
        }
    }

}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    console.log('🔥🔥🔥 MAIN.JS: DOMContentLoaded fired!');
    console.log('🔥🔥🔥 MAIN.JS: About to create SGSTheme...');
    
    const sgsTheme = new SGSTheme();
    
    console.log('🔥🔥🔥 MAIN.JS: SGSTheme created:', sgsTheme);
    
    // Make globally available for debugging
    window.SGSTheme = sgsTheme;
    
    console.log('🔥🔥🔥 MAIN.JS: SGSTheme available on window.SGSTheme');
});
