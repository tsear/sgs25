/**
 * Mission Separator Grants RSS Feed Slideshow
 * EXACT copy from Financial Compliance JavaScript
 */

class MissionGrantsSlider {
    constructor() {
        this.slider = document.querySelector('[data-ms-slider]');
        if (this.slider) {
            this.slides = Array.from(this.slider.querySelectorAll('.ms-slide'));
            this.prevBtn = this.slider.querySelector('.ms-nav--prev');
            this.nextBtn = this.slider.querySelector('.ms-nav--next');
            
            if (this.slides.length > 1) {
                this.currentIndex = this.slides.findIndex((s) => s.classList.contains('is-active'));
                if (this.currentIndex < 0) this.currentIndex = 0;
                this.autoRotationInterval = null;
                this.init();
            }
        }
    }
    
    init() {
        this.bindEvents();
        this.startAutoRotation();
    }
    
    bindEvents() {
        if (this.prevBtn) {
            this.prevBtn.addEventListener('click', () => this.goToPrevSlide());
        }
        
        if (this.nextBtn) {
            this.nextBtn.addEventListener('click', () => this.goToNextSlide());
        }
        
        // Pause auto-rotation on hover, resume on mouse leave
        this.slider.addEventListener('mouseenter', () => this.pauseAutoRotation());
        this.slider.addEventListener('mouseleave', () => this.startAutoRotation());
    }
    
    goToPrevSlide() {
        this.slides[this.currentIndex].classList.remove('is-active');
        this.currentIndex = (this.currentIndex - 1 + this.slides.length) % this.slides.length;
        this.slides[this.currentIndex].classList.add('is-active');
    }
    
    goToNextSlide() {
        this.slides[this.currentIndex].classList.remove('is-active');
        this.currentIndex = (this.currentIndex + 1) % this.slides.length;
        this.slides[this.currentIndex].classList.add('is-active');
    }
    
    startAutoRotation() {
        this.pauseAutoRotation(); // Clear any existing interval
        this.autoRotationInterval = setInterval(() => {
            this.goToNextSlide();
        }, 4500);
    }
    
    pauseAutoRotation() {
        if (this.autoRotationInterval) {
            clearInterval(this.autoRotationInterval);
            this.autoRotationInterval = null;
        }
    }
}

export default MissionGrantsSlider;
