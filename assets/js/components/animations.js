/**
 * Animations Component
 * Handles CSS animations and transitions throughout the theme
 */

export class Animations {
  constructor() {
    this.animatedElements = new Map();
    this.animationQueue = [];
    this.isProcessingQueue = false;
    
    this.init();
  }

  init() {
    this.setupAnimationStyles();
    this.bindEvents();
    this.processExistingElements();
  }

  setupAnimationStyles() {
    // Inject CSS animations if not already present
    if (!document.querySelector('#sgs-animations-css')) {
      const style = document.createElement('style');
      style.id = 'sgs-animations-css';
      style.textContent = this.getAnimationCSS();
      document.head.appendChild(style);
    }
  }

  getAnimationCSS() {
    return `
      /* SGS Theme Animations */
      
      /* Base animation classes */
      .animate-fade-in {
        animation: sgs-fadeIn 0.6s ease-out forwards;
      }
      
      .animate-slide-up {
        animation: sgs-slideUp 0.6s ease-out forwards;
      }
      
      .animate-slide-down {
        animation: sgs-slideDown 0.6s ease-out forwards;
      }
      
      .animate-slide-left {
        animation: sgs-slideLeft 0.6s ease-out forwards;
      }
      
      .animate-slide-right {
        animation: sgs-slideRight 0.6s ease-out forwards;
      }
      
      .animate-scale-in {
        animation: sgs-scaleIn 0.5s ease-out forwards;
      }
      
      .animate-bounce-in {
        animation: sgs-bounceIn 0.8s ease-out forwards;
      }
      
      .animate-rotate-in {
        animation: sgs-rotateIn 0.6s ease-out forwards;
      }

      /* Keyframe definitions */
      @keyframes sgs-fadeIn {
        from {
          opacity: 0;
        }
        to {
          opacity: 1;
        }
      }
      
      @keyframes sgs-slideUp {
        from {
          opacity: 0;
          transform: translateY(30px);
        }
        to {
          opacity: 1;
          transform: translateY(0);
        }
      }
      
      @keyframes sgs-slideDown {
        from {
          opacity: 0;
          transform: translateY(-30px);
        }
        to {
          opacity: 1;
          transform: translateY(0);
        }
      }
      
      @keyframes sgs-slideLeft {
        from {
          opacity: 0;
          transform: translateX(30px);
        }
        to {
          opacity: 1;
          transform: translateX(0);
        }
      }
      
      @keyframes sgs-slideRight {
        from {
          opacity: 0;
          transform: translateX(-30px);
        }
        to {
          opacity: 1;
          transform: translateX(0);
        }
      }
      
      @keyframes sgs-scaleIn {
        from {
          opacity: 0;
          transform: scale(0.9);
        }
        to {
          opacity: 1;
          transform: scale(1);
        }
      }
      
      @keyframes sgs-bounceIn {
        0% {
          opacity: 0;
          transform: scale(0.3);
        }
        50% {
          opacity: 1;
          transform: scale(1.05);
        }
        70% {
          transform: scale(0.9);
        }
        100% {
          opacity: 1;
          transform: scale(1);
        }
      }
      
      @keyframes sgs-rotateIn {
        from {
          opacity: 0;
          transform: rotate(-200deg);
        }
        to {
          opacity: 1;
          transform: rotate(0);
        }
      }

      /* Stagger animations */
      .animate-stagger > * {
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.6s ease-out;
      }
      
      .animate-stagger.is-visible > * {
        opacity: 1;
        transform: translateY(0);
      }

      /* Hover animations */
      .hover-lift {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
      }
      
      .hover-lift:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
      }
      
      .hover-scale {
        transition: transform 0.3s ease;
      }
      
      .hover-scale:hover {
        transform: scale(1.05);
      }
      
      .hover-rotate {
        transition: transform 0.3s ease;
      }
      
      .hover-rotate:hover {
        transform: rotate(5deg);
      }

      /* Loading animations */
      .loading-spinner {
        display: inline-block;
        width: 20px;
        height: 20px;
        border: 3px solid rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        border-top-color: #fff;
        animation: spin 1s ease-in-out infinite;
      }
      
      @keyframes spin {
        to {
          transform: rotate(360deg);
        }
      }

      /* Pulse animation */
      .pulse {
        animation: pulse 2s infinite;
      }
      
      @keyframes pulse {
        0% {
          transform: scale(1);
        }
        50% {
          transform: scale(1.05);
        }
        100% {
          transform: scale(1);
        }
      }

      /* Text animations */
      .animate-typing {
        overflow: hidden;
        border-right: 0.15em solid #d81259;
        white-space: nowrap;
        animation: typing 3.5s steps(40, end), blink-caret 0.75s step-end infinite;
      }
      
      @keyframes typing {
        from {
          width: 0;
        }
        to {
          width: 100%;
        }
      }
      
      @keyframes blink-caret {
        from, to {
          border-color: transparent;
        }
        50% {
          border-color: #d81259;
        }
      }

      /* Reduced motion preferences */
      @media (prefers-reduced-motion: reduce) {
        *,
        *::before,
        *::after {
          animation-duration: 0.01ms !important;
          animation-iteration-count: 1 !important;
          transition-duration: 0.01ms !important;
        }
      }
    `;
  }

