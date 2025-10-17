/**
 * Mobile Performance Optimizer
 * Enhances existing modules for better mobile performance without modifying them
 */

class MobilePerformanceOptimizer {
    constructor() {
        this.isMobile = window.innerWidth < 768;
        this.isTablet = window.innerWidth < 1024;
        this.isLowEndDevice = this.detectLowEndDevice();
        
        if (this.isMobile || this.isLowEndDevice) {
            this.init();
        }
    }
    
    init() {
        // Wait for other modules to load, then optimize
        setTimeout(() => {
            this.optimizeVideoFeatures();
            this.optimizeAnimations();
            this.setupIntersectionOptimizations();
            this.optimizeMemoryUsage();
        }, 100);
    }
    
    detectLowEndDevice() {
        // Simple heuristics to detect low-end devices
        const memoryLimit = navigator.deviceMemory ? navigator.deviceMemory < 4 : false;
        const slowConnection = navigator.connection ? 
            ['slow-2g', '2g', '3g'].includes(navigator.connection.effectiveType) : false;
        const oldUserAgent = /Android [1-6]|iPhone OS [1-9]_|iPad.*OS [1-9]_/.test(navigator.userAgent);
        
        return memoryLimit || slowConnection || oldUserAgent;
    }
    
    optimizeVideoFeatures() {
        const videoSection = document.querySelector('.video-features-section');
        if (!videoSection) return;
        
        // Reduce rocket animation complexity
        this.optimizeRocketAnimations(videoSection);
        
        // Optimize connection labels
        this.optimizeConnectionLabels(videoSection);
        
        // Optimize background elements
        this.optimizeBackgroundElements(videoSection);
        
        // Setup lazy loading for GIFs
        this.setupGifLazyLoading(videoSection);
    }
    
    optimizeRocketAnimations(section) {
        const rockets = section.querySelectorAll('.rocket');
        
        rockets.forEach((rocket, index) => {
            // Reduce animation frequency
            rocket.style.animationDuration = '3s'; // Slower animation
            
            // Stagger animations to reduce simultaneous load
            rocket.style.animationDelay = `${index * 0.5}s`;
            
            // Use transform3d for better performance
            rocket.style.transform = 'translate3d(0,0,0)';
            
            // Remove animations entirely on very low-end devices
            if (this.isLowEndDevice) {
                rocket.style.animation = 'none';
                rocket.style.transform = 'none';
            }
        });
    }
    
    optimizeConnectionLabels(section) {
        const labels = section.querySelectorAll('.connection-label');
        
        if (this.isMobile) {
            // Hide connection labels on mobile to improve performance
            labels.forEach(label => {
                label.style.display = 'none';
            });
        } else if (this.isLowEndDevice) {
            // Simplify for low-end devices
            labels.forEach(label => {
                label.style.animation = 'none';
                label.style.opacity = '0.5';
            });
        }
    }
    
    optimizeBackgroundElements(section) {
        const ellipses = section.querySelectorAll('.ellipse');
        const exhaustFlames = section.querySelectorAll('.exhaust-flame');
        
        if (this.isMobile || this.isLowEndDevice) {
            // Remove or simplify background decorations
            ellipses.forEach(ellipse => {
                if (this.isLowEndDevice) {
                    ellipse.style.display = 'none';
                } else {
                    ellipse.style.animation = 'none';
                    ellipse.style.opacity = '0.3';
                }
            });
            
            exhaustFlames.forEach(flame => {
                if (this.isLowEndDevice) {
                    flame.style.display = 'none';
                } else {
                    flame.style.opacity = '0.5';
                    flame.style.filter = 'blur(1px)';
                }
            });
        }
    }
    
