// ==========================================================================
// TRUSTED ORGANIZATIONS CAROUSEL
// ==========================================================================
// Recreates Tilda t738 carousel functionality exactly
// Auto-cycling every 3 seconds with navigation arrows

class TrustedOrgsCarousel {
  constructor() {
    this.carousel = document.querySelector('.trusted-orgs-carousel');
    this.slidesWrapper = document.querySelector('.carousel-slides');
    this.slides = document.querySelectorAll('.carousel-slide');
    this.leftArrow = document.querySelector('.carousel-arrow--left');
    this.rightArrow = document.querySelector('.carousel-arrow--right');
    
    this.currentSlide = 0;
    this.totalSlides = this.slides.length;
    this.autoPlayInterval = null;
    this.isAutoPlaying = true;
    
    if (this.carousel && this.slidesWrapper && this.slides.length > 0) {
      this.init();
    }
  }
  
  init() {
    // Set initial position
    this.updateSlidePosition();
    
    // Bind event listeners
    this.bindEvents();
    
    // Start auto-play
    this.startAutoPlay();
  }
  
  bindEvents() {
    // Navigation arrows
    if (this.leftArrow) {
      this.leftArrow.addEventListener('click', () => {
        this.goToPreviousSlide();
        this.resetAutoPlay();
      });
    }
    
    if (this.rightArrow) {
      this.rightArrow.addEventListener('click', () => {
        this.goToNextSlide();
        this.resetAutoPlay();
      });
    }
    
    // Keyboard navigation
    document.addEventListener('keydown', (e) => {
      if (!this.carousel.matches(':hover')) return;
      
      switch (e.key) {
        case 'ArrowLeft':
          e.preventDefault();
          this.goToPreviousSlide();
          this.resetAutoPlay();
          break;
        case 'ArrowRight':
          e.preventDefault();
          this.goToNextSlide();
          this.resetAutoPlay();
          break;
      }
    });
    
    // Pause on hover, resume on leave
    this.carousel.addEventListener('mouseenter', () => {
      this.pauseAutoPlay();
    });
    
    this.carousel.addEventListener('mouseleave', () => {
      if (this.isAutoPlaying) {
        this.startAutoPlay();
      }
    });
    
    // Handle visibility change (pause when tab is inactive)
    document.addEventListener('visibilitychange', () => {
      if (document.hidden) {
        this.pauseAutoPlay();
      } else if (this.isAutoPlaying) {
        this.startAutoPlay();
      }
    });
  }
  
  goToSlide(slideIndex) {
    // Ensure slide index is within bounds
    if (slideIndex < 0) {
      this.currentSlide = this.totalSlides - 1;
    } else if (slideIndex >= this.totalSlides) {
      this.currentSlide = 0;
    } else {
      this.currentSlide = slideIndex;
    }
    
    this.updateSlidePosition();
  }
  
  goToNextSlide() {
    this.goToSlide(this.currentSlide + 1);
  }
  
  goToPreviousSlide() {
    this.goToSlide(this.currentSlide - 1);
  }
  
  updateSlidePosition() {
    const translateX = -(this.currentSlide * 100);
    this.slidesWrapper.style.transform = `translateX(${translateX}%)`;
    
    // Update accessibility attributes
    this.slides.forEach((slide, index) => {
      const isActive = index === this.currentSlide;
      slide.setAttribute('aria-hidden', !isActive);
      
      // Update tabindex for interactive elements in slides
      const links = slide.querySelectorAll('a');
      links.forEach(link => {
        link.tabIndex = isActive ? 0 : -1;
      });
    });
  }
  
  startAutoPlay() {
    if (this.totalSlides <= 1) return; // Don't auto-play if only one slide
    
    this.pauseAutoPlay(); // Clear any existing interval
    
    this.autoPlayInterval = setInterval(() => {
      this.goToNextSlide();
    }, 3000); // 3 seconds like Tilda
  }
  
  pauseAutoPlay() {
    if (this.autoPlayInterval) {
      clearInterval(this.autoPlayInterval);
      this.autoPlayInterval = null;
    }
  }
  
  resetAutoPlay() {
    if (this.isAutoPlaying) {
      this.startAutoPlay();
    }
  }
  
  // Public methods for external control
  play() {
    this.isAutoPlaying = true;
    this.startAutoPlay();
  }
  
  pause() {
    this.isAutoPlaying = false;
    this.pauseAutoPlay();
  }
  
  destroy() {
    this.pauseAutoPlay();
    
    // Remove event listeners
    if (this.leftArrow) {
      this.leftArrow.removeEventListener('click', this.goToPreviousSlide);
    }
    if (this.rightArrow) {
      this.rightArrow.removeEventListener('click', this.goToNextSlide);
    }
  }
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
  const trustedOrgsCarousel = new TrustedOrgsCarousel();
  
  // Make globally accessible for debugging/external control
  window.trustedOrgsCarousel = trustedOrgsCarousel;
});

// Export for potential module usage
if (typeof module !== 'undefined' && module.exports) {
  module.exports = TrustedOrgsCarousel;
}