  bindEvents() {
    // Listen for custom animation events
    document.addEventListener('sgs:animate', (event) => {
      this.animateElement(event.detail.element, event.detail.animation, event.detail.options);
    });

    // Listen for stagger animation triggers
    document.addEventListener('sgs:animate-stagger', (event) => {
      this.animateStagger(event.detail.container, event.detail.options);
    });
  }

  processExistingElements() {
    // Process elements with animation classes
    const elementsToAnimate = document.querySelectorAll('[data-animate]:not(.processed)');
    
    elementsToAnimate.forEach(element => {
      element.classList.add('processed');
      const animation = element.dataset.animate;
      const delay = parseInt(element.dataset.animateDelay) || 0;
      const duration = parseInt(element.dataset.animateDuration) || 600;
      
      this.queueAnimation({
        element,
        animation,
        delay,
        duration
      });
    });

    this.processAnimationQueue();
  }

  queueAnimation(animationData) {
    this.animationQueue.push(animationData);
  }

  async processAnimationQueue() {
    if (this.isProcessingQueue || this.animationQueue.length === 0) {
      return;
    }

    this.isProcessingQueue = true;

    while (this.animationQueue.length > 0) {
      const animationData = this.animationQueue.shift();
      await this.executeAnimation(animationData);
    }

    this.isProcessingQueue = false;
  }

  async executeAnimation(animationData) {
    const { element, animation, delay, duration } = animationData;

    if (delay > 0) {
      await this.wait(delay);
    }

    return this.animateElement(element, animation, { duration });
  }

  animateElement(element, animation, options = {}) {
    if (!element) return Promise.resolve();

    return new Promise((resolve) => {
      const duration = options.duration || 600;
      const easing = options.easing || 'ease-out';
      
      // Set custom duration if specified
      if (duration !== 600) {
        element.style.animationDuration = `${duration}ms`;
        element.style.animationTimingFunction = easing;
      }

      // Remove any existing animation classes
      this.clearAnimationClasses(element);

      // Apply new animation class
      const animationClass = `animate-${animation}`;
      element.classList.add(animationClass, 'is-visible');

      // Store animation data
      this.animatedElements.set(element, {
        animation,
        startTime: Date.now(),
        duration,
        options
      });

      // Handle animation end
      const handleAnimationEnd = () => {
        element.removeEventListener('animationend', handleAnimationEnd);
        
        // Clean up animation classes but keep is-visible
        element.classList.remove(animationClass);
        
        // Reset custom styles
        element.style.animationDuration = '';
        element.style.animationTimingFunction = '';
        
        // Fire completion event
        this.fireAnimationComplete(element, animation);
        
        resolve();
      };

      element.addEventListener('animationend', handleAnimationEnd);

      // Fallback timeout in case animationend doesn't fire
      setTimeout(() => {
        if (element.classList.contains(animationClass)) {
          handleAnimationEnd();
        }
      }, duration + 100);
    });
  }

  animateStagger(container, options = {}) {
    if (!container) return;

    const children = container.children;
    const delay = options.delay || 100;
    const animation = options.animation || 'slide-up';

    container.classList.add('animate-stagger');

    Array.from(children).forEach((child, index) => {
      setTimeout(() => {
        this.animateElement(child, animation);
      }, index * delay);
    });

    // Mark container as visible after all animations start
    setTimeout(() => {
      container.classList.add('is-visible');
    }, 0);
  }

