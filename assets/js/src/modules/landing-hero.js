/**
 * Landing Hero Typewriter Animation
 * Modern, lightweight typewriter effect for hero tagline
 */

class TypewriterEffect {
    constructor(element, phrases, options = {}) {
        this.element = element;
        this.phrases = phrases;
        this.phraseIndex = 0;
        this.charIndex = 0;
        this.isDeleting = false;
        
        // Options with defaults
        this.typeSpeed = options.typeSpeed || 100;
        this.deleteSpeed = options.deleteSpeed || 50;
        this.pauseDuration = options.pauseDuration || 2000;
        this.loop = options.loop !== false;
        
        // Start after a brief delay
        setTimeout(() => this.type(), 500);
    }
    
    type() {
        const currentPhrase = this.phrases[this.phraseIndex];
        
        if (this.isDeleting) {
            // Remove characters
            this.element.textContent = currentPhrase.substring(0, this.charIndex - 1);
            this.charIndex--;
            
            if (this.charIndex === 0) {
                this.isDeleting = false;
                this.phraseIndex = (this.phraseIndex + 1) % this.phrases.length;
                
                // If we've looped through all phrases and loop is false, stop
                if (!this.loop && this.phraseIndex === 0) {
                    this.element.textContent = this.phrases[0];
                    this.element.classList.remove('landing-hero__tagline--typing');
                    return;
                }
                
                setTimeout(() => this.type(), 500);
                return;
            }
        } else {
            // Add characters
            this.element.textContent = currentPhrase.substring(0, this.charIndex + 1);
            this.charIndex++;
            
            if (this.charIndex === currentPhrase.length) {
                this.isDeleting = true;
                setTimeout(() => this.type(), this.pauseDuration);
                return;
            }
        }
        
        const speed = this.isDeleting ? this.deleteSpeed : this.typeSpeed;
        setTimeout(() => this.type(), speed);
    }
}

// Export for use in main.js
export default class LandingHero {
    constructor() {
        this.init();
    }
    
    init() {
        const heroText = document.getElementById('hero-typed-text');
        
        if (heroText) {
            // Phrases to cycle through
            const phrases = [
                'FINANCIAL EMPOWERMENT',
                'GRANT SUCCESS',
                'COMPLIANCE SIMPLIFIED',
                'STRATEGIC GROWTH',
                'AUDIT CONFIDENCE'
            ];
            
            // Initialize typewriter with options
            this.typewriter = new TypewriterEffect(heroText, phrases, {
                typeSpeed: 100,
                deleteSpeed: 50,
                pauseDuration: 2500,
                loop: true
            });
        }
    }
}
