/**
 * Smart Grant Solutions Theme JavaScript
 * 1:1 Recreation of Tilda MissionGranted Site
 */

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
        
        this.element.innerHTML = '<span class="typed-cursor">|</span>';
        setTimeout(() => this.type(), this.startDelay);
    }
    
    type() {
        const currentText = this.texts[this.currentTextIndex];
        
        if (this.isDeleting) {
            this.currentCharIndex--;
        } else {
            this.currentCharIndex++;
        }
        
        const displayText = currentText.substring(0, this.currentCharIndex);
        this.element.innerHTML = displayText + '<span class="typed-cursor">|</span>';
        
        let nextDelay = this.isDeleting ? this.backSpeed : this.typeSpeed;
        
        if (!this.isDeleting && this.currentCharIndex === currentText.length) {
            nextDelay = this.backDelay;
            this.isDeleting = true;
        } else if (this.isDeleting && this.currentCharIndex === 0) {
            this.isDeleting = false;
            this.currentTextIndex = (this.currentTextIndex + 1) % this.texts.length;
            nextDelay = 500;
        }
        
        this.timeoutId = setTimeout(() => this.type(), nextDelay);
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
        this.components = {};
        this.init();
    }
    
    init() {
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => this.initComponents());
        } else {
            this.initComponents();
        }
    }
    
    initComponents() {
        try {
            // Initialize typed animation for hero section
            if (document.querySelector('.hero-animated-text')) {
                this.components.typedAnimation = new TypedAnimation('.hero-animated-text', {
                    texts: [
                        'spreadsheet automation',
                        'grant&fund management',
                        'simplified compliance', 
                        'proudly built by'
                    ],
                    typeSpeed: 80,
                    backSpeed: 40,
                    startDelay: 1000,
                    backDelay: 2000,
                    loop: true
                });
            }
            
            // Initialize smooth scrolling
            this.initSmoothScrolling();
            
            // Initialize button effects
            this.initButtonEffects();
            
            // Initialize responsive adjustments
            this.initResponsiveAdjustments();
            
            console.log('SGS Theme initialized successfully');
        } catch (error) {
            console.error('Error initializing SGS Theme:', error);
        }
    }
    
    initSmoothScrolling() {
        const links = document.querySelectorAll('a[href^="#"]');
        links.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    }
    
    initButtonEffects() {
        // CTA Button hover effects matching Tilda design
        const ctaButtons = document.querySelectorAll('.tn-atom[href*="reach-out"], .tn-atom[data-btn-effects="hover"]');
        
        ctaButtons.forEach(button => {
            const originalBg = button.style.backgroundColor || '#d81259';
            const originalBorder = button.style.borderColor || 'transparent';
            
            button.addEventListener('mouseenter', function() {
                this.style.backgroundColor = '#000000';
                this.style.borderColor = '#d81259';
                this.style.transition = 'all 0.3s ease';
            });
            
            button.addEventListener('mouseleave', function() {
                this.style.backgroundColor = originalBg;
                this.style.borderColor = originalBorder;
            });
        });
    }
    
    initResponsiveAdjustments() {
        // Add responsive CSS for mobile optimization
        if (!document.querySelector('#sgs-responsive-styles')) {
            const style = document.createElement('style');
            style.id = 'sgs-responsive-styles';
            style.innerHTML = `
                /* Mobile optimizations for exact Tilda recreation */
                @media screen and (max-width: 640px) {
                    .t396__elem[data-elem-id="1746321582982"] .tn-atom {
                        font-size: 28px !important;
                        text-align: center !important;
                        white-space: normal !important;
                        line-height: 1.2 !important;
                    }
                    
                    .t396__elem[data-elem-id="1746326442530"] .tn-atom {
                        font-size: 24px !important;
                        white-space: normal !important;
                        line-height: 1.3 !important;
                    }
                    
                    .hero-animated-text {
                        font-size: 32px !important;
                        text-align: center !important;
                    }
                }
                
                @media screen and (max-width: 480px) {
                    .t396__elem[data-elem-id="1746321582982"] .tn-atom {
                        font-size: 24px !important;
                    }
                    
                    .t396__elem[data-elem-id="1746326442530"] .tn-atom {
                        font-size: 20px !important;
                    }
                    
                    .hero-animated-text {
                        font-size: 28px !important;
                    }
                }
                
                /* Button hover effects */
                .tn-atom[href*="reach-out"]:hover,
                .tn-atom[data-btn-effects="hover"]:hover {
                    background-color: #000000 !important;
                    border-color: #d81259 !important;
                    color: #ffffff !important;
                    transform: translateY(-2px);
                    box-shadow: 0 4px 8px rgba(216, 18, 89, 0.3);
                }
            `;
            document.head.appendChild(style);
        }
    }
}

// Initialize theme when DOM is ready
const sgsTheme = new SGSTheme();

// Make globally available
window.SGSTheme = sgsTheme;
