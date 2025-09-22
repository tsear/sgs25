/**
 * Smart Grant Solutions Theme JavaScript
 * Main entry point with modular imports
 */

import BlogShowMore from './modules/blog-showmore.js';
import BlogSearch from './modules/blog-search.js';

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
        this.initTypedAnimation();
        this.initBlogModules();
        this.addCustomStyles();
    }
    
    initTypedAnimation() {
        // Initialize typed animation if element exists
        const typedElement = document.querySelector('#hero-typed-text');
        if (typedElement) {
            this.typedAnimation = new TypedAnimation('#hero-typed-text');
        }
    }
    
    initBlogModules() {
        // Initialize blog functionality
        this.blogShowMore = new BlogShowMore();
        this.blogSearch = new BlogSearch();
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
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    const sgsTheme = new SGSTheme();
    
    // Make globally available for debugging
    window.SGSTheme = sgsTheme;
});
