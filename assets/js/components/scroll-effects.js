/**
 * Scroll Effects Component
 * Handles scroll-based animations and effects
 */

export class ScrollEffects {
  constructor() {
    this.elements = [];
    this.scrollY = 0;
    this.ticking = false;
    this.intersectionObserver = null;
    
    this.init();
  }

  init() {
    this.setupIntersectionObserver();
    this.bindScrollEvents();
    this.registerAnimationElements();
  }

  setupIntersectionObserver() {
    // Check if IntersectionObserver is supported
    if (!window.IntersectionObserver) {
      console.warn('IntersectionObserver not supported, using fallback');
      return;
    }

    const options = {
      root: null,
      rootMargin: '0px 0px -50px 0px', // Trigger when 50px visible
      threshold: [0, 0.25, 0.5, 0.75, 1]
    };

    this.intersectionObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => this.handleIntersection(entry));
    }, options);
  }

  registerAnimationElements() {
    // Elements that should animate on scroll
    const animationSelectors = [
      '.fade-in',
      '.slide-up',
      '.scale-in',
      '.service-card',
      '.team-card',
      '.testimonial-card',
      '.project-card',
      '[data-animate]'
    ];

    animationSelectors.forEach(selector => {
      const elements = document.querySelectorAll(selector);
      elements.forEach(element => this.registerElement(element));
    });
  }

  registerElement(element) {
    if (!element || this.elements.find(item => item.element === element)) {
      return; // Already registered or element doesn't exist
    }

    const elementData = {
      element: element,
      animation: this.getAnimationType(element),
      delay: this.getAnimationDelay(element),
      duration: this.getAnimationDuration(element),
      triggered: false,
      repeat: element.dataset.animateRepeat === 'true'
    };

    this.elements.push(elementData);

    // Use IntersectionObserver if available
    if (this.intersectionObserver) {
      this.intersectionObserver.observe(element);
    } else {
      // Fallback for older browsers
      this.checkElementVisibility(elementData);
    }
  }

  handleIntersection(entry) {
    const elementData = this.elements.find(item => item.element === entry.target);
    if (!elementData) return;

    if (entry.isIntersecting) {
      if (!elementData.triggered || elementData.repeat) {
        this.triggerAnimation(elementData);
      }
    } else if (elementData.repeat && elementData.triggered) {
      this.resetAnimation(elementData);
    }
  }

  triggerAnimation(elementData) {
    const { element, animation, delay, duration } = elementData;

    // Apply animation delay if specified
    if (delay > 0) {
      setTimeout(() => {
        this.applyAnimation(element, animation, duration);
      }, delay);
    } else {
      this.applyAnimation(element, animation, duration);
    }

    elementData.triggered = true;
  }

  applyAnimation(element, animation, duration) {
    // Remove any existing animation classes
    element.classList.remove('animate-fade-in', 'animate-slide-up', 'animate-scale-in', 'animate-slide-left', 'animate-slide-right');
    
    // Set custom duration if specified
    if (duration && duration !== 600) {
      element.style.animationDuration = `${duration}ms`;
    }

    // Apply animation class
    switch (animation) {
      case 'fade-in':
        element.classList.add('animate-fade-in');
        break;
      case 'slide-up':
        element.classList.add('animate-slide-up');
        break;
      case 'scale-in':
        element.classList.add('animate-scale-in');
        break;
      case 'slide-left':
        element.classList.add('animate-slide-left');
        break;
      case 'slide-right':
        element.classList.add('animate-slide-right');
        break;
      default:
        element.classList.add('animate-fade-in');
    }

    // Add visible class for CSS animations
    element.classList.add('is-visible', 'animated');
  }

  resetAnimation(elementData) {
    const { element } = elementData;
    
    element.classList.remove('animate-fade-in', 'animate-slide-up', 'animate-scale-in', 
                            'animate-slide-left', 'animate-slide-right', 'is-visible', 'animated');
    element.style.animationDuration = '';
    elementData.triggered = false;
  }

  getAnimationType(element) {
    // Check data attribute first
    if (element.dataset.animate) {
      return element.dataset.animate;
    }

    // Check CSS classes
    if (element.classList.contains('fade-in')) return 'fade-in';
    if (element.classList.contains('slide-up')) return 'slide-up';
    if (element.classList.contains('scale-in')) return 'scale-in';

    // Default based on element type
    if (element.classList.contains('service-card') || 
        element.classList.contains('team-card')) {
      return 'slide-up';
    }

    return 'fade-in';
  }

  getAnimationDelay(element) {
    const delay = element.dataset.animateDelay;
    return delay ? parseInt(delay, 10) : 0;
  }

  getAnimationDuration(element) {
    const duration = element.dataset.animateDuration;
    return duration ? parseInt(duration, 10) : 600;
  }

  bindScrollEvents() {
    // Parallax and other scroll effects
    window.addEventListener('scroll', () => {
      this.scrollY = window.pageYOffset;
      
      if (!this.ticking) {
        requestAnimationFrame(() => {
          this.updateScrollEffects();
          this.ticking = false;
        });
        this.ticking = true;
      }
    }, { passive: true });
  }

  updateScrollEffects() {
    // Parallax elements
    this.updateParallaxElements();
    
    // Progress bars
    this.updateProgressBars();
    
    // Counter animations
    this.updateCounters();

    // Fallback visibility check for older browsers
    if (!this.intersectionObserver) {
      this.elements.forEach(elementData => {
        if (!elementData.triggered || elementData.repeat) {
          this.checkElementVisibility(elementData);
        }
      });
    }
  }

  updateParallaxElements() {
    const parallaxElements = document.querySelectorAll('[data-parallax]');
    
    parallaxElements.forEach(element => {
      const speed = parseFloat(element.dataset.parallax) || 0.5;
      const rect = element.getBoundingClientRect();
      const elementTop = rect.top + this.scrollY;
      const elementHeight = element.offsetHeight;
      const windowHeight = window.innerHeight;

      // Check if element is in viewport
      if (rect.bottom >= 0 && rect.top <= windowHeight) {
        const scrolled = this.scrollY - elementTop + windowHeight;
        const parallax = scrolled * speed;
        
        element.style.transform = `translateY(${parallax}px)`;
      }
    });
  }

  updateProgressBars() {
    const progressBars = document.querySelectorAll('.progress-bar[data-progress]');
    
    progressBars.forEach(bar => {
      const rect = bar.getBoundingClientRect();
      
      if (rect.top <= window.innerHeight * 0.8 && rect.bottom >= 0) {
        const progress = parseInt(bar.dataset.progress, 10);
        const progressFill = bar.querySelector('.progress-fill');
        
        if (progressFill && !bar.classList.contains('animated')) {
          bar.classList.add('animated');
          
          // Animate progress bar
          let current = 0;
          const increment = progress / 60; // 60 frames for 1 second at 60fps
          
          const animate = () => {
            current += increment;
            if (current < progress) {
              progressFill.style.width = `${current}%`;
              requestAnimationFrame(animate);
            } else {
              progressFill.style.width = `${progress}%`;
            }
          };
          
          animate();
        }
      }
    });
  }

  updateCounters() {
    const counters = document.querySelectorAll('.counter[data-count-to]');
    
    counters.forEach(counter => {
      const rect = counter.getBoundingClientRect();
      
      if (rect.top <= window.innerHeight * 0.8 && rect.bottom >= 0) {
        if (!counter.classList.contains('animated')) {
          counter.classList.add('animated');
          this.animateCounter(counter);
        }
      }
    });
  }

  animateCounter(counter) {
    const target = parseInt(counter.dataset.countTo, 10);
    const duration = parseInt(counter.dataset.countDuration, 10) || 2000;
    const increment = target / (duration / 16); // 60fps
    
    let current = 0;
    
    const animate = () => {
      current += increment;
      
      if (current < target) {
        counter.textContent = Math.floor(current);
        requestAnimationFrame(animate);
      } else {
        counter.textContent = target;
      }
    };
    
    animate();
  }

  checkElementVisibility(elementData) {
    const { element } = elementData;
    const rect = element.getBoundingClientRect();
    const windowHeight = window.innerHeight;
    
    // Check if element is in viewport
    if (rect.top <= windowHeight * 0.8 && rect.bottom >= 0) {
      if (!elementData.triggered || elementData.repeat) {
        this.triggerAnimation(elementData);
      }
    } else if (elementData.repeat && elementData.triggered && rect.top > windowHeight) {
      this.resetAnimation(elementData);
    }
  }

  // Public methods
  addElement(element, options = {}) {
    if (!element) return;

    // Set data attributes based on options
    if (options.animation) element.dataset.animate = options.animation;
    if (options.delay) element.dataset.animateDelay = options.delay;
    if (options.duration) element.dataset.animateDuration = options.duration;
    if (options.repeat) element.dataset.animateRepeat = options.repeat;

    this.registerElement(element);
  }

  removeElement(element) {
    if (!element) return;

    const index = this.elements.findIndex(item => item.element === element);
    if (index > -1) {
      if (this.intersectionObserver) {
        this.intersectionObserver.unobserve(element);
      }
      this.elements.splice(index, 1);
    }
  }

  refresh() {
    // Re-register all elements (useful after dynamic content loading)
    this.elements = [];
    this.registerAnimationElements();
  }

  destroy() {
    // Clean up observers
    if (this.intersectionObserver) {
      this.intersectionObserver.disconnect();
    }

    // Remove scroll listeners
    window.removeEventListener('scroll', this.updateScrollEffects);

    // Reset elements
    this.elements.forEach(elementData => {
      this.resetAnimation(elementData);
    });

    this.elements = [];
  }
}