    setupGifLazyLoading(section) {
        const gifs = section.querySelectorAll('.feature-gif');
        
        gifs.forEach(gif => {
            // Add intersection observer for GIFs
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        this.loadGif(entry.target);
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                rootMargin: this.isMobile ? '20px' : '50px'
            });
            
            // Replace src with data-src for lazy loading
            if (gif.src && !gif.dataset.originalSrc) {
                gif.dataset.originalSrc = gif.src;
                gif.src = this.createGifPlaceholder();
                gif.style.filter = 'blur(5px)';
            }
            
            observer.observe(gif);
        });
    }
    
    loadGif(gif) {
        const originalSrc = gif.dataset.originalSrc;
        if (!originalSrc) return;
        
        const img = new Image();
        img.onload = () => {
            gif.style.transition = 'filter 0.3s ease';
            gif.src = originalSrc;
            gif.style.filter = 'none';
            
            // Add pause/play control on mobile
            if (this.isMobile) {
                this.addGifControls(gif);
            }
        };
        img.src = originalSrc;
    }
    
    createGifPlaceholder() {
        // Create a simple colored placeholder
        return 'data:image/svg+xml;base64,' + btoa(`
            <svg xmlns="http://www.w3.org/2000/svg" width="400" height="300" viewBox="0 0 400 300">
                <rect width="100%" height="100%" fill="#f0f0f0"/>
                <text x="50%" y="50%" text-anchor="middle" dy=".3em" font-family="Arial" font-size="16" fill="#999">Loading...</text>
            </svg>
        `);
    }
    
    addGifControls(gif) {
        const wrapper = gif.closest('.video-wrapper');
        if (!wrapper || wrapper.querySelector('.mobile-gif-control')) return;
        
        const control = document.createElement('button');
        control.className = 'mobile-gif-control';
        control.innerHTML = '⏸️';
        control.title = 'Pause/Resume animation';
        
        control.style.cssText = `
            position: absolute;
            bottom: 8px;
            right: 8px;
            background: rgba(0,0,0,0.7);
            border: none;
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            cursor: pointer;
            z-index: 10;
        `;
        
        let isPaused = false;
        control.addEventListener('click', () => {
            if (isPaused) {
                // Resume: reload the gif
                const src = gif.src;
                gif.src = '';
                gif.src = src;
                control.innerHTML = '⏸️';
            } else {
                // Pause: convert to static image
                const canvas = document.createElement('canvas');
                const ctx = canvas.getContext('2d');
                canvas.width = gif.naturalWidth || gif.width;
                canvas.height = gif.naturalHeight || gif.height;
                ctx.drawImage(gif, 0, 0);
                gif.src = canvas.toDataURL();
                control.innerHTML = '▶️';
            }
            isPaused = !isPaused;
        });
        
        wrapper.appendChild(control);
    }
    
    optimizeAnimations() {
        // Reduce animation complexity globally on mobile
        if (this.isMobile || this.isLowEndDevice) {
            const style = document.createElement('style');
            style.textContent = `
                .mobile-optimized * {
                    animation-duration: 1s !important;
                    transition-duration: 0.2s !important;
                }
                
                ${this.isLowEndDevice ? `
                .mobile-optimized .rocket,
                .mobile-optimized .ellipse,
                .mobile-optimized .exhaust-flame {
                    animation: none !important;
                    transform: none !important;
                }` : ''}
            `;
            document.head.appendChild(style);
            
            document.documentElement.classList.add('mobile-optimized');
        }
    }
    
    setupIntersectionOptimizations() {
        // Pause animations when elements are out of view
        const animatedElements = document.querySelectorAll('.rocket, .ellipse, .exhaust-flame');
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                const element = entry.target;
                if (entry.isIntersecting) {
                    element.style.animationPlayState = 'running';
                } else {
                    element.style.animationPlayState = 'paused';
                }
            });
        }, {
            rootMargin: '50px'
        });
        
        animatedElements.forEach(el => observer.observe(el));
    }
    
    optimizeMemoryUsage() {
        // Clean up resources when possible
        window.addEventListener('beforeunload', () => {
            // Cancel any ongoing animations
            const animatedElements = document.querySelectorAll('[style*="animation"]');
            animatedElements.forEach(el => {
                el.style.animation = 'none';
            });
        });
        
        // Monitor memory usage if available
        if (performance.memory) {
            setInterval(() => {
                const memUsage = performance.memory.usedJSHeapSize / performance.memory.jsHeapSizeLimit;
                if (memUsage > 0.8) {
                    console.warn('High memory usage detected, reducing animations');
                    document.documentElement.classList.add('performance-reduced');
                }
            }, 5000);
        }
    }
}

// Auto-initialize
export default function initMobilePerformanceOptimizer() {
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => {
            new MobilePerformanceOptimizer();
        });
    } else {
        new MobilePerformanceOptimizer();
    }
}
