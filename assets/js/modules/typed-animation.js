/**
 * Typed Animation Module
 * Recreates the exact Tilda t635 typed text animation for MissionGranted hero section
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
        
        this.typeSpeed = options.typeSpeed || 100;
        this.backSpeed = options.backSpeed || 50;
        this.startDelay = options.startDelay || 1000;
        this.backDelay = options.backDelay || 2000;
        this.loop = options.loop !== false;
        this.loopCount = options.loopCount || Infinity;
        
        this.currentTextIndex = 0;
        this.currentCharIndex = 0;
        this.isDeleting = false;
        this.currentLoop = 0;
        
        this.init();
    }
    
    init() {
        this.element.innerHTML = '<span class="typed-cursor">|</span>';
        
        // Add CSS for cursor blinking
        if (!document.querySelector('#typed-cursor-styles')) {
            const style = document.createElement('style');
            style.id = 'typed-cursor-styles';
            style.innerHTML = `
                .typed-cursor {
                    animation: typed-blink 1s infinite;
                    color: #d81259;
                    font-weight: normal;
                }
                @keyframes typed-blink {
                    0%, 50% { opacity: 1; }
                    51%, 100% { opacity: 0; }
                }
                .typed-text {
                    color: #d81259;
                }
            `;
            document.head.appendChild(style);
        }
        
        setTimeout(() => {
            this.type();
        }, this.startDelay);
    }
    
    type() {
        const currentText = this.texts[this.currentTextIndex];
        
        if (this.isDeleting) {
            // Deleting characters
            this.currentCharIndex--;
            this.element.innerHTML = `<span class="typed-text">${currentText.substring(0, this.currentCharIndex)}</span><span class="typed-cursor">|</span>`;
            
            if (this.currentCharIndex === 0) {
                this.isDeleting = false;
                this.currentTextIndex = (this.currentTextIndex + 1) % this.texts.length;
                
                // If we've completed a full cycle
                if (this.currentTextIndex === 0) {
                    this.currentLoop++;
                    if (this.currentLoop >= this.loopCount) {
                        return; // Stop animation
                    }
                }
                
                setTimeout(() => {
                    this.type();
                }, 200); // Brief pause before typing next word
            } else {
                setTimeout(() => {
                    this.type();
                }, this.backSpeed);
            }
        } else {
            // Typing characters
            this.currentCharIndex++;
            this.element.innerHTML = `<span class="typed-text">${currentText.substring(0, this.currentCharIndex)}</span><span class="typed-cursor">|</span>`;
            
            if (this.currentCharIndex === currentText.length) {
                // Finished typing current text, start deleting after delay
                setTimeout(() => {
                    this.isDeleting = true;
                    this.type();
                }, this.backDelay);
            } else {
                setTimeout(() => {
                    this.type();
                }, this.typeSpeed);
            }
        }
    }
    
    destroy() {
        if (this.element) {
            this.element.innerHTML = '';
        }
    }
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    // Initialize the typed animation for MissionGranted hero
    const typedAnimation = new TypedAnimation('.hero-animated-text', {
        texts: [
            'spreadsheet automation',
            'grant&fund management',
            'simplified compliance', 
            'proudly built by'
        ],
        typeSpeed: 100,
        backSpeed: 50,
        startDelay: 1000,
        backDelay: 2000,
        loop: true
    });
});

export default TypedAnimation;
