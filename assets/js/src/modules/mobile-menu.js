/**
 * Mobile Menu Module
 * Handles hamburger menu functionality for mobile navigation
 */

class MobileMenu {
    constructor() {
        console.log('MobileMenu constructor called');
        this.hamburger = document.getElementById('mobile-hamburger');
        this.overlay = document.getElementById('mobile-nav-overlay');
        this.closeBtn = document.getElementById('mobile-nav-close');
        this.body = document.body;
        this.isOpen = false;
        
        console.log('Hamburger element:', this.hamburger);
        console.log('Overlay element:', this.overlay);
        
        this.init();
    }
    
    init() {
        if (!this.hamburger || !this.overlay) return;
        
        this.bindEvents();
    }
    
    bindEvents() {
        // Open menu when hamburger is clicked
        this.hamburger.addEventListener('click', () => {
            console.log('Hamburger clicked!');
            this.openMenu();
        });
        
        // Close menu when close button is clicked
        if (this.closeBtn) {
            this.closeBtn.addEventListener('click', () => this.closeMenu());
        }
        
        // Close menu when overlay background is clicked
        this.overlay.addEventListener('click', (e) => {
            if (e.target === this.overlay) {
                this.closeMenu();
            }
        });
        
        // Close menu when a nav link is clicked
        const mobileNavLinks = document.querySelectorAll('.mobile-nav-link');
        mobileNavLinks.forEach(link => {
            link.addEventListener('click', () => this.closeMenu());
        });
        
        // Close menu when escape key is pressed
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && this.isOpen) {
                this.closeMenu();
            }
        });
    }
    
    openMenu() {
        console.log('Opening mobile menu');
        this.overlay.classList.add('active');
        this.hamburger.classList.add('active');
        this.body.style.overflow = 'hidden';
        this.isOpen = true;
    }
    
    closeMenu() {
        this.overlay.classList.remove('active');
        this.hamburger.classList.remove('active');
        this.body.style.overflow = '';
        this.isOpen = false;
    }
}

// Initialize mobile menu immediately
export default function initMobileMenu() {
    // Wait for DOM if not ready, otherwise initialize immediately
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => {
            new MobileMenu();
        });
    } else {
        new MobileMenu();
    }
}
