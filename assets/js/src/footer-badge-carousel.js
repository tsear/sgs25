/**
 * Footer Badge Carousel
 * Simple right-to-left scrolling carousel showing 3 badges at a time
 */

class FooterBadgeCarousel {
    constructor(element) {
        this.carousel = element;
        this.track = this.carousel.querySelector('.badge-carousel-track');
        this.badges = this.carousel.querySelectorAll('.badge-item');
        this.totalBadges = this.badges.length;
        this.visibleBadges = 3;
        this.currentIndex = 0;
        this.autoplayDelay = 4000;
        this.isPlaying = true;
        this.autoplayTimer = null;
        
        this.init();
    }
    
    init() {
        if (this.totalBadges <= this.visibleBadges) {
            // Show all badges statically if 3 or fewer
            return;
        }
        
        this.setupCarousel();
        this.setupEventListeners();
        this.play();
    }
    
    setupCarousel() {
        // Track width = exactly fit all badges, no more
        this.track.style.width = `${this.totalBadges * (100 / this.visibleBadges)}%`;
        
        // Each badge takes equal space within the track
        this.badges.forEach(badge => {
            badge.style.width = `${100 / this.totalBadges}%`;
            badge.style.flexBasis = `${100 / this.totalBadges}%`;
            badge.style.flexShrink = '0';
        });
    }
    
    setupEventListeners() {
        // Pause on hover
        this.carousel.addEventListener('mouseenter', () => this.pause());
        this.carousel.addEventListener('mouseleave', () => this.play());
    }
    
    nextSlide() {
        this.currentIndex++;
        
        // Loop back to start when we reach the end
        if (this.currentIndex > this.totalBadges - this.visibleBadges) {
            this.currentIndex = 0;
        }
        
        // Move the track RIGHT TO LEFT (negative values move left)
        const movePercent = (this.currentIndex / this.totalBadges) * 100;
        this.track.style.transform = `translateX(-${movePercent}%)`;
    }
    
    play() {
        if (this.totalBadges <= this.visibleBadges) return;
        
        this.isPlaying = true;
        this.autoplayTimer = setInterval(() => {
            if (this.isPlaying) {
                this.nextSlide();
            }
        }, this.autoplayDelay);
    }
    
    pause() {
        this.isPlaying = false;
        if (this.autoplayTimer) {
            clearInterval(this.autoplayTimer);
            this.autoplayTimer = null;
        }
    }
}

// Initialize carousel when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    const badgeCarousel = document.querySelector('.footer-badge-carousel');
    if (badgeCarousel) {
        new FooterBadgeCarousel(badgeCarousel);
    }
});

// Export for potential external use
if (typeof module !== 'undefined' && module.exports) {
    module.exports = FooterBadgeCarousel;
}
