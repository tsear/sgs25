/**
 * Lazy Loading Module
 * Handles progressive image loading, mobile optimization, and performance improvements
 */

class LazyLoader {
    constructor() {
        this.observer = null;
        this.isMobile = window.innerWidth < 768;
        this.isReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        
        this.init();
    }
    
    init() {
        // Create intersection observer for lazy loading
        this.createIntersectionObserver();
        
        // Setup mobile optimizations
        this.setupMobileOptimizations();
        
        // Optimize existing elements
        this.optimizeExistingElements();
        
        // Setup performance monitoring
        this.setupPerformanceOptimizations();
    }
    
    createIntersectionObserver() {
        const options = {
            root: null,
            rootMargin: this.isMobile ? '50px' : '100px', // Smaller margin on mobile
            threshold: 0.1
        };
        
        this.observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    this.loadElement(entry.target);
                    this.observer.unobserve(entry.target);
                }
            });
        }, options);
        
        // Observe all images that need lazy loading
        this.observeImages();
    }
    
    observeImages() {
        // Find images with data-src or without src
        const lazyImages = document.querySelectorAll('img[data-src], img:not([src])');
        const backgroundImages = document.querySelectorAll('[data-bg]');
        
        lazyImages.forEach(img => {
            // Add placeholder if needed
            if (!img.src && !img.dataset.src) return;
            
            if (!img.src) {
                img.src = this.createPlaceholder(img);
            }
            
            this.observer.observe(img);
        });
        
        backgroundImages.forEach(el => {
            this.observer.observe(el);
        });
    }
    
    loadElement(element) {
        if (element.tagName === 'IMG') {
            this.loadImage(element);
        } else if (element.dataset.bg) {
            this.loadBackgroundImage(element);
        }
    }
    
    loadImage(img) {
        const src = img.dataset.src || img.dataset.lazySrc;
        if (!src) return;
        
        // Create a new image to preload
        const imageLoader = new Image();
        
        imageLoader.onload = () => {
            // Fade in the image
            img.style.opacity = '0';
            img.src = src;
            
            // Animate in
            img.style.transition = 'opacity 0.3s ease';
            requestAnimationFrame(() => {
                img.style.opacity = '1';
            });
            
            // Remove data attributes
            delete img.dataset.src;
            delete img.dataset.lazySrc;
            
            // Add loaded class
            img.classList.add('lazy-loaded');
        };
        
        imageLoader.onerror = () => {
            img.classList.add('lazy-error');
        };
        
        imageLoader.src = src;
    }
    
    loadBackgroundImage(element) {
        const bgSrc = element.dataset.bg;
        if (!bgSrc) return;
        
        const imageLoader = new Image();
        imageLoader.onload = () => {
            element.style.backgroundImage = `url(${bgSrc})`;
            element.classList.add('lazy-loaded');
            delete element.dataset.bg;
        };
        imageLoader.src = bgSrc;
    }
    
    createPlaceholder(img) {
        // Create a simple SVG placeholder
        const width = img.width || 800;
        const height = img.height || 600;
        
        return `data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='${width}' height='${height}' viewBox='0 0 ${width} ${height}'%3E%3Crect width='100%25' height='100%25' fill='%23f0f0f0'/%3E%3C/svg%3E`;
    }
    
    setupMobileOptimizations() {
        if (!this.isMobile) return;
        
        // Reduce animation complexity on mobile
        if (this.isReducedMotion) {
            document.documentElement.classList.add('reduced-motion');
        }
        
        // Disable heavy animations on mobile
        document.documentElement.classList.add('mobile-optimized');
        
        // Reduce intersection observer frequency on mobile
        this.throttleScrollEvents();
    }
    
    optimizeExistingElements() {
        // Find and optimize GIFs for mobile
        if (this.isMobile) {
            this.optimizeGifsForMobile();
        }
        
        // Add loading states
        this.addLoadingStates();
    }
    
    optimizeGifsForMobile() {
        const gifs = document.querySelectorAll('img[src*=".gif"], img[data-src*=".gif"]');
        
        gifs.forEach(gif => {
            if (this.isMobile) {
                // Add pause on mobile option
                gif.classList.add('mobile-gif');
                
                // Create play/pause control
                this.addGifControls(gif);
            }
        });
    }
    
    addGifControls(gif) {
        const wrapper = gif.parentElement;
        if (!wrapper || wrapper.querySelector('.gif-controls')) return;
        
        const controls = document.createElement('div');
        controls.className = 'gif-controls';
        controls.innerHTML = `
            <button class="gif-toggle" aria-label="Pause/Play animation">
                <span class="pause-icon">⏸</span>
                <span class="play-icon" style="display:none">▶</span>
            </button>
        `;
        
        wrapper.style.position = 'relative';
        wrapper.appendChild(controls);
        
        // Add toggle functionality
        const toggle = controls.querySelector('.gif-toggle');
        let isPaused = false;
        
        toggle.addEventListener('click', () => {
            if (isPaused) {
                // Resume gif - reload source
                const src = gif.src;
                gif.src = '';
                gif.src = src;
                toggle.querySelector('.pause-icon').style.display = '';
                toggle.querySelector('.play-icon').style.display = 'none';
            } else {
                // Pause gif - create static version
                const canvas = document.createElement('canvas');
                const ctx = canvas.getContext('2d');
                canvas.width = gif.width;
                canvas.height = gif.height;
                ctx.drawImage(gif, 0, 0);
                gif.src = canvas.toDataURL();
                toggle.querySelector('.pause-icon').style.display = 'none';
                toggle.querySelector('.play-icon').style.display = '';
            }
            isPaused = !isPaused;
        });
    }
    
    addLoadingStates() {
        // Add loading skeleton to video cards
        const videoCards = document.querySelectorAll('.video-card');
        videoCards.forEach(card => {
            if (!card.querySelector('.loading-skeleton')) {
                const skeleton = document.createElement('div');
                skeleton.className = 'loading-skeleton';
                card.appendChild(skeleton);
            }
        });
    }
    
    throttleScrollEvents() {
        // Throttle scroll-based animations on mobile
        let ticking = false;
        
        const updateAnimations = () => {
            // Update any scroll-based animations
            ticking = false;
        };
        
        const requestTick = () => {
            if (!ticking) {
                requestAnimationFrame(updateAnimations);
                ticking = true;
            }
        };
        
        window.addEventListener('scroll', requestTick, { passive: true });
    }
    
    setupPerformanceOptimizations() {
        // Monitor performance and adjust accordingly
        if ('PerformanceObserver' in window) {
            this.setupPerformanceMonitoring();
        }
        
        // Setup connection-based optimizations
        if ('connection' in navigator) {
            this.optimizeForConnection();
        }
    }
    
    setupPerformanceMonitoring() {
        const observer = new PerformanceObserver((list) => {
            const entries = list.getEntries();
            entries.forEach(entry => {
                // Monitor long tasks and adjust loading strategy
                if (entry.duration > 50) {
                    console.warn('Long task detected:', entry.duration + 'ms');
                    // Reduce animation complexity
                    document.documentElement.classList.add('performance-reduced');
                }
            });
        });
        
        observer.observe({ entryTypes: ['longtask'] });
    }
    
    optimizeForConnection() {
        const connection = navigator.connection;
        
        if (connection.effectiveType === 'slow-2g' || connection.effectiveType === '2g') {
            // Disable heavy animations and optimize for slow connections
            document.documentElement.classList.add('slow-connection');
            
            // Reduce image quality
            this.reduceImageQuality();
        }
    }
    
    reduceImageQuality() {
        // For slow connections, load lower quality images if available
        const images = document.querySelectorAll('img[data-src-low]');
        images.forEach(img => {
            if (img.dataset.srcLow) {
                img.dataset.src = img.dataset.srcLow;
            }
        });
    }
}

// Auto-initialize when DOM is ready
export default function initLazyLoader() {
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => {
            new LazyLoader();
        });
    } else {
        new LazyLoader();
    }
}