  // Specialized animation methods
  typewriter(element, text, options = {}) {
    if (!element) return Promise.resolve();

    return new Promise((resolve) => {
      const speed = options.speed || 50;
      const cursor = options.cursor !== false;
      
      element.textContent = '';
      
      if (cursor) {
        element.classList.add('animate-typing');
      }

      let index = 0;
      const typeInterval = setInterval(() => {
        element.textContent += text[index];
        index++;

        if (index >= text.length) {
          clearInterval(typeInterval);
          
          if (!cursor) {
            element.classList.remove('animate-typing');
          }
          
          resolve();
        }
      }, speed);
    });
  }

  countUp(element, targetValue, options = {}) {
    if (!element) return Promise.resolve();

    return new Promise((resolve) => {
      const duration = options.duration || 2000;
      const startValue = options.startValue || 0;
      const easing = options.easing || 'ease-out';
      
      const startTime = Date.now();
      const endTime = startTime + duration;

      const animate = () => {
        const currentTime = Date.now();
        const progress = Math.min((currentTime - startTime) / duration, 1);
        
        // Apply easing
        let easedProgress = progress;
        if (easing === 'ease-out') {
          easedProgress = 1 - Math.pow(1 - progress, 3);
        }

        const currentValue = Math.floor(startValue + (targetValue - startValue) * easedProgress);
        element.textContent = this.formatNumber(currentValue, options.format);

        if (currentTime < endTime) {
          requestAnimationFrame(animate);
        } else {
          element.textContent = this.formatNumber(targetValue, options.format);
          resolve();
        }
      };

      requestAnimationFrame(animate);
    });
  }

  morphShape(element, newPath, options = {}) {
    if (!element || element.tagName !== 'path') return Promise.resolve();

    return new Promise((resolve) => {
      const duration = options.duration || 800;
      const currentPath = element.getAttribute('d');
      
      // This is a basic implementation - for complex path morphing,
      // you'd want to use a library like Flubber or similar
      element.style.transition = `d ${duration}ms ease-in-out`;
      element.setAttribute('d', newPath);

      setTimeout(() => {
        element.style.transition = '';
        resolve();
      }, duration);
    });
  }

  // Utility methods
  clearAnimationClasses(element) {
    const animationClasses = [
      'animate-fade-in', 'animate-slide-up', 'animate-slide-down',
      'animate-slide-left', 'animate-slide-right', 'animate-scale-in',
      'animate-bounce-in', 'animate-rotate-in'
    ];

    animationClasses.forEach(className => {
      element.classList.remove(className);
    });
  }

  formatNumber(number, format) {
    if (format === 'currency') {
      return new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD'
      }).format(number);
    }
    
    if (format === 'percentage') {
      return `${number}%`;
    }
    
    return number.toLocaleString();
  }

  wait(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
  }

  fireAnimationComplete(element, animation) {
    const event = new CustomEvent('sgs:animation-complete', {
      detail: {
        element,
        animation,
        timestamp: Date.now()
      }
    });

    element.dispatchEvent(event);
  }

  // Public API methods
  animate(element, animation, options = {}) {
    return this.animateElement(element, animation, options);
  }

  stagger(container, options = {}) {
    return this.animateStagger(container, options);
  }

  addHoverEffect(element, effect = 'lift') {
    if (!element) return;

    element.classList.add(`hover-${effect}`);
  }

  removeHoverEffect(element, effect = 'lift') {
    if (!element) return;

    element.classList.remove(`hover-${effect}`);
  }

  pauseAnimations() {
    document.body.style.animationPlayState = 'paused';
  }

  resumeAnimations() {
    document.body.style.animationPlayState = 'running';
  }

  // Check if element has been animated
  hasBeenAnimated(element) {
    return this.animatedElements.has(element);
  }

  // Get animation data for element
  getAnimationData(element) {
    return this.animatedElements.get(element);
  }

  // Reset element animation state
  resetElement(element) {
    this.clearAnimationClasses(element);
    element.classList.remove('is-visible', 'processed');
    element.style.animationDuration = '';
    element.style.animationTimingFunction = '';
    this.animatedElements.delete(element);
  }

  // Refresh all animations (useful after dynamic content loading)
  refresh() {
    this.processExistingElements();
  }

  destroy() {
    // Clear all stored animation data
    this.animatedElements.clear();
    this.animationQueue = [];
    
    // Remove animation styles
    const styleSheet = document.querySelector('#sgs-animations-css');
    if (styleSheet) {
      styleSheet.remove();
    }

    // Reset all animated elements
    document.querySelectorAll('.is-visible').forEach(element => {
      this.resetElement(element);
    });
  }
}
