/**
 * Trust Logos Carousel
 * Recreates the rotating funder logos carousel from the Tilda design
 */

class TrustCarousel {
    constructor(selector, options = {}) {
        this.element = document.querySelector(selector);
        if (!this.element) return;
        
        this.slides = this.element.querySelectorAll('.trust-slide');
        this.currentSlide = 0;
        this.autoplay = options.autoplay !== false;
        this.interval = options.interval || 5000;
        this.intervalId = null;
        
        this.init();
    }
    
    init() {
        if (this.slides.length <= 1) return;
        
        // Show first slide
        this.showSlide(0);
        
        if (this.autoplay) {
            this.startAutoplay();
        }
        
        // Pause on hover
        this.element.addEventListener('mouseenter', () => this.pauseAutoplay());
        this.element.addEventListener('mouseleave', () => this.startAutoplay());
    }
    
    showSlide(index) {
        // Hide all slides
        this.slides.forEach(slide => {
            slide.classList.remove('active');
        });
        
        // Show target slide
        if (this.slides[index]) {
            this.slides[index].classList.add('active');
            this.currentSlide = index;
        }
    }
    
    nextSlide() {
        const next = (this.currentSlide + 1) % this.slides.length;
        this.showSlide(next);
    }
    
    previousSlide() {
        const prev = this.currentSlide === 0 ? this.slides.length - 1 : this.currentSlide - 1;
        this.showSlide(prev);
    }
    
    startAutoplay() {
        if (this.autoplay && !this.intervalId) {
            this.intervalId = setInterval(() => {
                this.nextSlide();
            }, this.interval);
        }
    }
    
    pauseAutoplay() {
        if (this.intervalId) {
            clearInterval(this.intervalId);
            this.intervalId = null;
        }
    }
    
    destroy() {
        this.pauseAutoplay();
        if (this.element) {
            this.element.removeEventListener('mouseenter', () => this.pauseAutoplay());
            this.element.removeEventListener('mouseleave', () => this.startAutoplay());
        }
    }
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    // Initialize trust carousel
    const trustCarousel = new TrustCarousel('.trust-logos', {
        autoplay: true,
        interval: 5000
    });
});

export default TrustCarousel;
